#!/bin/bash

# WIKIMEDIA_DOWNLOAD_BATCH.sh
# Télécharge automatiquement toutes les images Wikimedia pour la formation Pente Tibiale
# Version: 2.0 (30 mars 2026)
# Statut: READY_FOR_DOWNLOAD

set -e  # Exit on error

# Couleurs pour l'output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'  # No Color

# Configuration
BASE_URL="https://commons.wikimedia.org/wiki/Special:Redirect/file/"
ASSETS_DIR="../assets/images"
MANIFEST_FILE="WIKIMEDIA_MANIFEST.json"
LOG_FILE="WIKIMEDIA_DOWNLOAD.log"

echo -e "${BLUE}═══════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}FORMATION PENTE TIBIALE — Téléchargement Wikimedia${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════${NC}"
echo ""

# Vérifier que le manifest existe
if [ ! -f "$MANIFEST_FILE" ]; then
    echo -e "${RED}✗ ERREUR: Fichier $MANIFEST_FILE introuvable${NC}"
    exit 1
fi

# Créer les répertoires
echo -e "${YELLOW}📁 Création des répertoires...${NC}"
mkdir -p "$ASSETS_DIR/radiographs"
mkdir -p "$ASSETS_DIR/diagrams"
mkdir -p "$ASSETS_DIR/mri"
mkdir -p "$ASSETS_DIR/illustrations"
mkdir -p "$ASSETS_DIR/anatomy"
echo -e "${GREEN}✓ Répertoires prêts${NC}\n"

# Initialiser le log
echo "WIKIMEDIA_DOWNLOAD_BATCH - $(date)" > "$LOG_FILE"
echo "================================================" >> "$LOG_FILE"

# Fonction pour télécharger un fichier
download_file() {
    local url="$1"
    local output_path="$2"
    local filename=$(basename "$output_path")
    local category="$3"

    # Vérifier si le fichier existe déjà
    if [ -f "$output_path" ]; then
        echo -e "${YELLOW}⊘ $filename (existe déjà)${NC}"
        echo "SKIP: $filename (file exists)" >> "$LOG_FILE"
        return 0
    fi

    # Créer le répertoire de destination s'il n'existe pas
    mkdir -p "$(dirname "$output_path")"

    # Télécharger avec curl (avec timeout et retry)
    echo -n "⬇ $filename ... "

    if curl -s -f -L --max-time 30 "$url" -o "$output_path" 2>/dev/null; then
        # Vérifier que le fichier n'est pas vide
        if [ -s "$output_path" ]; then
            local size=$(du -h "$output_path" | cut -f1)
            echo -e "${GREEN}✓ ($size)${NC}"
            echo "OK: $filename ($size)" >> "$LOG_FILE"
            return 0
        else
            rm "$output_path"
            echo -e "${RED}✗ (fichier vide)${NC}"
            echo "FAIL: $filename (empty file)" >> "$LOG_FILE"
            return 1
        fi
    else
        echo -e "${RED}✗ (échec)${NC}"
        echo "FAIL: $filename (download error)" >> "$LOG_FILE"
        return 1
    fi
}

# Parser le JSON et télécharger chaque image
echo -e "${YELLOW}📥 Téléchargement des images...${NC}"
echo ""

# Utiliser jq ou Python pour parser le JSON
if command -v jq &> /dev/null; then
    # Utiliser jq si disponible
    while IFS= read -r line; do
        name=$(echo "$line" | jq -r '.name')
        source_url=$(echo "$line" | jq -r '.source_url')
        download_path=$(echo "$line" | jq -r '.download_path')
        category=$(echo "$line" | jq -r '.category')
        id=$(echo "$line" | jq -r '.id')

        # Remplacer le chemin relatif par le chemin absolu
        full_path="$ASSETS_DIR/$(echo $download_path | sed 's|assets/images/||')"

        # Extraire l'URL réelle de Wikimedia (le lien direct au fichier)
        file_url="${BASE_URL}${name}"

        download_file "$file_url" "$full_path" "$category"

    done < <(jq -c '.images[]' "$MANIFEST_FILE")
