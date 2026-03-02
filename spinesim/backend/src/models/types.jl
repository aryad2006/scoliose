# ══════════════════════════════════════════════════════════════
# Vertex — Types fondamentaux
# ══════════════════════════════════════════════════════════════

using StaticArrays

# ── Alias vectoriels ──
const Vec3 = SVector{3, Float64}
const Mat3 = SMatrix{3, 3, Float64, 9}

# ── Niveaux vertébraux ──
@enum VertebralLevel begin
    C1; C2; C3; C4; C5; C6; C7
    T1; T2; T3; T4; T5; T6; T7; T8; T9; T10; T11; T12
    L1; L2; L3; L4; L5
    S1
end

# ── Niveaux discaux ──
@enum DiscLevel begin
    C2C3; C3C4; C4C5; C5C6; C6C7
    C7T1
    T1T2; T2T3; T3T4; T4T5; T5T6; T6T7; T7T8; T8T9; T9T10; T10T11; T11T12
    T12L1
    L1L2; L2L3; L3L4; L4L5
    L5S1
end

# ── Type de ligament ──
@enum LigamentType begin
    LVCA   # Ligament vertébral commun antérieur (ALL)
    LVCP   # Ligament vertébral commun postérieur (PLL)
    LF     # Ligament jaune (flavum)
    ISL    # Inter-épineux (interspinous)
    SSL    # Supra-épineux (supraspinous)
    ITL    # Intertransversaire
    CL     # Capsulaire facettaire
end

# ── Type de muscle ──
@enum MuscleType begin
    ERECTOR_SPINAE
    MULTIFIDUS
    PSOAS
    ABDOMINAL
    QUADRATUS_LUMBORUM
    INTERCOSTAL
end

# ── Propriétés mécaniques ──
struct MaterialProperties
    youngs_modulus::Float64      # Pa (ex: 12e9 pour os cortical)
    poissons_ratio::Float64     # sans unité (0.3 typique os)
    yield_stress::Float64       # Pa (contrainte de rupture)
    density::Float64            # kg/m³
    is_anisotropic::Bool
    anisotropy_ratio::Float64   # E_axial / E_transverse

    function MaterialProperties(E::Float64, ν::Float64, σy::Float64, ρ::Float64;
                                anisotropic::Bool=false, aniso_ratio::Float64=1.0)
        @assert E > 0 "Module de Young doit être positif"
        @assert 0 < ν < 0.5 "Coefficient de Poisson doit être dans ]0, 0.5["
        new(E, ν, σy, ρ, anisotropic, aniso_ratio)
    end
end

# ── Matériaux prédéfinis ──
const CORTICAL_BONE = MaterialProperties(14.0e9, 0.3, 150.0e6, 1900.0)
const CANCELLOUS_BONE = MaterialProperties(0.3e9, 0.22, 2.0e6, 300.0)
const CORTICAL_PEDICLE = MaterialProperties(12.0e9, 0.3, 120.0e6, 1800.0)
const CARTILAGE_ENDPLATE = MaterialProperties(12.0e6, 0.42, 5.0e6, 1100.0)
const OSTEOPOROTIC_BONE = MaterialProperties(0.1e9, 0.25, 0.5e6, 150.0)

# ── Titanium implant ──
const TITANIUM_6AL4V = MaterialProperties(110.0e9, 0.34, 880.0e6, 4430.0)
const COBALT_CHROME = MaterialProperties(210.0e9, 0.30, 600.0e6, 8300.0)

# ── Grade de dégénérescence discale (Pfirrmann) ──
struct PfirrmannGrade
    grade::Int                  # I à V
    height_ratio::Float64       # fraction de la hauteur normale (1.0 = normal)
    nucleus_pressure_ratio::Float64  # fraction de la pression normale
    annulus_stiffness_ratio::Float64 # multiplicateur de rigidité
    
    function PfirrmannGrade(g::Int)
        @assert 1 ≤ g ≤ 5 "Grade Pfirrmann: 1-5"
        ratios = [
            (1.00, 1.00, 1.00),  # I — normal
            (0.90, 0.85, 1.10),  # II
            (0.75, 0.60, 1.30),  # III
            (0.60, 0.30, 1.60),  # IV
            (0.40, 0.10, 2.00),  # V — sévère
        ]
        h, p, a = ratios[g]
        new(g, h, p, a)
    end
end

# ── Chargement mécanique ──
struct Load
    point::Vec3         # Point d'application (coordonnées globales)
    force::Vec3         # Vecteur force (N)
    moment::Vec3        # Vecteur moment (N·m)
end

# ── Tenseur de contrainte ──
struct StressTensor
    σ::Mat3             # Tenseur de Cauchy 3×3
end

function von_mises(s::StressTensor)::Float64
    σ = s.σ
    σ11, σ22, σ33 = σ[1,1], σ[2,2], σ[3,3]
    σ12, σ13, σ23 = σ[1,2], σ[1,3], σ[2,3]
    return sqrt(0.5 * ((σ11 - σ22)^2 + (σ22 - σ33)^2 + (σ33 - σ11)^2 +
                        6 * (σ12^2 + σ13^2 + σ23^2)))
end

# ── Retour de force haptique ──
struct HapticFeedback
    resistance::Float64     # N
    vibration::Float64      # 0.0 - 1.0
end
