# NOTE TECHNIQUE — Projet de Formation en Ligne sur la Scoliose

**Référence projet** : FORM-SCOLIOSE-2025  
**Dépôt GitHub** : [https://github.com/aryad2006/scoliose](https://github.com/aryad2006/scoliose)  
**Branche principale** : `main`  
**Dernier commit** : `bd0fb44` — Sprint 3 FEM complet  
**Version du document** : v4.0 — Mars 2026  
**Auteur** : Dr Arya D. — Chirurgien orthopédiste  
**Assisté par** : GitHub Copilot (Claude Opus 4.6)

---

## 1. Objet du projet

Conception, production et déploiement d'une **formation en ligne complète et certifiante sur la scoliose**, destinée aux :

- Chirurgiens orthopédistes (en formation et en exercice)
- Neurochirurgiens rachidiens
- Médecins de rééducation (MPR)
- Kinésithérapeutes spécialisés
- Équipes paramédicales (IBODE, IADE, infirmiers de suivi)

Le projet inclut un **simulateur biomécanique interactif (VERTEX©)** basé sur la méthode des éléments finis, permettant la planification chirurgicale virtuelle et l'entraînement à la correction 3D.

### 1.1 Historique des versions

| Version | Date | Commit | Changements majeurs |
|---|---|---|---|
| v1.0 | Juil. 2025 | `b1f4483` | Création initiale : 10 fichiers, 7 719 lignes, 29 modules |
| v1.1 | Juil. 2025 | `a8af1ea` | Ajout NOTE_TECHNIQUE_PROJET.md |
| v1.2 | Juil. 2025 | `aa5526d` | Corrections structurelles (§5.5bis→§5.5, §20.4bis→§20.5), REFLEXION_FINALE |
| v2.0 | Juil. 2025 | `b003d2d` | Audit final : 22 corrections (critiques, hautes, moyennes, basses) |
| v2.5 | Fév. 2026 | `fc9b4a0` | Modules 21-24 développés en détail, PROMPTS_SCRIPTS_MEDIAS.md créé, marqueurs [MEDIA] M1 |
| v3.0 | Fév. 2026 | `a28cf3d` | Marqueurs [MEDIA] insérés dans les 29 modules (113+ marqueurs) |
| **v3.1** | **Fév. 2026** | **à commit** | **4 constats critiques résolus (ECO-01, TECH-01, XREF-01, XREF-03), §21 SaMD ajouté, MVS défini, plan validation marché** |
| v3.2 | Fév. 2026 | `fe1b09b` | Module admin complet (ADMIN_MODULE_SPECIFICATIONS.md), Module 1 rédigé (cours/) |
| v3.3 | Fév. 2026 | `ce21609` | Module 1 réécrit pédagogie active + règles écriture + script Moodle |
| v4.0 | Fév. 2026 | `5616b2b` | VERTEX spinesim complet (backend Julia + frontend Vue.js + simulation longitudinale ressort spiral) |
| v4.1 | Fév. 2026 | `e06349c` | Simulation longitudinale calibrée + rapport complet + fixes bugs 11-16 + LongitudinalPanel |
| v4.2 | Mar. 2026 | `30ddfad` | Sprint 3 FEM : rigidité géométrique, CL élimination, contraintes locales, flambage |
| v4.3 | Mar. 2026 | `f7e523f` | Cours modules 2-25, configs dev, updates frontend, documentation |
| **v4.4** | **Mar. 2026** | **à commit** | **Sprint 4-5 : géométrie 3D enrichie, PBR, caméra animée, endpoint mesures radiologiques** |

---

## 2. Périmètre fonctionnel

### 2.1 Structure pédagogique

| Élément | Quantité |
|---|---|
| Parties thématiques | 8 + VERTEX© + Évaluation |
| Modules | 29 |
| Sections détaillées | ~180 (§X.Y) |
| Durée totale estimée | ~89h15 |
| Médias catalogués | 513+ items |
| Marqueurs [MEDIA] dans le contenu | 113+ |
| Questions de quiz | 600+ (à rédiger) |
| Niveaux de difficulté | 4 (Bronze 🥉 / Argent 🥈 / Or 🥇 / Diamant 💎) |
| Examen certifiant | 3h30, surveillé (proctoring) |

### 2.2 Parties de la formation

| # | Partie | Modules | Durée | Nb sections |
|---|---|---|---|---|
| I | Fondamentaux et sciences de base | 1-3 | ~7h15 | 14 |
| II | Définition, classification et diagnostic | 4-7 | ~10h | 20 |
| III | Scoliose idiopathique | 8-10 | ~17h | 35 |
| IV | Scolioses non idiopathiques | 11-14 | ~11h30 | 25 |
| V | Techniques chirurgicales détaillées | 15-17 | ~14h30 | 20 |
| VI | Complications et gestion | 18-19 | ~5h30 | 10 |
| VII | Prise en charge globale | 20-23 | ~11h | 23 |
| VIII | Sujets spéciaux et avancés | 24-27 | ~7h | 19 |
| — | VERTEX© + Évaluation | 28-29 | ~5h30 | 14 |
| | **TOTAL** | **29** | **~89h15** | **~180** |

### 2.3 VERTEX© — Simulateur biomécanique

- **Backend** : Julia 1.10+ — HTTP.jl (API REST), FEM Euler-Bernoulli poutre 3D (23 nœuds, 138 DOF), rigidité géométrique (Przemieniecki 1968), analyse de flambage
- **Frontend** : Vue.js 3 + Three.js (WebGL 2.0) + Pinia + Chart.js + jsPDF
- **Fonctionnalités opérationnelles** : 7 pathologies, vis pédiculaires, tiges, simulation longitudinale ressort spiral, mesures radiologiques (Cobb, SVA, cyphose, lordose, balance coronale), rapports cliniques, authentification JWT
- **Rendu 3D** : ExtrudeGeometry réniforme, pédicules, lamines, processus transverses, facettes articulaires, matériaux PBR avec environment map procédurale
- **Spécifications complètes** : 20 sections, 1 650 lignes

---

## 3. Inventaire des livrables (dépôt Git)

Le dépôt contient **14 documents** totalisant **8 710 lignes** de contenu structuré :

| # | Fichier | Lignes | Rôle |
|---|---|---|---|
| 1 | `PLAN_FORMATION_SCOLIOSE.md` | 2 716 | Plan maître : 29 modules détaillés, objectifs, quiz, certification, 113+ marqueurs [MEDIA] |
| 2 | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` | 1 650 | Spécifications complètes VERTEX© : architecture Julia/WebGL, FEM, sécurité, CI/CD, analytics |
| 3 | `PROMPTS_SCRIPTS_MEDIAS.md` | 957 | Prompts prêts à l'emploi pour BioRender, Runway Gen-3, BioDigital, HeyGen + workflow |
| 4 | `MEDIAS_PRODUCTION_SCOLIOSE.md` | 776 | Catalogue de 513+ médias : images, vidéos, animations 3D, simulations |
| 5 | `AUDIT_COMPLET_PROJET.md` | 549 | Audit qualité : 47 constats (7 critiques, 15 hauts, 16 moyens, 9 bas) |
| 6 | `AUDIT_FINAL_VERIFICATION.md` | 310 | Audit final : 22 constats — **tous corrigés (22/22)** |
| 7 | `CAHIER_DES_CHARGES_LMS.md` | 292 | Cahier des charges LMS : xAPI, SCORM, 6 formules tarifaires, accessibilité |
| 8 | `NOTE_TECHNIQUE_PROJET.md` | ~340 | Ce document — synthèse technique complète et à jour |
| 9 | `GUIDE_FORMATEUR.md` | 247 | Guide du tuteur/formateur : rôles, animation, KPI, checklists |
| 10 | `CALENDRIER_PRODUCTION.md` | 229 | Calendrier intégré : 40 mois, 6 chantiers parallèles, 15 jalons |
| 11 | `BIBLIOGRAPHIE_COMPLETE.md` | 195 | 130 références bibliographiques classées par partie et module |
| 12 | `MODELE_ECONOMIQUE.md` | 193 | Modèle SaaS : 5 paliers tarifaires, projections à 5 ans, ARR 2,52 M€ |
| 13 | `BUDGET_GLOBAL_FORMATION.md` | 188 | Budget détaillé : 4 695–6 835 K€ sur 40 mois, 8 postes |
| 14 | `REFLEXION_FINALE_STRATEGIQUE.md` | 169 | Réflexion stratégique : 5 questions clés, 10 lacunes, évaluation honnête |

### 3.1 Évolution du dépôt

| Métrique | v1.0 (Jul 2025) | v3.0 (Fév 2026) | Évolution |
|---|---|---|---|
| Fichiers | 10 | 14 | +40% |
| Lignes totales | 7 719 | 8 710 | +13% |
| PLAN_FORMATION | 2 223 lignes | 2 716 lignes | +22% (M21-24 développés, marqueurs [MEDIA]) |
| Corrections appliquées | — | 69 (47 audit #1 + 22 audit #2) | — |
| Marqueurs [MEDIA] | 0 | 113+ | Nouveauté |
| Prompts médias | 0 | 957 lignes | Nouveau fichier |

---

## 4. Architecture technique cible

```
┌─────────────────────────────────────────────────────────────┐
│                    UTILISATEURS FINAUX                       │
│   Navigateur web (Chrome/Edge/Firefox) + Casque VR (opt.)   │
└────────────────────────────┬────────────────────────────────┘
                             │ HTTPS / WSS
┌────────────────────────────▼────────────────────────────────┐
│                      CDN / WAF / LB                         │
│              (CloudFlare / AWS CloudFront)                   │
└────────────────────────────┬────────────────────────────────┘
                             │
        ┌────────────────────┼────────────────────┐
        ▼                    ▼                    ▼
┌───────────────┐  ┌─────────────────┐  ┌─────────────────┐
│  LMS Platform │  │  VERTEX©  API │  │  Media Server   │
│  (Moodle/     │  │  (Genie.jl)     │  │  (Streaming     │
│   Canvas/     │  │  + FEM Engine   │  │   vidéo/3D)     │
│   Custom)     │  │  + CUDA GPU     │  │                 │
│               │  │  + WebSocket    │  │                 │
└───────┬───────┘  └────────┬────────┘  └────────┬────────┘
        │                   │                    │
        ▼                   ▼                    ▼
┌─────────────────────────────────────────────────────────────┐
│              Base de données / Stockage                      │
│  PostgreSQL 17 (users, progress, analytics)                  │
│  Redis Cluster (sessions, cache)                             │
│  S3/MinIO (médias, DICOM anonymisés)                         │
│  TimescaleDB (learning analytics)                            │
└─────────────────────────────────────────────────────────────┘
```

---

## 5. Production des médias

### 5.1 Outils de production retenus

| Outil | Usage principal | Médias | Prompts prêts |
|---|---|---|---|
| **BioRender** | Illustrations anatomiques, schémas biomécaniques, infographies | ~215 📐📊 | ✅ 15+ prompts détaillés |
| **Runway Gen-3 Alpha** | Animations vidéo 2D/3D médicales | ~90 🎬 | ✅ 12+ prompts détaillés |
| **BioDigital Human** | Modèles anatomiques 3D interactifs (WebGL embed) | ~8 🧊 | ✅ 7 configurations |
| **HeyGen** | Présentateur IA, narration, slides narrées | ~330 🎥 | ✅ 6 scripts (intro + modules) |
| **VERTEX©** | Captures de simulation, démonstrations FEM | ~70 | Scripts à produire en phase dev |
| **Tournage réel** | Vidéos chirurgicales, examens cliniques | ~35 🎥 | Planning à établir |
| **DaVinci Resolve** | Post-production, montage, sous-titres | — | Workflow défini |

### 5.2 Pipeline de production

```
ÉTAPE 1 — Création des assets bruts
  BioRender → PNG/SVG (📐 📊)
  Runway Gen-3 → Clips MP4 10-15s (🎬)
  BioDigital → Modèles 3D embed WebGL (🧊)
  Tournage → Vidéos chirurgicales HD (📷 🎥)
        ↓
ÉTAPE 2 — Post-production (DaVinci Resolve)
  Montage, légendes FR, color grading médical, export 1080p
        ↓
ÉTAPE 3 — Narration (HeyGen)
  Avatar médecin, introductions modules, slides narrées
        ↓
ÉTAPE 4 — Intégration LMS
  Upload SCORM/xAPI, iframes BioDigital, tracking analytics
```

### 5.3 Marqueurs [MEDIA] dans le contenu

Le PLAN_FORMATION contient **113+ marqueurs** `[MEDIA: 🎬/📐/📊/🧊 MXX-SYY-ZZZ — Description]` positionnés à l'emplacement exact de chaque média dans le flux pédagogique. Format :

```
> [MEDIA: 🎬 M01-S04-004 — Animation artère d'Adamkiewicz (CRITIQUE chirurgie)]
```

### 5.4 Budget médias

| Outil | Licence/an | Commentaire |
|---|---|---|
| BioRender | 2 000–5 000 € | Académique/Institutional |
| Runway Gen-3 | 1 200–3 600 € | Pro unlimited |
| BioDigital | 5 000–15 000 € | Enterprise/API SDK |
| HeyGen | 3 000–6 000 € | Enterprise |
| DaVinci Resolve Studio | 295 € (unique) | Licence perpétuelle |
| **Total outils médias** | **~11 500–30 000 €/an** | Sur 18 mois de production |

---

## 6. Résultats des audits qualité

### 6.1 Audit #1 — Complet (47 constats)

| Sévérité | Nombre | Statut |
|---|---|---|
| 🔴 CRITIQUE | 7 | 3 résolus (STRUCT-01 invalide, STRUCT-02, XREF-04), 4 ouverts |
| 🟠 HAUT | 15 | 12 résolus, 3 ouverts |
| 🟡 MOYEN | 16 | 10 résolus, 6 ouverts |
| 🟢 BAS | 9 | 5 résolus, 4 ouverts |
| **Total** | **47** | **30 résolus / 17 ouverts** |

#### Constats critiques restants : **0/4 — TOUS RÉSOLUS** ✅

| Réf. | Constat | Action réalisée | Statut |
|---|---|---|---|
| ECO-01 | Pas de validation marché (étude / focus groups) | Plan de validation défini dans `MODELE_ECONOMIQUE.md` §8 : 40 interviews, landing page, pricing test, Go/No-Go | ✅ |
| TECH-01 | Pas de stratégie SaMD pour VERTEX© | Section §21 ajoutée dans `VERTEX_SPECIFICATIONS_TECHNIQUES.md` : Phase 1 « educational only », Phase 2 SaMD optionnelle avec critères de déclenchement | ✅ |
| XREF-01 | Seuil de rentabilité inconsistant budget vs modèle éco. | Harmonisé : break-even opérationnel An 3 vs cumulé An 5, notes d'harmonisation dans les deux documents | ✅ |
| XREF-03 | VERTEX v1.0 mois 40, intégration LMS mois 18 → MVS non défini | MVS défini dans `CALENDRIER_PRODUCTION.md` : features incluses (FEM, 11 pathologies, vis, WebGL) et exclues (VR, haptique, import DICOM) au mois 22 | ✅ |

### 6.2 Audit #2 — Vérification finale (22 constats)

| Sévérité | Nombre | Statut |
|---|---|---|
| 🔴 CRITIQUE | 3 | ✅ 3/3 corrigés |
| 🟠 HAUTE | 8 | ✅ 8/8 corrigés |
| 🟡 MOYENNE | 6 | ✅ 6/6 corrigés |
| 🟢 BASSE | 5 | ✅ 5/5 corrigés |
| **Total** | **22** | **✅ 22/22 TOUS CORRIGÉS** |

Corrections majeures appliquées :
- `640+` → `600+` questions dans 6 fichiers
- Tableau des Parties NOTE_TECHNIQUE entièrement reécrit
- Budget NOTE_TECHNIQUE aligné sur BUDGET_GLOBAL
- Bibliographie : 7 mappings modules corrigés (Parties VII/VIII)
- Formule « Essentiel » (290€) ajoutée au CAHIER_DES_CHARGES_LMS
- ARR An 5 corrigé : 2 500 000 → 2 520 000 €
- Notes d'harmonisation churn mensuel/annuel ajoutées
- Typos corrigés : narrées, praticien, ref 101

---

## 7. Pile technologique complète

### 7.1 VERTEX© — Backend

| Composant | Technologie | Version |
|---|---|---|
| Langage principal | Julia | 1.10+ |
| Framework web | Genie.jl | Latest |
| FEM (éléments finis) | FinEtools.jl + Ferrite.jl | Latest |
| Calcul GPU | CUDA.jl | 5.x |
| Traitement d'images | DICOM.jl + Images.jl | Latest |
| Base de données | LibPQ.jl (PostgreSQL) | Latest |
| Cache | Redis.jl | Latest |
| Tests | Test (stdlib) + Aqua.jl | Latest |
| CI/CD | GitHub Actions | — |

### 7.2 VERTEX© — Frontend (implémenté)

| Composant | Technologie | Version |
|---|---|---|
| Rendu 3D | Three.js + WebGL 2.0 | 0.162 |
| Framework UI | Vue.js 3 (Composition API) | 3.4 |
| Bundler | Vite | 5.1 |
| State management | Pinia | 2.1 |
| Graphiques | Chart.js | 4.x |
| Export PDF | jsPDF + html2canvas | Latest |
| Tests E2E | Playwright | Latest |
| API HTTP | Axios | Latest |

### 7.3 Infrastructure

| Composant | Technologie |
|---|---|
| Cloud | AWS / Azure / OVHCloud (conformité RGPD) |
| Conteneurisation | Docker + Kubernetes |
| BDD principale | PostgreSQL 17 |
| BDD analytique | TimescaleDB |
| Cache / Sessions | Redis Cluster |
| Stockage objets | S3 / MinIO |
| CDN | CloudFront / CloudFlare |
| Monitoring | Prometheus + Grafana |
| Logs | ELK Stack (Elasticsearch, Logstash, Kibana) |
| Secrets | HashiCorp Vault |

---

## 8. Modèle économique synthétique

### 8.1 Tarification (6 formules)

| Formule | Contenu | Prix | Durée |
|---|---|---|---|
| **Découverte** | Modules 1-3 | Gratuit | Illimité |
| **Essentiel** | Modules 1-14 | 290 € | 12 mois |
| **Standard** | Tous modules sans VERTEX | 490 € | 12 mois |
| **Premium** | Tous + VERTEX + VR | 890 € | 12 mois |
| **Certification** | Premium + examen + certificat | 1 190 € | 12 mois |
| **Institutionnel** | Licence par siège (min 10) | 590 €/siège | 12 mois |

### 8.2 Projections financières (hypothèse médiane)

| Année | Praticiens actifs | CA Total | Résultat net |
|---|---|---|---|
| An 1 | 400 | 305 000 € | -1 195 000 € |
| An 2 | 900 | 630 000 € | -70 000 € |
| **An 3** | **1 500** | **1 150 000 €** | **+500 000 €** |
| An 4 | 2 200 | 1 770 000 € | +1 120 000 € |
| An 5 | 3 000 | 2 550 000 € | +1 850 000 € |

### 8.3 KPI SaaS cibles (An 5)

| Métrique | Valeur cible |
|---|---|
| ARR | 2 520 000 € |
| Panier moyen | ~772 € |
| LTV/CAC | 21x |
| Churn mensuel | 2,5% |
| NPS | 65 |

---

## 9. Budget synthétique

| Poste | Montant estimé | Part |
|---|---|---|
| Développement VERTEX© | 3 600–5 000 K€ | ~75% |
| Plateforme LMS | 300–500 K€ | ~7% |
| Production médias | 250–400 K€ | ~5% |
| Contenu pédagogique | 180–280 K€ | ~4% |
| Ressources humaines | 200–350 K€ | ~4% |
| Marketing et lancement | 80–150 K€ | ~2% |
| Certification et réglementaire | 50–100 K€ | ~1% |
| Infrastructure (an 1) | 35–55 K€ | ~1% |
| **TOTAL** | **4 695–6 835 K€** | **100%** |

---

## 10. Calendrier macroscopique (40 mois)

```
Mois 1-4     ██████░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░  Cadrage & conception
Mois 5-12    ░░░░██████████░░░░░░░░░░░░░░░░░░░░░░░░░░░  Production Parties I-III
Mois 10-18   ░░░░░░░░░████████████░░░░░░░░░░░░░░░░░░░░  Production Parties IV-VIII
Mois 14-22   ░░░░░░░░░░░░░░████████████░░░░░░░░░░░░░░░  Intégration LMS + Beta
Mois 6-40    ░░░░░██████████████████████████████████░░░  Développement VERTEX©
Mois 20-22   ░░░░░░░░░░░░░░░░░░░████░░░░░░░░░░░░░░░░░  Tests & certification
Mois 22      ░░░░░░░░░░░░░░░░░░░░░█░░░░░░░░░░░░░░░░░░  🚀 LANCEMENT
Mois 23-40   ░░░░░░░░░░░░░░░░░░░░░░██████████████████░  Exploitation & évolution
```

---

## 11. Conformité et réglementation

| Domaine | Exigence | Statut |
|---|---|---|
| Protection des données | RGPD (UE) + HDS (Hébergement Données de Santé) | 🟡 À implémenter |
| Accessibilité | WCAG 2.1 AA | 🟡 Spécifié dans CdC LMS |
| Interopérabilité LMS | xAPI 1.0.3 + SCORM 2004 4th Ed. | 🟡 Spécifié dans CdC LMS |
| Dispositif médical | Classification SaMD (si VERTEX© clinique) | ✅ Phase 1 « educational only », Phase 2 SaMD optionnelle (§21 VERTEX) |
| Formation continue | Agrément DPC (France) / CME (international) | 🟡 À demander |
| Certification qualité | ISO 27001 (sécurité), ISO 9001 (qualité) | 🟡 Objectif An 2 |

---

## 12. État d'avancement et prochaines étapes

### 12.1 Travaux réalisés

| # | Livrable | Statut |
|---|---|---|
| 1 | Plan de formation 29 modules (~89h, 2 716 lignes) | ✅ Complet |
| 2 | VERTEX© spécifications techniques (1 650 lignes) | ✅ Complet |
| 3 | Catalogue médias (513+ items) | ✅ Complet |
| 4 | Cahier des charges LMS (292 lignes) | ✅ Complet |
| 5 | Budget global (4 695–6 835 K€) | ✅ Complet |
| 6 | Calendrier production (40 mois) | ✅ Complet |
| 7 | Modèle économique SaaS | ✅ Complet |
| 8 | Guide formateur | ✅ Complet |
| 9 | Bibliographie (130 références) | ✅ Complet |
| 10 | Audit complet + audit final (69 constats au total) | ✅ Complet |
| 11 | Réflexion stratégique | ✅ Complet |
| 12 | Modules 21-24 développés en profondeur | ✅ Complet |
| 13 | Prompts/scripts BioRender, Runway, BioDigital, HeyGen | ✅ Complet |
| 14 | Marqueurs [MEDIA] dans les 29 modules (113+) | ✅ Complet |
| 15 | Module admin — spécifications complètes (17 sections, 280 j-h) | ✅ Complet |
| 16 | Contenu Module 1 — Anatomie du rachis (cours/) | ✅ Complet |
| 17 | VERTEX© backend Julia opérationnel (16+ endpoints REST, FEM, 7 pathologies) | ✅ Complet |
| 18 | VERTEX© frontend Vue.js + Three.js (rendu 3D PBR, 9 composants, 2 dashboards) | ✅ Complet |
| 19 | Simulation longitudinale ressort spiral (calibrée, résultats cliniques validés) | ✅ Complet |
| 20 | Sprint 3 FEM — rigidité géométrique, CL élimination, contraintes locales, flambage | ✅ Complet |
| 21 | Sprint 4 — Géométrie 3D enrichie (lamines, transverses, facettes), PBR, caméra animée | ✅ Complet |
| 22 | Sprint 5 — Endpoint mesures radiologiques (Cobb, SVA, cyphose, lordose, balance coronale) | ✅ Complet |
| 23 | Modules de cours 2-25 rédigés (cours/) | ✅ Complet |

### 12.2 Prochaines étapes

| Priorité | Action | Effort estimé |
|---|---|---|
| **P0** | Rédaction du contenu pédagogique détaillé (slides narrées, scripts vidéo) | 3-6 mois |
| **P0** | Exécution du plan de validation marché (40 interviews + landing page) | 3 mois |
| **P1** | Rédaction de la banque de 600+ questions quiz (après contenu) | 2-3 semaines |
| **P2** | Étude de marché / validation auprès de chirurgiens | 1-2 mois |
| **P2** | Sélection et contractualisation LMS | 1-2 mois |
| **P3** | Production effective des médias (BioRender, Runway, BioDigital, HeyGen) | 12-18 mois |
| **P3** | Dossier réglementaire SaMD pour VERTEX© | 2-4 mois |
| **P4** | Recrutement équipe de développement VERTEX© (Julia/WebGL) | 2-3 mois |
| **P4** | Recherche de financement (BPI, VCs HealthTech, ANR) | 3-6 mois |

---

## 13. Informations Git

```
Dépôt      : https://github.com/aryad2006/scoliose.git
Branche    : main
Commit     : a28cf3d (Février 2026)
Fichiers   : 14 documents Markdown
Volume     : 8 710 lignes
Commits    : 6 (b1f4483 → a8af1ea → aa5526d → b003d2d → fc9b4a0 → a28cf3d)
Licence    : À définir (propriétaire recommandé)
```

---

## 14. Contact

**Porteur de projet** : Dr Arya D.  
**Dépôt** : [github.com/aryad2006/scoliose](https://github.com/aryad2006/scoliose)

---

*Note technique v3.2 — Février 2026 — 16 fichiers, ~10 200 lignes, 29 modules, ~89h15*

---

*Document généré le 2025-07-13 — v1.0*
