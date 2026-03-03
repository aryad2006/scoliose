# ══════════════════════════════════════════════════════════════
# Vertex — Simulation Longitudinale du Rachis
# Boucle temporelle : années de chargement cyclique
# Théorie du ressort spiral / flambage progressif
# ══════════════════════════════════════════════════════════════

"""
    run_longitudinal_simulation(params::LongitudinalParams) → LongitudinalResult

Exécute une simulation longitudinale complète du rachis.

Hypothèse testée (théorie du ressort spiral) :
- Un rachis SYMÉTRIQUE soumis à des charges de la vie quotidienne
  pendant des années reste stable (pas de scoliose)
- Un rachis ASYMÉTRIQUE (même subtil : 1-2° de cunéiformisation,
  10-15% d'asymétrie ligamentaire) soumis aux mêmes charges
  développe progressivement une déformation scoliotique par
  flambage du « ressort » rachidien

Boucle de simulation (par pas de temps mensuels) :
1. Calculer les charges représentatives de la période
2. Résoudre l'équilibre FEM → distribution des contraintes
3. Accumuler la fatigue (loi de Miner)
4. Remodelage osseux adaptatif (loi de Wolff) 
5. Dégénérescence discale progressive
6. Mettre à jour la géométrie (déformations cumulatives)
7. Croissance (si patient en âge de croître)
8. Analyser le flambage (charge critique vs charge appliquée)
9. Prendre un snapshot si nécessaire
"""
function run_longitudinal_simulation(params::LongitudinalParams)::LongitudinalResult
    
    # ══════════════════════════════════════════════════════════
    # INITIALISATION
    # ══════════════════════════════════════════════════════════
    
    # Créer le rachis initial
    model = create_normal_spine(
        weight=params.weight, height=params.height,
        age=params.initial_age, sex=params.sex
    )
    
    # Appliquer l'asymétrie initiale
    apply_initial_asymmetry!(model, params.asymmetry)
    
    # Initialiser les états longitudinaux
    fatigue_states = initialize_fatigue_states(model)
    remodeling_states = initialize_remodeling_states(model)
    disc_states = initialize_disc_degeneration_states(model)
    
    # Historique
    snapshots = SpineSnapshot[]
    
    # Métriques de suivi
    scoliosis_detected = false
    scoliosis_onset = Inf
    buckling_detected = false
    buckling_onset = Inf
    
    # Sauvegarder les positions initiales (pour mesurer la déviation)
    initial_positions = [v.position for v in model.vertebrae]

    # ══════════════════════════════════════════════════════════
    # BOUCLE TEMPORELLE
    # ══════════════════════════════════════════════════════════
    
    total_months = round(Int, params.duration_years * 12)
    dt = params.time_step_months
    
    for month in 1:dt:total_months
        current_time_years = month / 12.0
        current_age = params.initial_age + current_time_years
        
        # ── Mise à jour du profil de charge selon l'âge ──
        current_weight = update_patient_weight(params, current_age)
        current_height = update_patient_height(params, current_age)
        load_profile = standard_daily_profile(current_weight, current_height)
        
        # ── 1. Résoudre l'équilibre FEM pour la charge représentative ──
        representative_loads = compute_representative_loads(model, load_profile, params.asymmetry)
        
        fem_ok = true
        try
            solve_spine!(model; gravity=true, loads=representative_loads)
        catch e
            @warn "Échec FEM au mois $month" exception=e
            fem_ok = false
            # Continue — use fallback stress estimation
        end
        
        # ── 2. Extraire la distribution de contraintes ──
        stress_distribution = extract_stress_distribution(model)
        
        # ── 3. Accumulation de fatigue ──
        days_in_step = dt * 30.44  # jours moyens par mois
        for activity in load_profile.activities
            if activity.cycles_per_day > 0
                accumulate_fatigue!(fatigue_states, stress_distribution,
                                   activity, params.fatigue_sensitivity, days_in_step)
            end
        end
        apply_fatigue_effects!(model, fatigue_states)
        
        # ── 4. Remodelage osseux (Wolff) ──
        update_bone_remodeling!(remodeling_states, model, stress_distribution,
                                params.remodeling_rate, dt)
        apply_remodeling_effects!(model, remodeling_states)
        
        # ── 5. Dégénérescence discale ──
        update_disc_degeneration!(disc_states, model, stress_distribution,
                                  fatigue_states, params.disc_degeneration_rate,
                                  dt, current_age)
        apply_disc_degeneration_effects!(model, disc_states)
        
        # ── 6. Croissance ──
        if params.growth_enabled && current_age < 18
            apply_growth!(model, params, current_age, dt)
        end
        
        # ── 7. Déformations cumulatives (fluage) ──
        apply_cumulative_deformation!(model, stress_distribution, dt)
        
        # ── 8. Analyse de flambage (ressort spiral) ──
        if params.detect_buckling
            buckling_ratio = compute_spring_buckling_ratio(model, current_weight)
            if buckling_ratio > 1.0 && !buckling_detected
                buckling_detected = true
                buckling_onset = current_time_years
            end
        end
        
        # ── 9. Mesures et détection de scoliose ──
        max_cobb = measure_max_cobb(model)
        if max_cobb > 10.0 && !scoliosis_detected
            scoliosis_detected = true
            scoliosis_onset = current_time_years
        end
        
        # ── 10. Snapshot périodique ──
        if month % params.snapshot_interval_months == 0
            snapshot = create_snapshot(model, current_time_years, 
                                       stress_distribution, initial_positions,
                                       current_weight)
            push!(snapshots, snapshot)
        end
    end
    
    # ══════════════════════════════════════════════════════════
    # RÉSULTATS
    # ══════════════════════════════════════════════════════════
    
    final_cobb = measure_max_cobb(model)
    max_damage = maximum(s.vertebral_damage for s in fatigue_states)
    max_asym = isempty(disc_states) ? 0.0 : 
               maximum(abs(s.height_asymmetry - 1.0) for s in disc_states)
    
    return LongitudinalResult(
        params.asymmetry,
        params.duration_years,
        params.time_step_months,
        snapshots,
        final_cobb,
        scoliosis_detected,
        scoliosis_detected ? scoliosis_onset : Inf,
        buckling_detected,
        buckling_detected ? buckling_onset : Inf,
        max_damage,
        max_asym
    )
