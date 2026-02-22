# SPINESIM© — SPÉCIFICATIONS TECHNIQUES DE L'APPLICATION
## Application de simulation biomécanique du rachis et chirurgie virtuelle
### Document de spécifications pour le développement

---

## 1. VISION ET OBJECTIFS

### 1.1 Vision produit
SpineSim© est une application de simulation biomécanique du rachis et de chirurgie virtuelle, développée spécifiquement pour la formation des chirurgiens orthopédistes et neurochirurgiens. Elle permet de simuler les contraintes mécaniques du rachis dans toutes les situations physiologiques et pathologiques, et d'apprendre les voies d'abord et techniques chirurgicales dans un environnement virtuel réaliste et sans risque.

### 1.2 Objectifs pédagogiques
1. **Comprendre** la biomécanique rachidienne par manipulation interactive 3D
2. **Visualiser** les contraintes et déformations dans toutes les pathologies
3. **Planifier** des corrections chirurgicales et en prédire les résultats
4. **Pratiquer** les voies d'abord chirurgicales en environnement virtuel
5. **Maîtriser** les techniques d'instrumentation (vis, tiges, ostéotomies)
6. **Évaluer** les résultats de différentes stratégies chirurgicales

### 1.3 Public cible
- Internes en chirurgie orthopédique (apprentissage des fondamentaux)
- Résidents et CCA (pratique des gestes chirurgicaux)
- Chirurgiens confirmés (planification préopératoire, cas complexes)
- Chercheurs en biomécanique rachidienne

---

## 2. ARCHITECTURE TECHNIQUE

### 2.1 Vue d'ensemble de l'architecture

```
┌─────────────────────────────────────────────────────────┐
│                    FRONTEND (Client)                     │
│                                                          │
│  ┌──────────┐  ┌───────────┐  ┌──────────────────────┐  │
│  │  Vue.js / │  │  Three.js  │  │  WebXR API           │  │
│  │  React    │  │  (WebGL)   │  │  (VR/AR)             │  │
│  │  UI Layer │  │  3D Render │  │  Immersive mode      │  │
│  └──────────┘  └───────────┘  └──────────────────────┘  │
│                      ↕ WebSocket / REST                   │
├─────────────────────────────────────────────────────────┤
│                    BACKEND (Serveur)                      │
│                                                          │
│  ┌──────────────────┐  ┌─────────────────────────────┐  │
│  │  Genie.jl         │  │  Moteur Biomécanique (Julia) │  │
│  │  API REST +       │  │  ┌─────────────────────┐    │  │
│  │  WebSocket        │  │  │  FEM Solver          │    │  │
│  │  Authentification │  │  │  (FinEtools/Ferrite) │    │  │
│  │  Session mgmt     │  │  ├─────────────────────┤    │  │
│  │                   │  │  │  Contact mechanics   │    │  │
│  │                   │  │  │  (implants-os)       │    │  │
│  │                   │  │  ├─────────────────────┤    │  │
│  │                   │  │  │  GPU acceleration    │    │  │
│  │                   │  │  │  (CUDA.jl)           │    │  │
│  │                   │  │  └─────────────────────┘    │  │
│  └──────────────────┘  └─────────────────────────────┘  │
│                      ↕ Base de données                    │
├─────────────────────────────────────────────────────────┤
│                    DATA LAYER                             │
│                                                          │
│  ┌──────────┐  ┌───────────┐  ┌──────────────────────┐  │
│  │ PostgreSQL│  │  Redis     │  │  Stockage fichiers   │  │
│  │ (données) │  │  (cache)   │  │  (maillages, DICOM)  │  │
│  └──────────┘  └───────────┘  └──────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

### 2.2 Stack technologique détaillé

#### Backend — Julia (v1.10+)

| Composant | Package Julia | Rôle |
|-----------|--------------|------|
| **Serveur web** | `Genie.jl` | API REST, WebSocket, routing, sessions |
| **FEM Solver** | `FinEtools.jl` + `Ferrite.jl` | Éléments finis 3D, assemblage, résolution |
| **Maillage** | `Gmsh.jl` | Génération et raffinement de maillages 3D |
| **Algèbre linéaire** | `LinearAlgebra` (stdlib) + `SparseArrays` | Matrices creuses, décompositions |
| **GPU** | `CUDA.jl` + `KernelAbstractions.jl` | Accélération GPU NVIDIA |
| **Visualisation serveur** | `Makie.jl` + `WGLMakie.jl` | Rendu côté serveur, export WebGL |
| **Optimisation** | `Optim.jl` + `JuMP.jl` | Optimisation de paramètres, planification |
| **Statistiques** | `Distributions.jl` + `StatsBase.jl` | Modèles stochastiques, Monte-Carlo |
| **I/O médical** | `DICOM.jl` + custom | Importation CT-scan, segmentation |
| **Sérialisation** | `JSON3.jl` + `MsgPack.jl` | Communication client-serveur |
| **Tests** | `Test` (stdlib) + `BenchmarkTools.jl` | Tests unitaires, benchmarks |
| **Documentation** | `Documenter.jl` | Documentation API |

#### Frontend — JavaScript / TypeScript

| Composant | Technologie | Rôle |
|-----------|------------|------|
| **Framework UI** | Vue.js 3 / React 18 | Interface utilisateur réactive |
| **Rendu 3D** | Three.js + WebGL 2.0 | Rendu 3D dans le navigateur |
| **VR/AR** | WebXR API | Mode réalité virtuelle immersive |
| **Physique client** | Cannon.js / Ammo.js | Physique temps réel légère côté client |
| **Graphiques 2D** | D3.js + Chart.js | Graphiques de résultats, heatmaps |
| **État** | Pinia / Redux | Gestion d'état applicatif |
| **Communication** | Axios + Socket.io | REST + WebSocket temps réel |
| **Build** | Vite | Bundling et hot reload |

#### Infrastructure

| Composant | Technologie | Rôle |
|-----------|------------|------|
| **Base de données** | PostgreSQL 16 | Données patients virtuels, résultats, progression |
| **Cache** | Redis | Cache de calculs, sessions temps réel |
| **Stockage** | MinIO / S3 | Maillages 3D, fichiers DICOM, modèles |
| **Conteneurisation** | Docker + Docker Compose | Déploiement reproductible |
| **CI/CD** | GitHub Actions | Tests automatisés, déploiement |
| **Monitoring** | Prometheus + Grafana | Performance, usage |

---

## 3. MOTEUR BIOMÉCANIQUE — DÉTAIL TECHNIQUE (Julia)

### 3.1 Modèle vertébral par éléments finis

#### Structure de données d'une vertèbre

```julia
# Définition du type Vertebra
struct VertebralBody
    level::VertebralLevel           # C1..S1
    mesh::FEMesh{Tetrahedron}       # Maillage tétraédrique 3D
    cortical_bone::MaterialProperties   # E = 12-18 GPa, ν = 0.3
    cancellous_bone::MaterialProperties # E = 0.1-0.5 GPa, ν = 0.2
    density::Float64                # g/cm³ (lié au T-score DEXA)
    morphology::VertebralMorphology # dimensions, angles
end

struct VertebralMorphology
    body_width::Float64     # mm
    body_depth::Float64     # mm
    body_height::Float64    # mm
    pedicle_width::Float64  # mm (critique pour vis)
    pedicle_height::Float64 # mm
    canal_width::Float64    # mm
    canal_depth::Float64    # mm
    spinous_process_angle::Float64  # degrés
    facet_orientation::Float64      # sagittal vs frontal
end

# Propriétés mécaniques paramétrables
struct MaterialProperties
    youngs_modulus::Float64    # GPa
    poissons_ratio::Float64   # sans unité
    yield_stress::Float64     # MPa
    density::Float64          # g/cm³
    is_anisotropic::Bool
    anisotropy_ratio::Float64 # ratio E_axial / E_transverse
end
```

#### Propriétés mécaniques par structure

| Structure | Module de Young (GPa) | Coefficient de Poisson | Densité (g/cm³) |
|-----------|----------------------|----------------------|-----------------|
| Os cortical vertébral | 12-18 | 0.29-0.32 | 1.8-2.0 |
| Os spongieux vertébral | 0.1-0.5 | 0.20-0.25 | 0.1-0.4 |
| Os cortical pédicule | 10-15 | 0.30 | 1.7-1.9 |
| Cartilage plateau | 0.005-0.02 | 0.40-0.45 | 1.1 |
| Os ostéoporotique (T-score -3) | 0.05-0.15 | 0.25 | 0.08-0.2 |

### 3.2 Modèle du disque intervertébral

```julia
struct IntervertebralDisc
    level::DiscLevel              # C2C3..L5S1
    nucleus::NucleusPulposus
    annulus::AnnulusFibrosus
    endplates::Tuple{CartilaginousEndplate, CartilaginousEndplate}
    degeneration_grade::Int       # Pfirrmann I-V
end

struct NucleusPulposus
    mesh::FEMesh{Tetrahedron}
    # Modèle hyperélastique (Mooney-Rivlin)
    C10::Float64    # Pa - paramètre Mooney-Rivlin
    C01::Float64    # Pa
    bulk_modulus::Float64  # Pa (quasi-incompressible)
    pressure::Float64      # MPa (pression interne)
end

struct AnnulusFibrosus
    mesh::FEMesh{Tetrahedron}
    # Modèle fibre-renforcé
    ground_matrix::MaterialProperties  # E ≈ 0.5 MPa
    fiber_families::Vector{FiberFamily}
    num_layers::Int           # 10-15 couches concentriques
end

struct FiberFamily
    orientation::Float64      # angle ± 30° par rapport au plan horizontal
    stiffness::Float64        # N/mm²
    recruitment_strain::Float64  # déformation de recrutement
end
```

#### Dégénérescence discale paramétrable

| Grade Pfirrmann | Hauteur disco | Pression nucleus | Rigidité annulus | Signal IRM |
|----------------|---------------|-----------------|-----------------|-----------|
| I (normal) | 100% | 100% | 100% | Blanc homogène |
| II | 90% | 85% | 110% | Gris-blanc |
| III | 75% | 60% | 130% | Gris hétérogène |
| IV | 60% | 30% | 160% | Gris-noir |
| V (sévère) | 40% | 10% | 200% | Noir, effondré |

### 3.3 Système ligamentaire

```julia
struct SpinalLigament
    name::LigamentType               # ALL, PLL, LF, ISL, SSL, CL
    attachment_points::Tuple{Point3D, Point3D}
    # Comportement non-linéaire : courbe force-déplacement
    slack_length::Float64             # mm (longueur repos)
    linear_stiffness::Float64        # N/mm
    toe_region_strain::Float64       # % (zone non-linéaire initiale)
    failure_strain::Float64          # % (rupture)
    failure_force::Float64           # N
    is_pretensioned::Bool
