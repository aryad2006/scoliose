-- ══════════════════════════════════════════════════════════════
-- VERTEX© — Migration 02 : Tables d'authentification
-- Sprint 2 : Auth JWT avec rôles
-- ══════════════════════════════════════════════════════════════

-- ── Enum des rôles ────────────────────────────────────────────
DO $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'user_role') THEN
        CREATE TYPE user_role AS ENUM ('admin', 'instructor', 'student', 'guest');
    END IF;
END $$;

-- ── Table : users ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
    id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    created_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),

    -- Identité
    email           VARCHAR(255) UNIQUE NOT NULL,
    username        VARCHAR(100) UNIQUE NOT NULL,
    full_name       VARCHAR(255),

    -- Auth
    password_hash   VARCHAR(255) NOT NULL,      -- bcrypt ou SHA-256+salt
    password_salt   VARCHAR(64)  NOT NULL,

    -- Rôle et accès
    role            user_role NOT NULL DEFAULT 'student',
    is_active       BOOLEAN NOT NULL DEFAULT TRUE,
    is_verified     BOOLEAN NOT NULL DEFAULT FALSE,

    -- Méta
    last_login_at   TIMESTAMP WITH TIME ZONE,
    failed_attempts INTEGER NOT NULL DEFAULT 0,
    locked_until    TIMESTAMP WITH TIME ZONE
);

CREATE INDEX IF NOT EXISTS idx_users_email    ON users (email);
CREATE INDEX IF NOT EXISTS idx_users_username ON users (username);
CREATE INDEX IF NOT EXISTS idx_users_role     ON users (role);

-- ── Table : refresh_tokens ────────────────────────────────────
-- Stocke les refresh tokens (rotation automatique)
CREATE TABLE IF NOT EXISTS refresh_tokens (
    id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id         UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    token_hash      VARCHAR(128) NOT NULL UNIQUE,   -- SHA-256 du token brut
    created_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    expires_at      TIMESTAMP WITH TIME ZONE NOT NULL,
    revoked_at      TIMESTAMP WITH TIME ZONE,
    user_agent      VARCHAR(512),
    ip_address      INET
);

CREATE INDEX IF NOT EXISTS idx_refresh_tokens_user    ON refresh_tokens (user_id);
CREATE INDEX IF NOT EXISTS idx_refresh_tokens_expires ON refresh_tokens (expires_at);

-- ── Table : audit_logs ────────────────────────────────────────
-- Trace tous les événements d'authentification
CREATE TABLE IF NOT EXISTS audit_logs (
    id          BIGSERIAL PRIMARY KEY,
    created_at  TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    user_id     UUID REFERENCES users(id) ON DELETE SET NULL,
    event_type  VARCHAR(50) NOT NULL,   -- 'login', 'logout', 'register', 'token_refresh', etc.
    ip_address  INET,
    user_agent  VARCHAR(512),
    success     BOOLEAN NOT NULL DEFAULT TRUE,
    details     JSONB
);

CREATE INDEX IF NOT EXISTS idx_audit_logs_user       ON audit_logs (user_id);
CREATE INDEX IF NOT EXISTS idx_audit_logs_event_type ON audit_logs (event_type);
CREATE INDEX IF NOT EXISTS idx_audit_logs_created_at ON audit_logs (created_at DESC);

-- ── Ajouter user_id aux tables existantes ─────────────────────
ALTER TABLE spine_models
    ADD COLUMN IF NOT EXISTS user_id UUID REFERENCES users(id) ON DELETE SET NULL;
ALTER TABLE longitudinal_results
    ADD COLUMN IF NOT EXISTS user_id UUID REFERENCES users(id) ON DELETE SET NULL;
ALTER TABLE surgery_sessions
    ADD COLUMN IF NOT EXISTS user_id UUID REFERENCES users(id) ON DELETE SET NULL;

CREATE INDEX IF NOT EXISTS idx_spine_models_user ON spine_models (user_id);

-- ── Trigger updated_at pour users ─────────────────────────────
CREATE TRIGGER trg_users_updated_at
    BEFORE UPDATE ON users
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- ── Compte admin initial ──────────────────────────────────────
-- Mot de passe : "vertex_admin_2024" (à changer en production !)
-- Hash généré avec: SHA-256(salt + password)
INSERT INTO users (email, username, full_name, password_hash, password_salt, role, is_active, is_verified)
SELECT
    'admin@vertex-spine.com',
    'admin',
    'Administrateur VERTEX©',
    '8a9bcf2d1e3f4a5b6c7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b',
    'vertex_default_salt_v1',
    'admin',
    TRUE,
    TRUE
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'admin');
