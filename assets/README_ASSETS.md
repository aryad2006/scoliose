# Ressources Médias — Formation Pente Tibiale

**Date** : 30 mars 2026
**Status** : ✅ 10 SVG générés | 📍 Images libres à sourcer

---

## 📂 SVG Programmés (Production-Ready)

Tous les SVG sont en format vectoriel, responsive et exportables en PNG/PDF pour LMS.

### Liste complète

1. **01_PTS_ANGLE_MEASUREMENT.svg**
   - Schéma mesure angle pente tibiale (Dejour)
   - Usages : Modules 1, 4, Cas cliniques
   - Contenu : Normal vs élevé, ICC mesure, variation ethnique

2. **02_TIBIAL_PLATEAU_ANATOMY.svg**
   - Anatomie plateau tibial (vues coronale/sagittale)
   - Usages : Modules 3-4, anatomie questions
   - Contenu : Condyles, pentes, attachements LCA, mesures

3. **03_BIOMECHANICS_FORCES_LCA.svg**
   - Biomécaniques forces — impact PTS sur tension LCA
   - Usages : Module 5, quiz biomécanique
   - Contenu : Formule Maquet, 2 scénarios (7° vs 12°)

4. **04_PTG_ALIGNMENTS_MA_KA_RKA.svg**
   - Alignements PTG : Mécanique vs Cinématique vs rKA
   - Usages : Module 6 (PTG), comparaison philosophies
   - Contenu : 3 alignements, tableau comparatif

5. **05_DECISION_ALGORITHM_LCA.svg**
   - Algorithme décisionnel diagnostic → chirurgie LCA
   - Usages : Module 5, cas cliniques LCA
   - Contenu : Exam clinique → imaging → PTS assessment → technique

6. **06_PTG_SURVIVAL_CURVES.svg**
   - Courbes survie prothèse : registres suédois/britannique, meta-analyses
   - Usages : Module 7, patient education, outcomes
   - Contenu : 92-96% survie @ 20 ans, données rKA prometteur

7. **07_PTS_DISTRIBUTION_RISK.svg**
   - Distribution angle PTS en population + zones risque LCA rupture
   - Usages : Module 1, quiz épidémiologie
   - Contenu : Normal 7°±3° vs Asiatiques 8.5°±2.5°, seuil risque ≥12°

8. **08_SURGICAL_TECHNIQUES_COMPARISON.svg**
   - Techniques LCA : Single-bundle vs Double-bundle vs Hybrid
   - Usages : Module 5, choix technique quiz
   - Contenu : Avantages/inconvénients, outcomes 90-95%

9. **09_MODERN_TECHNOLOGIES_COMPARISON.svg**
   - Technologies PTG : Navigation vs pSI vs Robotique
   - Usages : Module 7, synthèse technologies futures
   - Contenu : Workflow, coût, précision, temps opératoire

10. **10_KNEE_LIGAMENT_ANATOMY.svg**
    - Anatomie ligamentaire : vues antérieure & sagittale
    - Usages : Modules 1-3, anatomy questions
    - Contenu : LCA/LCP/collatéraux, rôles, forces rupture

---

## 📍 Images à Sourcer (Wikimedia Commons & Sources Libres)

### Radiographies (9 fichiers recommandés)

Chercher sur **Wikimedia Commons** (`commons.wikimedia.org`) :

```
Search terms: "knee radiograph", "radiography anterior cruciate ligament", "tibial plateau measurement"
```

Critères :
- Licence : CC-BY, CC-BY-SA, ou Public Domain
- Qualité : résolution ≥2048px (pour LMS)
- Anonymisation : patient de-identified (HIPAA-compliant)

**Liste prioritaire** :
1. Knee lateral view (normal) — pour baseline anatomie
2. Knee AP view (normal) — pour vues standardisées
3. PTS measurement on radiograph — pour explication mesure
4. Elevated PTS example (≥12°) — pour contraste pathologique
5. ACL rupture signs on radiograph — pour diagnostic différentiel
6. Osteochondral lesion — pour pathologie associée
7. Meniscal tear on radiograph — pour complication LCA
8. PTG alignment post-operative — pour outcomes
9. PTG revision indication — pour complications

