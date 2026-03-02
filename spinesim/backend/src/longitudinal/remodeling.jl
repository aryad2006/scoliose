# ══════════════════════════════════════════════════════════════
# Vertex — Remodelage Osseux Adaptatif (Loi de Wolff)
# et Dégénérescence Discale Progressive
# ══════════════════════════════════════════════════════════════

# ═══════════════════════════════════════════════════════════════
# REMODELAGE OSSEUX (Loi de Wolff)
# L'os se renforce là où les contraintes dépassent l'homéostase
# et se résorbe là où elles sont insuffisantes (astronautes, alitement)
# ═══════════════════════════════════════════════════════════════

"""
    initialize_remodeling_states(model::SpineModel) → Vector{BoneRemodelingState}

Initialise les états de remodelage osseux pour chaque vertèbre.
La densité initiale est uniforme (symétrique gauche/droite).
"""
function initialize_remodeling_states(model::SpineModel)
    states = BoneRemodelingState[]
    
    for vb in model.vertebrae
        # Contrainte homéostatique de référence : ~1-2 MPa pour os spongieux
        σ_ref = 1.5e6  # Pa
        
        push!(states, BoneRemodelingState(
            vb.level,
            Vec3(1.0, 1.0, 1.0),   # Densité uniforme (gauche, centre, droite)
            σ_ref,
            0.02,                   # Formation : 2% par mois max
            0.015,                  # Résorption : 1.5% par mois max
        ))
    end
    
    return states
end

"""
    update_bone_remodeling!(remodeling_states, model, stress_distribution,
                            rate_factor, dt_months)

Met à jour le remodelage osseux selon la loi de Wolff :
    dρ/dt = B × (σ - σ_ref)

Si σ > σ_ref → formation osseuse (densité augmente)  
Si σ < σ_ref → résorption osseuse (densité diminue)

En cas de charge asymétrique (scoliose), le côté concave (plus contraint)
se densifie et le côté convexe se résorbe.

Référence : Huiskes et al. (1987), Weinans et al. (1992).
"""
function update_bone_remodeling!(remodeling_states::Vector{BoneRemodelingState},
                                  model::SpineModel,
                                  stress_distribution::Vector{Float64},
                                  rate_factor::Float64,
                                  dt_months::Int)
    for (i, state) in enumerate(remodeling_states)
        if i > length(stress_distribution)
            continue
        end
        
        σ_mean = stress_distribution[i]
        vb = model.vertebrae[i]
        
        # ── Estimer la distribution de contrainte gauche/centre/droite ──
        # En cas d'asymétrie, la contrainte n'est pas uniforme
        σ_distribution = estimate_lateral_stress_distribution(vb, σ_mean)
        
        # ── Appliquer la loi de Wolff pour chaque zone ──
        for j in 1:3  # gauche, centre, droite
            σ_local = σ_distribution[j]
            Δσ = σ_local - state.homeostatic_stress
            
            if Δσ > 0
                # Formation osseuse
                Δρ = state.formation_rate * (Δσ / state.homeostatic_stress) * 
                     rate_factor * dt_months
            else
                # Résorption osseuse
                Δρ = state.resorption_rate * (Δσ / state.homeostatic_stress) *
                     rate_factor * dt_months
            end
            
            # Limiter le changement (bornes physiologiques)
            new_density = state.density_distribution[j] + Δρ
            new_density = clamp(new_density, 0.3, 2.0)  # 30% à 200% de la référence
            
            # Mise à jour
            state.density_distribution = setindex(state.density_distribution, new_density, j)
        end
    end
end

"""
    estimate_lateral_stress_distribution(vb::VertebralBody, σ_mean) → Vec3

Estime la distribution de contrainte gauche/centre/droite en fonction
de l'inclinaison de la vertèbre. Une vertèbre inclinée crée une
distribution asymétrique (plus de compression du côté concave).
"""
function estimate_lateral_stress_distribution(vb::VertebralBody, σ_mean::Float64)
    # L'inclinaison dans le plan frontal est donnée par la composante
    # (1,3) de la matrice d'orientation (couplage x-z)
    tilt_angle = atan(vb.orientation[1, 3], vb.orientation[3, 3])
    
    # Distribution : σ(x) = σ_mean × (1 + x/R × sin(θ))
    # où R est le rayon du corps vertébral et θ l'inclinaison
    R = vb.morphology.body_width / 2.0
    
    # Position latérale normalisée : gauche=-1, centre=0, droite=+1
    σ_left   = σ_mean * (1.0 + sin(tilt_angle) * 0.8)  # côté concave ↑
    σ_center = σ_mean
    σ_right  = σ_mean * (1.0 - sin(tilt_angle) * 0.8)  # côté convexe ↓
    
    return Vec3(max(0, σ_left), max(0, σ_center), max(0, σ_right))
