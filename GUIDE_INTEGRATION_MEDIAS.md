# Guide Intégration Médias dans Fichiers Contenu

**Date** : 30 mars 2026
**Objectif** : Enrichir tous les fichiers CDC_PT_XX + CAS_CLINIQUES + QUIZ avec références [MEDIA]

---

## 📋 Template Standard [MEDIA: ...]

### Format

```markdown
[MEDIA: ICON CODE_REFERENCE — Description visuelle complète]
```

### Exemples

```markdown
[MEDIA: 📐 PT-MOD05-001 — Schéma décomposition forces plan incliné (angle PTS, force normale, force cisaillement)]

[MEDIA: 📊 PT-MOD05-002 — Graphique force cisaillement vs angle PTS (0° à 20°, Maquet formula)]

[MEDIA: 📷 PT-MOD04-003 — Radiographie latérale tibia normal, PTS 7°, landmark cortex postérieur]

[MEDIA: 🧠 PT-CAS-LCA-015-001 — IRM sagittale T2 FS, rupture LCA proximale, PTS mesuré 14°]
```

### Code Référence (Sémantique)

Format : `PT-MOD##-###` ou `PT-CAS-TYPE-###-###`

Exemples :
- `PT-MOD05-001` → Pente Tibiale, Module 05, Média 01
- `PT-CAS-LCA-015-001` → Pente Tibiale, Cas Clinique, Type LCA, Cas 15, Médium 01
- `PT-QUIZ-BR-001` → Pente Tibiale, Quiz, Niveau Bronze, Question 001

### Icons Standardisés

| Icon | Type | Usages |
|---|---|---|
| 📐 | Schéma/Diagramme SVG | Anatomie, biomécanique, algorithmes |
| 📊 | Graphique/Courbe | Survival curves, distribution, outcomes |
| 📷 | Radiographie/Photo | Radiographies simples, images cliniques |
| 🧠 | IRM/TDM | Imagerie avancée |
| 🖼️ | Illustration | Anatomie artwork, reconstructions |
| ⚠️ | Image pathologique | Pathologie, complications |
| ✅ | Normal/Exemple bon | Normal anatomy, good outcomes |
| ❌ | Mauvais/Pathologique | Pathological findings |

---

## 🎯 Mapping Médias par Module

### MODULE 1 : HISTOIRE & CONCEPTS

**Sections principales** :
- Historique WebER → [MEDIA: 📐 PT-MOD01-001 — Timeline histoire PTS (1836 Weber → 2026 rKA)]
- Distribution PTS population → [MEDIA: 📊 PT-MOD01-002 — Histogramme PTS normal vs risque (zones Bronze/limite/élevé)]
- Concepts bases → [MEDIA: 🖼️ PT-MOD01-003 — Illustration plateau tibial incliné vs plat]

**Cas clinique intro** :
- [MEDIA: 📷 PT-MOD01-004 — Radiographie patient Weber découverte incidentelle]

---

### MODULE 3 : ANATOMIE

**Sections principales** :
- Plateau tibial anatomie → [MEDIA: 📐 PT-MOD03-001 — Vue coronale + sagittale plateau tibial, condyles, pentes]
- LCA attachements → [MEDIA: 🖼️ PT-MOD03-002 — Anatomie LCA attaches fémorales/tibiales, vue 3D]
- Ligaments stabilisateurs → [MEDIA: 📐 PT-MOD03-003 — Schéma ligaments complets (LCA/LCP/collatéraux/capsule)]
- Ménisques → [MEDIA: 🖼️ PT-MOD03-004 — Anatomie ménisques médial/latéral, semi-lunaires]

**Imagerie** :
- [MEDIA: 📷 PT-MOD03-005 — Radiographie AP genou anatomie osseuse normale]
- [MEDIA: 🧠 PT-MOD03-006 — IRM coronale T1 anatomie plateau tibial normal]

---

### MODULE 5 : BIOMÉCANIQUE (CRITICAL)

