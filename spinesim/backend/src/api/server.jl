# ══════════════════════════════════════════════════════════════
# Vertex — Serveur API REST
# ══════════════════════════════════════════════════════════════

using HTTP
using JSON3
using Sockets
using UUIDs
using Dates
using Logging

# Module de base de données (Sprint 1)
include(joinpath(@__DIR__, "..", "db", "database.jl"))
using .Database

# Module d'authentification (Sprint 2)
include(joinpath(@__DIR__, "..", "auth", "users.jl"))
using .Users

# Module de rapports (Sprint 3)
include(joinpath(@__DIR__, "..", "reports", "report.jl"))
using .Reports

# ── Stockage en mémoire des modèles actifs (thread-safe) ──
const ACTIVE_MODELS = Dict{UUID, SpineModel}()
const MODELS_LOCK = ReentrantLock()

# ── Helpers d'accès thread-safe ──
function get_model(id::UUID)::Union{SpineModel, Nothing}
    lock(MODELS_LOCK) do
        get(ACTIVE_MODELS, id, nothing)
    end
end

function set_model!(id::UUID, model::SpineModel)
    lock(MODELS_LOCK) do
        ACTIVE_MODELS[id] = model
    end
end

function delete_model!(id::UUID)
    lock(MODELS_LOCK) do
        delete!(ACTIVE_MODELS, id)
    end
end

function count_models()::Int
    lock(MODELS_LOCK) do
        length(ACTIVE_MODELS)
    end
end

# ── Logging structuré ──
function log_request(method::String, path::String, status::Int, duration_ms::Float64)
    @info "HTTP" method=method path=path status=status duration_ms=round(duration_ms, digits=2)
end

"""
    start_server(; port=8080)

Démarre le serveur HTTP API pour VERTEX©.
"""
function start_server(; port::Int=8080)
    router = HTTP.Router()
    
    # ── Routes API REST ──
    
    # Santé / info
    HTTP.register!(router, "GET", "/api/health", handle_health)
    HTTP.register!(router, "GET", "/api/info", handle_info)
    
    # Modèle de rachis
    HTTP.register!(router, "POST", "/api/spine/create", handle_create_spine)
    HTTP.register!(router, "GET", "/api/spine/*", handle_get_spine)
    HTTP.register!(router, "POST", "/api/spine/*/solve", handle_solve_spine)
    
    # Scoliose
    HTTP.register!(router, "POST", "/api/spine/*/scoliosis", handle_apply_scoliosis)
    
    # Autres pathologies
    HTTP.register!(router, "POST", "/api/spine/*/fracture", handle_apply_fracture)
    HTTP.register!(router, "POST", "/api/spine/*/hernia", handle_apply_hernia)
    HTTP.register!(router, "POST", "/api/spine/*/spondylolisthesis", handle_apply_spondylolisthesis)
    HTTP.register!(router, "POST", "/api/spine/*/stenosis", handle_apply_stenosis)
    HTTP.register!(router, "POST", "/api/spine/*/tumor", handle_apply_tumor)
    HTTP.register!(router, "POST", "/api/spine/*/adult-deformity", handle_apply_adult_deformity)
    
    # Chirurgie
    HTTP.register!(router, "POST", "/api/surgery/*/screw", handle_place_screw)
    HTTP.register!(router, "POST", "/api/surgery/*/rod", handle_place_rod)
    HTTP.register!(router, "POST", "/api/surgery/*/correct", handle_correction)
    HTTP.register!(router, "GET", "/api/surgery/*/evaluate", handle_evaluate)
    
    # Simulation longitudinale (théorie du ressort spiral)
    HTTP.register!(router, "POST", "/api/longitudinal/run", handle_longitudinal_run)
    HTTP.register!(router, "POST", "/api/longitudinal/comparison", handle_longitudinal_comparison)
    
    # Authentification (Sprint 2)
    HTTP.register!(router, "POST", "/api/auth/register", handle_auth_register)
    HTTP.register!(router, "POST", "/api/auth/login",    handle_auth_login)
    HTTP.register!(router, "POST", "/api/auth/refresh",  handle_auth_refresh)
    HTTP.register!(router, "POST", "/api/auth/logout",   handle_auth_logout)
    HTTP.register!(router, "GET",  "/api/auth/me",       handle_auth_me)

    # Rapports PDF (Sprint 3)
    HTTP.register!(router, "GET",  "/api/spine/*/report", handle_get_report)
    
    # CORS headers pour le frontend
    HTTP.register!(router, "OPTIONS", "/*", handle_cors_preflight)
    
    println("╔══════════════════════════════════════════════╗")
    println("║         🦴 VERTEX© Server v0.2.0           ║")
    println("║  Virtual Environment for Rachis           ║")
    println("║  Training and EXploration                 ║")
    println("║  Port: $port                                 ║")
    println("╚══════════════════════════════════════════════╝")
    println()
    # Connexion base de données (mode dégradé si indisponible)
    db_ok = Database.init_db()
    if db_ok
        @info "PostgreSQL : disponible"
    else
        @warn "PostgreSQL : indisponible — fonctionnement en mode mémoire seule"
    end
    println()    println("Endpoints disponibles:")
    println("  GET  /api/health                  — État du serveur")
    println("  POST /api/spine/create             — Créer un rachis")
    println("  GET  /api/spine/{id}               — Récupérer un modèle")
    println("  POST /api/spine/{id}/solve          — Résoudre FEM")
    println("  POST /api/spine/{id}/scoliosis      — Appliquer scoliose")
    println("  POST /api/spine/{id}/fracture       — Appliquer fracture")
    println("  POST /api/spine/{id}/hernia         — Appliquer hernie discale")
    println("  POST /api/spine/{id}/spondylolisthesis — Spondylolisthésis")
    println("  POST /api/spine/{id}/stenosis       — Sténose canalaire")
    println("  POST /api/spine/{id}/tumor          — Tumeur rachidienne")
    println("  POST /api/spine/{id}/adult-deformity — Déformité adulte")
    println("  POST /api/surgery/{id}/screw        — Placer une vis")
    println("  POST /api/surgery/{id}/rod          — Placer une tige")
    println("  POST /api/surgery/{id}/correct      — Manœuvre de correction")
    println("  GET  /api/surgery/{id}/evaluate     — Évaluer la chirurgie")
    println("  POST /api/longitudinal/run          — Simulation longitudinale")
    println("  POST /api/longitudinal/comparison   — Étude comparative (ressort spiral)")
    println()
    
    HTTP.serve(router, "0.0.0.0", port;
               access_log=nothing,
               verbose=false)
