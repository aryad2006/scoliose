# ══════════════════════════════════════════════════════════════
# Vertex — Évaluation Chirurgicale
# ══════════════════════════════════════════════════════════════

"""
Évaluation complète de la qualité de la chirurgie simulée.
"""
struct SurgicalEvaluation
    # Correction radiographique
    preop_cobb::Float64             # ° pré-opératoire
    postop_cobb::Float64            # ° post-opératoire
    correction_percent::Float64     # % de correction
    
    # Équilibre
    postop_sva::Float64             # mm (Sagittal Vertical Axis)
    postop_pi_ll::Float64           # ° (PI - LL mismatch)
    postop_coronal_balance::Float64 # mm (C7 - CSVL)
    
    # Qualité du geste
    screws_placed::Int
    screws_accurate::Int            # précision > 80%
    breaches::Int
    breach_types::Vector{Symbol}
    
    # Prédictions
    pjk_risk::Float64              # % risque de Proximal Junctional Kyphosis
    revision_risk_5y::Float64      # % risque de révision à 5 ans
    max_implant_stress::Float64    # MPa
    
    # Temps et performance
    time_seconds::Float64
    blood_loss_ml::Float64
    overall_score::Float64          # 0-100
end

"""
    evaluate_surgery(model_preop, model_postop, screws, elapsed_time) → SurgicalEvaluation

Évalue la qualité de la chirurgie en comparant les modèles pré et post-opératoires.
"""
function evaluate_surgery(preop::SpineModel, postop::SpineModel,
                          screw_results::Vector{ScrewResult},
                          elapsed_time::Float64)
    # ── 1. Mesures radiographiques ──
    # Chercher la courbure principale (plus grand angle de Cobb)
    max_cobb_pre = 0.0
    max_cobb_post = 0.0
    levels = vertebral_levels()
    
    for i in 1:(length(levels)-4)
        for j in (i+3):min(i+10, length(levels))
            cobb_pre = measure_cobb(preop, levels[i], levels[j])
            cobb_post = measure_cobb(postop, levels[i], levels[j])
            if cobb_pre > max_cobb_pre
                max_cobb_pre = cobb_pre
            end
            if i == 1 || cobb_post > max_cobb_post
                max_cobb_post = cobb_post
            end
        end
    end
    
    correction_pct = if max_cobb_pre > 0
        (max_cobb_pre - max_cobb_post) / max_cobb_pre * 100
    else
        0.0
    end
    
    # ── 2. Équilibre ──
    # SVA = déplacement horizontal de C3 par rapport à S1
    c3 = postop.vertebrae[1].position
    s1 = postop.vertebrae[end].position
    sva = c3[2] - s1[2]  # mm (AP)
    
    # Balance coronale
    coronal = c3[1] - s1[1]  # mm (latéral)
    
    # PI-LL mismatch (simplifié)
    pi_ll = postop.patient_weight * 0.0  # Placeholder — nécessite calcul réel des lordoses
    
    # ── 3. Vis ──
    n_screws = length(screw_results)
    n_accurate = count(s -> s.accuracy > 80.0, screw_results)
    n_breaches = count(s -> s.breach != :none, screw_results)
    breach_types = [s.breach for s in screw_results if s.breach != :none]
    
    # ── 4. Prédictions (modèles statistiques simplifiés) ──
    # Risque PJK (Yilgor et al., 2017) — facteurs : âge, SVA, instrumentation haute
    pjk_risk = clamp(5.0 + abs(sva) * 0.5 + postop.age * 0.1, 0, 100)
    
    # Risque de révision
    revision_risk = clamp(3.0 + n_breaches * 5.0 + abs(sva) * 0.3, 0, 100)
    
    # Contrainte max implant (simplifié)
    max_stress = 150.0 + max_cobb_post * 2.0  # MPa estimé
    
    # ── 5. Estimation perte sanguine ──
    blood_loss = 400.0 + n_screws * 30.0 + elapsed_time * 0.5
    
    # ── 6. Score global ──
    score = compute_global_score(
        correction_pct, sva, coronal, n_accurate / max(1, n_screws),
        n_breaches, pjk_risk, elapsed_time
    )
    
    return SurgicalEvaluation(
        max_cobb_pre, max_cobb_post, correction_pct,
        sva, pi_ll, coronal,
        n_screws, n_accurate, n_breaches, breach_types,
        pjk_risk, revision_risk, max_stress,
        elapsed_time, blood_loss, score
    )
end

"""
    compute_global_score(correction, sva, coronal, accuracy_ratio, breaches, pjk, time)

Score de 0 à 100 basé sur les critères de qualité chirurgicale.
"""
function compute_global_score(correction::Float64, sva::Float64, coronal::Float64,
                              accuracy_ratio::Float64, breaches::Int,
                              pjk_risk::Float64, time::Float64)
    score = 0.0
    
    # Correction (35 pts max)
    score += clamp(correction * 0.5, 0, 35)
    
    # Équilibre sagittal (20 pts max) — SVA < 50mm = bon
    score += clamp(20 - abs(sva) * 0.4, 0, 20)
    
    # Équilibre coronal (10 pts max) — < 20mm = bon
    score += clamp(10 - abs(coronal) * 0.5, 0, 10)
    
    # Précision des vis (20 pts max)
    score += accuracy_ratio * 20
    
    # Brèches (pénalité -10 par brèche, max -20)
    score -= min(20, breaches * 10)
    
    # Risque PJK faible (10 pts max)
    score += clamp(10 - pjk_risk * 0.3, 0, 10)
    
    # Temps raisonnable (5 pts max) — < 3h = bonus
    score += clamp(5 - time / 3600, 0, 5)
    
    return clamp(score, 0, 100)
end

"""
    evaluation_to_json(eval::SurgicalEvaluation) → Dict

Sérialise l'évaluation pour le frontend.
"""
function evaluation_to_json(eval::SurgicalEvaluation)
    return Dict(
        "preop_cobb" => round(eval.preop_cobb, digits=1),
        "postop_cobb" => round(eval.postop_cobb, digits=1),
        "correction_percent" => round(eval.correction_percent, digits=1),
        "sva" => round(eval.postop_sva, digits=1),
        "pi_ll_mismatch" => round(eval.postop_pi_ll, digits=1),
        "coronal_balance" => round(eval.postop_coronal_balance, digits=1),
        "screws_placed" => eval.screws_placed,
        "screws_accurate" => eval.screws_accurate,
        "breaches" => eval.breaches,
        "pjk_risk" => round(eval.pjk_risk, digits=1),
        "revision_risk_5y" => round(eval.revision_risk_5y, digits=1),
        "max_implant_stress" => round(eval.max_implant_stress, digits=0),
        "time_minutes" => round(eval.time_seconds / 60, digits=0),
        "blood_loss_ml" => round(eval.blood_loss_ml, digits=0),
        "overall_score" => round(eval.overall_score, digits=0),
        "grade" => score_to_grade(eval.overall_score),
    )
end

function score_to_grade(score::Float64)::String
    if score >= 90
        "⭐⭐⭐⭐⭐ Expert"
    elseif score >= 75
        "⭐⭐⭐⭐ Très bien"
    elseif score >= 60
        "⭐⭐⭐ Bien"
    elseif score >= 40
        "⭐⭐ Insuffisant"
    else
        "⭐ À retravailler"
    end
end