end

# ═══════════════════════════════════════════════════════════════
# FONCTIONS AUXILIAIRES
# ═══════════════════════════════════════════════════════════════

"""
    compute_representative_loads(model, profile, asymmetry) → Vector{Load}

Calcule les charges représentatives d'une période en combinant
toutes les activités quotidiennes pondérées par leur durée.
"""
function compute_representative_loads(model::SpineModel, 
                                       profile::DailyLoadProfile,
                                       asymmetry::AsymmetryConfig)
    loads = Load[]
    
    # Charge axiale pondérée
    total_axial = 0.0
    total_flexion = 0.0
    total_lateral = 0.0
    total_torsion = 0.0
    
    for activity in profile.activities
        total_axial += activity.axial_load * activity.duration_fraction
        total_flexion += activity.flexion_moment * activity.duration_fraction
        total_lateral += activity.lateral_moment * activity.duration_fraction
        total_torsion += activity.torsion_moment * activity.duration_fraction
    end
    
    # ── Asymétrie musculaire → charge latérale additionnelle ──
    lateral_bias = 0.0
    for da in asymmetry.dynamic_asymmetries
        if da.type == MUSCLE_TONE_ASYMMETRY
            sign = da.side == :left ? 1.0 : -1.0
            lateral_bias += total_axial * 0.05 * (da.magnitude - 1.0) * sign
        end
    end
    total_lateral += lateral_bias
    
    # Appliquer au rachis thoracique moyen (T7-T8)
    n = length(model.vertebrae)
    mid = div(n, 2)
    
    if mid ≥ 1 && mid ≤ n
        push!(loads, Load(
            model.vertebrae[mid].position,
            Vec3(total_lateral, 0, -total_axial),
            Vec3(total_torsion, total_flexion, 0)
        ))
    end
    
    # Charge au sommet du rachis (tête + membres supérieurs)
    if n ≥ 1
        head_weight = profile.patient_weight * 0.08 * 9.81  # ~8% BW
        push!(loads, Load(
            model.vertebrae[1].position,
            Vec3(0, 0, -head_weight),
            Vec3(0, 0, 0)
        ))
    end
    
    return loads
end

