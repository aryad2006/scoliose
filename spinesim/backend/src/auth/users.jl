# ══════════════════════════════════════════════════════════════
# Vertex — Module Utilisateurs et Authentification
# Sprint 2 : Login / Register / Token refresh
# ══════════════════════════════════════════════════════════════

module Users

using LibPQ
using JSON3
using UUIDs
using Dates
using Logging

include("jwt.jl")

# ── Dépendance DB ─────────────────────────────────────────────
# Les fonctions de ce module reçoivent la connexion en paramètre
# pour éviter une dépendance circulaire avec Database.jl

# ── Structures ────────────────────────────────────────────────

struct UserRecord
    id          :: UUID
    email       :: String
    username    :: String
    full_name   :: Union{String, Nothing}
    role        :: String
    is_active   :: Bool
    is_verified :: Bool
end

struct AuthTokens
    access_token  :: String
    refresh_token :: String
    expires_in    :: Int       # secondes
    token_type    :: String    # "Bearer"
end

# ── Enregistrement ────────────────────────────────────────────

"""
    register_user(conn, email, username, password; full_name, role) 
        → (UserRecord, String)  # (user, error_msg)
"""
function register_user(
    conn,
    email::String,
    username::String,
    password::String;
    full_name::Union{String,Nothing} = nothing,
    role::String = "student"
)::Tuple{Union{UserRecord, Nothing}, String}
    
    # Validation basique
    length(email) < 5    && return (nothing, "Email invalide")
    length(password) < 8  && return (nothing, "Mot de passe trop court (min 8 caractères)")
    length(username) < 3  && return (nothing, "Nom d'utilisateur trop court (min 3 caractères)")
    
    # Vérifier si email/username déjà utilisés
    try
        r = LibPQ.execute(conn,
            "SELECT id FROM users WHERE email = \$1 OR username = \$2",
            [email, username])
        rows = LibPQ.Tables.rowtable(r)
        !isempty(rows) && return (nothing, "Email ou nom d'utilisateur déjà utilisé")
    catch e
        @error "register_user check failed" exception=e
        return (nothing, "Erreur base de données")
    end
    
    # Hash du mot de passe
    salt = JWT.generate_salt()
    pw_hash = JWT.hash_password(password, salt)
    new_id = uuid4()
    
    try
        LibPQ.execute(conn, """
            INSERT INTO users (id, email, username, full_name, password_hash, password_salt, role)
            VALUES (\$1, \$2, \$3, \$4, \$5, \$6, \$7::user_role)
        """, [
            string(new_id), email, username,
            isnothing(full_name) ? missing : full_name,
            pw_hash, salt, role
        ])
        
        user = UserRecord(new_id, email, username, full_name, role, true, false)
        @info "Nouvel utilisateur enregistré" username=username role=role
        return (user, "")
    catch e
        @error "register_user insert failed" exception=(e, catch_backtrace())
        return (nothing, "Erreur lors de la création du compte")
    end
end

# ── Authentification ──────────────────────────────────────────

"""
    login_user(conn, login, password; ip, user_agent)
        → (AuthTokens, String)  # (tokens, error_msg)

`login` peut être l'email ou le nom d'utilisateur.
"""
function login_user(
    conn,
    login::String,
    password::String;
    ip::String = "",
    user_agent::String = ""
)::Tuple{Union{AuthTokens, Nothing}, String}
    
    # Chercher l'utilisateur
    local user_row
    try
        r = LibPQ.execute(conn, """
            SELECT id, email, username, full_name, password_hash, password_salt,
                   role, is_active, failed_attempts, locked_until
            FROM users
            WHERE (email = \$1 OR username = \$1)
        """, [login])
        rows = LibPQ.Tables.rowtable(r)
        isempty(rows) && return (nothing, "Email ou mot de passe incorrect")
        user_row = rows[1]
    catch e
        @error "login_user query failed" exception=e
        return (nothing, "Erreur base de données")
    end
    
    # Compte actif ?
    !user_row.is_active && return (nothing, "Compte désactivé")
    
    # Compte verrouillé ?
    if !ismissing(user_row.locked_until) && !isnothing(user_row.locked_until)
        if now(UTC) < user_row.locked_until
            return (nothing, "Compte temporairement verrouillé — réessayez plus tard")
        end
    end
    
    # Vérifier le mot de passe
    if !JWT.verify_password(password, user_row.password_salt, user_row.password_hash)
        # Incrémenter les tentatives échouées
        try
            LibPQ.execute(conn, """
                UPDATE users SET failed_attempts = failed_attempts + 1,
                    locked_until = CASE WHEN failed_attempts >= 4 
                                        THEN NOW() + INTERVAL '15 minutes' 
                                        ELSE locked_until END
                WHERE id = \$1
            """, [string(user_row.id)])
        catch; end
        _log_audit(conn, user_row.id, "login_failed", ip, user_agent, false)
        return (nothing, "Email ou mot de passe incorrect")
    end
    
    # Réinitialiser les tentatives
    try
        LibPQ.execute(conn, """
            UPDATE users SET failed_attempts = 0, locked_until = NULL, last_login_at = NOW()
            WHERE id = \$1
        """, [string(user_row.id)])
    catch; end
    
    user_id = UUID(string(user_row.id))
    
    # Générer les tokens
    access_token  = JWT.create_access_token(user_id, user_row.role, user_row.username)
    refresh_token, refresh_hash = JWT.create_refresh_token()
    
    # Stocker le refresh token en base
    try
        expires_at = now(UTC) + Second(JWT.REFRESH_TOKEN_TTL_SECONDS)
        LibPQ.execute(conn, """
            INSERT INTO refresh_tokens (user_id, token_hash, expires_at, user_agent, ip_address)
            VALUES (\$1, \$2, \$3, \$4, \$5::inet)
        """, [
            string(user_id), refresh_hash, string(expires_at),
            isempty(user_agent) ? missing : user_agent,
            isempty(ip) ? missing : ip
        ])
    catch e
        @warn "Impossible de stocker le refresh token" exception=e
    end
    
    _log_audit(conn, user_id, "login", ip, user_agent, true)
    
    tokens = AuthTokens(
        access_token, refresh_token,
        JWT.ACCESS_TOKEN_TTL_SECONDS, "Bearer"
    )
    return (tokens, "")