**Sections principales** :
- Plan incliné → [MEDIA: 📐 PT-MOD05-001 — Décomposition forces plan incliné, F=P×sin(θ)]
- Forces vs PTS → [MEDIA: 📊 PT-MOD05-002 — Graphique cisaillement vs PTS (7°→12°→15°, +71%)]
- Interaction flexion → [MEDIA: 📐 PT-MOD05-003 — Vecteur cisaillement selon angle flexion (extension → 30° → 90°)]
- Pente effective → [MEDIA: 📐 PT-MOD05-004 — Schéma composantes pente effective (osseuse + ménisque + PE insert)]
- Équilibre LCA/LCP → [MEDIA: 📐 PT-MOD05-005 — Triangle stabilité (PTS + ligaments + ménisques)]

**Cas cliniques** :
- [MEDIA: 📷 PT-MOD05-006 — Radiographie patient 28 ans PTS 15°, critique biomécanicien]

---

### MODULE 4 : IMAGERIE

**Sections principales** :
- Radiographie latérale → [MEDIA: 📷 PT-MOD04-001 — Radiographie latérale genou normal, marqueurs référence cortex]
- Mesure PTS Dejour → [MEDIA: 📐 PT-MOD04-002 — Schéma technique mesure PTS (cortex postérieur vs horizontal)]
- ICC précision → [MEDIA: 📊 PT-MOD04-003 — Graphique ICC mesure radio (0.88) vs 3D-IRM (0.95)]
- Radiographie AP → [MEDIA: 📷 PT-MOD04-004 — Radiographie AP genou axes mécaniques marqués]
- IRM 3D → [MEDIA: 🧠 PT-MOD04-005 — IRM sagittale T2 FS mesure PTS 3D précise]

---

### MODULE 5-6 : LCA & TECHNIQUE

**Sections principales** :
- Diagnostic LCA → [MEDIA: 📐 PT-MOD05-006 — Algorithme décisionnel LCA (examen clinique → imaging → PTS → technique)]
- Lachman test → [MEDIA: 🖼️ PT-MOD05-007 — Illustration Lachman test (60-90° flexion, tiroir antérieur)]
- Techniques chirurgicales → [MEDIA: 📐 PT-MOD05-008 — Comparaison SB vs DB vs Hybrid (avantages/inconvénients)]
- Reconstruction → [MEDIA: 📷 PT-MOD05-009 — Radiographie post-op LCA reconstruction, tunnel bon position]

---

### MODULE 6 : PTG ALIGNEMENT

**Sections principales** :
- Alignement MA → [MEDIA: 📐 PT-MOD06-001 — Schéma alignment mécanique PTG (axe neutre 0±3°)]
- Alignement KA → [MEDIA: 📐 PT-MOD06-002 — Schéma alignment cinématique (flexion fémorale +5°, valgus +3°)]
- Alignement rKA → [MEDIA: 📐 PT-MOD06-003 — Schéma alignment restreint (compromis pragmatique, flexion +1-2°)]
- Comparaison → [MEDIA: 📊 PT-MOD06-004 — Table comparaison MA/KA/rKA (survie, précision, facilité)]

---

### MODULE 7 : SYNTHÈSE & OUTCOMES

**Sections principales** :
- Survie prothèse → [MEDIA: 📊 PT-MOD07-001 — Courbes survie PTG (registres suédois/britannique, 92-96% @ 20ans)]
- Technologies → [MEDIA: 📐 PT-MOD07-002 — Comparaison Navigation vs pSI vs Robotique (workflow, coût, précision)]
- Outcomes → [MEDIA: 📊 PT-MOD07-003 — Graphique satisfaction patient MA vs rKA (cinématique naturelle)]

---

## 🔗 Cas Cliniques — Pattern [MEDIA]

### Template Cas Clinique (chaque cas)

