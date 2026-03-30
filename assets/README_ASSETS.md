# Assets — Formation Pente Tibiale

**Status** : 🟡 Phase 1 Partial Complete (7/10 SVG créés) | 📍 Phase 2 Prêt (Wikimedia sourcing)

---

## Structure

```
assets/
├── README_ASSETS.md                    [Ce fichier]
├── MEDIA_ASSETS_CATALOGUE.json         [Inventaire complet + status]
├── IMAGES_WIKIMEDIA_SOURCED.md        [18+ images cataloguées]
│
└── images/
    ├── svg/                            [7 SVG ✅ created]
    │   ├── 01_PTS_ANGLE_MEASUREMENT.svg
    │   ├── 02_TIBIAL_PLATEAU_ANATOMY.svg
    │   ├── 03_BIOMECHANICS_FORCES_LCA.svg
    │   ├── 04_PTG_ALIGNMENTS_MA_KA_RKA.svg
    │   ├── 05_DECISION_ALGORITHM_LCA.svg
    │   ├── 06_PTG_SURVIVAL_CURVES.svg
    │   ├── 07_PTS_DISTRIBUTION_RISK.svg
    │   ├── 08_SURGICAL_TECHNIQUES_COMPARISON.svg [🟡 Planned]
    │   ├── 09_MODERN_TECHNOLOGIES_COMPARISON.svg [🟡 Planned]
    │   └── 10_KNEE_LIGAMENT_ANATOMY.svg [🟡 Planned]
    │
    ├── radiographs/                    [🟡 Pending Wikimedia]
    │   ├── 01_knee_plain_xray_normal.jpg
    │   ├── 02_osteoarthritis_left_knee.jpg
    │   └── ... (9-12 radiographies)
    │
    ├── diagrams/                       [🟡 Pending Wikimedia]
    │   ├── 08_knee_diagram_fr.svg
    │   ├── 09_knee_anatomy_anterior.svg
    │   └── ... (6+ diagrammes)
    │
    └── mri/                            [🟡 Pending Wikimedia]
        ├── 05_knee_mri_sagittal.ogg
        └── ... (3+ vidéos IRM)
```

---

## SVG Créés (Phase 1 ✅)

### 1. **01_PTS_ANGLE_MEASUREMENT.svg**
- Méthode Dejour mesure radiographique PTS
- Zones normales/borderline/élevées
- Module 4 (Imagerie)
- Usage : CDC_PT_04_IMAGERIE, CAS_CLINIQUES

### 2. **02_TIBIAL_PLATEAU_ANATOMY.svg**
- Vues coronales et sagittales plateau tibial
- Ménisques, condyles, attaches LCA
- Module 3 (Anatomie)
- Usage : CDC_PT_03_BIOMECANIQUE, cas cliniques

### 3. **03_BIOMECHANICS_FORCES_LCA.svg**
- Forces cisaillement PTS 7° vs 15°
- Maquet formula application
- Graphique cisaillement vs PTS
- Module 11 (LCA - Biomécanique)
- Usage : CDC_PT_05_LCA, cas LCA

### 4. **04_PTG_ALIGNMENTS_MA_KA_RKA.svg**
- Comparaison MA / KA / rKA
- Survie, pros/cons, indications
- Module 6 (PTG)
- Usage : CDC_PT_06_PTG, cas PTG

### 5. **05_DECISION_ALGORITHM_LCA.svg**
- Flowchart examen clinique → diagnostic → chirurgie
- Branches PTS ≤10° / 10-12° / >12°
- Module 11-12 (LCA - Décision)
- Usage : CDC_PT_05_LCA, tous cas LCA

### 6. **06_PTG_SURVIVAL_CURVES.svg**
- Courbes survie 92-96% @ 20 ans
- Registres suédois/britannique
- Module 7 (Synthèse)
- Usage : CDC_PT_07_SYNTHESE

### 7. **07_PTS_DISTRIBUTION_RISK.svg**
- Histogramme distribution PTS population
- Zones risque avec seuils
- Module 11 (Épidémiologie)
- Usage : CDC_PT_05_LCA, Module 11

---

## SVG Planifiés (Phase 1b 🟡)

| # | Filename | Titre | Module | Status |
|---|----------|-------|--------|--------|
| 8 | `08_SURGICAL_TECHNIQUES_COMPARISON.svg` | SB vs DB vs Hybrid | 5 | Planned |
| 9 | `09_MODERN_TECHNOLOGIES_COMPARISON.svg` | Navigation vs pSI vs Robotique | 7 | Planned |
| 10 | `10_KNEE_LIGAMENT_ANATOMY.svg` | Anatomie ligaments | 3 | Planned |

