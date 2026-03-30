#!/bin/bash
# ═══════════════════════════════════════════════════════════════════
# VERTEX© — Mise à jour production doctraining.ma
# ═══════════════════════════════════════════════════════════════════
#
# Usage :
#   cd moodle-local/deploy
#   bash deploy_infomaniak.sh
#
# Le site est DÉJÀ en production. Ce script :
#   1. Upload les fichiers de config
#   2. Configure le thème Moove (slider, marketing, FAQ, CSS)
#   3. Configure SMTP Infomaniak
#   4. Installe les plugins manquants
# ═══════════════════════════════════════════════════════════════════

set -e

# ─── CONFIGURATION ───
SSH_USER="uid361285"
SSH_HOST="ssh.doctraining.ma"
REMOTE_MOODLE="~/sites/doctraining.ma"
DEPLOY_DIR="$(cd "$(dirname "$0")" && pwd)"

echo "╔══════════════════════════════════════════════════════════════╗"
echo "║  VERTEX© — Mise à jour production doctraining.ma           ║"
echo "╚══════════════════════════════════════════════════════════════╝"
echo ""

# ─── TEST SSH ───
echo "── Test SSH ──"
if ! ssh -o ConnectTimeout=10 "${SSH_USER}@${SSH_HOST}" "echo 'OK'" 2>/dev/null; then
    echo "[ERREUR] SSH impossible. Alternatives :"
    echo "  1. Terminal web Infomaniak : Manager > Hébergement > SSH"
    echo "  2. Copier les fichiers via FTP puis exécuter en SSH"
    echo ""
    echo "Commandes à exécuter manuellement sur le serveur :"
    echo "  cd ~/sites/doctraining.ma"
    echo "  mkdir -p deploy"
    echo "  # (uploader configure_production.php et vertex_custom.css dans deploy/)"
    echo "  php deploy/configure_production.php"
    exit 1
fi
echo "[OK] Connexion SSH"
echo ""

# ─── 1. UPLOAD ───
echo "── 1. Upload fichiers ──"
ssh "${SSH_USER}@${SSH_HOST}" "mkdir -p ${REMOTE_MOODLE}/deploy"
scp "${DEPLOY_DIR}/configure_production.php" "${SSH_USER}@${SSH_HOST}:${REMOTE_MOODLE}/deploy/"
scp "${DEPLOY_DIR}/vertex_custom.css" "${SSH_USER}@${SSH_HOST}:${REMOTE_MOODLE}/deploy/"
echo "[OK] Fichiers uploadés"
echo ""

# ─── 2. VÉRIFIER THÈME MOOVE ───
echo "── 2. Thème Moove ──"
ssh "${SSH_USER}@${SSH_HOST}" bash -s << 'EOF'
MOODLE=~/sites/doctraining.ma
if [ ! -d "$MOODLE/theme/moove" ]; then
    echo "[INFO] Installation thème Moove..."
    cd $MOODLE/theme
    curl -sL -o moove.zip "https://github.com/willianmano/moodle-theme_moove/archive/refs/heads/master.zip"
    unzip -q moove.zip
    mv moodle-theme_moove-master moove
    rm moove.zip
    echo "[OK] Moove installé"
else
    echo "[OK] Moove déjà présent"
fi
EOF
echo ""

# ─── 3. PLUGINS MANQUANTS ───
echo "── 3. Plugins ──"
ssh "${SSH_USER}@${SSH_HOST}" bash -s << 'EOF'
MOODLE=~/sites/doctraining.ma

