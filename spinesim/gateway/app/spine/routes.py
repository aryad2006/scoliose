"""
Routes du rachis — proxy vers le backend Julia.
Toutes les routes requièrent une authentification JWT valide.
"""

from fastapi import APIRouter, Depends, HTTPException, Request, status
from fastapi.responses import JSONResponse

from app.auth.dependencies import get_current_user
from app.auth.models import UserInfo

router = APIRouter()


def _forward_headers(user: UserInfo) -> dict:
    """Crée les headers à transmettre au backend Julia."""
    return {"X-User-ID": user.id, "X-User-Role": user.role}


async def _proxy_request(
    client,
    method: str,
    path: str,
    body: dict | None = None,
    headers: dict | None = None,
) -> JSONResponse:
    """Exécute une requête proxifiée vers le backend Julia."""
    try:
        request_kwargs = {
            "headers": headers or {},
        }
        if body is not None:
            request_kwargs["json"] = body

        resp = await client.request(method, path, **request_kwargs)
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    return JSONResponse(content=resp.json(), status_code=resp.status_code)


# ── Modèles de rachis ─────────────────────────────────────────

@router.get("/", summary="Lister tous les modèles sauvegardés")
async def list_models(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    return await _proxy_request(
        request.app.state.http_client, "GET", "/api/v1/spine",
        headers=_forward_headers(user),
    )


@router.get("/{model_id}", summary="Récupérer un modèle par ID")
async def get_model(
    model_id: str,
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    return await _proxy_request(
        request.app.state.http_client, "GET", f"/api/v1/spine/{model_id}",
        headers=_forward_headers(user),
    )


@router.post("/", status_code=201, summary="Créer un modèle de rachis")
async def create_model(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    body = await request.json()
    return await _proxy_request(
        request.app.state.http_client, "POST", "/api/v1/spine",
        body=body, headers=_forward_headers(user),
    )


@router.put("/{model_id}", summary="Mettre à jour un modèle")
async def update_model(
    model_id: str,
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    body = await request.json()
    return await _proxy_request(
        request.app.state.http_client, "PUT", f"/api/v1/spine/{model_id}",
        body=body, headers=_forward_headers(user),
    )


@router.delete("/{model_id}", summary="Supprimer un modèle")
async def delete_model(
    model_id: str,
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    return await _proxy_request(
        request.app.state.http_client, "DELETE", f"/api/v1/spine/{model_id}",
        headers=_forward_headers(user),
    )


# ── FEM Solve ─────────────────────────────────────────────────

@router.post("/solve", summary="Lancer le calcul FEM")
async def solve(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """Lance la résolution FEM du rachis et retourne les déplacements + contraintes."""
    body = await request.json()
    return await _proxy_request(
        request.app.state.http_client, "POST", "/api/v1/spine/solve",
        body=body, headers=_forward_headers(user),
    )


# ── Rapport PDF ───────────────────────────────────────────────

@router.post("/{model_id}/report", summary="Générer le rapport PDF")
async def generate_report(
    model_id: str,
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """Génère le rapport PDF pour un modèle via le backend Julia."""
    body = await request.json()
    # Proxifier la demande de rapport
    return await _proxy_request(
        request.app.state.http_client, "POST", f"/api/v1/spine/{model_id}/report",
        body=body, headers=_forward_headers(user),
    )