"""
    extract_stress_distribution(model) → Vector{Float64}

Extrait la contrainte de Von Mises par segment intervertébral.
"""
function extract_stress_distribution(model::SpineModel)::Vector{Float64}
    if isempty(model.stress_field)
        # Estimation basique si pas de champ de contraintes
        n = length(model.vertebrae) - 1
        σ = zeros(n)
        for i in 1:n
            # Contrainte axiale approximative = F/A
            body = model.vertebrae[i]
            A = π * body.morphology.body_width * body.morphology.body_depth / 4.0
            σ[i] = model.patient_weight * 9.81 * 0.6 / A  # ~60% BW au rachis
        end
        return σ
    end
    
    # Von Mises par élément
    return [von_mises(s) for s in model.stress_field]
end

"""
    update_patient_weight(params, age) → Float64

Mise à jour du poids en fonction de l'âge (courbe de croissance).
"""
function update_patient_weight(params::LongitudinalParams, age::Float64)::Float64
    if !params.growth_enabled || age ≥ 18
        return params.weight * (age < 18 ? 1.0 : 
               min(1.3, 1.0 + 0.005 * (age - 18)))  # Prise de poids adulte lente
    end
    
    # Courbe de croissance pondérale simplifiée (percentile 50)
    age_start = params.initial_age
    weight_start = params.weight
    weight_adult = params.sex == :F ? 60.0 : 70.0
    
    if age ≥ 18
        return weight_adult
    end
    
    # Interpolation sigmoïdale
    t = (age - age_start) / (18.0 - age_start)
    t = clamp(t, 0, 1)
    return weight_start + (weight_adult - weight_start) * (3t^2 - 2t^3)
end

"""
    update_patient_height(params, age) → Float64

Mise à jour de la taille en fonction de l'âge.
Pic de croissance pendant la puberté.
"""
function update_patient_height(params::LongitudinalParams, age::Float64)::Float64
    if !params.growth_enabled || age ≥ 18
        return params.height + (age < 18 ? 0.0 : 
               (params.sex == :F ? 25.0 : 35.0) * min(1.0, (18.0 - params.initial_age) / 8.0))
    end
    
    age_start = params.initial_age
    height_start = params.height
    
    # Vitesse de croissance avec pic pubertaire (Tanner)
    peak_age = params.growth_peak_age
    peak_rate = params.growth_rate_cm_year
    
    # Intégration approximative de la courbe de croissance
    total_growth = 0.0
    for y in age_start:0.1:min(age, 18.0)
        # Gaussienne centrée sur le pic
        rate = peak_rate * exp(-0.5 * ((y - peak_age) / 1.5)^2) + 1.0  # base: 1 cm/an
        total_growth += rate * 0.1
    end
    
    return height_start + total_growth
end

"""
    apply_growth!(model, params, age, dt_months)

Applique la croissance rachidienne : allongement des vertèbres et disques.
La croissance amplifie les asymétries existantes via la loi de Hueter-Volkmann :
- Le côté comprimé croît moins vite
- Le côté en traction croît plus vite
→ C'est le mécanisme principal de progression scoliotique chez l'enfant.
"""
function apply_growth!(model::SpineModel, params::LongitudinalParams,
                       age::Float64, dt_months::Int)
    # Taux de croissance rachidienne (mm/mois)
    peak_age = params.growth_peak_age
    peak_rate = params.growth_rate_cm_year * 10.0 / 12.0  # → mm/mois
    
    # Vitesse de croissance à l'âge actuel (Gaussienne + base)
    growth_rate = peak_rate * exp(-0.5 * ((age - peak_age) / 1.5)^2) + 
                  0.5  # base: 0.5 mm/mois
    
    Δh_per_vertebra = growth_rate * dt_months / length(model.vertebrae)
    
    for (i, vb) in enumerate(model.vertebrae)
        # ── Élongation verticale ──
        pos = vb.position
        z_shift = Δh_per_vertebra * (length(model.vertebrae) - i) / 
                  length(model.vertebrae)
        model.vertebrae[i].position = Vec3(pos[1], pos[2], pos[3] + z_shift)
        
        # ── Loi de Hueter-Volkmann ──
        # Si la vertèbre est inclinée (pré-scoliose), le côté comprimé 
        # croît moins vite → la cunéiformisation s'accentue
        tilt = atan(vb.orientation[1, 3], vb.orientation[3, 3])
        
        # Croissance différentielle gauche/droite
        # ΔG = G₀ × (1 - k × σ/σ_ref) où k est le coefficient de Hueter-Volkmann
        # Calibré d'après Stokes et al. (2006), Villemure & Stokes (2009)
        hueter_volkmann_k = 1.0  # Sensibilité de la croissance aux contraintes
        
        growth_asymmetry = -hueter_volkmann_k * sin(tilt)
        # Côté concave (comprimé) : croissance réduite → cunéiformisation
        
        if abs(growth_asymmetry) > 0.0005 && age < 18
            # Facteur d'amplification proportionnel à la vitesse de croissance
            # Plus la croissance est rapide (pic pubertaire), plus l'effet est fort
            growth_amplification = 18.0 * (growth_rate / (peak_rate + 0.5))
            θy_growth = deg2rad(growth_asymmetry * Δh_per_vertebra * growth_amplification)
            R = rotation_matrix(0.0, θy_growth, 0.0)
            model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
            
            # La croissance différentielle déplace aussi latéralement
            lat_growth = Δh_per_vertebra * sin(tilt) * growth_amplification * 0.05
            cur_pos = model.vertebrae[i].position
            model.vertebrae[i].position = Vec3(cur_pos[1] + lat_growth, cur_pos[2], cur_pos[3])
        end
    end
    
    # Croissance des disques (plus lente)
    for disc in model.discs
        disc.height += Δh_per_vertebra * 0.3  # Les disques croissent moins vite
    end