end
```

| Ligament | Rigidité (N/mm) | Déformation rupture (%) | Force rupture (N) |
|----------|----------------|------------------------|-------------------|
| LLA | 33 | 25 | 450 |
| LLP | 20 | 18 | 320 |
| Ligament jaune | 15 | 35 | 210 |
| Inter-épineux | 12 | 20 | 140 |
| Supra-épineux | 15 | 22 | 180 |
| Capsulaire | 25 | 30 | 300 |

### 3.4 Modèle musculaire

```julia
struct SpinalMuscle
    name::String
    type::MuscleType          # :erector_spinae, :multifidus, :psoas, :abdominal
    origin::Point3D
    insertion::Point3D
    pcsa::Float64             # cm² (physiological cross-sectional area)
    max_force::Float64        # N (= PCSA × specific tension ≈ 35 N/cm²)
    activation_level::Float64 # 0.0 - 1.0
    fiber_length::Float64     # mm
    pennation_angle::Float64  # degrés
end

# Calcul de l'équilibre musculaire (optimisation)
function compute_muscle_equilibrium(spine::SpineModel, posture::Posture)
    # Minimisation de l'effort musculaire total sous contraintes d'équilibre
    model = Model(Ipopt.Optimizer)
    @variable(model, 0 <= activation[m in muscles] <= 1)
    @objective(model, Min, sum(activation[m]^2 * muscles[m].max_force for m in muscles))
    # Contraintes d'équilibre : ΣF = 0, ΣM = 0 à chaque niveau
    for level in spine.levels
        @constraint(model, sum_forces(level, activation) .== 0)
        @constraint(model, sum_moments(level, activation) .== 0)
    end
    optimize!(model)
    return value.(activation)
end
```

### 3.5 Assemblage du rachis complet

```julia
struct SpineModel
    vertebrae::Vector{VertebralBody}       # C1 à S1 (25 vertèbres)
    discs::Vector{IntervertebralDisc}      # 23 disques
    ligaments::Vector{SpinalLigament}      # ~150 ligaments
    muscles::Vector{SpinalMuscle}          # ~80 muscles
    pelvis::PelvicModel                    # Bassin complet
    rib_cage::Union{RibCageModel, Nothing} # Cage thoracique (optionnel)
    
    # État actuel
    global_stiffness_matrix::SparseMatrixCSC{Float64}
    displacement_vector::Vector{Float64}
    stress_field::Vector{StressTensor}
    
    # Paramètres patient
    patient_weight::Float64    # kg
    patient_height::Float64    # cm
    age::Int
    bone_density::Float64      # T-score DEXA
end

# Assemblage et résolution FEM
function solve_spine!(model::SpineModel, loads::Vector{Load};
                      solver=:direct, tolerance=1e-6, max_iter=100)
    K = assemble_stiffness(model)       # Matrice de rigidité globale (creuse)
    F = assemble_forces(model, loads)   # Vecteur de forces
    
    # Conditions aux limites (sacrum fixe par défaut)
    apply_boundary_conditions!(K, F, model.boundary_conditions)
    
    # Résolution
    if solver == :direct
        U = K \ F                       # Décomposition LU (SuiteSparse)
    elseif solver == :iterative
        U = cg(K, F; tol=tolerance, maxiter=max_iter)  # Gradient conjugué
    elseif solver == :gpu
        U = solve_gpu(K, F)             # Résolution GPU (CUDA.jl)
    end
    
    # Post-traitement
    model.displacement_vector = U
    model.stress_field = compute_stresses(model, U)
    
    return U
end
```

### 3.6 Solveur GPU haute performance

```julia
# Accélération GPU pour l'interactivité temps réel
using CUDA, KernelAbstractions

function solve_gpu(K::SparseMatrixCSC, F::Vector{Float64})
    # Transfert vers GPU
    K_gpu = CuSparseMatrixCSR(K)
    F_gpu = CuArray(F)
    
    # Préconditionneur incomplet Cholesky
    P = ilu02(K_gpu)
    
    # Gradient conjugué préconditionné sur GPU
    U_gpu = CUDA.CUSPARSE.cg(K_gpu, F_gpu; 
                              preconditioner=P, 
                              tol=1e-6, 
                              maxiter=200)
    
    return Array(U_gpu)  # Retour CPU
end

# Benchmark de performance ciblé
# - Rachis complet (25 vertèbres) : ~500,000 DOF
# - CPU (16 cores) : ~2 secondes
# - GPU (RTX 4080) : ~100 ms → interactivité temps réel
```

---

## 4. SIMULATEUR DE PATHOLOGIES

### 4.1 Générateur de scoliose paramétrable

```julia
struct ScoliosisParameters
    # Classification
    lenke_type::Int           # 1-6
    curve_type::Symbol        # :thoracic, :thoracolumbar, :lumbar, :double
    
    # Courbure principale
    main_curve_apex::VertebralLevel    # ex: T8
    main_curve_cobb::Float64           # degrés
    main_curve_rotation::Float64       # degrés (Nash-Moe ou Perdriolle)
    
    # Courbures secondaires
    secondary_curves::Vector{CurveParameters}
    
    # Équilibre
    coronal_balance::Float64   # mm (C7-CSVL)
    sagittal_balance::Float64  # mm (SVA)
    pelvic_incidence::Float64  # degrés
    
    # Patient
    risser::Int                # 0-5
    sanders::Int               # 1-8
    flexibility::Float64       # % correction en bending
    age::Int
    sex::Symbol                # :M, :F
    bone_density::Float64      # T-score
end

function generate_scoliosis(params::ScoliosisParameters)::SpineModel
    # 1. Créer un rachis normal
    spine = create_normal_spine(params.age, params.sex)
    
    # 2. Appliquer la déformation scoliotique
    apply_coronal_curve!(spine, params.main_curve_apex, params.main_curve_cobb)
    apply_rotation!(spine, params.main_curve_apex, params.main_curve_rotation)
    
    for curve in params.secondary_curves
        apply_coronal_curve!(spine, curve.apex, curve.cobb)
    end
    
    # 3. Appliquer la cunéiformisation (Hueter-Volkmann)
    apply_wedging!(spine, params.main_curve_cobb)
    
    # 4. Ajuster la rigidité selon la flexibilité
    adjust_flexibility!(spine, params.flexibility)
    
    # 5. Résoudre l'équilibre
    solve_spine!(spine, [gravity_load(params)])
    
    return spine
end
```

### 4.2 Catalogue de pathologies simulables

| Pathologie | Paramètres modifiables | Métriques de sortie |
|-----------|----------------------|-------------------|
| SIA (Lenke 1-6) | Cobb, rotation, flexibilité, Risser, Sanders | Gibbosité, déséquilibre, contraintes |
| Scoliose congénitale | Type anomalie (HV, barre, mixte), niveau, nombre | Progression prédite, contraintes locales |
| Scoliose neuromusculaire | Groupes musculaires affectés, sévérité | Obliquité pelvienne, effondrement postural |
| Scoliose dégénérative | Niveaux dégénérés (Pfirrmann), listhésis | Sténose, SVA, PI-LL mismatch |
| Scheuermann | Cunéiformisation, nombre de vertèbres | Cyphose, contraintes antérieures |
| Spondylolisthésis | Grade (Meyerding I-V), niveau | Instabilité, compression nerveuse |
| Ostéoporose | T-score, distribution | Risque fracturaire, tenue des vis |
| Rachitisme / Ostéomalacie | Paramètres osseux, minéralisation | Déformation, fragilité |
| Post-traumatique | Type fracture, niveau, nombre | Cal vicieux, déséquilibre |
| Post-laminectomie | Niveaux décomprimés, étendue | Instabilité iatrogène |
| Post-irradiation | Zone irradiée, dose, âge | Qualité osseuse altérée |

---

## 5. SIMULATEUR DE CHIRURGIE VIRTUELLE

### 5.1 Moteur de chirurgie virtuelle

```julia
# Chirurgie virtuelle : système d'événements chirurgicaux
abstract type SurgicalAction end

struct PedicleScrew <: SurgicalAction
    level::VertebralLevel
    side::Symbol              # :left, :right
    entry_point::Point3D
    trajectory::Vector3D      # direction
    diameter::Float64         # mm (4.5, 5.5, 6.5, 7.5)
    length::Float64           # mm (30-55)
    screw_type::Symbol        # :monoaxial, :polyaxial, :uniplanar
    material::Symbol          # :titanium, :CoCr
end

struct RodPlacement <: SurgicalAction
    side::Symbol
    levels::Tuple{VertebralLevel, VertebralLevel}
    material::Symbol          # :titanium, :CoCr
    diameter::Float64         # mm (5.5, 6.0, 6.35)
    contour::Vector{Point3D}  # profil de cintrage
end

struct CorrectionManeuver <: SurgicalAction
    type::Symbol              # :rod_rotation, :translation, :compression, :distraction
    levels::Tuple{VertebralLevel, VertebralLevel}
    force::Float64            # N
    direction::Vector3D
end

struct Osteotomy <: SurgicalAction
    type::Symbol              # :ponte, :pso, :vcr
    level::VertebralLevel
    resection_volume::Float64 # cm³
    closing_angle::Float64    # degrés
end

# Évaluation de la qualité du geste
struct SurgicalEvaluation
    screw_accuracy::Float64       # % (position vs idéale)
    breach::Bool                  # brèche pédiculaire (médiale/latérale)
    breach_type::Symbol           # :none, :medial, :lateral, :anterior
    correction_achieved::Float64  # ° Cobb résiduel
    sagittal_balance::Float64     # mm SVA résiduel
    pi_ll_mismatch::Float64       # ° résiduel
    implant_stress::Float64       # MPa (contrainte max sur implant)
    neurological_risk::Float64    # score de risque 0-1
    blood_loss_estimated::Float64 # mL
    time_elapsed::Float64         # secondes
    overall_score::Float64        # 0-100
end
```

### 5.2 Simulation de vis pédiculaire

```julia
function simulate_pedicle_screw(spine::SpineModel, screw::PedicleScrew)
    vertebra = get_vertebra(spine, screw.level)
    pedicle = get_pedicle(vertebra, screw.side)
    
    # 1. Vérifier la trajectoire
    trajectory_analysis = analyze_trajectory(
        pedicle, screw.entry_point, screw.trajectory,
        screw.diameter, screw.length
    )
    
    # 2. Détecter les brèches
    breach = detect_breach(pedicle, trajectory_analysis)
    
    # 3. Calculer la tenue mécanique (pull-out strength)
    pullout = compute_pullout_strength(
        vertebra.cancellous_bone,
        vertebra.cortical_bone,
        screw.diameter, screw.length,
        spine.patient.bone_density
    )
    
    # 4. Vérifier les structures à risque
    neural_risk = check_neural_structures(trajectory_analysis, spine)
    vascular_risk = check_vascular_structures(trajectory_analysis, spine)
    
    # 5. Insérer la vis dans le modèle
    if !breach.is_critical
        insert_screw!(spine, screw, trajectory_analysis)
        update_stiffness_matrix!(spine)  # Recalcul FEM
    end
    
    return ScrewResult(trajectory_analysis, breach, pullout, neural_risk, vascular_risk)
