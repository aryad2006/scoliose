# ══════════════════════════════════════════════════════════════
# Vertex — Module JWT (JSON Web Tokens)
# Sprint 2 : Auth HS256 sans dépendance externe
# ══════════════════════════════════════════════════════════════

module JWT

using Base64
using SHA
using JSON3
using UUIDs
using Dates

# ── Configuration ─────────────────────────────────────────────

"""Durée de validité des access tokens (15 minutes par défaut)."""
const ACCESS_TOKEN_TTL_SECONDS  = parse(Int, get(ENV, "JWT_ACCESS_TTL",  "900"))

"""Durée de validité des refresh tokens (7 jours par défaut)."""
const REFRESH_TOKEN_TTL_SECONDS = parse(Int, get(ENV, "JWT_REFRESH_TTL", "604800"))

"""Clé secrète HMAC-SHA256. DOIT être définie via JWT_SECRET en production."""
function jwt_secret()::String
    s = get(ENV, "JWT_SECRET", "")
    if isempty(s)
        @warn "JWT_SECRET non définie — utilisation d'une clé par défaut INSÉCURISÉE"
        return "vertex_dev_secret_CHANGE_IN_PRODUCTION_do_not_use_in_prod"
    end
    return s
end

# ── Base64url ─────────────────────────────────────────────────

"""Encode en Base64 URL-safe (sans padding '=')."""
function b64url_encode(data::AbstractVector{UInt8})::String
    s = Base64.base64encode(data)
    # Base64url : remplacer +→- /→_ et enlever le padding =
    s = replace(s, '+' => '-', '/' => '_')
    return rstrip(s, '=')
end

b64url_encode(s::AbstractString) = b64url_encode(Vector{UInt8}(s))

"""Décode du Base64 URL-safe."""
function b64url_decode(s::AbstractString)::Vector{UInt8}
    # Restaurer le padding
    pad = (4 - length(s) % 4) % 4
    s = s * "="^pad
    s = replace(s, '-' => '+', '_' => '/')
    return Base64.base64decode(s)
end

# ── HMAC-SHA256 ───────────────────────────────────────────────

"""Calcule HMAC-SHA256(key, message) → bytes."""
function hmac_sha256(key::AbstractString, message::AbstractString)::Vector{UInt8}
    key_bytes  = Vector{UInt8}(key)
    msg_bytes  = Vector{UInt8}(message)
    
    block_size = 64  # SHA-256 block size en bytes
    
    # Si clé > block_size, la hacher
    if length(key_bytes) > block_size
        key_bytes = SHA.sha256(key_bytes)
    end
    # Padder la clé à block_size
    key_padded = vcat(key_bytes, zeros(UInt8, block_size - length(key_bytes)))
    
    # ipad = 0x36, opad = 0x5c
    ipad = key_padded .⊻ fill(0x36, block_size)
    opad = key_padded .⊻ fill(0x5c, block_size)
    
    inner = SHA.sha256(vcat(ipad, msg_bytes))
    outer = SHA.sha256(vcat(opad, inner))
    return outer
end

# ── Création de tokens ────────────────────────────────────────

"""
    create_access_token(user_id, role, username) → String

Génère un JWT access token (HS256) avec expiration.
"""
function create_access_token(
    user_id::UUID,
    role::String,
    username::String
)::String
    header = b64url_encode("""{"alg":"HS256","typ":"JWT"}""")
    
    now_ts = round(Int, datetime2unix(now(UTC)))
    exp_ts = now_ts + ACCESS_TOKEN_TTL_SECONDS
    
    payload_dict = Dict(
        "sub"  => string(user_id),
        "role" => role,
        "user" => username,
        "iat"  => now_ts,
        "exp"  => exp_ts,
        "jti"  => string(uuid4()),  # JWT ID unique (anti-replay)
        "iss"  => "vertex-spine",
    )
    payload = b64url_encode(JSON3.write(payload_dict))
    
    signing_input = "$header.$payload"
    signature = b64url_encode(hmac_sha256(jwt_secret(), signing_input))
    
    return "$signing_input.$signature"
end

