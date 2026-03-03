"""
Dépendances FastAPI pour l'authentification.
"""

from typing import Optional

from fastapi import Depends, Header, HTTPException, status

from app.auth.jwt import decode_token
from app.auth.models import UserInfo


def get_current_user(authorization: Optional[str] = Header(None)) -> UserInfo:
    """
    Dépendance FastAPI — extrait et valide le Bearer token.
    Lève une 401 si le token est absent ou invalide.
    """
    if not authorization or not authorization.startswith("Bearer "):
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token d'authentification manquant",
            headers={"WWW-Authenticate": "Bearer"},
        )

    token = authorization.removeprefix("Bearer ").strip()
    payload = decode_token(token)

    if not payload or payload.get("type") != "access":
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token invalide ou expiré",
            headers={"WWW-Authenticate": "Bearer"},
        )

    return UserInfo(
        id=payload.get("sub", ""),
        username=payload.get("username", ""),
        email=payload.get("email", ""),
        full_name=payload.get("full_name", ""),
        role=payload.get("role", "student"),
        is_active=True,
    )


def require_role(*roles: str):
    """Dépendance factory — requiert un rôle spécifique."""
    def _check(user: UserInfo = Depends(get_current_user)) -> UserInfo:
        if user.role not in roles:
            raise HTTPException(
                status_code=status.HTTP_403_FORBIDDEN,
                detail=f"Rôle requis : {', '.join(roles)}",
            )
        return user
    return _check
