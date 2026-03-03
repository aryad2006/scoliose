# ══════════════════════════════════════════════════════════════
# Vertex — Module de base de données PostgreSQL
# Sprint 1 : Persistence via LibPQ.jl
# ══════════════════════════════════════════════════════════════

module Database

using LibPQ
using JSON3
using UUIDs
using Dates
using Logging

# ── Configuration ─────────────────────────────────────────────

"""
Lit les paramètres de connexion depuis les variables d'environnement.
Variables attendues :
  VERTEX_DB_HOST     (défaut: localhost)
  VERTEX_DB_PORT     (défaut: 5432)
  VERTEX_DB_NAME     (défaut: vertex)
  VERTEX_DB_USER     (défaut: vertex)
  VERTEX_DB_PASSWORD (défaut: vertex_secret)
"""
function db_connection_string()::String
    host = get(ENV, "VERTEX_DB_HOST", "localhost")
    port = get(ENV, "VERTEX_DB_PORT", "5432")
    dbname = get(ENV, "VERTEX_DB_NAME", "vertex")
    user = get(ENV, "VERTEX_DB_USER", "vertex")
    password = get(ENV, "VERTEX_DB_PASSWORD", "vertex_secret")
    return "host=$host port=$port dbname=$dbname user=$user password=$password"
end

# Pool de connexions (connexion unique pour l'instant — évolutif)
const DB_CONN = Ref{Union{LibPQ.Connection, Nothing}}(nothing)
const DB_LOCK = ReentrantLock()

# ── Initialisation ────────────────────────────────────────────

"""
    init_db() → Bool

Ouvre la connexion PostgreSQL et applique le schéma SQL initial.
Retourne `true` si la connexion est établie, `false` sinon.
"""
function init_db()::Bool
    conn_str = db_connection_string()
    
    lock(DB_LOCK) do
        try
            conn = LibPQ.Connection(conn_str)
            
            # Appliquer le schéma initial
            sql_path = joinpath(@__DIR__, "..", "..", "sql", "init.sql")
            if isfile(sql_path)
                sql = read(sql_path, String)
                LibPQ.execute(conn, sql)
                @info "Schéma DB appliqué depuis $sql_path"
            else
                @warn "Fichier init.sql introuvable : $sql_path"
            end
            
            DB_CONN[] = conn
            @info "Connexion PostgreSQL établie" host=get(ENV, "VERTEX_DB_HOST", "localhost")
            return true
        catch e
            @error "Échec connexion PostgreSQL — mode dégradé (mémoire seule)" exception=(e, catch_backtrace())
            DB_CONN[] = nothing
            return false
        end
    end
end

"""
Retourne la connexion active, ou `nothing` si non disponible.
"""
function get_conn()::Union{LibPQ.Connection, Nothing}
    lock(DB_LOCK) do
        DB_CONN[]
    end
end

"""
Vérifie si la base de données est disponible.
"""
function db_available()::Bool
    conn = get_conn()
    return !isnothing(conn) && isopen(conn)
end

# ── spine_models ──────────────────────────────────────────────

"""
    save_spine_model(id, model_json, params) → Bool

Persiste un modèle de rachis en base de données.
`params` : NamedTuple ou Dict avec weight, height, age, sex, tscore.
"""
function save_spine_model(
    id::UUID,
    model_json::String,
    params::NamedTuple
)::Bool
    conn = get_conn()
    isnothing(conn) && return false
    
    try
        LibPQ.execute(conn, """
            INSERT INTO spine_models
                (id, weight_kg, height_cm, age, sex, tscore, model_json)
            VALUES (\$1, \$2, \$3, \$4, \$5, \$6, \$7::jsonb)
            ON CONFLICT (id) DO UPDATE
                SET model_json = EXCLUDED.model_json,
                    updated_at = NOW()
        """, [
            string(id),
            params.weight,
            params.height,
            params.age,
            string(params.sex),
            params.tscore,
            model_json
        ])
        return true
    catch e
        @error "save_spine_model failed" id=id exception=(e, catch_backtrace())
        return false
    end
end

"""
    load_spine_model(id) → Union{String, Nothing}

Charge le JSON sérialisé d'un modèle depuis la base de données.
"""
function load_spine_model(id::UUID)::Union{String, Nothing}
    conn = get_conn()
    isnothing(conn) && return nothing
    
    try
        result = LibPQ.execute(conn,
            "SELECT model_json FROM spine_models WHERE id = \$1",
            [string(id)]
        )
        rows = LibPQ.Tables.columntable(result)
        isempty(rows.model_json) && return nothing
        return string(rows.model_json[1])
    catch e
        @error "load_spine_model failed" id=id exception=(e, catch_backtrace())
        return nothing
    end
end

