# ══════════════════════════════════════════════════════════════
# Vertex — Types pour la Simulation Longitudinale
# Théorie du ressort spiral : flambage progressif du rachis
# asymétrique sous charge cyclique
# ══════════════════════════════════════════════════════════════

# ── Type d'asymétrie initiale ──

"""
Asymétrie initiale du rachis — cause potentielle de scoliose idiopathique.

Deux catégories :
- **Statique** : anomalie structurelle fixe (cunéiformisation vertébrale, 
  asymétrie de l'arc postérieur)
- **Dynamique** : anomalie fonctionnelle des tissus mous (asymétrie 
  ligamentaire, asymétrie discale)
"""
@enum AsymmetryCategory begin
    ASYMMETRY_NONE          # Rachis parfaitement symétrique (contrôle)
    ASYMMETRY_STATIC        # Structurelle (os)
    ASYMMETRY_DYNAMIC       # Fonctionnelle (tissus mous)
    ASYMMETRY_COMBINED      # Statique + dynamique
end

@enum StaticAsymmetryType begin
    VERTEBRAL_WEDGING           # Cunéiformisation du corps vertébral
    POSTERIOR_ARCH_ASYMMETRY    # Asymétrie des pédicules/lames/facettes
    ENDPLATE_TILT               # Inclinaison du plateau vertébral
end

@enum DynamicAsymmetryType begin
    LIGAMENT_STIFFNESS_ASYMMETRY    # Rigidité ligamentaire gauche ≠ droite
    DISC_ASYMMETRY                  # Asymétrie discale (nucleus excentré)
    MUSCLE_TONE_ASYMMETRY           # Asymétrie tonus musculaire
end

"""
Définition d'une asymétrie statique sur une vertèbre.
"""
struct StaticAsymmetry
    type::StaticAsymmetryType
    level::VertebralLevel           # Vertèbre affectée
    magnitude::Float64              # Amplitude (degrés pour wedging, mm pour offset)
    side::Symbol                    # :left ou :right
end

"""
Définition d'une asymétrie dynamique sur un segment.
"""
struct DynamicAsymmetry
    type::DynamicAsymmetryType
    level::VertebralLevel           # Niveau supérieur du segment
    magnitude::Float64              # Ratio d'asymétrie (1.0 = symétrique, 1.2 = 20% plus rigide)
    side::Symbol                    # :left ou :right — côté le plus rigide/tendu
end

"""
Configuration complète de l'asymétrie initiale du rachis.
"""
struct AsymmetryConfig
    category::AsymmetryCategory
    static_asymmetries::Vector{StaticAsymmetry}
    dynamic_asymmetries::Vector{DynamicAsymmetry}
    description::String
end

"""
    symmetric_config() → AsymmetryConfig

Configuration de contrôle : rachis parfaitement symétrique.
"""
function symmetric_config()
    return AsymmetryConfig(
        ASYMMETRY_NONE,
        StaticAsymmetry[],
        DynamicAsymmetry[],
        "Rachis symétrique — contrôle"
    )
end

# ── Profil de chargement quotidien ──

"""
Activité quotidienne avec sa fréquence et ses charges associées.
Représente un pattern de charge répété des milliers de fois par jour.
"""
struct DailyActivity
    name::String
    cycles_per_day::Int             # Nombre de répétitions/jour
    axial_load::Float64             # Force axiale (N) — poids + charge
    flexion_moment::Float64         # Moment de flexion sagittale (N·mm)
    lateral_moment::Float64         # Moment de flexion latérale (N·mm)
    torsion_moment::Float64         # Moment de torsion (N·mm)
    duration_fraction::Float64      # Fraction du temps de la journée (0-1)
end

"""
Profil de chargement quotidien complet.
Basé sur Nachemson (1976), Wilke (1999) pour les pressions intradiscales
et les charges selon les postures.
"""
struct DailyLoadProfile
    activities::Vector{DailyActivity}
    patient_weight::Float64         # kg
    patient_height::Float64         # cm
end

