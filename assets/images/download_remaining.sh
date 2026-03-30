#!/bin/bash

BASE_URL="https://commons.wikimedia.org/wiki/Special:Redirect/file/"

# Array of files to download: (filename, output_path)
declare -a files=(
  "Knee_diagram.svg:diagrams/01_knee_diagram_en.svg"
  "Knee_diagram-fr_ACL_PCL.svg:diagrams/02_knee_diagram_fr.svg"
  "DBCLS_anterior_view_knee.svg:diagrams/03_anterior_view.svg"
  "DBCLS_posterior_view_knee.svg:diagrams/04_posterior_view.svg"
  "Knee_diagram-de_ACL_PCL.svg:diagrams/05_knee_diagram_de.svg"
  "Knee_osteoarthritis.svg:illustrations/01_oa_progression.svg"
  "Postoperative_X-ray_normal_knee_prosthesis.svg:illustrations/02_ptg_postop.svg"
  "Gray348.png:illustrations/03_gray348_tibia.png"
  "Human_leg_bones_labeled.svg:anatomy/01_leg_bones.svg"
  "Human_tibia.stl:anatomy/02_tibia_3d.stl"
)

for entry in "${files[@]}"; do
  IFS=':' read -r filename output <<< "$entry"
  
  if [ -f "$output" ]; then
    echo "✓ $filename (exists)"
    continue
  fi
  
  mkdir -p "$(dirname "$output")"
  echo -n "⬇ $filename ... "
  
  if curl -s -L --max-time 60 "${BASE_URL}${filename}" -o "$output" 2>/dev/null && [ -s "$output" ]; then
    size=$(du -h "$output" | cut -f1)
    echo "✓ ($size)"
  else
    rm -f "$output"
    echo "✗"
  fi
done

echo ""
echo "Summary:"
find . -type f ! -path "*/.*" | wc -l | xargs echo "Total files:"
