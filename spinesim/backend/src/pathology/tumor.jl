# ══════════════════════════════════════════════════════════════
# Vertex — Tumeurs rachidiennes
# ══════════════════════════════════════════════════════════════

"""
Siège anatomique de la tumeur dans/autour de la vertèbre.
"""
@enum TumorCompartment begin
    VERTEBRAL_BODY      # Corps vertébral (métastases les plus fréquentes)
    POSTERIOR_ELEMENTS   # Arc postérieur (pédicules, lames)
    EPIDURAL            # Épidurale (compression médullaire)
    INTRADURAL_EXTRA     # Intradurale extramédullaire (méningiome, schwannome)
    INTRAMEDULLARY       # Intramédullaire (épendymome, astrocytome)
end

"""
Classification de Weinstein-Boriani-Biagini (WBB) — localisation dans le plan axial.
12 secteurs horaires (1-12) + 5 couches (A-E).
"""
struct WBBClassification
    sectors::Vector{Int}    # Secteurs atteints (1-12, horaire)
    layers::Vector{Char}    # Couches envahies: A(extraosseux), B(intraosseux superficiel),
                            # C(intraosseux profond), D(extradural), E(intradural)
end

"""
Score de Tokuhashi (pronostic de survie pour métastases rachidiennes).
Score révisé (0-15): ≤8 → < 6 mois, 9-11 → > 6 mois, ≥12 → > 12 mois.
"""
struct TokuhashiScore
    general_condition::Int       # 0-2 (KPS)
    extraspinal_bone_mets::Int   # 0-2 
    spinal_mets_count::Int       # 0-2
    major_organ_mets::Int        # 0-2
    primary_tumor_site::Int      # 0-5 (poumon=0, foie/estomac=1, ..., rein/thyroïde=5)
    neurological_deficit::Int    # 0-2 (complet=0, incomplet=1, aucun=2)
    total::Int                   # Somme 0-15
end

function compute_tokuhashi(gc::Int, bone::Int, spine_n::Int, organ::Int, primary::Int, neuro::Int)
    total = gc + bone + spine_n + organ + primary + neuro
    return TokuhashiScore(gc, bone, spine_n, organ, primary, neuro, total)
end

"""
Score de Tomita (stratégie chirurgicale pour métastases).
Score 2-10: 2-3 → résection large, 4-5 → résection marginale/intra-lésionnelle,
6-7 → chirurgie palliative, 8-10 → traitement non-chirurgical.
"""
struct TomitaScore
    primary_growth_rate::Int     # 1 (lent), 2 (modéré), 4 (rapide)
    visceral_mets::Int           # 0 (aucune), 2 (traitable), 4 (non-traitable)
    bone_mets::Int               # 1 (solitaire), 2 (multiples)
    total::Int
end

function compute_tomita(growth::Int, visc::Int, bone::Int)
    return TomitaScore(growth, visc, bone, growth + visc + bone)
end

"""
Classification SINS (Spinal Instability Neoplastic Score).
0-18 : 0-6 stable, 7-12 potentiellement instable, 13-18 instable.
"""
struct SINSScore
    location::Int           # 0-3 (sacré→jonction)
    pain::Int               # 0-3
    bone_lesion::Int        # 0-2 (blastique→lytique)
    alignment::Int          # 0-4 (scoliose/kyphose)
    vertebral_body::Int     # 0-3 (intact→>50% collapse)
    posterolateral::Int     # 0-3 (intact→bilatéral)
    total::Int
end

function compute_sins(loc::Int, pain::Int, bone::Int, align::Int, body::Int, post::Int)
    total = loc + pain + bone + align + body + post
    return SINSScore(loc, pain, bone, align, body, post, total)
end

"""
Paramètres de tumeur rachidienne.
"""
struct TumorParameters
    level::VertebralLevel              # Vertèbre atteinte
    compartment::TumorCompartment
    wbb::WBBClassification             # Classification WBB
    
    # Nature
    is_metastatic::Bool                # Métastase vs tumeur primitive
    primary_site::String               # Site primaire (si métastase) : "poumon", "sein", "rein"...
    is_lytic::Bool                     # Lytique (destruction osseuse) vs blastique (ostéocondensante)
    
    # Extension
    vertebral_body_involvement::Float64  # % du corps vertébral envahi (0-1)
    pedicle_destruction::Symbol          # :none, :unilateral, :bilateral
    epidural_extension::Float64          # % d'extension épidurale (0-1)
    soft_tissue_mass::Float64            # Volume paravertébral (cm³)
    
    # Stabilité
    sins::SINSScore
    
    # Pronostic
    tokuhashi::Union{TokuhashiScore, Nothing}
    tomita::Union{TomitaScore, Nothing}
    
    # Multi-niveaux
    multi_level::Bool
    adjacent_levels::Vector{VertebralLevel}
    
    # Compression neurologique
    cord_compression::Bool               # Compression médullaire
    escc_grade::Int                      # ESCC 0-3 (Epidural Spinal Cord Compression)