---

## Images Wikimedia (Phase 2 📍)

**Statut** : 18+ images cataloguées, prêtes pour téléchargement

Voir [IMAGES_WIKIMEDIA_SOURCED.md](IMAGES_WIKIMEDIA_SOURCED.md) pour :
- Radiographies simples (4)
- IRM/TDM vidéos (3)
- Diagrammes anatomiques (6)
- Illustrations pathologie (3)
- Anatomie osseuse (2+)

**Workflow téléchargement** :
```bash
# Créer dossiers
mkdir -p assets/images/{radiographs,diagrams,mri}

# Télécharger Wikimedia (exemple)
wget https://commons.wikimedia.org/wiki/File:Knee_diagram-fr_ACL_PCL.svg \
  -O assets/images/diagrams/09_knee_diagram_fr.svg
```

---

## Intégration dans CDC

### Template Standard [MEDIA]

```markdown
> [MEDIA: ICON PT-MOD##-### — Description brève 40-50 caractères]
```

**Icons** :
- `📐` Schéma/Diagramme SVG
- `📊` Graphique/Courbe
- `📷` Radiographie
- `🧠` IRM/TDM
- `🖼️` Illustration
- `⚠️` Pathologie
- `✅` Normal/Exemple bon

**Code Format** :
- `PT-MOD##-###` pour modules (# = numéro module)
- `PT-CAS-TYPE-###-###` pour cas cliniques
- `PT-QUIZ-LEVEL-###` pour quiz

---

## Fichiers Intégrés ✅

| Fichier | Médias | Status | Avancement |
|---------|--------|--------|------------|
| CDC_PT_05_LCA.md | 13 | ✅ Complete | 100% |
| CDC_PT_03_BIOMECANIQUE.md | 5-6 | 🟡 Pending | 0% |
| CDC_PT_04_IMAGERIE.md | 8-10 | 🟡 Pending | 0% |
| CDC_PT_06_PTG.md | 10-12 | 🟡 Pending | 0% |
| CDC_PT_01, 02, 07 | 5-8 each | 🟡 Pending | 0% |
| CAS_CLINIQUES | 180 (60×3) | 🟡 Pending | 0% |
| QUIZ | 25+ | 🟡 Pending | 0% |

---

## Metadata Standard

Chaque [MEDIA] tag doit avoir :
- **id** : PT-MOD##-### (unique)
- **filename** : Path relatif assets/images/
- **title** : Titre court (max 80 chars)
- **description** : 2-3 lignes max
- **module** : Numéro module
- **type** : diagram, anatomy, biomechanics, outcomes, etc.
- **icon** : Emoji standard
- **license** : CC-BY, Public Domain, etc.
- **status** : ✅ Created, 🟡 Planned, 📍 Sourced

---

## Commandes Utiles

### Convertir SVG → PNG (batch)
```bash
# Avec Inkscape
for f in assets/images/svg/*.svg; do
  inkscape --export-png="${f%.svg}.png" -w 1920 -h 1080 "$f"
done

# Avec ImageMagick
for f in assets/images/svg/*.svg; do
  convert -density 300 "$f" -resize 1920x1080 "${f%.svg}.png"
done
```

### Valider Liens Médias
```bash
# Vérifier tous [MEDIA] tags dans CDC
grep -r "\[MEDIA:" cours-pente-tibiale/ | wc -l

# Lister fichiers manquants
grep -r "\[MEDIA:" cours-pente-tibiale/ | grep -o "PT-[^ ]*" | sort -u > referenced_ids.txt
```

---

## Timeline

- **Phase 1** : ✅ DONE (7 SVG created)
- **Phase 1b** : 🟡 NEXT (3 SVG remaining ~ 2h)
- **Phase 2** : 📍 READY (Wikimedia sourcing ~ 2-3h)
- **Phase 3** : 🟡 AFTER (CDC integration ~ 8-12h)
- **Phase 4** : 🟡 FINAL (QA + export ~ 4-6h)

**Total** : 24-30h (bien coordonné)

---

## QA Checklist

- [ ] Tous SVG créés et testés
- [ ] Wikimedia images téléchargées
- [ ] [MEDIA] tags ajoutés dans tous CDC files
- [ ] Liens validés (no broken refs)
- [ ] Metadata complète JSON
- [ ] Licenses vérifiées
- [ ] Alt-text pour accessibilité WCAG
- [ ] PNG export test pour LMS
- [ ] Commit final + push

---

**Last Updated** : 2026-03-30
**Prepared by** : CLAUDE Code Agent
**Platform** : VERTEX© Medical Education
