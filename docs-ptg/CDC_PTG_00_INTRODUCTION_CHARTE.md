# CAHIER DES CHARGES — FORMATION COMPLÈTE SUR LA PROTHÈSE TOTALE DU GENOU (PTG)

## Partie 0 — Introduction générale, Charte graphique et Architecture pédagogique

**Date** : 5 mars 2026
**Version** : 1.0
**Statut** : Document fondateur — Cahier des charges complet
**Plateforme** : VERTEX© — Formation médicale en ligne
**Formation** : Prothèse Totale du Genou (PTG) — Arthroplastie totale du genou (*Total Knee Arthroplasty*, TKA)

---

# TABLE DES MATIÈRES — PARTIE 0

1. [Synthèse exécutive](#1-synthèse-exécutive)
2. [Public cible et prérequis](#2-public-cible-et-prérequis)
3. [Architecture pédagogique globale](#3-architecture-pédagogique-globale)
4. [Charte graphique unifiée — Plateforme VERTEX©](#4-charte-graphique-unifiée--plateforme-vertex)
5. [Code couleur bi-formation (Scoliose + PTG)](#5-code-couleur-bi-formation-scoliose--ptg)
6. [Règles d'écriture du contenu](#6-règles-décriture-du-contenu)
7. [Structure des fichiers du CDC](#7-structure-des-fichiers-du-cdc)
8. [Correspondance inter-formations](#8-correspondance-inter-formations)

---

# 1. SYNTHÈSE EXÉCUTIVE

## 1.1 Ce qu'est cette formation

La **Formation Prothèse Totale du Genou (PTG)** est un programme e-learning complet destiné aux chirurgiens orthopédistes, couvrant **l'intégralité** du sujet — de l'embryologie du genou à la gestion des complications à 20 ans, en passant par la conception mécanique des implants et les techniques chirurgicales avancées.

Elle constitue la **deuxième formation** de la plateforme VERTEX©, après la Formation Scoliose (29 modules, ~89h). Les deux formations partagent :

- La même **plateforme LMS** (architecture, authentification, évaluation)
- La même **charte graphique** de base (typographie, mise en page, icônes)
- Le même **moteur de simulation** VERTEX© (adapté au genou : KneeSim©)
- Les mêmes **règles d'écriture pédagogique** (cas cliniques, mnémoniques, niveaux de profondeur)
- Les mêmes **standards d'évaluation** (Bronze → Diamant, cas cliniques progressifs)

## 1.2 Périmètre de la formation PTG

| Dimension | Détail |
|---|---|
| **Nombre de modules** | 28 modules organisés en 8 parties |
| **Durée estimée** | ~75-85 heures de contenu |
| **Niveau** | Interne avancé → chirurgien confirmé → expert |
| **Spécialité** | Chirurgie orthopédique — arthroplastie du genou |
| **Couverture** | Histoire, embryologie, anatomie, biomécanique, pathologies, imagerie, indications, conception des implants, planification, techniques chirurgicales (primaires et reprises), résultats, complications, rééducation, suivi long terme, innovations |
| **Simulation** | KneeSim© — module VERTEX© dédié au genou (cinématique, placement d'implants, planification 3D) |
| **Certification** | Certificat VERTEX© PTG, éligible DPC/CME |
| **Langue** | Français (traduction EN/ES/AR prévue) |

## 1.3 Objectifs pédagogiques globaux

À l'issue de cette formation, l'apprenant sera capable de :

1. **Décrire** l'anatomie fonctionnelle et la biomécanique du genou normal et arthrosique
2. **Expliquer** les principes de conception des prothèses totales de genou (design, matériaux, cinématique, fixation)
3. **Poser** les indications et contre-indications d'une PTG en fonction du contexte clinique
4. **Planifier** une PTG (bilan préopératoire, templating 2D/3D, choix de l'implant, gestion de l'alignement)
5. **Maîtriser** les techniques chirurgicales (voies d'abord, coupes osseuses, équilibrage ligamentaire, scellement/impaction, PSI, navigation, robotique)
6. **Identifier et gérer** les complications peropératoires et postopératoires (infection, raideur, instabilité, fracture périprothétique, usure, descellement)
7. **Diriger** la rééducation postopératoire et le suivi à long terme
8. **Évaluer** les résultats fonctionnels (scores cliniques, PROMs, survie des implants)
9. **Planifier et réaliser** une chirurgie de reprise (diagnostic, classification, stratégie, technique)
10. **Intégrer** les innovations récentes (PSI, robotique, capteurs, implants personnalisés, IA)

---

# 2. PUBLIC CIBLE ET PRÉREQUIS

## 2.1 Public cible

| Niveau | Public | Modules obligatoires | Modules optionnels |
|---|---|---|---|
| **Niveau 1 — Fondamental** | Internes orthopédie (1ère-4ème année), médecins rééducateurs | Modules 1-8, 22-23, 28 | 24-25 |
| **Niveau 2 — Intermédiaire** | Résidents séniors, CCA, chirurgiens en début de pratique | Modules 1-18, 22-23, 28 | 19-21, 24-27 |
| **Niveau 3 — Expert** | Chirurgiens confirmés, fellows arthroplastie, experts PTG | Modules 1-28 (intégralité) | — |

## 2.2 Prérequis

- Diplôme de médecine (ou en cours d'obtention)
- Connaissances de base en anatomie du membre inférieur
- Connaissances de base en biomécanique (souhaitées mais non obligatoires — le Module 4 couvre les fondamentaux)

---

# 3. ARCHITECTURE PÉDAGOGIQUE GLOBALE

## 3.1 Organisation en 8 parties — 28 modules

```
FORMATION PTG — PROTHÈSE TOTALE DU GENOU
│
├── PARTIE I — FONDAMENTAUX ET SCIENCES DE BASE (Modules 1-4)
│   ├── Module 1  : Histoire de l'arthroplastie du genou
│   ├── Module 2  : Embryologie et croissance du genou
│   ├── Module 3  : Anatomie chirurgicale du genou
│   └── Module 4  : Biomécanique du genou normal et pathologique
│
├── PARTIE II — PATHOLOGIES ET INDICATIONS (Modules 5-8)
│   ├── Module 5  : Gonarthrose — Physiopathologie et histoire naturelle
│   ├── Module 6  : Autres pathologies nécessitant une PTG
│   ├── Module 7  : Examen clinique du genou
│   └── Module 8  : Imagerie du genou
│
├── PARTIE III — CONCEPTION ET DESIGN DES IMPLANTS (Modules 9-12)
│   ├── Module 9  : Principes de conception d'une PTG — Design fonctionnel
│   ├── Module 10 : Matériaux et tribologie
│   ├── Module 11 : Cinématique prothétique — Statique et dynamique
│   └── Module 12 : Types de PTG et classification des implants
│
├── PARTIE IV — PLANIFICATION PRÉOPÉRATOIRE (Modules 13-14)
│   ├── Module 13 : Bilan préopératoire complet
│   └── Module 14 : Planification chirurgicale (Templating 2D/3D, alignement)
│
├── PARTIE V — TECHNIQUES CHIRURGICALES (Modules 15-19)
│   ├── Module 15 : Voies d'abord et exposition
│   ├── Module 16 : Technique chirurgicale standard — PTG primaire
│   ├── Module 17 : Équilibrage ligamentaire et gestion des déformations
│   ├── Module 18 : Navigation, robotique et PSI (Patient-Specific Instrumentation)
│   └── Module 19 : PTG unicompartimentale (PUC), patello-fémorale et bi-compartimentale
│
├── PARTIE VI — RÉSULTATS ET COMPLICATIONS (Modules 20-23)
│   ├── Module 20 : Résultats de la PTG — Scores et survie des implants
│   ├── Module 21 : Complications peropératoires et postopératoires précoces
│   ├── Module 22 : Complications tardives — Descellement, usure, ostéolyse
│   └── Module 23 : Infection périprothétique du genou
│
├── PARTIE VII — REPRISES ET CAS COMPLEXES (Modules 24-26)
│   ├── Module 24 : Chirurgie de reprise — Diagnostic et planification
│   ├── Module 25 : Chirurgie de reprise — Techniques et reconstruction
│   └── Module 26 : PTG en situation complexe (fracture périprothétique, post-ostéotomie, post-traumatique, rhumatismes inflammatoires, obésité)
│
└── PARTIE VIII — RÉÉDUCATION, SUIVI ET INNOVATIONS (Modules 27-28)
    ├── Module 27 : Rééducation et suivi à long terme
    └── Module 28 : Innovations et perspectives (IA, capteurs, biologie, implants du futur)
```

## 3.2 Structure standardisée de chaque module

Chaque module suit le **même format** que la Formation Scoliose (cf. REGLES_ECRITURE_CONTENU.md) :

1. **En-tête** : titre, partie, durée, niveau, prérequis
2. **Accroche clinique** : vignette patient ou mise en situation réelle (3-5 lignes)
3. **Objectifs d'apprentissage** : 3-7 objectifs (verbes de Bloom)
4. **Sections de contenu** : 3-6 sections principales
5. **Points clés** : 5-8 messages essentiels
6. **Auto-évaluation** : 5-10 questions (QCM, QROC, cas clinique)
7. **Références bibliographiques** : sources vérifiables

## 3.3 Parcours apprenant — Déblocage séquentiel

```
Module 1 → Module 2 → Module 3 → Module 4
                                       ↓
Module 5 → Module 6 → Module 7 → Module 8
                                       ↓
Module 9 → Module 10 → Module 11 → Module 12
                                        ↓
           Module 13 → Module 14
                           ↓
Module 15 → Module 16 → Module 17 → Module 18 → Module 19
                                                     ↓
Module 20 → Module 21 → Module 22 → Module 23
                                         ↓
           Module 24 → Module 25 → Module 26
                                       ↓
                  Module 27 → Module 28
```

- Score ≥ 70% requis pour passer au module suivant
- 2 tentatives autorisées par quiz
- Feedback immédiat avec explication et référence bibliographique

## 3.4 Système de quiz — Difficulté progressive (identique Scoliose)

| Niveau | Icône | Type de question | % du quiz |
|---|---|---|---|
| **Bronze** | 🥉 | Connaissance pure (rappel, définitions) | 30% |
| **Argent** | 🥈 | Compréhension et application (cas simples) | 30% |
| **Or** | 🥇 | Analyse et raisonnement clinique (cas complexes) | 25% |
| **Diamant** | 💎 | Synthèse et décision chirurgicale (scénarios multi-facteurs) | 15% |

---

# 4. CHARTE GRAPHIQUE UNIFIÉE — PLATEFORME VERTEX©

## 4.1 Identité visuelle de la plateforme

La plateforme VERTEX© repose sur une identité visuelle **commune** à toutes les formations, garantissant la cohérence et la reconnaissance de marque.

### 4.1.1 Typographie

| Usage | Police | Poids | Taille |
|---|---|---|---|
| **Titres de partie (H1)** | Montserrat | Bold (700) | 32-36px |
| **Titres de module (H2)** | Montserrat | SemiBold (600) | 26-30px |
| **Titres de section (H3)** | Montserrat | Medium (500) | 22-24px |
| **Sous-sections (H4)** | Open Sans | SemiBold (600) | 18-20px |
| **Corps de texte** | Open Sans | Regular (400) | 16px, line-height 1.6 |
| **Légendes / notes** | Open Sans | Light (300) | 14px |
| **Code / formules** | JetBrains Mono | Regular | 14px |

### 4.1.2 Mise en page

| Élément | Spécification |
|---|---|
| **Largeur max contenu** | 900px (centré) |
| **Marges latérales** | 60px minimum (responsive) |
| **Espacement inter-sections** | 48px |
| **Espacement inter-paragraphes** | 24px |
| **Bordures d'encadrés** | 3px solid, border-radius 8px |
| **Ombres** | box-shadow: 0 2px 8px rgba(0,0,0,0.08) |
| **Coins arrondis** | 8px (encadrés), 12px (cartes), 50% (avatars) |

### 4.1.3 Iconographie

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

## 4.2 Principes de design communs

| Principe | Description |
|---|---|
| **Clarté** | Hiérarchie visuelle claire — titres, sous-titres, corps de texte immédiatement distinguables |
| **Cohérence** | Mêmes composants UI, mêmes encadrés, mêmes icônes pour les deux formations |
| **Accessibilité** | Contraste AAA (WCAG 2.1), polices lisibles, alt-text sur toutes les images |
| **Professionnalisme médical** | Tons sobres et sérieux, pas de couleurs criardes, images HD |
| **Responsive** | Adapté desktop (70% des usages), tablette (25%), mobile (5%) |

---

# 5. CODE COULEUR BI-FORMATION (SCOLIOSE + PTG)

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
| **Succès** | Vert médical | `#27AE60` | Validations, scores positifs |
| **Alerte** | Rouge sang | `#C0392B` | Dangers, erreurs |

### Formation PTG 🦵

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Dominante** | Vert émeraude (Chirurgical) | `#0E6655` | En-têtes H1, bandeau supérieur, sidebar |
| **Accent** | Vert jade | `#1ABC9C` | Liens, boutons primaires, icônes actives |
| **Secondaire** | Vert-gris | `#7DCEA0` | Texte secondaire, bordures |
| **Fond principal** | Blanc cassé | `#FAFEFA` | Fond de page |
| **Fond encadré** | Vert très pâle | `#E8F8F5` | Fond des encadrés 📖 |
| **Succès** | Vert vif | `#27AE60` | Validations, scores positifs (commun) |
| **Alerte** | Rouge sang | `#C0392B` | Dangers, erreurs (commun) |

### Éléments communs (partagés)

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Texte principal** | Noir doux | `#2C3E50` | Corps de texte, toutes formations |
| **Texte secondaire** | Gris moyen | `#7F8C8D` | Légendes, métadonnées |
| **Fond neutre** | Gris très clair | `#F7F9F9` | Fond de tableaux alternés |
| **Bordures** | Gris clair | `#D5D8DC` | Séparateurs, bordures de tableaux |
| **Or (réussite)** | Or | `#F39C12` | Badges, certificats |
| **Diamant** | Bleu diamant | `#3498DB` | Niveau diamant quiz |

## 5.2 Hiérarchie typographique colorée

### Titres et sous-titres — Formation Scoliose 🦴

| Niveau | Style | Couleur | Exemple |
|---|---|---|---|
| **H1 — Titre de partie** | Montserrat Bold 34px, MAJUSCULES | `#1A5276` bleu profond | PARTIE I — FONDAMENTAUX ET SCIENCES DE BASE |
| **H2 — Titre de module** | Montserrat SemiBold 28px | `#1A5276` bleu profond | MODULE 1 : ANATOMIE DU RACHIS |
| **H3 — Titre de section** | Montserrat Medium 22px | `#2E86C1` bleu accent | 1.1 Anatomie descriptive du rachis |
| **H4 — Sous-section** | Open Sans SemiBold 18px | `#2C3E50` noir doux | Vertèbres cervicales (C1-C7) |
| **Bandeau latéral** | — | `#1A5276` fond, texte blanc | Navigation module |
| **Badge formation** | Pill 24px | `#1A5276` fond, blanc | 🦴 SCOLIOSE |

### Titres et sous-titres — Formation PTG 🦵

| Niveau | Style | Couleur | Exemple |
|---|---|---|---|
| **H1 — Titre de partie** | Montserrat Bold 34px, MAJUSCULES | `#0E6655` vert émeraude | PARTIE I — FONDAMENTAUX ET SCIENCES DE BASE |
| **H2 — Titre de module** | Montserrat SemiBold 28px | `#0E6655` vert émeraude | MODULE 1 : HISTOIRE DE L'ARTHROPLASTIE DU GENOU |
| **H3 — Titre de section** | Montserrat Medium 22px | `#1ABC9C` vert jade | 1.1 Des origines à Themistoclès Glück |
| **H4 — Sous-section** | Open Sans SemiBold 18px | `#2C3E50` noir doux | Premières résections articulaires |
| **Bandeau latéral** | — | `#0E6655` fond, texte blanc | Navigation module |
| **Badge formation** | Pill 24px | `#0E6655` fond, blanc | 🦵 PTG |

## 5.3 Encadrés — Code couleur partagé

Les encadrés utilisent le **même code couleur** dans les deux formations, garantissant la cohérence :

| Marqueur | Nom | Bordure gauche | Fond | Usage identique |
|---|---|---|---|---|
| 🏥 | **Pertinence clinique** | `#E67E22` orange | `#FDF2E9` | Lien concept → pratique chirurgicale |
| ⚠️ | **Danger / Critique** | `#E74C3C` rouge | `#FDEDEC` | Risque vital, erreur dangereuse |
| 📖 | **Approfondissement** | `#3498DB` bleu | `#EBF5FB` | Mécanisme, physique, recherche |
| 💡 | **Astuce / Mnémonique** | `#2ECC71` vert | `#EAFAF1` | Aide-mémoire, truc de praticien |
| 🔬 | **Expert** | `#9B59B6` violet | `#F4ECF7` | Détail avancé, technique fine |
| 🤔 | **Réflexion** | `#F1C40F` jaune | `#FEF9E7` | Question ouverte, problème |

## 5.4 Navigation plateforme — Identification visuelle

```
┌─────────────────────────────────────────────────────────────────┐
│  VERTEX©                                    🔔  👤 Dr. Martin  │
│  ─────────────────────────────────────────────────────────────  │
│                                                                 │
│  ┌─────────────────┐    ┌─────────────────┐                     │
│  │  🦴 SCOLIOSE    │    │  🦵 PTG          │                    │
│  │  ▔▔▔▔▔▔▔▔▔▔▔▔▔  │    │  ▔▔▔▔▔▔▔▔▔▔▔▔▔  │                    │
│  │  Fond: #1A5276  │    │  Fond: #0E6655  │                    │
│  │  29 modules     │    │  28 modules     │                    │
│  │  89h            │    │  80h            │                    │
│  │  ████████░░ 75% │    │  ██░░░░░░░░ 15% │                    │
│  └─────────────────┘    └─────────────────┘                     │
│                                                                 │
│  Formations à venir :                                           │
│  ┌─────────────────┐    ┌─────────────────┐                     │
│  │  🧠 NEUROCHIR.  │    │  🦴 PTH          │                    │
│  │  À venir Q4'26  │    │  À venir 2027   │                    │
│  └─────────────────┘    └─────────────────┘                     │
└─────────────────────────────────────────────────────────────────┘
```

## 5.5 Sidebar de navigation — Couleur par formation

**Formation Scoliose :**
```
┌──────────────────────┐
│  🦴 SCOLIOSE         │  ← Fond #1A5276, texte blanc
│  ────────────────    │
│  PARTIE I            │  ← Texte #AED6F1 (bleu clair)
│   ▸ M1 Anatomie     │  ← Texte blanc
│   ▸ M2 Embryologie  │
│   ▸ M3 Biomécanique │
│   ► M4 Définitions  │  ← Module actif : fond #2E86C1
│   ▸ M5 Classification│
│  PARTIE II           │
│   ...                │
└──────────────────────┘
```

**Formation PTG :**
```
┌──────────────────────┐
│  🦵 PTG              │  ← Fond #0E6655, texte blanc
│  ────────────────    │
│  PARTIE I            │  ← Texte #A3E4D7 (vert clair)
│   ▸ M1 Histoire     │  ← Texte blanc
│   ▸ M2 Embryologie  │
│   ▸ M3 Anatomie     │
│   ► M4 Biomécanique │  ← Module actif : fond #1ABC9C
│   ...                │
│  PARTIE II           │
│   ...                │
└──────────────────────┘
```

---

# 6. RÈGLES D'ÉCRITURE DU CONTENU

Les règles d'écriture sont **identiques** à celles de la Formation Scoliose (cf. `REGLES_ECRITURE_CONTENU.md`). Voici un résumé des principes fondamentaux, adaptés au contexte PTG :

## 6.1 Principes inchangés

| # | Règle | Applicable PTG |
|---|---|---|
| 1 | Jamais de fait sans explication (mécanisme + conséquence clinique) | ✅ Identique |
| 2 | Chaînes de raisonnement obligatoires (anatomie → biomécanique → pathologie → clinique → chirurgie) | ✅ Identique |
| 3 | Controverses et niveaux de preuve (📊, ⚖️) | ✅ Identique |
| 4 | Trois niveaux de profondeur (Essentiel / Approfondi / Expert) | ✅ Identique |
| 5 | Minimum 2 vignettes cliniques par module | ✅ Identique |
| 6 | Minimum 1 question de réflexion par section (🤔) | ✅ Identique |
| 7 | Minimum 1 micro-exercice par section (✏️) | ✅ Identique |
| 8 | Minimum 3 mnémoniques par module (💡) | ✅ Identique |
| 9 | Minimum 1 exercice KneeSim© par module (si applicable) | ✅ Adapté (VERTEX → KneeSim) |
| 10 | 1 encadré pour 500 mots minimum | ✅ Identique |
| 11 | Format des marqueurs médias : `> [MEDIA: {EMOJI} {CODE} — {TITRE} ({INSTRUCTION})]` | ✅ Identique |
| 12 | Vouvoiement systématique | ✅ Identique |
| 13 | Formulations interdites (cf. §8.4 du REGLES_ECRITURE) | ✅ Identique |
| 14 | ≥ 300 mots par sous-section | ✅ Identique |

## 6.2 Adaptations spécifiques PTG

| Adaptation | Détail |
|---|---|
| **Simulateur** | KneeSim© au lieu de VERTEX© rachis. Même moteur, scénarios genou : cinématique, placement d'implants, équilibrage ligamentaire virtuel |
| **Patient fil rouge** | Un patient fil rouge par partie (pas par 5 modules consécutifs comme en scoliose, car les parties sont plus courtes) |
| **Particularité biomécanique** | Insister sur les aspects tribologiques (usure, friction) absents de la formation scoliose |
| **Vidéos chirurgicales** | Plus nombreuses qu'en scoliose (au moins 1 par module à partir du Module 15) |
| **Données industrielles** | Certains modules (9-12) contiennent des données de conception industrielle (design, matériaux, normes ISO). Ton rigoureux mais accessible |

## 6.3 Marqueurs médias — Codification PTG

```
> [MEDIA: {EMOJI} MPTG{module}-S{section}-{numéro} — {TITRE} ({INSTRUCTION_PÉDAGOGIQUE})]
```

- Préfixe **MPTG** (au lieu de M) pour distinguer des médias scoliose
- Exemple : `MPTG03-S02-005` = Formation PTG, Module 3, Section 2, 5ème média

---

# 7. STRUCTURE DES FICHIERS DU CDC

Le présent cahier des charges est organisé en **8 fichiers** :

| # | Fichier | Contenu | Modules couverts |
|---|---|---|---|
| 0 | `CDC_PTG_00_INTRODUCTION_CHARTE.md` | Introduction, charte graphique, code couleur, règles d'écriture | — |
| 1 | `CDC_PTG_01_FONDAMENTAUX.md` | Histoire, embryologie, anatomie, biomécanique | Modules 1-4 |
| 2 | `CDC_PTG_02_PATHOLOGIES_INDICATIONS.md` | Gonarthrose, pathologies, examen clinique, imagerie | Modules 5-8 |
| 3 | `CDC_PTG_03_IMPLANTS_CONCEPTION.md` | Design, matériaux, cinématique, types d'implants | Modules 9-12 |
| 4 | `CDC_PTG_04_PLANIFICATION_CHIRURGIE.md` | Bilan préop, planification, techniques chirurgicales, navigation, PUC | Modules 13-19 |
| 5 | `CDC_PTG_05_RESULTATS_COMPLICATIONS.md` | Résultats, complications, infections | Modules 20-23 |
| 6 | `CDC_PTG_06_REPRISES_CAS_COMPLEXES.md` | Chirurgie de reprise, situations complexes | Modules 24-26 |
| 7 | `CDC_PTG_07_REEDUCATION_INNOVATIONS.md` | Rééducation, suivi, innovations | Modules 27-28 |

---

# 8. CORRESPONDANCE INTER-FORMATIONS

## 8.1 Modules partagés / transversaux

Certains concepts sont communs aux deux formations. Le LMS gère les **renvois croisés** :

| Concept | Formation Scoliose | Formation PTG | Type de partage |
|---|---|---|---|
| Biomécanique générale (forces, moments, contraintes) | Module 3 §3.1 | Module 4 §4.1 | Contenu adapté (rachis vs genou) |
| Imagerie (radiographie, scanner, IRM) | Module 7 | Module 8 | Principes communs, applications différentes |
| Matériaux d'ostéosynthèse (titane, CoCr, PE) | Module 15 §15.1 | Modules 10, 12 | Contenu plus détaillé en PTG |
| Infection site opératoire | Module 22 (scoliose) | Module 23 (PTG) | Principes communs, spécificités locales |
| Rééducation postopératoire | Module 18 (scoliose) | Module 27 (PTG) | Entièrement différent |
| Complications thromboemboliques | Module 17 §17.4 | Module 21 §21.5 | Même physiopathologie, protocoles différents |
| Anesthésie et gestion de la douleur | Module 20 (scoliose) | Module 13 §13.4 | Rachianesthésie vs AG, PCA vs blocs |

## 8.2 Simulation KneeSim© vs VERTEX© Rachis

| Caractéristique | VERTEX© Rachis (Scoliose) | KneeSim© (PTG) |
|---|---|---|
| **Anatomie simulée** | Rachis C3-S1, 23 vertèbres, disques, ligaments | Genou : fémur distal, tibia proximal, patella, ligaments, ménisques |
| **FEM** | Poutre Euler-Bernoulli 3D → tétraédrique (phase 2) | Volumique tétraédrique (os) + contact surface (implants) |
| **Cinématique** | Couplage flexion-rotation, zone neutre | 6 DDL du genou, rollback, pivot médial, cinématique de l'implant |
| **Chirurgie virtuelle** | Placement de vis pédiculaires, cintrage de tige | Coupes osseuses, positionnement d'implant, équilibrage ligamentaire |
| **Longitudinal** | Simulation de croissance et progression scoliotique | Usure du PE, ostéolyse, descellement (simulation à 10-20 ans) |
| **Moteur** | Julia + Three.js | Même stack, modèles anatomiques différents |

---

# ANNEXE A — GLOSSAIRE DES ABRÉVIATIONS

| Abréviation | Signification |
|---|---|
| PTG | Prothèse Totale du Genou |
| TKA | *Total Knee Arthroplasty* |
| PUC | Prothèse Unicompartimentale |
| UKA | *Unicompartmental Knee Arthroplasty* |
| PSI | *Patient-Specific Instrumentation* |
| CR | *Cruciate Retaining* (conservation du LCP) |
| PS | *Posterior Stabilized* (sacrifice du LCP + came/poteau) |
| CS | *Cruciate Substituting* |
| UC | *Ultra-Congruent* |
| MC | *Medial Congruent* |
| BCS | *Bicruciate Substituting* |
| BCR | *Bicruciate Retaining* |
| PE | Polyéthylène (UHMWPE) |
| XLPE | *Cross-Linked Polyethylene* |
| CoCr | Cobalt-Chrome |
| PMMA | Polyméthacrylate de méthyle (ciment) |
| HA | Hydroxyapatite |
| LCA | Ligament Croisé Antérieur |
| LCP | Ligament Croisé Postérieur |
| LCM | Ligament Collatéral Médial |
| LCL | Ligament Collatéral Latéral |
| HKA | *Hip-Knee-Ankle angle* (axe mécanique) |
| AFM | Axe Fémoral Mécanique |
| ATM | Axe Tibial Mécanique |
| LDFA | *Lateral Distal Femoral Angle* |
| MPTA | *Medial Proximal Tibial Angle* |
| JLCA | *Joint Line Congruency Angle* |
| OTV | Ostéotomie Tibiale de Valgisation |
| DPC | Développement Professionnel Continu |
| CME | *Continuing Medical Education* |
| PROMs | *Patient-Reported Outcome Measures* |
| KSS | *Knee Society Score* |
| WOMAC | *Western Ontario and McMaster Universities Osteoarthritis Index* |
| FJS | *Forgotten Joint Score* |
| OKS | *Oxford Knee Score* |
| EQ-5D | *EuroQol-5 Dimensions* |
| KOOS | *Knee injury and Osteoarthritis Outcome Score* |

---

*Ce document (Partie 0) constitue le socle commun de la Formation PTG. Les parties suivantes (1 à 7) détaillent le contenu pédagogique module par module.*

*Document conforme à la charte VERTEX© — Version 1.0 — Mars 2026*
