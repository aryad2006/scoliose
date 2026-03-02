# ══════════════════════════════════════════════════════════════
# Vertex — Hernie Discale
# ══════════════════════════════════════════════════════════════

"""
Type de hernie discale selon la classification morphologique.
"""
@enum HerniaType begin
    PROTRUSION      # Bombement symétrique, base large, annulus intact
    EXTRUSION       # Herniation focale, base étroite, à travers l'annulus
    SEQUESTRATION   # Fragment libre détaché du disque parent
    BULGING         # Bombement diffus (>50% de la circonférence)
end

"""
Localisation de la hernie dans le plan axial.
"""
@enum HerniaLocation begin
    CENTRAL         # Médiane — sténose canalaire
    PARACENTRAL     # Paramédiane — compression radiculaire ipsilatérale
    FORAMINAL       # Foraminale — compression de la racine sortante
    EXTRAFORAMINAL  # Extra-foraminale — racine sus-jacente
    LATERAL         # Latérale
end

"""
Paramètres de hernie discale.
"""
struct HerniaParameters
    level::DiscLevel                    # Niveau discal (ex: L4L5)
    hernia_type::HerniaType
    location::HerniaLocation
    side::Symbol                        # :left, :right, :central
    
    # Dimensions
    protrusion_mm::Float64              # Saillie postérieure (mm)
    base_width_mm::Float64              # Largeur de la base (mm)
    height_mm::Float64                  # Hauteur crânio-caudale (mm)
    
    # Contexte discal
    pfirrmann_grade::Int                # 1-5 (dégénérescence)
    disc_height_loss::Float64           # % de perte de hauteur discale
    
    # Impact neurologique
    canal_compromise::Float64           # % de sténose canalaire (0-1)
    root_compression::Bool              # Compression radiculaire
    thecal_sac_compression::Bool        # Compression du sac thécal
    
    # Classification MSU (Michigan State University)
    msu_grade::Int                      # 1-5
end

"""
    generate_hernia!(model::SpineModel, params::HerniaParameters)

Applique une hernie discale avec ses conséquences biomécaniques :
- Perte de hauteur discale
- Diminution de la pression intra-discale
- Sténose canalaire
- Déséquilibre sagittal local
"""
function generate_hernia!(model::SpineModel, params::HerniaParameters)
    disc_idx = findfirst(d -> d.level == params.level, model.discs)
    isnothing(disc_idx) && error("Disque $(params.level) non trouvé")
    
    disc = model.discs[disc_idx]
    
    # ── 1. Dégénérescence discale ──
    disc.degeneration = PfirrmannGrade(params.pfirrmann_grade)
    disc.height *= (1.0 - params.disc_height_loss)
    
    # ── 2. Modification des propriétés mécaniques ──
    # Perte de pression nucléaire (noyau déshydraté)
    disc.nucleus.pressure *= disc.degeneration.nucleus_pressure_ratio
    disc.nucleus.water_content -= 0.05 * params.pfirrmann_grade
    
    # Annulus : fissuration + rigidification
    for fiber in disc.annulus.fiber_families
        # Les fibres rompues perdent leur rigidité dans la zone herniée
        if params.location in (CENTRAL, PARACENTRAL)
            fiber_loss = 0.3 * params.protrusion_mm / 10.0  # Plus la hernie est grosse...
        else
            fiber_loss = 0.2 * params.protrusion_mm / 10.0
        end
    end
    
    # ── 3. Affaissement discal → rapprochement des vertèbres adjacentes ──
    dz = disc.height * params.disc_height_loss / 2.0
    
    # La vertèbre sus-jacente descend
    upper_idx = disc_idx
    if upper_idx >= 1 && upper_idx <= length(model.vertebrae)
        for i in 1:upper_idx
            p = model.vertebrae[i].position
            model.vertebrae[i].position = Vec3(p[1], p[2], p[3] - dz)
        end
    end
    
    # ── 4. Inclinaison antalgique (le patient se penche du côté opposé) ──
    if params.side == :left
        shift = params.protrusion_mm * 0.5  # L'attitude antalgique penche à droite
    elseif params.side == :right
        shift = -params.protrusion_mm * 0.5
    else
        shift = 0.0
    end
    
    # Appliquer un léger shift latéral aux vertèbres sus-jacentes
    for i in 1:upper_idx
        t = (upper_idx - i + 1) / upper_idx
        p = model.vertebrae[i].position
        model.vertebrae[i].position = Vec3(p[1] + shift * t, p[2], p[3])
    end
    
    model.is_solved = false
    return model
end

# ── Cas prédéfinis ──

"""
Hernie discale L4-L5 postéro-latérale gauche classique (sciatique L5).
"""
function hernia_l4l5_left(; protrusion::Float64=8.0, pfirrmann::Int=3)
    return HerniaParameters(
        L4L5, EXTRUSION, PARACENTRAL, :left,
        protrusion, 12.0, 8.0,
        pfirrmann, 0.20,
        0.25, true, false,
        3
    )
end

"""
Hernie discale L5-S1 médiane (syndrome de la queue de cheval).
"""
function hernia_l5s1_central(; protrusion::Float64=12.0)
    return HerniaParameters(
        L5S1, EXTRUSION, CENTRAL, :central,
        protrusion, 20.0, 10.0,
        4, 0.30,
        0.50, true, true,
        5
    )
end

"""
Hernie discale cervicale C5-C6 paramédiane droite.
"""
function hernia_c5c6_right(; protrusion::Float64=5.0)
    return HerniaParameters(
        C5C6, PROTRUSION, PARACENTRAL, :right,
        protrusion, 8.0, 5.0,
        2, 0.15,
        0.20, true, false,
        2
    )
end
