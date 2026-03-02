# ══════════════════════════════════════════════════════════════
# Vertex — Fracture Vertébrale (Classification AO/Magerl)
# ══════════════════════════════════════════════════════════════

"""
Classification AO/Magerl des fractures du rachis.
Type A : Compression (A0-A4)
Type B : Distraction (B1-B3)
Type C : Translation/Rotation (C)
"""
@enum FractureType begin
    # Type A — Compression
    A0_minor   # Fracture mineure (processus épineux, transverse)
    A1_wedge   # Tassement cunéiforme (compression du mur antérieur)
    A2_split   # Fracture en fente (séparation sagittale/frontale)
    A3_burst_incomplete  # Burst incomplet (mur postérieur partiellement atteint)
    A4_burst_complete    # Burst complet (comminution + mur postérieur)
    
    # Type B — Distraction
    B1_ligamentous  # Distraction postérieure ligamentaire (chance osseux)
    B2_osseous      # Distraction postérieure osseuse (fracture Chance)
    B3_anterior     # Distraction antérieure à travers le disque/corps
    
    # Type C — Translation / Rotation
    C_translation   # Déplacement/Rotation (instabilité maximale)
end

"""
Paramètres de fracture vertébrale.
"""
struct FractureParameters
    level::VertebralLevel               # Vertèbre fracturée
    fracture_type::FractureType
    
    # Géométrie de la fracture
    compression_ratio::Float64          # % de perte de hauteur (0 → 1)
    kyphotic_angle::Float64             # Angle de cyphose segmentaire (degrés)
    canal_compromise::Float64           # % de sténose canalaire (0 → 1)
    
    # Fragments
    retropulse_mm::Float64              # Recul du fragment dans le canal (mm)
    num_fragments::Int                  # Nombre de fragments osseux
    
    # Stabilité (TLICS score)
    morphology_score::Int               # 0-2 (compression 1, burst 2)
    plc_integrity::Symbol               # :intact, :indeterminate, :disrupted (0-3 pts)
    neuro_status::Symbol                # :intact, :root, :cord_incomplete, :cord_complete, :cauda
    
    # Densité osseuse (influence le pattern de fracture)
    bone_tscore::Float64
end

"""
    compute_tlics(params::FractureParameters) → Int

Calcule le score TLICS (Thoracolumbar Injury Classification and Severity).
Score ≤3 : traitement conservateur
Score 4 : indéterminé 
Score ≥5 : traitement chirurgical
"""
function compute_tlics(params::FractureParameters)::Int
    # 1. Morphologie (0-2)
    morph = params.morphology_score
    
    # 2. Complexe ligamentaire postérieur (0-3)
    plc = if params.plc_integrity == :intact
        0
    elseif params.plc_integrity == :indeterminate
        2
    else  # :disrupted
        3
    end
    
    # 3. Statut neurologique (0-3)
    neuro = if params.neuro_status == :intact
        0
    elseif params.neuro_status == :root
        2
    elseif params.neuro_status == :cord_incomplete
        3
    elseif params.neuro_status == :cord_complete
        2
    else  # :cauda
        3
    end
    
    return morph + plc + neuro
end

