# ══════════════════════════════════════════════════════════════
# Vertex — Modèle du Rachis Complet
# ══════════════════════════════════════════════════════════════

"""
Modèle biomécanique complet du rachis (C3–S1).
Assemblage de vertèbres, disques, ligaments avec état FEM global.
"""
mutable struct SpineModel
    id::UUID
    
    # Composants anatomiques
    vertebrae::Vector{VertebralBody}
    discs::Vector{IntervertebralDisc}
    ligaments::Vector{SpinalLigament}
    
    # Paramètres patient
    patient_weight::Float64     # kg
    patient_height::Float64     # cm
    age::Int
    sex::Symbol                 # :M ou :F
    bone_tscore::Float64        # T-score DEXA
    
    # État FEM global
    num_nodes::Int
    num_dof::Int                # 3 × num_nodes (déplacements)
    global_stiffness::SparseMatrixCSC{Float64, Int}
    force_vector::Vector{Float64}
    displacement::Vector{Float64}
    stress_field::Vector{StressTensor}
    
    # Conditions aux limites
    fixed_dofs::Vector{Int}     # Degrés de liberté fixés (sacrum)
    
    # Métadonnées
    is_solved::Bool
    solver_iterations::Int
    solver_residual::Float64
end

"""
    create_normal_spine(; weight=70, height=170, age=30, sex=:M, tscore=0.0) → SpineModel

Crée un rachis normal (non pathologique) avec toutes les structures anatomiques.
Le sacrum S1 est fixé comme condition aux limites.
"""
function create_normal_spine(; weight::Float64=70.0, height::Float64=170.0,
                               age::Int=30, sex::Symbol=:M, tscore::Float64=0.0)
    levels = vertebral_levels()
    n_vert = length(levels)
    
    # ── 1. Calculer les positions verticales ──
    # Le sacrum est à z=0, les vertèbres montent
    # Hauteur totale approximative du rachis: basée sur la taille du patient
    spine_height = height * 0.45  # ~45% de la taille du corps
    
    positions = compute_spine_positions(levels, spine_height)
    
    # ── 2. Créer les vertèbres ──
    vertebrae = VertebralBody[]
    for (i, level) in enumerate(levels)
        vb = create_vertebra(level, positions[i]; tscore=tscore)
        push!(vertebrae, vb)
    end
    
    # ── 3. Créer les disques ──
    discs = IntervertebralDisc[]
    for i in 1:(n_vert - 1)
        upper = levels[i]
        lower = levels[i + 1]
        dlevel = disc_level_for(upper, lower)
        disc_pos = (positions[i] + positions[i + 1]) / 2.0
        w = (vertebrae[i].morphology.body_width + vertebrae[i+1].morphology.body_width) / 2.0
        d = (vertebrae[i].morphology.body_depth + vertebrae[i+1].morphology.body_depth) / 2.0
        disc = create_disc(dlevel, disc_pos, w, d)
        push!(discs, disc)
    end
    
    # ── 4. Créer les ligaments ──
    all_ligaments = SpinalLigament[]
    for i in 1:(n_vert - 1)
        level = levels[i]
        w = vertebrae[i].morphology.body_width
        d = vertebrae[i].morphology.body_depth
        level_ligs = create_level_ligaments(level, positions[i], positions[i+1], w, d)
        append!(all_ligaments, level_ligs)
    end
    
    # ── 5. Assembler le modèle ──
    # Pour la Phase 0, on utilise un modèle simplifié : chaque vertèbre = 1 nœud (6 DOF)
    num_nodes = n_vert
    num_dof = 6 * num_nodes  # 3 translations + 3 rotations par nœud
    
    K = spzeros(num_dof, num_dof)
    F = zeros(num_dof)
    U = zeros(num_dof)
    
    # Conditions aux limites : sacrum fixé (dernier nœud)
    sacrum_dofs = ((n_vert - 1) * 6 + 1):(n_vert * 6)
    
    model = SpineModel(
        uuid4(),
        vertebrae, discs, all_ligaments,
        weight, height, age, sex, tscore,
        num_nodes, num_dof,
        K, F, U,
        StressTensor[],
        collect(sacrum_dofs),
        false, 0, Inf
    )
    
    return model
end

"""
    compute_spine_positions(levels, total_height) → Vector{Vec3}

Calcule les positions 3D initiales des vertèbres dans la configuration de référence.
Inclut les courbures sagittales physiologiques (lordose/cyphose).
"""
function compute_spine_positions(levels::Vector{VertebralLevel}, total_height::Float64)
    n = length(levels)
    positions = Vec3[]
    
    # Espacement vertical uniforme comme point de départ
    dz = total_height / (n - 1)
    
    for (i, level) in enumerate(levels)
        z = (n - i) * dz  # S1 en bas (z=0), C3 en haut
        
        # Courbures sagittales physiologiques (déplacement AP en y)
        # Lordose cervicale: convexe antérieur (+y)
        # Cyphose thoracique: convexe postérieur (-y)
        # Lordose lombaire: convexe antérieur (+y)
        y = sagittal_offset(level)
        
        push!(positions, Vec3(0.0, y, z))
    end
    
    return positions
