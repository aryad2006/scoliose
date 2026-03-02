# ══════════════════════════════════════════════════════════════
# Vertex — Spondylolisthésis
# ══════════════════════════════════════════════════════════════

"""
Classification de Meyerding du spondylolisthésis (glissement antérieur).
Grade I à V selon le pourcentage de déplacement.
"""
@enum MeyerdingGrade begin
    MEYERDING_I    # 1-25% de glissement
    MEYERDING_II   # 25-50%
    MEYERDING_III  # 50-75%
    MEYERDING_IV   # 75-100%
    SPONDYLOPTOSIS # >100% (chute complète)
end

"""
Étiologie du spondylolisthésis.
"""
@enum SpondyloEtiology begin
    ISTHMIC         # Lyse isthmique (spondylolyse) — la plus fréquente
    DEGENERATIVE    # Dégénératif (arthrose facettaire, fréquent L4-L5 chez la femme)
    DYSPLASTIC      # Congénital (anomalie facettaire L5-S1)
    TRAUMATIC       # Post-traumatique
    PATHOLOGIC      # Pathologique (tumeur, infection)
    IATROGENIC      # Post-chirurgical (laminectomie excessive)
end

"""
Paramètres de spondylolisthésis.
"""
struct SpondyloParameters
    level::VertebralLevel               # Vertèbre qui glisse (ex: L5)
    etiology::SpondyloEtiology
    grade::MeyerdingGrade
    
    # Glissement
    slip_percent::Float64               # % de glissement antérieur (0-100+)
    slip_angle::Float64                 # Angle de glissement (degrés)
    
    # Lyse isthmique (si isthmic)
    bilateral_pars_defect::Bool         # Fracture bilatérale de l'isthme
    
    # Paramètres sagittaux pelviens
    pelvic_incidence::Float64           # PI (degrés) — typiquement élevé
    sacral_slope::Float64               # SS (degrés)
    pelvic_tilt::Float64                # PT (degrés)
    
    # Sténose associée
    canal_stenosis::Float64             # % (0-1)
    foraminal_stenosis::Float64         # % (0-1) — compression des racines
    
    # Symptômes associés
    radiculopathy::Bool                 # Radiculopathie (L5 pour listhésis L5-S1)
    claudication::Bool                  # Claudication neurogène
end

"""
    generate_spondylolisthesis!(model::SpineModel, params::SpondyloParameters)

Applique un spondylolisthésis au rachis.
"""
function generate_spondylolisthesis!(model::SpineModel, params::SpondyloParameters)
    idx = level_index(params.level)
    
    # ── 1. Translation antérieure de la vertèbre ──
    vb = model.vertebrae[idx]
    morph = vb.morphology
    
    # Le glissement est antérieur (= direction +y dans notre repère)
    slip_mm = morph.body_depth * params.slip_percent / 100.0
    
    pos = vb.position
    model.vertebrae[idx].position = Vec3(pos[1], pos[2] + slip_mm, pos[3])
    
    # ── 2. Angle de glissement (inclinaison sagittale) ──
    θy = deg2rad(params.slip_angle)
    R = rotation_matrix(0.0, θy, 0.0)
    model.vertebrae[idx].orientation = R * vb.orientation
    
    # ── 3. Cascade sus-jacente ──
    # Toutes les vertèbres au-dessus glissent avec
    for i in 1:(idx-1)
        p = model.vertebrae[i].position
        # Translation + propagation de la lordose compensatoire
        t = (idx - i) / idx
        model.vertebrae[i].position = Vec3(
            p[1],
            p[2] + slip_mm * (1.0 - 0.3 * t),  # Atténuation progressive
            p[3]
        )
    end
    
    # ── 4. Lyse isthmique → rupture des ligaments ──
    if params.etiology == ISTHMIC && params.bilateral_pars_defect
        for lig in model.ligaments
            if lig.level == params.level && lig.type in (ISL, SSL, LF)
                # L'isthme rompu déconnecte les éléments postérieurs de l'arc antérieur
                lig.linear_stiffness *= 0.3  # Réduction drastique
            end
        end
    end
    
    # ── 5. Dégénérescence facettaire (si dégénératif) ──
    if params.etiology == DEGENERATIVE
        for lig in model.ligaments
            if lig.level == params.level && lig.type == CL
                lig.linear_stiffness *= 0.5  # Laxité capsulaire
            end
        end
        # Le disque sous-jacent est aussi dégénéré
        if idx <= length(model.discs)
            disc = model.discs[idx]
            disc.degeneration = PfirrmannGrade(min(5, 3))
            disc.nucleus.pressure *= 0.5
        end
    end
    
    # ── 6. Diminution de hauteur du disque ──
    if idx <= length(model.discs)
        model.discs[idx].height *= 0.7  # Affaissement discal typique
    end
    
    model.is_solved = false
    return model
end

# ── Cas prédéfinis ──

"""
Spondylolisthésis isthmique L5-S1 grade II (adolescent sportif).
"""
function isthmic_l5s1_grade2(; slip::Float64=35.0, pi::Float64=65.0)
    return SpondyloParameters(
        L5, ISTHMIC, MEYERDING_II,
        slip, 10.0,
        true,
        pi, 45.0, 20.0,
        0.10, 0.25,
        true, false
    )
end

"""
Spondylolisthésis dégénératif L4-L5 grade I (femme 65+ ans).
"""
function degenerative_l4l5_grade1(; slip::Float64=18.0)
    return SpondyloParameters(
        L4, DEGENERATIVE, MEYERDING_I,
        slip, 5.0,
        false,
        55.0, 35.0, 20.0,
        0.20, 0.30,
        true, true
    )
end

"""
Spondylolisthésis dysplasique L5-S1 grade IV (haut grade, adolescent).
"""
function dysplastic_l5s1_grade4(; slip::Float64=85.0)
    return SpondyloParameters(
        L5, DYSPLASTIC, MEYERDING_IV,
        slip, 35.0,
        true,
        80.0, 55.0, 25.0,
        0.40, 0.50,
        true, true
    )
end
