# ══════════════════════════════════════════════════════════════
# Vertex — Modèle Ligamentaire
# ══════════════════════════════════════════════════════════════

"""
Ligament rachidien avec comportement non-linéaire.
Données: White & Panjabi, 1990; Pintar et al., 1992.
"""
mutable struct SpinalLigament
    type::LigamentType
    level::VertebralLevel           # Niveau vertébral supérieur
    
    # Points d'attache (coordonnées globales, mm)
    origin::Vec3
    insertion::Vec3
    
    # Propriétés mécaniques
    slack_length::Float64           # longueur au repos (mm)
    linear_stiffness::Float64       # rigidité linéaire (N/mm)
    toe_region_strain::Float64      # déformation zone non-linéaire initiale
    failure_strain::Float64         # déformation à rupture
    failure_force::Float64          # force de rupture (N)
    is_pretensioned::Bool           # pré-tension (ex: ligament jaune)
    pretension::Float64             # force de pré-tension (N)
    
    # État courant
    current_length::Float64
    current_force::Float64
    is_ruptured::Bool
end

# ── Propriétés mécaniques de référence par type de ligament ──
# Pintar et al. (1992), Chazal et al. (1985)

struct LigamentProperties
    stiffness::Float64      # N/mm
    failure_strain::Float64 # fraction
    failure_force::Float64  # N
    pretensioned::Bool
    pretension::Float64     # N
end

const LIGAMENT_PROPERTIES = Dict{LigamentType, LigamentProperties}(
    LVCA => LigamentProperties(33.0, 0.25, 450.0, false, 0.0),
    LVCP => LigamentProperties(20.0, 0.18, 320.0, false, 0.0),
    LF   => LigamentProperties(15.0, 0.35, 210.0, true,  5.0),   # pré-tendu (posture érigée)
    ISL  => LigamentProperties(12.0, 0.20, 140.0, false, 0.0),
    SSL  => LigamentProperties(15.0, 0.22, 180.0, false, 0.0),
    ITL  => LigamentProperties(10.0, 0.25, 100.0, false, 0.0),
    CL   => LigamentProperties(25.0, 0.30, 300.0, false, 0.0),
)

"""
    create_ligament(type, level, origin, insertion) → SpinalLigament

Crée un ligament rachidien avec propriétés mécaniques de référence.
"""
function create_ligament(type::LigamentType, level::VertebralLevel,
                         origin::Vec3, insertion::Vec3)
    props = LIGAMENT_PROPERTIES[type]
    slack = norm(insertion - origin)
    
    return SpinalLigament(
        type, level,
        origin, insertion,
        slack,
        props.stiffness, 0.05,      # toe region = 5% de la déformation
        props.failure_strain,
        props.failure_force,
        props.pretensioned,
        props.pretension,
        slack,                       # longueur courante = repos
        props.pretensioned ? props.pretension : 0.0,
        false                        # non rompu
    )
end

"""
    compute_ligament_force!(lig::SpinalLigament) → Float64

Calcule la force dans le ligament en fonction de sa déformation courante.
Modèle non-linéaire : zone "toe" quadratique + zone linéaire.
Référence : Panjabi et al., Clinical Biomechanics of the Spine (1990).
"""
function compute_ligament_force!(lig::SpinalLigament)::Float64
    if lig.is_ruptured
        lig.current_force = 0.0
        return 0.0
    end
    
    strain = (lig.current_length - lig.slack_length) / lig.slack_length
    
    if strain ≤ 0
        # Ligament relâché — pas de compression
        lig.current_force = lig.is_pretensioned ? lig.pretension : 0.0
        return lig.current_force
    end
    
    if strain > lig.failure_strain
        # Rupture
        lig.is_ruptured = true
        lig.current_force = 0.0
        return 0.0
    end
    
    force = if strain < lig.toe_region_strain
        # Zone toe (non-linéaire quadratique)
        k_toe = lig.linear_stiffness / (2.0 * lig.toe_region_strain)
        k_toe * strain^2 * lig.slack_length
    else
        # Zone linéaire
        f_toe = lig.linear_stiffness * lig.toe_region_strain * lig.slack_length / 2.0
        f_toe + lig.linear_stiffness * (strain - lig.toe_region_strain) * lig.slack_length
    end
    
    lig.current_force = force + (lig.is_pretensioned ? lig.pretension : 0.0)
    return lig.current_force
end

"""
    create_level_ligaments(level, upper_vb, lower_vb) → Vector{SpinalLigament}

Crée tous les ligaments entre deux vertèbres adjacentes.
"""
function create_level_ligaments(level::VertebralLevel,
                                upper_pos::Vec3, lower_pos::Vec3,
                                body_width::Float64, body_depth::Float64)
    ligaments = SpinalLigament[]
    
    midline = (upper_pos + lower_pos) / 2.0
    
    # LVCA — face antérieure du corps
    push!(ligaments, create_ligament(LVCA, level,
        upper_pos + Vec3(0, body_depth/2, 0),
        lower_pos + Vec3(0, body_depth/2, 0)))
    
    # LVCP — face postérieure (dans le canal)
    push!(ligaments, create_ligament(LVCP, level,
        upper_pos + Vec3(0, -body_depth/2, 0),
        lower_pos + Vec3(0, -body_depth/2, 0)))
    
    # Ligament jaune — entre les lames
    push!(ligaments, create_ligament(LF, level,
        upper_pos + Vec3(0, -body_depth/2 - 5, 0),
        lower_pos + Vec3(0, -body_depth/2 - 5, 0)))
    
    # Inter-épineux — entre les processus épineux
    push!(ligaments, create_ligament(ISL, level,
        upper_pos + Vec3(0, -body_depth/2 - 15, 0),
        lower_pos + Vec3(0, -body_depth/2 - 15, 0)))
    
    # Supra-épineux — apex des épineuses
    push!(ligaments, create_ligament(SSL, level,
        upper_pos + Vec3(0, -body_depth/2 - 25, 0),
        lower_pos + Vec3(0, -body_depth/2 - 25, 0)))
    
    # Intertransversaire — gauche et droite
    for side in (-1, 1)
        push!(ligaments, create_ligament(ITL, level,
            upper_pos + Vec3(side * body_width/2, 0, 0),
            lower_pos + Vec3(side * body_width/2, 0, 0)))
    end
    
    # Capsulaire facettaire — gauche et droite
    for side in (-1, 1)
        push!(ligaments, create_ligament(CL, level,
            upper_pos + Vec3(side * body_width/3, -body_depth/3, 0),
            lower_pos + Vec3(side * body_width/3, -body_depth/3, 0)))
    end
    
    return ligaments
end