"""
    generate_fracture!(model::SpineModel, params::FractureParameters)

Applique une fracture vertébrale au rachis avec déformation locale.
"""
function generate_fracture!(model::SpineModel, params::FractureParameters)
    idx = level_index(params.level)
    vb = model.vertebrae[idx]
    
    # ── 1. Compression du corps vertébral (perte de hauteur) ──
    # Modifier la hauteur effective du corps vertébral
    original_height = vb.morphology.body_height
    compressed_height = original_height * (1.0 - params.compression_ratio)
    
    # La compression est antérieure → déplacement AP + inclinaison sagittale
    pos = vb.position
    dz = -original_height * params.compression_ratio / 2.0
    model.vertebrae[idx].position = Vec3(pos[1], pos[2], pos[3] + dz)
    
    # ── 2. Cyphose segmentaire ──
    θy = deg2rad(params.kyphotic_angle)
    R = rotation_matrix(0.0, θy, 0.0)
    model.vertebrae[idx].orientation = R * vb.orientation
    
    # ── 3. Cascade : déplacer les vertèbres sus-jacentes ──
    for i in 1:(idx-1)
        p = model.vertebrae[i].position
        model.vertebrae[i].position = Vec3(p[1], p[2], p[3] + dz)
        
        # Légère inclinaison sagittale propagée
        t = (idx - i) / idx
        θ_prop = θy * 0.3 * t  # 30% de la cyphose se propage
        R_prop = rotation_matrix(0.0, θ_prop, 0.0)
        model.vertebrae[i].orientation = R_prop * model.vertebrae[i].orientation
    end
    
    # ── 4. Rétropulsion canalaire (burst fracture) ──
    if params.retropulse_mm > 0
        # Réduire la largeur/profondeur du canal (modélisation simplifiée)
        # Impact sur les structures neurales est reflété dans le canal_compromise
    end
    
    # ── 5. Affaiblissement des propriétés mécaniques ──
    # La vertèbre fracturée perd sa rigidité
    fracture_factor = max(0.1, 1.0 - params.compression_ratio * 1.5)
    model.vertebrae[idx].cortical = MaterialProperties(
        vb.cortical.youngs_modulus * fracture_factor,
        vb.cortical.poissons_ratio,
        vb.cortical.yield_stress * fracture_factor,
        vb.cortical.density * fracture_factor
    )
    model.vertebrae[idx].cancellous = MaterialProperties(
        vb.cancellous.youngs_modulus * fracture_factor^2,
        vb.cancellous.poissons_ratio,
        vb.cancellous.yield_stress * fracture_factor^2,
        vb.cancellous.density * fracture_factor
    )
    
    # ── 6. Lésions ligamentaires associées (type B/C) ──
    if params.fracture_type in (B1_ligamentous, B3_anterior, C_translation)
        for lig in model.ligaments
            if lig.level == params.level
                if lig.type in (ISL, SSL, LF)
                    lig.is_ruptured = true
                    lig.current_force = 0.0
                end
            end
        end
    end
    
    if params.fracture_type == C_translation
        # Rupture de tous les ligaments au niveau fracturé
        for lig in model.ligaments
            if lig.level == params.level
                lig.is_ruptured = true
                lig.current_force = 0.0
            end
        end
    end
    
    model.is_solved = false
    return model
end

# ── Cas prédéfinis ──

"""
Fracture-burst L1 typique (chute de hauteur, parachutisme).
"""
function burst_l1(; compression::Float64=0.40, canal::Float64=0.30)
    return FractureParameters(
        L1, A4_burst_complete,
        compression, 15.0, canal,
        8.0, 4,
        2, :indeterminate, :intact,
        0.0
    )
end

"""
Fracture-tassement ostéoporotique T12 (femme âgée, chute mineure).
"""
function osteoporotic_compression_T12(; compression::Float64=0.30)
    return FractureParameters(
        T12, A1_wedge,
        compression, 10.0, 0.0,
        0.0, 1,
        1, :intact, :intact,
        -3.0
    )
end

"""
Fracture Chance L2 (accident de voiture, ceinture abdominale).
"""
function chance_fracture_L2()
    return FractureParameters(
        L2, B2_osseous,
        0.10, 5.0, 0.10,
        2.0, 2,
        1, :disrupted, :root,
        0.0
    )
end

"""
Fracture-luxation T12 (polytraumatisme, instabilité maximale).
"""
function fracture_dislocation_T12()
    return FractureParameters(
        T12, C_translation,
        0.50, 25.0, 0.60,
        15.0, 5,
        2, :disrupted, :cord_incomplete,
        0.0
    )
end
