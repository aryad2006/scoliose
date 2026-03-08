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


---


## Partie 1 — Histoire et Fondamentaux (Modules 1-4)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 1 : HISTOIRE DES INFECTIONS OSSEUSES — DES ORIGINES À L'ÈRE MODERNE

**Partie** : I — Histoire et Fondamentaux
**Durée estimée** : 2h30
**Niveau** : Fondamental
**Prérequis** : Aucun

## Accroche clinique

> 🏥 **Mise en situation** : En 1914, un soldat de la Première Guerre mondiale reçoit un éclat d'obus au fémur. La fracture ouverte se complique inévitablement d'une ostéomyélite suppurée. Sans antibiotiques, le chirurgien de campagne n'a d'autre choix que l'amputation ou le drainage à ciel ouvert… avec un taux de mortalité de 80%. Un siècle plus tard, le même type de blessure se traite par fixation externe, débridement itératif et antibiothérapie ciblée. *Qu'est-ce qui a changé ? Quelles sont les étapes clés de cette révolution thérapeutique ?*

## Objectifs d'apprentissage

1. **Retracer** les grandes étapes historiques de la compréhension et du traitement des infections osseuses
2. **Identifier** les contributions majeures (Lister, Pasteur, Fleming, Orr, Papineau, Ilizarov, Masquelet)
3. **Expliquer** l'impact de la découverte des antibiotiques sur le traitement des IOA
4. **Analyser** l'émergence de la résistance bactérienne dans une perspective historique
5. **Comprendre** comment l'évolution des concepts a façonné les pratiques actuelles

## Structure du contenu

### Section 1.1 — L'Antiquité et le Moyen Âge : les infections osseuses avant la microbiologie

**Contenu obligatoire** :
- Preuves paléopathologiques d'ostéomyélite (momies égyptiennes, squelettes néolithiques)
- Descriptions d'Hippocrate (« os cariés »), Galien, Celse (les 4 signes cardinaux de l'inflammation : *rubor, calor, tumor, dolor*)
- Avicenne et le Canon de la médecine — traitement des abcès osseux
- Concepts humoraux : l'infection comme déséquilibre des humeurs
- Traitements empiriques : cautérisation, drainage, amputation, plantes médicinales
- Chirurgie de guerre médiévale : la chirurgie des plaies par Ambroise Paré (1510-1590)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA01-S01-001 | 📷 IMAGE | Preuve paléopathologique d'ostéomyélite sur os ancien (fémur/tibia) | Photo musée d'histoire naturelle |
| MIOA01-S01-002 | 📊 INFOGRAPHIE | Frise chronologique des IOA — Antiquité au Moyen Âge | Timeline illustrée |
| MIOA01-S01-003 | 📐 SCHÉMA | Les 4 signes cardinaux de l'inflammation de Celse — illustration anatomique | Dessin classique annoté |
| MIOA01-S01-004 | 📷 IMAGE | Portrait et instruments d'Ambroise Paré — chirurgie de guerre de la Renaissance | Gravure historique |

### Section 1.2 — La révolution microbienne : de Pasteur à Koch (XIXe siècle)

**Contenu obligatoire** :
- Louis Pasteur et la théorie des germes (1860s) — fin de la génération spontanée
- Joseph Lister et l'antisepsie (1867) : acide phénique, réduction drastique des infections postopératoires
- Robert Koch et les postulats de Koch (1882) — identification des agents pathogènes
- Alexander Ogston (1880) : identification du *Staphylococcus aureus* comme agent principal des abcès
- Ernest Lexer (1894) : première description systématique de l'ostéomyélite hématogène
- Développement de l'asepsie chirurgicale (Semmelweis, Halsted, gants en caoutchouc)
- Impact sur la compréhension de la physiopathologie : de la « carie osseuse » à l'infection bactérienne

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA01-S02-001 | 📷 IMAGE | Portraits de Pasteur, Lister, Koch — galerie des fondateurs | Photos historiques |
| MIOA01-S02-002 | 🎬 ANIMATION | Expérience du col de cygne de Pasteur — animation 2D | Montrer la rupture de la génération spontanée |
| MIOA01-S02-003 | 📊 INFOGRAPHIE | Les 4 postulats de Koch — schéma illustré | Application à l'ostéomyélite |
| MIOA01-S02-004 | 📐 SCHÉMA | Comparaison taux d'infection pré- et post-Lister | Graphique avant/après |
| MIOA01-S02-005 | 📷 IMAGE | Première photographie d'un *Staphylococcus aureus* par Ogston (1880) | Image historique de microscopie |

### Section 1.3 — L'ère des antibiotiques : de Fleming à nos jours (XXe siècle)

**Contenu obligatoire** :
- Alexander Fleming et la découverte de la pénicilline (1928)
- Chain et Florey : production industrielle de la pénicilline (1940-1942)
- Impact de la Seconde Guerre mondiale : la pénicilline comme « miracle drug »
- Réduction spectaculaire de la mortalité par IOA (de 50-80% à <5%)
- Apparition des premiers *Staphylococcus aureus* résistants à la pénicilline (1947 — à peine 2 ans !)
- Introduction de la méticilline (1959) et émergence du SARM (1961)
- Développement des classes d'antibiotiques successives : céphalosporines, aminosides, glycopeptides, fluoroquinolones, oxazolidinones, lipopeptides
- La « course aux armements » bactéries vs antibiotiques

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA01-S03-001 | 📷 IMAGE | La boîte de Petri originale de Fleming (1928) — zone d'inhibition autour du *Penicillium* | Photo historique iconique |
| MIOA01-S03-002 | 🎬 ANIMATION | Timeline animée des antibiotiques : découverte → résistance, pour chaque classe | Montrer le délai entre introduction et résistance |
| MIOA01-S03-003 | 📊 INFOGRAPHIE | Courbe de mortalité par IOA au XXe siècle — impact des antibiotiques | Graphique spectaculaire |
| MIOA01-S03-004 | 📊 INFOGRAPHIE | Chronologie des résistances bactériennes — de la pénicilline au SARM et au-delà | Timeline progressive |

### Section 1.4 — Évolution des techniques chirurgicales au XXe siècle

**Contenu obligatoire** :
- Hiram Winnett Orr (1929) : traitement de l'ostéomyélite par plâtre fenêtré et drainage
- Harold Boyd et Felix Compere (1943) : ostéomyélite chronique et séquestrectomie radicale
- La technique Papineau (1973) : comblement osseux à ciel ouvert avec greffe spongieuse
- Alain-Charles Masquelet (2000+) : technique de la membrane induite
- Gavriil Ilizarov : transport osseux par distraction ostéogénèse (1950s-1970s, diffusé en Occident dans les années 1980)
- Développement du fixateur externe dans les fractures ouvertes infectées
- Évolution du débridement : de l'amputation au « save the limb »
- Rôle des ciments chargés d'antibiotiques (Buchholz et Engelbrecht, 1970)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA01-S04-001 | 📷 IMAGE | Technique d'Orr — plâtre fenêtré pour ostéomyélite (photo historique) | Archives chirurgicales |
| MIOA01-S04-002 | 📐 SCHÉMA | Technique de Papineau — étapes illustrées (débridement → comblement → cicatrisation) | 4 schémas séquentiels |
| MIOA01-S04-003 | 🎬 ANIMATION | Principe de la membrane induite de Masquelet — animation 3D en 2 temps | Montrer les 2 temps opératoires |
| MIOA01-S04-004 | 🎬 ANIMATION | Transport osseux d'Ilizarov — principe de distraction ostéogénèse | Montrer le matériel et la régénération |
| MIOA01-S04-005 | 📐 SCHÉMA | Ciment antibiotique de Buchholz — spacer en PMMA chargé | Coupe montrant la diffusion locale |

### Section 1.5 — L'ère moderne : défis contemporains et perspectives (XXIe siècle)

**Contenu obligatoire** :
- Pandémie de résistance aux antibiotiques : SARM communautaire, BLSE, EPC, BMR, BHRe
- L'alerte de l'OMS (2014) : l'ère post-antibiotique
- Création des CRIOAC (Centres de Référence des IOA Complexes) en France (2008, label 2012)
- Approche pluridisciplinaire systématique (chirurgien + infectiologue + microbiologiste)
- Nouvelles technologies : biologie moléculaire (PCR, NGS), phagothérapie, peptides antimicrobiens
- Intelligence artificielle et algorithmes diagnostiques
- Implants « smart » : surfaces antibactériennes, coatings, biomatériaux anti-biofilm

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA01-S05-001 | 📊 INFOGRAPHIE | Carte mondiale de la résistance aux antibiotiques — données OMS | Carte interactive |
| MIOA01-S05-002 | 📊 INFOGRAPHIE | Organisation d'un CRIOAC — organigramme pluridisciplinaire | Rôles de chaque membre |
| MIOA01-S05-003 | 📐 SCHÉMA | Timeline des innovations en IOA (XXIe siècle) | Frise prospective |
| MIOA01-S05-004 | 📊 INFOGRAPHIE | Pipeline des alternatives aux antibiotiques — phagothérapie, peptides, IA | Infographie synthétique |

### Points clés du Module 1

1. Les infections osseuses sont documentées depuis l'Antiquité ; la paléopathologie montre des ostéomyélites sur des squelettes vieux de plusieurs millénaires
2. La révolution Pasteur-Lister-Koch a transformé la compréhension de l'infection de « théorie humorale » à « théorie microbienne »
3. La pénicilline (Fleming, 1928) a révolutionné le pronostic des IOA, mais la résistance bactérienne est apparue en moins de 2 ans
4. Les techniques chirurgicales ont évolué de l'amputation au sauvetage de membre (Orr, Papineau, Masquelet, Ilizarov)
5. L'ère moderne est marquée par la résistance croissante (SARM, BLSE, EPC) et l'approche pluridisciplinaire (CRIOAC)
6. Les perspectives incluent la phagothérapie, les peptides antimicrobiens, l'IA diagnostique et les surfaces anti-biofilm

### Auto-évaluation