end

"""
    apply_cumulative_deformation!(model, stress, dt_months)

Applique les déformations cumulatives dues au fluage viscoélastique
des tissus mous (disques, ligaments) sous charge prolongée.
"""
function apply_cumulative_deformation!(model::SpineModel, 
                                       stress_distribution::Vector{Float64},
                                       dt_months::Int)
    n = length(model.vertebrae)
    
    for i in 1:(n-1)
        if i > length(stress_distribution)
            continue
        end
        
        σ = stress_distribution[i]
        vb = model.vertebrae[i]
        
        # ── Fluage viscoélastique discal ──
        # Le disque se déforme lentement sous charge constante
        # ε_creep = A × σ^n × t  (loi puissance)
        # Calibré d'après Keller et al. (1987), Adams & Dolan (2005)
        creep_coefficient = 5e-11  # Coefficient de fluage (mm/Pa/mois)
        creep_displacement = creep_coefficient * σ * dt_months
        
        # La direction du fluage dépend de l'inclinaison existante
        tilt = atan(vb.orientation[1, 3], vb.orientation[3, 3])
        
        if abs(tilt) > deg2rad(0.005)
            # Le fluage amplifie la déformation existante (instabilité)
            lateral_creep = creep_displacement * sin(tilt) * 300.0  # mm
            pos = vb.position
            model.vertebrae[i].position = Vec3(
                pos[1] + lateral_creep,
                pos[2],
                pos[3]
            )
            
            # Le fluage augmente aussi l'inclinaison (boucle positive)
            θ_creep = creep_displacement * sin(tilt) * 0.2
            R_creep = rotation_matrix(0.0, θ_creep, 0.0)
            model.vertebrae[i].orientation = R_creep * vb.orientation
        end
    end
end

# ═══════════════════════════════════════════════════════════════
# ANALYSE DE FLAMBAGE DU RESSORT SPIRAL
# ═══════════════════════════════════════════════════════════════