for plugin in "mod/customcert:https://github.com/mdjnelson/moodle-mod_customcert/archive/refs/heads/MOODLE_405_STABLE.zip" \
              "mod/attendance:https://github.com/danmarsden/moodle-mod_attendance/archive/refs/heads/main.zip" \
              "mod/hvp:https://github.com/h5p/moodle-mod_hvp/archive/refs/heads/stable.zip" \
              "blocks/completion_progress:https://github.com/deraadt/moodle-block_completion_progress/archive/refs/heads/master.zip"; do
    dir=$(echo $plugin | cut -d: -f1)
    url=$(echo $plugin | cut -d: -f2-)
    name=$(basename $dir)

    if [ ! -d "$MOODLE/$dir" ]; then
        echo "[INFO] Installation $dir..."
        cd "$MOODLE/$(dirname $dir)"
        curl -sL -o tmp.zip "$url"
        unzip -q tmp.zip
        mv moodle-*${name}* "$name" 2>/dev/null || mv *${name}* "$name" 2>/dev/null || true
        rm -f tmp.zip
        echo "  [OK] $dir"
    else
        echo "  [OK] $dir (présent)"
    fi
done
EOF
echo ""

# ─── 4. PLUGIN COUPONS ───
echo "── 4. Plugin VERTEX Coupons ──"
COUPONS_SRC="$(dirname "$DEPLOY_DIR")/plugins/local_vertex_coupons"
if [ -d "$COUPONS_SRC" ]; then
    COUPONS_EXISTS=$(ssh "${SSH_USER}@${SSH_HOST}" "test -d ${REMOTE_MOODLE}/local/vertex_coupons && echo 'yes' || echo 'no'")
    if [ "$COUPONS_EXISTS" = "no" ]; then
        scp -r "$COUPONS_SRC" "${SSH_USER}@${SSH_HOST}:${REMOTE_MOODLE}/local/vertex_coupons"
        echo "[OK] Plugin coupons uploadé"
    else
        echo "[OK] Plugin coupons (présent, mise à jour fichiers)"
        scp -r "$COUPONS_SRC"/* "${SSH_USER}@${SSH_HOST}:${REMOTE_MOODLE}/local/vertex_coupons/"
        echo "[OK] Fichiers coupons mis à jour"
    fi
else
    echo "[SKIP] Source plugin coupons non trouvée"
fi
echo ""

# ─── 5. CONFIGURATION MOODLE ───
echo "── 5. Configuration Moove + SMTP + Paramètres ──"
ssh "${SSH_USER}@${SSH_HOST}" "cd ${REMOTE_MOODLE} && php deploy/configure_production.php"
echo ""

# ─── 6. UPGRADE PLUGINS ───
echo "── 6. Upgrade Moodle ──"
ssh "${SSH_USER}@${SSH_HOST}" "cd ${REMOTE_MOODLE} && php admin/cli/upgrade.php --non-interactive 2>&1" || echo "[WARN] Upgrade a rencontré des warnings (normal si pas de nouveaux plugins)"
echo ""

# ─── 7. RAPPEL CRON ───
echo "── 7. Cron Moodle ──"
echo "Configurer dans Manager Infomaniak > Tâches planifiées :"
echo "  Commande :  /opt/php8.2/bin/php ~/sites/doctraining.ma/admin/cli/cron.php"
echo "  Fréquence : */5 * * * *  (toutes les 5 minutes)"
echo ""

# ─── RÉSUMÉ ───
echo "╔══════════════════════════════════════════════════════════════╗"
echo "║  ✓ MISE À JOUR TERMINÉE                                    ║"
echo "╠══════════════════════════════════════════════════════════════╣"
echo "║  https://doctraining.ma                                     ║"
echo "╠══════════════════════════════════════════════════════════════╣"
echo "║  Reste à faire manuellement :                               ║"
echo "║  1. Mot de passe SMTP : Admin > Serveur > E-mail            ║"
echo "║  2. Logo SVG : Admin > Apparence > Logos                    ║"
echo "║  3. Favicon : Admin > Apparence > Logos                     ║"
echo "║  4. Images slider : Admin > Apparence > Moove > Slider      ║"
echo "║  5. Cron : Manager Infomaniak > Tâches planifiées           ║"
echo "║  6. Tester email : Admin > Serveur > Test e-mail sortant    ║"
echo "╚══════════════════════════════════════════════════════════════╝"