- 3 QCM Bronze (dates clés, personnages)
- 3 QCM Argent (impacts des découvertes)
- 2 QCM Or (analyse de l'évolution des résistances)
- 1 QCM Diamant (synthèse historique appliquée au raisonnement actuel)
- 1 QROC : « Expliquez en 5 lignes pourquoi la découverte de la pénicilline n'a pas éliminé les IOA »

---

# MODULE 2 : ANATOMIE ET VASCULARISATION OSSEUSE APPLIQUÉES À L'INFECTION

**Partie** : I — Histoire et Fondamentaux
**Durée estimée** : 3h00
**Niveau** : Fondamental
**Prérequis** : Connaissances de base en anatomie

## Accroche clinique

> 🏥 **Cas clinique — Lucas, 8 ans** : Consulte aux urgences pour douleurs de la cuisse gauche depuis 3 jours, fièvre à 39,5°C, boiterie. La radiographie est normale. L'IRM montre un signal anormal de la métaphyse fémorale distale. *Pourquoi la métaphyse plutôt que la diaphyse ? Pourquoi l'enfant et pas l'adulte ? La réponse est dans la vascularisation osseuse…*

## Objectifs d'apprentissage

1. **Décrire** la structure macro- et microscopique de l'os (cortical, spongieux, périoste, endoste)
2. **Expliquer** la vascularisation osseuse (artère nourricière, métaphysaire, périostée) et ses variations selon l'âge
3. **Comprendre** pourquoi la métaphyse est le site privilégié de l'ostéomyélite hématogène chez l'enfant
4. **Analyser** les différences vasculaires entre enfant, adulte et nourrisson, et leurs implications infectiologiques
5. **Relier** l'anatomie osseuse aux voies de contamination bactérienne (hématogène, directe, contiguïté)
6. **Identifier** les zones anatomiques vulnérables à l'infection pour chaque segment osseux

## Structure du contenu

### Section 2.1 — Rappels de structure osseuse : macro-anatomie

**Contenu obligatoire** :
- Structure d'un os long : épiphyse, métaphyse, diaphyse, cartilage de croissance (physe)
- Os cortical (compact) vs os spongieux (trabéculaire) : porosité, surface spécifique, rôles respectifs
- Périoste : couche fibreuse et couche génératrice (cambium), rôle dans la croissance et la réparation
- Endoste : revêtement interne, cellules ostéogéniques
- Canal médullaire : moelle rouge (hématopoïétique) vs moelle jaune (graisseuse), distribution selon l'âge
- Architecture trabéculaire : lignes de force, répartition des charges, implications pour la fragilité infectieuse
- Différences anatomiques entre os long, os plat (ilion, sternum) et os court (vertèbre, calcanéum)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA02-S01-001 | 🧊 MODÈLE 3D | Os long complet (fémur) — coupe longitudinale avec légendes de toutes les régions | Modèle interactif rotatif |
| MIOA02-S01-002 | 📐 SCHÉMA | Coupe histologique osseuse — os cortical (systèmes de Havers) vs os spongieux (travées) | Zoom microscopique annoté |
| MIOA02-S01-003 | 📐 SCHÉMA | Périoste : double couche (fibreuse + cambium) avec vascularisation et innervation | Coupe transversale annotée |
| MIOA02-S01-004 | 📊 INFOGRAPHIE | Tableau comparatif os cortical vs spongieux : porosité, surface, vascularisation, susceptibilité infectieuse | Side by side |

### Section 2.2 — Vascularisation osseuse : les 3 systèmes

**Contenu obligatoire** :
- **Système afférent** : artère nourricière (diaphyse), artères métaphysaires, artères périostées
- Vascularisation centrifuge : artère nourricière → cavité médullaire → cortex interne → cortex externe → périoste
- Vascularisation centripète : artères périostées → 1/3 externe du cortex (suppléance si artère nourricière lésée)
- **Système efférent** : drainage veineux médullaire et cortical
- **Système intermédiaire** : capillaires corticaux (canaux de Havers et Volkmann)
- Variations de la vascularisation selon le type d'os et la localisation
- Conséquences chirurgicales : comment la dévascularisation favorise l'infection (fracture, chirurgie, séquestre)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA02-S02-001 | 🎬 ANIMATION | Vascularisation d'un os long — système afférent complet (artère nourricière, métaphysaire, périostée) | Animation 3D avec flux sanguin coloré |
| MIOA02-S02-002 | 📐 SCHÉMA | Vascularisation centrifuge vs centripète — coupe transversale diaphysaire | Flèches directionnelles |
| MIOA02-S02-003 | 📐 SCHÉMA | Système de Havers et de Volkmann — coupe microscopique avec vaisseaux | Zoom histologique |
| MIOA02-S02-004 | 🎬 ANIMATION | Comment la dévascularisation crée un séquestre : thrombose vasculaire → nécrose → colonisation bactérienne | Animation physiopathologique |

### Section 2.3 — Vascularisation métaphysaire : la clé de l'ostéomyélite hématogène chez l'enfant

**Contenu obligatoire** :
- **Anatomie vasculaire métaphysaire de l'enfant** : boucles vasculaires sinusoïdales (anses capillaires) — flux lent, stase, perte des phagocytes marginés
- Théorie de Trueta (1959) : les vaisseaux métaphysaires se terminent en boucles aveugles adjacentes à la physe → ralentissement du flux → piège bactérien
- Absence de couche endothéliale complète au niveau des « sinusoïdes veineux » métaphysaires
- Chez le nourrisson (<18 mois) : **vaisseaux transphysaires** reliant métaphyse et épiphyse → extension articulaire possible de l'infection
- Chez l'enfant (2-16 ans) : physe = barrière vasculaire → infection métaphysaire, rarement épiphysaire
- Chez l'adulte : physe fusionnée → vascularisation épiphyso-métaphysaire continue → ostéomyélite épiphysaire possible, mais plus rare
- Zones métaphysaires intra-articulaires : hanche (métaphyse fémorale proximale intra-capsulaire), épaule, cheville → risque d'arthrite septique associée
- Importance du débit sanguin métaphysaire élevé chez l'enfant en croissance

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA02-S03-001 | 🎬 ANIMATION | Boucles vasculaires sinusoïdales métaphysaires de l'enfant — stase → piège bactérien | Animation de Trueta modernisée |
| MIOA02-S03-002 | 📐 SCHÉMA | Comparaison vascularisation métaphysaire : nourrisson vs enfant vs adulte | 3 schémas côte à côte |
| MIOA02-S03-003 | 📐 SCHÉMA | Zones métaphysaires intra-articulaires (hanche, épaule, cheville, coude) | Anatomie articulaire annotée |
| MIOA02-S03-004 | 🎬 ANIMATION | Vaisseaux transphysaires du nourrisson → propagation épiphysaire et articulaire | Animation critique |
| MIOA02-S03-005 | 📊 INFOGRAPHIE | Tableau comparatif vascularisation et risque infectieux par tranche d'âge | Synthèse visuelle |

### Section 2.4 — Anatomie des voies de contamination

**Contenu obligatoire** :
- **Voie hématogène** : bactériémie → colonisation métaphysaire (enfant) ou épiphyso-métaphysaire (adulte)
  - Foyers à distance : cutané, urinaire, dentaire, endocardite
  - Bactériémie transitoire : extraction dentaire, manœuvre instrumentale
- **Voie directe (inoculation)** : fracture ouverte, chirurgie, ponction, morsure
  - Classification de Gustilo-Anderson des fractures ouvertes et risque infectieux
  - Implants : colonisation de surface, adhésion bactérienne
- **Voie par contiguïté** : extension d'une infection des parties molles adjacentes
  - Escarre, ulcère, cellulite, infection de plaie
  - Pied diabétique : paradigme de l'infection par contiguïté
- Anatomie des barrières naturelles : périoste, cortex, physe, capsule articulaire
- Quand les barrières cèdent : abcès sous-périosté, arthrite secondaire, fistule cutanée

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA02-S04-001 | 📐 SCHÉMA | Les 3 voies de contamination osseuse — schéma synthétique | Hématogène, directe, contiguïté |
| MIOA02-S04-002 | 🎬 ANIMATION | Voie hématogène : bactériémie → colonisation métaphysaire → abcès sous-périosté | Scénario complet animé |
| MIOA02-S04-003 | 📐 SCHÉMA | Classification de Gustilo-Anderson (type I, II, IIIA, IIIB, IIIC) — illustrations | Dessins des 5 types |
| MIOA02-S04-004 | 📐 SCHÉMA | Infection par contiguïté — pied diabétique : de l'ulcère à l'ostéomyélite | Coupe sagittale du pied |
| MIOA02-S04-005 | 🎬 ANIMATION | Rupture des barrières anatomiques : périoste → abcès → fistule | Progression anatomique |

### Section 2.5 — Anatomie osseuse régionale et vulnérabilité infectieuse

**Contenu obligatoire** :
- **Fémur** : métaphyse proximale intra-capsulaire, diaphyse bien vascularisée, métaphyse distale (site classique d'ostéomyélite chez l'enfant)
- **Tibia** : face antéro-médiale sous-cutanée (vulnérabilité aux fractures ouvertes), vascularisation précaire du 1/3 moyen-inférieur
- **Hanche** : capsule englobant la métaphyse fémorale → risque d'arthrite septique associée
- **Rachis** : vascularisation vertébrale, plexus de Batson, propagation transversale de la spondylodiscite
- **Pied** : calcanéum (os spongieux riche, vulnérable au pied diabétique), métatarsiens
- **Bassin** : ilion, sacrum, articulation sacro-iliaque (sites d'ostéomyélite parfois méconnus)
- **Main et poignet** : panaris osseux, arthrite des petites articulations, morsures

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA02-S05-001 | 🧊 MODÈLE 3D | Squelette complet avec couleur-codage des zones vulnérables à l'infection | Interactif, cliquable par région |
| MIOA02-S05-002 | 📐 SCHÉMA | Vascularisation du tibia — face antéro-médiale sous-cutanée, zone de fragilité | Important car fractures ouvertes |
| MIOA02-S05-003 | 📐 SCHÉMA | Plexus veineux de Batson (rachis) — voie de propagation des spondylodiscites | Vue antérieure du rachis |
| MIOA02-S05-004 | 📐 SCHÉMA | Vascularisation du calcanéum et du pied — zones de vulnérabilité diabétique | Vue latérale et plantaire |

### Points clés du Module 2

1. L'os est un organe vascularisé avec 3 systèmes : artère nourricière, artères métaphysaires, artères périostées
2. La métaphyse de l'enfant est le site privilégié de l'ostéomyélite hématogène à cause des boucles vasculaires sinusoïdales (Trueta) créant une stase favorable à la colonisation bactérienne
3. Chez le nourrisson, les vaisseaux transphysaires permettent l'extension de l'infection à l'épiphyse et à l'articulation
4. La physe de l'enfant constitue une barrière vasculaire qui est perdue après la fusion chez l'adulte
5. Les 3 voies de contamination sont : hématogène, directe (inoculation), par contiguïté
6. Certaines zones anatomiques sont plus vulnérables : tibia antéro-médial (sous-cutané), calcanéum (diabète), métaphyse intra-capsulaire (hanche)
7. La dévascularisation (traumatique ou chirurgicale) est un facteur majeur d'infection car elle crée un séquestre avasculaire inaccessible aux défenses immunitaires et aux antibiotiques

---

# MODULE 3 : MICROBIOLOGIE DES INFECTIONS OSTÉOARTICULAIRES

**Partie** : I — Histoire et Fondamentaux
**Durée estimée** : 4h00
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Module 2

## Accroche clinique

> 🏥 **Cas clinique — M. Belkacem, 72 ans** : Prothèse totale de hanche posée il y a 14 mois. Douleur progressive depuis 3 mois. CRP = 45 mg/L. Ponction articulaire : liquide trouble, 38 000 leucocytes/mm³ (85% PNN). La culture standard est **négative** à J+5. *Quels germes peut-on suspecter ? Faut-il prolonger l'incubation ? Quelles techniques complémentaires demander ?*

## Objectifs d'apprentissage

1. **Identifier** les principaux micro-organismes responsables d'IOA selon le contexte (hématogène, post-opératoire, péri-prothétique, communautaire)
2. **Décrire** *Staphylococcus aureus* et ses facteurs de virulence (PVL, adhésines, toxines, SCV)
3. **Expliquer** le rôle des staphylocoques à coagulase négative dans les infections sur matériel
4. **Connaître** les principaux profils de résistance (SARM, BLSE, EPC) et leur impact thérapeutique
5. **Distinguer** les infections monomicrobiennes et polymicrobiennes selon le contexte
6. **Comprendre** le concept de *Small Colony Variants* (SCV) et leur rôle dans la chronicité

## Structure du contenu

### Section 3.1 — *Staphylococcus aureus* : le roi des IOA

**Contenu obligatoire** :
- Épidémiologie : responsable de 40-60% des ostéomyélites hématogènes, 30-40% des infections périprothétiques
- **Facteurs de virulence** :
  - Adhésines (MSCRAMMs : *Microbial Surface Components Recognizing Adhesive Matrix Molecules*) : clumping factor A/B, fibronectin-binding proteins, collagen-binding protein
  - Toxines : leucocidine de Panton-Valentine (PVL), TSST-1, entérotoxines, alpha-hémolysine
  - Enzymes : coagulase, catalase, hyaluronidase, lipase, DNase, protéases
  - Protéine A : liaison au fragment Fc des IgG → évasion immunitaire
  - Capsule polysaccharidique (types 5 et 8)
- *S. aureus* sensible (SASM) vs résistant (SARM) à la méticilline
  - SARM nosocomial : souvent multirésistant (clone Lyon, clone GISA)
  - SARM communautaire : souvent PVL+ (clone USA300, clone ST80)
- *Staphylococcus aureus* PVL+  : formes nécrosantes, ostéomyélites multifocales, thrombophlébite septique, enfant ++
- *Small Colony Variants* (SCV) : phénotype à croissance lente, internalisation dans les ostéoblastes, résistance aux aminosides, cause de récidive/chronicité

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA03-S01-001 | 📐 SCHÉMA | *S. aureus* — arsenal de virulence complet (adhésines, toxines, enzymes, évasion immunitaire) | Schéma en étoile autour de la bactérie |
| MIOA03-S01-002 | 🎬 ANIMATION | MSCRAMMs : adhésion de *S. aureus* à la matrice osseuse (fibronectine, collagène) | Interaction moléculaire animée |
| MIOA03-S01-003 | 📷 IMAGE | Culture de SARM vs SASM — antibiogramme avec résistance à l'oxacilline | Photo de boîte de Petri annotée |
| MIOA03-S01-004 | 🎬 ANIMATION | *Small Colony Variants* (SCV) : internalisation dans les ostéoblastes, survie intracellulaire | Animation physiopathologique critique |
| MIOA03-S01-005 | 📐 SCHÉMA | Comparaison SARM nosocomial vs SARM communautaire (PVL+) | Tableau visuel |

### Section 3.2 — Staphylocoques à coagulase négative et les infections sur matériel

**Contenu obligatoire** :
- Principales espèces : *S. epidermidis* (60-80%), *S. lugdunensis* (virulent ++ comme *S. aureus*), *S. capitis*, *S. haemolyticus*, *S. hominis*
- Rôle du slime (glycocalyx) dans la formation du biofilm sur implants métalliques
- Profils de résistance : fréquemment résistants à la méticilline et aux fluoroquinolones
- Interprétation délicate : contamination vs infection vraie (règle des ≥ 2 prélèvements positifs au même germe)
- *S. lugdunensis* : « le loup dans la bergerie » — virulence proche de *S. aureus*, ne pas considérer comme contaminant

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA03-S02-001 | 📐 SCHÉMA | Biofilm de *S. epidermidis* sur implant — microscopie électronique stylisée | Montrer les couches du biofilm |
| MIOA03-S02-002 | 📊 INFOGRAPHIE | Arbre décisionnel : SCN = contamination ou infection ? (critères de Atkins, IDSA) | Algorithme visuel |
| MIOA03-S02-003 | 📐 SCHÉMA | Profils de résistance des SCN — antibiogramme typique | Comparaison avec SASM |

### Section 3.3 — Streptocoques, entérocoques et autres cocci Gram positif

**Contenu obligatoire** :
- Streptocoques bêta-hémolytiques du groupe A (*S. pyogenes*) : arthrite septique fulminante, fasciite nécrosante
- Streptocoques du groupe B (*S. agalactiae*) : nouveau-né, diabétique, immunodéprimé
- *Streptococcus pneumoniae* : arthrite septique de l'enfant (2ème agent après *S. aureus*), association avec pneumonie/méningite
- Streptocoques du groupe viridans : endocardite → embolies septiques osseuses
- *Enterococcus faecalis* et *E. faecium* : infections polymicrobiennes, résistance naturelle aux céphalosporines, ERV (Entérocoque Résistant à la Vancomycine)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA03-S03-001 | 📊 INFOGRAPHIE | Classification et virulence des streptocoques selon le groupe de Lancefield | Tableau synthétique |
| MIOA03-S03-002 | 📐 SCHÉMA | Arthrite septique à streptocoque du groupe A — fasciite associée | Coupe anatomique |

### Section 3.4 — Bacilles Gram négatif

**Contenu obligatoire** :
- *Escherichia coli* : IOA par contiguïté (urinaire ++), sujets âgés
- *Pseudomonas aeruginosa* : ostéomyélite du pied (toxicomane, diabétique), fractures ouvertes, milieu humide
- *Kingella kingae* : première cause d'IOA ostéoarticulaire chez l'enfant <4 ans dans certaines séries, difficile à cultiver
- *Salmonella* spp. : ostéomyélite drépanocytaire (classique !), rôle de l'ischémie médullaire
- *Brucella* spp. : zone endémique (Méditerranée, Moyen-Orient), spondylodiscite, sacro-iliite
- Entérobactéries BLSE et EPC : problème croissant, options thérapeutiques limitées
- *Haemophilus influenzae* : historiquement fréquent chez l'enfant, drastiquement réduit par la vaccination

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA03-S04-001 | 📊 INFOGRAPHIE | Tableau : BGN et leurs contextes cliniques favorisants | Tableau de synthèse |
| MIOA03-S04-002 | 📐 SCHÉMA | *Kingella kingae* chez l'enfant — physiopathologie (colonisation oropharyngée → bactériémie → IOA) | Chemin d'infection |
| MIOA03-S04-003 | 📐 SCHÉMA | Ostéomyélite à *Salmonella* chez le drépanocytaire — physiopathologie (ischémie + nécrose médullaire + immunodépression fonctionnelle) | Schéma physiopathologique |

### Section 3.5 — Anaérobies, mycobactéries et germes inhabituels

**Contenu obligatoire** :
- **Anaérobies** : *Cutibacterium acnes* (prothèse d'épaule ++, incubation prolongée ≥14 jours), *Bacteroides*, *Fusobacterium*
- **Mycobactéries** : *M. tuberculosis* (mal de Pott, arthrite), mycobactéries atypiques (*M. marinum*, *M. avium*, *M. abscessus*)
- **Champignons** : *Candida* spp. (immunodéprimé, UDIV), *Aspergillus* (rachis, immunodéprimé), champignons dimorphiques tropicaux
- **Parasites** : échinococcose osseuse (rare mais classique en zone d'endémie)
- Infections polymicrobiennes : fractures ouvertes, pied diabétique, escarre
- Importance de l'incubation prolongée et des cultures adaptées

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA03-S05-001 | 📷 IMAGE | *Cutibacterium acnes* — culture sur gélose sang après 14 jours d'incubation | Photo typique |
| MIOA03-S05-002 | 📐 SCHÉMA | Répartition des germes selon le type d'IOA : hématogène enfant, hématogène adulte, post-op, péri-prothétique, pied diabétique | 5 camemberts |
| MIOA03-S05-003 | 📊 INFOGRAPHIE | Conditions de culture spéciales par germe suspecté | Tableau pratique pour le laboratoire |

### Section 3.6 — Profils de résistance et impact thérapeutique

**Contenu obligatoire** :
- SARM : mécanisme mecA, PBP2a, impact sur le traitement (vancomycine, daptomycine, linézolide, TMP-SMX)
- BLSE : mécanisme de résistance aux céphalosporines, impact (carbapénèmes)
- EPC : résistance aux carbapénèmes (NDM, KPC, OXA-48), « impasse thérapeutique », options (colistine, ceftazidime-avibactam, céfidérocol)
- Résistance à la rifampicine : usage en combinaison obligatoire, jamais en monothérapie
- Résistance aux fluoroquinolones : mutation topoisomérase, impact dans les IOA à staphylocoque
- Concept d'antibiogramme élargi et CMI
- Rôle du référent en antibiothérapie

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA03-S06-001 | 🎬 ANIMATION | Mécanisme de résistance SARM : gène mecA → PBP2a → résistance à toutes les bêta-lactamines | Animation moléculaire |
| MIOA03-S06-002 | 📊 INFOGRAPHIE | Arbre décisionnel antibiothérapie selon le profil de résistance | Algorithme coloré |
| MIOA03-S06-003 | 📊 INFOGRAPHIE | Surveillance épidémiologique de la résistance en France — données EARS-Net/ONERBA | Graphiques temporels |

### Points clés du Module 3

1. *S. aureus* est le principal agent des IOA avec un arsenal de virulence considérable (MSCRAMMs, PVL, toxines, SCV)
2. Les SCN (*S. epidermidis*) dominent les infections sur matériel grâce à leur capacité à former un biofilm
3. *Kingella kingae* est devenue la première cause d'IOA chez l'enfant <4 ans dans certaines séries
4. *Salmonella* est classiquement associée à l'ostéomyélite du drépanocytaire
5. *Cutibacterium acnes* nécessite une incubation prolongée (≥14 jours) et est fréquent dans les infections de prothèse d'épaule
6. La résistance bactérienne (SARM, BLSE, EPC) impose une approche microbiologique rigoureuse et une antibiothérapie adaptée
7. Les infections polymicrobiennes sont fréquentes dans les fractures ouvertes et le pied diabétique
8. Les SCV de *S. aureus* expliquent de nombreuses récidives par leur survie intracellulaire dans les ostéoblastes

---

# MODULE 4 : PHYSIOPATHOLOGIE DE L'INFECTION OSSEUSE ET BIOFILM

**Partie** : I — Histoire et Fondamentaux
**Durée estimée** : 3h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 2, 3

## Accroche clinique

> 🏥 **Cas clinique — Mme Durand, 65 ans** : PTG posée il y a 5 ans. Douleurs progressives depuis 18 mois, raideur du genou. CRP modérément élevée (18 mg/L). Re-intervention : le chirurgien observe un film blanchâtre brillant à la surface de l'implant tibial. La sonication de l'explant révèle un *Staphylococcus epidermidis* en grande quantité, alors que les prélèvements per-opératoires standard étaient négatifs. *Qu'est-ce que ce « film brillant » ? Pourquoi les cultures standard étaient-elles négatives ? Pourquoi l'antibiotique seul ne peut-il pas guérir cette infection ?*

## Objectifs d'apprentissage

1. **Expliquer** les étapes de la colonisation bactérienne de l'os (adhésion, invasion, multiplication, nécrose)
2. **Décrire** la formation du biofilm en 5 étapes et ses implications thérapeutiques
3. **Comprendre** le concept de séquestre osseux et les mécanismes de nécrose vasculaire
4. **Analyser** la réponse inflammatoire osseuse (aiguë → chronique) et ses conséquences
5. **Expliquer** pourquoi le biofilm rend l'infection réfractaire aux antibiotiques et à l'immunité
6. **Distinguer** les mécanismes de l'ostéomyélite hématogène vs post-traumatique vs sur matériel

## Structure du contenu

### Section 4.1 — De la bactériémie à la colonisation osseuse

**Contenu obligatoire** :
- Phase initiale : adhésion bactérienne aux composants de la matrice extracellulaire osseuse (collagène, fibronectine, os dénaturé)
- Rôle des MSCRAMMs et des adhésines dans l'attachement initial
- Invasion des ostéoblastes et des ostéocytes par *S. aureus* (internalisation active)
- Survie intracellulaire : échappement au lysosome, adaptation métabolique (SCV)
- Induction de l'apoptose des ostéoblastes par *S. aureus* (activation des caspases, toxines)
- Déséquilibre ostéoblastes/ostéoclastes : activation RANKL, inhibition OPG → résorption osseuse accélérée
- Lacunes de Howship + ostéoclastogenèse médiée par les cytokines bactériennes et de l'hôte

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA04-S01-001 | 🎬 ANIMATION | Cycle complet de colonisation osseuse : bactériémie → adhésion → invasion → multiplication → nécrose | Animation en 5 phases |
| MIOA04-S01-002 | 📐 SCHÉMA | Interaction moléculaire *S. aureus*-ostéoblaste : adhésines, intégrine α5β1, internalisation | Zoom cellulaire |
| MIOA04-S01-003 | 🎬 ANIMATION | Déséquilibre ostéoblastes/ostéoclastes : activation RANKL → ostéolyse | Animation osseuse |
| MIOA04-S01-004 | 📐 SCHÉMA | Cycle de destruction osseuse : bactéries → inflammation → ostéoclastogenèse → résorption → expansion | Cycle physiopathologique |

### Section 4.2 — Le biofilm : la forteresse bactérienne

**Contenu obligatoire** :
- **Définition** : communauté structurée de micro-organismes enveloppés dans une matrice extracellulaire autosynthétisée, adhérents à une surface (vivante ou inerte)
- **Les 5 étapes de formation du biofilm** :
  1. **Attachement réversible** : adhésion initiale (forces de Van der Waals, interactions hydrophobes) — minutes
  2. **Attachement irréversible** : production d'adhésines, liaisons spécifiques — heures
  3. **Maturation précoce** : sécrétion de la matrice exopolysaccharidique (EPS), structuration en microcolonies — jours
  4. **Maturation avancée** : architecture complexe (tours, canaux hydriques), hétérogénéité métabolique, phénotype « sessile » — semaines
  5. **Dispersion** : libération de bactéries planctoniques pour coloniser de nouveaux sites — variable
- **Composition de la matrice du biofilm** : polysaccharides (PIA/PNAG), protéines, ADN extracellulaire (eDNA), lipides
- **Pourquoi le biofilm rend l'infection réfractaire** :
  - Barrière physique : diffusion limitée des antibiotiques et des cellules immunitaires
  - Hétérogénéité métabolique : bactéries en dormance (persisters) → insensibles aux ATB qui ciblent la croissance
  - Échanges génétiques : transfert horizontal de gènes de résistance facilité
  - Tolérance vs résistance : les bactéries du biofilm sont « tolérantes » (pas résistantes génétiquement) mais deviennent résistantes à des concentrations 100-1000× la CMI
- **Le concept de « fenêtre antibiofilm »** : les premières heures post-contamination sont critiques — le biofilm n'est pas encore mature

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA04-S02-001 | 🎬 ANIMATION | Les 5 étapes du biofilm — animation complète du cycle | Animation 3D essentielle |
| MIOA04-S02-002 | 📷 IMAGE | Biofilm sur implant en microscopie électronique à balayage (MEB) — image réelle | Photo MEB spectaculaire |
| MIOA04-S02-003 | 📐 SCHÉMA | Architecture du biofilm mature : tours, canaux, zones de dormance, zones actives | Coupe transversale |
| MIOA04-S02-004 | 📊 INFOGRAPHIE | Biofilm vs bactéries planctoniques : comparaison des propriétés (sensibilité ATB, détection, métabolisme) | Tableau de comparaison |
| MIOA04-S02-005 | 🎬 ANIMATION | Concept de « fenêtre antibiofilm » : chronologie de la maturation et moment optimal d'intervention | Timeline critique |
| MIOA04-S02-006 | 📐 SCHÉMA | Mécanismes de tolérance du biofilm aux antibiotiques — barrière, dormance, pompes d'efflux, transfert de gènes | 4 mécanismes illustrés |

### Section 4.3 — Formation du séquestre et involucrum

**Contenu obligatoire** :
- **Séquestre** : fragment d'os nécrosé (dévascularisé), déconnecté de l'os vivant, colonisé par les bactéries
  - Mécanisme : thrombose des vaisseaux intra-osseux → ischémie → nécrose → os mort = corps étranger
  - Le séquestre est inaccessible aux antibiotiques systémiques (pas de vascularisation) et aux cellules immunitaires
  - Support idéal pour le biofilm
- **Involucrum** : néoformation osseuse périostée réactionnelle autour du séquestre (par le cambium du périoste)
  - Mécanisme : réaction périostée de défense, ostéogenèse réactionnelle
  - L'involucrum peut englober le séquestre de manière plus ou moins complète
- **Cloaque** : ouverture dans l'involucrum par laquelle le pus s'écoule (communication avec la surface)
- **Fistule** : trajet fistuleux depuis le cloaque jusqu'à la peau (sortie du pus)
- Séquence complète : infection → nécrose vasculaire → séquestre → réaction périostée → involucrum → cloaque → fistule
- Classification de Cierny-Mader : rôle de l'anatomie de l'atteinte osseuse (médullaire, superficielle, locale, diffuse)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA04-S03-001 | 🎬 ANIMATION | Formation du séquestre et de l'involucrum — de l'infection au cloaque | Animation physiopathologique complète |
| MIOA04-S03-002 | 📐 SCHÉMA | Coupe d'un os avec séquestre, involucrum, cloaque et fistule — anatomie pathologique | Schéma classique annoté |
| MIOA04-S03-003 | 📷 IMAGE | Radiographie montrant un séquestre osseux classique (tibia) | Image radiographique annotée |
| MIOA04-S03-004 | 📐 SCHÉMA | Classification de Cierny-Mader : 4 types anatomiques × 3 classes d'hôte | Schéma 12 cases |
| MIOA04-S03-005 | 📷 IMAGE | Pièce opératoire de séquestrectomie — os nécrosé extrait chirurgicalement | Photo per-opératoire |

### Section 4.4 — Réponse immunitaire et inflammation osseuse

**Contenu obligatoire** :
- **Phase aiguë** (<2 semaines) :
  - Recrutement des PNN par chimiotactisme (IL-8, C5a, fMLP)
  - Phagocytose bactérienne et dégranulation
  - Activation du complément (voie alterne et classique)
  - Production de cytokines pro-inflammatoires (TNF-α, IL-1β, IL-6)
  - Œdème, hyperpression intra-osseuse, thrombose → cercle vicieux ischémique
- **Phase chronique** (>4-6 semaines) :
  - Passage à une réponse lymphocytaire (LT, LB, macrophages activés)
  - Formation de granulome péri-infectieux
  - Fibrose péri-lésionnelle
  - Équilibre instable : infection quiescente vs réactivation
  - Remodelage osseux pathologique : sclérose, épaississement cortical
- **Évasion immunitaire bactérienne** :
  - Protéine A (IgG-binding)
  - Capsule polysaccharidique
  - Biofilm
  - SCV (internalisation)
  - Superantigènes (dérégulation lymphocytaire)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA04-S04-001 | 🎬 ANIMATION | Réponse immunitaire aiguë dans l'os : PNN, complément, cytokines, hyperpression | Animation immunologique |
| MIOA04-S04-002 | 📐 SCHÉMA | Cercle vicieux de l'ostéomyélite aiguë : infection → inflammation → œdème → ischémie → nécrose → infection | Cycle vicieux |
| MIOA04-S04-003 | 📊 INFOGRAPHIE | Phase aiguë vs phase chronique de l'ostéomyélite — différences histologiques et immunologiques | Tableau de comparaison |
| MIOA04-S04-004 | 📐 SCHÉMA | Mécanismes d'évasion immunitaire de *S. aureus* — 5 stratégies | Schéma en étoile |

### Section 4.5 — Physiopathologie de l'infection sur matériel

**Contenu obligatoire** :
- « The race for the surface » (Gristina, 1987) : compétition entre cellules de l'hôte et bactéries pour coloniser la surface de l'implant
- Conditionnement de l'implant : adsorption instantanée de protéines de l'hôte (fibrinogène, fibronectine, albumine) → création d'un film conditionnant
- Adhésion bactérienne au film conditionnant (adhésines + forces physiques)
- Propriétés de surface : rugosité, hydrophobicité, charge → influence sur l'adhésion
- Types de surface : acier, titane, cobalt-chrome, PMMA (ciment), polyéthylène → susceptibilités variables
- Biofilm sur implant : même séquence que sur os, mais la surface inerte est un substrat idéal
- Conséquence thérapeutique : le biofilm sur implant est **impossible à éradiquer sans retrait du matériel** (sauf DAIR très précoce)
- Rôle de la sonication pour détacher et identifier les bactéries du biofilm

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA04-S05-001 | 🎬 ANIMATION | « Race for the surface » de Gristina : cellules hôte vs bactéries sur l'implant | Animation conceptuelle clé |
| MIOA04-S05-002 | 📐 SCHÉMA | Film conditionnant sur implant : protéines adsorbées → point d'ancrage bactérien | Zoom surface implant |
| MIOA04-S05-003 | 📊 INFOGRAPHIE | Susceptibilité au biofilm par type de matériau (acier > CoCr > titane > céramique) | Tableau comparatif |
| MIOA04-S05-004 | 🎬 ANIMATION | Sonication d'un explant : détachement du biofilm, mise en culture | Technique de laboratoire |
| MIOA04-S05-005 | 📐 SCHÉMA | Arbre décisionnel : conserver l'implant (DAIR) vs retirer l'implant selon la maturité du biofilm | Algorithme |

### Points clés du Module 4

1. L'infection osseuse suit une séquence : adhésion → invasion → multiplication → nécrose → séquestre → chronicité
2. Le biofilm se forme en 5 étapes (attachement réversible → irréversible → maturation précoce → maturation avancée → dispersion) et rend l'infection 100-1000× plus résistante aux antibiotiques
3. Le séquestre osseux est un os nécrosé dévascularisé qui sert de sanctuaire bactérien inaccessible aux défenses et aux antibiotiques
4. La « race for the surface » (Gristina) explique pourquoi les premières heures post-implantation sont critiques
5. Le biofilm sur implant impose le retrait du matériel sauf dans le cadre d'un DAIR très précoce (<4 semaines)
6. Les SCV de *S. aureus* survivent dans les ostéoblastes et expliquent les récidives à distance
7. L'évasion immunitaire multifactorielle de *S. aureus* (protéine A, capsule, biofilm, SCV, superantigènes) rend son éradication particulièrement difficile

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 2 — Immunologie et Terrain (Modules 5-6)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 5 : IMMUNOLOGIE DE L'OS ET RÉPONSE DE L'HÔTE

**Partie** : II — Immunologie et Terrain
**Durée estimée** : 3h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 3, 4

## Accroche clinique

> 🏥 **Cas clinique — M. Kouadio, 45 ans** : VIH+ avec CD4 à 180/mm³ sous ARV. Fracture ouverte du tibia (Gustilo II) traitée par enclouage centromédullaire. À J+15, fièvre, écoulement purulent de la plaie. Malgré un traitement ATB bien conduit, l'infection récidive 3 fois en 18 mois. *Pourquoi l'immunodépression rend-elle l'éradication si difficile ? Quels mécanismes immunitaires sont défaillants ?*

## Objectifs d'apprentissage

1. **Décrire** les composantes de l'immunité innée et adaptative dans l'os
2. **Expliquer** le rôle des cellules osseuses (ostéoblastes, ostéocytes, ostéoclastes) dans la réponse anti-infectieuse
3. **Analyser** comment les cytokines et les voies de signalisation contrôlent l'inflammation osseuse
4. **Comprendre** les mécanismes d'évasion immunitaire des principaux pathogènes osseux
5. **Identifier** les déficits immunitaires prédisposant aux IOA récidivantes

## Structure du contenu

### Section 5.1 — Immunité innée dans le tissu osseux

**Contenu obligatoire** :
- **Barrières physiques** : périoste, cortex osseux, tissu mou périphérique
- **Cellules sentinelles** : macrophages résidents (ostéomacs), cellules dendritiques osseuses, mastocytes médullaires
- **Reconnaissance** : récepteurs PRR (TLR2, TLR4, TLR9, NOD1, NOD2), reconnaissance des PAMPs staphylococciques (acide lipotéichoïque, peptidoglycane, lipopeptides)
- **Réponse des PNN** : chimiotactisme, diapédèse, phagocytose, burst oxydatif, NETs (Neutrophil Extracellular Traps)
- **Système du complément** : activation dans l'os infecté, opsonisation, complexe d'attaque membranaire
- **Inflammation locale** : cascade de cytokines (TNF-α, IL-1β, IL-6, IL-8, IL-17), chimioattraction, vasodilatation
- Les ostéoblastes comme cellules immunitaires : production de cytokines, de peptides antimicrobiens (défensines, cathélicidines)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA05-S01-001 | 🎬 ANIMATION | Immunité innée osseuse : de la détection (TLR) à la réponse (PNN, complément) | Animation immuno complète |
| MIOA05-S01-002 | 📐 SCHÉMA | PRR osseux : TLR2/4/9, NOD1/2 et leurs ligands staphylococciques | Schéma récepteur-ligand |
| MIOA05-S01-003 | 📐 SCHÉMA | NETs (pièges extracellulaires des neutrophiles) : mécanisme et rôle dans l'os | Schéma cellulaire |
| MIOA05-S01-004 | 📊 INFOGRAPHIE | L'ostéoblaste comme « cellule immunitaire » : cytokines et peptides antimicrobiens produits | Infographie originale |

### Section 5.2 — Immunité adaptative et mémoire immunitaire osseuse

**Contenu obligatoire** :
- **Lymphocytes T** : rôle des LT CD4+ (Th1, Th17) dans le contrôle de l'infection osseuse
- **Lymphocytes Th17** : production d'IL-17 → recrutement de PNN, rôle pivot dans l'ostéomyélite chronique
- **Lymphocytes T régulateurs (Treg)** : rôle ambivalent — contrôle de l'inflammation vs immunosuppression favorisant la chronicité
- **Lymphocytes B et immunoglobulines** : opsonisation, neutralisation des toxines, rôle limité dans l'os
- **Immunité muqueuse et vaccination** : pertinence de la vaccination anti-*S. aureus* (échecs passés, recherche en cours)
- **Cellules NK** : rôle émergent dans la surveillance anti-infectieuse osseuse
- Immunité « entraînée » (*trained immunity*) : concept émergent — capacité des monocytes/macrophages à développer une mémoire innée

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA05-S02-001 | 📐 SCHÉMA | Polarisation Th1/Th17/Treg dans l'ostéomyélite — rôles respectifs | Schéma de balance immunitaire |
| MIOA05-S02-002 | 🎬 ANIMATION | Réponse adaptative dans l'os : présentation antigénique → activation LT → contrôle de l'infection | Animation séquentielle |
| MIOA05-S02-003 | 📊 INFOGRAPHIE | Pourquoi il n'existe pas de vaccin anti-*S. aureus* efficace — obstacles | Infographie explicative |

### Section 5.3 — Axe RANK/RANKL/OPG et remodelage osseux infectieux

**Contenu obligatoire** :
- **Axe RANK/RANKL/OPG** : régulateur majeur de l'homéostasie osseuse
- En contexte infectieux : surexpression de RANKL par les ostéoblastes (stimulés par TNF-α, IL-1β, PGE2) → activation massive des ostéoclastes → résorption osseuse pathologique
- Diminution de l'OPG (récepteur leurre protecteur) en contexte infectieux
- Stimulation directe des ostéoclastes par les produits bactériens (LPS, acide lipotéichoïque)
- **Ostéolyse infectieuse** : mécanisme combiné (direct bactérien + indirect via inflammation)
- Lien avec la formation du séquestre : quand la balance résorption/formation est totalement déséquilibrée
- Perspectives thérapeutiques : inhibiteurs de RANKL (dénosumab) comme adjuvants anti-infectieux ? (recherche préclinique)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA05-S03-001 | 🎬 ANIMATION | Axe RANK/RANKL/OPG en conditions normales vs infection : déséquilibre et ostéolyse | Animation comparative |
| MIOA05-S03-002 | 📐 SCHÉMA | Mécanismes d'ostéolyse infectieuse : voie directe (bactérie → os) + voie indirecte (inflammation → RANKL → ostéoclaste → résorption) | Double voie illustrée |
| MIOA05-S03-003 | 📊 INFOGRAPHIE | Cibles thérapeutiques potentielles de l'axe RANK/RANKL/OPG en contexte infectieux | Schéma prospectif |

### Section 5.4 — Ostéo-immunologie : les cellules osseuses comme acteurs immunitaires

**Contenu obligatoire** :
- **Ostéoblastes** : production de cytokines (IL-6, IL-8, MCP-1), chimiokines, peptides antimicrobiens, expression de TLR
- **Ostéocytes** : cellules les plus abondantes de l'os, réseau lacuno-canaliculaire = système de « surveillance », production de RANKL et sclérostine en réponse à l'infection
- **Ostéoclastes** : résorption de l'os infecté (double tranchant : élimine le tissu infecté mais détruit l'architecture)
- **Macrophages ostéaux (ostéomacs)** : population résidente unique, canopy cells, rôle dans la réparation osseuse post-infectieuse
- **Interaction os-moelle** : la moelle osseuse comme organe immunitaire (production de PNN, monocytes, lymphocytes) — l'infection médullaire compromet l'immunité systémique
- Concept d'ostéo-immunologie : discipline émergente unifiant biologie osseuse et immunologie

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA05-S04-001 | 📐 SCHÉMA | Le réseau lacuno-canaliculaire des ostéocytes comme système de surveillance anti-infectieuse | Zoom microscopique |
| MIOA05-S04-002 | 🎬 ANIMATION | Activation des ostéomacs par l'infection : phagocytose, cytokines, recrutement | Animation cellulaire |
| MIOA05-S04-003 | 📊 INFOGRAPHIE | Synthèse ostéo-immunologique : chaque cellule osseuse et son rôle immunitaire | Tableau illustré |

### Points clés du Module 5

1. Les ostéoblastes sont de véritables cellules immunitaires produisant cytokines, chimiokines et peptides antimicrobiens
2. L'axe RANK/RANKL/OPG est massivement déséquilibré en cas d'infection, causant une ostéolyse pathologique
3. Les LT Th17 jouent un rôle pivot dans le recrutement des PNN et le contrôle de l'infection osseuse
4. Les Treg ont un rôle ambivalent : contrôle de l'inflammation excessive vs facilitation de la chronicité
5. Les ostéocytes forment un réseau de surveillance via le système lacuno-canaliculaire
6. L'absence de vaccin efficace contre *S. aureus* reste un défi majeur de la recherche

---

# MODULE 6 : FACTEURS DE RISQUE ET TERRAIN — DIABÈTE, IMMUNODÉPRESSION, DÉNUTRITION

**Partie** : II — Immunologie et Terrain
**Durée estimée** : 3h00
**Niveau** : Intermédiaire
**Prérequis** : Module 5

## Accroche clinique

> 🏥 **Cas clinique — Mme Toussaint, 67 ans** : Diabétique de type 2 (HbA1c = 9.2%), obèse (IMC 38), insuffisante rénale chronique stade 3. PTG droite posée il y a 4 mois. Infection précoce à *S. aureus* SASM. DAIR réalisé avec 12 semaines d'antibiothérapie. Récidive à 6 mois avec le même germe. *Pourquoi cette patiente cumule-t-elle les facteurs de risque ? Quels sont les mécanismes par lesquels le diabète, l'obésité et l'insuffisance rénale favorisent l'infection ?*

## Objectifs d'apprentissage

1. **Identifier** les principaux facteurs de risque d'IOA (modifiables et non modifiables)
2. **Expliquer** les mécanismes physiopathologiques par lesquels le diabète favorise l'infection osseuse
3. **Analyser** l'impact de l'immunodépression (VIH, chimiothérapie, corticothérapie, biologiques) sur les IOA
4. **Comprendre** le rôle de la dénutrition et de l'obésité dans la susceptibilité aux IOA
5. **Appliquer** la classification McPherson de l'hôte pour stratifier le risque
6. **Proposer** des stratégies d'optimisation préopératoire

## Structure du contenu

### Section 6.1 — Diabète et infections ostéoarticulaires

**Contenu obligatoire** :
- **Épidémiologie** : risque d'infection du site opératoire ×2-5 chez le diabétique
- **Mécanismes** :
  - Dysfonction des PNN : chimiotactisme altéré, phagocytose diminuée, burst oxydatif réduit
  - Microangiopathie : ischémie tissulaire, cicatrisation retardée
  - Neuropathie : perte de la sensibilité protectrice → ulcère → porte d'entrée
  - Macroangiopathie : AOMI, ischémie de membre
  - Glycation des protéines (AGEs) : altération de la matrice extracellulaire, dysfonction endothéliale
  - Hyperglycémie : milieu favorable à la croissance bactérienne
- **Impact sur le traitement** : cicatrisation cutanée retardée, diffusion antibiotique altérée, insuffisance rénale (dosage des ATB)
- **Seuil d'HbA1c** : optimisation préopératoire visée <7-8% (débat sur le seuil optimal)
- Glycémie péri-opératoire : cible <180 mg/dL, insulinothérapie IVSE si besoin
- **Pied diabétique** : paradigme de l'IOA par contiguïté (renvoi vers Module 23)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA06-S01-001 | 🎬 ANIMATION | Mécanismes diabétiques favorisant l'IOA : PNN, microangiopathie, neuropathie, hyperglycémie | Animation multimécanisme |
| MIOA06-S01-002 | 📐 SCHÉMA | Cascade diabétique : hyperglycémie → AGEs → dysfonction endothéliale → ischémie → infection | Schéma en cascade |
| MIOA06-S01-003 | 📊 INFOGRAPHIE | Checklist d'optimisation préopératoire du patient diabétique | Infographie pratique |

### Section 6.2 — Immunodépression et infections sévères

**Contenu obligatoire** :
- **VIH/SIDA** : risque corrélé au taux de CD4 (<200/mm³ = risque maximal), germes opportunistes, interactions médicamenteuses ARV-ATB
- **Chimiothérapie et neutropénie** : neutropénie fébrile + suspicion d'IOA, germes fongiques (Aspergillus, Candida)
- **Corticothérapie au long cours** : inhibition PNN et macrophages, retard de cicatrisation, ostéoporose (fragilité osseuse)
- **Biothérapies** :
  - Anti-TNF (infliximab, adalimumab) : risque infectieux ×2-3, tuberculose réactivée +++
  - Rituximab (anti-CD20) : hypogammaglobulinémie, infections tardives
  - Tocilizumab (anti-IL-6R) : masque la CRP ! (faux négatif biologique)
  - JAK inhibiteurs (tofacitinib, baricitinib) : risque d'infections opportunistes
- **Transplantation d'organe** : immunosuppresseurs combinés, risque fongique et viral
- **Déficits immunitaires congénitaux** : granulomatose septique chronique (CGD), déficits de l'immunité innée — IOA récidivantes de l'enfant
- **Splénectomie** : risque d'infections à bactéries encapsulées

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA06-S02-001 | 📊 INFOGRAPHIE | Tableau des immunodépressions et risques infectieux osseux associés | Tableau synthétique complet |
| MIOA06-S02-002 | 📐 SCHÉMA | Biothérapies et cibles immunologiques : anti-TNF, anti-IL-6, anti-CD20, JAKi | Schéma des cibles |
| MIOA06-S02-003 | ⚠️ ENCADRÉ | Alerte : tocilizumab masque la CRP — piège diagnostique majeur | Encadré danger |

### Section 6.3 — Dénutrition, obésité et facteurs métaboliques

**Contenu obligatoire** :
- **Dénutrition** :
  - Critères : albumine <30 g/L, préalbumine <15 mg/dL, IMC <18.5, perte de poids >10% en 6 mois
  - Impact : cicatrisation ↓, immunité ↓ (lymphopénie, dysfonction PNN), hypoprotidémie → œdèmes
  - Supplémentation préopératoire : immunonutrition (arginine, glutamine, oméga-3)
- **Obésité** :
  - IMC >35 : risque infection ×2-3 post-arthroplastie
  - Mécanismes : tissu adipeux pro-inflammatoire (adipokines), difficultés chirurgicales (exposition, durée opératoire allongée), hypoperfusion du tissu sous-cutané
  - Seuil pondéral pour arthroplastie : débat IMC 40 vs 45
- **Tabac** : vasoconstriction, hypoxie tissulaire, dysfonction immunitaire — risque infection ×2
- **Alcoolisme** : dysfonction hépatique, dénutrition, immunodépression
- **Insuffisance rénale chronique** : immunodépression urémique, anémie, trobles de la cicatrisation, ajustement des doses d'ATB
- **Anémie** : hypoxie tissulaire, cicatrisation retardée

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA06-S03-001 | 📊 INFOGRAPHIE | Score de risque infectieux pré-opératoire : critères cumulatifs | Checklist pondérée |
| MIOA06-S03-002 | 📐 SCHÉMA | Obésité et infection : tissu adipeux pro-inflammatoire, adipokines, perfusion cutanée | Schéma physiopathologique |
| MIOA06-S03-003 | 📊 INFOGRAPHIE | Protocole d'optimisation nutritionnelle préopératoire | Infographie pratique |

### Section 6.4 — Classification McPherson de l'hôte et stratification du risque

**Contenu obligatoire** :
- Classification McPherson (adaptation de Cierny-Mader pour les infections périprothétiques) :
  - **Hôte A** : non compromis (pas de comorbidités majeures)
  - **Hôte B** : compromis — sous-types :
    - B-L : compromission locale (peau fragile, cicatrice, lymphœdème, irradiation)
    - B-S : compromission systémique (diabète, immunodépression, malnutrition)
    - B-LS : compromission locale ET systémique
  - **Hôte C** : patient dont le traitement chirurgical présente un risque supérieur au bénéfice (traitement suppressif seul)
- Application pratique : le type d'hôte influence la stratégie thérapeutique (1 temps vs 2 temps vs DAIR vs suppressif)
- Scores de risque pré-opératoire : ASA, Charlson Comorbidity Index, NNIS, Elixhauser
- Discussion RCP : intégration du terrain dans la décision thérapeutique

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA06-S04-001 | 📊 INFOGRAPHIE | Classification McPherson de l'hôte : A, B-L, B-S, B-LS, C | Schéma illustré avec exemples |
| MIOA06-S04-002 | 📐 SCHÉMA | Algorithme décisionnel selon le type d'hôte : stratégie thérapeutique adaptée | Arbre de décision |
| MIOA06-S04-003 | 📊 INFOGRAPHIE | Scores de comorbidités utilisés en IOA : ASA, Charlson, NNIS | Tableaux comparatifs |

### Points clés du Module 6

1. Le diabète augmente le risque d'IOA par au moins 4 mécanismes : dysfonction PNN, microangiopathie, neuropathie, hyperglycémie
2. Le tocilizumab (anti-IL-6R) masque la CRP — piège diagnostique majeur à connaître
3. La dénutrition (albumine <30 g/L) et l'obésité (IMC >35) sont des facteurs de risque indépendants d'IOA
4. Le tabac double le risque d'infection du site opératoire
5. La classification McPherson stratifie le risque de l'hôte (A, B, C) et guide la stratégie thérapeutique
6. L'optimisation préopératoire (glycémie, nutrition, arrêt du tabac) est fondamentale pour réduire le risque

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 3 — Diagnostic (Modules 7-10)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 7 : DIAGNOSTIC CLINIQUE ET BIOLOGIQUE DES IOA

**Partie** : III — Diagnostic
**Durée estimée** : 3h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 1-6

## Accroche clinique

> 🏥 **Cas clinique — Léa, 3 ans** : Boiterie depuis 48h, refus de marcher, fièvre à 38.8°C. Pas de traumatisme rapporté. Examen : limitation douloureuse de la rotation interne de hanche droite, pas de signes cutanés. NFS : GB 14 500/mm³ (82% PNN), CRP 78 mg/L. *Arthrite septique de hanche ou rhume de hanche ? Comment trancher ? Quels critères vous aident à décider ?*

## Objectifs d'apprentissage

1. **Reconnaître** les présentations cliniques des IOA selon le site et l'âge
2. **Appliquer** les critères prédictifs de Kocher (arthrite septique de hanche de l'enfant)
3. **Interpréter** les marqueurs biologiques inflammatoires (CRP, VS, PCT, GB, IL-6)
4. **Distinguer** les présentations aiguës, subaiguës et chroniques
5. **Connaître** les pièges diagnostiques et diagnostics différentiels
6. **Organiser** la démarche diagnostique de manière systématique

## Structure du contenu

### Section 7.1 — Sémiologie clinique des IOA aiguës

**Contenu obligatoire** :
- **Signes généraux** : fièvre (absente dans 50% des IOA post-chirurgicales !), frissons, altération de l'état général
- **Signes locaux** :
  - Os : douleur exquise métaphysaire (ostéomyélite enfant), œdème, chaleur, rougeur, impotence fonctionnelle
  - Articulation : épanchement (fluctuation), limitation douloureuse active et passive, position antalgique
  - Matériel : douleur persistante ou récurrente après chirurgie, écoulement de plaie, désunion cicatricielle, fistule
- **Particularités selon l'âge** :
  - Nouveau-né : pseudo-paralysie, irritabilité, sepsis
  - Nourrisson : boiterie, pleurs à la mobilisation, fièvre inconstante
  - Enfant : présentation classique (douleur + fièvre + impotence)
  - Adulte : présentation souvent atténuée, surtout en post-chirurgical
  - Sujet âgé : tableau souvent fruste, apyrexie fréquente, confusion
- **Examen clinique systématique** : palpation osseuse, mobilité articulaire, examen vasculo-nerveux, recherche de porte d'entrée

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA07-S01-001 | 📐 SCHÉMA | Sémiologie clinique de l'ostéomyélite aiguë de l'enfant — points de palpation métaphysaire | Squelette enfant annoté |
| MIOA07-S01-002 | 📷 IMAGE | Arthrite septique du genou — épanchement clinique, position antalgique en flexion | Photo clinique |
| MIOA07-S01-003 | 📷 IMAGE | Infection post-opératoire de plaie chirurgicale — écoulement, rougeur péri-cicatricielle | Photo clinique |
| MIOA07-S01-004 | 📊 INFOGRAPHIE | Particularités cliniques par tranche d'âge (nouveau-né → sujet âgé) | Tableau comparatif |

### Section 7.2 — Présentations subaiguës et chroniques

**Contenu obligatoire** :
- **IOA subaiguë** : évolution >2 semaines, symptômes atténués, biologie modérément perturbée
  - Abcès de Brodie : forme subaiguë d'ostéomyélite métaphysaire — lésion lytique bien limitée avec sclérose périlésionnelle
  - Spondylodiscite subaiguë : dorsalgie/lombalgie progressive, raideur rachidienne
- **IOA chronique** (>4-6 semaines) :
  - Fistule cutanée chronique = quasi-pathognomonique d'ostéomyélite chronique (ou d'infection sur matériel)
  - Épisodes d'exacerbation et de rémission
  - Douleur chronique
  - Amyotrophie, raideur articulaire
  - Biologie souvent peu perturbée (CRP normale possible !)
- **Rechute vs réinfection** : même germe (rechute) vs germe différent (réinfection) — implications thérapeutiques différentes

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA07-S02-001 | 📷 IMAGE | Abcès de Brodie typique (radiographie + IRM) | Images radiologiques annotées |
| MIOA07-S02-002 | 📷 IMAGE | Fistule cutanée chronique sur ostéomyélite chronique du tibia | Photo clinique |
| MIOA07-S02-003 | 📊 INFOGRAPHIE | IOA aiguë vs subaiguë vs chronique : comparaison clinico-biologique | Tableau de 3 colonnes |

### Section 7.3 — Marqueurs biologiques inflammatoires

**Contenu obligatoire** :
- **CRP (C-Reactive Protein)** :
  - Marqueur le plus utilisé, sensibilité >90%
  - Délai d'élévation : 6-12h, pic à 48h, demi-vie 19h
  - Cinétique de décroissance : marqueur de réponse au traitement
  - Valeur seuil : >10 mg/L suspect, >50 mg/L fortement évocateur (contexte dépendant)
  - ATTENTION : CRP masquée par tocilizumab !
- **VS (Vitesse de Sédimentation)** :
  - Moins spécifique que la CRP, élévation plus lente (48-72h), normalisation lente (semaines)
  - Utile en suivi de l'ostéomyélite chronique
  - Faux positifs : anémie, myélome, grossesse, inflammation chronique
- **Procalcitonine (PCT)** :
  - Plus spécifique de l'infection bactérienne (vs inflammation stérile)
  - Sensibilité modérée en IOA (pas d'infection bactériémique systématique)
  - Utile si suspicion de bactériémie associée
- **NFS** : hyperleucocytose à PNN (inconstante, surdout chez l'adulte), leucopénie possible (immunodéprimé, sepsis sévère)
- **IL-6** : marqueur précoce (élévation en 2-4h), utile en post-opératoire (élévation >J3 = suspect d'infection)
- **Fibrinogène** : marqueur de phase aiguë, souvent élevé
- **Cinétique biologique post-opératoire normale** : CRP pic à J2-J3, retour à la normale à J14-J21


**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA07-S03-001 | 📊 INFOGRAPHIE | Cinétique des marqueurs biologiques : CRP, VS, PCT, IL-6 — courbes temporelles | Graphiques superposés |
| MIOA07-S03-002 | 📐 SCHÉMA | Cinétique post-opératoire normale de la CRP — quand suspecter une infection | Courbe avec zone d'alerte |
| MIOA07-S03-003 | 📊 INFOGRAPHIE | Tableau comparatif CRP vs VS vs PCT vs IL-6 : sensibilité, spécificité, délai, demi-vie | Tableau synthétique |
| MIOA07-S03-004 | 📐 SCHÉMA | Algorithme biologique devant une suspicion d'IOA | Arbre décisionnel |

### Section 7.4 — Critères prédictifs et scores diagnostiques

**Contenu obligatoire** :
- **Critères de Kocher** (arthrite septique de hanche de l'enfant) :
  1. Fièvre >38.5°C
  2. Non-appui (refus de marcher)
  3. CRP >20 mg/L
  4. GB >12 000/mm³
  - Probabilité : 0 critère = 0.2%, 1 = 3%, 2 = 40%, 3 = 93%, 4 = 99.6%
  - Critère ajouté par Caird : VS >40 mm/h
- **Score de MSIS** (Musculoskeletal Infection Society) pour l'infection périprothétique :
  - Critères majeurs : fistule communicante, 2 cultures positives au même germe
  - Critères mineurs : CRP élevée, VS élevée, leucocytes du liquide articulaire, % PNN, alpha-défensine, histologie
- **Critères ICM** (International Consensus Meeting, 2018) pour l'infection périprothétique
- **Critères IDSA** pour le diagnostic d'ostéomyélite du pied diabétique

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA07-S04-001 | 📊 INFOGRAPHIE | Critères de Kocher — abaque de probabilité (0-4 critères) | Illustration visuelle frappante |
| MIOA07-S04-002 | 📊 INFOGRAPHIE | Score MSIS / ICM 2018 — grille de scoring pour infection périprothétique | Tableau de scoring |
| MIOA07-S04-003 | 📐 SCHÉMA | Algorithme décisionnel devant une suspicion d'arthrite septique de l'enfant | Arbre décisionnel |

### Points clés du Module 7

1. La fièvre est absente dans 50% des IOA post-chirurgicales — ne jamais exclure une infection sur l'absence de fièvre
2. La CRP est le marqueur biologique le plus utile : sensibilité >90%, cinétique rapide, bon marqueur de suivi
3. La CRP post-opératoire normale pic à J2-J3 et revient à la normale en 2-3 semaines — une réascension après J3 doit faire suspecter une infection
4. Les critères de Kocher (4 critères) permettent de prédire la probabilité d'arthrite septique de hanche de l'enfant
5. Le score MSIS/ICM 2018 est la référence pour le diagnostic d'infection périprothétique
6. La fistule cutanée communicante = infection du matériel jusqu'à preuve du contraire

---

# MODULE 8 : IMAGERIE DES INFECTIONS OSTÉOARTICULAIRES

**Partie** : III — Diagnostic
**Durée estimée** : 3h30
**Niveau** : Intermédiaire
**Prérequis** : Module 7

## Accroche clinique

> 🏥 **Cas clinique — M. Traoré, 52 ans** : Diabétique, lombalgie fébrile depuis 3 semaines, aggravation progressive. Radiographies du rachis lombaire : aspect « normal ». IRM : hyposignal T1 et hypersignal T2 des plateaux vertébraux L3-L4 avec prise de gadolinium, érosion du disque. *Pourquoi la radiographie est-elle « normale » alors que l'IRM montre déjà des signes avancés ? Quel est le délai d'apparition des signes radiographiques dans l'ostéomyélite ?*

## Objectifs d'apprentissage

1. **Connaître** les signes radiographiques des IOA et leur chronologie d'apparition
2. **Maîtriser** la sémiologie IRM des infections osseuses et articulaires
3. **Utiliser** le scanner et l'échographie dans les IOA de manière appropriée
4. **Interpréter** les examens de médecine nucléaire (scintigraphie, TEP-TDM)
5. **Distinguer** infection de tumeur, de fracture de contrainte, de nécrose avasculaire par l'imagerie
6. **Choisir** l'examen d'imagerie le plus pertinent selon le contexte clinique

## Structure du contenu

### Section 8.1 — Radiographies standard

**Contenu obligatoire** :
- **Délai d'apparition** : signes visibles seulement après 10-21 jours (30-50% de perte osseuse nécessaire)
- Radiographie NORMALE en phase aiguë → n'élimine JAMAIS une IOA
- **Signes d'ostéomyélite** :
  - Précoce : œdème des parties molles, effacement des plans graisseux
  - Intermédiaire : ostéolyse mal limitée (métaphyse ++), réaction périostée (lamellaire, spiculée)
  - Tardif : séquestre (fragment dense entouré de lyse), involucrum, cloaque
  - Chronique : sclérose, épaississement cortical, séquestre, déformation
- **Signes d'arthrite septique** : épanchement articulaire (élargissement de l'interligne), érosions sous-chondrales, pincement de l'interligne, ostéopénie péri-articulaire
- **Signes d'infection sur matériel** : lyse péri-implant, descellement (liseré >2mm), défaut de consolidation
- **Spondylodiscite** : pincement discal, érosion des plateaux vertébraux (en miroir), rectangularisation du corps vertébral

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA08-S01-001 | 📷 IMAGE | Ostéomyélite aiguë du tibia — radiographie normale à J5 vs ostéolyse à J21 | Comparaison séquentielle |
| MIOA08-S01-002 | 📷 IMAGE | Ostéomyélite chronique — séquestre, involucrum, cloaque (radiographie annotée) | Image iconique |
| MIOA08-S01-003 | 📷 IMAGE | Spondylodiscite L3-L4 — érosion en miroir des plateaux, pincement discal | Cliché latéral annoté |
| MIOA08-S01-004 | 📷 IMAGE | Infection sur PTG — lyse péri-implant, liseré de descellement >2mm | Radiographie annotée |
| MIOA08-S01-005 | 📊 INFOGRAPHIE | Chronologie d'apparition des signes radiographiques dans l'ostéomyélite | Timeline visuelle |

### Section 8.2 — IRM : l'examen de référence

**Contenu obligatoire** :
- **Sensibilité >95%, spécificité >85-90%** pour les IOA — examen de référence
- **Séquences indispensables** : T1 (anatomie), T2 Fat-Sat / STIR (œdème/inflammation), T1 gadolinium (vascularisation, abcès)
- **Sémiologie IRM de l'ostéomyélite** :
  - Hyposignal T1 (infiltration médullaire), hypersignal T2/STIR (œdème), prise de contraste (vascularisation, abcès)
  - Abcès : collection bien limitée avec prise de contraste périphérique (« ring enhancement »)
  - Séquestre : hyposignal T1 et T2 (os nécrosé) au sein de l'hypersignal inflammatoire
  - Abcès sous-périosté : collection entre cortex et périoste, prise de gadolinium
- **Sémiologie IRM de l'arthrite septique** : épanchement articulaire (hypersignal T2), synovite (prise de contraste épaisse), érosion sous-chondrale, œdème péri-articulaire
- **Sémiologie IRM de la spondylodiscite** : atteinte discale + 2 plateaux adjacents, hyposignal T1 / hypersignal T2, prise de contraste, abcès paravertébral / épidural
- **Signe du « penumbra sign »** : halo T1 iso/hypersignal autour de l'abcès = signe spécifique d'abcès de Brodie
- **Limites** : artefacts métalliques (implants), coût, disponibilité, contre-indications (pacemaker, claustrophobie)
- **IRM et matériel** : séquences optimisées (MARS, MAVRIC-SL) pour réduire les artefacts

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA08-S02-001 | 📷 IMAGE | IRM d'ostéomyélite tibiale — séquences T1, T2 STIR, T1 gadolinium côte à côte | 3 coupes annotées |
| MIOA08-S02-002 | 📷 IMAGE | Abcès sous-périosté en IRM — collection avec ring enhancement | Image IRM annotée |
| MIOA08-S02-003 | 📷 IMAGE | Spondylodiscite en IRM : T1/T2/Gado — atteinte discale et des 2 plateaux | Coupes sagittales annotées |
| MIOA08-S02-004 | 📷 IMAGE | Abcès de Brodie en IRM — penumbra sign | Image caractéristique |
| MIOA08-S02-005 | 📊 INFOGRAPHIE | Sémiologie IRM des IOA — tableau synthétique T1/T2/Gado par pathologie | Matrice visuelle |

### Section 8.3 — Scanner (TDM)

**Contenu obligatoire** :
- **Indications** : évaluation de la destruction osseuse, séquestre (mieux vu qu'en IRM), planification chirurgicale (3D), ponction/biopsie guidée
- **Avantages** : excellente résolution osseuse, artefacts métalliques moins gênants qu'IRM standard, reconstruction 3D, rapidité
- **Limites** : irradiation, sensibilité inférieure à l'IRM pour les stades précoces
- **Arthro-scanner** : injection intra-articulaire de contraste, utile si IRM impossible (contre-indication, matériel)
- **Scanner injecté** : recherche de collections, abcès, fistules — cartographie préopératoire

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA08-S03-001 | 📷 IMAGE | Scanner montrant un séquestre tibial (meilleure visualisation qu'en radiographie) | Reconstruction 3D + coupe axiale |
| MIOA08-S03-002 | 📷 IMAGE | Scanner du rachis — spondylodiscite avec abcès paravertébral | Coupes axiales et sagittales |
| MIOA08-S03-003 | 📊 INFOGRAPHIE | IRM vs Scanner : indications comparées dans les IOA | Tableau de décision |

### Section 8.4 — Échographie

**Contenu obligatoire** :
- **Indications principales** : détection d'épanchement articulaire (hanche ++ chez l'enfant), collections des parties molles, guidage de ponction
- **Arthrite septique de hanche de l'enfant** : échographie = 1er examen (épaississement capsulaire >5mm, épanchement)
- **Limites** : ne visualise pas l'os cortical, opérateur-dépendant
- **Doppler** : hypervascularisation synoviale, abcès des parties molles

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA08-S04-001 | 📷 IMAGE | Échographie de hanche de l'enfant — épanchement articulaire (normal vs arthrite septique) | Images côte à côte |
| MIOA08-S04-002 | 📷 IMAGE | Échographie d'un abcès des parties molles — collection hypoéchogène | Image annotée |

### Section 8.5 — Médecine nucléaire : scintigraphie et TEP-TDM

**Contenu obligatoire** :
- **Scintigraphie osseuse au Tc-99m** :
  - Très sensible (>95%) mais peu spécifique
  - Hyperfixation en 3 phases (vasculaire, tissulaire, osseuse)
  - Utile : IOA multifocale, recherche de foyers à distance, enfant (corps entier)
  - Limites : ne distingue pas infection de fracture, de tumeur
- **Scintigraphie aux leucocytes marqués (In-111 ou Tc-99m HMPAO)** :
  - Plus spécifique que la scintigraphie standard
  - Utile : infection sur matériel (articulation périphérique), infection chronique
  - Limites : technique complexe, peu disponible, durée (24-48h)
- **TEP-TDM au 18F-FDG** :
  - Sensibilité et spécificité excellentes (>90% dans de nombreux contextes)
  - Avantages : corps entier, détection de foyers multiples, bonne performance en contexte postopératoire et sur matériel
  - Limites : coût, faux positifs (inflammation post-chirurgicale récente, tumeur)
  - SUVmax : aide à distinguer infection de processus non infectieux (seuil débattu)
- **Choix de l'examen de médecine nucléaire selon le contexte** : arbre décisionnel

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA08-S05-001 | 📷 IMAGE | Scintigraphie 3 phases : ostéomyélite du tibia vs cellulite des parties molles | Comparaison diagnostique |
| MIOA08-S05-002 | 📷 IMAGE | TEP-TDM 18F-FDG : spondylodiscite L4-L5 avec hyperfixation discale et vertébrale | Image fusion PET/CT |
| MIOA08-S05-003 | 📷 IMAGE | TEP-TDM : infection de PTG avec hyperfixation péri-prothétique | Image caractéristique |
| MIOA08-S05-004 | 📊 INFOGRAPHIE | Algorithme de choix de l'imagerie selon le type d'IOA suspectée | Arbre décisionnel complet |

### Points clés du Module 8

1. La radiographie standard est NORMALE dans les 10-21 premiers jours d'une ostéomyélite — une radiographie normale n'élimine jamais une IOA
2. L'IRM est l'examen de référence (sensibilité >95%) — séquences T1, T2 Fat-Sat/STIR, T1 gadolinium
3. Le séquestre est mieux vu au scanner qu'en IRM ou en radiographie
4. L'échographie est le 1er examen en cas de suspicion d'arthrite septique de hanche chez l'enfant
5. La TEP-TDM au 18F-FDG est de plus en plus utilisée, avec d'excellentes performances, notamment pour les infections sur matériel et les spondylodiscites
6. Le « penumbra sign » en IRM est un signe spécifique de l'abcès de Brodie

---

# MODULE 9 : DIAGNOSTIC MICROBIOLOGIQUE — PRÉLÈVEMENTS, CULTURES, BIOLOGIE MOLÉCULAIRE

**Partie** : III — Diagnostic
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 3, 7

## Accroche clinique

> 🏥 **Cas clinique — M. Faure, 58 ans** : PTH posée il y a 3 ans. Douleur progressive depuis 6 mois. CRP = 22 mg/L. Ponction de hanche : liquide clair, 3200 leucocytes/mm³ (68% PNN). Alpha-défensine : positive. Cultures standard : négatives à J+7. PCR universelle 16S : *Cutibacterium acnes*. *Pourquoi les cultures étaient-elles négatives ? Quelle est la valeur de l'alpha-défensine ? De la PCR 16S ?*

## Objectifs d'apprentissage

1. **Maîtriser** les techniques de prélèvement microbiologique en contexte d'IOA (ponction, prélèvements per-opératoires)
2. **Connaître** les règles des prélèvements per-opératoires (≥5 échantillons, fenêtre ATB)
3. **Interpréter** les résultats des cultures (nombre de prélèvements positifs, concordance)
4. **Comprendre** les apports de la biologie moléculaire (PCR 16S/28S, PCR spécifiques, NGS)
5. **Utiliser** les biomarqueurs du liquide articulaire (leucocytes, % PNN, alpha-défensine, D-lactate)
6. **Connaître** la sonication des implants et son indication

## Structure du contenu

### Section 9.1 — Ponction articulaire : technique et interprétation

**Contenu obligatoire** :
- **Indications** : toute articulation suspecte d'infection (native ou prothétique)
- **Technique** : asepsie chirurgicale, SANS antibiotique préalable (fenêtre ATB ≥14 jours si possible), en dehors d'ATB locaux (ciment)
- **Analyse du liquide articulaire** :
  - Cytologie : leucocytes, % PNN — seuils selon articulation native vs prothétique
  - Articulation NATIVE : >50 000 leucocytes/mm³ avec >90% PNN = très suspect arthrite septique
  - Articulation PROTHÉTIQUE : seuils plus bas — >3000 leucocytes/mm³ (chronique) ou >10 000 (aigu) avec >80% PNN
  - Biochimie : glucose (diminué), lactate (augmenté), protéines (augmentées)
- **Culture standard** : inoculation aérobie + anaérobie, incubation ≥14 jours si matériel
- **Biomarqueurs innovants du liquide articulaire** :
  - **Alpha-défensine** : peptide antimicrobien, sensibilité 97%, spécificité 97% — excellent test
  - **Leucocyte esterase** (bandelette urinaire appliquée au liquide articulaire) : test rapide, bonne sensibilité
  - **D-lactate** : produit par les bactéries, non par les cellules humaines — marqueur prometteur
  - **CRP synoviale** (dosage local)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA09-S01-001 | 🎬 ANIMATION | Technique de ponction articulaire aseptique (genou, hanche) — pas à pas | Animation procédurale |
| MIOA09-S01-002 | 📷 IMAGE | Aspects macroscopiques du liquide articulaire : normal, inflammatoire, septique, hémorragique | 4 tubes côte à côte |
| MIOA09-S01-003 | 📊 INFOGRAPHIE | Seuils cytologiques du liquide articulaire : natif vs prothétique, aigu vs chronique | Tableau de seuils |
| MIOA09-S01-004 | 📐 SCHÉMA | Alpha-défensine : mécanisme, sensibilité/spécificité, interprétation | Schéma explicatif |

### Section 9.2 — Prélèvements per-opératoires : les règles d'or

**Contenu obligatoire** :
- **Règle des ≥5 prélèvements** (IDSA, consensus français) : au minimum 5 échantillons tissulaires profonds, sur des sites différents
- **Critères d'interprétation** : ≥3 prélèvements positifs au même germe sur 5 = infection confirmée ; 1 seul positif = possible contamination
- **Fenêtre antibiotique** : arrêt des ATB ≥14 jours avant les prélèvements chirurgicaux (sauf urgence vitale)
- **Types de prélèvements** : tissu péri-implant, membrane péri-prothétique, tissu osseux, liquide articulaire, os (biopsie)
- **Conditions de transport** : milieu de transport anaérobie, acheminement rapide (<2h), flacons d'hémoculture (en appoint)
- **Incubation prolongée** : ≥14 jours pour les cultures sur matériel (C. acnes !)
- **Écouvillonnage superficiel** : À PROSCRIRE (contamination par la flore cutanée, faible corrélation avec les germes profonds)
- **Histologie per-opératoire** : ≥5 PNN/champ (×400) dans ≥5 champs = infection (critère de Feldman modifié)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA09-S02-001 | 📐 SCHÉMA | Sites de prélèvement per-opératoire — genou prothétique (5 sites annotés) | Schéma anatomique |
| MIOA09-S02-002 | 📊 INFOGRAPHIE | Critères d'interprétation : 1/5, 2/5, 3/5 prélèvements positifs — signification | Abaque visuel |
| MIOA09-S02-003 | ⚠️ ENCADRÉ | INTERDIT : écouvillonnage superficiel de fistule | Encadré danger |
| MIOA09-S02-004 | 📷 IMAGE | Histologie per-opératoire d'une membrane infectée : infiltrat de PNN | Photo microscopique |

### Section 9.3 — Sonication des implants

**Contenu obligatoire** :
- **Principe** : ultrasons de basse intensité appliqués à l'implant retiré → détachement mécanique des bactéries du biofilm → mise en culture du sonicat
- **Supériorité** : sensibilité 30-40% supérieure aux prélèvements tissulaires standard, surtout après ATB préalable
- **Indications** : tout implant retiré pour suspicion d'infection (prothèse, matériel d'ostéosynthèse, spacer)
- **Protocole** : immersion de l'implant en solution stérile, sonication 1 min à 40 kHz, mise en culture du liquide
- **Interprétation** : seuil quantitatif (>50 UFC/mL = positif significatif pour certaines études)
- **Limites** : disponibilité, standardisation incomplète, nécessité d'un laboratoire équipé

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA09-S03-001 | 🎬 ANIMATION | Principe de la sonication : ultrasons → détachement du biofilm → culture | Animation technique |
| MIOA09-S03-002 | 📷 IMAGE | Bac de sonication avec implant PTH | Photo de laboratoire |
| MIOA09-S03-003 | 📊 INFOGRAPHIE | Sonication vs cultures tissulaires : comparaison des performances | Tableau méta-analytique |

### Section 9.4 — Biologie moléculaire : PCR et séquençage

**Contenu obligatoire** :
- **PCR universelle 16S (bactéries) / 28S-ITS (champignons)** :
  - Amplifie le gène de l'ARN ribosomal → identification du genre et de l'espèce par séquençage
  - Avantages : identification même après ATB, cultures négatives, germes fastidieux
  - Limites : pas d'antibiogramme, contamination possible, ne distingue pas vivant/mort, coût
- **PCR spécifiques** : mecA (SARM), vanA/vanB (ERV), blaKPC, blaNDM (EPC)
  - Résultat en quelques heures → adaptation rapide de l'ATB
- **MALDI-TOF** : identification rapide à partir d'une colonie (ou directement du liquide) en quelques minutes
- **NGS (Next-Generation Sequencing) métagénomique** :
  - Séquençage de tout l'ADN présent dans l'échantillon → identification exhaustive
  - Détection de flores mixtes, germes impossibles à cultiver
  - Limites : coût élevé, complexité d'interprétation, contamination, pas d'antibiogramme phénotypique
  - Application émergente : infections chroniques réfractaires

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA09-S04-001 | 🎬 ANIMATION | PCR universelle 16S : principe (extraction ADN → amplification → séquençage → identification) | Animation moléculaire |
| MIOA09-S04-002 | 📐 SCHÉMA | MALDI-TOF : principe (ionisation → vol → spectre → identification) | Schéma technique simplifié |
| MIOA09-S04-003 | 📊 INFOGRAPHIE | Comparatif : culture vs PCR 16S vs MALDI-TOF vs NGS | Tableau multicritère |
| MIOA09-S04-004 | 📐 SCHÉMA | Algorithme de diagnostic microbiologique combiné (culture + sonication + PCR) | Arbre décisionnel |

### Points clés du Module 9

1. ≥5 prélèvements per-opératoires sur des sites différents avec ≥14 jours de fenêtre antibiotique
2. ≥3 prélèvements positifs au même germe sur 5 = infection confirmée
3. L'écouvillonnage superficiel de fistule est INTERDIT (contamination, non représentatif)
4. La sonication augmente la sensibilité de 30-40% par rapport aux prélèvements tissulaires seuls
5. L'alpha-défensine du liquide articulaire a une sensibilité et spécificité de ~97%
6. La PCR universelle 16S identifie les germes même après antibiothérapie, mais ne fournit pas d'antibiogramme
7. L'incubation prolongée ≥14 jours est indispensable pour détecter *C. acnes* et certains germes à croissance lente

---

# MODULE 10 : CLASSIFICATIONS DES INFECTIONS OSSEUSES ET ARTICULAIRES

**Partie** : III — Diagnostic
**Durée estimée** : 2h30
**Niveau** : Intermédiaire
**Prérequis** : Modules 7-9

## Accroche clinique

> 🏥 **Cas clinique — M. Dupont, 45 ans** : Ostéomyélite chronique du tibia moyen après fracture ouverte Gustilo IIIB traitée il y a 3 ans. Fistule intermittente, séquestre central visible au scanner, sclérose corticale diffuse. Patient diabétique, fumeur, HbA1c 8.5%. *Comment classer cette atteinte selon Cierny-Mader ? Quel est le type anatomique ? Quelle est la classe de l'hôte ? En quoi cela change-t-il votre stratégie ?*

## Objectifs d'apprentissage

1. **Appliquer** la classification de Cierny-Mader pour l'ostéomyélite
2. **Utiliser** les classifications de Tsukayama et de Zimmerli/ICM pour les infections périprothétiques
3. **Connaître** la classification de Waldvogel pour l'ostéomyélite
4. **Comprendre** la classification de l'infection sur matériel d'ostéosynthèse (FRI)
5. **Relier** chaque classification à la décision thérapeutique

## Structure du contenu

### Section 10.1 — Classification de Waldvogel (ostéomyélite)

**Contenu obligatoire** :
- Classification historique (1970) basée sur la **physiopathologie** :
  1. Ostéomyélite hématogène
  2. Ostéomyélite par foyer contigu (avec ou sans insuffisance vasculaire)
  3. Ostéomyélite chronique
- Simple mais limitée : ne guide pas le traitement chirurgical

### Section 10.2 — Classification de Cierny-Mader (ostéomyélite)

**Contenu obligatoire** :
- Classification la plus utilisée (1985, révisée 2003) — base **anatomique** + **statut de l'hôte**
- **4 types anatomiques** :
  - Type I : Médullaire (endostée) — infection limitée à la cavité médullaire
  - Type II : Superficielle (cortex externe) — érosion corticale externe, sous le périoste
  - Type III : Localisée — séquestre cortical localisé, os stable pré- et post-débridement
  - Type IV : Diffuse — atteinte étendue, instabilité osseuse pré- et/ou post-débridement
- **3 classes d'hôte** :
  - Classe A : hôte normal
  - Classe B : hôte compromis (Bs = systémique, BL = local, BLS = les deux)
  - Classe C : traitement > maladie (suppression seule)
- **Matrice 4×3** : 12 combinaisons possibles → stratégie thérapeutique graduée
- Impact sur la décision : curetage seul (IA) → séquestrectomie + comblement (IIIA) → résection segmentaire + reconstruction (IVA) → traitement suppressif (xC)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA10-S02-001 | 📐 SCHÉMA | 4 types anatomiques de Cierny-Mader — dessins en coupe d'os | 4 illustrations côte à côte |
| MIOA10-S02-002 | 📊 INFOGRAPHIE | Matrice Cierny-Mader 4×3 avec stratégie thérapeutique pour chaque case | Tableau illustré et coloré |
| MIOA10-S02-003 | 📐 SCHÉMA | Algorithme thérapeutique guidé par Cierny-Mader | Arbre de décision |

### Section 10.3 — Classifications des infections périprothétiques

**Contenu obligatoire** :
- **Classification de Tsukayama** (1996) :
  - Type I : Culture per-opératoire positive inattendue (≥2 prélèvements)
  - Type II : Infection postopératoire précoce (<4 semaines)
  - Type III : Infection hématogène tardive aiguë (symptômes <4 semaines)
  - Type IV : Infection chronique tardive (symptômes >4 semaines)
- **Classification de Zimmerli** (simplifiée, basée sur le délai) :
  - Précoce : <3 mois post-chirurgie
  - Retardée (*delayed*) : 3-24 mois
  - Tardive : >24 mois (hématogène ou chronique de bas grade)
- **Consensus ICM 2018** : classification basée sur les critères diagnostiques (scores)
- **Impact thérapeutique** :
  - Précoce/hématogène + biofilm immature (<4 semaines de symptômes) → DAIR possible
  - Chronique/biofilm mature (>4 semaines) → changement d'implant (1 temps ou 2 temps)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA10-S03-001 | 📊 INFOGRAPHIE | Classification de Tsukayama — 4 types avec exemples cliniques et traitement | Tableau visuel |
| MIOA10-S03-002 | 📊 INFOGRAPHIE | Classification de Zimmerli — timeline avec types et traitements | Frise chronologique |
| MIOA10-S03-003 | 📐 SCHÉMA | Algorithme thérapeutique de l'infection périprothétique selon la classification | Arbre de décision complet |

### Section 10.4 — Classification FRI (Fracture-Related Infection)

**Contenu obligatoire** :
- Concept de FRI (2018, consensus international) : standardisation de la définition d'infection sur matériel d'ostéosynthèse
- **Critères confirmatifs** : fistule communicante, germe identifié (≥2 prélèvements), pus per-opératoire
- **Critères évocateurs** : signes cliniques, biologiques, radiologiques sans preuve microbiologique formelle
- Intérêt : uniformiser la recherche et le suivi, comparer les séries
- Stratégie thérapeutique : selon consolidation osseuse (consolidée vs non consolidée), stabilité du matériel, germe

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA10-S04-001 | 📊 INFOGRAPHIE | Critères de FRI : confirmatifs vs évocateurs | Tableau dichotomique |
| MIOA10-S04-002 | 📐 SCHÉMA | Algorithme de prise en charge de la FRI | Arbre de décision |

### Points clés du Module 10

1. La classification de Cierny-Mader (4 types anatomiques × 3 classes d'hôte) est la référence pour l'ostéomyélite
2. Le type anatomique guide le geste chirurgical ; la classe de l'hôte module l'agressivité du traitement
3. Pour les infections périprothétiques, la durée des symptômes (<4 semaines vs >4 semaines) est le critère pivot (DAIR vs changement)
4. La classification de Tsukayama distingue 4 types d'infection périprothétique selon le moment et le mode de survenue
5. Le concept de FRI standardise la définition de l'infection sur matériel d'ostéosynthèse

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 4 — Antibiothérapie (Modules 11-13)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 11 : PHARMACOLOGIE DES ANTIBIOTIQUES EN CONTEXTE OSSEUX

**Partie** : IV — Antibiothérapie
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Module 3

## Accroche clinique

> 🏥 **Cas clinique — Mme Laurent, 48 ans** : Ostéomyélite chronique du fémur à SASM. Antibiothérapie par oxacilline IV 12g/j pendant 2 semaines suivie de lévofloxacine + rifampicine per os. À 6 semaines, la CRP remonte et une fistule réapparaît. *La rifampicine a-t-elle bien diffusé dans l'os ? La combinaison était-elle optimale ? Quel rôle joue la diffusion osseuse dans le choix des antibiotiques ?*

## Objectifs d'apprentissage

1. **Expliquer** les principes de diffusion des antibiotiques dans l'os (ratio os/sérum)
2. **Connaître** les antibiotiques à bonne diffusion osseuse et ceux à diffusion insuffisante
3. **Maîtriser** la pharmacologie de la rifampicine, des fluoroquinolones et des antibiotiques anti-biofilm
4. **Comprendre** les concepts de pharmacocinétique (PK) et pharmacodynamie (PD) appliqués à l'os
5. **Adapter** les posologies selon la fonction rénale et hépatique
6. **Identifier** les interactions médicamenteuses majeures

## Structure du contenu

### Section 11.1 — Diffusion osseuse des antibiotiques : principes généraux

**Contenu obligatoire** :
- **Barrière osseuse** : l'os est un tissu peu vascularisé (cortex) avec une matrice minéralisée limitant la diffusion
- **Ratio os/sérum** : rapport entre concentration osseuse et concentration sérique — variable selon l'ATB
- **Facteurs influençant la diffusion** :
  - Liposolubilité de la molécule (↑ = meilleure diffusion)
  - Liaison aux protéines plasmatiques (↓ = meilleure fraction libre diffusible)
  - Taille moléculaire
  - Vascularisation osseuse (os cortical << os spongieux << os infecté/inflammatoire)
  - État de l'os : os sain vs os infecté (vascularisation néo-formée = meilleure diffusion paradoxale)
- **Antibiotiques à bonne diffusion osseuse** : fluoroquinolones, rifampicine, clindamycine, linézolide, TMP-SMX, acide fusidique, métronidazole
- **Antibiotiques à diffusion osseuse modérée** : bêta-lactamines (à doses élevées), vancomycine
- **Antibiotiques à diffusion osseuse insuffisante** : aminosides (usage IV/local mais mauvaise diffusion osseuse systémique)
- **Le paradoxe de l'os infecté** : la néovascularisation inflammatoire améliore la diffusion → l'os infecté reçoit plus d'ATB que l'os sain

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA11-S01-001 | 📊 INFOGRAPHIE | Tableau de diffusion osseuse des principaux antibiotiques (ratio os/sérum) | Classement code couleur |
| MIOA11-S01-002 | 📐 SCHÉMA | Facteurs influençant la diffusion osseuse des ATB — schéma conceptuel | 5 facteurs illustrés |
| MIOA11-S01-003 | 🎬 ANIMATION | Diffusion d'un ATB de la circulation sanguine vers l'os cortical et spongieux | Animation pharmacocinétique |
| MIOA11-S01-004 | 📐 SCHÉMA | Paradoxe de l'os infecté : néovascularisation → meilleure diffusion | Schéma comparatif |

### Section 11.2 — Pharmacocinétique/pharmacodynamie (PK/PD) appliquées à l'os

**Contenu obligatoire** :
- **Rappels PK/PD** :
  - ATB temps-dépendants : bêta-lactamines, vancomycine → efficacité liée au temps au-dessus de la CMI (T>CMI)
  - ATB concentration-dépendants : aminosides, fluoroquinolones → efficacité liée au Cmax/CMI ou AUC/CMI
  - ATB AUC-dépendants : vancomycine (AUC/CMI cible >400), linézolide
- **Application à l'os** :
  - Pour les bêta-lactamines : perfusion continue ou prolongée pour maximiser T>CMI dans l'os
  - Pour les fluoroquinolones : doses unitaires élevées pour atteindre un Cmax/CMI >10
  - Pour la vancomycine : monitoring des concentrations résiduelles (cible 15-20 mg/L), AUC/CMI
- **Monitoring thérapeutique (TDM)** : vancomycine, aminosides, voriconazole obligatoires ; rifampicine recommandé
- **Adaptation rénale** : aminosides, vancomycine, bêta-lactamines — formules de Cockcroft, CKD-EPI
- **Adaptation hépatique** : rifampicine, métronidazole, clindamycine

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA11-S02-001 | 📐 SCHÉMA | Modèles PK/PD : temps-dépendant vs concentration-dépendant vs AUC-dépendant | 3 courbes de concentration |
| MIOA11-S02-002 | 📊 INFOGRAPHIE | Tableau PK/PD par classe d'ATB + objectif thérapeutique dans l'os | Synthèse clinique |
| MIOA11-S02-003 | 📐 SCHÉMA | Perfusion continue de bêta-lactamines : principe et avantage dans l'os | Comparaison intermittent vs continu |

### Section 11.3 — La rifampicine : l'arme anti-biofilm par excellence

**Contenu obligatoire** :
- **Propriétés uniques** :
  - Activité anti-biofilm démontrée (pénètre le biofilm, tue les bactéries sessiles)
  - Excellente diffusion osseuse (ratio os/sérum > 0.5)
  - Activité bactéricide intracellulaire (SCV !)
  - Bonne diffusion dans les abcès
- **RÈGLE ABSOLUE** : JAMAIS en monothérapie (sélection de résistance en 24-48h !)
  - Toujours en combinaison : rifampicine + FQ, rifampicine + cotrimoxazole, rifampicine + clindamycine
- **Posologie** : 600-900 mg/j en 1-2 prises (adulte)
- **Effets indésirables** : hépatotoxicité (transaminases), interactions médicamenteuses majeures (inducteur enzymatique CYP450 +++), coloration des urines/larmes, nausées
- **Interactions majeures** : AVK (↓ INR), contraceptifs oraux (↓ efficacité), antirétroviraux (IP ++), immunosuppresseurs (tacrolimus, ciclosporine), fluoroquinolones (interaction modérée)
- **Quand débuter la rifampicine** : APRÈS que le site chirurgical est propre et drainé, jamais en phase d'abcès non drainé (risque de résistance dans un milieu non accessible)
- **Études fondatrices** : Zimmerli et al. (1998), études sur biofilm staphylococcique

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA11-S03-001 | 🎬 ANIMATION | Rifampicine vs biofilm : pénétration, action sur bactéries sessiles et intracellulaires | Animation anti-biofilm |
| MIOA11-S03-002 | ⚠️ ENCADRÉ | JAMAIS de rifampicine en monothérapie — sélection de résistance en 24-48h | Encadré danger critique |
| MIOA11-S03-003 | 📊 INFOGRAPHIE | Interactions médicamenteuses de la rifampicine — tableau exhaustif | Tableau d'interactions |
| MIOA11-S03-004 | 📐 SCHÉMA | Quand débuter la rifampicine dans la séquence thérapeutique | Timeline optimale |

### Section 11.4 — Fluoroquinolones, clindamycine et antibiotiques oraux à bonne diffusion osseuse

**Contenu obligatoire** :
- **Fluoroquinolones** (lévofloxacine, ciprofloxacine, moxifloxacine) :
  - Excellente diffusion osseuse (ratio >1 pour certaines)
  - Activité anti-biofilm (synergie avec rifampicine)
  - Risque de résistance si monothérapie
  - Effets indésirables : tendinopathies (tendon d'Achille ++), neuropathie, allongement QT, photosensibilité, dysglycémie
  - Contre-indications relatives : épilepsie, déficit en G6PD
- **Clindamycine** : bonne diffusion osseuse, activité anti-staphylococcique, per os possible, risque de colite à *C. difficile*
- **Cotrimoxazole (TMP-SMX)** : alternative orale, bonne diffusion, actif sur SARM communautaire, risque hématologique, rénal
- **Acide fusidique** : bonne diffusion, toujours en combinaison, hépatotoxicité
- **Linézolide** : oxazolidinone, excellente diffusion, actif anti-SARM, anti-ERV, per os = IV ; toxicité hématologique (thrombopénie) et neurologique (neuropathie) si >28 jours
- **Tédizolide** : oxazolidinone de 2e génération, meilleure tolérance, 1 prise/jour
- **Doxycycline** : alternative orale en suppression chronique, bonne diffusion, tolérance correcte

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA11-S04-001 | 📊 INFOGRAPHIE | Tableau des antibiotiques oraux à bonne diffusion osseuse : molécule, spectre, posologie, effets indésirables | Tableau de référence |
| MIOA11-S04-002 | ⚠️ ENCADRÉ | Effets indésirables des fluoroquinolones : tendinopathies, neuropathie | Encadré alerte |
| MIOA11-S04-003 | 📐 SCHÉMA | Linézolide : spectre, place dans les IOA à SARM/ERV, durée maximale recommandée | Schéma synthétique |

### Section 11.5 — Antibiotiques IV : bêta-lactamines, glycopeptides, daptomycine

**Contenu obligatoire** :
- **Bêta-lactamines anti-staphylococciques** : oxacilline/cloxacilline (SASM), céfazoline (SASM, alternative), pipéracilline-tazobactam (large spectre)
  - Diffusion osseuse modérée mais compensée par des doses élevées et la perfusion continue
- **Vancomycine** : référence anti-SARM IV, monitoring obligatoire, néphrotoxicité, red-man syndrome
  - AUC/CMI cible 400-600
- **Daptomycine** : lipopeptide, actif anti-SARM, anti-ERV, bactéricide rapide
  - Dose ≥8-10 mg/kg pour les IOA (doses standard de 4-6 mg/kg insuffisantes)
  - Inactivée par le surfactant → NE PAS utiliser dans les pneumonies
  - Monitoring CPK (myotoxicité)
- **Ceftaroline** : céphalosporine anti-SARM, bonne tolérance, alternative intéressante
- **Carbapénèmes** : imipénème, méropénème — large spectre, réserve pour BLSE/certaines EPC
- **Ceftazidime-avibactam, céfidérocol** : nouvelles molécules anti-EPC

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA11-S05-001 | 📊 INFOGRAPHIE | Antibiotiques IV dans les IOA : molécule, spectre, posologie, monitoring | Tableau de référence |
| MIOA11-S05-002 | 📐 SCHÉMA | Algorithme d'antibiothérapie IV selon le germe identifié | Arbre décisionnel |
| MIOA11-S05-003 | 📐 SCHÉMA | Daptomycine à haute dose dans les IOA : justification et surveillance | Schéma PK/PD |

### Points clés du Module 11

1. La diffusion osseuse des ATB dépend de la liposolubilité, de la liaison protéique, de la taille et de la vascularisation osseuse
2. La rifampicine est l'arme anti-biofilm majeure — JAMAIS en monothérapie (résistance en 24-48h)
3. Les fluoroquinolones ont une excellente diffusion osseuse mais des effets indésirables sérieux (tendinopathie)
4. Le linézolide est une option anti-SARM/ERV par voie orale, mais limité à 28 jours par la toxicité hématologique/neurologique
5. La daptomycine doit être utilisée à haute dose (≥8-10 mg/kg) dans les IOA
6. Le monitoring thérapeutique (TDM) est obligatoire pour vancomycine et aminosides

---

# MODULE 12 : ANTIBIOTHÉRAPIE PROBABILISTE ET DOCUMENTÉE DES IOA

**Partie** : IV — Antibiothérapie
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 3, 7, 9, 11

## Accroche clinique

> 🏥 **Cas clinique — Ahmed, 6 ans** : Ostéomyélite aiguë hématogène du fémur (IRM confirmée). Hémocultures en cours. Pas de porte d'entrée évidente. Pas d'allergie connue. CRP 120 mg/L, fièvre 39.5°C. *Quel antibiotique probabiliste débutez-vous dans l'heure ? Sur quel germe pariez-vous ? Quelle sera la durée totale de traitement ?*

## Objectifs d'apprentissage

1. **Prescrire** l'antibiothérapie probabiliste adaptée selon le contexte (enfant/adulte, post-op, hématogène)
2. **Adapter** le traitement après documentation microbiologique
3. **Connaître** les durées de traitement recommandées
4. **Gérer** le relais IV → oral (OPAT, switch précoce)
5. **Organiser** le suivi biologique et clinique sous traitement
6. **Maîtriser** les protocoles thérapeutiques des CRIOAC

## Structure du contenu

### Section 12.1 — Antibiothérapie probabiliste selon le contexte

**Contenu obligatoire** :
- **Principes** : débuter APRÈS les prélèvements mais AVANT les résultats (si urgence clinique), couvrir les germes les plus probables, adapter dès réception de l'antibiogramme
- **Ostéomyélite aiguë hématogène de l'enfant** :
  - 1ère intention : céfamandole ou oxacilline IV (couvrir *S. aureus* SASM)
  - Si <4 ans : ajouter couverture *K. kingae* (amoxicilline-acide clavulanique ou C3G)
  - Si SARM suspecté (voyage, communauté à risque) : vancomycine + C3G
  - Drépanocytaire : C3G (couvrir *Salmonella*)
- **Arthrite septique** : mêmes principes que l'ostéomyélite, adapté au contexte
- **Infection post-opératoire précoce (<4 semaines)** :
  - Couvrir *S. aureus* + SCN + BGN = vancomycine + pipéracilline-tazobactam (ou C3G)
  - En cas de SARM connu : vancomycine obligatoire
- **Spondylodiscite** : C3G ou oxacilline (si CG+ prédominant) ; si tuberculose suspectée → traitement antituberculeux
- **Pied diabétique infecté** : amoxicilline-acide clavulanique (forme modérée) ; pipéracilline-tazobactam + vancomycine (forme sévère, à BMR)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA12-S01-001 | 📊 INFOGRAPHIE | Antibiothérapie probabiliste des IOA : tableau par contexte clinique | Tableau de référence majeur |
| MIOA12-S01-002 | 📐 SCHÉMA | Algorithme d'antibiothérapie probabiliste de l'ostéomyélite aiguë de l'enfant | Arbre décisionnel pédiatrique |
| MIOA12-S01-003 | 📊 INFOGRAPHIE | Antibiothérapie probabiliste du pied diabétique selon la sévérité (IDSA) | Tableau gradué |

### Section 12.2 — Antibiothérapie documentée et adaptée

**Contenu obligatoire** :
- **Principe** : dès l'antibiogramme, adapter l'ATB au spectre le plus étroit efficace (épargne écologique)
- **IOA à SASM** :
  - IV : oxacilline ou céfazoline
  - Relais oral : lévofloxacine + rifampicine (combinaison de référence pour les IOA sur matériel)
  - Alternatives : clindamycine + rifampicine, TMP-SMX + rifampicine
- **IOA à SARM** :
  - IV : vancomycine ou daptomycine haute dose
  - Relais oral : TMP-SMX + rifampicine, linézolide + rifampicine, FQ + rifampicine (si sensible)
- **IOA à SCN (S. epidermidis)** :
  - Souvent MétR → vancomycine IV + rifampicine (si DAIR), puis relais par FQ + rifampicine si sensible
- **IOA à streptocoques** : amoxicilline IV puis relais per os (bonne sensibilité)
- **IOA à BGN** : C3G ou FQ (si sensible), carbapénème (si BLSE)
- **IOA à *Cutibacterium acnes*** : amoxicilline IV puis per os ×12 semaines, alternatives : clindamycine
- **Associations antibiotiques anti-biofilm de référence** (DAIR, matériel conservé) :
  - Staphyloque + matériel : rifampicine + FQ (ou TMP-SMX, ou clindamycine)
  - La rifampicine est l'élément clé si l'implant est conservé

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA12-S02-001 | 📊 INFOGRAPHIE | Antibiothérapie documentée par germe (tableau complet) : SASM, SARM, SCN, streptocoques, BGN, C. acnes | Tableau de référence majeur |
| MIOA12-S02-002 | 📐 SCHÉMA | Combinaisons rifampicine + compagnon : choix selon antibiogramme et tolérance | Arbre de choix |
| MIOA12-S02-003 | 💊 ENCADRÉ | Protocole de relais IV → oral : critères de switch (apyrexie, CRP ↓, tolérance digestive) | Encadré protocole |

### Section 12.3 — Durées de traitement

**Contenu obligatoire** :
- **Ostéomyélite aiguë de l'enfant** : 3-4 semaines (switch IV → oral après 3-5 jours si bonne évolution) — étude POET, données récentes
- **Arthrite septique** : 2-4 semaines (selon l'articulation et le germe)
- **Ostéomyélite chronique** : 6-12 semaines (après chirurgie d'exérèse)
- **Infection périprothétique** :
  - DAIR : 12 semaines (genou), 6 semaines + rifampicine (hanche) — protocoles CRIOAC
  - Changement en 2 temps : 6 semaines entre les 2 temps, puis 6-12 semaines post-réimplantation
  - Changement en 1 temps : 6-12 semaines
- **Spondylodiscite à pyogènes** : 6 semaines (recommandations SPILF 2007, étude DATISPO — 6 vs 12 semaines)
- **Spondylodiscite tuberculeuse** : 9-12 mois (quadrithérapie puis bithérapie)
- **Pied diabétique / ostéomyélite** : 6 semaines après résection chirurgicale, ≥3 mois si traitement médical seul
- **Études récentes** : tendance à la réduction des durées (OVIVA — per os précoce, DATISPO — 6 semaines de spondylodiscite)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA12-S03-001 | 📊 INFOGRAPHIE | Durées de traitement recommandées par type d'IOA | Tableau synthétique de référence |
| MIOA12-S03-002 | 📐 SCHÉMA | Études clés récentes : OVIVA, DATISPO, POET — impact sur les pratiques | Résumé visuel |

### Section 12.4 — OPAT et traitement ambulatoire

**Contenu obligatoire** :
- **OPAT** (*Outpatient Parenteral Antibiotic Therapy*) : antibiothérapie parentérale à domicile
- Indications : patient stable, cathéter (PICC-line, Midline, PAC), ATB compatible (ceftriaxone, ertapénème, daptomycine, vancomycine en pompe)
- Organisation : IDE à domicile, suivi biologique hebdomadaire (NFS, CRP, rénale, hépatique), consultation infectiologie
- **Relais oral précoce** : étude OVIVA (2019) → pas d'infériorité du relais oral à J7 vs IV prolongé, révolution des pratiques
- Critères de switch IV → oral : apyrexie, CRP ↓ >50%, absence de signes de gravité, antibiogramme compatible, molécule orale appropriée
- **Suivi clinique et biologique** : CRP et NFS hebdomadaires, bilan hépatique et rénal à J14, J30, J45, J90

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA12-S04-001 | 📊 INFOGRAPHIE | Organisation de l'OPAT : acteurs, suivi, matériel | Schéma organisationnel |
| MIOA12-S04-002 | 📐 SCHÉMA | Critères de switch IV → oral : checklist de sécurité | Checklist colorée |
| MIOA12-S04-003 | 📊 INFOGRAPHIE | Calendrier de suivi biologique sous ATB prolongé | Planning de suivi |

### Points clés du Module 12

1. L'antibiothérapie probabiliste doit couvrir *S. aureus* dans la grande majorité des IOA
2. La combinaison rifampicine + fluoroquinolone est la référence pour les IOA sur matériel à staphylocoque sensible
3. La rifampicine ne doit JAMAIS être utilisée en monothérapie et ne doit être débutée que lorsque le foyer est contrôlé chirurgicalement
4. L'étude OVIVA permet un relais oral précoce (J7) dans de nombreuses IOA
5. Les durées de traitement tendent à se raccourcir (3-4 semaines chez l'enfant, 6 semaines pour la spondylodiscite)
6. Le suivi biologique régulier (CRP, NFS, bilan hépatique/rénal) est indispensable

---

# MODULE 13 : ANTIBIOTIQUES LOCAUX — CIMENT, SPACERS, BILLES, COATINGS

**Partie** : IV — Antibiothérapie
**Durée estimée** : 2h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 11, 12

## Accroche clinique

> 🏥 **Cas clinique — M. Renaud, 71 ans** : Infection chronique de PTG à SASM. Explantation et mise en place d'un spacer en ciment chargé de vancomycine + gentamicine. 8 semaines d'ATB systémique. Lors de la réimplantation, les prélèvements reviennent négatifs. *Comment fonctionne un spacer antibiotique ? Quelles concentrations locales atteint-on ? Pourquoi vancomycine + gentamicine plutôt qu'un seul ATB ?*

## Objectifs d'apprentissage

1. **Expliquer** le principe de l'antibiothérapie locale et ses avantages
2. **Connaître** les antibiotiques utilisables en ciment (thermostables, hydrosolubles)
3. **Décrire** les différents vecteurs locaux (ciment, spacer, billes, éponge de collagène, coatings)
4. **Comprendre** la cinétique d'élution des antibiotiques depuis le ciment
5. **Discuter** les avantages et limites de l'antibiothérapie locale

## Structure du contenu

### Section 13.1 — Principes de l'antibiothérapie locale

**Contenu obligatoire** :
- **Avantages** : concentrations locales très élevées (10-100× la CMI, 100-1000× les concentrations sériques), faible toxicité systémique, action au contact du biofilm
- **Indications** : espace mort après débridement, spacer entre 2 temps, ciment d'ancrage prophylactique, ostéomyélite chronique
- **Le concept d'espace mort** : après séquestrectomie radicale, la cavité résiduelle doit être comblée (sinon : réinfection par hématome)
- **Complémentaire et non substitutive** : l'antibiothérapie locale ne remplace JAMAIS l'antibiothérapie systémique

### Section 13.2 — Le ciment PMMA chargé d'antibiotiques

**Contenu obligatoire** :
- **PMMA** (Polyméthacrylate de Méthyle) : polymérise exothermiquement, l'ATB est emprisonné dans la matrice
- **ATB utilisables** : thermostables (résistent à la polymérisation exothermique ~80°C), hydrosolubles (éluent depuis la matrice)
  - Gentamicine (le plus utilisé), tobramycine, vancomycine, clindamycine
  - ATB NON utilisables : rifampicine (interfère avec la polymérisation), bêta-lactamines (thermolabiles), daptomycine
- **Cinétique d'élution** :
  - Phase initiale rapide (burst release) : premières 24-72h → concentrations très élevées
  - Phase de décroissance lente : semaines → concentrations plus faibles, risque de sous-dosage et de sélection de résistance
- **Combinaison de 2 ATB** : vancomycine + gentamicine — synergie d'élution (les 2 élèchent mutuellement la porosité du ciment)
- **Dosage dans le ciment** :
  - Prophylactique : 0.5-1g ATB / 40g ciment
  - Thérapeutique (spacer) : 3-4g vancomycine + 3-4g gentamicine / 40g ciment (doses élevées)
- **Types de ciment thérapeutique** :
  - Artisanal (préparé au bloc) vs industriel (prêt à l'emploi : Spacer-G, Copal)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA13-S02-001 | 🎬 ANIMATION | Cinétique d'élution du ciment : burst release → décroissance | Courbe animée |
| MIOA13-S02-002 | 📐 SCHÉMA | Ciment PMMA : structure moléculaire, piégeage de l'ATB, élution | Zoom microscopique |
| MIOA13-S02-003 | 📷 IMAGE | Préparation d'un spacer de genou au bloc opératoire | Photo per-opératoire |
| MIOA13-S02-004 | 📊 INFOGRAPHIE | ATB utilisables vs non utilisables en ciment — critères et liste | Tableau de référence |

### Section 13.3 — Spacers, billes et autres vecteurs

**Contenu obligatoire** :
- **Spacers articulés** (genou) : maintiennent l'espace articulaire et la longueur du membre, permettent une mobilité partielle
- **Spacers statiques** (hanche, genou complexe) : plus stables, moins de mobilité
- **Billes de gentamicine** (Septopal®) : chaîne de billes de PMMA pré-chargées, comblement de cavités osseuses
- **Éponge de collagène-gentamicine** (Collatamp®) : résorbable, libération rapide, utilisée en prophylaxie locale
- **Sulfate de calcium** : résorbable, bonne élution, remplacé progressivement par l'os
- **Vecteurs innovants** :
  - Bio-verres chargés d'ATB (BAG-S53P4) : antimicrobiens intrinsèquement + libération d'ions, ostéoconducteurs
  - Hydrogels chargés d'ATB : libération contrôlée, résorbables
  - Coatings d'implants : surfaces traitées anti-biofilm (argent, cuivre, hydroxyapatite chargée d'ATB)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA13-S03-001 | 📷 IMAGE | Spacer articulé de genou (vue clinique et radiographique) | Photos per-op + radio |
| MIOA13-S03-002 | 📷 IMAGE | Billes de gentamicine (Septopal) en place dans une cavité osseuse | Radio et photo per-op |
| MIOA13-S03-003 | 📊 INFOGRAPHIE | Comparatif des vecteurs d'ATB locaux : PMMA, sulfate de calcium, collagène, bio-verre | Tableau multicritère |
| MIOA13-S03-004 | 📐 SCHÉMA | Coating anti-biofilm d'implant — technologies disponibles | Schéma de surface |

### Points clés du Module 13

1. L'antibiothérapie locale atteint des concentrations 100-1000× supérieures aux concentrations sériques au site d'infection
2. Les ATB utilisables en ciment PMMA doivent être thermostables et hydrosolubles (gentamicine, vancomycine, tobramycine)
3. La combinaison vancomycine + gentamicine dans le ciment améliore l'élution par synergie
4. La cinétique d'élution comporte un burst release initial puis une phase de décroissance — attention au risque de sous-dosage tardif
5. Les spacers articulés (genou) maintiennent l'espace articulaire ; les spacers statiques offrent plus de stabilité
6. L'antibiothérapie locale est complémentaire et NE REMPLACE JAMAIS l'antibiothérapie systémique

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 5 — Ostéomyélite (Modules 14-17)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 14 : OSTÉOMYÉLITE AIGUË HÉMATOGÈNE DE L'ENFANT

**Partie** : V — Ostéomyélite
**Durée estimée** : 3h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 2, 3, 4, 7, 8

## Accroche clinique

> 🏥 **Cas clinique — Yasmine, 10 ans** : Fièvre à 39.8°C depuis 3 jours, douleur exquise de l'extrémité inférieure du fémur gauche, boiterie, refus d'appui. Pas de traumatisme. CRP = 145 mg/L. Radiographie : normal. IRM : hypersignal T2 métaphysaire fémoral distal avec abcès sous-périosté. Hémoculture : *S. aureus* PVL+. *Urgence chirurgicale ou traitement médical seul ? Quelles sont les formes graves à redouter avec un S. aureus PVL+ ?*

## Objectifs d'apprentissage

1. **Reconnaître** les signes cliniques de l'ostéomyélite aiguë de l'enfant
2. **Connaître** les germes en cause selon l'âge
3. **Comprendre** la physiopathologie vasculaire métaphysaire
4. **Définir** les indications chirurgicales (ponction-drainage, fenêtre corticale)
5. **Prescrire** le traitement ATB adapté (probabiliste puis documenté)
6. **Identifier** les formes compliquées (PVL+, multifocale, thrombophlébite)

## Structure du contenu

### Section 14.1 — Épidémiologie et agents pathogènes selon l'âge

**Contenu obligatoire** :
- Incidence : 1-13/100 000 enfants/an, prédominance masculine (2:1)
- Pic d'âge : 5-15 ans (pic de croissance métaphysaire)
- **Germes par tranche d'âge** :
  - Nouveau-né (<3 mois) : *S. aureus*, *Streptocoque B*, BGN (*E. coli*, *Klebsiella*)
  - Nourrisson (3 mois-4 ans) : *S. aureus*, *Kingella kingae* (1ère cause dans certaines séries)
  - Enfant (>4 ans) : *S. aureus* (60-90%), *Streptococcus pyogenes*, *S. pneumoniae*
  - Drépanocytaire : *Salmonella* (classique !), *S. aureus*
- **S. aureus PVL+** : formes nécrosantes sévères, ostéomyélite multifocale, thrombophlébite septique, abcès multiples, haute mortalité si retard diagnostique
- Hémocultures positives dans 30-50% des cas

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA14-S01-001 | 📊 INFOGRAPHIE | Germes de l'ostéomyélite de l'enfant selon l'âge | Tableau par tranche d'âge |
| MIOA14-S01-002 | 📐 SCHÉMA | Localisations préférentielles de l'ostéomyélite hématogène de l'enfant (fémur distal, tibia proximal, humérus proximal) | Squelette enfant annoté |
| MIOA14-S01-003 | 📷 IMAGE | IRM d'ostéomyélite métaphysaire fémorale distale chez l'enfant | Coupes T1, T2, Gado |

### Section 14.2 — Présentation clinique et diagnostic

**Contenu obligatoire** :
- Tableau typique : fièvre + douleur métaphysaire exquise + impotence fonctionnelle + boiterie/refus de marche
- Palpation métaphysaire systématique : « point douloureux métaphysaire » = signe cardinal
- Nouveau-né : pseudo-paralysie, irritabilité, sepsis — pas de localisation évidente
- **Bilan minimal** : NFS, CRP, hémocultures (×2-3), radiographies bilatérales comparatives
- **IRM** : examen de référence — dans les 24-48h si suspicion clinique forte, en urgence si suspicion de forme compliquée
- Radiographie : normale les 10-14 premiers jours, utile pour éliminer d'autres diagnostics (fracture, tumeur)
- Échographie : abcès sous-périosté, épanchement articulaire associé (hanche ++)
- **Diagnostics différentiels** : fracture de fatigue, tumeur (sarcome d'Ewing, ostéosarcome !), crise vaso-occlusive drépanocytaire, arthrite juvénile idiopathique, cellulite

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA14-S02-001 | 📐 SCHÉMA | Examen clinique : points de palpation métaphysaire | Schéma des zones |
| MIOA14-S02-002 | 📊 INFOGRAPHIE | Bilan initial devant une suspicion d'ostéomyélite aiguë de l'enfant | Checklist |
| MIOA14-S02-003 | 📷 IMAGE | Diagnostics différentiels en imagerie : ostéomyélite vs Ewing vs ostéosarcome | IRM comparatives |
| MIOA14-S02-004 | 📐 SCHÉMA | Algorithme diagnostique de l'ostéomyélite aiguë de l'enfant | Arbre décisionnel |

### Section 14.3 — Traitement médical : antibiothérapie

**Contenu obligatoire** :
- **Urgence** : antibiothérapie IV dès les prélèvements réalisés (hémocultures ± ponction osseuse)
- ATB probabiliste : oxacilline ou céfamandole (couvre SASM) ; si <4 ans : amoxicilline-ac. clavulanique (couvre *K. kingae*)
- Relais oral précoce (J3-J5) si : apyrexie, CRP ↓↓, bonne tolérance digestive — étude POET (New England, 2019)
- Durée totale : **3-4 semaines** (consensus actuel vs 6 semaines historique)
- Schéma court validé : études finlandaises (Peltola), CRP comme guide de durée
- Suivi : CRP à J3, J7, J14, puis hebdomadaire ; radiographie à M1, M3, M6

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA14-S03-001 | 📊 INFOGRAPHIE | Protocole d'antibiothérapie de l'ostéomyélite aiguë de l'enfant | Protocole structuré |
| MIOA14-S03-002 | 📐 SCHÉMA | Relais IV → oral : critères et timing | Arbre décisionnel |

### Section 14.4 — Indications chirurgicales

**Contenu obligatoire** :
- La majorité des ostéomyélites aiguës de l'enfant guérissent sous **ATB seuls** (sans chirurgie)
- **Indications chirurgicales** :
  - Abcès sous-périosté > 3-5mm (drainage chirurgical ou ponction-aspiration)
  - Absence d'amélioration à 48-72h d'ATB adapté
  - Abcès intra-osseux volumineux
  - Arthrite septique associée (drainage articulaire obligatoire)
  - *S. aureus* PVL+ avec complications nécrosantes
  - Formes multifocales sévères
- **Techniques chirurgicales** : ponction-aspiration, fenêtre corticale + curetage, drainage d'abcès sous-périosté, lavage articulaire (en cas d'arthrite associée)
- Le débridement extensif de type adulte est rarement nécessaire chez l'enfant

### Section 14.5 — Formes compliquées et rare

**Contenu obligatoire** :
- **Ostéomyélite à S. aureus PVL+** : formes multifocales, nécrosantes, thrombophlébite septique (veine fémorale, cave), abcès pulmonaires métastatiques, mortalité 5-10%, prise en charge en réanimation
- **Arthrite septique associée** : hanche et épaule (métaphyse intra-capsulaire), urgence chirurgicale de drainage
- **Ostéomyélite multifocale** : scintigraphie corps entier, hémocultures PVL recherché en urgence
- **CRMO (Chronic Recurrent Multifocal Osteomyelitis)** : pathologie auto-inflammatoire, PAS infectieuse (diagnostic différentiel !), pas d'ATB

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA14-S05-001 | 📷 IMAGE | Ostéomyélite PVL+ multifocale — IRM corps entier | IRM spectaculaire |
| MIOA14-S05-002 | 📐 SCHÉMA | Thrombophlébite septique : physiopathologie et complications | Schéma vasculaire |
| MIOA14-S05-003 | 📊 INFOGRAPHIE | CRMO vs ostéomyélite infectieuse — tableau de diagnostic différentiel | Comparatif |

### Points clés du Module 14

1. L'ostéomyélite aiguë de l'enfant touche la métaphyse des os longs avec un pic entre 5-15 ans
2. *S. aureus* est le germe principal ; *K. kingae* est la 1ère cause chez l'enfant <4 ans
3. La radiographie est NORMALE les 10-14 premiers jours — l'IRM est l'examen de référence
4. La majorité guérit sous ATB seuls ; la chirurgie est réservée aux abcès et aux formes compliquées
5. Le relais oral précoce (J3-J5) et la durée courte (3-4 semaines) sont validés par des études récentes
6. Les formes PVL+ sont potentiellement graves : multifocales, nécrosantes, thrombophlébite septique
7. La CRMO est auto-inflammatoire et NE NÉCESSITE PAS d'antibiotiques (diagnostic différentiel !)

---

# MODULE 15 : OSTÉOMYÉLITE AIGUË ET SUBAIGUË DE L'ADULTE

**Partie** : V — Ostéomyélite
**Durée estimée** : 3h00
**Niveau** : Intermédiaire
**Prérequis** : Module 14

## Accroche clinique

> 🏥 **Cas clinique — M. Garcia, 55 ans** : Douleur progressive du tibia droit depuis 6 semaines, fébricule intermittente (37.8°C). Diabétique type 2. Radiographie : lésion lytique métaphysaire proximale tibiale avec halo de sclérose. IRM : cavité en hypersignal T2 avec prise de contraste périphérique et penumbra sign. Biopsie scanno-guidée : *S. aureus* SASM. *Abcès de Brodie ? Quelle prise en charge ?*

## Objectifs d'apprentissage

1. **Distinguer** les formes aiguës, subaiguës (Brodie) et chroniques chez l'adulte
2. **Identifier** les facteurs de risque spécifiques de l'adulte
3. **Maîtriser** le diagnostic et le traitement de l'abcès de Brodie
4. **Comprendre** les différences avec l'enfant (vascularisation, germes, présentation)

## Structure du contenu

### Section 15.1 — Particularités de l'ostéomyélite hématogène de l'adulte

**Contenu obligatoire** :
- Beaucoup plus rare que chez l'enfant
- Localisations : vertèbres (spondylodiscite >>> os longs), os périphériques si immunodépression, UDIV, drépanocytaire adulte
- Porte d'entrée : urinaire, cutanée, dentaire, endocardite, cathéters
- Germes : *S. aureus* (50%), streptocoques, BGN (sujet âgé, urinaire), *M. tuberculosis* (rachis)
- Présentation souvent subaiguë ou chronique (diagnostic retardé)

### Section 15.2 — L'abcès de Brodie

**Contenu obligatoire** :
- Forme subaiguë d'ostéomyélite : cavité intra-osseuse collectée, bien limitée, entourée de sclérose
- Localisation : métaphyse des os longs (identique aux enfants), parfois transphysaire
- Germe : *S. aureus* (le plus fréquent), mais cultures souvent négatives (30-50%)
- Imagerie : lésion lytique ronde/ovale, sclérose périlésionnelle, penumbra sign en IRM
- Diagnostic différentiel : tumeur osseuse (ostéome ostéoïde, histiocytose, lymphome, métastase)
- Traitement : biopsie pour identification de germe + ATB 6 semaines ; curetage chirurgical si volumineux ou échec du traitement médical

### Section 15.3 — Ostéomyélite vertébrale (renvoi Module 22)

- Renvoi détaillé vers Module 22 (Spondylodiscite)
- Place de l'ostéomyélite hématogène dans l'atteinte vertébrale de l'adulte

### Points clés du Module 15

1. L'ostéomyélite hématogène de l'adulte atteint préférentiellement le rachis (spondylodiscite)
2. L'abcès de Brodie est la forme subaiguë classique : cavité intra-osseuse, sclérose périlésionnelle, penumbra sign en IRM
3. Les cultures de l'abcès de Brodie sont négatives dans 30-50% des cas
4. Le diagnostic différentiel principal est la tumeur osseuse

---

# MODULE 16 : OSTÉOMYÉLITE CHRONIQUE — PHYSIOPATHOLOGIE ET TRAITEMENT

**Partie** : V — Ostéomyélite
**Durée estimée** : 4h00
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 4, 14, 15

## Accroche clinique

> 🏥 **Cas clinique — M. Benali, 42 ans** : Ostéomyélite chronique du tibia droit, rémontant à une fracture ouverte il y a 15 ans. Épisodes d'exacerbation-rémission, fistule intermittente sur la face antéromédiale. Scanner : séquestre cortical de 8 cm, sclérose étendue, involucrum incomplet. CRP = 12 mg/L (à peine élevée !). *Quel est votre plan ? Peut-on guérir cette ostéomyélite chronique de 15 ans ?*

## Objectifs d'apprentissage

1. **Comprendre** la physiopathologie de la chronicité (séquestre, biofilm, dormance)
2. **Classer** l'ostéomyélite chronique selon Cierny-Mader
3. **Planifier** le traitement chirurgical radical (séquestrectomie, curetage, résection segmentaire)
4. **Choisir** le comblement adapté (ciment, greffe, substituts)
5. **Prescrire** l'antibiothérapie post-chirurgicale adaptée
6. **Gérer** les échecs et les récidives

## Structure du contenu

### Section 16.1 — Physiopathologie de la chronicité

- Séquestre comme sanctuaire bactérien inaccessible
- Biofilm mature irréversible
- SCV dormantes dans les ostéocytes
- Sclérose corticale = tissu avasculaire, impénétrable aux ATB
- Cercle vicieux : infection → nécrose → séquestre → réinfection
- La CRP peut être NORMALE dans l'ostéomyélite chronique quiescente

### Section 16.2 — Traitement chirurgical radical

**Contenu obligatoire** :
- **Principe fondamental** : excision complète de tout le tissu infecté et nécrosé (séquestrectomie + curetage radical)
- **Séquestrectomie** : extraction du séquestre, curetage de la cavité, avivage des berges jusqu'à l'os sain (« paprika sign » = os vascularisé saignant en nappe)
- **Résection segmentaire** : Cierny IV — résection de la totalité du segment infecté (instabilité mécanique → reconstruction nécessaire)
- **Comblement de l'espace mort** : OBLIGATOIRE, sinon récidive
  - Ciment PMMA chargé d'ATB (temporaire ou définitif)
  - Greffe osseuse spongieuse autologue (crête iliaque, RIA) — en 1 ou 2 temps
  - Membrane induite (Masquelet) — combler les pertes osseuses >4-6 cm
  - Substituts osseux : sulfate de calcium, hydroxyapatite, bio-verre
- **Papineau** (ostéotomie-comblement à ciel ouvert) : technique historique, encore utilisée dans certaines situations
- **Couverture des tissus mous** : souvent nécessaire (peau fragile, fistule, cicatrice) — lambeaux locaux ou libres (renvoi Module 28)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA16-S02-001 | 🎬 ANIMATION | Séquestrectomie radicale : technique pas à pas | Animation chirurgicale 3D |
| MIOA16-S02-002 | 📷 IMAGE | « Paprika sign » : os sain vascularisé après curetage radical | Photo per-opératoire |
| MIOA16-S02-003 | 📷 IMAGE | Comblement par ciment antibiotique après séquestrectomie | Photo + radiographie |
| MIOA16-S02-004 | 📐 SCHÉMA | Algorithme thérapeutique de l'ostéomyélite chronique selon Cierny-Mader | Arbre de décision complet |
| MIOA16-S02-005 | 📊 INFOGRAPHIE | Options de comblement : ciment, greffe, Masquelet, bio-verre — tableau comparatif | Multicritère |

### Section 16.3 — Antibiothérapie de l'ostéomyélite chronique

- Post-chirurgicale : 6-12 semaines d'ATB adapté au germe
- Traitement suppressif chronique : si patient Cierny C (contre-indication chirurgicale), ATB oral au long cours (doxycycline, TMP-SMX, amoxicilline)
- Pas de rôle de la rifampicine si pas de matériel en place

### Section 16.4 — Récidives et gestion des échecs

- Taux de récidive : 15-30% malgré traitement optimal
- Causes d'échec : débridement insuffisant, mauvais comblement, défaut de couverture cutanée, immunodépression, germe résistant
- Re-chirurgie : nouvelle séquestrectomie, résection plus étendue
- Amputation : dernier recours, discutée en RCP après multiples échecs, évaluation qualité de vie

### Points clés du Module 16

1. L'ostéomyélite chronique est une maladie chirurgicale : les antibiotiques seuls ne guérissent pas si le séquestre n'est pas retiré
2. Le débridement doit être radical : excision jusqu'à l'os sain saignant (« paprika sign »)
3. L'espace mort après séquestrectomie DOIT être comblé (ciment, greffe, Masquelet)
4. La CRP peut être normale dans l'ostéomyélite chronique — ne jamais conclure à l'absence d'infection sur une CRP normale
5. Le taux de récidive reste de 15-30% même avec un traitement optimal
6. L'amputation est le dernier recours, discutée en RCP après échecs multiples

---

# MODULE 17 : OSTÉOMYÉLITE POST-TRAUMATIQUE ET SUR FRACTURE OUVERTE

**Partie** : V — Ostéomyélite
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Module 16

## Accroche clinique

> 🏥 **Cas clinique — M. Messaoud, 28 ans** : AVP moto, fracture ouverte du tibia Gustilo IIIB. Parage chirurgical + fixateur externe en urgence. ATB prophylactique par amoxicilline-acide clavulanique 48h. À J+10, fièvre, écoulement trouble par la plaie. Prélèvements : *Pseudomonas aeruginosa*. *Était-ce prévisible ? L'antibioprophylaxie était-elle adaptée ? Quelle est votre stratégie ?*

## Objectifs d'apprentissage

1. **Évaluer** le risque infectieux selon la classification de Gustilo-Anderson
2. **Maîtriser** l'antibioprophylaxie des fractures ouvertes
3. **Diagnostiquer** l'infection post-traumatique précoce et tardive
4. **Traiter** l'ostéomyélite post-traumatique (débridement, fixation, couverture, ATB)
5. **Appliquer** le concept de FRI (Fracture-Related Infection)

## Structure du contenu

### Section 17.1 — Fractures ouvertes : classification et risque infectieux

**Contenu obligatoire** :
- **Classification de Gustilo-Anderson** :
  - Type I : plaie <1cm, fracture simple → risque infection 0-2%
  - Type II : plaie 1-10 cm, contamination modérée → risque 2-10%
  - Type IIIA : plaie >10cm, couverture cutanée possible → risque 10-25%
  - Type IIIB : perte de substance cutanée, périoste dénudé, lambeau nécessaire → risque 25-50%
  - Type IIIC : lésion vasculaire nécessitant réparation → risque 25-50% + risque amputatoire
- **Facteurs de risque additionnels** : tabac, diabète, polytraumatisme, délai de prise en charge, contamination tellurique

### Section 17.2 — Antibioprophylaxie et premiers soins

**Contenu obligatoire** :
- **Recommandations** :
  - Gustilo I-II : céphalosporine 1re gén (céfazoline) 24-48h
  - Gustilo III : céphalosporine + aminoside (gentamicine) 48-72h ; ajouter pénicilline si contamination tellurique (Clostridium)
- Parage chirurgical précoce : dans les 6-12h idéalement (débat sur l'urgence absolue vs semi-urgence)
- Irrigation : sérum physiologique abondant (low-pressure pulsatile lavage vs high-pressure débattu)
- Fixation : fixateur externe (Gustilo III), enclouage centromédullaire (Gustilo I-II après parage), jamais de plaque sur fracture fortement contaminée
- Couverture des parties molles : impératif dans les 7-10 jours (lambeau si IIIB)
- Attitude « fix and flap » (Gopal) : fixation + lambeau dans les 72h si possible

### Section 17.3 — Diagnostic et traitement de l'infection post-traumatique

**Contenu obligatoire** :
- Infection précoce vs tardive : <4 semaines (germes nosocomiaux) vs >4 semaines (chronicité)
- Diagnostic : clinique (désunion, écoulement, fièvre) + biologie (CRP) + imagerie (scanner, IRM si matériel compatible)
- Prélèvements profonds au bloc opératoire (≥5)
- **Traitement** :
  - Débridement chirurgical radical + stabilisation de la fracture
  - Si fracture non consolidée : maintien/changement de fixation (clou, fixateur externe) + débridement itératif
  - Si fracture consolidée : ablation matériel + séquestrectomie + comblement
  - ATB adaptée 6-12 semaines
  - Concept FRI : consolidation osseuse = objectif parallèle au contrôle de l'infection

### Section 17.4 — Transport osseux et reconstruction secondaire

- Pertes osseuses >4-6 cm : membrane induite (Masquelet), transport osseux (Ilizarov), méga-prothèse
- Délai de reconstruction : une fois l'infection maîtrisée (stérilisation confirmée)
- Renvoi détaillé vers Module 27

### Points clés du Module 17

1. Le risque infectieux augmente avec la sévérité de la fracture ouverte : 0-2% (Gustilo I) à 25-50% (Gustilo IIIB-C)
2. L'antibioprophylaxie doit couvrir le *S. aureus* (céfazoline) ; ajout d'aminoside pour Gustilo III
3. Le parage précoce et la couverture rapide des parties molles sont essentiels pour prévenir l'infection
4. L'objectif double est de contrôler l'infection ET d'obtenir la consolidation osseuse
5. Le concept de FRI standardise le diagnostic de l'infection sur fracture

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 6 — Arthrite Septique et Infection Périprothétique (Modules 18-21)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 18 : ARTHRITE SEPTIQUE DE L'ARTICULATION NATIVE

**Partie** : VI — Arthrite Septique et Infection Périprothétique
**Durée estimée** : 3h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 2, 3, 7

## Accroche clinique

> 🏥 **Cas clinique — M. Dupont, 72 ans** : Genou droit chaud, gonflé, douloureux depuis 3 jours, fièvre 38.5°C. Antécédent d'infiltration de corticoïdes du genou droit il y a 10 jours pour gonarthrose. Ponction articulaire : liquide purulent, 85 000 GB/mm³ (92% PNN). Cristaux : absents. Examen direct : cocci Gram+ en amas. *Urgence ? Quel traitement ? L'infiltration est-elle en cause ?*

## Objectifs d'apprentissage

1. **Reconnaître** le tableau clinique d'arthrite septique native
2. **Différencier** arthrite septique et arthrite microcristalline
3. **Pratiquer** et interpréter la ponction articulaire diagnostique
4. **Prescrire** l'antibiothérapie adaptée
5. **Indiquer** et réaliser le lavage articulaire chirurgical
6. **Évaluer** le pronostic fonctionnel articulaire

## Structure du contenu

### Section 18.1 — Épidémiologie et physiopathologie articulaire

**Contenu obligatoire** :
- Incidence : 2-10/100 000/an ; pic bimodal (<5 ans et >65 ans)
- Articulation synoviale : cible idéale (vascularisée, pas de membrane basale endothéliale dans la synoviale)
- 3 voies de contamination : hématogène (principale), inoculation directe (infiltration, chirurgie, plaie pénétrante), contiguïté (ostéomyélite métaphysaire intra-capsulaire)
- **Localisations** : genou (50%), hanche (20%), épaule (10%), cheville (7%), poignet, coude, doigts
- **Effet de l'infection sur le cartilage** : destruction rapide (48-72h) par protéases bactériennes + enzymes leucocytaires + pression intra-articulaire + toxines → dommage irréversible
- Urgence : chaque heure de retard thérapeutique aggrave le pronostic fonctionnel

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA18-S01-001 | 🎬 ANIMATION | Physiopathologie de l'arthrite septique : contamination → destruction du cartilage | Animation chronologique |
| MIOA18-S01-002 | 📐 SCHÉMA | Les 3 voies de contamination articulaire | Schéma anatomique |
| MIOA18-S01-003 | 📊 INFOGRAPHIE | Distribution des localisations d'arthrite septique | Diagramme avec squelette |

### Section 18.2 — Diagnostic clinico-biologique

**Contenu obligatoire** :
- **Tableau typique** : monoarthrite aiguë fébrile avec impotence fonctionnelle sévère
- Genou : gros genou chaud, rouge, douloureux, épanchement sous tension, flexum antalgique
- Hanche : douleur inguinale, rotation externe douloureuse, position antalgique (flexion-abduction-rotation externe), palpation articulaire impossible → diagnostic souvent tardif chez l'adulte
- **Ponction articulaire : pierre angulaire du diagnostic** :
  - Urgence : toute monoarthrite aiguë fébrile doit être ponctiée
  - Aspect macroscopique : purulent ou trouble
  - Cytologie : > 50 000 GB/mm³ (souvent >100 000) avec > 90% PNN
  - Recherche de cristaux : INDISPENSABLE (éliminer goutte/chondrocalcinose) — NB : arthrite septique et microcristalline peuvent COEXISTER
  - Examen bactériologique : Gram + culture (aéro-anaérobie)
  - Culture positive dans 70-90% des cas
- **Germes** :
  - *S. aureus* : 60% des cas (adulte)
  - *Streptocoques* : 15-20%
  - *Neisseria gonorrhoeae* : sujet jeune, polyarthrite migratrice → monoarthrite
  - *K. kingae* : enfant <4 ans
  - BGN : sujet âgé, immunodéprimé, UDIV
  - *Mycobacterium tuberculosis* : arthrite chronique, mono-viscérale
- **Diagnostics différentiels** :
  - Arthrite microcristalline (goutte, CCA) — cristaux visibles en microscopie polarisée
  - Arthrite réactionnelle
  - Poussée de PR
  - Hémarthrose sur anticoagulant

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA18-S02-001 | 📷 IMAGE | Genou septique : aspect clinique (tuméfaction, rougeur) | Photo clinique |
| MIOA18-S02-002 | 🎬 VIDÉO | Ponction articulaire du genou : technique, aspect du liquide | Vidéo procédurale |
| MIOA18-S02-003 | 📐 SCHÉMA | Algorithme : ponction articulaire → interprétation → décision | Arbre complet |
| MIOA18-S02-004 | 📊 INFOGRAPHIE | Liquide articulaire : septique vs mécanique vs inflammatoire vs microcristallin | Tableau comparatif |

### Section 18.3 — Traitement : antibiothérapie et lavage articulaire

**Contenu obligatoire** :
- **Antibiothérapie** :
  - Urgence dès la ponction réalisée
  - Probabiliste anti-staphylococcique (oxacilline ou céfazoline) + aminoside si sepsis
  - Adaptation à l'antibiogramme dès résultat
  - Durée : **4-6 semaines** (accord professionnel, pas d'étude randomisée adulte)
  - Relais oral dès l'amélioration clinico-biologique (J3-J7)
- **Lavage articulaire** :
  - **Genou, épaule, cheville** : lavage arthroscopique (gold standard), répété si nécessaire
  - **Hanche** : arthrotomie chirurgicale (lavage arthroscopique possible mais plus complexe)
  - Quand ? En urgence dans les 24h, idéalement <12h
  - Lavage abondant (>10L) + synovectomie si synoviale très épaissie
  - Drainage aspiratif 48h
  - Ponctions-aspirations itératives : alternative acceptable si patient inopérable (comorbidités)
- **Immobilisation** : controversée — mobilisation passive précoce recommandée pour préserver le cartilage

### Section 18.4 — Pronostic et séquelles

**Contenu obligatoire** :
- Mortalité : 5-15% (sujet âgé, comorbidités, poly-articulaire)
- Séquelles articulaires permanentes : 30-50% des cas
- Facteurs de mauvais pronostic : âge >65 ans, retard diagnostique >48h, hanche, immunodépression, *S. aureus*
- Arthrose secondaire : quasi constante après arthrite septique
- Arthrodèse : option de sauvetage (cheville, épaule, genou)
- Rôle de la kinésithérapie dans la récupération (renvoi Module 28)

### Points clés du Module 18

1. Toute monoarthrite aiguë fébrile est une arthrite septique jusqu'à preuve du contraire → PONCTION EN URGENCE
2. Le cartilage est détruit en 48-72h → urgence diagnostique et thérapeutique
3. Liquide articulaire septique : >50 000 GB/mm³, >90% PNN, bactéries au Gram + culture
4. Toujours chercher des cristaux : arthrite septique et microcristalline peuvent coexister
5. S. aureus est le 1er germe chez l'adulte ; K. kingae chez l'enfant <4 ans
6. Lavage articulaire en urgence + antibiothérapie IV = traitement de référence
7. Séquelles articulaires dans 30-50% des cas malgré traitement adapté

---

# MODULE 19 : INFECTION PÉRIPROTHÉTIQUE — DIAGNOSTIC ET CLASSIFICATION

**Partie** : VI — Arthrite Septique et Infection Périprothétique
**Durée estimée** : 4h00
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 7, 9, 10

## Accroche clinique

> 🏥 **Cas clinique — Mme Lefèvre, 74 ans** : Prothèse totale de hanche droite posée il y a 2 ans. Douleur inguinale droite progressive depuis 6 mois, pas de fièvre, marche limitée à 200m. CRP = 18 mg/L. Radiographie : liseré >2mm progressif, ostéolyse zones I et VII de DeLee-Charnley. Suspicion d'infection chronique ? Descellement septique vs aseptique ? *Comment faire la part des choses ?*

## Objectifs d'apprentissage

1. **Définir** l'infection périprothétique et sa classification temporelle (Tsukayama/Zimmerli)
2. **Appliquer** les critères diagnostiques (MSIS/ICM 2018)
3. **Interpréter** les examens complémentaires (biologie, imagerie, ponction, alpha-défensine)
4. **Distinguer** descellement septique et aseptique
5. **Évaluer** les facteurs pronostiques

## Structure du contenu

### Section 19.1 — Épidémiologie et facteurs de risque

**Contenu obligatoire** :
- Incidence : PTH 0.5-2%, PTG 1-2.5%, prothèse d'épaule 1-4%, prothèse de coude 3-8%
- Coût moyen d'un sepsis sur prothèse : 50 000-100 000 € (traitement complet)
- **Facteurs de risque pré-opératoires** :
  - Diabète (OR 1.5-2), obésité IMC>40 (OR 2-3), immunosuppression, polyarthrite rhumatoïde
  - ATCD de révision prothétique, ATCD d'infection articulaire
  - Malnutrition (albumine <35 g/L), anémie
  - Tabagisme actif, ASA ≥3
- **Facteurs de risque per-opératoires** :
  - Durée opératoire >2.5h, reprise précoce, hématome post-opératoire
  - Contamination per-opératoire (flux laminaire mal positionné, trafic bloc opératoire)
- **Facteurs de risque post-opératoires** :
  - Bactériémie à distance (infection urinaire, dentaire, cutanée)
  - Désunion cicatricielle, hématome non drainé

### Section 19.2 — Classification temporelle

**Contenu obligatoire** :
- **Classification de Tsukayama (2002)** :
  - Type I : Culture per-opératoire positive (découverte fortuite) — ≥2 échantillons positifs au même germe
  - Type II : Infection post-opératoire précoce (<4 semaines) — S. aureus, BGN
  - Type III : Infection hématogène aiguë (>4 semaines, mais début brutal, articulation fonctionnelle avant) — S. aureus, streptocoques
  - Type IV : Infection chronique tardive (>4 semaines, insidieux) — SCN, Cutibacterium acnes, entérocoques
- **Classification de Zimmerli (NEJM 2004)** :
  - Précoce (<3 mois post-op) : germes virulents, contamination per-opératoire
  - Retardée (3-24 mois) : germes de faible virulence, mode insidieux
  - Tardive (>24 mois) : hématogène, début aigu
- **Lien entre classification et stratégie thérapeutique** : déterminant ++

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA19-S02-001 | 📊 INFOGRAPHIE | Classifications de Tsukayama et Zimmerli — correspondances et germes | Infographie comparative |
| MIOA19-S02-002 | 📐 SCHÉMA | Timeline des infections périprothétiques : de l'implantation à la bactériémie tardive | Frise chronologique |

### Section 19.3 — Démarche diagnostique

**Contenu obligatoire** :
- **Critères ICM 2018 (International Consensus Meeting)** :
  - Critère majeur (1 seul suffit) : fistule communiquant avec l'articulation, ou ≥2 cultures positives au même germe
  - Critères mineurs (score ≥6 = infection) :
    - CRP >10 mg/L (2 pts), VS >30 mm/h (2 pts)
    - Leucocytes synoviaux >3000/µL (3 pts), % PNN synoviaux >80% (2 pts)
    - Alpha-défensine positive (3 pts) — spécificité 97%
    - Histologie : >5 PNN/champ HPF (3 pts)
  - Score : ≥6 = infection probable, 2-5 = doute, ≤1 = infection peu probable
- **Biologie sérique** : CRP +++, VS (moins spécifique), IL-6 (normalisation rapide), D-dimères (nouveau marqueur)
- **Imagerie** :
  - Radiographies standards : liseré progressif, ostéolyse, descellement (MAIS non spécifique septique/aseptique)
  - Scanner avec réduction d'artefacts métalliques
  - Scintigraphie aux leucocytes marqués : spécificité ~85%
  - PET-scan au 18F-FDG : sensibilité élevée, spécificité variable
  - IRM : séquences réduction artefacts métalliques (MARS/SEMAC)
- **Ponction articulaire** :
  - INDISPENSABLE avant toute reprise chirurgicale pour suspicion d'infection
  - Fenêtre antibiotique 14 jours minimum
  - Cytologie + culture en milieu enrichi (14 jours)
  - Alpha-défensine : test immuno-chromatographique rapide ou ELISA
  - Leucocyte estérase : test bandelette rapide orientatif

### Section 19.4 — Prélèvements per-opératoires et critères histologiques

**Contenu obligatoire** :
- **Règle des 5 prélèvements** (IDSA) : ≥5 biopsies tissulaires péri-prothétiques dans des zones différentes
- Culture prolongée 14 jours (milieux aéro-anaérobie)
- ≥2 prélèvements positifs au même germe = infection confirmée
- 1 seul prélèvement positif : possible contaminant, interprétation prudente
- **Histologie** (examen extemporané + définitif) : ≥5 PNN/champ HPF (400×), 10 champs → sensibilité 80%, spécificité 90%
- **Sonication de l'implant** : détache le biofilm → culture, augmente la sensibilité de 30-40%
- **PCR 16S/MALDI-TOF** : utile si cultures négatives sous ATB ou germes fastidieux

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA19-S04-001 | 📐 SCHÉMA | Procédure de prélèvements per-opératoires (5 sites, conditionnement, transport) | Schéma technique |
| MIOA19-S04-002 | 📷 IMAGE | Sonication d'un implant : matériel et résultats | Photo de laboratoire |
| MIOA19-S04-003 | 📊 INFOGRAPHIE | Grille ICM 2018 : scoring critères majeurs et mineurs | Score interactif |

### Points clés du Module 19

1. L'infection périprothétique touche 1-2% des PTH/PTG — coût médico-économique majeur
2. La classification temporelle (Tsukayama/Zimmerli) détermine la stratégie thérapeutique
3. Critères ICM 2018 : score combinant CRP, cytologie synoviale, alpha-défensine, histologie — seuil ≥6
4. L'alpha-défensine a une spécificité de 97% — meilleur marqueur biologique actuel
5. ≥5 prélèvements per-opératoires, fenêtre ATB 14 jours, culture 14 jours, sonication
6. Ponction articulaire obligatoire avant toute reprise pour suspicion d'infection
7. La distinction septique/aseptique est FONDAMENTALE car le traitement est radicalement différent

---

# MODULE 20 : DAIR — DÉBRIDEMENT, ANTIBIOTIQUES, IRRIGATION, RÉTENTION

**Partie** : VI — Arthrite Septique et Infection Périprothétique
**Durée estimée** : 3h00
**Niveau** : Expert
**Prérequis** : Module 19

## Accroche clinique

> 🏥 **Cas clinique — Mme Bouchard, 68 ans** : PTG gauche posée il y a 15 jours. Depuis J7, rougeur, chaleur, écoulement séreux de la cicatrice, fièvre 38.2°C. CRP remontée à 205 mg/L (était à 35 à J5). Radiographies : implant en bonne position. *Infection post-opératoire précoce. DAIR ou changement ? Quels sont les critères de décision ?*

## Objectifs d'apprentissage

1. **Définir** les indications du DAIR (conservation de la prothèse)
2. **Comprendre** les critères de sélection des patients éligibles au DAIR
3. **Décrire** la technique chirurgicale du DAIR
4. **Prescrire** l'antibiothérapie post-DAIR avec bi-thérapie rifampicine
5. **Évaluer** les résultats et facteurs d'échec du DAIR

## Structure du contenu

### Section 20.1 — Indications et contre-indications du DAIR

**Contenu obligatoire** :
- **Conditions d'éligibilité** (ALL doivent être remplis) :
  - Infection aiguë : <4 semaines depuis l'apparition des symptômes (critères de « l'infection aiguë »)
  - Post-opératoire précoce (<30 jours) OU hématogène aiguë (symptômes <3 semaines)
  - Implant stable (pas de descellement mécanique)
  - Pas de fistule chronique
  - État des tissus mous acceptable (pas de nécrose étendue, possibilité de fermeture)
  - Germe sensible à la rifampicine et aux fluoroquinolones (pour bi-thérapie orale)
- **Contre-indications RELATIVES au DAIR** :
  - SARM (succès DAIR 30-40% vs 70% pour SASM)
  - Polyéthylène non échangeable
  - Symptômes >4 semaines
  - Fistule
  - Multiples reprises antérieures

### Section 20.2 — Technique chirurgicale

**Contenu obligatoire** :
- Arthrotomie large (même voie d'abord)
- Synovectomie radicale
- Lavage abondant (>9L de sérum physiologique)
- Échange des pièces mobiles : polyéthylène (insert tibial PTG, liner acétabulaire PTH), tête fémorale modulaire
- NE PAS déposer les implants fixés et stables
- Prélèvements multiples (≥5) AVANT lavage
- Fermeture sur drain aspiratif
- Nombre de DAIR : 1, maximum 2 tentatives — au-delà, changement prothétique

### Section 20.3 — Antibiothérapie post-DAIR

**Contenu obligatoire** :
- **Phase d'attaque IV** (2-4 semaines) : ATB IV adaptée au germe
- **Phase d'entretien orale** (10-12 semaines pour staphylocoques, 6-8 semaines pour streptocoques) :
  - STAPHYLOCOQUE : **rifampicine + fluoroquinolone** (lévofloxacine ou ofloxacine) — combinaison clé anti-biofilm
  - NE JAMAIS donner la rifampicine en monothérapie (résistance en 24-48h !)
  - Alternative si FQ contre-indiquée : rifampicine + cotrimoxazole / acide fusidique / clindamycine
  - Streptocoque : amoxicilline + rifampicine (ou FQ)
  - BGN : fluoroquinolone (ciprofloxacine) seule possible
- Étude majeure : **Zimmerli (JAMA 1998)** — rifampicine + ciprofloxacine vs ciprofloxacine seule → 100% vs 58% de succès

### Section 20.4 — Résultats et facteurs d'échec

**Contenu obligatoire** :
- Taux de succès global du DAIR : 60-75%
- **Facteurs de bon pronostic** : infection précoce (<7 jours), SASM, bi-thérapie rifampicine, 1er DAIR
- **Facteurs d'échec** : SARM (30-40% succès), symptômes >4 semaines, Gram-négatif, polymicrobien, immunodéprimé, échec d'un 1er DAIR
- En cas d'échec de DAIR → changement prothétique en 1 ou 2 temps (Modules 21)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA20-S04-001 | 📊 INFOGRAPHIE | Algorithme décisionnel : DAIR vs changement prothétique | Arbre de décision |
| MIOA20-S04-002 | 📐 SCHÉMA | Technique chirurgicale du DAIR (synovectomie, changement insert, lavage) | Schéma technique |
| MIOA20-S04-003 | 📊 INFOGRAPHIE | Antibiothérapie post-DAIR : protocole rifampicine + compagnon selon germe | Tableau protocole |
| MIOA20-S04-004 | 🎬 ANIMATION InfectoSim© | Simulation : évaluer un patient pour DAIR vs changement — critères de sélection | Exercice interactif |

### Points clés du Module 20

1. DAIR = conservation de la prothèse — réservé aux infections aiguës (<4 semaines), implant stable, pas de fistule
2. Technique : synovectomie + lavage abondant + échange des pièces mobiles + ≥5 prélèvements
3. Bi-thérapie rifampicine + FQ = pierre angulaire du traitement des infections staphylococciques sur matériel
4. JAMAIS de rifampicine en monothérapie (risque de résistance immédiat)
5. Taux de succès 60-75% ; SARM = facteur d'échec majeur (succès ~30-40%)
6. Maximum 2 tentatives de DAIR avant de passer au changement prothétique

---

# MODULE 21 : CHANGEMENT PROTHÉTIQUE EN 1 OU 2 TEMPS — STRATÉGIES DE SAUVETAGE

**Partie** : VI — Arthrite Septique et Infection Périprothétique
**Durée estimée** : 4h30
**Niveau** : Expert
**Prérequis** : Modules 19, 20

## Accroche clinique

> 🏥 **Cas clinique — M. Rossi, 62 ans** : PTH gauche infectée chronique (3 ans post-op). Fistule inguinale depuis 6 mois. Ponction : *S. epidermidis* multi-résistant (R rifampicine, R FQ, S vancomycine, S daptomycine). Scanner : descellement complet des 2 composants, ostéolyse majeure zone II-III de Gruen. DAIR exclu (fistule + chronique + germe résistant). *1 temps ou 2 temps ? Comment reconstruire avec cette perte osseuse ?*

## Objectifs d'apprentissage

1. **Choisir** entre un changement en 1 temps et en 2 temps selon la situation clinique
2. **Décrire** la technique du changement en 2 temps avec spacer
3. **Prescrire** l'antibiothérapie inter-temps
4. **Déterminer** le bon timing pour la réimplantation
5. **Connaître** les stratégies de sauvetage (arthrodèse, résection, amputation)

## Structure du contenu

### Section 21.1 — Changement en 1 temps

**Contenu obligatoire** :
- **Principe** : dépose + réimplantation dans la même intervention chirurgicale
- **Indications** (plutôt européennes, tradition scandinave et française) :
  - Germe identifié et sensible avant la chirurgie
  - Pas de fistule complexe
  - Perte osseuse modérée (pas de reconstruction majeure nécessaire)
  - Tissus mous de bonne qualité
  - Patient pouvant supporter une chirurgie longue
- **Avantages** : 1 seule intervention, pas de spacer, reprise fonctionnelle plus rapide, coût réduit, moins de complications liées à l'immobilisation
- **Technique** : dépose complète, curetage radical, ciment de scellement chargé ATB, +/- greffe osseuse, réimplantation avec ciment ATB
- **Résultats** : taux de guérison 85-95% (dans des indications bien sélectionnées)

### Section 21.2 — Changement en 2 temps (gold standard historique)

**Contenu obligatoire** :
- **Principe** : 1er temps = dépose + spacer ; 2ème temps = réimplantation après stérilisation
- **1er temps chirurgical** :
  - Dépose de tous les implants + extraction du ciment
  - Curetage radical de tout le tissu infecté
  - Prélèvements multiples (≥5)
  - Mise en place du **spacer** : ciment PMMA chargé d'ATB haute dose (vancomycine + gentamicine)
    - Spacer articulé (mobile) : préserve la mobilité, facilite le 2e temps
    - Spacer statique : plus stable si perte osseuse sévère ou infection sévère
- **Inter-temps** :
  - ATB IV 6 semaines puis relais oral (durée totale 8-12 semaines selon les centres)
  - Fenêtre ATB avant le 2e temps : 2-6 semaines sans ATB
  - Critères de réimplantation : CRP normalisée, ponction du spacer stérile, bon état des tissus mous
- **2e temps chirurgical** (8-16 semaines après le 1er temps) :
  - Retrait du spacer, prélèvements (≥5), lavage
  - Réimplantation prothétique (ciment +/- chargé ATB)
  - +/- greffes osseuses (impaction grafting, allogreffes structurales)
- **Résultats** : taux de guérison 85-95%

### Section 21.3 — Comparaison 1 temps vs 2 temps

- **Méta-analyses** : pas de supériorité claire du 2 temps vs 1 temps en termes d'éradication (Kunutsor et al., 2015)
- **Tendance internationale** : élargissement des indications du 1 temps (coût-efficacité, qualité de vie)
- **Facteurs décisionnels** :
  - 1 temps si : germe connu sensible, sinus/fistule absent, perte osseuse modérée, bon état général
  - 2 temps si : germe résistant/inconnu, fistule, perte osseuse sévère, insuffisance des tissus mous, échec préalable

### Section 21.4 — Stratégies de sauvetage

**Contenu obligatoire** :
- Quand les changements échouent (< 5-10% des cas) :
  - **Résection-arthroplastie (Girdlestone)** : hanche — résection tête fémorale + nettoyage, pas de réimplantation. Résultat fonctionnel médiocre mais éradication de l'infection. Inégalité de longueur, instabilité, marche avec aides
  - **Arthrodèse** : genou — fusion osseuse, supprime la douleur mais supprime la mobilité. Technique : enclouage centromédullaire, fixateur externe, greffe
  - **Amputation** : dernier recours absolu, discutée en RCP. Indications : infection incontrôlable mettant en jeu le pronostic vital, douleur chronique invalidante, membre non fonctionnel
  - **Traitement suppressif chronique** : ATB au long cours (indéfini) chez le patient non opérable (Cierny C)
- Place de la RCP multidisciplinaire (CRIOA — Centre de Référence des IOA) : recommandation d'adresser les cas complexes aux CRIOA

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA21-S01-001 | 📷 IMAGE | Changement en 1 temps : per-opératoire et radiographies | Série d'images |
| MIOA21-S02-001 | 📷 IMAGE | Spacer en ciment antibiotique : articulé vs statique | Photos comparatives |
| MIOA21-S02-002 | 🎬 ANIMATION | Changement en 2 temps : technique chirurgicale complète (1er temps et 2e temps) | Animation chirurgicale 3D |
| MIOA21-S02-003 | 📐 SCHÉMA | Timeline du changement en 2 temps (1er temps → ATB → fenêtre → contrôle → 2e temps) | Chronologie |
| MIOA21-S03-001 | 📊 INFOGRAPHIE | 1 temps vs 2 temps : critères de choix | Tableau décisionnel |
| MIOA21-S04-001 | 📷 IMAGE | Résection-arthroplastie de Girdlestone : radiographie post-opératoire | Radiographie |
| MIOA21-S04-002 | 📊 INFOGRAPHIE | Stratégies de sauvetage : algorithme quand tout échoue | Arbre de décision |
| MIOA21-S04-003 | 🎬 ANIMATION InfectoSim© | Simulation : choix stratégique (DAIR vs 1 temps vs 2 temps vs sauvetage) selon le cas clinique | Exercice interactif |

### Points clés du Module 21

1. Le changement en 2 temps avec spacer est le gold standard historique (guérison 85-95%)
2. Le changement en 1 temps a des résultats comparables dans des indications sélectionnées et offre des avantages fonctionnels
3. Le spacer antibiotique assure une diffusion locale d'ATB + maintien de l'espace articulaire pendant l'inter-temps
4. La réimplantation nécessite : CRP normale, ponction stérile, bon état des tissus mous
5. Girdlestone, arthrodèse, amputation = sauvetage ultime après échecs multiples
6. Les cas complexes doivent être adressés aux CRIOA (Centres de Référence)
7. Le traitement suppressif est une option chez le patient inopérable

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 7 — Infections Spécifiques (Modules 22-25)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 22 : SPONDYLODISCITE ET ABCÈS ÉPIDURAL

**Partie** : VII — Infections Spécifiques
**Durée estimée** : 4h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 2, 7, 8, 11

## Accroche clinique

> 🏥 **Cas clinique — M. Kader, 58 ans** : Rachialgie lombaire intense depuis 3 semaines, fièvre 38.4°C, contracture paravertébrale majeure. ATCD d'infection urinaire à *E. coli* traitée il y a 1 mois. IRM rachidienne : hypersignal T2 des corps vertébraux L3-L4, destruction du disque L3-L4, collection pré-vertébrale et épidurale postérieure. *Spondylodiscite avec abcès épidural : quand opérer en urgence ? Le déficit neurologique est-il imminent ?*

## Objectifs d'apprentissage

1. **Diagnostiquer** une spondylodiscite infectieuse (clinique, biologie, imagerie)
2. **Différencier** les étiologies (pyogène, tuberculeuse, post-opératoire)
3. **Identifier** l'abcès épidural comme urgence neurochirurgicale
4. **Déterminer** les indications du traitement médical seul vs chirurgical
5. **Prescrire** l'antibiothérapie adaptée et sa durée

## Structure du contenu

### Section 22.1 — Épidémiologie et portes d'entrée

**Contenu obligatoire** :
- Incidence : 2-7/100 000/an (en augmentation : vieillissement, immunosuppression, gestes invasifs)
- Âge moyen : 50-70 ans, sex-ratio H/F = 1.5-2
- **Portes d'entrée** :
  - Urinaire (30%) : BGN surtout
  - Cutanée (15%) : *S. aureus*
  - Endocardite (10-15%) : streptocoques, staphylocoques
  - Iatrogène : discographie, infiltration péridurale/foraminale, chirurgie rachidienne
  - Non retrouvée (30-40%)
- **Germes** :
  - *S. aureus* : 30-50% (1er germe)
  - BGN (*E. coli*, *Klebsiella*, *Proteus*) : 20-25% (porte d'entrée urinaire)
  - Streptocoques/Entérocoques : 10-15%
  - SCN : post-chirurgical
  - *M. tuberculosis* : 20-30% dans les populations endémiques (Mal de Pott → Module 24)
  - *Brucella*, *Candida* : rares, contextes spécifiques
- Localisation préférentielle : lombaire (60%) > thoracique (30%) > cervicale (10%)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA22-S01-001 | 📊 INFOGRAPHIE | Portes d'entrée de la spondylodiscite et germes associés | Infographie circulaire |
| MIOA22-S01-002 | 📐 SCHÉMA | Anatomie vasculaire vertébrale et voies de contamination | Schéma vasculaire |

### Section 22.2 — Diagnostic clinique et biologique

**Contenu obligatoire** :
- **Triade classique** : rachialgie + fièvre + raideur rachidienne
- Rachialgie : d'installation progressive (jours-semaines), inflammatoire (nocturne, insomniante), rebelle aux antalgiques
- Fièvre : inconstante (50-60%), parfois fébricule intermittente
- Contracture paravertébrale : quasi constante
- **Signes de gravité** :
  - Déficit neurologique : radiculaire (sciatique paralysante, syndrome de la queue de cheval) ou médullaire (syndrome compressif) → urgence chirurgicale
  - Abcès épidural : compression médullaire/radiculaire progressive
  - Abcès du psoas : psoïtis (flexion de hanche antalgique)
  - Choc septique (rare)
- **Biologie** : CRP élevée (quasi constante), hyperleucocytose (50%), hémocultures positives dans 50-70%

### Section 22.3 — Imagerie

**Contenu obligatoire** :
- **IRM** : EXAMEN DE RÉFÉRENCE — sensibilité 92-97%, spécificité 90-95%
  - T1 : hyposignal des corps vertébraux adjacents au disque
  - T2 : hypersignal des corps vertébraux et du disque
  - Gadolinium : rehaussement des plateaux vertébraux, du disque, des collections péri-vertébrales et épidurales
  - Extension épidurale : compression moelle/racines → urgence si déficit neurologique
  - IRM corps entier si doute sur localisation multifocale
- **Scanner** : destruction disco-corporéale, guidage pour biopsie disco-vertébrale percutanée
- **Radiographies** : normales pendant 2-4 semaines, puis pincement discal, érosion des plateaux, destruction
- **PET-scanner** : utile pour le suivi (normalisation plus rapide que l'IRM)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA22-S03-001 | 📷 IMAGE | IRM de spondylodiscite L3-L4 : coupes T1, T2, T1 Gado | Séries IRM typiques |
| MIOA22-S03-002 | 📷 IMAGE | Abcès épidural compressif en IRM : coupe axiale et sagittale | Urgence neurochirurgicale |
| MIOA22-S03-003 | 📐 SCHÉMA | Diagnostic différentiel en imagerie : spondylodiscite infectieuse vs dégénérative Modic 1 vs tumorale | IRM comparées |

### Section 22.4 — Documentation microbiologique

**Contenu obligatoire** :
- **Hémocultures** : 2-3 paires, AVANT toute antibiothérapie — positives dans 50-70%
- **Biopsie disco-vertébrale** (BDV) : geste clé si hémocultures négatives
  - Technique : percutanée, scanno-guidée, aiguille coaxiale
  - Prélèvements : disco-corporéaux (disque + plateau vertébral), ≥3 fragments
  - Résultats : positive dans 50-70% des cas
  - ATTENTION : arrêt des ATB (fenêtre ≥10-14 jours) avant BDV si non urgent
  - Si 1ère BDV négative : 2e BDV recommandée (rendement supplémentaire 30%)
- PCR 16S ARNr, MALDI-TOF, NGS : en 2e intention si cultures négatives
- Sérologies : *Brucella*, *Coxiella* selon contexte épidémiologique

### Section 22.5 — Traitement médical

**Contenu obligatoire** :
- **Antibiothérapie** :
  - IV initiale (2-4 semaines) puis relais oral
  - Durée totale : **6 semaines** (recommandations IDSA, SPILF)
  - Étude randomisée (Bernard et al., Lancet 2015) : 6 semaines = 12 semaines (non-infériorité)
  - Schémas : oxacilline/céfazoline → relais FQ/clindamycine/TMP-SMX (selon germe)
  - BGN : C3G IV → relais FQ oral
  - Si matériel (vis, cage, tiges) : ajout rifampicine dans la bi-thérapie anti-staphylococcique
- **Immobilisation** : controversée — repos au lit court + corset rigide si instabilité
- **Suivi** : CRP hebdomadaire, IRM de contrôle à 6 semaines (attention : l'IRM se normalise lentement, 3-6 mois)

### Section 22.6 — Traitement chirurgical et indications

**Contenu obligatoire** :
- **Indications chirurgicales** :
  - Déficit neurologique (urgence chirurgicale ++)
  - Abcès épidural compressif
  - Instabilité rachidienne / déformation
  - Échec du traitement médical (non amélioration à 4-6 semaines)
  - Abcès paravertébraux volumineux non drainables percutanément
- **Techniques** :
  - Laminectomie de décompression + drainage épidural
  - Corporectomie + greffe (cage intersomatique ou greffe iliaque) + ostéosynthèse postérieure
  - Abcès du psoas : drainage percutané scanno-guidé (1ère intention) ou chirurgical
- **Résultats** : mortalité 2-10%, récidive 5-15%, séquelles neurologiques irréversibles possibles si retard

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA22-S06-001 | 📐 SCHÉMA | Algorithme : traitement médical seul vs chirurgie dans la spondylodiscite | Arbre de décision |
| MIOA22-S06-002 | 📷 IMAGE | Corporectomie + greffe + ostéosynthèse : radiographie post-opératoire | Cas illustratif |
| MIOA22-S06-003 | 🎬 ANIMATION InfectoSim© | Simulation : spondylodiscite avec abcès épidural — urgence chirurgicale ? Évaluer les critères | Exercice interactif |

### Points clés du Module 22

1. La spondylodiscite est la plus fréquente des infections osseuses de l'adulte (localisation lombaire 60%)
2. L'IRM est l'examen de référence (sensibilité 92-97%)
3. Hémocultures + biopsie disco-vertébrale percutanée = documentation microbiologique
4. Durée d'antibiothérapie : 6 semaines (étude Bernard, Lancet 2015)
5. L'abcès épidural compressif avec déficit neurologique est une urgence chirurgicale absolue
6. L'IRM de contrôle se normalise lentement (3-6 mois) — ne pas confondre avec échec thérapeutique
7. La fenêtre ATB avant BDV est indispensable (≥14 jours) sauf urgence

---

# MODULE 23 : PIED DIABÉTIQUE INFECTÉ

**Partie** : VII — Infections Spécifiques
**Durée estimée** : 4h00
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 3, 6, 7, 8

## Accroche clinique

> 🏥 **Cas clinique — M. Ahmed, 67 ans** : Diabétique type 2 depuis 25 ans, HbA1c = 9.8%. Ulcère neuropathique du 1er métatarsien gauche depuis 3 mois, extension récente, contact osseux positif au « probe-to-bone ». Pied chaud mais PAS douloureux (neuropathie !). Radiographie : lyse de la tête du 1er métatarsien. CRP = 45 mg/L. *Ostéite sur pied diabétique. Antibiothérapie seule ? Résection métatarsienne ? Quelle est la place de la chirurgie conservatrice ?*

## Objectifs d'apprentissage

1. **Évaluer** le pied diabétique selon les classifications PEDIS et IWGDF
2. **Diagnostiquer** l'ostéite du pied diabétique (probe-to-bone, imagerie, biopsie osseuse)
3. **Distinguer** infection vs colonisation dans l'ulcère diabétique
4. **Traiter** l'infection du pied diabétique (ATB + chirurgie conservatrice vs amputation)
5. **Organiser** la prise en charge multidisciplinaire

## Structure du contenu

### Section 23.1 — Physiopathologie du pied diabétique

**Contenu obligatoire** :
- **Triade pathologique** :
  - Neuropathie périphérique (sensitive, motrice, autonome) : perte de la protection sensorielle, déformations (griffes, hallux valgus), sécheresse cutanée
  - Artériopathie oblitérante des MI : ischémie distale (artères jambières, pédieuses)
  - Immunodépression relative du diabétique : chimiotactisme altéré, phagocytose diminuée
- Ulcère neuropathique : indolore (!), en regard des points de pression (tête métatarsienne, talon)
- Mal perforant plantaire (MPP) : lésion typique
- Contamination bactérienne → colonisation → infection (continuum)
- La neuropathie masque la douleur = retard diagnostique fréquent

### Section 23.2 — Diagnostic de l'infection du pied diabétique

**Contenu obligatoire** :
- **Classification IWGDF/PEDIS de l'infection** :
  - Grade 1 : pas d'infection
  - Grade 2 : infection superficielle (cellulite <2 cm autour de l'ulcère)
  - Grade 3 : infection profonde (cellulite >2 cm, abcès profond, atteinte os/articulation, fasciite)
  - Grade 4 : sepsis systémique (SIRS)
- **Probe-to-bone test** (test de la sonde) : stylet métallique stérile introduit au fond de l'ulcère → contact rugueux avec l'os = ostéite probable (sensibilité 66%, spécificité 85%, VPP élevée si prévalence élevée)
- **Imagerie** :
  - Radiographies : lyse corticale, réaction périostée, destruction articulaire — mais retard de 2-3 semaines
  - IRM : sensibilité 90%, spécificité 80% — diagnostic différentiel pied de Charcot vs ostéite +++
  - Scanner/PET : 2e intention
- **Diagnostic microbiologique** :
  - Prélèvement superficiel (écouvillon) : INUTILE (reflète la colonisation, pas l'infection)
  - Biopsie osseuse transcutanée : gold standard (cultures + anatomopathologie)
  - Prélèvements profonds au curettage chirurgical
  - Germes : polymicrobien fréquent — S. aureus, streptocoques, entérobactéries, anaérobies, Pseudomonas

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA23-S02-001 | 📷 IMAGE | Mal perforant plantaire avec contact osseux (probe-to-bone +) | Photo clinique |
| MIOA23-S02-002 | 📷 IMAGE | IRM du pied diabétique : ostéite du 1er métatarsien — comparaison avec pied de Charcot | IRM comparatives |
| MIOA23-S02-003 | 📐 SCHÉMA | Algorithme diagnostique du pied diabétique infecté | Arbre de décision |
| MIOA23-S02-004 | 📊 INFOGRAPHIE | Classification IWGDF/PEDIS de l'infection du pied diabétique | Grades 1-4 |

### Section 23.3 — Traitement médical

**Contenu obligatoire** :
- **Antibiothérapie** :
  - Infection superficielle (grade 2) : ATB orale, amoxicilline-ac. clav. ou FQ + métronidazole, 1-2 semaines
  - Infection profonde (grade 3-4) sans ostéite : ATB IV puis relais oral, 2-4 semaines
  - Ostéite du pied diabétique : 6-12 semaines (débat) ; OU traitement médical seul 6 semaines si résection chirurgicale complète de l'os infecté
  - Étude OVAIRE/PHRC : traitement médical seul de l'ostéite du pied (6 semaines ATB vs chirurgie + ATB courte)
- **Décharge** : ESSENTIELLE — chaussure de décharge, plâtre à contact total (TCC), déambulateur

### Section 23.4 — Traitement chirurgical conservateur et amputation

**Contenu obligatoire** :
- **Chirurgie conservatrice** (objectif prioritaire) :
  - Résection de la tête métatarsienne (ostéite isolée)
  - Amputation de rayon (orteil + métatarsien)
  - Résection articulaire
  - Principe : toute chirurgie doit préserver au maximum la biomécanique du pied
- **Amputation** :
  - Transmétatarsienne : bon résultat fonctionnel, préserve l'appui
  - Lisfranc, Chopart : résultats fonctionnels variables, orthèses nécessaires
  - Amputation de jambe (transtibiale) : si ischémie non revascularisable + infection non contrôlable
  - 30% des amputations sont précédées d'une amputation mineure ayant échoué
  - Mortalité à 5 ans post-amputation majeure : 50-70% (comorbidités cardiovasculaires)
- **Revascularisation** : angioplastie ou pontage distral si artériopathie sévère — AVANT chirurgie infectieuse si possible

### Section 23.5 — Prise en charge multidisciplinaire

- Équipe : diabétologue + infectiologue + chirurgien orthopédiste + chirurgien vasculaire + podologue + plaies et cicatrisation
- Prévention secondaire : chaussage adapté, inspection quotidienne des pieds, équilibre glycémique, éducation thérapeutique
- Taux de récidive : 40-60% à 5 ans → surveillance au long cours

### Points clés du Module 23

1. Le pied diabétique infecté est la 1ère cause d'amputation non traumatique
2. La neuropathie masque la douleur → diagnostic souvent tardif
3. Le probe-to-bone test est un outil diagnostique simple et utile (VPP élevée en contexte prévalent)
4. L'écouvillon superficiel est INUTILE — seuls les prélèvements profonds (biopsie osseuse) ont de la valeur
5. IRM : examen de référence pour le diagnostic d'ostéite, mais diagnostic différentiel difficile avec le pied de Charcot
6. La chirurgie conservatrice est l'objectif prioritaire — préserver la biomécanique du pied
7. La prise en charge est MULTIDISCIPLINAIRE : diabétologue, infectiologue, chirurgien, vasculaire, podologue

---

# MODULE 24 : TUBERCULOSE OSTÉOARTICULAIRE — MAL DE POTT

**Partie** : VII — Infections Spécifiques
**Durée estimée** : 3h30
**Niveau** : Intermédiaire
**Prérequis** : Modules 3, 22

## Accroche clinique

> 🏥 **Cas clinique — Mme Traore, 32 ans** : Arrivée récente du Mali. Rachialgie dorsale progressive depuis 6 mois, amaigrissement (-8 kg), sueurs nocturnes. Pas de fièvre franche. Radiographies : destruction des corps vertébraux T10-T11, érosion des plateaux en « miroir », image fusiforme pré-vertébrale. IRM : abcès fusiforme pré-vertébral s'étendant sur 3 étages, collection intra-canalaire avec compression médullaire. *Mal de Pott du rachis thoracique. Quelle est votre démarche diagnostique ? Comment traiter un abcès froid paravertébral géant ?*

## Objectifs d'apprentissage

1. **Maîtriser** la physiopathologie de la tuberculose ostéoarticulaire
2. **Reconnaître** les présentations typiques du Mal de Pott
3. **Diagnostiquer** la tuberculose ostéoarticulaire (bactériologie, histologie, PCR)
4. **Prescrire** le traitement antituberculeux adapté
5. **Poser** les indications chirurgicales

## Structure du contenu

### Section 24.1 — Épidémiologie et physiopathologie

**Contenu obligatoire** :
- Tuberculose ostéoarticulaire : 2-5% de toutes les tuberculoses
- Réactivation d'un foyer osseux ensemencé par voie hématogène lors de la primo-infection
- Localisation : rachis (Mal de Pott) = 50% des cas ; hanche, genou, poignet (rares)
- Population : migrants de zones endémiques, immunodéprimés (VIH ++), sujets âgés
- En France : 150-300 cas/an estimés
- BCGite ostéo-articulaire : rare complication post-vaccinale chez l'enfant

### Section 24.2 — Le Mal de Pott (spondylodiscite tuberculeuse)

**Contenu obligatoire** :
- **Siège** : rachis thoracique (50%), thoraco-lombaire (25%), lombaire (20%), cervical (5%)
- **Présentation** : insidieuse, sur des mois — rachialgie d'aggravation progressive, raideur, gibbosité (cyphose angulaire)
- Pas de fièvre franche dans 50% des cas
- Signes généraux : amaigrissement, sueurs nocturnes, AEG
- **Imagerie typique** :
  - Radiographie : destruction corporéale en « miroir » (2 corps adjacents), abcès fusiforme pré-vertébral
  - IRM : hypersignal T2, rehaussement périphérique, abcès froid (pas de rehaussement central), extension épidurale
  - Différences avec la spondylodiscite pyogène : destruction plus marquée, abcès froid volumineux, atteinte multi-étage, respect relatif du disque (initialement)
- **Abcès froid** :
  - Pré-vertébral, paravertébral, peut migrer à distance (abcès du psoas = psoïtis de Pott)
  - « Abcès froid » = pas de chaleur locale ni d'INFLAMMATION franche (réponse granulomateuse)

### Section 24.3 — Diagnostic

**Contenu obligatoire** :
- **Biopsie disco-vertébrale** : indispensable — cultures sur milieux de Löwenstein-Jensen (3-8 semaines), PCR *M. tuberculosis* (résultat en 48h), histologie (granulome giganto-cellulaire avec nécrose caséeuse)
- IDR à la tuberculine, QuantiFERON / T-SPOT.TB : positifs mais ne différencient pas latente/active
- Recherche de tuberculose pulmonaire associée (30-50% des cas)
- Diagnostic différentiel : spondylodiscite pyogène, brucellose, tumeur (métastase, lymphome, myélome)

### Section 24.4 — Traitement

**Contenu obligatoire** :
- **Traitement médical** (antituberculeux) : quadrithérapie initiale 2 mois (isoniazide + rifampicine + pyrazinamide + éthambutol) puis bithérapie 10-16 mois (isoniazide + rifampicine)
- Durée totale : **12-18 mois** (recommandations OMS/SPLIF pour la tuberculose ostéoarticulaire)
- Compliance : traitement long → traitement directement observé (DOT) si nécessaire
- Effets secondaires : hépatotoxicité (surveillance transaminases mensuelles), névrite optique (éthambutol), neuropathie périphérique (isoniazide → supplémentation en B6)
- **Indications chirurgicales** :
  - Déficit neurologique (urgence relative)
  - Instabilité rachidienne / cyphose progressive
  - Abcès volumineux non résolutif sous traitement médical
  - Technique : drainage d'abcès, corporectomie-greffe ± ostéosynthèse, correction de déformation
- Résultats : excellents sous traitement anti-TB adapté (guérison >95% si traitement complet)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA24-S02-001 | 📷 IMAGE | Mal de Pott thoracique : radiographies et IRM typiques (destruction en miroir, abcès froid) | Série d'images |
| MIOA24-S02-002 | 📐 SCHÉMA | Comparaison spondylodiscite pyogène vs tuberculeuse — 10 critères différentiels | Tableau |
| MIOA24-S04-001 | 📊 INFOGRAPHIE | Protocole antituberculeux : quadrithérapie → bithérapie, durée, surveillance | Infographie médicament |
| MIOA24-S04-002 | 📷 IMAGE | Chirurgie du Mal de Pott : corporectomie, greffe, ostéosynthèse — radiographies pré et post | Cas illustratif |

### Points clés du Module 24

1. Le Mal de Pott (spondylodiscite tuberculeuse) touche le rachis thoracique dans 50% des cas
2. Présentation insidieuse sur des mois : rachialgie, amaigrissement, pas toujours de fièvre
3. L'abcès froid est caractéristique : volumineux, pas de chaleur locale, peut migrer (psoas)
4. Diagnostic : biopsie disco-vertébrale + PCR M. tuberculosis + histologie (granulome caséeux)
5. Traitement antituberculeux : quadrithérapie 2 mois puis bithérapie 10-16 mois — compliance essentielle
6. Chirurgie réservée aux compressions neurologiques, instabilités et abcès réfractaires
7. Guérison >95% si traitement complet et adapté

---

# MODULE 25 : INFECTIONS FONGIQUES, PARASITAIRES ET À MYCOBACTÉRIES ATYPIQUES

**Partie** : VII — Infections Spécifiques
**Durée estimée** : 2h30
**Niveau** : Expert
**Prérequis** : Module 3

## Accroche clinique

> 🏥 **Cas clinique — M. Johnson, 45 ans** : Patient VIH (CD4 = 85/mm³), arrivant d'Arizona. Douleur du genou droit progressive depuis 2 mois, tuméfaction, pas de fièvre. Ponction : liquide inflammatoire, culture bactérienne négative. Culture fongique (3 semaines) : *Coccidioides immitis*. Radiographies : lésion lytique épiphysaire fémorale distale. *Coccidioïdomycose articulaire : comment traiter cette infection fongique rare mais grave ?*

## Objectifs d'apprentissage

1. **Connaître** les principales infections osseuses fongiques
2. **Identifier** les mycobactéries atypiques responsables d'infections musculo-squelettiques
3. **Diagnostiquer** et traiter les parasitoses ostéoarticulaires
4. **Adapter** la stratégie diagnostique et thérapeutique au contexte d'immunosuppression

## Structure du contenu

### Section 25.1 — Infections osseuses fongiques

**Contenu obligatoire** :
- **Contexte** : immunodéprimé (VIH, greffe d'organe, hémopathie), zones endémiques
- **Candida** : spondylodiscite (UDIV), ostéomyélite sur cathéter, néonatologie
  - Traitement : fluconazole 6-12 mois ou amphotéricine B
- **Aspergillus** : spondylodiscite, ostéomyélite chronique chez le neutropénique
  - Traitement : voriconazole 6-12 mois
- **Cryptococcus** : ostéomyélite rare, souvent VIH avec CD4 <100
- **Coccidioides** (Valley fever) : zone endémique (sud-ouest USA, Mexique), ostéomyélite, arthrite
- **Histoplasma, Blastomyces** : zones endémiques (Amérique du Nord), ostéomyélite disséminée
- **Diagnostic** : cultures fongiques prolongées (2-4 semaines), histologie (colorations PAS, Gomori-Grocott), antigène sérique/urinaire, PCR
- Importance d'ÉVOQUER le diagnostic chez l'immunodéprimé devant des cultures bactériennes négatives

### Section 25.2 — Mycobactéries non tuberculeuses (MNT)

**Contenu obligatoire** :
- Mycobactérioses atypiques de l'appareil locomoteur :
  - *M. marinum* : infection après piqûre/blessure en milieu aquatique, ténosynovite/arthrite (poisson, aquarium)
  - *M. avium complex* (MAC) : ostéomyélite disséminée chez VIH avancé
  - *M. fortuitum*, *M. abscessus*, *M. chelonae* : mycobactéries à croissance rapide, ostéomyélite chronique post-traumatique/sur matériel
  - *M. ulcerans* : ulcère de Buruli (Afrique de l'Ouest) — atteinte osseuse par contiguïté
- Diagnostic : cultures sur milieux mycobactéries (Löwenstein), biologie moléculaire
- Traitement : multithérapie prolongée (12-24 mois), variable selon l'espèce

### Section 25.3 — Parasitoses ostéoarticulaires

**Contenu obligatoire** :
- Rares mais à connaître dans un contexte tropical :
  - **Échinococcose (kyste hydatique)** : kyste hydatique osseux (vertèbre, pelvis), rare (1-2% des hydatidoses), chirurgie difficile, récidive fréquente
  - **Toxoplasmose** : arthrite chez l'immunodéprimé profond
  - **Leishmaniose** : atteinte osseuse exceptionnelle
- Diagnostic : sérologies, imagerie (aspect kystique), histologie, PCR

### Points clés du Module 25

1. Évoquer une infection fongique chez tout immunodéprimé avec infection ostéoarticulaire à cultures bactériennes négatives
2. Les cultures fongiques nécessitent 2-4 semaines — les demander spécifiquement au laboratoire
3. *M. marinum* (aquarium/poisson), *M. fortuitum/abscessus* (matériel) sont les MNT les plus fréquentes en orthopédie
4. Le kyste hydatique osseux est rare mais redoutable (récidive fréquente)
5. Le contexte géographique et immunitaire guide le diagnostic étiologique

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 8 — Chirurgie et Reconstruction (Modules 26-28)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 26 : PRINCIPES CHIRURGICAUX — DÉBRIDEMENT ET SÉQUESTRECTOMIE

**Partie** : VIII — Chirurgie et Reconstruction
**Durée estimée** : 4h00
**Niveau** : Expert
**Prérequis** : Modules 16, 17, 20, 21

## Accroche clinique

> 🏥 **Cas clinique — M. Nguyen, 38 ans** : Ostéomyélite chronique du fémur après enclouage centromédullaire pour fracture diaphysaire. Fistule permanente depuis 2 ans, multiples cures d'ATB sans succès. Scanner : épaississement cortical, cavité centromédullaire cloisonnée, séquestre intra-canalaire de 6 cm, canal Haversien élargi. *Comment planifier cette chirurgie complexe ? Jusqu'où débrider ? Comment gérer l'espace mort et la stabilité mécanique ?*

## Objectifs d'apprentissage

1. **Appliquer** les principes fondamentaux du débridement chirurgical en chirurgie septique
2. **Planifier** la séquestrectomie et le curetage radical
3. **Gérer** l'espace mort résiduel post-débridement
4. **Maîtriser** les techniques de stabilisation en contexte septique
5. **Organiser** la chronologie opératoire (stratégie en 1 ou plusieurs temps)

## Structure du contenu

### Section 26.1 — Principes fondamentaux du débridement

**Contenu obligatoire** :
- **Dogme de la chirurgie septique** : « Dead bone, dead space, dead tissue must go »
- Le débridement est le geste chirurgical LE PLUS IMPORTANT — les ATB ne compensent pas un débridement insuffisant
- **Évaluation pré-opératoire** :
  - Scanner avec reconstruction 3D : cartographie des séquestres, étendue de l'atteinte, épaisseur corticale résiduelle
  - IRM : extension dans les parties molles, abcès, fistule(s)
  - Planification 3D (logiciel) : anticipation de la perte de substance osseuse et des options de reconstruction
  - Évaluation vasculaire (si membre inférieur) : angioscanner ou écho-Doppler si artériopathie suspectée
  - État nutritionnel et optimisation pré-opératoire (albumine >30 g/L, lymphocytes >1500/mm³)
- **Classification de Cierny-Mader** : guide la stratégie chirurgicale
  - Type 1 : médullaire (endosteal)
  - Type 2 : superficiel (cortical)
  - Type 3 : localisé (cavitaire, mais os stable)
  - Type 4 : diffus (instabilité mécanique, résection segmentaire nécessaire)

### Section 26.2 — Technique du débridement radical

**Contenu obligatoire** :
- **Séquestrectomie** : extraction de tout fragment osseux dévascularisé
- **Curetage** : élimination du tissu infecté, granuleux, nécrotique
- **Paprika sign** : indicateur peropératoire — os cortical/spongieux sain = saignement punctiforme en nappe (comme paprika saupoudré). L'os sain saigne, l'os mort ne saigne pas
- **Corticotomie** : ouverture de la corticale pour accéder au canal médullaire
- **Alésage centromédullaire** : alésage du fût fémoral/tibial sur toute la longueur si clou retiré
- **Prélèvements** : ≥5 prélèvements tissulaires dans des zones différentes AVANT lavage
- **Irrigation-lavage** : abondant (>6-10L), low-pressure pulsatile lavage recommandé
- **Hémostase** : soigneuse — l'hématome post-opératoire favorise la surinfection

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA26-S02-001 | 🎬 VIDÉO | Séquestrectomie radicale du tibia : technique chirurgicale pas à pas | Vidéo chirurgicale |
| MIOA26-S02-002 | 📷 IMAGE | Paprika sign : aspect per-opératoire de l'os sain après curetage | Photo close-up |
| MIOA26-S02-003 | 📐 SCHÉMA | Débridement selon Cierny-Mader (types 1-4) : schéma opératoire pour chaque type | 4 schémas |

### Section 26.3 — Gestion de l'espace mort

**Contenu obligatoire** :
- **L'espace mort est l'ennemi** : après débridement, la cavité résiduelle se remplit d'hématome → milieu de culture idéal
- **Options de comblement** :
  - **Ciment PMMA antibiotique** :
    - Forme perles (chaîne de Klemm), forme bloc moulé, spacer articulé
    - Élution antibiotique locale : vancomycine + gentamicine (synergie anti-staphylococcique)
    - Temporaire (retrait au 2e temps + greffe) ou semi-définitif
  - **Greffe osseuse autologue** :
    - Crête iliaque (spongieux) : gold standard biologique
    - RIA (Reamer-Irrigator-Aspirator) : prélèvement centromédullaire fémoral, grande quantité de greffon
    - Greffe vascularisée (péroné) : si perte >6 cm et vascularisation locale compromise
  - **Membrane induite (Masquelet)** : renvoi détaillé Module 27
  - **Substituts osseux** :
    - Sulfate de calcium antibiotique (Stimulan®) : résorbable, élution ATB
    - Hydroxyapatite / phosphate tricalcique
    - Bio-verre bioactive (S53P4, BonAlive®) : antibactérien intrinsèque (pH alcalin, pression osmotique)
  - **Muscle pédiculé** : comblement biologique locorégional (gastrocnémien médial pour le tibia proximal)
- Choix selon : taille du défect, localisation, vascularisation locale, état du patient

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA26-S03-001 | 📊 INFOGRAPHIE | Options de comblement de l'espace mort : tableau comparatif (ciment, greffe, Masquelet, bio-verre, muscle) | Multicritère incluant taille défect |
| MIOA26-S03-002 | 📷 IMAGE | Bio-verre S53P4 : aspect macroscopique et mise en place per-opératoire | Photos |
| MIOA26-S03-003 | 🎬 ANIMATION InfectoSim© | Simulation : choisir le comblement optimal selon le défect osseux et le contexte | Exercice interactif |

### Section 26.4 — Stabilisation mécanique en terrain septique

**Contenu obligatoire** :
- **Fixateur externe** : gold standard en terrain septique (pas de matériel interne dans la zone infectée)
  - Fixateur monoplan, circulaire (Ilizarov, Taylor Spatial Frame)
  - Avantages : stabilité, accès aux parties molles, possibilité de transport osseux
  - Inconvénients : encombrement, infection sur fiches (2-10%), raideur articulaire
- **Plaque** : contre-indiquée en terrain septique aigu ; possible en terrain assaini avec couverture antibiotique
- **Enclouage centromédullaire** : débattu — contre-indiqué si infection aiguë intramédullaire, possible si os bien débridé et nettoyé (clou cimenté antibiotique)
- **Clou cimenté antibiotique** : clou enrobé de ciment PMMA chargé d'ATB — stabilisation + diffusion antibiotique locale (technique décrite par Paley et al.)

### Points clés du Module 26

1. Le débridement chirurgical radical est le pilier du traitement — les ATB ne remplacent pas un débridement insuffisant
2. Le « paprika sign » est le marqueur per-opératoire de l'os sain (saignement punctiforme en nappe)
3. L'espace mort post-débridement DOIT être comblé (ciment, greffe, muscle, bio-verre)
4. ≥5 prélèvements tissulaires dans des zones différentes avant le lavage
5. Le fixateur externe est le gold standard de stabilisation en terrain septique
6. La planification 3D pré-opératoire (scanner + IRM) est indispensable pour les cas complexes

---

# MODULE 27 : RECONSTRUCTION OSSEUSE — MASQUELET, TRANSPORT OSSEUX, TECHNIQUES AVANCÉES

**Partie** : VIII — Chirurgie et Reconstruction
**Durée estimée** : 4h30
**Niveau** : Expert
**Prérequis** : Module 26

## Accroche clinique

> 🏥 **Cas clinique — M. Diouf, 25 ans** : Ostéomyélite post-traumatique tibiale après fracture ouverte Gustilo IIIB. Après débridement radical, défect osseux tibial de 12 cm. Spacer PMMA en place, fixateur externe. CRP normalisée, prélèvements stériles. Couverture cutanée par lambeau de grand dorsal libre (viable). *Comment reconstruire 12 cm de tibia ? Masquelet ou transport osseux ?*

## Objectifs d'apprentissage

1. **Maîtriser** la technique de la membrane induite (Masquelet) : indications, technique, résultats
2. **Comprendre** le transport osseux (Ilizarov) et ses variantes
3. **Connaître** les autres options de reconstruction (péroné vascularisé, méga-prothèse)
4. **Choisir** la stratégie de reconstruction adaptée au patient et au défect

## Structure du contenu

### Section 27.1 — Technique de la membrane induite (Masquelet)

**Contenu obligatoire** :
- **Concept** (Alain-Charles Masquelet, 2000) : la membrane biologique induite par un spacer PMMA a des propriétés ostéoinductrices qui favorisent la consolidation d'une greffe osseuse
- **Premier temps** (voir Module 26) :
  - Débridement radical + résection de l'os infecté
  - Mise en place d'un spacer PMMA (avec ou sans ATB)
  - Stabilisation (fixateur externe)
  - Le spacer INDUIT une membrane biologique richement vascularisée autour de lui (6-8 semaines)
- **Deuxième temps** (6-8 semaines après le 1er temps, une fois l'infection contrôlée) :
  - Ouverture soigneuse de la membrane (NE PAS la résequer !)
  - Retrait du spacer PMMA
  - Comblement de la cavité avec greffe osseuse autologue (crête iliaque ± RIA)
  - La membrane contient des facteurs de croissance (VEGF, BMP-2, TGF-β1) et est richement vascularisée → ostéogenèse + ostéoinduction + protection mécanique de la greffe
  - Fermeture de la membrane autour de la greffe
- **Résultats** : consolidation dans 85-95% des cas pour des défects de 4-25 cm
- **Avantages** : technique reproductible, défects importants, pas de matériel complexe
- **Limites** : 2 interventions minimum, dépendant de la qualité de la membrane et de la quantité de greffe disponible

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA27-S01-001 | 🎬 ANIMATION | Technique de Masquelet : 1er temps (spacer) → membrane induite → 2e temps (greffe) | Animation 3D complète |
| MIOA27-S01-002 | 📷 IMAGE | Membrane induite ouverte : aspect macroscopique, richement vascularisée | Photos per-opératoires |
| MIOA27-S01-003 | 📷 IMAGE | Résultats radiographiques : consolidation d'un défect de 15 cm de tibia par Masquelet | Radiographies sériées |
| MIOA27-S01-004 | 📐 SCHÉMA | Biologie de la membrane induite : facteurs de croissance, vascularisation, ostéoinduction | Schéma moléculaire |

### Section 27.2 — Transport osseux (Ilizarov et variantes)

**Contenu obligatoire** :
- **Concept** (Gavriil Ilizarov, 1950s-1980s) : l'os distraction peut régénérer de l'os nouveau grâce à l'ostéogenèse en distraction (« distraction osteogenesis »)
- **Technique** :
  - Résection de l'os infecté → défect
  - Corticotomie à distance de la zone septique
  - Transport progressif du fragment osseux (1 mm/jour en 4 incréments de 0.25 mm) via fixateur externe circulaire
  - Le fragment transporté avance progressivement pour combler le défect
  - À l'extrémité distale : régénérat osseux se forme dans le sillage du fragment transporté
  - Au site d'accostage (docking site) : greffe de contact ± compression
- **Fixateur externe** : Ilizarov (anneaux + broches/fiches), Taylor Spatial Frame (hexapode programmable), fixateur monoral motorisé
- **Variantes** : transport osseux bifocal (2 corticotomies), trifocal (défects très longs), transport sur clou (raccourcit la durée au fixateur)
- **Résultats** : consolidation 85-95% mais durée de traitement longue (Index de consolidation : 1-1.5 mois/cm)
- **Avantages** : reconstruction biologique, pas de greffe si bon régénérat
- **Inconvénients** : durée ++, infection sur fiches (2-10%), raideur articulaire, inconfort, compliance nécessaire

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA27-S02-001 | 🎬 ANIMATION | Transport osseux d'Ilizarov : corticotomie, distraction progressive, accostage | Animation 3D |
| MIOA27-S02-002 | 📷 IMAGE | Fixateur de type Ilizarov et Taylor Spatial Frame | Photos de matériel |
| MIOA27-S02-003 | 📷 IMAGE | Radiographies sériées : régénérat osseux pendant le transport (J0, J30, J60, J90) | Série radiographique |

### Section 27.3 — Autres techniques de reconstruction

**Contenu obligatoire** :
- **Greffe de péroné vascularisé** :
  - Péroné libre microchirurgical (10-25 cm de greffon disponible)
  - Indications : défects >6 cm avec environnement local compromis
  - Avantages : os vascularisé → résistance à l'infection, hypertrophie progressive
  - Inconvénients : chirurgie longue (microchirurgie vasculaire), risque de fracture de fatigue du greffon, morbidité du site donneur
- **Méga-prothèses** :
  - Alternative non biologique pour la reconstruction de défects majeurs
  - Indications limitées en contexte septique (risque de réinfection sur matériel)
  - Utilisées en sauvetage après échecs de reconstruction biologique
- **Allogreffes structurales** :
  - Os de banque (tête fémorale, diaphyse)
  - Risque : résorption, non-union, réinfection (os non vascularisé)
  - Intérêt : impaction grafting (comblement de pertes péri-prothétiques)

### Section 27.4 — Arbre décisionnel : choix de la reconstruction

**Contenu obligatoire** :
- **Défect <2 cm** : greffe autologue directe (crête iliaque), comblement ciment/substitut
- **Défect 2-6 cm** : Masquelet (1ère intention), greffe de crête iliaque, RIA
- **Défect 6-15 cm** : Masquelet OU transport osseux (Ilizarov) — choix selon terrain et expérience de l'équipe
- **Défect >15 cm** : transport osseux (préféré), péroné vascularisé, combine techniques
- **Facteurs de choix** : état des tissus mous, vascularisation locale, âge du patient, compliance, expérience du chirurgien

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA27-S04-001 | 📊 INFOGRAPHIE | Arbre décisionnel de reconstruction osseuse selon la taille du défect | Algorithme visuel |
| MIOA27-S04-002 | 📊 INFOGRAPHIE | Masquelet vs Ilizarov : tableau comparatif — avantages, inconvénients, durée, résultats | Comparaison structurée |
| MIOA27-S04-003 | 🎬 ANIMATION InfectoSim© | Simulation : planifier la reconstruction d'un défect tibial de 10 cm post-septique | Exercice interactif |

### Points clés du Module 27

1. La technique de Masquelet utilise une membrane biologique induite par un spacer PMMA pour favoriser la consolidation de la greffe osseuse (1er temps spacer → 2e temps greffe)
2. Le transport osseux d'Ilizarov permet une régénération osseuse biologique par distraction (1 mm/jour)
3. Le péroné vascularisé est une option pour les défects >6 cm en environnement compromis
4. Le choix de la technique dépend de la taille du défect, des tissus mous, de la vascularisation et de l'expérience du chirurgien
5. Consolidation attendue dans 85-95% des cas avec les techniques modernes
6. La durée de traitement est longue (transport osseux : 1-1.5 mois/cm de défect)

---

# MODULE 28 : COUVERTURE DES TISSUS MOUS — LAMBEAUX EN CHIRURGIE SEPTIQUE

**Partie** : VIII — Chirurgie et Reconstruction
**Durée estimée** : 3h30
**Niveau** : Expert
**Prérequis** : Module 26

## Accroche clinique

> 🏥 **Cas clinique — Mme Petit, 52 ans** : Ostéomyélite chronique du tibia distal après fracture ouverte. Séquestrectomie radicale réalisée — infection contrôlée. Défect osseux comblé par Masquelet (1er temps). Problème : perte de substance cutanée de 10×6 cm sur la face antéromédiale du tibia (zone sous-cutanée, pas de muscle sous-jacent). *Comment couvrir cette zone ? Quel lambeau choisir pour une couverture durable en terrain septique ?*

## Objectifs d'apprentissage

1. **Comprendre** l'importance de la couverture des tissus mous en chirurgie septique
2. **Connaître** les principaux lambeaux utilisés en chirurgie septique orthopédique
3. **Choisir** le lambeau adapté selon la localisation et l'état vasculaire
4. **Identifier** les complications des lambeaux en terrain septique

## Structure du contenu

### Section 28.1 — Importance de la couverture dans la chaîne septique

**Contenu obligatoire** :
- « Bone without soft tissue cover will become infected bone »
- Le tibia est la localisation la plus fréquente d'ostéomyélite chronique PARCE QUE sa face antéromédiale est sous-cutanée (pas de couverture musculaire)
- **Objectifs de la couverture** :
  - Apporter de la vascularisation au tissu osseux (lambeau musculaire = angiogenèse)
  - Oblitérer l'espace mort
  - Permettre la diffusion des ATB systémiques dans la zone infectée
  - Protéger mécaniquement le site opératoire
- **Timing** : couverture dans les 7-10 jours si possible (concept « fix and flap » de Gopal)
- Collaboration chirurgien orthopédiste + chirurgien plasticien

### Section 28.2 — Lambeaux locaux (pédiculés)

**Contenu obligatoire** :
- **Tibia proximal et genou** :
  - Lambeau de gastrocnémien médial : workhorse pour le tiers proximal du tibia
  - Rotation : 90-180°, pédicule vasculaire artère surale médiale
  - Couverture : exposition prothétique du genou, ostéomyélite tibiale proximale
- **Tibia moyen** :
  - Lambeau de soléaire : pour le tiers moyen du tibia
  - Lambeau hémisoleaire : variante moins mutilante
  - Lambeau de soléaire inversé : tiers distal
- **Pied/cheville** :
  - Lambeau sural à pédicule distal (reverse sural flap) : couverture du talon, malléoles, tendon d'Achille
  - Lambeaux locaux de rotation
- **Autres** :
  - Lambeau de grand fessier : trochanters, ischions (escarre infectée)
  - Lambeau de vaste latéral/vaste médial : cuisse

### Section 28.3 — Lambeaux libres (microchirurgicaux)

**Contenu obligatoire** :
- **Indications** : lorsque les lambeaux locaux sont insuffisants ou non disponibles (zone 3/3 distale du tibia, traumatisme étendu ayant détruit les muscles locaux)
- **Lambeaux libres les plus utilisés en orthopédie septique** :
  - Grand dorsal (latissimus dorsi) : grande surface, volume important, fiable
  - Grand droit de l'abdomen (TRAM/VRAM) : alternative
  - Gracilis : petit volume, pédiculé court, idéal pour défects modérés
  - ALT (Anterolateral Thigh Flap) : fasciocutané, très polyvalent
- **Technique** : anastomose microchirurgicale (artère + veine) sur les vaisseaux receveurs (artère tibiale antérieure/postérieure)
- **Résultats en terrain septique** : taux de succès 90-95% (similaire au non-septique si débridement adéquat)
- **Complications** : thrombose anastomotique (1-5%), nécrose partielle, sérome, infection du lambeau

### Section 28.4 — Thérapie par pression négative (TPN/VAC)

**Contenu obligatoire** :
- **VAC (Vacuum-Assisted Closure)** : système de pression négative (-125 mmHg) appliqué sur la plaie
- Rôle de pont temporaire en attendant la couverture définitive
- Avantages : drainage, réduction de l'espace mort, stimulation granulation, réduction charge bactérienne
- Limites : ne remplace PAS un lambeau, ne couvre pas l'os exposé à long terme
- VAC-instill : variante avec instillation intermittente d'antiseptique ou d'ATB liquide entre les phases de pression négative

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA28-S02-001 | 📐 SCHÉMA | Choix du lambeau pour le membre inférieur selon le tiers anatomique | Schéma jambe annotée |
| MIOA28-S02-002 | 📷 IMAGE | Lambeau de gastrocnémien médial : technique chirurgicale et résultat | Photos per-opératoires |
| MIOA28-S03-001 | 📷 IMAGE | Lambeau libre de grand dorsal pour couverture tibiale distale | Photos pré/post |
| MIOA28-S04-001 | 📷 IMAGE | VAC therapy sur plaie septique tibiale : aspect à J0, J7, J14 | Photos évolution |
| MIOA28-S04-002 | 📊 INFOGRAPHIE | Algorithme de couverture des tissus mous en chirurgie septique | Arbre de décision complet |

### Points clés du Module 28

1. La couverture des tissus mous est essentielle : l'os exposé sans couverture = infection garantie
2. Le tibia est la localisation la plus fréquente d'ostéomyélite chronique car sa face antéromédiale est sous-cutanée
3. Lambeaux locaux par tiers du tibia : gastrocnémien (proximal), soléaire (moyen), sural inversé (distal)
4. Les lambeaux libres (grand dorsal, ALT, gracilis) sont nécessaires quand les lambeaux locaux manquent
5. La VAC est un outil temporaire de bridge — elle ne remplace jamais un lambeau définitif
6. Collaboration orthopédiste + plasticien est indispensable pour les cas complexes
7. Concept « fix and flap » : fixation osseuse + couverture en urgence (<72h si possible)

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*


---


## Partie 9 — Prévention et Innovations (Modules 29-30)

**Date** : 8 mars 2026
**Version** : 1.0
**Formation** : Infection Osseuse et Articulaire (IOA)
**Plateforme** : VERTEX©

---

# MODULE 29 : PRÉVENTION — ANTIBIOPROPHYLAXIE, ENVIRONNEMENT ET STRATÉGIES DE RÉDUCTION DU RISQUE

**Partie** : IX — Prévention et Innovations
**Durée estimée** : 3h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 1-6

## Accroche clinique

> 🏥 **Cas clinique — équipe chirurgicale** : Audit du bloc opératoire d'orthopédie : taux d'infection du site opératoire (ISO) = 2.8% (national : 1.5%). Analyse des pratiques : antibioprophylaxie administrée 45 minutes après l'incision dans 30% des cas, flux laminaire en panne depuis 3 semaines, trafic en salle opératoire non contrôlé, 15% des patients obèses non dépistés en pré-opératoire pour colonisation au SARM. *Comment réduire ce taux d'infection ? Quelles mesures ont le plus fort niveau de preuve ?*

## Objectifs d'apprentissage

1. **Prescrire** l'antibioprophylaxie chirurgicale selon les recommandations
2. **Optimiser** l'environnement du bloc opératoire pour la chirurgie prothétique
3. **Évaluer** et corriger les facteurs de risque pré-opératoires modifiables
4. **Appliquer** les recommandations de la SFAR/OMS/CDC pour la prévention des ISO
5. **Organiser** un programme de surveillance des ISO

## Structure du contenu

### Section 29.1 — Antibioprophylaxie chirurgicale

**Contenu obligatoire** :
- **Principes** :
  - Concentration efficace d'ATB au niveau du site opératoire AU MOMENT DE L'INCISION
  - Administration : 30-60 minutes avant l'incision (idéalement 30 min pour les céphalosporines, 60-120 min pour la vancomycine)
  - Molécule de référence : **CÉFAZOLINE** 2g IV (3g si poids >120 kg)
  - Alternative (allergie β-lactamines) : vancomycine 15 mg/kg IV (en 60 min) OU clindamycine 900 mg IV
  - Réinjection : céfazoline toutes les 4h si chirurgie prolongée (demi-vie courte)
- **Durée** : dose unique ou maximum 24h post-opératoire — JAMAIS au-delà !
  - Étude PARITY (JBJS, 2022) : prophylaxie 24h = prophylaxie 5 jours pour les fractures fermées opérées
  - Fractures ouvertes : voir Module 17 (48-72h selon Gustilo)
- **Cas particuliers** :
  - Dépistage SARM nasal pré-opératoire : si positif → décolonisation mupirocine nasale + chlorhexidine douche ; ajout vancomycine à l'antibioprophylaxie
  - Allergie pénicilline : évaluation allergologique, céfazoline possible dans 95% des « allergies » déclarées aux pénicillines
  - Reprise chirurgicale précoce (<30 jours) : renouveler la prophylaxie

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA29-S01-001 | 📊 INFOGRAPHIE | Protocole d'antibioprophylaxie en chirurgie orthopédique : timing, molécule, dose, réinjection | Protocole visuel |
| MIOA29-S01-002 | 📐 SCHÉMA | Timeline antibioprophylaxie : fenêtre optimale d'administration par rapport à l'incision | Chronologie |
| MIOA29-S01-003 | 📊 INFOGRAPHIE | Décolonisation SARM pré-opératoire : protocole complet | Checklist |

### Section 29.2 — Environnement du bloc opératoire

**Contenu obligatoire** :
- **Flux laminaire** (Ultra-Clean Air) :
  - Données historiques (Lidwell, Lancet 1982) : réduction des ISO prothétiques de 3.4% → 0.9% avec flux + ATB prophylaxie
  - Controverses récentes : études observationnelles remettant en question le bénéfice additionnel du flux laminaire (registres suédois, néo-zélandais)
  - Consensus actuel : recommandé mais pas obligatoire ; le taux de renouvellement d'air (≥20 vol/h) est plus important que le type de flux
- **Seuils de particules et contamination aérienne** :
  - ISO 5 (classe 100) : ≤3 520 particules ≥0.5 µm/m³ — recommandé pour la chirurgie prothétique
  - Contrôle bactériologique de l'air : ≤10 UFC/m³ en activité
- **Trafic en salle opératoire** : chaque ouverture de porte = augmentation de la contamination aérienne → politique de restriction du trafic
- **Habillage chirurgical** : casaque imperméable, double gantage, cagoule/scaphandre (réduction des desquamations)
- **Antisepsie cutanée pré-opératoire** :
  - 2 douches pré-opératoires à la chlorhexidine (veille + matin de l'intervention)
  - Antisepsie du site opératoire : povidone iodée alcoolique ou chlorhexidine alcoolique (CHG-OH préféré car activité rémanente)
  - Dépilation : tonte (PAS de rasage) le jour de l'intervention

### Section 29.3 — Optimisation pré-opératoire du patient

**Contenu obligatoire** :
- **Facteurs modifiables** :
  - Diabète : HbA1c <8%, glycémie péri-opératoire <180 mg/dL
  - Obésité : IMC idéalement <40 (risque ISO multipliés par 2-3 si IMC >40)
  - Tabac : sevrage ≥4-6 semaines avant la chirurgie
  - Malnutrition : albumine >30 g/L, lymphocytes >1500/mm³ — complémentation nutritionnelle si nécessaire
  - Anémie : optimisation pré-opératoire (fer IV, EPO) pour réduire les transfusions (transfusion = facteur de risque d'ISO !)
  - Colonisation SARM : dépistage nasal + décolonisation si positif
  - Infection à distance : traiter toute infection (urinaire, dentaire, cutanée) avant chirurgie programmée
- **Consultation pré-opératoire infectiologique** : recommandée pour les reprises prothétiques et les patients à haut risque

### Section 29.4 — Techniques per-opératoires de prévention

**Contenu obligatoire** :
- **Ciment antibiotique** : ajout systématique de gentamicine ± vancomycine au ciment de scellement prothétique en chirurgie de 1ère intention
  - Registres scandinaves : réduction du risque d'infection de 40-50% (PTH, PTG)
  - Dose recommandée : ≤2g d'ATB/40g de ciment (ne pas compromettre les propriétés mécaniques)
- **Vancomycine poudre locale** : application dans la plaie (rachis surtout) — efficacité démontrée en chirurgie rachidienne instrumentée
- **Irrigation antiseptique** : bétadine diluée (3.5%) en lavage per-opératoire (étude FLOW pour les fractures ouvertes — pas de supériorité)
- **Drainage post-opératoire** : pas de bénéfice prouvé pour la prévention de l'ISO en arthroplastie (tendance à l'abandon)
- **Durée opératoire** : facteur de risque indépendant — chaque 30 min supplémentaire = +50% de risque d'ISO

### Section 29.5 — Surveillance et registres

**Contenu obligatoire** :
- **Surveillance des ISO** : obligation réglementaire en France (réseau ISO-RAISIN → maintenant SPARE-SSI)
- Taux cibles : PTH <1%, PTG <1.5%, rachis instrumenté <2%
- **Indicateurs** : taux brut d'ISO, ratio standardisé d'incidence (SIR), score NNIS (durée opératoire, ASA, contamination)
- Retour d'information aux chirurgiens : effet prouvé sur la réduction des ISO (Hawthorne effect)
- Registres prothétiques nationaux : données de survie incluant la révision pour infection

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA29-S04-001 | 📊 INFOGRAPHIE | Checklist de prévention des ISO en chirurgie orthopédique prothétique | Checklist OMS adaptée |
| MIOA29-S04-002 | 📐 SCHÉMA | Les 10 commandements de la prévention des ISO | Visuel mémorisable |
| MIOA29-S05-001 | 📊 INFOGRAPHIE | Registres de surveillance des ISO : indicateurs et taux cibles | Tableau de bord |

### Points clés du Module 29

1. L'antibioprophylaxie (céfazoline 2g IV, 30 min avant l'incision) est la mesure la plus efficace pour prévenir l'ISO
2. Durée maximale de la prophylaxie : 24h post-opératoire — jamais au-delà
3. Dépistage et décolonisation du SARM en pré-opératoire réduisent les ISO staphylococciques
4. Optimisation pré-opératoire : HbA1c, nutrition, sevrage tabac, traitement des infections à distance
5. Le ciment antibiotique réduit le risque d'infection prothétique de 40-50% (registres scandinaves)
6. La surveillance des ISO avec retour aux chirurgiens est obligatoire et efficace
7. La durée opératoire est un facteur de risque indépendant (+50% de risque par 30 min additionnelles)

---

# MODULE 30 : RECHERCHE ET INNOVATIONS — PHAGOTHÉRAPIE, PEPTIDES ANTIMICROBIENS, BIOMATÉRIAUX, INTELLIGENCE ARTIFICIELLE

**Partie** : IX — Prévention et Innovations
**Durée estimée** : 3h00
**Niveau** : Expert
**Prérequis** : Modules 3, 4, 11, 13

## Accroche clinique

> 🏥 **Cas clinique — M. Weber, 48 ans** : Infection périprothétique chronique du genou à *S. aureus* SARM, résistant à la rifampicine ET aux fluoroquinolones. 3 révisions chirurgicales antérieures (2 DAIR échoués, 1 changement en 2 temps échoué). Options conventionnelles épuisées. L'équipe du CRIOA propose une thérapie par phages anti-*S. aureus* en compassionnel. *Qu'est-ce que la phagothérapie ? Est-ce l'avenir du traitement des IOA résistantes ?*

## Objectifs d'apprentissage

1. **Comprendre** les principes de la phagothérapie et son état d'avancement
2. **Connaître** les peptides antimicrobiens et leur potentiel thérapeutique
3. **Évaluer** les biomatériaux anti-infectieux innovants
4. **Appréhender** le rôle de l'intelligence artificielle dans le diagnostic et la prédiction des IOA
5. **Situer** les axes de recherche translationnelle en IOA

## Structure du contenu

### Section 30.1 — Phagothérapie

**Contenu obligatoire** :
- **Concept** : utilisation de bactériophages (virus spécifiques des bactéries) pour détruire les bactéries pathogènes
- **Histoire** : Félix d'Hérelle (Institut Pasteur, 1917) → utilisation courante en URSS → renaissance mondiale au XXIe siècle face à l'antibiorésistance
- **Principes** :
  - Spécificité étroite : chaque phage attaque un spectre bactérien limité → phagogramme (antibiogramme des phages)
  - Auto-amplification : les phages se multiplient au site d'infection
  - Action anti-biofilm : certains phages possèdent des dépolymérases qui dégradent la matrice extracellulaire du biofilm
  - Synergie phage-antibiotique (PAS = Phage-Antibiotic Synergy) : les ATB sub-inhibiteurs augmentent la réplication des phages
- **Applications en IOA** :
  - Infections chroniques résistantes aux ATB conventionnels
  - Utilisation compassionnelle (ATU en France, via le Comité de phagothérapie — Hospices Civils de Lyon, AP-HP)
  - Administration : locale (per-opératoire), intraveineuse, intra-articulaire
  - Essais cliniques en cours : PhagoPTG (Lyon), PHOSA (Bordeaux), WHO-endorsed studies
- **Résultats** : séries de cas encourageantes (succès 50-80% en compassionnel), mais pas encore d'essai randomisé contrôlé de grande taille
- **Défis** : production GMP (Good Manufacturing Practice), réglementation (médicament ou produit biologique ?), résistance bactérienne aux phages (émergence rapide), élargissement du spectre (cocktails de phages)

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA30-S01-001 | 🎬 ANIMATION | Phagothérapie : cycle lytique du bactériophage, action anti-biofilm, synergie avec ATB | Animation 3D |
| MIOA30-S01-002 | 📐 SCHÉMA | Phagogramme : sélection du cocktail de phages pour un patient | Schéma procédural |
| MIOA30-S01-003 | 📊 INFOGRAPHIE | Phagothérapie en IOA : état des lieux 2026 — essais, résultats, limites | Tableau synthétique |

### Section 30.2 — Peptides antimicrobiens (PAM)

**Contenu obligatoire** :
- **Définition** : petites protéines cationiques de défense immunitaire innée avec activité antimicrobienne directe
- **Exemples** : défensines (α, β), cathelicidines (LL-37), lactoferricine, magainine
- **Mécanisme d'action** : perturbation de la membrane bactérienne (pores transmembranaires), activité anti-biofilm, immunomodulation
- **Avantages théoriques** : spectre large, action rapide, faible risque de résistance, activité anti-biofilm
- **Applications en développement** :
  - Coating d'implants orthopédiques : revêtement de PAM sur titane/acier
  - Incorporation dans les ciments et hydrogels
  - Administration locale
- **Limites actuelles** : cytotoxicité potentielle, coût de production, instabilité in vivo, peu d'essais cliniques avancés

### Section 30.3 — Biomatériaux anti-infectieux innovants

**Contenu obligatoire** :
- **Coating d'implants** :
  - Revêtement argent : effet bactéricide, utilisé sur certaines méga-prothèses tumorales (Agluna®, Mutars®)
  - Revêtement titane-cuivre (TiCu) : activité antimicrobienne intrinsèque
  - Revêtement hydrogel + ATB : libération prolongée
  - Surface nano-texturée : effet mécano-bactéricide (nanopillars, ailes de cigale biomimétique)
  - Revêtement anti-adhésion : PEG, phosphorylcholine → empêche l'adhésion bactérienne initiale
- **Ciments nouvelle génération** :
  - Ciment résorbable antibiotique (sulfate de calcium, phosphate de calcium)
  - Hydrogels injectables : libération locale prolongée d'ATB + facteurs de croissance
  - Ciment thermosensible : liquide à température ambiante, solide à 37°C
- **Bio-verre S53P4** (BonAlive®) : antibactérien intrinsèque (pH alcalin local + osmolarité élevée), substitut osseux + comblement + anti-infectieux
- **Impression 3D** :
  - Spacers PMMA imprimés en 3D (anatomiques, patient-spécifiques)
  - Implants en titane poreux imprimés en 3D avec coating antibiotique
  - Guides de coupe patient-spécifiques pour la chirurgie de révision

### Section 30.4 — Intelligence artificielle et IOA

**Contenu obligatoire** :
- **IA et diagnostic** :
  - Algorithmes de deep learning pour la détection de l'ostéomyélite en IRM (sensibilité 90-95%)
  - Analyse automatisée des radiographies : détection de descellement prothétique
  - NLP (Natural Language Processing) : extraction automatisée des données de surveillance des ISO dans les dossiers médicaux
- **IA et prédiction** :
  - Modèles prédictifs du risque d'ISO : machine learning intégrant >50 variables pré/per-opératoires
  - Prédiction de l'échec du DAIR vs changement prothétique
  - Prédiction de la résistance bactérienne aux ATB à partir des données génomiques
- **IA et planification chirurgicale** :
  - Planification 3D automatisée de la résection osseuse
  - Simulation de la reconstruction (Masquelet, transport osseux)
  - Guides chirurgicaux patient-spécifiques générés par IA
- **Limites** : validation clinique insuffisante, biais des données d'entraînement, interprétabilité des modèles, questions éthiques

### Section 30.5 — Autres axes de recherche

**Contenu obligatoire** :
- **Vaccination anti-*S. aureus*** : plusieurs candidats en développement, aucun succès à ce jour (SA4Ag de Pfizer : échec en phase III, 2019)
- **Immunothérapie passive** : anticorps monoclonaux anti-toxines staphylococciques (anti-alpha-hémolysine, anti-PVL)
- **Quorum sensing inhibitors** : bloquer la communication bactérienne pour inhiber la formation de biofilm
- **CRISPR-Cas** encodé dans des phages : ciblage spécifique des gènes de résistance bactérienne
- **Métaméta-analyse du microbiome osseux** : remise en question du dogme de la stérilité osseuse
- **Biofilm disruption** : enzymes (dispersine B, DNase), ultrasons focalisés, champs électriques pulsés
- **Nanotechnologies** : nanoparticules d'argent, nanocapsules d'ATB, nanovecteurs ciblés

**Médias** :
| ID | Type | Description | Notes |
|----|------|-------------|-------|
| MIOA30-S03-001 | 📷 IMAGE | Coating d'implant : surface nano-texturée biomimétique (microscope électronique) | Image MEB |
| MIOA30-S03-002 | 📊 INFOGRAPHIE | Biomatériaux anti-infectieux innovants : panorama 2026 | Roadmap technologique |
| MIOA30-S04-001 | 📐 SCHÉMA | IA en IOA : applications diagnostiques, prédictives et chirurgicales | Schéma récapitulatif |
| MIOA30-S05-001 | 📊 INFOGRAPHIE | Perspectives de recherche IOA 2026-2036 : feuille de route | Timeline prospective |
| MIOA30-S05-002 | 🎬 ANIMATION InfectoSim© | Simulation finale : cas complexe intégrant toutes les innovations (phagothérapie, biomatériaux, IA) | Exercice synthèse |

### Points clés du Module 30

1. La phagothérapie est l'innovation la plus avancée en IOA résistante : usage compassionnel en France, essais randomisés en cours
2. Les peptides antimicrobiens ont un potentiel comme coating d'implants mais restent en développement préclinique
3. Les biomatériaux anti-infectieux (coating argent, nanosurfaces, bio-verre) sont progressivement utilisés en pratique clinique
4. L'IA peut améliorer le diagnostic (imagerie), la prédiction du risque d'ISO et la planification chirurgicale
5. La vaccination anti-S. aureus reste un objectif majeur non atteint
6. L'approche multimodale combinant phages + ATB + biomatériaux + IA est probablement l'avenir
7. La recherche translationnelle en IOA est un domaine en pleine expansion

---

## SYNTHÈSE DE LA PARTIE IX — GRILLE D'AUTO-ÉVALUATION

### Quiz récapitulatif (Modules 29-30)

**Niveau Bronze 🥉** :
1. Quel antibiotique est le standard de la prophylaxie en chirurgie orthopédique ? (*céfazoline*)
2. Quel est le timing optimal d'administration de l'antibioprophylaxie ? (*30-60 min avant l'incision*)
3. Quelle est la durée maximale recommandée de la prophylaxie ? (*24h*)

**Niveau Argent 🥈** :
1. Quels sont les 3 facteurs pré-opératoires modifiables les plus impactants pour réduire le risque d'ISO ?
2. Quel est le mécanisme d'action des bactériophages sur le biofilm ?
3. Quels sont les critères de réinjection de la céfazoline ?

**Niveau Or 🥇** :
1. Expliquez la synergie phage-antibiotique (PAS) et ses implications thérapeutiques
2. Comparez les avantages et inconvénients du ciment antibiotique vs bio-verre S53P4 pour le comblement osseux septique
3. Décrivez le protocole complet de dépistage et décolonisation du SARM en pré-opératoire

**Niveau Diamant 💎** :
1. Un patient présente une infection périprothétique à SARM résistant à la rifampicine et aux FQ. Les 2 tentatives de DAIR et un changement en 2 temps ont échoué. Proposez une stratégie thérapeutique innovante argumentée en intégrant les développements récents
2. Proposez un programme de surveillance des ISO dans votre établissement incluant les indicateurs, les seuils d'alerte et les actions correctives
3. Évaluez le niveau de preuve actuel de la phagothérapie en IOA et argumentez pour ou contre son intégration dans les recommandations de bonnes pratiques

---

## TABLEAU RÉCAPITULATIF GLOBAL DE LA FORMATION IOA

| Partie | Modules | Titre | Durée |
|--------|---------|-------|-------|
| I | 1-4 | Histoire et Fondamentaux | 14h |
| II | 5-6 | Immunologie et Terrain | 7h |
| III | 7-10 | Diagnostic | 14h |
| IV | 11-13 | Antibiothérapie | 10h30 |
| V | 14-17 | Ostéomyélite | 14h |
| VI | 18-21 | Arthrite Septique et Infection Périprothétique | 15h |
| VII | 22-25 | Infections Spécifiques | 14h |
| VIII | 26-28 | Chirurgie et Reconstruction | 12h |
| IX | 29-30 | Prévention et Innovations | 6h30 |
| **TOTAL** | **30** | | **~107h** |

---

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*
