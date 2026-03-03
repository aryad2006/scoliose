"""
VERTEX© — Modèles Pydantic pour le module de paiement Stripe.
"""

from __future__ import annotations
from datetime import datetime
from enum import Enum
from pydantic import BaseModel, field_validator
from typing import Optional


class PlanTier(str, Enum):
    DECOUVERTE = "decouverte"    # Gratuit — accès limité
    ESSENTIEL  = "essentiel"     # 590 €/an
    CHIRURGICAL= "chirurgical"   # 890 €/an
    INTEGRAL   = "integral"      # 1190 €/an
    INSTITUTION= "institution"   # Sur devis (contact commercial)


PLAN_CONFIG: dict[PlanTier, dict] = {
    PlanTier.DECOUVERTE: {
        "name":        "Découverte",
        "price_eur":   0,
        "stripe_price_id": None,
        "max_simulations": 5,
        "features": ["5 simulations / mois", "Anatomie de base", "Sans accès chirurgie"],
    },
    PlanTier.ESSENTIEL: {
        "name":        "Essentiel",
        "price_eur":   590,
        "stripe_price_id": "price_essentiel_annual",  # À remplacer par le vrai ID Stripe
        "max_simulations": 50,
        "features": [
            "50 simulations / mois",
            "Tous les modules anatomiques",
            "Chirurgie simulée (score ≤ 50)",
            "Export PDF",
            "Support email",
        ],
    },
    PlanTier.CHIRURGICAL: {
        "name":        "Chirurgical",
        "price_eur":   890,
        "stripe_price_id": "price_chirurgical_annual",
        "max_simulations": 200,
        "features": [
            "200 simulations / mois",
            "Module chirurgie complet",
            "FEBio analysis (mécanobiologie)",
            "Score chirurgical /100",
            "Quiz adaptatifs",
            "Support prioritaire",
        ],
    },
    PlanTier.INTEGRAL: {
        "name":        "Intégral",
        "price_eur":   1190,
        "stripe_price_id": "price_integral_annual",
        "max_simulations": -1,  # Illimité
        "features": [
            "Simulations illimitées",
            "Accès complet tous modules",
            "Dashboard formateur",
            "API REST complète",
            "Export SCORM / LTI 1.3",
            "SLA 99,5 %",
            "Support dédié",
        ],
    },
    PlanTier.INSTITUTION: {
        "name":        "Institution",
        "price_eur":   -1,  # Sur devis
        "stripe_price_id": None,
        "max_simulations": -1,
        "features": [
            "Déploiement auto-hébergé",
            "Multi-établissements",
            "SSO / SAML / LDAP",
            "Personnalisation marque blanche",
            "Formation des formateurs incluse",
            "Contrat de maintenance",
        ],
    },
}


class CheckoutRequest(BaseModel):
    plan:     PlanTier
    user_id:  str
    email:    str
    success_url: str = "http://localhost:5173/payment/success"
    cancel_url:  str = "http://localhost:5173/payment/cancel"


class CheckoutResponse(BaseModel):
    checkout_url: str
    session_id:   str
    plan:         PlanTier


class PortalRequest(BaseModel):
    user_id:     str
    return_url:  str = "http://localhost:5173/account"


class PortalResponse(BaseModel):
    portal_url: str


class SubscriptionStatus(BaseModel):
    user_id:        str
    plan:           PlanTier
    status:         str          # active | trialing | past_due | canceled | unpaid
    current_period_end: Optional[datetime] = None
    cancel_at_period_end: bool = False
    stripe_subscription_id: Optional[str] = None
    stripe_customer_id:     Optional[str] = None


class WebhookEvent(BaseModel):
    event_type: str
    stripe_id:  str
    payload:    dict


class PlanInfo(BaseModel):
    tier:          PlanTier
    name:          str
    price_eur:     int
    features:      list[str]
    max_simulations: int