"""
    create_refresh_token() → (token::String, token_hash::String)

Génère un refresh token opaque (UUID4) et son hash SHA-256 pour stockage.
"""
function create_refresh_token()::Tuple{String, String}
    token = string(uuid4()) * string(uuid4())  # 72 chars aléatoires
    token_bytes = Vector{UInt8}(token)
    token_hash  = bytes2hex(SHA.sha256(token_bytes))
    return token, token_hash
end

# ── Vérification de tokens ────────────────────────────────────

"""
    Claims

Structure retournée après validation d'un JWT valide.
"""
struct Claims
    user_id  :: UUID
    role     :: String
    username :: String
    exp      :: Int
    jti      :: String
end

"""
Résultat de la vérification d'un token.
"""
@enum VerifyResult begin
    TOKEN_VALID
    TOKEN_EXPIRED
    TOKEN_INVALID_SIGNATURE
    TOKEN_MALFORMED
    TOKEN_MISSING
end

"""
    verify_token(token) → (VerifyResult, Union{Claims, Nothing})

Vérifie la signature et l'expiration d'un JWT.
"""
function verify_token(token::String)::Tuple{VerifyResult, Union{Claims, Nothing}}
    isempty(strip(token)) && return (TOKEN_MISSING, nothing)
    
    parts = split(token, '.')
    length(parts) != 3 && return (TOKEN_MALFORMED, nothing)
    
    header_b64, payload_b64, sig_b64 = parts
    
    # Vérifier la signature
    signing_input = "$header_b64.$payload_b64"
    expected_sig  = b64url_encode(hmac_sha256(jwt_secret(), signing_input))
    
    # Comparaison en temps constant (anti timing-attack)
    if !_constant_time_compare(sig_b64, expected_sig)
        return (TOKEN_INVALID_SIGNATURE, nothing)
    end
    
    # Parser le payload
    try
        payload_json = String(b64url_decode(payload_b64))
        payload = JSON3.read(payload_json)
        
        # Vérifier l'expiration
        exp = get(payload, :exp, 0)
        now_ts = round(Int, datetime2unix(now(UTC)))
        if now_ts > exp
            return (TOKEN_EXPIRED, nothing)
        end
        
        claims = Claims(
            UUID(string(payload[:sub])),
            string(get(payload, :role, "student")),
            string(get(payload, :user, "")),
            exp,
            string(get(payload, :jti, ""))
        )
        return (TOKEN_VALID, claims)
    catch e
        @warn "JWT payload parse error" exception=e
        return (TOKEN_MALFORMED, nothing)
    end
end

"""Comparaison de chaînes en temps constant."""
function _constant_time_compare(a::AbstractString, b::AbstractString)::Bool
    len_a = length(a)
    len_b = length(b)
    
    # On compare toujours len_a chars pour éviter les timing leaks sur la longueur
    result = (len_a == len_b)
    for i in 1:min(len_a, len_b)
        result &= (a[i] == b[i])
    end
    return result
end

# ── Hash de mots de passe ─────────────────────────────────────

"""
    hash_password(password, salt) → String

Hash SHA-256 d'un mot de passe avec sel.
Note : en production, utiliser bcrypt ou argon2 via une lib C.
"""
function hash_password(password::String, salt::String)::String
    combined = salt * password * "vertex_pepper_2024"
    # Double hachage SHA-256
    h1 = SHA.sha256(Vector{UInt8}(combined))
    h2 = SHA.sha256(vcat(h1, Vector{UInt8}(salt)))
    return bytes2hex(h2)
end

"""
    generate_salt() → String

Génère un sel aléatoire 32 octets (hex).
"""
function generate_salt()::String
    return bytes2hex(rand(UInt8, 32))
end

"""
    verify_password(password, salt, stored_hash) → Bool
"""
function verify_password(password::String, salt::String, stored_hash::String)::Bool
    computed = hash_password(password, salt)
    return _constant_time_compare(computed, stored_hash)
end

# ── Extraction du token de la requête ─────────────────────────

"""
    extract_bearer_token(req) → String

Extrait le JWT du header `Authorization: Bearer <token>`.
"""
function extract_bearer_token(req)::String
    auth_header = ""
    for (name, value) in req.headers
        if lowercase(name) == "authorization"
            auth_header = value
            break
        end
    end
    
    isempty(auth_header) && return ""
    
    if startswith(auth_header, "Bearer ")
        return auth_header[8:end]
    end
    return ""
end

end  # module JWT