end

# ── Middleware CORS ──
function add_cors_headers!(response::HTTP.Response)
    HTTP.setheader(response, "Access-Control-Allow-Origin" => "*")
    HTTP.setheader(response, "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE, OPTIONS")
    HTTP.setheader(response, "Access-Control-Allow-Headers" => "Content-Type, Authorization")
    return response
end

function json_response(data; status::Int=200)
    body = JSON3.write(data)
    resp = HTTP.Response(status, ["Content-Type" => "application/json"], body)
    return add_cors_headers!(resp)
end

function error_response(msg::String; status::Int=400)
    return json_response(Dict("error" => msg); status=status)
end

function handle_cors_preflight(req::HTTP.Request)
    resp = HTTP.Response(204)
    return add_cors_headers!(resp)
end

# ── Handlers ──

function handle_health(req::HTTP.Request)
    return json_response(Dict(
        "status" => "ok",
        "version" => "0.2.0",
        "active_models" => count_models(),
        "database" => Database.db_available() ? "connected" : "unavailable",
        "timestamp" => string(now()),
    ))
end

function handle_info(req::HTTP.Request)
    return json_response(Dict(
        "name" => "VERTEX©",
        "version" => "0.2.0-alpha",
        "description" => "Virtual Environment for Rachis Training and EXploration",
        "capabilities" => [
            "normal_spine", "scoliosis_generator",
            "fracture_generator", "hernia_generator",
            "spondylolisthesis_generator", "stenosis_generator",
            "tumor_generator", "adult_deformity_generator",
            "pedicle_screw", "rod_placement", "correction_maneuvers",
            "fem_solver", "stress_analysis",
            "longitudinal_simulation", "spring_spiral_theory",
            "fatigue_analysis", "bone_remodeling", "disc_degeneration"
        ],
        "vertebral_levels" => string.(vertebral_levels()),
    ))
end

function handle_create_spine(req::HTTP.Request)
    t0 = time()
    try
        body = JSON3.read(String(req.body))
        
        weight = get(body, :weight, 70.0)
        height = get(body, :height, 170.0)
        age = get(body, :age, 30)
        sex = Symbol(get(body, :sex, "M"))
        tscore = get(body, :tscore, 0.0)
        
        model = create_normal_spine(
            weight=Float64(weight), height=Float64(height),
            age=Int(age), sex=sex, tscore=Float64(tscore)
        )
        
        set_model!(model.id, model)
        
        # Persister en base de données (si disponible)
        if Database.db_available()
            model_json = JSON3.write(to_json(model))
            params_nt = (weight=Float64(weight), height=Float64(height),
                         age=Int(age), sex=string(sex), tscore=Float64(tscore))
            Database.save_spine_model(model.id, model_json, params_nt)
        end
        
        resp = json_response(Dict(
            "id" => string(model.id),
            "message" => "Rachis créé avec succès",
            "num_vertebrae" => length(model.vertebrae),
            "num_discs" => length(model.discs),
            "num_ligaments" => length(model.ligaments),
            "model" => to_json(model),
        ); status=201)
        log_request("POST", "/api/spine/create", 201, (time()-t0)*1000)
        return resp
        
    catch e
        @error "handle_create_spine failed" exception=(e, catch_backtrace())
        log_request("POST", "/api/spine/create", 500, (time()-t0)*1000)
        return error_response("Erreur création rachis: $(sprint(showerror, e))"; status=500)
    end