end

"""
    apply_remodeling_effects!(model, remodeling_states)

Applique les effets du remodelage sur les propriétés mécaniques des vertèbres.
Le remodelage asymétrique crée un gradient de rigidité gauche/droite
qui peut amplifier ou stabiliser la courbure.
"""
function apply_remodeling_effects!(model::SpineModel,
                                    remodeling_states::Vector{BoneRemodelingState})
    for (i, state) in enumerate(remodeling_states)
        if i > length(model.vertebrae)
            continue
        end
        
        vb = model.vertebrae[i]
        
        # Densité effective = moyenne pondérée des zones
        ρ_eff = (state.density_distribution[1] + 
                 2.0 * state.density_distribution[2] + 
                 state.density_distribution[3]) / 4.0
        
        # Module de Young de l'os spongieux ∝ ρ² (Carter & Hayes, 1977)
        E_factor = ρ_eff^2
        
        model.vertebrae[i].cancellous = MaterialProperties(
            CANCELLOUS_BONE.youngs_modulus * E_factor,
            vb.cancellous.poissons_ratio,
            CANCELLOUS_BONE.yield_stress * E_factor,
            CANCELLOUS_BONE.density * ρ_eff
        )
        
        # ── Effet de l'asymétrie de densité sur la géométrie ──
        # Si un côté est plus dense, le corps vertébral se déforme 
        # progressivement (cunéiformisation adaptative = Hueter-Volkmann)
        asymmetry_ratio = state.density_distribution[1] / 
                         (state.density_distribution[3] + 1e-10)
        
        if abs(asymmetry_ratio - 1.0) > 0.02  # >2% d'asymétrie
            # Créer une légère cunéiformisation additionnelle
            wedge_increment = 0.01 * (asymmetry_ratio - 1.0)  # degrés
            θz = deg2rad(wedge_increment)
            R = rotation_matrix(0.0, 0.0, θz)
            model.vertebrae[i].orientation = R * vb.orientation
        end
    end
end

# ═══════════════════════════════════════════════════════════════
# DÉGÉNÉRESCENCE DISCALE PROGRESSIVE
# ═══════════════════════════════════════════════════════════════

"""
    initialize_disc_degeneration_states(model::SpineModel) → Vector{DiscDegenerationState}

Initialise les états de dégénérescence discale.
"""
function initialize_disc_degeneration_states(model::SpineModel)
    states = DiscDegenerationState[]
    
    for disc in model.discs
        push!(states, DiscDegenerationState(
            disc.level,
            disc.height,
            disc.height,
            disc.nucleus.water_content,
            Float64(disc.degeneration.grade),
            1.0,                        # Pas d'asymétrie initiale
            Vec3(0, 0, 0),             # Nucleus centré
            disc.nucleus.pressure
        ))
    end
    
    return states
end

