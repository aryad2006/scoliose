# ══════════════════════════════════════════════════════════════
# VERTEX© — Service FEBio (solveur FEM tétraédrique)
# Ubuntu 22.04 — compile FEBio 4.x depuis les sources
# ══════════════════════════════════════════════════════════════

FROM ubuntu:22.04 AS febio-builder

# Variables d'environnement pour compilation non-interactive
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/Paris

# ── Dépendances système pour compiler FEBio ──
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    cmake \
    git \
    libmpfr-dev \
    libgmp-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libboost-dev \
    wget \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /build

# ── Cloner FEBio depuis la source officielle ──
RUN git clone --depth 1 --branch v4.4 \
    https://github.com/febiosoftware/FEBio.git \
    FEBio || \
    git clone --depth 1 \
    https://github.com/febiosoftware/FEBio.git \
    FEBio

# ── Compiler FEBio ──
RUN cd FEBio && \
    mkdir -p build && cd build && \
    cmake .. \
        -DCMAKE_BUILD_TYPE=Release \
        -DCMAKE_INSTALL_PREFIX=/usr/local \
        -DUSE_MKL=OFF \
        -DUSE_LEVMAR=OFF && \
    make -j$(nproc) && \
    make install

# ═══════════════════════════════════════════════════════════════
# Image de production — Python FastAPI wrapper
# ═══════════════════════════════════════════════════════════════
FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# ── Runtime FEBio + Python ──
RUN apt-get update && apt-get install -y --no-install-recommends \
    python3.11 \
    python3-pip \
    python3.11-dev \
    libgomp1 \
    && rm -rf /var/lib/apt/lists/*

# Copier le binaire FEBio depuis le builder
COPY --from=febio-builder /usr/local/bin/febio4 /usr/local/bin/febio4
RUN chmod +x /usr/local/bin/febio4

WORKDIR /app

# ── Dépendances Python ──
RUN pip3 install --no-cache-dir \
    fastapi==0.111.0 \
    uvicorn[standard]==0.29.0 \
    pydantic==2.7.1 \
    numpy==1.26.4 \
    scipy==1.13.0 \
    lxml==5.2.1

# ── Code source du service ──
COPY . .

# Créer le répertoire de travail FEBio (fichiers .feb temporaires)
RUN mkdir -p /tmp/febio_workspace && chmod 777 /tmp/febio_workspace

# Port FastAPI
EXPOSE 8081

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=15s --retries=3 \
    CMD python3 -c "import urllib.request; urllib.request.urlopen('http://localhost:8081/health')"

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8081"]
