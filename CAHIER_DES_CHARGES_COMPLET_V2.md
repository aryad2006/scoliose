# CAHIER DES CHARGES COMPLET — V2
## Projet Formation Scoliose + VERTEX© — Analyse, Améliorations, Alternatives et Roadmap

**Date** : 3 mars 2026  
**Version** : 2.0  
**Statut** : Audit complet post-analyse de tous les fichiers du projet  
**Analyste** : GitHub Copilot (Claude Opus 4.6)

---

# TABLE DES MATIÈRES

1. [SYNTHÈSE EXÉCUTIVE](#1-synthèse-exécutive)
2. [ANALYSE DE L'ARCHITECTURE ACTUELLE](#2-analyse-de-larchitecture-actuelle)
3. [PROBLÈMES IDENTIFIÉS ET CORRECTIONS](#3-problèmes-identifiés-et-corrections)
4. [ALTERNATIVES À SPINESIM/VERTEX — ANALYSE COMPARATIVE](#4-alternatives-à-spinesimvertex--analyse-comparative)
5. [RECOMMANDATION ARCHITECTURALE](#5-recommandation-architecturale)
6. [CAHIER DES CHARGES COMPLET RÉVISÉ](#6-cahier-des-charges-complet-révisé)
7. [ROADMAP DÉTAILLÉE](#7-roadmap-détaillée)
8. [ANNEXES](#8-annexes)

---

# 1. SYNTHÈSE EXÉCUTIVE

## 1.1 Ce qu'est ce projet

Le projet **Formation Scoliose + VERTEX©** est un écosystème éducatif médical composé de :

- **29 modules de formation** (~89h) sur la scoliose, de niveau chirurgien spécialiste
- **VERTEX©** : un simulateur biomécanique interactif basé sur les éléments finis (FEM)
- **Une plateforme LMS** (Moodle personnalisé) pour héberger et distribuer le contenu
- **Un module de simulation longitudinale** validant la « théorie du ressort spiral » (hypothèse originale sur l'étiologie de la scoliose idiopathique)

## 1.2 État actuel (3 mars 2026)

| Composant | État | Maturité |
|---|---|---|
| Documentation pédagogique (plan, specs) | 14+ fichiers, ~10 200 lignes | ✅ 90% — Très avancé |
| Module 1 rédigé (cours/) | 943 lignes, qualité exceptionnelle | ✅ Complet |
| Backend Julia (VERTEX) | ~4 000 lignes, 7 pathologies, FEM fonctionnel | ⚠️ 30% — Prototype Phase 0 |
| Simulation longitudinale | ~1 910 lignes, résultats calibrés | ✅ Phase 1 complète |
| Frontend Vue.js/Three.js | ~408 lignes App.vue, composants de base | ⚠️ 15% — Squelette |
| Moodle local (Docker) | Config Docker + scripts PHP | ⚠️ 10% — Expérimental |
| Tests unitaires | 339 lignes, 9 testsets | ⚠️ 20% — Couverture partielle |

## 1.3 Verdict global

Le projet est **extrêmement ambitieux et médicalement remarquable**, mais souffre de :

1. **Disproportion documentation/code** : 10 200 lignes de docs vs ~4 000 lignes de code fonctionnel
2. **Architecture VERTEX surdimensionnée** pour la phase actuelle
3. **Choix technologiques risqués** (Julia seul, Genie.jl, pas de BDD)
4. **Absence de validation marché** avant investissement technique
5. **Simulation longitudinale validée** — c'est le joyau du projet et la vraie valeur scientifique

---

# 2. ANALYSE DE L'ARCHITECTURE ACTUELLE

## 2.1 Backend Julia — Forces et faiblesses

### Forces
- **Modélisation FEM correcte** : matrices de rigidité Euler-Bernoulli 3D 12×12, assemblage par triplets creux, solveur direct + CG fallback
- **Modèle anatomique réaliste** : 23 vertèbres (C3-S1), 22 disques, ligaments avec 7 types, morphologie paramétrique issue de la littérature (Panjabi, Roussouly)
- **Simulation longitudinale validée** : résultats cliniquement plausibles (wedging 1° → Cobb 11.2°, coefficient d'amplification ~11×)
- **API REST propre** : 16+ endpoints, CORS, JSON sérialisé
- **7 modules pathologiques** : scoliose, fracture, hernie, spondylolisthésis, sténose, tumeur, déformité adulte

### Faiblesses critiques

| # | Problème | Impact | Sévérité |
|---|---|---|---|
| A-01 | **Maillage poutre (Phase 0)** : 23 nœuds, 22 éléments beam → trop simpliste pour chirurgie virtuelle | Impossible de simuler le placement de vis dans un pédicule (besoin de maillage volumique tétraédrique) | 🔴 CRITIQUE |
| A-02 | **Pas de BDD** : `ACTIVE_MODELS` est un Dict en mémoire → perte totale au redémarrage | Aucune persistance, pas de multi-utilisateurs réel | 🔴 CRITIQUE |
| A-03 | **Pas d'authentification** : API ouverte, CORS `*` | Aucune sécurité | 🟠 HAUTE |
| A-04 | **Genie.jl abandonné** : le code utilise HTTP.jl directement (pas Genie.jl comme spécifié) | Les specs sont incohérentes avec le code réel | 🟠 HAUTE |
| A-05 | **Pas de WebSocket** : tout en REST synchrone → pas de temps réel | Impossible d'avoir une simulation interactive fluide | 🟡 MOYENNE |
| A-06 | **Pas de GPU** : calculs CPU uniquement, pas de CUDA.jl utilisé | Ne posera problème qu'en phase avancée | 🟢 BASSE actuellement |
| A-07 | **No logging/monitoring** : pas de structured logging, pas de métriques | Debug difficile en production | 🟡 MOYENNE |
| A-08 | **FEM fallback silencieux** : quand solve échoue, `fem_ok = false` mais la simulation continue sans FEM → résultats potentiellement faux | Fiabilité des résultats compromise | 🟠 HAUTE |

## 2.2 Frontend Vue.js/Three.js — État

- **Squelette fonctionnel** : layout 3 colonnes (contrôles / viewport 3D / résultats)
- **Composants présents** : SpineViewport, PatientPanel, ScoliosisPanel, SurgeryPanel, ResultsPanel, LongitudinalPanel
- **Three.js** utilisé pour le rendu 3D
- **Pinia** pour la gestion d'état
- **Problème majeur** : le viewport 3D affiche des cylindres/sphères basiques, pas un rachis réaliste → besoin de modèles GLB/GLTF

## 2.3 Moodle local — État

- Docker Compose avec PostgreSQL 17 + Moodle PHP 8.3
- Nombreux scripts PHP de fix/debug → signe d'instabilité
- **Pas adapté à la production** : configuration locale uniquement
- **Chemin Mac** dans les commentaires (`/Users/imac/Desktop/`) → problème de portabilité

## 2.4 Cohérence inter-documents

| Problème de cohérence | Fichiers concernés | Détail |
|---|---|---|
| Stack spécifié ≠ stack implémenté | VERTEX_SPECS vs code | Specs : Genie.jl, FinEtools.jl, Ferrite.jl, CUDA.jl → Code : HTTP.jl seul, pas de FEM library externe |
| Budget VERTEX : €3,6-5M | BUDGET vs réalité | Les 4 000 lignes actuelles = <5% de ce budget |
| Nombre de devs : 11-12 | BUDGET vs réalité | Projet développé par 1 personne + assistant IA |
| Vue.js « ou React » | Specs vs code | Code = Vue.js (bon choix, mais specs indécises) |
| Maillage tétraédrique | VERTEX_SPECS vs code | Specs : « FEMesh{Tetrahedron} » → Code : poutre Euler-Bernoulli linéaire |

---

# 3. PROBLÈMES IDENTIFIÉS ET CORRECTIONS

## 3.1 Corrections techniques immédiates (code)

### 3.1.1 Backend Julia

| # | Fichier | Problème | Correction recommandée | Priorité |
|---|---|---|---|---|
| C-01 | `server.jl` | Route `GET /api/health` enregistrée mais aussi `/health` dans README → incohérence | Unifier vers `/api/health` | 🟢 |
| C-02 | `server.jl` | `ACTIVE_MODELS` = Dict en mémoire, pas thread-safe | Ajouter `ReentrantLock()` ou passer à SQLite/PostgreSQL | 🔴 |
| C-03 | `simulation.jl` | `catch e` sur FEM → continue sans erreur visible | Logger l'erreur, proposer un mode strict qui arrête | 🟠 |
| C-04 | `simulation.jl` | `current_weight = update_patient_weight(params, current_age)` — vérifie que la fonction existe | Confirmer implémentation, ajouter test | 🟡 |
| C-05 | `solver.jl` | `cg_solve` : solveur CG maison sans préconditionneur | Utiliser `IterativeSolvers.jl` pour un CG/GMRES robuste avec préconditionneur | 🟡 |
| C-06 | `stiffness.jl` | Pas de transformation locale→globale pour les éléments poutre inclinés | Ajouter la matrice de rotation T : $K_{global} = T^T K_{local} T$ | 🔴 |
| C-07 | `spine.jl` | `measure_cobb()` projette dans le plan XZ via `Vec3(n1[1], 0, n1[3])` → ne gère pas la rotation axiale | Projeter correctement dans le plan coronal en tenant compte de la posture globale | 🟡 |
| C-08 | `types.jl` | `MaterialProperties` est immutable (`struct`) → cause des erreurs dans stenosis/adult_deformity quand on modifie les propriétés | Déjà partiellement fixé (reconstruction), mais à vérifier | 🟡 |
| C-09 | `mesh.jl` | `E_eff = (E_disc * E_bone) / (E_disc + E_bone)` — modèle série trop simpliste | Ajouter le modèle Voigt-Reuss-Hill pour des bornes plus réalistes | 🟡 |
| C-10 | `runtests.jl` | Pas de `using Vertex` → tests par include direct → fragile | Utiliser le module compilé : `using Vertex` | 🟡 |

### 3.1.2 Frontend

| # | Fichier | Problème | Correction | Priorité |
|---|---|---|---|---|
| C-11 | `App.vue` | `VITE_API_URL` dans Docker = `http://backend:8080` → inaccessible depuis le navigateur | Utiliser `http://localhost:8080` ou un reverse proxy | 🔴 |
| C-12 | `package.json` | Three.js v0.162 → la version actuelle est 0.170+ | Mettre à jour | 🟡 |
| C-13 | Components | Pas de gestion d'erreur sur les appels API | Ajouter try/catch + toast d'erreur | 🟡 |

### 3.1.3 Infrastructure

| # | Fichier | Problème | Correction | Priorité |
|---|---|---|---|---|
| C-14 | `docker-compose.yml` (spinesim) | Pas de réseau Docker dédié → conflit potentiel avec Moodle | Créer un réseau `vertex-net` | 🟡 |
| C-15 | `docker-compose.yml` (moodle) | Credentials en clair dans le fichier | Utiliser `.env` ou Docker secrets | 🟠 |
| C-16 | Général | Pas de `.gitignore` visible | Ajouter `.gitignore` (node_modules, .env, __pycache__, etc.) | 🟢 |
| C-17 | Général | Pas de CI/CD (GitHub Actions) | Créer workflow build + test | 🟠 |

## 3.2 Corrections documentaires

| # | Document | Problème | Correction |
|---|---|---|---|
| D-01 | `NOTE_TECHNIQUE_PROJET.md` | Dernière ligne : « Document généré le **2025-07-13** — v1.0 » → incohérent avec header v3.2 Février 2026 | Mettre à jour la date et version |
| D-02 | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` | Mentionne Genie.jl partout → le code utilise HTTP.jl | Aligner : indiquer HTTP.jl + migration potentielle vers Oxygen.jl |
| D-03 | `CALENDRIER_PRODUCTION.md` | Jalons datés en mois relatifs sans date de début fixée | Fixer un M0 (ex : septembre 2026 si financement obtenu) |
| D-04 | `MODELE_ECONOMIQUE.md` | Churn 5%/mois An 1 = 46% annuel → incompatible avec LTV de €1100 (LTV = ARPU / churn = 772/0.05 = €15 440 ou avec churn annuel = 772/0.46 = €1 678) | Recalculer LTV avec le churn mensuel correct |
| D-05 | `BUDGET_GLOBAL_FORMATION.md` | « 11-12 personnes » pour VERTEX → irréaliste pour le stade actuel | Adapter : Phase 1 = 2-3 devs, Phase 2 = 5-7 devs |
| D-06 | `REFLEXION_FINALE_STRATEGIQUE.md` | Section 6 « Mon avis honnête » est vide (coupée) | Compléter ou supprimer |
| D-07 | `moodle-local/docker-compose.yml` | Chemin Mac dans les commentaires | Adapter pour Windows/multi-OS |

---

# 4. ALTERNATIVES À SPINESIM/VERTEX — ANALYSE COMPARATIVE

## 4.1 Le problème avec l'approche actuelle

Le VERTEX actuel est un **solveur FEM maison écrit from scratch en Julia** :
- Matrice de rigidité poutre Euler-Bernoulli 3D codée à la main
- Assemblage FEM codé à la main
- Solveur direct/CG codé à la main
- Pas de bibliothèque FEM externe (contrairement aux specs qui mentionnent FinEtools.jl/Ferrite.jl)

Cela représente ~4 000 lignes de Julia qui réimplémentent ce que des frameworks matures font déjà **avec 20 ans de validation** et des ordres de grandeur de fonctionnalités supplémentaires.

## 4.2 Alternatives FEM existantes (open-source)

### 4.2.1 FEBio — ★★★★★ (RECOMMANDÉ pour le calcul)

| Critère | Détail |
|---|---|
| **Description** | Framework FEM spécialisé biomécanique, développé par l'Université de Utah (Musculoskeletal Research Lab) |
| **Licence** | MIT (open-source depuis 2020) |
| **Langage** | C++ (noyau) + Python API (FEBioPy) + SDK |
| **Spécialisations** | Tissus biologiques, mécanique des solides, contact, matériaux hyperélastiques, croissance, remodelage |
| **Maillage** | Tétraédrique, hexaédrique, beam, shell — import de maillages depuis PreView |
| **Matériaux** | 50+ modèles constitutifs (Mooney-Rivlin, Ogden, néo-hookéen, transverse isotrope, fibre renforcé…) |
| **Validation** | 100+ publications peer-reviewed, utilisé par la NIH, Mayo Clinic, Stanford |
| **Communauté** | ~5 000 utilisateurs, forum actif, documentation complète |
| **Spine spécifique** | Oui — de nombreuses études rachidiennes publiées avec FEBio |
| **Intégration WebGL** | Non natif, mais export de résultats en JSON / VTK possible |

**Avantage** : FEBio a un modèle de matériau dédié à la **croissance et au remodelage** (`GrowthTensor`), exactement ce dont la théorie du ressort spiral a besoin. Son solveur est validé cliniquement sur des modèles rachidiens. La migration du code Julia vers FEBio éliminerait >2 000 lignes de code FEM maison et augmenterait la crédibilité scientifique.

**Inconvénient** : C++ → plus complexe à intégrer dans une API web. Nécessite un wrapper Python ou un microservice.

### 4.2.2 SOFA Framework — ★★★★☆ (RECOMMANDÉ pour la simulation temps réel)

| Critère | Détail |
|---|---|
| **Description** | Framework de simulation médicale temps réel, conçu pour la chirurgie virtuelle et l'entraînement |
| **Licence** | LGPL (open-source) |
| **Langage** | C++ (noyau) + Python binding (SofaPython3) |
| **Spécialisations** | Simulation temps réel, chirurgie virtuelle, haptique, déformation interactive |
| **FEM** | Éléments tétraédriques/hexaédriques co-rotationnels, hyperélastiques |
| **Haptique** | Intégration native (GeoMagic Touch, Haption) |
| **Communauté** | INRIA (France), consortium européen, 25+ ans de développement |
| **Performant** | GPU (CUDA/OpenCL), multithreading, temps réel <30ms/frame |
| **Spine** | Plugins existants pour simulation rachidienne |

**Avantage** : SOFA est LE standard pour la chirurgie virtuelle interactive. Il intègre nativement le haptique, le temps réel, et la découpe de maillage (ostéotomies). C'est exactement l'outil pour la partie « chirurgie virtuelle » de VERTEX.

**Inconvénient** : Courbe d'apprentissage importante. API Python via SofaPython3 mais plus lourd à déployer en Docker. La partie « simulation longitudinale sur 20 ans » n'est pas son point fort.

### 4.2.3 OpenSim — ★★★☆☆

| Critère | Détail |
|---|---|
| **Description** | Simulation musculosquelettique (Stanford/NIH) |
| **Licence** | Apache 2.0 |
| **Langage** | C++, MATLAB, Python, Java API |
| **Spécialisations** | Dynamique musculaire, cinématique inverse, modèles de marche |
| **Spine** | Modèles rachidiens disponibles mais pas le focus principal |

**Verdict** : Excellent pour la biomécanique dynamique (marche, posture), mais PAS adapté pour la simulation chirurgicale ni le FEM précis des vertèbres.

### 4.2.4 3D Slicer + SlicerIGT — ★★★☆☆

| Critère | Détail |
|---|---|
| **Description** | Plateforme d'imagerie médicale avec extensions simulation |
| **Licence** | BSD open-source |
| **Principaux usages** | Segmentation DICOM, planification chirurgicale, navigation |

**Verdict** : Excellent pour l'import DICOM et la segmentation, mais pas un solveur FEM. Complémentaire, pas un remplacement.

### 4.2.5 Rester en Julia avec FinEtools.jl / Ferrite.jl — ★★★★☆

| Critère | Détail |
|---|---|
| **FinEtools.jl** | FEM toolbox Julia, éléments volumiques, mécanique des solides, chaleur, acoustique |
| **Ferrite.jl** | FEM assembly toolkit Julia, plus bas niveau mais plus flexible |
| **Avantage** | Rester dans l'écosystème Julia, bonne performance, code lisible |
| **Inconvénient** | Communauté petite (~200-500 stars GitHub chacun), pas de validation clinique publiée pour le rachis |

**Verdict** : Si vous voulez rester en Julia, utiliser FinEtools.jl/Ferrite.jl (comme prévu dans les specs originales) serait déjà un progrès majeur par rapport au FEM maison actuel. Cela remplacerait ~1 500 lignes de code (mesh.jl, stiffness.jl, solver.jl) par des bibliothèques testées.

## 4.3 Alternatives commerciales pour le LMS + simulation

### 4.3.1 Osso VR — Concurrent direct

- Plateforme de formation chirurgicale VR, levée >$100M
- Partenariat avec J&J, Stryker
- Pas spécifique scoliose, mais couvre la chirurgie orthopédique
- **Leçon** : ils ont levé $100M+ avant d'avoir un produit complet → preuve que le marché existe

### 4.3.2 Touch Surgery (Medtronic)

- Racheté par Medtronic pour ~$100M
- Simulation procédurale étape par étape (pas FEM)
- Mobile/tablette → très accessible
- **Leçon** : le succès ne nécessite PAS un FEM sophistiqué. La valeur est dans le contenu et l'ergonomie.

### 4.3.3 Immersive Touch

- Simulation neurochirurgicale avec haptique
- Utilisé dans le training des résidents US
- Plus petit que Osso VR

## 4.4 Tableau comparatif des architectures possibles

| Architecture | Coût dev (18 mois) | Fidélité FEM | Temps réel | Haptique | Publication | Maintenance |
|---|---|---|---|---|---|---|
| **A. Statu quo (Julia maison)** | €50-100K (1-2 devs) | ⭐⭐ (poutre) | ⚠️ | ❌ | Faible crédibilité | Risque Julia niche |
| **B. Julia + FinEtools.jl** | €80-150K | ⭐⭐⭐ (volumique) | ⚠️ | ❌ | Correcte | Risque Julia |
| **C. FEBio (backend) + Vue/Three.js (frontend)** | €150-300K | ⭐⭐⭐⭐⭐ | ⚠️ | Via SOFA | Excellent (NIH validated) | Communauté solide |
| **D. SOFA (engine) + Vue/Three.js** | €200-400K | ⭐⭐⭐⭐ | ✅ | ✅ natif | Bonne (INRIA) | Bonne |
| **E. FEBio (calcul) + SOFA (interaction) + Vue/Three.js** | €300-500K | ⭐⭐⭐⭐⭐ | ✅ | ✅ | Excellent | Complexe mais résilient |
| **F. Julia longitudinal + FEBio chirurgie** (hybride) | €120-250K | ⭐⭐⭐⭐⭐ | Partiel | Via plugin | Excellent | Bonne |

---

# 5. RECOMMANDATION ARCHITECTURALE

## 5.1 Architecture recommandée : **Option F — Hybride Julia + FEBio**

Garder le meilleur de chaque monde :

```
┌─────────────────────────────────────────────────────────────────┐
│                       FRONTEND (Web)                             │
│  Vue.js 3 + Three.js (WebGL 2.0) + Pinia                       │
│  Rendu 3D des modèles rachidiens, UI interactive                │
└────────────────────┬───────────────────────────────┬────────────┘
                     │ REST/WebSocket                │ REST
     ┌───────────────▼──────────┐    ┌───────────────▼────────────┐
     │   API Gateway (FastAPI)  │    │   Moodle LMS (LTI 1.3)     │
     │   Python — orchestrateur │    │   Contenu + Quiz + Certif   │
     └──────┬──────────┬────────┘    └────────────────────────────┘
            │          │
   ┌────────▼───┐  ┌───▼───────────────┐
   │ Module A   │  │ Module B          │
   │ Julia      │  │ FEBio (C++)       │
   │ Simulation │  │ Chirurgie         │
   │ longitud.  │  │ virtuelle         │
   │ (ressort   │  │ Maillage          │
   │  spiral)   │  │ tétraédrique      │
   │ HTTP.jl    │  │ Matériaux bio     │
   │            │  │ Vis/tiges/ostéot. │
   └────────────┘  └───────────────────┘
            │          │
   ┌────────▼──────────▼───────────────┐
   │        Data Layer                  │
   │  PostgreSQL 17 │ Redis │ S3/MinIO │
   └────────────────────────────────────┘
```

### Justification

1. **Module A (Julia) = garder tel quel** : la simulation longitudinale du ressort spiral est VALIDÉE et CALIBRÉE. C'est la pièce maîtresse scientifique. Garder Julia ici est parfaitement justifié (calcul scientifique = force de Julia).

2. **Module B (FEBio) = remplacer le FEM maison** : pour la chirurgie virtuelle (vis pédiculaires, tiges, ostéotomies), utiliser FEBio via FEBioPy (Python API). Cela apporte :
   - Maillage tétraédrique 3D (vs poutre)
   - 50+ modèles de matériaux biologiques validés
   - Crédibilité scientifique (100+ publications)
   - Suppression de ~1 500 lignes de FEM maison

3. **API Gateway en Python (FastAPI)** : orchestrer les deux modules, gérer l'auth, les sessions, la queue de calcul. Python = pool de recrutement 100× plus grand que Julia.

4. **Frontend Vue.js/Three.js** : garder, mais enrichir avec des modèles 3D GLB/GLTF anatomiquement précis.

5. **Moodle LMS** : garder, connexion via LTI 1.3.

### Ce que cela change

| Aspect | Avant (Julia maison) | Après (Hybride) |
|---|---|---|
| Fidélité FEM chirurgical | Poutres 23 nœuds | Tétra 10 000+ nœuds (FEBio) |
| Validation scientifique | Auto-calibration | FEBio = standard NIH |
| Crédibilité publication | Faible | Forte (« validated using FEBio ») |
| Pool de recrutement | Julia niche | Python + C++ = mainstream |
| Maintenance | 1 personne (risque bus factor) | Communauté FEBio |
| Simulation longitudinale | ✅ Garde Julia | ✅ Identique |
| Coût dev supplémentaire | — | +€50-100K pour l'intégration FEBio |

## 5.2 Architecture alternative simplifiée (si budget limité) : **Option B — Julia + FinEtools.jl**

Si le budget ne permet pas FEBio, au minimum remplacer le FEM maison par FinEtools.jl/Ferrite.jl :

```julia
# Avant (maison) — mesh.jl + stiffness.jl + solver.jl = ~500 lignes
K = beam_stiffness_matrix(elem)  # Poutre 12×12 codée à la main

# Après (FinEtools.jl) — 50 lignes
using FinEtools
using FinEtoolsDeforLinear
fens, fes = import_mesh("vertebra.inp")  # maillage Abaqus/Gmsh
geom = NodalField(fens)
u = NodalField(zeros(size(fens.xyz, 1), 3))
material = MatDeforElastIso(E, nu)
femm = FEMMDeforLinearESNICET4(IntegDomain(fes, TetRule(1)), material)
K = stiffness(femm, geom, u)
```

Cela améliorerait considérablement la fidélité des résultats avec un effort minimal.

---

# 6. CAHIER DES CHARGES COMPLET RÉVISÉ

## 6.1 Vision produit

### 6.1.1 Énoncé de vision

> **VERTEX©** est la première plateforme francophone de formation certifiante sur la scoliose, combinant un contenu pédagogique de niveau chirurgien spécialiste avec un simulateur biomécanique interactif basé sur les éléments finis. Sa valeur unique est la simulation longitudinale de la « théorie du ressort spiral », une hypothèse originale sur l'étiologie de la scoliose idiopathique.

### 6.1.2 Proposition de valeur unique (USP)

1. **Théorie du ressort spiral** : seule plateforme proposant une simulation de l'étiologie de la scoliose idiopathique → valeur scientifique et de publication
2. **Formation exhaustive** : 29 modules × 89h couvrant 100% de la scoliose (aucune autre offre FR aussi complète)
3. **Simulateur interactif** : placement de vis, correction, visualisation 3D → entraînement chirurgical sans risque

## 6.2 Périmètre fonctionnel

### 6.2.1 Composant 1 — Formation en ligne (LMS)

| Fonctionnalité | Description | Priorité |
|---|---|---|
| F-LMS-01 | 29 modules de contenu structuré (texte, images, vidéos, animations 3D) | P0 |
| F-LMS-02 | Quiz progressifs 4 niveaux (Bronze → Diamant), 600+ questions | P0 |
| F-LMS-03 | Progression séquentielle configurable (seuil ≥70%) avec option test-out | P0 |
| F-LMS-04 | 3 parcours (Essentiel 25h / Chirurgical 55h / Intégral 89h) + modules à la carte | P0 |
| F-LMS-05 | Dashboard apprenant (progression, scores, radar de compétences) | P1 |
| F-LMS-06 | Dashboard formateur/tuteur (cohorte, alertes, statistiques) | P1 |
| F-LMS-07 | Forum de discussion par module | P1 |
| F-LMS-08 | Webinaires live intégrés (BBB / Zoom) | P2 |
| F-LMS-09 | Certification + proctoring en ligne | P2 |
| F-LMS-10 | Paiement en ligne (Stripe) + facturation DPC | P1 |
| F-LMS-11 | SSO SAML 2.0 / OAuth2 pour institutions | P2 |
| F-LMS-12 | Assistant IA contextuel (RAG sur le contenu de formation) | P3 |
| F-LMS-13 | Mode hors-ligne PWA | P3 |
| F-LMS-14 | Internationalisation (FR, EN) | P2 |
| F-LMS-15 | Conformité RGPD + hébergement HDS | P1 |
| F-LMS-16 | Tarif étudiant -50% + paiement en mensualités | P1 |

### 6.2.2 Composant 2 — VERTEX© Simulation longitudinale (Ressort spiral)

| Fonctionnalité | Description | Priorité |
|---|---|---|
| F-SIM-01 | Simulation longitudinale 1-20 ans avec paramètres configurables | P0 ✅ |
| F-SIM-02 | 9 configurations d'asymétrie (symétrique, wedging 1-3°, ligaments, disque, combinées) | P0 ✅ |
| F-SIM-03 | Lois physiques : Hueter-Volkmann, Wolff, Miner, fluage, flambage Euler | P0 ✅ |
| F-SIM-04 | Profil de croissance sexe-dépendant avec pic pubertaire | P0 ✅ |
| F-SIM-05 | API REST pour lancement et récupération des résultats | P0 ✅ |
| F-SIM-06 | Visualisation temporelle 3D (time-lapse de la déformation progressive) | P1 |
| F-SIM-07 | Export des résultats en PDF/CSV | P2 |
| F-SIM-08 | FEM dynamique : ligaments/disques initiateurs de scoliose (Phase 2) | P2 |
| F-SIM-09 | Rotation axiale (gibbosité) dans la simulation | P2 |
| F-SIM-10 | Validation clinique : comparaison avec données radiographiques réelles | P1 |

### 6.2.3 Composant 3 — VERTEX© Chirurgie virtuelle

| Fonctionnalité | Description | Priorité |
|---|---|---|
| F-CHIR-01 | Modèle 3D anatomique interactif du rachis (GLB/GLTF, rotation, zoom, coupe) | P0 |
| F-CHIR-02 | 7 pathologies simulables (scoliose, fracture, hernie, spondylo, sténose, tumeur, déformité adulte) | P0 ✅ API |
| F-CHIR-03 | Placement de vis pédiculaires (trajectoire, diamètre, longueur) | P1 |
| F-CHIR-04 | Insertion et pliage de tiges | P1 |
| F-CHIR-05 | Manœuvres de correction (dérotation, translation, compression/distraction) | P1 |
| F-CHIR-06 | Mesures angulaires (Cobb, cyphose, lordose, SVA) | P0 |
| F-CHIR-07 | 5 cas cliniques guidés (Lenke 1, 2, 5, neuromusculaire, adulte dégénératif) | P1 |
| F-CHIR-08 | Score et évaluation du geste chirurgical | P2 |
| F-CHIR-09 | Ostéotomies (SPO, PSO, VCR) | P2 |
| F-CHIR-10 | Import DICOM patient-spécifique | P3 |
| F-CHIR-11 | Mode VR/XR (WebXR, Meta Quest) | P3 |
| F-CHIR-12 | Retour haptique | P3 |
| F-CHIR-13 | Migration vers FEBio (maillage tétraédrique, matériaux validés) | P1 |

### 6.2.4 Composant 4 — Module Administration

| Fonctionnalité | Description | Priorité |
|---|---|---|
| F-ADM-01 | RBAC (Super Admin, Admin, Gestionnaires, Tuteur, Auditeur) | P0 |
| F-ADM-02 | Dashboard KPI (inscriptions, CA, taux de complétion, NPS) | P1 |
| F-ADM-03 | Gestion des abonnements et licences | P1 |
| F-ADM-04 | Gestion financière (revenus, remboursements, facturation) | P1 |
| F-ADM-05 | Gestion examens et certifications | P2 |
| F-ADM-06 | Audit trail (logging de toutes les actions admin) | P1 |
| F-ADM-07 | API d'administration (REST + GraphQL) | P2 |
| F-ADM-08 | Conformité et exports RGPD | P1 |

## 6.3 Exigences non fonctionnelles

### 6.3.1 Performance

| Métrique | Objectif | Mesure |
|---|---|---|
| TTFB (Time To First Byte) | < 200 ms | Synthetics |
| LCP (Largest Contentful Paint) | < 2.5s | Lighthouse |
| Temps de réponse API p95 | < 500 ms (REST), < 200 ms (WebSocket) | APM |
| Temps lancement simulation longitudinale (10 ans) | < 2s | Benchmark |
| Temps chargement modèle 3D | < 5s | RUM |
| Sessions FEM simultanées | ≥ 20 (Phase 1), ≥ 100 (Phase 3) | Load test |
| Uptime | 99.5% (Phase 1), 99.9% (Phase 3) | Monitoring |

### 6.3.2 Sécurité

| Exigence | Détail |
|---|---|
| Chiffrement en transit | TLS 1.3 obligatoire |
| Chiffrement au repos | AES-256 pour les données sensibles + DICOM |
| Authentification | OAuth2/OIDC + MFA pour admin et examen |
| Autorisation | RBAC avec matrice de permissions |
| Audit | Logging de toutes les actions modifiantes |
| Conformité | RGPD (EU), HDS (hébergement santé France) |
| HIPAA | Phase 2 (si expansion US) |
| Pen testing | Annuel (prestataire PASSI) |

### 6.3.3 Accessibilité

| Exigence | Détail |
|---|---|
| WCAG | 2.1 niveau AA |
| Navigateurs | Chrome 90+, Firefox 90+, Edge 90+, Safari 16+ |
| Mobile | Responsive, PWA (hors 3D VERTEX) |
| GPU client minimum | WebGL 2.0 (Intel HD 620+, Apple M1+) |

### 6.3.4 Scalabilité

| Phase | Utilisateurs cibles | Architecture |
|---|---|---|
| Phase 1 (An 1) | 100-400 | Docker Compose sur 1 serveur |
| Phase 2 (An 2-3) | 400-1 500 | Kubernetes 3 nœuds + 1 GPU |
| Phase 3 (An 4-5) | 1 500-5 000 | K8s multi-nœuds, auto-scaling, CDN |

## 6.4 Stack technologique retenu

| Couche | Technologie | Justification |
|---|---|---|
| **Frontend** | Vue.js 3 + Nuxt 3 (SSR) | Performance, SEO, écosystème riche |
| **Rendu 3D** | Three.js + WebGL 2.0 | Standard, large communauté |
| **Backend API** | Python FastAPI | Performance async, pool recrutement large, typage |
| **Simulation longitudinale** | Julia (HTTP.jl) — microservice | Performance calcul, code existant validé |
| **FEM chirurgical** | FEBio (C++) via FEBioPy ou Julia + FinEtools.jl (fallback) | Validation clinique, matériaux bio |
| **LMS** | Moodle 4.x + plugins custom | Open-source, LTI 1.3 natif, communauté massive, DPC compatible |
| **Base de données** | PostgreSQL 17 | Relationnel robuste, JSON natif |
| **Cache** | Redis 7 | Sessions, rate limiting, queue |
| **Stockage objets** | MinIO (dev) / S3 (prod) | Vidéos, modèles 3D, DICOM |
| **Search** | Meilisearch ou Elasticsearch | Recherche full-text dans le contenu |
| **CI/CD** | GitHub Actions | Build, test, deploy automatisés |
| **Conteneurisation** | Docker + Docker Compose (Phase 1) → K8s (Phase 2+) | Reproductibilité, scaling |
| **Monitoring** | Prometheus + Grafana + Sentry | Métriques, alertes, error tracking |
| **Hébergement** | OVHcloud HDS (France) ou Scaleway | Conformité HDS, proximité, coût |

## 6.5 Modèle de données (entités principales)

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│    User      │────▶│ Enrollment   │────▶│   Course     │
│ id, email    │     │ progress,    │     │ 29 modules   │
│ role, rpps   │     │ score        │     │ sections     │
│ institution  │     │              │     │ medias       │
└──────────────┘     └──────────────┘     └──────────────┘
       │                                         │
       │                                         │
       ▼                                         ▼
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│ Subscription │     │  QuizAttempt │     │   Question   │
│ plan, dates  │     │ score, time  │     │ level, type  │
│ stripe_id    │     │ answers      │     │ explanation  │
└──────────────┘     └──────────────┘     └──────────────┘
       │
       ▼
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│  Payment     │     │ VertexSession│     │ Certificate  │
│ amount, date │     │ spine_model  │     │ exam_score   │
│ method       │     │ scenario     │     │ date_issued  │
│ invoice_id   │     │ score        │     │ qr_code      │
└──────────────┘     └──────────────┘     └──────────────┘
```

## 6.6 Intégrations externes

| Système | Protocole | Usage | Priorité |
|---|---|---|---|
| Moodle LMS | LTI 1.3 + xAPI | Intégration VERTEX dans le cours | P0 |
| Stripe | API REST + webhooks | Paiement CB, facturation | P1 |
| ANDPC / DPC | API DPC | Déclaration formation continue | P2 |
| SendGrid / SES | SMTP API | Emails transactionnels | P1 |
| BigBlueButton | API REST | Webinaires live | P2 |
| Matomo | JS tracking | Analytics RGPD-compliant | P1 |
| FEBio | CLI / FEBioPy | Calcul FEM chirurgical | P1 |

## 6.7 Critères de recette

### Phase 1 (MVP — Mois 12)
- [ ] 10 modules de contenu complets et importés dans Moodle
- [ ] Quiz fonctionnels (150+ questions, 4 niveaux)
- [ ] Simulation longitudinale accessible depuis le LMS (LTI)
- [ ] Visualisation 3D du rachis (modèle GLB, rotation, mesures)
- [ ] Inscription + paiement (Stripe) fonctionnels
- [ ] Déploiement sur serveur HDS OVH/Scaleway
- [ ] 20 beta-testeurs (chirurgiens) avec feedback collecté

### Phase 2 (Version complète — Mois 22)
- [ ] 29 modules complets
- [ ] 600+ questions de quiz
- [ ] Chirurgie virtuelle basique (vis, tiges, correction)
- [ ] 5 cas cliniques guidés
- [ ] Dashboard formateur opérationnel
- [ ] DPC/ANDPC demandé
- [ ] Certification avec proctoring

### Phase 3 (Version avancée — Mois 36)
- [ ] Ostéotomies (SPO, PSO, VCR)
- [ ] Import DICOM
- [ ] Mode VR (WebXR)
- [ ] Assistant IA (RAG)
- [ ] 1 000+ apprenants actifs
- [ ] Publication scientifique sur la théorie du ressort spiral

---

# 7. ROADMAP DÉTAILLÉE

## 7.1 Phasage stratégique (3 phases, 36 mois)

```
PHASE 0 — VALIDATION (Mois 0-3)
═══════════════════════════════════════════════════
  Validation marché + décision Go/No-Go
  Coût : €10-30K | Équipe : porteur + 1 assistant

PHASE 1 — MVP FORMATION + SIMULATION (Mois 4-15)
═══════════════════════════════════════════════════
  Formation en ligne avec simulateur longitudinal intégré
  Coût : €150-250K | Équipe : 3-5 personnes

PHASE 2 — CHIRURGIE VIRTUELLE + CERTIFICATION (Mois 12-24)
═══════════════════════════════════════════════════
  Module chirurgical (FEBio), certification, scaling
  Coût : €200-400K | Équipe : 5-8 personnes

PHASE 3 — INNOVATION + INTERNATIONAL (Mois 24-36)
═══════════════════════════════════════════════════
  VR, DICOM, IA, international, SaMD optionnel
  Coût : €300-600K | Équipe : 8-12 personnes
```

## 7.2 Phase 0 — Validation marché (Mois 0-3, €10-30K)

**Objectif** : Confirmer le Product-Market Fit AVANT tout développement coûteux.

| Mois | Sprint | Livrables | Responsable |
|---|---|---|---|
| M0-1 | Interviews | 40 interviews chirurgiens du rachis (FR, BE, CH, Maghreb) | Porteur |
| M0-1 | Landing page | Site vitrine avec pré-inscription email | Dev freelance |
| M1-2 | Test pricing | Test Gabor-Granger sur 3 segments (interne, résident, confirmé) | Porteur |
| M1-2 | Prototype | Prototype Figma cliquable de VERTEX (5 écrans) | UX designer |
| M2-3 | Démo live | Demo de la simulation longitudinale à 10 chirurgiens | Porteur |
| M3 | **Go/No-Go** | **Décision basée sur : ≥500 pré-inscrits, ≥30/40 interviews positives, pricing validé** | Porteur |

### KPI de validation

| Indicateur | Seuil Go | Seuil No-Go |
|---|---|---|
| Pré-inscriptions email | ≥ 500 | < 200 |
| Interviews « j'achèterais » | ≥ 75% (30/40) | < 50% |
| NPS du prototype | ≥ 40 | < 20 |
| Pricing accepté (certification) | ≥ €800 médian | < €400 |

## 7.3 Phase 1 — MVP Formation + Simulation (Mois 4-15, €150-250K)

### Objectif
Lancer une formation fonctionnelle avec les modules les plus attractifs + la simulation longitudinale intégrée.

### Équipe Phase 1 (3-5 personnes)

| Rôle | Profil | Temps |
|---|---|---|
| **Porteur / Expert médical** | Dr Arya D. — contenu, validation, cas cliniques | 50% |
| **Développeur fullstack** | Vue.js + Python FastAPI + Docker | 100% |
| **Développeur Julia** (partiel) | Maintenance simulation + API | 30% |
| **UX/UI designer** | Design LMS, visualisation 3D | 50% (6 mois) |
| **Ingénieur pédagogique** | Structure contenu Moodle, quiz, SCORM | 50% (6 mois) |

### Sprint plan Phase 1

| Mois | Sprint | Livrables |
|---|---|---|
| **M4** | Infrastructure | Docker Compose production (Moodle + VERTEX + PostgreSQL + Redis), CI/CD GitHub Actions, domaine + SSL |
| **M4-5** | Auth + Paiement | Inscription, authentification OAuth2, profils, intégration Stripe |
| **M5-6** | Contenu Partie I | Modules 1-3 complets (anatomie, embryologie, biomécanique) — rédaction + médias BioRender |
| **M6-7** | Quiz engine | Plugin quiz Moodle : 4 niveaux, QCM, QCS, images, feedback immédiat |
| **M7-8** | Contenu Partie II | Modules 4-7 (définitions, classifications, examen clinique, imagerie) |
| **M8-9** | VERTEX integration | LTI 1.3 : simulation longitudinale accessible depuis Moodle, visualisation 3D des résultats |
| **M9-10** | Contenu Partie III | Modules 8-10 (SIA, infantile/juvénile, adulte) — le cœur de la formation |
| **M10** | Dashboards | Dashboard apprenant (progression, scores) + Dashboard formateur basique |
| **M11** | Beta privée | 20-30 chirurgiens testeurs, collecte feedback |
| **M12** | Corrections beta | Intégration retours, correction contenu et bugs |
| **M13** | Contenu Parties IV-V | Modules 11-17 (pathologies + techniques chirurgicales) |
| **M14** | Médias | Production de 200+ médias (infographies, animations, vidéos) |
| **M15** | **🚀 Lancement MVP** | Ouverture publique, marketing, 10 modules complets minimum |

### KPI Phase 1

| Indicateur | Objectif M15 |
|---|---|
| Modules complets | ≥ 10 |
| Questions quiz | ≥ 200 |
| Beta-testeurs satisfaits | ≥ 80% (NPS > 40) |
| Pré-inscrits convertis | ≥ 50 payants |
| Uptime | ≥ 99% |

## 7.4 Phase 2 — Chirurgie virtuelle + Certification (Mois 12-24, €200-400K)

### Objectif
Ajouter la chirurgie virtuelle avec FEBio, compléter les 29 modules, obtenir l'agrément DPC, lancer la certification.

### Équipe Phase 2 (5-8 personnes, en plus de Phase 1)

| Rôle supplémentaire | Profil | Temps |
|---|---|---|
| **Développeur FEM / C++** | Intégration FEBio, modèles vertébraux | 100% |
| **Développeur 3D / WebGL** | Modèles 3D anatomiques, interactions chirurgicales | 100% |
| **Rédacteur médical** | Modules 18-29 + quiz | 80% |
| **DevOps** | Kubernetes, monitoring, scaling | 50% |

### Sprint plan Phase 2

| Mois | Sprint | Livrables |
|---|---|---|
| **M12-13** | FEBio setup | Installation FEBio en Docker, maillage tétraédrique d'une vertèbre, premier solve |
| **M14-15** | Modèles 3D | Modèles GLB/GLTF anatomiques (vertèbres, disques, ligaments) pour le frontend |
| **M15-16** | Vis pédiculaires | Placement de vis dans FEBio (trajectoire, contact os-implant), visualisation Three.js |
| **M16-17** | Tiges + correction | Insertion de tiges, manœuvres de correction (dérotation, translation) |
| **M17-18** | Contenu Parties VI-VIII | Modules 18-27 (complications, rééducation, dépistage, recherche) |
| **M18-19** | Module 28-29 | VERTEX© module pédagogique + évaluation certifiante |
| **M19-20** | Cas cliniques | 5 cas cliniques guidés avec scénarios FEBio |
| **M20** | Certification | Examen de certification : proctoring, notation, certificat numérique |
| **M20-21** | DPC | Dossier ANDPC, agrément organisme de formation |
| **M21-22** | Scaling | Migration K8s, CDN pour vidéos, optimisation performance |
| **M22-23** | Beta chirurgie | Beta du module chirurgical avec 50 utilisateurs |
| **M24** | **🚀 V2.0 complète** | 29 modules + chirurgie virtuelle + certification |

### KPI Phase 2

| Indicateur | Objectif M24 |
|---|---|
| Modules complets | 29 |
| Questions quiz | ≥ 600 |
| Cas cliniques VERTEX | ≥ 5 |
| Apprenants actifs | ≥ 400 |
| CA annuel | ≥ €200K |
| Agrément DPC | Obtenu |

## 7.5 Phase 3 — Innovation + International (Mois 24-36, €300-600K)

### Sprint plan Phase 3

| Mois | Sprint | Livrables |
|---|---|---|
| **M24-26** | Ostéotomies | SPO, PSO, VCR dans FEBio + frontend |
| **M26-28** | Publication | Article scientifique « théorie du ressort spiral » dans Spine ou JBJS |
| **M27-29** | Assistant IA | RAG LLM sur le contenu de formation (questions/réponses contextuelles) |
| **M28-30** | DICOM import | Import CT-scan, segmentation automatique, modèle patient-spécifique |
| **M30-32** | VR/XR | WebXR pour Meta Quest, mode immersif chirurgie |
| **M32-34** | Internationalisation | Traduction anglaise des modules + adaptation culturelle |
| **M34-36** | Partenariats | Intégration avec AO Spine, fabricants d'implants (Medtronic, DePuy) |
| **M36** | Bilan | Évaluation : pivot vers SaMD (marquage CE) ou maintien « educational only » |

### KPI Phase 3

| Indicateur | Objectif M36 |
|---|---|
| Apprenants actifs | ≥ 1 500 |
| CA annuel | ≥ €1M |
| Publications scientifiques | ≥ 1 (peer-reviewed) |
| NPS | ≥ 55 |
| Pays couverts | ≥ 5 (FR, BE, CH, CA, Maghreb) |

## 7.6 Gantt simplifié (36 mois)

```
TÂCHE                              M1-3    M4-6    M7-9   M10-12  M13-15  M16-18  M19-21  M22-24  M25-27  M28-30  M31-33  M34-36
═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════
PHASE 0 — VALIDATION
  Interviews + landing page         ██████
  Go/No-Go                                ★

PHASE 1 — MVP FORMATION
  Infrastructure + Auth                     ██████
  Contenu Parties I-III                     ████████████████
  Quiz engine                                      ██████
  Intégration VERTEX longit.                               ██████
  Contenu Parties IV-V                                             ██████████████
  Beta + corrections                                               ██████████████
  🚀 LANCEMENT MVP                                                         ★

PHASE 2 — CHIRURGIE VIRTUELLE
  Intégration FEBio                                        ████████████████
  Modèles 3D anatomiques                                          ████████████████
  Vis + tiges + correction                                                ████████████████
  Contenu Parties VI-VIII                                                 ████████████████
  Certification + DPC                                                             ████████████████
  🚀 V2.0 COMPLÈTE                                                                         ★

PHASE 3 — INNOVATION
  Ostéotomies                                                                               ██████████████
  Publication scientifique                                                                  ████████████████████████
  IA + DICOM + VR                                                                                   ████████████████████████
  International                                                                                                     ████████████████
═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════
```

## 7.7 Budget révisé (approche phasée)

| Phase | Durée | Coût estimé | Financement |
|---|---|---|---|
| **Phase 0** | 3 mois | €10-30K | Fonds propres |
| **Phase 1** | 12 mois | €150-250K | Fonds propres + BPI (bourse French Tech) + CIR |
| **Phase 2** | 12 mois | €200-400K | Revenus Phase 1 + investisseurs seed (€200-500K) |
| **Phase 3** | 12 mois | €300-600K | Revenus + série A (€1-3M) ou partenariats industriels |
| **TOTAL** | **36 mois** | **€660K-1,28M** | — |

### Comparaison avec le budget initial

| Aspect | Budget initial | Budget révisé | Économie |
|---|---|---|---|
| VERTEX dev | €3,6-5M (11-12 devs, 40 mois) | €250-500K (FEBio + Julia, 2-3 devs) | **-85%** |
| LMS | €300-500K (custom) | €50-100K (Moodle + plugins) | **-75%** |
| Contenu | €180-280K | €100-200K | **-30%** |
| Médias | €250-400K | €80-150K (BioRender/Runway/HeyGen = tools IA) | **-60%** |
| **TOTAL** | **€4,7-6,8M** | **€660K-1,28M** | **-80%** |

La différence fondamentale : **ne pas réinventer FEBio** (utiliser l'existant), **ne pas réinventer Moodle** (customiser l'existant), et **utiliser les outils IA pour les médias** (BioRender, Runway Gen-3, HeyGen) au lieu de tourner en studio.

---

# 8. ANNEXES

## 8.1 Matrice de risques révisée

| # | Risque | Probabilité | Impact | Mitigation |
|---|---|---|---|---|
| R-01 | Validation marché négative | 30% | 🔴 Fatal | Phase 0 = kill switch à €20K max |
| R-02 | FEBio : courbe d'apprentissage > prévue | 40% | 🟠 Retard 3 mois | Fallback : FinEtools.jl en Julia (déjà maîtrisé) |
| R-03 | Churn élevé (>5%/mois) | 50% | 🟠 Revenus -40% | Webinaires mensuels, VERTEX gamifié, DPC annuel |
| R-04 | AO Spine lance un concurrent | 20% | 🟠 Parts de marché | Positionner VERTEX comme complément, pas concurrent |
| R-05 | Développeur Julia indisponible | 30% | 🟡 Retard Phase 2 | Code documenté, migration possible vers Python NumPy/SciPy |
| R-06 | Réglementation SaMD imposée | 15% | 🔴 +€200K +12 mois | Phase 1-2 = « educational only » avec disclaimer strict |
| R-07 | Obtention agrément DPC retardée | 40% | 🟡 Revenus FR -20% | Lancé dès Phase 1, contenu validé par comité expert |
| R-08 | Performance 3D insuffisante sur GPU intégré | 25% | 🟡 UX dégradée | Mode simplifié (wireframe), streaming GPU cloud fallback |
| R-09 | Turnover développeur fullstack | 30% | 🟠 Retard 2-3 mois | Documentation, code review, rétention (equity) |
| R-10 | Théorie du ressort spiral réfutée | 10% | 🟡 Valeur scientifique | Le simulateur reste utile pédagogiquement indépendamment |

## 8.2 Références des alternatives FEM

| Outil | URL | Licence | Dernière release |
|---|---|---|---|
| **FEBio** | https://febio.org | MIT | 4.x (2024) |
| **SOFA** | https://www.sofa-framework.org | LGPL | 24.06 (2024) |
| **OpenSim** | https://opensim.stanford.edu | Apache 2.0 | 4.5 (2024) |
| **3D Slicer** | https://slicer.org | BSD | 5.6 (2024) |
| **FinEtools.jl** | https://github.com/PetrKryslUCSD/FinEtools.jl | MIT | v8.x |
| **Ferrite.jl** | https://github.com/Ferrite-FEM/Ferrite.jl | MIT | v1.0 |
| **FEBioPy** | https://github.com/febiosoftware/FEBioPy | MIT | v0.x |

## 8.3 Glossaire

| Terme | Définition |
|---|---|
| **FEM** | Finite Element Method — méthode des éléments finis |
| **FEBio** | Finite Elements for Biomechanics — framework FEM spécialisé bio |
| **SOFA** | Simulation Open Framework Architecture |
| **LMS** | Learning Management System |
| **LTI** | Learning Tools Interoperability (norme de connexion LMS ↔ outil) |
| **xAPI** | Experience API (Tin Can) — norme de traces d'apprentissage |
| **SaMD** | Software as a Medical Device |
| **DPC** | Développement Professionnel Continu |
| **MVS** | Minimum Viable Simulator |
| **MVP** | Minimum Viable Product |
| **GLB/GLTF** | GL Transmission Format — format 3D standard pour le web |
| **RAG** | Retrieval-Augmented Generation — IA contextuelle |
| **HDS** | Hébergement de Données de Santé |

## 8.4 Décisions architecturales (ADR)

### ADR-001 : Garder Julia pour la simulation longitudinale
- **Contexte** : Le module de simulation longitudinale (ressort spiral) est validé et calibré en Julia (~1 910 lignes)
- **Décision** : Garder Julia (HTTP.jl) comme microservice dédié
- **Justification** : Code validé, résultats calibrés, réécrire coûterait >2 mois sans valeur ajoutée
- **Conséquence** : 2 langages backend (Python + Julia) → Docker Compose gère

### ADR-002 : Utiliser FEBio au lieu de FEM maison pour la chirurgie
- **Contexte** : Le FEM maison (poutre Euler-Bernoulli, 23 nœuds) est insuffisant pour la chirurgie virtuelle
- **Décision** : Intégrer FEBio via FEBioPy pour le module chirurgical
- **Alternative rejetée** : Coder un solveur tétraédrique 3D en Julia (coût estimé : 6-12 mois, risque élevé)
- **Conséquence** : +1 dépendance C++ dans Docker, mais validation clinique acquise

### ADR-003 : Moodle plutôt que LMS custom
- **Contexte** : Le CdC LMS initial spécifie des fonctionnalités que Moodle 4.x couvre à 90%
- **Décision** : Moodle 4.x + 4-5 plugins custom (VERTEX LTI, quiz 4 niveaux, analytics, paiement)
- **Alternative rejetée** : LMS custom (Node.js/Django) — coût ×3-5, délai ×2, risque ×3
- **Conséquence** : Quelques compromis UX mais time-to-market divisé par 2

### ADR-004 : Python FastAPI comme API Gateway
- **Contexte** : Julia (HTTP.jl) seul ne gère pas l'auth, les sessions, le rate limiting
- **Décision** : FastAPI en front des microservices Julia et FEBio
- **Justification** : Pool de recrutement 100×, middleware mature (auth, CORS, OpenAPI doc auto)

---

*Cahier des charges complet V2 — Projet Formation Scoliose + VERTEX©*
*Date : 3 mars 2026 — Analyse exhaustive de 14 fichiers (10 200+ lignes) + code source (~4 000 lignes Julia, ~400 lignes Vue.js)*
