# ══════════════════════════════════════════════════════════════
# Vertex — Générateur de Scoliose Paramétrable
# ══════════════════════════════════════════════════════════════

"""
Paramètres de scoliose — classification Lenke, courbures, équilibre.
"""
struct ScoliosisParameters
    # Classification Lenke
    lenke_type::Int                     # 1-6
    curve_type::Symbol                  # :thoracic, :thoracolumbar, :lumbar, :double
    
    # Courbure principale
    main_apex::VertebralLevel           # vertèbre apicale (ex: T8)
    main_cobb::Float64                  # angle de Cobb (degrés)
    main_rotation::Float64              # rotation vertébrale (degrés, Nash-Moe)
    
    # Courbure(s) secondaire(s)
    secondary_apex::Union{VertebralLevel, Nothing}
    secondary_cobb::Float64
    
    # Équilibre
    coronal_balance::Float64            # mm (C7-CSVL, positif = droite)
    sagittal_balance::Float64           # mm (SVA, positif = avant)
    pelvic_incidence::Float64           # degrés
    
    # Patient
    risser::Int                         # 0-5
    flexibility::Float64               # % correction en bending latéral
end

"""
    generate_scoliosis!(model::SpineModel, params::ScoliosisParameters)

Applique une déformation scoliotique paramétrable au rachis normal.
Méthode : déplacement latéral + rotation axiale + cunéiformisation vertébrale.
"""
function generate_scoliosis!(model::SpineModel, params::ScoliosisParameters)
    # ── 1. Courbure coronale principale ──
    apply_coronal_curve!(model, params.main_apex, params.main_cobb)
    
    # ── 2. Rotation axiale vertébrale ──
    apply_axial_rotation!(model, params.main_apex, params.main_rotation)
    
    # ── 3. Courbure secondaire compensatoire ──
    if !isnothing(params.secondary_apex)
        apply_coronal_curve!(model, params.secondary_apex, -params.secondary_cobb)
        apply_axial_rotation!(model, params.secondary_apex, -params.main_rotation * 0.5)
    end
    
    # ── 4. Cunéiformisation vertébrale (Hueter-Volkmann) ──
    apply_wedging!(model, params.main_apex, params.main_cobb)
    
    # ── 5. Déséquilibre global ──
    apply_global_balance!(model, params.coronal_balance, params.sagittal_balance)
    
    # ── 6. Ajuster la flexibilité ──
    adjust_flexibility!(model, params.flexibility)
    
    return model
end

"""
    apply_coronal_curve!(model, apex, cobb_angle)

Applique une courbure coronale (plan frontal) au rachis.
Utilise une distribution sinusoïdale du déplacement latéral.
"""
function apply_coronal_curve!(model::SpineModel, apex::VertebralLevel, cobb_angle::Float64)
    apex_idx = level_index(apex)
    n = length(model.vertebrae)
    
    # Distribution sinusoïdale du déplacement latéral
    # L'apex a le déplacement maximum, les extrémités sont à 0
    
    # Trouver l'étendue de la courbure (heuristique : ±5 niveaux autour de l'apex)
    span = 5
    start_idx = max(1, apex_idx - span)
    end_idx = min(n, apex_idx + span)
    curve_length = end_idx - start_idx
    
    # Amplitude du déplacement latéral
    # Pour un angle de Cobb de θ° sur n segments de longueur L,
    # le déplacement max ≈ L_total × sin(θ/2) / 2
    total_length = sum(norm(model.vertebrae[i+1].position - model.vertebrae[i].position) 
                       for i in start_idx:(end_idx-1))
    max_displacement = total_length * sin(deg2rad(cobb_angle) / 2) / 2
    
    for i in start_idx:end_idx
        # Phase sinusoïdale : 0 aux bords, 1 à l'apex
        t = (i - start_idx) / curve_length
        lateral_shift = max_displacement * sin(π * t)
        
        # Déplacer la vertèbre latéralement (axe x)
        pos = model.vertebrae[i].position
        model.vertebrae[i].position = Vec3(pos[1] + lateral_shift, pos[2], pos[3])
    end
    
    # Incliner les vertèbres (rotation dans le plan frontal)
    for i in start_idx:end_idx
        t = (i - start_idx) / curve_length
        # Angle local = dérivée du déplacement
        local_angle = cobb_angle * cos(π * t) * π / curve_length
        θz = deg2rad(local_angle / 2)
        R = rotation_matrix(0.0, 0.0, θz)
        model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
    end
end

