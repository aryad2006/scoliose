# VERTEX© — Virtual Environment for Rachis Training and EXploration

## Phase 0 — Proof of Concept

Simulateur biomécanique 3D interactif pan-rachidien pour l'enseignement de la chirurgie du rachis.

### Architecture

```
spinesim/
├── backend/          # Julia 1.10 — Moteur biomécanique
│   ├── src/
│   │   ├── models/   # Vertèbres, disques, ligaments, rachis
│   │   ├── fem/      # Éléments finis (beam Euler-Bernoulli 3D)
│   │   ├── pathology/ # Scoliose, fractures, hernies, spondylolisthésis,
│   │   │              # sténose, tumeurs, déformités de l'adulte
│   │   ├── surgery/  # Vis pédiculaires, tiges, manœuvres
│   │   └── api/      # Serveur REST HTTP
│   └── test/
├── frontend/         # Vue.js 3 + Three.js — Interface 3D
│   └── src/
│       ├── engine/   # SpineRenderer (WebGL)
│       ├── components/ # Panneaux UI
│       └── stores/   # Pinia (état global)
└── docker-compose.yml
```

### Démarrage rapide

#### Sans Docker

**Backend Julia :**
```bash
cd backend
julia --project=.
julia> ]instantiate
julia> using Vertex; start_server(port=8080)
```

**Frontend Vue.js :**
```bash
cd frontend
npm install
npm run dev
```

Ouvrir http://localhost:5173 dans le navigateur.

#### Avec Docker

```bash
docker-compose up --build
```

- Frontend: http://localhost:3000
- API Backend: http://localhost:8080/api/health

### API REST

| Méthode | Route | Description |
|---------|-------|-------------|
| GET | `/api/health` | État du serveur |
| GET | `/api/info` | Version et capacités |
| POST | `/api/spine/create` | Créer un rachis normal |
| POST | `/api/spine/{id}/solve` | Résoudre le FEM |
| POST | `/api/spine/{id}/scoliosis` | Appliquer une scoliose (Lenke 1-6) |
| POST | `/api/spine/{id}/fracture` | Appliquer une fracture (AO/Magerl, TLICS) |
| POST | `/api/spine/{id}/hernia` | Appliquer une hernie discale |
| POST | `/api/spine/{id}/spondylolisthesis` | Spondylolisthésis (Meyerding I-V) |
| POST | `/api/spine/{id}/stenosis` | Sténose canalaire (Schizas A-D) |
| POST | `/api/spine/{id}/tumor` | Tumeur rachidienne (SINS, Tokuhashi, Tomita) |
| POST | `/api/spine/{id}/adult-deformity` | Déformité adulte (SRS-Schwab) |
| POST | `/api/surgery/{id}/screw` | Placer une vis pédiculaire |
| POST | `/api/surgery/{id}/rod` | Connecter une tige |
| POST | `/api/surgery/{id}/correct` | Manœuvre de correction |
| GET | `/api/surgery/{id}/evaluate` | Évaluer la chirurgie |

### Modules pathologiques

| Module | Classifications | Fichier |
|--------|----------------|---------|
| **Scoliose** | Lenke 1-6, angle de Cobb, rotation vertébrale | `pathology/scoliosis.jl` |
| **Fracture** | AO/Magerl (A0-C), score TLICS, burst/compression/chance | `pathology/fracture.jl` |
| **Hernie discale** | Protrusion/Extrusion/Séquestration, localisation foraminale | `pathology/hernia.jl` |
| **Spondylolisthésis** | Meyerding I-V, isthmique/dégénératif/dysplasique | `pathology/spondylolisthesis.jl` |
| **Sténose** | Schizas A-D, centrale/latérale/foraminale, multi-étagée | `pathology/stenosis.jl` |
| **Tumeur** | SINS, Tokuhashi, Tomita, WBB, lytique/blastique | `pathology/tumor.jl` |
| **Déformité adulte** | SRS-Schwab, PI-LL mismatch, SVA, dos plat, Scheuermann | `pathology/adult_deformity.jl` |

### Modèle biomécanique

- **23 vertèbres** (C3-S1) avec morphologie Panjabi 1991 / Zindrick 1987
- **22 disques** avec modèle Mooney-Rivlin + fibres ±30° (Marchand & Ahmed)
- **~150 ligaments** (LVCA, LVCP, LF, ISL, SSL, ITL, CL) avec mécanique non-linéaire
- **FEM poutre Euler-Bernoulli 3D** — 12 DDL par élément, ~138 DDL total
- **7 modules pathologiques** couvrant les principales pathologies du rachis
- **Vis pédiculaires** avec évaluation trajectoire / pull-out / breach
- **Manœuvres** : rotation de tige, translation, compression, distraction, dérotation

### Références

- Panjabi MM et al. "Human lumbar vertebrae: quantitative three-dimensional anatomy." _Spine_, 1992.
- Zindrick MR et al. "Analysis of the morphometric characteristics of the thoracic and lumbar pedicles." _Spine_, 1987.
- Gilad & Nissan. "Sagittal evaluation of elemental geometrical dimensions of human vertebrae." _J Anat_, 1986.
- Halvorson TL et al. "Effects of bone mineral density on pedicle screw fixation." _Spine_, 1994.
- Magerl F et al. "A comprehensive classification of thoracic and lumbar injuries." _Eur Spine J_, 1994.
- Schwab F et al. "Scoliosis Research Society—Schwab adult spinal deformity classification." _Spine_, 2012.
- Tokuhashi Y et al. "Revised scoring system for preoperative evaluation of metastatic spine tumor prognosis." _Spine_, 2005.
- Schizas C et al. "Qualitative grading of severity of lumbar spinal stenosis." _Spine_, 2010.

### Licence

© 2025 VERTEX© — Projet de formation en chirurgie du rachis. Usage éducatif uniquement.