end

"""
    sagittal_offset(level) → Float64

Déplacement antéro-postérieur (mm) pour les courbures sagittales physiologiques.
Valeurs moyennes issues de Roussouly & Pinheiro-Franco, 2011.
"""
function sagittal_offset(level::VertebralLevel)::Float64
    offsets = Dict{VertebralLevel, Float64}(
        # Lordose cervicale (~20-40°)
        C3 => 8.0, C4 => 10.0, C5 => 11.0, C6 => 10.0, C7 => 6.0,
        # Jonction cervico-thoracique
        T1 => 0.0,
        # Cyphose thoracique (~20-45°)
        T2 => -4.0, T3 => -8.0, T4 => -12.0, T5 => -15.0,
        T6 => -17.0, T7 => -18.0, T8 => -17.0, T9 => -15.0,
        T10 => -12.0, T11 => -8.0, T12 => -3.0,
        # Lordose lombaire (~40-70°)
        L1 => 3.0, L2 => 8.0, L3 => 12.0, L4 => 14.0, L5 => 12.0,
        # Sacrum
        S1 => 0.0,
    )
    return get(offsets, level, 0.0)
end

"""
    get_vertebra(model::SpineModel, level::VertebralLevel) → VertebralBody

Récupère une vertèbre par son niveau anatomique.
"""
function get_vertebra(model::SpineModel, level::VertebralLevel)
    idx = findfirst(v -> v.level == level, model.vertebrae)
    isnothing(idx) && error("Vertèbre $level non trouvée dans le modèle")
    return model.vertebrae[idx]
end

"""
    get_disc(model::SpineModel, level::DiscLevel) → IntervertebralDisc

Récupère un disque par son niveau.
"""
function get_disc(model::SpineModel, level::DiscLevel)
    idx = findfirst(d -> d.level == level, model.discs)
    isnothing(idx) && error("Disque $level non trouvé dans le modèle")
    return model.discs[idx]
end

"""
    measure_cobb(model::SpineModel, upper::VertebralLevel, lower::VertebralLevel) → Float64

Mesure l'angle de Cobb (degrés) entre deux vertèbres dans le plan frontal.
"""
function measure_cobb(model::SpineModel, upper::VertebralLevel, lower::VertebralLevel)
    v_upper = get_vertebra(model, upper)
    v_lower = get_vertebra(model, lower)
    
    # Vecteur normal au plateau supérieur de chaque vertèbre
    n1 = v_upper.orientation * Vec3(1, 0, 0)  # axe transversal
    n2 = v_lower.orientation * Vec3(1, 0, 0)
    
    # Angle entre les deux dans le plan frontal (projection XZ)
    n1_xz = Vec3(n1[1], 0, n1[3])
    n2_xz = Vec3(n2[1], 0, n2[3])
    
    cos_angle = dot(n1_xz, n2_xz) / (norm(n1_xz) * norm(n2_xz) + 1e-10)
    return rad2deg(acos(clamp(cos_angle, -1, 1)))
end

"""
    to_json(model::SpineModel) → Dict

Sérialise le modèle pour transmission au frontend via WebSocket/REST.
"""
function to_json(model::SpineModel)
    return Dict(
        "id" => string(model.id),
        "patient" => Dict(
            "weight" => model.patient_weight,
            "height" => model.patient_height,
            "age" => model.age,
            "sex" => string(model.sex),
            "tscore" => model.bone_tscore,
        ),
        "vertebrae" => [
            Dict(
                "level" => string(v.level),
                "position" => [v.position[1], v.position[2], v.position[3]],
                "orientation" => collect(v.orientation),
                "morphology" => Dict(
                    "body_width" => v.morphology.body_width,
                    "body_depth" => v.morphology.body_depth,
                    "body_height" => v.morphology.body_height,
                    "pedicle_width" => v.morphology.pedicle_width,
                    "pedicle_height" => v.morphology.pedicle_height,
                    "canal_width" => v.morphology.canal_width,
                    "canal_depth" => v.morphology.canal_depth,
                    "facet_orientation" => v.morphology.facet_orientation,
                )
            ) for v in model.vertebrae
        ],
        "discs" => [
            Dict(
                "level" => string(d.level),
                "position" => [d.position[1], d.position[2], d.position[3]],
                "height" => d.height,
                "width" => d.width,
                "depth" => d.depth,
                "pfirrmann" => d.degeneration.grade,
            ) for d in model.discs
        ],
        "is_solved" => model.is_solved,
        "num_nodes" => model.num_nodes,
        "num_dof" => model.num_dof,
    )
end