end
```

### 5.3 Simulation d'ostéotomie

```julia
function simulate_osteotomy(spine::SpineModel, osteotomy::Osteotomy)
    vertebra = get_vertebra(spine, osteotomy.level)
    
    if osteotomy.type == :pso
        # PSO (Pedicle Subtraction Osteotomy)
        # 1. Retirer les éléments postérieurs
        remove_posterior_elements!(vertebra)
        
        # 2. Retirer les pédicules bilatéralement
        remove_pedicles!(vertebra)
        
        # 3. Résection cunéiforme du corps vertébral
        resection = create_wedge_resection(vertebra, osteotomy.closing_angle)
        apply_resection!(vertebra, resection)
        
        # 4. Fermeture de l'ostéotomie (compression postérieure)
        closure_result = close_osteotomy!(spine, osteotomy.level, osteotomy.closing_angle)
        
        # 5. Recalcul biomécanique
        solve_spine!(spine, [gravity_load(spine.patient)])
        
        # 6. Mesurer la correction obtenue
        correction = measure_lordosis_gain(spine, osteotomy.level)
        
        return OsteotomyResult(
            correction_achieved=correction,  # typiquement 25-35°
            anterior_wall_intact=check_anterior_wall(vertebra),
            neural_clearance=check_neural_clearance(spine, osteotomy.level),
            blood_loss_estimate=estimate_blood_loss(osteotomy)
        )
    end
    # ... similarement pour Ponte, VCR
end
```

### 5.4 Voies d'abord — Simulation anatomique par couches

```julia
# Système de couches anatomiques pour les voies d'abord
struct AnatomicalLayer
    name::String
    type::Symbol          # :skin, :fascia, :muscle, :bone, :neural, :vascular
    mesh::FEMesh
    transparency::Float64 # 0.0-1.0
    is_retractable::Bool
    is_resectable::Bool
    danger_level::Symbol  # :safe, :caution, :danger, :critical
    haptic_resistance::Float64  # N (pour feedback haptique)
end

# Voie d'abord postérieure : couches anatomiques
const POSTERIOR_APPROACH_LAYERS = [
    AnatomicalLayer("Peau", :skin, skin_mesh, 0.0, false, true, :safe, 5.0),
    AnatomicalLayer("Tissu sous-cutané", :fascia, subcut_mesh, 0.0, false, true, :safe, 3.0),
    AnatomicalLayer("Fascia thoraco-lombaire", :fascia, tl_fascia_mesh, 0.0, true, true, :safe, 8.0),
    AnatomicalLayer("Muscles érecteurs du rachis", :muscle, erector_mesh, 0.0, true, false, :caution, 15.0),
    AnatomicalLayer("Multifides", :muscle, multifidus_mesh, 0.0, true, false, :caution, 12.0),
    AnatomicalLayer("Périoste", :fascia, periosteum_mesh, 0.0, false, true, :safe, 6.0),
    AnatomicalLayer("Lames vertébrales", :bone, lamina_mesh, 0.0, false, true, :caution, 50.0),
    AnatomicalLayer("Ligament jaune", :fascia, lf_mesh, 0.0, false, true, :danger, 20.0),
    AnatomicalLayer("Espace épidural", :neural, epidural_mesh, 0.0, false, false, :critical, 0.5),
    AnatomicalLayer("Dure-mère / Moelle", :neural, dura_mesh, 0.0, false, false, :critical, 0.2),
]

# Interaction chirurgicale avec retour haptique
function interact_with_layer!(action::Symbol, layer::AnatomicalLayer, instrument::SurgicalInstrument)
    if action == :incise && layer.is_resectable
        create_incision!(layer, instrument.position, instrument.direction)
        return HapticFeedback(resistance=layer.haptic_resistance, vibration=0.0)
    elseif action == :retract && layer.is_retractable
        retract_tissue!(layer, instrument.retraction_vector)
        return HapticFeedback(resistance=layer.haptic_resistance * 0.5, vibration=0.0)
    elseif action == :touch && layer.danger_level == :critical
        trigger_alert!("⚠️ STRUCTURE CRITIQUE : $(layer.name)")
        return HapticFeedback(resistance=0.0, vibration=1.0)  # Alerte haptique
    end
end
```

---

## 6. INTERFACE UTILISATEUR

### 6.1 Modes d'affichage

| Mode | Description | Utilisation |
|------|------------|------------|
| **Vue anatomique** | Rachis réaliste avec textures anatomiques | Apprentissage anatomie |
| **Vue radiographique** | Simulation de radiographie AP/latéral | Mesures et classification |
| **Vue contraintes** | Heatmap colorimétrique des contraintes | Analyse biomécanique |
| **Vue chirurgicale** | Champ opératoire avec couches anatomiques | Chirurgie virtuelle |
| **Vue transparente** | Structures sélectivement transparentes | Visualisation implants |
| **Vue IRM** | Simulation de coupes IRM (sagittal, axial, coronal) | Évaluation pathologie |

### 6.2 Contrôles et interactions

| Action | Souris / Clavier | Tactile | VR |
|--------|-----------------|---------|-----|
| Rotation vue | Clic gauche + drag | 2 doigts rotation | Rotation tête |
| Zoom | Molette | 2 doigts pinch | Rapprochement |
| Pan | Clic droit + drag | 1 doigt drag | Translation main |
| Sélection vertèbre | Clic gauche | Tap | Pointeur + trigger |
| Placement vis | Clic + guide | Tap position + direction | Main + geste d'insertion |
| Cintrage tige | Drag sur points de contrôle | Drag | Mains (geste de cintrage) |
| Manœuvre correction | Curseurs / sliders | Sliders | Gestuelle naturelle |

### 6.3 Dashboard de résultats

```
┌────────────────────────────────────────────────────────────┐
│  📊 RAPPORT DE SIMULATION — Cas #0042                       │
├────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌─────────────────────────┐  ┌──────────────────────────┐ │
│  │  PARAMÈTRES PRÉOP        │  │  RÉSULTATS POSTOP SIMULÉ │ │
│  │  Cobb thoracique : 52°   │  │  Cobb résiduel : 12°     │ │
│  │  Cobb lombaire : 38°     │  │  Cobb résiduel : 8°      │ │
│  │  SVA : +8.5 cm           │  │  SVA : +2.1 cm ✅        │ │
│  │  PI : 55°                │  │  PI : 55° (inchangé)     │ │
│  │  LL : 25°                │  │  LL : 48° ✅             │ │
│  │  PI-LL : 30°             │  │  PI-LL : 7° ✅           │ │
│  │  TK : 22°                │  │  TK : 35° ✅             │ │
│  └─────────────────────────┘  └──────────────────────────┘ │
│                                                             │
│  ┌─────────────────────────────────────────────────────┐   │
│  │  PERFORMANCE CHIRURGICALE                             │   │
│  │  • Vis placées : 16/16 (précision moyenne : 94.2%)    │   │
│  │  • Brèches : 0 (aucune) ✅                           │   │
│  │  • Temps opératoire simulé : 3h12                     │   │
│  │  • Perte sanguine estimée : 850 mL                    │   │
│  │  • Score global : 87/100 ⭐⭐⭐⭐                    │   │
│  └─────────────────────────────────────────────────────┘   │
│                                                             │
│  ┌─────────────────────────────────────────────────────┐   │
│  │  PRÉDICTION À LONG TERME                              │   │
│  │  • Risque PJK à 2 ans : 12% (modéré)                 │   │
│  │  • Contrainte max implant : 180 MPa (acceptable)      │   │
│  │  • Pression intradiscale adj. : +15% (acceptable)     │   │
│  │  • Probabilité de révision à 5 ans : 8%               │   │
│  └─────────────────────────────────────────────────────┘   │
│                                                             │
│  [📥 Export PDF]  [🔄 Comparer]  [💾 Sauvegarder]          │
└────────────────────────────────────────────────────────────┘
```

---

## 7. INTÉGRATION AVEC LA PLATEFORME LMS

### 7.1 Communication LMS ↔ SpineSim©

| Événement | Direction | Données |
|-----------|-----------|---------|
| Lancement atelier | LMS → SpineSim© | ID module, ID apprenant, exercice à charger |
| Progression | SpineSim© → LMS | Score, temps, gestes réalisés |
| Complétion | SpineSim© → LMS | Résultat final, badge obtenu, rapport PDF |
| Prérequis | LMS → SpineSim© | Niveaux débloqués, compétences acquises |

### 7.2 Standards d'interopérabilité
- **xAPI (Experience API)** : traçabilité fine des interactions dans la simulation
- **LTI 1.3** : lancement sécurisé depuis le LMS (Moodle, Teachable)
- **SCORM 2004** : compatibilité avec les LMS traditionnels
- **DICOM** : importation de cas réels anonymisés pour simulation

---

## 8. PLAN DE DÉVELOPPEMENT

### 8.1 Phases de développement

| Phase | Contenu | Durée estimée | Livrable |
|-------|---------|---------------|----------|
| **Phase 0 — Prototype** | Modèle FEM d'une vertèbre unique en Julia, rendu WebGL basique | 3 mois | POC technique |
| **Phase 1 — MVP** | Rachis complet (C1-S1), chargement gravitaire, visualisation contraintes, manipulation 3D | 6 mois | Version alpha |
| **Phase 2 — Scoliose** | Générateur de scoliose paramétrable (Lenke 1-6), simulation correction manuelle | 4 mois | Version beta 1 |
| **Phase 3 — Chirurgie** | Vis pédiculaires (free-hand), tiges, manœuvres de correction, scoring | 5 mois | Version beta 2 |
| **Phase 4 — Voies d'abord** | Couches anatomiques, voie postérieure complète, voie antérieure | 4 mois | Version beta 3 |
| **Phase 5 — Ostéotomies** | Ponte, PSO, VCR — simulation complète avec calcul de correction | 3 mois | Version beta 4 |
| **Phase 6 — Pathologies** | Toutes pathologies (congénitale, neuromusculaire, adulte, métabolique) | 4 mois | Version RC |
| **Phase 7 — VR + Haptic** | Mode VR (WebXR), retour haptique, version desktop Vulkan | 4 mois | Version 1.0 |
| **Phase 8 — IA + Prédiction** | Prédiction PJK, vieillissement virtuel, comparaison de stratégies | 3 mois | Version 1.1 |
| **Phase 9 — Production** | Optimisation performance, tests utilisateurs, certification CE/FDA si applicable | 4 mois | Version 2.0 |

**Durée totale estimée : ~40 mois (3 ans 4 mois)**

### 8.2 Équipe de développement nécessaire

| Rôle | Nombre | Compétences clés |
|------|--------|-----------------|
| Lead développeur Julia | 1 | Julia, FEM, biomécanique numérique |
| Développeur Julia backend | 2 | Julia, Genie.jl, calcul scientifique, GPU |
| Développeur frontend 3D | 2 | Three.js, WebGL, Vue.js/React, WebXR |
| Bioméchanicien / PhD | 1 | Mécanique des milieux continus, FEM, rachis |
| Chirurgien consultant | 1-2 | Chirurgie rachidienne (validation médicale) |
| Designer UI/UX médical | 1 | Interface médicale, ergonomie simulation |
| Ingénieur DevOps | 1 | Docker, CI/CD, infrastructure cloud |
| QA / Testeur | 1 | Tests automatisés, validation biomédicale |
| Chef de projet | 1 | Coordination, Agile, médical |

**Équipe totale : 11-12 personnes**

### 8.3 Budget estimatif

| Poste | Coût annuel estimé | Durée | Total |
|-------|-------------------|-------|-------|
| Salaires équipe (11 personnes) | 800 000 - 1 100 000 € | 3.5 ans | 2 800 000 - 3 850 000 € |
| Infrastructure cloud (GPU) | 30 000 - 60 000 €/an | 3.5 ans | 105 000 - 210 000 € |
| Licences et outils | 15 000 - 25 000 €/an | 3.5 ans | 52 500 - 87 500 € |
| Matériel (stations GPU, VR, haptique) | 80 000 € (ponctuel) | — | 80 000 € |
| Données anatomiques (CT-scan, validation) | 50 000 € | — | 50 000 € |
| Tests utilisateurs et validation | 40 000 €/an | 2 ans | 80 000 € |
| Frais généraux et imprévus (15%) | — | — | 475 000 - 650 000 € |
| **TOTAL ESTIMÉ** | | | **3 640 000 - 5 000 000 €** |

### 8.4 Sources de financement possibles
- ANR (Agence Nationale de la Recherche) — appel à projets « Technologies pour la santé »
- BPI France — Concours d'innovation numérique, Deep Tech
- Horizon Europe — Programme de recherche européen
- Fonds hospitaliers d'innovation (PHRC, PRME)
- Partenariat industriel (fabricants d'implants : Medtronic, DePuy Synthes, Stryker, Zimmer)
- Sociétés savantes (SRS, SOSORT, SFCR)

---

## 9. VALIDATION ET CERTIFICATION

### 9.1 Validation biomécanique
- Comparaison des résultats de simulation avec :
  - Données cadavériques publiées (Panjabi, Wilke)
  - Études par éléments finis de référence (Little et al., Schmidt et al.)
  - Données cliniques réelles (pre/post-op radiographiques)
- Protocole de validation : corrélation < 5% d'erreur sur les mesures de contrainte
- Validation externe par un laboratoire de biomécanique indépendant

### 9.2 Validation pédagogique
- Étude randomisée : groupe simulation vs groupe contrôle (formation traditionnelle)
- Mesure : amélioration des scores de compétence chirurgicale
- Transfert d'apprentissage : corrélation score simulation ↔ performance au bloc
- Publication des résultats dans une revue peer-reviewed (Spine, JBJS, Eur Spine J)

### 9.3 Certification réglementaire
- **CE Marking** (si classé dispositif médical de formation)
- **ISO 13485** (système de management de la qualité)
- **IEC 62304** (cycle de vie des logiciels de dispositifs médicaux)
- Classification : pas un dispositif médical de diagnostic → class I ou exempté

---

## 10. PACKAGES JULIA — DÉTAIL DES DÉPENDANCES

```julia
# Project.toml — dépendances principales de SpineSim©