end

# ── Refresh token ─────────────────────────────────────────────

"""
    refresh_access_token(conn, refresh_token) → (AuthTokens, String)
"""
function refresh_access_token(
    conn,
    refresh_token::String
)::Tuple{Union{AuthTokens, Nothing}, String}
    
    token_hash = bytes2hex(SHA.sha256(Vector{UInt8}(refresh_token)))
    
    try
        r = LibPQ.execute(conn, """
            SELECT rt.id, rt.user_id, rt.expires_at, rt.revoked_at,
                   u.role, u.username, u.is_active
            FROM refresh_tokens rt
            JOIN users u ON u.id = rt.user_id
            WHERE rt.token_hash = \$1
        """, [token_hash])
        
        rows = LibPQ.Tables.rowtable(r)
        isempty(rows) && return (nothing, "Refresh token invalide")
        rt = rows[1]
        
        !ismissing(rt.revoked_at) && !isnothing(rt.revoked_at) &&
            return (nothing, "Refresh token révoqué")
        
        now(UTC) > rt.expires_at && return (nothing, "Refresh token expiré")
        !rt.is_active && return (nothing, "Compte désactivé")
        
        # Rotation : révoquer l'ancien, créer un nouveau
        LibPQ.execute(conn,
            "UPDATE refresh_tokens SET revoked_at = NOW() WHERE id = \$1",
            [string(rt.id)])
        
        user_id = UUID(string(rt.user_id))
        new_access  = JWT.create_access_token(user_id, rt.role, rt.username)
        new_refresh, new_hash = JWT.create_refresh_token()
        
        new_expires = now(UTC) + Second(JWT.REFRESH_TOKEN_TTL_SECONDS)
        LibPQ.execute(conn, """
            INSERT INTO refresh_tokens (user_id, token_hash, expires_at)
            VALUES (\$1, \$2, \$3)
        """, [string(user_id), new_hash, string(new_expires)])
        
        tokens = AuthTokens(new_access, new_refresh, JWT.ACCESS_TOKEN_TTL_SECONDS, "Bearer")
        return (tokens, "")
    catch e
        @error "refresh_access_token failed" exception=(e, catch_backtrace())
        return (nothing, "Erreur serveur")
    end
end

# ── Révocation ────────────────────────────────────────────────

"""
    logout_user(conn, refresh_token) → Bool
"""
function logout_user(conn, refresh_token::String)::Bool
    token_hash = bytes2hex(SHA.sha256(Vector{UInt8}(refresh_token)))
    try
        LibPQ.execute(conn,
            "UPDATE refresh_tokens SET revoked_at = NOW() WHERE token_hash = \$1",
            [token_hash])
        return true
    catch e
        @error "logout_user failed" exception=e
        return false
    end
end

# ── Audit log ─────────────────────────────────────────────────

function _log_audit(conn, user_id::UUID, event::String, ip::String, ua::String, success::Bool)
    try
        LibPQ.execute(conn, """
            INSERT INTO audit_logs (user_id, event_type, ip_address, user_agent, success)
            VALUES (\$1, \$2, \$3::inet, \$4, \$5)
        """, [
            string(user_id), event,
            isempty(ip) ? missing : ip,
            isempty(ua) ? missing : ua,
            success
        ])
    catch; end  # Ne jamais bloquer le flow principal pour un log
end

end  # module Users