end

function handle_get_spine(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            log_request("GET", "/api/spine/$id_str", 404, (time()-t0)*1000)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        resp = json_response(to_json(model))
        log_request("GET", "/api/spine/$id_str", 200, (time()-t0)*1000)
        return resp
    catch e
        @error "handle_get_spine failed" id=id_str exception=(e, catch_backtrace())
        log_request("GET", "/api/spine/$id_str", 400, (time()-t0)*1000)
        return error_response("ID invalide: $id_str"; status=400)
    end
end

function handle_solve_spine(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        t0 = time()
        U = solve_spine!(model)
        elapsed = time() - t0
        
        # Contraintes de von Mises
        vm_stresses = [von_mises(s) for s in model.stress_field]
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Simulation résolue",
            "solver_time_ms" => round(elapsed * 1000, digits=1),
            "max_displacement_mm" => round(maximum(abs.(U)), digits=3),
            "max_von_mises_mpa" => isempty(vm_stresses) ? 0.0 : round(maximum(vm_stresses) / 1e6, digits=2),
            "num_dof" => model.num_dof,
            "model" => to_json(model),
            "stresses" => [round(von_mises(s) / 1e6, digits=2) for s in model.stress_field],
        ))
        
    catch e
        return error_response("Erreur résolution: $(sprint(showerror, e))"; status=500)
    end
end

function handle_apply_scoliosis(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        
        lenke = get(body, :lenke_type, 1)
        cobb = Float64(get(body, :cobb, 50.0))
        
        params = if lenke == 1
            lenke1_thoracic(cobb)
        elseif lenke == 5
            lenke5_thoracolumbar(cobb)
        else
            lenke1_thoracic(cobb)  # Défaut
        end
        
        generate_scoliosis!(model, params)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Scoliose Lenke $lenke appliquée (Cobb $(cobb)°)",
            "model" => to_json(model),
        ))
        
    catch e
        return error_response("Erreur scoliose: $(sprint(showerror, e))"; status=500)
    end
end

# ── Fracture ──
function handle_apply_fracture(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        preset = get(body, :preset, "")
        
        params = if preset == "burst_l1"
            burst_l1()
        elseif preset == "osteoporotic_T12"
            osteoporotic_compression_T12()
        elseif preset == "chance_L2"
            chance_fracture_L2()
        elseif preset == "dislocation_T12"
            fracture_dislocation_T12()
        else
            # Paramètres custom
            level = eval(Symbol(get(body, :level, "L1")))
            ftype = FractureType(get(body, :fracture_type, 0))
            burst_l1()  # Défaut
        end
        
        generate_fracture!(model, params)
        tlics = compute_tlics(params)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Fracture appliquée",
            "tlics_score" => tlics,
            "model" => to_json(model),
        ))
    catch e
        return error_response("Erreur fracture: $(sprint(showerror, e))"; status=500)
    end
end

# ── Hernie discale ──
function handle_apply_hernia(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        preset = get(body, :preset, "")
        
        params = if preset == "l4l5_left"
            hernia_l4l5_left()
        elseif preset == "l5s1_central"
            hernia_l5s1_central()
        elseif preset == "c5c6_right"
            hernia_c5c6_right()
        else
            hernia_l4l5_left()
        end
        
        generate_hernia!(model, params)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Hernie discale appliquée",
            "model" => to_json(model),
        ))
    catch e
        return error_response("Erreur hernie: $(sprint(showerror, e))"; status=500)
    end
end

# ── Spondylolisthésis ──
function handle_apply_spondylolisthesis(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        preset = get(body, :preset, "")
        
        params = if preset == "isthmic_l5s1"
            isthmic_l5s1_grade2()
        elseif preset == "degenerative_l4l5"
            degenerative_l4l5_grade1()
        elseif preset == "dysplastic_l5s1"
            dysplastic_l5s1_grade4()
        else
            isthmic_l5s1_grade2()
        end
        
        generate_spondylolisthesis!(model, params)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Spondylolisthésis appliqué (grade $(string(params.grade)))",
            "model" => to_json(model),
        ))
    catch e
        return error_response("Erreur spondylolisthésis: $(sprint(showerror, e))"; status=500)
    end
end