"""
    compute_spring_buckling_ratio(model, weight) → Float64

Calcule le ratio charge appliquée / charge critique de flambage.

Le rachis est modélisé comme un ressort hélicoïdal (spirale 3D
formée par les courbures sagittales). La charge axiale de compression
(gravité + charges) est comparée à la charge critique de flambage d'Euler.

Flambage = quand le ratio > 1.0 → le « ressort » se déforme latéralement
de façon instable → c'est l'initiation d'une scoliose.

Références :
- Euler (1744) : flambage des colonnes
- Lucas et al. (2012) : stabilité du rachis
- Kiefer et al. (1997) : modèle de flambage rachidien
"""
function compute_spring_buckling_ratio(model::SpineModel, 
                                        patient_weight::Float64)::Float64
    # ── Charge appliquée ──
    P_applied = patient_weight * 9.81 * 0.6  # ~60% BW sur le rachis
    
    # ── Charge critique d'Euler ──
    # P_cr = π² × EI / (K × L)²
    # où K = facteur de longueur effective (K=2 pour encastré-libre)
    
    # Rigidité en flexion effective du rachis (EI)
    EI_total = compute_effective_bending_stiffness(model)
    
    # Longueur effective du rachis
    L = norm(model.vertebrae[1].position - model.vertebrae[end].position)
    
    # Facteur de réduction dû à l'asymétrie
    # Un rachis asymétrique a une charge critique plus faible
    asymmetry_penalty = compute_asymmetry_penalty(model)
    
    # Charge critique d'Euler (encastré-libre : K=2)
    K_boundary = 2.0
    P_critical = π^2 * EI_total / (K_boundary * L)^2
    
    # Réduire par le facteur d'asymétrie
    P_critical *= asymmetry_penalty
    
    # ── Correction pour la géométrie hélicoïdale (ressort spiral) ──
    # Un ressort hélicoïdal flambe plus facilement qu'une colonne droite
    # car il a déjà une excentricité initiale
    helix_factor = compute_helix_factor(model)
    P_critical *= helix_factor
    
    return P_applied / P_critical
end

"""
    compute_effective_bending_stiffness(model) → Float64

Calcule la rigidité en flexion effective du rachis complet (EI total).
C'est la résistance du rachis au flambage latéral.
"""
function compute_effective_bending_stiffness(model::SpineModel)::Float64
    EI_total = 0.0
    
    n = length(model.vertebrae)
    for i in 1:(n-1)
        vb_upper = model.vertebrae[i]
        vb_lower = model.vertebrae[i+1]
        
        if i ≤ length(model.discs)
            disc = model.discs[i]
            
            # Section du segment
            a = disc.width / 2.0
            b = disc.depth / 2.0
            Iz = π * a^3 * b / 4.0  # Moment d'inertie flexion coronale
            
            # Module effectif (série vertèbre-disque)
            E_disc = 10.0e6 * (disc.nucleus.water_content / 0.85)
            E_bone = vb_upper.cortical.youngs_modulus
            E_eff = (E_disc * E_bone) / (E_disc + E_bone)
            
            EI_total += E_eff * Iz
        end
    end
    
    # Moyenne par segment
    EI_total /= max(1, n - 1)
    
    return EI_total
end

"""
    compute_asymmetry_penalty(model) → Float64

Calcule un facteur de réduction (0-1) de la charge critique de flambage
dû aux asymétries du rachis.
Un rachis parfaitement symétrique a un facteur de 1.0.
Plus il est asymétrique, plus il flambe facilement.
"""
function compute_asymmetry_penalty(model::SpineModel)::Float64
    # Mesurer l'excentricité latérale maximale (déviation de la ligne médiane)
    max_lateral_dev = 0.0
    
    # Ligne de référence : droite entre C3 et S1
    top = model.vertebrae[1].position
    bottom = model.vertebrae[end].position
    
    for vb in model.vertebrae
        # Distance latérale (x) par rapport à la ligne
        t = (vb.position[3] - bottom[3]) / (top[3] - bottom[3] + 1e-10)
        expected_x = bottom[1] + t * (top[1] - bottom[1])
        dev = abs(vb.position[1] - expected_x)
        max_lateral_dev = max(max_lateral_dev, dev)
    end
    
    # Mesurer l'asymétrie d'orientation (inclinaisons dans le plan frontal)
    max_tilt = 0.0
    for vb in model.vertebrae
        tilt = abs(atan(vb.orientation[1, 3], vb.orientation[3, 3]))
        max_tilt = max(max_tilt, tilt)
    end
    
    # Facteur de pénalité : excentricité réduit la charge critique
    # P_cr_imperfect = P_cr_perfect / (1 + e/r × sec(π/2 × P/P_cr))
    # Simplifié : facteur = 1 / (1 + α × e_max / R_mean)
    R_mean = mean_body_width(model) / 2.0
    α = 5.0  # Sensibilité
    
    eccentricity_factor = 1.0 / (1.0 + α * max_lateral_dev / (R_mean + 1e-10))
    tilt_factor = 1.0 / (1.0 + 3.0 * max_tilt)
    
    return eccentricity_factor * tilt_factor
end