"""
    list_spine_models(; limit=20, offset=0) → Vector{Dict}

Liste les modèles récents (sans leur JSON complet).
"""
function list_spine_models(; limit::Int=20, offset::Int=0)::Vector{Dict}
    conn = get_conn()
    isnothing(conn) && return Dict[]
    
    try
        result = LibPQ.execute(conn, """
            SELECT id, created_at, weight_kg, height_cm, age, sex, tscore, label
            FROM spine_models
            ORDER BY created_at DESC
            LIMIT \$1 OFFSET \$2
        """, [limit, offset])
        
        rows = LibPQ.Tables.rowtable(result)
        return [Dict(
            "id"          => string(r.id),
            "created_at"  => string(r.created_at),
            "weight_kg"   => r.weight_kg,
            "height_cm"   => r.height_cm,
            "age"         => r.age,
            "sex"         => r.sex,
            "tscore"      => r.tscore,
            "label"       => r.label
        ) for r in rows]
    catch e
        @error "list_spine_models failed" exception=(e, catch_backtrace())
        return Dict[]
    end
end

# ── longitudinal_results ──────────────────────────────────────

"""
    save_longitudinal_result(result, spine_model_id, params) → UUID

Persiste un résultat de simulation longitudinale.
Retourne l'UUID de l'enregistrement créé.
"""
function save_longitudinal_result(
    result_json::String,
    spine_model_id::Union{UUID, Nothing},
    params::NamedTuple,
    result_summary::NamedTuple
)::Union{UUID, Nothing}
    conn = get_conn()
    isnothing(conn) && return nothing
    
    new_id = UUIDs.uuid4()
    try
        LibPQ.execute(conn, """
            INSERT INTO longitudinal_results (
                id, spine_model_id, duration_years, time_step_months,
                initial_age, asymmetry_type,
                final_cobb_angle, developed_scoliosis, scoliosis_onset_years,
                buckling_detected, buckling_onset_years,
                max_damage, max_asymmetry, warnings, result_json
            ) VALUES (
                \$1, \$2, \$3, \$4, \$5, \$6,
                \$7, \$8, \$9, \$10, \$11,
                \$12, \$13, \$14, \$15::jsonb
            )
        """, [
            string(new_id),
            isnothing(spine_model_id) ? missing : string(spine_model_id),
            params.duration_years,
            params.time_step_months,
            params.initial_age,
            get(params, :asymmetry_type, "unknown"),
            result_summary.final_cobb,
            result_summary.developed_scoliosis,
            isfinite(result_summary.scoliosis_onset_years) ? result_summary.scoliosis_onset_years : missing,
            result_summary.buckling_detected,
            isfinite(result_summary.buckling_onset_years) ? result_summary.buckling_onset_years : missing,
            result_summary.max_damage,
            result_summary.max_asymmetry,
            result_summary.warnings,
            result_json
        ])
        return new_id
    catch e
        @error "save_longitudinal_result failed" exception=(e, catch_backtrace())
        return nothing
    end
end

# ── surgery_sessions ──────────────────────────────────────────

"""
    create_surgery_session(spine_model_id) → UUID

Crée une session chirurgicale vide.
"""
function create_surgery_session(spine_model_id::UUID)::Union{UUID, Nothing}
    conn = get_conn()
    isnothing(conn) && return nothing
    
    new_id = UUIDs.uuid4()
    try
        LibPQ.execute(conn, """
            INSERT INTO surgery_sessions (id, spine_model_id)
            VALUES (\$1, \$2)
        """, [string(new_id), string(spine_model_id)])
        return new_id
    catch e
        @error "create_surgery_session failed" exception=(e, catch_backtrace())
        return nothing
    end
end

"""
    update_surgery_session(session_id, session_json; status) → Bool

Met à jour le JSON d'une session chirurgicale.
"""
function update_surgery_session(
    session_id::UUID,
    session_json::String;
    status::String="in_progress"
)::Bool
    conn = get_conn()
    isnothing(conn) && return false
    
    try
        LibPQ.execute(conn, """
            UPDATE surgery_sessions
            SET session_json = \$2::jsonb, status = \$3
            WHERE id = \$1
        """, [string(session_id), session_json, status])
        return true
    catch e
        @error "update_surgery_session failed" session_id=session_id exception=(e, catch_backtrace())
        return false
    end
end

# ── Statistiques ──────────────────────────────────────────────

"""
    get_stats() → Dict

Retourne les statistiques globales depuis la vue `v_simulation_stats`.
"""
function get_stats()::Dict
    conn = get_conn()
    isnothing(conn) && return Dict("error" => "database unavailable")
    
    try
        result = LibPQ.execute(conn, "SELECT * FROM v_simulation_stats")
        rows = LibPQ.Tables.rowtable(result)
        isempty(rows) && return Dict()
        r = rows[1]
        return Dict(
            "total_models"           => r.total_models,
            "total_simulations"      => r.total_simulations,
            "scoliosis_cases"        => r.scoliosis_cases,
            "avg_cobb_angle"         => r.avg_cobb_angle,
            "avg_sim_duration_years" => r.avg_sim_duration_years,
            "total_surgery_sessions" => r.total_surgery_sessions,
        )
    catch e
        @error "get_stats failed" exception=(e, catch_backtrace())
        return Dict("error" => sprint(showerror, e))
    end
end

end  # module Database
