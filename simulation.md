80% des scolioses sont idiopathiques, c'est à dire sans cause apparente, sans etiologie, mais il y a differentes theories, j'en ai une que je dois verifier, cette theorie peut expliquer la totalité ou une partie des scolioses idiopathiques: le rachis est symetrique, et il doit jouer son role d'amortisseur et repartiteur de pression, chose qu'ilpourra faire toute une vie, et il reste symetrique, pour son role d'amortisseur, il joue le role d'un ressort ( comme dans une voiture ou d'autres vehicules par exemple), don je veux simuler un rachis normal subissant les contraintes de pression de la vie quotidienne pendant des annees et voir les deformations, et s'il joue aussi le role d'un ressort spiral, puis les memes contraintes pendant des annees sur un rachis legerement asymetrique, d'origine statique(une deformation vertebrale ou de l'arc posterieur), ou dynamique(une assymetrie ligamentaire ou discale) est ce que vertex peut le faire ou je dois trouver une autre application?

---

# NOTE TECHNIQUE DE REPRISE
**Date** : 3 mars 2026 — **Commit** : e06349c (main, GitHub)

## Etat du projet — Phase 1 COMPLETE

La simulation longitudinale de la theorie du ressort spiral est **operationnelle et calibree**. Resultats cliniquement realistes.

**Resultats valides (fille, age 10 ans, 10/20 ans de simulation) :**

| Asymetrie initiale | Cobb final | Scoliose | Onset |
|:---|:---:|:---:|:---:|
| Symetrique | 0.0 | Non | - |
| Cuneiformisation 1 deg (T8) | 11.2 | Oui | age 14.2 ans |
| Cuneiformisation 2 deg (T8) | 22.2 | Oui | age 12.6 ans |
| Cuneiformisation 3 deg (T8) | 32.8 | Oui | age 12.1 ans |
| Ligament +10/20% (T7) | 0.0 | Non | - (limitation FEM) |
| Disque +10% (T8) | 0.0 | Non | - (limitation FEM) |
| Combinee (wedge 2 + lig 10%) | 22.2 | Oui | age 12.6 ans |

Interpretation : theorie verifiee pour la cuneiformisation statique. Coefficient amplification ~11x (1 deg wedging -> ~11 deg Cobb / 10 ans croissance). Asymetries tissus mous non initiatrices dans le FEM actuel (Phase 2).

---

## Bugs resolus (3 mars 2026)

| # | Fichier | Symptome | Fix |
|:---:|:---|:---|:---|
| 11 | stenosis/tumor/adult_deformity.jl | lig.level_index inexistant | level_index(lig.level) |
| 12 | stenosis.jl | lig.cross_section_area inexistant | Suppression |
| 13 | stenosis/adult_deformity.jl | disc.annulus.stiffness immutable | Reconstruction MaterialProperties |
| 14 | adult_deformity.jl | VertebralLevel(N) invalide | vertebral_levels()[N] |
| 15 | server.jl | wedging_1/2/3 non reconnus -> 0 silencieux | Branches explicites handler |
| 16 | asymmetry.jl | \ -> UndefVarError: angle | \ |

---

## Parametres calibration finaux (simulation.jl)

hueter_volkmann_k    = 1.0
growth_amplification = 18.0 * (growth_rate / (peak_rate + 0.5))
creep_coefficient    = 5e-11  mm/Pa/mois
theta_creep          = creep * sin(tilt) * 0.2
lat_growth           = delta_h * sin(tilt) * amplification * 0.05
seuil_tilt_HV        = 0.0005 rad
age_limite_croissance = 18 ans

---

## Prochaines etapes — Phase 2

1. FEM dynamique — permettre aux ligaments/disques d'initier la scoliose
   Fichiers : fem/solver.jl, longitudinal/simulation.jl

2. Rotation axiale — ajouter theta_z (gibbosité)
   Fichiers : simulation.jl, asymmetry.jl

3. Modules de formation — MODULE_02 a MODULE_05
   cours/MODULE_02_*.md a creer

---

## Pour reprendre

  cd C:\Users\USER\Documents\scoliose\spinesim
  docker compose up -d
  curl http://localhost:8080/health

  # Test (attendu max_cobb_angle = 22.2)
  curl -X POST http://localhost:8080/api/longitudinal/run -H Content-Type:application/json -d {duration_years:10,initial_age:10,asymmetry_type:wedging_2}

Rapport complet : docs/RAPPORT_SIMULATION_RESSORT_SPIRAL.md

---

# NOTE TECHNIQUE DE REPRISE #2
**Date** : 3 mars 2026 — **Session** : Claude Opus 4 (Sprint 3+ FEM)

## Travail effectue — Sprint 3 : FEM ameliore

### 1. Bug critique corrige : contraintes en coordonnees locales
**Fichier** : `spinesim/backend/src/fem/solver.jl` — `compute_element_stresses()`

**Avant** : les deplacements globaux U etaient utilises directement pour calculer
les deformations axiales, de flexion et de torsion. Pour tout element NON-vertical
(c'est-a-dire la majorite du rachis avec ses courbures sagittales), les contraintes
etaient fausses.

**Apres** : transformation `u_local = T * u_global` avant calcul des contraintes.
Les formules de contrainte (sigma_axial = E * du/L, sigma_flex = E*c*dtheta/L)
s'appliquent maintenant dans le repere local de la poutre.

### 2. Conditions aux limites par elimination (vs penalite)
**Fichier** : `spinesim/backend/src/fem/solver.jl` — `apply_boundary_conditions()`

Nouvelle fonction avec deux methodes :
- `:elimination` (defaut) — reduit le systeme K*U=F en eliminant les DOF fixes.
  Meilleur conditionnement. Les DOF du sacrum sont exactement 0.
- `:penalty` (retrocompatible) — ajoute 1e15 sur la diagonale.

Le solveur reconstruit le vecteur complet U apres resolution du systeme reduit.

### 3. Idempotence de solve_spine!
**Fichier** : `spinesim/backend/src/fem/solver.jl`

solve_spine! sauvegarde les positions/orientations de REFERENCE avant resolution,
puis met a jour depuis la reference (pas incrementalement). Avant, appeler
solve_spine! deux fois accumulait les deplacements → positions fausses.

### 4. Matrice de rigidite geometrique (flambage FEM)
**Fichier** : `spinesim/backend/src/fem/stiffness.jl`

Trois nouvelles fonctions :
- `beam_geometric_stiffness(elem, N)` — matrice Ksigma 12x12 (Przemieniecki 1968)
  Capture l'effet P-Delta : reduction de rigidite sous compression.
- `assemble_geometric_stiffness(mesh, U)` — assemblage global depuis les efforts
  normaux reels (extraits du champ de deplacement).
- `linear_buckling_factor(K, Ksigma, fixed_dofs)` — probleme aux valeurs propres
  generalise : (K + lambda*Ksigma)*phi = 0. lambda_cr > 1 = stable.

### 5. Flambage FEM dans la simulation longitudinale
**Fichier** : `spinesim/backend/src/longitudinal/simulation.jl`

Nouvelle fonction `compute_fem_buckling_ratio(model, weight)` :
- Utilise la VRAIE matrice geometrique (pas la formule d'Euler simplifiee)
- Inclut la contribution des ligaments
- Capture les modes de flambage locaux
- Complement de `compute_spring_buckling_ratio()` (analytique)

### 6. Corrections d'architecture
- Ordre inclusion corrige dans Vertex.jl : stiffness.jl AVANT solver.jl
  (solver.jl utilise element_rotation_matrix() defini dans stiffness.jl)
- Imports deplace : eigvals/det dans stiffness.jl, Diagonal/Symmetric dans solver.jl
- Exports des nouvelles fonctions ajoutees dans Vertex.jl

### 7. Tests ajoutes (7 testsets, ~95 lignes)
**Fichier** : `spinesim/backend/test/runtests.jl`

| Testset | Verifie |
|:---|:---|
| CL elimination vs penalite | Convergence < 1%, sacrum exactement zero |
| Re-entree solve_spine! | U1 ≈ U2 a 1e-8 pres |
| Matrice geometrique elem | Symetrie, termes nuls/positifs, N=0 → zeroes |
| Assemblage geometrique global | 138x138 sparse, non-nulle |
| Analyse flambage lineaire | lambda_cr > 1 pour rachis normal |
| compute_fem_buckling_ratio | ratio < 1 pour rachis normal |
| Contraintes coord. locales | Finitude, non-nullite sous gravite |

---

## Fichiers modifies

| Fichier | Lignes | Type |
|:---|:---:|:---|
| spinesim/backend/src/fem/solver.jl | 266 | Rewrite (CL, idempotence, contraintes locales) |
| spinesim/backend/src/fem/stiffness.jl | 453 | +190 lignes (Kg, assemblage, flambage) |
| spinesim/backend/src/longitudinal/simulation.jl | ~840 | +40 lignes (compute_fem_buckling_ratio) |
| spinesim/backend/src/Vertex.jl | 79 | Fix ordre inclusion + exports |
| spinesim/backend/test/runtests.jl | ~710 | +95 lignes (7 testsets) |

---

## Prochaines etapes — Phase 2 (plan Sprint 4+)

1. **Sprint 4 — Frontend 3D** : geometrie vertebrale realiste (ExtrudeGeometry),
   materiaux PBR, controles de vue (AP/lateral/axial/3D), capture ecran
   Fichiers : SpineRenderer.js, ViewControls.vue

2. **Sprint 5 — Mesures angulaires API** : endpoint /api/measurements
   avec Cobb, SVA, balance coronale, cyphose thoracique, lordose lombaire
   Fichiers : server.jl (nouveau handler), MeasurementPanel.vue

3. **Sprint 6 — Rapports cliniques PDF** : export structure
   Fichiers : reports/report.jl, ReportPanel.vue

4. **FEM dynamique** — permettre aux ligaments/disques d'initier la scoliose
   (limitation identifiee dans la Phase 1 : asymetries tissus mous non initiatrices)

5. **Rotation axiale** — ajouter theta_z (gibbosite) dans la simulation longitudinale

6. **Contenu pedagogique** — etoffer Modules 21-25 (niveau bullet points → 500 lignes)

---

## Pour reprendre

```
cd C:\Users\USER\Documents\scoliose\spinesim
docker compose up -d
curl http://localhost:8080/health

# Test simulation longitudinale (attendu max_cobb_angle = 22.2)
curl -X POST http://localhost:8080/api/longitudinal/run -H Content-Type:application/json -d {duration_years:10,initial_age:10,asymmetry_type:wedging_2}

# Tests Julia
cd backend
julia --project=. test/runtests.jl
```

---

# NOTE TECHNIQUE DE REPRISE #3
**Date** : 5 mars 2026 — **Session** : Claude Opus 4.6 (Sprint 4 + Sprint 5)

## Travail effectue — Sprint 4 : Frontend 3D ameliore

### 1. Geometrie vertebrale enrichie
**Fichier** : `spinesim/frontend/src/engine/SpineRenderer.js`

Ajout de structures anatomiques manquantes dans `_createVertebraMesh()` :
- **Lamines** (BoxGeometry) — connexion pedicules → processus epineux
- **Processus transverses** (CylinderGeometry) — extensions laterales
- **Facettes articulaires** (SphereGeometry) — 4 par vertebre (sup/inf × gauche/droite)

### 2. Environment map PBR procedurale
**Fichier** : `spinesim/frontend/src/engine/SpineRenderer.js`

Nouvelle methode `_initEnvironment()` :
- PMREMGenerator avec scene procedurale (sol + plafond scialytique)
- Reflets realistes sur vis et tiges metalliques (metalness 0.92+)
- Pas de fichier HDR externe → chargement instantane

### 3. Transitions camera animees
**Fichier** : `spinesim/frontend/src/engine/SpineRenderer.js`

Nouvelle methode `setCameraView(targetPos, targetLook, durationMs)` :
- Animation fluide avec easing cubic-out
- Annulation d'animation en cours via cancelAnimationFrame
- Utilise lerpVectors pour interpolation position + target

### 4. Integration ViewControls dans App.vue
**Fichier** : `spinesim/frontend/src/App.vue`

- ViewControls integre en overlay (position absolute, bas-gauche du viewport)
- MeasurementPanel et ReportPanel integres dans le panneau droit
- Renderer expose via defineExpose() dans SpineViewport.vue

### 5. SpineViewport expose le renderer
**Fichier** : `spinesim/frontend/src/components/SpineViewport.vue`

- `defineExpose({ renderer })` permet au parent de passer le renderer a ViewControls
- ViewControls utilise `setCameraView()` pour transitions AP/Lat/Axial/3D animees

---

## Travail effectue — Sprint 5 : Mesures radiologiques API

### 1. Endpoint GET /api/spine/{id}/measurements
**Fichier** : `spinesim/backend/src/api/server.jl`

Nouveau handler `handle_get_measurements()` qui calcule :
- **Angle de Cobb** — via `measure_cobb()` (FEM) ou estimation geometrique
- **Apex** — vertebre avec deviation laterale maximale
- **Cyphose thoracique** T4-T12 (norme 20-50 deg)
- **Lordose lombaire** L1-L5 (norme 30-60 deg)
- **SVA** — distance AP entre C7 et S1 (norme < 50 mm)
- **Balance coronale** — distance laterale C7-CSVL (norme < 20 mm)
- **Severite** — normal/legere/moderee/severe/tres severe

### 2. Store action fetchMeasurements()
**Fichier** : `spinesim/frontend/src/stores/spineStore.js`

- Nouveau state `solveResult` pour stocker les mesures
- `fetchMeasurements()` appele automatiquement apres `solveSpine()`
- MeasurementPanel lit `store.solveResult` (deja cable)

---

## Fichiers modifies

| Fichier | Type |
|:---|:---|
| spinesim/frontend/src/engine/SpineRenderer.js | +95 lignes (geometrie, envmap, camera) |
| spinesim/frontend/src/components/SpineViewport.vue | +1 ligne (defineExpose) |
| spinesim/frontend/src/components/ViewControls.vue | Transition animee |
| spinesim/frontend/src/App.vue | Integration ViewControls, MeasurementPanel, ReportPanel |
| spinesim/frontend/src/stores/spineStore.js | +solveResult, +fetchMeasurements() |
| spinesim/backend/src/api/server.jl | +endpoint /api/spine/*/measurements (~110 lignes) |

---

## Prochaines etapes — Phase 2 (Sprint 6+)

1. **Sprint 6 — Rapports cliniques PDF** : export structure
   Fichiers : backend reports/report.jl (deja fait), ReportPanel.vue (deja integre)
   → Verifier le cablage complet frontend ↔ backend

2. **FEM dynamique** — permettre aux ligaments/disques d'initier la scoliose

3. **Rotation axiale** — ajouter theta_z (gibbosite) dans la simulation longitudinale

4. **Contenu pedagogique** — etoffer Modules 21-25

---

## Pour reprendre

```
cd C:\Users\USER\Documents\scoliose\spinesim
docker compose up -d
curl http://localhost:8080/api/health

# Test mesures radiologiques (Sprint 5)
curl http://localhost:8080/api/spine/{id}/measurements

# Test simulation longitudinale (attendu max_cobb_angle = 22.2)
curl -X POST http://localhost:8080/api/longitudinal/run -H Content-Type:application/json -d {duration_years:10,initial_age:10,asymmetry_type:wedging_2}

# Build frontend
cd frontend
npm run build

# Tests Julia
cd backend
julia --project=. test/runtests.jl
```