[deps]
FinEtools = "91bb5406-6c9a-523d-811d-0644c4229550"
Ferrite = "c061ca5d-56c9-439f-9c0e-210fe06d3992"
Gmsh = "705231aa-382f-11e9-3f0c-b7cb4346fdeb"
CUDA = "052768ef-5323-5732-b1bb-66c8b64840ba"
KernelAbstractions = "63c18a36-062a-441e-b654-da1e3ab1ce7c"
Genie = "c43c736e-a2d1-11e8-161f-af95571f5e91"
JSON3 = "0f8b85d8-7281-11e9-16c2-39a750bddbf1"
MsgPack = "99f44e22-a591-53d1-9472-aa23ef4bd671"
Makie = "ee78f7c6-11fb-53f2-987a-cfe4a2b5a57a"
WGLMakie = "276b4fcb-3e11-5398-bf8b-a0c2d153d008"
Optim = "429524aa-4258-5aef-a3af-852621145aeb"
JuMP = "4076af6c-e467-56ae-b986-b466b2749572"
Ipopt = "b6b21f68-93f8-5de0-b562-5493be1d77c9"
Distributions = "31c24e10-a181-5473-b8eb-7969acd0382f"
StatsBase = "2913bbd2-ae8a-5f71-8c99-4fb6c76f3a91"
LinearAlgebra = "37e2e46d-f89d-539d-b4ee-838fcccc9c8e"
SparseArrays = "2f01184e-e22b-5df5-ae63-d93ebab69eaf"
BenchmarkTools = "6e4b80f9-dd63-53aa-95a3-0cdb28fa8baf"
Documenter = "e30172f5-a6a5-5a46-863b-614d45cd2de4"
Test = "8dfed614-e22c-5e08-85e1-65c5234f0b40"

[compat]
julia = "1.10"
```

---

## 11. API ENDPOINTS

### 11.1 API REST principales

| Méthode | Endpoint | Description |
|---------|----------|-------------|
| `POST` | `/api/spine/create` | Créer un nouveau modèle de rachis (normal ou pathologique) |
| `GET` | `/api/spine/{id}` | Récupérer un modèle de rachis existant |
| `POST` | `/api/spine/{id}/solve` | Lancer une simulation biomécanique |
| `GET` | `/api/spine/{id}/stresses` | Récupérer la cartographie de contraintes |
| `POST` | `/api/spine/{id}/scoliosis` | Appliquer une scoliose paramétrable |
| `POST` | `/api/surgery/{id}/screw` | Placer une vis pédiculaire |
| `POST` | `/api/surgery/{id}/rod` | Placer une tige |
| `POST` | `/api/surgery/{id}/correct` | Exécuter une manœuvre de correction |
| `POST` | `/api/surgery/{id}/osteotomy` | Réaliser une ostéotomie |
| `GET` | `/api/surgery/{id}/evaluate` | Évaluer la qualité de la chirurgie |
| `GET` | `/api/surgery/{id}/report` | Générer un rapport PDF |
| `POST` | `/api/approach/{type}/start` | Démarrer une simulation de voie d'abord |
| `POST` | `/api/approach/{id}/interact` | Interagir avec une couche anatomique |
| `GET` | `/api/student/{id}/progress` | Progression de l'apprenant |
| `POST` | `/api/student/{id}/badge` | Attribuer un badge |

### 11.2 WebSocket (temps réel)

| Canal | Direction | Données |
|-------|-----------|---------|
| `ws://spine/transform` | Client → Serveur | Rotation/translation du modèle 3D |
| `ws://spine/stress` | Serveur → Client | Mise à jour temps réel des contraintes |
| `ws://surgery/feedback` | Serveur → Client | Feedback peropératoire (brèche, alerte) |
| `ws://haptic/force` | Serveur → Client | Données de retour de force haptique |

---

## 12. SÉCURITÉ ET CONFORMITÉ

### 12.1 Authentification et autorisation

#### 12.1.1 Authentification multi-facteurs (MFA)
- **Protocole** : OAuth 2.0 / OpenID Connect (OIDC) via Keycloak ou Auth0
- **Fournisseurs d'identité** : SSO SAML 2.0 (universités, hôpitaux), Google Workspace, Microsoft Entra ID
- **MFA obligatoire** : TOTP (Google Authenticator, Authy), WebAuthn/FIDO2 (clés physiques), SMS (fallback)
- **Gestion des sessions** :
  - Access token JWT : durée 15 min, refresh token : 7 jours
  - Rotation automatique des refresh tokens
  - Invalidation globale en cas de compromission
  - Cookie HttpOnly, Secure, SameSite=Strict

#### 12.1.2 Politique de mots de passe
- Minimum 12 caractères, complexité ANSSI (majuscule, minuscule, chiffre, spécial)
- Vérification contre base Have I Been Pwned (k-anonymity)
- Historique des 12 derniers mots de passe
- Expiration tous les 90 jours (configurable)
- Verrouillage après 5 tentatives (déblocage par admin ou email)

### 12.2 Chiffrement

| Couche | Protocole | Détails |
|--------|-----------|---------|
| Transport | TLS 1.3 | HSTS, certificats Let's Encrypt auto-renouvelés |
| Données au repos (PostgreSQL) | AES-256-GCM | Via pgcrypto ou chiffrement disque LUKS |
| Données au repos (fichiers/S3) | AES-256 SSE | Server-Side Encryption avec clé KMS |
| Sauvegardes | AES-256-CBC | Clé dérivée par PBKDF2, rotation trimestrielle |
| Secrets applicatifs | HashiCorp Vault | Transit engine pour encrypt/decrypt dynamique |

### 12.3 Conformité RGPD / données de santé

#### 12.3.1 Données personnelles
- **Minimisation** : seules les données nécessaires à la formation sont collectées
- **Consentement** : formulaire granulaire (analytics, communication, recherche)
- **Droit d'accès** : export JSON/CSV des données personnelles en < 72h
- **Droit à l'oubli** : suppression irréversible + anonymisation des logs
- **Portabilité** : export xAPI complet au format standardisé
- **DPO** : désignation d'un Délégué à la Protection des Données

#### 12.3.2 Anonymisation DICOM
```julia
struct DICOMAnonymizer
    tags_to_remove::Vector{Tuple{UInt16, UInt16}}  # (group, element)
    tags_to_replace::Dict{Tuple{UInt16, UInt16}, String}
    hash_salt::String  # Pour pseudonymisation déterministe
end

const TAGS_PHI = [
    (0x0010, 0x0010),  # Patient Name
    (0x0010, 0x0020),  # Patient ID
    (0x0010, 0x0030),  # Patient Birth Date
    (0x0010, 0x0040),  # Patient Sex
    (0x0008, 0x0080),  # Institution Name
    (0x0008, 0x0081),  # Institution Address
    (0x0008, 0x0090),  # Referring Physician
    (0x0008, 0x1070),  # Operator Name
    (0x0010, 0x1000),  # Other Patient IDs
    (0x0020, 0x000D),  # Study Instance UID (pseudonymisé)
]

function anonymize_dicom(file_path::String, anon::DICOMAnonymizer)
    dcm = DICOM.dcm_parse(file_path)
    for tag in anon.tags_to_remove
        delete!(dcm, tag)
    end
    for (tag, replacement) in anon.tags_to_replace
        dcm[tag] = replacement
    end
    # Pseudonymisation déterministe de l'UID
    original_uid = dcm[(0x0020, 0x000D)]
    dcm[(0x0020, 0x000D)] = bytes2hex(sha256(anon.hash_salt * original_uid))[1:64]
    return dcm
end
```