```markdown
## Cas n°15 — Patient 28 ans, LCA rupture chronique, PTS 14°

### Présentation
...

### Antécédents
...

### Examen Clinique
- Lachman test : +++ (positif)
- [MEDIA: 🖼️ PT-CAS-LCA-015-001 — Illustration Lachman test position]
- Anterior drawer : ++
- Pivot-shift : + (présent, cinématique instable)

### Données Imagerie

**Radiographie latérale** :
- PTS : 14° (élevé, seuil >12°)
- [MEDIA: 📷 PT-CAS-LCA-015-002 — Radiographie latérale tibia, PTS 14° mesure landmarks]

**IRM 3D** :
- LCA : rupture proximale, rétraction 1-2 cm
- [MEDIA: 🧠 PT-CAS-LCA-015-003 — IRM sagittale T2 FS, LCA rupture, hyperintense]
- Ménisque médial : déchirure radiale
- [MEDIA: 🧠 PT-CAS-LCA-015-004 — IRM coronale T2 FS, ménisque médial tear]

### Questions Progressives

**Q1 (Diagnostic)** : Quel est le diagnostic ?
→ Réponse : Rupture LCA chronique...
→ [MEDIA: 📐 PT-CAS-LCA-015-005 — Schéma anatomie LCA rupture vs intact]

**Q2 (Physiopathologie)** : Effet PTS 14° sur tension LCA ?
→ Réponse : +99% cisaillement vs normal (Maquet formula)...
→ [MEDIA: 📊 PT-CAS-LCA-015-006 — Graphique forces cisaillement patient vs normal]

**Q3 (Technique)** : Quel technique chirurgicale ?
→ Réponse : Double-bundle avec correction PTS...
→ [MEDIA: 📐 PT-CAS-LCA-015-007 — Technique DB + déflexion (Dejour approach)]

**Q4 (Synthèse)** : Plan global ?
→ Réponse : 1-stage DB reconstruction + tibial slope reduction...
→ [MEDIA: 📐 PT-CAS-LCA-015-008 — Algorithme décisionnel cas LCA+PTS élevée]

### Points Clés
...

```

---

## 📝 Checklist Intégration par Fichier

### CDC_PT_01_HISTOIRE_CONCEPTS.md
- [ ] Timeline histoire → [MEDIA: 📐]
- [ ] Distribution PTS population → [MEDIA: 📊]
- [ ] Concepts introduction → [MEDIA: 🖼️]

**Médias nécessaires** :
- `07_PTS_DISTRIBUTION_RISK.svg` ✅
- Radiographie patient weber historique

---

### CDC_PT_02_ANATOMIE_EMBRYOLOGIE.md
- [ ] Plateau tibial anatomie → [MEDIA: 📐 02_TIBIAL_PLATEAU]
- [ ] Ligaments → [MEDIA: 📐 10_KNEE_LIGAMENT_ANATOMY]
- [ ] Ménisques → [MEDIA: 🖼️]

**Médias nécessaires** :
- `02_TIBIAL_PLATEAU_ANATOMY.svg` ✅
- `10_KNEE_LIGAMENT_ANATOMY.svg` ✅

---

### CDC_PT_03_BIOMECANIQUE.md (PRIORITAIRE)
- [ ] Plan incliné → [MEDIA: 📐 03_BIOMECHANICS]
- [ ] Forces vs PTS → [MEDIA: 📊 03_BIOMECHANICS]
- [ ] Flexion interaction → [MEDIA: 📐]
- [ ] Pente effective → [MEDIA: 📐]
- [ ] Triangle stabilité → [MEDIA: 📐]

**Médias nécessaires** :
- `03_BIOMECHANICS_FORCES_LCA.svg` ✅

---

### CDC_PT_04_IMAGERIE_MESURE.md
- [ ] Radiographie latérale → [MEDIA: 📷]
- [ ] Mesure PTS Dejour → [MEDIA: 📐 01_PTS_ANGLE]
- [ ] ICC précision → [MEDIA: 📊]
- [ ] IRM 3D → [MEDIA: 🧠]

**Médias nécessaires** :
- `01_PTS_ANGLE_MEASUREMENT.svg` ✅
- 4-5 radiographies sourçées

---

