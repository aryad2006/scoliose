# ══════════════════════════════════════════════════════════════
# Vertex — Sténose du canal rachidien
# ══════════════════════════════════════════════════════════════

"""
Localisation anatomique de la sténose canalaire.
"""
@enum StenosisLocation begin
    CENTRAL_CANAL       # Canal central
    LATERAL_RECESS      # Récessus latéral (sous-articulaire)
    FORAMINAL_CANAL     # Foraminale (trou de conjugaison)
    EXTRAFORAMINAL_CANAL # Extra-foraminale (Far-out syndrome)
end

"""
Classification de Schizas (IRM, séquence T2 axiale) pour la sténose centrale.
Grade A–D selon la morphologie du LCS vs racines.
"""
@enum SchizasGrade begin
    SCHIZAS_A   # LCS visible, racines bien séparées
    SCHIZAS_B   # Racines regroupées mais encore du LCS
    SCHIZAS_C   # Pas de LCS résiduel visible, racines agrégées
    SCHIZAS_D   # Compression sévère, pas de signal LCS du tout
end

"""
Type de sténose (étiologie).
"""
@enum StenosisType begin
    DEGENERATIVE_STENOSIS   # Arthrose facettaire + hypertrophie LF + discopathie
    CONGENITAL_STENOSIS     # Canal constitutionnellement étroit (diamètre AP < 12mm)
    COMBINED_STENOSIS       # Congénitale + dégénérative surajoutée
    IATROGENIC_STENOSIS     # Post-chirurgicale (fibrose épidurale)
    SPONDYLOLISTHETIC       # Associée à un spondylolisthésis
end

"""
Paramètres de sténose rachidienne.
"""
struct StenosisParameters
    level::VertebralLevel                  # Niveau principal (ex: L4)
    location::StenosisLocation
    stenosis_type::StenosisType
    schizas::SchizasGrade                  # Grade de Schizas (central stenosis)
    
    # Dimensions mesurées
    canal_ap_diameter::Float64             # Diamètre antéro-postérieur (mm), normal ~15-17mm
    canal_area::Float64                    # Surface canalaire (mm²), normal > 100 mm²
    
    # Facteurs contribuant à la sténose
    ligamentum_flavum_thickness::Float64   # Épaisseur LF (mm), normal 2-4, pathologique > 4
    facet_hypertrophy::Float64             # % d'hypertrophie facettaire (0-1)
    disc_bulge::Float64                    # % de protrusion discale contribuant (0-1)
    osteophyte_encroachment::Float64       # % d'invasion par ostéophytes (0-1)
    
    # Extension multi-niveaux
    multi_level::Bool                      # Sténose étagée
    adjacent_levels::Vector{VertebralLevel}# Niveaux adjacents atteints
    
    # Symptômes
    neurogenic_claudication::Bool          # Claudication neurogène (< 200m)
    radiculopathy::Bool                    # Radiculopathie associée
    cauda_equina::Bool                     # Syndrome de la queue de cheval (urgence!)
end

"""
    generate_stenosis!(model::SpineModel, params::StenosisParameters)

Applique une sténose canalaire au rachis.
"""
function generate_stenosis!(model::SpineModel, params::StenosisParameters)
    idx = level_index(params.level)
    levels = [idx]
    
    # Niveaux adjacents si multi-étagé
    if params.multi_level
        for adj in params.adjacent_levels
            push!(levels, level_index(adj))
        end
    end
    
    for lidx in levels
        # ── 1. Hypertrophie du ligament jaune (LF) ──
        lf_factor = params.ligamentum_flavum_thickness / 3.0  # Ratio vs normal
        for lig in model.ligaments
            if lig.level_index == lidx && lig.type == LF
                # Épaississement → augmente la raideur mais réduit l'espace canalaire
                lig.linear_stiffness *= lf_factor
                lig.cross_section_area *= lf_factor
            end
        end
        
        # ── 2. Hypertrophie facettaire ──
        hyp = params.facet_hypertrophy
        for lig in model.ligaments
            if lig.level_index == lidx && lig.type == CL
                # Raideur facettaire augmentée
                lig.linear_stiffness *= (1.0 + hyp)
            end
        end
        
        # ── 3. Protrusion discale ──
        if lidx <= length(model.discs) && params.disc_bulge > 0
            disc = model.discs[lidx]
            # Le bombement discal réduit la hauteur et augmente la pression
            disc.height *= (1.0 - 0.3 * params.disc_bulge)
            disc.annulus.stiffness *= (0.8 + 0.4 * params.disc_bulge)
        end
        
        # ── 4. Ostéophytes → rigidification segmentaire ──
        if params.osteophyte_encroachment > 0
            osteo_factor = 1.0 + 2.0 * params.osteophyte_encroachment
            for lig in model.ligaments
                if lig.level_index == lidx && lig.type in (LVCA, LVCP)
                    lig.linear_stiffness *= osteo_factor
                end
            end
        end
        
        # ── 5. Réduction de la mobilité segmentaire ──
        # La sténose dégénérative fige le segment
        if params.stenosis_type == DEGENERATIVE_STENOSIS
            vb = model.vertebrae[lidx]
            # Augmentation de la raideur globale du segment
            for lig in model.ligaments
                if lig.level_index == lidx
                    lig.linear_stiffness *= 1.3
                end
            end
        end
    end
    
    model.is_solved = false
    return model
end

# ── Cas prédéfinis ──

"""
Sténose lombaire centrale L4-L5 dégénérative typique (patient > 60 ans).
"""
function central_stenosis_l4l5(; schizas::SchizasGrade=SCHIZAS_C)
    return StenosisParameters(
        L4, CENTRAL_CANAL, DEGENERATIVE_STENOSIS, schizas,
        9.0, 65.0,                          # Canal rétréci
        5.5, 0.4, 0.3, 0.2,                # LF épais, facettes hypertrophiques
        true, [L3, L5],                      # Multi-étagé
        true, false, false                   # Claudication neurogène
    )
end

"""
Sténose foraminale L5-S1 (compression de la racine L5).
"""
function foraminal_stenosis_l5s1()
    return StenosisParameters(
        L5, FORAMINAL_CANAL, DEGENERATIVE_STENOSIS, SCHIZAS_B,
        13.0, 90.0,
        4.0, 0.3, 0.5, 0.3,
        false, VertebralLevel[],
        false, true, false                   # Radiculopathie isolée
    )
end

"""
Sténose cervicale C5-C6 (myélopathie cervicarthrosique).
"""
function cervical_stenosis_c5c6()
    return StenosisParameters(
        C5, CENTRAL_CANAL, COMBINED_STENOSIS, SCHIZAS_D,
        8.0, 50.0,
        4.5, 0.5, 0.4, 0.4,
        true, [C4, C6],
        false, true, false
    )
end

"""
Canal lombaire étroit constitutionnel (sujet jeune, canal < 12mm).
"""
function congenital_narrow_canal()
    return StenosisParameters(
        L4, CENTRAL_CANAL, CONGENITAL_STENOSIS, SCHIZAS_B,
        11.0, 85.0,
        3.0, 0.1, 0.1, 0.0,                # Peu de dégénératif
        true, [L3, L5],
        true, false, false
    )
end