#### 12.3.3 Hébergement données de santé (HDS)
- Hébergeur certifié HDS (ISO 27001 + HDS) obligatoire pour données DICOM
- Localisation : datacenter en France ou UE
- Contrat de sous-traitance RGPD avec tous les prestataires
- PIA (Privacy Impact Assessment) réalisée avant mise en production

### 12.4 Sécurité applicative

| Mesure | Implémentation |
|--------|---------------|
| OWASP Top 10 | Audit annuel, WAF (ModSecurity/CloudFlare), CSP strict |
| Injection SQL | Requêtes paramétrées exclusivement (LibPQ.jl prepared statements) |
| XSS | Content Security Policy, sanitisation DOMPurify, échappement systématique |
| CSRF | Tokens synchronizer pattern + SameSite cookies |
| Rate limiting | 100 req/min/utilisateur, 1000 req/min/IP (Redis sliding window) |
| Dépendances | Dependabot/Renovate, audit `Pkg.audit()`, SCA Snyk |
| Logs de sécurité | Audit trail immutable (append-only), rétention 5 ans, format CEF → SIEM |
| Pen testing | Test d'intrusion annuel par prestataire PASSI, bug bounty privé |

### 12.5 Conformité réglementaire

- **CE Médical** : si classifié dispositif médical (classe I/IIa), conformité MDR 2017/745
- **ISO 13485** : système de management qualité pour logiciel de simulation médicale
- **ISO 27001** : certification SMSI recommandée
- **SOC 2 Type II** : pour clients institutionnels internationaux

---

## 13. ARCHITECTURE DE DÉPLOIEMENT

### 13.1 Infrastructure cloud

```
┌─────────────────────────────────────────────────────────────────────┐
│                        CDN (CloudFront/Fastly)                     │
│                   Assets statiques, modèles 3D cachés              │
└──────────────────────────────┬──────────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────────┐
│                     Load Balancer (ALB/Nginx)                       │
│              TLS termination, routing, health checks                │
└────────┬─────────────────────┬──────────────────────┬───────────────┘
         │                     │                      │
┌────────▼────────┐  ┌────────▼────────┐  ┌──────────▼────────┐
│  Web Frontend   │  │  API Gateway    │  │  WebSocket Proxy  │
│  (Nginx/S3)     │  │  (Kong/Traefik) │  │  (sticky session) │
│  Vue.js SPA     │  │  Rate limit,    │  │  Spine transforms │
│  Three.js       │  │  auth, logging  │  │  Haptic feedback  │
└─────────────────┘  └────────┬────────┘  └──────────┬────────┘
                              │                      │
┌─────────────────────────────▼──────────────────────▼────────────────┐
│                    Kubernetes Cluster (EKS/GKE)                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────────────────┐  │
│  │ API Pods     │  │ Solver Pods  │  │ Worker Pods              │  │
│  │ Genie.jl     │  │ FEM Engine   │  │ PDF gen, xAPI, analytics │  │
│  │ HPA: 2-20    │  │ GPU nodes    │  │ HPA: 1-5                │  │
│  │ CPU: 2 cores │  │ NVIDIA T4/A10│  │ CPU: 1 core             │  │
│  │ RAM: 4 GB    │  │ RAM: 16 GB   │  │ RAM: 2 GB               │  │
│  └──────────────┘  └──────────────┘  └──────────────────────────┘  │
└─────────────────────────────┬──────────────────────────────────────┘
                              │
┌─────────────────────────────▼──────────────────────────────────────┐
│                         Data Layer                                  │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────────────┐   │
│  │PostgreSQL│  │  Redis   │  │ MinIO/S3 │  │ Elasticsearch    │   │
│  │ Primary  │  │ Cluster  │  │ Objects  │  │ Logs + Analytics │   │
│  │ + Replica│  │ 3 nodes  │  │ Models3D │  │ 3 nodes          │   │
│  │ 100 GB   │  │ 16 GB    │  │ DICOM    │  │ 500 GB           │   │
│  └──────────┘  └──────────┘  └──────────┘  └──────────────────┘   │
└────────────────────────────────────────────────────────────────────┘
```

### 13.2 Auto-scaling

| Composant | Métrique | Seuil scale-up | Seuil scale-down | Min pods | Max pods |
|-----------|----------|----------------|-------------------|----------|----------|
| API Genie.jl | CPU usage | > 70% (2 min) | < 30% (5 min) | 2 | 20 |
| FEM Solver | Queue length | > 5 jobs | < 1 job (10 min) | 0 | 10 |
| Workers | Queue length | > 10 tasks | < 2 tasks (5 min) | 1 | 5 |
| WebSocket | Connections | > 200/pod | < 50/pod | 2 | 15 |

```yaml
# HPA Kubernetes — solver pods
apiVersion: autoscaling/v2
kind: HorizontalPodAutoscaler
metadata:
  name: spinesim-solver-hpa
spec:
  scaleTargetRef:
    apiVersion: apps/v1
    kind: Deployment
    name: spinesim-solver
  minReplicas: 0
  maxReplicas: 10
  metrics:
    - type: External
      external:
        metric:
          name: rabbitmq_queue_messages
          selector:
            matchLabels:
              queue: fem-solver
        target:
          type: AverageValue
          averageValue: "5"
  behavior:
    scaleDown:
      stabilizationWindowSeconds: 600
      policies:
        - type: Pods
          value: 1
          periodSeconds: 120
    scaleUp:
      stabilizationWindowSeconds: 60
      policies:
        - type: Pods
          value: 2
          periodSeconds: 60
```

### 13.3 Multi-région et latence

| Région | Rôle | Services | Latence cible |
|--------|------|----------|---------------|
| eu-west-3 (Paris) | **Primaire** | Tous les services | < 50 ms |
| eu-central-1 (Francfort) | Failover | API + DB replica | < 80 ms |
| us-east-1 (Virginie) | CDN + Read replica | Assets + API read | < 150 ms |
| ap-southeast-1 (Singapour) | CDN | Assets uniquement | < 200 ms |

### 13.4 GPU Cloud

- **Développement** : instances GPU spot (T4, ~0.35€/h)
- **Production** : GPU réservées (A10G) pour simulations temps réel
- **Burst** : GPU spot pool pour pics (examens, formations massives)
- **Fallback CPU** : mode dégradé sans GPU pour visualisation seule (solver CPU multi-thread)
- **Budget GPU estimé** : 800-1500€/mois en production standard

---

## 14. DISASTER RECOVERY ET SAUVEGARDES

### 14.1 Objectifs de continuité

| Métrique | Objectif | Justification |
|----------|----------|---------------|
| **RPO** (Recovery Point Objective) | ≤ 1 heure | Perte maximale acceptable de données |
| **RTO** (Recovery Time Objective) | ≤ 4 heures | Temps maximal d'indisponibilité |
| **Disponibilité** | 99.9% (≈8.7h/an) | SLA formation en ligne standard |
| **Durabilité données** | 99.999999999% (11 nines) | Via réplication S3 cross-region |

### 14.2 Stratégie de sauvegarde

| Composant | Méthode | Fréquence | Rétention | Localisation |
|-----------|---------|-----------|-----------|--------------|
| PostgreSQL | pg_basebackup + WAL streaming | Continue (WAL) + snapshot quotidien | 30 jours (quotidien), 12 mois (hebdo), 7 ans (mensuel) | Cross-region S3 |
| Redis | RDB snapshot + AOF | Snapshot 4x/jour, AOF continu | 7 jours | Même région |
| MinIO/S3 (modèles 3D, DICOM) | Cross-region replication | Temps réel | Illimité (lifecycle policy) | 2 régions |
| Elasticsearch | Snapshot repository | Quotidien | 90 jours | S3 |
| Configurations K8s | GitOps (ArgoCD/Flux) | À chaque commit | Historique Git complet | GitHub/GitLab |
| Secrets (Vault) | Raft snapshot | Quotidien | 90 jours | Cross-region |

### 14.3 Plan de continuité d'activité (PCA)

```
Incident détecté
       │
       ▼
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│ Niveau 1     │     │ Niveau 2     │     │ Niveau 3     │
│ Dégradation  │────▶│ Basculement  │────▶│ Reconstruction│
│ automatique  │     │ région       │     │ complète      │
│              │     │ secondaire   │     │               │
│ • HPA scale  │     │ • DNS failover│    │ • Restore full│
│ • Circuit    │     │ • Read replica│    │ • Depuis backup│
│   breaker    │     │   → primary  │     │ • Re-deploy   │
│ • Cache mode │     │ • S3 failover│     │   from GitOps │
│              │     │              │     │               │
│ RTO: 0 min   │     │ RTO: 30 min  │     │ RTO: 4h max   │
│ RPO: 0       │     │ RPO: < 1 min │     │ RPO: < 1h     │
└──────────────┘     └──────────────┘     └──────────────┘
```

### 14.4 Tests de disaster recovery

| Test | Fréquence | Procédure |
|------|-----------|-----------|
| Restauration PostgreSQL | Mensuel | Restore backup sur environnement isolé, vérification intégrité |
| Failover DNS | Trimestriel | Simulation panne primaire, mesure RTO réel |
| Fail-back | Trimestriel | Retour sur région primaire après failover |
| Restore complet | Semestriel | Reconstruction complète depuis zéro (GitOps + backups) |
| Test de charge post-restore | Semestriel | Vérification performances après restauration |

---

## 15. STRATÉGIE DE TESTS

### 15.1 Pyramide de tests

```
         ╱╲
        ╱  ╲         E2E (Cypress/Playwright) — 5%
       ╱    ╲        Tests manuels VR
      ╱──────╲
     ╱        ╲      Intégration — 15%
    ╱          ╲     API, WebSocket, DB
   ╱────────────╲
  ╱              ╲   Unitaires — 80%+
 ╱                ╲  Julia (Test.jl), JS (Jest/Vitest)
╱──────────────────╲
```

### 15.2 Tests unitaires (couverture > 80%)

```julia
# Exemple test biomécanique — Test.jl
@testset "Biomechanical Engine" begin
    @testset "Vertebral body creation" begin
        vb = VertebralBody("L1", [0.0, 0.0, 100.0], 35.0, 25.0, 28.0, 0.0)
        @test vb.level == "L1"
        @test vb.width == 35.0
        @test vb.height == 28.0
    end
    
    @testset "FEM Solver convergence" begin
        spine = create_normal_spine()
        mesh = generate_mesh(spine, resolution=:medium)
        result = solve_fem(mesh, load=500.0)  # 500N charge axiale
        @test result.converged == true
        @test result.max_stress < 10.0  # MPa, seuil physiologique
        @test result.iterations < 100
    end
    
    @testset "Screw placement validation" begin
        spine = create_normal_spine()
        # Vis parfaitement placée
        good = place_pedicle_screw(spine, "L4", diameter=6.5, length=45.0,
                                    trajectory=[0.0, 15.0, 0.0])  # 15° médial
        @test good.breach == false
        @test good.score > 0.8
        
        # Vis avec brèche médiale
        bad = place_pedicle_screw(spine, "T5", diameter=7.0, length=50.0,
                                  trajectory=[0.0, 35.0, 0.0])  # 35° excessif
        @test bad.breach == true
        @test bad.breach_type == :medial
    end
    
    @testset "Scoliosis parameters" begin
        params = ScoliosisParameters(:lenke_1A, 55.0, :lumbar, true)
        spine = apply_scoliosis(create_normal_spine(), params)
        cobb = measure_cobb_angle(spine, :thoracic)
        @test 50.0 < cobb < 60.0  # ±5° tolérance
    end
end
```

