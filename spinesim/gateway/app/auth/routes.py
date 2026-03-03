"""
Routes d'authentification.
Le gateway proxifie les requêtes /auth/* vers le backend Julia,
et peut aussi gérer des sessions localement.
"""

from fastapi import APIRouter, Depends, HTTPException, Request, status
from fastapi.security import OAuth2PasswordRequestForm

from app.auth.models import LoginRequest, RegisterRequest, RefreshRequest, TokenResponse, UserInfo
from app.auth.dependencies import get_current_user
from app.config import settings

router = APIRouter()


@router.post("/login", response_model=TokenResponse, summary="Connexion utilisateur")
async def login(request: Request, body: LoginRequest):
    """
    Authentifie l'utilisateur via le backend Julia
    et retourne les tokens JWT access + refresh.
    """
    client = request.app.state.http_client
    try:
        resp = await client.post(
            "/api/v1/auth/login",
            json={"username": body.username, "password": body.password},
        )
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    if resp.status_code != 200:
        detail = resp.json().get("error", "Identifiants incorrects")
        raise HTTPException(status_code=resp.status_code, detail=detail)

    data = resp.json()
    return TokenResponse(
        access_token=data["access_token"],
        refresh_token=data["refresh_token"],
        token_type="bearer",
        expires_in=settings.jwt_access_token_expire_minutes * 60,
    )


@router.post("/register", status_code=201, summary="Inscription utilisateur")
async def register(request: Request, body: RegisterRequest):
    """Crée un nouveau compte utilisateur via le backend Julia."""
    client = request.app.state.http_client
    try:
        resp = await client.post(
            "/api/v1/auth/register",
            json={
                "username": body.username,
                "email": body.email,
                "password": body.password,
                "full_name": body.full_name,
                "role": body.role,
            },
        )
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    if resp.status_code not in (200, 201):
        detail = resp.json().get("error", "Erreur lors de l'inscription")
        raise HTTPException(status_code=resp.status_code, detail=detail)

    return resp.json()


@router.post("/refresh", response_model=TokenResponse, summary="Renouveler les tokens")
async def refresh_tokens(request: Request, body: RefreshRequest):
    """Renouvelle les tokens JWT depuis le refresh token."""
    client = request.app.state.http_client
    try:
        resp = await client.post(
            "/api/v1/auth/refresh",
            json={"refresh_token": body.refresh_token},
        )
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    if resp.status_code != 200:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Refresh token invalide ou expiré",
        )

    data = resp.json()
    return TokenResponse(
        access_token=data["access_token"],
        refresh_token=data["refresh_token"],
        token_type="bearer",
        expires_in=settings.jwt_access_token_expire_minutes * 60,
    )


@router.get("/me", response_model=UserInfo, summary="Profil utilisateur courant")
async def get_me(current_user: UserInfo = Depends(get_current_user)):
    """Retourne les informations du compte connecté."""
    return current_user


@router.post("/logout", summary="Déconnexion")
async def logout(
    request: Request,
    current_user: UserInfo = Depends(get_current_user),
):
    """Révoque le token (proxifié vers le backend Julia)."""
    client = request.app.state.http_client
    auth_header = request.headers.get("authorization", "")
    try:
        await client.post(
            "/api/v1/auth/logout",
            headers={"Authorization": auth_header},
        )
    except Exception:
        pass  # Ne pas bloquer la déconnexion si le backend est inaccessible

    return {"message": "Déconnexion réussie"}