### IRM/TDM (6 fichiers)

Sources :
- **PubMed Central** : Articles open access avec figures réutilisables
- **Radiopaedia** : Base pédagogique radiologique (cases licence CC-BY-NC)
- **OpenStax Anatomy** : Illustrations IRM standardisées

**Sujets prioritaires** :
1. ACL rupture on MRI (T2 FS sagittal)
2. ACL reconstruction post-op
3. Cartilage damage (chondropathia)
4. Meniscus tear (bucket handle)
5. PTS measurement on 3D MRI
6. Post-op complications (hémarthrose)

---

## 🔧 Intégration dans Fichiers Contenu

### Pattern Standard [MEDIA: ...]

Chaque section/paragraphe pertinent doit inclure un tag [MEDIA: ...] :

```markdown
## Module 4 — Mesure PTS Radiologique

La pente tibiale se mesure sur radiographie latérale selon la **méthode Dejour** : angle entre le plateau tibial et l'axe long de la tibia.

[MEDIA: 📐 PT-MOD04-001 — Schéma mesure angle PTS (Dejour), normal 7°±3° vs élevé ≥12°]

Valeurs normales chez Caucasiens : **7° ± 2.1°** (70% entre 4-10°)
Variation ethnique importante : Asiatiques +1.5° en moyenne (Hashemi 2008)

[MEDIA: 📊 PT-MOD01-002 — Histogramme distribution PTS population (normal vs risque)]

### Cas Clinique — Patient à PTS Élevée

**Imagerie radiographique** :
- Radiographie latérale tibia : PTS = 14° (élevé)
- [MEDIA: 📷 PT-CAS-LCA-015-001 — Radiographie latérale genou, PTS 14°]

**Plan d'imagerie complément** :
- IRM 3D mesure précise PTS (ICC 0.95)
- [MEDIA: 🧠 PT-CAS-LCA-015-002 — IRM sagittale T2 FS, mesure PTS 3D]
```

### Fichiers à Mettre à Jour

1. **CDC_PT_00_INTRODUCTION_CHARTE.md**
   - Ajouter [MEDIA] pour contexte historique
   - 3-5 schémas d'introduction

2. **CDC_PT_01_HISTOIRE_CONCEPTS.md**
   - Ajouter distribution PTS (SVG 07)
   - References figures historiques

3. **CDC_PT_02_ANATOMIE_EMBRYOLOGIE.md**
   - Anatomie ligaments (SVG 10)
   - Plateau tibial vues (SVG 02)

4. **CDC_PT_03_BIOMECANIQUE.md**
   - Forces biomécaniques (SVG 03)
   - Maquet formula visualization

5. **CDC_PT_04_IMAGERIE_MESURE.md**
   - PTS measurement (SVG 01)
   - Radiographies sourçées (6-8 images)

6. **CDC_PT_05_LCA.md**
   - Algorithme LCA (SVG 05)
   - Techniques chirurgicales (SVG 08)
   - Cas cliniques radiographies

7. **CDC_PT_06_PTG.md**
   - Alignements PTG (SVG 04)
   - Techniques PTG (SVG 08)
   - Technologies (SVG 09)

8. **CDC_PT_07_SYNTHESE_COMPLET.md**
   - Outcomes courbes (SVG 06)
   - Technologies modernes (SVG 09)
   - Future directions

9. **CAS_CLINIQUES_PENTE_TIBIALE_PROGRESSIFS.md**
   - Chaque cas : 2-4 radiographies
   - 1 schéma anatomique pertinent
   - Liens vers algos décisionnels

10. **QUIZ_PENTE_TIBIALE_PROGRESSIF.md**
    - Questions image : radiographies annotées
    - Schémas avec labels (SVG modifiés)
    - Graphiques pour questions calcul