"""
    apply_axial_rotation!(model, apex, max_rotation)

Applique la rotation axiale vertébrale associée à la scoliose.
La rotation est maximale à l'apex et diminue vers les extrémités.
Distribution différenciée selon la région (thoracique : 20-40°, lombaire : 10-20°).
"""
function apply_axial_rotation!(model::SpineModel, apex::VertebralLevel, max_rotation::Float64)
    apex_idx = level_index(apex)
    n = length(model.vertebrae)
    
    span = 5
    start_idx = max(1, apex_idx - span)
    end_idx = min(n, apex_idx + span)
    curve_length = end_idx - start_idx
    
    for i in start_idx:end_idx
        t = (i - start_idx) / curve_length
        rotation = max_rotation * sin(π * t)
        
        θx = deg2rad(rotation)
        R = rotation_matrix(θx, 0.0, 0.0)
        model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
    end
end

"""
    apply_wedging!(model, apex, cobb_angle)

Simule la cunéiformisation vertébrale (loi de Hueter-Volkmann).
En scoliose, la pression asymétrique provoque une croissance asymétrique
du corps vertébral → forme cunéiforme.
"""
function apply_wedging!(model::SpineModel, apex::VertebralLevel, cobb_angle::Float64)
    apex_idx = level_index(apex)
    
    # Cunéiformisation proportionnelle à la courbure locale
    # Affecte les 3 vertèbres autour de l'apex
    for offset in -2:2
        idx = apex_idx + offset
        if 1 ≤ idx ≤ length(model.vertebrae)
            wedge_factor = 1.0 - abs(offset) / 3.0  # max à l'apex
            wedge_angle = cobb_angle * 0.3 * wedge_factor  # ~30% vient de la cunéiformisation
            
            # Modifier la morphologie : asymétrie hauteur gauche/droite
            morph = model.vertebrae[idx].morphology
            # En pratique, on encode la cunéiformisation dans l'orientation
            θz = deg2rad(wedge_angle * wedge_factor)
            R = rotation_matrix(0.0, 0.0, θz)
            model.vertebrae[idx].orientation = R * model.vertebrae[idx].orientation
        end
    end
end

"""
    apply_global_balance!(model, coronal_shift, sagittal_shift)

Applique un déséquilibre global du rachis.
"""
function apply_global_balance!(model::SpineModel, coronal_shift::Float64, sagittal_shift::Float64)
    n = length(model.vertebrae)
    
    for i in 1:n
        # Gradient linéaire du sacrum (fixe) vers C3
        t = (n - i) / n  # 0 au sacrum, 1 en haut
        dx = coronal_shift * t
        dy = sagittal_shift * t
        
        pos = model.vertebrae[i].position
        model.vertebrae[i].position = Vec3(pos[1] + dx, pos[2] + dy, pos[3])
    end
end

"""
    adjust_flexibility!(model, flexibility_percent)

Ajuste la rigidité du modèle pour simuler différents degrés de flexibilité.
Flexibilité élevée = scoliose plus facilement corrigible.
"""
function adjust_flexibility!(model::SpineModel, flexibility_percent::Float64)
    flex_factor = flexibility_percent / 100.0
    
    # Augmenter la compliance des ligaments et disques dans la zone de courbure
    for lig in model.ligaments
        if !lig.is_ruptured
            lig.linear_stiffness *= (1.0 - 0.5 * flex_factor)
        end
    end
    
    for disc in model.discs
        disc.nucleus.C10 *= (1.0 - 0.3 * flex_factor)
    end
end

# ── Cas prédéfinis (Lenke) ──

"""
    lenke1_thoracic(cobb; kwargs...) → ScoliosisParameters

Scoliose idiopathique thoracique droite (Lenke 1) — la plus fréquente.
"""
function lenke1_thoracic(cobb::Float64=50.0; flexibility::Float64=40.0, risser::Int=3)
    return ScoliosisParameters(
        1, :thoracic,
        T8, cobb, cobb * 0.6,          # rotation ≈ 60% du Cobb
        L2, cobb * 0.5,                 # compensatoire lombaire
        0.0, 5.0, 50.0,                # équilibre
        risser, flexibility
    )
end

"""
    lenke5_thoracolumbar(cobb; kwargs...) → ScoliosisParameters

Scoliose thoraco-lombaire/lombaire gauche (Lenke 5).
"""
function lenke5_thoracolumbar(cobb::Float64=45.0; flexibility::Float64=50.0, risser::Int=4)
    return ScoliosisParameters(
        5, :thoracolumbar,
        L1, -cobb, -cobb * 0.4,        # rotation moindre au lombaire
        T6, cobb * 0.3,                 # compensatoire thoracique
        -5.0, 0.0, 55.0,
        risser, flexibility
    )
end
