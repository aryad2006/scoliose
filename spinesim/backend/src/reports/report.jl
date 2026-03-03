# ══════════════════════════════════════════════════════════════
# Vertex — Module de génération de rapports
# Sprint 3 : Export PDF via structure JSON + HTML
# ══════════════════════════════════════════════════════════════

module Reports

using JSON3
using Dates
using Printf

# ── Structure du rapport ──────────────────────────────────────

"""
Génère un rapport complet d'analyse d'un modèle de rachis.
Retourne un dictionnaire JSON-sérialisable.
"""
function generate_spine_report(
    model,
    sim_result = nothing;
    patient_name::String = "Patient anonyme",
    generated_by::String = "VERTEX© Simulator"
)::Dict

    # Identifier les pathologies présentes
    pathologies = detect_pathologies(model)
    
    # Mesures cliniques
    clinical = compute_clinical_measurements(model)
    
    # Construire le rapport
    report = Dict(
        "metadata" => Dict(
            "report_id"     => string(Base.UUID(rand(UInt128))),
            "generated_at"  => string(now()),
            "generated_by"  => generated_by,
            "version"       => "0.2.0",
        ),
        "patient" => Dict(
            "name"      => patient_name,
            "weight_kg" => model.weight,
            "height_cm" => model.height,
            "age"       => model.age,
            "sex"       => string(model.sex),
            "tscore"    => model.tscore,
            "bmi"       => round(model.weight / (model.height/100)^2, digits=1),
        ),
        "model_summary" => Dict(
            "id"              => string(model.id),
            "num_vertebrae"   => length(model.vertebrae),
            "num_discs"       => length(model.discs),
            "num_ligaments"   => length(model.ligaments),
            "has_surgery"     => !isempty(model.screws) || !isempty(model.rods),
        ),
        "clinical_measurements" => clinical,
        "pathologies"           => pathologies,
        "simulation_summary"    => isnothing(sim_result) ? nothing :
                                     summarize_simulation(sim_result),
        "recommendations"       => generate_recommendations(clinical, pathologies),
    )
    
    return report
end

"""Mesures cliniques sur le rachis."""
function compute_clinical_measurements(model)::Dict
    vertebrae = model.vertebrae
    
    # Calculer les angles de courbure sagittale
    # (approximation via les positions Z des vertèbres)
    positions_z = [v.position[3] for v in vertebrae]
    positions_y = [v.position[2] for v in vertebrae]
    positions_x = [v.position[1] for v in vertebrae]
    
    # Déviation latérale maximale
    x_mean   = sum(positions_x) / length(positions_x)
    max_lateral_dev_mm = round(maximum(abs.(positions_x .- x_mean)) * 1000, digits=1)
    
    # Hauteur totale du rachis instrumenté
    total_height_mm = round((maximum(positions_z) - minimum(positions_z)) * 1000, digits=1)
    
    # Estimation de la cyphose thoracique et lordose lombaire
    # (via changement d'angle entre T4 et T12, L1 et L5)
    thoracic_range = filter(v -> v.level in [:T4,:T5,:T6,:T7,:T8,:T9,:T10,:T11,:T12], vertebrae)
    lumbar_range   = filter(v -> v.level in [:L1,:L2,:L3,:L4,:L5], vertebrae)
    
    kyphosis  = isempty(thoracic_range) ? 35.0 : estimate_curvature_angle(thoracic_range)
    lordosis  = isempty(lumbar_range)   ? 45.0 : estimate_curvature_angle(lumbar_range)
    
    # Angle de Cobb (estimé depuis le modèle direct)
    max_cobb = estimate_cobb_from_model(model)
    
    return Dict(
        "max_lateral_deviation_mm" => max_lateral_dev_mm,
        "total_spine_height_mm"    => total_height_mm,
        "thoracic_kyphosis_deg"    => round(kyphosis, digits=1),
        "lumbar_lordosis_deg"      => round(lordosis, digits=1),
        "cobb_angle_deg"           => round(max_cobb, digits=1),
        "scoliosis_severity"       => cobb_severity_label(max_cobb),
    )
end

