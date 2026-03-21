# CLAUDE.md — VERTEX© Plateforme Formations Medicales

## Projet

VERTEX© (Virtual Environment for Real-Time EXpertise) — Plateforme de formations medicales e-learning multi-specialites (orthopedie, endocrinologie, medecine interne, AMP), avec simulateur biomecanique 3D.

## Stack technique

### Simulateur VERTEX (spinesim/)
- **Backend** : Julia 1.10 — moteur biomecanique, FEM poutre Euler-Bernoulli 3D, API REST (HTTP.jl)
- **Frontend** : Vue.js 3 + Three.js 0.162 + Pinia + Vite 5 — interface 3D WebGL
- **Gateway** : Python 3 / FastAPI 0.111 + uvicorn — auth JWT, paiement Stripe, proxy API
- **FEBio** : Solveur FEM tetaedrique (service Docker)
- **BDD** : PostgreSQL 17 (asyncpg cote gateway, LibPQ.jl cote Julia)
- **Infra** : Docker Compose, Nginx (reverse proxy prod)
- **Monitoring** : Prometheus + Grafana + Alertmanager
- **Tests frontend** : Vitest (unit) + Playwright (e2e)
- **Tests backend** : Julia test/ (runtests.jl)

### LMS Moodle (moodle-local/)
- Moodle PHP 8.3 + PostgreSQL 17 (Docker)
- Port : 8890, admin: admin / ScolioseLMS2026

## Architecture

```
/                              # Racine projet
├── CLAUDE.md                  # Ce fichier
├── REGLES_ECRITURE_CONTENU.md # Charte editoriale des formations
├── NOTE_REPRISE_11_MARS_2026.md # Etat d'avancement
├── cours-scoliose/            # 19 modules MD + cas cliniques (formation principale)
├── cours-ptg/                 # CDC Prothese Totale Genou (8 parties)
├── cours-infection-osseuse/   # CDC Infections Osteo-Articulaires (10 parties)
├── cours-tendinites/          # CDC Tendinites (9 parties + complet)
├── cours-obesite-orthopedie/  # CDC Obesite et Orthopedie (9 parties + complet)
├── a-venir/                   # Planning formations futures
├── docs/                      # Rapports techniques simulation
├── docs-IOA/                  # Documentation IOA
├── docs-ptg/                  # Documentation PTG
├── moodle-local/              # Instance Moodle Docker pour tests
└── spinesim/                  # Simulateur VERTEX
    ├── backend/src/           # Julia : models/ fem/ pathology/ surgery/ api/ auth/ db/
    ├── frontend/src/          # Vue.js : engine/ components/ stores/ views/
    ├── gateway/app/           # FastAPI : auth/ payment/ simulation/ spine/
    ├── febio/                 # Service FEBio (meshes tetraedriques)
    ├── monitoring/            # Prometheus, Grafana, Alertmanager
    ├── docker-compose.yml     # Dev
    ├── deploy/                # docker-compose.prod.yml + .env.production
    └── Makefile               # Commandes dev/test/deploy
```

## Commandes utiles (depuis spinesim/)

```bash
make dev              # Demarrer environnement dev complet
make stop             # Arreter les services
make test             # Tests unitaires Julia + build frontend
make test-unit        # Tests Julia uniquement
make test-frontend    # Build frontend (Vitest)
make db-init          # Initialiser la BDD
make db-reset         # Reset BDD (supprime les donnees)
make build            # Build images Docker
make deploy           # Build + deploy
make lint             # JuliaFormatter sur backend
make health           # Verifier sante des services
make julia-repl       # REPL Julia avec le projet charge
```

### Frontend (depuis spinesim/frontend/)
```bash
npm run dev           # Serveur dev Vite (port 5173)
npm run build         # Build production
npm run test          # Tests Vitest
npm run test:e2e      # Tests Playwright
```

## Conventions de code

### Contenu pedagogique (fichiers MD cours-*)
- Suivre REGLES_ECRITURE_CONTENU.md (charte editoriale stricte)
- Tags media inline : `> [MEDIA: icon MXX-SYY-ZZZ -- Description]`
- Fichiers nommes : `CDC_<PREFIX>_<NUM>_<TITRE>.md` ou `MODULE_<NUM>_<TITRE>.md`
- Cas cliniques : 4 niveaux (Bronze/Argent/Or/Diamant), 15-24 cas par formation
- Fichiers > 500 lignes : creer en parties successives
- Anti-plagiat : attributions bibliographiques obligatoires

### Code Julia (backend)
- Formatter : JuliaFormatter
- Modules : un fichier par concept (disc.jl, vertebra.jl, scoliosis.jl...)
- Structs mutables pour les modeles biomecaniques

### Code Vue.js (frontend)
- Composition API (Vue 3)
- Stores Pinia pour l'etat global
- Three.js via SpineRenderer.js et ScrewPlacer.js

### Git
- Messages de commit en francais, prefixes : feat:, fix:, docs:
- Branche principale : main

## Regles

- Langue : francais pour tout le contenu et les commits
- Reponses concises et factuelles
- Ne jamais creer de fichier MD sans respecter REGLES_ECRITURE_CONTENU.md
- Toujours verifier la coherence avec les modules existants avant d'ajouter du contenu
- Les classifications medicales doivent etre exactes et referenceees (Lenke, AO/Magerl, Meyerding, etc.)
