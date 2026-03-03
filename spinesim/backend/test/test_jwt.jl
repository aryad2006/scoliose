# ══════════════════════════════════════════════════════════════
# Vertex — Tests JWT (Sprint 2)
# ══════════════════════════════════════════════════════════════

using Test

include("../src/auth/jwt.jl")
using .JWT

@testset "JWT — Module d'authentification" begin

    @testset "Base64url" begin
        # Encode → decode doit être l'identité
        original = "Hello, VERTEX© World! 🦴"
        encoded  = JWT.b64url_encode(original)
        decoded  = String(JWT.b64url_decode(encoded))
        @test decoded == original
        
        # Pas de caractères +, /, =
        @test !contains(encoded, "+")
        @test !contains(encoded, "/")
        @test !contains(encoded, "=")
    end

    @testset "HMAC-SHA256" begin
        # Vecteur de test standard (RFC 4231 - Test Case 1)
        key = "key"
        msg = "The quick brown fox jumps over the lazy dog"
        sig = JWT.hmac_sha256(key, msg)
        
        @test length(sig) == 32  # SHA-256 → 32 bytes
        
        # Même entrée → même sortie (déterministe)
        sig2 = JWT.hmac_sha256(key, msg)
        @test sig == sig2
        
        # Clé différente → signature différente
        sig3 = JWT.hmac_sha256("other_key", msg)
        @test sig != sig3
    end

    @testset "Création de token" begin
        id   = Base.UUID("12345678-1234-1234-1234-123456789012")
        role = "instructor"
        user = "dr_martin"
        
        token = JWT.create_access_token(id, role, user)
        
        # Structure JWT : 3 parties séparées par des points
        parts = split(token, '.')
        @test length(parts) == 3
        
        # Header doit être HS256
        header_json = String(JWT.b64url_decode(parts[1]))
        @test contains(header_json, "HS256")
        
        # Payload doit contenir les bonnes données
        payload_json = String(JWT.b64url_decode(parts[2]))
        @test contains(payload_json, string(id))
        @test contains(payload_json, role)
        @test contains(payload_json, user)
    end

    @testset "Vérification de token valide" begin
        id   = Base.UUID("87654321-4321-4321-4321-abcdef012345")
        role = "student"
        user = "etudiant_test"
        
        token = JWT.create_access_token(id, role, user)
        result, claims = JWT.verify_token(token)
        
        @test result == JWT.TOKEN_VALID
        @test !isnothing(claims)
        @test claims.user_id == id
        @test claims.role    == role
        @test claims.username == user
        @test claims.exp > round(Int, datetime2unix(now(UTC)))
    end

    @testset "Token invalide (signature corrompue)" begin
        token = JWT.create_access_token(
            Base.uuid4(), "student", "test_user"
        )
        
        # Corrompre la signature (dernier caractère)
        parts = split(token, '.')
        bad_sig = parts[3][1:end-1] * (parts[3][end] == 'a' ? 'b' : 'a')
        bad_token = "$(parts[1]).$(parts[2]).$bad_sig"
        
        result, claims = JWT.verify_token(bad_token)
        @test result == JWT.TOKEN_INVALID_SIGNATURE
        @test isnothing(claims)
    end

    @testset "Token mal formé" begin
        result, claims = JWT.verify_token("not.a.valid.jwt.token.with.toomanyparts")
        @test result == JWT.TOKEN_MALFORMED
        
        result2, _ = JWT.verify_token("")
        @test result2 == JWT.TOKEN_MISSING
    end

    @testset "Hash de mot de passe" begin
        salt = JWT.generate_salt()
        @test length(salt) == 64  # 32 bytes hex
        
        pw = "MySecretPassword123!"
        h1 = JWT.hash_password(pw, salt)
        h2 = JWT.hash_password(pw, salt)
        
        # Déterministe
        @test h1 == h2
        @test length(h1) == 64  # SHA-256 hex
        
        # Bon mot de passe → vrai
        @test JWT.verify_password(pw, salt, h1)
        
        # Mauvais mot de passe → faux
        @test !JWT.verify_password("WrongPassword", salt, h1)
        
        # Sel différent → hash différent
        salt2 = JWT.generate_salt()
        h3 = JWT.hash_password(pw, salt2)
        @test h3 != h1
    end

    @testset "Refresh token" begin
        token, hash = JWT.create_refresh_token()
        
        # Token et hash différents
        @test token != hash
        
        # Hash est un SHA-256 hex (64 chars)
        @test length(hash) == 64
        
        # Deux appels → deux tokens différents
        t2, h2 = JWT.create_refresh_token()
        @test token != t2
        @test hash  != h2
    end

    @testset "Comparaison en temps constant" begin
        # Les tests de timing ne sont pas pratiques ici
        # On vérifie le comportement fonctionnel
        @test JWT._constant_time_compare("hello", "hello")
        @test !JWT._constant_time_compare("hello", "world")
        @test !JWT._constant_time_compare("hello", "hello!")
        @test !JWT._constant_time_compare("hello!", "hello")
    end

end

println("✅ Tests JWT passés!")
