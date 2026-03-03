# ══════════════════════════════════════════════════════════════
# Vertex — Tests API (Intégration HTTP)
# Sprint 4 : tests des endpoints REST
# ══════════════════════════════════════════════════════════════

using Test
using HTTP
using JSON3
using UUIDs

# ── Configuration ─────────────────────────────────────────────
const BASE_URL = get(ENV, "VERTEX_TEST_URL", "http://localhost:8080")
const TEST_TIMEOUT = 30  # secondes

"""Wrapper HTTP GET qui retourne (status, JSON)."""
function api_get(path::String; token::String="")
    headers = ["Content-Type" => "application/json"]
    !isempty(token) && push!(headers, "Authorization" => "Bearer $token")
    
    resp = HTTP.get("$BASE_URL$path", headers;
                    status_exception=false, readtimeout=TEST_TIMEOUT)
    status = resp.status
    body   = isempty(resp.body) ? Dict() : JSON3.read(String(resp.body))
    return status, body
end

"""Wrapper HTTP POST qui retourne (status, JSON)."""
function api_post(path::String, data::Dict; token::String="")
    headers = ["Content-Type" => "application/json"]
    !isempty(token) && push!(headers, "Authorization" => "Bearer $token")
    
    resp = HTTP.post("$BASE_URL$path", headers, JSON3.write(data);
                     status_exception=false, readtimeout=TEST_TIMEOUT)
    status = resp.status
    body   = isempty(resp.body) ? Dict() : JSON3.read(String(resp.body))
    return status, body
end

# ── Vérifier que le serveur est démarré ──────────────────────
function server_available()::Bool
    try
        HTTP.get("$BASE_URL/api/health"; readtimeout=5, status_exception=false)
        return true
    catch
        return false
    end
end