### CDC_PT_05_LCA.md (TRÈS PRIORITAIRE)
- [ ] Diagnostic LCA → [MEDIA: 📐 05_DECISION_ALGORITHM]
- [ ] Examen clinique → [MEDIA: 🖼️]
- [ ] Techniques SB/DB → [MEDIA: 📐 08_SURGICAL_TECHNIQUES]
- [ ] Reconstruction → [MEDIA: 📷]

**Médias nécessaires** :
- `05_DECISION_ALGORITHM_LCA.svg` ✅
- `08_SURGICAL_TECHNIQUES_COMPARISON.svg` ✅
- 6-8 radiographies/IRM cas LCA

---

### CDC_PT_06_PTG.md
- [ ] Alignements MA/KA/rKA → [MEDIA: 📐 04_PTG_ALIGNMENTS]
- [ ] Comparison → [MEDIA: 📊]
- [ ] Technique PTG → [MEDIA: 📐]

**Médias nécessaires** :
- `04_PTG_ALIGNMENTS_MA_KA_RKA.svg` ✅

---

### CDC_PT_07_SYNTHESE_COMPLET.md
- [ ] Survie prothèse → [MEDIA: 📊 06_PTG_SURVIVAL]
- [ ] Technologies → [MEDIA: 📐 09_MODERN_TECHNOLOGIES]
- [ ] Outcomes → [MEDIA: 📊]

**Médias nécessaires** :
- `06_PTG_SURVIVAL_CURVES.svg` ✅
- `09_MODERN_TECHNOLOGIES_COMPARISON.svg` ✅

---

### CAS_CLINIQUES_PENTE_TIBIALE_PROGRESSIFS.md

**Par cas clinique** : 2-4 [MEDIA] tags
- Radiographie patient (📷)
- Schéma anatomique pertinent (📐)
- IRM si applicable (🧠)
- Algorithme décisionnel référence (📐)

**Total** : 60 cas × 3 médias = 180 [MEDIA] tags

---

### QUIZ_PENTE_TIBIALE_PROGRESSIF.md

**Questions image** : 25+ questions × 1 image = 25 [MEDIA] tags
- QCM images radiologiques
- IRM diagnostics
- Schémas avec labels à identifier

---

## 🚀 Plan Déploiement Rapide

### Phase 1 : SVG Reference Completes (✅ DONE)
- [x] 10 SVG programmés + documentés

### Phase 2 : CDC Integration (🟡 NEXT)
- [ ] CDC_PT_03, 05, 06 : full [MEDIA] integration
- Délai : 4-6 heures

### Phase 3 : Image Sourcing (📍 PARALLEL)
- [ ] Wikimedia recherche (2-3 h)
- [ ] Download + normalize (2-3 h)

### Phase 4 : Cas Cliniques + Quiz (🟡 AFTER)
- [ ] CAS_CLINIQUES : 180 [MEDIA] tags
- [ ] QUIZ : 25+ images questions
- Délai : 8-10 heures

### Phase 5 : Final QA (🟡 END)
- [ ] Validation tous liens
- [ ] Attribution sources
- [ ] Export LMS test

**Timeline total** : 24-30 heures (bien organisé)

---

## 📌 Notes Pratiques

### Remplacer Placeholder

Avant :
```markdown
> [MEDIA: 📐 MPT05-S01-001 — Décomposition vectorielle sur le plan incliné]
```

Après :
```markdown
> [MEDIA: 📐 PT-MOD05-001 — Schéma décomposition forces plan incliné (angle θ PTS, force normale P×cos, force tangentielle P×sin)]
```

### Grouper par Section

Chaque §1, §2, §3 doit avoir minimum 1 [MEDIA] tag pertinent.

### Valider Liens

Avant commit, vérifier :
- `assets/images/svg/XYZ.svg` existe
- Noms fichiers consistents
- Descriptions claires (30-50 caractères)

---

**Prêt à continuer ?** Commençons par enrichir CDC_PT_05_LCA.md (module LCA = plus d'images nécessaires).
