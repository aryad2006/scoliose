-- ══════════════════════════════════════════════════════════════
-- VERTEX© — Initialisation de la base de données PostgreSQL
-- Sprint 1 : Persistence des modèles et simulations
-- ══════════════════════════════════════════════════════════════

-- Extension UUID native PostgreSQL
CREATE EXTENSION IF NOT EXISTS "pgcrypto";

-- ── Table : spine_models ──────────────────────────────────────
-- Stocke chaque modèle de rachis créé via POST /api/spine/create
CREATE TABLE IF NOT EXISTS spine_models (
    id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    created_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),

    -- Paramètres patient
    weight_kg       FLOAT NOT NULL,
    height_cm       FLOAT NOT NULL,
    age             INTEGER NOT NULL,
    sex             VARCHAR(1) NOT NULL CHECK (sex IN ('M', 'F')),
    tscore          FLOAT NOT NULL DEFAULT 0.0,

    -- Méta
    version         VARCHAR(20) NOT NULL DEFAULT '0.2.0',
    label           VARCHAR(255),

    -- Sérialisation JSON complète du modèle Julia
    model_json      JSONB NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_spine_models_created_at
    ON spine_models (created_at DESC);

-- ── Table : longitudinal_results ─────────────────────────────
-- Stocke chaque résultat de simulation longitudinale
CREATE TABLE IF NOT EXISTS longitudinal_results (
    id                      UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    spine_model_id          UUID REFERENCES spine_models(id) ON DELETE CASCADE,
    created_at              TIMESTAMP WITH TIME ZONE DEFAULT NOW(),

    -- Paramètres de simulation
    duration_years          FLOAT NOT NULL,
    time_step_months        INTEGER NOT NULL,
    initial_age             INTEGER NOT NULL,
    asymmetry_type          VARCHAR(50),

    -- Résultats clés
    final_cobb_angle        FLOAT NOT NULL,
    developed_scoliosis     BOOLEAN NOT NULL DEFAULT FALSE,
    scoliosis_onset_years   FLOAT,
    buckling_detected       BOOLEAN NOT NULL DEFAULT FALSE,
    buckling_onset_years    FLOAT,
    max_damage              FLOAT NOT NULL DEFAULT 0.0,
    max_asymmetry           FLOAT NOT NULL DEFAULT 0.0,

    -- Avertissements FEM
    warnings                TEXT[] NOT NULL DEFAULT '{}',

    -- Sérialisation JSON complète (snapshots inclus)
    result_json             JSONB NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_longi_results_spine_model
    ON longitudinal_results (spine_model_id);
CREATE INDEX IF NOT EXISTS idx_longi_results_scoliosis
    ON longitudinal_results (developed_scoliosis, final_cobb_angle DESC);

-- ── Table : surgery_sessions ─────────────────────────────────
-- Stocke les sessions chirurgicales (vis + tiges + correction)
CREATE TABLE IF NOT EXISTS surgery_sessions (
    id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    spine_model_id  UUID REFERENCES spine_models(id) ON DELETE CASCADE,
    created_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at      TIMESTAMP WITH TIME ZONE DEFAULT NOW(),

    -- Statut
    status          VARCHAR(20) NOT NULL DEFAULT 'in_progress'
                    CHECK (status IN ('in_progress', 'completed', 'evaluated')),

    -- Résultats de l'évaluation (NULL si pas encore évaluée)
    cobb_correction_pct     FLOAT,
    complication_score      FLOAT,
    instrumentation_density FLOAT,

    -- Sérialisation (vis, tiges, résultats) 
    session_json    JSONB NOT NULL DEFAULT '{}'
);

CREATE INDEX IF NOT EXISTS idx_surgery_sessions_spine_model
    ON surgery_sessions (spine_model_id);
CREATE INDEX IF NOT EXISTS idx_surgery_sessions_status
    ON surgery_sessions (status);

-- ── Trigger : updated_at automatique ─────────────────────────
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_spine_models_updated_at
    BEFORE UPDATE ON spine_models
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER trg_surgery_sessions_updated_at
    BEFORE UPDATE ON surgery_sessions
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- ── Vue : statistiques globales ───────────────────────────────
CREATE OR REPLACE VIEW v_simulation_stats AS
SELECT
    COUNT(DISTINCT sm.id)                               AS total_models,
    COUNT(DISTINCT lr.id)                               AS total_simulations,
    COUNT(DISTINCT CASE WHEN lr.developed_scoliosis THEN lr.id END) AS scoliosis_cases,
    ROUND(AVG(lr.final_cobb_angle)::numeric, 2)         AS avg_cobb_angle,
    ROUND(AVG(lr.duration_years)::numeric, 1)           AS avg_sim_duration_years,
    COUNT(DISTINCT ss.id)                               AS total_surgery_sessions
FROM spine_models sm
LEFT JOIN longitudinal_results lr ON lr.spine_model_id = sm.id
LEFT JOIN surgery_sessions ss     ON ss.spine_model_id = sm.id;