"""
    compute_helix_factor(model) → Float64

Facteur de correction pour la géométrie hélicoïdale du rachis.
Les courbures sagittales (lordose/cyphose) créent une forme de ressort
qui a un seuil de flambage différent d'une colonne droite.

Un ressort hélicoïdal sous compression peut flamber latéralement
(flambage global) ou localement (flambage inter-spires).
"""
function compute_helix_factor(model::SpineModel)::Float64
    # Calculer l'amplitude des courbures sagittales
    max_ap_deviation = 0.0
    
    for vb in model.vertebrae
        max_ap_deviation = max(max_ap_deviation, abs(vb.position[2]))
    end
    
    # Plus les courbures sagittales sont prononcées, plus le rachis
    # se comporte comme un ressort → plus facile à flamber
    # Ratio : déviation AP / longueur du rachis
    L = norm(model.vertebrae[1].position - model.vertebrae[end].position)
    helix_ratio = max_ap_deviation / (L + 1e-10)
    
    # Facteur : 1.0 pour colonne droite, <1 pour rachis courbé
    # Un ressort très "enroulé" flambe plus facilement
    return 1.0 - 0.5 * min(1.0, helix_ratio * 5.0)
end

"""
    mean_body_width(model) → Float64

Largeur moyenne du corps vertébral dans le modèle.
"""
function mean_body_width(model::SpineModel)::Float64
    return sum(v.morphology.body_width for v in model.vertebrae) / 
           length(model.vertebrae)
end

# ═══════════════════════════════════════════════════════════════
# MESURES ET SNAPSHOTS
# ═══════════════════════════════════════════════════════════════

"""
    measure_max_cobb(model) → Float64

Mesure l'angle de Cobb maximal dans le plan frontal.
Teste plusieurs combinaisons de vertèbres limites pour trouver
la courbure maximale.
"""
function measure_max_cobb(model::SpineModel)::Float64
    levels = vertebral_levels()
    max_cobb = 0.0
    
    n = length(levels)
    # Tester des fenêtres de 5 à 15 vertèbres
    for span in 5:min(15, n-1)
        for start in 1:(n - span)
            try
                angle = measure_cobb(model, levels[start], levels[start + span])
                max_cobb = max(max_cobb, angle)
            catch
                continue
            end
        end
    end
    
    return max_cobb
end

"""
    create_snapshot(model, time, stress, initial_positions, weight) → SpineSnapshot

Crée un snapshot de l'état du rachis à un instant donné.
"""
function create_snapshot(model::SpineModel, time_years::Float64,
                          stress_distribution::Vector{Float64},
                          initial_positions::Vector{Vec3},
                          patient_weight::Float64)
    # Mesurer les angles de Cobb pour les courbures principales
    cobb_angles = Dict{String, Float64}()
    
    # Maximum (balayage de toutes les fenêtres)
    cobb_angles["max"] = measure_max_cobb(model)
    
    # Thoracique (T5-T12)
    try
        cobb_angles["T5-T12"] = measure_cobb(model, T5, T12)
    catch; end
    
    # Thoraco-lombaire (T10-L2)
    try
        cobb_angles["T10-L2"] = measure_cobb(model, T10, L2)
    catch; end
    
    # Lombaire (L1-L5)
    try
        cobb_angles["L1-L5"] = measure_cobb(model, L1, L5)
    catch; end
    
    # Rotations axiales
    axial_rotations = Float64[]
    for vb in model.vertebrae
        θx = atan(vb.orientation[2, 3], vb.orientation[3, 3])
        push!(axial_rotations, rad2deg(θx))
    end
    
    # Déviation latérale maximale
    max_lateral = 0.0
    top = model.vertebrae[1].position
    bottom = model.vertebrae[end].position
    for (i, vb) in enumerate(model.vertebrae)
        t = (vb.position[3] - bottom[3]) / (top[3] - bottom[3] + 1e-10)
        expected_x = bottom[1] + t * (top[1] - bottom[1])
        dev = abs(vb.position[1] - expected_x)
        max_lateral = max(max_lateral, dev)
    end
    
    # Cyphose thoracique et lordose lombaire
    kyphosis = 0.0
    lordosis = 0.0
    try
        kyphosis = measure_cobb(model, T4, T12)
    catch; end
    try
        lordosis = measure_cobb(model, L1, L5)
    catch; end
    
    # Ratio de flambage
    buckling_ratio = compute_spring_buckling_ratio(model, patient_weight)
    
    return SpineSnapshot(
        time_years,
        cobb_angles,
        kyphosis,
        lordosis,
        axial_rotations,
        [v.position for v in model.vertebrae],
        [v.orientation for v in model.vertebrae],
        stress_distribution,
        max_lateral,
        buckling_ratio
    )
