# ══════════════════════════════════════════════════════════════
# Vertex — Simulation de Vis Pédiculaire
# ══════════════════════════════════════════════════════════════

"""
Vis pédiculaire — implant chirurgical.
"""
struct PedicleScrew
    level::VertebralLevel
    side::Symbol                # :left ou :right
    entry_point::Vec3           # point d'entrée sur la vertèbre (mm)
    trajectory::Vec3            # direction de la vis (vecteur unité)
    diameter::Float64           # mm (4.5, 5.5, 6.5, 7.5)
    length::Float64             # mm (30-55)
    screw_type::Symbol          # :monoaxial, :polyaxial, :uniplanar
    material::MaterialProperties
end

"""
Résultat du placement d'une vis pédiculaire.
"""
struct ScrewResult
    is_placed::Bool
    breach::Symbol              # :none, :medial, :lateral, :anterior, :inferior
    breach_severity::Float64    # mm de dépassement (0 = pas de brèche)
    pullout_strength::Float64   # N (résistance à l'arrachement)
    accuracy::Float64           # % (vs trajectoire idéale)
    neural_risk::Float64        # 0-1 (risque neurologique)
    vascular_risk::Float64      # 0-1 (risque vasculaire)
end

"""
    ideal_entry_point(level, side, morphology) → Vec3

Calcule le point d'entrée idéal pour une vis pédiculaire (technique free-hand).
Référence : Kim et al., 2004; Weinstein JN.
"""
function ideal_entry_point(level::VertebralLevel, side::Symbol,
                           morph::VertebralMorphology, center::Vec3)
    # Le point d'entrée est à la jonction processus transverse / facette supérieure
    lateral = (side == :right) ? 1 : -1
    
    # Position relative au centre du corps vertébral
    x_offset = lateral * morph.body_width / 4    # ~1/4 de la largeur
    y_offset = -morph.body_depth / 2 - 5.0       # postérieur au corps
    z_offset = morph.body_height / 4              # quart supérieur
    
    return center + Vec3(x_offset, y_offset, z_offset)
end

"""
    ideal_trajectory(level, side, morphology) → Vec3

Calcule la trajectoire idéale de la vis pédiculaire.
Convergence médiale + inclinaison crânio-caudale selon le niveau.
"""
function ideal_trajectory(level::VertebralLevel, side::Symbol,
                          morph::VertebralMorphology)
    lateral = (side == :right) ? 1 : -1
    
    # Angle de convergence médiale (degrés) — varie selon le niveau
    medial_angle = if level in (T1, T2, T3, T4, T5)
        25.0  # thoracique supérieur : forte convergence
    elseif level in (T6, T7, T8, T9, T10)
        20.0  # thoracique moyen
    elseif level in (T11, T12)
        15.0  # jonction thoraco-lombaire
    elseif level in (L1, L2, L3)
        10.0  # lombaire supérieur
    elseif level in (L4, L5)
        5.0   # lombaire inférieur
    else
        15.0  # défaut
    end
    
    # Angle sagittal (légère inclinaison crânio-caudale)
    sagittal_angle = 5.0
    
    # Vecteur de direction
    θ_medial = deg2rad(medial_angle)
    θ_sagittal = deg2rad(sagittal_angle)
    
    dir = Vec3(
        -lateral * sin(θ_medial),     # convergence médiale
        cos(θ_medial) * cos(θ_sagittal),  # vers l'avant
        -sin(θ_sagittal)              # légèrement caudal
    )
    
    return dir / norm(dir)
end

"""
    simulate_screw_placement(model, screw) → ScrewResult

Simule le placement d'une vis pédiculaire et évalue la qualité du geste.
"""
function simulate_screw_placement(model::SpineModel, screw::PedicleScrew)
    vb = get_vertebra(model, screw.level)
    morph = vb.morphology
    
    # ── 1. Vérifier la compatibilité diamètre/pédicule ──
    max_diameter = morph.pedicle_width * 0.80  # marge de sécurité 20%
    
    if screw.diameter > morph.pedicle_width
        # Brèche inévitable
        breach_mm = screw.diameter - morph.pedicle_width
        return ScrewResult(false, :medial, breach_mm / 2, 0.0, 0.0, 0.9, 0.3)
    end
    
    # ── 2. Calculer la trajectoire idéale ──
    ideal_traj = ideal_trajectory(screw.level, screw.side, morph)
    ideal_entry = ideal_entry_point(screw.level, screw.side, morph, vb.position)
    
    # ── 3. Évaluer la précision ──
    entry_error = norm(screw.entry_point - ideal_entry)
    traj_error = acos(clamp(dot(screw.trajectory, ideal_traj), -1, 1))
    traj_error_deg = rad2deg(traj_error)
    
    accuracy = max(0.0, 100.0 - entry_error * 5.0 - traj_error_deg * 10.0)
    
    # ── 4. Détecter les brèches ──
    breach = :none
    breach_severity = 0.0
    
    # Le pédicule est un cylindre : si la trajectoire dévie trop, la vis sort
    clearance = (morph.pedicle_width - screw.diameter) / 2.0  # mm de marge
    
    # Déviation latérale au niveau du pédicule (à mi-chemin)
    deviation = entry_error + traj_error_deg * morph.body_depth / 57.3  # rad→mm
    
    if deviation > clearance
        breach_severity = deviation - clearance
        # Type de brèche selon la direction de déviation
        if traj_error_deg > 5 && dot(screw.trajectory, Vec3(1,0,0)) > 0
            breach = :lateral
        else
            breach = :medial  # Plus dangereux (vers la moelle)
        end
    end
    
    # ── 5. Pull-out strength (Halvorson et al., 1994) ──
    # F_pullout ∝ π × d × L × τ_interface × densité osseuse
    bone_density_factor = max(0.1, 1.0 + 0.15 * model.bone_tscore)
    τ_interface = 3.0 * bone_density_factor  # MPa
    contact_area = π * screw.diameter * screw.length  # mm²
    pullout = τ_interface * contact_area  # N
    
    # ── 6. Risques ──
    neural_risk = if breach == :medial
        min(1.0, breach_severity / 4.0)  # >4mm = risque max
    elseif breach == :anterior
        0.1
    else
        0.0
    end
    
    vascular_risk = if breach == :anterior
        min(1.0, breach_severity / 5.0)  # Aorte à risque (thoraco-lombaire)
    else
        0.0
    end
    
    return ScrewResult(
        breach_severity < 2.0,  # Placement accepté si brèche < 2mm
        breach, breach_severity,
        pullout, accuracy,
        neural_risk, vascular_risk
    )
end