@testset "VERTEX© — Tests API REST" begin

    if !server_available()
        @warn "Serveur non démarré — tests d'intégration ignorés."
        @test skip=true false
    else
        # ── Santé ─────────────────────────────────────────────
        @testset "GET /api/health" begin
            status, body = api_get("/api/health")
            @test status == 200
            @test body[:status] == "ok"
            @test haskey(body, :version)
            @test haskey(body, :active_models)
            @test haskey(body, :timestamp)
        end

        @testset "GET /api/info" begin
            status, body = api_get("/api/info")
            @test status == 200
            @test haskey(body, :vertebral_levels)
        end

        # ── Création de rachis ────────────────────────────────
        spine_id = Ref{String}("")

        @testset "POST /api/spine/create" begin
            status, body = api_post("/api/spine/create", Dict(
                "weight" => 70.0,
                "height" => 170.0,
                "age"    => 30,
                "sex"    => "M",
            ))
            @test status == 201
            @test haskey(body, :id)
            @test body[:num_vertebrae] == 23
            @test body[:num_discs] == 22
            @test body[:num_ligaments] > 0
            spine_id[] = string(body[:id])
        end

        @testset "GET /api/spine/{id}" begin
            status, body = api_get("/api/spine/$(spine_id[])")
            @test status == 200
            @test haskey(body, :vertebrae)

            # ID inexistant → 404
            fake_id = string(UUIDs.uuid4())
            status2, _ = api_get("/api/spine/$fake_id")
            @test status2 == 404
        end

        # ── Solveur FEM ───────────────────────────────────────
        @testset "POST /api/spine/{id}/solve" begin
            status, body = api_post("/api/spine/$(spine_id[])/solve", Dict())
            @test status == 200
            @test haskey(body, :max_displacement_mm)
        end

        # ── Pathologies ───────────────────────────────────────
        @testset "POST /api/spine/{id}/scoliosis" begin
            status, body = api_post("/api/spine/$(spine_id[])/scoliosis", Dict(
                "lenke_type"    => 1,
                "main_cobb"     => 35.0,
                "main_apex"     => "T8",
            ))
            @test status in [200, 201]
        end

        @testset "POST /api/spine/{id}/fracture" begin
            status, body = api_post("/api/spine/$(spine_id[])/fracture", Dict(
                "level"       => "T12",
                "fracture_type" => "compression",
                "severity"    => 0.3,
            ))
            @test status in [200, 201]
        end

        # ── Chirurgie ─────────────────────────────────────────
        @testset "POST /api/surgery/{id}/screw" begin
            status, body = api_post("/api/surgery/$(spine_id[])/screw", Dict(
                "level" => "L4",
                "side"  => "left",
                "diameter_mm" => 6.5,
                "length_mm"   => 45.0,
            ))
            @test status in [200, 201]
        end

        # ── Simulation longitudinale ──────────────────────────
        @testset "POST /api/longitudinal/run (court)" begin
            status, body = api_post("/api/longitudinal/run", Dict(
                "duration_years"   => 2.0,
                "initial_age"      => 10,
                "sex"              => "F",
                "weight"           => 35.0,
                "height"           => 140.0,
                "asymmetry_type"   => "none",
            ))
            @test status == 200
            @test haskey(body, :final_cobb_deg)
            @test haskey(body, :developed_scoliosis)
            @test haskey(body, :num_snapshots)
        end

        # ── Rapport ───────────────────────────────────────────
        @testset "GET /api/spine/{id}/report" begin
            status, body = api_get("/api/spine/$(spine_id[])/report?patient_name=Test+Patient")
            @test status == 200
            @test haskey(body, :metadata)
            @test haskey(body, :patient)
            @test haskey(body, :clinical_measurements)
            @test haskey(body, :pathologies)
            @test haskey(body, :recommendations)
            
            cm = body[:clinical_measurements]
            @test haskey(cm, :cobb_angle_deg)
            @test haskey(cm, :scoliosis_severity)
        end

        # ── Auth ──────────────────────────────────────────────
        @testset "POST /api/auth/register + login" begin
            # Enregistrement
            status, body = api_post("/api/auth/register", Dict(
                "email"    => "test_$(round(Int, time()))@vertex.test",
                "username" => "testuser_$(round(Int, time()))",
                "password" => "TestPassword123!",
            ))
            # 201 si DB disponible, 503 sinon
            @test status in [201, 503, 503]
            
            if status == 201
                # Login
                username = string(body[:username])
                st2, body2 = api_post("/api/auth/login", Dict(
                    "login"    => username,
                    "password" => "TestPassword123!",
                ))
                @test st2 == 200
                @test haskey(body2, :access_token)
                @test haskey(body2, :refresh_token)
                @test body2[:token_type] == "Bearer"
                
                # /me avec le token
                token = string(body2[:access_token])
                st3, me = api_get("/api/auth/me"; token=token)
                @test st3 == 200
                @test me[:username] == username
            end
        end

        # ── Thread safety ─────────────────────────────────────
        @testset "Création concurrente de modèles" begin
            # Créer 5 modèles en parallèle
            results = Vector{Any}(undef, 5)
            tasks = map(1:5) do i
                @async begin
                    st, b = api_post("/api/spine/create", Dict(
                        "weight" => 60.0 + i * 2,
                        "height" => 165.0,
                        "age"    => 25 + i,
                        "sex"    => "F",
                    ))
                    results[i] = (st, b)
                end
            end
            
            # Attendre tous les tasks
            for t in tasks; wait(t); end
            
            # Tous doivent avoir réussi
            @test all(r -> r[1] == 201, results)
            
            # Tous les IDs doivent être uniques
            ids = [string(r[2][:id]) for r in results]
            @test length(unique(ids)) == 5
        end

        # ── CORS ──────────────────────────────────────────────
        @testset "OPTIONS (preflight CORS)" begin
            resp = HTTP.request("OPTIONS", "$BASE_URL/api/spine/create",
                               ["Origin" => "http://localhost:3001",
                                "Access-Control-Request-Method" => "POST"];
                               status_exception=false)
            @test resp.status in [200, 204]
            
            headers = Dict(resp.headers)
            @test haskey(headers, "Access-Control-Allow-Origin")
        end

    end  # if server_available

end  # @testset

println("✅ Tests API terminés!")
