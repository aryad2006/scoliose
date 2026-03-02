# VERTEX© Backend — Julia 1.10
FROM julia:1.10-bookworm

WORKDIR /app

# Copier le projet et le code source
COPY Project.toml .
COPY src/ ./src/
COPY test/ ./test/

# Installer les dépendances et précompiler
RUN julia --project=. -e 'using Pkg; Pkg.instantiate(); Pkg.precompile()'

# Port exposé
EXPOSE 8080

# Commande de démarrage
CMD ["julia", "--project=.", "-e", "using Vertex; Vertex.start_server(port=8080)"]
