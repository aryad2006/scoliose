#!/usr/bin/env bash
# VERTEX© — Sauvegarde PostgreSQL automatique
# Cron recommandé : 0 2 * * * /opt/vertex/deploy/backup.sh
#
# Fonctionnement :
#   1. Dump PostgreSQL compressé (pg_dump + gzip)
#   2. Archivage des uploads (si présents)
#   3. Rotation automatique (suppression après RETENTION_DAYS jours)
#   4. Notification de statut (optionnel)
#
# Variables d'environnement à définir (ou dans .env.production) :
#   POSTGRES_USER, POSTGRES_PASSWORD, POSTGRES_DB
#   BACKUP_DIR (défaut: /opt/vertex/backups)
#   RETENTION_DAYS (défaut: 30)
#   REMOTE_BACKUP_HOST (optionnel: rsync vers serveur distant)

set -euo pipefail

# ─── Configuration ─────────────────────────────────────────────────────────────
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ENV_FILE="${SCRIPT_DIR}/.env.production"

# Charger les variables d'environnement
if [[ -f "${ENV_FILE}" ]]; then
  set -o allexport
  # shellcheck disable=SC1090
  source "${ENV_FILE}"
  set +o allexport
fi

POSTGRES_USER="${POSTGRES_USER:-vertex}"
POSTGRES_DB="${POSTGRES_DB:-vertex_db}"
BACKUP_DIR="${BACKUP_DIR:-/opt/vertex/backups}"
RETENTION_DAYS="${RETENTION_DAYS:-30}"
TIMESTAMP="$(date +%Y%m%d_%H%M%S)"
BACKUP_NAME="vertex_db_${TIMESTAMP}.sql.gz"
LOG_FILE="${BACKUP_DIR}/backup.log"
CONTAINER_NAME="vertex_db"

# ─── Fonctions ────────────────────────────────────────────────────────────────
log() {
  echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${LOG_FILE}"
}

notify_failure() {
  local msg="$1"
  log "ERROR: ${msg}"
  # Notification Slack si configuré
  if [[ -n "${SLACK_WEBHOOK_URL:-}" ]]; then
    curl -s -X POST "${SLACK_WEBHOOK_URL}" \
      -H 'Content-type: application/json' \
      --data "{\"text\":\"🚨 [VERTEX Backup] ÉCHEC: ${msg}\"}" || true
  fi
  exit 1
}

notify_success() {
  local size="$1"
  log "SUCCESS: Backup ${BACKUP_NAME} (${size}) créé avec succès."
  if [[ -n "${SLACK_WEBHOOK_URL:-}" ]]; then
    curl -s -X POST "${SLACK_WEBHOOK_URL}" \
      -H 'Content-type: application/json' \
      --data "{\"text\":\"✅ [VERTEX Backup] ${BACKUP_NAME} — ${size} — ${TIMESTAMP}\"}" || true
  fi
}

# ─── Préparation ──────────────────────────────────────────────────────────────
mkdir -p "${BACKUP_DIR}/db"
mkdir -p "${BACKUP_DIR}/uploads"

log "=== Début de la sauvegarde VERTEX ==="

# Vérifier que le container PostgreSQL est actif
if ! docker ps --filter "name=${CONTAINER_NAME}" --filter "status=running" --quiet | grep -q .; then
  notify_failure "Container PostgreSQL '${CONTAINER_NAME}' non disponible"
fi

# ─── Dump PostgreSQL ──────────────────────────────────────────────────────────
log "Dump PostgreSQL → ${BACKUP_NAME}..."
BACKUP_PATH="${BACKUP_DIR}/db/${BACKUP_NAME}"

docker exec "${CONTAINER_NAME}" \
  pg_dump \
    -U "${POSTGRES_USER}" \
    -d "${POSTGRES_DB}" \
    --no-password \
    --format=custom \
    --compress=9 \
  > "${BACKUP_PATH}" \
  || notify_failure "pg_dump a échoué (code $?)"

# Vérifier l'intégrité du dump
if [[ ! -s "${BACKUP_PATH}" ]]; then
  notify_failure "Fichier de backup vide : ${BACKUP_PATH}"
fi

BACKUP_SIZE="$(du -sh "${BACKUP_PATH}" | cut -f1)"
log "Dump terminé : ${BACKUP_SIZE}"

# ─── Archivage uploads (optionnel) ────────────────────────────────────────────
UPLOAD_DIR="${UPLOAD_DIR:-/opt/vertex/uploads}"
if [[ -d "${UPLOAD_DIR}" ]]; then
  UPLOAD_ARCHIVE="${BACKUP_DIR}/uploads/uploads_${TIMESTAMP}.tar.gz"
  log "Archivage uploads → ${UPLOAD_ARCHIVE}..."
  tar -czf "${UPLOAD_ARCHIVE}" -C "$(dirname "${UPLOAD_DIR}")" "$(basename "${UPLOAD_DIR}")" 2>/dev/null || true
fi

# ─── Replication distante (rsync) ─────────────────────────────────────────────
if [[ -n "${REMOTE_BACKUP_HOST:-}" && -n "${REMOTE_BACKUP_PATH:-}" ]]; then
  log "Réplication vers ${REMOTE_BACKUP_HOST}:${REMOTE_BACKUP_PATH}..."
  rsync -az --no-relative \
    "${BACKUP_PATH}" \
    "${REMOTE_BACKUP_HOST}:${REMOTE_BACKUP_PATH}/" \
    || log "WARNING: rsync échoué — backup local conservé"
fi

# ─── Rotation (suppression des vieux backups) ─────────────────────────────────
log "Rotation : suppression des backups de plus de ${RETENTION_DAYS} jours..."
find "${BACKUP_DIR}/db"      -name "*.sql.gz"         -mtime +"${RETENTION_DAYS}" -delete 2>/dev/null || true
find "${BACKUP_DIR}/uploads" -name "*.tar.gz"         -mtime +"${RETENTION_DAYS}" -delete 2>/dev/null || true

# Compter les backups restants
REMAINING="$(find "${BACKUP_DIR}/db" -name "*.sql.gz" | wc -l)"
log "${REMAINING} backup(s) conservé(s) dans ${BACKUP_DIR}/db/"

# ─── Récapitulatif ────────────────────────────────────────────────────────────
notify_success "${BACKUP_SIZE}"
log "=== Fin de la sauvegarde VERTEX ===\n"
