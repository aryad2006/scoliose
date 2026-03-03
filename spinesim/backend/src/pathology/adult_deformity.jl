# ══════════════════════════════════════════════════════════════
# Vertex — Déformités rachidiennes de l'adulte
# ══════════════════════════════════════════════════════════════

"""
Classification SRS-Schwab des déformités dégénératives de l'adulte.
Type de courbe coronale + 3 modificateurs sagittaux.
"""

"""
Type de courbe coronale SRS-Schwab.
"""
@enum SRSSchwabCurveType begin
    SCHWAB_TYPE_N   # Pas de déformité coronale significative (Cobb < 30°)
    SCHWAB_TYPE_T   # Thoracique seul (apex T1-T12)
    SCHWAB_TYPE_L   # Thoraco-lombaire/Lombaire (apex T12-L5)
    SCHWAB_TYPE_D   # Double courbe (thoracique + lombaire)
end

"""
Modificateur PI-LL (Pelvic Incidence - Lordose Lombaire).
Paramètre sagittal le plus corrélé aux résultats cliniques (HRQoL).
"""
@enum PILLModifier begin
    PI_LL_0   # PI - LL < 10° (aligné)
    PI_LL_1   # PI - LL 10-20° (modéré)
    PI_LL_2   # PI - LL > 20° (malalignement sagittal sévère)
end

"""
Modificateur de version pelvienne (Pelvic Tilt, PT).
Reflète le mécanisme de compensation pelvienne.
"""
@enum PTModifier begin
    PT_0   # PT < 20° (normal)
    PT_1   # PT 20-30° (compensation modérée)
    PT_2   # PT > 30° (compensation maximale, mauvais pronostic)
end

"""
Modificateur Global Alignment (SVA — Sagittal Vertical Axis).
"""
@enum SVAModifier begin
    SVA_0   # SVA < 4 cm (aligné)
    SVA_1   # SVA 4-9.5 cm (déséquilibre modéré)
    SVA_2   # SVA > 9.5 cm (déséquilibre sévère, regard au sol)
end

"""
Type spécifique de déformité de l'adulte.
"""
@enum AdultDeformityType begin
    DEGENERATIVE_SCOLIOSIS      # Scoliose de novo (dégénérative pure, adulte > 50 ans)
    PROGRESSIVE_IDIOPATHIC      # Scoliose idiopathique vieillie (résiduelle de l'adolescence)
    FLAT_BACK_SYNDROME          # Dos plat iatrogénique (perte de lordose post-arthrodèse)
    PROXIMAL_JUNCTIONAL_KYPHOSIS # PJK post-instrumenté
    FIXED_SAGITTAL_IMBALANCE    # Déséquilibre sagittal fixé (ankylose + cyphose)
    SCHEUERMANN_ADULT           # Maladie de Scheuermann résiduelle chez l'adulte
    IATROGENIC_DEFORMITY        # Déformité iatrogénique post-chirurgicale
end

"""
Paramètres d'équilibre sagittal et spino-pelviens.
"""
struct SagittalBalance
    pelvic_incidence::Float64     # PI (degrés) — paramètre anatomique fixe
    pelvic_tilt::Float64          # PT (degrés) — rétroversion compensatoire
    sacral_slope::Float64         # SS (degrés) — PI = PT + SS
    lumbar_lordosis::Float64      # LL (degrés) — valeur algébrique
    thoracic_kyphosis::Float64    # TK (degrés, T4-T12)
    sva::Float64                  # SVA (cm) — Sagittal Vertical Axis (fil à plomb C7-S1)
    t1_spi::Float64               # T1 Spino-Pelvic Inclination (degrés)
    pi_ll_mismatch::Float64       # PI - LL (degrés)
    
    # Mécanismes compensatoires
    knee_flexion::Float64         # Flexion des genoux (degrés)
    ankle_dorsiflexion::Float64   # Dorsiflexion cheville (degrés)
end