### 15.3 Tests d'intégration

| Suite | Scope | Outils | Fréquence |
|-------|-------|--------|-----------|
| API REST | Tous les endpoints §11 | HTTP.jl + assertions JSON | À chaque PR |
| WebSocket | Connexion, streaming, reconnexion | WebSockets.jl | À chaque PR |
| Base de données | Migrations, CRUD, transactions | Testcontainers (PostgreSQL) | À chaque PR |
| FEM + GPU | Solver CPU/GPU concordance | CUDA.jl test suite | Quotidien (nightly) |
| xAPI/LTI | Émission statements, authentification LTI | Mock LRS + Mock LMS | À chaque PR |
| DICOM | Import, anonymisation, rendu | Fichiers DICOM de test (anonymisés) | Hebdomadaire |

### 15.4 Tests end-to-end (E2E)

```javascript
// Cypress — Scénario chirurgie virtuelle complète
describe('Virtual Surgery Workflow', () => {
  beforeEach(() => {
    cy.login('student@test.com', 'TestPassword123!');
    cy.visit('/simulation/new');
  });

  it('should complete a full Lenke 1A surgery', () => {
    // 1. Créer un modèle scoliotique
    cy.get('[data-cy=pathology-select]').select('Lenke 1A');
    cy.get('[data-cy=cobb-slider]').invoke('val', 55).trigger('change');
    cy.get('[data-cy=create-model]').click();
    cy.get('[data-cy=spine-3d-canvas]', { timeout: 30000 }).should('be.visible');

    // 2. Placer des vis pédiculaires
    cy.get('[data-cy=tool-screw]').click();
    cy.get('[data-cy=vertebra-T4]').click();
    cy.get('[data-cy=screw-placed-feedback]').should('contain', 'Vis placée');

    // 3. Placer une tige
    cy.get('[data-cy=tool-rod]').click();
    cy.get('[data-cy=connect-T4-L1]').click();
    cy.get('[data-cy=rod-placed-feedback]').should('be.visible');

    // 4. Correction
    cy.get('[data-cy=tool-correct]').click();
    cy.get('[data-cy=derotation-maneuver]').click();
    cy.get('[data-cy=cobb-result]').invoke('text').then(parseFloat)
      .should('be.lessThan', 20);  // Correction attendue

    // 5. Évaluation
    cy.get('[data-cy=evaluate-surgery]').click();
    cy.get('[data-cy=score]').invoke('text').then(parseFloat)
      .should('be.greaterThan', 60);  // Score minimum
    cy.get('[data-cy=report-pdf]').should('have.attr', 'href');
  });
});
```

### 15.5 Tests de performance et charge

| Test | Outil | Scénario | Objectif |
|------|-------|----------|----------|
| Charge API | k6 / Artillery | 500 utilisateurs simultanés, 100 req/s | p95 < 200 ms |
| Charge WebSocket | k6 WebSocket | 200 connexions simultanées, 30 msg/s | Latence < 50 ms |
| Charge FEM solver | Custom Julia benchmark | 50 simulations parallèles | Temps moyen < 30s |
| Rendu 3D | Lighthouse + custom | 60 FPS avec modèle 500k polygones | Frame drop < 5% |
| Stress test | k6 | Montée progressive 0→2000 users en 30 min | Pas de crash, dégradation gracieuse |
| Soak test | k6 | 200 users pendant 24h | Pas de memory leak |

### 15.6 Tests cross-browser et dispositifs VR

| Navigateur/Device | Version min. | Tests spécifiques |
|-------------------|-------------|-------------------|
| Chrome | 110+ | WebGL2, WebXR, WASM |
| Firefox | 110+ | WebGL2, fallback WebXR |
| Safari | 16.4+ | WebGL2 (Metal backend) |
| Edge | 110+ | WebGL2, WebXR |
| Meta Quest 2/3 | Quest Browser | WebXR immersive, contrôleurs |
| Pico 4 | Pico Browser | WebXR, tracking mains |
| Apple Vision Pro | visionOS 1.0+ | WebXR, eye tracking |
| iPad Pro | Safari 16.4+ | Touch, WebGL2, mode AR |

### 15.7 Tests de régression biomécanique

- Base de données de **50 cas de référence** validés par des experts biomécaniciens
- Chaque cas : géométrie rachis + chargement + résultat attendu (stress, déplacement)
- Tolérance : ±5% par rapport aux résultats de référence
- Exécution automatique à chaque modification du solver
- Alerte automatique si régression détectée

---

## 16. PIPELINE CI/CD

### 16.1 Architecture du pipeline

```yaml
# .github/workflows/spinesim-ci.yml
name: SpineSim CI/CD Pipeline

on:
  push:
    branches: [main, develop, 'release/**']
  pull_request:
    branches: [main, develop]

jobs:
  # ═══════════════════════════════════════════
  # Stage 1: Lint & Format
  # ═══════════════════════════════════════════
  lint:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Julia format check
        uses: julia-actions/setup-julia@v1
        with: { version: '1.10' }
      - run: julia -e 'using JuliaFormatter; @assert format("src", verbose=true)'
      - name: Frontend lint
        run: cd frontend && npm ci && npm run lint

  # ═══════════════════════════════════════════
  # Stage 2: Unit Tests
  # ═══════════════════════════════════════════
  test-backend:
    runs-on: ubuntu-latest
    needs: lint
    steps:
      - uses: actions/checkout@v4
      - uses: julia-actions/setup-julia@v1
        with: { version: '1.10' }
      - uses: julia-actions/cache@v1
      - run: julia --project -e 'using Pkg; Pkg.instantiate(); Pkg.test()'
      - name: Coverage report
        run: julia --project -e '
          using Coverage;
          coverage = process_folder();
          LCOV.writefile("lcov.info", coverage)'
      - uses: codecov/codecov-action@v3
        with: { files: lcov.info }

  test-frontend:
    runs-on: ubuntu-latest
    needs: lint
    steps:
      - uses: actions/checkout@v4
      - run: cd frontend && npm ci && npm run test:unit -- --coverage
      - uses: codecov/codecov-action@v3

  # ═══════════════════════════════════════════
  # Stage 3: Integration Tests
  # ═══════════════════════════════════════════
  integration:
    runs-on: ubuntu-latest
    needs: [test-backend, test-frontend]
    services:
      postgres:
        image: postgres:16
        env: { POSTGRES_DB: spinesim_test, POSTGRES_PASSWORD: test }
        ports: ['5432:5432']
      redis:
        image: redis:7
        ports: ['6379:6379']
    steps:
      - uses: actions/checkout@v4
      - uses: julia-actions/setup-julia@v1
        with: { version: '1.10' }
      - run: julia --project -e 'include("test/integration/run_all.jl")'

  # ═══════════════════════════════════════════
  # Stage 4: Build & Docker
  # ═══════════════════════════════════════════
  build:
    runs-on: ubuntu-latest
    needs: integration
    steps:
      - uses: actions/checkout@v4
      - name: Build Docker images
        run: |
          docker build -t spinesim-api:${{ github.sha }} -f docker/Dockerfile.api .
          docker build -t spinesim-solver:${{ github.sha }} -f docker/Dockerfile.solver .
          docker build -t spinesim-frontend:${{ github.sha }} -f docker/Dockerfile.frontend .
      - name: Push to registry
        run: |
          echo ${{ secrets.REGISTRY_TOKEN }} | docker login ghcr.io -u ${{ github.actor }} --password-stdin
          docker push ghcr.io/spinesim/api:${{ github.sha }}
          docker push ghcr.io/spinesim/solver:${{ github.sha }}
          docker push ghcr.io/spinesim/frontend:${{ github.sha }}

  # ═══════════════════════════════════════════
  # Stage 5: Deploy Staging
  # ═══════════════════════════════════════════
  deploy-staging:
    runs-on: ubuntu-latest
    needs: build
    if: github.ref == 'refs/heads/develop'
    environment: staging
    steps:
      - uses: actions/checkout@v4
      - name: Deploy to staging K8s
        run: |
          helm upgrade --install spinesim-staging ./helm/spinesim \
            --namespace staging \
            --set image.tag=${{ github.sha }} \
            --set env=staging \
            --wait --timeout 10m

  # ═══════════════════════════════════════════
  # Stage 6: E2E Tests on Staging
  # ═══════════════════════════════════════════
  e2e-staging:
    runs-on: ubuntu-latest
    needs: deploy-staging
    steps:
      - uses: actions/checkout@v4
      - name: Cypress E2E
        uses: cypress-io/github-action@v6
        with:
          config: baseUrl=https://staging.spinesim.io

  # ═══════════════════════════════════════════
  # Stage 7: Deploy Production
  # ═══════════════════════════════════════════
  deploy-production:
    runs-on: ubuntu-latest
    needs: e2e-staging
    if: startsWith(github.ref, 'refs/heads/release/')
    environment: production
    steps:
      - uses: actions/checkout@v4
      - name: Canary deployment (10%)
        run: |
          helm upgrade --install spinesim ./helm/spinesim \
            --namespace production \
            --set image.tag=${{ github.sha }} \
            --set canary.enabled=true \
            --set canary.weight=10
      - name: Monitor canary (15 min)
        run: |
          sleep 900
          julia scripts/check_canary_metrics.jl --threshold 0.01
      - name: Full rollout
        run: |
          helm upgrade --install spinesim ./helm/spinesim \
            --namespace production \
            --set image.tag=${{ github.sha }} \
            --set canary.enabled=false
```

### 16.2 Quality gates

| Gate | Critère | Bloquant | Stage |
|------|---------|----------|-------|
| Lint | 0 erreurs Julia + ESLint | ✅ Oui | 1 |
| Coverage backend | ≥ 80% | ✅ Oui | 2 |
| Coverage frontend | ≥ 75% | ✅ Oui | 2 |
| Tests unitaires | 100% pass | ✅ Oui | 2 |
| Tests intégration | 100% pass | ✅ Oui | 3 |
| Vulnérabilités critiques | 0 CVE critiques/hautes | ✅ Oui | 3 |
| Image Docker size | < 2 GB (API), < 5 GB (solver) | ⚠️ Warning | 4 |
| E2E tests | ≥ 95% pass | ✅ Oui | 6 |
| Performance p95 | < 200 ms | ⚠️ Warning | 6 |
| Canary error rate | < 1% | ✅ Oui | 7 |

### 16.3 Rollback automatique

