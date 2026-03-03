# ══════════════════════════════════════════════════════════════
# VERTEX© — Makefile
# Commandes de développement et de déploiement
# ══════════════════════════════════════════════════════════════

.PHONY: help dev build test test-unit test-api test-watch
.PHONY: db-init db-reset lint clean deploy logs

# Couleurs
BOLD := \033[1m
GREEN := \033[32m
BLUE  := \033[34m
RESET := \033[0m

# Variables
COMPOSE      := docker compose
JULIA        := julia --project=backend
NODE_BIN     := frontend/node_modules/.bin

help: ## Affiche cette aide
	@echo ""
	@echo "$(BOLD)VERTEX© — Commandes disponibles :$(RESET)"
	@echo ""
	@awk 'BEGIN {FS = ":.*##"} /^[a-zA-Z_-]+:.*##/ { printf "  $(BLUE)%-18s$(RESET) %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
	@echo ""

# ── Développement ─────────────────────────────────────────────

dev: ## Démarrer l'environnement de développement complet
	@echo "$(GREEN)Démarrage de VERTEX© en mode développement...$(RESET)"
	$(COMPOSE) up --build -d db
	@echo "Attente de PostgreSQL..."
	@sleep 3
	$(COMPOSE) up --build backend frontend
	
dev-bg: ## Démarrer en arrière-plan
	$(COMPOSE) up --build -d
	@echo "$(GREEN)VERTEX© démarré en arrière-plan$(RESET)"
	@echo "  Backend  : http://localhost:8080"
	@echo "  Frontend : http://localhost:3001"

stop: ## Arrêter tous les services
	$(COMPOSE) down

restart: ## Redémarrer tous les services
	$(COMPOSE) restart

logs: ## Afficher les logs en temps réel
	$(COMPOSE) logs -f

logs-backend: ## Afficher les logs du backend uniquement
	$(COMPOSE) logs -f backend

# ── Tests ─────────────────────────────────────────────────────

test-unit: ## Lancer les tests unitaires Julia
	@echo "$(GREEN)Tests unitaires Julia...$(RESET)"
	cd backend && $(JULIA) --threads=auto test/runtests.jl

test-jwt: ## Lancer les tests JWT uniquement
	cd backend && $(JULIA) test/test_jwt.jl

test-api: ## Lancer les tests d'intégration API (serveur requis)
	@echo "$(GREEN)Tests d'intégration API...$(RESET)"
	cd backend && RUN_API_TESTS=true $(JULIA) test/test_api.jl

test-frontend: ## Tests et build du frontend
	cd frontend && npm run build

test: test-unit test-frontend ## Lancer tous les tests

test-ci: ## Lancer les tests dans un environnement Docker isolé
	$(COMPOSE) -f docker-compose.yml -f docker-compose.test.yml up \
		--build --abort-on-container-exit --exit-code-from test-runner

# ── Base de données ───────────────────────────────────────────

db-init: ## Initialiser la base de données
	$(COMPOSE) exec db psql -U vertex -d vertex -f /docker-entrypoint-initdb.d/01_init.sql
	$(COMPOSE) exec db psql -U vertex -d vertex -f /docker-entrypoint-initdb.d/02_users.sql

db-reset: ## Réinitialiser la base de données (⚠️ supprime toutes les données)
	@echo "⚠️  Suppression de toutes les données..."
	$(COMPOSE) down -v
	$(COMPOSE) up -d db
	@sleep 3
	@echo "$(GREEN)Base de données réinitialisée$(RESET)"

db-shell: ## Ouvrir un shell PostgreSQL interactif
	$(COMPOSE) exec db psql -U vertex -d vertex

db-stats: ## Afficher les statistiques de la base de données
	$(COMPOSE) exec db psql -U vertex -d vertex -c "SELECT * FROM v_simulation_stats;"

db-backup: ## Sauvegarder la base de données
	@mkdir -p backups
	$(COMPOSE) exec db pg_dump -U vertex vertex | gzip > backups/vertex_$(shell date +%Y%m%d_%H%M%S).sql.gz
	@echo "$(GREEN)Sauvegarde créée dans backups/$(RESET)"

# ── Build et déploiement ──────────────────────────────────────

build: ## Construire les images Docker
	$(COMPOSE) build --no-cache

build-backend: ## Reconstruire uniquement le backend
	$(COMPOSE) build --no-cache backend

build-frontend: ## Reconstruire uniquement le frontend
	$(COMPOSE) build --no-cache frontend

build-prod: ## Construire les images de production
	$(COMPOSE) -f docker-compose.prod.yml build --no-cache

deploy: build ## Construire et déployer
	$(COMPOSE) up -d --force-recreate
	@echo "$(GREEN)Déploiement terminé$(RESET)"

# ── Julia / Packages ──────────────────────────────────────────

julia-install: ## Installer les dépendances Julia
	cd backend && $(JULIA) -e 'using Pkg; Pkg.instantiate()'

julia-update: ## Mettre à jour les dépendances Julia
	cd backend && $(JULIA) -e 'using Pkg; Pkg.update()'

julia-precompile: ## Précompiler pour accélérer le démarrage
	cd backend && $(JULIA) --threads=auto -e \
		'using Pkg; Pkg.instantiate(); include("src/Vertex.jl")'

# ── Node.js / npm ─────────────────────────────────────────────

npm-install: ## Installer les dépendances Node
	cd frontend && npm install

npm-update: ## Mettre à jour les dépendances Node
	cd frontend && npm update

npm-audit: ## Analyser les vulnérabilités npm
	cd frontend && npm audit

# ── Qualité du code ───────────────────────────────────────────

lint: ## Vérifier la qualité du code Julia (JuliaFormatter)
	cd backend && $(JULIA) -e 'using JuliaFormatter; format("src/")'

lint-check: ## Vérifier sans modifier
	cd backend && $(JULIA) -e \
		'using JuliaFormatter; any(!format("src/"; overwrite=false)) && exit(1)'

# ── Nettoyage ─────────────────────────────────────────────────

clean: ## Supprimer les fichiers temporaires
	cd frontend && rm -rf dist node_modules/.vite
	cd backend  && rm -rf compiled/

clean-all: clean ## Tout nettoyer (incluant node_modules)
	cd frontend && rm -rf node_modules
	$(COMPOSE) down --rmi local -v --remove-orphans

# ── Monitoring ────────────────────────────────────────────────

health: ## Vérifier l'état de tous les services
	@echo "$(BOLD)État des services VERTEX© :$(RESET)"
	@curl -sf http://localhost:8080/api/health | python3 -m json.tool || echo "Backend : ❌"
	@curl -sf http://localhost:3001 > /dev/null && echo "Frontend : ✅" || echo "Frontend : ❌"

status: ## Afficher l'état des conteneurs Docker
	$(COMPOSE) ps

# ── Utilitaires ───────────────────────────────────────────────

shell-backend: ## Ouvrir un shell dans le conteneur backend
	$(COMPOSE) exec backend /bin/bash

shell-frontend: ## Ouvrir un shell dans le conteneur frontend
	$(COMPOSE) exec frontend /bin/sh

julia-repl: ## Démarrer un REPL Julia avec le projet chargé
	cd backend && julia --project=. --threads=auto
