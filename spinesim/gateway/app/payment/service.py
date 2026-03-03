"""
VERTEX© — Service Stripe pour la gestion des abonnements.
"""

from __future__ import annotations
import logging
from typing import Optional

import stripe
from .models import (
    CheckoutRequest, CheckoutResponse,
    PortalRequest, PortalResponse,
    SubscriptionStatus, PlanTier, PLAN_CONFIG,
)

logger = logging.getLogger(__name__)


class StripeService:
    """
    Couche d'abstraction autour de l'API Stripe.
    Instancier avec la clé secrète Stripe.
    """

    def __init__(self, secret_key: str, webhook_secret: str = ""):
        stripe.api_key = secret_key
        self._webhook_secret = webhook_secret

    # ─────────────────────────────────────────────────────────────────────────
    # Checkout Session
    # ─────────────────────────────────────────────────────────────────────────

    async def create_checkout_session(self, req: CheckoutRequest) -> CheckoutResponse:
        """
        Crée une session de checkout Stripe pour l'abonnement demandé.
        Retourne l'URL de redirection Stripe Checkout.
        """
        plan_cfg = PLAN_CONFIG[req.plan]
        price_id = plan_cfg.get("stripe_price_id")

        if req.plan == PlanTier.DECOUVERTE:
            # Plan gratuit — pas de checkout, activer directement
            return CheckoutResponse(
                checkout_url="",
                session_id="free_plan",
                plan=req.plan,
            )

        if req.plan == PlanTier.INSTITUTION or not price_id:
            raise ValueError(
                "Le plan Institution se souscrit sur devis. "
                "Contactez contact@vertex-simulation.fr"
            )

        try:
            session = stripe.checkout.Session.create(
                customer_email=req.email,
                payment_method_types=["card"],
                line_items=[{
                    "price": price_id,
                    "quantity": 1,
                }],
                mode="subscription",
                success_url=req.success_url + "?session_id={CHECKOUT_SESSION_ID}",
                cancel_url=req.cancel_url,
                metadata={
                    "user_id": req.user_id,
                    "plan":    req.plan.value,
                },
                subscription_data={
                    "metadata": {
                        "user_id": req.user_id,
                        "plan":    req.plan.value,
                    }
                },
                allow_promotion_codes=True,
                billing_address_collection="auto",
            )

            logger.info("Checkout session created: %s (user=%s plan=%s)",
                        session.id, req.user_id, req.plan.value)

            return CheckoutResponse(
                checkout_url=session.url,
                session_id=session.id,
                plan=req.plan,
            )

        except stripe.error.StripeError as e:
            logger.error("Stripe checkout error: %s", str(e))
            raise ValueError(f"Erreur Stripe: {e.user_message}") from e

    # ─────────────────────────────────────────────────────────────────────────
    # Customer Portal
    # ─────────────────────────────────────────────────────────────────────────

    async def create_portal_session(self, req: PortalRequest, customer_id: str) -> PortalResponse:
        """
        Crée une session de portail client (gestion abonnement / factures).
        """
        try:
            session = stripe.billing_portal.Session.create(
                customer=customer_id,
                return_url=req.return_url,
            )
            return PortalResponse(portal_url=session.url)
        except stripe.error.StripeError as e:
            logger.error("Stripe portal error: %s", str(e))
            raise ValueError(f"Erreur portail Stripe: {e.user_message}") from e

    # ─────────────────────────────────────────────────────────────────────────
    # Récupérer le statut d'abonnement
    # ─────────────────────────────────────────────────────────────────────────

    async def get_subscription_status(self, stripe_customer_id: str, user_id: str) -> SubscriptionStatus:
        """
        Récupère le plan actuel et le statut de l'abonnement depuis Stripe.
        """
        try:
            subs = stripe.Subscription.list(
                customer=stripe_customer_id,
                status="all",
                limit=1,
            )
            if not subs.data:
                return SubscriptionStatus(
                    user_id=user_id,
                    plan=PlanTier.DECOUVERTE,
                    status="active",
                    stripe_customer_id=stripe_customer_id,
                )

            sub = subs.data[0]
            plan_meta = sub.metadata.get("plan", "decouverte")
            try:
                plan = PlanTier(plan_meta)
            except ValueError:
                plan = PlanTier.DECOUVERTE

            from datetime import datetime
            return SubscriptionStatus(
                user_id=user_id,
                plan=plan,
                status=sub.status,
                current_period_end=datetime.fromtimestamp(sub.current_period_end),
                cancel_at_period_end=sub.cancel_at_period_end,
                stripe_subscription_id=sub.id,
                stripe_customer_id=stripe_customer_id,
            )

        except stripe.error.StripeError as e:
            logger.error("Stripe subscription lookup error: %s", str(e))
            return SubscriptionStatus(
                user_id=user_id,
                plan=PlanTier.DECOUVERTE,
                status="unknown",
                stripe_customer_id=stripe_customer_id,
            )

    # ─────────────────────────────────────────────────────────────────────────
    # Webhook handler
    # ─────────────────────────────────────────────────────────────────────────

    def verify_webhook(self, payload: bytes, sig_header: str) -> stripe.Event:
        """
        Vérifie la signature du webhook Stripe et retourne l'événement.
        Lève ValueError si la signature est invalide.
        """
        try:
            event = stripe.Webhook.construct_event(
                payload, sig_header, self._webhook_secret
            )
            return event
        except stripe.error.SignatureVerificationError as e:
            raise ValueError(f"Signature webhook invalide: {e}") from e

    def handle_webhook_event(self, event: stripe.Event) -> dict:
        """
        Traite les événements Stripe entrants et retourne les données à enregistrer.
        """
        event_type = event["type"]
        logger.info("Stripe webhook: %s", event_type)

        if event_type == "checkout.session.completed":
            session = event["data"]["object"]
            return {
                "action":   "subscription_activated",
                "user_id":  session.metadata.get("user_id"),
                "plan":     session.metadata.get("plan"),
                "customer": session.get("customer"),
                "session":  session.id,
            }

        if event_type == "customer.subscription.updated":
            sub = event["data"]["object"]
            return {
                "action":       "subscription_updated",
                "user_id":      sub.metadata.get("user_id"),
                "plan":         sub.metadata.get("plan"),
                "status":       sub.status,
                "subscription": sub.id,
            }

        if event_type == "customer.subscription.deleted":
            sub = event["data"]["object"]
            return {
                "action":       "subscription_canceled",
                "user_id":      sub.metadata.get("user_id"),
                "subscription": sub.id,
            }

        if event_type == "invoice.payment_failed":
            invoice = event["data"]["object"]
            return {
                "action":   "payment_failed",
                "customer": invoice.get("customer"),
                "amount":   invoice.get("amount_due"),
                "invoice":  invoice.id,
            }

        # Événements non gérés
        return {"action": "ignored", "event_type": event_type}