```julia
# scripts/check_canary_metrics.jl
function check_canary_health(threshold::Float64=0.01)
    metrics = query_prometheus("rate(http_requests_total{status=~\"5..\",deployment=\"canary\"}[5m])")
    error_rate = metrics.value
    
    if error_rate > threshold
        @warn "Canary error rate $(error_rate) exceeds threshold $(threshold)"
        run(`helm rollback spinesim --namespace production`)
        error("Canary deployment rolled back automatically")
    else
        @info "Canary healthy: error rate = $(error_rate)"
    end
end
```

---

## 17. MODÈLE RBAC (CONTRÔLE D'ACCÈS PAR RÔLES)

### 17.1 Rôles et hiérarchie

```
Super Admin
    │
    ├── Admin Institution
    │       │
    │       ├── Instructeur / Formateur
    │       │       │
    │       │       └── Tuteur
    │       │
    │       └── Content Manager
    │
    └── Apprenant (Étudiant)
            │
            ├── Niveau Bronze
            ├── Niveau Argent
            ├── Niveau Or
            └── Niveau Diamant
```

### 17.2 Matrice de permissions

| Permission | Super Admin | Admin Inst. | Instructeur | Tuteur | Content Mgr | Apprenant |
|------------|:-----------:|:-----------:|:-----------:|:------:|:-----------:|:---------:|
| **Utilisateurs** | | | | | | |
| Créer utilisateur | ✅ | ✅ (son inst.) | ❌ | ❌ | ❌ | ❌ |
| Modifier rôles | ✅ | ⚠️ (limité) | ❌ | ❌ | ❌ | ❌ |
| Voir tous les profils | ✅ | ✅ (son inst.) | ✅ (ses étudiants) | ✅ (ses assignés) | ❌ | ❌ |
| Supprimer utilisateur | ✅ | ❌ | ❌ | ❌ | ❌ | ❌ |
| **Contenu** | | | | | | |
| Créer module | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ |
| Modifier module | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ |
| Publier module | ✅ | ✅ | ❌ | ❌ | ⚠️ (draft) | ❌ |
| Voir contenu | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ (débloqué) |
| Créer quiz | ✅ | ❌ | ✅ | ❌ | ✅ | ❌ |
| **Simulation SpineSim** | | | | | | |
| Accès simulation | ✅ | ✅ | ✅ | ✅ | ❌ | ✅ (selon niveau) |
| Mode libre (sandbox) | ✅ | ✅ | ✅ | ❌ | ❌ | ✅ (Or+) |
| Scénarios avancés (VR) | ✅ | ✅ | ✅ | ❌ | ❌ | ✅ (Diamant) |
| Importer DICOM perso | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| Créer scénario custom | ✅ | ❌ | ✅ | ❌ | ❌ | ❌ |
| **Analytics** | | | | | | |
| Dashboard global | ✅ | ✅ (son inst.) | ❌ | ❌ | ❌ | ❌ |
| Progression étudiants | ✅ | ✅ | ✅ (ses cours) | ✅ (ses assignés) | ❌ | ✅ (soi-même) |
| Export données | ✅ | ✅ | ⚠️ (anonymisé) | ❌ | ❌ | ✅ (soi-même) |
| **Administration** | | | | | | |
| Configuration système | ✅ | ❌ | ❌ | ❌ | ❌ | ❌ |
| Logs de sécurité | ✅ | ❌ | ❌ | ❌ | ❌ | ❌ |
| Gestion facturation | ✅ | ✅ (son inst.) | ❌ | ❌ | ❌ | ❌ |

### 17.3 Provisioning et SSO

```julia
# Intégration SCIM 2.0 pour provisioning automatique
struct SCIMUser
    schemas::Vector{String}
    userName::String
    name::Dict{String, String}  # givenName, familyName
    emails::Vector{Dict{String, Any}}
    roles::Vector{String}
    active::Bool
    externalId::String  # ID dans le système source
    institution_id::String  # Rattachement institution
end

# Mapping SAML attributes → SpineSim roles
const SAML_ROLE_MAPPING = Dict(
    "urn:mace:dir:entitlement:faculty" => "instructeur",
    "urn:mace:dir:entitlement:student" => "apprenant",
    "urn:mace:dir:entitlement:staff"   => "admin_institution",
    "urn:mace:dir:entitlement:admin"   => "super_admin",
)

# Provisioning automatique via webhook LMS
function provision_from_lti(lti_params::Dict)
    role = map_lti_role(lti_params["roles"])
    user = find_or_create_user(
        email = lti_params["email"],
        name = lti_params["name"],
        role = role,
        institution = lti_params["tool_consumer_instance_guid"]
    )
    create_session(user)
end
```

---

## 18. ACCESSIBILITÉ

### 18.1 Conformité WCAG 2.1 AA (interface web)

| Critère WCAG | Exigence | Implémentation |
|-------------|---------|----------------|
| **1.1.1** Contenu non textuel | Textes alternatifs | Alt-text sur tous les modèles 3D, ARIA labels |
| **1.3.1** Information et relations | Structure sémantique | Headings hiérarchiques, landmarks ARIA |
| **1.4.1** Utilisation de la couleur | Ne pas reposer sur la couleur seule | Icônes + couleurs + texte pour feedback |
| **1.4.3** Contraste minimal | Ratio 4.5:1 (texte), 3:1 (grand texte) | Design system vérifié avec axe-core |
| **1.4.11** Contraste non textuel | Ratio 3:1 pour éléments UI | Bordures, focus indicators |
| **2.1.1** Clavier | Navigation complète au clavier | Tab order, focus management 3D viewer |
| **2.4.1** Contourner des blocs | Skip navigation | Skip links, landmarks |
| **2.4.7** Focus visible | Indicateur de focus | Outline 3px solid, high contrast |
| **3.3.1** Identification des erreurs | Messages d'erreur descriptifs | ARIA-live pour simulation feedback |
| **4.1.2** Nom, rôle, valeur | Composants accessibles | ARIA roles pour Three.js canvas |

### 18.2 Accessibilité VR / XR

#### 18.2.1 Mode assis (seated mode)
- Toutes les interactions accessibles en position assise
- Recentrage automatique du point de vue
- Hauteur de la table virtuelle ajustable
- Pas de mouvement debout requis

#### 18.2.2 Daltonisme et déficiences visuelles
```javascript
// Palettes accessibles pour visualisation 3D
const COLOR_SCHEMES = {
  default: {
    bone: '#F5E6D3', stress_low: '#2196F3', stress_high: '#F44336',
    screw: '#9E9E9E', rod: '#607D8B', warning: '#FF9800'
  },
  deuteranopia: {  // Rouge-vert
    bone: '#F5E6D3', stress_low: '#648FFF', stress_high: '#DC267F',
    screw: '#9E9E9E', rod: '#607D8B', warning: '#FFB000'
  },
  protanopia: {    // Rouge
    bone: '#F5E6D3', stress_low: '#648FFF', stress_high: '#FE6100',
    screw: '#9E9E9E', rod: '#607D8B', warning: '#FFB000'
  },
  tritanopia: {    // Bleu-jaune
    bone: '#F5E6D3', stress_low: '#009E73', stress_high: '#D55E00',
    screw: '#9E9E9E', rod: '#607D8B', warning: '#CC79A7'
  },
  high_contrast: {
    bone: '#FFFFFF', stress_low: '#0000FF', stress_high: '#FF0000',
    screw: '#000000', rod: '#333333', warning: '#FFFF00'
  }
};

// Indicateurs non-colorimétriques
const STRESS_INDICATORS = {
  pattern: true,     // Hachures pour zones de stress
  animation: true,   // Pulsation pour zones critiques
  audio: true,       // Bip intensité croissante
  haptic: true       // Vibration proportionnelle au stress
};
```

#### 18.2.3 Prévention du motion sickness
- **Cadre de référence fixe** : cockpit/dashboard toujours visible
- **Vignetting** : assombrissement périphérique lors des mouvements
- **Téléportation** : déplacement par téléportation (pas de locomotion fluide par défaut)
- **Snap turning** : rotation par incréments de 30° ou 45° (configurable)
- **FPS garanti** : ≥ 72 FPS sur Quest 2, ≥ 90 FPS sur Quest 3
- **Option confort** : 3 niveaux (confortable, modéré, intense)
- **Minuterie** : rappel de pause toutes les 30 min (configurable)

#### 18.2.4 Accessibilité motrice VR
- **Mode mono-main** : toutes les actions réalisables avec un seul contrôleur
- **Hand tracking** : interaction sans contrôleur (pinch, grab, point)
- **Gaze-based interaction** : sélection par regard + dwell time (2s)
- **Voice commands** : commandes vocales pour actions principales ("placer vis", "rotation", "évaluer")
- **Boutons adaptatifs** : taille configurable (S/M/L/XL), zones de hit box élargies

### 18.3 Accessibilité cognitive
- **Mode simplifié** : interface réduite aux outils essentiels
- **Tutoriel interactif** : guide pas-à-pas avec surbrillance des éléments
- **Feedback multimodal** : visuel + audio + haptique simultané
- **Annulation multiple** : Ctrl+Z illimité, historique visible
- **Sauvegarde automatique** : toutes les 30 secondes

---

## 19. COMPATIBILITÉ MOBILE ET MODE HORS-LIGNE

### 19.1 Design responsive

| Point de rupture | Appareil | Adaptations |
|-----------------|----------|-------------|
| ≥ 1440px | Desktop large | Layout complet, panneau latéral + 3D + dashboard |
| 1024-1439px | Desktop/Tablet landscape | Panneau latéral rétractable |
| 768-1023px | Tablet portrait | Navigation burger, 3D plein écran toggle |
| < 768px | Mobile | Bottom navigation, 3D simplifié, pas de simulation chirurgicale |

### 19.2 Progressive Web App (PWA)

```json
{
  "name": "SpineSim© - Simulateur Biomécanique du Rachis",
  "short_name": "SpineSim",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#1A237E",
  "theme_color": "#283593",
  "icons": [
    { "src": "/icons/icon-192.png", "sizes": "192x192", "type": "image/png" },
    { "src": "/icons/icon-512.png", "sizes": "512x512", "type": "image/png" },
    { "src": "/icons/icon-maskable.png", "sizes": "512x512", "type": "image/png", "purpose": "maskable" }
  ],
  "categories": ["medical", "education"],
  "screenshots": [
    { "src": "/screenshots/surgery.png", "sizes": "1920x1080", "type": "image/png", "label": "Simulation chirurgicale" }
  ]
}
```

### 19.3 Service Workers et cache

