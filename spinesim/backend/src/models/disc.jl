# ══════════════════════════════════════════════════════════════
# Vertex — Modèle du Disque Intervertébral
# ══════════════════════════════════════════════════════════════

"""
Famille de fibres de collagène dans l'annulus fibrosus.
Orientation alternée ±30° entre lamelles (Marchand & Ahmed, 1990).
"""
struct FiberFamily
    orientation::Float64        # angle par rapport à l'horizontale (degrés)
    stiffness::Float64          # rigidité (N/mm²)
    recruitment_strain::Float64 # déformation de recrutement (fraction)
end

"""
Nucleus pulposus — noyau gélatineux hydraulique.
Modèle hyperélastique Mooney-Rivlin quasi-incompressible.
"""
mutable struct NucleusPulposus
    C10::Float64                # Pa — 1er paramètre Mooney-Rivlin
    C01::Float64                # Pa — 2ème paramètre
    bulk_modulus::Float64       # Pa — module de compressibilité
    pressure::Float64           # MPa — pression intra-discale
    water_content::Float64      # fraction (0.7-0.9)
end

"""
Annulus fibrosus — anneau fibreux multicouche.
Modèle fibre-renforcé avec matrice de substance fondamentale.
"""
mutable struct AnnulusFibrosus
    ground_matrix::MaterialProperties
    fiber_families::Vector{FiberFamily}
    num_layers::Int             # 10-25 lamelles concentriques
end

"""
Disque intervertébral complet.
"""
mutable struct IntervertebralDisc
    level::DiscLevel
    nucleus::NucleusPulposus
    annulus::AnnulusFibrosus
    degeneration::PfirrmannGrade
    
    # Géométrie
    height::Float64             # mm — hauteur du disque
    width::Float64              # mm — largeur (= corps vertébral)
    depth::Float64              # mm — profondeur AP
    
    # Position
    position::Vec3              # Centre du disque
    
    # Indices maillage
    node_indices::UnitRange{Int}
    element_indices::UnitRange{Int}
end

# ── Hauteurs discales de référence (mm) — Gilad & Nissan, 1986 ──
const DISC_HEIGHTS = Dict{DiscLevel, Float64}(
    C2C3 => 4.0, C3C4 => 4.5, C4C5 => 5.0, C5C6 => 5.0, C6C7 => 4.5,
    C7T1 => 4.0,
    T1T2 => 4.0, T2T3 => 4.0, T3T4 => 4.0, T4T5 => 4.0,
    T5T6 => 4.5, T6T7 => 5.0, T7T8 => 5.0, T8T9 => 5.5,
    T9T10 => 6.0, T10T11 => 6.5, T11T12 => 7.0,
    T12L1 => 8.0,
    L1L2 => 9.0, L2L3 => 10.0, L3L4 => 11.0, L4L5 => 12.0,
    L5S1 => 11.0,
)

"""
    disc_level_for(upper::VertebralLevel, lower::VertebralLevel) → DiscLevel

Retourne le niveau discal entre deux vertèbres adjacentes.
"""
function disc_level_for(upper::VertebralLevel, lower::VertebralLevel)
    mapping = Dict(
        (C2, C3) => C2C3, (C3, C4) => C3C4, (C4, C5) => C4C5,
        (C5, C6) => C5C6, (C6, C7) => C6C7, (C7, T1) => C7T1,
        (T1, T2) => T1T2, (T2, T3) => T2T3, (T3, T4) => T3T4,
        (T4, T5) => T4T5, (T5, T6) => T5T6, (T6, T7) => T6T7,
        (T7, T8) => T7T8, (T8, T9) => T8T9, (T9, T10) => T9T10,
        (T10, T11) => T10T11, (T11, T12) => T11T12,
        (T12, L1) => T12L1,
        (L1, L2) => L1L2, (L2, L3) => L2L3, (L3, L4) => L3L4,
        (L4, L5) => L4L5, (L5, S1) => L5S1,
    )
    return mapping[(upper, lower)]
end

"""
    create_disc(level::DiscLevel, position::Vec3, width::Float64, depth::Float64;
                pfirrmann=1) → IntervertebralDisc

Crée un disque intervertébral avec les propriétés de référence.
"""
function create_disc(level::DiscLevel, position::Vec3, width::Float64, depth::Float64;
                     pfirrmann::Int=1)
    grade = PfirrmannGrade(pfirrmann)
    height = DISC_HEIGHTS[level] * grade.height_ratio
    
    # Nucleus — modèle Mooney-Rivlin
    nucleus = NucleusPulposus(
        0.12e6,                     # C10 (Pa)
        0.03e6,                     # C01 (Pa)
        1700.0e6,                   # module de compressibilité (Pa)
        0.15 * grade.nucleus_pressure_ratio,  # pression MPa (debout)
        0.85 - 0.10 * (pfirrmann - 1)        # contenu en eau diminue
    )
    
    # Annulus — fibres alternées ±30° (Marchand & Ahmed, 1990)
    num_layers = 15
    fibers = FiberFamily[]
    for i in 1:num_layers
        angle = (i % 2 == 1) ? 30.0 : -30.0
        stiffness = 60.0 * grade.annulus_stiffness_ratio  # N/mm²
        # Couches externes plus rigides
        layer_factor = 0.7 + 0.6 * (i / num_layers)
        push!(fibers, FiberFamily(angle, stiffness * layer_factor, 0.03))
    end
    
    ground = MaterialProperties(0.5e6, 0.40, 0.3e6, 1050.0)  # matrice de fond
    annulus = AnnulusFibrosus(ground, fibers, num_layers)
    
    return IntervertebralDisc(
        level, nucleus, annulus, grade,
        height, width, depth,
        position,
        1:0, 1:0  # Indices maillage (assignés plus tard)
    )
end