"""Détecte les pathologies présentes dans le modèle."""
function detect_pathologies(model)::Vector{Dict}
    pathologies = Dict[]
    
    for disc in model.discs
        degen_pct = (1.0 - disc.height_ratio) * 100
        if degen_pct > 20
            push!(pathologies, Dict(
                "type"     => "disc_degeneration",
                "location" => string(disc.levels),
                "severity" => degen_pct > 50 ? "sévère" : degen_pct > 30 ? "modérée" : "légère",
                "detail"   => @sprintf("Réduction de hauteur discale : %.0f%%", degen_pct),
            ))
        end
        
        if disc.herniation_present
            push!(pathologies, Dict(
                "type"     => "disc_herniation",
                "location" => string(disc.levels),
                "severity" => "modérée",
                "detail"   => @sprintf("Hernie discale (ratio : %.2f)", disc.herniation_ratio),
            ))
        end
    end
    
    for vert in model.vertebrae
        if vert.fracture_present
            push!(pathologies, Dict(
                "type"     => "vertebral_fracture",
                "location" => string(vert.level),
                "severity" => "sévère",
                "detail"   => @sprintf("Fracture vertébrale — compression : %.0f%%", 
                                        (1.0 - vert.height_ratio) * 100),
            ))
        end
        
        if vert.wedging_angle > 3.0
            push!(pathologies, Dict(
                "type"     => "vertebral_wedging",
                "location" => string(vert.level),
                "severity" => vert.wedging_angle > 6 ? "sévère" : "légère",
                "detail"   => @sprintf("Cunéiformisation : %.1f°", vert.wedging_angle),
            ))
        end
    end
    
    return pathologies
end

"""Résumé d'un résultat de simulation longitudinale."""
function summarize_simulation(result)::Dict
    return Dict(
        "duration_years"          => result.duration_years,
        "final_cobb_angle_deg"    => round(result.final_cobb, digits=1),
        "developed_scoliosis"     => result.developed_scoliosis,
        "scoliosis_onset_years"   => result.developed_scoliosis ? 
            round(result.scoliosis_onset_years, digits=1) : nothing,
        "buckling_detected"       => result.buckling_detected,
        "max_accumulated_damage"  => round(result.max_damage, digits=4),
        "warnings"                => result.warnings,
        "num_snapshots"           => length(result.snapshots),
    )
end

"""Génère des recommandations cliniques basées sur les mesures."""
function generate_recommendations(clinical::Dict, pathologies::Vector{Dict})::Vector{String}
    recs = String[]
    
    cobb = get(clinical, "cobb_angle_deg", 0.0)
    
    if cobb < 10
        push!(recs, "Rachis dans les limites normales — surveillance annuelle recommandée")
    elseif cobb < 25
        push!(recs, "Scoliose légère (< 25°) — kinésithérapie et surveillance tous les 6 mois")
        push!(recs, "Envisager le port d'orthèse si le patient est en croissance")
    elseif cobb < 40
        push!(recs, "Scoliose modérée (25–40°) — orthèse correctrice (Boston ou Rigo-Chêneau)")
        push!(recs, "Consultation chirurgicale si progression > 5°/an")
    else
        push!(recs, "Scoliose sévère (> 40°) — évaluation chirurgicale recommandée")
        push!(recs, "Arthrodèse vertébrale à discuter selon âge osseux et progression")
    end
    
    kyphosis = get(clinical, "thoracic_kyphosis_deg", 35.0)
    kyphosis > 55 && push!(recs, "Hypercyphose thoracique — kinésithérapie en extension")
    kyphosis < 20 && push!(recs, "Hypo-cyphose thoracique — réévaluation posturale")
    
    any(p -> p["type"] == "disc_degeneration", pathologies) &&
        push!(recs, "Dégénérescence discale détectée — programme de renforcement du tronc")
    
    any(p -> p["type"] == "disc_herniation", pathologies) &&
        push!(recs, "Hernie discale présente — évitement des charges axiales extrêmes")
    
    return recs
end

# ── Helpers ────────────────────────────────────────────────────

function estimate_curvature_angle(vertebrae)::Float64
    isempty(vertebrae) && return 0.0
    length(vertebrae) < 2 && return 0.0
    
    # Vecteur entre la première et dernière vertèbre
    p1 = vertebrae[1].position
    pN = vertebrae[end].position
    
    # Angle approximatif avec l'axe vertical
    dz = pN[3] - p1[3]
    dy = pN[2] - p1[2]
    angle = abs(atand(abs(dy), abs(dz)))
    return max(0.0, min(angle * 2, 90.0))
end

function estimate_cobb_from_model(model)::Float64
    positions_x = [v.position[1] for v in model.vertebrae]
    positions_z = [v.position[3] for v in model.vertebrae]
    
    x_range = maximum(positions_x) - minimum(positions_x)
    z_range = maximum(positions_z) - minimum(positions_z)
    
    z_range < 0.01 && return 0.0
    return atand(x_range / z_range) * 2
end

function cobb_severity_label(cobb::Float64)::String
    cobb < 10  && return "normal"
    cobb < 25  && return "légère"
    cobb < 40  && return "modérée"
    cobb < 60  && return "sévère"
    return "très sévère"
end

end  # module Reports