```javascript
// service-worker.js — Stratégie de cache
const CACHE_VERSION = 'spinesim-v2.1';

const CACHE_STRATEGIES = {
  // Cache-first : assets statiques, modèles 3D de base
  static: [
    '/assets/**',
    '/models/normal-spine.glb',
    '/models/pathology-templates/*.glb',
    '/icons/**',
    '/fonts/**'
  ],
  
  // Network-first : API, contenu dynamique
  dynamic: [
    '/api/student/**',
    '/api/spine/**'
  ],
  
  // Stale-while-revalidate : contenu de cours
  swr: [
    '/api/modules/**',
    '/api/quizzes/**',
    '/media/videos/**'  // Vidéos cours (pré-téléchargées)
  ]
};

// Taille maximale cache hors-ligne
const MAX_OFFLINE_CACHE = 2 * 1024 * 1024 * 1024;  // 2 GB

// Sync en arrière-plan
self.addEventListener('sync', event => {
  if (event.tag === 'sync-progress') {
    event.waitUntil(syncStudentProgress());
  }
  if (event.tag === 'sync-xapi') {
    event.waitUntil(syncXAPIStatements());
  }
});
```

### 19.4 Mode hors-ligne

| Fonctionnalité | Disponible hors-ligne | Détails |
|----------------|:---------------------:|---------|
| Contenu de cours (texte + images) | ✅ | Pré-téléchargement par module |
| Vidéos de cours | ✅ | Téléchargement explicite par l'utilisateur |
| Quiz (QCM, QCS) | ✅ | Réponses synchronisées au retour en ligne |
| Modèle 3D normal (visualisation) | ✅ | Modèle de base en cache |
| Simulation chirurgicale complète | ❌ | Nécessite le solver serveur (GPU) |
| Simulation chirurgicale simplifiée | ✅ | Solver WebAssembly réduit (modèle rigide, sans FEM) |
| Progression et badges | ⚠️ | Mise à jour locale, sync différée |
| Forum et discussions | ❌ | Nécessite connexion |
| Certification / examen | ❌ | Proctoring nécessite connexion temps réel |

### 19.5 Optimisation bande passante

- **Compression modèles 3D** : Draco compression (réduction 80-90%), LOD (Level of Detail)
- **Streaming adaptatif vidéo** : HLS/DASH avec qualités auto (360p→4K)
- **Images** : WebP/AVIF avec fallback PNG, responsive srcset
- **API** : compression Brotli, pagination, champs sélectifs (GraphQL-like)
- **Delta sync** : synchronisation différentielle (seuls les changements sont transmis)

---

## 20. LEARNING ANALYTICS ET DASHBOARD

### 20.1 Métriques collectées

#### 20.1.1 Métriques d'engagement
| Métrique | Source | Granularité | Stockage |
|----------|--------|-------------|----------|
| Temps passé par module | xAPI (duration) | Par session | PostgreSQL + Data Warehouse |
| Taux de complétion | xAPI (completed) | Par module/quiz | PostgreSQL |
| Fréquence de connexion | Auth logs | Quotidien | Elasticsearch |
| Pages/écrans consultés | xAPI (experienced) | Par page | Elasticsearch |
| Vidéos regardées (% complétion) | xAPI (progressed) | Par vidéo | PostgreSQL |
| Abandon (dernière activité > 14j) | Calculé | Quotidien | Data Warehouse |

#### 20.1.2 Métriques de performance
| Métrique | Source | Analyse |
|----------|--------|---------|
| Scores quiz par niveau (Bronze→Diamant) | xAPI (scored) | Distribution, percentiles |
| Taux de réussite par question | Agrégation | Difficulté réelle vs prévue |
| Temps de réponse par question | xAPI | Corrélation temps × réussite |
| Tentatives par quiz | xAPI (attempted) | Courbe d'apprentissage |
| Score simulation SpineSim | API SpineSim | Progression chirurgicale |
| Précision placement vis | API SpineSim | Évolution accuracy % |
| Score de correction Cobb final | API SpineSim | Courbe de compétence |

#### 20.1.3 Métriques SpineSim spécifiques
```julia
struct SimulationAnalytics
    student_id::String
    session_id::String
    timestamp::DateTime
    
    # Performance chirurgicale
    screw_accuracy::Float64           # % vis intra-pédiculaires
    screw_breach_count::Int           # Nombre de brèches
    breach_severity::Vector{Symbol}   # [:none, :minor_lateral, :major_medial...]
    rod_contour_match::Float64        # % concordance avec le contour idéal
    correction_achieved::Float64      # Angle de Cobb final
    correction_target::Float64        # Angle de Cobb cible
    surgery_time::Float64             # Temps en minutes
    blood_loss_simulated::Float64     # Pertes sanguines simulées (mL)
    complications::Vector{String}     # Complications rencontrées
    
    # Progression
    attempts_count::Int               # Nombre de tentatives sur ce scénario
    improvement_rate::Float64         # % d'amélioration vs tentative précédente
    skill_level::Symbol               # :novice, :intermediate, :advanced, :expert
    
    # Interaction
    tools_used::Vector{String}        # Outils utilisés
    undo_count::Int                   # Nombre d'annulations
    help_requests::Int                # Demandes d'aide
    time_in_vr::Float64               # Temps en mode VR (minutes)
end
```

### 20.2 Dashboard instructeur

```
┌─────────────────────────────────────────────────────────────────────────────┐
│  SpineSim© — Dashboard Instructeur          Dr. Martin │ Cohorte 2026-A    │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐       │
│  │ 47 étudiants│  │ 72% taux    │  │ 8.2h temps  │  │ 85% réussite│       │
│  │ actifs      │  │ complétion  │  │ moyen/sem.  │  │ quiz moy.   │       │
│  └─────────────┘  └─────────────┘  └─────────────┘  └─────────────┘       │
│                                                                             │
│  ┌─ Progression par module ──────────────────────────────────────────────┐  │
│  │ M1  Anatomie      ████████████████████████████████████████ 95%       │  │
│  │ M5  Classifications ██████████████████████████████████░░░░ 82%       │  │
│  │ M15 Instrumentation ████████████████████████░░░░░░░░░░░░░ 58%       │  │
│  │ M20 Peropératoire  ██████████████░░░░░░░░░░░░░░░░░░░░░░░░ 32%       │  │
│  │ M28 SpineSim       ████████░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ 21%       │  │
│  └───────────────────────────────────────────────────────────────────────┘  │
│                                                                             │
│  ┌─ SpineSim — Compétences chirurgicales ───────────────────────────────┐  │
│  │                                                                       │  │
│  │  Précision vis pédiculaires    Correction Cobb       Temps opératoire │  │
│  │  ┌────────────┐               ┌────────────┐        ┌────────────┐   │  │
│  │  │     ╱──    │               │    ──╲      │        │  ──╲       │   │  │
│  │  │   ╱       │               │        ╲    │        │     ╲      │   │  │
│  │  │ ╱         │               │ Cible    ╲  │        │      ──    │   │  │
│  │  │╱          │               │ ─ ─ ─ ─   ╲│        │        ╲   │   │  │
│  │  └────────────┘               └────────────┘        └────────────┘   │  │
│  │  Sem 1→8: 71%→92%            62°→18° (cible <25°)  180→95 min       │  │
│  └───────────────────────────────────────────────────────────────────────┘  │
│                                                                             │
│  ┌─ Alertes ────────────────────────────────────────────────────────────┐  │
│  │ ⚠ 3 étudiants inactifs depuis > 14 jours                           │  │
│  │ ⚠ Module 15 : taux d'échec quiz > 40% — revoir questions 12, 15    │  │
│  │ ✓ 5 étudiants prêts pour certification Diamant                      │  │
│  └───────────────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────┘
```

### 20.3 Dashboard apprenant

```
┌─────────────────────────────────────────────────────────────────────────────┐
│  SpineSim© — Mon parcours                            Dr. Dupont │ Or 🥇    │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─ Progression globale ────────────────────────────────────────────────┐  │
│  │  ████████████████████████████████████████░░░░░░░░░░░░ 72%           │  │
│  │  Modules complétés : 21/29    Heures : 54.3h    Badges : 12/20     │  │
│  └───────────────────────────────────────────────────────────────────────┘  │
│                                                                             │
│  ┌─ Radar de compétences ─────────┐  ┌─ Prochaines étapes ────────────┐  │
│  │        Anatomie                 │  │                                 │  │
│  │          ★★★★★                  │  │ → Module 22 : Complications     │  │
│  │  Imagerie    Classification     │  │ → Quiz Or Module 20 (2e essai) │  │
│  │   ★★★★☆       ★★★★★            │  │ → SpineSim Scénario Lenke 5C   │  │
│  │  Chirurgie    Biomécanique      │  │ → Révision : Ostéotomies       │  │
│  │   ★★★☆☆       ★★★★☆            │  │                                 │  │
│  └─────────────────────────────────┘  └─────────────────────────────────┘  │
│                                                                             │
│  ┌─ SpineSim — Mes performances ────────────────────────────────────────┐  │
│  │  Dernière simulation : Lenke 1AN — Score 78/100                      │  │
│  │  • Vis placées : 12/12 (92% intra-pédiculaires, record personnel)   │  │
│  │  • Cobb final : 22° (cible < 25°) ✓                                 │  │
│  │  • Temps : 110 min (amélioration -15%)                               │  │
│  │  • Complications : 0 (vs 2 lors de la tentative précédente)          │  │
│  │  [📊 Voir l'évolution] [🔄 Refaire ce scénario] [▶ Scénario suivant]│  │
│  └───────────────────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────┘
```

### 20.4 Data warehouse et export

| Couche | Technologie | Rôle |
|--------|-------------|------|
| Ingestion | Apache Kafka / Amazon Kinesis | Collecte temps réel des événements xAPI |
| Stockage brut | S3 / MinIO (Data Lake) | Données brutes immutables (format Parquet) |
| Transformation | dbt (data build tool) | Modèles analytiques, agrégations |
| Warehouse | ClickHouse / BigQuery | Requêtes analytiques rapides |
| Visualisation | Metabase / Grafana | Dashboards, exploration ad-hoc |
| Export | API REST + CSV/JSON | Export programmé ou à la demande |

### 20.5 Analyse prédictive

```julia
# Modèle prédictif de réussite — Gradient Boosting
using MLJ, XGBoost

struct StudentPredictiveFeatures
    completion_rate::Float64          # Taux de complétion actuel
    avg_quiz_score::Float64           # Score moyen quiz
    login_frequency::Float64          # Connexions/semaine
    time_between_sessions::Float64    # Jours entre sessions (régularité)
    spinesim_improvement_rate::Float64 # Taux d'amélioration SpineSim
    help_requests_ratio::Float64      # Demandes d'aide / interactions
    undo_ratio::Float64               # Annulations / actions totales
    video_completion_rate::Float64    # % vidéos regardées en entier
end

# Prédictions
# - Risque d'abandon (> 70% → alerte tuteur)
# - Score certification estimé
# - Temps restant estimé pour compléter la formation
# - Modules recommandés (adaptatif)
```

---

*Document de spécifications techniques — SpineSim© — Février 2026*
*Version 2.0 — Document évolutif, mis à jour à chaque phase de développement*
*Propriété intellectuelle : à définir (brevet logiciel, licence académique ou commerciale)*
*Sections 12-20 ajoutées : sécurité, déploiement, DR, tests, CI/CD, RBAC, accessibilité, mobile/hors-ligne, analytics*