"""
    standard_daily_profile(weight, height) → DailyLoadProfile

Profil quotidien standard d'un individu moyen.
Référence : Nachemson (1976), Wilke et al. (1999).
"""
function standard_daily_profile(weight::Float64=70.0, height::Float64=170.0)
    body_weight_N = weight * 9.81

    activities = DailyActivity[
        # Marche : ~8000 pas/jour, charge modérée avec composante cyclique
        DailyActivity("Marche", 8000,
            0.8 * body_weight_N,     # axial (80% BW au rachis lombaire)
            50.0 * weight,           # flexion légère
            15.0 * weight,           # balancement latéral
            10.0 * weight,           # rotation associée
            0.10),                   # 10% du temps éveillé

        # Station debout immobile
        DailyActivity("Debout immobile", 1,
            0.7 * body_weight_N,
            20.0 * weight,
            5.0 * weight,
            0.0,
            0.20),                   # 20% du temps

        # Station assise
        DailyActivity("Assis", 1,
            1.0 * body_weight_N,     # 100% BW (Nachemson : assis > debout)
            80.0 * weight,           # flexion importante
            5.0 * weight,
            0.0,
            0.30),                   # 30% du temps

        # Flexion avant (se pencher, ramasser)
        DailyActivity("Flexion avant", 50,
            1.7 * body_weight_N,     # 170% BW
            200.0 * weight,
            10.0 * weight,
            5.0 * weight,
            0.05),

        # Rotation tronc (se tourner)
        DailyActivity("Rotation tronc", 100,
            0.9 * body_weight_N,
            30.0 * weight,
            20.0 * weight,
            80.0 * weight,           # torsion importante
            0.05),

        # Port de charge modéré (sac, courses)
        DailyActivity("Port de charge", 20,
            1.5 * body_weight_N,
            150.0 * weight,
            50.0 * weight,           # Charge souvent asymétrique
            20.0 * weight,
            0.03),

        # Repos (décubitus) — décharge quasi totale
        DailyActivity("Décubitus", 1,
            0.1 * body_weight_N,     # pas complètement à 0 (tonus)
            0.0,
            0.0,
            0.0,
            0.33),                   # 8h de sommeil ≈ 33%
    ]

    return DailyLoadProfile(activities, weight, height)
end

# ── État de fatigue cumulée ──

"""
État de fatigue/dommage d'un segment intervertébral.
Modèle de Miner (accumulation linéaire de dommage).
"""
mutable struct SegmentFatigueState
    level::VertebralLevel           # Niveau supérieur du segment
    
    # Dommage cumulé (0 = neuf, 1 = rupture/défaillance)
    vertebral_damage::Float64       # Os cortical + spongieux
    disc_damage::Float64            # Annulus fibrosus
    endplate_damage::Float64        # Plateau vertébral cartilagineux
    
    # Compteur de cycles total
    total_cycles::Int64
    
    # Contrainte max vue par le segment
    peak_stress_history::Float64    # Von Mises max historique (Pa)
end

# ── État de remodelage osseux ──

"""
État du remodelage osseux adaptatif (loi de Wolff).
L'os se renforce là où les contraintes sont élevées et se résorbe
là où elles sont faibles.
"""
mutable struct BoneRemodelingState
    level::VertebralLevel
    
    # Densité osseuse locale (fraction de la densité de référence)
    # [gauche, centre, droite] dans le plan frontal
    density_distribution::Vec3      # (left, center, right) ratios
    
    # Référence homéostatique
    homeostatic_stress::Float64     # Contrainte d'équilibre (Pa)
    
    # Taux de remodelage
    formation_rate::Float64         # g/cm³ par mois
    resorption_rate::Float64        # g/cm³ par mois
end

# ── État de dégénérescence discale ──

"""
État de dégénérescence progressive du disque intervertébral.
"""
mutable struct DiscDegenerationState
    level::DiscLevel
    
    # Propriétés évoluant dans le temps
    current_height::Float64         # mm (diminue avec le temps)
    initial_height::Float64         # mm (référence)
    water_content::Float64          # fraction (0.9 → 0.3 sur une vie)
    current_pfirrmann::Float64      # note continue (1.0 → 5.0)
    
    # Asymétrie discale développée
    height_asymmetry::Float64       # ratio gauche/droite (1.0 = symétrique)
    nucleus_offset::Vec3            # déplacement du nucleus par rapport au centre (mm)
    
    # Pression nucleus
    nucleus_pressure::Float64       # MPa
end

# ── Résultats de la simulation longitudinale ──

