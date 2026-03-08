# PLAN DE DÉVELOPPEMENT — VERTEX©
## Instructions pour Claude Sonnet 4.1

**Objectif** : Ce document est un plan de développement opérationnel, prêt à être confié à un agent Claude Sonnet 4.1 pour exécution. Chaque tâche est spécifiée avec le contexte, les fichiers à modifier/créer, les dépendances, et les critères de validation.

**Workspace** : `c:\Users\USER\Documents\scoliose\`

---

# CONTEXTE DU PROJET

## Ce qu'est VERTEX©

VERTEX© (Virtual Environment for Rachis Training and EXploration) est un simulateur biomécanique du rachis (colonne vertébrale) composé de :

1. **Backend Julia** (`spinesim/backend/`) : API REST + solveur FEM (éléments finis) + simulation longitudinale de la scoliose
2. **Frontend Vue.js 3 + Three.js** (`spinesim/frontend/`) : interface web avec rendu 3D interactif
3. **Docker Compose** (`spinesim/docker-compose.yml`) : orchestration backend + frontend
4. **Moodle LMS** (`moodle-local/`) : plateforme e-learning (séparé)
5. **Documentation** (racine) : 14+ fichiers markdown de spécifications

## État actuel du code

### Backend Julia (fonctionnel, ~4 000 lignes)
- `Vertex.jl` : module principal, inclut tous les sous-modules
- `api/server.jl` (854 lignes) : serveur HTTP.jl, 16+ endpoints REST, CORS
- `models/` : types.jl, vertebra.jl, disc.jl, ligament.jl, spine.jl — modèle anatomique C3-S1
- `fem/` : mesh.jl, solver.jl, stiffness.jl — FEM Euler-Bernoulli poutre 3D (23 nœuds, 138 DOF)
- `longitudinal/` : simulation.jl, types.jl, asymmetry.jl, fatigue.jl, remodeling.jl — simulation ressort spiral (VALIDÉE)
- `pathology/` : 7 pathologies (scoliosis, fracture, hernia, spondylolisthesis, stenosis, tumor, adult_deformity)
- `surgery/` : screw.jl, rod.jl, evaluation.jl
- `test/runtests.jl` : 339 lignes, 9 testsets

### Frontend Vue.js (squelette, ~1 500 lignes)
- `App.vue` (408 lignes) : layout 3 colonnes
- `engine/SpineRenderer.js` (497 lignes) : rendu Three.js (cylindres/cônes)
- `stores/spineStore.js` (179 lignes) : Pinia store avec toutes les actions API
- `components/` : PatientPanel, ScoliosisPanel, SurgeryPanel, ResultsPanel, LongitudinalPanel, SpineViewport
- `vite.config.js` : proxy `/api` vers backend

### Problèmes connus à corriger
1. `VITE_API_URL=http://backend:8080` dans Docker → inaccessible depuis le navigateur (doit utiliser le proxy Vite)
2. `ACTIVE_MODELS` = Dict en mémoire, pas thread-safe
3. FEM fallback silencieux quand solve échoue
4. Pas de transformation locale→globale pour éléments poutre inclinés dans stiffness.jl
5. Pas de `.gitignore`
6. Pas de tests frontend
7. Pas d'authentification API
8. Pas de base de données (tout en mémoire)

---

# PLAN DE DÉVELOPPEMENT — 15 SPRINTS

Les sprints sont ordonnés par dépendance. Chaque sprint dure 1-2 semaines.
**Convention** : ✅ = fichier existant à modifier | 🆕 = fichier à créer

---

## SPRINT 0 — Fondations et qualité de code (Semaine 1)

### Objectif
Mettre en place les bases propres : .gitignore, linting, CI, corrections critiques.

### Tâches

#### T0.1 — Créer .gitignore
🆕 `spinesim/.gitignore`
```gitignore
# Julia
*.jl.cov
*.jl.*.cov
*.jl.mem
Manifest.toml

# Node.js
node_modules/
dist/
.vite/

# Environment
.env
.env.local
.env.*.local

# IDE
.vscode/
.idea/
*.swp
*.swo

# Docker
*.log

# OS
.DS_Store
Thumbs.db
```

#### T0.2 — Corriger le problème VITE_API_URL
✅ `spinesim/docker-compose.yml`

Le frontend en Docker ne doit PAS utiliser `http://backend:8080` comme `VITE_API_URL` car le code s'exécute dans le navigateur de l'utilisateur, pas dans Docker. Le proxy Vite dans `vite.config.js` fait déjà le travail.

**Action** : Supprimer la variable `VITE_API_URL` du service frontend dans docker-compose.yml. Le proxy Vite redirige déjà `/api` vers `http://localhost:8080`.

Pour la production (sans Vite dev server), ajouter nginx comme reverse proxy :

🆕 `spinesim/nginx.conf`
```nginx
server {
    listen 80;
    server_name localhost;

    # Frontend SPA
    location / {
        root /usr/share/nginx/html;
        index index.html;
        try_files $uri $uri/ /index.html;
    }

    # API proxy vers le backend Julia
    location /api/ {
        proxy_pass http://backend:8080;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_read_timeout 120s;
    }
}
```

Décommenter le service nginx dans docker-compose.yml et créer un Dockerfile de production pour le frontend :

🆕 `spinesim/frontend/Dockerfile.prod`
```dockerfile
FROM node:20-alpine AS builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM nginx:alpine
COPY --from=builder /app/dist /usr/share/nginx/html
COPY ../nginx.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
```

#### T0.3 — Ajouter thread-safety au stockage des modèles
✅ `spinesim/backend/src/api/server.jl`

**Ligne ~12**, remplacer :
```julia
const ACTIVE_MODELS = Dict{UUID, SpineModel}()
```
Par :
```julia
const ACTIVE_MODELS = Dict{UUID, SpineModel}()
const MODELS_LOCK = ReentrantLock()

# Helper functions for thread-safe access
function get_model(id::UUID)::Union{SpineModel, Nothing}
    lock(MODELS_LOCK) do
        get(ACTIVE_MODELS, id, nothing)
    end
end

function set_model!(id::UUID, model::SpineModel)
    lock(MODELS_LOCK) do
        ACTIVE_MODELS[id] = model
    end
end

function delete_model!(id::UUID)
    lock(MODELS_LOCK) do
        delete!(ACTIVE_MODELS, id)
    end
end
```

Puis remplacer tous les accès directs `ACTIVE_MODELS[id]` par `get_model(id)` et `ACTIVE_MODELS[id] = model` par `set_model!(id, model)` dans toutes les fonctions handler.

#### T0.4 — Améliorer le logging
✅ `spinesim/backend/src/api/server.jl`

Ajouter en tête du fichier, après les `using` :
```julia
using Logging

# Structured logging
function log_request(method::String, path::String, status::Int, duration_ms::Float64)
    @info "HTTP" method=method path=path status=status duration_ms=round(duration_ms, digits=2)
end
```

Puis wrapper chaque handler avec un timing :
```julia
function handle_create_spine(req::HTTP.Request)
    t0 = time()
    try
        # ... existing code ...
        resp = json_response(result)
        log_request("POST", "/api/spine/create", 200, (time()-t0)*1000)
        return resp
    catch e
        log_request("POST", "/api/spine/create", 500, (time()-t0)*1000)
        @error "handle_create_spine failed" exception=(e, catch_backtrace())
        return error_response(string(e), 500)
    end
end
```

