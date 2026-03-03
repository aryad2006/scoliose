"""
VERTEX© — FastAPI Gateway
------------------------
Point d'entrée principal. Proxifie les requêtes vers :
  - Backend Julia : http://backend:8080
  - Service FEBio : http://febio:8081

Port exposé : 8000
Docs OpenAPI: http://localhost:8000/docs
"""

from contextlib import asynccontextmanager

import httpx
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import JSONResponse
from slowapi import Limiter, _rate_limit_exceeded_handler
from slowapi.errors import RateLimitExceeded
from slowapi.util import get_remote_address

from app.config import settings
from app.auth.routes import router as auth_router
from app.spine.routes import router as spine_router
from app.simulation.routes import router as simulation_router
from app.payment.routes import router as payment_router


# ── Rate limiter ─────────────────────────────────────────────
limiter = Limiter(key_func=get_remote_address)


# ── Lifespan (connexions partagées) ─────────────────────────
@asynccontextmanager
async def lifespan(app: FastAPI):
    # Créer un client HTTP partagé pour proxifier vers le backend Julia
    app.state.http_client = httpx.AsyncClient(
        base_url=settings.julia_backend_url,
        timeout=httpx.Timeout(30.0),
        limits=httpx.Limits(max_connections=50, max_keepalive_connections=20),
    )
    app.state.febio_client = httpx.AsyncClient(
        base_url=settings.febio_url,
        timeout=httpx.Timeout(120.0),  # FEBio peut prendre du temps
    )
    yield
    await app.state.http_client.aclose()
    await app.state.febio_client.aclose()


# ── Création de l'application ────────────────────────────────
app = FastAPI(
    title="VERTEX Gateway",
    description="API Gateway pour le simulateur biomécanique VERTEX©",
    version="0.3.0",
    docs_url="/docs",
    redoc_url="/redoc",
    lifespan=lifespan,
)

# ── Middleware CORS ───────────────────────────────────────────
app.add_middleware(
    CORSMiddleware,
    allow_origins=settings.cors_origins,
    allow_credentials=True,
    allow_methods=["GET", "POST", "PUT", "DELETE", "OPTIONS"],
    allow_headers=["*"],
)

# ── Rate limiting ─────────────────────────────────────────────
app.state.limiter = limiter
app.add_exception_handler(RateLimitExceeded, _rate_limit_exceeded_handler)


# ── Routers ───────────────────────────────────────────────────
app.include_router(auth_router,       prefix="/api/auth",       tags=["Auth"])
app.include_router(spine_router,      prefix="/api/spine",      tags=["Rachis"])
app.include_router(simulation_router, prefix="/api/simulation", tags=["Simulation"])
app.include_router(payment_router,    tags=["Paiement"])


# ── Health check ─────────────────────────────────────────────
@app.get("/health", tags=["System"])
async def health():
    """Vérification de l'état du gateway."""
    return {
        "status": "ok",
        "service": "vertex-gateway",
        "version": "0.3.0",
        "backends": {
            "julia": settings.julia_backend_url,
            "febio": settings.febio_url,
        },
    }


@app.get("/health/backends", tags=["System"])
async def health_backends(request):
    """Vérification de l'état de tous les backends."""
    julia_ok = febio_ok = False
    try:
        r = await request.app.state.http_client.get("/health", timeout=5.0)
        julia_ok = r.status_code == 200
    except Exception:
        pass
    try:
        r = await request.app.state.febio_client.get("/health", timeout=5.0)
        febio_ok = r.status_code == 200
    except Exception:
        pass

    status = "ok" if (julia_ok and febio_ok) else "degraded"
    return JSONResponse(
        content={
            "status": status,
            "julia_backend": "ok" if julia_ok else "unreachable",
            "febio_service": "ok" if febio_ok else "unreachable",
        },
        status_code=200 if status == "ok" else 503,
    )