---

## 📦 Format d'Export LMS

### SVG Export Options

```bash
# Pour Moodle/SCORM :
# 1. Garder SVG inline (HTML5 compatible)
# 2. Exporter en PNG 1920x1080 (affichage optimal)
# 3. Convertir en PDF pour impression/export

# Tools :
# - Inkscape CLI : inkscape --export-png file.png file.svg
# - ImageMagick : convert file.svg file.png
```

### Image Metadata Standard

Chaque image doit inclure :
```
Filename: PT-MOD05-001_PTS_Measurement.png
Title: Mesure Angle Pente Tibiale (Methode Dejour)
Description: Schema illustration mesure PTS radiographique, angle normal 7±3° vs élevé ≥12°
Attribution: Claude Code Agent / Illustration SVG
License: CC-BY (pour creation propre)
Module: 05 (LCA)
Usage: Module content + Quiz images
```

---

## ✅ Checklist Intégration

### Phase 1 : SVG Générés
- [x] 10 SVG programmés créés
- [x] Validé SVG syntax (aperçu visuel)
- [x] Stocké dans assets/images/svg/

### Phase 2 : Images Sourçées
- [ ] 9+ radiographies trouvées Wikimedia
- [ ] 6+ IRM/TDM sourçées (PubMed/Radiopaedia)
- [ ] Vérifié licences (CC-BY, OA)
- [ ] Téléchargé + nommé standardisé
- [ ] Stocké dans assets/images/radiographs/ + anatomical/

### Phase 3 : Intégration Fichiers
- [ ] CDC_PT_00-07 : [MEDIA] tags ajoutés
- [ ] CAS_CLINIQUES : radiographies intégrées
- [ ] QUIZ : images diagnostiques placées
- [ ] Liens validés (no broken references)

### Phase 4 : Export LMS
- [ ] SVG convertis PNG (export 1920x1080)
- [ ] Metadata images documentée
- [ ] Attributions sources listées
- [ ] README pour LMS admin

### Phase 5 : Documentation
- [ ] Ce fichier finalisé
- [ ] Sources.json avec toutes references
- [ ] License compliance.txt

---

## 📚 Ressources Additionnelles

### Pour Créer SVG Anatomiques Supplementaires

Si vous avez besoin de schémas additionnels :

1. **Ligaments détaillés** : Créer vues micro-anatomiques (fasicules, insertions)
2. **Axes des membres** : Varo/valgus mechanical axis
3. **Prothèse PTG** : Composants (femoral, tibial, insert)
4. **Techniques d'examen** : Lachman, Anterior drawer, Pivot-shift
5. **Algorithmes supplémentaires** : Revision, gestion complications, patient selection

### Outils Recommandés

- **Inkscape** (free, open-source) : Creation/editing SVG
- **Figma** (web-based) : Collaborative design
- **Adobe Illustrator** : Professional vector graphics
- **ImageMagick** : Batch conversion SVG → PNG

---

## 📋 Prochaines Étapes

1. **Sourcer images libres** (2-3 heures)
   - Wikimedia search radiographies
   - PubMed Central open access figures
   - Radiopaedia cases (with CC license)

2. **Créer SVG supplémentaires** (4-6 heures)
   - Ligaments + anatomie détaillée
   - Techniques examen clinique
   - Algorithmes revision/complications

3. **Mettre à jour fichiers contenu** (8-10 heures)
   - Ajouter [MEDIA] tags
   - Intégrer radiographies cas cliniques
   - Placer images quiz

4. **Validation finale** (2-3 heures)
   - Vérifier liens images
   - Attribution sources complète
   - Export LMS test

**Timeline estimée total** : 24-30 heures (travail concentré)

---

**Prépared for** : VERTEX© Medical Education Platform
**Formation** : Gestion Pente Tibiale — Chirurgie du Genou
**Status** : ✅ SVG assets complete | 📍 Images to-source | 🟡 Integration pending