#### T0.5 — Rendre le FEM fallback explicite
✅ `spinesim/backend/src/longitudinal/simulation.jl`

Dans la boucle de simulation, là où il y a un `try/catch` sur `solve_spine!`, remplacer le `catch` silencieux par :
```julia
catch e
    fem_ok = false
    @warn "FEM solve failed at month $month" exception=(e, catch_backtrace())
    push!(warnings, "FEM échec mois $month: $(sprint(showerror, e))")
end
```

Et ajouter le champ `warnings::Vector{String}` au `LongitudinalResult`.

### Critères de validation Sprint 0
- [ ] `.gitignore` présent
- [ ] `docker-compose up` fonctionne sans erreur de proxy
- [ ] Les accès `ACTIVE_MODELS` sont protégés par un lock
- [ ] Les logs serveur affichent method/path/status/duration
- [ ] Les warnings FEM sont remontés dans les résultats de simulation

---

## SPRINT 1 — Base de données PostgreSQL (Semaine 2)

### Objectif
Remplacer le `Dict` en mémoire par PostgreSQL pour la persistance des modèles.

### Tâches

#### T1.1 — Ajouter PostgreSQL au Docker Compose
✅ `spinesim/docker-compose.yml`

Ajouter un service :
```yaml
  db:
    image: postgres:17-alpine
    container_name: vertex-db
    ports:
      - "5432:5432"
    environment:
      POSTGRES_DB: vertex
      POSTGRES_USER: vertex
      POSTGRES_PASSWORD: ${DB_PASSWORD:-vertex_dev_2026}
    volumes:
      - vertex-pgdata:/var/lib/postgresql/data
      - ./backend/sql/init.sql:/docker-entrypoint-initdb.d/init.sql

volumes:
  vertex-pgdata:
```

#### T1.2 — Schéma SQL initial
🆕 `spinesim/backend/sql/init.sql`
```sql
-- VERTEX© — Schéma de base de données

CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- Table des modèles de rachis
CREATE TABLE spine_models (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    patient_data JSONB NOT NULL,
    model_data JSONB NOT NULL,
    created_at TIMESTAMPTZ DEFAULT NOW(),
    updated_at TIMESTAMPTZ DEFAULT NOW(),
    session_id UUID,
    is_active BOOLEAN DEFAULT TRUE
);

-- Table des résultats de simulation longitudinale
CREATE TABLE longitudinal_results (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    params JSONB NOT NULL,
    result JSONB NOT NULL,
    duration_years REAL,
    final_cobb_deg REAL,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Table des sessions de chirurgie
CREATE TABLE surgery_sessions (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    spine_id UUID REFERENCES spine_models(id),
    screws JSONB DEFAULT '[]',
    rods JSONB DEFAULT '[]',
    corrections JSONB DEFAULT '[]',
    evaluation JSONB,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Index
CREATE INDEX idx_spine_models_active ON spine_models(is_active) WHERE is_active;
CREATE INDEX idx_spine_models_created ON spine_models(created_at DESC);
CREATE INDEX idx_longitudinal_results_cobb ON longitudinal_results(final_cobb_deg);
```

#### T1.3 — Client PostgreSQL en Julia
🆕 `spinesim/backend/src/db/database.jl`

Utiliser `LibPQ.jl` pour se connecter à PostgreSQL :
```julia
using LibPQ
using JSON3

const DB_CONN = Ref{LibPQ.Connection}()

function init_db(;
    host = get(ENV, "DB_HOST", "localhost"),
    port = parse(Int, get(ENV, "DB_PORT", "5432")),
    dbname = get(ENV, "DB_NAME", "vertex"),
    user = get(ENV, "DB_USER", "vertex"),
    password = get(ENV, "DB_PASSWORD", "vertex_dev_2026")
)
    connstr = "host=$host port=$port dbname=$dbname user=$user password=$password"
    DB_CONN[] = LibPQ.Connection(connstr)
    @info "Connected to PostgreSQL" host=host dbname=dbname
end

function save_spine_model(id::UUID, patient_data, model::SpineModel)
    query = """
        INSERT INTO spine_models (id, patient_data, model_data)
        VALUES (\$1, \$2, \$3)
        ON CONFLICT (id) DO UPDATE SET
            model_data = EXCLUDED.model_data,
            updated_at = NOW()
    """
    execute(DB_CONN[], query, [string(id), JSON3.write(patient_data), JSON3.write(to_json(model))])
end

function load_spine_model(id::UUID)::Union{SpineModel, Nothing}
    query = "SELECT model_data FROM spine_models WHERE id = \$1 AND is_active"
    result = execute(DB_CONN[], query, [string(id)])
    isempty(result) && return nothing
    data = JSON3.read(result[1, 1])
    return reconstruct_spine_model(data)  # À implémenter
end

function save_longitudinal_result(params, result)
    query = """
        INSERT INTO longitudinal_results (params, result, duration_years, final_cobb_deg)
        VALUES (\$1, \$2, \$3, \$4)
    """
    execute(DB_CONN[], query, [
        JSON3.write(params),
        JSON3.write(result),
        result.duration_years,
        result.final_cobb_deg
    ])
end
```

Ajouter `LibPQ` au `Project.toml` :
✅ `spinesim/backend/Project.toml` — ajouter `LibPQ = "194296ae-..."` dans `[deps]`

#### T1.4 — Modifier server.jl pour utiliser la DB
✅ `spinesim/backend/src/api/server.jl`

Dans `start_server()`, ajouter avant le `HTTP.serve` :
```julia
# Initialiser la connexion DB
init_db()
```

Dans `handle_create_spine`, après la création du modèle, ajouter :
```julia
save_spine_model(id, patient_params, model)
```

Dans les handlers qui récupèrent un modèle, essayer d'abord le cache mémoire, puis la DB :
```julia
model = get_model(id)
if model === nothing
    model = load_spine_model(id)
    model === nothing && return error_response("Model not found", 404)
    set_model!(id, model)  # Remettre en cache
end
```

### Critères de validation Sprint 1
- [ ] `docker-compose up` démarre PostgreSQL, les tables sont créées
- [ ] POST `/api/spine/create` persiste le modèle en DB
- [ ] Redémarrer le backend → les modèles sont récupérés depuis la DB
- [ ] `docker-compose down && docker-compose up` → les données survivent (volume persistant)

---

## SPRINT 2 — Authentification et sécurité API (Semaine 3)

### Objectif
Ajouter JWT auth, rate limiting, et CORS restrictif.

### Tâches

#### T2.1 — Middleware d'authentification JWT
🆕 `spinesim/backend/src/api/auth.jl`

