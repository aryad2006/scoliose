# ══════════════════════════════════════════════════════════════
# Vertex — Modèle Vertébral
# ══════════════════════════════════════════════════════════════

"""
Morphologie d'une vertèbre — dimensions en mm.
Valeurs issues de Panjabi et al. (1991), Zindrick et al. (1987).
"""
struct VertebralMorphology
    body_width::Float64         # largeur du corps (mm)
    body_depth::Float64         # profondeur AP du corps (mm)
    body_height::Float64        # hauteur du corps (mm)
    pedicle_width::Float64      # largeur transversale du pédicule (mm)
    pedicle_height::Float64     # hauteur sagittale du pédicule (mm)
    canal_width::Float64        # largeur du canal rachidien (mm)
    canal_depth::Float64        # profondeur AP du canal (mm)
    spinous_length::Float64     # longueur du processus épineux (mm)
    transverse_length::Float64  # longueur du processus transverse (mm)
    facet_orientation::Float64  # orientation des facettes (degrés vs sagittal)
end

"""
Vertèbre — élément structurel fondamental du rachis.
"""
mutable struct VertebralBody
    level::VertebralLevel
    morphology::VertebralMorphology
    cortical::MaterialProperties
    cancellous::MaterialProperties
    
    # Position et orientation dans l'espace global
    position::Vec3              # Centre du corps vertébral (mm)
    orientation::Mat3           # Matrice de rotation 3×3
    
    # Maillage FEM (indices dans le maillage global)
    node_indices::UnitRange{Int}
    element_indices::UnitRange{Int}
    
    # État mécanique
    displacement::Vector{Vec3}
    stress::Vector{StressTensor}
end

# ── Morphologies de référence par niveau (Panjabi 1991, Zindrick 1987) ──

const VERTEBRAL_MORPHOLOGY = Dict{VertebralLevel, VertebralMorphology}(
    # Cervicales (C3-C7 typiques)
    C3 => VertebralMorphology(17.0, 15.0, 13.0, 5.5, 7.0, 24.0, 16.0, 20.0, 25.0, 45.0),
    C4 => VertebralMorphology(17.5, 15.5, 13.0, 5.8, 7.0, 24.0, 16.0, 22.0, 28.0, 45.0),
    C5 => VertebralMorphology(18.0, 16.0, 13.5, 6.0, 7.0, 24.5, 16.0, 24.0, 30.0, 45.0),
    C6 => VertebralMorphology(19.0, 16.5, 13.5, 6.2, 7.5, 24.5, 16.0, 26.0, 32.0, 45.0),
    C7 => VertebralMorphology(20.0, 17.0, 14.0, 6.8, 7.5, 25.0, 16.5, 35.0, 34.0, 45.0),
    
    # Thoraciques
    T1  => VertebralMorphology(24.0, 18.0, 17.0, 7.2, 10.0, 21.0, 16.0, 30.0, 35.0, 60.0),
    T2  => VertebralMorphology(24.5, 19.0, 18.0, 5.3, 10.5, 20.0, 15.5, 32.0, 36.0, 65.0),
    T3  => VertebralMorphology(25.0, 20.0, 18.5, 4.7, 11.0, 19.5, 15.0, 33.0, 38.0, 70.0),
    T4  => VertebralMorphology(26.0, 22.0, 19.0, 4.5, 11.5, 19.0, 15.0, 34.0, 40.0, 72.0),
    T5  => VertebralMorphology(27.0, 24.0, 20.0, 5.2, 12.0, 19.0, 15.0, 35.0, 42.0, 70.0),
    T6  => VertebralMorphology(28.0, 25.0, 20.5, 5.8, 12.5, 19.5, 15.0, 36.0, 43.0, 68.0),
    T7  => VertebralMorphology(29.0, 26.0, 21.0, 6.3, 13.0, 20.0, 15.5, 37.0, 44.0, 65.0),
    T8  => VertebralMorphology(30.0, 27.0, 21.5, 6.9, 13.5, 20.5, 15.5, 37.0, 45.0, 60.0),
    T9  => VertebralMorphology(31.0, 28.0, 22.0, 7.6, 14.0, 21.0, 16.0, 36.0, 46.0, 55.0),
    T10 => VertebralMorphology(32.0, 29.0, 22.5, 8.7, 15.0, 22.0, 16.0, 34.0, 47.0, 50.0),
    T11 => VertebralMorphology(34.0, 30.0, 23.0, 10.5, 15.5, 23.0, 16.5, 32.0, 48.0, 40.0),
    T12 => VertebralMorphology(37.0, 32.0, 24.0, 12.8, 16.0, 24.0, 17.0, 28.0, 48.0, 30.0),
    
    # Lombaires (Zindrick 1987)
    L1 => VertebralMorphology(40.0, 33.0, 25.0, 8.7,  15.0, 24.0, 17.0, 15.0, 35.0, 15.0),
    L2 => VertebralMorphology(42.0, 34.0, 26.0, 9.5,  15.2, 24.5, 17.5, 18.0, 40.0, 12.0),
    L3 => VertebralMorphology(44.0, 35.0, 27.0, 11.2, 15.5, 25.0, 18.0, 14.0, 45.0, 10.0),
    L4 => VertebralMorphology(47.0, 36.0, 26.5, 13.8, 15.8, 25.5, 18.5, 10.0, 40.0, 15.0),
    L5 => VertebralMorphology(50.0, 37.0, 26.0, 17.5, 16.0, 27.0, 19.0,  8.0, 38.0, 25.0),
    
    # Sacrum S1 (simplifié)
    S1 => VertebralMorphology(52.0, 38.0, 25.0, 14.0, 16.0, 28.0, 20.0, 0.0, 35.0, 35.0),
)