else
    # Fallback: utiliser des commandes manuelles
    echo -e "${YELLOW}⚠ jq non trouvé, utilisant extraction manuelle...${NC}"
    echo ""

    # Radiographies
    echo "→ Radiographies (4 fichiers)"
    download_file "${BASE_URL}Knee_plain_X-ray_weight_bearing.jpg" "$ASSETS_DIR/radiographs/01_knee_normal_ap.jpg" "radiograph"
    download_file "${BASE_URL}Osteoarthritis_left_knee.jpg" "$ASSETS_DIR/radiographs/02_oa_pathology.jpg" "radiograph"
    download_file "${BASE_URL}Knee_plain_X-ray_weight_bearing_flexion.jpg" "$ASSETS_DIR/radiographs/03_flexion_xray.jpg" "radiograph"
    download_file "${BASE_URL}X-ray_9_year_old_female_knee.jpg" "$ASSETS_DIR/radiographs/04_pediatric_knee.jpg" "radiograph"

    # IRM
    echo ""
    echo "→ IRM Vidéos (3 fichiers)"
    download_file "${BASE_URL}Knee_MRI_osteoarthritis_pd_tse_sagittal.ogg" "$ASSETS_DIR/mri/01_mri_oa_sagittal.ogg" "mri_video"
    download_file "${BASE_URL}Knee_MRI_t1_tse_sagittal.ogg" "$ASSETS_DIR/mri/02_mri_t1_sagittal.ogg" "mri_video"
    download_file "${BASE_URL}Knee_MRI_pd_tse_transverse.ogg" "$ASSETS_DIR/mri/03_mri_transverse.ogg" "mri_video"

    # Diagrammes
    echo ""
    echo "→ Diagrammes (6 fichiers)"
    download_file "${BASE_URL}Knee_diagram.svg" "$ASSETS_DIR/diagrams/01_knee_diagram_en.svg" "diagram"
    download_file "${BASE_URL}Knee_diagram-fr_ACL_PCL.svg" "$ASSETS_DIR/diagrams/02_knee_diagram_fr.svg" "diagram"
    download_file "${BASE_URL}DBCLS_anterior_view_knee.svg" "$ASSETS_DIR/diagrams/03_anterior_view.svg" "diagram"
    download_file "${BASE_URL}DBCLS_posterior_view_knee.svg" "$ASSETS_DIR/diagrams/04_posterior_view.svg" "diagram"
    download_file "${BASE_URL}Knee_diagram-de_ACL_PCL.svg" "$ASSETS_DIR/diagrams/05_knee_diagram_de.svg" "diagram"

    # Illustrations
    echo ""
    echo "→ Illustrations (3 fichiers)"
    download_file "${BASE_URL}Knee_osteoarthritis.svg" "$ASSETS_DIR/illustrations/01_oa_progression.svg" "illustration"
    download_file "${BASE_URL}Postoperative_X-ray_normal_knee_prosthesis.svg" "$ASSETS_DIR/illustrations/02_ptg_postop.svg" "illustration"
    download_file "${BASE_URL}Gray348.png" "$ASSETS_DIR/illustrations/03_gray348_tibia.png" "illustration"

    # Anatomie
    echo ""
    echo "→ Anatomie (2+ fichiers)"
    download_file "${BASE_URL}Human_leg_bones_labeled.svg" "$ASSETS_DIR/anatomy/01_leg_bones.svg" "anatomy"
    download_file "${BASE_URL}Human_tibia.stl" "$ASSETS_DIR/anatomy/02_tibia_3d.stl" "anatomy"
fi

echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✓ Téléchargement terminé${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════${NC}"

# Résumé
echo ""
echo "📊 Résumé:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Voir $LOG_FILE pour les détails"

# Compter les fichiers téléchargés
total_files=$(find "$ASSETS_DIR" -type f ! -path "*/.*" | wc -l)
echo "Fichiers dans $ASSETS_DIR: $total_files"

echo ""
echo "🎯 Prochaines étapes:"
echo "  1. Vérifier les images téléchargées: ls -lR $ASSETS_DIR"
echo "  2. Valider les licences et la qualité"
echo "  3. Intégrer [MEDIA] tags dans CAS_CLINIQUES_PENTE_TIBIALE_PROGRESSIFS.md"
echo "  4. Lancer la QA finale (validation liens, metadata)"
echo ""