```julia
using SHA
using Base64

const JWT_SECRET = get(ENV, "JWT_SECRET", "vertex-dev-secret-change-in-production")
const API_KEYS = Dict{String, Dict{String, Any}}()  # Clés API pour les intégrations

struct JWTPayload
    sub::String      # user ID
    role::String     # "admin", "instructor", "student"
    exp::Int64       # expiration timestamp
    iat::Int64       # issued at
end

function generate_jwt(user_id::String, role::String; ttl_hours::Int=24)::String
    header = base64encode(JSON3.write((alg="HS256", typ="JWT")))
    payload_data = JWTPayload(user_id, role, Int64(time()) + ttl_hours*3600, Int64(time()))
    payload = base64encode(JSON3.write(payload_data))
    signature = base64encode(hmac_sha256(JWT_SECRET, "$header.$payload"))
    return "$header.$payload.$signature"
end

function verify_jwt(token::String)::Union{JWTPayload, Nothing}
    parts = split(token, ".")
    length(parts) != 3 && return nothing
    
    expected_sig = base64encode(hmac_sha256(JWT_SECRET, "$(parts[1]).$(parts[2])"))
    expected_sig != parts[3] && return nothing
    
    payload = JSON3.read(base64decode(String(parts[2])), JWTPayload)
    payload.exp < Int64(time()) && return nothing  # Expiré
    
    return payload
end

function auth_middleware(handler)
    return function(req::HTTP.Request)
        path = HTTP.URI(req.target).path
        
        # Routes publiques (pas d'auth)
        path in ["/api/health", "/api/info"] && return handler(req)
        startswith(path, "/api/auth/") && return handler(req)
        
        # Vérifier le token
        auth_header = HTTP.header(req, "Authorization", "")
        if !startswith(auth_header, "Bearer ")
            return error_response("Missing or invalid Authorization header", 401)
        end
        
        token = auth_header[8:end]
        payload = verify_jwt(token)
        if payload === nothing
            return error_response("Invalid or expired token", 401)
        end
        
        # Ajouter le payload au context de la requête
        req.context[:user] = payload
        return handler(req)
    end
end
```

#### T2.2 — Routes d'authentification
Ajouter dans `server.jl` :
```julia
HTTP.register!(router, "POST", "/api/auth/login", handle_login)
HTTP.register!(router, "POST", "/api/auth/register", handle_register)
```

Handlers :
```julia
function handle_login(req::HTTP.Request)
    body = JSON3.read(IOBuffer(HTTP.payload(req)))
    email = body.email
    password = body.password
    
    # Vérifier en DB (table users à ajouter)
    user = find_user_by_email(email)
    user === nothing && return error_response("Invalid credentials", 401)
    
    if !verify_password(password, user.password_hash)
        return error_response("Invalid credentials", 401)
    end
    
    token = generate_jwt(string(user.id), user.role)
    return json_response((token=token, user=(id=user.id, email=user.email, role=user.role)))
end
```

#### T2.3 — Rate limiting simple
🆕 `spinesim/backend/src/api/ratelimit.jl`

```julia
const RATE_LIMITS = Dict{String, Vector{Float64}}()  # IP → timestamps
const RATE_LIMIT_WINDOW = 60.0  # 60 secondes
const RATE_LIMIT_MAX = 30       # 30 requêtes par minute

function rate_limit_check(ip::String)::Bool
    now = time()
    timestamps = get!(RATE_LIMITS, ip, Float64[])
    
    # Nettoyer les anciennes entrées
    filter!(t -> now - t < RATE_LIMIT_WINDOW, timestamps)
    
    if length(timestamps) >= RATE_LIMIT_MAX
        return false
    end
    
    push!(timestamps, now)
    return true
end
```

#### T2.4 — Restreindre CORS
✅ `spinesim/backend/src/api/server.jl`

Remplacer `"Access-Control-Allow-Origin" => "*"` par :
```julia
const ALLOWED_ORIGINS = Set([
    "http://localhost:3000",
    "http://localhost:3001",
    get(ENV, "FRONTEND_URL", "http://localhost:3000"),
])

function add_cors_headers!(response::HTTP.Response, origin::String="")
    allowed = origin in ALLOWED_ORIGINS ? origin : first(ALLOWED_ORIGINS)
    HTTP.setheader(response, "Access-Control-Allow-Origin" => allowed)
    HTTP.setheader(response, "Access-Control-Allow-Methods" => "GET, POST, OPTIONS")
    HTTP.setheader(response, "Access-Control-Allow-Headers" => "Content-Type, Authorization")
    HTTP.setheader(response, "Access-Control-Allow-Credentials" => "true")
    return response
end
```

### Critères de validation Sprint 2
- [ ] `POST /api/auth/login` retourne un JWT valide
- [ ] Les endpoints protégés retournent 401 sans token
- [ ] Les endpoints protégés fonctionnent avec un token Bearer valide
- [ ] Plus de 30 requêtes/minute depuis la même IP → 429 Too Many Requests
- [ ] CORS rejette les origines non autorisées

---

## SPRINT 3 — Amélioration du FEM (Semaine 4)

### Objectif
Corriger les bugs FEM critiques et améliorer la fidélité du solveur.

### Tâches

#### T3.1 — Transformation locale → globale dans stiffness.jl
✅ `spinesim/backend/src/fem/stiffness.jl`

**Problème** : La matrice de rigidité est assemblée en coordonnées locales sans rotation dans le repère global. Pour les courbures physiologiques (cyphose thoracique, lordose lombaire), c'est faux.

**Action** : Ajouter une fonction de transformation :
```julia
"""
    rotation_matrix_3d(p1::Vec3, p2::Vec3) → SMatrix{12,12}

Matrice de rotation 12×12 pour transformer un élément poutre
de ses coordonnées locales vers le repère global.
L'axe local x est aligné avec le vecteur p1→p2.
"""
function element_rotation_matrix(p1::Vec3, p2::Vec3)::SMatrix{12,12,Float64}
    # Axe local x = direction de l'élément
    dx = p2 - p1
    L = norm(dx)
    ex = dx / L
    
    # Axe local y (arbitraire, perpendiculaire à x)
    # Utiliser le vecteur global Z (vertical) pour croisé initial
    ref = abs(ex[3]) < 0.9 ? Vec3(0, 0, 1) : Vec3(1, 0, 0)
    ey = normalize(cross(ref, ex))
    ez = cross(ex, ey)
    
    # Matrice de rotation 3×3
    R3 = SMatrix{3,3}(
        ex[1], ey[1], ez[1],
        ex[2], ey[2], ez[2],
        ex[3], ey[3], ez[3],
    )
    
    # Étendre à 12×12 (4 blocs diagonaux de 3×3)
    T = zeros(SMatrix{12,12,Float64})
    for i in 0:3
        T = setindex(T, R3, (3i+1:3i+3, 3i+1:3i+3))
    end
    
    return T
end
```

Puis dans `assemble_global_stiffness()`, après le calcul de `Ke_local`, appliquer :
```julia
T = element_rotation_matrix(nodes[n1].position, nodes[n2].position)
Ke_global = T' * Ke_local * T
```

#### T3.2 — Remplacer le CG maison par IterativeSolvers.jl
✅ `spinesim/backend/src/fem/solver.jl`

Ajouter `IterativeSolvers` au `Project.toml`, puis remplacer la fonction `cg_solve` :
```julia
using IterativeSolvers

function fallback_solve(K::SparseMatrixCSC, F::Vector{Float64})
    # Préconditionneur diagonal (Jacobi)
    M = Diagonal(1.0 ./ diag(K))
    U, history = cg(K, F; Pl=M, tol=1e-8, maxiter=2000, log=true)
    @info "CG converged" iterations=history.iters residual=history.data[:resnorm][end]
    return U
end
```

#### T3.3 — Ajouter les tests FEM manquants
✅ `spinesim/backend/test/runtests.jl`