"""
Snapshot de l'état du rachis à un instant donné de la simulation.
"""
struct SpineSnapshot
    time_years::Float64
    
    # Mesures angulaires
    cobb_angles::Dict{String, Float64}      # ex: "T5-T12" => 15.0°
    thoracic_kyphosis::Float64              # degrés
    lumbar_lordosis::Float64                # degrés
    
    # Rotation vertébrale
    axial_rotations::Vector{Float64}        # degrés, par vertèbre
    
    # Positions vertébrales
    vertebral_positions::Vector{Vec3}
    vertebral_orientations::Vector{Mat3}
    
    # État mécanique
    stress_distribution::Vector{Float64}    # Von Mises par segment
    
    # Métriques de flambage
    lateral_deviation::Float64              # mm — déplacement latéral max
    spring_buckling_ratio::Float64          # ratio charge/charge critique (>1 = flambage)
end

"""
Résultat complet d'une simulation longitudinale.
"""
struct LongitudinalResult
    config::AsymmetryConfig
    duration_years::Float64
    time_step_months::Int
    
    # Historique
    snapshots::Vector{SpineSnapshot}
    
    # État final
    final_cobb::Float64                     # angle de Cobb final max
    developed_scoliosis::Bool               # Cobb > 10°
    scoliosis_onset_years::Float64          # moment d'apparition (Cobb > 10°)
    
    # Analyse du flambage
    buckling_detected::Bool
    buckling_onset_years::Float64
    
    # Statistiques
    max_damage::Float64
    max_asymmetry_developed::Float64
end

# ── Paramètres de la simulation ──

"""
Paramètres contrôlant la simulation longitudinale.
"""
struct LongitudinalParams
    # Durée
    duration_years::Float64         # Durée totale simulée (ex: 20 ans)
    time_step_months::Int           # Pas de temps (ex: 1 mois)
    
    # Patient
    initial_age::Int                # Âge au début (ex: 10 ans)
    sex::Symbol                     # :M ou :F
    weight::Float64                 # kg
    height::Float64                 # cm
    
    # Croissance (si patient jeune)
    growth_enabled::Bool            # Simuler la croissance
    growth_rate_cm_year::Float64    # cm/an (pic pubertaire)
    growth_peak_age::Float64        # Âge du pic de croissance
    
    # Profil de charge
    load_profile::DailyLoadProfile
    
    # Asymétrie initiale
    asymmetry::AsymmetryConfig
    
    # Paramètres mécaniques
    fatigue_sensitivity::Float64    # 0-1 (0=pas de fatigue, 1=très sensible)
    remodeling_rate::Float64        # Vitesse de remodelage osseux (0-1)
    disc_degeneration_rate::Float64 # Vitesse de dégénérescence discale (0-1)
    
    # Analyse
    snapshot_interval_months::Int   # Intervalle entre les snapshots
    detect_buckling::Bool           # Détecter le flambage du "ressort"
end

"""
    default_longitudinal_params(; kwargs...) → LongitudinalParams

Paramètres par défaut pour une simulation longitudinale de 20 ans
d'un adolescent de 10 ans avec rachis symétrique.
"""
function default_longitudinal_params(;
        duration_years::Float64=20.0,
        time_step_months::Int=1,
        initial_age::Int=10,
        sex::Symbol=:F,             # Scoliose idiopathique : 7F/1M
        weight::Float64=35.0,
        height::Float64=140.0,
        growth_enabled::Bool=true,
        growth_rate::Float64=6.0,   # cm/an au pic
        growth_peak_age::Float64=12.0,
        asymmetry::AsymmetryConfig=symmetric_config(),
        fatigue_sensitivity::Float64=0.5,
        remodeling_rate::Float64=0.5,
        disc_degeneration_rate::Float64=0.3,
        snapshot_interval::Int=6,
        detect_buckling::Bool=true)
    
    profile = standard_daily_profile(weight, height)
    
    return LongitudinalParams(
        duration_years, time_step_months,
        initial_age, sex, weight, height,
        growth_enabled, growth_rate, growth_peak_age,
        profile,
        asymmetry,
        fatigue_sensitivity,
        remodeling_rate,
        disc_degeneration_rate,
        snapshot_interval,
        detect_buckling
    )
end
