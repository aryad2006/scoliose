# ══════════════════════════════════════════════════════════════
# Vertex — Modèle de Fatigue Cyclique
# Accumulation de dommage sous chargement répétitif (loi de Miner)
# ══════════════════════════════════════════════════════════════

"""
    initialize_fatigue_states(model::SpineModel) → Vector{SegmentFatigueState}

Initialise l'état de fatigue à zéro pour tous les segments intervertébraux.
"""
function initialize_fatigue_states(model::SpineModel)
    levels = vertebral_levels()
    states = SegmentFatigueState[]
    
    for i in 1:(length(levels) - 1)
        push!(states, SegmentFatigueState(
            levels[i],
            0.0,    # vertebral_damage
            0.0,    # disc_damage
            0.0,    # endplate_damage
            0,      # total_cycles
            0.0     # peak_stress_history
        ))
    end
    
    return states
end

"""
    accumulate_fatigue!(fatigue_states, stress_distribution, activity, sensitivity)

Accumule le dommage de fatigue pour un cycle de chargement donné.

Modèle de Miner : D = Σ(nᵢ/Nfᵢ)
où nᵢ = nombre de cycles à la contrainte σᵢ
et Nfᵢ = nombre de cycles à rupture à cette contrainte (courbe S-N)

Courbes S-N osseuses : Caler et al. (1996), Carter & Caler (1985)
"""
function accumulate_fatigue!(fatigue_states::Vector{SegmentFatigueState},
                             stress_distribution::Vector{Float64},
                             activity::DailyActivity,
                             sensitivity::Float64,
                             days_in_step::Float64)
    n_cycles = round(Int64, activity.cycles_per_day * days_in_step)
    
    for (i, state) in enumerate(fatigue_states)
        if i > length(stress_distribution)
            continue
        end
        
        σ = stress_distribution[i]  # Von Mises (Pa)
        
        # Mise à jour du pic historique
        state.peak_stress_history = max(state.peak_stress_history, σ)
        state.total_cycles += n_cycles
        
        # ── Dommage osseux vertébral ──
        # Courbe S-N os cortical : Nf = A × σ^(-B)
        # Carter & Caler (1985): A ≈ 6.6e40, B ≈ 13.2 (compression)
        σ_normalized_bone = σ / CORTICAL_BONE.yield_stress
        if σ_normalized_bone > 0.01  # Seuil de contribution
            Nf_bone = fatigue_life_bone(σ_normalized_bone)
            Δd_bone = n_cycles / Nf_bone * sensitivity
            state.vertebral_damage = min(1.0, state.vertebral_damage + Δd_bone)
        end
        
        # ── Dommage discal (annulus fibrosus) ──
        # Les fibres de collagène ont une résistance à la fatigue plus faible
        # Green et al. (1993) : fatigue discale
        σ_normalized_disc = σ / 5.0e6  # σ_ultimate annulus ≈ 5 MPa
        if σ_normalized_disc > 0.05
            Nf_disc = fatigue_life_disc(σ_normalized_disc)
            Δd_disc = n_cycles / Nf_disc * sensitivity
            state.disc_damage = min(1.0, state.disc_damage + Δd_disc)
        end
        
        # ── Dommage plateau vertébral ──
        # Le cartilage est le maillon faible (Fields et al., 2010)
        σ_normalized_ep = σ / CARTILAGE_ENDPLATE.yield_stress
        if σ_normalized_ep > 0.02
            Nf_ep = fatigue_life_endplate(σ_normalized_ep)
            Δd_ep = n_cycles / Nf_ep * sensitivity
            state.endplate_damage = min(1.0, state.endplate_damage + Δd_ep)
        end
    end
end