Ajouter un testset dédié :
```julia
@testset "FEM — Stiffness Matrix" begin
    # Test 1 : Matrice de rigidité d'un élément unitaire
    K = beam_stiffness_matrix(1.0, 200e3, 1e-4, 1e-8, 1e-8, 1e-6)
    @test size(K) == (12, 12)
    @test issymmetric(K)
    @test all(diag(K) .> 0)  # Diagonale positive
    
    # Test 2 : Rotation d'un élément vertical
    T = element_rotation_matrix(Vec3(0,0,0), Vec3(0,0,1))
    @test size(T) == (12, 12)
    @test isapprox(T * T', I(12), atol=1e-10)  # Orthogonale
    
    # Test 3 : Rachis droit → déplacement sous gravité principalement vertical
    model = create_normal_spine()
    solve_spine!(model)
    U = model.U
    @test length(U) == 138  # 23 nœuds × 6 DOF
    max_disp = maximum(abs.(U))
    @test max_disp < 50.0  # mm — déplacement raisonnable
end
```

### Critères de validation Sprint 3
- [ ] `element_rotation_matrix` est unitaire (T'T = I)
- [ ] Les résultats de `solve_spine!` changent pour les courbures physiologiques (cyphose/lordose)
- [ ] Le solveur CG converge en <500 itérations avec le préconditionneur
- [ ] Tous les tests FEM passent

---

## SPRINT 4 — Frontend : modèles 3D améliorés (Semaine 5-6)

### Objectif
Remplacer les cylindres/cônes par des géométries vertex améliorées et ajouter les interactions utilisateur.

### Tâches

#### T4.1 — Améliorer la géométrie des vertèbres
✅ `spinesim/frontend/src/engine/SpineRenderer.js`

Remplacer `_createVertebraMesh` par une version utilisant des `ExtrudeGeometry` ou des formes combinées plus réalistes :

```javascript
_createVertebraMesh(v) {
    const group = new THREE.Group()
    const morph = v.morphology
    
    // Corps vertébral — forme réniforme (kidney-shaped) via Shape
    const bodyShape = new THREE.Shape()
    const w = morph.body_width / 2
    const d = morph.body_depth / 2
    
    // Approximation d'un rein via courbe de Bezier
    bodyShape.moveTo(0, -d)
    bodyShape.bezierCurveTo(w * 0.8, -d, w, -d * 0.3, w, 0)
    bodyShape.bezierCurveTo(w, d * 0.3, w * 0.8, d, 0, d * 0.8)
    bodyShape.bezierCurveTo(-w * 0.8, d, -w, d * 0.3, -w, 0)
    bodyShape.bezierCurveTo(-w, -d * 0.3, -w * 0.8, -d, 0, -d)
    
    const extrudeSettings = {
        depth: morph.body_height,
        bevelEnabled: true,
        bevelThickness: 1,
        bevelSize: 0.5,
        bevelSegments: 2,
    }
    
    const bodyGeom = new THREE.ExtrudeGeometry(bodyShape, extrudeSettings)
    bodyGeom.center()
    
    // Matériau PBR (plus réaliste que Phong)
    const bodyMat = new THREE.MeshStandardMaterial({
        color: COLORS.bone,
        roughness: 0.7,
        metalness: 0.1,
        flatShading: false,
    })
    
    const bodyMesh = new THREE.Mesh(bodyGeom, bodyMat)
    bodyMesh.rotation.x = Math.PI / 2
    bodyMesh.castShadow = true
    bodyMesh.receiveShadow = true
    bodyMesh.userData = { type: 'vertebra', level: v.level }
    group.add(bodyMesh)
    
    // ... (pédicules et processus épineux améliorés de la même façon)
    
    group.position.set(v.position[0], v.position[2], v.position[1])
    return group
}
```

#### T4.2 — Panneau de mesures angulaires
🆕 `spinesim/frontend/src/components/MeasurementPanel.vue`

```vue
<template>
  <div class="panel measurement-panel">
    <h3>📐 Mesures</h3>
    
    <div class="measurement-row">
      <label>Angle de Cobb</label>
      <span class="value" :class="cobbClass">{{ measurements.cobb?.toFixed(1) ?? '—' }}°</span>
    </div>
    
    <div class="measurement-row">
      <label>Cyphose thoracique (T4-T12)</label>
      <span class="value">{{ measurements.kyphosis?.toFixed(1) ?? '—' }}°</span>
    </div>
    
    <div class="measurement-row">
      <label>Lordose lombaire (L1-S1)</label>
      <span class="value">{{ measurements.lordosis?.toFixed(1) ?? '—' }}°</span>
    </div>
    
    <div class="measurement-row">
      <label>SVA (Sagittal Vertical Axis)</label>
      <span class="value">{{ measurements.sva?.toFixed(1) ?? '—' }} mm</span>
    </div>
    
    <div class="measurement-row">
      <label>Équilibre coronal</label>
      <span class="value">{{ measurements.coronal_balance?.toFixed(1) ?? '—' }} mm</span>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()

const measurements = computed(() => {
  if (!store.spineData) return {}
  return store.spineData.measurements || {}
})

const cobbClass = computed(() => {
  const cobb = measurements.value.cobb
  if (!cobb) return ''
  if (cobb > 40) return 'severe'
  if (cobb > 25) return 'moderate'
  if (cobb > 10) return 'mild'
  return 'normal'
})
</script>
```

#### T4.3 — Ajouter les contrôles de vue
🆕 `spinesim/frontend/src/components/ViewControls.vue`

Composant avec boutons pour :
- Vue antéropostérieure (AP)
- Vue latérale
- Vue supérieure (axiale)
- Vue 3D libre
- Toggle wireframe / anatomique / stress / radiographic
- Capture d'écran (canvas.toDataURL)
- Plein écran

#### T4.4 — Timeline pour la simulation longitudinale
✅ `spinesim/frontend/src/components/LongitudinalPanel.vue`

Ajouter un slider temporel et un graphique Chart.js ou D3.js montrant l'évolution de l'angle de Cobb dans le temps :

```vue
<div v-if="store.longitudinalResult" class="timeline">
  <label>Temps : {{ currentYear }} ans</label>
  <input type="range" v-model.number="currentYear" 
         :min="0" :max="store.longitudinalResult.duration_years" step="0.5" />
  <canvas ref="cobbChart" height="200"></canvas>
</div>
```

### Critères de validation Sprint 4
- [ ] Les vertèbres ont une forme réniforme (pas de cylindres)
- [ ] Le panneau de mesures affiche Cobb, cyphose, lordose, SVA
- [ ] Les boutons de vue changent l'angle de caméra avec animation
- [ ] La timeline de simulation permet de voir l'évolution temporelle

---

## SPRINT 5 — API Gateway Python FastAPI (Semaine 7-8)

### Objectif
Ajouter une couche FastAPI en Python comme API Gateway, qui orchestre Julia et gère auth/sessions.

### Tâches

#### T5.1 — Structure du projet Python
🆕 Créer l'arborescence suivante :
```
spinesim/gateway/
├── Dockerfile
├── requirements.txt
├── main.py
├── app/
│   ├── __init__.py
│   ├── config.py
│   ├── auth/
│   │   ├── __init__.py
│   │   ├── jwt.py
│   │   ├── models.py
│   │   └── routes.py
│   ├── spine/
│   │   ├── __init__.py
│   │   ├── routes.py
│   │   └── service.py
│   ├── simulation/
│   │   ├── __init__.py
│   │   ├── routes.py
│   │   └── service.py
│   └── db/
│       ├── __init__.py
│       ├── database.py
│       └── models.py
```

#### T5.2 — main.py (point d'entrée FastAPI)
🆕 `spinesim/gateway/main.py`
```python
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from app.auth.routes import router as auth_router
from app.spine.routes import router as spine_router
from app.simulation.routes import router as simulation_router
from app.config import settings

app = FastAPI(
    title="VERTEX© API Gateway",
    version="0.3.0",
    description="API Gateway pour le simulateur biomécanique du rachis VERTEX©",
)

app.add_middleware(
    CORSMiddleware,
    allow_origins=settings.CORS_ORIGINS,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

app.include_router(auth_router, prefix="/api/auth", tags=["Authentication"])
app.include_router(spine_router, prefix="/api/spine", tags=["Spine Models"])
app.include_router(simulation_router, prefix="/api/simulation", tags=["Simulation"])

@app.get("/api/health")
async def health():
    return {"status": "ok", "service": "vertex-gateway", "version": "0.3.0"}
```

#### T5.3 — Proxy vers Julia backend
🆕 `spinesim/gateway/app/spine/service.py`
```python
import httpx
from app.config import settings

JULIA_URL = settings.JULIA_BACKEND_URL  # http://backend:8080

async def proxy_to_julia(method: str, path: str, body: dict = None):
    """Proxy une requête vers le backend Julia."""
    async with httpx.AsyncClient(timeout=120.0) as client:
        url = f"{JULIA_URL}{path}"
        if method == "GET":
            resp = await client.get(url)
        elif method == "POST":
            resp = await client.post(url, json=body)
        return resp.json(), resp.status_code
```

#### T5.4 — Docker Compose mis à jour
✅ `spinesim/docker-compose.yml`

Ajouter le service gateway :
```yaml
  gateway:
    build: ./gateway
    container_name: vertex-gateway
    ports:
      - "8000:8000"
    environment:
      - JULIA_BACKEND_URL=http://backend:8080
      - DATABASE_URL=postgresql://vertex:${DB_PASSWORD:-vertex_dev_2026}@db:5432/vertex
      - JWT_SECRET=${JWT_SECRET:-vertex-dev-secret}
    depends_on:
      - backend
      - db
```

Le frontend pointe maintenant vers le gateway (port 8000) au lieu du backend Julia directement.

### Critères de validation Sprint 5
- [ ] `GET /api/health` sur le gateway répond
- [ ] Les routes `/api/spine/*` sont proxifiées vers Julia
- [ ] L'auth JWT fonctionne via le gateway
- [ ] La doc OpenAPI est accessible à `/docs`

---

## SPRINT 6 — Contenu pédagogique : Modules 2-5 (Semaine 9-12)

### Objectif
Rédiger les modules de formation 2 à 5 en suivant les règles du fichier `REGLES_ECRITURE_CONTENU.md`.

### Tâches

#### T6.1 — Module 2 : Embryologie et croissance du rachis
🆕 `cours/MODULE_02_EMBRYOLOGIE_CROISSANCE.md`

Structure à suivre (identique au Module 1 qui est le modèle) :
- Header avec objectifs Bloom
- Sections numérotées
- Chaque section avec :
  - Texte explicatif
  - `[MEDIA: type — description — identifiant]` pour les médias
  - `[MICRO-EXERCICE]` avec question + réponse
  - `[POINT CLÉ]` en encadré
  - `[CAS CLINIQUE]` avec scénario patient
- Quiz de fin de section (4 niveaux)
- Patient récurrent ("Sophie" ou autre)

**Contenu médical à couvrir** (d'après PLAN_FORMATION_SCOLIOSE.md) :
- Somitogenèse et segmentation vertébrale
- Ossification enchondrale
- Développement des courbes sagittales
- Croissance vertébrale (Hueter-Volkmann)
- Anomalies congénitales (barres, hémivertèbres)

#### T6.2 — Module 3 : Biomécanique du rachis
🆕 `cours/MODULE_03_BIOMECANIQUE.md`
- Unité fonctionnelle rachidienne
- Cinématique segmentaire (Panjabi)
- Rôle des ligaments
- Biomécanique discale
- Introduction à la théorie du ressort spiral

#### T6.3 — Module 4 : Définitions et classifications
🆕 `cours/MODULE_04_DEFINITIONS_CLASSIFICATIONS.md`
- Classification de Lenke (6 types)
- Classification de King
- Risser (maturité squelettique)
- Sanders (main)
- Classification de Raimondi (neuromusculaire)

#### T6.4 — Module 5 : Examen clinique
🆕 `cours/MODULE_05_EXAMEN_CLINIQUE.md`
- Test d'Adams
- Scoliomètre
- Équilibre sagittal et coronal
- Examen neurologique
- Facteurs de progression

### Critères de validation Sprint 6
- [ ] Chaque module fait 800-1000 lignes
- [ ] Au moins 5 médias balisés par module
- [ ] Au moins 3 micro-exercices par module
- [ ] Au moins 1 cas clinique par module
- [ ] Le patient récurrent apparaît dans chaque module
- [ ] Les objectifs de Bloom sont spécifiés

---

## SPRINT 7 — Intégration FEBio (Semaine 13-16)

### Objectif
Intégrer FEBio comme solveur FEM pour la chirurgie virtuelle (maillage tétraédrique).

### Tâches

#### T7.1 — Installer FEBio dans Docker
🆕 `spinesim/febio/Dockerfile`
```dockerfile
FROM ubuntu:22.04

# Installer les dépendances
RUN apt-get update && apt-get install -y \
    cmake g++ git libxml2-dev libz-dev \
    python3 python3-pip python3-venv \
    && rm -rf /var/lib/apt/lists/*

# Cloner et compiler FEBio
RUN git clone https://github.com/febiosoftware/FEBio.git /opt/febio-src \
    && cd /opt/febio-src \
    && mkdir build && cd build \
    && cmake .. -DCMAKE_BUILD_TYPE=Release \
    && make -j$(nproc) \
    && make install

# Installer FEBioPy
RUN pip3 install febio-python numpy scipy

# API wrapper
WORKDIR /app
COPY . .
RUN pip3 install -r requirements.txt

EXPOSE 8081
CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8081"]
```

#### T7.2 — API wrapper FEBio (Python FastAPI)
🆕 `spinesim/febio/main.py`
```python
"""
VERTEX© — FEBio Microservice
Wrapper FastAPI autour de FEBio pour la chirurgie virtuelle.
"""
from fastapi import FastAPI
from pydantic import BaseModel
import subprocess
import json
import tempfile
from pathlib import Path

app = FastAPI(title="VERTEX FEBio Service", version="0.1.0")

class VertebralMesh(BaseModel):
    level: str          # e.g. "L4"
    nodes: list         # [[x,y,z], ...]
    elements: list      # [[n1,n2,n3,n4], ...] tétraèdres
    material: dict      # E, nu, density

class ScrewPlacement(BaseModel):
    level: str
    side: str           # "left" or "right"
    entry_point: list   # [x, y, z]
    trajectory: list    # [dx, dy, dz]
    diameter: float     # mm
    length: float       # mm

@app.post("/solve")
async def solve_fem(mesh: VertebralMesh):
    """Résout un problème FEM avec FEBio."""
    # 1. Générer le fichier .feb (XML FEBio)
    feb_content = generate_feb_file(mesh)
    
    # 2. Écrire dans un fichier temporaire
    with tempfile.NamedTemporaryFile(suffix=".feb", delete=False, mode="w") as f:
        f.write(feb_content)
        feb_path = f.name
    
    # 3. Exécuter FEBio
    result = subprocess.run(
        ["febio4", "-i", feb_path],
        capture_output=True, text=True, timeout=60
    )
    
    # 4. Lire les résultats
    results = parse_febio_results(feb_path.replace(".feb", ".xplt"))
    
    return results

@app.post("/screw-analysis")
async def analyze_screw(screw: ScrewPlacement, mesh: VertebralMesh):
    """Analyse le placement d'une vis pédiculaire avec FEBio."""
    # Modifier le maillage pour inclure la vis
    # Résoudre le contact vis-os
    # Retourner les contraintes et la force d'arrachement
    pass

def generate_feb_file(mesh: VertebralMesh) -> str:
    """Génère un fichier .feb (format XML FEBio) à partir du maillage."""
    # ... génération XML complète ...
    pass
```

#### T7.3 — Maillages vertébraux de référence
🆕 `spinesim/febio/meshes/` — Dossier contenant des maillages tétraédriques de référence

Créer des maillages paramétriques pour chaque niveau vertébral (C3-S1) en utilisant les dimensions morphologiques déjà présentes dans `models/vertebra.jl`.

Options pour générer les maillages :
1. **Gmsh** (Python API) : `pip install gmsh` → script Python qui génère des .msh
2. **TetGen** : librairie C++ de maillage tétraédrique
3. **PreView** (GUI FEBio) : créer manuellement puis exporter

Recommandation : utiliser Gmsh (le plus simple à automatiser).

🆕 `spinesim/febio/generate_meshes.py`
```python
"""Génère les maillages tétraédriques vertébraux avec Gmsh."""
import gmsh
import json

VERTEBRA_DIMS = {
    "L1": {"width": 42, "depth": 32, "height": 26},
    "L2": {"width": 44, "depth": 33, "height": 27},
    # ... etc.
}

def generate_vertebra_mesh(level: str, dims: dict, output_path: str):
    gmsh.initialize()
    gmsh.model.add(level)
    
    # Corps vertébral simplifié (ellipsoïde aplati)
    w, d, h = dims["width"]/2, dims["depth"]/2, dims["height"]/2
    gmsh.model.occ.addEllipsoid(0, 0, 0, w, d, h)
    
    # Pédicules (2 cylindres)
    ped_r = 4.5  # rayon pédicule
    ped_l = d * 0.8
    for side in [-1, 1]:
        gmsh.model.occ.addCylinder(
            side * w * 0.6, 0, -d * 0.3,
            0, 0, -ped_l,
            ped_r
        )
    
    gmsh.model.occ.synchronize()
    gmsh.model.mesh.generate(3)  # Maillage 3D (tetra)
    gmsh.write(output_path)
    gmsh.finalize()
```

#### T7.4 — Mettre à jour Docker Compose
✅ `spinesim/docker-compose.yml`
```yaml
  febio:
    build: ./febio
    container_name: vertex-febio
    ports:
      - "8081:8081"
    volumes:
      - ./febio/meshes:/app/meshes
    restart: unless-stopped
```

### Critères de validation Sprint 7
- [ ] FEBio compile et s'exécute dans Docker
- [ ] `POST /solve` avec un maillage simple retourne des déplacements
- [ ] Au moins 5 maillages vertébraux (L1-L5) sont générés en .msh
- [ ] Le temps de solve pour 1 vertèbre est < 5 sec

---

## SPRINT 8 — Chirurgie virtuelle : vis pédiculaires (Semaine 17-18)

### Objectif
Implémenter le placement interactif de vis pédiculaires dans le frontend avec validation FEBio.

### Tâches

#### T8.1 — Vis 3D dans Three.js
Ajouter dans `SpineRenderer.js` :
```javascript
addScrew(screwData) {
    const { entry_point, trajectory, diameter, length, level, side } = screwData
    
    // Géométrie de vis (cylindre + filetage simplifié)
    const screwGeom = new THREE.CylinderGeometry(
        diameter / 2, diameter / 2 * 0.8, length, 12
    )
    const screwMat = new THREE.MeshStandardMaterial({
        color: COLORS.screw,
        metalness: 0.9,
        roughness: 0.2,
    })
    
    const screw = new THREE.Mesh(screwGeom, screwMat)
    // Orienter selon la trajectoire
    const dir = new THREE.Vector3(...trajectory).normalize()
    screw.quaternion.setFromUnitVectors(new THREE.Vector3(0, 1, 0), dir)
    screw.position.set(...entry_point)
    
    screw.userData = { type: 'screw', level, side }
    this.scene.add(screw)
    this.screwMeshes.push(screw)
}
```

#### T8.2 — Mode placement interactif
🆕 `spinesim/frontend/src/engine/ScrewPlacer.js`

Classe qui gère :
- Clic sur une vertèbre → sélection du point d'entrée
- Drag pour définir la trajectoire
- Preview en temps réel (vis transparente)
- Validation de la trajectoire (pas de brèche corticale)
- Envoi au backend pour analyse FEM

#### T8.3 — Panneau chirurgie amélioré
✅ `spinesim/frontend/src/components/SurgeryPanel.vue`

Ajouter les contrôles de vis :
- Sélection du niveau vertébral (dropdown)
- Côté (gauche/droit/bilatéral)
- Diamètre (4.5, 5.0, 5.5, 6.0, 6.5, 7.0 mm)
- Longueur (30-55 mm)
- Trajectoire (convergence médiale en degrés)
- Bouton "Placer la vis" → appel API
- Résultats : précision, force d'arrachement, brèche

### Critères de validation Sprint 8
- [ ] Les vis apparaissent en 3D avec orientation correcte
- [ ] Le mode placement interactif fonctionne (clic + drag)
- [ ] L'API retourne la force d'arrachement (pull-out strength)
- [ ] Les brèches corticales sont détectées et signalées

---

## SPRINT 9 — Tiges et correction (Semaine 19-20)

### Objectif
Implémenter les tiges de correction et les manœuvres chirurgicales.

### Tâches

#### T9.1 — Modèle de tige 3D
Ajouter dans `SpineRenderer.js` une fonction pour dessiner une tige courbée passant par les têtes de vis :
```javascript
addRod(rodData) {
    const { screw_heads, material, diameter } = rodData
    
    // Courbe passant par les têtes de vis (Catmull-Rom)
    const points = screw_heads.map(p => new THREE.Vector3(...p))
    const curve = new THREE.CatmullRomCurve3(points)
    
    const tubeGeom = new THREE.TubeGeometry(curve, 64, diameter / 2, 8, false)
    const tubeMat = new THREE.MeshStandardMaterial({
        color: material === 'titanium' ? 0xc0c0c0 : 0xa0a0b0,
        metalness: 0.95,
        roughness: 0.1,
    })
    
    const rod = new THREE.Mesh(tubeGeom, tubeMat)
    this.scene.add(rod)
}
```

#### T9.2 — Manœuvres de correction animées
Implémenter dans le frontend des animations Three.js pour :
- **Dérotation** : rotation progressive des vertèbres autour de l'axe de la tige
- **Translation** : déplacement latéral vers la tige
- **Compression/Distraction** : rapprochement/éloignement entre les vis

Chaque manœuvre envoie les nouveaux paramètres au backend Julia qui recalcule le FEM.

#### T9.3 — Score chirurgical
Ajouter au `ResultsPanel.vue` un tableau de bord post-chirurgie :
- Correction Cobb (% gain)
- Restauration de la balance sagittale (delta SVA)
- Score biomécanique (contraintes aux vis)
- Niveau de fusion nécessaire vs réalisé
- Score global /100

### Critères de validation Sprint 9
- [ ] Les tiges suivent les têtes de vis en courbe lisse
- [ ] La correction anime le rachis en temps réel
- [ ] Le score chirurgical est calculé et affiché
- [ ] Les contraintes aux vis sont mises à jour après correction

---

## SPRINT 10 — Moodle + LTI 1.3 (Semaine 21-24)

### Objectif
Configurer Moodle 4.x en production et connecter VERTEX via LTI 1.3.

### Tâches

#### T10.1 — Docker Compose production Moodle
✅ `moodle-local/docker-compose.yml` — Refaire complètement pour la production :

```yaml
version: '3.8'
services:
  moodle:
    image: bitnami/moodle:4.4
    container_name: vertex-moodle
    ports:
      - "8080:8080"
    environment:
      - MOODLE_DATABASE_HOST=moodle-db
      - MOODLE_DATABASE_PORT_NUMBER=5432
      - MOODLE_DATABASE_NAME=moodle
      - MOODLE_DATABASE_USER=moodle
      - MOODLE_DATABASE_PASSWORD=${MOODLE_DB_PASSWORD:-moodle2026}
      - MOODLE_USERNAME=admin
      - MOODLE_PASSWORD=${MOODLE_ADMIN_PASSWORD:-Vertex2026!}
      - MOODLE_SITE_NAME=VERTEX Formation Scoliose
      - MOODLE_LANG=fr
    volumes:
      - moodle-data:/bitnami/moodle
      - moodle-moodledata:/bitnami/moodledata
    depends_on:
      - moodle-db

  moodle-db:
    image: postgres:17-alpine
    container_name: vertex-moodle-db
    environment:
      - POSTGRES_DB=moodle
      - POSTGRES_USER=moodle
      - POSTGRES_PASSWORD=${MOODLE_DB_PASSWORD:-moodle2026}
    volumes:
      - moodle-pgdata:/var/lib/postgresql/data

volumes:
  moodle-data:
  moodle-moodledata:
  moodle-pgdata:
```

#### T10.2 — Plugin LTI 1.3 pour VERTEX
🆕 `moodle-local/plugins/mod_vertex/` — Plugin Moodle qui intègre VERTEX en LTI 1.3 :

Structure :
```
mod_vertex/
├── version.php
├── lib.php
├── mod_form.php
├── view.php
├── lang/fr/vertex.php
├── db/
│   ├── install.xml
│   └── access.php
└── templates/
    └── view.mustache
```

Le plugin permet à l'enseignant d'ajouter une "activité VERTEX" dans un cours Moodle. Quand l'étudiant clique, il est redirigé vers VERTEX avec un token LTI contenant son identité et le contexte du cours.

#### T10.3 — Import des modules dans Moodle
🆕 `moodle-local/import_courses.py`

Script Python qui :
1. Lit les fichiers `cours/MODULE_*.md`
2. Les convertit en format SCORM ou Moodle Backup (.mbz)
3. Les importe via l'API REST de Moodle

### Critères de validation Sprint 10
- [ ] Moodle 4.x démarre et est accessible
- [ ] Le plugin mod_vertex est installable
- [ ] Un clic sur "Activité VERTEX" ouvre le simulateur
- [ ] L'identité de l'étudiant est transmise via LTI

---

## SPRINT 11 — Paiement Stripe (Semaine 25-26)

### Objectif
Intégrer Stripe pour les abonnements et le paiement à la carte.

### Tâches

🆕 `spinesim/gateway/app/payment/`
- `routes.py` : endpoints `/api/payment/checkout`, `/api/payment/webhook`
- `service.py` : logique Stripe (checkout session, subscription, webhook handler)
- `models.py` : Subscription, Payment, Invoice

Plans tarifaires (d'après `MODELE_ECONOMIQUE.md`) :
| Plan | Prix | Contenu |
|---|---|---|
| Découverte | Gratuit | Module 1 + démo VERTEX |
| Essentiel | €590/an | 10 modules essentiels |
| Chirurgical | €890/an | 20 modules + VERTEX basique |
| Intégral | €1 190/an | 29 modules + VERTEX complet + certification |
| Institution | Sur devis | Multi-licences, analytics |

### Critères de validation Sprint 11
- [ ] Checkout Stripe redirige vers la page de paiement
- [ ] Webhook Stripe active l'abonnement en DB
- [ ] L'accès au contenu est conditionné par l'abonnement actif

---

## SPRINT 12 — Quiz et évaluation (Semaine 27-28)

### Objectif
Implémenter le système de quiz 4 niveaux dans Moodle.

### Tâches

- Plugin quiz personnalisé avec 4 niveaux (Bronze/Argent/Or/Diamant)
- Import des questions depuis les fichiers de cours
- Seuil de passage configurable (70% par défaut)
- Radar de compétences (graphique)
- Export des résultats (CSV)

### Critères de validation Sprint 12
- [ ] 150+ questions importées
- [ ] Les 4 niveaux sont distincts visuellement
- [ ] Le seuil de passage bloque/débloque le module suivant

---

## SPRINT 13 — Dashboard et analytics (Semaine 29-30)

### Objectif
Tableaux de bord praticien et formateur.

### Tâches

🆕 `spinesim/frontend/src/views/DashboardStudent.vue`
🆕 `spinesim/frontend/src/views/DashboardInstructor.vue`

Dashboard praticien :
- Progression globale (barre + %)
- Modules complétés vs restants
- Scores par module (radar)
- Temps passé
- Badges/certificats obtenus

Dashboard formateur :
- Vue cohorte (tableau des étudiants)
- Alertes (étudiants en difficulté, abandons)
- Statistiques d'usage VERTEX
- Export CSV/PDF

### Critères de validation Sprint 13
- [ ] Le dashboard praticien affiche la progression en temps réel
- [ ] Le dashboard formateur affiche la cohorte avec filtres
- [ ] Les alertes se déclenchent (ex: étudiant inactif >7 jours)

---

## SPRINT 14 — Tests, CI/CD, monitoring (Semaine 31-32)

### Objectif
Qualité logicielle : tests complets, intégration continue, monitoring.

### Tâches

#### T14.1 — Tests backend Julia
✅ `spinesim/backend/test/runtests.jl` — Étendre à 80%+ de couverture :
- Tests unitaires pour chaque pathologie
- Tests d'intégration API (HTTP requêtes)
- Test de régression simulation longitudinale (résultats de référence)

#### T14.2 — Tests frontend
🆕 `spinesim/frontend/src/__tests__/`
- Tests composants Vitest + Vue Test Utils
- Test E2E avec Playwright (créer rachis → solve → vérifier 3D)

#### T14.3 — GitHub Actions CI/CD
🆕 `.github/workflows/ci.yml`
```yaml
name: VERTEX CI/CD

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]

jobs:
  test-julia:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: julia-actions/setup-julia@v2
        with:
          version: '1.10'
      - run: |
          cd spinesim/backend
          julia --project=. -e 'using Pkg; Pkg.instantiate()'
          julia --project=. test/runtests.jl

  test-frontend:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: actions/setup-node@v4
        with:
          node-version: 20
      - run: |
          cd spinesim/frontend
          npm ci
          npm run test
          npm run build

  docker-build:
    runs-on: ubuntu-latest
    needs: [test-julia, test-frontend]
    steps:
      - uses: actions/checkout@v4
      - run: docker compose -f spinesim/docker-compose.yml build
```

#### T14.4 — Monitoring
🆕 `spinesim/monitoring/docker-compose.monitoring.yml`
```yaml
services:
  prometheus:
    image: prom/prometheus:v2.51.0
    volumes:
      - ./prometheus.yml:/etc/prometheus/prometheus.yml
    ports:
      - "9090:9090"

  grafana:
    image: grafana/grafana:10.4.0
    ports:
      - "3000:3000"
    environment:
      - GF_SECURITY_ADMIN_PASSWORD=vertex2026
```

### Critères de validation Sprint 14
- [ ] Couverture tests backend ≥ 80%
- [ ] Tests frontend passent (unit + E2E)
- [ ] GitHub Actions passe en vert sur chaque push
- [ ] Grafana affiche les métriques de base (uptime, latence, erreurs)

---

## SPRINT 15 — Déploiement production (Semaine 33-34)

### Objectif
Déployer VERTEX sur un serveur HDS pour le beta test.

### Tâches

#### T15.1 — Configuration production
🆕 `spinesim/deploy/`
```
deploy/
├── docker-compose.prod.yml
├── .env.production
├── backup.sh
├── ssl/
│   └── renew-certs.sh
└── README.md
```

#### T15.2 — Checklist sécurité production
- [ ] TLS 1.3 (Let's Encrypt via Certbot)
- [ ] Variables sensibles dans `.env` (pas dans docker-compose)
- [ ] Rate limiting activé
- [ ] CORS restrictif (domaine production uniquement)
- [ ] Headers de sécurité (HSTS, CSP, X-Frame-Options)
- [ ] Backup automatique PostgreSQL (cron quotidien)
- [ ] Logs centralisés (Loki ou CloudWatch)

#### T15.3 — DNS et domaine
- Domaine recommandé : `vertex-spine.com` ou `formation-scoliose.fr`
- A record → IP serveur OVH/Scaleway
- Sous-domaines : `app.`, `api.`, `lms.`, `grafana.`

### Critères de validation Sprint 15
- [ ] Le site est accessible via HTTPS
- [ ] L'API répond en < 500ms (p95)
- [ ] Les backups fonctionnent et sont testés
- [ ] 10 beta-testeurs peuvent se connecter simultanément

---

# RÉSUMÉ DES DÉPENDANCES ENTRE SPRINTS

```
Sprint 0 (Fondations)
  ├── Sprint 1 (PostgreSQL)
  │   ├── Sprint 2 (Auth JWT)
  │   │   └── Sprint 5 (FastAPI Gateway)
  │   │       ├── Sprint 11 (Stripe)
  │   │       └── Sprint 13 (Dashboards)
  │   └── Sprint 10 (Moodle LTI)
  │       └── Sprint 12 (Quiz)
  ├── Sprint 3 (FEM amélioré)
  │   └── Sprint 7 (FEBio)
  │       ├── Sprint 8 (Vis pédiculaires)
  │       │   └── Sprint 9 (Tiges + correction)
  │       └── Sprint 4 (Frontend 3D) [parallélisable]
  ├── Sprint 6 (Contenu modules 2-5) [indépendant]
  └── Sprint 14 (Tests + CI/CD) [continu]
      └── Sprint 15 (Déploiement)
```

# CONVENTIONS DE CODE

## Julia
- **Style** : 4 espaces d'indentation, docstrings Julia (`""" ... """`)
- **Nommage** : `snake_case` pour fonctions/variables, `CamelCase` pour types/modules
- **Tests** : `@testset` + `@test`, un fichier par module
- **Erreurs** : `@error` / `@warn` / `@info` (pas `println`)

## Vue.js / JavaScript
- **Style** : 2 espaces, `<script setup>`, Composition API
- **Nommage** : `camelCase` pour fonctions/variables, `PascalCase` pour composants
- **Store** : Pinia avec Composition API (`defineStore` + `ref`)
- **CSS** : `<style scoped>`, BEM naming pour les classes

## Python (Gateway)
- **Style** : PEP 8, Black formatter, isort
- **Nommage** : `snake_case` partout, type hints obligatoires
- **Framework** : FastAPI + Pydantic v2
- **Async** : `async def` partout (FastAPI natif)

## Docker
- Images Alpine quand possible
- Multi-stage builds pour la production
- Health checks sur chaque service
- Pas de credentials en clair (`.env` ou secrets)

## Git
- Branches : `main` (production), `develop` (intégration), `feature/*`, `fix/*`
- Commits : Conventional Commits (`feat:`, `fix:`, `docs:`, `refactor:`, `test:`)
- PRs avec review obligatoire sur `main`
- Tags sémantiques : `v0.3.0`, `v0.4.0`, etc.

---

# VARIABLES D'ENVIRONNEMENT REQUISES

```env
# Database
DB_HOST=db
DB_PORT=5432
DB_NAME=vertex
DB_USER=vertex
DB_PASSWORD=<strong-password>

# Auth
JWT_SECRET=<random-256-bit-hex>

# Julia Backend
VERTEX_PORT=8080
JULIA_NUM_THREADS=auto

# FEBio
FEBIO_PORT=8081

# Gateway
GATEWAY_PORT=8000
JULIA_BACKEND_URL=http://backend:8080
FEBIO_URL=http://febio:8081

# Stripe
STRIPE_SECRET_KEY=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...

# Moodle
MOODLE_URL=https://lms.vertex-spine.com
MOODLE_LTI_KEY=vertex-lti-key
MOODLE_LTI_SECRET=<random>

# Frontend
VITE_API_URL=/api
```

---

# PRIORITÉ D'EXÉCUTION RECOMMANDÉE

1. **Sprint 0** → Sprint 1 → Sprint 3 (qualité + DB + FEM) — **Semaines 1-4**
2. **Sprint 6** en parallèle (contenu, pas de dépendance technique) — **Semaines 1-12**
3. **Sprint 2 → Sprint 5** (auth + gateway) — **Semaines 3-8**
4. **Sprint 4** (frontend 3D, parallélisable avec Sprint 5) — **Semaines 5-6**
5. **Sprint 7 → Sprint 8 → Sprint 9** (FEBio + chirurgie) — **Semaines 13-20**
6. **Sprint 10 → Sprint 12** (Moodle + quiz) — **Semaines 21-28**
7. **Sprint 11** (Stripe, parallélisable avec Sprint 10) — **Semaines 25-26**
8. **Sprint 13** (dashboards) — **Semaines 29-30**
9. **Sprint 14** (tests, continu depuis Sprint 0) — **Semaines 31-32**
10. **Sprint 15** (déploiement) — **Semaines 33-34**

---

*Plan de développement VERTEX© — 15 sprints / 34 semaines*
*Prêt pour exécution par Claude Sonnet 4.1*