"""
    create_vertebra(level::VertebralLevel, position::Vec3; tscore=0.0) → VertebralBody

Crée une vertèbre à un niveau donné avec les propriétés morphologiques de référence.
`tscore` : T-score DEXA pour ajuster la densité osseuse.
"""
function create_vertebra(level::VertebralLevel, position::Vec3; tscore::Float64=0.0)
    morph = get(VERTEBRAL_MORPHOLOGY, level, VERTEBRAL_MORPHOLOGY[L3])
    
    # Ajuster les propriétés mécaniques selon la densité osseuse (T-score)
    density_factor = max(0.1, 1.0 + 0.15 * tscore)  # ±15% par T-score
    
    cortical = MaterialProperties(
        CORTICAL_BONE.youngs_modulus * density_factor,
        CORTICAL_BONE.poissons_ratio,
        CORTICAL_BONE.yield_stress * density_factor,
        CORTICAL_BONE.density * density_factor
    )
    
    cancellous = MaterialProperties(
        CANCELLOUS_BONE.youngs_modulus * density_factor^2,  # Plus sensible
        CANCELLOUS_BONE.poissons_ratio,
        CANCELLOUS_BONE.yield_stress * density_factor^2,
        CANCELLOUS_BONE.density * density_factor
    )
    
    return VertebralBody(
        level, morph, cortical, cancellous,
        position, Mat3(I),       # Position/orientation initiales
        1:0, 1:0,                # Indices maillage (assignés plus tard)
        Vec3[], StressTensor[]   # Vides au départ
    )
end

"""
    vertebral_levels() → Vector{VertebralLevel}
    
Retourne les niveaux C3..S1 dans l'ordre anatomique (sans C1-C2 pour simplifier le Phase 0).
"""
function vertebral_levels()
    return [C3, C4, C5, C6, C7,
            T1, T2, T3, T4, T5, T6, T7, T8, T9, T10, T11, T12,
            L1, L2, L3, L4, L5,
            S1]
end

"""
    level_index(level::VertebralLevel) → Int

Index 1-based du niveau vertébral dans le rachis complet (C3=1, ..., S1=23).
"""
function level_index(level::VertebralLevel)
    levels = vertebral_levels()
    idx = findfirst(==(level), levels)
    isnothing(idx) && error("Niveau $level non trouvé")
    return idx
end