# ── Sténose canalaire ──
function handle_apply_stenosis(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        preset = get(body, :preset, "")
        
        params = if preset == "central_l4l5"
            central_stenosis_l4l5()
        elseif preset == "foraminal_l5s1"
            foraminal_stenosis_l5s1()
        elseif preset == "cervical_c5c6"
            cervical_stenosis_c5c6()
        elseif preset == "congenital"
            congenital_narrow_canal()
        else
            central_stenosis_l4l5()
        end
        
        generate_stenosis!(model, params)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Sténose appliquée (Schizas $(string(params.schizas)))",
            "model" => to_json(model),
        ))
    catch e
        return error_response("Erreur sténose: $(sprint(showerror, e))"; status=500)
    end
end

# ── Tumeur rachidienne ──
function handle_apply_tumor(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        preset = get(body, :preset, "")
        
        params = if preset == "metastasis_t12_lung"
            metastasis_t12_lung()
        elseif preset == "metastasis_t7_breast"
            metastasis_t7_breast()
        elseif preset == "osteoblastoma_l2"
            osteoblastoma_l2()
        else
            metastasis_t12_lung()
        end
        
        generate_tumor!(model, params)
        
        result = Dict(
            "id" => string(id),
            "message" => "Tumeur appliquée ($(params.is_metastatic ? "métastase" : "primitive"))",
            "model" => to_json(model),
        )
        
        if !isnothing(params.sins)
            result["sins_score"] = params.sins.total
            result["sins_stability"] = params.sins.total <= 6 ? "stable" : params.sins.total <= 12 ? "potentiellement instable" : "instable"
        end
        if !isnothing(params.tokuhashi)
            result["tokuhashi_score"] = params.tokuhashi.total
        end
        if !isnothing(params.tomita)
            result["tomita_score"] = params.tomita.total
        end
        
        return json_response(result)
    catch e
        return error_response("Erreur tumeur: $(sprint(showerror, e))"; status=500)
    end
end

# ── Déformité de l'adulte ──
function handle_apply_adult_deformity(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        preset = get(body, :preset, "")
        
        params = if preset == "degenerative_l2l4"
            degenerative_scoliosis_l2l4()
        elseif preset == "flat_back"
            flat_back_post_fusion()
        elseif preset == "scheuermann"
            scheuermann_adult()
        elseif preset == "progressive_idiopathic"
            progressive_idiopathic_adult()
        else
            degenerative_scoliosis_l2l4()
        end
        
        generate_adult_deformity!(model, params)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Déformité adulte appliquée ($(string(params.deformity_type)))",
            "schwab" => Dict(
                "curve_type" => string(params.schwab_curve),
                "pi_ll" => string(params.pi_ll_mod),
                "pt" => string(params.pt_mod),
                "sva" => string(params.sva_mod),
            ),
            "sagittal_balance" => Dict(
                "pi" => params.sagittal.pelvic_incidence,
                "pt" => params.sagittal.pelvic_tilt,
                "ll" => params.sagittal.lumbar_lordosis,
                "tk" => params.sagittal.thoracic_kyphosis,
                "sva_cm" => params.sagittal.sva,
                "pi_ll_mismatch" => params.sagittal.pi_ll_mismatch,
            ),
            "model" => to_json(model),
        ))
    catch e
        return error_response("Erreur déformité adulte: $(sprint(showerror, e))"; status=500)
    end
end

function handle_place_screw(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        
        level = eval(Symbol(body.level))
        side = Symbol(body.side)
        diameter = Float64(get(body, :diameter, 5.5))
        length_mm = Float64(get(body, :length, 40.0))
        
        vb = get_vertebra(model, level)
        entry = ideal_entry_point(level, side, vb.morphology, vb.position)
        traj = ideal_trajectory(level, side, vb.morphology)
        
        # Si des coordonnées custom sont fournies
        if haskey(body, :entry_x)
            entry = Vec3(Float64(body.entry_x), Float64(body.entry_y), Float64(body.entry_z))
        end
        
        screw = PedicleScrew(level, side, entry, traj, diameter, length_mm,
                             :polyaxial, TITANIUM_6AL4V)
        result = simulate_screw_placement(model, screw)
        
        return json_response(Dict(
            "id" => string(id),
            "level" => string(level),
            "side" => string(side),
            "result" => Dict(
                "placed" => result.is_placed,
                "breach" => string(result.breach),
                "breach_severity_mm" => round(result.breach_severity, digits=1),
                "pullout_strength_N" => round(result.pullout_strength, digits=0),
                "accuracy_percent" => round(result.accuracy, digits=1),
                "neural_risk" => round(result.neural_risk, digits=2),
                "vascular_risk" => round(result.vascular_risk, digits=2),
            ),
            "entry_point" => [entry[1], entry[2], entry[3]],
            "trajectory" => [traj[1], traj[2], traj[3]],
        ))
        
    catch e
        return error_response("Erreur vis: $(sprint(showerror, e))"; status=500)
    end
end

function handle_place_rod(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        
        side = Symbol(get(body, :side, "left"))
        upper = eval(Symbol(get(body, :upper_level, "T4")))
        lower = eval(Symbol(get(body, :lower_level, "L1")))
        material = Symbol(get(body, :material, "titanium"))
        diameter = Float64(get(body, :diameter, 5.5))
        
        rod = create_rod(side, upper, lower; material=material, diameter=diameter)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Tige placée ($side) de $(string(upper)) à $(string(lower))",
            "rod" => Dict(
                "side" => string(side),
                "upper" => string(upper),
                "lower" => string(lower),
                "material" => string(material),
                "diameter" => diameter,
            ),
        ))
        
    catch e
        return error_response("Erreur tige: $(sprint(showerror, e))"; status=500)
    end