end

"""
    generate_tumor!(model::SpineModel, params::TumorParameters)

Applique une lésion tumorale au rachis.
"""
function generate_tumor!(model::SpineModel, params::TumorParameters)
    idx = level_index(params.level)
    levels = [idx]
    
    if params.multi_level
        for adj in params.adjacent_levels
            push!(levels, level_index(adj))
        end
    end
    
    for lidx in levels
        vb = model.vertebrae[lidx]
        
        # ── 1. Destruction osseuse (lytique) ──
        if params.is_lytic
            inv = params.vertebral_body_involvement
            
            # Affaiblissement structurel proportionnel à l'invasion
            morph = vb.morphology
            new_height = morph.body_height * (1.0 - 0.5 * inv)  # Tassement
            
            # Réduction de rigidité du segment
            stiffness_factor = 1.0 - 0.7 * inv  # Jusqu'à 70% de perte
            
            for lig in model.ligaments
                if lig.level_index == lidx && lig.type in (LVCA, LVCP)
                    lig.linear_stiffness *= stiffness_factor
                end
            end
            
            # Tassement vertébral
            pos = vb.position
            collapse = morph.body_height * 0.5 * inv
            model.vertebrae[lidx].position = Vec3(pos[1], pos[2], pos[3] - collapse)
            
        else
            # ── Lésion blastique → augmentation de rigidité ──
            for lig in model.ligaments
                if lig.level_index == lidx
                    lig.linear_stiffness *= 1.5  # Sclérose
                end
            end
        end
        
        # ── 2. Destruction pédiculaire ──
        if params.pedicle_destruction == :bilateral
            # Déstabilisation majeure de l'arc postérieur
            for lig in model.ligaments
                if lig.level_index == lidx && lig.type in (ISL, SSL, LF)
                    lig.linear_stiffness *= 0.2
                end
            end
        elseif params.pedicle_destruction == :unilateral
            for lig in model.ligaments
                if lig.level_index == lidx && lig.type in (ISL, SSL, LF)
                    lig.linear_stiffness *= 0.5
                end
            end
        end
        
        # ── 3. Déformation kyphotique (tassement asymétrique) ──
        if params.vertebral_body_involvement > 0.3
            kyphosis_angle = deg2rad(params.vertebral_body_involvement * 20.0)
            R = rotation_matrix(kyphosis_angle, 0.0, 0.0)
            model.vertebrae[lidx].orientation = R * vb.orientation
        end
        
        # ── 4. Impact sur les disques adjacents ──
        if lidx <= length(model.discs)
            disc = model.discs[lidx]
            disc.height *= (1.0 - 0.4 * params.vertebral_body_involvement)
        end
    end
    
    model.is_solved = false
    return model
end

# ── Cas prédéfinis ──

"""
Métastase lytique T12 (carcinome pulmonaire) — cas typique d'urgence neurachirurgicale.
"""
function metastasis_t12_lung()
    sins = compute_sins(3, 3, 2, 2, 2, 1)    # Score 13 → instable
    tok  = compute_tokuhashi(1, 0, 1, 0, 0, 1) # Score faible → < 6 mois
    tom  = compute_tomita(4, 4, 2)             # Score 10 → non-chirurgical
    
    return TumorParameters(
        T12, VERTEBRAL_BODY,
        WBBClassification([4,5,6,7,8,9], ['A','B','C','D']),
        true, "poumon", true,
        0.65, :unilateral, 0.40, 25.0,
        sins, tok, tom,
        false, VertebralLevel[],
        true, 2
    )
end

"""
Métastase T7 (carcinome du sein) — lésion lytique avec compression médullaire.
"""
function metastasis_t7_breast()
    sins = compute_sins(2, 2, 2, 0, 1, 0)
    tok  = compute_tokuhashi(2, 1, 1, 1, 3, 1)  # Score 9 → > 6 mois
    tom  = compute_tomita(2, 0, 1)               # Score 3 → résection large possible
    
    return TumorParameters(
        T7, VERTEBRAL_BODY,
        WBBClassification([4,5,6,7,8], ['B','C']),
        true, "sein", true,
        0.40, :none, 0.20, 10.0,
        sins, tok, tom,
        false, VertebralLevel[],
        true, 1
    )
end

"""
Tumeur primitive L2 (ostéoblastome) — lésion bénigne agressive de l'arc postérieur.
"""
function osteoblastoma_l2()
    sins = compute_sins(1, 1, 0, 0, 0, 2)       # Score 4 → stable
    
    return TumorParameters(
        L2, POSTERIOR_ELEMENTS,
        WBBClassification([10,11,12,1,2], ['B','C']),
        false, "ostéoblastome", false,
        0.15, :unilateral, 0.10, 5.0,
        sins, nothing, nothing,
        false, VertebralLevel[],
        false, 0
    )
end
