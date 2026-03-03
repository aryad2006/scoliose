# ══════════════════════════════════════════════════════════════
# VERTEX© — Gateway FastAPI
# Python 3.12-slim — multi-stage build
# ══════════════════════════════════════════════════════════════

FROM python:3.12-slim AS builder

WORKDIR /build

# Dépendances système
RUN apt-get update && apt-get install -y --no-install-recommends \
    gcc \
    && rm -rf /var/lib/apt/lists/*

# Installer les dépendances Python
COPY requirements.txt .
RUN pip install --no-cache-dir --prefix=/install -r requirements.txt

# ── Image de production ──
FROM python:3.12-slim

WORKDIR /app

# Copier les packages installés
COPY --from=builder /install /usr/local

# Copier le code source
COPY . .

# Port exposé
EXPOSE 8000

# Variables d'environnement par défaut
ENV GATEWAY_PORT=8000
ENV JULIA_BACKEND_URL=http://backend:8080
ENV FEBIO_URL=http://febio:8081
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=20s --retries=3 \
    CMD python -c "import urllib.request; urllib.request.urlopen('http://localhost:8000/health')"

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000", "--workers", "2"]
