"""
VERTEX Gateway — Configuration centralisée (pydantic-settings).
Variables chargées depuis l'environnement ou le fichier .env.
"""

from functools import lru_cache
from typing import List

from pydantic_settings import BaseSettings, SettingsConfigDict


class Settings(BaseSettings):
    model_config = SettingsConfigDict(
        env_file=".env",
        env_file_encoding="utf-8",
        case_sensitive=False,
        extra="ignore",
    )

    # ── Service ─────────────────────────────────────────────
    gateway_port: int = 8000
    environment: str = "development"  # development | production

    # ── Backends ────────────────────────────────────────────
    julia_backend_url: str = "http://backend:8080"
    febio_url: str = "http://febio:8081"

    # ── Authentification JWT ─────────────────────────────────
    jwt_secret: str = "CHANGE_ME_IN_PRODUCTION_USE_A_256_BIT_KEY"
    jwt_algorithm: str = "HS256"
    jwt_access_token_expire_minutes: int = 30
    jwt_refresh_token_expire_days: int = 7

    # ── CORS ────────────────────────────────────────────────
    cors_origins: List[str] = [
        "http://localhost:5173",   # Frontend Vite dev
        "http://localhost:3000",   # Moodle (dev)
        "http://localhost:8080",   # Direct backend (dev)
    ]

    # ── Base de données (optionnel — si gateway a sa propre DB) ──
    db_host: str = "db"
    db_port: int = 5432
    db_name: str = "vertex"
    db_user: str = "vertex"
    db_password: str = "vertex"

    # ── Rate limiting ────────────────────────────────────────
    rate_limit_default: str = "100/minute"
    rate_limit_auth: str = "10/minute"
    rate_limit_solve: str = "20/minute"

    # ── Stripe ───────────────────────────────────────────────
    stripe_secret_key:     str = ""   # sk_live_... ou sk_test_...
    stripe_webhook_secret: str = ""   # whsec_...
    stripe_publishable_key:str = ""   # pk_live_... (exposé au frontend)

    @property
    def database_url(self) -> str:
        return (
            f"postgresql://{self.db_user}:{self.db_password}"
            f"@{self.db_host}:{self.db_port}/{self.db_name}"
        )


@lru_cache(maxsize=1)
def get_settings() -> Settings:
    return Settings()


# Instance globale
settings = get_settings()