"""
Paramètres de déformité rachidienne de l'adulte.
"""
struct AdultDeformityParameters
    deformity_type::AdultDeformityType
    
    # Classification SRS-Schwab
    schwab_curve::SRSSchwabCurveType
    pi_ll_mod::PILLModifier
    pt_mod::PTModifier
    sva_mod::SVAModifier
    
    # Courbe coronale (si présente)
    coronal_cobb::Float64               # Cobb coronal (degrés)
    coronal_apex::VertebralLevel        # Apex de la courbe
    
    # Équilibre sagittal complet
    sagittal::SagittalBalance
    
    # Dégénérescence associée
    disc_degeneration_levels::Vector{VertebralLevel}  # Niveaux avec discopathie
    facet_arthropathy_levels::Vector{VertebralLevel}   # Niveaux avec arthrose facettaire
    
    # Sténose associée
    stenosis_levels::Vector{VertebralLevel}  # Niveaux avec sténose canalaire
    
    # Ostéoporose
    bone_density_tscore::Float64        # T-score DEXA (< -2.5 = ostéoporose)
    
    # Symptômes
    back_pain_vas::Float64              # EVA douleur lombaire (0-10)
    leg_pain_vas::Float64               # EVA douleur radiculaire (0-10)
    odi_score::Float64                  # Oswestry Disability Index (0-100%)
    walking_distance::Float64           # Périmètre de marche (mètres)
end

"""
    generate_adult_deformity!(model::SpineModel, params::AdultDeformityParameters)

Applique une déformité de l'adulte au modèle rachidien.
"""
function generate_adult_deformity!(model::SpineModel, params::AdultDeformityParameters)
    sag = params.sagittal
    
    # ── 1. Perte de lordose lombaire ──
    normal_ll = sag.pelvic_incidence - 10.0  # LL idéale ≈ PI - 10°
    ll_deficit = normal_ll - sag.lumbar_lordosis  # Excès de cyphose lombaire en degrés
    
    if ll_deficit > 0
        # Répartir la perte de lordose sur les segments lombaires (L1-L5)
        n_lumbar = 5
        per_segment = deg2rad(ll_deficit / n_lumbar)
        
        for i in 1:n_lumbar
            level = vertebral_levels()[17 + i]  # L1 à L5 (index 18-22 dans le tableau)
            idx = level_index(level)
            if idx <= length(model.vertebrae)
                vb = model.vertebrae[idx]
                R = rotation_matrix(per_segment, 0.0, 0.0)  # Flexion sagittale
                model.vertebrae[idx].orientation = R * vb.orientation
            end
        end
    end
    
    # ── 2. Hypercyphose thoracique (si Scheuermann ou compensatoire) ──
    if sag.thoracic_kyphosis > 45.0  # Normal: 20-45°
        excess_tk = sag.thoracic_kyphosis - 40.0
        n_thoracic = 9  # T4-T12
        per_segment = deg2rad(excess_tk / n_thoracic)
        
        for i in 1:n_thoracic
            level = vertebral_levels()[8 + i]  # T4 à T12 (index 9-17 dans le tableau)
            idx = level_index(level)
            if idx <= length(model.vertebrae)
                vb = model.vertebrae[idx]
                R = rotation_matrix(per_segment, 0.0, 0.0)
                model.vertebrae[idx].orientation = R * vb.orientation
            end
        end
    end
    
    # ── 3. Déséquilibre sagittal global (SVA) ──
    if sag.sva > 0
        sva_mm = sag.sva * 10.0  # cm → mm
        n_vert = length(model.vertebrae)
        for i in 1:n_vert
            p = model.vertebrae[i].position
            # Le tronc bascule progressivement en avant (sommet = max)
            t = (n_vert - i) / n_vert
            model.vertebrae[i].position = Vec3(
                p[1], p[2] + sva_mm * t, p[3]
            )
        end
    end
    
    # ── 4. Déformité coronale (scoliose dégénérative) ──
    if params.coronal_cobb > 10.0
        apex_idx = level_index(params.coronal_apex)
        θ_max = deg2rad(params.coronal_cobb / 2.0)
        
        for i in 1:length(model.vertebrae)
            dist = abs(i - apex_idx)
            max_dist = max(apex_idx - 1, length(model.vertebrae) - apex_idx)
            factor = max(0.0, 1.0 - dist / max_dist)
            
            θ = θ_max * factor
            R = rotation_matrix(0.0, 0.0, θ)
            model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
            
            # Déviation latérale
            lat = sin(θ) * 30.0 * factor  # Jusqu'à 30mm de déviation
            p = model.vertebrae[i].position
            model.vertebrae[i].position = Vec3(p[1] + lat, p[2], p[3])
        end
    end
    
    # ── 5. Dégénérescence discale ──
    for level in params.disc_degeneration_levels
        idx = level_index(level)
        if idx <= length(model.discs)
            disc = model.discs[idx]
            disc.height *= 0.6
            disc.nucleus.pressure *= 0.3
            # Fibrose de l'annulus → augmenter la rigidité de la matrice
            gm = disc.annulus.ground_matrix
            new_E = gm.youngs_modulus * 1.5
            disc.annulus.ground_matrix = MaterialProperties(new_E, gm.poissons_ratio, gm.yield_stress, gm.density)
        end
    end
    
    # ── 6. Arthrose facettaire ──
    for level in params.facet_arthropathy_levels
        idx = level_index(level)
        for lig in model.ligaments
            if level_index(lig.level) == idx && lig.type == CL
                lig.linear_stiffness *= 2.0  # Ankylose facettaire
            end
        end
    end
    
    # ── 7. Ostéoporose globale ──
    if params.bone_density_tscore < -1.0
        # Factor de pénalité osseuse : -2.5 → 0.5, -4.0 → 0.3
        bone_factor = max(0.3, 1.0 + 0.2 * params.bone_density_tscore)
        for lig in model.ligaments
            if lig.type in (LVCA, LVCP)
                lig.linear_stiffness *= bone_factor
            end
        end
    end
    
    model.is_solved = false
    return model
