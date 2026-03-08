# CAHIER DES CHARGES — FORMATION COMPLÈTE SUR L'INFECTION OSSEUSE ET ARTICULAIRE DE L'APPAREIL LOCOMOTEUR (IOA)

## Partie 0 — Introduction générale, Charte graphique et Architecture pédagogique

**Date** : 8 mars 2026
**Version** : 1.0
**Statut** : Document fondateur — Cahier des charges complet
**Plateforme** : VERTEX© — Formation médicale en ligne
**Formation** : Infection Osseuse et Articulaire de l'Appareil Locomoteur (IOA) — *Musculoskeletal Infections*

---

# TABLE DES MATIÈRES — PARTIE 0

1. [Synthèse exécutive](#1-synthèse-exécutive)
2. [Public cible et prérequis](#2-public-cible-et-prérequis)
3. [Architecture pédagogique globale](#3-architecture-pédagogique-globale)
4. [Charte graphique unifiée — Plateforme VERTEX©](#4-charte-graphique-unifiée--plateforme-vertex)
5. [Code couleur tri-formation (Scoliose + PTG + IOA)](#5-code-couleur-tri-formation-scoliose--ptg--ioa)
6. [Règles d'écriture du contenu](#6-règles-décriture-du-contenu)
7. [Structure des fichiers du CDC](#7-structure-des-fichiers-du-cdc)
8. [Correspondance inter-formations](#8-correspondance-inter-formations)

---

# 1. SYNTHÈSE EXÉCUTIVE

## 1.1 Ce qu'est cette formation

La **Formation Infection Osseuse et Articulaire (IOA)** est un programme e-learning complet destiné aux chirurgiens orthopédistes, infectiologues, microbiologistes et médecins impliqués dans la prise en charge des infections de l'appareil locomoteur, couvrant **l'intégralité** du sujet — de l'histoire des infections osseuses à l'antibiothérapie de pointe, en passant par la physiopathologie du biofilm, le diagnostic microbiologique avancé, les techniques chirurgicales de débridement et de reconstruction, et les cas complexes multirécidivants.

Elle constitue la **troisième formation** de la plateforme VERTEX©, après la Formation Scoliose (25 modules, ~75h) et la Formation PTG (28 modules, ~80h). Les trois formations partagent :

- La même **plateforme LMS** (architecture, authentification, évaluation)
- La même **charte graphique** de base (typographie, mise en page, icônes)
- Les mêmes **règles d'écriture pédagogique** (cas cliniques, mnémoniques, niveaux de profondeur)
- Les mêmes **standards d'évaluation** (Bronze → Diamant, cas cliniques progressifs)
- Le même **moteur de simulation** VERTEX© (adapté : InfectoSim© pour la modélisation de diffusion antibiotique, cinétique du biofilm, planification chirurgicale)

## 1.2 Périmètre de la formation IOA

| Dimension | Détail |
|---|---|
| **Nombre de modules** | 30 modules organisés en 9 parties |
| **Durée estimée** | ~85-95 heures de contenu |
| **Niveau** | Interne avancé → chirurgien confirmé → expert |
| **Spécialités** | Chirurgie orthopédique, infectiologie, microbiologie, médecine interne |
| **Couverture** | Histoire, microbiologie, physiopathologie, biofilm, immunologie, ostéomyélite (enfant/adulte), arthrite septique, infections sur matériel, infections du rachis, infections du pied diabétique, tuberculose ostéoarticulaire, infections fongiques/parasitaires, diagnostic biologique/imagerie, antibiothérapie, traitement chirurgical, reconstruction, prévention, recherche |
| **Simulation** | InfectoSim© — module VERTEX© dédié (cinétique antibiotique, modélisation du biofilm, planification de débridement 3D) |
| **Certification** | Certificat VERTEX© IOA, éligible DPC/CME |
| **Langue** | Français (traduction EN/ES/AR prévue) |

## 1.3 Objectifs pédagogiques globaux

À l'issue de cette formation, le praticien sera capable de :

1. **Retracer** l'histoire des infections osseuses et comprendre l'évolution des concepts physiopathologiques et thérapeutiques
2. **Maîtriser** la microbiologie des infections ostéoarticulaires (bactériologie, biofilm, résistances, mycobactéries, champignons)
3. **Expliquer** la physiopathologie de l'infection osseuse (voies de contamination, séquestration, nécrose, biofilm, immunité locale)
4. **Diagnostiquer** une infection ostéoarticulaire en utilisant les outils cliniques, biologiques, d'imagerie et microbiologiques de manière appropriée
5. **Classifier** les infections selon les systèmes reconnus (Cierny-Mader, McPherson, Tsukayama, etc.)
6. **Prescrire** une antibiothérapie adaptée (probabiliste puis documentée, durée, voie, combinaisons, spécificités de l'os)
7. **Planifier et réaliser** le traitement chirurgical (débridement, séquestrectomie, DAIR, changement en 1 ou 2 temps, techniques de comblement, lambaux, fixation externe)
8. **Gérer** les situations complexes (infections multirécidivantes, germes multirésistants, terrain fragile, ostéomyélite chronique, amputation)
9. **Prévenir** les infections ostéoarticulaires (antibioprophylaxie, mesures environnementales, ciment chargé)
10. **Intégrer** les innovations (phagothérapie, peptides antimicrobiens, ciments/spacers intelligents, détection moléculaire rapide, IA diagnostique)

---

# 2. PUBLIC CIBLE ET PRÉREQUIS

## 2.1 Public cible

| Niveau | Public | Modules obligatoires | Modules optionnels |
|---|---|---|---|
| **Niveau 1 — Fondamental** | Internes orthopédie/infectiologie, médecins généralistes, urgentistes | Modules 1-10, 15-17, 25-26 | 27-28 |
| **Niveau 2 — Intermédiaire** | Résidents séniors, CCA, chirurgiens en début de pratique, infectiologues | Modules 1-22, 25-26 | 23-24, 27-30 |
| **Niveau 3 — Expert** | Chirurgiens septiques confirmés, référents IOA, chercheurs | Modules 1-30 (intégralité) | — |

## 2.2 Prérequis

- Diplôme de médecine (ou en cours d'obtention)
- Connaissances de base en anatomie de l'appareil locomoteur
- Connaissances de base en microbiologie (souhaitées mais non obligatoires — le Module 3 couvre les fondamentaux)
- Connaissances de base en pharmacologie des antibiotiques (souhaitées — le Module 7 reprend les bases)

---

# 3. ARCHITECTURE PÉDAGOGIQUE GLOBALE

## 3.1 Organisation en 9 parties — 30 modules

```
FORMATION IOA — INFECTION OSSEUSE ET ARTICULAIRE DE L'APPAREIL LOCOMOTEUR
│
├── PARTIE I — HISTOIRE ET FONDAMENTAUX (Modules 1-4)
│   ├── Module 1  : Histoire des infections osseuses — Des origines à l'ère moderne
│   ├── Module 2  : Anatomie et vascularisation osseuse appliquées à l'infection
│   ├── Module 3  : Microbiologie des infections ostéoarticulaires
│   └── Module 4  : Physiopathologie de l'infection osseuse et biofilm
│
├── PARTIE II — IMMUNOLOGIE ET TERRAIN (Modules 5-6)
│   ├── Module 5  : Immunologie de l'os et réponse de l'hôte
│   └── Module 6  : Facteurs de risque et terrain — Diabète, immunodépression, dénutrition
│
├── PARTIE III — DIAGNOSTIC (Modules 7-10)
│   ├── Module 7  : Diagnostic clinique et biologique des IOA
│   ├── Module 8  : Imagerie des infections ostéoarticulaires
│   ├── Module 9  : Diagnostic microbiologique — Prélèvements, cultures, biologie moléculaire
│   └── Module 10 : Classifications des infections osseuses et articulaires
│
├── PARTIE IV — ANTIBIOTHÉRAPIE (Modules 11-13)
│   ├── Module 11 : Pharmacologie des antibiotiques en contexte osseux
│   ├── Module 12 : Antibiothérapie probabiliste et documentée des IOA
│   └── Module 13 : Antibiotiques locaux — Ciment, spacers, billes, coatings
│
├── PARTIE V — OSTÉOMYÉLITE (Modules 14-17)
│   ├── Module 14 : Ostéomyélite aiguë hématogène de l'enfant
│   ├── Module 15 : Ostéomyélite aiguë et subaiguë de l'adulte
│   ├── Module 16 : Ostéomyélite chronique — Physiopathologie et traitement
│   └── Module 17 : Ostéomyélite post-traumatique et sur fracture ouverte
│
├── PARTIE VI — ARTHRITE SEPTIQUE ET INFECTIONS PÉRIPROTHÉTIQUES (Modules 18-21)
│   ├── Module 18 : Arthrite septique native — Diagnostic et traitement
│   ├── Module 19 : Infection périprothétique — Diagnostic et classification
│   ├── Module 20 : Infection périprothétique — DAIR et changement en un temps
│   └── Module 21 : Infection périprothétique — Changement en deux temps et sauvetage
│
├── PARTIE VII — INFECTIONS SPÉCIFIQUES (Modules 22-25)
│   ├── Module 22 : Infections du rachis — Spondylodiscite et abcès épidural
│   ├── Module 23 : Infections du pied diabétique — Du mal perforant à l'amputation
│   ├── Module 24 : Tuberculose ostéoarticulaire — Du mal de Pott aux atteintes périphériques
│   └── Module 25 : Infections fongiques, parasitaires et à mycobactéries atypiques
│
├── PARTIE VIII — TECHNIQUES CHIRURGICALES ET RECONSTRUCTION (Modules 26-28)
│   ├── Module 26 : Principes chirurgicaux du traitement des IOA — Débridement, séquestrectomie
│   ├── Module 27 : Reconstruction osseuse après infection — Masquelet, transport osseux, greffes
│   └── Module 28 : Couverture des tissus mous — Lambeaux et chirurgie plastique en contexte septique
│
└── PARTIE IX — PRÉVENTION, RECHERCHE ET INNOVATIONS (Modules 29-30)
    ├── Module 29 : Prévention des infections ostéoarticulaires — Antibioprophylaxie et environnement
    └── Module 30 : Recherche et innovations — Phagothérapie, peptides antimicrobiens, IA, biomatériaux
```

## 3.2 Structure standardisée de chaque module

Chaque module suit le **même format** que les Formations Scoliose et PTG (cf. `REGLES_ECRITURE_CONTENU.md`) :

1. **En-tête** : titre, partie, durée, niveau, prérequis
2. **Accroche clinique** : vignette patient ou mise en situation réelle (3-5 lignes)
3. **Objectifs d'apprentissage** : 3-7 objectifs (verbes de Bloom)
4. **Sections de contenu** : 3-6 sections principales
5. **Points clés** : 5-8 messages essentiels
6. **Auto-évaluation** : 5-10 questions (QCM, QROC, cas clinique)
7. **Références bibliographiques** : sources vérifiables

## 3.3 Parcours praticien — Déblocage séquentiel

```
Module 1 → Module 2 → Module 3 → Module 4
                                       ↓
                  Module 5 → Module 6
                                 ↓
Module 7 → Module 8 → Module 9 → Module 10
                                       ↓
          Module 11 → Module 12 → Module 13
                                       ↓
Module 14 → Module 15 → Module 16 → Module 17
                                         ↓
Module 18 → Module 19 → Module 20 → Module 21
                                         ↓
Module 22 → Module 23 → Module 24 → Module 25
                                         ↓
          Module 26 → Module 27 → Module 28
                                       ↓
                  Module 29 → Module 30
```

- Score ≥ 70% requis pour passer au module suivant
- 2 tentatives autorisées par quiz
- Feedback immédiat avec explication et référence bibliographique

## 3.4 Système de quiz — Difficulté progressive (identique aux autres formations)

| Niveau | Icône | Type de question | % du quiz |
|---|---|---|---|
| **Bronze** | 🥉 | Connaissance pure (rappel, définitions) | 30% |
| **Argent** | 🥈 | Compréhension et application (cas simples) | 30% |
| **Or** | 🥇 | Analyse et raisonnement clinique (cas complexes) | 25% |
| **Diamant** | 💎 | Synthèse et décision médico-chirurgicale (scénarios multi-facteurs) | 15% |

---

# 4. CHARTE GRAPHIQUE UNIFIÉE — PLATEFORME VERTEX©

## 4.1 Identité visuelle de la plateforme

La plateforme VERTEX© repose sur une identité visuelle **commune** à toutes les formations, garantissant la cohérence et la reconnaissance de marque.

### 4.1.1 Typographie (identique aux autres formations)

| Usage | Police | Poids | Taille |
|---|---|---|---|
| **Titres de partie (H1)** | Montserrat | Bold (700) | 32-36px |
| **Titres de module (H2)** | Montserrat | SemiBold (600) | 26-30px |
| **Titres de section (H3)** | Montserrat | Medium (500) | 22-24px |
| **Sous-sections (H4)** | Open Sans | SemiBold (600) | 18-20px |
| **Corps de texte** | Open Sans | Regular (400) | 16px, line-height 1.6 |
| **Légendes / notes** | Open Sans | Light (300) | 14px |
| **Code / formules** | JetBrains Mono | Regular | 14px |

### 4.1.2 Mise en page (identique aux autres formations)

| Élément | Spécification |
|---|---|
| **Largeur max contenu** | 900px (centré) |
| **Marges latérales** | 60px minimum (responsive) |
| **Espacement inter-sections** | 48px |
| **Espacement inter-paragraphes** | 24px |
| **Bordures d'encadrés** | 3px solid, border-radius 8px |
| **Ombres** | box-shadow: 0 2px 8px rgba(0,0,0,0.08) |
| **Coins arrondis** | 8px (encadrés), 12px (cartes), 50% (avatars) |

### 4.1.3 Iconographie (identique aux autres formations)

| Icône | Usage | Emoji / SVG |
|---|---|---|
| 🏥 | Pertinence clinique | Orange |
| ⚠️ | Danger / Critique | Rouge |
| 📖 | Approfondissement | Bleu |
| 💡 | Astuce / Mnémonique | Vert clair |
| 🔬 | Expert | Violet |
| 🤔 | Réflexion | Jaune |
| 🧊 | Modèle 3D | Cyan |
| 📐 | Schéma | Gris-bleu |
| 🎬 | Animation / Vidéo | Rouge-orange |
| 📊 | Infographie | Vert |
| 📷 | Photo clinique | Gris |
| 🦠 | Microbiologie (spécifique IOA) | Vert-jaune |
| 💊 | Antibiothérapie (spécifique IOA) | Bleu-violet |

## 4.2 Principes de design communs (identiques)

| Principe | Description |
|---|---|
| **Clarté** | Hiérarchie visuelle claire — titres, sous-titres, corps de texte immédiatement distinguables |
| **Cohérence** | Mêmes composants UI, mêmes encadrés, mêmes icônes pour toutes les formations |
| **Accessibilité** | Contraste AAA (WCAG 2.1), polices lisibles, alt-text sur toutes les images |
| **Professionnalisme médical** | Tons sobres et sérieux, pas de couleurs criardes, images HD |
| **Responsive** | Adapté desktop (70% des usages), tablette (25%), mobile (5%) |

---

# 5. CODE COULEUR TRI-FORMATION (SCOLIOSE + PTG + IOA)

## 5.1 Palette principale par formation

Chaque formation possède sa **couleur dominante** qui l'identifie immédiatement sur la plateforme.

### Formation Scoliose 🦴

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Dominante** | Bleu profond (Cobalt médical) | `#1A5276` | En-têtes H1, bandeau supérieur, sidebar |
| **Accent** | Bleu ciel | `#2E86C1` | Liens, boutons primaires, icônes actives |
| **Secondaire** | Bleu-gris | `#85929E` | Texte secondaire, bordures |
| **Fond principal** | Blanc cassé | `#FAFCFE` | Fond de page |
| **Fond encadré** | Bleu très pâle | `#EBF5FB` | Fond des encadrés 📖 |

### Formation PTG 🦵

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Dominante** | Vert émeraude (Chirurgical) | `#0E6655` | En-têtes H1, bandeau supérieur, sidebar |
| **Accent** | Vert jade | `#1ABC9C` | Liens, boutons primaires, icônes actives |
| **Secondaire** | Vert-gris | `#7DCEA0` | Texte secondaire, bordures |
| **Fond principal** | Blanc cassé | `#FAFEFA` | Fond de page |
| **Fond encadré** | Vert très pâle | `#E8F8F5` | Fond des encadrés 📖 |

### Formation IOA 🦠

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Dominante** | Rouge bordeaux (Infectiologie) | `#922B21` | En-têtes H1, bandeau supérieur, sidebar |
| **Accent** | Rouge corail | `#E74C3C` | Liens, boutons primaires, icônes actives |
| **Secondaire** | Rouge-gris | `#CD6155` | Texte secondaire, bordures |
| **Fond principal** | Blanc cassé rosé | `#FEF9F8` | Fond de page |
| **Fond encadré** | Rouge très pâle | `#FDEDEC` | Fond des encadrés 📖 |
| **Succès** | Vert médical | `#27AE60` | Validations, scores positifs (commun) |
| **Alerte** | Jaune sécurité | `#F39C12` | Alertes spécifiques IOA (résistance, allergie) |

> **Justification du rouge bordeaux** : Le rouge bordeaux évoque le monde de l'infectiologie (alerte, urgence, sang, inflammation) tout en restant sobre et professionnel. Il se distingue clairement du bleu (Scoliose) et du vert (PTG), permettant une identification instantanée de la formation.

### Éléments communs (partagés entre les 3 formations)

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Texte principal** | Noir doux | `#2C3E50` | Corps de texte, toutes formations |
| **Texte secondaire** | Gris moyen | `#7F8C8D` | Légendes, métadonnées |
| **Fond neutre** | Gris très clair | `#F7F9F9` | Fond de tableaux alternés |
| **Bordures** | Gris clair | `#D5D8DC` | Séparateurs, bordures de tableaux |
| **Or (réussite)** | Or | `#F39C12` | Badges, certificats |
| **Diamant** | Bleu diamant | `#3498DB` | Niveau diamant quiz |

## 5.2 Hiérarchie typographique colorée — Formation IOA 🦠

| Niveau | Style | Couleur | Exemple |
|---|---|---|---|
| **H1 — Titre de partie** | Montserrat Bold 34px, MAJUSCULES | `#922B21` rouge bordeaux | PARTIE I — HISTOIRE ET FONDAMENTAUX |
| **H2 — Titre de module** | Montserrat SemiBold 28px | `#922B21` rouge bordeaux | MODULE 3 : MICROBIOLOGIE DES IOA |
| **H3 — Titre de section** | Montserrat Medium 22px | `#E74C3C` rouge corail | 3.1 Staphylococcus aureus — Le roi des IOA |
| **H4 — Sous-section** | Open Sans SemiBold 18px | `#2C3E50` noir doux | Facteurs de virulence |
| **Bandeau latéral** | — | `#922B21` fond, texte blanc | Navigation module |
| **Badge formation** | Pill 24px | `#922B21` fond, blanc | 🦠 INFECTION OSSEUSE |

## 5.3 Encadrés — Code couleur partagé (identique aux autres formations)

| Marqueur | Nom | Bordure gauche | Fond | Usage identique |
|---|---|---|---|---|
| 🏥 | **Pertinence clinique** | `#E67E22` orange | `#FDF2E9` | Lien concept → pratique clinique/chirurgicale |
| ⚠️ | **Danger / Critique** | `#E74C3C` rouge | `#FDEDEC` | Risque vital, erreur dangereuse, résistance |
| 📖 | **Approfondissement** | `#3498DB` bleu | `#EBF5FB` | Mécanisme, recherche, biologie |
| 💡 | **Astuce / Mnémonique** | `#2ECC71` vert | `#EAFAF1` | Aide-mémoire, truc de praticien |
| 🔬 | **Expert** | `#9B59B6` violet | `#F4ECF7` | Détail avancé, technique fine |
| 🤔 | **Réflexion** | `#F1C40F` jaune | `#FEF9E7` | Question ouverte, problème |
| 🦠 | **Microbiologie** (nouveau) | `#922B21` bordeaux | `#F9EBEA` | Focus microbiologique spécifique |
| 💊 | **Antibiothérapie** (nouveau) | `#8E44AD` violet foncé | `#F5EEF8` | Protocoles antibiotiques, posologies |

## 5.4 Navigation plateforme — Identification visuelle

```
┌─────────────────────────────────────────────────────────────────────────────┐
│  VERTEX©                                              🔔  👤 Dr. Martin   │
│  ─────────────────────────────────────────────────────────────────────────  │
│                                                                             │
│  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐             │
│  │  🦴 SCOLIOSE    │  │  🦵 PTG          │  │  🦠 INFECTION   │            │
│  │  ▔▔▔▔▔▔▔▔▔▔▔▔▔  │  │  ▔▔▔▔▔▔▔▔▔▔▔▔▔  │  │  ▔▔▔▔▔▔▔▔▔▔▔▔▔  │           │
│  │  Fond: #1A5276  │  │  Fond: #0E6655  │  │  Fond: #922B21  │            │
│  │  25 modules     │  │  28 modules     │  │  30 modules     │            │
│  │  75h            │  │  80h            │  │  90h            │            │
│  │  ████████░░ 75% │  │  ██░░░░░░░░ 15% │  │  ░░░░░░░░░░  0% │           │
│  └─────────────────┘  └─────────────────┘  └─────────────────┘             │
│                                                                             │
│  Formations à venir :                                                       │
│  ┌─────────────────┐  ┌─────────────────┐                                   │
│  │  🧠 NEUROCHIR.  │  │  🦴 PTH          │                                  │
│  │  À venir Q4'26  │  │  À venir 2027   │                                  │
│  └─────────────────┘  └─────────────────┘                                   │
└─────────────────────────────────────────────────────────────────────────────┘
```

## 5.5 Sidebar de navigation — Formation IOA 🦠

```
┌──────────────────────┐
│  🦠 INFECTION OSS.   │  ← Fond #922B21, texte blanc
│  ────────────────    │
│  PARTIE I            │  ← Texte #F5B7B1 (rouge clair)
│   ▸ M1 Histoire     │  ← Texte blanc
│   ▸ M2 Anatomie vasc│
│   ▸ M3 Microbiologie│
│   ► M4 Physiopath.  │  ← Module actif : fond #E74C3C
│  PARTIE II           │
│   ▸ M5 Immunologie  │
│   ▸ M6 Terrain      │
│  PARTIE III          │
│   ▸ M7 Diag. cliniq.│
│   ▸ M8 Imagerie     │
│   ▸ M9 Microbio.    │
│   ▸ M10 Classif.    │
│  PARTIE IV           │
│   ▸ M11 Pharmaco.   │
│   ▸ M12 ATB thérapie│
│   ▸ M13 ATB locaux  │
│  ...                 │
└──────────────────────┘
```

---

# 6. RÈGLES D'ÉCRITURE DU CONTENU

Les règles d'écriture sont **identiques** à celles des Formations Scoliose et PTG (cf. `REGLES_ECRITURE_CONTENU.md`). Voici un résumé des principes fondamentaux, adaptés au contexte IOA :

## 6.1 Principes inchangés

| # | Règle | Applicable IOA |
|---|---|---|
| 1 | Jamais de fait sans explication (mécanisme + conséquence clinique) | ✅ Identique |
| 2 | Chaînes de raisonnement obligatoires (microbiologie → physiopath. → diagnostic → traitement) | ✅ Adapté |
| 3 | Controverses et niveaux de preuve (📊, ⚖️) | ✅ Identique |
| 4 | Trois niveaux de profondeur (Essentiel / Approfondi / Expert) | ✅ Identique |
| 5 | Minimum 2 vignettes cliniques par module | ✅ Identique |
| 6 | Minimum 1 question de réflexion par section (🤔) | ✅ Identique |
| 7 | Minimum 1 micro-exercice par section (✏️) | ✅ Identique |
| 8 | Minimum 3 mnémoniques par module (💡) | ✅ Identique |
| 9 | Minimum 1 exercice InfectoSim© par module (si applicable) | ✅ Adapté (VERTEX → InfectoSim) |
| 10 | 1 encadré pour 500 mots minimum | ✅ Identique |
| 11 | Format des marqueurs médias : `> [MEDIA: {EMOJI} {CODE} — {TITRE} ({INSTRUCTION})]` | ✅ Identique |
| 12 | Vouvoiement systématique | ✅ Identique |
| 13 | Formulations interdites | ✅ Identique |
| 14 | ≥ 300 mots par sous-section | ✅ Identique |

## 6.2 Adaptations spécifiques IOA

| Adaptation | Détail |
|---|---|
| **Simulateur** | InfectoSim© au lieu de VERTEX© rachis ou KneeSim©. Scénarios IOA : cinétique antibiotique osseuse, modélisation du biofilm, planification chirurgicale de débridement 3D, simulation de résistances |
| **Patient fil rouge** | Un patient fil rouge par partie — parcours d'un patient depuis le diagnostic jusqu'à la guérison ou la récidive |
| **Particularité microbiologique** | Intégrer systématiquement l'antibiogramme, les CMI, les interactions médicamenteuses dans chaque cas clinique |
| **Particularité pluridisciplinaire** | Chaque cas clinique complexe DOIT mentionner la RCP (Réunion de Concertation Pluridisciplinaire) et les rôles de chaque intervenant (chirurgien, infectiologue, microbiologiste, radiologue) |
| **Photos cliniques** | Plus nombreuses qu'en scoliose/PTG — photos de plaies, fistules, séquestres, résultats de reconstruction |
| **Données biologiques** | Tableaux de valeurs biologiques systématiques (CRP, VS, GB, PCT) avec cinétique temporelle |

## 6.3 Marqueurs médias — Codification IOA

```
> [MEDIA: {EMOJI} MIOA{module}-S{section}-{numéro} — {TITRE} ({INSTRUCTION_PÉDAGOGIQUE})]
```

- Préfixe **MIOA** pour distinguer des médias scoliose (M) et PTG (MPTG)
- Exemple : `MIOA03-S02-005` = Formation IOA, Module 3, Section 2, 5ème média

---

# 7. STRUCTURE DES FICHIERS DU CDC

Le présent cahier des charges est organisé en **10 fichiers** :

| # | Fichier | Contenu | Modules couverts |
|---|---|---|---|
| 0 | `CDC_IOA_00_INTRODUCTION_CHARTE.md` | Introduction, charte graphique, code couleur, règles d'écriture | — |
| 1 | `CDC_IOA_01_HISTOIRE_FONDAMENTAUX.md` | Histoire, anatomie vasculaire, microbiologie, physiopathologie | Modules 1-4 |
| 2 | `CDC_IOA_02_IMMUNOLOGIE_TERRAIN.md` | Immunologie osseuse, facteurs de risque | Modules 5-6 |
| 3 | `CDC_IOA_03_DIAGNOSTIC.md` | Diagnostic clinique, biologique, imagerie, microbiologique, classifications | Modules 7-10 |
| 4 | `CDC_IOA_04_ANTIBIOTHERAPIE.md` | Pharmacologie, antibiothérapie systémique et locale | Modules 11-13 |
| 5 | `CDC_IOA_05_OSTEOMYELITE.md` | Ostéomyélite enfant, adulte, chronique, post-traumatique | Modules 14-17 |
| 6 | `CDC_IOA_06_ARTHRITE_PERIPROTHETIQUE.md` | Arthrite septique, infections périprothétiques | Modules 18-21 |
| 7 | `CDC_IOA_07_INFECTIONS_SPECIFIQUES.md` | Spondylodiscite, pied diabétique, tuberculose, fongiques | Modules 22-25 |
| 8 | `CDC_IOA_08_CHIRURGIE_RECONSTRUCTION.md` | Techniques chirurgicales, reconstruction, couverture | Modules 26-28 |
| 9 | `CDC_IOA_09_PREVENTION_INNOVATIONS.md` | Prévention, recherche, innovations | Modules 29-30 |

---

# 8. CORRESPONDANCE INTER-FORMATIONS

## 8.1 Modules partagés / transversaux

Certains concepts sont communs aux trois formations. Le LMS gère les **renvois croisés** :

| Concept | Formation Scoliose | Formation PTG | Formation IOA | Type de partage |
|---|---|---|---|---|
| Anatomie osseuse (structure, vascularisation) | Module 1 §1.1 | Module 3 §3.1 | Module 2 §2.1 | Contenu adapté au contexte |
| Matériaux d'ostéosynthèse (titane, CoCr, PE, ciment) | Module 15 §15.1 | Modules 10, 12 | Module 13 §13.1 | Focus adhésion bactérienne en IOA |
| Infection site opératoire / périprothétique | Module 22 (scoliose) | Module 23 (PTG) | Modules 18-21 (IOA) | Traitement exhaustif en IOA |
| Imagerie (radio, scanner, IRM) | Module 7 | Module 8 | Module 8 | Sémiologie spécifique infection en IOA |
| Infection rachidienne | Module 22 (scoliose) | — | Module 22 (IOA) | Traitement complet en IOA |
| Antibioprophylaxie chirurgicale | Module 17 §17.5 | Module 21 §21.7 | Module 29 | Traitement approfondi en IOA |
| Complications générales chirurgie | Module 17 | Module 21 | Module 29 §29.2 | Focus infection en IOA |
| Rééducation post-chirurgie septique | Module 18 | Module 27 | Module 27 §27.4 | Spécificités contexte infectieux |

## 8.2 Simulation InfectoSim© vs VERTEX© Rachis vs KneeSim©

| Caractéristique | VERTEX© Rachis (Scoliose) | KneeSim© (PTG) | InfectoSim© (IOA) |
|---|---|---|---|
| **Anatomie simulée** | Rachis C3-S1 | Genou : fémur/tibia/patella | Os long, articulation, rachis (multi-site) |
| **Focus principal** | Biomécanique, correction 3D | Cinématique, placement implant | Infection, diffusion ATB, biofilm |
| **Simulation unique** | Croissance, progression scoliose | Usure PE, descellement long terme | Cinétique ATB osseuse, croissance biofilm |
| **Chirurgie virtuelle** | Vis pédiculaires, cintrage tige | Coupes, équilibrage ligamentaire | Débridement 3D, séquestrectomie virtuelle |
| **Scénarios spécifiques** | — | — | Choix ATB selon CMI, simulation résistance, planning membrane induite |
| **Moteur** | Julia + Three.js | Même stack | Même stack + modèles pharmacocinétiques |

---

# ANNEXE A — GLOSSAIRE DES ABRÉVIATIONS IOA

| Abréviation | Signification |
|---|---|
| IOA | Infection Ostéo-Articulaire |
| SARM | *Staphylococcus aureus* Résistant à la Méticilline (*MRSA*) |
| SASM | *Staphylococcus aureus* Sensible à la Méticilline (*MSSA*) |
| SCN | Staphylocoque à Coagulase Négative |
| BLSE | Bêta-Lactamase à Spectre Étendu |
| EPC | Entérobactérie Productrice de Carbapénémase |
| BMR | Bactérie Multi-Résistante |
| BHRe | Bactérie Hautement Résistante émergente |
| CMI | Concentration Minimale Inhibitrice (*MIC*) |
| CMB | Concentration Minimale Bactéricide |
| ATB | Antibiotique |
| CRP | C-Reactive Protein |
| VS | Vitesse de Sédimentation |
| PCT | Procalcitonine |
| NFS | Numération Formule Sanguine |
| GB | Globules Blancs |
| PNN | Polynucléaires Neutrophiles |
| IL-6 | Interleukine-6 |
| PCR | *Polymerase Chain Reaction* |
| MALDI-TOF | *Matrix-Assisted Laser Desorption Ionization — Time Of Flight* |
| NGS | *Next-Generation Sequencing* |
| ASP | Arthroscopie |
| DAIR | *Debridement, Antibiotics, Implant Retention* |
| TEP | Tomographie par Émission de Positons |
| IRM | Imagerie par Résonance Magnétique |
| TDM | Tomodensitométrie (Scanner) |
| LBA | Lavage Broncho-Alvéolaire |
| RCP | Réunion de Concertation Pluridisciplinaire |
| CRIOAC | Centre de Référence des IOA Complexes |
| MI | Membrane Induite (technique de Masquelet) |
| TOD | Transport Osseux Distraction |
| VAC | *Vacuum-Assisted Closure* (pansement à pression négative) |
| PMMA | Polyméthacrylate de Méthyle (ciment) |
| BMP | *Bone Morphogenetic Protein* |
| PVL | Leucocidine de Panton-Valentine |
| TSST | *Toxic Shock Syndrome Toxin* |
| SEA/SEB | Entérotoxines Staphylococciques A/B |
| FQ | Fluoroquinolone |
| RIF | Rifampicine |
| TMP-SMX | Triméthoprime-Sulfaméthoxazole (Bactrim®) |
| OPAT | *Outpatient Parenteral Antibiotic Therapy* |
| DPC | Développement Professionnel Continu |
| CME | *Continuing Medical Education* |

---

*Ce document (Partie 0) constitue le socle commun de la Formation IOA. Les parties suivantes (1 à 9) détaillent le contenu pédagogique module par module.*

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*