"""
    update_disc_degeneration!(disc_states, model, stress_distribution,
                               fatigue_states, rate_factor, dt_months, age)

Met à jour la dégénérescence discale progressive.
La dégénérescence est accélérée par :
1. L'âge naturel
2. Les contraintes mécaniques élevées
3. Le dommage de fatigue accumulé
4. La perte de nutrition (micro-fractures plateau)

Référence : Adams & Roughley (2006), Urban & Roberts (2003).
"""
function update_disc_degeneration!(disc_states::Vector{DiscDegenerationState},
                                    model::SpineModel,
                                    stress_distribution::Vector{Float64},
                                    fatigue_states::Vector{SegmentFatigueState},
                                    rate_factor::Float64,
                                    dt_months::Int,
                                    current_age::Float64)
    for (i, state) in enumerate(disc_states)
        if i > length(model.discs) || i > length(stress_distribution)
            continue
        end
        
        disc = model.discs[i]
        
        # ── Taux de dégénérescence naturelle (liée à l'âge) ──
        # La dégénérescence s'accélère après 30 ans
        age_factor = if current_age < 20
            0.01  # Très lent pendant la croissance
        elseif current_age < 40
            0.03 + 0.002 * (current_age - 20)
        else
            0.05 + 0.003 * (current_age - 40)
        end
        
        # ── Facteur mécanique (surcharge) ──
        σ = stress_distribution[min(i, length(stress_distribution))]
        mech_factor = max(0.0, σ / 2.0e6 - 0.5)  # Accélération si σ > 1 MPa
        
        # ── Facteur de fatigue (dommage accumulé) ──
        fatigue_factor = 0.0
        if i ≤ length(fatigue_states)
            fatigue_factor = fatigue_states[i].endplate_damage * 0.5
        end
        
        # ── Taux total de dégénérescence ──
        total_rate = (age_factor + mech_factor + fatigue_factor) * rate_factor * dt_months / 12.0
        
        # ── Mise à jour des propriétés ──
        
        # 1. Grade de Pfirrmann (augmente avec le temps)
        state.current_pfirrmann = min(5.0, state.current_pfirrmann + total_rate * 0.1)
        
        # 2. Contenu en eau (diminue)
        state.water_content = max(0.3, state.water_content - total_rate * 0.02)
        
        # 3. Hauteur discale (diminue)
        height_loss = total_rate * 0.05 * state.initial_height  # mm
        state.current_height = max(state.initial_height * 0.4, 
                                    state.current_height - height_loss)
        
        # 4. Pression du nucleus (diminue avec la perte d'eau)
        state.nucleus_pressure = 0.15 * (state.water_content / 0.85)^2
        
        # ── Asymétrie discale développée ──
        # Si les contraintes sont asymétriques, le disque dégénère
        # plus vite d'un côté
        if i ≤ length(model.vertebrae)
            vb = model.vertebrae[i]
            tilt = atan(vb.orientation[1, 3], vb.orientation[3, 3])
            
            if abs(tilt) > deg2rad(1.0)  # Plus de 1° d'inclinaison
                # Le côté concave (comprimé) dégénère plus vite
                asym_rate = sin(tilt) * total_rate * 0.3
                state.height_asymmetry *= (1.0 + asym_rate)
                state.height_asymmetry = clamp(state.height_asymmetry, 0.5, 2.0)
                
                # Le nucleus se déplace vers le côté convexe
                shift = disc.width * 0.01 * sin(tilt) * abs(total_rate)
                state.nucleus_offset = Vec3(
                    state.nucleus_offset[1] + shift,
                    state.nucleus_offset[2],
                    state.nucleus_offset[3]
                )
            end
        end
    end
end

"""
    apply_disc_degeneration_effects!(model, disc_states)

Applique les effets de la dégénérescence discale au modèle.
"""
function apply_disc_degeneration_effects!(model::SpineModel,
                                           disc_states::Vector{DiscDegenerationState})
    for (i, state) in enumerate(disc_states)
        if i > length(model.discs)
            continue
        end
        
        disc = model.discs[i]
        
        # Mise à jour hauteur
        disc.height = state.current_height
        
        # Mise à jour propriétés du nucleus
        disc.nucleus.water_content = state.water_content
        disc.nucleus.pressure = state.nucleus_pressure
        
        # Module de compressibilité diminue avec la perte d'eau
        disc.nucleus.bulk_modulus = 1700.0e6 * (state.water_content / 0.85)
        
        # Paramètres Mooney-Rivlin dégradés
        degradation = state.current_pfirrmann / 5.0
        disc.nucleus.C10 = 0.12e6 * (1.0 - 0.7 * degradation)
        disc.nucleus.C01 = 0.03e6 * (1.0 - 0.7 * degradation)
        
        # Annulus : fibrose progressive (rigidification)
        for (j, fiber) in enumerate(disc.annulus.fiber_families)
            disc.annulus.fiber_families[j] = FiberFamily(
                fiber.orientation,
                fiber.stiffness * (1.0 + 0.5 * degradation),
                fiber.recruitment_strain * (1.0 + 0.3 * degradation)
            )
        end
        
        # ── Effet de l'asymétrie discale sur la géométrie ──
        # Un disque asymétrique crée une inclinaison du segment
        if abs(state.height_asymmetry - 1.0) > 0.01 && i < length(model.vertebrae)
            # L'asymétrie de hauteur crée un moment de flexion latérale
            # qui s'ajoute à la déformation existante
            Δh = state.current_height * (state.height_asymmetry - 1.0) * 0.5
            wedge_from_disc = atan(Δh, disc.width)
            
            θz = wedge_from_disc * 0.1  # Contribution fractionnelle
            R = rotation_matrix(0.0, 0.0, θz)
            model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
        end
    end
end