end

function handle_correction(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        body = JSON3.read(String(req.body))
        
        maneuver_type = Symbol(get(body, :type, "rod_rotation"))
        upper = eval(Symbol(get(body, :upper_level, "T4")))
        lower = eval(Symbol(get(body, :lower_level, "L1")))
        intensity = Float64(get(body, :intensity, 80.0))
        dir = Vec3(0, 0, 1)  # Direction par défaut
        
        if haskey(body, :direction)
            d = body.direction
            dir = Vec3(Float64(d[1]), Float64(d[2]), Float64(d[3]))
        end
        
        rod = create_rod(:left, upper, lower)  # Rod de référence
        maneuver = CorrectionManeuver(maneuver_type, upper, lower, intensity, dir)
        
        # Sauvegarder l'état pré-correction pour comparaison
        apply_correction!(model, rod, maneuver)
        
        return json_response(Dict(
            "id" => string(id),
            "message" => "Manœuvre $(string(maneuver_type)) appliquée (intensité $(intensity)%)",
            "model" => to_json(model),
        ))
        
    catch e
        return error_response("Erreur correction: $(sprint(showerror, e))"; status=500)
    end
end

function handle_evaluate(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    try
        id = UUID(id_str)
        model = get_model(id)
        if isnothing(model)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        # Créer un rachis de référence (pré-op) pour comparaison
        preop = create_normal_spine(
            weight=model.patient_weight, height=model.patient_height,
            age=model.age, sex=model.sex, tscore=model.bone_tscore
        )
        
        screw_results_list = ScrewResult[]
        
        eval_result = evaluate_surgery(preop, model, screw_results_list, 0.0)
        
        return json_response(evaluation_to_json(eval_result))
        
    catch e
        return error_response("Erreur évaluation: $(sprint(showerror, e))"; status=500)
    end
end

# ── Utilitaire ──
function now()
    return Dates.format(Dates.now(), "yyyy-mm-dd HH:MM:SS")
end

# ═══════════════════════════════════════════════════════════════
# HANDLERS — Simulation Longitudinale (Théorie du ressort spiral)
# ═══════════════════════════════════════════════════════════════

"""
POST /api/longitudinal/run
Corps JSON :
{
  "duration_years": 20,
  "initial_age": 10,
  "sex": "F",
  "weight": 35,
  "height": 140,
  "asymmetry_type": "wedging",     -- "none", "wedging", "ligament", "disc", "combined"
  "asymmetry_level": "T8",
  "asymmetry_magnitude": 2.0,
  "asymmetry_side": "right"
}
"""
function handle_longitudinal_run(req::HTTP.Request)
    try
        body = JSON3.read(String(req.body))
        
        # Paramètres patient
        duration = Float64(get(body, :duration_years, 20))
        age = Int(get(body, :initial_age, 10))
        sex = Symbol(get(body, :sex, "F"))
        weight = Float64(get(body, :weight, 35.0))
        height = Float64(get(body, :height, 140.0))
        
        # Asymétrie
        asym_type = string(get(body, :asymmetry_type, "none"))
        asym_level_str = string(get(body, :asymmetry_level, "T8"))
        asym_mag = Float64(get(body, :asymmetry_magnitude, 2.0))
        asym_side = Symbol(get(body, :asymmetry_side, "right"))
        
        # Parser le niveau vertébral
        asym_level = parse_vertebral_level(asym_level_str)
        
        # Construire la config d'asymétrie
        # Supporte les formats "wedging_N" (degrés) et "ligament_N" (%) du frontend
        asym_config = if asym_type == "none"
            symmetric_config()
        # ── Formats frontend (wedging_1, wedging_2, wedging_3) ──
        elseif asym_type == "wedging_1"
            mild_vertebral_wedging(level=T8, angle=1.0, side=:right)
        elseif asym_type == "wedging_2"
            mild_vertebral_wedging(level=T8, angle=2.0, side=:right)
        elseif asym_type == "wedging_3"
            mild_vertebral_wedging(level=T8, angle=3.0, side=:right)
        # ── Formats frontend (ligament_10, ligament_20) ──
        elseif asym_type == "ligament_10"
            mild_ligament_asymmetry(level=T7, ratio=1.10, side=:right)
        elseif asym_type == "ligament_20"
            mild_ligament_asymmetry(level=T7, ratio=1.20, side=:right)
        # ── Format frontend (disc_10) ──
        elseif asym_type == "disc_10"
            mild_disc_asymmetry(level=T8, ratio=1.10, side=:right)
        # ── Format frontend (combined = wedge 2° + lig 10%) ──
        elseif asym_type == "combined"
            combined_asymmetry(wedge_level=T8, wedge_angle=2.0,
                               lig_level=T7, lig_ratio=1.10, side=:right)
        # ── Formats API générique (rétrocompatibilité) ──
        elseif asym_type == "wedging"
            mild_vertebral_wedging(level=asym_level, angle=asym_mag, side=asym_side)
        elseif asym_type == "ligament"
            mild_ligament_asymmetry(level=asym_level, ratio=asym_mag, side=asym_side)
        elseif asym_type == "disc"
            mild_disc_asymmetry(level=asym_level, ratio=asym_mag, side=asym_side)
        else
            symmetric_config()
        end
        
        # Paramètres de simulation
        params = default_longitudinal_params(
            duration_years=duration,
            initial_age=age,
            sex=sex,
            weight=weight,
            height=height,
            asymmetry=asym_config
        )
        
        # Exécuter
        t0 = time()
        result = run_longitudinal_simulation(params)
        elapsed = time() - t0

        # Persister en base de données
        if Database.db_available()
            result_json = JSON3.write(Dict(
                "final_cobb" => result.final_cobb,
                "developed_scoliosis" => result.developed_scoliosis,
                "buckling_detected" => result.buckling_detected,
                "warnings" => result.warnings,
            ))
            p_nt = (duration_years=duration, time_step_months=params.time_step_months,
                    initial_age=age, asymmetry_type=asym_type)
            r_nt = (final_cobb=result.final_cobb, developed_scoliosis=result.developed_scoliosis,
                    scoliosis_onset_years=result.scoliosis_onset_years,
                    buckling_detected=result.buckling_detected,
                    buckling_onset_years=result.buckling_onset_years,
                    max_damage=result.max_damage, max_asymmetry=result.max_asymmetry_developed,
                    warnings=result.warnings)
            @async Database.save_longitudinal_result(result_json, nothing, p_nt, r_nt)
        end
        return json_response(Dict(
            "message" => "Simulation longitudinale terminée",
            "computation_time_s" => round(elapsed, digits=1),
            "duration_years" => result.duration_years,
            "asymmetry" => result.config.description,
            "final_cobb_deg" => round(result.final_cobb, digits=1),
            "developed_scoliosis" => result.developed_scoliosis,
            "scoliosis_onset_years" => result.developed_scoliosis ? 
                round(result.scoliosis_onset_years, digits=1) : nothing,
            "buckling_detected" => result.buckling_detected,
            "buckling_onset_years" => result.buckling_detected ?
                round(result.buckling_onset_years, digits=1) : nothing,
            "max_damage" => round(result.max_damage, digits=4),
            "num_snapshots" => length(result.snapshots),
            "snapshots" => [
                Dict(
                    "time_years" => round(s.time_years, digits=1),
                    "cobb_angles" => Dict(k => round(v, digits=1) for (k,v) in s.cobb_angles),
                    "lateral_deviation_mm" => round(s.lateral_deviation, digits=2),
                    "buckling_ratio" => round(s.spring_buckling_ratio, digits=3),
                    "thoracic_kyphosis" => round(s.thoracic_kyphosis, digits=1),
                    "lumbar_lordosis" => round(s.lumbar_lordosis, digits=1),
                ) for s in result.snapshots
            ],
        ); status=200)
        
    catch e
        return error_response("Erreur simulation longitudinale: $(sprint(showerror, e))"; 
                              status=500)
    end
end

"""
POST /api/longitudinal/comparison
Corps JSON :
{
  "duration_years": 20,
  "initial_age": 10,
  "configs": {
    "control": {"type": "none"},
    "mild_wedge": {"type": "wedging", "level": "T8", "magnitude": 2.0, "side": "right"},
    "ligament": {"type": "ligament", "level": "T7", "magnitude": 1.15, "side": "right"}
  }
}
"""
function handle_longitudinal_comparison(req::HTTP.Request)
    try
        body = JSON3.read(String(req.body))
        
        duration = Float64(get(body, :duration_years, 20))
        age = Int(get(body, :initial_age, 10))
        
        # Utiliser les configurations par défaut si non spécifiées
        t0 = time()
        results = run_comparison_study(duration=duration, initial_age=age)
        elapsed = time() - t0
        
        # Résumé textuel
        summary = summarize_results(results)
        
        return json_response(Dict(
            "message" => "Étude comparative terminée",
            "computation_time_s" => round(elapsed, digits=1),
            "num_configurations" => length(results),
            "summary" => summary,
            "results" => Dict(
                name => Dict(
                    "asymmetry" => r.config.description,
                    "final_cobb_deg" => round(r.final_cobb, digits=1),
                    "developed_scoliosis" => r.developed_scoliosis,
                    "scoliosis_onset_years" => r.developed_scoliosis ? 
                        round(r.scoliosis_onset_years, digits=1) : nothing,
                    "buckling_detected" => r.buckling_detected,
                    "evolution" => [
                        Dict(
                            "time" => round(s.time_years, digits=1),
                            "cobb" => round(maximum(values(s.cobb_angles); init=0.0), digits=1),
                            "lateral_dev" => round(s.lateral_deviation, digits=2),
                            "buckling_ratio" => round(s.spring_buckling_ratio, digits=3),
                        ) for s in r.snapshots
                    ]
                ) for (name, r) in results
            ),
        ); status=200)
        
    catch e
        return error_response("Erreur étude comparative: $(sprint(showerror, e))"; 
                              status=500)
    end
end

"""
    parse_vertebral_level(s::String) → VertebralLevel

Parse un string comme "T8" en VertebralLevel.
"""
function parse_vertebral_level(s::String)::VertebralLevel
    level_map = Dict(
        "C1" => C1, "C2" => C2, "C3" => C3, "C4" => C4, "C5" => C5, "C6" => C6, "C7" => C7,
        "T1" => T1, "T2" => T2, "T3" => T3, "T4" => T4, "T5" => T5, "T6" => T6,
        "T7" => T7, "T8" => T8, "T9" => T9, "T10" => T10, "T11" => T11, "T12" => T12,
        "L1" => L1, "L2" => L2, "L3" => L3, "L4" => L4, "L5" => L5,
        "S1" => S1,
    )
    return get(level_map, uppercase(s), T8)
end

# ══════════════════════════════════════════════════════════════
# SPRINT 2 — Handlers Authentification JWT
# ══════════════════════════════════════════════════════════════

"""Middleware : vérifie le JWT et retourne les Claims, ou envoie 401."""
function require_auth(req::HTTP.Request)::Union{Users.JWT.Claims, HTTP.Response}
    token = Users.JWT.extract_bearer_token(req)
    result, claims = Users.JWT.verify_token(token)
    
    if result == Users.JWT.TOKEN_VALID
        return claims
    elseif result == Users.JWT.TOKEN_EXPIRED
        return error_response("Token expiré — veuillez vous reconnecter"; status=401)
    elseif result == Users.JWT.TOKEN_MISSING
        return error_response("Authentification requise"; status=401)
    else
        return error_response("Token invalide"; status=401)
    end
end

"""POST /api/auth/register"""
function handle_auth_register(req::HTTP.Request)
    t0 = time()
    try
        body = JSON3.read(String(req.body))
        email    = string(get(body, :email,    ""))
        username = string(get(body, :username, ""))
        password = string(get(body, :password, ""))
        fullname = string(get(body, :full_name, ""))
        role     = string(get(body, :role,     "student"))
        
        conn = Database.get_conn()
        if isnothing(conn)
            log_request("POST", "/api/auth/register", 503, (time()-t0)*1000)
            return error_response("Base de données indisponible"; status=503)
        end
        
        user, err = Users.register_user(conn, email, username, password;
                                         full_name=isempty(fullname) ? nothing : fullname,
                                         role=role)
        if !isnothing(err) && !isempty(err)
            log_request("POST", "/api/auth/register", 400, (time()-t0)*1000)
            return error_response(err; status=400)
        end
        
        resp = json_response(Dict(
            "message"  => "Compte créé avec succès",
            "user_id"  => string(user.id),
            "username" => user.username,
            "role"     => user.role,
        ); status=201)
        log_request("POST", "/api/auth/register", 201, (time()-t0)*1000)
        return resp
    catch e
        @error "handle_auth_register" exception=(e, catch_backtrace())
        log_request("POST", "/api/auth/register", 500, (time()-t0)*1000)
        return error_response("Erreur serveur"; status=500)
    end
end

"""POST /api/auth/login"""
function handle_auth_login(req::HTTP.Request)
    t0 = time()
    try
        body = JSON3.read(String(req.body))
        login    = string(get(body, :login,    get(body, :email, "")))
        password = string(get(body, :password, ""))
        
        ip = ""
        ua = ""
        for (n, v) in req.headers
            lowercase(n) == "x-forwarded-for" && (ip = v)
            lowercase(n) == "user-agent"       && (ua = v)
        end
        
        conn = Database.get_conn()
        if isnothing(conn)
            log_request("POST", "/api/auth/login", 503, (time()-t0)*1000)
            return error_response("Base de données indisponible"; status=503)
        end
        
        tokens, err = Users.login_user(conn, login, password; ip=ip, user_agent=ua)
        if !isnothing(err) && !isempty(err)
            log_request("POST", "/api/auth/login", 401, (time()-t0)*1000)
            return error_response(err; status=401)
        end
        
        resp = json_response(Dict(
            "access_token"  => tokens.access_token,
            "refresh_token" => tokens.refresh_token,
            "token_type"    => tokens.token_type,
            "expires_in"    => tokens.expires_in,
        ))
        log_request("POST", "/api/auth/login", 200, (time()-t0)*1000)
        return resp
    catch e
        @error "handle_auth_login" exception=(e, catch_backtrace())
        log_request("POST", "/api/auth/login", 500, (time()-t0)*1000)
        return error_response("Erreur serveur"; status=500)
    end
end

"""POST /api/auth/refresh"""
function handle_auth_refresh(req::HTTP.Request)
    t0 = time()
    try
        body = JSON3.read(String(req.body))
        refresh_token = string(get(body, :refresh_token, ""))
        isempty(refresh_token) && return error_response("refresh_token manquant"; status=400)
        
        conn = Database.get_conn()
        isnothing(conn) && return error_response("Base de données indisponible"; status=503)
        
        tokens, err = Users.refresh_access_token(conn, refresh_token)
        if !isnothing(err) && !isempty(err)
            log_request("POST", "/api/auth/refresh", 401, (time()-t0)*1000)
            return error_response(err; status=401)
        end
        
        resp = json_response(Dict(
            "access_token"  => tokens.access_token,
            "refresh_token" => tokens.refresh_token,
            "token_type"    => tokens.token_type,
            "expires_in"    => tokens.expires_in,
        ))
        log_request("POST", "/api/auth/refresh", 200, (time()-t0)*1000)
        return resp
    catch e
        @error "handle_auth_refresh" exception=(e, catch_backtrace())
        return error_response("Erreur serveur"; status=500)
    end
end

"""POST /api/auth/logout"""
function handle_auth_logout(req::HTTP.Request)
    try
        body = JSON3.read(String(req.body))
        refresh_token = string(get(body, :refresh_token, ""))
        
        conn = Database.get_conn()
        if !isnothing(conn) && !isempty(refresh_token)
            Users.logout_user(conn, refresh_token)
        end
        
        return json_response(Dict("message" => "Déconnexion réussie"))
    catch e
        return json_response(Dict("message" => "Déconnexion"))
    end
end

"""GET /api/auth/me — retourne le profil de l'utilisateur connecté"""
function handle_auth_me(req::HTTP.Request)
    auth = require_auth(req)
    auth isa HTTP.Response && return auth  # 401
    
    return json_response(Dict(
        "user_id"  => string(auth.user_id),
        "username" => auth.username,
        "role"     => auth.role,
    ))
end

# ══════════════════════════════════════════════════════════════
# SPRINT 3 — Handler Rapport PDF
# ══════════════════════════════════════════════════════════════

"""
GET /api/spine/{id}/report
GET /api/spine/{id}/report?patient_name=xxx

Retourne un rapport JSON structuré — le frontend le convertit en PDF.
"""
function handle_get_report(req::HTTP.Request)
    t0 = time()
    id_str = split(req.target, "/")[4]
    
    try
        id = UUID(id_str)
        model = get_model(id)
        
        if isnothing(model)
            log_request("GET", "/api/spine/$id_str/report", 404, (time()-t0)*1000)
            return error_response("Modèle $id non trouvé"; status=404)
        end
        
        # Parser les query params
        patient_name = "Patient anonyme"
        generated_by  = "VERTEX© Simulator"
        
        # Extraire ?patient_name=xxx de l'URL
        query_str = ""
        if contains(req.target, "?")
            query_str = split(req.target, "?")[2]
            for param in split(query_str, "&")
                kv = split(param, "=")
                length(kv) == 2 || continue
                HTTP.URIs.unescapeuri(kv[1]) == "patient_name" &&
                    (patient_name = HTTP.URIs.unescapeuri(kv[2]))
                HTTP.URIs.unescapeuri(kv[1]) == "generated_by" &&
                    (generated_by = HTTP.URIs.unescapeuri(kv[2]))
            end
        end
        
        report = Reports.generate_spine_report(model;
                    patient_name=patient_name,
                    generated_by=generated_by)
        
        resp = json_response(report)
        log_request("GET", "/api/spine/$id_str/report", 200, (time()-t0)*1000)
        return resp
        
    catch e
        @error "handle_get_report" exception=(e, catch_backtrace())
        log_request("GET", "/api/spine/$id_str/report", 500, (time()-t0)*1000)
        return error_response("Erreur génération rapport: $(sprint(showerror, e))"; status=500)
    end
end
