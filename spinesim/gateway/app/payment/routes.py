"""
VERTEX© — Routes FastAPI pour les paiements Stripe.
"""

from __future__ import annotations
import logging
from typing import Annotated

from fastapi import APIRouter, Depends, HTTPException, Header, Request, status

from ..auth.dependencies import get_current_user
from ..config import get_settings
from .models import (
    CheckoutRequest, CheckoutResponse,
    PortalRequest, PortalResponse,
    SubscriptionStatus, PlanTier, PLAN_CONFIG, PlanInfo,
)
from .service import StripeService

logger = logging.getLogger(__name__)
router = APIRouter(prefix="/api/payment", tags=["payment"])


# ─────────────────────────────────────────────────────────────────────────────
# Dépendance — StripeService
# ─────────────────────────────────────────────────────────────────────────────

def get_stripe_service() -> StripeService:
    settings = get_settings()
    return StripeService(
        secret_key=settings.stripe_secret_key or "",
        webhook_secret=settings.stripe_webhook_secret or "",
    )


# ─────────────────────────────────────────────────────────────────────────────
# Endpoints
# ─────────────────────────────────────────────────────────────────────────────

@router.get("/plans", response_model=list[PlanInfo])
async def list_plans() -> list[PlanInfo]:
    """
    Retourne tous les plans disponibles avec leurs fonctionnalités et tarifs.
    Endpoint public — pas d'authentification requise.
    """
    return [
        PlanInfo(
            tier=tier,
            name=cfg["name"],
            price_eur=cfg["price_eur"],
            features=cfg["features"],
            max_simulations=cfg["max_simulations"],
        )
        for tier, cfg in PLAN_CONFIG.items()
    ]


@router.post("/checkout", response_model=CheckoutResponse)
async def create_checkout(
    req: CheckoutRequest,
    current_user: dict = Depends(get_current_user),
    stripe_svc: StripeService = Depends(get_stripe_service),
) -> CheckoutResponse:
    """
    Crée une session Stripe Checkout pour souscrire à un abonnement.
    Retourne l'URL de redirection vers la page de paiement Stripe.
    """
    # Forcer l'user_id depuis le token JWT (sécurité)
    req.user_id = str(current_user["id"])

    try:
        result = await stripe_svc.create_checkout_session(req)
        return result
    except ValueError as e:
        raise HTTPException(status_code=status.HTTP_400_BAD_REQUEST, detail=str(e))


@router.post("/portal", response_model=PortalResponse)
async def customer_portal(
    req: PortalRequest,
    current_user: dict = Depends(get_current_user),
    stripe_svc: StripeService = Depends(get_stripe_service),
) -> PortalResponse:
    """
    Crée une session de portail client Stripe (gérer abonnement, factures, CB).
    Nécessite que l'utilisateur ait un customer_id Stripe enregistré.
    """
    req.user_id = str(current_user["id"])
    customer_id = current_user.get("stripe_customer_id")

    if not customer_id:
        raise HTTPException(
            status_code=status.HTTP_404_NOT_FOUND,
            detail="Aucun compte Stripe associé à cet utilisateur",
        )

    try:
        return await stripe_svc.create_portal_session(req, customer_id)
    except ValueError as e:
        raise HTTPException(status_code=status.HTTP_400_BAD_REQUEST, detail=str(e))


@router.get("/subscription", response_model=SubscriptionStatus)
async def get_subscription(
    current_user: dict = Depends(get_current_user),
    stripe_svc: StripeService = Depends(get_stripe_service),
) -> SubscriptionStatus:
    """
    Retourne le statut d'abonnement actuel de l'utilisateur authentifié.
    """
    user_id     = str(current_user["id"])
    customer_id = current_user.get("stripe_customer_id")

    if not customer_id:
        return SubscriptionStatus(
            user_id=user_id,
            plan=PlanTier.DECOUVERTE,
            status="active",
        )

    return await stripe_svc.get_subscription_status(customer_id, user_id)


@router.post("/webhook", status_code=status.HTTP_200_OK)
async def stripe_webhook(
    request: Request,
    stripe_signature: Annotated[str | None, Header(alias="stripe-signature")] = None,
    stripe_svc: StripeService = Depends(get_stripe_service),
) -> dict:
    """
    Webhook Stripe — reçoit les événements de paiement signés.
    Stripe envoie POST /api/payment/webhook avec en-tête Stripe-Signature.

    Configurer dans le Dashboard Stripe :
        Endpoint URL: https://votre-domaine.fr/api/payment/webhook
        Events: checkout.session.completed, customer.subscription.*, invoice.payment_failed
    """
    if not stripe_signature:
        raise HTTPException(
            status_code=status.HTTP_400_BAD_REQUEST,
            detail="En-tête Stripe-Signature manquant",
        )

    payload = await request.body()

    try:
        event = stripe_svc.verify_webhook(payload, stripe_signature)
    except ValueError as e:
        logger.warning("Webhook signature invalide: %s", e)
        raise HTTPException(status_code=status.HTTP_400_BAD_REQUEST, detail=str(e))

    event_data = stripe_svc.handle_webhook_event(event)
    action = event_data.get("action", "ignored")

    logger.info("Webhook traité: %s → %s", event["type"], action)

    # TODO : persister le changement de plan dans la base de données PostgreSQL
    # (via asyncpg ou un service utilisateur dédié)
    # await user_service.update_plan(event_data["user_id"], event_data.get("plan"))

    return {"received": True, "action": action}
