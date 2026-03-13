# CAHIER DES CHARGES — FORMATION COMPLÈTE DIABÉTOLOGIE

## Partie 0 — Introduction générale, Charte graphique et Architecture pédagogique

**Date** : 13 mars 2026
**Version** : 1.0
**Statut** : Document fondateur — Cahier des charges complet
**Plateforme** : VERTEX© — Formation médicale en ligne
**Formation** : Diabétologie Complète — *Comprehensive Diabetology*

---

# TABLE DES MATIÈRES — PARTIE 0

1. [Synthèse exécutive](#1-synthèse-exécutive)
2. [Public cible et prérequis](#2-public-cible-et-prérequis)
3. [Architecture pédagogique globale](#3-architecture-pédagogique-globale)
4. [Charte graphique unifiée — Plateforme VERTEX©](#4-charte-graphique-unifiée--plateforme-vertex)
5. [Code couleur — Formation Diabétologie](#5-code-couleur--formation-diabétologie)
6. [Règles d'écriture du contenu](#6-règles-décriture-du-contenu)
7. [Structure des fichiers du CDC](#7-structure-des-fichiers-du-cdc)
8. [Correspondance inter-formations](#8-correspondance-inter-formations)

---

# 1. SYNTHÈSE EXÉCUTIVE

## 1.1 Ce qu'est cette formation

La **Formation Diabétologie Complète** est un programme e-learning exhaustif destiné aux médecins généralistes, internes en médecine, diabétologues-endocrinologues et nutritionnistes, couvrant **l'intégralité** de la diabétologie — depuis l'embryologie et l'anatomie du pancréas endocrine, la physiologie de l'homéostasie glucidique, la physiopathologie des différents types de diabète, le diagnostic, le dépistage, les complications aiguës et chroniques (micro et macrovasculaires), jusqu'aux traitements actuels et futurs (insulinothérapie, antidiabétiques oraux et injectables, technologies du diabète, pancréas artificiel, immunothérapie, thérapie cellulaire, médecine de précision), en passant par les situations cliniques particulières (grossesse, chirurgie, réanimation, sport) et l'organisation des soins.

Elle constitue la **sixième formation** de la plateforme VERTEX©, après les Formations Scoliose (🔵), PTG (🟢), IOA (🟤), Tendinites (🩶) et Obésité-Orthopédie (🟣). Les formations partagent :

- La même **plateforme LMS** (architecture, authentification, évaluation)
- La même **charte graphique** de base (typographie, mise en page, icônes)
- Les mêmes **règles d'écriture pédagogique** (cas cliniques, mnémoniques, niveaux de profondeur)
- Les mêmes **standards d'évaluation** (Bronze → Diamant, cas cliniques progressifs)
- Le même **moteur de simulation** VERTEX© (adapté : DiabSim© pour la modélisation métabolique, la simulation de l'insulinothérapie, la cinétique glycémique et les scénarios de complications)

## 1.2 Périmètre de la formation Diabétologie

| Dimension | Détail |
|---|---|
| **Nombre de modules** | 40 modules organisés en 12 parties |
| **Durée estimée** | ~120-140 heures de contenu |
| **Niveau** | Fondamental → Intermédiaire → Expert |
| **Spécialités** | Diabétologie-endocrinologie, médecine générale, médecine interne, nutrition, cardiologie, néphrologie, ophtalmologie, neurologie, obstétrique, anesthésie-réanimation, médecine du sport, pédiatrie |
| **Couverture — Volet Fondamental** | Embryologie du pancréas, anatomie macro et microscopique, îlots de Langerhans, physiologie de la sécrétion d'insuline, glucagon, incrétines (GLP-1, GIP), axe entéro-insulaire, métabolisme glucidique intégré (foie, muscle, tissu adipeux, cerveau), transporteurs du glucose (GLUT), signalisation insulinique |
| **Couverture — Volet Physiopathologie** | DT1 (auto-immunité, destruction β-cellulaire, histoire naturelle, stades pré-cliniques), DT2 (insulinorésistance, dysfonction β-cellulaire, glucotoxicité, lipotoxicité, inflammasome, microbiote), MODY (types 1-14), LADA, diabète mitochondrial, diabète pancréatique (type 3c), diabète médicamenteux (corticoïdes, immunothérapie), diabète gestationnel |
| **Couverture — Volet Diagnostic** | Critères OMS/ADA/HAS, glycémie à jeun, HGPO 75g, HbA1c, diagnostic différentiel, dépistage ciblé et populationnel, prédiabète (IFG, IGT), auto-anticorps (anti-GAD, anti-IA2, anti-ZnT8, anti-insuline), peptide C, génotypage HLA |
| **Couverture — Volet Clinique** | Présentation DT1 (enfant, adolescent, adulte, acidocétose inaugurale), présentation DT2 (découverte fortuite, syndrome métabolique, acanthosis nigricans), complications aiguës (acidocétose, syndrome hyperosmolaire, hypoglycémie sévère, acidose lactique), formes particulières (sujet âgé, enfant, migrant, psychiatrique) |
| **Couverture — Volet Complications** | Microvasculaires : rétinopathie (classification ETDRS, OCT, anti-VEGF), néphropathie (stades Mogensen/KDIGO, néphroprotection iSGLT2/finérénone), neuropathie (polyneuropathie, dysautonomie, Charcot). Macrovasculaires : coronaropathie silencieuse, AVC, AOMI, cardiopathie diabétique. Pied diabétique (grades IWGDF/Texas, décharge, revascularisation). Autres : NASH/MAFLD, infections, dermatologie, dysfonction érectile, ostéoarticulaire |
| **Couverture — Volet Traitement** | DT1 : schémas insuliniques (basal-bolus, pompe CSII), analogues rapides/lents, insulines ultra-concentrées, CGM (FreeStyle Libre, Dexcom, Guardian), boucle fermée (CamAPS, Control-IQ, Omnipod 5), pancréas artificiel. DT2 : metformine, sulfamides/glinides, iDPP-4, agonistes GLP-1 (liraglutide, sémaglutide, dulaglutide, tirzépatide), iSGLT2 (empagliflozine, dapagliflozine, canagliflozine), glitazones, inhibiteurs α-glucosidase, double/triple agonistes (survodutide, retatrutide), insulinothérapie du DT2, algorithmes HAS/ADA-EASD. Futur : teplizumab, greffe d'îlots, cellules souches, encapsulation, édition génomique |
| **Couverture — Volet Situations** | Diabète et grossesse (programmation, suivi, accouchement), diabète et chirurgie (protocoles périopératoires), diabète et réanimation (gestion glycémique intensive), diabète et sport (adaptation insuline, prévention hypo), gestion du risque CV (dyslipidémie, HTA, anti-agrégation) |
| **Couverture — Volet Organisation** | Parcours de soins (ALD, coordination ville-hôpital, télémédecine, télésurveillance), ETP structurée (programmes, entretien motivationnel, accompagnement psychologique), IA et médecine de précision |
| **Simulation** | DiabSim© — module VERTEX© dédié (cinétique glycémique, simulation insulinothérapie, ajustement de doses, scénarios de complications aiguës, calcul de risque CV personnalisé) |
| **Certification** | Certificat VERTEX© Diabétologie, éligible DPC/CME |
| **Langue** | Français (traduction EN/ES/AR prévue) |

## 1.3 Objectifs pédagogiques globaux

À l'issue de cette formation, le praticien sera capable de :

1. **Décrire** l'embryologie, l'anatomie macro et microscopique du pancréas endocrine et la structure des îlots de Langerhans (Slack, *Development*, 1995 ; Jennings et al., *Diabetes*, 2015)
2. **Expliquer** la physiologie de la sécrétion d'insuline (couplage stimulus-sécrétion, canaux KATP, exocytose biphasique) et le rôle des incrétines dans l'axe entéro-insulaire (Drucker, *Cell Metab*, 2006 ; Nauck & Meier, *Diabetologia*, 2018)
3. **Décrire** le métabolisme glucidique intégré (rôle du foie, du muscle squelettique, du tissu adipeux et du cerveau) et les mécanismes de régulation de la glycémie à jeun et postprandiale
4. **Expliquer** la physiopathologie du DT1 (auto-immunité, stades Eisenbarth/Insel, prédisposition HLA, facteurs environnementaux) et du DT2 (insulinorésistance, dysfonction β-cellulaire progressive, glucotoxicité, lipotoxicité, rôle du microbiote)
5. **Classifier** les différents types de diabète selon la nomenclature actuelle (DT1, DT2, MODY, LADA, diabète mitochondrial, pancréatique, gestationnel, médicamenteux, génétiques rares)
6. **Diagnostiquer** un diabète selon les critères OMS/ADA et prescrire le bilan étiologique adapté (auto-anticorps, peptide C, HLA, MODY génétique)
7. **Organiser** le dépistage du diabète dans les populations à risque et identifier les états de prédiabète (IFG, IGT) avec leur prise en charge
8. **Reconnaître** et prendre en charge les complications aiguës : acidocétose diabétique (protocole de réhydratation, insulinothérapie IVSE, correction kaliémie), syndrome hyperosmolaire, hypoglycémie sévère, acidose lactique
9. **Dépister** et classer les complications microvasculaires : rétinopathie (classification ETDRS, indication anti-VEGF), néphropathie (stades KDIGO, néphroprotection), neuropathie (questionnaires, EMG, monofilament)
10. **Évaluer** le risque cardiovasculaire global du patient diabétique et prescrire une stratégie de prévention adaptée (statines, antihypertenseurs, anti-agrégants, iSGLT2, aGLP-1)
11. **Prescrire** et adapter l'insulinothérapie du DT1 : schéma basal-bolus, pompe, ratio insuline/glucides, facteur de sensibilité, gestion de l'exercice
12. **Utiliser** les technologies du diabète : CGM, pompes à insuline, boucles fermées hybrides, applications de santé connectée
13. **Appliquer** l'algorithme thérapeutique du DT2 : metformine en première ligne, choix de la bithérapie selon le profil du patient (cardiorénal, pondéral), escalade thérapeutique, passage à l'insuline
14. **Maîtriser** la pharmacologie des nouvelles classes thérapeutiques : agonistes GLP-1, iSGLT2, iDPP-4, double et triple agonistes (tirzépatide, survodutide, retatrutide)
15. **Gérer** le diabète dans les situations particulières : grossesse (programmation, suivi obstétrical, insulinothérapie), chirurgie (protocoles périopératoires), réanimation (contrôle glycémique intensif vs conventionnel), sport (adaptation du traitement)
16. **Prendre en charge** le pied diabétique de manière multidisciplinaire : gradation du risque IWGDF, décharge, soins locaux, antibiothérapie, revascularisation, indication d'amputation
17. **Connaître** les innovations thérapeutiques : immunothérapie préventive du DT1 (teplizumab), greffe d'îlots pancréatiques, cellules souches, pancréas bio-artificiel, édition génomique
18. **Organiser** le parcours de soins du patient diabétique : suivi annuel structuré, coordination des intervenants, télémédecine, éducation thérapeutique, accompagnement psychologique

---

# 2. PUBLIC CIBLE ET PRÉREQUIS

## 2.1 Public cible

| Niveau | Public | Modules obligatoires | Modules optionnels |
|---|---|---|---|
| **Niveau 1 — Fondamental** | Internes en médecine, médecins généralistes en formation, IDE en diabétologie | Modules 1-4, 9-10, 12-15, 22, 25-26 | Modules 5-8, 16-21, 27-40 |
| **Niveau 2 — Intermédiaire** | Médecins généralistes installés, internes DES endocrinologie, résidents | Modules 1-29, 34-35 | Modules 30-33, 36-40 |
| **Niveau 3 — Expert** | Diabétologues-endocrinologues, médecins internistes, chercheurs, enseignants | Modules 1-40 (intégralité) | — |

## 2.2 Prérequis

- Diplôme de médecine (ou en cours d'obtention) — ou diplôme d'IDE spécialisée en diabétologie
- Connaissances de base en biochimie et physiologie (souhaitées — les Modules 1-4 reprennent les fondamentaux)
- Connaissances de base en pharmacologie (souhaitées — les modules de traitement sont progressifs)
- Formation VERTEX© Obésité-Orthopédie recommandée en complément (liens croisés : modules obésité/syndrome métabolique/DT2)

---

# 3. ARCHITECTURE PÉDAGOGIQUE GLOBALE

## 3.1 Organisation en 12 parties — 40 modules

```
FORMATION DIABÉTOLOGIE COMPLÈTE
│
├── PARTIE I — FONDAMENTAUX : EMBRYOLOGIE, ANATOMIE ET PHYSIOLOGIE (Modules 1-4)
│   ├── Module 1  : Embryologie du pancréas — Organogenèse, différenciation cellulaire, îlots de Langerhans
│   ├── Module 2  : Anatomie du pancréas endocrine — Macro/microanatomie, vascularisation, innervation
│   ├── Module 3  : Physiologie de la sécrétion d'insuline et du glucagon — Couplage stimulus-sécrétion, incrétines
│   └── Module 4  : Métabolisme glucidique intégré — Foie, muscle, tissu adipeux, cerveau, transporteurs GLUT
│
├── PARTIE II — PHYSIOPATHOLOGIE DU DIABÈTE (Modules 5-8)
│   ├── Module 5  : Diabète de type 1 — Auto-immunité, destruction β-cellulaire, stades pré-cliniques, histoire naturelle
│   ├── Module 6  : Diabète de type 2 — Insulinorésistance, dysfonction β-cellulaire, glucotoxicité, lipotoxicité
│   ├── Module 7  : Diabètes spécifiques — MODY, LADA, mitochondrial, pancréatique (3c), médicamenteux, génétiques rares
│   └── Module 8  : Diabète gestationnel — Physiopathologie, dépistage IADPSG, prise en charge, conséquences fœto-maternelles
│
├── PARTIE III — DIAGNOSTIC ET DÉPISTAGE (Modules 9-11)
│   ├── Module 9  : Diagnostic du diabète — Critères OMS/ADA/HAS, glycémie à jeun, HGPO, HbA1c, pièges diagnostiques
│   ├── Module 10 : Dépistage et prédiabète — Populations cibles, outils, stratégies, IFG, IGT, prévention du DT2
│   └── Module 11 : Explorations biologiques spécialisées — Auto-anticorps, peptide C, HLA, génétique MODY, profil lipidique
│
├── PARTIE IV — CLINIQUE ET FORMES DU DIABÈTE (Modules 12-15)
│   ├── Module 12 : Présentation clinique du DT1 — Signes cardinaux, acidocétose inaugurale, formes de l'enfant et de l'adulte
│   ├── Module 13 : Présentation clinique du DT2 — Découverte fortuite, syndrome métabolique, acanthosis nigricans
│   ├── Module 14 : Complications aiguës — Acidocétose, syndrome hyperosmolaire, hypoglycémie sévère, acidose lactique
│   └── Module 15 : Formes cliniques particulières — Diabète du sujet âgé, de l'enfant/adolescent, du migrant, du patient psychiatrique
│
├── PARTIE V — COMPLICATIONS CHRONIQUES MICROVASCULAIRES (Modules 16-18)
│   ├── Module 16 : Rétinopathie diabétique — Physiopathologie, classification ETDRS, dépistage, OCT, anti-VEGF, laser
│   ├── Module 17 : Néphropathie diabétique — Microalbuminurie → IRC, classification KDIGO, néphroprotection (iSGLT2, finérénone)
│   └── Module 18 : Neuropathie diabétique — Polyneuropathie sensitivomotrice, dysautonomie cardiaque/digestive/vésicale, douleur neuropathique
│
├── PARTIE VI — COMPLICATIONS CHRONIQUES MACROVASCULAIRES ET AUTRES (Modules 19-21)
│   ├── Module 19 : Complications cardiovasculaires — Coronaropathie silencieuse, AVC, AOMI, cardiopathie diabétique, IC
│   ├── Module 20 : Pied diabétique — Physiopathologie, gradation IWGDF, décharge, soins locaux, revascularisation, amputation
│   └── Module 21 : Autres complications — NASH/MAFLD, infections, dermatologie, ostéoarticulaire, dysfonction érectile, santé buccodentaire
│
├── PARTIE VII — TRAITEMENT DU DIABÈTE DE TYPE 1 (Modules 22-24)
│   ├── Module 22 : Insulinothérapie du DT1 — Pharmacologie des insulines, schémas basal-bolus, ajustement des doses
│   ├── Module 23 : Technologies du diabète — Pompes à insuline, CGM, boucles fermées, pancréas artificiel
│   └── Module 24 : Éducation thérapeutique et autosurveillance — IF, ratio I/G, facteur de sensibilité, gestion des hypo/hyper
│
├── PARTIE VIII — TRAITEMENT DU DIABÈTE DE TYPE 2 (Modules 25-29)
│   ├── Module 25 : Mesures hygiéno-diététiques — Nutrition thérapeutique, activité physique adaptée, sevrage tabagique
│   ├── Module 26 : Antidiabétiques oraux classiques — Metformine, sulfamides, glinides, inhibiteurs α-glucosidase, glitazones
│   ├── Module 27 : Nouvelles classes thérapeutiques — Agonistes GLP-1, iSGLT2, iDPP-4, double/triple agonistes
│   ├── Module 28 : Insulinothérapie dans le DT2 — Indications, instauration, titration, schémas, intensification, désescalade
│   └── Module 29 : Stratégie thérapeutique globale — Algorithmes HAS/ADA-EASD, personnalisation, objectifs glycémiques individualisés
│
├── PARTIE IX — SITUATIONS PARTICULIÈRES (Modules 30-33)
│   ├── Module 30 : Diabète et grossesse — Programmation préconceptionnelle, suivi, accouchement, post-partum, allaitement
│   ├── Module 31 : Diabète et chirurgie — Gestion périopératoire, protocoles insuliniques, chirurgie bariatrique et rémission du DT2
│   ├── Module 32 : Diabète en situation aiguë — Réanimation, corticothérapie, infections sévères, nutrition artificielle
│   └── Module 33 : Diabète et exercice physique — Physiologie à l'effort, adaptation du traitement, sport de compétition
│
├── PARTIE X — RISQUE CARDIOVASCULAIRE ET PROTECTION D'ORGANE (Modules 34-35)
│   ├── Module 34 : Dyslipidémie et HTA chez le diabétique — Objectifs LDL, statines, ézétimibe, iPCSK9, antihypertenseurs
│   └── Module 35 : Risque CV global et protection cardiorespiratoire — Scores, prévention, anti-agrégation, bénéfices CV des iSGLT2/aGLP-1
│
├── PARTIE XI — INNOVATIONS ET PERSPECTIVES (Modules 36-38)
│   ├── Module 36 : Immunothérapie et prévention du DT1 — Teplizumab, essais cliniques, screening génétique/immunologique
│   ├── Module 37 : Thérapie cellulaire et médecine régénérative — Greffe d'îlots, cellules souches, encapsulation, édition génomique
│   └── Module 38 : Intelligence artificielle et médecine de précision — Algorithmes prédictifs, phénotypage, pharmacogénomique
│
└── PARTIE XII — ORGANISATION DES SOINS ET ÉDUCATION (Modules 39-40)
    ├── Module 39 : Parcours de soins du patient diabétique — ALD, réseau, télémédecine, télésurveillance, coordination
    └── Module 40 : Éducation thérapeutique structurée — Programmes ETP, entretien motivationnel, accompagnement psychologique, empowerment
```

## 3.2 Structure standardisée de chaque module

Chaque module suit le **même format** que les autres formations VERTEX© (cf. `REGLES_ECRITURE_CONTENU.md`) :

1. **En-tête** : titre, partie, durée, niveau, prérequis
2. **Accroche clinique** : vignette patient ou mise en situation réelle (3-5 lignes)
3. **Objectifs d'apprentissage** : 3-7 objectifs formulés avec un verbe d'action (taxonomie de Bloom)
4. **Sections de contenu** : 3-6 sections principales
5. **Points clés** : 5-8 messages essentiels
6. **Auto-évaluation** : 8-15 questions (QCM, QROC, cas clinique court) — **densité maximale de quiz**
7. **Références bibliographiques** : sources vérifiables

## 3.3 Parcours praticien — Déblocage séquentiel

```
Module 1 → Module 2 → Module 3 → Module 4
                                      ↓
          Module 5 → Module 6 → Module 7 → Module 8
                                               ↓
               Module 9 → Module 10 → Module 11
                                          ↓
          Module 12 → Module 13 → Module 14 → Module 15
                                                  ↓
               Module 16 → Module 17 → Module 18
                                           ↓
               Module 19 → Module 20 → Module 21
                                           ↓
               Module 22 → Module 23 → Module 24
                                           ↓
          Module 25 → Module 26 → Module 27 → Module 28 → Module 29
                                                              ↓
               Module 30 → Module 31 → Module 32 → Module 33
                                                        ↓
                         Module 34 → Module 35
                                        ↓
               Module 36 → Module 37 → Module 38
                                           ↓
                    Module 39 → Module 40
```

- Score ≥ 70% requis pour passer au module suivant
- 2 tentatives autorisées par quiz
- Feedback immédiat avec explication et référence bibliographique

## 3.4 Système de quiz — Difficulté progressive et densité maximale

| Niveau | Icône | Type de question | % du quiz | Nb questions/module |
|---|---|---|---|---|
| **Bronze** | 🥉 | Connaissance pure (rappel, définitions, valeurs seuils) | 25% | 2-4 |
| **Argent** | 🥈 | Compréhension et application (cas simples, calculs, prescriptions) | 30% | 3-5 |
| **Or** | 🥇 | Analyse et raisonnement clinique (cas complexes, diagnostic différentiel) | 30% | 3-4 |
| **Diamant** | 💎 | Synthèse et décision thérapeutique multi-facteurs (situations rares, controverses) | 15% | 1-2 |

**Exigence spécifique Diabétologie** : chaque module comporte **10-15 questions d'auto-évaluation** (vs 5-10 dans les autres formations), incluant obligatoirement :
- 3-5 QCM classiques (4-5 options, feedback immédiat pour chaque option)
- 2-3 cas cliniques courts avec questions enchaînées
- 1-2 exercices de calcul (dose d'insuline, ratio I/G, estimation DFG, objectif LDL)
- 1-2 questions de prescription (ordonnance type, bilan annuel)
- 1 question de synthèse ouverte

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

### 4.1.3 Iconographie (identique aux autres formations + spécifique)

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
| 🩸 | Glycémie / Biologie (spécifique DIAB) | Rouge sang |
| 💉 | Insuline / Injection (spécifique DIAB) | Bleu clair |
| 📱 | Technologie / CGM / App (spécifique DIAB) | Teal |
| 🧬 | Génétique / Auto-immunité (spécifique DIAB) | Violet ADN |
| 🍽️ | Nutrition / Diététique (partagé OBO) | Vert olive |

---

# 5. CODE COULEUR — FORMATION DIABÉTOLOGIE

## 5.1 Palette principale — Formation Diabétologie 🔶

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Dominante** | Bleu pétrole (Métabolique/Endocrine) | `#1A5276` | En-têtes H1, bandeau supérieur, sidebar |
| **Accent** | Bleu turquoise | `#148F77` | Liens, boutons primaires, icônes actives |
| **Secondaire** | Bleu-vert clair | `#76D7C4` | Texte secondaire, bordures |
| **Fond principal** | Blanc cassé | `#FAFBFC` | Fond de page |
| **Fond encadré** | Bleu-vert très pâle | `#E8F8F5` | Fond des encadrés 📖 |
| **Succès** | Vert médical | `#27AE60` | Validations, scores positifs (commun) |
| **Alerte** | Orange glycémie haute | `#E67E22` | Alertes hyperglycémie, complications |
| **Danger** | Rouge hypoglycémie | `#E74C3C` | Alertes hypoglycémie, urgences |

> **Justification du bleu pétrole** : Le bleu pétrole évoque la profondeur métabolique et endocrinienne de la diabétologie, la rigueur du contrôle glycémique. Il se distingue clairement du bleu cobalt (Scoliose 🔵), du vert (PTG 🟢), du rouge bordeaux (IOA 🟤), du gris-bleu acier (Tendinites 🩶) et du violet foncé (Obésité 🟣), permettant une identification instantanée de la formation.

### Éléments communs (partagés entre toutes les formations)

| Rôle | Couleur | Hex | Usage |
|---|---|---|---|
| **Texte principal** | Noir doux | `#2C3E50` | Corps de texte, toutes formations |
| **Texte secondaire** | Gris moyen | `#7F8C8D` | Légendes, métadonnées |
| **Fond neutre** | Gris très clair | `#F7F9F9` | Fond de tableaux alternés |
| **Bordures** | Gris clair | `#D5D8DC` | Séparateurs, bordures de tableaux |
| **Or (réussite)** | Or | `#F39C12` | Badges, certificats |
| **Diamant** | Bleu diamant | `#3498DB` | Niveau diamant quiz |

## 5.2 Hiérarchie typographique colorée — Formation Diabétologie 🔶

| Niveau | Style | Couleur | Exemple |
|---|---|---|---|
| **H1 — Titre de partie** | Montserrat Bold 34px, MAJUSCULES | `#1A5276` bleu pétrole | PARTIE I — FONDAMENTAUX : EMBRYOLOGIE, ANATOMIE ET PHYSIOLOGIE |
| **H2 — Titre de module** | Montserrat SemiBold 28px | `#1A5276` bleu pétrole | MODULE 3 : PHYSIOLOGIE DE LA SÉCRÉTION D'INSULINE |
| **H3 — Titre de section** | Montserrat Medium 22px | `#148F77` turquoise | 3.2 Axe entéro-insulaire et effet incrétine |
| **H4 — Sous-section** | Open Sans SemiBold 18px | `#2C3E50` noir doux | Rôle du GLP-1 dans la potentialisation de la sécrétion d'insuline |
| **Bandeau latéral** | — | `#1A5276` fond, texte blanc | Navigation module |
| **Badge formation** | Pill 24px | `#1A5276` fond, blanc | 🔶 DIABÉTOLOGIE |

## 5.3 Encadrés — Code couleur partagé (identique aux autres formations + spécifiques)

| Marqueur | Nom | Bordure gauche | Fond | Usage |
|---|---|---|---|---|
| 🏥 | **Pertinence clinique** | `#E67E22` orange | `#FDF2E9` | Lien concept → pratique clinique |
| ⚠️ | **Danger / Critique** | `#E74C3C` rouge | `#FDEDEC` | Risque vital, erreur dangereuse (hypo sévère, acidocétose) |
| 📖 | **Approfondissement** | `#3498DB` bleu | `#EBF5FB` | Mécanisme, recherche, biochimie |
| 💡 | **Astuce / Mnémonique** | `#2ECC71` vert | `#EAFAF1` | Aide-mémoire, truc de praticien |
| 🔬 | **Expert** | `#9B59B6` violet | `#F4ECF7` | Détail avancé, technique fine |
| 🤔 | **Réflexion** | `#F1C40F` jaune | `#FEF9E7` | Question ouverte, problème |
| 🩸 | **Focus glycémique** (nouveau) | `#C0392B` rouge sang | `#FDEDEC` | Objectifs glycémiques, profils CGM, temps dans la cible |
| 💉 | **Focus insuline** (nouveau) | `#2980B9` bleu clair | `#EBF5FB` | Schémas insuliniques, ajustement de doses, pharmacocinétique |
| 📱 | **Focus technologie** (nouveau) | `#17A589` teal | `#E8F8F5` | CGM, pompes, boucles fermées, applications |
| 🧬 | **Focus génétique/immunologie** (nouveau) | `#8E44AD` violet | `#F4ECF7` | Auto-anticorps, HLA, MODY, thérapie cellulaire |

## 5.4 Sidebar de navigation — Formation Diabétologie 🔶

```
┌──────────────────────────────┐
│  🔶 DIABÉTOLOGIE              │  ← Fond #1A5276, texte blanc
│  ────────────────────────────│
│  PARTIE I — FONDAMENTAUX     │  ← Texte #76D7C4
│   ▸ M1 Embryologie pancréas  │  ← Texte blanc
│   ▸ M2 Anatomie endocrine    │
│   ▸ M3 Physiologie insuline  │
│   ▸ M4 Métabolisme glucidique│
│  PARTIE II — PHYSIOPATHOLOGIE│
│   ▸ M5 DT1 auto-immunité     │
│   ▸ M6 DT2 insulinorésistance│
│   ▸ M7 Diabètes spécifiques  │
│   ▸ M8 Diabète gestationnel   │
│  PARTIE III — DIAGNOSTIC     │
│   ▸ M9 Critères diagnostiques│
│   ▸ M10 Dépistage/prédiabète │
│   ▸ M11 Explorations bio     │
│  PARTIE IV — CLINIQUE        │
│   ▸ M12 Clinique DT1         │
│   ▸ M13 Clinique DT2         │
│   ▸ M14 Complications aiguës │
│   ► M15 Formes particulières │  ← Module actif : fond #148F77
│  PARTIE V — MICROVASCULAIRE  │
│   ▸ M16 Rétinopathie         │
│   ▸ M17 Néphropathie         │
│   ▸ M18 Neuropathie          │
│  PARTIE VI — MACROVASCULAIRE │
│   ▸ M19 Cardiovasculaire     │
│   ▸ M20 Pied diabétique      │
│   ▸ M21 Autres complications │
│  PARTIE VII — TTT DT1       │
│   ▸ M22 Insulinothérapie DT1 │
│   ▸ M23 Technologies         │
│   ▸ M24 ETP/autosurveillance │
│  PARTIE VIII — TTT DT2      │
│   ▸ M25 MHD                  │
│   ▸ M26 ADO classiques       │
│   ▸ M27 Nouvelles classes    │
│   ▸ M28 Insuline DT2         │
│   ▸ M29 Stratégie globale    │
│  PARTIE IX — SITUATIONS      │
│   ▸ M30 Grossesse            │
│   ▸ M31 Chirurgie            │
│   ▸ M32 Réanimation          │
│   ▸ M33 Sport                │
│  PARTIE X — RISQUE CV       │
│   ▸ M34 Dyslipidémie/HTA    │
│   ▸ M35 Prévention CV        │
│  PARTIE XI — INNOVATIONS    │
│   ▸ M36 Immunothérapie DT1   │
│   ▸ M37 Thérapie cellulaire  │
│   ▸ M38 IA/Précision         │
│  PARTIE XII — ORGANISATION  │
│   ▸ M39 Parcours de soins    │
│   ▸ M40 ETP structurée       │
└──────────────────────────────┘
```

---

# 6. RÈGLES D'ÉCRITURE DU CONTENU

Les règles d'écriture sont **identiques** à celles des autres formations VERTEX© (cf. `REGLES_ECRITURE_CONTENU.md`). Voici un résumé des principes fondamentaux, adaptés au contexte Diabétologie :

## 6.1 Principes inchangés

| # | Règle | Applicable DIAB |
|---|---|---|
| 1 | Jamais de fait sans explication (mécanisme + conséquence clinique) | ✅ Identique |
| 2 | Chaînes de raisonnement obligatoires (physiopathologie → biochimie → clinique → traitement) | ✅ Adapté |
| 3 | Controverses et niveaux de preuve (📊, ⚖️) | ✅ Identique |
| 4 | Trois niveaux de profondeur (Essentiel / Approfondi / Expert) | ✅ Identique |
| 5 | Minimum 2 vignettes cliniques par module | ✅ Renforcé → **minimum 3** |
| 6 | Minimum 1 question de réflexion par section (🤔) | ✅ Identique |
| 7 | Minimum 1 micro-exercice par section (✏️) | ✅ Identique |
| 8 | Minimum 3 mnémoniques par module (💡) | ✅ Identique |
| 9 | Minimum 1 exercice DiabSim© par module (si applicable) | ✅ Adapté (VERTEX → DiabSim) |
| 10 | 1 encadré pour 500 mots minimum | ✅ Identique |
| 11 | Format des marqueurs médias : `> [MEDIA: {EMOJI} {CODE} — {TITRE} ({INSTRUCTION})]` | ✅ Identique |
| 12 | Vouvoiement systématique | ✅ Identique |
| 13 | Formulations interdites | ✅ Identique |
| 14 | ≥ 300 mots par sous-section | ✅ Identique |
| 15 | **Auto-évaluation renforcée : 10-15 questions par module** | ✅ **Nouveau — spécifique DIAB** |
| 16 | **Cas cliniques progressifs obligatoires couvrant tous les chapitres** | ✅ **Nouveau — spécifique DIAB** |

> **⚠️ Originalité et propriété intellectuelle** : Les règles d'originalité du contenu et de prévention du plagiat définies à la **section 13 de `REGLES_ECRITURE_CONTENU.md`** s'appliquent intégralement à cette formation.

## 6.2 Adaptations spécifiques Diabétologie

| Adaptation | Détail |
|---|---|
| **Simulateur** | DiabSim© au lieu de SpineSim©, KneeSim©, InfectoSim©, TendonSim© ou ObesSim©. Scénarios : cinétique glycémique (simulation glucose-insuline sur 24h), ajustement de doses d'insuline (basal-bolus, pompe), simulation de l'effet des repas et de l'exercice sur la glycémie, scénarios de complications aiguës (acidocétose, hypoglycémie), simulation pharmacocinétique des ADO et injectables, calcul de risque CV personnalisé |
| **Patient fil rouge** | Un patient fil rouge par partie — parcours complet d'un patient DT1 (de la découverte à l'autonomie avec boucle fermée) ET d'un patient DT2 (de la découverte au traitement injectable en passant par les complications) |
| **Particularité métabolique** | Intégrer systématiquement les données de glycémie (valeurs, profils CGM, temps dans la cible) à chaque module clinique et thérapeutique |
| **Particularité multidisciplinaire** | Chaque module de complications DOIT mentionner le rôle du spécialiste d'organe (ophtalmologue, néphrologue, cardiologue, neurologue, podologue) |
| **Densité de quiz** | **10-15 questions par module** avec cas cliniques enchaînés, calculs de doses, ordonnances types — la formation Diabétologie vise un entraînement maximal |
| **Données de la littérature** | Études princeps obligatoires : DCCT/EDIC (DT1), UKPDS (DT2), ADVANCE, ACCORD, EMPA-REG OUTCOME, LEADER, DAPA-HF/CKD, CREDENCE, SUSTAIN, SURPASS, STENO-2, VADT |

## 6.3 Marqueurs médias — Codification Diabétologie

```
> [MEDIA: {EMOJI} MDIAB{module}-S{section}-{numéro} — {TITRE} ({INSTRUCTION_PÉDAGOGIQUE})]
```

- Préfixe **MDIAB** pour distinguer des médias des autres formations (M, MPTG, MIOA, MTEND, MOBO)
- Exemple : `MDIAB03-S02-005` = Formation DIAB, Module 3, Section 2, 5ème média

---

# 7. STRUCTURE DES FICHIERS DU CDC

Le présent cahier des charges est organisé en **12 fichiers** :

| # | Fichier | Contenu | Modules couverts |
|---|---|---|---|
| 0 | `CDC_DIAB_00_INTRODUCTION_CHARTE.md` | Introduction, charte graphique, code couleur, règles d'écriture | — |
| 1 | `CDC_DIAB_01_FONDAMENTAUX.md` | Embryologie, anatomie, physiologie, métabolisme glucidique | Modules 1-4 |
| 2 | `CDC_DIAB_02_PHYSIOPATHOLOGIE.md` | DT1, DT2, diabètes spécifiques, gestationnel | Modules 5-8 |
| 3 | `CDC_DIAB_03_DIAGNOSTIC_DEPISTAGE.md` | Diagnostic, dépistage, prédiabète, explorations biologiques | Modules 9-11 |
| 4 | `CDC_DIAB_04_CLINIQUE_FORMES.md` | Clinique DT1/DT2, complications aiguës, formes particulières | Modules 12-15 |
| 5 | `CDC_DIAB_05_COMPLICATIONS_MICROVASCULAIRES.md` | Rétinopathie, néphropathie, neuropathie | Modules 16-18 |
| 6 | `CDC_DIAB_06_COMPLICATIONS_MACROVASCULAIRES.md` | Cardiovasculaire, pied diabétique, autres complications | Modules 19-21 |
| 7 | `CDC_DIAB_07_TRAITEMENT_DT1.md` | Insulinothérapie, technologies, éducation thérapeutique | Modules 22-24 |
| 8 | `CDC_DIAB_08_TRAITEMENT_DT2.md` | MHD, ADO, injectables, insuline DT2, stratégie globale | Modules 25-29 |
| 9 | `CDC_DIAB_09_SITUATIONS_PARTICULIERES.md` | Grossesse, chirurgie, réanimation, sport | Modules 30-33 |
| 10 | `CDC_DIAB_10_RISQUE_CV_INNOVATIONS.md` | Risque CV, immunothérapie, thérapie cellulaire, IA | Modules 34-38 |
| 11 | `CDC_DIAB_11_ORGANISATION_EDUCATION.md` | Parcours de soins, ETP structurée | Modules 39-40 |

---

# 8. CORRESPONDANCE INTER-FORMATIONS

## 8.1 Modules partagés / transversaux

| Concept | Formation Scoliose | Formation PTG | Formation IOA | Formation Tendinites | Formation OBO | Formation DIAB | Type de partage |
|---|---|---|---|---|---|---|---|
| Syndrome métabolique | — | — | — | — | Modules 3-4 | Module 6 | Contenu partagé, angle DT2 |
| Obésité et DT2 | — | — | — | — | Modules 1-9 | Modules 6, 25, 31 | Renvoi croisé OBO ↔ DIAB |
| Chirurgie bariatrique | — | — | — | — | Module 9 | Module 31 | OBO = technique, DIAB = rémission DT2 |
| Infection (pied diabétique) | — | — | Modules 18-21 | — | — | Module 20 | Renvoi vers IOA pour ATB |
| Neuropathie/pied | — | — | — | Module 12 | Module 12 | Module 18, 20 | Spécificités diabétiques |
| Risque CV périopératoire | — | — | — | — | Modules 20-21 | Module 31 | Renvoi croisé |
| Rééducation/APA | Module 18 | Module 27 | Module 27 | Modules 18, 22 | Module 22 | Modules 25, 33 | Spécificités diabète |
| Insuffisance rénale | — | — | — | — | — | Module 17 | Exclusif DIAB (néphropathie) |
| Rétinopathie | — | — | — | — | — | Module 16 | Exclusif DIAB |
| Technologies CGM/pompe | — | — | — | — | — | Module 23 | Exclusif DIAB |

## 8.2 Simulation DiabSim© vs autres simulateurs

| Caractéristique | SpineSim© | KneeSim© | InfectoSim© | TendonSim© | ObesSim© | DiabSim© |
|---|---|---|---|---|---|---|
| **Focus principal** | Biomécanique rachis | Cinématique genou | Infection, biofilm | Charge tendineuse | Surcharge pondérale | Métabolisme glucidique |
| **Simulation unique** | Croissance, correction | Usure PE | Cinétique ATB | Courbe charge | Forces selon IMC | Cinétique glucose-insuline 24h |
| **Scénarios spécifiques** | Vis pédiculaires | Coupes, équilibrage | Choix ATB | Rééducation | Planification obèse | Ajustement doses, hypo/hyper, acidocétose |
| **Modèles** | FEM poutre | Cinématique | Pharmacocinétique | Biomécanique | Bioméca + métabo | Modèles compartimentaux glucose-insuline |
| **Moteur** | Julia + Three.js | Même stack | Même stack | Même stack | Même stack | Même stack + modèles métaboliques (Bergman, Dalla Man) |

---

# ANNEXE A — GLOSSAIRE DES ABRÉVIATIONS DIABÉTOLOGIE

| Abréviation | Signification |
|---|---|
| DIAB | Diabétologie |
| DT1 | Diabète de Type 1 |
| DT2 | Diabète de Type 2 |
| DG | Diabète Gestationnel |
| MODY | *Maturity-Onset Diabetes of the Young* |
| LADA | *Latent Autoimmune Diabetes in Adults* |
| HbA1c | Hémoglobine glyquée |
| GAJ | Glycémie à jeun |
| GPP | Glycémie postprandiale |
| HGPO | Hyperglycémie Provoquée par voie Orale |
| IFG | *Impaired Fasting Glucose* (hyperglycémie modérée à jeun) |
| IGT | *Impaired Glucose Tolerance* (intolérance au glucose) |
| Anti-GAD | Anticorps anti-glutamate décarboxylase |
| Anti-IA2 | Anticorps anti-tyrosine phosphatase |
| Anti-ZnT8 | Anticorps anti-transporteur de zinc 8 |
| ICA | *Islet Cell Antibodies* (anticorps anti-îlots) |
| HLA | *Human Leukocyte Antigen* (antigène leucocytaire humain) |
| GLP-1 | *Glucagon-Like Peptide-1* |
| GIP | *Glucose-dependent Insulinotropic Polypeptide* |
| DPP-4 | Dipeptidyl Peptidase-4 |
| SGLT2 | *Sodium-Glucose Cotransporter 2* |
| iSGLT2 | Inhibiteur du SGLT2 |
| iDPP-4 | Inhibiteur de la DPP-4 (gliptine) |
| aGLP-1 | Agoniste du récepteur du GLP-1 |
| iPCSK9 | Inhibiteur de la PCSK9 |
| KATP | Canal potassique ATP-dépendant |
| GLUT | *Glucose Transporter* (transporteur du glucose) |
| IRS | *Insulin Receptor Substrate* (substrat du récepteur de l'insuline) |
| PI3K | Phosphatidylinositol 3-kinase |
| AMPK | *AMP-activated Protein Kinase* |
| CGM | *Continuous Glucose Monitoring* (mesure continue du glucose) |
| FGM | *Flash Glucose Monitoring* (mesure flash du glucose) |
| CSII | *Continuous Subcutaneous Insulin Infusion* (pompe à insuline) |
| MDI | *Multiple Daily Injections* (injections multiples) |
| TIR | *Time In Range* (temps dans la cible, 70-180 mg/dL) |
| TBR | *Time Below Range* (temps en hypoglycémie) |
| TAR | *Time Above Range* (temps en hyperglycémie) |
| GMI | *Glucose Management Indicator* (indicateur de gestion du glucose) |
| AID | *Automated Insulin Delivery* (boucle fermée) |
| I/G | Ratio insuline/glucides |
| FSI | Facteur de Sensibilité à l'Insuline |
| IF | Insulinothérapie Fonctionnelle |
| ACD | Acidocétose Diabétique |
| SHH | Syndrome d'Hyperglycémie Hyperosmolaire |
| RD | Rétinopathie Diabétique |
| RDNP | Rétinopathie Diabétique Non Proliférante |
| RDP | Rétinopathie Diabétique Proliférante |
| EMD | Œdème Maculaire Diabétique |
| ETDRS | *Early Treatment Diabetic Retinopathy Study* |
| OCT | Tomographie par Cohérence Optique |
| VEGF | *Vascular Endothelial Growth Factor* |
| ND | Néphropathie Diabétique |
| DFG | Débit de Filtration Glomérulaire |
| DFGe | DFG estimé |
| RAC | Rapport Albumine/Créatinine (urinaire) |
| KDIGO | *Kidney Disease: Improving Global Outcomes* |
| IRC | Insuffisance Rénale Chronique |
| IRT | Insuffisance Rénale Terminale |
| AOMI | Artériopathie Oblitérante des Membres Inférieurs |
| AVC | Accident Vasculaire Cérébral |
| IC | Insuffisance Cardiaque |
| ICFEr | Insuffisance Cardiaque à Fraction d'Éjection réduite |
| IWGDF | *International Working Group on the Diabetic Foot* |
| NASH | *Non-Alcoholic Steatohepatitis* (stéatohépatite non alcoolique) |
| MAFLD | *Metabolic-Associated Fatty Liver Disease* |
| MASLD | *Metabolic-dysfunction Associated Steatotic Liver Disease* |
| ETP | Éducation Thérapeutique du Patient |
| ALD | Affection de Longue Durée |
| DPC | Développement Professionnel Continu |
| CME | *Continuing Medical Education* |
| HAS | Haute Autorité de Santé |
| ADA | *American Diabetes Association* |
| EASD | *European Association for the Study of Diabetes* |
| IDF | *International Diabetes Federation* |
| IADPSG | *International Association of Diabetes and Pregnancy Study Groups* |
| SFD | Société Francophone du Diabète |
| DCCT | *Diabetes Control and Complications Trial* |
| EDIC | *Epidemiology of Diabetes Interventions and Complications* |
| UKPDS | *United Kingdom Prospective Diabetes Study* |
| ADVANCE | *Action in Diabetes and Vascular Disease* |
| ACCORD | *Action to Control Cardiovascular Risk in Diabetes* |
| STENO-2 | Étude Steno-2 (traitement multifactoriel) |
| EMPA-REG | *Empagliflozin Cardiovascular Outcome Event Trial* |
| LEADER | *Liraglutide Effect and Action in Diabetes* |
| SUSTAIN | *Semaglutide Unabated Sustainability in Treatment of Type 2 Diabetes* |
| SURPASS | *Tirzepatide Clinical Trial Program* |
| DAPA-HF | *Dapagliflozin and Prevention of Adverse Outcomes in Heart Failure* |
| DAPA-CKD | *Dapagliflozin and Prevention of Adverse Outcomes in Chronic Kidney Disease* |
| CREDENCE | *Canagliflozin and Renal Events in Diabetes with Established Nephropathy* |
| EVA | Échelle Visuelle Analogique |
| IMC | Indice de Masse Corporelle |
| HTA | Hypertension Artérielle |
| LDL-c | LDL-cholestérol |
| HDL-c | HDL-cholestérol |
| TG | Triglycérides |
| PA | Pression Artérielle |
| ECG | Électrocardiogramme |
| ETT | Échocardiographie Trans-Thoracique |
| IPS | Index de Pression Systolique (cheville/bras) |
| EMG | Électromyogramme |
| IVSE | Intraveineux à la Seringue Électrique |
| RAAC | Récupération Améliorée Après Chirurgie |
| NNT | *Number Needed to Treat* |
| RR | Risque Relatif |
| HR | *Hazard Ratio* |
| OR | *Odds Ratio* |
| IC 95% | Intervalle de Confiance à 95% |

---

# RÉFÉRENCES

1. Slack JMW. Developmental biology of the pancreas. *Development*. 1995;121(6):1569-1580.
2. Jennings RE, Berry AA, Strutt JP, et al. Human pancreas development. *Development*. 2015;142(18):3126-3137. doi:10.1242/dev.120063
3. Drucker DJ. The biology of incretin hormones. *Cell Metab*. 2006;3(3):153-165. doi:10.1016/j.cmet.2006.01.004
4. Nauck MA, Meier JJ. Incretin hormones: Their role in health and disease. *Diabetes Obes Metab*. 2018;20(Suppl 1):5-21.
5. Atkinson MA, Eisenbarth GS, Michels AW. Type 1 diabetes. *Lancet*. 2014;383(9911):69-82. doi:10.1016/S0140-6736(13)60591-7
6. DeFronzo RA. From the triumvirate to the ominous octet: a new paradigm for the treatment of type 2 diabetes mellitus. *Diabetes*. 2009;58(4):773-795.
7. American Diabetes Association. Standards of Care in Diabetes — 2025. *Diabetes Care*. 2025;48(Suppl 1).
8. Davies MJ, Aroda VR, Collins BS, et al. Management of hyperglycaemia in type 2 diabetes, 2022. A consensus report by ADA and EASD. *Diabetologia*. 2022;65(12):1925-1966.
9. Nathan DM, DCCT/EDIC Research Group. The Diabetes Control and Complications Trial/Epidemiology of Diabetes Interventions and Complications Study at 30 years. *Diabetes Care*. 2014;37(1):9-16.
10. UK Prospective Diabetes Study (UKPDS) Group. Intensive blood-glucose control with sulphonylureas or insulin compared with conventional treatment and risk of complications in patients with type 2 diabetes (UKPDS 33). *Lancet*. 1998;352(9131):837-853.
11. Zinman B, Wanner C, Lachin JM, et al. Empagliflozin, cardiovascular outcomes, and mortality in type 2 diabetes (EMPA-REG OUTCOME). *N Engl J Med*. 2015;373(22):2117-2128.
12. Marso SP, Daniels GH, Tanaka K, et al. Liraglutide and cardiovascular outcomes in type 2 diabetes (LEADER). *N Engl J Med*. 2016;375(4):311-322.
13. Heerspink HJL, Stefánsson BV, Correa-Rotter R, et al. Dapagliflozin in patients with chronic kidney disease (DAPA-CKD). *N Engl J Med*. 2020;383(15):1436-1446.
14. Frías JP, Davies MJ, Rosenstock J, et al. Tirzepatide versus semaglutide once weekly in patients with type 2 diabetes (SURPASS-2). *N Engl J Med*. 2021;385(6):503-515.
15. Herold KC, Bundy BN, Long SA, et al. An anti-CD3 antibody, teplizumab, in relatives at risk for type 1 diabetes (TrialNet). *N Engl J Med*. 2019;381(7):603-613.

---

*Ce document (Partie 0) constitue le socle commun de la Formation Diabétologie Complète. Les parties suivantes (1 à 11) détaillent le contenu pédagogique module par module.*

*Document conforme à la charte VERTEX© — Version 1.0 — 13 mars 2026*
