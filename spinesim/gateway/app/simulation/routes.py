"""
Routes de simulation — proxifie vers Julia (longitudinal) et FEBio (FEM tétraédrique).
"""

from fastapi import APIRouter, Depends, HTTPException, Request, status
from fastapi.responses import JSONResponse

from app.auth.dependencies import get_current_user
from app.auth.models import UserInfo

router = APIRouter()


# ── Simulation longitudinale (backend Julia) ──────────────────

@router.post("/longitudinal", summary="Simulation longitudinale de progression scoliotique")
async def run_longitudinal(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """
    Lance la simulation longitudinale (ressort spiral).
    Body JSON : { spine_model, duration_years, initial_age, asymmetry_type }
    """
    body = await request.json()
    client = request.app.state.http_client
    try:
        resp = await client.post(
            "/api/v1/simulation/longitudinal",
            json=body,
            headers={"X-User-ID": user.id, "X-User-Role": user.role},
        )
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    return JSONResponse(content=resp.json(), status_code=resp.status_code)


@router.post("/longitudinal/compare", summary="Étude comparative multi-configurations")
async def run_comparison(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """Lance la simulation comparative pour toutes les configurations d'asymétrie."""
    body = await request.json()
    client = request.app.state.http_client
    try:
        resp = await client.post(
            "/api/v1/simulation/longitudinal/compare",
            json=body,
            headers={"X-User-ID": user.id, "X-User-Role": user.role},
        )
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    return JSONResponse(content=resp.json(), status_code=resp.status_code)


# ── FEBio (solveur tétraédrique) ─────────────────────────────

@router.post("/febio/solve", summary="Résolution FEM tétraédrique via FEBio")
async def febio_solve(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """
    Lance un solve FEBio pour analyse biomécanique détaillée.
    Body JSON : VertebralMesh (level, nodes, elements, material)
    """
    body = await request.json()
    client = request.app.state.febio_client
    try:
        resp = await client.post("/solve", json=body)
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Service FEBio inaccessible",
        ) from e

    if resp.status_code != 200:
        detail = resp.json().get("detail", "Erreur FEBio")
        raise HTTPException(status_code=resp.status_code, detail=detail)

    return resp.json()


@router.post("/febio/screw-analysis", summary="Analyse de vis pédiculaire via FEBio")
async def febio_screw_analysis(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """
    Analyse la stabilité d'une vis pédiculaire (force d'arrachement, brèche corticale).
    Body JSON : { screw: ScrewPlacement, mesh: VertebralMesh }
    """
    body = await request.json()
    client = request.app.state.febio_client
    try:
        resp = await client.post("/screw-analysis", json=body)
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Service FEBio inaccessible",
        ) from e

    if resp.status_code != 200:
        detail = resp.json().get("detail", "Erreur FEBio")
        raise HTTPException(status_code=resp.status_code, detail=detail)

    return resp.json()


# ── Chirurgie (backend Julia) ────────────────────────────────

@router.post("/surgery/evaluate", summary="Évaluation d'un plan chirurgical")
async def evaluate_surgery(
    request: Request,
    user: UserInfo = Depends(get_current_user),
):
    """Évalue un plan de chirurgie (vis + tiges) via le backend Julia."""
    body = await request.json()
    client = request.app.state.http_client
    try:
        resp = await client.post(
            "/api/v1/surgery/evaluate",
            json=body,
            headers={"X-User-ID": user.id, "X-User-Role": user.role},
        )
    except Exception as e:
        raise HTTPException(
            status_code=status.HTTP_503_SERVICE_UNAVAILABLE,
            detail="Backend Julia inaccessible",
        ) from e

    return JSONResponse(content=resp.json(), status_code=resp.status_code)