end

# ── Cas prédéfinis ──

"""
Scoliose dégénérative lombaire L2-L4, femme 68 ans, déséquilibre sagittal modéré.
"""
function degenerative_scoliosis_l2l4()
    sag = SagittalBalance(
        55.0,   # PI
        28.0,   # PT — compensation pelvienne
        27.0,   # SS
        30.0,   # LL — perte de lordose
        42.0,   # TK
        6.5,    # SVA (cm)
        3.0,    # T1-SPI
        25.0,   # PI-LL mismatch
        10.0,   # Flexion genoux
        5.0     # Dorsiflexion
    )
    
    return AdultDeformityParameters(
        DEGENERATIVE_SCOLIOSIS,
        SCHWAB_TYPE_L, PI_LL_2, PT_1, SVA_1,
        35.0, L3,
        sag,
        [L2, L3, L4, L5],     # Discopathie
        [L3, L4, L5],          # Arthrose facettaire
        [L3, L4],              # Sténose
        -2.8,                   # Ostéoporose
        6.5, 4.0, 42.0, 400.0
    )
end

"""
Dos plat post-arthrodèse (flat back syndrome) — L1-L5, perte de lordose majeure.
"""
function flat_back_post_fusion()
    sag = SagittalBalance(
        58.0,   # PI
        35.0,   # PT — rétroversion maximale
        23.0,   # SS
        15.0,   # LL — quasi-nulle
        35.0,   # TK
        12.0,   # SVA (cm) — déséquilibre majeur
        8.0,    # T1-SPI
        43.0,   # PI-LL mismatch sévère
        20.0,   # Flexion genoux importante
        10.0
    )
    
    return AdultDeformityParameters(
        FLAT_BACK_SYNDROME,
        SCHWAB_TYPE_N, PI_LL_2, PT_2, SVA_2,
        10.0, L3,
        sag,
        [L1, L2, L3, L4, L5],
        [L1, L2],
        [L2, L3],
        -1.5,
        8.0, 3.0, 56.0, 200.0
    )
end

"""
Cyphose de Scheuermann résiduelle (adulte 40 ans) — TK > 60°, thoraco-lombaire.
"""
function scheuermann_adult()
    sag = SagittalBalance(
        50.0, 15.0, 35.0,
        50.0,     # LL compensatoire augmentée
        65.0,     # TK excessive
        3.0,      # SVA encore compensé
        1.0,
        0.0,      # PI-LL ok (compensé par hyperlordose)
        0.0, 0.0
    )
    
    return AdultDeformityParameters(
        SCHEUERMANN_ADULT,
        SCHWAB_TYPE_T, PI_LL_0, PT_0, SVA_0,
        0.0, T8,
        sag,
        [T8, T9, T10, T11],    # Schmorl + discopathie
        VertebralLevel[],
        VertebralLevel[],
        -0.5,
        5.0, 0.0, 28.0, 2000.0
    )
end

"""
Scoliose idiopathique vieillie — courbe thoraco-lombaire résiduelle progressive.
"""
function progressive_idiopathic_adult()
    sag = SagittalBalance(
        52.0, 22.0, 30.0,
        35.0,
        48.0,
        5.0,
        2.0,
        17.0,
        5.0, 3.0
    )
    
    return AdultDeformityParameters(
        PROGRESSIVE_IDIOPATHIC,
        SCHWAB_TYPE_D, PI_LL_1, PT_1, SVA_1,
        48.0, L1,
        sag,
        [T11, T12, L1, L2, L3],
        [L2, L3, L4],
        [L2, L3],
        -1.8,
        5.0, 5.0, 38.0, 500.0
    )
end