end

# ═══════════════════════════════════════════════════════════════
# EXÉCUTION PAR LOT (comparaison symétrique vs asymétrique)
# ═══════════════════════════════════════════════════════════════

"""
    run_comparison_study(; duration=20.0, configs=nothing) → Dict{String, LongitudinalResult}

Exécute une série de simulations comparant le rachis symétrique
avec différentes configurations d'asymétrie.

C'est l'expérience principale pour tester la théorie du ressort spiral :
1. Contrôle : rachis symétrique → devrait rester stable
2. Cunéiformisation légère → devrait montrer une progression
3. Asymétrie ligamentaire → devrait montrer une progression
4. Asymétrie discale → devrait montrer une progression
5. Combinée → progression plus rapide

Retourne un dictionnaire de résultats par nom de configuration.
"""
function run_comparison_study(; 
        duration::Float64=20.0,
        initial_age::Int=10,
        configs::Union{Nothing, Dict{String, AsymmetryConfig}}=nothing)
    
    # Configurations par défaut
    if isnothing(configs)
        configs = Dict{String, AsymmetryConfig}(
            "1_symetrique" => symmetric_config(),
            "2_wedging_1deg" => mild_vertebral_wedging(angle=1.0),
            "3_wedging_2deg" => mild_vertebral_wedging(angle=2.0),
            "4_wedging_3deg" => mild_vertebral_wedging(angle=3.0),
            "5_ligament_10pct" => mild_ligament_asymmetry(ratio=1.10),
            "6_ligament_20pct" => mild_ligament_asymmetry(ratio=1.20),
            "7_disc_10pct" => mild_disc_asymmetry(ratio=1.10),
            "8_combined_mild" => combined_asymmetry(wedge_angle=1.5, lig_ratio=1.10),
            "9_combined_moderate" => combined_asymmetry(wedge_angle=2.5, lig_ratio=1.20),
        )
    end
    
    results = Dict{String, LongitudinalResult}()
    
    for (name, config) in sort(collect(configs), by=first)
        @info "Simulation: $name — $(config.description)"
        
        params = default_longitudinal_params(
            duration_years=duration,
            initial_age=initial_age,
            asymmetry=config
        )
        
        result = run_longitudinal_simulation(params)
        results[name] = result
        
        @info "  → Cobb final: $(round(result.final_cobb, digits=1))° | " *
              "Scoliose: $(result.developed_scoliosis) | " *
              "Flambage: $(result.buckling_detected)"
    end
    
    return results
end

"""
    summarize_results(results::Dict{String, LongitudinalResult}) → String

Génère un résumé textuel des résultats de l'étude comparative.
"""
function summarize_results(results::Dict{String, LongitudinalResult})::String
    lines = String[]
    push!(lines, "═══════════════════════════════════════════════════════════")
    push!(lines, "RÉSULTATS — Simulation Longitudinale (Théorie du Ressort Spiral)")
    push!(lines, "═══════════════════════════════════════════════════════════")
    push!(lines, "")
    
    push!(lines, "| Configuration | Asymétrie | Cobb final | Scoliose | Onset (ans) | Flambage |")
    push!(lines, "|:---|:---|---:|:---:|---:|:---:|")
    
    for (name, result) in sort(collect(results), by=first)
        onset = result.developed_scoliosis ? 
                "$(round(result.scoliosis_onset_years, digits=1))" : "—"
        scoliosis_flag = result.developed_scoliosis ? "OUI" : "NON"
        buckling_flag = result.buckling_detected ? "OUI" : "NON"
        
        push!(lines, "| $name | $(result.config.description) | " *
              "$(round(result.final_cobb, digits=1))° | $scoliosis_flag | " *
              "$onset | $buckling_flag |")
    end
    
    push!(lines, "")
    push!(lines, "Scoliose définie comme angle de Cobb > 10°")
    push!(lines, "Durée de simulation : $(first(values(results)).duration_years) ans")
    
    return join(lines, "\n")
end
