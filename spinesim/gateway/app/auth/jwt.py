"""
Service JWT — Création et validation des tokens.
Compatible avec le backend Julia (HS256, mêmes claims).
"""

from __future__ import annotations

import time
from typing import Optional

from jose import JWTError, jwt

from app.config import settings


def create_access_token(
    user_id: str,
    username: str,
    role: str,
) -> str:
    """Crée un access token JWT (30 min)."""
    now = int(time.time())
    payload = {
        "sub": user_id,
        "username": username,
        "role": role,
        "iat": now,
        "exp": now + settings.jwt_access_token_expire_minutes * 60,
        "type": "access",
    }
    return jwt.encode(payload, settings.jwt_secret, algorithm=settings.jwt_algorithm)


def create_refresh_token(user_id: str) -> str:
    """Crée un refresh token JWT (7 jours)."""
    now = int(time.time())
    payload = {
        "sub": user_id,
        "iat": now,
        "exp": now + settings.jwt_refresh_token_expire_days * 86400,
        "type": "refresh",
    }
    return jwt.encode(payload, settings.jwt_secret, algorithm=settings.jwt_algorithm)


def decode_token(token: str) -> Optional[dict]:
    """Décode et valide un token. Retourne None si invalide."""
    try:
        return jwt.decode(
            token,
            settings.jwt_secret,
            algorithms=[settings.jwt_algorithm],
        )
    except JWTError:
        return None


def get_user_id_from_token(token: str) -> Optional[str]:
    """Extrait le user_id (sub) depuis le token."""
    payload = decode_token(token)
    return payload.get("sub") if payload else None