"""
    fatigue_life_bone(σ_normalized) → Float64

Nombre de cycles à rupture pour l'os cortical à un niveau de contrainte donné.
Courbe S-N simplifiée : Nf = 10^(a - b × log10(σ/σ_y))
Référence : Carter & Caler (1985), Pattin et al. (1996).
"""
function fatigue_life_bone(σ_normalized::Float64)::Float64
    # En dessous du seuil d'endurance, durée de vie infinie
    if σ_normalized < 0.3
        return 1e15  # Quasi-infini
    end
    
    # Au-dessus du seuil, courbe S-N log-linéaire
    # log10(Nf) = 12 - 10 × σ/σy  (approximation simplifiée)
    log_Nf = 12.0 - 10.0 * σ_normalized
    return 10.0^max(log_Nf, 0.0)
end

"""
    fatigue_life_disc(σ_normalized) → Float64

Nombre de cycles à rupture pour l'annulus fibrosus.
Le disque est plus sensible à la fatigue que l'os.
Référence : Green et al. (1993).
"""
function fatigue_life_disc(σ_normalized::Float64)::Float64
    if σ_normalized < 0.2
        return 1e12
    end
    
    # Courbe S-N du collagène : pente plus raide
    log_Nf = 10.0 - 12.0 * σ_normalized
    return 10.0^max(log_Nf, 0.0)
end

"""
    fatigue_life_endplate(σ_normalized) → Float64

Nombre de cycles à rupture pour le plateau vertébral cartilagineux.
Le plateau est le premier à céder dans de nombreux cas.
Référence : Fields et al. (2010).
"""
function fatigue_life_endplate(σ_normalized::Float64)::Float64
    if σ_normalized < 0.15
        return 1e11
    end
    
    log_Nf = 9.0 - 11.0 * σ_normalized
    return 10.0^max(log_Nf, 0.0)
end

"""
    apply_fatigue_effects!(model, fatigue_states)

Applique les effets du dommage de fatigue accumulé au modèle :
- Réduction du module de Young (perte de rigidité avec les micro-fissures)
- Augmentation de la compliance
- Perte de hauteur discale
"""
function apply_fatigue_effects!(model::SpineModel,
                                fatigue_states::Vector{SegmentFatigueState})
    for (i, state) in enumerate(fatigue_states)
        if i > length(model.vertebrae) - 1
            continue
        end
        
        # ── Dégradation osseuse (micro-fractures de fatigue) ──
        # E_endommagé = E₀ × (1 - D)^α
        # Avec α ≈ 2 pour l'os (Lemaitre & Chaboche, 1994)
        bone_degradation = (1.0 - state.vertebral_damage)^2
        
        vb = model.vertebrae[i]
        vb_cortical = vb.cortical
        model.vertebrae[i].cortical = MaterialProperties(
            CORTICAL_BONE.youngs_modulus * bone_degradation,
            vb_cortical.poissons_ratio,
            CORTICAL_BONE.yield_stress * bone_degradation,
            vb_cortical.density
        )
        
        # ── Dégradation discale ──
        if i ≤ length(model.discs)
            disc = model.discs[i]
            disc_degradation = (1.0 - state.disc_damage)
            
            # Réduire la pression du nucleus (perte de capacité hydraulique)
            disc.nucleus.pressure *= max(0.1, disc_degradation)
            
            # Augmenter la rigidité de l'annulus (fibrose)
            disc.annulus.ground_matrix = MaterialProperties(
                disc.annulus.ground_matrix.youngs_modulus * (1.0 + state.disc_damage),
                disc.annulus.ground_matrix.poissons_ratio,
                disc.annulus.ground_matrix.yield_stress,
                disc.annulus.ground_matrix.density
            )
        end
        
        # ── Dommage au plateau vertébral ──
        # Les micro-fractures du plateau changent la distribution de pression
        # et peuvent initier la dégénérescence discale
        if state.endplate_damage > 0.3
            # Redistribution de pression non uniforme
            # → accélère la dégénérescence discale
            if i ≤ length(model.discs)
                model.discs[i].nucleus.water_content *= (1.0 - 0.1 * state.endplate_damage)
            end
        end
    end
end
