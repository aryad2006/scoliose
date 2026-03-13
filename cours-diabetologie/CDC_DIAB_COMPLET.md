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
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 1 — Fondamentaux : Embryologie, Anatomie et Physiologie (Modules 1-4)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 1 : EMBRYOLOGIE DU PANCRÉAS — ORGANOGENÈSE, DIFFÉRENCIATION CELLULAIRE, ÎLOTS DE LANGERHANS

**Partie** : I — Fondamentaux
**Durée estimée** : 3h00
**Niveau** : Fondamental
**Prérequis** : Connaissances de base en biologie cellulaire et embryologie générale

## Accroche clinique

> 🏥 **Mise en situation** : Un couple consulte en diabétologie pédiatrique. Leur fils de 8 ans vient d'être diagnostiqué DT1. La mère, elle-même diabétique de type 1 depuis l'adolescence, demande : *« Pourquoi le pancréas de mon fils a-t-il cessé de fabriquer de l'insuline ? Est-ce que les cellules qui produisent l'insuline étaient normales au départ ? Et pourquoi seulement ces cellules-là sont détruites, pas les autres ? »* Pour répondre, le praticien doit comprendre comment le pancréas endocrine se forme pendant la vie embryonnaire, comment les cellules β se différencient et s'organisent en îlots — et pourquoi cette architecture unique les rend vulnérables à l'attaque auto-immune.

## Objectifs d'apprentissage

1. **Décrire** les étapes de l'organogenèse pancréatique (bourgeon dorsal et ventral, fusion, rotation duodénale) en référence aux travaux de Slack (*Development*, 1995) et Jennings et al. (*Development*, 2015)
2. **Expliquer** les mécanismes moléculaires de la différenciation des cellules endocrines (rôle de Pdx1, Ngn3, NeuroD1, Pax6, Nkx6.1) et leur implication dans les diabètes monogéniques (MODY4/Pdx1)
3. **Distinguer** les lignages cellulaires du pancréas exocrine (acini, canaux) et endocrine (α, β, δ, ε, PP) et expliquer leur organisation spatiale au sein des îlots de Langerhans
4. **Analyser** les conséquences des anomalies du développement pancréatique sur la fonction endocrine (agénésie pancréatique, pancréas annulaire, pancréas divisum)
5. **Relier** l'embryologie à la compréhension des thérapies régénératives (reprogrammation cellulaire, cellules souches, différenciation in vitro de cellules β)

## Structure du contenu

### Section 1.1 — Organogenèse pancréatique : des bourgeons endodermiques à l'organe fonctionnel

**Contenu obligatoire** :

Le module doit présenter le développement embryonnaire du pancréas en s'appuyant sur les données de l'embryologie classique et les apports récents de la biologie du développement :

- **Origine endodermique** : le module doit expliquer que le pancréas dérive de l'endoderme de la partie caudale de l'intestin antérieur (*foregut*), sous l'influence de signaux inducteurs provenant du mésoderme adjacent (notochorde, aorte dorsale) — le rôle de la signalisation FGF, Shh (inhibition), rétinoïque et Wnt doit être détaillé *(Slack, Development, 1995 ; Pan & Wright, Dev Dyn, 2011)*
- **Double bourgeon** : le module doit décrire l'apparition du bourgeon pancréatique dorsal (vers la 4ème semaine de développement chez l'humain, ~E26) et du bourgeon ventral (légèrement plus tardif), leur croissance dans le mésenchyme environnant, et la rotation du bourgeon ventral autour du duodénum (avec le cholédoque) pour fusionner avec le bourgeon dorsal — cette fusion explique l'anatomie définitive du pancréas (tête = bourgeon ventral principalement, corps et queue = bourgeon dorsal)
- **Chronologie** : le module doit présenter le calendrier du développement pancréatique humain — spécification endodermique (~S4), bourgeonnement (~S4-5), branchement et prolifération (~S6-8), différenciation endocrine (~S8-10), maturation des îlots (~S12-20), avec les données issues de Jennings et al. (*Development*, 2015)
- **Anomalies du développement** : le module doit aborder les malformations congénitales (pancréas annulaire, pancréas divisum, agénésie pancréatique) et leur lien avec des mutations de facteurs de transcription (Pdx1, Ptf1a) — pertinence clinique pour les diabètes néonataux

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB01-S01-001 | 🎬 ANIMATION | Développement embryonnaire du pancréas — séquence 3D montrant les bourgeons dorsal et ventral, la rotation duodénale et la fusion (Identifiez les deux bourgeons et suivez la rotation du bourgeon ventral) |
| MDIAB01-S01-002 | 📐 SCHÉMA | Coupe sagittale de l'embryon à S4-5 — signaux moléculaires de spécification pancréatique (Shh inhibé, FGF, acide rétinoïque) |
| MDIAB01-S01-003 | 📐 SCHÉMA | Anomalies du développement — pancréas annulaire et pancréas divisum (Identifiez le défaut de rotation/fusion responsable) |

### Section 1.2 — Différenciation des cellules endocrines : la cascade des facteurs de transcription

**Contenu obligatoire** :

- **Progéniteurs multipotents** : le module doit expliquer que les cellules progénitrices pancréatiques co-expriment Pdx1 et Ptf1a et sont capables de donner naissance aux trois lignages (exocrine acinaire, canalaire, endocrine) — les signaux de Notch (voie latérale inhibitrice) contrôlent l'allocation vers le lignage endocrine *(Apelqvist et al., Nature, 1999 ; Gu et al., Development, 2002)*
- **Cascade de transcription endocrine** : le module doit détailler la séquence Pdx1 → Ngn3 (neurogenin 3, marqueur du progéniteur endocrine) → NeuroD1 → Pax4/Arx (choix β/α) → Nkx6.1/MafA (maturation β) — chaque facteur de transcription doit être relié à son rôle fonctionnel et aux conséquences de sa mutation chez l'humain (ex. mutations Pdx1 = MODY4 ; mutations Ngn3 = déficit endocrine ; mutations NeuroD1 = MODY6)
- **Choix β vs α** : le module doit expliquer l'antagonisme Pax4 (progéniteur β/δ) vs Arx (progéniteur α/ε) — Pax4 réprime les gènes α, Arx réprime les gènes β, la balance entre ces deux facteurs détermine le ratio α/β dans l'îlot *(Collombat et al., J Clin Invest, 2007)*
- **Maturation fonctionnelle des cellules β** : le module doit décrire l'acquisition progressive de la compétence sécrétoire (expression de l'insuline, couplage glucose-sécrétion, maturation des granules) — la maturation n'est complète que tardivement (post-natal chez le rongeur, fin de gestation chez l'humain) — implication pour la néonatologie
- **Lien avec les thérapies régénératives** : le module doit expliquer comment la connaissance de cette cascade est utilisée pour guider la différenciation in vitro de cellules souches pluripotentes (iPSC) en cellules β fonctionnelles — protocoles de Pagliuca et al. (*Cell*, 2014) et Rezania et al. (*Nat Biotechnol*, 2014)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB01-S02-001 | 📐 SCHÉMA | Cascade des facteurs de transcription pancréatiques — de Pdx1 à MafA, avec branchements exocrine/endocrine/α/β |
| MDIAB01-S02-002 | 📊 INFOGRAPHIE | Correspondance facteurs de transcription ↔ diabètes monogéniques (MODY4, MODY6) — pertinence clinique directe |
| MDIAB01-S02-003 | 🎬 ANIMATION | Antagonisme Pax4/Arx — choix de destin cellulaire β vs α dans le progéniteur endocrine |

### Section 1.3 — Architecture et composition cellulaire des îlots de Langerhans

**Contenu obligatoire** :

- **Découverte historique** : le module doit mentionner la découverte par Paul Langerhans (thèse, Berlin, 1869) de ces « petits amas cellulaires » dans le pancréas, et l'identification ultérieure de leur rôle endocrine par Laguesse (1893) et la découverte de l'insuline par Banting et Best (1921-1922)
- **Organisation de l'îlot humain** : le module doit décrire la composition cellulaire de l'îlot de Langerhans humain — environ 1 million d'îlots par pancréas, chacun contenant 1 000 à 3 000 cellules, répartis en : cellules β (~50-60%, insuline), cellules α (~30-40%, glucagon), cellules δ (~5-10%, somatostatine), cellules PP (<5%, polypeptide pancréatique), cellules ε (<1%, ghréline) *(Cabrera et al., PNAS, 2006 ; Brissova et al., J Histochem Cytochem, 2005)*
- **Différences humain vs rongeur** : le module doit souligner que l'architecture de l'îlot diffère entre l'humain (distribution hétérogène, α et β entremêlées) et le rongeur (cœur de cellules β entouré d'un manteau de cellules α) — cette différence a des implications majeures pour la transposition des résultats précliniques *(Bosco et al., Diabetes, 2010)*
- **Vascularisation et innervation** : le module doit expliquer la vascularisation exceptionnellement dense des îlots (5-10× celle du tissu exocrine), le système porte intra-insulaire (flux β → α → δ qui explique la régulation paracrine) et l'innervation sympathique/parasympathique — pertinence pour la compréhension de la physiopathologie et la greffe d'îlots
- **Matrice extracellulaire et communication intercellulaire** : le module doit aborder les jonctions communicantes (connexines Cx36 entre cellules β), les signaux paracrines (insuline inhibe glucagon, somatostatine inhibe insuline et glucagon, glucagon stimule insuline) et l'importance de cette communication pour la pulsatilité de la sécrétion d'insuline

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB01-S03-001 | 📷 PHOTO | Immunofluorescence d'un îlot humain — marquage insuline (vert), glucagon (rouge), somatostatine (bleu) (Identifiez la distribution des trois types cellulaires et comparez avec l'îlot murin) |
| MDIAB01-S03-002 | 📐 SCHÉMA | Architecture comparée îlot humain vs murin — distribution cellulaire et flux sanguin |
| MDIAB01-S03-003 | 📐 SCHÉMA | Communication paracrine intra-îlot — insuline, glucagon, somatostatine : boucles de rétrocontrôle |
| MDIAB01-S03-004 | 🧊 MODÈLE 3D | Îlot de Langerhans en 3D — vascularisation, innervation, distribution cellulaire (DiabSim©) |

### Section 1.4 — Ontogenèse de la masse β-cellulaire et implications pour le diabète

**Contenu obligatoire** :

- **Croissance de la masse β-cellulaire** : le module doit décrire la dynamique de la masse β-cellulaire au cours de la vie — expansion rapide pendant la vie fœtale et néonatale (réplication), plateau à l'âge adulte, déclin progressif avec le vieillissement — la capacité de régénération β-cellulaire est très limitée chez l'adulte humain *(Meier et al., Diabetes, 2008 ; Gregg et al., J Clin Endocrinol Metab, 2012)*
- **Plasticité cellulaire** : le module doit présenter les données récentes sur la transdifférenciation α → β (Thorel et al., *Nature*, 2010) et la dédifférenciation β-cellulaire sous stress métabolique (Talchai et al., *Cell*, 2012) — concept de cellules β « dormantes » dans le DT2
- **Masse β-cellulaire et diabète** : le module doit relier la réduction de la masse β-cellulaire aux différents types de diabète — destruction >80-90% dans le DT1, réduction de ~30-50% dans le DT2 (avec dysfonction des cellules restantes), réduction congénitale dans les diabètes néonataux *(Butler et al., Diabetes, 2003)*
- **Implications thérapeutiques** : le module doit faire le lien entre ces données développementales et les approches régénératives actuelles — greffe d'îlots (protocole d'Edmonton, Shapiro et al., *N Engl J Med*, 2000), cellules souches (vertex/ViaCyte), encapsulation, reprogrammation in vivo

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB01-S04-001 | 📊 INFOGRAPHIE | Dynamique de la masse β-cellulaire au cours de la vie — courbe de croissance/plateau/déclin |
| MDIAB01-S04-002 | 📐 SCHÉMA | Mécanismes de perte β-cellulaire — DT1 (auto-immunité) vs DT2 (glucolipotoxicité + dédifférenciation) |

## Points clés

Le module doit permettre au praticien de retenir les messages essentiels suivants :

1. Le pancréas dérive de deux bourgeons endodermiques (dorsal et ventral) qui fusionnent après rotation du bourgeon ventral autour du duodénum
2. La différenciation endocrine est contrôlée par une cascade de facteurs de transcription (Pdx1 → Ngn3 → NeuroD1 → Pax4/Arx), dont les mutations causent des diabètes monogéniques (MODY)
3. L'îlot de Langerhans humain contient ~50-60% de cellules β (insuline), ~30-40% de cellules α (glucagon), et des cellules δ, PP et ε en proportions mineures
4. L'architecture de l'îlot humain diffère de celle du rongeur — prudence dans la transposition des résultats précliniques
5. La communication paracrine intra-îlot (insuline ⊣ glucagon, somatostatine ⊣ insuline et glucagon) est essentielle à l'homéostasie glycémique
6. La capacité de régénération β-cellulaire est très limitée chez l'adulte humain — fondement de l'approche par greffe et thérapie cellulaire
7. La masse β-cellulaire est réduite de >80% dans le DT1 (destruction auto-immune) et de ~30-50% dans le DT2 (avec dysfonction associée)

## Auto-évaluation — Module 1

### QCM (5 questions)

**QCM 1** 🥉 : Le bourgeon pancréatique ventral fusionne avec le bourgeon dorsal après :
- A) Migration à travers le mésentère dorsal
- B) Rotation autour du duodénum avec le cholédoque ✅
- C) Invagination dans le mésoderme splanchnique
- D) Résorption de la paroi duodénale ventrale
> *Feedback : Le bourgeon ventral effectue une rotation de 180° autour du duodénum, accompagnant le cholédoque. Cette rotation explique la position finale du canal de Wirsung (bourgeon ventral) qui draine la majeure partie du pancréas.*

**QCM 2** 🥉 : Quel facteur de transcription est considéré comme le marqueur du progéniteur endocrine pancréatique ?
- A) Pdx1
- B) Ptf1a
- C) Ngn3 (Neurogenin 3) ✅
- D) MafA
- E) Arx
> *Feedback : Ngn3 est le facteur de transcription obligatoire pour l'engagement vers le lignage endocrine. Son expression transitoire dans les progéniteurs canalaires marque le point de non-retour vers la différenciation endocrine. Les mutations de Ngn3 causent un déficit endocrine pancréatique sévère.*

**QCM 3** 🥈 : L'antagonisme Pax4/Arx détermine le choix de destin cellulaire dans l'îlot. Une perte de fonction de Pax4 entraîne :
- A) Une augmentation massive des cellules β au détriment des cellules α
- B) Une conversion des cellules β en cellules δ
- C) Une augmentation des cellules α et ε au détriment des cellules β et δ ✅
- D) Une agénésie complète du pancréas endocrine
> *Feedback : Pax4 est nécessaire à la spécification des lignages β et δ. En son absence, les progéniteurs endocrines s'orientent préférentiellement vers les lignages α (glucagon) et ε (ghréline), sous l'effet non contrebalancé d'Arx (Collombat et al., J Clin Invest, 2007).*

**QCM 4** 🥈 : La proportion de cellules β dans un îlot de Langerhans humain adulte normal est d'environ :
- A) 20-30%
- B) 50-60% ✅
- C) 70-80%
- D) >90%
> *Feedback : L'îlot humain contient environ 50-60% de cellules β, 30-40% de cellules α, et 5-10% de cellules δ (Cabrera et al., PNAS, 2006). Cette proportion est nettement inférieure à celle de l'îlot murin (~70-80% de cellules β), ce qui a des implications pour l'interprétation des modèles animaux.*

**QCM 5** 🥇 : Un nouveau-né présente un diabète néonatal permanent avec agénésie pancréatique. Quel facteur de transcription est le plus probablement muté ?
- A) Ngn3
- B) Arx
- C) Pdx1 (mutation homozygote) ✅
- D) MafA
- E) Pax6
> *Feedback : Les mutations homozygotes de Pdx1 causent une agénésie pancréatique (exocrine + endocrine) car Pdx1 est le facteur de transcription maître du développement pancréatique précoce. Les mutations hétérozygotes de Pdx1 causent un MODY4 (diabète modéré de l'adulte). Distinction fondamentale entre perte complète vs partielle de fonction.*

### Cas clinique court

> 🏥 **Cas — M. K., 28 ans**
> Diabète diagnostiqué à 24 ans, HbA1c 7,2%, pas d'acidocétose, père diabétique diagnostiqué à 30 ans, grand-mère paternelle diabétique. IMC 23 kg/m². Anti-GAD, anti-IA2, anti-ZnT8 négatifs. Peptide C normal.
>
> **Q1** 🥇 : Ce tableau est-il compatible avec un DT1, un DT2, ou un diabète monogénique (MODY) ? Justifiez en mobilisant vos connaissances sur les facteurs de transcription du développement pancréatique.
> *Réponse attendue : L'absence d'auto-anticorps, le peptide C conservé, l'hérédité autosomique dominante sur 3 générations, l'âge de survenue <35 ans et l'IMC normal orientent vers un MODY. Le praticien doit évoquer les gènes candidats (HNF1A/MODY3 le plus fréquent, GCK/MODY2, PDX1/MODY4, NEUROD1/MODY6) et prescrire un séquençage ciblé. Le lien avec l'embryologie est direct : ces gènes codent les facteurs de transcription de la cascade de différenciation β-cellulaire étudiée dans ce module.*
>
> **Q2** 🥈 : Pourquoi la connaissance de la cascade des facteurs de transcription est-elle importante pour le diagnostic génétique des MODY ?
> *Réponse attendue : Chaque facteur de transcription de la cascade (HNF4A → HNF1A → Pdx1 → Ngn3 → NeuroD1) est le gène responsable d'un sous-type de MODY. Connaître leur rôle dans le développement β-cellulaire permet de prédire le phénotype clinique : GCK/MODY2 = hyperglycémie modérée stable (capteur glucose altéré), HNF1A/MODY3 = diabète progressif sensible aux sulfamides (défaut de transcription des gènes du métabolisme glucidique β-cellulaire).*

### Question de synthèse

💎 **Question ouverte** : En quoi la compréhension de l'embryologie et de l'architecture des îlots de Langerhans éclaire-t-elle les stratégies actuelles de thérapie cellulaire du diabète de type 1 (greffe d'îlots, cellules souches, encapsulation) ? Développez en 8-10 lignes.
> *Éléments de réponse attendus : La connaissance de la cascade de différenciation (Pdx1 → Ngn3 → MafA) guide les protocoles de différenciation in vitro des iPSC en cellules β fonctionnelles. L'architecture de l'îlot (vascularisation dense, communication paracrine β-α-δ) explique pourquoi les cellules β isolées fonctionnent moins bien que les îlots intacts et justifie les approches de reconstitution d'îlots 3D (pseudo-îlots). La vascularisation dense explique la nécessité de la revascularisation après greffe (délai de 2-4 semaines). L'immunologie de la destruction β-cellulaire dans le DT1 explique le besoin d'immunosuppression post-greffe ou d'encapsulation pour protéger les cellules greffées.*

---

# MODULE 2 : ANATOMIE DU PANCRÉAS ENDOCRINE — MACRO ET MICROANATOMIE, VASCULARISATION, INNERVATION

**Partie** : I — Fondamentaux
**Durée estimée** : 3h00
**Niveau** : Fondamental
**Prérequis** : Module 1 (Embryologie)

## Accroche clinique

> 🏥 **Mise en situation** : Vous examinez un patient de 55 ans, ancien alcoolique sevré depuis 5 ans, qui développe un diabète avec stéatorrhée et amaigrissement. Le scanner abdominal révèle des calcifications pancréatiques diffuses, une atrophie parenchymateuse et une dilatation du canal de Wirsung. L'interne demande : *« Pourquoi la pancréatite chronique peut-elle causer un diabète ? Les îlots de Langerhans sont-ils dispersés uniformément dans le pancréas, ou certaines zones sont-elles plus riches ? Et pourquoi l'atteinte exocrine précède-t-elle souvent l'atteinte endocrine ? »*

## Objectifs d'apprentissage

1. **Décrire** la macroanatomie du pancréas (tête, col, corps, queue, processus unciné) et ses rapports anatomiques essentiels
2. **Localiser** la distribution des îlots de Langerhans dans le parenchyme pancréatique et expliquer les variations régionales (densité queue > tête, ratio α/β variable)
3. **Détailler** la vascularisation artérielle et veineuse du pancréas et le drainage portal — implications pour le métabolisme hépatique de l'insuline
4. **Expliquer** l'innervation autonome du pancréas (sympathique, parasympathique, peptidergique) et son rôle dans la régulation de la sécrétion d'insuline
5. **Analyser** les conséquences anatomiques des pathologies pancréatiques (pancréatite chronique, cancer, chirurgie) sur la fonction endocrine — concept de diabète de type 3c

## Structure du contenu

### Section 2.1 — Macroanatomie du pancréas : topographie et rapports

**Contenu obligatoire** :

Le module doit présenter l'anatomie macroscopique du pancréas dans un objectif de compréhension clinique (imagerie, chirurgie, physiopathologie des diabètes secondaires) :

- **Situation et morphologie** : organe rétropéritonéal, allongé transversalement en avant des gros vaisseaux (aorte, VCI), de L1 à L2, mesurant environ 15-20 cm de long, 60-100 g chez l'adulte. Le module doit décrire les 4 segments anatomiques (tête avec processus unciné, col/isthme, corps, queue) et leur orientation oblique vers le haut et la gauche
- **Rapports anatomiques essentiels** : le module doit détailler les rapports de la tête (cadre duodénal, cholédoque intra-pancréatique, artère mésentérique supérieure), du corps (estomac en avant, aorte et artère splénique en arrière) et de la queue (hile splénique) — pertinence pour l'interprétation de l'imagerie et la compréhension des complications chirurgicales
- **Canaux pancréatiques** : canal principal de Wirsung (bourgeon ventral fusionné) et canal accessoire de Santorini (bourgeon dorsal) — leur anatomie explique les variantes (pancréas divisum ~5-10% de la population) et les pathologies obstructives
- **Imagerie du pancréas normal** : le module doit présenter l'aspect normal du pancréas en échographie, scanner (TDM) et IRM/MRCP — critères de normalité, densité, rehaussement, calibre du Wirsung

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB02-S01-001 | 📐 SCHÉMA | Anatomie macroscopique du pancréas — vue antérieure avec segments, rapports et canaux |
| MDIAB02-S01-002 | 📷 PHOTO | TDM abdominale injectée — pancréas normal, identification des segments anatomiques |
| MDIAB02-S01-003 | 📐 SCHÉMA | Rapports anatomiques — coupe transversale passant par le corps du pancréas |

### Section 2.2 — Microanatomie du pancréas endocrine : îlots, capillaires et matrices

**Contenu obligatoire** :

- **Distribution des îlots** : le module doit expliquer que les îlots de Langerhans représentent seulement 1-2% de la masse pancréatique totale mais reçoivent 10-15% du débit sanguin pancréatique — cette disproportion vascularisation/masse reflète l'importance métabolique du compartiment endocrine. Le nombre d'îlots est estimé à environ 1 million chez l'adulte, avec une densité plus élevée dans la queue que dans la tête *(Wittingen & Frey, Anat Rec, 1974 ; In't Veld & Marichal, in Bentham, 2010)*
- **Variations régionales** : le module doit présenter les variations de composition cellulaire selon la localisation — les îlots de la tête sont plus riches en cellules PP, les îlots du corps et de la queue sont plus riches en cellules β — ces variations reflètent l'origine embryonnaire double (bourgeon ventral = tête, bourgeon dorsal = corps/queue)
- **Microvascularisation intra-insulaire** : le module doit décrire le réseau capillaire fenêtré dense des îlots, le système porte intra-insulaire avec un flux orienté du cœur (β) vers la périphérie (α, δ), permettant une régulation paracrine directe — l'insuline à forte concentration inhibe la sécrétion de glucagon *(Bonner-Weir & Orci, Diabetes, 1982)*
- **Matrice extracellulaire** : le module doit aborder la membrane basale péri-insulaire (collagène IV, laminine, fibronectine), son rôle de soutien et de signalisation, et son importance pour la greffe d'îlots (la destruction enzymatique de la matrice lors de l'isolement compromet la survie des îlots)
- **Histologie** : le module doit présenter les techniques d'identification histologique (coloration HE, immunohistochimie insuline/glucagon, immunofluorescence multi-marquage) et les aspects normaux vs pathologiques (insulite, amyloïdose insulaire dans le DT2)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB02-S02-001 | 📷 PHOTO | Coupe histologique pancréatique (HE) — identification d'un îlot au sein du tissu exocrine |
| MDIAB02-S02-002 | 📷 PHOTO | Immunohistochimie — marquage insuline (marron) montrant la distribution des cellules β dans un îlot |
| MDIAB02-S02-003 | 📐 SCHÉMA | Microvascularisation intra-insulaire — flux porte β → α → δ et régulation paracrine |

### Section 2.3 — Vascularisation et drainage portal : conséquences métaboliques

**Contenu obligatoire** :

- **Vascularisation artérielle** : le module doit décrire les artères du pancréas — artères pancréaticoduodénales (supérieure : branche du tronc cœliaque via la gastroduodénale ; inférieure : branche de la mésentérique supérieure) pour la tête, artère splénique (branches pancréatiques dorsale et magna) pour le corps et la queue — anastomoses riches entre les deux systèmes
- **Drainage veineux et système porte** : le module doit expliquer que le drainage veineux pancréatique se fait vers le système porte hépatique (veines pancréatiques → veine splénique → veine porte). Cette anatomie a une conséquence métabolique majeure : l'insuline sécrétée par les cellules β arrive en premier au foie, où ~50% est captée au premier passage hépatique — le foie « voit » des concentrations d'insuline 2 à 3 fois supérieures à celles de la circulation systémique. Ce gradient porto-systémique est perdu lors de l'insulinothérapie sous-cutanée (concentration systémique uniforme), ce qui a des implications pour la physiologie et la thérapeutique
- **Conséquences cliniques** : le module doit relier cette anatomie vasculaire à la pratique clinique — dosage du peptide C (non capté au premier passage, reflet de la sécrétion endogène) vs insulinémie (captation hépatique variable), insuline portale vs périphérique dans les stratégies thérapeutiques, perte du gradient porto-systémique dans le diabète pancréatique (type 3c)
- **Drainage lymphatique** : le module doit mentionner le drainage vers les ganglions pancréatiques, péri-aortiques et cœliaques — pertinence pour la diffusion de l'inflammation et la stadification tumorale

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB02-S03-001 | 📐 SCHÉMA | Vascularisation artérielle du pancréas — arcade pancréaticoduodénale et branches spléniques |
| MDIAB02-S03-002 | 📐 SCHÉMA | Drainage portal et premier passage hépatique de l'insuline — gradient porto-systémique |
| MDIAB02-S03-003 | 📊 INFOGRAPHIE | Comparaison insuline portale (endogène) vs insuline sous-cutanée (exogène) — concentrations hépatique et systémique |

### Section 2.4 — Innervation pancréatique et régulation neurale de la sécrétion

**Contenu obligatoire** :

- **Innervation parasympathique** : le module doit décrire le rôle du nerf vague (X) dans la stimulation de la sécrétion d'insuline — la phase céphalique de la sécrétion (avant même l'ingestion du repas) est médiée par l'acétylcholine qui agit sur les récepteurs muscariniques M3 des cellules β — cette innervation explique la sécrétion anticipatoire d'insuline et le concept de « phase céphalique »
- **Innervation sympathique** : le module doit expliquer que les fibres sympathiques (nerfs splanchniques, ganglions cœliaques) inhibent la sécrétion d'insuline et stimulent la sécrétion de glucagon via les récepteurs α2-adrénergiques (β) et β2-adrénergiques (α) — pertinence clinique : stress, exercice, hypoglycémie → réponse sympathique → ↑ glucagon, ↓ insuline → ↑ glycémie
- **Système nerveux intra-pancréatique** : le module doit aborder les neurones peptidergiques intra-pancréatiques (VIP, PACAP, galanine, NPY, GRP) et leur rôle modulateur sur la sécrétion d'insuline — complexité du « mini-cerveau » pancréatique
- **Neuropathie autonome diabétique** : le module doit faire le lien avec les conséquences de la neuropathie autonome sur la sécrétion d'insuline dans le DT2 avancé et la contre-régulation déficiente dans le DT1 (perte de la réponse glucagon et adrénergique à l'hypoglycémie = *hypoglycemia unawareness*)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB02-S04-001 | 📐 SCHÉMA | Innervation autonome du pancréas — parasympathique (vague) et sympathique (splanchniques) avec récepteurs |
| MDIAB02-S04-002 | 📊 INFOGRAPHIE | Effets de l'innervation autonome sur les cellules α et β — stimulation/inhibition selon le contexte métabolique |

## Points clés

1. Le pancréas est un organe rétropéritonéal de 60-100 g dont les îlots de Langerhans ne représentent que 1-2% de la masse mais reçoivent 10-15% du débit sanguin
2. La distribution des îlots est hétérogène : densité plus élevée dans la queue, composition cellulaire variable selon la région (PP enrichi dans la tête)
3. Le drainage veineux portal crée un gradient d'insulinémie porto-systémique (2-3×) avec ~50% de captation hépatique au premier passage — perdu lors de l'insulinothérapie sous-cutanée
4. Le peptide C n'est pas capté par le foie → marqueur fidèle de la sécrétion endogène d'insuline
5. L'innervation parasympathique (vague) stimule et la sympathique inhibe la sécrétion d'insuline — fondement de la phase céphalique et de la contre-régulation
6. Les pathologies pancréatiques destructrices (pancréatite chronique, cancer) causent un diabète de type 3c par destruction des îlots in situ

## Auto-évaluation — Module 2

### QCM

**QCM 1** 🥉 : Quelle proportion du débit sanguin pancréatique total est dirigée vers les îlots de Langerhans ?
- A) 1-2%
- B) 5-7%
- C) 10-15% ✅
- D) 25-30%
> *Feedback : Les îlots représentent 1-2% de la masse pancréatique mais reçoivent 10-15% du débit sanguin — cette disproportion vascularisation/masse reflète leur activité métabolique intense et leur rôle endocrine majeur.*

**QCM 2** 🥈 : Le gradient d'insulinémie porto-systémique signifie que :
- A) La concentration d'insuline est identique dans la veine porte et dans la circulation systémique
- B) La concentration d'insuline est 2-3× plus élevée dans la veine porte que dans la circulation systémique ✅
- C) Le glucagon est capté à 90% par le foie
- D) Le peptide C est capté à 50% par le foie
> *Feedback : Environ 50% de l'insuline sécrétée est captée au premier passage hépatique. Le foie « voit » donc des concentrations d'insuline 2-3× supérieures à celles mesurées en périphérie. Le peptide C (co-sécrété avec l'insuline) n'est PAS capté par le foie, ce qui en fait un marqueur fiable de la sécrétion endogène.*

**QCM 3** 🥈 : Quel nerf est responsable de la « phase céphalique » de la sécrétion d'insuline ?
- A) Le nerf grand splanchnique
- B) Le nerf vague (X) ✅
- C) Le nerf phrénique
- D) Le nerf récurrent laryngé
> *Feedback : Le nerf vague (X), composante parasympathique, stimule la sécrétion d'insuline via l'acétylcholine et les récepteurs muscariniques M3 des cellules β. La phase céphalique correspond à une sécrétion d'insuline anticipatoire déclenchée par la vue, l'odeur et le goût des aliments, avant même l'absorption glucidique.*

**QCM 4** 🥇 : Un patient de 50 ans avec pancréatite chronique calcifiante développe un diabète insulinorequérant. Ce diabète est classé :
- A) DT1
- B) DT2
- C) Diabète de type 3c (pancréatique) ✅
- D) LADA
> *Feedback : Le diabète de type 3c (ou diabète pancréatoprive) est causé par la destruction du parenchyme pancréatique (pancréatite chronique, cancer, hémochromatose, mucoviscidose, chirurgie). Il se distingue du DT1 (auto-immun) et du DT2 (insulinorésistance) par son étiologie et ses caractéristiques : atteinte combinée exocrine + endocrine, carence en glucagon (risque d'hypoglycémies sévères), élastase fécale basse.*

### Cas clinique court

> 🏥 **Cas — Mme L., 62 ans**
> Diabète diagnostiqué il y a 2 ans, HbA1c 8,5% sous metformine. Antécédent de pancréatectomie corporéo-caudale pour tumeur neuroendocrine il y a 3 ans. Poids stable, pas de stéatorrhée.
>
> **Q1** 🥇 : Pourquoi cette patiente est-elle plus susceptible de développer un diabète après chirurgie du corps et de la queue du pancréas plutôt que de la tête ? Mobilisez vos connaissances sur la distribution des îlots.
> *Réponse attendue : Les îlots de Langerhans sont plus denses dans la queue et le corps (bourgeon dorsal) que dans la tête (bourgeon ventral). La résection corporéo-caudale enlève donc proportionnellement plus d'îlots β-sécréteurs. De plus, les îlots de la tête sont plus riches en cellules PP et moins en cellules β. La perte de la masse β-cellulaire au-delà d'un seuil critique (~50%) déclenche le diabète.*
>
> **Q2** 🥈 : Le dosage du peptide C serait-il informatif chez cette patiente ? Justifiez.
> *Réponse attendue : Oui. Le peptide C reflète la sécrétion résiduelle d'insuline endogène (non capté par le foie, contrairement à l'insuline). Un peptide C bas confirmerait que le diabète est lié à la réduction de la masse β-cellulaire post-chirurgicale (diabète de type 3c) et orienterait vers une insulinothérapie plutôt que vers l'intensification des ADO.*

### Exercice de calcul

✏️ **Exercice** : Un patient diabétique sous insuline basale + bolus a une insulinémie mesurée à 45 mUI/L et un peptide C à 0,3 ng/mL (norme 0,8-3,5 ng/mL). L'insulinémie reflète-t-elle la sécrétion endogène ou l'insuline injectée ? Justifiez en utilisant vos connaissances sur le premier passage hépatique.
> *Réponse : Le peptide C très bas (0,3 ng/mL, bien en dessous de la norme) indique une sécrétion endogène d'insuline quasi nulle. L'insulinémie élevée (45 mUI/L) reflète donc exclusivement l'insuline exogène injectée en sous-cutané, qui n'est pas soumise au premier passage hépatique. Chez un sujet normal, l'insulinémie mesurée en périphérie sous-estime la sécrétion pancréatique d'un facteur 2-3 (captation hépatique ~50%), mais chez un patient sous insuline exogène, cette captation ne s'applique pas.*

---

# MODULE 3 : PHYSIOLOGIE DE LA SÉCRÉTION D'INSULINE ET DU GLUCAGON — COUPLAGE STIMULUS-SÉCRÉTION, INCRÉTINES

**Partie** : I — Fondamentaux
**Durée estimée** : 4h00
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 1-2

## Accroche clinique

> 🏥 **Mise en situation** : Un patient DT2 est traité par sulfamide hypoglycémiant (gliclazide). Il présente une hypoglycémie sévère à 2h du matin. Le médecin de garde l'interroge : *« Comment un médicament qui stimule la sécrétion d'insuline peut-il causer une hypoglycémie si le glucose sanguin est bas ? L'insuline ne devrait-elle pas s'arrêter de sortir quand la glycémie baisse ? »* Pour comprendre, il faut maîtriser le couplage glucose-sécrétion d'insuline, le rôle des canaux KATP — et comment les sulfamides court-circuitent ce couplage.

## Objectifs d'apprentissage

1. **Décrire** le mécanisme moléculaire du couplage stimulus-sécrétion dans la cellule β : entrée du glucose → glucokinase → métabolisme mitochondrial → ↑ ATP/ADP → fermeture canaux KATP → dépolarisation → influx Ca²⁺ → exocytose
2. **Expliquer** la cinétique biphasique de la sécrétion d'insuline (1ère phase rapide 5-10 min, 2ème phase prolongée) et sa perte précoce dans le DT2
3. **Détailler** le rôle des incrétines (GLP-1, GIP) dans la potentialisation glucose-dépendante de la sécrétion d'insuline — concept d'axe entéro-insulaire et d'effet incrétine
4. **Expliquer** la régulation de la sécrétion de glucagon par les cellules α et le rôle de la contre-régulation dans la prévention de l'hypoglycémie
5. **Relier** chaque cible physiologique à sa classe thérapeutique : glucokinase (activateurs GK), canaux KATP (sulfamides/glinides), incrétines (iDPP-4, aGLP-1), SGLT2 (iSGLT2)

## Structure du contenu

### Section 3.1 — Couplage stimulus-sécrétion dans la cellule β : le glucose comme signal métabolique

**Contenu obligatoire** :

Le module doit présenter en détail le mécanisme par lequel la cellule β « détecte » le glucose circulant et y répond par une sécrétion proportionnelle d'insuline — ce mécanisme est le fondement de l'homéostasie glycémique et sa compréhension est indispensable pour appréhender la pharmacologie des antidiabétiques :

- **Entrée du glucose** : le module doit expliquer que le glucose entre dans la cellule β via le transporteur GLUT1 (humain) / GLUT2 (rongeur), qui fonctionne comme un transporteur passif facilité à haute capacité et faible affinité — la concentration intracellulaire de glucose équilibre rapidement la concentration extracellulaire
- **Glucokinase — le « glucostat »** : le module doit détailler le rôle de la glucokinase (hexokinase IV) comme enzyme limitante et véritable « capteur de glucose » de la cellule β — son Km élevé (~8 mM, proche de la glycémie normale) et son absence d'inhibition par le produit (glucose-6-phosphate) lui confèrent une cinétique sigmoïdale idéale pour répondre aux variations physiologiques de glycémie *(Matschinsky, Diabetes, 2002)*. Les mutations de la glucokinase causent le MODY2/GCK-MODY (seuil glycémique relevé → hyperglycémie modérée) ou, en cas de mutation activatrice, un hyperinsulinisme congénital
- **Métabolisme mitochondrial et ratio ATP/ADP** : le module doit expliquer la chaîne métabolique — glycolyse → pyruvate → cycle de Krebs → phosphorylation oxydative → ↑ ratio ATP/ADP — c'est l'augmentation de ce ratio qui constitue le signal effecteur couplant le glucose à la sécrétion d'insuline
- **Canal KATP — la cible des sulfamides** : le module doit décrire le canal KATP (complexe octamérique Kir6.2/SUR1) : à l'état basal (glycémie basse, ATP bas), le canal est ouvert → flux sortant de K⁺ → membrane hyperpolarisée → cellule au repos. Quand le ratio ATP/ADP augmente, l'ATP se lie à Kir6.2, ferme le canal → dépolarisation membranaire → ouverture des canaux Ca²⁺ voltage-dépendants → influx de Ca²⁺ → exocytose des granules d'insuline. Les sulfamides hypoglycémiants (et les glinides) ferment ce canal indépendamment de l'ATP → sécrétion d'insuline même quand la glycémie est basse → risque d'hypoglycémie
- **Mutations du canal KATP** : le module doit mentionner les mutations de KCNJ11 (Kir6.2) et ABCC8 (SUR1) qui causent soit un diabète néonatal (mutations activatrices → canal bloqué ouvert → pas de sécrétion d'insuline, traitable par sulfamides à haute dose), soit un hyperinsulinisme congénital (mutations inactivatrices → canal bloqué fermé → sécrétion permanente d'insuline)
- **Exocytose** : le module doit expliquer le mécanisme d'exocytose des granules d'insuline (arrimage SNARE, fusion membranaire Ca²⁺-dépendante) et la maturation des granules (proinsuline → insuline + peptide C par clivage par les prohormone convertases PC1/3 et PC2)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB03-S01-001 | 🎬 ANIMATION | Couplage stimulus-sécrétion dans la cellule β — du glucose à l'exocytose de l'insuline, étape par étape (DiabSim©) |
| MDIAB03-S01-002 | 📐 SCHÉMA | Canal KATP (Kir6.2/SUR1) — structure, régulation par ATP et site de liaison des sulfamides |
| MDIAB03-S01-003 | 📐 SCHÉMA | Glucokinase comme « glucostat » — courbe de cinétique enzymatique et implications pour la détection du glucose |
| MDIAB03-S01-004 | 📊 INFOGRAPHIE | Correspondance mutations canal KATP ↔ phénotypes cliniques (diabète néonatal vs hyperinsulinisme) |

### Section 3.2 — Cinétique biphasique de la sécrétion d'insuline et sa perturbation dans le DT2

**Contenu obligatoire** :

- **Première phase (rapide)** : le module doit décrire la 1ère phase de sécrétion d'insuline — pic précoce survenant dans les 5-10 minutes suivant l'élévation glycémique, correspondant à l'exocytose du pool de granules « prêts à être libérés » (*readily releasable pool*, RRP), amarrés à la membrane. Cette phase est cruciale pour la suppression rapide de la production hépatique de glucose postprandiale
- **Deuxième phase (prolongée)** : le module doit expliquer que la 2ème phase (>10 min, pendant des heures) correspond au recrutement progressif de granules depuis le pool de réserve, avec néosynthèse d'insuline — cette phase est proportionnelle au stimulus glucidique et aux amplificateurs (incrétines, acides aminés, acides gras)
- **Perte de la 1ère phase dans le DT2** : le module doit souligner que la perte de la 1ère phase de sécrétion d'insuline est l'une des anomalies les plus précoces du DT2 — observable dès le stade de prédiabète (IGT), elle précède le diabète franc de plusieurs années *(Pratley & Weyer, Diabetologia, 2001)*. Cette perte contribue à l'hyperglycémie postprandiale et à la glucotoxicité secondaire
- **Pulsatilité** : le module doit mentionner la sécrétion pulsatile d'insuline (oscillations toutes les 5-15 min, « pulses » ultrarapides) et sa perte dans le DT2 — la sécrétion pulsatile est plus efficace pour supprimer la production hépatique de glucose que la sécrétion continue
- **Test au glucose intraveineux (IVGTT)** : le module doit présenter le principe du test IVGTT pour quantifier la 1ère phase de sécrétion (*acute insulin response*, AIR) — utilisé en recherche et dans le suivi des sujets à risque de DT1

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB03-S02-001 | 📊 INFOGRAPHIE | Cinétique biphasique de la sécrétion d'insuline — 1ère phase (RRP) et 2ème phase (pool de réserve) |
| MDIAB03-S02-002 | 📊 INFOGRAPHIE | Comparaison profil de sécrétion d'insuline : sujet normal vs IGT vs DT2 — perte progressive de la 1ère phase |
| MDIAB03-S02-003 | 🎬 ANIMATION | Sécrétion pulsatile d'insuline — oscillations 5-15 min et leur perte dans le DT2 (DiabSim©) |

### Section 3.3 — Axe entéro-insulaire et effet incrétine : GLP-1 et GIP

**Contenu obligatoire** :

- **Effet incrétine** : le module doit définir l'effet incrétine — le fait qu'une charge glucidique orale stimule 2 à 3 fois plus la sécrétion d'insuline qu'une charge glucidique intraveineuse produisant la même glycémie. Cet effet représente 50-70% de la sécrétion postprandiale d'insuline chez le sujet sain *(Nauck et al., J Clin Endocrinol Metab, 1986)*
- **GLP-1 (Glucagon-Like Peptide-1)** : le module doit détailler la biologie du GLP-1 — sécrétion par les cellules L de l'iléon et du côlon en réponse aux nutriments luminaux, effets multiples : potentialisation glucose-dépendante de la sécrétion d'insuline (→ pas d'hypoglycémie quand le glucose est normal), inhibition de la sécrétion de glucagon (glucose-dépendante aussi), ralentissement de la vidange gastrique, effet satiétogène central (hypothalamus), effet cardioprotecteur *(Drucker, Cell Metab, 2006)*
- **GIP (Glucose-dependent Insulinotropic Polypeptide)** : le module doit décrire le GIP — sécrétion par les cellules K du duodénum et du jéjunum, potentialisation de la sécrétion d'insuline, effet sur le métabolisme osseux et lipidique. Différence clé : le GIP stimule la sécrétion de glucagon (vs GLP-1 qui l'inhibe) — le tirzépatide (double agoniste GIP/GLP-1) exploite la synergie des deux voies
- **Déficit incrétine dans le DT2** : le module doit expliquer que l'effet incrétine est réduit de ~50% dans le DT2, principalement par résistance des cellules β au GIP (la réponse au GLP-1 est relativement préservée) *(Nauck et al., Diabetologia, 1986)*. Ce déficit a justifié le développement des thérapeutiques incrétinomimétiques
- **DPP-4 et dégradation** : le module doit expliquer que le GLP-1 natif a une demi-vie très courte (2-3 min) car il est rapidement dégradé par l'enzyme DPP-4 — d'où deux stratégies thérapeutiques : inhiber la DPP-4 (gliptines → iDPP-4) ou utiliser des analogues résistants à la DPP-4 (exénatide, liraglutide, sémaglutide, dulaglutide → agonistes GLP-1)
- **Axe cerveau-intestin-pancréas** : le module doit aborder les voies neurales et hormonales reliant l'intestin au pancréas — nerf vague, peptides entériques (CCK, sécrétine), et le concept de « senseurs métaboliques » intestinaux qui détectent les nutriments et transmettent l'information au pancréas et au cerveau

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB03-S03-001 | 📐 SCHÉMA | Effet incrétine — comparaison sécrétion d'insuline après charge orale vs IV à glycémies identiques |
| MDIAB03-S03-002 | 📐 SCHÉMA | GLP-1 : source (cellules L), effets multiples (pancréas, estomac, cerveau, cœur), dégradation par DPP-4 |
| MDIAB03-S03-003 | 📐 SCHÉMA | GIP vs GLP-1 — comparaison des effets et justification du double agonisme (tirzépatide) |
| MDIAB03-S03-004 | 📊 INFOGRAPHIE | Déficit de l'effet incrétine dans le DT2 — données Nauck et al. |

### Section 3.4 — Sécrétion de glucagon et contre-régulation glycémique

**Contenu obligatoire** :

- **Physiologie du glucagon** : le module doit décrire la sécrétion de glucagon par les cellules α — le glucagon est le principal hormone hyperglycémiante, stimulant la glycogénolyse et la néoglucogenèse hépatiques. Sa sécrétion est stimulée par l'hypoglycémie, les acides aminés, l'exercice et le système sympathique, et inhibée par l'hyperglycémie, l'insuline (régulation paracrine intra-îlot), la somatostatine et le GLP-1
- **Contre-régulation** : le module doit détailler les mécanismes de défense contre l'hypoglycémie — hiérarchie des réponses : ↓ insuline endogène (seuil ~80 mg/dL) → ↑ glucagon (seuil ~65-70 mg/dL) → ↑ adrénaline (seuil ~65-70 mg/dL) → cortisol + GH (seuil ~60 mg/dL) → symptômes neurogènes (seuil ~55-60 mg/dL) → symptômes neuroglycopéniques (<50 mg/dL) *(Cryer, J Clin Invest, 2006)*
- **Défauts de contre-régulation dans le DT1** : le module doit expliquer que les patients DT1 perdent progressivement la réponse glucagon à l'hypoglycémie (dans les 5 premières années) puis la réponse adrénergique (syndrome d'insensibilité à l'hypoglycémie, *hypoglycemia unawareness*) — ces défauts multiplient le risque d'hypoglycémie sévère par 25×. Le mécanisme implique la perte de l'inhibition paracrine par l'insuline intra-îlot (pas de « signal de levée de freinage » quand l'insuline basale vient de l'injection et non des cellules β voisines)
- **Hyperglucagonémie dans le DT2** : le module doit présenter le concept d'hyperglucagonémie paradoxale dans le DT2 — les cellules α deviennent résistantes au signal inhibiteur de l'insuline et de l'hyperglycémie → sécrétion inappropriée de glucagon → production hépatique de glucose excessive → hyperglycémie à jeun. Le glucagon est considéré comme le « partenaire oublié » de la physiopathologie du DT2 *(Unger & Cherrington, J Clin Invest, 2012)*

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB03-S04-001 | 📐 SCHÉMA | Hiérarchie de la contre-régulation glycémique — seuils de réponse et hormones impliquées |
| MDIAB03-S04-002 | 📊 INFOGRAPHIE | Comparaison réponse glucagon à l'hypoglycémie : sujet normal vs DT1 (<5 ans) vs DT1 (>5 ans) |
| MDIAB03-S04-003 | 📐 SCHÉMA | Hyperglucagonémie paradoxale dans le DT2 — cercle vicieux glucagon → production hépatique de glucose |

## Points clés

1. Le couplage stimulus-sécrétion dans la cellule β suit la séquence : glucose → GLUT → glucokinase → ↑ATP/ADP → fermeture canaux KATP → dépolarisation → Ca²⁺ → exocytose
2. La glucokinase est le véritable « glucostat » — ses mutations causent MODY2 (Km relevé) ou hyperinsulinisme congénital (Km abaissé)
3. Les sulfamides ferment les canaux KATP indépendamment du glucose → risque d'hypoglycémie (contrairement aux incrétines, glucose-dépendantes)
4. La perte de la 1ère phase de sécrétion d'insuline est l'anomalie la plus précoce du DT2
5. L'effet incrétine (GLP-1, GIP) représente 50-70% de la sécrétion postprandiale d'insuline et est réduit de ~50% dans le DT2
6. Le GLP-1 potentialise la sécrétion d'insuline de manière glucose-dépendante → pas d'hypoglycémie → fondement des aGLP-1 et iDPP-4
7. La perte progressive de la contre-régulation glucagon/adrénaline dans le DT1 explique le syndrome d'insensibilité à l'hypoglycémie

## Auto-évaluation — Module 3

### QCM

**QCM 1** 🥉 : Quelle enzyme est considérée comme le « capteur de glucose » de la cellule β ?
- A) Hexokinase I
- B) Glucokinase (Hexokinase IV) ✅
- C) Phosphofructokinase
- D) Pyruvate kinase
> *Feedback : La glucokinase (hexokinase IV) a un Km élevé (~8 mM) proche de la glycémie normale, n'est pas inhibée par son produit, et fonctionne comme un véritable « glucostat ». Elle est l'enzyme limitante du métabolisme glucidique dans la cellule β et dans l'hépatocyte.*

**QCM 2** 🥉 : L'effet incrétine explique quel pourcentage de la sécrétion postprandiale d'insuline chez le sujet sain ?
- A) 10-20%
- B) 30-40%
- C) 50-70% ✅
- D) >90%
> *Feedback : L'effet incrétine (GLP-1 + GIP) est responsable de 50-70% de la sécrétion d'insuline en réponse à un repas oral (Nauck et al., 1986). C'est un amplificateur majeur de la réponse sécrétoire, glucose-dépendant, qui est réduit dans le DT2.*

**QCM 3** 🥈 : Les sulfamides hypoglycémiants agissent en :
- A) Stimulant la sécrétion de GLP-1
- B) Inhibant la DPP-4
- C) Fermant les canaux KATP indépendamment du glucose ✅
- D) Activant la glucokinase
> *Feedback : Les sulfamides se lient au récepteur SUR1 du canal KATP et le ferment, indépendamment du ratio ATP/ADP et donc indépendamment de la glycémie. C'est pourquoi ils peuvent causer des hypoglycémies, contrairement aux incrétinomimétiques (dont l'effet est glucose-dépendant).*

**QCM 4** 🥈 : Quelle est la demi-vie du GLP-1 natif dans la circulation ?
- A) 2-3 minutes ✅
- B) 20-30 minutes
- C) 2-3 heures
- D) 12-24 heures
> *Feedback : Le GLP-1 natif a une demi-vie très courte (2-3 min) due à sa dégradation rapide par l'enzyme DPP-4. C'est pourquoi les agonistes GLP-1 thérapeutiques sont modifiés (acylation, PEGylation, fusion Fc) pour résister à la DPP-4 et avoir des demi-vies de quelques heures (exénatide) à plusieurs jours (sémaglutide, dulaglutide).*

**QCM 5** 🥇 : Un patient DT1 depuis 15 ans ne ressent plus les signes d'hypoglycémie. Quel est le mécanisme physiopathologique principal ?
- A) Neuropathie périphérique des extrémités
- B) Perte de la réponse glucagon puis de la réponse adrénergique à l'hypoglycémie ✅
- C) Adaptation centrale au glucose bas
- D) Absorption rapide de l'insuline injectée
> *Feedback : Le syndrome d'insensibilité à l'hypoglycémie (hypoglycemia unawareness) résulte de la perte séquentielle de la contre-régulation : d'abord la réponse glucagon (perte intra-îlot dans les premières années), puis la réponse adrénergique (par abaissement du seuil sympathique après hypoglycémies récurrentes). Le risque d'hypoglycémie sévère est multiplié par 25× (Cryer, 2006).*

### Cas clinique court

> 🏥 **Cas — M. B., 67 ans, DT2**
> DT2 depuis 12 ans. Traité par metformine 1g × 2/j + gliclazide LM 60 mg/j. HbA1c 7,8%. Se plaint d'épisodes d'hypoglycémie à jeun et avant les repas (glycémies capillaires 50-60 mg/dL avec sueurs, tremblements). Créatinine 115 µmol/L (DFGe 52 mL/min).
>
> **Q1** 🥈 : Expliquez le mécanisme des hypoglycémies sous gliclazide en utilisant vos connaissances sur le canal KATP.
> *Réponse : Le gliclazide (sulfamide) ferme les canaux KATP en se liant au SUR1, indépendamment du ratio ATP/ADP. Même quand la glycémie est basse (métabolisme glucidique réduit, ATP bas), le canal reste fermé → la cellule β sécrète de l'insuline de manière inappropriée → hypoglycémie. Le DFGe abaissé (52 mL/min) réduit l'élimination rénale du gliclazide et de ses métabolites actifs, prolongeant son effet et augmentant le risque d'hypoglycémie.*
>
> **Q2** 🥇 : Quelle alternative thérapeutique proposeriez-vous pour remplacer le gliclazide en tenant compte du profil rénal, et pourquoi cette alternative ne cause-t-elle pas d'hypoglycémie ?
> *Réponse : Un iDPP-4 (sitagliptine avec ajustement posologique à 50 mg/j pour DFGe 30-50 mL/min, ou linagliptine sans ajustement car élimination biliaire) ou un aGLP-1 (dulaglutide, utilisable jusqu'à DFGe 15 mL/min). Ces molécules potentialisent l'effet du GLP-1 endogène (iDPP-4) ou miment le GLP-1 (aGLP-1) — leur effet sur la sécrétion d'insuline est GLUCOSE-DÉPENDANT : quand la glycémie descend en dessous du seuil de stimulation, l'effet incrétine s'éteint spontanément → pas de sécrétion inappropriée d'insuline → pas d'hypoglycémie.*

---

# MODULE 4 : MÉTABOLISME GLUCIDIQUE INTÉGRÉ — FOIE, MUSCLE, TISSU ADIPEUX, CERVEAU

**Partie** : I — Fondamentaux
**Durée estimée** : 3h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Module 3

## Accroche clinique

> 🏥 **Mise en situation** : Un patient DT2 bien équilibré sous metformine présente des glycémies à jeun élevées (1,40 g/L) mais des glycémies postprandiales quasi normales (1,60 g/L à H+2). Son médecin s'interroge : *« D'où vient le sucre à jeun, puisqu'il n'a rien mangé depuis 12 heures ? Pourquoi le foie continue-t-il à fabriquer du glucose alors que la glycémie est déjà élevée ? Et pourquoi la metformine, qui n'agit pas sur le pancréas, fait-elle baisser la glycémie à jeun ? »*

## Objectifs d'apprentissage

1. **Expliquer** le rôle du foie dans l'homéostasie glucidique : glycogénolyse, néoglucogenèse, glycogénogenèse, régulation par l'insuline et le glucagon
2. **Décrire** le captage musculaire du glucose (GLUT4, contraction) et le rôle du muscle squelettique comme principal site de disposition du glucose postprandial
3. **Analyser** le rôle du tissu adipeux dans le métabolisme glucidique : lipolyse, acides gras libres, adipokines, lipotoxicité
4. **Expliquer** le rôle du cerveau comme organe glucose-dépendant et les mécanismes de détection centrale de la glycémie
5. **Intégrer** ces connaissances pour comprendre l'hyperglycémie à jeun (production hépatique) et postprandiale (captage périphérique) du DT2 et les cibles thérapeutiques correspondantes

## Structure du contenu

### Section 4.1 — Le foie : chef d'orchestre de la glycémie à jeun

**Contenu obligatoire** :

- **Production hépatique de glucose** : le module doit expliquer que le foie est la principale source de glucose endogène à jeun (~2 mg/kg/min), via deux voies : la glycogénolyse (prédominante dans les premières 6-8 heures de jeûne) et la néoglucogenèse (prédominante au-delà de 12-14 heures, à partir du lactate, de l'alanine, du glycérol et du pyruvate). L'insuline inhibe les deux voies (via la phosphorylation des enzymes clés : glycogène phosphorylase, PEPCK, G6Pase), tandis que le glucagon stimule les deux voies
- **Insulinorésistance hépatique dans le DT2** : le module doit détailler le mécanisme de l'hyperglycémie à jeun dans le DT2 — l'insulinorésistance hépatique fait que la production hépatique de glucose n'est pas correctement supprimée par l'insuline, malgré une hyperinsulinémie compensatrice. L'hyperglucagonémie paradoxale (cf. Module 3) aggrave cette production. Le foie « se comporte comme s'il était à jeun alors que l'organisme est en état nourri »
- **Cible de la metformine** : le module doit expliquer que la metformine réduit la production hépatique de glucose principalement en inhibant la néoglucogenèse (via l'activation de l'AMPK et l'inhibition du complexe I mitochondrial → ↑ AMP/ATP → ↓ néoglucogenèse) *(Foretz et al., J Clin Invest, 2010)* — c'est pourquoi elle est particulièrement efficace sur la glycémie à jeun
- **Glycogénogenèse postprandiale** : le module doit expliquer que le foie capte environ 30% du glucose absorbé en période postprandiale, le stockant sous forme de glycogène sous l'effet de l'insuline portale — le foie passe du mode « producteur » au mode « stockeur » sous l'effet du ratio insuline/glucagon élevé

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB04-S01-001 | 📐 SCHÉMA | Production hépatique de glucose — glycogénolyse et néoglucogenèse, régulation par insuline et glucagon |
| MDIAB04-S01-002 | 📊 INFOGRAPHIE | Sources de glucose selon la durée du jeûne — glycogénolyse dominante (0-8h) puis néoglucogenèse (>12h) |
| MDIAB04-S01-003 | 📐 SCHÉMA | Mécanisme d'action de la metformine — inhibition de la néoglucogenèse hépatique via AMPK |

### Section 4.2 — Le muscle squelettique : principal consommateur de glucose postprandial

**Contenu obligatoire** :

- **Captage musculaire du glucose** : le module doit expliquer que le muscle squelettique est responsable de ~75-80% du captage du glucose stimulé par l'insuline en période postprandiale. L'insuline provoque la translocation du transporteur GLUT4 depuis les vésicules intracellulaires vers la membrane plasmique, multipliant le captage par 10-20× *(Saltiel & Kahn, Nature, 2001)*
- **Voie de signalisation insulinique** : le module doit décrire la cascade de signalisation — liaison insuline au récepteur tyrosine kinase → autophosphorylation → recrutement IRS-1/2 → activation PI3K → Akt/PKB → translocation GLUT4 + activation glycogène synthase → captage et stockage du glucose
- **Contraction musculaire et GLUT4** : le module doit souligner que la contraction musculaire provoque aussi la translocation de GLUT4, par une voie indépendante de l'insuline (via l'AMPK et le calcium) — c'est le fondement de l'effet hypoglycémiant de l'exercice physique, même en cas d'insulinorésistance
- **Insulinorésistance musculaire dans le DT2** : le module doit expliquer que la réduction du captage musculaire du glucose (par accumulation intramyocellulaire de lipides, DAG, céramides, dysfonction mitochondriale) est un mécanisme central de l'hyperglycémie postprandiale dans le DT2 *(Shulman, J Clin Invest, 2000)*

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB04-S02-001 | 📐 SCHÉMA | Signalisation insulinique dans le myocyte — IRS → PI3K → Akt → translocation GLUT4 |
| MDIAB04-S02-002 | 📐 SCHÉMA | Double voie de translocation GLUT4 — insuline-dépendante vs contraction-dépendante (AMPK) |
| MDIAB04-S02-003 | 📊 INFOGRAPHIE | Disposition du glucose postprandial — répartition entre muscle (~75%), foie (~25%), et autres tissus |

### Section 4.3 — Le tissu adipeux : de la réserve énergétique à l'organe endocrine

**Contenu obligatoire** :

- **Rôle dans l'homéostasie glucidique** : le module doit expliquer que le tissu adipeux capte seulement ~5% du glucose postprandial mais joue un rôle majeur dans l'homéostasie glucidique via la régulation de la lipolyse — l'insuline inhibe la lipolyse (via l'inhibition de la lipase hormono-sensible), réduisant les AGL circulants. En cas d'insulinorésistance, la lipolyse reste active → excès d'AGL → lipotoxicité hépatique et musculaire → aggravation de l'insulinorésistance
- **Adipokines et métabolisme** : le module doit présenter les principales adipokines — leptine (signal de satiété, proportionnelle à la masse grasse, résistance à la leptine dans l'obésité), adiponectine (sensibilisateur à l'insuline, anti-inflammatoire, diminuée dans l'obésité et le DT2), TNF-α et IL-6 (pro-inflammatoires, contribuent à l'insulinorésistance), résistine, visfatine — référence croisée vers Formation OBO, Modules 3-4
- **Lipotoxicité** : le module doit expliquer le concept de lipotoxicité — l'excès d'AGL et leur stockage ectopique (foie → stéatose/NASH, muscle → insulinorésistance, pancréas → lipoapoptose β-cellulaire) constitue un mécanisme clé de la progression du DT2 *(Unger & Scherer, Trends Endocrinol Metab, 2010)*

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB04-S03-001 | 📐 SCHÉMA | Tissu adipeux comme organe endocrine — principales adipokines et leurs effets métaboliques |
| MDIAB04-S03-002 | 📐 SCHÉMA | Lipotoxicité — flux d'AGL du tissu adipeux vers le foie, le muscle et le pancréas en cas d'insulinorésistance |

### Section 4.4 — Le cerveau : organe glucose-dépendant et intégrateur central

**Contenu obligatoire** :

- **Dépendance au glucose** : le module doit expliquer que le cerveau consomme ~120 g de glucose/jour (soit ~60% de la consommation totale de glucose à jeun) et ne peut pas utiliser les acides gras comme substrat énergétique (les AG ne traversent pas la barrière hémato-encéphalique). Le transport du glucose dans les neurones se fait principalement via GLUT1 (barrière hémato-encéphalique) et GLUT3 (neurones), indépendants de l'insuline
- **Détection centrale de la glycémie** : le module doit décrire les neurones glucose-sensibles de l'hypothalamus (noyaux arqué et ventromédian) qui détectent les variations de glycémie et régulent la prise alimentaire, la dépense énergétique et la contre-régulation — le cerveau est un véritable « glucostat central »
- **Neuroglycopénie** : le module doit expliquer les conséquences de la privation glucidique cérébrale — symptômes neuroglycopéniques progressifs (trouble de la concentration, confusion, trouble du comportement, convulsions, coma) — fondement de l'urgence thérapeutique de l'hypoglycémie sévère
- **Corps cétoniques comme substrat alternatif** : le module doit mentionner que le cerveau peut utiliser les corps cétoniques (β-hydroxybutyrate, acétoacétate) comme substrat alternatif lors du jeûne prolongé ou de l'acidocétose — mais cette adaptation est lente et insuffisante en situation aiguë

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB04-S04-001 | 📊 INFOGRAPHIE | Consommation de glucose par organe — cerveau (~60% à jeun), muscle, foie, autres |
| MDIAB04-S04-002 | 📐 SCHÉMA | Transporteurs GLUT : GLUT1-4 — localisation, affinité, dépendance à l'insuline |

## Points clés

1. Le foie est la principale source de glucose à jeun (glycogénolyse puis néoglucogenèse) — l'insulinorésistance hépatique cause l'hyperglycémie à jeun du DT2
2. La metformine agit principalement en inhibant la néoglucogenèse hépatique (via AMPK) — d'où son efficacité sur la glycémie à jeun
3. Le muscle squelettique capte ~75-80% du glucose postprandial via GLUT4 (insulino-dépendant) — l'insulinorésistance musculaire cause l'hyperglycémie postprandiale
4. L'exercice physique provoque la translocation de GLUT4 par une voie indépendante de l'insuline (AMPK) — efficace même en cas d'insulinorésistance
5. Le tissu adipeux régule la glycémie via la lipolyse (AGL) et les adipokines — la lipotoxicité (stockage ectopique des lipides) aggrave l'insulinorésistance dans tous les tissus cibles
6. Le cerveau est glucose-dépendant (~120 g/j) et ne peut pas utiliser les acides gras — la neuroglycopénie est la base de l'urgence de l'hypoglycémie sévère

## Auto-évaluation — Module 4

### QCM

**QCM 1** 🥉 : Quel organe est responsable de la majorité du captage du glucose stimulé par l'insuline en période postprandiale ?
- A) Le foie
- B) Le cerveau
- C) Le muscle squelettique ✅
- D) Le tissu adipeux
> *Feedback : Le muscle squelettique est responsable de ~75-80% du captage du glucose stimulé par l'insuline en période postprandiale, via la translocation du transporteur GLUT4 à la membrane. Le tissu adipeux ne capte que ~5% du glucose postprandial.*

**QCM 2** 🥈 : La metformine réduit la glycémie à jeun principalement en :
- A) Stimulant la sécrétion d'insuline
- B) Inhibant l'absorption intestinale du glucose
- C) Réduisant la production hépatique de glucose (néoglucogenèse) ✅
- D) Augmentant l'excrétion rénale de glucose
> *Feedback : La metformine active l'AMPK hépatique et inhibe le complexe I mitochondrial, réduisant la néoglucogenèse hépatique. Elle ne stimule PAS la sécrétion d'insuline (pas d'hypoglycémie) et n'augmente PAS la glucosurie (c'est le mécanisme des iSGLT2).*

**QCM 3** 🥈 : L'exercice physique favorise le captage musculaire du glucose par une voie :
- A) Exclusivement insulino-dépendante (PI3K/Akt)
- B) Indépendante de l'insuline, via l'AMPK et le calcium ✅
- C) Dépendante du glucagon
- D) Médiée par le GLP-1
> *Feedback : La contraction musculaire provoque la translocation de GLUT4 via l'AMPK et le calcium intracellulaire, indépendamment de l'insuline. C'est pourquoi l'exercice physique est efficace pour réduire la glycémie même chez les patients DT2 insulinorésistants, et constitue un pilier du traitement.*

**QCM 4** 🥇 : Un patient DT2 a une glycémie à jeun à 1,60 g/L et une glycémie postprandiale (H+2) à 2,00 g/L. Quel(s) mécanisme(s) physiopathologique(s) explique(nt) respectivement l'hyperglycémie à jeun et postprandiale ?
- A) GAJ : ↑ production hépatique de glucose ; GPP : ↓ captage musculaire du glucose ✅
- B) GAJ : ↓ captage musculaire ; GPP : ↑ production hépatique
- C) GAJ et GPP : déficit de sécrétion d'insuline uniquement
- D) GAJ : ↑ absorption intestinale ; GPP : ↓ production hépatique
> *Feedback : L'hyperglycémie à jeun du DT2 est principalement causée par l'insulinorésistance hépatique (production hépatique de glucose non freinée) et l'hyperglucagonémie. L'hyperglycémie postprandiale est principalement causée par l'insulinorésistance musculaire (captage GLUT4 réduit) et le déficit incrétine. Cette distinction « hépatique à jeun / musculaire en postprandial » a des implications thérapeutiques directes.*

### Cas clinique court

> 🏥 **Cas — Mme F., 48 ans, DT2 récent**
> DT2 diagnostiqué il y a 3 mois. IMC 34 kg/m². HbA1c 7,5%. GAJ 1,35 g/L, GPP H+2 : 1,90 g/L. Mise sous metformine 500 mg × 2/j. À M+3 : GAJ 1,15 g/L, GPP H+2 : 1,75 g/L, HbA1c 7,0%.
>
> **Q1** 🥈 : Pourquoi la metformine a-t-elle davantage amélioré la GAJ (-0,20 g/L) que la GPP (-0,15 g/L) ?
> *Réponse : La metformine agit principalement sur la production hépatique de glucose (néoglucogenèse), qui est le déterminant majeur de la GAJ. Son effet sur le captage musculaire postprandial est modeste. Pour améliorer davantage la GPP, il faudrait cibler l'effet incrétine (iDPP-4 ou aGLP-1) ou la sécrétion d'insuline prandiale.*
>
> **Q2** 🥇 : Quels conseils d'activité physique donneriez-vous à cette patiente, et pourquoi l'exercice est-il efficace même en cas d'insulinorésistance ?
> *Réponse : Activité physique régulière (150 min/semaine d'intensité modérée, type marche rapide, vélo) + exercices de résistance (2×/semaine). L'exercice est efficace car la contraction musculaire provoque la translocation de GLUT4 par la voie AMPK/calcium, INDÉPENDANTE de l'insuline — elle « court-circuite » l'insulinorésistance. De plus, l'exercice améliore la sensibilité à l'insuline musculaire à long terme (↑ GLUT4, ↑ oxydation lipidique, ↓ lipides intramyocellulaires).*

### Question de synthèse

💎 **Question ouverte** : Construisez une « chaîne de raisonnement physiopathologique » reliant l'excès de tissu adipeux viscéral à l'hyperglycémie du DT2 en identifiant les mécanismes successifs au niveau du tissu adipeux, du foie, du muscle et du pancréas. Intégrez les concepts de lipotoxicité, d'insulinorésistance et de dysfonction β-cellulaire.
> *Éléments de réponse : Excès de tissu adipeux viscéral → ↑ lipolyse (insulinorésistance adipocytaire) → ↑ AGL circulants + adipokines pro-inflammatoires (TNF-α, IL-6) + ↓ adiponectine → (1) Foie : ↑ néoglucogenèse (stéatose, insulinorésistance hépatique) → hyperglycémie à jeun ; (2) Muscle : accumulation intramyocellulaire de lipides (DAG, céramides) → ↓ signalisation IRS/PI3K/Akt → ↓ translocation GLUT4 → hyperglycémie postprandiale ; (3) Pancréas : lipotoxicité β-cellulaire → ↓ sécrétion d'insuline + glucotoxicité secondaire → cercle vicieux glucolipotoxique → dysfonction β-cellulaire progressive → diabète franc. L'hyperglucagonémie paradoxale (cellules α résistantes à l'insuline) aggrave le tableau en maintenant la production hépatique de glucose.*

---

# RÉFÉRENCES — PARTIE 1 (Modules 1-4)

1. Slack JMW. Developmental biology of the pancreas. *Development*. 1995;121(6):1569-1580.
2. Jennings RE, Berry AA, Strutt JP, et al. Human pancreas development. *Development*. 2015;142(18):3126-3137.
3. Pan FC, Wright C. Pancreas organogenesis: from bud to plexus to gland. *Dev Dyn*. 2011;240(3):530-565.
4. Apelqvist Å, Li H, Sommer L, et al. Notch signalling controls pancreatic cell differentiation. *Nature*. 1999;400(6747):877-881.
5. Collombat P, Hecksher-Sørensen J, Krull J, et al. Embryonic endocrine pancreas and mature beta cells acquire alpha and PP cell phenotypes upon Arx misexpression. *J Clin Invest*. 2007;117(4):961-970.
6. Pagliuca FW, Millman JR, Gürtler M, et al. Generation of functional human pancreatic β cells in vitro. *Cell*. 2014;159(2):428-439.
7. Cabrera O, Berman DM, Kenyon NS, et al. The unique cytoarchitecture of human pancreatic islets has implications for islet cell function. *PNAS*. 2006;103(7):2334-2339.
8. Brissova M, Fowler MJ, Nicholson WE, et al. Assessment of human pancreatic islet architecture and composition by laser scanning confocal microscopy. *J Histochem Cytochem*. 2005;53(9):1087-1097.
9. Bosco D, Armanet M, Morel P, et al. Unique arrangement of alpha- and beta-cells in human islets of Langerhans. *Diabetes*. 2010;59(5):1202-1210.
10. Shapiro AMJ, Lakey JRT, Ryan EA, et al. Islet transplantation in seven patients with type 1 diabetes mellitus using a glucocorticoid-free immunosuppressive regimen. *N Engl J Med*. 2000;343(4):230-238.
11. Butler AE, Janson J, Bonner-Weir S, et al. Beta-cell deficit and increased beta-cell apoptosis in humans with type 2 diabetes. *Diabetes*. 2003;52(1):102-110.
12. Matschinsky FM. Regulation of pancreatic beta-cell glucokinase: from basics to therapeutics. *Diabetes*. 2002;51(Suppl 3):S394-S404.
13. Nauck M, Stöckmann F, Ebert R, Creutzfeldt W. Reduced incretin effect in type 2 (non-insulin-dependent) diabetes. *Diabetologia*. 1986;29(1):46-52.
14. Drucker DJ. The biology of incretin hormones. *Cell Metab*. 2006;3(3):153-165.
15. Nauck MA, Meier JJ. Incretin hormones: Their role in health and disease. *Diabetes Obes Metab*. 2018;20(Suppl 1):5-21.
16. Cryer PE. Mechanisms of sympathoadrenal failure and hypoglycemia in diabetes. *J Clin Invest*. 2006;116(6):1470-1473.
17. Unger RH, Cherrington AD. Glucagonocentric restructuring of diabetes: a pathophysiologic and therapeutic makeover. *J Clin Invest*. 2012;122(1):4-12.
18. Saltiel AR, Kahn CR. Insulin signalling and the regulation of glucose and lipid metabolism. *Nature*. 2001;414(6865):799-806.
19. Shulman GI. Cellular mechanisms of insulin resistance. *J Clin Invest*. 2000;106(2):171-176.
20. Foretz M, Hébrard S, Leclerc J, et al. Metformin inhibits hepatic gluconeogenesis in mice independently of the LKB1/AMPK pathway via a decrease in hepatic energy state. *J Clin Invest*. 2010;120(7):2355-2369.
21. DeFronzo RA. From the triumvirate to the ominous octet: a new paradigm for the treatment of type 2 diabetes mellitus. *Diabetes*. 2009;58(4):773-795.
22. Pratley RE, Weyer C. The role of impaired early insulin secretion in the pathogenesis of type II diabetes mellitus. *Diabetologia*. 2001;44(8):929-945.

---

*Partie 1 — Modules 1-4 — Document conforme à la charte VERTEX© — Version 1.0 — 13 mars 2026*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 2 — Physiopathologie du Diabète (Modules 5-8)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 5 : DIABÈTE DE TYPE 1 — AUTO-IMMUNITÉ, DESTRUCTION β-CELLULAIRE, STADES PRÉ-CLINIQUES

**Partie** : II — Physiopathologie
**Durée estimée** : 4h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 1-4

## Accroche clinique

> 🏥 **Mise en situation** : Une adolescente de 14 ans est amenée aux urgences en acidocétose inaugurale (glycémie 4,5 g/L, pH 7,12, bicarbonates 8 mmol/L, cétonurie +++). Après stabilisation, le bilan étiologique retrouve des anti-GAD à 250 UI/mL (N < 5) et des anti-IA2 positifs. Son frère jumeau monozygote, asymptomatique, est inquiet. Le diabétologue explique : *« Le DT1 est une maladie auto-immune qui a commencé des années avant l'acidocétose. Nous pouvons maintenant dépister les sujets à risque et peut-être même retarder l'apparition du diabète. »*

## Objectifs d'apprentissage

1. **Expliquer** les mécanismes de la destruction auto-immune des cellules β : présentation antigénique, lymphocytes T CD8+ cytotoxiques, rôle de l'insulite
2. **Décrire** les stades pré-cliniques du DT1 selon le modèle d'Eisenbarth/Insel (stades 1 à 3) et leur utilité pour le dépistage
3. **Identifier** les facteurs de prédisposition génétique (HLA DR3/DR4, CTLA-4, PTPN22, INS-VNTR) et leur poids relatif
4. **Analyser** les facteurs environnementaux déclencheurs (virus, alimentation, microbiote, vitamine D)
5. **Connaître** les stratégies de prévention (teplizumab) et le dépistage familial par auto-anticorps

## Structure du contenu

### Section 5.1 — Histoire naturelle du DT1 : de l'auto-immunité silencieuse à l'acidocétose

**Contenu obligatoire** :

Le module doit présenter l'histoire naturelle du DT1 comme un processus chronique se déroulant sur des mois à des années avant la manifestation clinique :

- **Modèle d'Eisenbarth (1986, révisé par Insel et al., 2015)** : le module doit décrire les 3 stades pré-cliniques selon la classification ADA/JDRF/Endocrine Society — Stade 1 : ≥ 2 auto-anticorps positifs, normoglycémie (risque de progression vers le DT1 clinique d'environ 44% à 5 ans et ~100% à vie) ; Stade 2 : ≥ 2 auto-anticorps + dysglycémie (IFG ou IGT, sans diabète franc) ; Stade 3 : diabète clinique (hyperglycémie symptomatique ou acidocétose) *(Insel et al., Diabetes Care, 2015)*
- **Cinétique de la destruction β-cellulaire** : le module doit expliquer que la destruction est progressive mais non linéaire — une « lune de miel » (rémission partielle avec besoins en insuline réduits) survient chez 60-80% des patients après le diagnostic, durant quelques semaines à 1-2 ans, correspondant à la sécrétion résiduelle des cellules β survivantes. La durée de cette rémission dépend de l'âge au diagnostic (plus courte chez l'enfant jeune) et de la masse β-cellulaire résiduelle
- **Insulite** : le module doit décrire l'infiltration inflammatoire des îlots (insulite) — prédominance de lymphocytes T CD8+ cytotoxiques, présence de CD4+, macrophages, cellules B. L'insulite est hétérogène (tous les îlots ne sont pas atteints simultanément) et les études du réseau nPOD (*Network for Pancreatic Organ Donors with Diabetes*) montrent que même au diagnostic, certains îlots contiennent encore des cellules β fonctionnelles *(Campbell-Thompson et al., Diabetologia, 2016)*
- **Auto-anticorps** : le module doit détailler les 4 auto-anticorps principaux — anti-GAD65 (glutamate décarboxylase 65), anti-IA2 (tyrosine phosphatase IA-2), anti-ZnT8 (transporteur de zinc 8), anti-insuline (IAA) — leur ordre d'apparition (IAA souvent premier chez l'enfant jeune, anti-GAD premier chez l'adulte), leur valeur prédictive (≥ 2 anticorps = risque très élevé), et la distinction avec les ICA (*Islet Cell Antibodies*, technique d'immunofluorescence historique)
- **Chronologie typique** : le module doit présenter une timeline illustrant les étapes — prédisposition génétique (naissance) → événement déclencheur (variable) → apparition du 1er auto-anticorps (mois à années avant le diagnostic) → séroconversion multiple → dysglycémie (stade 2) → diabète clinique (stade 3)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB05-S01-001 | 📊 INFOGRAPHIE | Modèle d'Eisenbarth/Insel — stades 1-3 du DT1 avec timeline, auto-anticorps et masse β-cellulaire |
| MDIAB05-S01-002 | 📷 PHOTO | Insulite — coupe histologique d'îlot avec infiltration lymphocytaire (immunohistochimie CD8) |
| MDIAB05-S01-003 | 📐 SCHÉMA | Les 4 auto-anticorps du DT1 — cibles antigéniques, chronologie d'apparition, valeur prédictive |

### Section 5.2 — Mécanismes immunologiques de la destruction β-cellulaire

**Contenu obligatoire** :

- **Présentation antigénique** : le module doit expliquer le mécanisme de rupture de tolérance — les autoantigènes β-cellulaires (insuline, GAD65, IA-2, ZnT8, chromogranine A, IGRP) sont présentés par les cellules dendritiques aux lymphocytes T dans les ganglions pancréatiques. Le HLA de classe II (DR3-DQ2, DR4-DQ8) détermine quels peptides sont efficacement présentés → certains haplotypes HLA favorisent la présentation d'autoantigènes β-cellulaires → susceptibilité au DT1
- **Lymphocytes T effecteurs** : le module doit décrire le rôle central des lymphocytes T CD8+ cytotoxiques qui reconnaissent les autoantigènes présentés par le HLA de classe I sur les cellules β et les détruisent par perforine/granzyme et Fas/FasL. Les lymphocytes T CD4+ helper de type Th1 produisent des cytokines pro-inflammatoires (IFN-γ, TNF-α, IL-1β) qui amplifient la réponse destructrice
- **Défaut de régulation** : le module doit expliquer le rôle du déficit relatif en lymphocytes T régulateurs (Treg, CD4+CD25+FoxP3+) dans le DT1 — la balance Teffecteurs/Treg est déplacée vers l'auto-immunité. Les polymorphismes de CTLA-4 et IL-2RA (CD25) modulent cette balance
- **Cytokines et apoptose β-cellulaire** : le module doit détailler les voies de mort cellulaire — IL-1β + IFN-γ + TNF-α activent les voies NF-κB et STAT-1 dans les cellules β → stress du réticulum endoplasmique → apoptose. Les cellules β sont particulièrement vulnérables car elles expriment peu de défenses antioxydantes *(Eizirik et al., Nat Rev Endocrinol, 2009)*

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB05-S02-001 | 📐 SCHÉMA | Mécanisme immunologique de la destruction β-cellulaire — présentation antigénique → CD8+ → apoptose |
| MDIAB05-S02-002 | 📐 SCHÉMA | Balance Teffecteurs/Treg — déséquilibre dans le DT1, cibles thérapeutiques (anti-CD3, IL-2 faible dose) |

### Section 5.3 — Prédisposition génétique : HLA et gènes non-HLA

**Contenu obligatoire** :

- **Gènes HLA (chromosome 6p21)** : le module doit expliquer que les gènes HLA de classe II représentent environ 40-50% de la susceptibilité génétique au DT1. Les haplotypes à haut risque sont DR3-DQ2 (DRB1*03:01-DQB1*02:01) et DR4-DQ8 (DRB1*04:01-DQB1*03:02) — l'hétérozygotie DR3/DR4 confère le risque le plus élevé (~5% de risque absolu vs 0,3% dans la population générale). À l'inverse, le HLA-DQB1*06:02 (DR15) est fortement protecteur *(Noble & Erlich, Diabetes, 2012)*
- **Concordance gémellaire** : le module doit présenter les données de concordance — ~50% chez les jumeaux monozygotes (vs ~6-8% chez les dizygotes), démontrant le poids de la génétique ET l'importance des facteurs environnementaux (si la génétique était seule, la concordance serait 100%)
- **Gènes non-HLA** : le module doit présenter les principaux gènes non-HLA de susceptibilité — INS-VNTR (variable number tandem repeat du gène de l'insuline, chromosome 11p15, ~10% de la susceptibilité), CTLA-4 (2q33, régulateur de l'activation T), PTPN22 (1p13, phosphatase modifiant le seuil d'activation T), IL-2RA/CD25 (10p15). Plus de 60 loci de susceptibilité identifiés par GWAS, mais chacun avec un effet modeste
- **Score de risque génétique (GRS)** : le module doit mentionner les scores de risque génétique combinant HLA et non-HLA, utilisés dans les programmes de dépistage (TEDDY, TrialNet, Fr1da)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB05-S03-001 | 📊 INFOGRAPHIE | Risque de DT1 selon le génotype HLA — DR3/DR4 hétérozygote = risque le plus élevé |
| MDIAB05-S03-002 | 📊 INFOGRAPHIE | Principaux gènes de susceptibilité au DT1 — HLA (~50%), INS-VNTR (~10%), non-HLA (~40%) |

### Section 5.4 — Facteurs environnementaux et prévention

**Contenu obligatoire** :

- **Facteurs viraux** : le module doit présenter l'hypothèse virale — les entérovirus (coxsackie B, en particulier CVB4) sont les candidats les plus étudiés, avec détection d'ARN entéroviral dans les îlots de patients DT1 *(Richardson et al., Diabetologia, 2009)*. Mécanismes proposés : mimétisme moléculaire, infection directe des cellules β, activation bystander. L'étude finlandaise DIPP et l'étude TEDDY apportent des données de cohorte prospective. Le vaccin anti-CVB est en développement (Provention Bio/PRV-101)
- **Alimentation et microbiote** : le module doit aborder les hypothèses nutritionnelles — introduction précoce du gluten (données controversées, étude BABYDIET négative), protéines du lait de vache (étude TRIGR négative pour la caséine mais question persistante), carence en vitamine D (association épidémiologique, méta-analyse Zipitis & Akobeng, *Arch Dis Child*, 2008), rôle du microbiote intestinal (dysbiose avec ↓ diversité et ↓ bactéries productrices de butyrate chez les sujets pré-DT1)
- **Hypothèse hygiéniste** : le module doit mentionner l'hypothèse hygiéniste — augmentation de l'incidence du DT1 dans les pays développés, gradient nord-sud, corrélation inverse avec les infections parasitaires
- **Teplizumab et prévention** : le module doit présenter les résultats de l'essai TrialNet TN-10 (Herold et al., *N Engl J Med*, 2019) — l'anti-CD3 monoclonal teplizumab (Tzield®) a retardé l'apparition du DT1 clinique de ~2 ans chez les apparentés au stade 2. Premier traitement approuvé (FDA, 2022) pour retarder le DT1 de stade 3 chez les sujets ≥ 8 ans au stade 2. Le module doit discuter les limites (coût, durée de l'effet, profil d'effets secondaires)
- **Programmes de dépistage** : le module doit décrire les programmes de screening familial par auto-anticorps (TrialNet, INNODIA, Fr1da en Bavière, ASK study au Colorado) et les critères d'inclusion — apparentés au 1er degré, dépistage par ≥ 2 auto-anticorps, suivi métabolique régulier

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB05-S04-001 | 📊 INFOGRAPHIE | Facteurs environnementaux du DT1 — virus, alimentation, microbiote, vitamine D |
| MDIAB05-S04-002 | 📊 INFOGRAPHIE | Essai TrialNet teplizumab — design, résultats (retard ~2 ans), implications cliniques |

## Points clés

1. Le DT1 est une maladie auto-immune chronique dont la destruction β-cellulaire débute des mois à des années avant le diagnostic clinique
2. Le modèle Eisenbarth/Insel définit 3 stades : stade 1 (≥ 2 auto-anticorps, normoglycémie), stade 2 (+ dysglycémie), stade 3 (diabète clinique)
3. Les 4 auto-anticorps clés sont : anti-GAD65, anti-IA2, anti-ZnT8, anti-insuline (IAA) — ≥ 2 positifs = risque très élevé
4. Le HLA de classe II (DR3/DR4) représente ~50% de la susceptibilité génétique — la concordance gémellaire monozygote n'est que de ~50%
5. Le teplizumab (anti-CD3) retarde l'apparition du DT1 de ~2 ans chez les sujets au stade 2 — premier traitement préventif approuvé
6. Les cellules β sont détruites par les lymphocytes T CD8+ cytotoxiques et les cytokines pro-inflammatoires (IL-1β, IFN-γ, TNF-α)

## Auto-évaluation — Module 5

**QCM 1** 🥉 : Combien d'auto-anticorps positifs faut-il pour définir le stade 1 du DT1 selon le modèle Eisenbarth/Insel ?
- A) ≥ 1
- B) ≥ 2 ✅
- C) ≥ 3
- D) Les 4
> *Feedback : Le stade 1 est défini par la présence de ≥ 2 auto-anticorps parmi anti-GAD, anti-IA2, anti-ZnT8, IAA, avec normoglycémie. Un seul auto-anticorps positif est associé à un risque plus faible et n'est pas classé comme stade 1.*

**QCM 2** 🥈 : L'hétérozygotie HLA DR3/DR4 confère un risque de DT1 d'environ :
- A) 0,3% (risque population générale)
- B) 1-2%
- C) 5% ✅
- D) 50%
> *Feedback : L'hétérozygotie DR3/DR4 confère le risque le plus élevé (~5% de risque absolu à vie vs 0,3% en population générale). Ce risque élevé s'explique par la formation d'un hétérodimère DQ trans-complémentaire (DQA1*05:01/DQB1*03:02) particulièrement efficace pour présenter les autoantigènes β-cellulaires.*

**QCM 3** 🥇 : Le teplizumab est un anticorps monoclonal dirigé contre :
- A) Le TNF-α
- B) Le CD20 des lymphocytes B
- C) Le CD3 des lymphocytes T ✅
- D) L'IL-6
> *Feedback : Le teplizumab est un anti-CD3 non mitogénique (humanisé FcR non-binding) qui module l'activité des lymphocytes T, induisant une anergie et une augmentation des Treg. L'essai TrialNet TN-10 (Herold et al., NEJM 2019) a montré un retard de ~2 ans dans la progression du stade 2 au stade 3 du DT1.*

**Cas clinique** : Le frère jumeau monozygote de la patiente de l'accroche est testé. Il a des anti-GAD positifs à 85 UI/mL et des anti-ZnT8 positifs. Sa glycémie à jeun est 0,95 g/L et son HGPO est normale. À quel stade se situe-t-il ? Quelle conduite tenir ?
> *Réponse : Stade 1 (≥ 2 auto-anticorps positifs, normoglycémie). CAT : (1) Suivi métabolique régulier (HGPO et HbA1c tous les 6 mois), (2) Discussion de l'inclusion dans un programme de suivi type TrialNet, (3) Discussion du teplizumab si progression vers le stade 2 (≥ 8 ans, approuvé FDA), (4) Information et éducation de la famille sur les signes d'alerte (polyurie, polydipsie, amaigrissement), (5) Pas d'insulinothérapie à ce stade. Le risque de progression vers le DT1 clinique est d'environ 44% à 5 ans et quasi 100% à vie.*

---

# MODULE 6 : DIABÈTE DE TYPE 2 — INSULINORÉSISTANCE, DYSFONCTION β-CELLULAIRE, GLUCOTOXICITÉ

**Partie** : II — Physiopathologie
**Durée estimée** : 4h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 1-4

## Accroche clinique

> 🏥 **Mise en situation** : M. D., 58 ans, IMC 32 kg/m², découverte fortuite d'un DT2 (GAJ 1,45 g/L, HbA1c 7,8%) lors d'un bilan de santé. Il demande : *« Mais docteur, je n'ai aucun symptôme ! Comment mon pancréas peut-il être malade si je suis en surpoids ? Ce n'est pas le sucre le problème, c'est la graisse ? »* Le praticien doit expliquer la double anomalie du DT2 : l'insulinorésistance (« la serrure est rouillée ») ET la dysfonction β-cellulaire (« la clé est usée ») — et pourquoi les deux sont nécessaires pour déclencher le diabète.

## Objectifs d'apprentissage

1. **Expliquer** le concept d'insulinorésistance : mécanismes moléculaires (défauts de signalisation IRS/PI3K/Akt), sites (foie, muscle, tissu adipeux), quantification (clamp euglycémique hyperinsulinémique, HOMA-IR)
2. **Décrire** la dysfonction progressive des cellules β dans le DT2 : perte de la 1ère phase, ↓ masse β-cellulaire, dédifférenciation, glucolipotoxicité
3. **Analyser** le rôle du « octet omineux » de DeFronzo (2009) : les 8 mécanismes physiopathologiques du DT2
4. **Comprendre** les concepts de glucotoxicité et lipotoxicité et leur contribution au cercle vicieux de la progression du DT2
5. **Relier** chaque mécanisme physiopathologique à sa cible thérapeutique

## Structure du contenu

### Section 6.1 — Insulinorésistance : mécanismes moléculaires et sites d'action

**Contenu obligatoire** :

- **Définition** : le module doit définir l'insulinorésistance comme une réponse biologique subnormale à une concentration donnée d'insuline — le terme désigne un défaut de signalisation post-récepteur, pas un défaut de sécrétion. L'insulinorésistance précède le DT2 de 10-20 ans et est fortement corrélée à l'obésité viscérale
- **Mécanismes moléculaires** : le module doit détailler les défauts de la cascade de signalisation insulinique — phosphorylation en sérine (inhibitrice) d'IRS-1 au lieu de tyrosine (activatrice), activation de kinases inhibitrices (JNK, IKKβ, PKC) par les AGL, les céramides, les DAG et les cytokines inflammatoires (TNF-α, IL-6) → ↓ PI3K/Akt → ↓ translocation GLUT4 (muscle) et ↓ suppression de la production hépatique de glucose *(Hotamisligil, Nature, 2006 ; Samuel & Shulman, Cell, 2012)*
- **Sites de l'insulinorésistance** : le module doit distinguer l'insulinorésistance hépatique (↑ production de glucose à jeun, ↑ VLDL), musculaire (↓ captage glucose postprandial, ↓ oxydation du glucose, ↓ glycogénogenèse) et adipocytaire (↑ lipolyse → ↑ AGL → lipotoxicité systémique). Le rein (↑ réabsorption de glucose), le cerveau (résistance à l'insuline et à la leptine) et l'intestin (microbiote altéré) sont aussi impliqués
- **Quantification** : le module doit présenter les méthodes de mesure — clamp euglycémique hyperinsulinémique (gold standard, DeFronzo et al., *Am J Physiol*, 1979), HOMA-IR (Matthews et al., *Diabetologia*, 1985 : HOMA-IR = insulinémie à jeun × GAJ / 22,5, en unités SI), indice QUICKI — limites et interprétation clinique

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB06-S01-001 | 📐 SCHÉMA | Défauts de signalisation insulinique dans l'insulinorésistance — IRS/PI3K/Akt et kinases inhibitrices |
| MDIAB06-S01-002 | 📐 SCHÉMA | Les 3 sites d'insulinorésistance — foie, muscle, tissu adipeux — conséquences métaboliques respectives |
| MDIAB06-S01-003 | 📊 INFOGRAPHIE | Méthodes de mesure de l'insulinorésistance — clamp, HOMA-IR, QUICKI |

### Section 6.2 — Dysfonction β-cellulaire progressive : de la compensation à l'épuisement

**Contenu obligatoire** :

- **Phase de compensation** : le module doit expliquer que les cellules β compensent initialement l'insulinorésistance par une hypersécrétion d'insuline (hyperinsulinisme compensatoire) — la glycémie reste normale tant que les cellules β maintiennent cette compensation. La capacité de compensation dépend de la masse β-cellulaire et de la fonction sécrétoire résiduelle
- **Décompensation et progression** : le module doit décrire la séquence de décompensation — perte de la 1ère phase de sécrétion d'insuline (anomalie la plus précoce, cf. Module 3) → IGT → DT2 → aggravation progressive. Au moment du diagnostic de DT2, environ 50% de la fonction β-cellulaire est déjà perdue (données UKPDS, *Diabetes*, 1995)
- **Mécanismes de la dysfonction β-cellulaire** : le module doit détailler la glucotoxicité (l'hyperglycémie chronique elle-même altère la fonction β-cellulaire → ↓ expression du gène de l'insuline, ↓ GLUT2, stress oxydatif), la lipotoxicité (les AGL en excès → ↓ sécrétion d'insuline, apoptose β-cellulaire), la glucolipotoxicité (synergie des deux), le stress du réticulum endoplasmique (surcharge en proinsuline), le dépôt d'amyloïde insulaire (IAPP/amyline, spécifique de l'humain — absent chez le rongeur), et la dédifférenciation β-cellulaire (perte d'identité, les cellules β cessent d'exprimer l'insuline mais ne meurent pas — concept de cellules β « dormantes », Talchai et al., *Cell*, 2012)
- **Réversibilité** : le module doit discuter la notion de réversibilité — les études de restriction calorique drastique (Taylor et al., *Lancet*, 2018 — étude DiRECT) et la chirurgie bariatrique montrent que le DT2 récent peut être mis en rémission, suggérant que la dysfonction β-cellulaire est partiellement réversible (dédifférenciation plutôt que mort cellulaire)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB06-S02-001 | 📊 INFOGRAPHIE | Courbe de Starling pancréatique — compensation → décompensation β-cellulaire au cours du DT2 |
| MDIAB06-S02-002 | 📐 SCHÉMA | Glucolipotoxicité — effets synergiques du glucose et des AGL sur la cellule β |
| MDIAB06-S02-003 | 📐 SCHÉMA | Dédifférenciation β-cellulaire — perte d'identité vs apoptose, concept de réversibilité |

### Section 6.3 — L'« octet omineux » de DeFronzo et le modèle intégré

**Contenu obligatoire** :

Le module doit présenter le concept de l'« ominous octet » de DeFronzo (*Diabetes*, 2009) — les 8 mécanismes physiopathologiques contribuant à l'hyperglycémie du DT2, chacun constituant une cible thérapeutique :

1. **Muscle** : ↓ captage du glucose (insulinorésistance musculaire) → cible : glitazones, exercice
2. **Foie** : ↑ production hépatique de glucose (néoglucogenèse excessive) → cible : metformine
3. **Cellule β** : dysfonction sécrétoire progressive → cible : sulfamides, glinides, aGLP-1, iDPP-4
4. **Cellule α** : hyperglucagonémie paradoxale → cible : aGLP-1, iDPP-4
5. **Tissu adipeux** : ↑ lipolyse → lipotoxicité → cible : glitazones, perte de poids
6. **Intestin** : déficit de l'effet incrétine → cible : aGLP-1, iDPP-4
7. **Rein** : ↑ réabsorption du glucose (seuil rénal élevé) → cible : iSGLT2
8. **Cerveau** : dysrégulation de l'appétit, résistance à l'insuline centrale → cible : aGLP-1 (effet satiétogène)

Le module doit souligner que le DT2 est une maladie multifactorielle et que le traitement optimal doit cibler plusieurs de ces mécanismes simultanément (justification de la polythérapie précoce).

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB06-S03-001 | 📊 INFOGRAPHIE | L'octet omineux de DeFronzo — 8 mécanismes physiopathologiques et leurs cibles thérapeutiques |
| MDIAB06-S03-002 | 📐 SCHÉMA | Correspondance mécanisme → classe thérapeutique — tableau synthétique |

### Section 6.4 — Facteurs de risque et prédisposition au DT2

**Contenu obligatoire** :

- **Facteurs non modifiables** : le module doit lister la prédisposition génétique (concordance gémellaire monozygote 60-90% pour le DT2, soit nettement plus que pour le DT1), l'âge (↑ incidence avec l'âge), l'ethnie (prévalence plus élevée chez les populations sud-asiatiques, africaines-américaines, hispaniques, amérindiennes, autochtones du Pacifique), les antécédents familiaux au 1er degré (risque × 2-3), le diabète gestationnel antérieur (risque × 7 de DT2 ultérieur), le petit poids de naissance (hypothèse de Barker — programmation fœtale)
- **Facteurs modifiables** : le module doit détailler l'obésité (surtout viscérale, risque × 3-7 selon le grade), la sédentarité (↓ captage musculaire GLUT4), l'alimentation (excès calorique, aliments ultra-transformés, index glycémique élevé, faible consommation de fibres), le tabac (↑ insulinorésistance), le stress chronique (cortisol), les troubles du sommeil (SAOS, privation de sommeil → insulinorésistance), certains médicaments (corticoïdes, antipsychotiques atypiques, statines à forte dose, immunosuppresseurs)
- **Gènes du DT2** : le module doit mentionner que plus de 400 loci de susceptibilité ont été identifiés par GWAS, chacun avec un effet modeste — les gènes les plus robustes incluent TCF7L2 (le plus fort, OR ~1,4, facteur de transcription Wnt), KCNJ11 (Kir6.2), SLC30A8 (ZnT8), PPARG (cible des glitazones), IRS1, FTO (obésité)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB06-S04-001 | 📊 INFOGRAPHIE | Facteurs de risque du DT2 — modifiables vs non modifiables, poids relatif |
| MDIAB06-S04-002 | 📐 SCHÉMA | Principaux gènes de susceptibilité au DT2 — TCF7L2, KCNJ11, PPARG, FTO |

## Points clés

1. Le DT2 résulte de la combinaison insulinorésistance + dysfonction β-cellulaire — l'un sans l'autre ne suffit pas à causer le diabète
2. L'insulinorésistance précède le DT2 de 10-20 ans et touche le foie, le muscle et le tissu adipeux
3. La fonction β-cellulaire décline progressivement — ~50% perdue au diagnostic (UKPDS)
4. L'« octet omineux » de DeFronzo identifie 8 mécanismes physiopathologiques, chacun cible d'une classe thérapeutique
5. La glucolipotoxicité crée un cercle vicieux d'aggravation progressive
6. La dédifférenciation β-cellulaire (vs apoptose) ouvre la perspective de réversibilité du DT2 (DiRECT, chirurgie bariatrique)
7. Le DT2 a une composante génétique forte (concordance monozygote 60-90%) mais les facteurs modifiables (obésité, sédentarité) sont déterminants

## Auto-évaluation — Module 6

**QCM 1** 🥉 : Le HOMA-IR se calcule par :
- A) Glycémie à jeun / insulinémie à jeun
- B) Insulinémie à jeun × glycémie à jeun / 22,5 ✅
- C) HbA1c × glycémie à jeun
- D) Peptide C / glycémie
> *Feedback : HOMA-IR = insulinémie à jeun (µU/mL) × glycémie à jeun (mmol/L) / 22,5. Un HOMA-IR élevé (>2,5-3) suggère une insulinorésistance. C'est une méthode simple et accessible en pratique courante, bien que moins précise que le clamp euglycémique.*

**QCM 2** 🥈 : Dans l'« octet omineux » de DeFronzo, quel organe est ciblé par les iSGLT2 ?
- A) Le foie
- B) Le pancréas
- C) Le rein ✅
- D) Le cerveau
> *Feedback : Les iSGLT2 ciblent le rein en inhibant la réabsorption du glucose dans le tubule proximal → glucosurie thérapeutique. Le rein fait partie de l'octet omineux car dans le DT2, le seuil rénal de glucose est anormalement élevé (↑ expression de SGLT2), ce qui contribue au maintien de l'hyperglycémie.*

**QCM 3** 🥇 : L'étude DiRECT (Taylor et al., 2018) a démontré que la rémission du DT2 est possible par :
- A) Insulinothérapie intensive précoce
- B) Restriction calorique drastique avec perte de poids significative ✅
- C) Exercice physique intense seul
- D) Combinaison metformine + aGLP-1
> *Feedback : L'étude DiRECT a montré que 46% des patients DT2 récent (<6 ans) obtenaient une rémission (HbA1c < 6,5% sans traitement) après un programme de restriction calorique (825-853 kcal/j pendant 12-20 semaines) suivi d'une réintroduction alimentaire progressive, avec perte de poids moyenne de 10 kg. Ce résultat soutient le concept de dédifférenciation réversible des cellules β.*

**Cas clinique** 💎 : M. D. (accroche) débute la metformine 1g/j. À 6 mois, HbA1c 7,2%. Son bilan montre : insulinémie à jeun 28 µU/mL (N 5-15), peptide C 3,8 ng/mL (N 0,8-3,5), TG 2,8 g/L, HDL-c 0,32 g/L, tour de taille 112 cm. Analysez ce profil en utilisant le concept de l'octet omineux et proposez un ajustement thérapeutique ciblant au moins 3 mécanismes différents.
> *Réponse : Le profil montre (1) hyperinsulinisme compensatoire (insulinémie 28, HOMA-IR élevé) = insulinorésistance majeure, (2) peptide C élevé = sécrétion β-cellulaire encore préservée mais insuffisante, (3) dyslipidémie athérogène (TG élevés, HDL bas) = lipotoxicité/stéatose, (4) obésité viscérale (tour de taille 112 cm). Ajustement ciblant ≥3 mécanismes : (a) ↑ metformine 2g/j (foie — néoglucogenèse), (b) + aGLP-1 (sémaglutide) = cellule β (potentialisation glucose-dépendante) + cellule α (↓ glucagon) + cerveau (satiété → perte de poids) + intestin (effet incrétine), (c) renforcement MHD + exercice physique (muscle — ↑ captage GLUT4 voie AMPK + tissu adipeux — ↓ lipolyse). Alternative : ajout d'un iSGLT2 (rein + perte de poids).*

---

# MODULE 7 : DIABÈTES SPÉCIFIQUES — MODY, LADA, MITOCHONDRIAL, PANCRÉATIQUE, MÉDICAMENTEUX

**Partie** : II — Physiopathologie
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 5-6

## Accroche clinique

> 🏥 **Mise en situation** : Un homme de 32 ans, IMC 22 kg/m², est adressé pour un diabète diagnostiqué il y a 2 ans, sous metformine avec contrôle médiocre (HbA1c 8,2%). Son père et sa grand-mère paternelle sont aussi diabétiques. Les auto-anticorps sont négatifs, le peptide C est normal. Le diabétologue suspecte un MODY et prescrit un séquençage génétique. Le résultat révèle une mutation du gène HNF1A. *« Ce n'est ni un type 1, ni un type 2 — c'est un MODY3. Et la bonne nouvelle, c'est que les sulfamides à faible dose fonctionnent très bien dans ce cas, mieux que la metformine. »*

## Objectifs d'apprentissage

1. **Classifier** les différents sous-types de MODY (1 à 14) et leurs caractéristiques cliniques distinctives
2. **Distinguer** le LADA du DT1 classique et du DT2 — critères diagnostiques et implications thérapeutiques
3. **Reconnaître** les diabètes mitochondriaux (MIDD : maternellement hérité avec surdité) et les syndromes génétiques rares
4. **Diagnostiquer** un diabète de type 3c (pancréatique) et en connaître les étiologies
5. **Identifier** les diabètes médicamenteux (corticoïdes, immunothérapie anti-PD1, antipsychotiques)

## Structure du contenu

### Section 7.1 — Diabètes monogéniques : MODY et diabètes néonataux

**Contenu obligatoire** :

Le module doit présenter les diabètes monogéniques comme un groupe de diabètes causés par la mutation d'un seul gène, représentant environ 1-5% de tous les diabètes (mais fréquemment méconnus et mal classés comme DT1 ou DT2) :

- **Critères évocateurs de MODY** : le module doit lister les éléments cliniques devant faire suspecter un MODY — diagnostic avant 25-35 ans, transmission autosomique dominante (≥ 3 générations), absence d'auto-anticorps, peptide C conservé, absence d'obésité, absence d'acidocétose (sauf rares exceptions), sensibilité aux sulfamides
- **MODY2/GCK-MODY** : le module doit détailler le plus fréquent en pédiatrie (~50% des MODY de l'enfant) — mutation de la glucokinase → seuil de détection du glucose relevé → hyperglycémie modérée stable (GAJ 1,10-1,40 g/L) sans progression, HbA1c 5,8-7,5% typiquement, pas de complications microvasculaires, PAS de traitement nécessaire sauf pendant la grossesse *(Stride et al., Diabetologia, 2002)*
- **MODY3/HNF1A-MODY** : le module doit détailler le plus fréquent chez l'adulte (~65% des MODY adultes) — mutation de HNF1A → défaut progressif de sécrétion d'insuline, glycosurie à seuil rénal bas (caractéristique), HbA1c progressive, complications microvasculaires possibles, excellente réponse aux sulfamides à faible dose (4× plus sensibles que les DT2) *(Pearson et al., Lancet, 2003)*
- **Autres MODY** : le module doit mentionner MODY1/HNF4A (similaire à MODY3, macrosomie fœtale, hyperinsulinisme néonatal transitoire), MODY4/PDX1, MODY5/HNF1B (+ anomalies rénales et génitales), MODY6/NEUROD1 — sans détailler les formes très rares (MODY7-14)
- **Diabètes néonataux** : le module doit distinguer le diabète néonatal permanent (DMNP, mutations KCNJ11, ABCC8, INS, PDX1) du diabète néonatal transitoire (DMNT, anomalies du chromosome 6q24) — l'importance du diagnostic génétique car les mutations de KCNJ11/ABCC8 permettent un passage de l'insuline aux sulfamides (Gloyn et al., *N Engl J Med*, 2004)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB07-S01-001 | 📊 INFOGRAPHIE | Arbre décisionnel diagnostique des MODY — critères cliniques + biologie + génétique |
| MDIAB07-S01-002 | 📊 INFOGRAPHIE | Comparaison MODY2/GCK vs MODY3/HNF1A — profil glycémique, évolution, traitement |

### Section 7.2 — LADA : le diabète auto-immun lent de l'adulte

**Contenu obligatoire** :

- **Définition et critères** : le module doit définir le LADA (*Latent Autoimmune Diabetes in Adults*) selon les critères de l'Immunology of Diabetes Society (2005) : (1) diagnostic après 30 ans, (2) présence d'au moins 1 auto-anticorps (anti-GAD le plus fréquent, 90%), (3) pas de besoin d'insuline dans les 6 premiers mois (distinction avec le DT1 classique). Le LADA représente environ 5-10% des « DT2 » — fréquemment méconnu
- **Physiopathologie** : le module doit expliquer que le LADA partage les mécanismes auto-immuns du DT1 mais avec une destruction β-cellulaire plus lente — la prédisposition HLA est similaire mais les titres d'auto-anticorps sont souvent plus bas et le processus destructeur moins agressif. Certains auteurs considèrent le LADA comme un DT1 à progression lente plutôt qu'une entité distincte
- **Pièges diagnostiques** : le module doit souligner que le LADA est souvent diagnostiqué comme DT2 (âge adulte, pas de cétose, réponse initiale aux ADO) → évolution vers l'insulinorequérance en 2-5 ans. Critères d'alerte chez un « DT2 » jeune et mince : penser LADA et doser les anti-GAD
- **Traitement** : le module doit discuter la controverse thérapeutique — éviter les sulfamides (accélèrent la destruction β-cellulaire ?), privilégier l'insuline précoce (préservation β-cellulaire), place des iDPP-4 et aGLP-1 (données limitées)

### Section 7.3 — Diabètes secondaires et médicamenteux

**Contenu obligatoire** :

- **Diabète de type 3c (pancréatique)** : le module doit détailler les étiologies — pancréatite chronique (cause la plus fréquente, 60-70%, surtout alcoolique et tropicale), cancer du pancréas (le diabète peut être un signe révélateur — *new-onset diabetes* > 50 ans = drapeau rouge), mucoviscidose (CFRD, *Cystic Fibrosis-Related Diabetes*, touchant 40-50% des adultes CF), hémochromatose (fer déposé dans les cellules β), pancréatectomie. Le module doit souligner les caractéristiques spécifiques : atteinte combinée exocrine + endocrine, déficit en glucagon (hypoglycémies sévères), carence en enzymes pancréatiques (malabsorption, carences vitaminiques)
- **Diabète cortico-induit** : le module doit expliquer le mécanisme (↑ néoglucogenèse hépatique, ↑ insulinorésistance musculaire et adipocytaire, ↓ sécrétion d'insuline) — profil glycémique caractéristique (hyperglycémie postprandiale prédominante, GAJ souvent subnormale si corticothérapie en dose unique matinale) — facteurs de risque (dose, durée, corticoïde utilisé, terrain prédisposant). Prise en charge : surveillance glycémique, insulinothérapie adaptée au profil glycémique
- **Diabète sous immunothérapie (anti-PD1/anti-PD-L1)** : le module doit présenter cette cause émergente et importante — les inhibiteurs de checkpoint immunitaire (nivolumab, pembrolizumab, atézolizumab) peuvent déclencher une insulite auto-immune fulminante avec acidocétose → diabète insulinodépendant définitif dans ~50% des cas. Incidence ~1%, mais urgence diagnostique et thérapeutique
- **Autres causes médicamenteuses** : le module doit mentionner les antipsychotiques atypiques (olanzapine, clozapine — prise de poids + effet direct sur la sécrétion d'insuline), les statines (↑ modeste du risque de DT2, ~9-12%), les inhibiteurs de calcineurine (tacrolimus > ciclosporine), les antiprotéases VIH

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB07-S03-001 | 📊 INFOGRAPHIE | Étiologies du diabète de type 3c — pancréatite chronique, cancer, mucoviscidose, hémochromatose |
| MDIAB07-S03-002 | 📐 SCHÉMA | Profil glycémique du diabète cortico-induit — prédominance postprandiale |

## Points clés et Auto-évaluation

**Points clés** :
1. Le MODY représente 1-5% des diabètes — suspecter devant : diabète avant 35 ans, hérédité AD, auto-anticorps négatifs, peptide C normal
2. MODY2/GCK = hyperglycémie modérée stable, pas de traitement ; MODY3/HNF1A = diabète progressif, sulfamides faible dose
3. Le LADA est un DT1 à progression lente de l'adulte — doser anti-GAD chez tout « DT2 » jeune et mince
4. Le diabète de type 3c = pathologie pancréatique exocrine → attention au déficit en glucagon (hypoglycémies)
5. Le diabète sous anti-PD1 est une urgence — insulite fulminante possible, irréversible dans ~50% des cas
6. Un *new-onset diabetes* > 50 ans sans facteurs de risque = penser cancer du pancréas (drapeau rouge)

**QCM rapides** :

**QCM 1** 🥈 : Un patient MODY3/HNF1A est mieux traité par :
- A) Metformine seule
- B) Sulfamides à faible dose ✅
- C) Insuline basale
- D) iSGLT2
> *Feedback : Les patients MODY3/HNF1A sont environ 4× plus sensibles aux sulfamides que les patients DT2, grâce au mécanisme spécifique de leur dysfonction β-cellulaire (Pearson et al., Lancet, 2003). La metformine est moins efficace car l'insulinorésistance n'est pas le mécanisme dominant.*

**QCM 2** 🥇 : Chez un patient de 55 ans sans antécédent, un diabète de découverte récente doit faire évoquer un cancer du pancréas quand :
- A) L'HbA1c est > 10%
- B) Le patient est obèse
- C) Le diabète survient sans facteur de risque classique, avec amaigrissement inexpliqué ✅
- D) Le patient a des antécédents familiaux de DT2
> *Feedback : Un « new-onset diabetes » > 50 ans sans obésité ni antécédents familiaux, surtout s'il s'accompagne d'un amaigrissement, de douleurs abdominales ou d'une altération de l'état général, doit faire rechercher un cancer du pancréas (scanner TAP). Le diabète peut précéder le diagnostic de cancer de 1-2 ans.*

---

# MODULE 8 : DIABÈTE GESTATIONNEL — PHYSIOPATHOLOGIE, DÉPISTAGE, PRISE EN CHARGE

**Partie** : II — Physiopathologie
**Durée estimée** : 3h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 5-6

## Accroche clinique

> 🏥 **Mise en situation** : Mme G., 34 ans, 2ème grossesse, IMC 29 kg/m², mère DT2. À 26 SA, l'HGPO 75 g montre : GAJ 0,98 g/L, H+1 2,05 g/L, H+2 1,65 g/L. Le gynécologue pose le diagnostic de diabète gestationnel. *« Est-ce que c'est dangereux pour le bébé ? Est-ce que ça va disparaître après l'accouchement ? Et est-ce que je vais devenir diabétique plus tard ? »*

## Objectifs d'apprentissage

1. **Expliquer** la physiopathologie du diabète gestationnel : insulinorésistance physiologique de la grossesse + défaut de compensation β-cellulaire
2. **Appliquer** les critères diagnostiques IADPSG/OMS 2013 et la stratégie de dépistage française (HAS 2011)
3. **Connaître** les complications materno-fœtales du DG non traité (macrosomie, pré-éclampsie, hypoglycémie néonatale)
4. **Prescrire** la prise en charge du DG (MHD, autosurveillance glycémique, insulinothérapie si échec)
5. **Organiser** le suivi post-partum (HGPO à 6-12 semaines, dépistage DT2 à vie)

## Structure du contenu

### Section 8.1 — Physiopathologie : insulinorésistance de la grossesse et décompensation

**Contenu obligatoire** :

- **Insulinorésistance physiologique** : le module doit expliquer que la grossesse normale s'accompagne d'une insulinorésistance progressive (2ème et 3ème trimestres) médiée par les hormones placentaires — hPL (*human Placental Lactogen*), progestérone, cortisol, prolactine, GH placentaire. Cette insulinorésistance est un mécanisme adaptatif qui favorise le transfert de glucose au fœtus. L'insulinosensibilité diminue de 50-70% au 3ème trimestre *(Catalano et al., Am J Obstet Gynecol, 1999)*
- **Compensation β-cellulaire** : le module doit expliquer que chez la femme enceinte non diabétique, les cellules β compensent par une hyperplasie (↑ masse β-cellulaire de ~40-50%) et une hypersécrétion d'insuline → la glycémie reste normale. Le DG survient quand cette compensation est insuffisante
- **Déterminants du DG** : le module doit détailler les facteurs de risque — obésité, âge > 35 ans, antécédent de DG, antécédent de macrosomie, antécédent familial de DT2 au 1er degré, syndrome des ovaires polykystiques, ethnie à risque. Le DG est un « test de stress » qui révèle une prédisposition sous-jacente au DT2

### Section 8.2 — Dépistage et diagnostic : critères IADPSG et stratégie française

**Contenu obligatoire** :

- **Stratégie de dépistage** : le module doit présenter la stratégie en deux temps recommandée par la HAS (2011) et le CNGOF — (1) GAJ au 1er trimestre chez les femmes à risque : si GAJ ≥ 0,92 g/L → DG diagnostiqué ; si GAJ ≥ 1,26 g/L → diabète préexistant méconnu ; (2) HGPO 75 g entre 24 et 28 SA chez les femmes à risque avec GAJ normale au 1er trimestre
- **Critères diagnostiques IADPSG** (Metzger et al., *Diabetes Care*, 2010) : le module doit présenter les seuils IADPSG pour l'HGPO 75 g — GAJ ≥ 0,92 g/L, ET/OU H+1 ≥ 1,80 g/L, ET/OU H+2 ≥ 1,53 g/L → une seule valeur atteinte suffit pour le diagnostic. Le module doit discuter la controverse sur l'abaissement des seuils et l'augmentation de la prévalence

### Section 8.3 — Complications et prise en charge

**Contenu obligatoire** :

- **Complications fœtales** : macrosomie (poids > 4 000 g ou > 90ème percentile), hyperinsulinisme fœtal (↑ insuline fœtale en réponse à l'hyperglycémie maternelle), dystocie des épaules, traumatisme obstétrical, hypoglycémie néonatale, détresse respiratoire, polyglobulie, hypocalcémie
- **Complications maternelles** : pré-éclampsie (risque × 1,5-2), césarienne (risque × 1,5-2), déchirure périnéale, risque de DT2 ultérieur (× 7 à 10 ans, ~50% à 20 ans)
- **Prise en charge** : le module doit détailler les mesures diététiques (régime fractionné 3 repas + 2-3 collations, 1 600-2 000 kcal/j, IG bas), l'autosurveillance glycémique (4-6 mesures/j, objectifs : GAJ < 0,95 g/L, H+2 postprandial < 1,20 g/L), l'insulinothérapie en cas d'échec des MHD (délai 1-2 semaines), les schémas insuliniques (insuline rapide prandiale ± basale), l'interdiction des ADO sauf metformine (off-label, données de sécurité croissantes — essai MiG)
- **Suivi post-partum** : HGPO 75 g à 6-12 semaines post-partum (reclassification : normale, IFG, IGT, DT2), puis dépistage annuel du DT2 à vie, encouragement à l'allaitement (↓ risque DT2 maternel)

## Points clés et Auto-évaluation

**Points clés** :
1. Le DG résulte d'un déséquilibre entre l'insulinorésistance physiologique de la grossesse et la capacité de compensation β-cellulaire
2. Critères IADPSG/HGPO 75 g : GAJ ≥ 0,92, H+1 ≥ 1,80, H+2 ≥ 1,53 g/L — une seule valeur suffit
3. La macrosomie est la complication fœtale principale — liée à l'hyperinsulinisme fœtal
4. Objectifs glycémiques : GAJ < 0,95 g/L, H+2 postprandial < 1,20 g/L
5. Risque de DT2 ultérieur × 7 — dépistage à vie obligatoire après un DG

**QCM 1** 🥉 : Le seuil de GAJ pour diagnostiquer un DG selon les critères IADPSG est :
- A) ≥ 1,10 g/L
- B) ≥ 1,00 g/L
- C) ≥ 0,92 g/L ✅
- D) ≥ 0,80 g/L
> *Feedback : Le seuil IADPSG pour la GAJ est ≥ 0,92 g/L (5,1 mmol/L). Ce seuil a été établi par l'étude HAPO (2008) comme correspondant à un OR de 1,75 pour la macrosomie. Si la GAJ est ≥ 1,26 g/L, c'est un diabète préexistant méconnu, pas un DG.*

**Cas clinique** 🥇 : Mme G. (accroche) est mise sous régime. À 30 SA, après 2 semaines de MHD, ses glycémies montrent : GAJ 0,88 g/L, mais H+2 postprandial systématiquement entre 1,30 et 1,50 g/L. L'échographie montre un périmètre abdominal fœtal > 90ème percentile. Quelle est votre conduite ?
> *Réponse : Les objectifs postprandiaux ne sont pas atteints (> 1,20 g/L) malgré les MHD, et la macrosomie est en cours (PA > 90ème percentile). CAT : (1) Introduction d'insuline rapide (analogue : lispro ou asparte) avant les repas où les GPP sont élevées, dose initiale 4-6 UI, titration selon les résultats, (2) Maintien du régime, (3) Surveillance glycémique renforcée (6 mesures/j), (4) Échographies de croissance rapprochées (tous les 15 jours), (5) Pas de sulfamides (non autorisés pendant la grossesse), (6) La metformine peut être discutée en alternative (off-label, données MiG trial) mais l'insuline reste le standard.*

---

# RÉFÉRENCES — PARTIE 2 (Modules 5-8)

1. Atkinson MA, Eisenbarth GS, Michels AW. Type 1 diabetes. *Lancet*. 2014;383(9911):69-82.
2. Insel RA, Dunne JL, Atkinson MA, et al. Staging presymptomatic type 1 diabetes: a scientific statement of JDRF, the Endocrine Society, and the ADA. *Diabetes Care*. 2015;38(10):1964-1974.
3. Herold KC, Bundy BN, Long SA, et al. An anti-CD3 antibody, teplizumab, in relatives at risk for type 1 diabetes. *N Engl J Med*. 2019;381(7):603-613.
4. Campbell-Thompson M, Fu A, Kaddis JS, et al. Insulitis and β-cell mass in the natural history of type 1 diabetes. *Diabetes*. 2016;65(3):719-731.
5. Noble JA, Erlich HA. Genetics of type 1 diabetes. *Cold Spring Harb Perspect Med*. 2012;2(1):a007732.
6. Eizirik DL, Colli ML, Ortis F. The role of inflammation in insulitis and β-cell loss in type 1 diabetes. *Nat Rev Endocrinol*. 2009;5(4):219-226.
7. Richardson SJ, Willcox A, Bone AJ, et al. The prevalence of enteroviral capsid protein VP1 immunostaining in pancreatic islets in human type 1 diabetes. *Diabetologia*. 2009;52(6):1143-1151.
8. DeFronzo RA. From the triumvirate to the ominous octet: a new paradigm for the treatment of type 2 diabetes mellitus. *Diabetes*. 2009;58(4):773-795.
9. Hotamisligil GS. Inflammation and metabolic disorders. *Nature*. 2006;444(7121):860-867.
10. Samuel VT, Shulman GI. Mechanisms for insulin resistance: common threads and missing links. *Cell*. 2012;148(5):852-871.
11. Talchai C, Xuan S, Lin HV, et al. Pancreatic β cell dedifferentiation as a mechanism of diabetic β cell failure. *Cell*. 2012;150(6):1223-1234.
12. Taylor R, Al-Mrabeh A, Zhyzhneuskaya S, et al. Remission of human type 2 diabetes requires decrease in liver and pancreas fat content but is dependent upon capacity for β cell recovery. *Cell Metab*. 2018;28(4):547-556.
13. Pearson ER, Starkey BJ, Powell RJ, et al. Genetic cause of hyperglycaemia and response to treatment in diabetes. *Lancet*. 2003;362(9392):1275-1281.
14. Stride A, Velho G, Kaski S, et al. The genetic abnormality in the beta cell determines the response to an oral glucose load. *Diabetologia*. 2002;45(3):427-435.
15. Gloyn AL, Pearson ER, Antcliff JF, et al. Activating mutations in the gene encoding the ATP-sensitive potassium-channel subunit Kir6.2 and permanent neonatal diabetes. *N Engl J Med*. 2004;350(18):1838-1849.
16. Catalano PM, Tyzbir ED, Wolfe RR, et al. Longitudinal changes in basal hepatic glucose production and suppression during insulin infusion in normal pregnant women. *Am J Obstet Gynecol*. 1999;180(4):903-916.
17. Metzger BE, Gabbe SG, Persson B, et al. International Association of Diabetes and Pregnancy Study Groups recommendations on the diagnosis and classification of hyperglycemia in pregnancy. *Diabetes Care*. 2010;33(3):676-682.
18. HAPO Study Cooperative Research Group. Hyperglycemia and adverse pregnancy outcomes. *N Engl J Med*. 2008;358(19):1991-2002.

---

*Partie 2 — Modules 5-8 — Document conforme à la charte VERTEX© — Version 1.0 — 13 mars 2026*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 3 — Diagnostic et Dépistage (Modules 9-11)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 9 : DIAGNOSTIC DU DIABÈTE — CRITÈRES OMS/ADA/HAS, GLYCÉMIE À JEUN, HGPO, HbA1c

**Partie** : III — Diagnostic et Dépistage
**Durée estimée** : 3h00
**Niveau** : Fondamental
**Prérequis** : Modules 5-6

## Accroche clinique

> 🏥 **Mise en situation** : Un homme de 52 ans consulte son médecin traitant pour une fatigue persistante. Le bilan biologique montre : GAJ 1,18 g/L. Le médecin hésite : *« Est-ce un diabète ? Un prédiabète ? Faut-il confirmer par une deuxième mesure, une HGPO ou une HbA1c ? Et si l'HbA1c est à 6,3%, est-ce que ça change le diagnostic ? »* Les critères diagnostiques du diabète semblent simples mais recèlent des pièges que tout praticien doit connaître.

## Objectifs d'apprentissage

1. **Appliquer** les critères diagnostiques du diabète selon l'OMS (2006/2011), l'ADA (2025) et la HAS : GAJ ≥ 1,26 g/L, HGPO H+2 ≥ 2,00 g/L, HbA1c ≥ 6,5%, glycémie aléatoire ≥ 2,00 g/L avec symptômes
2. **Distinguer** les situations nécessitant une confirmation (asymptomatique = 2 mesures) de celles ne la nécessitant pas (symptômes + glycémie ≥ 2,00 g/L)
3. **Identifier** les pièges diagnostiques : situations où l'HbA1c est non fiable (hémoglobinopathies, anémie, grossesse, IRC)
4. **Interpréter** une HGPO 75 g dans ses différentes indications (DG, prédiabète, diabètes monogéniques)
5. **Connaître** les zones grises diagnostiques et les diagnostics différentiels de l'hyperglycémie

## Structure du contenu

### Section 9.1 — Critères diagnostiques du diabète : les seuils fondamentaux

**Contenu obligatoire** :

Le module doit présenter les critères diagnostiques du diabète en s'appuyant sur les recommandations internationales actuelles :

- **Critères OMS/ADA** : le module doit présenter les 4 critères diagnostiques (un seul suffit, mais confirmation nécessaire si asymptomatique) :

| Critère | Seuil | Conditions | Confirmation |
|---|---|---|---|
| GAJ (*Fasting Plasma Glucose*) | ≥ 1,26 g/L (7,0 mmol/L) | Jeûne ≥ 8h, sang veineux | Oui (2ème mesure sur un autre jour) sauf si symptômes |
| HGPO 75 g, H+2 | ≥ 2,00 g/L (11,1 mmol/L) | Test standardisé (cf. §9.2) | Oui si asymptomatique |
| HbA1c | ≥ 6,5% (48 mmol/mol) | Méthode certifiée NGSP/DCCT | Oui si asymptomatique |
| Glycémie aléatoire | ≥ 2,00 g/L (11,1 mmol/L) | + symptômes cardinaux | Non — diagnostic posé |

*(adapté de ADA, Standards of Care in Diabetes, 2025 ; OMS, Definition and Diagnosis of Diabetes, 2006)*

- **Règle de la confirmation** : le module doit insister sur le fait qu'en l'absence de symptômes cardinaux (polyurie, polydipsie, amaigrissement) ou de décompensation métabolique (acidocétose, SHH), le diagnostic nécessite DEUX mesures anormales sur DEUX jours différents (même critère ou critères différents). Si deux critères sont discordants (ex. GAJ diabétique mais HbA1c non diabétique), le critère positif doit être recontrôlé
- **Symptômes cardinaux** : le module doit décrire les symptômes classiques — polyurie osmotique (seuil rénal ~1,80 g/L), polydipsie compensatrice, amaigrissement (catabolisme protéique et lipidique, surtout DT1), polyphagie, vision trouble (variation osmotique cristallinienne), infections récurrentes (mycoses, infections urinaires). La présence de symptômes + glycémie ≥ 2,00 g/L suffit au diagnostic sans confirmation
- **Distinction GAJ capillaire vs veineuse** : le module doit souligner que le diagnostic repose sur la glycémie veineuse plasmatique (et non capillaire). La glycémie capillaire (lecteur de glycémie) est un outil de surveillance, pas de diagnostic (variabilité ±15%)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB09-S01-001 | 📊 INFOGRAPHIE | Algorithme diagnostique du diabète — arbre décisionnel GAJ / HbA1c / HGPO / symptômes |
| MDIAB09-S01-002 | 📊 INFOGRAPHIE | Les 4 critères diagnostiques en un tableau — seuils, conditions, confirmation |

### Section 9.2 — L'HGPO 75 g : technique, interprétation et indications

**Contenu obligatoire** :

- **Technique standardisée** : le module doit décrire la procédure de l'HGPO 75 g selon les recommandations OMS — jeûne de 8-14h, alimentation non restrictive les 3 jours précédents (≥ 150 g de glucides/j), repos pendant le test, pas de tabac, prélèvements veineux à T0 et T+120 min après ingestion de 75 g de glucose anhydre dissous dans 250-300 mL d'eau, ingestion en 5 min
- **Interprétation des résultats** :

| Catégorie | GAJ (T0) | H+2 (T120) |
|---|---|---|
| Normal | < 1,10 g/L | < 1,40 g/L |
| IFG (*Impaired Fasting Glucose*) | 1,10 - 1,25 g/L | < 1,40 g/L |
| IGT (*Impaired Glucose Tolerance*) | < 1,26 g/L | 1,40 - 1,99 g/L |
| Diabète | ≥ 1,26 g/L | ≥ 2,00 g/L |

*(adapté de OMS, Definition and Diagnosis of Diabetes, 2006)*

- **Indications** : le module doit préciser que l'HGPO n'est pas systématique en routine mais est indiquée dans : (1) dépistage du DG (HGPO 75 g, critères IADPSG — cf. Module 8), (2) confirmation diagnostique quand GAJ et HbA1c sont discordantes ou en zone grise, (3) diagnostic des MODY (profil glycémique post-charge), (4) dépistage de l'IGT (non détectable par GAJ ni HbA1c), (5) suivi des sujets à risque (stade 2 du DT1 pré-clinique)
- **Note ADA** : le module doit mentionner que l'ADA accepte la GAJ seule OU l'HbA1c seule comme tests de dépistage de première intention chez l'adulte, et ne recommande l'HGPO qu'en 2ème intention ou pour le DG

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB09-S02-001 | 📐 SCHÉMA | Courbe glycémique HGPO — profils normal, IFG, IGT et diabétique superposés |
| MDIAB09-S02-002 | 📐 SCHÉMA | Technique de l'HGPO 75 g — protocole standardisé étape par étape |

### Section 9.3 — L'HbA1c : atouts, limites et pièges diagnostiques

**Contenu obligatoire** :

- **Principe** : le module doit expliquer que l'HbA1c mesure la glycation non enzymatique de l'hémoglobine (fraction A1c), reflétant la glycémie moyenne des 2-3 derniers mois (durée de vie des globules rouges ~120 jours). La corrélation HbA1c ↔ glycémie moyenne a été établie par l'étude ADAG (Nathan et al., *Diabetes Care*, 2008) — ex. HbA1c 7% ≈ glycémie moyenne ~1,54 g/L
- **Méthode de dosage** : le module doit préciser que le diagnostic par HbA1c nécessite une méthode certifiée NGSP (*National Glycohemoglobin Standardization Program*) et traçable DCCT/IFCC. Les méthodes point-of-care ne sont pas acceptées pour le diagnostic
- **Avantages** : pas de jeûne nécessaire, faible variabilité intra-individuelle, meilleure corrélation avec les complications chroniques que la GAJ isolée, praticité (prélèvement à tout moment)
- **Situations d'HbA1c non fiable** : le module doit détailler les situations où l'HbA1c NE DOIT PAS être utilisée pour le diagnostic — hémoglobinopathies (drépanocytose HbS, thalassémie — interférence analytique variable selon la méthode), anémie hémolytique ou ferriprive (turn-over érythrocytaire altéré), transfusion récente, grossesse (hémodilution, modification du turn-over), insuffisance rénale sévère (carbamylation de l'Hb), hépatopathie sévère, traitement par EPO ou fer IV, VIH sous antirétroviraux (interférence possible). Dans ces situations, utiliser GAJ ou HGPO
- **Écarts ethno-raciaux** : le module doit mentionner que des études ont montré des différences d'HbA1c à glycémie égale entre groupes ethniques (~0,4% plus élevée chez les Afro-Américains vs Caucasiens, Herman et al., *Ann Intern Med*, 2007) — la signification clinique de ces différences est débattue

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB09-S03-001 | 📊 INFOGRAPHIE | Correspondance HbA1c ↔ glycémie moyenne estimée (eAG) — table de conversion ADAG |
| MDIAB09-S03-002 | 📊 INFOGRAPHIE | Situations d'HbA1c non fiable — liste des pièges diagnostiques avec mécanisme |

### Section 9.4 — Diagnostics différentiels et situations particulières

**Contenu obligatoire** :

- **Hyperglycémie de stress** : le module doit distinguer le diabète vrai de l'hyperglycémie de stress (infection aiguë, chirurgie, traumatisme, corticothérapie, AVC, IDM) — contrôler à distance de l'épisode aigu (HbA1c utile dans ce contexte)
- **Diabète ou prédiabète ?** : le module doit présenter la zone grise — GAJ 1,10-1,25 g/L = IFG (prédiabète selon ADA ; « hyperglycémie modérée à jeun » selon OMS/HAS), HbA1c 5,7-6,4% = prédiabète ADA (non retenu par OMS/HAS). La conduite à tenir devant ces zones grises est détaillée dans le Module 10
- **Diabète de type 1 vs type 2 vs MODY vs LADA** : le module doit présenter les éléments d'orientation étiologique au diagnostic — âge, IMC, auto-anticorps, peptide C, cétonurie, antécédents familiaux, mode de début (brutal vs progressif). Arbre décisionnel vers le bilan étiologique (Module 11)
- **Diabète secondaire** : le module doit rappeler les causes de diabète secondaire à évoquer systématiquement — pancréatique (type 3c), endocrinien (Cushing, acromégalie, phéochromocytome, hyperthyroïdie), médicamenteux (cf. Module 7), génétique (cf. Module 7)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB09-S04-001 | 📐 SCHÉMA | Arbre décisionnel étiologique au diagnostic — DT1 vs DT2 vs MODY vs LADA vs secondaire |
| MDIAB09-S04-002 | 📊 INFOGRAPHIE | Éléments d'orientation au diagnostic — tableau comparatif DT1/DT2/MODY/LADA |

## Points clés

1. Le diagnostic de diabète repose sur 4 critères possibles — GAJ ≥ 1,26 g/L, HGPO H+2 ≥ 2,00 g/L, HbA1c ≥ 6,5%, glycémie aléatoire ≥ 2,00 g/L + symptômes
2. En l'absence de symptômes, le diagnostic nécessite DEUX mesures anormales sur DEUX jours différents
3. L'HbA1c ne doit PAS être utilisée pour le diagnostic en cas d'hémoglobinopathie, anémie, grossesse, IRC sévère
4. La glycémie veineuse plasmatique est le standard — la glycémie capillaire n'est pas un outil diagnostique
5. L'HGPO 75 g est indispensable pour diagnostiquer l'IGT et le DG — elle n'est pas systématique en routine
6. Toujours évoquer un diagnostic étiologique (DT1/DT2/MODY/LADA/secondaire) dès le diagnostic posé

## Auto-évaluation — Module 9

**QCM 1** 🥉 : Le seuil de GAJ définissant le diabète est :
- A) ≥ 1,10 g/L
- B) ≥ 1,20 g/L
- C) ≥ 1,26 g/L ✅
- D) ≥ 1,40 g/L
> *Feedback : Le seuil de 1,26 g/L (7,0 mmol/L) a été établi par l'OMS et l'ADA comme correspondant au seuil d'apparition de la rétinopathie diabétique dans les études épidémiologiques. Ce seuil nécessite une confirmation par une 2ème mesure si le patient est asymptomatique.*

**QCM 2** 🥈 : Un patient asymptomatique a une GAJ à 1,30 g/L et une HbA1c à 6,2%. Quelle est la conduite à tenir ?
- A) Le diagnostic de diabète est posé (GAJ ≥ 1,26)
- B) Recontrôler la GAJ sur un autre jour ✅
- C) L'HbA1c < 6,5% exclut le diabète
- D) Réaliser une HGPO immédiatement
> *Feedback : Chez un patient asymptomatique, une seule GAJ ≥ 1,26 g/L ne suffit pas — il faut confirmer par une 2ème mesure sur un autre jour. Si les deux critères sont discordants (GAJ diabétique, HbA1c non diabétique), c'est le critère positif (GAJ) qui doit être recontrôlé. Si la 2ème GAJ est ≥ 1,26, le diagnostic est posé malgré l'HbA1c « normale ».*

**QCM 3** 🥈 : L'HbA1c ne doit PAS être utilisée pour le diagnostic de diabète dans laquelle de ces situations ?
- A) Patient sédentaire de 55 ans
- B) Patiente drépanocytaire homozygote HbSS ✅
- C) Patient sous metformine
- D) Patient hypertendu sous IEC
> *Feedback : Les hémoglobinopathies (HbS, HbC, thalassémie) interfèrent avec de nombreuses méthodes de dosage de l'HbA1c (HPLC, immunoessai) et le turn-over érythrocytaire modifié fausse l'interprétation. Chez ces patients, utiliser la GAJ ou l'HGPO pour le diagnostic.*

**QCM 4** 🥇 : Un patient de 45 ans, IMC 21, consulte pour polyurie-polydipsie depuis 3 semaines. Glycémie veineuse à 3,50 g/L, cétonurie +++. Le diagnostic de diabète est-il posé ?
- A) Non, il faut confirmer par une 2ème glycémie
- B) Non, il faut doser l'HbA1c
- C) Oui, la glycémie ≥ 2,00 g/L avec symptômes cardinaux suffit ✅
- D) Il faut d'abord faire une HGPO
> *Feedback : En présence de symptômes cardinaux (polyurie, polydipsie) + glycémie ≥ 2,00 g/L, le diagnostic de diabète est posé SANS confirmation. De plus, la présence de cétonurie oriente vers un DT1. La priorité est la prise en charge urgente (recherche d'acidocétose, insulinothérapie).*

**Cas clinique** 🥇 : Mme R., 38 ans, originaire du Sénégal, trait drépanocytaire HbAS. Bilan systématique : GAJ 1,08 g/L, HbA1c 6,8%. Son médecin pose le diagnostic de diabète sur l'HbA1c. Qu'en pensez-vous ?
> *Réponse : Le diagnostic est inapproprié. Le trait drépanocytaire HbAS peut interférer avec certaines méthodes de dosage de l'HbA1c (HPLC en particulier), faussant le résultat à la hausse ou à la baisse selon la méthode. De plus, des études ont montré des différences d'HbA1c liées à l'ethnie à glycémie égale. CAT : (1) Ne pas retenir l'HbA1c comme critère diagnostique chez cette patiente, (2) Contrôler la GAJ — ici 1,08 g/L = normale (<1,10), (3) Si doute, réaliser une HGPO 75 g, (4) Si GAJ et HGPO normales → pas de diabète, l'HbA1c élevée est un artefact analytique. Ce cas illustre pourquoi la connaissance des limites de l'HbA1c est indispensable.*

---

# MODULE 10 : DÉPISTAGE ET PRÉDIABÈTE — POPULATIONS CIBLES, OUTILS, PRÉVENTION DU DT2

**Partie** : III — Diagnostic et Dépistage
**Durée estimée** : 3h00
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Module 9

## Accroche clinique

> 🏥 **Mise en situation** : M. P., 48 ans, IMC 31 kg/m², père DT2, consulte pour un bilan de santé. Sa GAJ est à 1,15 g/L et son HbA1c à 6,0%. *« Docteur, mon père est diabétique et je ne veux pas le devenir. Est-ce que je suis en route vers le diabète ? Et surtout, est-ce qu'on peut l'empêcher ? »* Le praticien doit connaître le concept de prédiabète, les outils de dépistage, et surtout les preuves que la prévention du DT2 est possible.

## Objectifs d'apprentissage

1. **Identifier** les populations cibles du dépistage du diabète selon les recommandations ADA et HAS
2. **Définir** et classifier les états de prédiabète : IFG, IGT, HbA1c 5,7-6,4%
3. **Connaître** les preuves de la prévention du DT2 par les mesures hygiéno-diététiques (DPP, Finnish DPS, Da Qing)
4. **Évaluer** le rôle de la pharmacoprévention (metformine, acarbose, pioglitazone, aGLP-1)
5. **Organiser** le suivi d'un patient prédiabétique

## Structure du contenu

### Section 10.1 — Stratégies de dépistage du diabète de type 2

**Contenu obligatoire** :

- **Dépistage ciblé vs populationnel** : le module doit distinguer le dépistage ciblé (recommandé — chez les sujets à risque) du dépistage systématique populationnel (non recommandé en l'état actuel des preuves). Le module doit présenter les critères de dépistage ciblé selon l'ADA (2025) et la HAS (2014)
- **Critères ADA** (adapté de ADA, Standards of Care, 2025) : le module doit indiquer que le dépistage est recommandé chez : (1) tout adulte ≥ 35 ans (anciennement 45 ans, abaissé en 2022), (2) tout adulte avec IMC ≥ 25 kg/m² (≥ 23 chez les Asiatiques) + ≥ 1 facteur de risque (antécédent familial DT2 au 1er degré, ethnie à risque, antécédent de DG, HTA, dyslipidémie, syndrome des ovaires polykystiques, sédentarité, acanthosis nigricans, antécédent de maladie cardiovasculaire, prédiabète antérieur)
- **Critères HAS** (2014) : le module doit présenter la stratégie française — dépistage par GAJ chez les sujets ≥ 45 ans avec ≥ 1 facteur de risque, répété tous les 1-3 ans selon le niveau de risque. Score FINDRISC comme outil de pré-sélection
- **Outils de dépistage** : GAJ (test de 1ère intention en France), HbA1c (accepté par l'ADA comme alternative), HGPO (2ème intention ou pour DG). Le module doit mentionner le score FINDRISC (questionnaire validé, score ≥ 12 = indication de GAJ)
- **Dépistage du DT1** : le module doit mentionner le dépistage des apparentés au 1er degré par auto-anticorps (cf. Module 5) — différence fondamentale avec le dépistage du DT2

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB10-S01-001 | 📊 INFOGRAPHIE | Algorithme de dépistage du DT2 — populations cibles, outils, fréquence |
| MDIAB10-S01-002 | 📊 INFOGRAPHIE | Score FINDRISC — questionnaire illustré avec seuils de risque |

### Section 10.2 — Prédiabète : définitions, risques et histoire naturelle

**Contenu obligatoire** :

- **Définitions** : le module doit présenter les deux catégories de prédiabète et leurs seuils :

| Catégorie | Critère ADA | Critère OMS/HAS |
|---|---|---|
| IFG (*Impaired Fasting Glucose*) | GAJ 1,00-1,25 g/L | GAJ 1,10-1,25 g/L |
| IGT (*Impaired Glucose Tolerance*) | HGPO H+2 : 1,40-1,99 g/L | HGPO H+2 : 1,40-1,99 g/L |
| Prédiabète HbA1c | 5,7-6,4% | Non retenu par OMS |

*(adapté de ADA, Standards of Care, 2025 ; OMS, 2006)*

- **Différence ADA vs OMS** : le module doit souligner que le seuil d'IFG diffère entre l'ADA (≥ 1,00 g/L) et l'OMS/HAS (≥ 1,10 g/L) — l'ADA a abaissé son seuil en 2003, ce que l'OMS n'a pas suivi. La catégorie « prédiabète par HbA1c 5,7-6,4% » est spécifique à l'ADA et non reconnue par l'OMS
- **Risque de progression** : le module doit présenter les données de progression — environ 5-10% des sujets prédiabétiques progressent vers le DT2 chaque année. L'IGT isolée confère un risque plus élevé que l'IFG isolée. La combinaison IFG + IGT confère le risque le plus élevé (~10-12%/an). À 10 ans, environ 30-50% des sujets prédiabétiques développent un DT2 en l'absence d'intervention
- **Risque cardiovasculaire** : le module doit souligner que le prédiabète est déjà associé à un risque cardiovasculaire accru (méta-analyse Huang et al., *BMJ*, 2016 — RR ~1,15 pour les événements CV majeurs) — d'où l'importance de la prise en charge globale des facteurs de risque CV dès le stade de prédiabète

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB10-S02-001 | 📊 INFOGRAPHIE | Spectre glycémique — normal → IFG/IGT → diabète, avec seuils et risques |
| MDIAB10-S02-002 | 📊 INFOGRAPHIE | Risque annuel de progression vers le DT2 — IFG, IGT, IFG+IGT |

### Section 10.3 — Prévention du DT2 : preuves et interventions

**Contenu obligatoire** :

- **Études princeps de prévention par MHD** : le module doit présenter les 3 études fondatrices démontrant que la prévention du DT2 est possible par des mesures hygiéno-diététiques intensives :
  - **Finnish DPS** (Tuomilehto et al., *N Engl J Med*, 2001) : intervention = activité physique ≥ 150 min/semaine + perte de poids ≥ 5% + alimentation enrichie en fibres, pauvre en graisses → réduction du risque de DT2 de 58% à 3,2 ans, effet persistant à 13 ans de suivi
  - **DPP** (*Diabetes Prevention Program*, Knowler et al., *N Engl J Med*, 2002) : 3 234 sujets IGT, 3 bras (placebo, metformine 850 mg × 2/j, MHD intensives) → MHD : -58% de risque de DT2, metformine : -31%, bénéfice persistant à 15 ans (DPP-OS)
  - **Da Qing** (Pan et al., *Lancet*, 1997, suivi à 30 ans — Gong et al., *Lancet Diabetes Endocrinol*, 2019) : réduction du risque de DT2, événements CV et mortalité à 30 ans de suivi
- **Objectifs de l'intervention lifestyle** : le module doit présenter les cibles validées — perte de poids de 5-7% du poids initial, activité physique ≥ 150 min/semaine d'intensité modérée, alimentation riche en fibres (≥ 15 g/1000 kcal), pauvre en graisses saturées (<30% des calories)
- **Pharmacoprévention** : le module doit discuter la place des traitements médicamenteux — metformine (seul agent avec données à long terme, DPP — recommandé par l'ADA chez les sujets à très haut risque : IMC ≥ 35, <60 ans, femmes avec antécédent de DG), acarbose (étude STOP-NIDDM, -25%), pioglitazone (étude ACT NOW, -72% mais effets secondaires), aGLP-1 (données émergentes sur le sémaglutide dans la prévention — STEP, SELECT)
- **Recommandations actuelles** : le module doit synthétiser les recommandations ADA 2025 — MHD intensives en 1ère intention pour tous les sujets prédiabétiques, metformine envisageable en complément chez les sujets à très haut risque, suivi annuel (GAJ ou HbA1c)

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB10-S03-001 | 📊 INFOGRAPHIE | Études de prévention du DT2 — DPP, Finnish DPS, Da Qing : design, résultats, NNT |
| MDIAB10-S03-002 | 📐 SCHÉMA | Stratégie de prévention du DT2 — MHD + pharmacoprévention selon le profil de risque |

## Points clés

1. Le dépistage du DT2 est ciblé (sujets à risque) — non populationnel
2. Le prédiabète comprend l'IFG (GAJ 1,10-1,25 g/L OMS, 1,00-1,25 ADA), l'IGT (HGPO H+2 1,40-1,99 g/L) et l'HbA1c 5,7-6,4% (ADA seul)
3. La prévention du DT2 est possible : MHD intensives réduisent le risque de 58% (DPP, Finnish DPS)
4. La metformine réduit le risque de 31% (DPP) — envisageable chez les sujets à très haut risque
5. Le prédiabète est déjà associé à un risque cardiovasculaire accru — prise en charge globale des FDRCV

## Auto-évaluation — Module 10

**QCM 1** 🥉 : Le seuil d'IFG selon l'OMS est :
- A) ≥ 0,90 g/L
- B) ≥ 1,00 g/L (seuil ADA)
- C) ≥ 1,10 g/L ✅
- D) ≥ 1,26 g/L
> *Feedback : L'OMS et la HAS retiennent le seuil de 1,10 g/L pour l'IFG, tandis que l'ADA a abaissé son seuil à 1,00 g/L en 2003. En pratique française, on utilise le seuil OMS de 1,10 g/L.*

**QCM 2** 🥈 : L'étude DPP a démontré que les MHD intensives réduisent le risque de DT2 de :
- A) 25%
- B) 31%
- C) 58% ✅
- D) 72%
> *Feedback : Les MHD intensives (perte de poids 5-7%, exercice 150 min/semaine) ont réduit le risque de 58% vs placebo, et la metformine de 31%. La pioglitazone (étude ACT NOW) a montré -72% mais n'est pas recommandée en prévention en raison de ses effets secondaires.*

**Cas clinique** 🥈 : M. P. (accroche) a une GAJ à 1,15 g/L, HbA1c 6,0%, IMC 31 kg/m², père DT2. Quelle est votre stratégie ?
> *Réponse : (1) Diagnostic : IFG (GAJ 1,10-1,25 g/L) = prédiabète. HbA1c 6,0% = prédiabète selon ADA (5,7-6,4%). (2) Réaliser une HGPO 75 g pour évaluer l'IGT (risque de progression plus élevé si IFG + IGT). (3) Intervention MHD intensive : objectif perte de poids ≥ 5% (soit ~4-5 kg), activité physique ≥ 150 min/semaine, alimentation équilibrée riche en fibres, pauvre en graisses saturées et sucres rapides. (4) Bilan FDRCV complet (lipides, PA, tabac). (5) Discuter la metformine si facteurs de risque multiples (IMC ≥ 35, <60 ans — ici IMC 31, limite). (6) Suivi annuel par GAJ ou HbA1c. (7) Information du patient sur l'efficacité prouvée de la prévention (DPP : -58%).*

---

# MODULE 11 : EXPLORATIONS BIOLOGIQUES SPÉCIALISÉES — AUTO-ANTICORPS, PEPTIDE C, HLA, GÉNÉTIQUE MODY

**Partie** : III — Diagnostic et Dépistage
**Durée estimée** : 3h00
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 5-7, 9

## Accroche clinique

> 🏥 **Mise en situation** : Un homme de 42 ans, diagnostiqué « DT2 » à 38 ans, est sous metformine + gliclazide avec contrôle médiocre (HbA1c 8,5%). IMC 24 kg/m², pas d'antécédent familial de DT2. Le diabétologue prescrit un bilan étiologique : anti-GAD 180 UI/mL (N < 5), anti-IA2 négatif, peptide C 0,4 ng/mL (bas). *« Ce patient n'a pas un DT2 — c'est un LADA. Il faut passer à l'insuline. »* Ce cas illustre l'importance du bilan étiologique pour adapter le traitement.

## Objectifs d'apprentissage

1. **Prescrire** et interpréter le dosage des auto-anticorps du diabète (anti-GAD, anti-IA2, anti-ZnT8, IAA)
2. **Utiliser** le peptide C pour évaluer la sécrétion résiduelle d'insuline et orienter le diagnostic étiologique
3. **Connaître** les indications du typage HLA dans le contexte du DT1
4. **Prescrire** un séquençage génétique MODY et en interpréter les résultats
5. **Intégrer** ces examens dans un arbre décisionnel étiologique pratique

## Structure du contenu

### Section 11.1 — Auto-anticorps du diabète : prescription et interprétation

**Contenu obligatoire** :

- **Les 4 auto-anticorps** : le module doit détailler chaque auto-anticorps :

| Auto-anticorps | Cible antigénique | Sensibilité au diagnostic DT1 | Spécificités |
|---|---|---|---|
| Anti-GAD65 | Glutamate décarboxylase 65 | ~70-80% | Le plus persistant (positif des années après le diagnostic), marqueur du LADA |
| Anti-IA2 | Tyrosine phosphatase IA-2 | ~50-70% | Corrélé à une progression plus rapide vers l'insulinorequérance |
| Anti-ZnT8 | Transporteur de zinc 8 | ~60-70% | Ajout récent (Wenzlau et al., PNAS, 2007), augmente la sensibilité combinée |
| IAA | Insuline | ~50-70% (enfant), ~20% (adulte) | Doit être dosé AVANT toute insulinothérapie (sinon positif par immunisation) |

*(adapté de Ziegler et al., Diabetes Care, 2012)*

- **Combinaison d'anticorps** : le module doit expliquer que la combinaison de 2 ou 3 anticorps atteint une sensibilité de ~95-98% pour le DT1. La présence de ≥ 2 anticorps chez un sujet à risque confère un risque de progression vers le DT1 clinique d'environ 44% à 5 ans et quasi 100% à vie
- **Indications du dosage** : le module doit préciser quand doser les auto-anticorps — (1) doute entre DT1 et DT2 (sujet jeune, maigre, ou DT2 « atypique »), (2) suspicion de LADA (DT2 avec réponse insuffisante aux ADO), (3) dépistage familial (apparentés au 1er degré d'un DT1), (4) classification étiologique initiale du diabète. NE PAS doser systématiquement chez un DT2 typique (obèse, >50 ans, antécédents familiaux DT2)
- **Faux positifs** : le module doit mentionner que les anti-GAD peuvent être positifs en dehors du diabète — maladies auto-immunes thyroïdiennes, maladie cœliaque, stiff-person syndrome. Un titre d'anti-GAD faiblement positif chez un sujet DT2 typique ne signifie pas automatiquement un LADA

### Section 11.2 — Peptide C : évaluation de la sécrétion résiduelle

**Contenu obligatoire** :

- **Physiologie** : le module doit rappeler que le peptide C est co-sécrété avec l'insuline en quantités équimolaires lors du clivage de la proinsuline dans les granules β-cellulaires (cf. Module 3). Contrairement à l'insuline, le peptide C n'est pas capté par le foie → reflet fidèle de la sécrétion endogène d'insuline. Sa demi-vie (~30 min) est plus longue que celle de l'insuline (~5 min), ce qui facilite son dosage
- **Dosage** : le module doit présenter les deux modalités — peptide C à jeun (le plus simple) et peptide C stimulé (après repas mixte standardisé ou injection de glucagon 1 mg IV — plus sensible). Valeurs normales : peptide C à jeun ~0,8-3,5 ng/mL (méthodes immunochimiques actuelles)
- **Interprétation diagnostique** :

| Peptide C à jeun | Interprétation | Orientation |
|---|---|---|
| < 0,2 ng/mL | Sécrétion β-cellulaire effondrée | DT1 évolué, pancréatectomie totale |
| 0,2-0,6 ng/mL | Sécrétion résiduelle faible | DT1 récent, LADA avancé, type 3c |
| 0,6-3,5 ng/mL | Sécrétion conservée | DT2 (précoce), MODY, LADA débutant |
| > 3,5 ng/mL | Hyperinsulinisme | DT2 avec insulinorésistance, insulinome |

- **Utilité clinique** : le module doit préciser les indications du dosage — distinction DT1/DT2/LADA, évaluation de la sécrétion résiduelle dans le DT1 (rémission ? éligibilité greffe ?), orientation vers l'insulinothérapie (peptide C bas = insuline nécessaire), suivi après pancréatectomie

### Section 11.3 — Typage HLA et génétique MODY

**Contenu obligatoire** :

- **Typage HLA** : le module doit expliquer que le typage HLA de classe II (DR/DQ) n'est pas un outil diagnostique de routine mais est utilisé dans le dépistage familial du DT1 (programmes TrialNet, TEDDY) et dans la recherche. Indication clinique principale : nouveau-né d'un parent DT1 → typage HLA à la naissance pour stratifier le risque
- **Séquençage MODY** : le module doit présenter les indications du séquençage génétique MODY — critères cliniques évocateurs (cf. Module 7) : diagnostic <35 ans, hérédité AD (≥ 2-3 générations), auto-anticorps négatifs, peptide C conservé, absence d'obésité. Le module doit détailler les panels de gènes séquencés (GCK, HNF1A, HNF4A, HNF1B, PDX1, NEUROD1 — minimum 6 gènes), le délai de résultat (~4-8 semaines), et l'impact thérapeutique majeur (MODY2 → pas de traitement, MODY3 → sulfamides faible dose)
- **Score de probabilité** : le module doit mentionner les outils d'aide à la décision — calculateur de probabilité MODY en ligne (Exeter MODY calculator — Shield et al., *Diabetologia*, 2012), qui intègre l'âge de diagnostic, le sexe, le traitement, l'HbA1c, l'IMC et les antécédents familiaux pour estimer la probabilité pré-test d'un MODY

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB11-S03-001 | 📊 INFOGRAPHIE | Arbre décisionnel : quand prescrire un séquençage MODY ? — critères cliniques et score de probabilité |
| MDIAB11-S03-002 | 📊 INFOGRAPHIE | Impact du diagnostic génétique MODY sur le traitement — passage metformine/insuline → sulfamides |

## Points clés

1. Les auto-anticorps (anti-GAD, anti-IA2, anti-ZnT8, IAA) servent à distinguer DT1/LADA du DT2 — ne pas doser systématiquement chez un DT2 typique
2. Le peptide C reflète la sécrétion endogène d'insuline — peptide C bas → insulinothérapie ; peptide C conservé + auto-AC négatifs → penser MODY
3. Le séquençage MODY a un impact thérapeutique majeur — MODY2 = pas de traitement, MODY3 = sulfamides
4. Le typage HLA est réservé au dépistage familial du DT1 et à la recherche
5. L'IAA doit être dosé AVANT toute insulinothérapie (sinon positif par immunisation)

## Auto-évaluation — Module 11

**QCM 1** 🥈 : Quel auto-anticorps est le plus caractéristique du LADA ?
- A) Anti-IA2
- B) Anti-ZnT8
- C) Anti-GAD65 ✅
- D) IAA
> *Feedback : L'anti-GAD65 est positif dans ~90% des LADA. C'est l'auto-anticorps le plus persistant (peut rester positif des années après le diagnostic) et le plus pertinent pour le dépistage du LADA chez un patient étiqueté DT2.*

**QCM 2** 🥈 : Un peptide C à jeun à 0,2 ng/mL chez un diabétique sous ADO oriente vers :
- A) Un DT2 avec insulinorésistance sévère
- B) Un MODY2/GCK
- C) Un DT1/LADA évolué nécessitant de l'insuline ✅
- D) Un diabète cortico-induit
> *Feedback : Un peptide C très bas (< 0,2-0,3 ng/mL) indique une sécrétion endogène d'insuline effondrée, incompatible avec un DT2 (où le peptide C est normal ou élevé). Ce résultat oriente vers un DT1 ou un LADA évolué et impose le passage à l'insulinothérapie — les ADO insulinosécrétagogues seront inefficaces sans réserve β-cellulaire.*

**QCM 3** 🥇 : Un patient de 28 ans, diagnostiqué diabétique à 22 ans, père et grand-père diabétiques, IMC 22, auto-AC négatifs, peptide C normal. Le séquençage MODY retrouve une mutation HNF1A. Le patient est sous insuline basale-bolus depuis 6 ans. Quelle modification thérapeutique proposez-vous ?
- A) Maintenir l'insuline et ajouter de la metformine
- B) Remplacer l'insuline par des sulfamides à faible dose ✅
- C) Arrêter tout traitement
- D) Passer à un iSGLT2
> *Feedback : Le MODY3/HNF1A répond remarquablement aux sulfamides à faible dose (4× plus sensible que les DT2 — Pearson et al., Lancet, 2003). Le passage de l'insuline aux sulfamides est non seulement possible mais recommandé — il simplifie considérablement le traitement (1 cp vs injections multiples) sans perte de contrôle glycémique. Transition progressive sous surveillance glycémique. Ce cas illustre l'impact thérapeutique majeur du diagnostic génétique.*

**Cas clinique** 💎 : Vous recevez un enfant de 6 mois avec diabète néonatal permanent. Il est sous insuline IVSE puis SC. Les auto-anticorps sont négatifs. Le séquençage retrouve une mutation activatrice de KCNJ11 (Kir6.2). Quelle implication thérapeutique ?
> *Réponse : Les mutations activatrices de KCNJ11 maintiennent le canal KATP en position ouverte → la cellule β ne peut pas sécréter d'insuline en réponse au glucose. Mais les sulfamides ferment le canal KATP par un mécanisme indépendant de l'ATP (liaison au SUR1). Un essai de passage insuline → sulfamides à forte dose (glibenclamide 0,5-1 mg/kg/j) est indiqué et réussit dans ~90% des cas (Pearson et al., N Engl J Med, 2006). Le patient peut passer d'injections d'insuline à un comprimé de sulfamide per os — transformation radicale de la qualité de vie. Surveillance glycémique intensive pendant la transition.*

---

# RÉFÉRENCES — PARTIE 3 (Modules 9-11)

1. American Diabetes Association. Standards of Care in Diabetes — 2025. *Diabetes Care*. 2025;48(Suppl 1).
2. World Health Organization. Definition and Diagnosis of Diabetes Mellitus and Intermediate Hyperglycaemia. Geneva: WHO; 2006.
3. Nathan DM, Kuenen J, Borg R, et al. Translating the A1c assay into estimated average glucose values (ADAG). *Diabetes Care*. 2008;31(8):1473-1478.
4. Herman WH, Ma Y, Uwaifo G, et al. Differences in A1C by race and ethnicity among patients with impaired glucose tolerance in the DPP. *Diabetes Care*. 2007;30(10):2453-2457.
5. Tuomilehto J, Lindström J, Eriksson JG, et al. Prevention of type 2 diabetes mellitus by changes in lifestyle among subjects with impaired glucose tolerance (Finnish DPS). *N Engl J Med*. 2001;344(18):1343-1350.
6. Knowler WC, Barrett-Connor E, Fowler SE, et al. Reduction in the incidence of type 2 diabetes with lifestyle intervention or metformin (DPP). *N Engl J Med*. 2002;346(6):393-403.
7. Gong Q, Zhang P, Wang J, et al. Morbidity and mortality after lifestyle intervention for people with impaired glucose tolerance: 30-year results of the Da Qing Diabetes Prevention Outcome Study. *Lancet Diabetes Endocrinol*. 2019;7(6):452-461.
8. Huang Y, Cai X, Mai W, et al. Association between prediabetes and risk of cardiovascular disease and all cause mortality: systematic review and meta-analysis. *BMJ*. 2016;355:i5953.
9. Wenzlau JM, Juhl K, Yu L, et al. The cation efflux transporter ZnT8 (Slc30A8) is a major autoantigen in human type 1 diabetes. *PNAS*. 2007;104(43):17040-17045.
10. Ziegler AG, Rewers M, Simell O, et al. Seroconversion to multiple islet autoantibodies and risk of progression to diabetes in children. *JAMA*. 2013;309(23):2473-2479.
11. Shield JP, Hattersley AT, et al. The MODY probability calculator. *Diabetologia*. 2012;55(Suppl 1):S47-S48.
12. Pearson ER, Flechtner I, Njølstad PR, et al. Switching from insulin to oral sulfonylureas in patients with diabetes due to Kir6.2 mutations. *N Engl J Med*. 2006;355(5):467-477.

---

*Partie 3 — Modules 9-11 — Document conforme à la charte VERTEX© — Version 1.0 — 13 mars 2026*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 4 — Clinique et Formes du Diabète (Modules 12-15)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 12 : PRÉSENTATION CLINIQUE DU DT1 — SIGNES CARDINAUX, ACIDOCÉTOSE INAUGURALE

**Partie** : IV — Clinique
**Durée estimée** : 3h00
**Niveau** : Fondamental
**Prérequis** : Module 5

## Accroche clinique

> 🏥 **Mise en situation** : Un garçon de 10 ans est amené aux urgences par ses parents. Depuis 3 semaines, il boit beaucoup (3-4 L/j), urine fréquemment (se lève 3 fois la nuit), a perdu 4 kg malgré un appétit conservé. Ce matin, il a des nausées, des douleurs abdominales et une respiration rapide. L'infirmière mesure une glycémie capillaire à « HI » (>5 g/L). *Le tableau classique d'une acidocétose inaugurale chez un enfant DT1 — mais combien de consultations manquées auraient pu éviter cette présentation dramatique ?*

## Objectifs d'apprentissage

1. **Reconnaître** les signes cardinaux du DT1 : polyurie, polydipsie, amaigrissement, polyphagie
2. **Diagnostiquer** une acidocétose inaugurale et en évaluer la sévérité (légère, modérée, sévère)
3. **Distinguer** les formes de présentation selon l'âge (nourrisson, enfant, adolescent, adulte)
4. **Identifier** les signes d'alerte devant conduire au diagnostic précoce
5. **Connaître** la « lune de miel » et ses implications pratiques

## Structure du contenu

### Section 12.1 — Signes cardinaux et diagnostic clinique du DT1

**Contenu obligatoire** :

- **Syndrome cardinal** : le module doit décrire les 4 signes cardinaux du DT1 en expliquant leur mécanisme physiopathologique — (1) Polyurie osmotique : quand la glycémie dépasse le seuil rénal (~1,80 g/L), le glucose filtré n'est plus entièrement réabsorbé → glucosurie → diurèse osmotique (5-10 L/j dans les formes sévères). (2) Polydipsie : compensation de la déshydratation. (3) Amaigrissement : carence en insuline → catabolisme protéique (muscle) et lipolyse (tissu adipeux) → perte de masse maigre et grasse. (4) Polyphagie : tentative de compensation des pertes caloriques urinaires et cataboliques
- **Chronologie** : le module doit présenter la timeline typique — symptômes sur 1-6 semaines chez l'enfant (plus brutal que chez l'adulte), souvent plus progressif chez l'adulte (DT1 lent / LADA)
- **Signes associés** : le module doit mentionner la fatigue intense (catabolisme + déshydratation), la vision trouble (variation de l'hydratation cristallinienne), les infections récurrentes (mycoses génitales ++, infections cutanées), l'énurésie secondaire chez l'enfant (signe d'alerte à ne pas manquer)
- **Retard diagnostique** : le module doit souligner le problème du retard diagnostique — le DT1 est encore diagnostiqué au stade d'acidocétose dans 20-40% des cas en France (davantage chez les enfants < 5 ans), malgré des symptômes présents depuis plusieurs jours à semaines. Le module doit insister sur les signaux d'alarme à ne pas manquer en médecine générale et en pédiatrie

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB12-S01-001 | 📐 SCHÉMA | Physiopathologie des signes cardinaux — carence insulinique → hyperglycémie → polyurie/polydipsie/amaigrissement |
| MDIAB12-S01-002 | 📊 INFOGRAPHIE | Signes d'alerte du DT1 chez l'enfant — campagne « les 4P » (polyurie, polydipsie, perte de poids, polyphagie) |

### Section 12.2 — Acidocétose diabétique inaugurale

**Contenu obligatoire** :

- **Physiopathologie** : le module doit expliquer la cascade métabolique — carence profonde en insuline → lipolyse massive → afflux d'AGL au foie → β-oxydation → production de corps cétoniques (β-hydroxybutyrate, acétoacétate, acétone) → acidose métabolique à trou anionique augmenté. Parallèlement : hyperglycémie majeure → polyurie osmotique → déshydratation + perte électrolytique (Na+, K+, Cl-, phosphate)
- **Diagnostic biologique** : le module doit présenter les critères diagnostiques de l'ACD — glycémie > 2,50 g/L (13,9 mmol/L), pH < 7,30, bicarbonates < 18 mmol/L, cétonémie > 3 mmol/L ou cétonurie ≥ ++. Classification de sévérité :

| Sévérité | pH | Bicarbonates | État de conscience |
|---|---|---|---|
| Légère | 7,25-7,30 | 15-18 mmol/L | Alerte |
| Modérée | 7,10-7,24 | 10-14 mmol/L | Somnolent |
| Sévère | < 7,10 | < 10 mmol/L | Stupeur/coma |

*(adapté de Wolfsdorf et al., ISPAD Guidelines, Pediatric Diabetes, 2018)*

- **Signes cliniques** : le module doit décrire la polypnée de Kussmaul (respiration ample et rapide, mécanisme compensatoire de l'acidose), l'haleine acétonique (odeur fruitée de pomme reinette), les nausées/vomissements, les douleurs abdominales (pouvant mimer un abdomen chirurgical — piège diagnostique classique chez l'enfant), la déshydratation (pli cutané, tachycardie, hypotension), les troubles de conscience
- **Complications de l'ACD** : le module doit aborder l'œdème cérébral (complication grave, 0,5-1% des ACD pédiatriques, mortalité 20-25% — facteurs de risque : âge jeune, correction trop rapide du glucose, perfusion de bicarbonates), l'hypokaliémie de recharge (le K+ total est deplété même si le K+ plasmatique est normal ou élevé en raison de l'acidose — DANGER lors de l'insulinothérapie qui fait rentrer le K+), le SDRA, la thrombose veineuse

### Section 12.3 — Formes selon l'âge et « lune de miel »

**Contenu obligatoire** :

- **DT1 du nourrisson et jeune enfant (<5 ans)** : le module doit souligner les particularités — diagnostic souvent tardif (symptômes atypiques : irritabilité, stagnation pondérale, couches mouillées ++), ACD inaugurale plus fréquente (~50%), risque d'œdème cérébral plus élevé, prise en charge complexe (petites doses d'insuline, alimentation variable)
- **DT1 de l'adolescent** : le module doit présenter les défis — variabilité glycémique liée aux hormones de croissance, puberté (insulinorésistance pubertaire), observance thérapeutique (déni, prise de risque), troubles du comportement alimentaire (diabulimie — omission volontaire d'insuline pour perdre du poids)
- **DT1 de l'adulte** : le module doit décrire les formes de l'adulte — DT1 classique (brutal, acidocétose), DT1 lent (LADA, cf. Module 7), et les pièges diagnostiques (DT1 diagnostiqué à tort comme DT2 chez l'adulte)
- **Lune de miel (rémission partielle)** : le module doit expliquer la phase de rémission survenant dans les semaines-mois suivant le diagnostic chez 60-80% des patients — les besoins en insuline diminuent (<0,5 UI/kg/j) grâce à la sécrétion résiduelle des cellules β survivantes et à la levée de la glucotoxicité. Durée : quelques semaines à 1-2 ans. Le patient et sa famille doivent être informés que cette rémission est TEMPORAIRE et ne signifie pas la guérison

## Points clés

1. Les 4P du DT1 : Polyurie, Polydipsie, Perte de poids, Polyphagie — tout praticien doit les connaître pour un diagnostic précoce
2. L'ACD inaugurale touche encore 20-40% des DT1 pédiatriques — retard diagnostique évitable
3. L'hypokaliémie de recharge est le piège principal du traitement de l'ACD — toujours vérifier le K+ avant l'insuline
4. L'œdème cérébral est la complication la plus redoutée de l'ACD pédiatrique (mortalité 20-25%)
5. La lune de miel est temporaire (semaines à mois) — ne pas la confondre avec une guérison

## Auto-évaluation — Module 12

**QCM 1** 🥉 : Le seuil rénal du glucose au-delà duquel apparaît la glucosurie est d'environ :
- A) 1,00 g/L
- B) 1,26 g/L
- C) 1,80 g/L ✅
- D) 2,50 g/L
> *Feedback : Le seuil rénal du glucose est d'environ 1,80 g/L (10 mmol/L). Au-delà, la capacité de réabsorption tubulaire du SGLT2 est saturée et le glucose « déborde » dans les urines → glucosurie → polyurie osmotique. Les iSGLT2 abaissent ce seuil pharmacologiquement.*

**QCM 2** 🥈 : Chez un enfant en ACD sévère (pH 7,05), quel est le principal danger lié à la correction ?
- A) Hypernatrémie
- B) Œdème cérébral ✅
- C) Hyperglycémie rebond
- D) Rhabdomyolyse
> *Feedback : L'œdème cérébral survient dans 0,5-1% des ACD pédiatriques et a une mortalité de 20-25%. Les facteurs de risque incluent : âge jeune, sévérité de l'ACD, correction trop rapide du glucose ou du sodium, perfusion de bicarbonates, volume de réhydratation excessif dans les premières heures.*

**QCM 3** 🥇 : Un enfant en ACD a un K+ plasmatique à 5,2 mmol/L à l'admission. Faut-il supplémenter en potassium ?
- A) Non, le K+ est élevé
- B) Oui, car le K+ total corporel est deplété malgré le K+ plasmatique normal ou élevé ✅
- C) Uniquement si le K+ descend sous 3,0 mmol/L
- D) Jamais avant 24h
> *Feedback : Le K+ plasmatique est faussement rassurant en ACD. L'acidose fait sortir le K+ des cellules (échange H+/K+), masquant une déplétion potassique totale sévère (pertes urinaires massives). Dès le début de l'insulinothérapie + correction de l'acidose, le K+ rentre massivement dans les cellules → risque d'hypokaliémie sévère (arythmies). Règle : supplémenter en K+ dès que la kaliémie est < 5,5 mmol/L et la diurèse est établie. Si K+ < 3,5 mmol/L à l'admission, débuter le K+ AVANT l'insuline.*

**Cas clinique** 💎 : Une adolescente de 16 ans, DT1 depuis 4 ans, est admise pour sa 3ème ACD en 6 mois. HbA1c 12,5%. Elle refuse de prendre du poids. L'interrogatoire révèle qu'elle « oublie » régulièrement ses injections d'insuline. IMC 17 kg/m². Quel diagnostic suspectez-vous en plus du DT1 ?
> *Réponse : Suspicion de diabulimie — omission volontaire d'insuline pour induire une glucosurie et perdre du poids (trouble du comportement alimentaire spécifique au DT1). La carence insulinique provoquée entraîne hyperglycémie chronique → glucosurie → perte calorique urinaire → perte de poids, mais aussi ACD récurrentes, hyperglycémie sévère et accélération des complications (rétinopathie, néphropathie). CAT : (1) Évaluation psychiatrique/psychologique spécialisée TCA, (2) Prise en charge multidisciplinaire (diabétologue, psychiatre, diététicien), (3) Sécurisation de l'insulinothérapie (pompe avec surveillance parentale), (4) Dépistage des complications (FO, microalbuminurie). La diabulimie est sous-diagnostiquée et potentiellement fatale.*

---

# MODULE 13 : PRÉSENTATION CLINIQUE DU DT2 — DÉCOUVERTE FORTUITE, SYNDROME MÉTABOLIQUE

**Partie** : IV — Clinique
**Durée estimée** : 2h30
**Niveau** : Fondamental
**Prérequis** : Module 6

## Accroche clinique

> 🏥 **Mise en situation** : M. T., 56 ans, chauffeur routier, IMC 33 kg/m², consulte pour un renouvellement d'ordonnance de son traitement antihypertenseur. Le bilan biologique systématique retrouve : GAJ 1,42 g/L, HbA1c 8,2%, TG 3,20 g/L, HDL-c 0,28 g/L, créatinine 92 µmol/L, microalbuminurie positive. *Il est complètement asymptomatique. Le DT2 était probablement présent depuis des années — et les complications microvasculaires ont déjà commencé.*

## Objectifs d'apprentissage

1. **Reconnaître** les circonstances de découverte du DT2 (bilan systématique, complication, DG antérieur)
2. **Définir** le syndrome métabolique selon les critères IDF/harmonisés (2009)
3. **Réaliser** le bilan initial au diagnostic de DT2 (complications, comorbidités, retentissement)
4. **Identifier** les signes cutanés d'insulinorésistance (acanthosis nigricans, acrochordons)

## Structure du contenu

### Section 13.1 — Modes de découverte et présentation clinique

**Contenu obligatoire** :

- **Découverte fortuite** : le module doit souligner que ~50% des DT2 sont asymptomatiques au diagnostic — la découverte se fait lors d'un bilan systématique (médecine du travail, bilan pré-opératoire, suivi d'HTA/dyslipidémie), d'un dépistage ciblé, ou lors d'une hospitalisation. Ce caractère insidieux explique que des complications sont déjà présentes chez 20-30% des patients au diagnostic *(Harris et al., Diabetes Care, 1992)*
- **Découverte sur complication** : le module doit lister les complications révélatrices — rétinopathie (dépistée au FO), neuropathie (paresthésies, mal perforant plantaire), néphropathie (protéinurie), coronaropathie (IDM, angor), AVC, AOMI, infection récurrente (mycose génitale, pied diabétique)
- **Syndrome cardinal atténué** : le module doit expliquer que les symptômes cardinaux (polyurie-polydipsie) sont possibles mais souvent atténués ou banalisés par le patient (« je bois beaucoup parce qu'il fait chaud »). L'amaigrissement est moins fréquent que dans le DT1 (la carence insulinique est relative, pas absolue)
- **Signes d'insulinorésistance** : le module doit décrire l'acanthosis nigricans (hyperpigmentation veloutée des plis — nuque, aisselles, aines, marqueur cutané d'hyperinsulinisme/insulinorésistance), les acrochordons (molluscum pendulum), le syndrome des ovaires polykystiques, la stéatose hépatique

### Section 13.2 — Syndrome métabolique

**Contenu obligatoire** :

- **Définition harmonisée** : le module doit présenter les critères du syndrome métabolique selon le consensus IDF/AHA/NHLBI (2009, Alberti et al., *Circulation*) — ≥ 3 critères parmi :

| Critère | Seuil |
|---|---|
| Tour de taille | ≥ 94 cm (homme européen), ≥ 80 cm (femme européenne) — seuils ethnospécifiques |
| Triglycérides | ≥ 1,50 g/L (ou traitement spécifique) |
| HDL-cholestérol | < 0,40 g/L (homme), < 0,50 g/L (femme) (ou traitement) |
| Pression artérielle | ≥ 130/85 mmHg (ou traitement antihypertenseur) |
| Glycémie à jeun | ≥ 1,00 g/L (ou DT2 connu) |

*(adapté de Alberti et al., Circulation, 2009)*

- **Signification clinique** : le module doit expliquer que le syndrome métabolique identifie les sujets à risque accru de DT2 (× 3-5) et de maladie cardiovasculaire (× 1,5-2). Sa physiopathologie est centrée sur l'insulinorésistance et l'adiposité viscérale (cf. Module 6)

### Section 13.3 — Bilan initial au diagnostic de DT2

**Contenu obligatoire** :

Le module doit détailler le bilan initial systématique au diagnostic de DT2 — ce bilan est fondamental car des complications sont souvent déjà présentes :

- **Bilan métabolique** : HbA1c, lipides complets (CT, LDL-c, HDL-c, TG), créatinine + DFGe, RAC urinaire (rapport albumine/créatinine), bilan hépatique (ASAT, ALAT, GGT — recherche MASLD)
- **Dépistage des complications** : fond d'œil dilaté (ou rétinographie — rétinopathie diabétique), ECG de repos (cardiopathie ischémique silencieuse), IPS (AOMI), examen des pieds (neuropathie — monofilament, diapason 128 Hz), recherche de microalbuminurie
- **Bilan des comorbidités** : PA (HTA), poids/IMC/tour de taille, TSH (hypothyroïdie associée), évaluation dentaire, évaluation psychologique (dépression, qualité de vie)
- **Bilan étiologique si atypique** : auto-anticorps si doute DT1/LADA, peptide C si doute sur réserve β-cellulaire, séquençage MODY si critères évocateurs

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB13-S03-001 | 📊 INFOGRAPHIE | Bilan initial au diagnostic de DT2 — checklist complète en un tableau |
| MDIAB13-S03-002 | 📷 PHOTO | Acanthosis nigricans — hyperpigmentation du pli du cou chez un patient insulinorésistant |

## Auto-évaluation — Module 13

**QCM 1** 🥉 : Quel pourcentage de patients DT2 sont asymptomatiques au moment du diagnostic ?
- A) ~10%
- B) ~30%
- C) ~50% ✅
- D) ~80%

**QCM 2** 🥈 : Le bilan initial au diagnostic de DT2 doit inclure systématiquement :
- A) Un fond d'œil et une microalbuminurie ✅
- B) Une coronarographie
- C) Un dosage des auto-anticorps
- D) Une HGPO
> *Feedback : Le fond d'œil (ou rétinographie) et la microalbuminurie sont systématiques car 20-30% des DT2 ont déjà des complications microvasculaires au diagnostic (le diabète évolue en moyenne depuis 5-10 ans avant d'être diagnostiqué). La coronarographie n'est pas systématique (ECG de repos + évaluation clinique en 1ère intention).*

**Cas clinique** 🥇 : M. T. (accroche) a son bilan initial : fond d'œil = RDNP minime, RAC = 45 mg/g (N < 30), DFGe = 82 mL/min, ECG = normal. Que montrent ces résultats et quel est leur impact sur la stratégie thérapeutique ?
> *Réponse : (1) RDNP minime = complications microvasculaires déjà présentes → confirme que le DT2 évolue depuis plusieurs années. (2) RAC 45 mg/g = microalbuminurie (stade A2 KDIGO, 30-300 mg/g) → néphropathie diabétique débutante. (3) DFGe 82 = fonction rénale préservée mais néphropathie débutante. Impact thérapeutique : (a) Objectif HbA1c strict (< 7%), (b) Privilégier un iSGLT2 (néphroprotection prouvée — DAPA-CKD, CREDENCE) ou un aGLP-1 (bénéfice rénal), (c) IEC ou ARA2 pour la néphroprotection (même si PA normale), (d) Statine haute intensité (LDL-c < 0,70 g/L — patient à très haut risque CV), (e) Suivi ophtalmologique annuel, (f) Éducation thérapeutique.*

---

# MODULE 14 : COMPLICATIONS AIGUËS — ACIDOCÉTOSE, SYNDROME HYPEROSMOLAIRE, HYPOGLYCÉMIE SÉVÈRE

**Partie** : IV — Clinique
**Durée estimée** : 4h00
**Niveau** : Intermédiaire → Expert
**Prérequis** : Modules 12-13

## Accroche clinique

> 🏥 **Mise en situation** : Deux patients diabétiques arrivent aux urgences le même jour. Patient A : femme de 22 ans, DT1, glycémie 4,80 g/L, pH 7,08, cétonémie 6,2 mmol/L. Patient B : homme de 78 ans, DT2, glycémie 8,50 g/L, pH 7,35, osmolalité 385 mOsm/kg, crépitants aux bases pulmonaires. *Deux urgences métaboliques très différentes dans leur physiopathologie et leur prise en charge — l'acidocétose et le syndrome hyperosmolaire.*

## Objectifs d'apprentissage

1. **Prendre en charge** une acidocétose diabétique en urgence : réhydratation, insulinothérapie IVSE, correction kaliémie, monitoring
2. **Distinguer** le syndrome hyperosmolaire de l'acidocétose et adapter le traitement
3. **Classifier** et traiter les hypoglycémies selon leur sévérité (grade 1, 2, 3 / IHSG)
4. **Identifier** et prévenir l'acidose lactique associée à la metformine

## Structure du contenu

### Section 14.1 — Acidocétose diabétique : prise en charge protocolisée

**Contenu obligatoire** :

Le module doit présenter le protocole complet de prise en charge de l'ACD en s'appuyant sur les recommandations ADA/ISPAD :

- **Réhydratation** : le module doit détailler le protocole — NaCl 0,9% en bolus initial (10-20 mL/kg en 1-2h chez l'adulte), puis réhydratation progressive sur 24-48h (objectif : correction du déficit hydrique estimé à 5-10% du poids corporel). Chez l'enfant, volume total de réhydratation < 2× la maintenance pour réduire le risque d'œdème cérébral. Passage au G5% + NaCl quand glycémie < 2,50 g/L pour éviter l'hypoglycémie sous insuline
- **Insulinothérapie IVSE** : le module doit présenter le protocole — insuline rapide (actrapid) en perfusion continue 0,1 UI/kg/h (0,05 UI/kg/h chez l'enfant jeune), SANS bolus initial (augmente le risque d'œdème cérébral chez l'enfant). Objectif : diminution de la glycémie de 50-75 mg/dL/h. Ne PAS arrêter l'insuline tant que la cétonémie n'est pas < 0,6 mmol/L et le trou anionique n'est pas normalisé
- **Potassium** : le module doit insister sur la gestion du K+ — Si K+ > 5,5 : pas de K+ initialement, Si K+ 3,5-5,5 : KCl 20-40 mmol/L dans la perfusion, Si K+ < 3,5 : supplémenter en K+ AVANT de démarrer l'insuline (risque d'arrêt cardiaque). Monitoring K+ toutes les 2-4h
- **Bicarbonates** : le module doit expliquer que les bicarbonates ne sont PAS recommandés sauf si pH < 6,9 (risque d'acidose paradoxale du LCR, d'hypokaliémie, de retard de correction de la cétose)
- **Monitoring** : glycémie horaire, GDS toutes les 2-4h, ionogramme (K+, Na+ corrigé) toutes les 2-4h, cétonémie (ou trou anionique) toutes les 2-4h, état neurologique (échelle de Glasgow — alerte œdème cérébral)
- **Critères de résolution** : glycémie < 2,00 g/L + au moins 2 parmi : pH > 7,30, bicarbonates > 15 mmol/L, trou anionique ≤ 12 mmol/L, cétonémie < 0,6 mmol/L. Puis relais insuline SC (chevauchement 1-2h)
- **Recherche du facteur déclenchant** : le module doit insister sur la recherche systématique — infection (1ère cause chez le DT1 connu), omission d'insuline (2ème cause), pompe à insuline dysfonctionnelle, IDM silencieux, corticothérapie, DT1 inaugural

**Médias** :
| ID | Type | Description |
|----|------|-------------|
| MDIAB14-S01-001 | 📐 SCHÉMA | Protocole ACD — arbre décisionnel réhydratation + insuline + K+ |
| MDIAB14-S01-002 | 📊 INFOGRAPHIE | Feuille de surveillance ACD — paramètres, fréquence, seuils d'alerte |
| MDIAB14-S01-003 | 📐 SCHÉMA | Physiopathologie de l'ACD — carence insulinique → cétogenèse → acidose |

### Section 14.2 — Syndrome d'hyperglycémie hyperosmolaire (SHH)

**Contenu obligatoire** :

- **Définition** : le module doit présenter les critères diagnostiques du SHH — glycémie > 6,00 g/L (33 mmol/L), osmolalité effective > 320 mOsm/kg, pH > 7,30, bicarbonates > 18 mmol/L, cétonurie faible ou absente. Le SHH touche typiquement les patients DT2 âgés, souvent en institution, avec accès limité à l'eau
- **Différences avec l'ACD** : le module doit présenter un tableau comparatif ACD vs SHH — la déshydratation est beaucoup plus sévère dans le SHH (déficit 8-12 L vs 3-6 L), l'hyperglycémie plus majeure, mais il n'y a PAS d'acidose métabolique (la sécrétion résiduelle d'insuline, même faible, suffit à inhiber la cétogenèse hépatique)
- **Prise en charge** : le module doit détailler le traitement — réhydratation prudente et progressive (risque d'œdème cérébral et de myélinolyse centro-pontine), NaCl 0,9% puis 0,45% quand Na+ corrigé > 155 mmol/L, insulinothérapie IVSE à doses plus faibles que l'ACD (0,05 UI/kg/h), thromboprophylaxie systématique (risque thromboembolique élevé +++), recherche du facteur déclenchant (infection ++, AVC, IDM)
- **Mortalité** : le module doit souligner que la mortalité du SHH reste élevée (10-20%, vs 1-5% pour l'ACD) en raison de l'âge avancé, des comorbidités et des complications thromboemboliques

### Section 14.3 — Hypoglycémie : classification, traitement, prévention

**Contenu obligatoire** :

- **Définition et classification** : le module doit présenter la classification IHSG (*International Hypoglycaemia Study Group*, Diabetologia, 2017) :

| Niveau | Glycémie | Caractéristiques |
|---|---|---|
| Niveau 1 (alerte) | < 0,70 g/L (3,9 mmol/L) | Seuil d'alerte, symptômes possibles, autogérable |
| Niveau 2 (cliniquement significatif) | < 0,54 g/L (3,0 mmol/L) | Seuil de neuroglycopénie, nécessite traitement |
| Niveau 3 (sévère) | Pas de seuil glycémique spécifique | Trouble cognitif sévère nécessitant l'aide d'un tiers |

- **Symptômes** : le module doit distinguer les symptômes neurovégétatifs (adrénergiques : sueurs, tremblements, tachycardie, pâleur, faim ; cholinergiques : nausées) — seuil ~0,55-0,65 g/L — des symptômes neuroglycopéniques (trouble de concentration, confusion, trouble du comportement, diplopie, convulsions, coma) — seuil ~0,45-0,55 g/L
- **Causes** : le module doit lister les causes d'hypoglycémie chez le diabétique — excès d'insuline (dose, timing, site d'injection), sulfamides/glinides, repas sauté ou retardé, exercice non compensé, alcool (inhibition de la néoglucogenèse hépatique), insuffisance rénale (↓ clairance insuline et sulfamides), interaction médicamenteuse
- **Traitement** : le module doit détailler le « resucrage » — patient conscient : 15 g de glucose oral (3 morceaux de sucre, 150 mL de jus de fruit, 1 tube de gel de glucose), recontrôle à 15 min, puis collation. Patient inconscient : glucagon IM ou SC (1 mg, ou glucagon nasal — Baqsimi® 3 mg) ou G30% IV (30-50 mL), puis relais G10% en perfusion. NE JAMAIS administrer de sucre per os à un patient inconscient (risque d'inhalation)
- **Prévention** : le module doit insister sur la prévention — éducation du patient et de l'entourage, adaptation des doses, autosurveillance glycémique, objectifs glycémiques individualisés (plus souples chez le sujet âgé, fragile ou avec antécédent d'hypoglycémie sévère), utilisation du CGM, choix de molécules à faible risque d'hypoglycémie (iDPP-4, aGLP-1, iSGLT2 plutôt que sulfamides)

### Section 14.4 — Acidose lactique et metformine

**Contenu obligatoire** :

- **Mécanisme** : le module doit expliquer que la metformine inhibe le complexe I mitochondrial → en cas d'accumulation (insuffisance rénale, déshydratation, états hypoxiques), ↑ lactate → acidose lactique (type B). L'incidence est très faible (~3-10 cas/100 000 patients-années) mais la mortalité est élevée (30-50%)
- **Facteurs de risque** : insuffisance rénale (contre-indication si DFGe < 30 mL/min, réduction de dose si 30-45), insuffisance hépatique sévère, insuffisance cardiaque décompensée, état de choc, chirurgie majeure, injection de produit de contraste iodé (arrêt temporaire)
- **Diagnostic** : pH < 7,35, lactates > 5 mmol/L, trou anionique augmenté, metforminémie élevée si disponible
- **Traitement** : arrêt de la metformine, réhydratation, épuration extra-rénale (hémodialyse) si acidose sévère (seul moyen d'éliminer la metformine)

## Auto-évaluation — Module 14

**QCM 1** 🥉 : Dans l'ACD, l'insulinothérapie IVSE se fait à la dose de :
- A) 0,01 UI/kg/h
- B) 0,05 UI/kg/h
- C) 0,1 UI/kg/h ✅
- D) 0,5 UI/kg/h
> *Feedback : La dose standard d'insuline IVSE dans l'ACD de l'adulte est 0,1 UI/kg/h (0,05 UI/kg/h chez le jeune enfant). L'objectif est une baisse glycémique de 50-75 mg/dL/h.*

**QCM 2** 🥈 : Le SHH se distingue de l'ACD par :
- A) Une glycémie plus basse
- B) L'absence d'acidose métabolique et une déshydratation plus sévère ✅
- C) La présence de cétonurie massive
- D) Un pH < 7,10
> *Feedback : Le SHH se caractérise par une hyperglycémie majeure (>6 g/L), une hyperosmolalité (>320 mOsm/kg), une déshydratation sévère (8-12 L), SANS acidose métabolique (pH > 7,30, car la sécrétion résiduelle d'insuline inhibe la cétogenèse). La mortalité est plus élevée que celle de l'ACD (10-20%).*

**QCM 3** 🥇 : Un patient DT2 sous metformine 2 g/j, DFGe à 28 mL/min, présente : pH 7,18, lactates 9,5 mmol/L, trou anionique 26. Diagnostic et conduite ?
- A) ACD — insuline IVSE
- B) Acidose lactique associée à la metformine — arrêt metformine + hémodialyse ✅
- C) SHH — réhydratation
- D) Acidose respiratoire — VNI
> *Feedback : Acidose métabolique à trou anionique augmenté + lactates élevés + DFGe < 30 + metformine = acidose lactique associée à la metformine (MALA). CAT : arrêt immédiat de la metformine, réhydratation, hémodialyse en urgence (seul moyen d'épuration efficace de la metformine), prise en charge du facteur déclenchant (ici : la metformine n'aurait PAS dû être poursuivie avec un DFGe < 30 mL/min — contre-indication absolue).*

**Cas clinique** 💎 : Patient A de l'accroche (femme 22 ans, DT1) : K+ = 5,8 mmol/L, Na+ = 128 mmol/L. Calculez le Na+ corrigé. Pouvez-vous démarrer l'insuline IVSE immédiatement ?
> *Réponse : Na+ corrigé = Na+ mesuré + 1,6 × (glycémie g/L - 1) / 1 = 128 + 1,6 × (4,8-1) = 128 + 6,1 = 134,1 mmol/L → hémoconcentration masquée par l'hyperglycémie. K+ = 5,8 → le K+ est élevé mais le K+ total corporel est deplété (acidose). On peut démarrer l'insuline (K+ > 3,5 mmol/L) mais AVEC supplémentation potassique dans la perfusion (20-40 mmol/L de KCl). Monitorer le K+ toutes les 2h les premières heures — il va chuter rapidement sous insuline.*

---

# MODULE 15 : FORMES CLINIQUES PARTICULIÈRES — SUJET ÂGÉ, ENFANT, MIGRANT, PATIENT PSYCHIATRIQUE

**Partie** : IV — Clinique
**Durée estimée** : 3h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 12-14

## Accroche clinique

> 🏥 **Mise en situation** : Mme V., 82 ans, vit seule en appartement. DT2 depuis 20 ans, sous gliclazide 60 mg + metformine 1,7 g/j. HbA1c 6,2%. Hospitalisée pour chute avec fracture de l'extrémité supérieure du fémur. À l'admission, glycémie capillaire 0,42 g/L, confusion. *Son HbA1c trop basse et son sulfamide à cet âge — elle est en sur-traitement. L'hypoglycémie a probablement causé la chute.*

## Objectifs d'apprentissage

1. **Adapter** les objectifs glycémiques chez le sujet âgé selon le profil gériatrique (robuste, fragile, dépendant)
2. **Connaître** les particularités du diabète de l'enfant et de l'adolescent (DT1 et DT2 pédiatrique)
3. **Identifier** les spécificités du diabète chez le patient migrant (formes atypiques, observance, interculturalité)
4. **Gérer** le diabète chez le patient psychiatrique (antipsychotiques, observance, syndrome métabolique)

## Structure du contenu

### Section 15.1 — Diabète du sujet âgé

**Contenu obligatoire** :

- **Objectifs glycémiques individualisés** : le module doit présenter les recommandations HAS (2013) et ADA/EASD pour les objectifs glycémiques chez le sujet âgé :

| Profil gériatrique | HbA1c cible | Justification |
|---|---|---|
| Robuste (autonome, peu de comorbidités, espérance de vie > 5 ans) | ≤ 7% | Prévention des complications à long terme |
| Fragile (comorbidités, chutes, MCI, ADL partiellement dépendant) | ≤ 8% | Éviter les hypoglycémies, préserver la qualité de vie |
| Dépendant (EHPAD, démence, poly-pathologies, espérance de vie limitée) | ≤ 9% (voire plus souple) | Confort, pas de symptômes d'hyper/hypoglycémie |

*(adapté de HAS, Stratégie médicamenteuse du contrôle glycémique du DT2, 2013)*

- **Risques spécifiques** : hypoglycémie (première cause de morbi-mortalité iatrogène chez le sujet âgé diabétique — chutes, fractures, arythmies, AVC, déclin cognitif), déshydratation et SHH (accès limité à l'eau, altération de la soif), dénutrition et sarcopénie, polypharmacie et interactions, insuffisance rénale (adaptation posologique obligatoire)
- **Choix thérapeutiques** : le module doit recommander de privilégier les molécules à faible risque d'hypoglycémie (metformine avec surveillance rénale, iDPP-4, iSGLT2 avec prudence — déshydratation, IU), d'éviter les sulfamides à longue durée d'action et les schémas insuliniques complexes chez le patient fragile/dépendant

### Section 15.2 — Diabète pédiatrique : DT1 et DT2 de l'enfant

**Contenu obligatoire** :

- **DT1 pédiatrique** : le module doit détailler les spécificités — objectifs glycémiques (HbA1c < 7% chez tous les enfants selon l'ISPAD 2022, abandon de l'objectif plus souple < 7,5%), importance du CGM et des pompes à insuline dès le diagnostic, éducation thérapeutique adaptée à l'âge, impact psychosocial (scolarité, sport, vie sociale), transition adolescent → adulte
- **DT2 pédiatrique** : le module doit souligner l'émergence du DT2 chez l'enfant et l'adolescent (épidémie liée à l'obésité pédiatrique), ses spécificités (plus agressif que le DT2 de l'adulte — déclin β-cellulaire plus rapide, complications plus précoces, étude TODAY), le traitement (metformine = seul ADO approuvé < 18 ans + MHD, insuline si décompensation, aGLP-1 = liraglutide approuvé ≥ 10 ans)
- **Dépistage du DT2 pédiatrique** : le module doit présenter les critères ADA — dépistage chez les enfants/ados en surpoids/obèses avec ≥ 1 facteur de risque (antécédent familial DT2, ethnie à risque, signes d'insulinorésistance, DG maternel)

### Section 15.3 — Diabète et migration : formes atypiques et enjeux interculturels

**Contenu obligatoire** :

- **Diabète cétosique du sujet africain (diabète de type 1B ou « Flatbush diabetes »)** : le module doit décrire cette forme atypique — présentation par ACD (mimant un DT1) chez un sujet africain/afro-caribéen/hispanique, souvent en surpoids, auto-anticorps négatifs, suivi d'une rémission prolongée avec sevrage insulinique possible (parfois pendant des mois/années, traitement par ADO). Physiopathologie : dysfonction β-cellulaire transitoire liée à la glucotoxicité aiguë, sur terrain d'insulinorésistance. Classification : « ketosis-prone type 2 diabetes » ou DT2 cétosique *(Mauvais-Jarvis et al., Diabetes Care, 2004)*
- **Formes ethnospécifiques** : le module doit mentionner les seuils d'IMC abaissés pour les populations asiatiques (obésité ≥ 25 vs ≥ 30), la prévalence très élevée chez les populations sud-asiatiques, l'impact du jeûne religieux (Ramadan — cf. recommandations IDF-DAR)
- **Enjeux d'observance** : le module doit aborder les barrières linguistiques, les croyances de santé, l'accès aux soins (AME, CMU), l'alimentation traditionnelle (adaptation diététique culturellement compétente), le rôle de la médiation culturelle

### Section 15.4 — Diabète et psychiatrie

**Contenu obligatoire** :

- **Syndrome métabolique iatrogène** : le module doit expliquer que les antipsychotiques atypiques (olanzapine >> clozapine > quétiapine > rispéridone > aripiprazole) causent une prise de poids, une dyslipidémie et un DT2 par insulinorésistance + effet direct sur la sécrétion d'insuline. Recommandations de surveillance : glycémie, lipides, poids, tour de taille à l'instauration puis régulièrement
- **Observance** : le module doit aborder les défis d'observance chez les patients avec troubles psychiatriques sévères — schizophrénie, trouble bipolaire, dépression majeure — et les stratégies adaptées (simplification du traitement, traitements injectables hebdomadaires, coordination psychiatre-diabétologue, programmes d'accompagnement)
- **Dépression et diabète** : le module doit souligner la bidirectionnalité — le diabète augmente le risque de dépression (× 2) et la dépression aggrave l'observance et le contrôle glycémique. Dépistage systématique recommandé (PHQ-2/PHQ-9)

## Auto-évaluation — Module 15

**QCM 1** 🥈 : Chez une patiente de 85 ans, dépendante en EHPAD, l'objectif d'HbA1c recommandé est :
- A) < 6,5%
- B) < 7%
- C) < 8%
- D) ≤ 9% ✅
> *Feedback : Chez un patient âgé dépendant avec espérance de vie limitée, l'objectif est ≤ 9% (voire plus souple) — la priorité est le confort, l'absence de symptômes d'hyper/hypoglycémie, et la prévention des complications aiguës. Un sur-traitement (HbA1c trop basse) expose au risque d'hypoglycémie, première cause de morbi-mortalité iatrogène dans cette population.*

**QCM 2** 🥇 : Un homme de 40 ans, originaire du Cameroun, IMC 28, est admis en ACD (glycémie 4,50 g/L, pH 7,18, cétonémie 5,8). Auto-anticorps négatifs. Après stabilisation, ses besoins en insuline diminuent rapidement. Quel diagnostic évoquez-vous ?
- A) DT1 classique
- B) LADA
- C) Diabète cétosique du sujet africain (DT2 cétosique) ✅
- D) MODY
> *Feedback : Le diabète cétosique du sujet africain (« Flatbush diabetes ») se présente par une ACD mimant un DT1, mais les auto-anticorps sont négatifs, le patient est souvent en surpoids, et une rémission prolongée avec sevrage insulinique est possible. Le mécanisme est une dysfonction β-cellulaire transitoire liée à la glucotoxicité aiguë. Après la phase aiguë, le patient peut être traité par ADO (metformine ± sulfamide) avec surveillance de la cétonémie.*

---

# RÉFÉRENCES — PARTIE 4 (Modules 12-15)

1. Wolfsdorf JI, Glaser N, Agus M, et al. ISPAD Clinical Practice Consensus Guidelines 2018: Diabetic ketoacidosis and the hyperglycemic hyperosmolar state. *Pediatr Diabetes*. 2018;19(Suppl 27):155-177.
2. International Hypoglycaemia Study Group. Glucose concentrations of less than 3.0 mmol/L (54 mg/dL) should be reported in clinical trials: a joint position statement. *Diabetologia*. 2017;60(1):3-6.
3. Harris MI, Klein R, Welborn TA, Knuiman MW. Onset of NIDDM occurs at least 4-7 yr before clinical diagnosis. *Diabetes Care*. 1992;15(7):815-819.
4. Alberti KGMM, Eckel RH, Grundy SM, et al. Harmonizing the metabolic syndrome: a joint interim statement of the IDF/NHLBI/AHA/WHF/IAS/IASO. *Circulation*. 2009;120(16):1640-1645.
5. HAS. Stratégie médicamenteuse du contrôle glycémique du diabète de type 2. Recommandations de bonne pratique. 2013.
6. Mauvais-Jarvis F, Sobngwi E, Porcher R, et al. Ketosis-prone type 2 diabetes in patients of sub-Saharan African origin. *Diabetes*. 2004;53(3):645-653.
7. TODAY Study Group. A clinical trial to maintain glycemic control in youth with type 2 diabetes. *N Engl J Med*. 2012;366(24):2247-2256.
8. Kitabchi AE, Umpierrez GE, Miles JM, Fisher JN. Hyperglycemic crises in adult patients with diabetes. *Diabetes Care*. 2009;32(7):1335-1343.

---

*Partie 4 — Modules 12-15 — Document conforme à la charte VERTEX© — Version 1.0 — 13 mars 2026*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 5 — Complications Microvasculaires (Modules 16-18)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 16 : RÉTINOPATHIE DIABÉTIQUE — DÉPISTAGE, CLASSIFICATION, TRAITEMENT

**Partie** : V — Complications microvasculaires
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 5-6, 14

## Accroche clinique

> 🏥 **Mise en situation** : Mme D., 52 ans, DT2 découvert il y a 12 ans, HbA1c oscillant entre 8,5 et 9,5 % ces 5 dernières années. Elle consulte pour « vision floue depuis 2 mois ». Le fond d'œil révèle des hémorragies rétiniennes en flammèches, des exsudats secs en couronne maculaire et des microanévrismes diffus. L'OCT montre un œdème maculaire cystoïde de 450 µm d'épaisseur. *La rétinopathie diabétique reste la première cause de cécité avant 65 ans dans les pays industrialisés — et pourtant, un dépistage annuel aurait permis une prise en charge bien plus précoce.*

## Objectifs d'apprentissage

1. **Décrire** la physiopathologie de la rétinopathie diabétique : hyperglycémie → voie des polyols, PKC, AGE, stress oxydatif → dysfonction endothéliale → rupture BHR
2. **Classer** la rétinopathie selon la classification internationale simplifiée (ETDRS adaptée) : absente, RDNP minime, modérée, sévère (règle du 4-2-1), RDP
3. **Interpréter** les examens complémentaires : rétinophotographie, OCT maculaire, angiographie à la fluorescéine, OCT-angiographie
4. **Appliquer** les stratégies de dépistage : rythme, modalités (mydriase/non-mydriase), télé-ophtalmologie, IA de screening
5. **Prescrire** le traitement adapté au stade : contrôle glycémique, IVT anti-VEGF (ranibizumab, aflibercept, faricimab), photocoagulation panrétinienne, corticoïdes intravitréens
6. **Gérer** les situations à risque : grossesse, amélioration glycémique rapide (« early worsening »), chirurgie de la cataracte

## Structure du contenu

### Section 1 — Épidémiologie et physiopathologie rétinienne

> Le module doit présenter les données épidémiologiques actuelles de la rétinopathie diabétique :

**Contenu obligatoire :**

- **Épidémiologie** : prévalence globale ~35 % des diabétiques (toutes formes), ~7 % de RDP, ~7 % d'œdème maculaire diabétique (OMD) ; incidence cumulée à 20 ans : ~80 % DT1, ~60 % DT2 (données Wisconsin Epidemiologic Study of Diabetic Retinopathy — Klein et al., 1984-2008)
- **Facteurs de risque** : durée du diabète (facteur principal), équilibre glycémique (DCCT : réduction de 76 % du risque de RD par contrôle intensif — DCCT Research Group, N Engl J Med, 1993), HTA (UKPDS : réduction de 34 % par contrôle tensionnel strict — UKPDS Group, BMJ, 1998), dyslipidémie, néphropathie associée, grossesse
- **Physiopathologie** : le module doit détailler les 4 voies biochimiques majeures activées par l'hyperglycémie chronique :
  - Voie des polyols (aldose réductase → sorbitol → fructose → déplétion NADPH → stress oxydatif)
  - Activation de la protéine kinase C (PKC-β → VEGF ↑, endothéline-1 ↑, TGF-β ↑)
  - Glycation non enzymatique (AGE → récepteur RAGE → NF-κB → inflammation)
  - Voie des hexosamines (UDP-GlcNAc → modification post-traductionnelle → dysfonction cellulaire)
- **Conséquences vasculaires** : perte des péricytes → microanévrismes → rupture de la barrière hémato-rétinienne (BHR) interne → exsudation → ischémie → néovascularisation VEGF-dépendante
- **Rôle de l'inflammation** : leucostase, activation microgliale, cytokines pro-inflammatoires (IL-1β, TNF-α, MCP-1)

> [MEDIA: 🔬 MDIAB16-S01-001 — SCHÉMA VOIES BIOCHIMIQUES DE L'HYPERGLYCÉMIE RÉTINIENNE (polyols, PKC, AGE, hexosamines → dysfonction endothéliale → rupture BHR)]

> [MEDIA: 📊 MDIAB16-S01-002 — GRAPHIQUE PRÉVALENCE RD EN FONCTION DE LA DURÉE DU DIABÈTE (DT1 vs DT2, données Klein et al.)]

> [MEDIA: 🔬 MDIAB16-S01-003 — SCHÉMA PROGRESSION MICROVASCULAIRE (péricyte normal → perte péricytaire → microanévrisme → rupture BHR → ischémie → néovascularisation)]

### Section 2 — Classification et sémiologie du fond d'œil

> Le module doit présenter la classification internationale et la sémiologie rétinienne :

**Contenu obligatoire :**

- **Classification internationale simplifiée** (adaptée de l'ETDRS — Wilkinson et al., Ophthalmology, 2003) :
  - **Pas de RD apparente** : aucune anomalie
  - **RDNP minime** : microanévrismes isolés uniquement
  - **RDNP modérée** : microanévrismes + hémorragies punctiformes, exsudats secs, nodules cotonneux (< seuil sévère)
  - **RDNP sévère** : règle du 4-2-1 (hémorragies rétiniennes dans 4 quadrants OU veines en chapelet dans ≥ 2 quadrants OU AMIR dans ≥ 1 quadrant) — risque de progression vers RDP de 50 % à 1 an
  - **RDP** : néovaisseaux prérétiniens ou prépapillaires ± hémorragie intravitréenne ± décollement de rétine tractionnel
- **Œdème maculaire diabétique (OMD)** : classification à part, peut survenir à tout stade ; OMD cliniquement significatif (adapté de l'ETDRS) : épaississement rétinien ≤ 500 µm du centre, exsudats secs ≤ 500 µm du centre avec épaississement adjacent, zone d'épaississement ≥ 1 diamètre papillaire dont une partie ≤ 1 DP du centre
- **Sémiologie détaillée** : le module doit illustrer chaque lésion élémentaire avec rétinophotographies commentées :
  - Microanévrismes (points rouges < 125 µm)
  - Hémorragies punctiformes (intra-rétiniennes profondes) et en flammèches (couche des fibres)
  - Exsudats secs (dépôts lipidiques jaunes, disposition circinée)
  - Nodules cotonneux (ischémie focale couche des fibres)
  - AMIR (anomalies microvasculaires intra-rétiniennes — shunts)
  - Veines en chapelet (irrégularités calibre veineux = ischémie sévère)
  - Néovaisseaux (pré-rétiniens, pré-papillaires — aspect en « dentelle »)

> [MEDIA: 👁️ MDIAB16-S02-001 — ATLAS RÉTINOPHOTOGRAPHIQUE LÉSIONS ÉLÉMENTAIRES (microanévrismes, hémorragies, exsudats, nodules cotonneux, AMIR, néovaisseaux — photos commentées)]

> [MEDIA: 📋 MDIAB16-S02-002 — TABLEAU CLASSIFICATION INTERNATIONALE SIMPLIFIÉE RD (stade, lésions, risque de progression, CAT)]

> [MEDIA: 👁️ MDIAB16-S02-003 — COMPARATIF OCT MACULAIRE NORMAL vs OMD FOCAL vs OMD DIFFUS (coupes transversales annotées)]

### Section 3 — Dépistage et examens complémentaires

> Le module doit présenter les stratégies de dépistage et les outils diagnostiques :

**Contenu obligatoire :**

- **Dépistage systématique** (recommandations HAS 2010, ADA 2024, AAO 2024) :
  - DT1 : premier dépistage à 5 ans du diagnostic (3 ans si puberté), puis annuel
  - DT2 : dépistage dès le diagnostic (RD présente dans 20 % des cas au diagnostic), puis annuel
  - Grossesse : fond d'œil avant conception ou au 1er trimestre, puis trimestriel, puis post-partum
  - Rythme adapté : tous les 2 ans si DT2 bien équilibré sans RD depuis > 2 examens normaux consécutifs
- **Rétinophotographie** : 2 champs minimum (macula + papille), non mydriatique en dépistage, mydriatique si anomalie ; télé-ophtalmologie (réseau OPHDIAT en France — Massin et al., Diabetes Care, 2008)
- **Intelligence artificielle** : algorithmes de screening validés FDA (IDx-DR/LumineticsCore — Abràmoff et al., npj Digital Medicine, 2018 ; EyeArt — Bhaskaranand et al., JAMA Ophthalmol, 2019) ; sensibilité > 87 %, spécificité > 90 % pour RDNP modérée référable ; limites (qualité image, cas limites, responsabilité médico-légale)
- **OCT maculaire** : examen de référence pour l'OMD ; mesure épaisseur rétinienne centrale (normale < 300 µm selon appareil) ; identification compartiments liquidiens (intrarétinien, sous-rétinien) ; biomarqueurs pronostiques (DRIL, points hyperréflectifs, état de la ligne ellipsoïde)
- **Angiographie à la fluorescéine** : indications (RDNP sévère/RDP, OMD réfractaire, diagnostic différentiel) ; signes (diffusion, non-perfusion capillaire, néovaisseaux) ; effets indésirables (nausées 5 %, allergie < 1 %, anaphylaxie < 0,05 %)
- **OCT-angiographie (OCTA)** : non invasive, visualisation des plexus capillaires superficiel et profond, zone avasculaire fovéolaire, détection néovaisseaux ; limites (champ limité, artefacts de mouvement)

> [MEDIA: 📊 MDIAB16-S03-001 — ALGORITHME DÉCISIONNEL DÉPISTAGE RD (DT1 vs DT2, rythme, télé-ophtalmologie, critères de référence ophtalmologique)]

> [MEDIA: 🖥️ MDIAB16-S03-002 — CAPTURE D'ÉCRAN IA SCREENING RD (image rétinienne + analyse automatisée + niveau de confiance + recommandation)]

> [MEDIA: 👁️ MDIAB16-S03-003 — COMPARATIF IMAGERIE RÉTINIENNE (rétinophoto couleur vs angiographie fluorescéine vs OCT vs OCTA — même patient RDNP sévère)]

### Section 4 — Traitement de la rétinopathie diabétique

> Le module doit présenter la prise en charge thérapeutique selon le stade :

**Contenu obligatoire :**

- **Contrôle des facteurs de risque** : optimisation glycémique (cible HbA1c individualisée), contrôle tensionnel (cible < 130/80 mmHg), traitement dyslipidémie ; fénofibrate (effet rétino-protecteur indépendant des lipides — études FIELD et ACCORD Eye, Chew et al., N Engl J Med, 2010)
- **Attention au « early worsening »** : aggravation paradoxale de la RD lors de l'amélioration glycémique rapide (↓ HbA1c > 2 % en 6 mois) ; mécanisme : vasoconstriction rétinienne par normalisation glycémique → ischémie relative ; CAT : dépistage renforcé, amélioration progressive de l'HbA1c
- **Injections intravitréennes (IVT) anti-VEGF** — traitement de 1ère intention de l'OMD avec atteinte centrale :
  - Ranibizumab 0,5 mg (Lucentis®) — études RISE/RIDE, RESTORE
  - Aflibercept 2 mg (Eylea®) — étude VIVID/VISTA ; nouvelle formulation 8 mg (Eylea HD®) — étude PHOTON (intervalles prolongés jusqu'à 16 semaines)
  - Faricimab 6 mg (Vabysmo®) — anti-VEGF-A + anti-Ang-2 bispecifique — études YOSEMITE/RHINE (non-infériorité avec intervalles jusqu'à 16 semaines)
  - Protocole : induction 3-5 IVT mensuelles puis PRN ou treat-and-extend ; gain moyen +8-10 lettres ETDRS à 1 an
- **Photocoagulation panrétinienne (PPR)** : traitement de référence de la RDP ; étude DRS (réduction de 50 % du risque de cécité sévère — DRS Research Group, 1978) ; technique : 1200-1600 impacts, 3-4 séances, laser argon ou multispot (PASCAL) ; effets secondaires : restriction champ visuel, héméralopie, douleur, OMD post-PPR
- **Comparaison IVT anti-VEGF vs PPR dans la RDP** : étude DRCR.net Protocol S (Gross et al., JAMA, 2015) — ranibizumab non inférieur à PPR à 2 ans avec meilleur champ visuel et moins d'OMD ; mais compliance aux IVT nécessaire
- **Corticoïdes intravitréens** : 2e intention si OMD réfractaire aux anti-VEGF ou pseudo-phaque ; implant de dexaméthasone 0,7 mg (Ozurdex® — étude MEAD, 4-6 mois) ; implant de fluocinolone 0,19 mg (Iluvien® — étude FAME, 3 ans) ; effets secondaires : cataracte (50-80 %), hypertonie oculaire (30-40 %)
- **Vitrectomie** : indications (hémorragie intravitréenne persistante > 1-3 mois, décollement de rétine tractionnel menaçant/atteignant la macula, RDP floride ne répondant pas au traitement)
- **Traitements émergents** : anti-VEGF à libération prolongée (port delivery system — PDS ranibizumab), inhibiteurs de la voie du complément, thérapie génique (RGX-314 — vecteur AAV codant pour ranibizumab), biothérapies anti-Ang-2, agonistes du récepteur Tie-2

> [MEDIA: 📋 MDIAB16-S04-001 — ALGORITHME THÉRAPEUTIQUE RD SELON STADE (RDNP minime → surveillance, RDNP sévère → surveillance rapprochée ± anti-VEGF, RDP → PPR ± anti-VEGF, OMD → anti-VEGF 1ère ligne)]

> [MEDIA: 💉 MDIAB16-S04-002 — COMPARATIF MOLÉCULES ANTI-VEGF DANS L'OMD (ranibizumab, aflibercept, faricimab — mécanisme, posologie, essais, intervalles)]

> [MEDIA: 👁️ MDIAB16-S04-003 — PHOTOS AVANT/APRÈS PPR (rétinophoto pré-PPR avec néovaisseaux vs post-PPR avec impacts laser et régression néovasculaire)]

## Points clés — Module 16

> 🎯 **Essentiel à retenir**
> 1. La RD est la 1ère cause de cécité avant 65 ans — dépistage annuel obligatoire (rétinophotographie)
> 2. Classification : RDNP minime → modérée → sévère (règle 4-2-1) → RDP (néovaisseaux)
> 3. L'OMD est une entité distincte, possible à tout stade, 1ère cause de baisse d'acuité visuelle
> 4. Traitement OMD central : IVT anti-VEGF en 1ère intention (faricimab, aflibercept 8 mg = intervalles prolongés)
> 5. Traitement RDP : PPR reste le standard ; anti-VEGF alternatif si compliance assurée (Protocol S)
> 6. Attention au « early worsening » : amélioration glycémique rapide peut aggraver la RD → surveillance renforcée
> 7. L'IA de screening (IDx-DR, EyeArt) permet un dépistage autonome en soins primaires
> 8. Le fénofibrate a un effet rétino-protecteur indépendant de son effet lipidique (FIELD, ACCORD Eye)

## Auto-évaluation — Module 16

### QCM progressifs (12 questions)

**Q1 — 🥉 Bronze** : Quelle est la lésion la plus précoce de la rétinopathie diabétique ?
A. Néovaisseaux prépapillaires
B. Microanévrismes
C. Hémorragie intravitréenne
D. Nodules cotonneux
> ✅ **B** — Les microanévrismes sont les premières lésions visibles, résultant de la perte des péricytes. Leur présence isolée définit la RDNP minime.

**Q2 — 🥉 Bronze** : À quel rythme le dépistage de la RD doit-il être réalisé chez un DT2 bien équilibré sans rétinopathie ?
A. Tous les 6 mois
B. Tous les ans
C. Tous les 2 ans (si ≥ 2 FO normaux consécutifs)
D. Tous les 5 ans
> ✅ **C** — Les recommandations permettent un espacement à 2 ans si DT2 bien équilibré et ≥ 2 FO normaux consécutifs. Sinon, rythme annuel.

**Q3 — 🥈 Argent** : La règle du « 4-2-1 » définit la RDNP sévère. Que signifie-t-elle ?
A. 4 IVT par an, 2 séances PPR, 1 vitrectomie
B. 4 quadrants d'hémorragies OU 2 quadrants de veines en chapelet OU 1 quadrant d'AMIR
C. 4 microanévrismes par quadrant, 2 nodules cotonneux, 1 exsudat sec
D. 4 mois de suivi, 2 OCT, 1 angiographie
> ✅ **B** — La règle 4-2-1 (hémorragies dans 4 quadrants OU veines en chapelet dans ≥ 2 quadrants OU AMIR dans ≥ 1 quadrant) définit la RDNP sévère avec un risque de 50 % de progression vers la RDP à 1 an.

**Q4 — 🥈 Argent** : Quel examen est la référence pour le diagnostic et le suivi de l'œdème maculaire diabétique ?
A. Rétinophotographie couleur
B. Angiographie à la fluorescéine
C. OCT maculaire
D. Échographie mode B
> ✅ **C** — L'OCT maculaire permet de mesurer l'épaisseur rétinienne centrale, d'identifier les compartiments liquidiens et les biomarqueurs pronostiques (DRIL, points hyperréflectifs, ligne ellipsoïde).

**Q5 — 🥈 Argent** : Quel est le traitement de 1ère intention de l'OMD avec atteinte centrale ?
A. Photocoagulation maculaire en grille
B. Injections intravitréennes d'anti-VEGF
C. Corticoïdes intravitréens (Ozurdex®)
D. Vitrectomie
> ✅ **B** — Les IVT anti-VEGF sont le traitement de 1ère intention de l'OMD central, avec un gain moyen de +8-10 lettres ETDRS à 1 an (études RISE/RIDE, VIVID/VISTA, YOSEMITE/RHINE).

**Q6 — 🥈 Argent** : Qu'est-ce que le phénomène d'« early worsening » ?
A. Aggravation de la RD après chirurgie de la cataracte
B. Aggravation paradoxale de la RD lors d'une amélioration glycémique rapide
C. Progression rapide de la RD pendant la grossesse
D. Aggravation de l'OMD après PPR
> ✅ **B** — L'« early worsening » est l'aggravation paradoxale de la RD lorsque l'HbA1c diminue de > 2 % en 6 mois, par vasoconstriction rétinienne et ischémie relative. Il justifie une surveillance ophtalmologique renforcée et une amélioration glycémique progressive.

**Q7 — 🥇 Or** : Quel avantage du faricimab par rapport aux anti-VEGF conventionnels ?
A. Meilleure acuité visuelle finale
B. Mécanisme bispecifique anti-VEGF-A + anti-Ang-2 permettant des intervalles prolongés
C. Absence totale d'effets secondaires
D. Administration en collyre
> ✅ **B** — Le faricimab est le premier anti-VEGF bispecifique (anti-VEGF-A + anti-Ang-2), normalisant la vasculature rétinienne et permettant des intervalles jusqu'à 16 semaines (études YOSEMITE/RHINE).

**Q8 — 🥇 Or** : Dans l'étude Protocol S (DRCR.net), quel est le résultat principal comparant ranibizumab vs PPR dans la RDP ?
A. La PPR est supérieure en termes d'acuité visuelle
B. Le ranibizumab est non inférieur à la PPR avec meilleur champ visuel et moins d'OMD
C. Le ranibizumab est inférieur à la PPR
D. Pas de différence significative sur aucun critère
> ✅ **B** — Protocol S montre la non-infériorité du ranibizumab vs PPR à 2 ans, avec un champ visuel mieux préservé et moins d'OMD secondaire, mais nécessitant une compliance aux injections répétées.

**Q9 — 🥇 Or** : Quel effet du fénofibrate sur la rétinopathie diabétique ?
A. Aucun effet prouvé
B. Effet rétino-protecteur uniquement via la baisse des triglycérides
C. Effet rétino-protecteur indépendant de l'effet lipidique (FIELD, ACCORD Eye)
D. Aggravation de la rétinopathie
> ✅ **C** — Le fénofibrate réduit la progression de la RD de 30-40 % indépendamment de son effet sur les lipides (études FIELD et ACCORD Eye). Le mécanisme implique des effets anti-inflammatoires et anti-apoptotiques via PPARα.

**Q10 — 🥇 Or** : Quels sont les effets secondaires principaux des corticoïdes intravitréens dans l'OMD ?
A. Hémorragie intravitréenne et décollement de rétine
B. Cataracte (50-80 %) et hypertonie oculaire (30-40 %)
C. Endophtalmie et atrophie optique
D. Kératite et sécheresse oculaire
> ✅ **B** — Les corticoïdes intravitréens (Ozurdex®, Iluvien®) induisent fréquemment une cataracte (50-80 %) et une hypertonie oculaire (30-40 %), ce qui limite leur utilisation en 1ère intention et favorise leur emploi chez les patients pseudo-phaques.

**Q11 — 💎 Diamant** : Une patiente DT1 de 28 ans, enceinte de 8 SA, a une RDNP modérée. Quelle surveillance ophtalmologique proposez-vous ?
A. Fond d'œil annuel comme habituellement
B. Fond d'œil trimestriel pendant la grossesse + post-partum
C. Fond d'œil uniquement au 3e trimestre
D. PPR préventive immédiate
> ✅ **B** — La grossesse est un facteur de risque majeur de progression de la RD. La surveillance doit être trimestrielle (1er, 2e, 3e trimestre) avec un contrôle post-partum. En cas de progression rapide vers une RDNP sévère/RDP, la PPR doit être réalisée pendant la grossesse.

**Q12 — 💎 Diamant** : Un patient DT2 avec une RDP à haut risque et un OMD central bilatéral. Quelle stratégie thérapeutique proposez-vous ?
A. PPR seule bilatérale
B. IVT anti-VEGF seules bilatérales
C. IVT anti-VEGF pour l'OMD + PPR pour la RDP, en débutant par les anti-VEGF
D. Vitrectomie bilatérale d'emblée
> ✅ **C** — En cas d'association RDP + OMD central, la stratégie recommandée est de débuter par les IVT anti-VEGF (qui traitent l'OMD et peuvent faire régresser partiellement la néovascularisation), puis de compléter par la PPR pour la RDP. La PPR en premier pourrait aggraver l'OMD.

### Cas clinique intégré — Module 16

> 📝 **Cas clinique : M. R., 58 ans, DT2 depuis 15 ans**
>
> M. R., chauffeur routier, DT2 traité par metformine + gliclazide. HbA1c : 9,2 %. HTA traitée par ramipril 10 mg (PA : 148/92 mmHg). Pas de fond d'œil depuis 4 ans. Consulte pour renouvellement de son permis de conduire.
>
> **Rétinophotographie** : hémorragies rétiniennes dans les 4 quadrants, veines en chapelet dans 2 quadrants, quelques AMIR. Exsudats secs en couronne maculaire OG.
> **OCT OG** : épaisseur maculaire centrale 520 µm, kystes intrarétiniens, liquide sous-rétinien.
> **AV** : OD 8/10, OG 4/10.
>
> **Questions :**
> 1. Quel est le stade de la rétinopathie ? Justifiez par la règle du 4-2-1.
> 2. Quel diagnostic complémentaire portez-vous à l'OG ? Argumentez.
> 3. Quelle prise en charge ophtalmologique proposez-vous ?
> 4. Quelles mesures non ophtalmologiques sont indispensables ?
> 5. Quelles implications pour le permis de conduire de catégorie professionnelle ?

### Question de synthèse

> 🔄 **Synthèse** : Décrivez l'algorithme complet de prise en charge d'un patient diabétique depuis le dépistage de la RD jusqu'au traitement, en intégrant : rythme de dépistage, examens complémentaires selon le stade, traitement de la RDNP sévère/RDP, traitement de l'OMD, et surveillance post-thérapeutique.

---

# MODULE 17 : NÉPHROPATHIE DIABÉTIQUE — DU DÉPISTAGE À LA DIALYSE

**Partie** : V — Complications microvasculaires
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 5-6, 14

## Accroche clinique

> 🏥 **Mise en situation** : M. K., 62 ans, DT2 depuis 18 ans, se présente avec un bilan biologique réalisé en ville : créatinine 185 µmol/L (DFG estimé CKD-EPI 35 mL/min/1,73 m²), albuminurie sur échantillon 850 mg/g de créatinine. Il est traité par metformine 2 g/j et gliclazide 60 mg/j. Sa PA est à 155/95 mmHg sous amlodipine 10 mg. Il n'a jamais eu de dosage d'albuminurie auparavant. *La néphropathie diabétique est la 1ère cause d'insuffisance rénale terminale dans le monde — ce patient a déjà un stade G3b A3, une prise en charge précoce aurait changé son pronostic rénal.*

## Objectifs d'apprentissage

1. **Décrire** l'histoire naturelle de la néphropathie diabétique selon les stades de Mogensen (DT1) et leur adaptation au DT2
2. **Interpréter** les marqueurs de dépistage : albuminurie (RAC), DFG estimé (CKD-EPI 2021), classification KDIGO
3. **Connaître** la physiopathologie glomérulaire : hyperfiltration, expansion mésangiale, glomérulosclérose nodulaire (Kimmelstiel-Wilson)
4. **Prescrire** le traitement néphroprotecteur : bloqueurs du SRAA, iSGLT2, finérénone
5. **Adapter** le traitement antidiabétique au stade d'IRC
6. **Savoir** quand adresser au néphrologue et préparer la suppléance rénale

## Structure du contenu

### Section 1 — Épidémiologie et physiopathologie rénale

> Le module doit présenter la physiopathologie de l'atteinte rénale diabétique :

**Contenu obligatoire :**

- **Épidémiologie** : la néphropathie diabétique (ND) est la 1ère cause d'insuffisance rénale terminale (IRT) dans le monde (30-50 % des patients en dialyse) ; prévalence de la MRC chez les diabétiques : ~40 % (DT1 et DT2 confondus) ; incidence cumulée d'IRT à 30 ans : ~20 % DT1 (en amélioration grâce au contrôle glycémique et tensionnel), variable DT2
- **Physiopathologie hémodynamique** : le module doit détailler les mécanismes :
  - Phase précoce : hyperfiltration glomérulaire (DFG > 130-150 mL/min) par vasodilatation afférente (hyperglycémie → cotransporteur SGLT2 → réabsorption glucose-sodium ↑ → ↓ NaCl au macula densa → ↓ feedback tubulo-glomérulaire → vasodilatation afférente) + vasoconstriction efférente (angiotensine II) → ↑ pression intraglomérulaire
  - Phase intermédiaire : épaississement membrane basale glomérulaire, expansion mésangiale, perte des podocytes → albuminurie progressive
  - Phase avancée : glomérulosclérose nodulaire (nodules de Kimmelstiel-Wilson — pathognomoniques), fibrose tubulo-interstitielle → déclin DFG
- **Physiopathologie métabolique** : les mêmes voies que la RD (polyols, PKC, AGE, hexosamines) + activation SRAA local rénal + inflammation (NF-κB, TGF-β, CTGF) + fibrose (transition épithélio-mésenchymateuse)
- **Facteurs de risque de progression** : mauvais contrôle glycémique, HTA (surtout systolique), tabac, dyslipidémie, albuminurie de base élevée, origine ethnique (Afro-Américains, Amérindiens, Hispaniques), facteurs génétiques
- **Non-diabetic kidney disease (NDKD)** : 20-40 % des patients diabétiques avec MRC n'ont pas de ND typique ; indices cliniques : hématurie glomérulaire, absence de RD associée, déclin DFG rapide atypique, début brutal → biopsie rénale à discuter

> [MEDIA: 🔬 MDIAB17-S01-001 — SCHÉMA PHYSIOPATHOLOGIE GLOMÉRULAIRE (hyperfiltration → expansion mésangiale → glomérulosclérose — rôle SGLT2, SRAA, podocytes)]

> [MEDIA: 🔬 MDIAB17-S01-002 — HISTOLOGIE RÉNALE COMPARÉE (glomérule normal vs expansion mésangiale diffuse vs nodules de Kimmelstiel-Wilson vs glomérulosclérose avancée)]

> [MEDIA: 📊 MDIAB17-S01-003 — COURBE HISTOIRE NATURELLE ND (DFG et albuminurie en fonction du temps — stades de Mogensen)]

### Section 2 — Dépistage, classification et diagnostic

> Le module doit présenter le dépistage et la classification de la maladie rénale chronique diabétique :

**Contenu obligatoire :**

- **Dépistage** (recommandations KDIGO 2024, HAS, ADA 2024) :
  - **Albuminurie** : rapport albumine/créatinine urinaire (RAC) sur échantillon matinal ; seuils : normal < 30 mg/g, modérément augmentée (A2, ex-« microalbuminurie ») 30-300 mg/g, sévèrement augmentée (A3, ex-« macroalbuminurie ») > 300 mg/g ; confirmation sur 2/3 échantillons à 3-6 mois d'intervalle (faux positifs : fièvre, exercice, infection urinaire, HTA déséquilibrée, insuffisance cardiaque)
  - **DFG estimé** : formule CKD-EPI 2021 (sans coefficient ethnique) recommandée ; cystatine C si doute (IMC extrêmes, amyotrophie, régime végétarien)
  - **Rythme** : DT1 à partir de 5 ans de diabète, DT2 dès le diagnostic ; annuel (RAC + créatinine + DFG)
- **Classification KDIGO** (adapté de KDIGO 2024) : matrice bidimensionnelle DFG (G1-G5) × albuminurie (A1-A3) → couleur de risque (vert, jaune, orange, rouge, rouge foncé) → fréquence de surveillance et urgence de prise en charge
- **Stades de Mogensen** (adapté de Mogensen, Diabetologia, 1983 — référence historique DT1) :
  - Stade 1 : hyperfiltration (DFG ↑, normoalbuminurie)
  - Stade 2 : lésions histologiques silencieuses (normoalbuminurie, épaississement MB)
  - Stade 3 : néphropathie incipiens (microalbuminurie 30-300 mg/g, DFG normal/↑)
  - Stade 4 : néphropathie avérée (macroalbuminurie > 300 mg/g, HTA, déclin DFG ~10 mL/min/an sans traitement)
  - Stade 5 : insuffisance rénale terminale (DFG < 15, dialyse)
- **Quand biopsier ?** : indications de ponction-biopsie rénale chez le diabétique : hématurie glomérulaire, protéinurie sans RD associée (la concordance rétinopatho-néphropathie est un argument fort pour la ND), déclin DFG > 5 mL/min/an, syndrome néphrotique d'apparition brutale, durée de diabète < 5 ans avec néphropathie, signes extrarénaux de maladie systémique

> [MEDIA: 📋 MDIAB17-S02-001 — MATRICE KDIGO HEAT MAP (DFG G1-G5 × Albuminurie A1-A3 — couleurs de risque, fréquence de surveillance)]

> [MEDIA: 📊 MDIAB17-S02-002 — ALGORITHME DÉPISTAGE ET CONFIRMATION ALBUMINURIE (échantillon matinal → confirmation → classification → CAT)]

> [MEDIA: 📋 MDIAB17-S02-003 — TABLEAU INDICATIONS DE BIOPSIE RÉNALE CHEZ LE DIABÉTIQUE (critères, arguments pour ND typique vs atypique)]

### Section 3 — Traitement néphroprotecteur

> Le module doit présenter les stratégies de néphroprotection fondées sur les preuves :

**Contenu obligatoire :**

- **Bloqueurs du système rénine-angiotensine-aldostérone (SRAA)** :
  - IEC (ramipril, énalapril, lisinopril) ou ARA2 (losartan, irbésartan, valsartan) en 1ère intention si albuminurie ≥ A2 même si PA normale
  - Preuves : étude RENAAL (losartan — Brenner et al., N Engl J Med, 2001 : réduction de 16 % du doublement de créatinine), IDNT (irbésartan — Lewis et al., N Engl J Med, 2001), IRMA-2 (irbésartan prévention progression micro→macroalbuminurie)
  - Précautions : surveillance créatinine + kaliémie à J7-J14 post-introduction ; tolérer ↑ créatinine ≤ 30 % ; ne pas associer IEC + ARA2 (étude ONTARGET : pas de bénéfice rénal, plus d'effets indésirables — Yusuf et al., N Engl J Med, 2008)
  - Cible tensionnelle : < 130/80 mmHg (< 120 mmHg systolique si albuminurie > 1 g/g selon KDIGO 2021)
- **Inhibiteurs du SGLT2 (iSGLT2)** — révolution néphroprotectrice :
  - Mécanisme rénal : restauration du feedback tubulo-glomérulaire → vasoconstriction afférente → ↓ pression intraglomérulaire → ↓ hyperfiltration et albuminurie ; effets additionnels (natriurèse, ↓ poids, ↓ uricémie, ↓ inflammation tubulo-interstitielle)
  - Preuves dans la ND : CREDENCE (canagliflozine — Perkovic et al., N Engl J Med, 2019 : réduction de 30 % du critère rénal composite, arrêt prématuré pour efficacité), DAPA-CKD (dapagliflozine — Heerspink et al., N Engl J Med, 2020 : réduction de 39 % du critère rénal, bénéfice aussi chez non-diabétiques), EMPA-KIDNEY (empagliflozine — Herrington et al., N Engl J Med, 2023 : réduction de 28 % progression MRC)
  - Indications KDIGO 2024 : iSGLT2 recommandé pour tout patient DT2 avec DFG ≥ 20 mL/min ET RAC ≥ 30 mg/g ; à poursuivre même si DFG < 20 jusqu'à la dialyse
  - « Dip and recovery » : baisse initiale du DFG de 3-5 mL/min (réversible, reflet de la correction hémodynamique) → ne pas arrêter le traitement
- **Finérénone** (antagoniste sélectif non stéroïdien des récepteurs des minéralocorticoïdes — ARM) :
  - Preuves : FIDELIO-DKD (Bakris et al., N Engl J Med, 2020 : réduction de 18 % du critère rénal composite), FIGARO-DKD (Pitt et al., N Engl J Med, 2021 : réduction de 13 % du critère CV), analyse poolée FIDELITY (bénéfice rénal ET cardiovasculaire)
  - Indications KDIGO 2024 : finérénone recommandée en add-on (IEC/ARA2 + iSGLT2 déjà en place) si DFG ≥ 25 mL/min, K+ < 5 mmol/L, RAC ≥ 30 mg/g
  - Surveillance : kaliémie à M1 puis tous les 4 mois ; risque principal = hyperkaliémie (mais moindre que spironolactone grâce à la sélectivité)
- **Pilier combiné KDIGO 2024** : IEC/ARA2 + iSGLT2 + finérénone + contrôle glycémique (HbA1c individualisée) + statine → « 4 piliers de la néphroprotection diabétique »
- **Contrôle glycémique adapté** : cible HbA1c ≤ 7 % en général, à individualiser selon DFG (attention aux hypoglycémies en IRC avancée — clairance réduite de l'insuline)
- **Autres mesures** : restriction sodée < 5 g/j, apport protéique 0,8 g/kg/j si DFG < 30, sevrage tabagique, activité physique adaptée, correction anémie (EPO si Hb < 10 g/dL), traitement acidose métabolique (bicarbonates si HCO3- < 22 mmol/L)

> [MEDIA: 🏗️ MDIAB17-S03-001 — SCHÉMA MÉCANISME NÉPHROPROTECTEUR iSGLT2 (feedback tubulo-glomérulaire, vasoconstriction afférente, ↓ pression intraglomérulaire)]

> [MEDIA: 📊 MDIAB17-S03-002 — GRAPHIQUE COMPARATIF ESSAIS NÉPHROPROTECTION (RENAAL, CREDENCE, DAPA-CKD, EMPA-KIDNEY, FIDELIO — critère rénal composite, NNT)]

> [MEDIA: 📋 MDIAB17-S03-003 — ALGORITHME KDIGO 2024 NÉPHROPROTECTION DT2 (4 piliers : SRAA + iSGLT2 + finérénone + contrôle métabolique — critères d'introduction et surveillance)]

### Section 4 — Adaptation thérapeutique et préparation à la suppléance

> Le module doit présenter l'adaptation des traitements en IRC et la préparation à la suppléance :

**Contenu obligatoire :**

- **Adaptation des antidiabétiques au DFG** (adapté de recommandations KDIGO 2024, SFD/SFNDT 2023) :
  - Metformine : maintien jusqu'à DFG ≥ 30 (dose réduite 1 g/j si DFG 30-45), arrêt si DFG < 30 ; situations d'arrêt temporaire (iode, chirurgie, déshydratation)
  - iSGLT2 : initiation si DFG ≥ 20, poursuite jusqu'à dialyse pour néphroprotection (effet glycémique diminué si DFG < 45)
  - Sulfonylurées : privilégier gliclazide (métabolisme hépatique) ; éviter glibenclamide (métabolites actifs accumulés → hypoglycémie)
  - Inhibiteurs DPP-4 : adaptation posologique (sauf linagliptine — pas d'ajustement)
  - Agonistes GLP-1 : pas d'adaptation posologique (sémaglutide, dulaglutide, liraglutide) ; données néphroprotectrices émergentes (FLOW — sémaglutide : réduction de 24 % du critère rénal composite, Perkovic et al., N Engl J Med, 2024)
  - Insuline : doses souvent à réduire de 25-50 % si DFG < 30 (clairance rénale réduite) → risque hypoglycémique accru ; privilégier analogues avec profil pharmacocinétique stable
- **Quand adresser au néphrologue** : DFG < 30, déclin DFG > 5 mL/min/an, RAC > 300 mg/g persistant, hyperkaliémie récurrente, HTA résistante, suspicion NDKD, préparation suppléance
- **Préparation à la suppléance** : information dès DFG < 20, choix éclairé (hémodialyse, dialyse péritonéale, transplantation rénale ± pancréatique), abord vasculaire (fistule artério-veineuse) à créer dès DFG < 15-20, inscription sur liste de transplantation préemptive si éligible
- **Transplantation rein-pancréas** : option pour DT1 avec IRT — greffe simultanée rein-pancréas (SPK) : survie du greffon rénal ~90 % à 5 ans, insulino-indépendance ~85 % à 5 ans

> [MEDIA: 📋 MDIAB17-S04-001 — TABLEAU ADAPTATION ANTIDIABÉTIQUES SELON DFG (molécule, seuil DFG, adaptation posologique, précautions)]

> [MEDIA: 📊 MDIAB17-S04-002 — ALGORITHME PARCOURS PATIENT IRC DIABÉTIQUE (du dépistage à la suppléance — seuils DFG, étapes clés, intervenants)]

## Points clés — Module 17

> 🎯 **Essentiel à retenir**
> 1. La ND est la 1ère cause d'IRT dans le monde — dépistage annuel : RAC + DFG estimé (CKD-EPI 2021)
> 2. L'hyperfiltration glomérulaire (rôle SGLT2 dans le feedback tubulo-glomérulaire) est le mécanisme initiateur
> 3. Classification KDIGO bidimensionnelle : DFG (G1-G5) × albuminurie (A1-A3) → niveau de risque
> 4. Les 4 piliers KDIGO 2024 : IEC/ARA2 + iSGLT2 + finérénone + contrôle métabolique
> 5. CREDENCE, DAPA-CKD, EMPA-KIDNEY : les iSGLT2 réduisent de 28-39 % la progression rénale
> 6. FIDELIO/FIGARO : la finérénone ajoute un bénéfice rénal et CV en add-on
> 7. FLOW : le sémaglutide montre un bénéfice néphroprotecteur (réduction 24 % critère rénal)
> 8. Le « dip and recovery » des iSGLT2 est attendu et bénin → ne pas arrêter le traitement
> 9. Adapter les antidiabétiques au DFG : attention metformine (stop si < 30), insuline (réduire doses si < 30)
> 10. Adresser au néphrologue si DFG < 30, déclin rapide, ou suspicion de NDKD

## Auto-évaluation — Module 17

### QCM progressifs (12 questions)

**Q1 — 🥉 Bronze** : Quel est l'examen de dépistage de la néphropathie diabétique ?
A. Protéinurie des 24 heures
B. Rapport albumine/créatinine urinaire (RAC) sur échantillon matinal
C. Créatinine urinaire isolée
D. Échographie rénale
> ✅ **B** — Le RAC sur échantillon matinal est l'examen de dépistage recommandé (KDIGO, ADA, HAS), à confirmer sur 2/3 prélèvements. La protéinurie des 24h est abandonnée en dépistage (peu fiable, mauvaise compliance).

**Q2 — 🥉 Bronze** : À partir de quel seuil d'albuminurie parle-t-on d'albuminurie modérément augmentée (ex-microalbuminurie) ?
A. > 10 mg/g
B. > 30 mg/g
C. > 150 mg/g
D. > 300 mg/g
> ✅ **B** — Albuminurie A2 (modérément augmentée) : RAC 30-300 mg/g. A3 (sévèrement augmentée) : > 300 mg/g. Normal (A1) : < 30 mg/g.

**Q3 — 🥈 Argent** : Quel est le mécanisme de l'hyperfiltration glomérulaire précoce dans le diabète ?
A. Vasoconstriction de l'artériole afférente
B. Vasodilatation afférente (par ↑ réabsorption SGLT2 → ↓ NaCl macula densa → ↓ feedback TG) + vasoconstriction efférente (angiotensine II)
C. Obstruction tubulaire par glycosurie
D. Nécrose papillaire
> ✅ **B** — L'hyperglycémie augmente la réabsorption glucose-sodium via SGLT2, diminuant le NaCl au macula densa, désactivant le feedback tubulo-glomérulaire (vasodilatation afférente). L'angiotensine II provoque la vasoconstriction efférente. Le résultat est une augmentation de la pression intraglomérulaire.

**Q4 — 🥈 Argent** : Pourquoi ne doit-on pas associer IEC + ARA2 en néphroprotection ?
A. Interaction pharmacocinétique rendant les deux molécules inefficaces
B. L'étude ONTARGET a montré l'absence de bénéfice rénal avec plus d'hyperkaliémie et d'hypotension
C. L'association provoque systématiquement une insuffisance rénale aiguë
D. Les deux molécules ont le même mécanisme d'action exact
> ✅ **B** — L'étude ONTARGET (Yusuf et al., 2008) a montré que le double blocage IEC + ARA2 n'apportait pas de bénéfice rénal supplémentaire mais augmentait significativement le risque d'hyperkaliémie, d'hypotension et d'insuffisance rénale aiguë.

**Q5 — 🥈 Argent** : Qu'est-ce que le « dip and recovery » des iSGLT2 ?
A. Une chute irréversible du DFG nécessitant l'arrêt du traitement
B. Une baisse initiale du DFG de 3-5 mL/min, réversible, reflétant la correction hémodynamique glomérulaire
C. Une augmentation paradoxale de l'albuminurie
D. Une fluctuation de l'HbA1c
> ✅ **B** — Le « dip and recovery » est une baisse initiale attendue et bénigne du DFG de 3-5 mL/min, reflétant la vasoconstriction de l'artériole afférente et la réduction de l'hyperfiltration. C'est un marqueur de bonne réponse hémodynamique — il ne faut pas arrêter le traitement.

**Q6 — 🥈 Argent** : Quelle est l'indication de la finérénone selon KDIGO 2024 ?
A. En 1ère intention avant les IEC/ARA2
B. En remplacement des iSGLT2
C. En add-on (IEC/ARA2 + iSGLT2 déjà en place) si DFG ≥ 25, K+ < 5, RAC ≥ 30
D. Uniquement si DFG < 15
> ✅ **C** — La finérénone est recommandée en 3e ligne de néphroprotection, en addition aux IEC/ARA2 et iSGLT2, chez les patients DT2 avec DFG ≥ 25 mL/min, K+ < 5 mmol/L et RAC ≥ 30 mg/g (KDIGO 2024).

**Q7 — 🥇 Or** : L'étude CREDENCE a montré quel bénéfice de la canagliflozine dans la ND ?
A. Réduction de 10 % du critère rénal composite
B. Réduction de 30 % du critère rénal composite, arrêt prématuré pour efficacité
C. Absence de bénéfice rénal significatif
D. Bénéfice uniquement chez les non-diabétiques
> ✅ **B** — CREDENCE (Perkovic et al., 2019) a montré une réduction de 30 % du critère rénal composite (IRT, doublement créatinine, décès rénal/CV) avec la canagliflozine vs placebo chez des DT2 avec albuminurie et DFG 30-90. L'essai a été arrêté prématurément pour bénéfice.

**Q8 — 🥇 Or** : Quelle adaptation de la metformine si le DFG est entre 30 et 45 mL/min ?
A. Arrêt immédiat de la metformine
B. Maintien à dose maximale (3 g/j)
C. Réduction à 1 g/j maximum avec surveillance rapprochée
D. Passage à la metformine à libération prolongée sans ajustement
> ✅ **C** — La metformine peut être maintenue jusqu'à un DFG de 30 mL/min mais la dose doit être réduite (maximum 1 g/j si DFG 30-45) avec surveillance de la fonction rénale et arrêt temporaire en cas de situation à risque d'acidose lactique.

**Q9 — 🥇 Or** : Quel argument clinique majeur oriente vers une néphropathie non diabétique (NDKD) chez un patient diabétique ?
A. Présence d'une rétinopathie diabétique associée
B. Albuminurie progressive sur plusieurs années
C. Hématurie glomérulaire avec absence de rétinopathie diabétique
D. HTA associée
> ✅ **C** — L'absence de RD associée et la présence d'une hématurie glomérulaire sont des « red flags » de NDKD, car la concordance rétino-néphropathie est un argument fort pour la ND typique. Une biopsie rénale doit être discutée.

**Q10 — 🥇 Or** : Quelle est la cible tensionnelle chez un patient DT2 avec albuminurie > 1 g/g selon KDIGO 2021 ?
A. < 140/90 mmHg
B. < 130/80 mmHg
C. PAS < 120 mmHg (mesure standardisée au cabinet)
D. < 150/90 mmHg
> ✅ **C** — KDIGO 2021 recommande une cible de PAS < 120 mmHg (mesure standardisée) chez les patients avec albuminurie sévère, basée sur les résultats de SPRINT et les analyses post-hoc de RENAAL/IDNT.

**Q11 — 💎 Diamant** : Un patient DT2 avec DFG 28 mL/min, RAC 650 mg/g, sous ramipril 10 mg + empagliflozine 10 mg, K+ 4,8 mmol/L. Peut-on ajouter de la finérénone ?
A. Oui, car DFG ≥ 25, K+ < 5, RAC ≥ 30 — tous les critères KDIGO sont remplis
B. Non, car le DFG est trop bas
C. Non, car l'empagliflozine est déjà en place
D. Oui, mais uniquement après arrêt de l'empagliflozine
> ✅ **A** — Les critères KDIGO 2024 pour l'introduction de la finérénone sont tous remplis : DFG ≥ 25 (ici 28), K+ < 5 (ici 4,8), RAC ≥ 30 (ici 650), et le patient est déjà sous IEC/ARA2 + iSGLT2. Surveillance de la kaliémie à M1.

**Q12 — 💎 Diamant** : M. T., 55 ans, DT1 depuis 30 ans, DFG 12 mL/min, sous insuline basale-bolus, IEC, iSGLT2. Quelles mesures de préparation à la suppléance ?
A. Attendre que le DFG atteigne 5 mL/min pour commencer les discussions
B. Information sur les modalités (HD, DP, transplantation), création fistule AV, inscription liste transplantation rein-pancréas préemptive, réduction doses insuline
C. Débuter la dialyse immédiatement
D. Transplantation pancréatique isolée
> ✅ **B** — Avec un DFG à 12 mL/min, la préparation à la suppléance est urgente : information éclairée (HD, DP, transplantation), création de la fistule AV (maturation 6-8 semaines), et chez ce DT1 de 55 ans, l'inscription préemptive pour greffe simultanée rein-pancréas (SPK) doit être discutée. Les doses d'insuline doivent être réduites (clairance rénale diminuée).

### Cas clinique intégré — Module 17

> 📝 **Cas clinique : Mme L., 54 ans, DT2 depuis 12 ans**
>
> Mme L., DT2 sous metformine 2 g/j + sémaglutide 1 mg/sem. HbA1c : 7,8 %. PA : 145/88 mmHg sans traitement antihypertenseur. Bilan annuel : créatinine 98 µmol/L (DFG CKD-EPI 58 mL/min), RAC 180 mg/g (confirmé sur 2 prélèvements). Fond d'œil : RDNP minime.
>
> **Questions :**
> 1. Classez cette patiente selon KDIGO (stade DFG + albuminurie + couleur de risque).
> 2. Quels traitements néphroprotecteurs devez-vous introduire et dans quel ordre ?
> 3. Faut-il adapter la metformine ? Et le sémaglutide ?
> 4. Quel bilan complémentaire demandez-vous ?
> 5. Quel est le rythme de surveillance recommandé pour ce stade KDIGO ?

### Question de synthèse

> 🔄 **Synthèse** : Construisez l'algorithme de néphroprotection KDIGO 2024 étape par étape pour un patient DT2 avec DFG 45 mL/min et RAC 250 mg/g, en précisant les 4 piliers, l'ordre d'introduction, les critères de surveillance et les seuils d'alerte pour chaque traitement.

---

# MODULE 18 : NEUROPATHIE DIABÉTIQUE — POLYNEUROPATHIE, NEUROPATHIE AUTONOME, DOULEUR NEUROPATHIQUE

**Partie** : V — Complications microvasculaires
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 5-6, 14

## Accroche clinique

> 🏥 **Mise en situation** : M. B., 65 ans, DT2 depuis 20 ans, HbA1c 8,3 %, consulte pour des « brûlures » et des « fourmillements » aux pieds qui l'empêchent de dormir depuis 6 mois. L'examen retrouve une hypoesthésie en chaussettes, des réflexes achilléens abolis bilatéralement, un test au monofilament 10 g positif (4/8 points insensibles). De plus, il signale des épisodes de vertiges au lever et une diarrhée nocturne intermittente. *La neuropathie diabétique touche jusqu'à 50 % des diabétiques — sa détection précoce est cruciale car elle conditionne le risque de pied diabétique et d'hypoglycémies non ressenties.*

## Objectifs d'apprentissage

1. **Classer** les différentes formes de neuropathie diabétique : polyneuropathie distale symétrique (PNDS), neuropathies focales/multifocales, neuropathie autonome
2. **Réaliser** le dépistage clinique : monofilament 10 g, diapason 128 Hz, réflexes achilléens, score NDS (Neuropathy Disability Score)
3. **Évaluer** la douleur neuropathique : questionnaire DN4, échelle EVA, retentissement fonctionnel
4. **Diagnostiquer** la neuropathie autonome cardiaque (NAC) et ses implications pronostiques
5. **Prescrire** le traitement de la douleur neuropathique selon les recommandations (ADA 2024, NICE 2024)
6. **Identifier** les formes atypiques nécessitant un diagnostic différentiel

## Structure du contenu

### Section 1 — Épidémiologie, physiopathologie et classification

> Le module doit présenter la physiopathologie de l'atteinte nerveuse diabétique :

**Contenu obligatoire :**

- **Épidémiologie** : prévalence de la PNDS ~30-50 % des diabétiques (toutes formes) ; la PNDS est la forme la plus fréquente (>75 % des neuropathies diabétiques) ; neuropathie autonome cardiaque (NAC) : 20-65 % selon les critères ; la neuropathie est le principal facteur de risque du pied diabétique (module 20)
- **Physiopathologie** : atteinte combinée métabolique et vasculaire :
  - **Atteinte métabolique directe** : voie des polyols (accumulation sorbitol dans les cellules de Schwann → œdème, déplétion myo-inositol), glycation des protéines nerveuses (neurofilaments, tubuline, myéline), stress oxydatif (mitochondrial, NADPH oxydase), voie PKC → ↓ Na+/K+ ATPase → ralentissement conduction
  - **Microangiopathie des vasa nervorum** : épaississement membrane basale des capillaires endoneuraux, ↓ flux sanguin endoneurial → hypoxie neuronale
  - **Dégénérescence axonale** : atteinte « length-dependent » (les fibres les plus longues sont touchées en premier → distribution « en chaussettes » puis « en gants »)
  - **Démyélinisation segmentaire** secondaire
  - **Rôle du canal sodique Nav1.7** dans la douleur neuropathique (hyperexcitabilité des nocicepteurs)
- **Classification** (adapté de Thomas, Diabetologia, 1997 et ADA 2017) :
  - **Polyneuropathies symétriques** : PNDS (sensitivo-motrice, la plus fréquente), polyneuropathie autonome, polyneuropathie sensitivo-motrice proximale (amyotrophie diabétique)
  - **Neuropathies focales et multifocales** : mononeuropathies crâniennes (III, VI, VII), mononeuropathies des membres (médian, cubital, fibulaire), radiculopathies/plexopathies (thoracique, lombosacrée), amyotrophie diabétique (syndrome de Bruns-Garland)
  - **Formes mixtes et atypiques** : neuropathie induite par le traitement (« treatment-induced neuropathy of diabetes » — TIND, ex-« névrite insulinique » : apparition/aggravation de neuropathie douloureuse + dysautonomie lors d'une amélioration glycémique rapide, ↓ HbA1c > 2 % en 3 mois)

> [MEDIA: 🔬 MDIAB18-S01-001 — SCHÉMA PHYSIOPATHOLOGIE NEUROPATHIE (voie des polyols dans cellule de Schwann, microangiopathie vasa nervorum, dégénérescence axonale distale)]

> [MEDIA: 📋 MDIAB18-S01-002 — CLASSIFICATION COMPLÈTE NEUROPATHIES DIABÉTIQUES (tableau : type, fréquence, mécanisme, présentation, pronostic)]

> [MEDIA: 🧍 MDIAB18-S01-003 — SCHÉMA DISTRIBUTION « LENGTH-DEPENDENT » (atteinte en chaussettes → gants → tronc, proportionnelle à la longueur axonale)]

### Section 2 — Polyneuropathie distale symétrique : dépistage et diagnostic

> Le module doit présenter le dépistage et le diagnostic de la PNDS :

**Contenu obligatoire :**

- **Dépistage systématique** (recommandations ADA 2024, HAS) :
  - DT2 : dès le diagnostic, puis annuel
  - DT1 : à partir de 5 ans de diabète, puis annuel
  - Examen minimum : monofilament 10 g + au moins 1 test parmi : diapason 128 Hz, pic-touche, réflexes achilléens
- **Tests cliniques détaillés** :
  - **Monofilament de Semmes-Weinstein 10 g** : technique standardisée (3 sites par pied : pulpe hallux, têtes M1, M5 — certains protocoles 4 sites ajoutant la voûte), application perpendiculaire, flexion en C, durée 1 seconde ; résultat positif (perte de sensation) si ≥ 1 site insensible → risque de pied diabétique
  - **Diapason 128 Hz** : vibration sur l'hallux (face dorsale tête M1), résultat positif si patient ne perçoit plus la vibration alors que l'examinateur la perçoit encore ; évalue les grosses fibres myélinisées (sensibilité profonde)
  - **Pic-touche (Neurotip®)** : évalue la sensibilité douloureuse (petites fibres)
  - **Réflexes achilléens** : abolition bilatérale = atteinte des grosses fibres myélinisées
  - **Score NDS (Neuropathy Disability Score)** (adapté de Young et al., Diabetologia, 1993) : score composite (réflexes achilléens + perception vibratoire + pic-touche + perception thermique) : 0-2 normal, 3-5 légère, 6-8 modérée, 9-10 sévère
- **Symptômes** : distinction fibres atteintes :
  - Grosses fibres myélinisées (Aβ) : engourdissement, paresthésies, ataxie, marche instable
  - Petites fibres (Aδ, C) : brûlures, piqûres, allodynie, hyperalgésie, douleurs nocturnes prédominantes
  - Fibres motrices : faiblesse distale tardive, atrophie interosseux, orteils en griffe
- **Examens complémentaires** (si diagnostic incertain) :
  - Électroneuromyographie (ENMG) : ↓ vitesses de conduction sensitives puis motrices, ↓ amplitudes ; normal si atteinte isolée des petites fibres
  - Biopsie cutanée (punch 3 mm cheville + cuisse) : quantification densité intra-épidermique des fibres nerveuses (IENFD) — gold standard pour neuropathie des petites fibres
  - Corneal confocal microscopy (CCM) : non invasive, corrélée à IENFD

> [MEDIA: 🩺 MDIAB18-S02-001 — TECHNIQUE MONOFILAMENT 10g (sites d'application, positionnement, interprétation — photos pas-à-pas)]

> [MEDIA: 📋 MDIAB18-S02-002 — SCORE NDS COMPLET (tableau : composants, cotation, interprétation, seuils)]

> [MEDIA: 📊 MDIAB18-S02-003 — ALGORITHME DIAGNOSTIQUE PNDS (dépistage clinique → confirmation → diagnostic différentiel → orientation)]

### Section 3 — Neuropathie autonome diabétique

> Le module doit présenter les différentes atteintes du système nerveux autonome :

**Contenu obligatoire :**

- **Neuropathie autonome cardiaque (NAC)** — la plus importante pronostiquement :
  - Prévalence : 20 % DT1 à 20 ans, 15-35 % DT2
  - Pronostic : mortalité multipliée par 3-5 (Maser et al., Diabetes Care, 2003) ; associée aux arythmies, ischémie silencieuse, mort subite
  - Dépistage : tests cardiovasculaires d'Ewing (adapté de Ewing & Clarke, BMJ, 1982) :
    - Variation de la FC à la respiration profonde (6 cycles/min → ratio E/I ; anormal si < 1,10)
    - Épreuve de Valsalva (ratio RR max/RR min ; anormal si < 1,10)
    - Réponse FC à l'orthostatisme (ratio 30/15 ; anormal si < 1,00)
    - Réponse PA à l'orthostatisme (↓ PAS > 20 mmHg ou PAD > 10 mmHg = hypotension orthostatique)
    - Réponse PA au handgrip isométrique (↑ PAD < 10 mmHg = anormal)
  - Stades : précoce (1 test anormal), confirmée (2-3 tests anormaux), sévère (hypotension orthostatique)
  - Conséquences pratiques : tachycardie de repos (FC > 100 bpm), ischémie myocardique silencieuse (dépistage par ECG d'effort ou scintigraphie), allongement QTc → risque arythmie, mauvaise tolérance à l'exercice physique → adaptation du programme d'activité
- **Neuropathie autonome digestive** :
  - **Gastroparésie diabétique** : retard de vidange gastrique → nausées, vomissements, satiété précoce, ballonnements, variabilité glycémique postprandiale erratique ; diagnostic : scintigraphie de vidange gastrique (rétention > 10 % à 4h) ; traitement : mesures diététiques (petits repas fractionnés, pauvres en graisses et fibres), métoclopramide (attention effets extrapyramidaux, durée limitée), érythromycine IV (agoniste motiline, efficacité transitoire), prucalopride (hors AMM), stimulation gastrique électrique (Enterra®) si réfractaire
  - **Diarrhée diabétique** : diarrhée nocturne caractéristique, aqueuse, non sanglante ; diagnostic d'exclusion ; traitement : lopéramide, cholestyramine si malabsorption sels biliaires, antibiotiques si pullulation bactérienne
  - **Constipation** : la plus fréquente des atteintes digestives (60 %)
- **Neuropathie autonome génito-urinaire** :
  - Dysfonction érectile : prévalence 35-75 % des hommes diabétiques ; dépistage systématique (IIEF-5) ; étiologie mixte (neuropathique + vasculaire + psychologique) ; traitement : IPDE5 (sildénafil, tadalafil) en 1ère intention, IIC prostaglandine E1 en 2e intention
  - Vessie neurogène : résidu post-mictionnel > 100 mL → autosondages si sévère
  - Dysfonction sexuelle féminine : sécheresse vaginale, dyspareunie, anorgasmie — sous-diagnostiquée
- **Neuropathie autonome sudorale** : anhidrose distale → peau sèche, fissures → porte d'entrée pied diabétique ; hyperhidrose compensatrice tronculaire ; Sudoscan® : mesure de la fonction sudorale (conductance électrochimique cutanée) — outil de dépistage émergent
- **Hypoglycémies non ressenties** : perte de la réponse adrénergique à l'hypoglycémie (« hypoglycemia unawareness ») — conséquence gravissime de la NAC ; seuil abaissé de déclenchement des symptômes → risque d'hypoglycémie sévère × 6 ; CAT : relèvement des cibles glycémiques, éviction stricte des hypoglycémies pendant 2-3 semaines → restauration partielle de la perception (« hypoglycemia awareness restoration »)

> [MEDIA: 📋 MDIAB18-S03-001 — TABLEAU TESTS D'EWING NAC (test, technique, seuil normal/anormal, interprétation — illustration pour chaque test)]

> [MEDIA: 🫀 MDIAB18-S03-002 — SCHÉMA CONSÉQUENCES NAC (tachycardie repos, ischémie silencieuse, hypotension orthostatique, QTc allongé, hypoglycémie non ressentie)]

> [MEDIA: 📋 MDIAB18-S03-003 — ALGORITHME GASTROPARÉSIE DIABÉTIQUE (suspicion → scintigraphie → traitement par paliers : diététique → prokinétiques → stimulation gastrique)]

### Section 4 — Traitement de la douleur neuropathique

> Le module doit présenter la prise en charge de la douleur neuropathique diabétique :

**Contenu obligatoire :**

- **Évaluation de la douleur** : questionnaire DN4 (≥ 4/10 = douleur neuropathique probable — Bouhassira et al., Pain, 2005), EVA/EN douleur, retentissement (sommeil, qualité de vie, anxiété/dépression — questionnaires PHQ-9, GAD-7), distinction douleur neuropathique positive (brûlures, allodynie) vs négative (engourdissement, hypoesthésie)
- **Traitement étiologique** : optimisation glycémique (seul traitement ayant montré un ralentissement de la progression — DCCT/EDIC pour DT1, effet plus modeste pour DT2) ; attention au TIND si amélioration trop rapide
- **Traitement pharmacologique de la douleur** (adapté des recommandations ADA 2024, NICE 2024, Bril et al., Neurology, 2024) :
  - **1ère ligne** (choix selon profil patient, comorbidités, effets secondaires) :
    - Prégabaline 150-600 mg/j en 2 prises (antiépileptique, ligand α2δ) : NNT ~5 ; ES : somnolence, prise de poids, vertiges ; CI : insuffisance rénale sévère (ajuster dose)
    - Duloxétine 60-120 mg/j en 1 prise (IRSNA) : NNT ~5 ; ES : nausées, céphalées, sécheresse buccale ; avantage si dépression/anxiété associée ; CI : insuffisance hépatique
    - Gabapentine 900-3600 mg/j en 3 prises (antiépileptique, ligand α2δ) : NNT ~6 ; ajuster en IRC
    - Amitriptyline 25-75 mg/j au coucher (antidépresseur tricyclique) : NNT ~3 (le plus efficace mais le plus d'ES) ; ES : anticholinergiques (bouche sèche, constipation, rétention urinaire, confusion) ; CI relative chez le sujet âgé, pathologie cardiaque (allongement QTc)
  - **2e ligne** : association de 2 molécules de 1ère ligne à doses sub-optimales (étude COMBO-DN : duloxétine + prégabaline supérieure à la monothérapie à dose optimale — Tesfaye et al., Lancet, 2022)
  - **3e ligne** : tramadol (opioïde faible) ; capsaïcine patch 8 % (Qutenza®) — application locale 30 min sur les pieds, efficacité 3 mois, réalisée en centre spécialisé ; tapentadol
  - **À éviter** : opioïdes forts en traitement chronique (risque de dépendance, efficacité limitée long terme)
- **Traitements non pharmacologiques** : TENS (neurostimulation transcutanée), stimulation médullaire (si douleur réfractaire — études Slangen et al., Diabetes Care, 2014), thérapie cognitivo-comportementale, exercice physique régulier (amélioration de la douleur et de la qualité de vie), acupuncture (niveau de preuve faible)
- **Traitements émergents** : inhibiteurs de l'aldose réductase (épalréstat — commercialisé au Japon), anticorps anti-NGF, thérapie génique (VM202 — plasmide codant pour HGF), inhibiteurs de PARP

> [MEDIA: 📋 MDIAB18-S04-001 — ALGORITHME TRAITEMENT DOULEUR NEUROPATHIQUE (1ère ligne : prégabaline/duloxétine/gabapentine/amitriptyline → 2e ligne : bithérapie → 3e ligne : tramadol/capsaïcine)]

> [MEDIA: 📊 MDIAB18-S04-002 — COMPARATIF MOLÉCULES 1ère LIGNE (NNT, NNH, profil ES, ajustement IRC, comorbidités favorisant le choix)]

> [MEDIA: 📋 MDIAB18-S04-003 — QUESTIONNAIRE DN4 ILLUSTRÉ (10 items, seuil ≥ 4, sensibilité 83 %, spécificité 90 %)]

## Points clés — Module 18

> 🎯 **Essentiel à retenir**
> 1. La PNDS touche 30-50 % des diabétiques — dépistage annuel par monofilament 10 g + diapason/réflexes
> 2. Distribution « length-dependent » : en chaussettes → gants (fibres longues touchées en premier)
> 3. Petites fibres = douleurs (brûlures, allodynie) ; grosses fibres = engourdissement, ataxie, chutes
> 4. La NAC est un marqueur pronostique majeur (mortalité ×3-5) → dépistage par tests d'Ewing
> 5. Hypoglycémie non ressentie : conséquence gravissime de la NAC → relèvement des cibles glycémiques
> 6. Gastroparésie : variabilité glycémique erratique → scintigraphie de vidange gastrique → prokinétiques
> 7. Douleur neuropathique : 1ère ligne = prégabaline OU duloxétine OU gabapentine OU amitriptyline
> 8. COMBO-DN : la bithérapie duloxétine + prégabaline est supérieure à la monothérapie optimale
> 9. TIND : aggravation neuropathique paradoxale si ↓ HbA1c > 2 % en 3 mois → amélioration progressive
> 10. Le contrôle glycémique est le seul traitement étiologique de la neuropathie (DCCT/EDIC)

## Auto-évaluation — Module 18

### QCM progressifs (13 questions)

**Q1 — 🥉 Bronze** : Quel est le test de dépistage de base de la neuropathie diabétique en consultation ?
A. Électroneuromyogramme
B. Monofilament de Semmes-Weinstein 10 g
C. Biopsie cutanée
D. IRM des nerfs périphériques
> ✅ **B** — Le monofilament 10 g est le test de dépistage de base, simple, rapide et reproductible. Un résultat positif (≥ 1 site insensible) identifie les patients à risque de pied diabétique. L'ENMG n'est pas un test de dépistage.

**Q2 — 🥉 Bronze** : Quelle est la forme la plus fréquente de neuropathie diabétique ?
A. Mononeuropathie du III
B. Polyneuropathie distale symétrique (PNDS)
C. Neuropathie autonome cardiaque
D. Amyotrophie diabétique
> ✅ **B** — La PNDS représente > 75 % des neuropathies diabétiques. Elle touche d'abord les fibres sensitives distales des membres inférieurs selon un gradient « length-dependent ».

**Q3 — 🥉 Bronze** : Quel score au questionnaire DN4 est en faveur d'une douleur neuropathique ?
A. ≥ 2/10
B. ≥ 4/10
C. ≥ 6/10
D. ≥ 8/10
> ✅ **B** — Un score DN4 ≥ 4/10 a une sensibilité de 83 % et une spécificité de 90 % pour le diagnostic de douleur neuropathique (Bouhassira et al., 2005).

**Q4 — 🥈 Argent** : L'atteinte des petites fibres (Aδ, C) se manifeste principalement par :
A. Ataxie et troubles de l'équilibre
B. Brûlures, douleurs lancinantes, allodynie, douleurs nocturnes
C. Faiblesse musculaire proximale
D. Abolition des réflexes ostéo-tendineux
> ✅ **B** — Les petites fibres (Aδ, C) véhiculent la sensibilité thermique et douloureuse. Leur atteinte provoque des douleurs neuropathiques positives : brûlures, piqûres, allodynie, hyperalgésie, prédominance nocturne. L'ENMG est normal (il n'explore que les grosses fibres).

**Q5 — 🥈 Argent** : Quel est l'examen de référence pour diagnostiquer une neuropathie des petites fibres quand l'ENMG est normal ?
A. IRM médullaire
B. Biopsie cutanée avec quantification IENFD
C. Potentiels évoqués somesthésiques
D. Dosage des anticorps anti-gangliosides
> ✅ **B** — La biopsie cutanée (punch 3 mm) avec quantification de la densité intra-épidermique des fibres nerveuses (IENFD) est le gold standard pour le diagnostic de neuropathie des petites fibres. L'ENMG est normal car il n'explore que les grosses fibres myélinisées.

**Q6 — 🥈 Argent** : Quels sont les tests de dépistage de la NAC les plus précoces ?
A. Variation FC à la respiration profonde et ratio 30/15 à l'orthostatisme
B. Recherche d'hypotension orthostatique
C. ECG 12 dérivations standard
D. Holter tensionnel
> ✅ **A** — Les tests parasympathiques (variation FC à la respiration profonde, ratio 30/15 à l'orthostatisme) sont les premiers altérés dans la NAC. L'hypotension orthostatique (test sympathique) est un signe tardif de NAC sévère.

**Q7 — 🥈 Argent** : Pourquoi la NAC aggrave-t-elle le risque d'hypoglycémie sévère ?
A. Elle provoque une insulinorésistance accrue
B. Elle abolit la réponse adrénergique contre-régulatrice → hypoglycémie non ressentie
C. Elle augmente l'absorption intestinale du glucose
D. Elle diminue la clairance rénale de l'insuline
> ✅ **B** — La NAC abolit la réponse sympatho-adrénergique (tachycardie, tremblements, sueurs) qui alerte normalement le patient lors d'une hypoglycémie. Sans ces symptômes d'alerte, l'hypoglycémie progresse sans être ressentie vers la neuroglycopénie sévère (risque ×6 d'hypoglycémie sévère).

**Q8 — 🥇 Or** : Quel résultat principal de l'étude COMBO-DN (Tesfaye et al., Lancet, 2022) ?
A. La monothérapie à haute dose est toujours supérieure à la bithérapie
B. La bithérapie duloxétine + prégabaline est supérieure à la monothérapie optimale
C. Les opioïdes sont supérieurs aux antiépileptiques
D. La capsaïcine est le traitement le plus efficace
> ✅ **B** — COMBO-DN a montré que l'association duloxétine + prégabaline à doses sub-optimales était plus efficace que la monothérapie à dose optimale, avec un profil d'effets secondaires acceptable. Cela justifie la bithérapie en 2e ligne.

**Q9 — 🥇 Or** : Qu'est-ce que le TIND (Treatment-Induced Neuropathy of Diabetes) ?
A. Neuropathie causée par la metformine
B. Aggravation/apparition de neuropathie douloureuse + dysautonomie lors d'une amélioration glycémique rapide (↓ HbA1c > 2 % en 3 mois)
C. Neuropathie induite par les statines
D. Neuropathie post-chirurgicale
> ✅ **B** — Le TIND (ex-« névrite insulinique ») associe neuropathie douloureuse sévère + dysautonomie (incluant aggravation de la RD) lors d'une normalisation glycémique trop rapide. Le mécanisme implique la régénération neuronale aberrante et l'ischémie endoneural. Prévention : amélioration glycémique progressive.

**Q10 — 🥇 Or** : Comment diagnostiquer une gastroparésie diabétique ?
A. Fibroscopie gastrique
B. Scintigraphie de vidange gastrique (rétention > 10 % à 4h)
C. Transit baryté
D. Manométrie œsophagienne
> ✅ **B** — La scintigraphie de vidange gastrique est l'examen de référence. Le repas test standardisé (œufs marqués au Tc-99m) est imagé à 0, 1, 2 et 4 heures. Une rétention > 10 % à 4 heures confirme le diagnostic. La fibroscopie est utile pour exclure une cause obstructive.

**Q11 — 🥇 Or** : Parmi les traitements de 1ère ligne de la douleur neuropathique, lequel a le meilleur NNT mais le plus d'effets secondaires ?
A. Prégabaline
B. Duloxétine
C. Amitriptyline
D. Gabapentine
> ✅ **C** — L'amitriptyline (tricyclique) a le meilleur NNT (~3) mais aussi le plus d'effets secondaires anticholinergiques (bouche sèche, constipation, rétention urinaire, confusion, allongement QTc). Elle est contre-indiquée relativement chez le sujet âgé et en cas de pathologie cardiaque.

**Q12 — 💎 Diamant** : M. A., 70 ans, DT2, NAC sévère avec hypotension orthostatique (PAS de 145 couché → 105 debout). Il chute fréquemment. Quelle prise en charge proposez-vous ?
A. Augmenter les antihypertenseurs pour contrôler la PA couchée
B. Mesures posturales + bas de contention + fludrocortisone/midodrine, éviter les diurétiques et les antihypertenseurs à risque
C. Ablation du nœud sinusal
D. Perfusion de sérum physiologique quotidienne
> ✅ **B** — La prise en charge de l'hypotension orthostatique de la NAC sévère comprend : mesures posturales (lever progressif, surélever tête du lit), contention élastique, hydratation + apport sodé, fludrocortisone 100-200 µg/j (minéralocorticoïde) et/ou midodrine 2,5-10 mg ×3/j (α-agoniste). Éviter les diurétiques, les α-bloquants, et réduire les antihypertenseurs favorisants.

**Q13 — 💎 Diamant** : Un patient DT2 de 55 ans présente une atteinte motrice proximale asymétrique du membre inférieur droit avec amyotrophie quadricipitale sévère et douleurs intenses, apparue en quelques semaines. Quel diagnostic évoquez-vous et quelle est l'évolution attendue ?
A. PNDS classique — évolution progressive et irréversible
B. Syndrome de Bruns-Garland (amyotrophie diabétique/plexopathie lombosacrée) — évolution spontanément favorable en 12-24 mois
C. Compression radiculaire L3-L4 — nécessitant une chirurgie urgente
D. Myopathie diabétique — traitement par corticoïdes
> ✅ **B** — Le syndrome de Bruns-Garland (amyotrophie diabétique) est une plexopathie/radiculopathie lombosacrée aiguë/subaiguë, asymétrique, avec douleur intense et amyotrophie proximale. Le mécanisme est probablement microvasculitique. L'évolution est spontanément favorable en 12-24 mois avec récupération partielle à complète, mais la phase douloureuse peut nécessiter un traitement antalgique intensif.

### Cas clinique intégré — Module 18

> 📝 **Cas clinique : Mme P., 62 ans, DT2 depuis 16 ans**
>
> Mme P. consulte pour des douleurs des pieds à type de brûlures, prédominantes la nuit, l'empêchant de supporter le drap sur les pieds. EVA douleur 7/10. DN4 : 6/10. Traitée par metformine 2 g/j + empagliflozine 10 mg. HbA1c : 7,4 %. PA : 132/78 mmHg.
>
> Examen : hypoesthésie en chaussettes, monofilament positif (3/8 sites insensibles bilatéralement), réflexes achilléens abolis, diapason diminué aux malléoles. Peau sèche des pieds, fissure talonnière droite. FC de repos : 95 bpm. Épreuve d'orthostatisme : PAS 138 couché → 112 debout.
>
> **Questions :**
> 1. Caractérisez la neuropathie (type, fibres atteintes, sévérité selon NDS approximatif).
> 2. Quels éléments évoquent une neuropathie autonome associée ? Quels tests complémentaires demandez-vous ?
> 3. Quel traitement de la douleur neuropathique proposez-vous en 1ère intention ? Justifiez.
> 4. Quelle prise en charge du pied proposez-vous devant le monofilament positif et la fissure ?
> 5. Si duloxétine 60 mg insuffisante à 4 semaines, quelle stratégie de 2e ligne ?

### Question de synthèse

> 🔄 **Synthèse** : Construisez un algorithme de dépistage et de prise en charge globale de la neuropathie diabétique intégrant : dépistage PNDS (tests cliniques), dépistage NAC (tests d'Ewing), évaluation de la douleur (DN4), traitement étiologique, traitement symptomatique par paliers, et mesures de prévention du pied diabétique.

---

## Références bibliographiques — Partie 5

1. Klein R, Klein BE, Moss SE et al. « The Wisconsin Epidemiologic Study of Diabetic Retinopathy: a review. » *Diabetes Metab Rev*, 1989; 5(7): 559-570.
2. DCCT Research Group. « The effect of intensive treatment of diabetes on the development and progression of long-term complications in insulin-dependent diabetes mellitus. » *N Engl J Med*, 1993; 329(14): 977-986.
3. UKPDS Group. « Tight blood pressure control and risk of macrovascular and microvascular complications in type 2 diabetes: UKPDS 38. » *BMJ*, 1998; 317(7160): 703-713.
4. Wilkinson CP, Ferris FL, Klein RE et al. « Proposed international clinical diabetic retinopathy and diabetic macular edema disease severity scales. » *Ophthalmology*, 2003; 110(9): 1677-1682.
5. Massin P, Chabouis A, Erginay A et al. « OPHDIAT: a telemedical network screening system for diabetic retinopathy. » *Diabetes Care*, 2008; 31(3): 391-396.
6. Chew EY, Davis MD, Danis RP et al. (ACCORD Eye Study). « The effects of medical management on the progression of diabetic retinopathy in persons with type 2 diabetes. » *Ophthalmology*, 2014; 121(12): 2443-2451.
7. Gross JG, Glassman AR, Jampol LM et al. (DRCR.net Protocol S). « Panretinal photocoagulation vs intravitreous ranibizumab for proliferative diabetic retinopathy. » *JAMA*, 2015; 314(20): 2137-2146.
8. Abràmoff MD, Lavin PT, Birch M et al. « Pivotal trial of an autonomous AI-based diagnostic system for detection of diabetic retinopathy in primary care offices. » *npj Digital Medicine*, 2018; 1: 39.
9. Mogensen CE. « Microalbuminuria, blood pressure and diabetic renal disease: origin and development of ideas. » *Diabetologia*, 1999; 42(3): 263-285.
10. Brenner BM, Cooper ME, de Zeeuw D et al. (RENAAL). « Effects of losartan on renal and cardiovascular outcomes in patients with type 2 diabetes and nephropathy. » *N Engl J Med*, 2001; 345(12): 861-869.
11. Perkovic V, Jardine MJ, Neal B et al. (CREDENCE). « Canagliflozin and renal outcomes in type 2 diabetes and nephropathy. » *N Engl J Med*, 2019; 380(24): 2295-2306.
12. Heerspink HJL, Stefánsson BV, Correa-Rotter R et al. (DAPA-CKD). « Dapagliflozin in patients with chronic kidney disease. » *N Engl J Med*, 2020; 383(15): 1436-1446.
13. Herrington WG, Staplin N, Wanner C et al. (EMPA-KIDNEY). « Empagliflozin in patients with chronic kidney disease. » *N Engl J Med*, 2023; 388(2): 117-127.
14. Bakris GL, Agarwal R, Anker SD et al. (FIDELIO-DKD). « Effect of finerenone on chronic kidney disease outcomes in type 2 diabetes. » *N Engl J Med*, 2020; 383(23): 2219-2229.
15. Pitt B, Filippatos G, Agarwal R et al. (FIGARO-DKD). « Cardiovascular events with finerenone in kidney disease and type 2 diabetes. » *N Engl J Med*, 2021; 385(24): 2252-2263.
16. Perkovic V, Tuttle KR, Rossing P et al. (FLOW). « Effects of semaglutide on chronic kidney disease in patients with type 2 diabetes. » *N Engl J Med*, 2024; 391(2): 109-121.
17. Young MJ, Boulton AJM, MacLeod AF et al. « A multicentre study of the prevalence of diabetic peripheral neuropathy in the United Kingdom hospital clinic population. » *Diabetologia*, 1993; 36(2): 150-154.
18. Bouhassira D, Attal N, Alchaar H et al. « Comparison of pain syndromes associated with nervous or somatic lesions and development of a new neuropathic pain diagnostic questionnaire (DN4). » *Pain*, 2005; 114(1-2): 29-36.
19. Ewing DJ, Clarke BF. « Diagnosis and management of diabetic autonomic neuropathy. » *BMJ*, 1982; 285(6346): 916-918.
20. Maser RE, Mitchell BD, Vinik AI, Freeman R. « The association between cardiovascular autonomic neuropathy and mortality in individuals with diabetes: a meta-analysis. » *Diabetes Care*, 2003; 26(6): 1895-1901.
21. Tesfaye S, Sloan G, Petrie J et al. (COMBO-DN). « Comparison of amitriptyline supplemented with pregabalin, pregabalin supplemented with amitriptyline, and duloxetine supplemented with pregabalin for the treatment of diabetic peripheral neuropathic pain. » *Lancet*, 2022; 400(10353): 680-690.

---

> 🔶 **DIABÉTOLOGIE** | Partie 5/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 6 — Complications Macrovasculaires et Pied Diabétique (Modules 19-21)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 19 : RISQUE CARDIOVASCULAIRE DU DIABÉTIQUE — ATHÉROSCLÉROSE ACCÉLÉRÉE, CARDIOPATHIE DIABÉTIQUE

**Partie** : VI — Complications macrovasculaires
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 5-6, 14

## Accroche clinique

> 🏥 **Mise en situation** : M. G., 58 ans, DT2 depuis 14 ans, HbA1c 8,1 %, fumeur actif 25 PA, LDL-c 1,45 g/L sous atorvastatine 20 mg, PA 142/88 mmHg sous ramipril 5 mg, IMC 31 kg/m². Asymptomatique sur le plan cardiaque. L'ECG de repos est normal. Son cardiologue demande un coroscanner qui révèle un score calcique coronaire > 400 et une sténose de l'IVA proximale estimée à 60 %. *Le diabète multiplie le risque cardiovasculaire par 2 à 4 — et la maladie coronaire reste la première cause de décès du patient diabétique. Cet homme « asymptomatique » a déjà une athérosclérose significative.*

## Objectifs d'apprentissage

1. **Comprendre** les mécanismes de l'athérosclérose accélérée du diabétique : dysfonction endothéliale, inflammation, dyslipidémie athérogène, hypercoagulabilité
2. **Évaluer** le risque cardiovasculaire global : scores SCORE2-Diabetes, tables de risque, reclassification
3. **Dépister** l'ischémie myocardique silencieuse chez le diabétique à haut risque
4. **Prescrire** la stratégie de prévention cardiovasculaire : statine, antihypertenseur, antiagrégant, iSGLT2, agoniste GLP-1
5. **Connaître** la cardiopathie diabétique (cardiomyopathie spécifique) et l'insuffisance cardiaque du diabétique
6. **Intégrer** les résultats des grands essais de sécurité cardiovasculaire (CVOT)

## Structure du contenu

### Section 1 — Épidémiologie et physiopathologie de l'athérosclérose diabétique

> Le module doit présenter les spécificités de l'atteinte cardiovasculaire chez le diabétique :

**Contenu obligatoire :**

- **Épidémiologie** : les maladies cardiovasculaires (MCV) sont la 1ère cause de décès chez le DT2 (50-80 % des décès) ; RR de coronaropathie ×2-4, d'AVC ×2-3, d'AOMI ×4-8 par rapport aux non-diabétiques ; le diabète est un facteur de risque CV « indépendant » au-delà de l'HTA, dyslipidémie, tabac ; surmortalité CV même après ajustement (Emerging Risk Factors Collaboration — Sarwar et al., Lancet, 2010)
- **Spécificités de l'athérosclérose diabétique** :
  - Atteinte diffuse, distale, pluritronculaire (vs focale chez le non-diabétique)
  - Plaques plus inflammatoires, plus riches en lipides, plus vulnérables → risque accru de rupture et de syndrome coronarien aigu
  - Calcifications artérielles médianes (médiacalcose) fréquentes → rigidité artérielle, IPS faussement élevé
  - Réseau collatéral moins développé → infarctus plus étendus
- **Physiopathologie** — le module doit détailler les mécanismes :
  - **Dysfonction endothéliale** : hyperglycémie → ↓ NO (eNOS découplée), ↑ endothéline-1, ↑ adhésion leucocytaire (VCAM-1, ICAM-1), ↑ perméabilité
  - **Dyslipidémie athérogène** : triade : hypertriglycéridémie + ↓ HDL-c + LDL petites et denses (phénotype B) — les LDL petites et denses traversent plus facilement l'endothélium et sont plus susceptibles à l'oxydation
  - **Insulinorésistance et inflammation** : tissu adipeux viscéral → TNF-α, IL-6, CRP ↑ → inflammation vasculaire chronique → activation macrophagique → cellules spumeuses → plaque
  - **Hypercoagulabilité** : ↑ fibrinogène, ↑ PAI-1 (inhibiteur de la fibrinolyse), ↑ facteur VII, hyperactivité plaquettaire (résistance relative à l'aspirine), ↓ fibrinolyse
  - **Glycation des lipoprotéines** : LDL glyquées → oxydation accrue → captation macrophagique accélérée
  - **Stress oxydatif vasculaire** : production de ROS mitochondrial, NADPH oxydase → lésions ADN, lipidiques, protéiques

> [MEDIA: 🔬 MDIAB19-S01-001 — SCHÉMA PHYSIOPATHOLOGIE ATHÉROSCLÉROSE DIABÉTIQUE (dysfonction endothéliale + dyslipidémie athérogène + inflammation + hypercoagulabilité → plaque vulnérable)]

> [MEDIA: 📊 MDIAB19-S01-002 — GRAPHIQUE RISQUE CV COMPARATIF (diabétiques vs non-diabétiques — coronaropathie, AVC, AOMI, IC — données méta-analytiques)]

> [MEDIA: 🔬 MDIAB19-S01-003 — COMPARATIF PLAQUE ATHÉROMATEUSE (non-diabétique : focale, stable vs diabétique : diffuse, inflammatoire, vulnérable)]

### Section 2 — Évaluation du risque et dépistage de l'ischémie silencieuse

> Le module doit présenter les outils d'évaluation du risque CV et le dépistage :

**Contenu obligatoire :**

- **Évaluation du risque CV** :
  - SCORE2-Diabetes (ESC 2023) : score spécifique intégrant âge, sexe, PA systolique, tabac, cholestérol total, HDL-c + variables diabétiques (âge au diagnostic, HbA1c, DFG) → risque d'événement CV fatal et non fatal à 10 ans ; catégorisation : risque modéré, élevé, très élevé
  - En pratique : la majorité des DT2 de plus de 40 ans sont considérés à haut ou très haut risque CV (ESC/EASD 2023)
  - Facteurs de reclassification : score calcique coronaire (CAC), index de pression systolique (IPS), albuminurie, atteinte des organes cibles
- **Dépistage de l'ischémie myocardique silencieuse (IMS)** :
  - Prévalence IMS chez le DT2 : 20-35 % (étude DIAD — Wackers et al., Diabetes Care, 2004)
  - Recommandations françaises (SFD/SFC 2021 — adaptées de Valensi et al.) : dépistage chez les patients à très haut risque CV (≥ 2 facteurs de risque CV + atteinte organe cible OU NAC OU AOMI OU albuminurie ≥ A2 OU reprise d'activité physique intense)
  - Modalités : ECG d'effort (1ère intention si possible), scintigraphie myocardique ou échographie de stress si ECG non interprétable/impossible, coroscanner (score calcique + anatomie coronaire)
  - Discussion : débat sur le bénéfice du dépistage systématique vs traitement médical optimal pour tous (étude DIAD : pas de réduction des événements CV par le dépistage, mais intensification thérapeutique dans les deux bras)
- **Spécificités de la coronaropathie du diabétique** :
  - Ischémie silencieuse fréquente (NAC → ↓ perception douloureuse)
  - SCA : pronostic plus sévère (mortalité hospitalière ↑), atteinte pluritronculaire fréquente, resténose accrue post-angioplastie, meilleurs résultats avec stents actifs (DES) et pontages (CABG > PCI dans l'atteinte pluritronculaire — étude FREEDOM, Farkouh et al., N Engl J Med, 2012)

> [MEDIA: 📋 MDIAB19-S02-001 — SCORE2-DIABETES (grilles de risque par sexe et âge, variables d'entrée, catégories de risque, seuils d'intervention)]

> [MEDIA: 📊 MDIAB19-S02-002 — ALGORITHME DÉPISTAGE IMS CHEZ LE DT2 (critères de sélection → choix du test → interprétation → CAT)]

### Section 3 — Cardiopathie diabétique et insuffisance cardiaque

> Le module doit présenter la cardiomyopathie diabétique et l'IC :

**Contenu obligatoire :**

- **Cardiomyopathie diabétique** (entité distincte de la coronaropathie et de la cardiopathie hypertensive) :
  - Concept initialement décrit par Rubler et al. (1972) : atteinte myocardique intrinsèque chez les diabétiques sans coronaropathie ni HTA significative
  - Physiopathologie : lipotoxicité myocardique (accumulation triglycérides intramyocytaires), fibrose interstitielle (TGF-β, collagène), dysfonction mitochondriale, anomalies du métabolisme calcique, AGE → rigidité myocardique
  - Présentation : d'abord dysfonction diastolique (ICFEp) → puis systolique (ICFEr) si progression
  - Diagnostic : échocardiographie (strain longitudinal global altéré, E/e' élevé), IRM cardiaque (fibrose — rehaussement tardif, T1 mapping), BNP/NT-proBNP
- **Insuffisance cardiaque chez le diabétique** :
  - Prévalence IC × 2-5 chez les diabétiques (Framingham — Kannel & McGee, 1979)
  - Deux phénotypes : ICFEp (le plus fréquent chez le DT2 — « HFpEF ») et ICFEr (« HFrEF »)
  - Impact pronostique : diabète = facteur de mauvais pronostic indépendant dans l'IC
- **Révolution des iSGLT2 dans l'IC** :
  - DAPA-HF (dapagliflozine — McMurray et al., N Engl J Med, 2019) : réduction de 26 % du critère composite (décès CV + hospitalisation IC) dans l'ICFEr, bénéfice identique diabétiques et non-diabétiques
  - EMPEROR-Reduced (empagliflozine — Packer et al., N Engl J Med, 2020) : réduction de 25 % du même critère dans l'ICFEr
  - EMPEROR-Preserved (empagliflozine — Anker et al., N Engl J Med, 2021) : réduction de 21 % des hospitalisations pour IC dans l'ICFEp
  - DELIVER (dapagliflozine — Solomon et al., N Engl J Med, 2022) : bénéfice dans l'ICFEp (réduction 18 % critère composite)
  - Recommandations ESC 2023 : iSGLT2 recommandés classe I dans l'ICFEr ET l'ICFEp, indépendamment du statut diabétique → les iSGLT2 sont devenus un pilier du traitement de l'IC
  - Mécanismes cardioprotecteurs : natriurèse/diurèse osmotique → ↓ précharge, ↓ PA → ↓ postcharge, amélioration métabolisme myocardique (switch vers β-hydroxybutyrate), ↓ fibrose, ↓ inflammation

> [MEDIA: 🫀 MDIAB19-S03-001 — SCHÉMA CARDIOMYOPATHIE DIABÉTIQUE (lipotoxicité + fibrose + dysfonction mitochondriale → dysfonction diastolique → systolique)]

> [MEDIA: 📊 MDIAB19-S03-002 — FOREST PLOT ESSAIS iSGLT2 DANS L'IC (DAPA-HF, EMPEROR-Reduced, EMPEROR-Preserved, DELIVER — HR, IC 95 %)]

> [MEDIA: 📋 MDIAB19-S03-003 — ALGORITHME IC CHEZ LE DIABÉTIQUE (ICFEr vs ICFEp, traitement selon les 4 piliers ESC + iSGLT2)]

### Section 4 — Prévention cardiovasculaire globale

> Le module doit présenter la stratégie multifactorielle de prévention CV :

**Contenu obligatoire :**

- **Approche multifactorielle** : l'étude STENO-2 (Gæde et al., N Engl J Med, 2003, suivi 21 ans Lancet Diabetes Endocrinol, 2016) a démontré qu'une intervention multifactorielle intensive (glycémie + PA + lipides + aspirine + mode de vie) réduit la mortalité CV de 53 % à 21 ans
- **Traitement hypolipémiant** (adapté d'ESC/EAS 2019 et ESC/EASD 2023) :
  - Cible LDL-c selon le risque : très haut risque < 0,55 g/L ET réduction ≥ 50 %, haut risque < 0,70 g/L ET réduction ≥ 50 %
  - Statine haute intensité (atorvastatine 40-80 mg ou rosuvastatine 20-40 mg) en 1ère intention
  - Si cible non atteinte : ajout ézétimibe, puis inhibiteur PCSK9 (évolocumab — FOURIER, alirocumab — ODYSSEY OUTCOMES) ou acide bempédoïque si intolérance statine
- **Contrôle tensionnel** : cible < 130/80 mmHg ; IEC/ARA2 en 1ère intention (si albuminurie) ; association IEC/ARA2 + amlodipine ou thiazidique si nécessaire
- **Antiagrégation plaquettaire** :
  - Prévention secondaire : aspirine 75-100 mg/j (indication formelle)
  - Prévention primaire : débat — recommandation faible chez DT2 à très haut risque sans risque hémorragique élevé (ESC/EASD 2023) ; étude ASCEND (Bowman et al., N Engl J Med, 2018) : réduction modeste événements CV (−12 %) mais ↑ hémorragies majeures (+29 %)
- **iSGLT2 et agonistes GLP-1 à bénéfice CV prouvé** (les CVOT) :
  - iSGLT2 avec bénéfice CV : empagliflozine (EMPA-REG OUTCOME — Zinman et al., N Engl J Med, 2015 : ↓ 38 % mortalité CV), canagliflozine (CANVAS), dapagliflozine (DECLARE-TIMI 58)
  - Agonistes GLP-1 avec bénéfice CV : liraglutide (LEADER — Marso et al., N Engl J Med, 2016 : ↓ 22 % mortalité CV), sémaglutide SC (SUSTAIN-6), dulaglutide (REWIND), efpéglénaide
  - Recommandations ESC/EASD 2023 : chez DT2 avec MCV athérosclérotique établie → iSGLT2 ou agoniste GLP-1 à bénéfice CV prouvé, indépendamment de l'HbA1c ; chez DT2 avec IC → iSGLT2 ; chez DT2 avec MRC → iSGLT2 (± finérénone)
- **Sevrage tabagique** : réduction du risque CV de 35-40 % à 2 ans ; aide au sevrage (substituts nicotiniques, varénicline, TCC) ; attention à la prise de poids post-sevrage chez le DT2
- **Activité physique** : ≥ 150 min/semaine d'activité modérée ou 75 min intense ; réduction mortalité CV de 25-40 % ; épreuve d'effort préalable si très haut risque + sédentaire

> [MEDIA: 📊 MDIAB19-S04-001 — RÉSULTATS STENO-2 À 21 ANS (courbes de survie groupe intensif vs conventionnel — mortalité toutes causes et CV)]

> [MEDIA: 📋 MDIAB19-S04-002 — TABLEAU CIBLES THÉRAPEUTIQUES CV DU DIABÉTIQUE (HbA1c, LDL-c, PA, aspirine — selon niveau de risque ESC)]

> [MEDIA: 📊 MDIAB19-S04-003 — FOREST PLOT CVOT (EMPA-REG, CANVAS, DECLARE, LEADER, SUSTAIN-6, REWIND — MACE 3 points, mortalité CV)]

## Points clés — Module 19

> 🎯 **Essentiel à retenir**
> 1. Les MCV sont la 1ère cause de décès du DT2 — athérosclérose diffuse, distale, pluritronculaire
> 2. Dyslipidémie athérogène : ↑ TG + ↓ HDL + LDL petites et denses → plaque vulnérable
> 3. SCORE2-Diabetes : outil d'évaluation du risque CV spécifique au diabétique (ESC 2023)
> 4. Ischémie silencieuse : fréquente (20-35 %) → dépistage ciblé chez les très hauts risques
> 5. Cardiomyopathie diabétique : entité spécifique (lipotoxicité + fibrose) → ICFEp puis ICFEr
> 6. iSGLT2 : révolution dans l'IC (DAPA-HF, EMPEROR) — recommandés classe I dans ICFEr ET ICFEp
> 7. STENO-2 : l'intervention multifactorielle intensive réduit la mortalité CV de 53 % à 21 ans
> 8. Cibles LDL-c : < 0,55 g/L si très haut risque, < 0,70 g/L si haut risque (statine forte dose ± ézétimibe ± iPCSK9)
> 9. CVOT : iSGLT2 (EMPA-REG) et agonistes GLP-1 (LEADER) ont un bénéfice CV prouvé → prioritaires chez DT2 avec MCV
> 10. Aspirine en prévention primaire : rapport bénéfice/risque modeste (ASCEND) → décision individualisée

## Auto-évaluation — Module 19

### QCM progressifs (12 questions)

**Q1 — 🥉 Bronze** : Quelle est la première cause de décès chez le patient DT2 ?
A. Insuffisance rénale terminale
B. Maladies cardiovasculaires
C. Infections
D. Cancers
> ✅ **B** — Les maladies cardiovasculaires représentent 50-80 % des causes de décès chez le DT2, principalement par coronaropathie et AVC.

**Q2 — 🥉 Bronze** : Qu'est-ce que la dyslipidémie athérogène du diabétique ?
A. Hypercholestérolémie familiale
B. Triade : hypertriglycéridémie + ↓ HDL-c + LDL petites et denses
C. Élévation isolée du LDL-c
D. Hypolipoprotéinémie
> ✅ **B** — La dyslipidémie athérogène du DT2 associe hypertriglycéridémie, baisse du HDL-c et prédominance de LDL petites et denses (phénotype B), plus athérogènes car plus oxydables et plus diffusibles à travers l'endothélium.

**Q3 — 🥈 Argent** : Quelle cible de LDL-c recommandez-vous chez un DT2 à très haut risque CV ?
A. < 1,30 g/L
B. < 1,00 g/L
C. < 0,70 g/L
D. < 0,55 g/L ET réduction ≥ 50 %
> ✅ **D** — Chez les patients à très haut risque CV (dont la plupart des DT2 avec MCV établie), la cible ESC/EAS 2019 est un LDL-c < 0,55 g/L avec une réduction d'au moins 50 % par rapport à la valeur de base.

**Q4 — 🥈 Argent** : L'étude STENO-2 a montré quel bénéfice de l'approche multifactorielle intensive chez le DT2 ?
A. Réduction de 10 % de la mortalité CV
B. Réduction de 53 % de la mortalité CV à 21 ans de suivi
C. Aucun bénéfice significatif
D. Bénéfice uniquement sur la néphropathie
> ✅ **B** — STENO-2 (Gæde et al.) a démontré une réduction spectaculaire de 53 % de la mortalité CV à 21 ans par une intervention multifactorielle intensive (glycémie, PA, lipides, aspirine, mode de vie) vs traitement conventionnel.

**Q5 — 🥈 Argent** : Quel est le principal résultat de l'étude EMPA-REG OUTCOME ?
A. L'empagliflozine réduit l'HbA1c de 2 %
B. L'empagliflozine réduit la mortalité CV de 38 % chez les DT2 en prévention secondaire
C. L'empagliflozine augmente le risque d'amputation
D. L'empagliflozine n'a pas de bénéfice CV significatif
> ✅ **B** — EMPA-REG OUTCOME (Zinman et al., 2015) a montré une réduction de 38 % de la mortalité CV avec l'empagliflozine chez les DT2 avec MCV athérosclérotique établie, résultat historique qui a changé la prise en charge du DT2.

**Q6 — 🥈 Argent** : L'aspirine est-elle recommandée en prévention primaire chez le DT2 ?
A. Oui, systématiquement pour tous les DT2
B. Recommandation faible, uniquement chez les DT2 à très haut risque sans risque hémorragique élevé
C. Non, jamais en prévention primaire
D. Uniquement en association avec le clopidogrel
> ✅ **B** — L'étude ASCEND a montré un bénéfice modeste de l'aspirine en prévention primaire (−12 % événements CV) contrebalancé par une augmentation des hémorragies majeures (+29 %). La recommandation est faible, réservée aux très hauts risques sans risque hémorragique élevé (ESC/EASD 2023).

**Q7 — 🥇 Or** : Les iSGLT2 sont recommandés dans l'IC (classe I ESC 2023) pour quels phénotypes ?
A. ICFEr uniquement
B. ICFEp uniquement
C. ICFEr ET ICFEp, indépendamment du statut diabétique
D. Uniquement chez les diabétiques avec IC
> ✅ **C** — Les études DAPA-HF/EMPEROR-Reduced (ICFEr) et EMPEROR-Preserved/DELIVER (ICFEp) ont montré le bénéfice des iSGLT2 dans les deux phénotypes d'IC, chez les diabétiques ET les non-diabétiques. La recommandation ESC 2023 est de classe I pour les deux.

**Q8 — 🥇 Or** : Chez un DT2 avec coronaropathie pluritronculaire, quelle revascularisation est supérieure selon l'étude FREEDOM ?
A. Angioplastie avec stents actifs (PCI)
B. Pontage aorto-coronaire (CABG)
C. Traitement médical seul
D. Pas de différence
> ✅ **B** — L'étude FREEDOM (Farkouh et al., 2012) a montré la supériorité du pontage (CABG) sur l'angioplastie (PCI) chez les diabétiques avec coronaropathie pluritronculaire, en termes de survie et de réduction des événements CV majeurs.

**Q9 — 🥇 Or** : Quel est le mécanisme cardioprotecteur principal des iSGLT2 dans l'IC ?
A. Baisse de l'HbA1c
B. Natriurèse/diurèse osmotique (↓ précharge) + amélioration métabolisme myocardique (switch vers β-hydroxybutyrate) + ↓ fibrose
C. Vasodilatation coronaire directe
D. Effet inotrope positif
> ✅ **B** — Les mécanismes cardioprotecteurs des iSGLT2 sont multiples et indépendants de l'effet glycémique : natriurèse/diurèse osmotique (↓ précharge), ↓ PA (↓ postcharge), amélioration du métabolisme myocardique (utilisation préférentielle des corps cétoniques), ↓ fibrose et ↓ inflammation myocardique.

**Q10 — 🥇 Or** : Qu'est-ce que la cardiomyopathie diabétique ?
A. Une coronaropathie sévère chez le diabétique
B. Une atteinte myocardique intrinsèque (lipotoxicité, fibrose, dysfonction mitochondriale) indépendante de la coronaropathie et de l'HTA
C. Une valvulopathie spécifique du diabète
D. Une péricardite constrictive
> ✅ **B** — La cardiomyopathie diabétique est une entité distincte décrite par Rubler (1972), caractérisée par une atteinte myocardique intrinsèque (lipotoxicité, fibrose interstitielle, dysfonction mitochondriale) survenant en l'absence de coronaropathie et d'HTA significative. Elle se manifeste d'abord par une dysfonction diastolique (ICFEp).

**Q11 — 💎 Diamant** : Un DT2 de 55 ans en prévention primaire avec SCORE2-Diabetes à risque élevé, LDL-c 0,95 g/L sous atorvastatine 40 mg + ézétimibe 10 mg. Quelle est la prochaine étape ?
A. Augmenter l'atorvastatine à 80 mg
B. Ajouter un inhibiteur PCSK9 (évolocumab ou alirocumab)
C. Remplacer par de la rosuvastatine
D. Accepter ce résultat comme satisfaisant
> ✅ **B** — La cible est LDL-c < 0,70 g/L pour le risque élevé. Sous statine haute dose + ézétimibe, le LDL-c reste à 0,95 g/L. L'étape suivante selon l'algorithme ESC/EAS est l'ajout d'un inhibiteur PCSK9 (évolocumab ou alirocumab).

**Q12 — 💎 Diamant** : Mme F., 60 ans, DT2 avec IDM récent (6 mois), FEVG 35 %, DFG 52 mL/min, RAC 250 mg/g, HbA1c 8,2 %, sous metformine, ramipril, bisoprolol, aspirine, atorvastatine. Quels traitements à bénéfice cardio-rénal ajoutez-vous prioritairement ?
A. Sulfamide hypoglycémiant + inhibiteur calcique
B. iSGLT2 (empagliflozine ou dapagliflozine) + agoniste GLP-1 (sémaglutide ou liraglutide)
C. Insuline basale + thiazidique
D. Inhibiteur DPP-4 + ARM (spironolactone)
> ✅ **B** — Cette patiente cumule MCV athérosclérotique (IDM), ICFEr (FEVG 35 %), et MRC avec albuminurie. L'iSGLT2 est prioritaire (bénéfice sur les 3 atteintes : EMPA-REG/DAPA-HF/CREDENCE). L'ajout d'un agoniste GLP-1 à bénéfice CV (LEADER/SUSTAIN-6) est recommandé pour le bénéfice athérosclérotique additionnel et la gestion pondérale.

### Cas clinique intégré — Module 19

> 📝 **Cas clinique : M. S., 56 ans, DT2 depuis 10 ans**
>
> M. S., commercial, DT2 traité par metformine 2 g/j + sitagliptine 100 mg. HbA1c : 7,9 %. IMC : 33. Fumeur 30 PA. PA : 148/92 mmHg (non traité). LDL-c : 1,65 g/L (non traité). HDL-c : 0,35 g/L. TG : 2,80 g/L. Créatinine : 88 µmol/L, DFG 82 mL/min. RAC : 85 mg/g. FO : RDNP minime. ECG : normal. Pas de symptôme cardiaque.
>
> **Questions :**
> 1. Évaluez le risque CV de ce patient (facteurs de risque, atteintes d'organes cibles, niveau de risque ESC).
> 2. Quelles cibles thérapeutiques fixez-vous (LDL-c, PA, HbA1c) ?
> 3. Quel traitement hypolipémiant prescrivez-vous ? Quel contrôle à 6 semaines ?
> 4. Quels antidiabétiques à bénéfice CV remplaceraient la sitagliptine ? Justifiez.
> 5. Faut-il dépister une ischémie myocardique silencieuse ? Argumentez.
> 6. Quel traitement antihypertenseur choisissez-vous et pourquoi ?

### Question de synthèse

> 🔄 **Synthèse** : Construisez l'ordonnance complète de prévention cardiovasculaire d'un patient DT2 à très haut risque CV (coronaropathie + ICFEr + MRC stade G3a A2), en justifiant chaque ligne par le niveau de preuve (étude clinique de référence).

---

# MODULE 20 : PIED DIABÉTIQUE — DÉPISTAGE, MAL PERFORANT, ARTÉRIOPATHIE, CHARCOT

**Partie** : VI — Complications macrovasculaires
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 18-19

## Accroche clinique

> 🏥 **Mise en situation** : M. H., 68 ans, DT2 depuis 22 ans, consulte pour une « plaie au pied qui ne guérit pas » depuis 3 semaines. Il marche beaucoup (travail en entrepôt) et a remarqué la plaie par hasard en retirant sa chaussette tachée. L'examen révèle un mal perforant plantaire en regard de la tête de M1 droit (2 × 1,5 cm, profondeur atteignant le tendon), pied chaud, pouls pédieux palpables mais tibial postérieur absent. Monofilament 10 g : 1/8 sites perçus bilatéralement. *Le pied diabétique est la première cause d'amputation non traumatique — et la majorité des amputations sont précédées d'un ulcère qui aurait pu être prévenu.*

## Objectifs d'apprentissage

1. **Réaliser** un examen complet du pied diabétique : neurologique, vasculaire, cutané, morphologique
2. **Classer** le risque podologique (grades IWGDF 0-3) et adapter la surveillance
3. **Diagnostiquer** et prendre en charge un mal perforant plantaire : classification PEDIS/SINBAD/UT
4. **Reconnaître** et traiter une infection du pied diabétique (classification IWGDF/IDSA)
5. **Diagnostiquer** le pied de Charcot et connaître sa prise en charge
6. **Évaluer** l'artériopathie du membre inférieur (AOMI) chez le diabétique

## Structure du contenu

### Section 1 — Épidémiologie et physiopathologie du pied diabétique

> Le module doit présenter les mécanismes du pied diabétique :

**Contenu obligatoire :**

- **Épidémiologie** : risque d'ulcère du pied au cours de la vie : 19-34 % des diabétiques ; incidence annuelle : 2-5 % ; taux d'amputation : 0,5-1 %/an chez les diabétiques ; 85 % des amputations sont précédées d'un ulcère ; mortalité à 5 ans post-amputation majeure : 50-70 % (comparable aux cancers métastatiques — Armstrong et al., N Engl J Med, 2017)
- **Triade physiopathologique** :
  - **Neuropathie** (facteur principal, présent dans > 80 % des ulcères) : perte de la sensibilité protectrice (monofilament 10 g) → blessures non ressenties ; neuropathie motrice → déformation du pied (orteils en griffe, proéminence des têtes métatarsiennes → hyperpression) ; neuropathie autonome → anhidrose → peau sèche, fissures → porte d'entrée
  - **Artériopathie** (AOMI, présente dans ~50 % des ulcères) : atteinte préférentiellement distale (artères jambières et du pied → difficulté de revascularisation) ; médiacalcose → IPS faussement élevé (> 1,30 = non compressible) → utiliser la pression au gros orteil ou TcPO2 ; hypoxie tissulaire → retard de cicatrisation
  - **Infection** (complication surajoutée, non cause primaire) : porte d'entrée cutanée → inoculation polymicrobienne ; réponse immunitaire altérée (neutrophiles dysfonctionnels) → extension rapide
- **Facteurs de risque d'ulcération** : antécédent d'ulcère ou d'amputation (RR ×15-20), neuropathie avec perte de sensibilité protectrice, AOMI, déformations du pied, callosités (hyperpression), insuffisance rénale/dialyse, mauvais contrôle glycémique, tabac, chaussage inadapté

> [MEDIA: 🦶 MDIAB20-S01-001 — SCHÉMA TRIADE PHYSIOPATHOLOGIQUE PIED DIABÉTIQUE (neuropathie + artériopathie + infection → ulcère → amputation)]

> [MEDIA: 🦶 MDIAB20-S01-002 — PHOTOS CLINIQUES DÉFORMATIONS NEUROPATHIQUES (orteils en griffe, proéminence M1-M5, hallux valgus, pied creux → zones d'hyperpression)]

### Section 2 — Dépistage et gradation du risque podologique

> Le module doit présenter le dépistage systématique et la prévention :

**Contenu obligatoire :**

- **Examen annuel du pied** (recommandations IWGDF 2023, HAS) — examen structuré en 4 temps :
  1. **Interrogatoire** : antécédents d'ulcère/amputation, symptômes neuropathiques, claudication, chaussage, soins de pédicurie
  2. **Examen neurologique** : monofilament 10 g (obligatoire) + diapason 128 Hz et/ou réflexes achilléens
  3. **Examen vasculaire** : palpation pouls pédieux et tibiaux postérieurs ; IPS (normal 0,90-1,30, AOMI < 0,90, non compressible > 1,30) ; attention : IPS faussement élevé si médiacalcose → mesurer pression du gros orteil (anormale < 40 mmHg) ou TcPO2
  4. **Examen cutané et morphologique** : callosités (zones d'hyperpression), mycose interdigitale/unguéale, sécheresse cutanée, fissures, ongle incarné, plaie, déformations (orteils en griffe, hallux valgus, pied de Charcot)
- **Gradation du risque podologique** (adapté de l'IWGDF 2023) :
  - **Grade 0** : pas de neuropathie → examen annuel, éducation
  - **Grade 1** : neuropathie isolée (monofilament + et/ou diapason −) → examen tous les 6-12 mois, pédicure-podologue annuel (remboursé)
  - **Grade 2** : neuropathie + AOMI et/ou déformation → examen tous les 3-6 mois, pédicure-podologue tous les 3 mois (remboursé), semelles orthopédiques, chaussage adapté
  - **Grade 3** : antécédent d'ulcère ou d'amputation → examen tous les 1-3 mois, pédicure-podologue mensuel (remboursé), chaussage thérapeutique sur mesure, suivi multidisciplinaire (centre du pied diabétique)
- **Éducation du patient** : auto-inspection quotidienne des pieds (miroir), hygiène (lavage, séchage interdigital), hydratation (crème émolliente quotidienne), chaussage adapté (jamais pieds nus, éviter les coutures saillantes), coupe d'ongles droite (pas de lame), consultation rapide si plaie

> [MEDIA: 🦶 MDIAB20-S02-001 — TECHNIQUE EXAMEN COMPLET DU PIED (4 temps illustrés : interrogatoire, neuro, vasculaire, cutané/morpho)]

> [MEDIA: 📋 MDIAB20-S02-002 — TABLEAU GRADATION RISQUE PODOLOGIQUE IWGDF (grade 0-3, définition, fréquence de surveillance, prestations remboursées)]

> [MEDIA: 📋 MDIAB20-S02-003 — FICHE ÉDUCATION PATIENT « 10 RÈGLES D'OR DU PIED DIABÉTIQUE » (conseils illustrés)]

### Section 3 — Ulcère du pied diabétique : diagnostic et prise en charge

> Le module doit présenter la classification et le traitement des ulcères :

**Contenu obligatoire :**

- **Classifications** :
  - **Classification de l'Université du Texas (UT)** (adapté de Lavery et al., Diabetes Care, 1996) : profondeur (grade 0-3) × complication (stade A-D : A = pas d'infection ni ischémie, B = infection, C = ischémie, D = infection + ischémie) → matrice pronostique
  - **SINBAD score** (Ince et al., Diabetes Care, 2008) : 6 critères binaires (Site, Ischemia, Neuropathy, Bacterial infection, Area, Depth) → score 0-6 → pronostic de cicatrisation
  - **Classification PEDIS** (IWGDF) : Perfusion, Extent, Depth, Infection, Sensation → descriptive et standardisée
  - **Classification IDSA/IWGDF de l'infection** : pas d'infection, infection légère (superficielle, < 2 cm), modérée (> 2 cm ou abcès/ostéite), sévère (signes systémiques, sepsis)
- **Bilan initial** d'un ulcère :
  - Étiologie : neuropathique pur (mal perforant plantaire : zone d'hyperpression, pouls présents, indolore, bords kératosiques), ischémique (orteils, acral, douloureux, pouls absents), mixte (le plus fréquent en pratique)
  - Recherche d'infection : signes locaux (rougeur > 0,5 cm, chaleur, œdème, douleur, pus), signes généraux (fièvre, frissons, tachycardie, hypotension) ; prélèvement bactériologique profond (après détersion et avant ATB) — écouvillon superficiel insuffisant → curetage du fond de plaie ou aspiration à l'aiguille
  - Recherche d'ostéite : « contact osseux » (sonde boutonnée métallique : si contact osseux → VPP ostéite ~90 % si infection clinique présente — Grayson et al., JAMA, 1995) ; imagerie : radiographies standard (retard de 2-4 semaines), IRM (examen de référence : sensibilité 90 %, spécificité 80 % — Dinh et al., Clin Infect Dis, 2008)
  - Évaluation vasculaire : IPS, pression d'orteil, TcPO2 (< 30 mmHg = ischémie critique → revascularisation à discuter)
- **Prise en charge multidisciplinaire** :
  - **Mise en décharge** (le pilier du traitement de l'ulcère neuropathique) : botte de décharge inamovible à contact total (irremovable total contact cast — iTCC) = gold standard (IWGDF 2023, grade de recommandation fort) ; alternative : botte amovible rendue inamovible ; résultat : cicatrisation à 12 semaines ~90 % si iTCC vs ~60 % si chaussure de décharge amovible (Bus et al., Lancet, 2024)
  - **Soins locaux** : détersion mécanique (retrait kératose, tissu nécrotique), pansement adapté (maintenir milieu humide), pas d'antiseptiques cytotoxiques
  - **Antibiothérapie** (si infection clinique confirmée) : ne pas traiter une plaie colonisée sans signes d'infection clinique ; infection légère : monothérapie orale ciblant Gram+ (amoxicilline-acide clavulanique, clindamycine) 1-2 semaines ; infection modérée-sévère : bi/trithérapie parentérale (pipéracilline-tazobactam, carbapénème si BMR) couvrant Gram+, Gram-, anaérobies
  - **Ostéite du pied diabétique** : antibiothérapie prolongée 6 semaines (si prise en charge médicale) ; chirurgie conservatrice (résection osseuse limitée + ATB 10 jours) ; choix médical vs chirurgical dépend du contexte (localisation, taille, vasculaire, comorbidités)
  - **Revascularisation** : angioplastie distale ou pontage si ischémie critique (TcPO2 < 30 mmHg, pression d'orteil < 40 mmHg, IPS < 0,50) et plaie ne cicatrisant pas malgré soins optimaux
  - **Traitements adjuvants** : oxygénothérapie hyperbare (preuves limitées, IWGDF conditionnelle), thérapie par pression négative (VAC), facteurs de croissance (platelet-derived growth factor — bécaplermine, preuves modestes), substituts dermiques
  - **Amputation** : dernier recours, gangrène humide extensive, sepsis non contrôlé, ischémie non revascularisable ; toujours discuter en réunion multidisciplinaire ; conservation maximale

> [MEDIA: 🦶 MDIAB20-S03-001 — PHOTOS CLINIQUES ULCÈRES (neuropathique pur : mal perforant M1 vs ischémique : nécrose d'orteil vs mixte)]

> [MEDIA: 📋 MDIAB20-S03-002 — CLASSIFICATION UT (matrice grade 0-3 × stade A-D, couleur pronostique, % cicatrisation, % amputation)]

> [MEDIA: 📋 MDIAB20-S03-003 — ALGORITHME PRISE EN CHARGE ULCÈRE PIED DIABÉTIQUE (évaluation → étiologie → infection → ostéite → décharge → revascularisation → suivi)]

### Section 4 — AOMI diabétique et pied de Charcot

> Le module doit présenter l'AOMI et l'ostéoarthropathie neuropathique :

**Contenu obligatoire :**

- **AOMI du diabétique** — spécificités :
  - Prévalence AOMI : 20-30 % des DT2 (IPS < 0,90) ; risque d'AOMI × 4-8 vs non-diabétiques
  - Topographie : atteinte préférentiellement distale (artères jambières : tibiale antérieure, tibiale postérieure, fibulaire) et du pied → ischémie distale avec conservation possible des pouls fémoraux et poplités
  - Calcifications médianes fréquentes → IPS faussement normal ou élevé (> 1,30 chez 30 % des diabétiques) → mesurer la pression au gros orteil (index orteil-bras < 0,70 = AOMI) et la TcPO2
  - Claudication souvent absente (neuropathie) → ischémie silencieuse fréquente
  - Bilan : écho-Doppler artériel MI, angio-TDM ou angio-IRM si revascularisation envisagée, artériographie conventionnelle si geste interventionnel
  - Traitement : antiagrégant + statine + contrôle des facteurs de risque + programme de marche supervisée ; revascularisation si ischémie critique ou plaie ne cicatrisant pas
- **Pied de Charcot (ostéoarthropathie neuropathique diabétique)** :
  - Définition : arthropathie destructrice non infectieuse survenant sur pied neuropathique, caractérisée par un processus inflammatoire excessif → fragmentation et luxation osseuse → déformation majeure
  - Épidémiologie : rare (0,1-0,3 % des diabétiques) mais grave ; atteinte bilatérale dans 25-50 % des cas ; le pied le plus fréquemment affecté est le médio-pied (articulations de Lisfranc et Chopart — classification de Sanders et Frykberg)
  - Physiopathologie : neuropathie → perte de proprioception → microtraumatismes répétés → réponse inflammatoire exagérée (RANKL ↑ → ostéoclastogenèse ↑, OPG ↓) → résorption osseuse → fractures pathologiques → effondrement de l'arche → pied « en tampon-buvard » (rocker-bottom deformity)
  - Diagnostic :
    - Phase aiguë : pied rouge, chaud, œdème, ΔT > 2°C vs controlatéral (thermométrie infrarouge), pouls bondissants, douleur minime/absente (neuropathie) → piège diagnostique majeur : souvent confondu avec cellulite, DVT, goutte, ostéite → RETARD DIAGNOSTIQUE moyen 29 semaines
    - Imagerie : radiographies (fragmentation, subluxation, destruction articulaire) ; IRM (œdème médullaire ↔ infection → distinction parfois difficile) ; scintigraphie osseuse + leucocytes marqués si suspicion d'ostéite associée
  - Classification de Sanders et Frykberg : type I (avant-pied), II (tarse-métatarse = Lisfranc, le plus fréquent), III (médio-tarse = Chopart), IV (cheville), V (calcanéum)
  - Prise en charge :
    - Phase aiguë : DÉCHARGE STRICTE (le traitement principal) → botte de contact total ou orthèse pneumatique amovible ; durée moyenne 3-6 mois jusqu'à résolution de l'inflammation (ΔT < 2°C vs controlatéral pendant 2 semaines consécutives)
    - Traitements médicamenteux (preuves limitées) : bisphosphonates (résultats décevants), calcitonine (quelques études), vitamine D/calcium
    - Phase chronique : chaussage sur mesure avec orthèses de correction pour prévenir les ulcères sur les zones de déformation ; chirurgie reconstructrice (arthrodèse de stabilisation) si instabilité sévère ou ulcère récidivant non contrôlable par chaussage

> [MEDIA: 🦶 MDIAB20-S04-001 — PHOTOS PIED DE CHARCOT (phase aiguë : pied rouge chaud vs phase chronique : déformation « rocker-bottom » vs radiographie fragmentation médio-pied)]

> [MEDIA: 📊 MDIAB20-S04-002 — ALGORITHME DIAGNOSTIC DIFFÉRENTIEL PIED CHAUD DIABÉTIQUE (Charcot vs cellulite vs ostéite vs DVT — éléments distinctifs)]

> [MEDIA: 📋 MDIAB20-S04-003 — CLASSIFICATION DE SANDERS ET FRYKBERG (types I-V, localisation anatomique, fréquence, schéma du squelette du pied)]

## Points clés — Module 20

> 🎯 **Essentiel à retenir**
> 1. Le pied diabétique est la 1ère cause d'amputation non traumatique — mortalité post-amputation ~50-70 % à 5 ans
> 2. Triade physiopathologique : neuropathie (>80 %) + artériopathie (~50 %) + infection (complication)
> 3. Examen annuel obligatoire : monofilament 10 g + pouls + inspection cutanée → grade IWGDF 0-3
> 4. Mal perforant plantaire = ulcère neuropathique en zone d'hyperpression, indolore, pouls présents
> 5. Décharge (iTCC) = gold standard du traitement de l'ulcère neuropathique (>90 % cicatrisation à 12 sem)
> 6. Contact osseux positif + infection → VPP ostéite ~90 % → IRM de confirmation
> 7. AOMI diabétique : atteinte distale + médiacalcose → IPS faussement élevé → utiliser pression d'orteil/TcPO2
> 8. Pied de Charcot aigu : pied chaud, rouge, ΔT > 2°C, douleur absente → DIAGNOSTIC PIÈGE (≠ infection !)
> 9. Retard diagnostique moyen du Charcot : 29 semaines — sensibiliser les médecins
> 10. Ne jamais traiter par antibiotiques un ulcère sans signes cliniques d'infection

## Auto-évaluation — Module 20

### QCM progressifs (13 questions)

**Q1 — 🥉 Bronze** : Quelle est la première cause d'amputation non traumatique dans les pays développés ?
A. Artériopathie athérosclérotique isolée
B. Pied diabétique
C. Traumatismes sportifs
D. Tumeurs osseuses
> ✅ **B** — Le pied diabétique est la 1ère cause d'amputation non traumatique. 85 % des amputations sont précédées d'un ulcère qui aurait pu être prévenu par un dépistage et une prise en charge précoce.

**Q2 — 🥉 Bronze** : Quel test est obligatoire lors de l'examen annuel du pied du diabétique ?
A. Doppler artériel des MI
B. Radiographie du pied
C. Monofilament de Semmes-Weinstein 10 g
D. Biopsie cutanée
> ✅ **C** — Le monofilament 10 g est l'examen de dépistage obligatoire annuel de la neuropathie et du risque podologique chez tout diabétique (recommandations IWGDF, HAS, ADA).

**Q3 — 🥈 Argent** : Un patient diabétique avec monofilament positif + AOMI (IPS 0,75) mais sans antécédent d'ulcère est classé en grade podologique :
A. Grade 0
B. Grade 1
C. Grade 2
D. Grade 3
> ✅ **C** — Grade 2 = neuropathie + AOMI et/ou déformation. Ce patient a une perte de sensibilité protectrice (monofilament +) ET une AOMI (IPS < 0,90). La surveillance doit être tous les 3-6 mois avec chaussage adapté.

**Q4 — 🥈 Argent** : Quel est le gold standard du traitement de décharge de l'ulcère neuropathique du pied ?
A. Chaussure post-opératoire
B. Béquilles avec mise en décharge complète
C. Botte de contact total inamovible (iTCC)
D. Semelles orthopédiques
> ✅ **C** — L'iTCC (irremovable total contact cast) est le gold standard de la décharge selon IWGDF 2023. La cicatrisation atteint ~90 % à 12 semaines vs ~60 % avec une chaussure de décharge amovible (Bus et al., Lancet, 2024).

**Q5 — 🥈 Argent** : Pourquoi l'IPS peut-il être faussement élevé chez le diabétique ?
A. Hypotension artérielle fréquente
B. Médiacalcose (calcifications artérielles médianes) → artères non compressibles
C. Œdèmes des MI surestimant la pression
D. Erreur systématique du Doppler
> ✅ **B** — La médiacalcose (calcifications de la média artérielle) rend les artères non compressibles, faussant l'IPS vers des valeurs élevées (> 1,30 chez 30 % des diabétiques). Alternatives : pression au gros orteil (index orteil-bras) ou TcPO2.

**Q6 — 🥈 Argent** : Quel signe clinique a une VPP de ~90 % pour l'ostéite du pied diabétique en contexte d'infection ?
A. Fièvre > 38,5°C
B. Contact osseux à la sonde métallique (« probe-to-bone test »)
C. CRP > 50 mg/L
D. Radiographie normale
> ✅ **B** — Le contact osseux à la sonde métallique (probe-to-bone test de Grayson) a une VPP de ~90 % pour l'ostéite lorsqu'il existe des signes cliniques d'infection. C'est un test simple, réalisable au lit du patient.

**Q7 — 🥇 Or** : Quelles caractéristiques distinguent l'ulcère neuropathique pur de l'ulcère ischémique ?
A. L'ulcère neuropathique est douloureux, l'ischémique est indolore
B. L'ulcère neuropathique est en zone d'hyperpression avec pouls présents et bords kératosiques ; l'ischémique est acral, douloureux, pouls absents
C. Les deux sont identiques cliniquement
D. L'ulcère ischémique a toujours des bords kératosiques
> ✅ **B** — L'ulcère neuropathique (mal perforant) siège en zone d'hyperpression (M1, M5), est indolore, avec des pouls présents et des bords kératosiques. L'ulcère ischémique est acral (orteils, talon, bord du pied), douloureux, avec des pouls absents et des bords nécrotiques.

**Q8 — 🥇 Or** : Qu'est-ce qui différencie un pied de Charcot aigu d'une cellulite infectieuse du pied ?
A. La cellulite est indolore
B. Le Charcot est douloureux avec fièvre
C. Le Charcot est peu/pas douloureux (neuropathie), sans fièvre, avec ΔT > 2°C ; la cellulite est douloureuse avec fièvre et adénopathie
D. Aucune différence clinique possible
> ✅ **C** — Le piège diagnostique du Charcot aigu est la présentation (pied chaud, rouge, gonflé) mimant une infection. Les clés : neuropathie sévère → douleur absente ou minime, pas de fièvre ni frissons, pas d'hyperleucocytose (sauf si infection associée), pas de porte d'entrée évidente. La thermométrie (ΔT > 2°C) est un outil utile.

**Q9 — 🥇 Or** : Dans le traitement de l'infection du pied diabétique, quand faut-il utiliser des antibiotiques ?
A. Pour toute plaie du pied diabétique
B. Uniquement en présence de signes cliniques d'infection (rougeur > 0,5 cm, chaleur, pus, signes généraux)
C. En prophylaxie pour tous les ulcères
D. Uniquement si culture positive
> ✅ **B** — L'antibiothérapie ne doit être prescrite qu'en présence de signes CLINIQUES d'infection (rougeur > 0,5 cm, chaleur, tuméfaction, douleur, écoulement purulent, ou signes systémiques). La colonisation bactérienne d'une plaie chronique est normale et ne justifie pas d'antibiotiques.

**Q10 — 🥇 Or** : Quel est le retard diagnostique moyen du pied de Charcot aigu ?
A. 2 semaines
B. 29 semaines
C. 6 mois
D. 1 an
> ✅ **B** — Le retard diagnostique moyen du pied de Charcot est de 29 semaines, principalement car il est confondu avec une cellulite, une DVT, une crise de goutte ou une entorse. Ce retard permet la progression vers la fragmentation et la déformation irréversible.

**Q11 — 💎 Diamant** : M. D., 60 ans, DT2, consulte pour un ulcère de la face plantaire de M1 droit (3 × 2 cm), profondeur atteignant l'os (contact osseux +), rougeur périphérique 3 cm, écoulement purulent. IPS droit 0,65. TcPO2 25 mmHg. Classez selon UT et décrivez la prise en charge.
> ✅ Classification UT : Grade 3 (os exposé), Stade D (infection + ischémie) — le stade de plus mauvais pronostic. Prise en charge : (1) Antibiothérapie IV couvrant Gram+/−/anaérobies après prélèvement profond ; (2) IRM pied pour cartographier l'ostéite ; (3) Avis vasculaire urgent pour revascularisation (TcPO2 25 mmHg = ischémie critique) ; (4) Débridement chirurgical après revascularisation ; (5) Décharge stricte ; (6) Discussion multidisciplinaire amputation vs conservation.

**Q12 — 💎 Diamant** : Une patiente DT1 de 45 ans, neuropathie sévère, présente brutalement un pied droit chaud, rouge, gonflé, avec ΔT 4°C vs le gauche. Pas de plaie. Pas de fièvre. Radiographies normales. Quelle est votre conduite à tenir ?
A. Antibiotiques IV et hospitalisation pour cellulite
B. AINS et décharge avec suspicion de pied de Charcot aigu, IRM urgente
C. Surveillance simple et contrôle dans 1 mois
D. Artériographie pour suspicion d'AOMI
> ✅ **B** — La présentation est très évocatrice d'un pied de Charcot aigu (neuropathie sévère + pied chaud ΔT > 2°C + pas de plaie ni fièvre + radio normale au stade précoce). L'IRM montrera l'œdème médullaire. La prise en charge immédiate : DÉCHARGE STRICTE (iTCC ou orthèse pneumatique) pour prévenir la fragmentation osseuse. Les radiographies initiales sont souvent normales.

**Q13 — 💎 Diamant** : Construisez le parcours de soins complet d'un patient grade 3 IWGDF avec ulcère récidivant, en identifiant tous les professionnels impliqués et les étapes clés.
> ✅ Parcours grade 3 : (1) Médecin traitant : coordination, équilibre glycémique, facteurs de risque ; (2) Diabétologue : optimisation traitement, suivi complications ; (3) Centre du pied diabétique : évaluation vasculaire + neurologique + infectieuse intégrée ; (4) Podologue : soins mensuels (remboursés), gestion callosités, surveillance ; (5) Podo-orthésiste : chaussage thérapeutique sur mesure, semelles moulées ; (6) Chirurgien vasculaire : si ischémie (revascularisation) ; (7) Chirurgien orthopédiste : si ostéite (résection) ou déformation (correction) ; (8) Infectiologue : si ostéite (ATB prolongée) ; (9) Infirmier(e) : soins locaux (pansements, décharge) ; (10) ETP : programme dédié au pied diabétique. Fréquence : consultation multidisciplinaire tous les 1-3 mois.

### Cas clinique intégré — Module 20

> 📝 **Cas clinique : M. N., 72 ans, DT2 depuis 25 ans**
>
> M. N. est adressé par son médecin traitant pour un ulcère de la face plantaire du pied gauche, évoluant depuis 6 semaines, ne cicatrisant pas malgré des pansements quotidiens par l'IDE. DT2 sous insuline basale-bolus. HbA1c : 9,1 %. Créatinine : 165 µmol/L (DFG 35). Antécédent : amputation D5 droit il y a 3 ans.
>
> **Examen** : ulcère 2,5 × 2 cm en regard M3 gauche, bords kératosiques, fond fibrineux, contact osseux négatif. Rougeur périphérique < 0,5 cm. Pas de fièvre. Monofilament : 0/8 bilatéral. Pouls pédieux : palpables bilatéralement. IPS gauche : 1,45 (non compressible). Orteils en griffe bilatéraux.
>
> **Questions :**
> 1. Quel est le grade podologique IWGDF ? Justifiez.
> 2. Classez l'ulcère (UT). Est-il neuropathique, ischémique ou mixte ? Argumentez.
> 3. L'IPS est 1,45. Comment interprétez-vous ce résultat et quel examen complémentaire demandez-vous ?
> 4. Faut-il prescrire des antibiotiques ? Pourquoi ?
> 5. Quel traitement de décharge prescrivez-vous et quel résultat attendez-vous ?
> 6. Quelles mesures préventives mettez-vous en place pour le long terme ?

### Question de synthèse

> 🔄 **Synthèse** : Construisez un algorithme de prise en charge complète du pied diabétique, depuis le dépistage annuel (examen systématique + gradation) jusqu'au traitement d'un ulcère compliqué d'infection et d'ischémie, en intégrant les acteurs multidisciplinaires et les critères de décision à chaque étape.

---

# MODULE 21 : AUTRES COMPLICATIONS — AVC, STÉATOHÉPATITE, INFECTIONS, CANCERS, SANTÉ MENTALE

**Partie** : VI — Complications macrovasculaires et diverses
**Durée estimée** : 2h30
**Niveau** : Intermédiaire
**Prérequis** : Modules 5-6, 14, 19

## Accroche clinique

> 🏥 **Mise en situation** : Mme V., 55 ans, DT2 depuis 8 ans, IMC 36, HbA1c 7,6 %. Bilan hépatique : ASAT 52, ALAT 78, GGT 95. Échographie abdominale : stéatose diffuse. FibroScan® : élasticité 12,5 kPa. Elle est également suivie pour un épisode dépressif traité par escitalopram depuis 6 mois. *Au-delà des complications micro et macrovasculaires classiques, le diabète impacte de nombreux organes et la santé mentale — la stéatohépatite dysmétabolique (MASLD/MASH) et la dépression sont parmi les comorbidités les plus fréquentes et les plus sous-diagnostiquées.*

## Objectifs d'apprentissage

1. **Connaître** les spécificités de l'AVC chez le diabétique
2. **Diagnostiquer** et prendre en charge la MASLD/MASH (stéatohépatite métabolique)
3. **Reconnaître** les infections spécifiques ou plus fréquentes chez le diabétique
4. **Connaître** le lien diabète-cancer et ses implications pratiques
5. **Dépister** et prendre en charge la détresse psychologique et la dépression du diabétique

## Structure du contenu

### Section 1 — AVC et atteinte cérébrale

> Le module doit présenter les spécificités cérébrovasculaires du diabétique :

**Contenu obligatoire :**

- **AVC ischémique** : RR × 2-3 ; atteinte des petites artères cérébrales (lacunes) plus fréquente → troubles cognitifs vasculaires ; hyperglycémie à la phase aiguë = facteur de mauvais pronostic (augmente la taille de la pénombre ischémique) ; cible glycémique en phase aiguë : 1,40-1,80 g/L (éviter hypo et hyperglycémie)
- **Déclin cognitif et démence** : DT2 augmente le risque de démence vasculaire (RR × 2-3) et de maladie d'Alzheimer (RR × 1,5) ; mécanismes : microangiopathie cérébrale, insulinorésistance cérébrale (« diabète de type 3 »), inflammation, accumulation amyloïde ; les hypoglycémies sévères récurrentes accélèrent le déclin cognitif
- **Prévention** : contrôle strict des facteurs de risque CV (PA, lipides, glycémie), anticoagulation si FA, activité physique (neuroprotection)

### Section 2 — Stéatohépatite dysmétabolique (MASLD/MASH)

> Le module doit présenter cette comorbidité majeure du DT2 :

**Contenu obligatoire :**

- **Nomenclature** : MASLD (Metabolic dysfunction-Associated Steatotic Liver Disease, ex-NAFLD) et MASH (Metabolic dysfunction-Associated SteatoHepatitis, ex-NASH) — nouvelle nomenclature consensuelle 2023 (Rinella et al., Hepatology, 2023)
- **Épidémiologie** : prévalence MASLD chez DT2 : 55-70 % ; prévalence MASH : 20-30 % ; DT2 = principal facteur de risque de progression vers la fibrose avancée et la cirrhose
- **Physiopathologie** : insulinorésistance hépatique → lipogenèse de novo ↑ → stéatose → stress oxydatif, lipotoxicité → stéatohépatite (MASH) → fibrose → cirrhose → carcinome hépatocellulaire (CHC)
- **Dépistage** (recommandations EASL 2024) : chez tout DT2 → score non invasif de fibrose en 1ère intention : FIB-4 (âge, ASAT, ALAT, plaquettes) ; si FIB-4 > 1,30 → FibroScan® (élasticité hépatique) ou ELF test ; si élasticité > 8 kPa → adresser à l'hépatologue
- **Traitement** :
  - Perte de poids ≥ 7-10 % → résolution de la MASH ; ≥ 10 % → amélioration de la fibrose
  - Agonistes GLP-1 (sémaglutide) : essai STEP-NASH (réduction significative de la MASH, amélioration de la fibrose — phase 3)
  - Pioglitazone : améliore la MASH histologique chez les non-cirrhotiques (mais effets secondaires : prise de poids, rétention hydrique, risque fracturaire)
  - Resmétirom (Rezdiffra®) : agoniste THR-β, 1er traitement approuvé FDA (2024) pour la MASH avec fibrose significative (étude MAESTRO-NASH, Harrison et al., N Engl J Med, 2024) — non encore disponible en Europe
  - iSGLT2 : réduction de la stéatose hépatique (preuves émergentes)
  - Chirurgie bariatrique : si obésité sévère associée → amélioration spectaculaire de la MASLD/MASH

> [MEDIA: 📊 MDIAB21-S02-001 — ALGORITHME DÉPISTAGE MASLD/MASH CHEZ LE DT2 (FIB-4 → FibroScan → hépatologue, seuils décisionnels)]

> [MEDIA: 🔬 MDIAB21-S02-002 — SCHÉMA PROGRESSION MASLD (stéatose → MASH → fibrose → cirrhose → CHC, rôle de l'insulinorésistance)]

### Section 3 — Infections et diabète

> Le module doit présenter les infections spécifiques ou aggravées par le diabète :

**Contenu obligatoire :**

- **Risque infectieux accru** : dysfonction des neutrophiles (chimiotactisme ↓, phagocytose ↓, bactéricidie ↓), glycosurie favorisant les infections urinaires, microangiopathie → hypoxie tissulaire → cicatrisation altérée
- **Infections spécifiques/plus fréquentes** :
  - Infections urinaires (cystites récidivantes, pyélonéphrites, pyélonéphrite emphysémateuse — urgence chirurgicale)
  - Mycoses (candidose génitale — fréquente sous iSGLT2, dermatomycoses, onychomycoses)
  - Infections cutanées (érysipèle, furoncles, gangrène de Fournier — rare mais gravissime, associée aux iSGLT2 → avertissement FDA)
  - Infections ORL/pulmonaires (otite externe maligne à Pseudomonas — diabète âgé, pneumonies communautaires — surmortalité)
  - Mucormycose rhino-cérébrale (rhinocerebral zygomycosis) : infection fongique gravissime, favorisée par l'acidocétose → urgence vitale, traitement : amphotéricine B + chirurgie de débridement
  - Tuberculose : risque accru chez le diabétique (RR × 2-3) → dépistage dans les populations à risque
  - COVID-19 : diabète = facteur de risque de forme grave et de mortalité (Barron et al., Lancet Diabetes Endocrinol, 2020) ; gestion glycémique complexe (corticoïdes → hyperglycémie, risque ACD)
- **Vaccinations recommandées** : grippe (annuelle), pneumocoque (PCV20 ou PCV15 + PPSV23), COVID-19, hépatite B (si non immunisé), zona (Shingrix® après 50 ans)

### Section 4 — Diabète et cancer, santé mentale

> Le module doit présenter les associations diabète-cancer et les aspects psychologiques :

**Contenu obligatoire :**

- **Diabète et cancer** :
  - DT2 augmente le risque de certains cancers : hépatocarcinome (× 2,5), pancréas (× 1,8), endomètre (× 2,1), colorectal (× 1,3), vessie (× 1,2), sein post-ménopausique (× 1,2) — méta-analyse Tsilidis et al., BMJ, 2015
  - Mécanismes : hyperinsulinémie (insuline = facteur de croissance → IGF-1), inflammation chronique, obésité associée, hyperglycémie (effet Warburg)
  - Metformine : effet protecteur potentiel (méta-analyses observationnelles montrent −10-30 % de risque de cancer) ; études randomisées en cours
  - Attention au « diagnostic précoce du pancréas » : diabète de novo après 50 ans sans facteurs de risque = rechercher un cancer du pancréas (scanner/IRM pancréatique)
- **Santé mentale et détresse psychologique** :
  - **Dépression** : prévalence × 2 chez les diabétiques (20-30 %) ; bidirectionnelle (dépression ↑ risque de DT2 par cortisol, inflammation, comportements ; DT2 ↑ risque de dépression par charge de la maladie, complications, hyperglycémie) ; impact : mauvaise observance, ↑ HbA1c, ↑ complications, ↑ mortalité ; dépistage : PHQ-2/PHQ-9 annuel recommandé ; traitement : psychothérapie (TCC), ISRS (sertraline, escitalopram — profil métabolique favorable)
  - **Détresse liée au diabète (« diabetes distress »)** : différente de la dépression clinique ; prévalence 20-40 % ; sentiments d'échec, frustration, épuisement face à la gestion quotidienne ; échelle PAID (Problem Areas In Diabetes) ou DDS (Diabetes Distress Scale) ; prise en charge : éducation thérapeutique adaptée, soutien motivationnel, allègement du schéma thérapeutique si possible
  - **Troubles du comportement alimentaire** : diabulimie (DT1 — restriction volontaire d'insuline pour perdre du poids → ACD récidivantes, HbA1c très élevée, complications précoces) ; binge eating disorder chez le DT2 obèse
  - **Burn-out du diabète** : épuisement psychologique face à la gestion chronique → désengagement → dégradation de l'équilibre → culpabilité → cercle vicieux

> [MEDIA: 📊 MDIAB21-S04-001 — GRAPHIQUE RISQUE RELATIF DE CANCER CHEZ LE DT2 (par localisation — méta-analyses)]

> [MEDIA: 📋 MDIAB21-S04-002 — ALGORITHME DÉPISTAGE DÉPRESSION ET DÉTRESSE (PHQ-2 → PHQ-9 → prise en charge graduée)]

## Points clés — Module 21

> 🎯 **Essentiel à retenir**
> 1. AVC ischémique × 2-3 chez le diabétique ; hyperglycémie en phase aiguë = facteur de mauvais pronostic
> 2. MASLD/MASH : prévalence 55-70 % chez le DT2 ; dépistage par FIB-4 → FibroScan si > 1,30
> 3. Resmétirom : 1er traitement approuvé de la MASH avec fibrose (MAESTRO-NASH, 2024)
> 4. Agonistes GLP-1 (sémaglutide) : bénéfice hépatique prometteur (STEP-NASH)
> 5. Infections spécifiques : mucormycose (acidocétose), otite externe maligne, pyélonéphrite emphysémateuse
> 6. Vaccinations : grippe, pneumocoque, COVID-19, hépatite B, zona ≥ 50 ans
> 7. Diabète de novo > 50 ans sans facteurs de risque = rechercher cancer du pancréas
> 8. Dépression × 2 chez le DT2 → dépistage annuel PHQ-2/PHQ-9
> 9. Diabetes distress ≠ dépression clinique → éducation thérapeutique et soutien motivationnel
> 10. Diabulimie (DT1) : restriction insuline pour perdre du poids → ACD récidivantes → urgence

## Auto-évaluation — Module 21

### QCM progressifs (10 questions)

**Q1 — 🥉 Bronze** : Quel est le principal facteur de risque de progression de la MASLD vers la fibrose ?
A. Consommation d'alcool
B. Diabète de type 2
C. Hépatite virale B
D. Médicaments hépatotoxiques
> ✅ **B** — Le DT2 est le principal facteur de risque de progression de la stéatose hépatique vers la MASH et la fibrose avancée. L'insulinorésistance hépatique est le moteur physiopathologique central.

**Q2 — 🥉 Bronze** : Quel score non invasif est recommandé en 1ère intention pour dépister la fibrose hépatique chez le DT2 ?
A. Child-Pugh
B. MELD
C. FIB-4
D. APRI
> ✅ **C** — Le FIB-4 (âge, ASAT, ALAT, plaquettes) est le score de 1ère intention recommandé (EASL 2024). Si > 1,30, un FibroScan® ou ELF test est indiqué en 2e intention.

**Q3 — 🥈 Argent** : Quelle infection fongique gravissime est spécifiquement associée à l'acidocétose diabétique ?
A. Aspergillose invasive
B. Mucormycose rhino-cérébrale
C. Candidose systémique
D. Cryptococcose
> ✅ **B** — La mucormycose rhino-cérébrale est une infection fongique gravissime à tropisme vasculaire, favorisée par l'acidocétose (acidose + hyperglycémie + fer libre ↑). C'est une urgence vitale nécessitant amphotéricine B + chirurgie de débridement.

**Q4 — 🥈 Argent** : Un diabète de novo après 50 ans sans facteurs de risque évidents doit faire évoquer quel diagnostic ?
A. Diabète de type 1 tardif (LADA)
B. Cancer du pancréas
C. MODY
D. Diabète secondaire aux corticoïdes
> ✅ **B** — Un diabète d'apparition récente après 50 ans, sans obésité ni facteurs de risque classiques de DT2, doit faire rechercher un cancer du pancréas (scanner ou IRM pancréatique). Le diabète peut précéder de 6-36 mois le diagnostic de cancer du pancréas.

**Q5 — 🥈 Argent** : Quelle est la prévalence de la dépression chez les patients diabétiques ?
A. 5-10 %
B. 20-30 %
C. 50-60 %
D. < 5 %
> ✅ **B** — La dépression touche 20-30 % des patients diabétiques (prévalence × 2 vs population générale). Elle est associée à une mauvaise observance, une HbA1c plus élevée, et une surmortalité. Le dépistage annuel par PHQ-2/PHQ-9 est recommandé.

**Q6 — 🥇 Or** : Quel est le 1er traitement approuvé (FDA 2024) pour la MASH avec fibrose significative ?
A. Pioglitazone
B. Resmétirom (agoniste THR-β)
C. Obétichol acid
D. Vitamine E
> ✅ **B** — Le resmétirom (Rezdiffra®), agoniste sélectif du récepteur thyroïdien β, est le 1er traitement approuvé par la FDA (mars 2024) pour la MASH avec fibrose significative (F2-F3), sur la base de l'étude MAESTRO-NASH.

**Q7 — 🥇 Or** : Qu'est-ce que la diabulimie et quel est son danger ?
A. Boulimie associée au diabète gestationnel
B. Restriction volontaire d'insuline chez le DT1 pour perdre du poids → ACD récidivantes, HbA1c très élevée, complications précoces
C. Anorexie mentale chez le DT2
D. Hyperphagie liée aux hypoglycémies
> ✅ **B** — La diabulimie est un TCA spécifique du DT1 : le patient omet ou réduit volontairement l'insuline pour induire une glycosurie massive et perdre du poids. Conséquences : ACD récidivantes, HbA1c > 10-12 %, complications microvasculaires précoces et sévères, surmortalité × 3.

**Q8 — 🥇 Or** : Quelle différence entre la dépression clinique et la « diabetes distress » ?
A. Aucune différence
B. La diabetes distress est un trouble psychiatrique plus sévère
C. La diabetes distress est une détresse spécifique liée à la gestion du diabète (frustration, épuisement), sans nécessairement les critères de dépression majeure
D. La diabetes distress ne nécessite jamais de prise en charge
> ✅ **C** — La diabetes distress est distincte de la dépression clinique : c'est une réponse émotionnelle spécifique à la charge du diabète (frustration, sentiment d'échec, épuisement). Elle ne remplit pas nécessairement les critères DSM-5 de dépression majeure. Prise en charge : ETP adaptée, soutien motivationnel, simplification du schéma.

**Q9 — 💎 Diamant** : Mme V. (de l'accroche clinique) avec FibroScan à 12,5 kPa, DT2, IMC 36 : quelle prise en charge hépatique proposez-vous ?
A. Surveillance simple car la stéatose est bénigne
B. Adresser à l'hépatologue, viser perte de poids ≥ 10 %, envisager agoniste GLP-1 (sémaglutide) pour le double bénéfice métabolique et hépatique
C. Biopsie hépatique systématique
D. Transplantation hépatique
> ✅ **B** — Avec une élasticité à 12,5 kPa (suggestif de fibrose significative F3), il faut adresser à l'hépatologue pour évaluation complète. La cible est une perte de poids ≥ 10 % (amélioration fibrose). Le sémaglutide offre un triple bénéfice : glycémique + pondéral + hépatique. La chirurgie bariatrique est à discuter (IMC 36 + DT2 + MASH).

**Q10 — 💎 Diamant** : Un patient DT1 de 22 ans présente des ACD à répétition (3 en 6 mois), HbA1c 13 %, a perdu 8 kg en 3 mois et reconnaît « parfois oublier l'insuline ». Quelle hypothèse et quelle prise en charge ?
A. Mauvaise technique d'injection → éducation technique
B. Suspicion de diabulimie → évaluation psychiatrique/TCA, prise en charge multidisciplinaire (diabétologue + psychiatre + diététicien), pas de jugement, empathie
C. Insulinorésistance → augmenter les doses
D. Erreur de dosage → vérifier le carnet
> ✅ **B** — ACD récidivantes + HbA1c très élevée + perte de poids chez un DT1 jeune qui « oublie » l'insuline = forte suspicion de diabulimie. L'approche doit être empathique, non jugeante, avec évaluation psychiatrique spécialisée (TCA), et prise en charge multidisciplinaire intégrée (diabétologue + psychiatre/psychologue + diététicien spécialisé TCA).

### Cas clinique intégré — Module 21

> 📝 **Cas clinique : M. T., 58 ans, DT2 depuis 12 ans**
>
> M. T., DT2 sous metformine + empagliflozine + sémaglutide 1 mg/sem. HbA1c : 6,9 %. IMC : 32. PA : 130/78. LDL-c : 0,62 g/L sous atorvastatine 40 mg. Consulte pour fatigue persistante, perte de motivation, troubles du sommeil depuis 4 mois. « Je n'en peux plus de ce diabète, je ne vois pas l'intérêt de tous ces traitements. » PHQ-2 : 4/6. ALAT : 65 UI/L (N < 35).
>
> **Questions :**
> 1. Quelle est votre hypothèse principale devant ce tableau psychologique ? Quel score utilisez-vous pour confirmer ?
> 2. S'agit-il plutôt d'une dépression clinique ou d'une diabetes distress ? Comment les distinguer ?
> 3. L'ALAT élevée : quel bilan hépatique demandez-vous chez ce DT2 ?
> 4. Quelles adaptations thérapeutiques envisagez-vous (médicamenteuses et non médicamenteuses) ?
> 5. Son traitement actuel est-il favorable sur le plan hépatique ? Argumentez.

### Question de synthèse

> 🔄 **Synthèse** : Pour un patient DT2 vu en consultation annuelle de suivi, construisez un « check-list des complications non classiques » intégrant : dépistage MASLD (score, seuils), évaluation psychologique (outils, seuils), recherche d'infections spécifiques, et surveillance oncologique adaptée.

---

## Références bibliographiques — Partie 6

1. Sarwar N, Gao P, Seshasai SR et al. (Emerging Risk Factors Collaboration). « Diabetes mellitus, fasting blood glucose concentration, and risk of vascular disease. » *Lancet*, 2010; 375(9733): 2215-2222.
2. Gæde P, Lund-Andersen H, Parving HH, Pedersen O. « Effect of a multifactorial intervention on mortality in type 2 diabetes (STENO-2). » *N Engl J Med*, 2008; 358(6): 580-591.
3. Zinman B, Wanner C, Lachin JM et al. (EMPA-REG OUTCOME). « Empagliflozin, cardiovascular outcomes, and mortality in type 2 diabetes. » *N Engl J Med*, 2015; 373(22): 2117-2128.
4. Marso SP, Daniels GH, Tanaka-Poole K et al. (LEADER). « Liraglutide and cardiovascular outcomes in type 2 diabetes. » *N Engl J Med*, 2016; 375(4): 311-322.
5. McMurray JJV, Solomon SD, Inzucchi SE et al. (DAPA-HF). « Dapagliflozin in patients with heart failure and reduced ejection fraction. » *N Engl J Med*, 2019; 381(21): 1995-2008.
6. Packer M, Anker SD, Butler J et al. (EMPEROR-Reduced). « Cardiovascular and renal outcomes with empagliflozin in heart failure. » *N Engl J Med*, 2020; 383(15): 1413-1424.
7. Anker SD, Butler J, Filippatos G et al. (EMPEROR-Preserved). « Empagliflozin in heart failure with a preserved ejection fraction. » *N Engl J Med*, 2021; 385(16): 1451-1461.
8. Solomon SD, McMurray JJV, Claggett B et al. (DELIVER). « Dapagliflozin in heart failure with mildly reduced or preserved ejection fraction. » *N Engl J Med*, 2022; 387(12): 1089-1098.
9. Farkouh ME, Domanski M, Sleeper LA et al. (FREEDOM). « Strategies for multivessel revascularization in patients with diabetes. » *N Engl J Med*, 2012; 367(25): 2375-2384.
10. Bowman L, Mafham M, Wallendszus K et al. (ASCEND). « Effects of aspirin for primary prevention in persons with diabetes mellitus. » *N Engl J Med*, 2018; 379(16): 1529-1539.
11. Armstrong DG, Boulton AJM, Bus SA. « Diabetic foot ulcers and their recurrence. » *N Engl J Med*, 2017; 376(24): 2367-2375.
12. Bus SA, Sacco ICN, Monteiro-Soares M et al. « Guidelines on the prevention of foot ulcers in persons with diabetes (IWGDF 2023). » *Diabetes Metab Res Rev*, 2024; 40(3): e3651.
13. Grayson ML, Gibbons GW, Balogh K et al. « Probing to bone in infected pedal ulcers: a clinical sign of underlying osteomyelitis in diabetic patients. » *JAMA*, 1995; 273(9): 721-723.
14. Rinella ME, Lazarus JV, Ratziu V et al. « A multisociety Delphi consensus statement on new fatty liver disease nomenclature. » *Hepatology*, 2023; 78(6): 1966-1986.
15. Harrison SA, Bedossa P, Guy CD et al. (MAESTRO-NASH). « A phase 3, randomized, controlled trial of resmetirom in NASH with liver fibrosis. » *N Engl J Med*, 2024; 390(6): 497-509.
16. Barron E, Bakhai C, Kar P et al. « Associations of type 1 and type 2 diabetes with COVID-19-related mortality in England. » *Lancet Diabetes Endocrinol*, 2020; 8(10): 813-822.
17. Tsilidis KK, Kasimis JC, Lopez DS et al. « Type 2 diabetes and cancer: umbrella review of meta-analyses. » *BMJ*, 2015; 350: g7607.

---

> 🔶 **DIABÉTOLOGIE** | Partie 6/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 7 — Traitement du Diabète de Type 1 (Modules 22-24)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 22 : INSULINOTHÉRAPIE DU DT1 — SCHÉMAS, PHARMACOLOGIE, ADAPTATION

**Partie** : VII — Traitement du DT1
**Durée estimée** : 4h00
**Niveau** : Fondamental → Avancé
**Prérequis** : Modules 3, 5, 12, 14

## Accroche clinique

> 🏥 **Mise en situation** : Lucas, 18 ans, DT1 diagnostiqué à 10 ans, sous schéma basal-bolus (glargine U100 20 UI au coucher + aspart 6-8-7 UI aux repas). HbA1c : 8,4 %. Il décrit des hypoglycémies nocturnes fréquentes (2-3/semaine) avec des glycémies au réveil élevées (2,20-2,60 g/L). Sa glycémie pré-prandiale du déjeuner est souvent basse (0,55-0,65 g/L) et il compense par un resucrage qui provoque une hyperglycémie post-prandiale. *L'optimisation de l'insulinothérapie est un art autant qu'une science — comprendre la pharmacocinétique de chaque insuline et savoir adapter les doses est la compétence fondamentale du diabétologue.*

## Objectifs d'apprentissage

1. **Connaître** la pharmacocinétique et pharmacodynamie de toutes les insulines disponibles (rapides, ultra-rapides, intermédiaires, lentes, ultra-lentes)
2. **Prescrire** un schéma basal-bolus optimisé : choix de l'insuline basale et prandiale, horaires, doses initiales
3. **Maîtriser** les techniques d'adaptation des doses : prospective (ratio glucidique, facteur de sensibilité) et rétrospective (analyse des tendances)
4. **Gérer** les situations courantes : hypoglycémie, journée de maladie, activité physique, alcool, jeûne religieux
5. **Connaître** les dispositifs d'injection : stylos, aiguilles, technique, lipodystrophies

## Structure du contenu

### Section 1 — Pharmacologie des insulines

> Le module doit présenter la pharmacologie détaillée de chaque type d'insuline :

**Contenu obligatoire :**

- **Insulines humaines** (quasi abandonnées dans le DT1) :
  - Insuline rapide (Actrapid®, Umuline Rapide®) : délai 30 min, pic 2-4h, durée 6-8h
  - Insuline NPH (Insulatard®, Umuline NPH®) : délai 1-2h, pic 4-8h, durée 12-18h → variabilité importante
- **Analogues rapides** :
  - Lispro (Humalog®) : inversion Pro-Lys B28-B29 → dissociation hexamère rapide ; délai 15 min, pic 1-2h, durée 3-5h
  - Aspart (NovoRapid®) : substitution Asp B28 → même cinétique que lispro
  - Glulisine (Apidra®) : substitutions Asn B3 + Lys B29 → cinétique similaire
- **Analogues ultra-rapides** (faster-acting) :
  - Faster aspart (Fiasp®) : aspart + niacinamide (accélère absorption) + L-arginine → délai 4-5 min, pic 0,5-1,5h → meilleur contrôle post-prandial, injection au début du repas voire juste après
  - Lispro ultra-rapide (Lyumjev®) : lispro + citrate + tréhalose → cinétique accélérée similaire
- **Analogues lents** :
  - Glargine U100 (Lantus®, biosimilaires Abasaglar®, Semglee®) : précipitation sous-cutanée à pH neutre → libération lente ; délai 2-4h, pas de pic franc, durée ~24h (mais parfois < 24h → hyperglycémie de fin de dose)
  - Glargine U300 (Toujeo®) : concentration × 3 → dépôt plus compact → absorption plus lente et plus régulière → durée ≥ 30h, profil plus plat, moins d'hypoglycémies nocturnes (étude EDITION — Riddle et al., Diabetes Care, 2014)
  - Détémir (Levemir®) : liaison à l'albumine → durée 12-18h → souvent 2 injections/jour
  - Dégludec (Tresiba®) : multihexamères sous-cutanés → demi-vie 25h, durée d'action > 42h → profil ultra-plat, flexibilité horaire, moins d'hypoglycémies sévères vs glargine U100 (étude SWITCH 1/2 — Lane et al., Lancet, 2017)
- **Insulines « weekly » (à venir)** : icodec (Awiqli®) : analogue hebdomadaire, demi-vie ~7 jours (études ONWARDS 1-6 — Rosenstock et al., N Engl J Med, 2023) — approuvé dans certains pays pour le DT2, études en cours dans le DT1
- **Insulines concentrées** : lispro U200, glargine U300, dégludec U200 → volumes d'injection réduits chez les patients nécessitant de fortes doses

> [MEDIA: 💉 MDIAB22-S01-001 — TABLEAU COMPARATIF PHARMACOCINÉTIQUE TOUTES INSULINES (nom, type, délai, pic, durée, concentration, particularités)]

> [MEDIA: 📊 MDIAB22-S01-002 — COURBES PHARMACODYNAMIQUES SUPERPOSÉES (rapides vs ultra-rapides vs basales — profil d'action sur 24h)]

> [MEDIA: 🔬 MDIAB22-S01-003 — SCHÉMA MÉCANISME D'ACTION PROLONGÉE (glargine : précipitation pH vs détémir : liaison albumine vs dégludec : multihexamères)]

### Section 2 — Schéma basal-bolus : prescription et adaptation

> Le module doit présenter la prescription et l'optimisation du schéma basal-bolus :

**Contenu obligatoire :**

- **Principe du basal-bolus** : mimer la sécrétion physiologique d'insuline → basale (besoins de base inter-prandiaux et nocturnes, ~40-50 % de la dose totale) + bolus (couverture des repas, ~50-60 %)
- **Dose totale initiale** : 0,5-0,7 UI/kg/j (adulte) ; période de lune de miel : 0,2-0,3 UI/kg/j ; adolescence/puberté : 1,0-1,5 UI/kg/j ; répartition : 40-50 % basale, 50-60 % bolus
- **Choix de la basale** :
  - Dégludec (Tresiba®) : 1ère intention (profil le plus plat, moins d'hypoglycémies, flexibilité horaire)
  - Glargine U300 (Toujeo®) : alternative (profil plat, moins d'hypos nocturnes)
  - Glargine U100 (Lantus®/biosimilaires) : option classique
  - Détémir : si besoin de 2 injections (contrôle insuffisant avec 1 injection)
- **Choix du bolus** :
  - Ultra-rapides (Fiasp®, Lyumjev®) : 1ère intention si disponibles (meilleur contrôle post-prandial, flexibilité péri-prandiale)
  - Analogues rapides (lispro, aspart, glulisine) : alternative
  - Timing : 15 min avant le repas (analogues rapides), au début du repas (ultra-rapides), juste après si contenu glucidique incertain
- **Adaptation prospective (insulinothérapie fonctionnelle)** :
  - **Ratio insuline/glucides (I/C)** : nombre de grammes de glucides couverts par 1 UI d'insuline rapide ; règle initiale : 500/dose totale journalière d'insuline = I/C ; exemple : DTJ 50 UI → I/C = 500/50 = 10 g/UI → 1 UI pour 10 g de glucides
  - **Facteur de sensibilité à l'insuline (FSI)** : baisse de glycémie (mg/dL) pour 1 UI de correction ; règle : 1800/DTJ (avec ultra-rapide) ou 1500/DTJ (avec rapide) ; exemple : DTJ 50 UI → FSI = 1800/50 = 36 mg/dL par UI → 1 UI fait baisser la glycémie de 0,36 g/L
  - **Dose de bolus** = glucides du repas / ratio I/C + correction = (glycémie actuelle − glycémie cible) / FSI
  - **Cible glycémique pré-prandiale** : 0,70-1,30 g/L (personnalisable)
- **Adaptation rétrospective** : analyse des tendances sur 3-7 jours → ajustement de la dose basale (glycémies nocturnes et inter-prandiales) et des ratios (glycémies post-prandiales à 2h)
- **Règles pratiques** :
  - Ajuster de 10-20 % maximum par modification
  - Ne changer qu'un paramètre à la fois
  - Attendre 3 jours avant de modifier la basale (sauf si dégludec → 5-7 jours pour état d'équilibre)

> [MEDIA: 📋 MDIAB22-S02-001 — SCHÉMA BASAL-BOLUS ILLUSTRÉ (profil glycémique 24h avec insuline basale + bolus aux 3 repas — zones cibles)]

> [MEDIA: 🧮 MDIAB22-S02-002 — CALCULATEUR RATIO I/C ET FSI (exemples pratiques avec repas types et corrections)]

> [MEDIA: 📋 MDIAB22-S02-003 — ALGORITHME ADAPTATION RÉTROSPECTIVE (analyse par période : nuit → matin → midi → soir → quelle dose ajuster)]

### Section 3 — Technique d'injection et lipodystrophies

> Le module doit présenter les aspects pratiques de l'injection :

**Contenu obligatoire :**

- **Dispositifs d'injection** : stylos réutilisables et préremplis (avantages : précision, facilité, discrétion) ; seringues (en voie de disparition dans le DT1) ; stylos connectés (NovoPen 6/Echo Plus, InPen) → enregistrement doses et horaires → données vers application smartphone
- **Technique d'injection** (recommandations FITTER — Forum for Injection Technique and Therapy Expert Recommendations, Frid et al., Mayo Clin Proc, 2016) :
  - Zones : abdomen (absorption la plus rapide et régulière pour les rapides), cuisse (absorption plus lente pour la basale), fesse (alternative pour la basale), bras (variable, éviter chez les enfants maigres)
  - Aiguilles : 4 mm pour tous les adultes (pas de pli cutané nécessaire, injection à 90°) ; 4 mm pour les enfants ; aiguilles > 6 mm → risque d'injection intramusculaire → absorption erratique
  - Rotation des sites : grille systématique au sein de chaque zone (espacer d'au moins 1 cm entre chaque injection, ne pas réutiliser un site avant 2-4 semaines)
  - Usage unique des aiguilles (réutilisation → lipodystrophies, douleur, imprécision de dose)
- **Lipodystrophies** :
  - **Lipohypertrophies** (les plus fréquentes, 30-50 % des patients) : nodules sous-cutanés fermes aux sites d'injection répétée → absorption erratique → variabilité glycémique inexpliquée ; palpation systématique à chaque consultation ; CAT : rotation stricte, éviction du site pendant 6-12 mois
  - **Lipoatrophies** (rares avec les analogues actuels) : dépressions cutanées, mécanisme immuno-médié
  - Impact clinique : injection dans une lipohypertrophie → ↓ absorption de 25-40 % → hyperglycémie → patient augmente les doses → injection en zone saine → hypoglycémie → cercle vicieux

> [MEDIA: 🩺 MDIAB22-S03-001 — TECHNIQUE D'INJECTION ILLUSTRÉE (zones, angle, profondeur, rotation — photos pas-à-pas)]

> [MEDIA: 🩺 MDIAB22-S03-002 — PHOTOS LIPOHYPERTROPHIES (inspection + palpation + échographie sous-cutanée montrant le dépôt fibreux)]

> [MEDIA: 📋 MDIAB22-S03-003 — GRILLE DE ROTATION DES SITES (abdomen divisé en 4 quadrants, rotation systématique)]

### Section 4 — Gestion des situations particulières

> Le module doit présenter l'adaptation de l'insulinothérapie dans les situations courantes :

**Contenu obligatoire :**

- **Activité physique** :
  - Endurance (course, vélo, natation) : risque hypoglycémie pendant et jusqu'à 24-48h après ; CAT : ↓ bolus du repas précédent de 25-75 %, ↓ basale de 20-50 %, collation 15-30 g glucides pré-effort si glycémie < 1,50 g/L, surveiller glycémie post-effort → collation si < 1,20 g/L au coucher
  - Résistance (musculation) et haute intensité intermittente (HIIT) : risque hyperglycémie initiale (catécholamines → néoglucogenèse) puis hypoglycémie tardive ; pas de réduction systématique du bolus
  - Compétition et stress → hyperglycémie possible → correction prudente
- **Journée de maladie (sick day rules)** :
  - JAMAIS arrêter l'insuline basale (même si ne mange pas → besoins basaux persistent + hormones de stress → risque ACD)
  - Surveillance glycémique toutes les 2-4h + cétonémie capillaire si glycémie > 2,50 g/L
  - Si cétonémie > 0,6 mmol/L : correction supplémentaire 10-20 % DTJ en insuline rapide, hydratation abondante
  - Si cétonémie > 1,5 mmol/L : dose de correction renforcée, si > 3,0 mmol/L → urgences (risque ACD)
  - Adapter les bolus au apports (même si réduits : bouillons, compotes, jus)
- **Alcool** : risque d'hypoglycémie retardée (inhibition néoglucogenèse hépatique) jusqu'à 12-24h après → ne jamais boire à jeun, collation avant le coucher, réduire la basale de 20-30 %, surveillance glycémique ++ ; masquage des symptômes d'hypoglycémie
- **Jeûne religieux (Ramadan)** : évaluation pré-Ramadan (risque selon IDF/DAR guidelines — Hassanein et al., Diabetes Res Clin Pract, 2017) ; adaptation : basale maintenue (↓ 15-30 %), bolus uniquement aux 2 repas (iftar et suhur), surveillance glycémique renforcée, critères de rupture du jeûne (glycémie < 0,70 g/L ou > 3,00 g/L)
- **Voyages et décalage horaire** : adaptation de la basale (si décalage > 3h → ajustement progressif), conservation de l'insuline (pas au réfrigérateur en vol → bagage cabine, stylos en cours d'utilisation à T° ambiante < 30°C pendant 4-8 semaines selon la molécule), lettre du diabétologue pour le matériel en cabine

> [MEDIA: 🏃 MDIAB22-S04-001 — ALGORITHME ADAPTATION INSULINE ET ACTIVITÉ PHYSIQUE (endurance vs résistance vs HIIT — réduction bolus, collation, surveillance)]

> [MEDIA: 🤒 MDIAB22-S04-002 — PROTOCOLE SICK DAY RULES (arbre décisionnel selon glycémie et cétonémie — actions à chaque seuil)]

> [MEDIA: 📋 MDIAB22-S04-003 — FICHE PATIENT RAMADAN ET DT1 (adaptation basale, bolus, surveillance, critères de rupture)]

## Points clés — Module 22

> 🎯 **Essentiel à retenir**
> 1. Schéma basal-bolus : basale 40-50 % (dégludec ou glargine U300) + bolus 50-60 % (ultra-rapide)
> 2. Dégludec : demi-vie 25h, durée > 42h, profil le plus plat, moins d'hypoglycémies sévères (SWITCH)
> 3. Ultra-rapides (Fiasp®, Lyumjev®) : injection au début du repas, meilleur contrôle post-prandial
> 4. Insulinothérapie fonctionnelle : ratio I/C (500/DTJ), FSI (1800/DTJ), dose = glucides/ratio + correction
> 5. Lipohypertrophies : 30-50 % des patients → variabilité glycémique → rotation systématique obligatoire
> 6. Aiguilles 4 mm pour tous les adultes (recommandations FITTER)
> 7. Activité physique endurance : ↓ bolus 25-75 %, ↓ basale 20-50 %, collation pré-effort
> 8. Sick day rules : JAMAIS arrêter la basale, cétonémie si glycémie > 2,50 g/L
> 9. Alcool : hypoglycémie retardée → ne jamais boire à jeun, ↓ basale, collation au coucher
> 10. Icodec (Awiqli®) : insuline hebdomadaire, bientôt disponible

## Auto-évaluation — Module 22

### QCM progressifs (13 questions)

**Q1 — 🥉 Bronze** : Quel est le principe du schéma basal-bolus ?
A. Une seule injection d'insuline lente par jour
B. Insuline basale (besoins de base) + bolus (couverture des repas) mimant la sécrétion physiologique
C. Insuline rapide seule 3 fois par jour
D. Prémix matin et soir
> ✅ **B** — Le basal-bolus mime la sécrétion physiologique : l'insuline basale couvre les besoins inter-prandiaux et nocturnes (40-50 % DTJ), les bolus couvrent les repas (50-60 % DTJ).

**Q2 — 🥉 Bronze** : Quel est le délai d'action d'un analogue rapide (lispro, aspart) ?
A. Immédiat
B. 15 minutes
C. 45 minutes
D. 2 heures
> ✅ **B** — Les analogues rapides (lispro, aspart, glulisine) ont un délai de 15 minutes, un pic à 1-2h et une durée de 3-5h. Ils doivent être injectés 15 min avant le repas idéalement.

**Q3 — 🥈 Argent** : Pourquoi le dégludec (Tresiba®) a-t-il un profil d'action plus plat que la glargine U100 ?
A. Concentration plus élevée
B. Formation de multihexamères sous-cutanés → libération ultra-lente et très régulière (demi-vie 25h)
C. Liaison à l'albumine
D. Précipitation sous-cutanée
> ✅ **B** — Le dégludec forme des multihexamères sous-cutanés à l'injection, créant un réservoir qui se dissocie très lentement et régulièrement (demi-vie 25h, durée > 42h). Ce mécanisme unique explique le profil ultra-plat et la flexibilité horaire.

**Q4 — 🥈 Argent** : Comment calcule-t-on le ratio insuline/glucides (I/C) initial ?
A. Poids / 10
B. 500 / dose totale journalière d'insuline
C. HbA1c × 10
D. Glycémie à jeun / 2
> ✅ **B** — La règle du 500 : I/C = 500 / DTJ. Exemple : DTJ = 50 UI → I/C = 10 g/UI = 1 UI couvre 10 g de glucides. Ce ratio est ensuite personnalisé par l'observation de la glycémie post-prandiale.

**Q5 — 🥈 Argent** : Quelle est la conséquence principale de l'injection dans une lipohypertrophie ?
A. Douleur accrue
B. Absorption erratique → variabilité glycémique (hyperglycémie puis hypoglycémie si changement de site)
C. Infection locale
D. Allergie à l'insuline
> ✅ **B** — L'injection dans une lipohypertrophie diminue l'absorption de 25-40 %, provoquant une hyperglycémie. Le patient augmente les doses pour compenser. S'il injecte ensuite en zone saine, la dose majorée provoque une hypoglycémie.

**Q6 — 🥈 Argent** : Quelle longueur d'aiguille est recommandée pour tous les adultes selon FITTER ?
A. 4 mm
B. 6 mm
C. 8 mm
D. 12 mm
> ✅ **A** — Les recommandations FITTER (2016) préconisent des aiguilles de 4 mm pour tous les adultes (indépendamment de l'IMC), à 90° sans pli cutané. Les aiguilles > 6 mm augmentent le risque d'injection intramusculaire.

**Q7 — 🥇 Or** : Un patient DT1 (DTJ 60 UI) veut manger un repas contenant 75 g de glucides. Sa glycémie pré-prandiale est à 2,00 g/L (cible 1,20 g/L). Calculez la dose de bolus.
A. 7,5 UI
B. 9 UI
C. 11,7 UI
D. 15 UI
> ✅ **C** — Ratio I/C = 500/60 ≈ 8,3 g/UI. Dose prandiale = 75/8,3 = 9 UI. FSI = 1800/60 = 30 mg/dL/UI. Correction = (200-120)/30 = 2,7 UI. Total = 9 + 2,7 ≈ 11,7 UI → arrondir à 12 UI.

**Q8 — 🥇 Or** : Un patient DT1 a une gastro-entérite avec vomissements. Il ne mange pas. Que faire avec l'insuline basale ?
A. Arrêter toute insuline jusqu'à reprise alimentaire
B. Maintenir la basale, surveiller glycémie/cétonémie toutes les 2-4h, adapter les bolus aux apports
C. Doubler la basale
D. Remplacer par de l'insuline rapide seule
> ✅ **B** — JAMAIS arrêter la basale (les besoins basaux persistent et les hormones de stress augmentent la glycémie → risque d'ACD). Maintenir la basale, surveiller glycémie + cétonémie toutes les 2-4h, adapter les bolus aux apports même faibles (bouillons, compotes).

**Q9 — 🥇 Or** : Quel est le risque spécifique de la consommation d'alcool chez le DT1 ?
A. Hyperglycémie prolongée
B. Hypoglycémie retardée (jusqu'à 12-24h) par inhibition de la néoglucogenèse hépatique
C. Acidocétose alcoolique
D. Résistance à l'insuline accrue
> ✅ **B** — L'alcool inhibe la néoglucogenèse hépatique, provoquant une hypoglycémie retardée pouvant survenir jusqu'à 12-24h après la consommation, souvent pendant le sommeil. Les symptômes d'hypoglycémie peuvent être masqués par l'intoxication.

**Q10 — 🥇 Or** : Quelle est la particularité de l'insuline icodec (Awiqli®) ?
A. Insuline ultra-rapide pour les repas
B. Insuline basale hebdomadaire (1 injection/semaine) avec demi-vie ~7 jours
C. Insuline inhalée
D. Insuline orale
> ✅ **B** — L'icodec est un analogue de l'insuline à durée d'action ultra-longue permettant 1 injection par semaine (demi-vie ~7 jours). Les études ONWARDS ont montré une efficacité et une sécurité comparables aux insulines basales quotidiennes.

**Q11 — 💎 Diamant** : Lucas (accroche clinique) : hypoglycémies nocturnes + glycémies élevées au réveil. Analysez le problème et proposez des solutions.
> ✅ Le profil de Lucas évoque un « effet Somogyi » possible (hypoglycémie nocturne → rebond hyperglycémique par contre-régulation) ou un simple surdosage de basale nocturne avec hyperglycémie du réveil par phénomène de l'aube (non corrigé car la basale est épuisée en fin de nuit). Solutions : (1) Changer glargine U100 pour dégludec ou glargine U300 (profil plus plat, moins d'hypos nocturnes) ; (2) Si maintien glargine : ↓ dose de 2-3 UI et déplacer l'injection au matin ; (3) Monitoring glycémique continu (CGM) pour visualiser le profil nocturne ; (4) Idéalement : pompe à insuline avec débit basal programmable.

**Q12 — 💎 Diamant** : Un patient DT1 musulman souhaite observer le Ramadan. DTJ 48 UI (basale 20 UI dégludec + bolus ~28 UI). HbA1c 7,2 %. Pas de complications sévères. Quelle adaptation proposez-vous ?
> ✅ Évaluation pré-Ramadan : risque modéré (DT1 bien équilibré, pas de complications sévères). Adaptation : (1) Basale : maintenir dégludec, ↓ à 17 UI (−15 %), à administrer à l'iftar ; (2) Bolus : iftar (repas principal, soir) = bolus normal voire ↑ si repas copieux ; suhur (repas aube) = bolus ↓ 25-30 % (activité physique limitée et longue période de jeûne) ; (3) Surveillance : glycémie capillaire ≥ 4/jour (ne rompt pas le jeûne selon consensus religieux) ; (4) Critères de rupture : glycémie < 0,70 g/L → resucrage immédiat, > 3,00 g/L → correction + hydratation ; (5) Éducation : signes d'hypoglycémie, hydratation suffisante au suhur, ne pas sauter le suhur.

**Q13 — 💎 Diamant** : Une patiente DT1 de 25 ans, marathon dans 2 semaines. DTJ 42 UI. Comment la préparez-vous ?
> ✅ Préparation : (1) J-7 : tests d'adaptation pendant les entraînements longs → titrer la réduction de basale et bolus ; (2) J-0 matin : ↓ basale de 30-50 % (si pompe : débit temporaire −50 %, si injections : réduire la veille au soir) ; (3) Bolus petit-déjeuner : ↓ 50-75 %, repas riche en glucides complexes 2-3h avant le départ ; (4) Pendant la course : collation 15-30 g glucides toutes les 30-45 min, glycémie capillaire ou CGM en continu, cible pendant l'effort : 1,20-1,80 g/L ; (5) Post-course : risque d'hypoglycémie pendant 24-48h → ↓ basale de 20 % la nuit suivante, collation au coucher, surveillance CGM ; (6) Matériel : glucomètre, resucrage rapide (gels de glucose), glucagon d'urgence, informer un accompagnateur.

### Cas clinique intégré — Module 22

> 📝 **Cas clinique : Mme C., 30 ans, DT1 depuis 12 ans**
>
> Mme C. sous schéma basal-bolus : dégludec 18 UI matin + Fiasp® I/C 1:8 aux repas. DTJ ~48 UI. HbA1c : 7,8 %. Utilise un lecteur flash (FreeStyle Libre 2). TIR (70-180 mg/dL) : 52 %. TAR (>180 mg/dL) : 35 %. TBR (<70 mg/dL) : 13 %. GMI : 7,6 %.
>
> **Profil AGP** : hyperglycémies post-prandiales fréquentes (pics > 250 mg/dL 1h après les repas), hypoglycémies nocturnes (3h-6h).
>
> **Questions :**
> 1. Analysez les métriques CGM : quels sont les objectifs non atteints ?
> 2. Identifiez les 2 problèmes principaux et proposez des solutions pour chacun.
> 3. Le TBR est à 13 %. Quelle est la cible et quelle adaptation prioritaire proposez-vous ?
> 4. Recalculez le ratio I/C si nécessaire.
> 5. Discutez l'indication d'un passage sous pompe à insuline.

### Question de synthèse

> 🔄 **Synthèse** : Décrivez la démarche complète d'instauration d'un schéma basal-bolus chez un DT1 nouvellement diagnostiqué, depuis le calcul des doses initiales jusqu'à l'adaptation par insulinothérapie fonctionnelle, en intégrant le choix des insulines, les techniques d'injection, et l'éducation du patient.

---

# MODULE 23 : TECHNOLOGIES DU DIABÈTE — CGM, POMPE, BOUCLE FERMÉE

**Partie** : VII — Traitement du DT1
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Module 22

## Accroche clinique

> 🏥 **Mise en situation** : Emma, 14 ans, DT1 depuis 5 ans, sous pompe à insuline couplée à un CGM (système de boucle fermée hybride). Son endocrinologue pédiatrique note que son HbA1c est passée de 8,9 % (sous injections) à 7,1 % avec un TIR de 72 % et un TBR < 2 %. Ses parents rapportent un « changement de vie » : plus de glycémies capillaires nocturnes, moins de stress, meilleure qualité de sommeil. *Les technologies du diabète ont transformé la vie des patients DT1 — la boucle fermée hybride est le plus grand progrès thérapeutique depuis la découverte de l'insuline.*

## Objectifs d'apprentissage

1. **Connaître** les systèmes de mesure continue du glucose (CGM) : types, précision, métriques
2. **Prescrire** et utiliser une pompe à insuline : indications, schémas, programmation
3. **Comprendre** les algorithmes de boucle fermée hybride (AID) et leurs différences
4. **Interpréter** les données CGM/AGP et les utiliser pour l'adaptation thérapeutique
5. **Connaître** les innovations émergentes : pancréas artificiel bihormonaux, capteurs implantables

## Structure du contenu

### Section 1 — Mesure continue du glucose (CGM)

> Le module doit présenter les systèmes CGM disponibles :

**Contenu obligatoire :**

- **Principe** : capteur sous-cutané (fibre enzymatique glucose oxydase ou fluorescence) mesurant le glucose interstitiel toutes les 1-5 min → transmission au récepteur/smartphone ; décalage physiologique de 5-15 min entre glucose sanguin et interstitiel (attention en cas de variation rapide)
- **Types de systèmes** :
  - **CGM en temps réel (rtCGM)** : données continues + alarmes programmables (hypo, hyper, vitesse de variation) ; exemples : Dexcom G7 (précision MARD 8,2 %), Medtronic Guardian 4 (compatible boucle fermée)
  - **Lecteur flash (isCGM — intermittently scanned CGM)** : données disponibles au scan du capteur ; FreeStyle Libre 2 (alarmes optionnelles, MARD ~9,2 %), FreeStyle Libre 3 (fonctionnalités rtCGM, MARD ~7,9 %, le plus petit capteur)
  - **CGM implantable** : Eversense E3 (capteur implantable sous-cutané, durée 6 mois, MARD ~8,5 %) → avantages pour les patients avec irritations cutanées
- **Métriques CGM standardisées** (consensus international — Battelino et al., Diabetes Care, 2019) :
  - **TIR (Time In Range)** 70-180 mg/dL : cible ≥ 70 % (corrélé à HbA1c ~7 %)
  - **TBR (Time Below Range)** < 70 mg/dL : cible < 4 % ; < 54 mg/dL : cible < 1 %
  - **TAR (Time Above Range)** > 180 mg/dL : cible < 25 % ; > 250 mg/dL : cible < 5 %
  - **GMI (Glucose Management Indicator)** : estimation de l'HbA1c à partir des données CGM
  - **CV (coefficient de variation)** : variabilité glycémique ; cible ≤ 36 % ; si > 36 % = instabilité → priorité à la réduction des hypoglycémies
- **Profil ambulatoire du glucose (AGP)** : standardisation de la visualisation des données CGM sur 14 jours ; courbe médiane + percentiles (10-25-75-90) → identification des patterns (hyperglycémie post-prandiale, hypoglycémie nocturne, phénomène de l'aube)
- **Indications remboursées en France** : DT1 (tous), DT2 sous ≥ 3 injections/jour ou pompe, diabète gestationnel (dans certains cas), instabilité glycémique

> [MEDIA: 🖥️ MDIAB23-S01-001 — COMPARATIF CGM DISPONIBLES (Dexcom G7, Libre 3, Guardian 4, Eversense E3 — taille, durée, MARD, alarmes, compatibilité)]

> [MEDIA: 📊 MDIAB23-S01-002 — PROFIL AGP ANNOTÉ (courbe médiane + percentiles, identification patterns, métriques TIR/TBR/TAR)]

> [MEDIA: 📋 MDIAB23-S01-003 — OBJECTIFS CGM STANDARDISÉS (tableau cibles TIR, TBR, TAR, CV, GMI — consensus Battelino 2019)]

### Section 2 — Pompe à insuline (CSII)

> Le module doit présenter la pompe à insuline externe :

**Contenu obligatoire :**

- **Principe** : perfusion sous-cutanée continue d'insuline ultra-rapide via un cathéter → débit basal programmable par tranches horaires + bolus à la demande du patient
- **Types de pompes** :
  - Pompes à tubulure : Medtronic MiniMed 780G, Tandem t:slim X2 → réservoir, tubulure, cathéter ; avantages : programmation fine des débits basaux, bolus étendus/combinés
  - Pompes patch (sans tubulure) : Omnipod 5 (directement collée sur la peau, commandée par PDM ou smartphone) → avantages : discrétion, pas de tubulure (sport, natation)
  - YpsoPump (Mylife Loop) : système modulaire compatible boucle fermée CamAPS FX
- **Indications** (recommandations HAS, ADA 2024) :
  - HbA1c non atteinte malgré basal-bolus optimisé
  - Hypoglycémies sévères ou fréquentes
  - Variabilité glycémique importante (CV > 36 %)
  - Mode de vie nécessitant une flexibilité (travail posté, sport de haut niveau)
  - Grossesse (planifiée ou en cours) chez DT1
  - Phénomène de l'aube marqué (non corrigeable par basale)
  - Enfants en bas âge (doses très faibles, flexibilité horaire)
- **Programmation** :
  - Débit basal : DTJ basale ÷ 24 = débit de base (UI/h) ; ajustement par tranche horaire (↑ 4h-8h pour phénomène de l'aube, ↓ 2h-4h si hypoglycémies nocturnes)
  - Bolus : calculateur de bolus intégré (ratio I/C, FSI, insuline active = IOB)
  - Débits temporaires : ↑ ou ↓ % pour activité physique, maladie
  - Bolus étendus/combinés : pour repas riches en graisses/protéines (pizza, raclette → pic glycémique retardé)
- **Complications** : obstruction cathéter → hyperglycémie rapide + ACD (pas de réserve d'insuline lente) → urgence de changement de cathéter ; infections locales (site d'insertion) ; défaillance technique ; dermatite de contact (adhésifs)

> [MEDIA: 💉 MDIAB23-S02-001 — COMPARATIF POMPES À INSULINE (MiniMed 780G, t:slim X2, Omnipod 5, YpsoPump — caractéristiques, compatibilité CGM/boucle fermée)]

> [MEDIA: 📊 MDIAB23-S02-002 — PROGRAMMATION DÉBIT BASAL (profil 24h avec augmentation aube, réduction nocturne — comparaison basal-bolus vs pompe)]

### Section 3 — Boucle fermée hybride (AID — Automated Insulin Delivery)

> Le module doit présenter les systèmes de boucle fermée :

**Contenu obligatoire :**

- **Principe** : CGM + pompe + algorithme → le système ajuste automatiquement le débit basal et les corrections en fonction des données CGM en temps réel ; « hybride » car le patient doit encore annoncer les repas et administrer les bolus manuellement
- **Systèmes disponibles** (2024-2025) :
  - **Medtronic MiniMed 780G + Guardian 4** : algorithme SmartGuard (cible personnalisable 100-120 mg/dL, auto-corrections toutes les 5 min), temps d'adaptation 48h
  - **Tandem t:slim X2 + Dexcom G7 — Control-IQ** : algorithme prédictif basé sur un modèle (cible 112,5 mg/dL, mode exercice, mode sommeil avec cible plus stricte)
  - **Omnipod 5 + Dexcom G7** : pompe patch en boucle fermée → algorithme SmartAdjust (cible personnalisable 110-150 mg/dL)
  - **CamAPS FX + Dexcom G7 (+ YpsoPump ou Dana)** : algorithme développé à Cambridge (MPC — Model Predictive Control), indiqué dès 1 an, adapté aux femmes enceintes DT1
  - **Systèmes DIY (Do It Yourself)** : OpenAPS, Loop, AndroidAPS → communauté de patients développeurs, algorithmes open-source, non approuvés réglementairement mais utilisés par >30 000 patients dans le monde ; résultats comparables aux systèmes commerciaux
- **Résultats cliniques** :
  - Augmentation TIR de 10-15 % vs basal-bolus ou pompe seule
  - Réduction HbA1c de 0,3-0,5 %
  - Réduction significative TBR et hypoglycémies nocturnes
  - Amélioration qualité de vie et charge mentale (études ADAPT — Benhamou et al., Lancet Digital Health, 2024)
- **Limites** : nécessité d'annoncer les repas (boucle « hybride »), retard capteur-interstitiel en cas de variation rapide (repas rapides, sport), dysfonctions techniques, coût, courbe d'apprentissage, dermatite adhésifs
- **Vers la boucle fermée complète (« fully closed loop »)** : systèmes en développement ne nécessitant plus d'annonce de repas ; algorithmes « meal detection » ; challenge : cinétique de l'insuline SC trop lente pour couvrir les pics post-prandiaux sans annonce → insulines ultra-rapides, insuline intrapéritonéale

> [MEDIA: 🖥️ MDIAB23-S03-001 — SCHÉMA FONCTIONNEL BOUCLE FERMÉE HYBRIDE (CGM → algorithme → pompe → glucose → CGM, boucle avec annonce repas)]

> [MEDIA: 📊 MDIAB23-S03-002 — COMPARATIF RÉSULTATS BOUCLE FERMÉE vs INJECTIONS (TIR, TBR, TAR, HbA1c — données des essais pivotaux)]

> [MEDIA: 📋 MDIAB23-S03-003 — COMPARATIF SYSTÈMES BOUCLE FERMÉE (780G, Control-IQ, Omnipod 5, CamAPS FX — algorithme, cible, CGM, pompe, indication pédiatrique)]

### Section 4 — Innovations et perspectives technologiques

> Le module doit présenter les technologies émergentes :

**Contenu obligatoire :**

- **Pancréas artificiel bihormonaux** : insuline + glucagon → meilleur contrôle des hypoglycémies (algorithme qui injecte du micro-glucagon en cas de tendance basse) ; iLet Bionic Pancreas (Beta Bionics) : études randomisées montrant amélioration du TIR ; limites : stabilité du glucagon (lyophilisé, reconstitué), coût, complexité
- **Capteurs non invasifs** : tentatives de mesure du glucose sans piqûre (spectroscopie NIR, microondes, salive, larmes — Google Contact Lens) → aucun dispositif fiable commercialisé à ce jour ; prometteur mais challenges techniques majeurs (interférences, précision insuffisante)
- **Insuline « smart » (glucose-responsive insulin)** : insulines dont l'activité s'adapte au niveau de glucose (monomères avec groupement phénylboronique ou glucose-binding protein) → libération augmentée quand glucose élevé → concept de « pancréas chimique » ; stade préclinique avancé/phase 1
- **Insuline orale** : projet ancien, challenges (dégradation GI, faible biodisponibilité) ; formulations nanotechnologiques (nanoparticules, hydrogels pH-sensibles) ; ORMD-0801 (phase 3 — résultats décevants)
- **Insuline inhalée** : Afrezza® (technelion inhaler, insuline poudre) : délai ultra-rapide (1 min), pic 12-15 min, durée 1,5-3h → bolus uniquement ; disponible aux USA, non commercialisée en Europe ; limites : fonction pulmonaire, tabac, variabilité de dose

> [MEDIA: 🔬 MDIAB23-S04-001 — SCHÉMA PANCRÉAS ARTIFICIEL BIHORMONAL (double pompe insuline + glucagon, algorithme, capteur)]

> [MEDIA: 🔮 MDIAB23-S04-002 — TIMELINE INNOVATIONS TECHNOLOGIQUES DIABÈTE (passé : seringue → stylo → pompe → CGM → boucle fermée → futur : bihormonaux, insuline smart, capteurs non invasifs)]

## Points clés — Module 23

> 🎯 **Essentiel à retenir**
> 1. CGM : mesure glucose interstitiel toutes les 1-5 min → rtCGM (alarmes) vs isCGM (scan)
> 2. Métriques CGM : TIR ≥ 70 %, TBR < 4 % (< 70 mg/dL), TAR < 25 %, CV ≤ 36 %
> 3. Profil AGP : outil standardisé de visualisation 14 jours → identification des patterns
> 4. Pompe à insuline : débit basal programmable + bolus → avantages : flexibilité, phénomène de l'aube
> 5. Boucle fermée hybride : CGM + pompe + algorithme → ↑ TIR 10-15 %, ↓ hypos, ↓ HbA1c 0,3-0,5 %
> 6. Systèmes commerciaux : 780G, Control-IQ, Omnipod 5, CamAPS FX
> 7. « Hybride » = annonce des repas encore nécessaire (limitation cinétique insuline SC)
> 8. Systèmes DIY (OpenAPS, Loop) : >30 000 utilisateurs, résultats comparables
> 9. Pancréas bihormonal (iLet) : insuline + glucagon → meilleur contrôle des hypos
> 10. Insuline smart (glucose-responsive) : concept prometteur, stade préclinique

## Auto-évaluation — Module 23

### QCM progressifs (10 questions)

**Q1 — 🥉 Bronze** : Que mesure un CGM ?
A. La glycémie veineuse
B. Le glucose interstitiel sous-cutané
C. L'HbA1c en continu
D. L'insulinémie
> ✅ **B** — Le CGM mesure le glucose interstitiel sous-cutané, avec un décalage physiologique de 5-15 min par rapport à la glycémie capillaire.

**Q2 — 🥉 Bronze** : Quelle est la cible de TIR (Time In Range, 70-180 mg/dL) recommandée ?
A. ≥ 50 %
B. ≥ 70 %
C. ≥ 90 %
D. 100 %
> ✅ **B** — La cible TIR est ≥ 70 % (consensus Battelino 2019), ce qui correspond approximativement à une HbA1c de 7 %. La cible TBR doit être < 4 % (< 70 mg/dL).

**Q3 — 🥈 Argent** : Pourquoi la boucle fermée est-elle « hybride » ?
A. Car elle utilise 2 types d'insuline
B. Car le patient doit encore annoncer les repas et administrer les bolus manuellement
C. Car elle combine 2 capteurs
D. Car elle fonctionne alternativement en mode automatique et manuel
> ✅ **B** — La boucle fermée est dite « hybride » car l'algorithme ajuste automatiquement le débit basal et les corrections, mais le patient doit annoncer les repas et déclencher les bolus. La cinétique de l'insuline SC est trop lente pour couvrir les pics post-prandiaux sans annonce préalable.

**Q4 — 🥈 Argent** : Quel risque spécifique de la pompe à insuline n'existe pas avec le schéma basal-bolus par injections ?
A. Lipodystrophie
B. Acidocétose rapide en cas d'obstruction du cathéter
C. Hypoglycémie
D. Hyperglycémie
> ✅ **B** — Avec la pompe, il n'y a pas de réserve d'insuline lente sous-cutanée. En cas d'obstruction du cathéter, la glycémie monte rapidement (2-4h) et l'ACD peut survenir en quelques heures. C'est un risque spécifique de la pompe nécessitant une éducation du patient.

**Q5 — 🥈 Argent** : Quel coefficient de variation glycémique indique une instabilité nécessitant de prioriser la réduction des hypoglycémies ?
A. CV > 20 %
B. CV > 36 %
C. CV > 50 %
D. CV > 10 %
> ✅ **B** — Un CV > 36 % indique une variabilité glycémique excessive. Dans ce cas, la priorité est de réduire les hypoglycémies (TBR) avant de chercher à réduire l'HbA1c ou augmenter le TIR.

**Q6 — 🥇 Or** : Quel algorithme de boucle fermée est spécifiquement validé chez la femme enceinte DT1 ?
A. SmartGuard (780G)
B. Control-IQ (t:slim X2)
C. CamAPS FX
D. SmartAdjust (Omnipod 5)
> ✅ **C** — CamAPS FX (Cambridge) est le seul algorithme de boucle fermée spécifiquement étudié et validé chez la femme enceinte DT1 (étude AiDAPT — Stewart et al., N Engl J Med, 2023). Il est aussi indiqué dès l'âge de 1 an.

**Q7 — 🥇 Or** : Que sont les systèmes DIY de boucle fermée et quelle est leur particularité ?
A. Des systèmes approuvés par la FDA moins coûteux
B. Des systèmes open-source développés par la communauté de patients (OpenAPS, Loop, AndroidAPS), non approuvés réglementairement mais utilisés par >30 000 patients
C. Des pompes à insuline manuelles
D. Des applications de calcul de bolus
> ✅ **B** — Les systèmes DIY sont des algorithmes de boucle fermée open-source créés par la communauté #WeAreNotWaiting. Bien que non approuvés réglementairement, ils sont utilisés par >30 000 patients dans le monde avec des résultats comparables aux systèmes commerciaux.

**Q8 — 💎 Diamant** : Une patiente DT1 sous boucle fermée hybride (780G) a un TIR de 58 %, un TAR de 38 %, un TBR de 4 %. L'AGP montre des pics > 300 mg/dL systématiquement 1-2h après les repas. Que proposez-vous ?
> ✅ Le problème principal est l'hyperglycémie post-prandiale (TAR 38 %) malgré la boucle fermée. Causes probables : (1) Bolus tardif ou insuffisant (la boucle ne peut compenser un bolus manquant/retardé) ; (2) Ratio I/C sous-estimé. Actions : (1) Vérifier que la patiente annonce TOUS les repas et donne le bolus 10-15 min AVANT de manger ; (2) Ajuster le ratio I/C (↓ de 10-15 %, par ex. de 1:10 à 1:8) ; (3) Vérifier le facteur de correction actif (le ratio d'insuline active) ; (4) Former à l'utilisation du pré-bolus (bolus 15 min avant le repas) ; (5) Vérifier le site d'insertion du cathéter (lipodystrophies → absorption retardée).

**Q9 — 💎 Diamant** : Comparez les avantages et inconvénients de la pompe patch (Omnipod 5) vs pompe à tubulure (MiniMed 780G) pour un adolescent DT1 sportif.
> ✅ **Omnipod 5** — Avantages : pas de tubulure (sport, natation, esthétique adolescent), discrétion, étanchéité ; Inconvénients : pod volumineux (bras/abdomen), pas de bolus étendu sophistiqué, changement obligatoire tous les 3 jours (pods jetables → coût, déchets). **MiniMed 780G** — Avantages : bolus étendus/combinés (repas riches en graisses), réservoir 300 UI (moins de changements si grosses doses), algorithme SmartGuard performant ; Inconvénients : tubulure (accrochage, sport aquatique), moins discret, site d'insertion + cathéter à changer. **Pour un ado sportif** : Omnipod 5 souvent préféré (liberté de mouvement, natation sans déconnexion, pas de tubulure gênante en sport).

**Q10 — 💎 Diamant** : Comment expliquez-vous à un patient la différence entre FreeStyle Libre 3 et Dexcom G7 pour l'aider à choisir ?
> ✅ **Libre 3** : le plus petit capteur disponible, 14 jours de port, MARD ~7,9 %, alarmes optionnelles, lecture continue (plus besoin de scanner comme le Libre 2), moins coûteux. **Dexcom G7** : durée 10 jours (+12h de grâce), MARD ~8,2 %, alarmes personnalisables robustes, compatible avec les systèmes de boucle fermée (Omnipod 5, Control-IQ), partage en temps réel (Dexcom Follow). **Critères de choix** : si le patient veut une boucle fermée → Dexcom G7 (plus de compatibilité) ; si autonome en basal-bolus sans projet de pompe → Libre 3 (plus petit, moins cher, 14 jours) ; alarmes plus fiables → Dexcom G7 ; sensibilité cutanée → tester les deux (adhésifs différents).

### Cas clinique intégré — Module 23

> 📝 **Cas clinique : Tom, 8 ans, DT1 depuis 2 ans**
>
> Tom est sous schéma basal-bolus (dégludec 6 UI + aspart I/C 1:20 aux repas). HbA1c : 8,6 %. CGM Libre 3 : TIR 45 %, TBR 8 %, TAR 47 %. Ses parents sont épuisés par la surveillance nocturne (se lèvent 2-3 fois/nuit pour vérifier la glycémie). L'AGP montre des hypoglycémies récurrentes entre 2h et 5h et des hyperglycémies matinales (phénomène de l'aube).
>
> **Questions :**
> 1. Analysez les métriques CGM : quels sont les problèmes prioritaires ?
> 2. Pourquoi la pompe à insuline est-elle particulièrement indiquée chez cet enfant ?
> 3. Quel système de boucle fermée recommanderiez-vous pour un enfant de 8 ans ? Justifiez.
> 4. Quels résultats attendez-vous du passage en boucle fermée (TIR, TBR, qualité de vie) ?
> 5. Comment accompagnez-vous les parents dans cette transition technologique ?

### Question de synthèse

> 🔄 **Synthèse** : Pour un patient DT1 actuellement sous basal-bolus par injections avec un TIR de 50 %, construisez la stratégie d'escalade technologique progressive : CGM → pompe → boucle fermée hybride, en justifiant chaque étape par les bénéfices attendus et en identifiant les critères de passage.

---

# MODULE 24 : ÉDUCATION THÉRAPEUTIQUE DU DT1 — AUTONOMISATION ET QUALITÉ DE VIE

**Partie** : VII — Traitement du DT1
**Durée estimée** : 2h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 22-23

## Accroche clinique

> 🏥 **Mise en situation** : Julien, 22 ans, DT1 depuis 4 ans, HbA1c 9,5 %, a été hospitalisé 2 fois pour ACD en 6 mois. Il admet ne pas compter les glucides (« c'est trop compliqué »), injecter l'insuline « au feeling », et avoir arrêté le CGM (« ça bipe tout le temps et ça m'énerve »). Il est étudiant en droit et dit que le diabète « ruine sa vie sociale ». *L'éducation thérapeutique n'est pas une option mais un droit du patient et une obligation du soignant — un DT1 qui ne comprend pas sa maladie ne peut pas la gérer.*

## Objectifs d'apprentissage

1. **Connaître** les principes de l'éducation thérapeutique du patient (ETP) selon l'OMS et la HAS
2. **Structurer** un programme d'ETP pour le DT1 : diagnostic éducatif, compétences visées, outils
3. **Enseigner** l'insulinothérapie fonctionnelle (comptage glucidique, ratios, FSI)
4. **Former** à la gestion des urgences : hypoglycémie sévère (glucagon), ACD (sick day rules)
5. **Accompagner** le vécu psychologique et la qualité de vie

## Structure du contenu

### Section 1 — Principes et cadre réglementaire de l'ETP

> Le module doit présenter le cadre de l'ETP :

**Contenu obligatoire :**

- **Définition OMS (1998)** : l'ETP vise à aider les patients à acquérir ou maintenir les compétences dont ils ont besoin pour gérer au mieux leur vie avec une maladie chronique
- **Cadre réglementaire français** : loi HPST 2009 (article L.1161-1 CSP), programmes autorisés par les ARS, équipe multidisciplinaire formée (40h minimum), évaluation quadriennale
- **Diagnostic éducatif** : 1ère étape = comprendre le patient (connaissances, croyances, vécu, ressources, freins, projets de vie) → bilan éducatif partagé → objectifs personnalisés
- **Compétences visées** (adapté de d'Ivernois & Gagnayre) :
  - **Compétences d'auto-soins** : techniques d'injection, adaptation des doses, comptage glucidique, surveillance glycémique, gestion hypoglycémie/hyperglycémie, activité physique, pied diabétique
  - **Compétences d'adaptation** : gestion émotionnelle, résolution de problèmes, communication avec l'entourage, gestion sociale (travail, voyages, loisirs)

### Section 2 — Insulinothérapie fonctionnelle et comptage glucidique

> Le module doit présenter l'éducation à l'insulinothérapie fonctionnelle :

**Contenu obligatoire :**

- **Insulinothérapie fonctionnelle (IF)** : approche éducative permettant au patient de déterminer lui-même ses doses d'insuline en fonction de son alimentation, son activité et sa glycémie → autonomisation maximale
- **Programme d'IF** (souvent sur 3-5 jours d'hospitalisation ou en ambulatoire) :
  - Jour 1-2 : détermination du débit de base (jeûne relatif → vérifier l'adéquation de la basale)
  - Jour 3-4 : détermination du ratio I/C par repas-test standardisé
  - Jour 5 : détermination du FSI, mise en situation, repas libre
- **Comptage glucidique** : méthode des 3 niveaux (ADA) :
  - Niveau 1 : reconnaissance des aliments glucidiques (groupes alimentaires)
  - Niveau 2 : estimation des portions en glucides (portions standardisées, tables de composition)
  - Niveau 3 : comptage précis des glucides en grammes (lecture des étiquettes, pesée, applications : myfitnesspal, Gluci-Check, Yuka nutritionnel)
- **Outils éducatifs** : assiette modèle, photos de portions, cartes aliments, applications smartphone, ateliers cuisine thérapeutique

> [MEDIA: 🍽️ MDIAB24-S02-001 — OUTIL VISUEL COMPTAGE GLUCIDIQUE (photos de portions courantes avec grammes de glucides annotés)]

> [MEDIA: 📋 MDIAB24-S02-002 — PROGRAMME IF SUR 5 JOURS (étapes, objectifs quotidiens, tests, résultats attendus)]

### Section 3 — Gestion des urgences et situations de vie

> Le module doit présenter l'éducation à la gestion des situations d'urgence :

**Contenu obligatoire :**

- **Resucrage de l'hypoglycémie** (règle des 15) : 15 g de sucres rapides (3 morceaux de sucre, 15 cl de jus de fruit, 1 tube de glucose) → attendre 15 min → contrôle glycémique → si < 0,70 g/L → re-sucrer → collation complexe si prochain repas > 1h
- **Glucagon d'urgence** : éducation de l'entourage (famille, école, conjoint) ; glucagon IM/SC (GlucaGen HypoKit®, Baqsimi® nasal, Zegalogue® SC auto-injecteur) ; technique de préparation et d'injection → mise en situation pratique ; indications : hypoglycémie sévère (perte de connaissance, convulsions, impossibilité de resucrage oral)
- **Protocole sick day** : éducation systématique avec remise de fiche écrite (cf. module 22)
- **Scolarité et diabète** : PAI (Projet d'Accueil Individualisé) → document encadrant la prise en charge à l'école (qui fait l'injection, où est le glucagon, qui appeler, activités physiques, cantine)
- **Permis de conduire** : réglementation (catégories A/B et C/D/E), obligation de déclaration, conditions (pas d'hypoglycémies sévères récurrentes, auto-surveillance avant de conduire, resucrage dans le véhicule)
- **Voyages** : certificat médical bilingue, insuline en cabine, adaptation aux fuseaux horaires, gestion du froid/chaleur, trousse d'urgence

### Section 4 — Vécu psychologique et qualité de vie

> Le module doit présenter l'accompagnement psychologique :

**Contenu obligatoire :**

- **Charge mentale du DT1** : prise de décisions multiples quotidiennes (200-300 décisions/jour liées au diabète selon Johnson, 2023), surveillance constante, planification alimentaire, gestion sociale → fatigue décisionnelle → « burnout du diabète »
- **Phases d'adaptation** : choc diagnostique → déni → colère/marchandage → dépression réactionnelle → acceptation (modèle de Kübler-Ross adapté) ; le processus n'est pas linéaire, des rechutes sont normales
- **Obstacles à l'observance** : peur de l'hypoglycémie (Fear of Hypoglycemia — échelle HFS), peur des aiguilles, stigmatisation sociale, conflits avec l'entourage, lassitude, coût (dans certains pays)
- **Outils de mesure de la qualité de vie** : DQoL (Diabetes Quality of Life), DTSQ (Diabetes Treatment Satisfaction Questionnaire), WHO-5 (bien-être), PAID (détresse liée au diabète)
- **Interventions** : entretien motivationnel, thérapie d'acceptation et d'engagement (ACT), groupes de pairs (associations de patients : AJD, FFD), accompagnement par un psychologue formé au diabète, travailleur social si besoins médico-sociaux

> [MEDIA: 📋 MDIAB24-S04-001 — PARCOURS ETP DU DT1 (diagnostic éducatif → programme initial → suivi → renforcement — acteurs et outils)]

> [MEDIA: 📊 MDIAB24-S04-002 — QUESTIONNAIRE PAID ABRÉGÉ (5 items, scoring, seuils d'alerte)]

## Points clés — Module 24

> 🎯 **Essentiel à retenir**
> 1. L'ETP est un droit du patient (loi HPST 2009) et une composante essentielle du traitement du DT1
> 2. Le diagnostic éducatif (bilan partagé) est la 1ère étape → comprendre le patient avant d'enseigner
> 3. L'insulinothérapie fonctionnelle donne au patient l'autonomie de calculer ses doses (ratio I/C, FSI)
> 4. Le comptage glucidique en 3 niveaux est la base de l'adaptation des bolus
> 5. Éducation de l'entourage au glucagon (nasal Baqsimi® ou SC Zegalogue®) = obligatoire
> 6. Règle des 15 pour l'hypoglycémie : 15 g sucres rapides → 15 min → contrôle → ± re-sucrage
> 7. Le PAI est obligatoire pour la scolarisation de l'enfant DT1
> 8. Le burnout du diabète est fréquent (200-300 décisions/jour) → dépistage systématique
> 9. L'entretien motivationnel est plus efficace que l'approche prescriptive pour l'observance
> 10. Les associations de patients (AJD, FFD) sont des ressources précieuses → les recommander

## Auto-évaluation — Module 24

### QCM progressifs (8 questions)

**Q1 — 🥉 Bronze** : Quelle est la 1ère étape d'un programme d'ETP ?
A. L'enseignement des techniques d'injection
B. Le diagnostic éducatif (bilan éducatif partagé)
C. La remise de brochures d'information
D. Le test de connaissances
> ✅ **B** — Le diagnostic éducatif est toujours la 1ère étape : comprendre le patient (connaissances, croyances, vécu, ressources, freins, projets) avant de construire un programme personnalisé.

**Q2 — 🥉 Bronze** : Quelle est la « règle des 15 » pour le resucrage de l'hypoglycémie ?
A. 15 UI d'insuline rapide
B. 15 g de sucres rapides → attendre 15 min → recontrôler
C. 15 mL de glucagon
D. 15 minutes de repos
> ✅ **B** — 15 g de sucres rapides (3 morceaux de sucre, 15 cl de jus de fruit) → attendre 15 min → contrôle glycémique → si toujours < 0,70 g/L → re-sucrer. Collation complexe si prochain repas > 1h.

**Q3 — 🥈 Argent** : Le glucagon nasal (Baqsimi®) : quand et par qui est-il utilisé ?
A. Par le patient lui-même en cas d'hyperglycémie
B. Par l'entourage en cas d'hypoglycémie sévère (perte de connaissance, impossibilité de resucrage oral)
C. Par le médecin uniquement en milieu hospitalier
D. En prévention quotidienne de l'hypoglycémie
> ✅ **B** — Le glucagon nasal (Baqsimi® 3 mg) est administré par l'entourage (famille, enseignant, collègue) en cas d'hypoglycémie sévère avec altération de conscience, quand le resucrage oral est impossible. Il ne nécessite pas de reconstitution.

**Q4 — 🥈 Argent** : Qu'est-ce que le PAI et quand est-il nécessaire ?
A. Un plan d'activité individuelle pour les sportifs diabétiques
B. Un Projet d'Accueil Individualisé obligatoire pour la scolarisation d'un enfant DT1
C. Un protocole d'administration d'insuline en réanimation
D. Un programme d'aide à l'insertion professionnelle
> ✅ **B** — Le PAI est un document réglementaire encadrant la prise en charge du diabète en milieu scolaire : qui fait l'injection, où est le glucagon, qui appeler, gestion de la cantine, activités sportives. Il est obligatoire pour tout enfant DT1 scolarisé.

**Q5 — 🥈 Argent** : L'insulinothérapie fonctionnelle vise principalement à :
A. Simplifier le traitement en réduisant le nombre d'injections
B. Donner au patient l'autonomie de calculer ses doses en fonction des glucides, de la glycémie et de l'activité
C. Remplacer la pompe à insuline
D. Supprimer les hypoglycémies
> ✅ **B** — L'IF autonomise le patient : il apprend à calculer ses bolus (ratio I/C + FSI), à adapter ses doses selon les circonstances (repas, sport, maladie), et à analyser ses résultats pour auto-corriger.

**Q6 — 🥇 Or** : Un patient DT1 prend environ 200-300 décisions par jour liées à son diabète. Quel risque psychologique en découle ?
A. Amélioration des fonctions cognitives
B. Burnout du diabète (fatigue décisionnelle, désengagement, dégradation de l'équilibre)
C. Hyperactivité
D. Aucun impact psychologique
> ✅ **B** — La charge décisionnelle constante (glycémie → interprétation → action, ×200-300/jour) épuise les ressources cognitives et émotionnelles → burnout du diabète avec désengagement progressif → dégradation de l'équilibre → culpabilité → cercle vicieux.

**Q7 — 💎 Diamant** : Julien (accroche clinique) : DT1, HbA1c 9,5 %, 2 ACD en 6 mois, refus du CGM, insuline « au feeling ». Comment structurez-vous sa prise en charge éducative ?
> ✅ (1) **Diagnostic éducatif prioritaire** : comprendre ses freins (pourquoi refuse-t-il le CGM ? qu'est-ce qui le gêne dans le comptage ? quel est son vécu émotionnel ? quels sont ses projets ?) ; (2) **Entretien motivationnel** : pas de jugement, explorer l'ambivalence (« qu'est-ce qui vous dérange le plus dans le diabète ? qu'est-ce que vous aimeriez changer ? ») ; (3) **Objectifs négociés** : commencer par 1-2 objectifs réalistes (ex : ne jamais sauter la basale = prévention ACD) ; (4) **IF simplifiée** : comptage glucidique niveau 1 (reconnaissance des groupes) avant le comptage précis ; (5) **CGM** : explorer le motif de refus (alarmes ? esthétique ? charge mentale ?) et proposer des solutions (désactiver certaines alarmes, essayer Libre 3 plus discret) ; (6) **Soutien psychologique** : proposer un psychologue, orientation vers l'AJD/FFD pour groupe de pairs jeunes adultes ; (7) **Suivi rapproché** : consultation toutes les 4-6 semaines initialement.

**Q8 — 💎 Diamant** : Comment organisez-vous un programme d'IF ambulatoire en 5 séances pour un groupe de 6 patients DT1 ?
> ✅ **Séance 1** (3h) : Diagnostic éducatif individuel (30 min/patient en parallèle) + atelier collectif « mes représentations du diabète et de l'alimentation » + présentation de l'IF ; **Séance 2** (3h) : Test de la basale : résultats du jeûne relatif réalisé entre les séances → analyse collective → ajustement ; Atelier : groupes alimentaires et identification des glucides (niveau 1-2) ; **Séance 3** (3h) : Ratio I/C : résultats des repas-tests standardisés → calcul collectif des ratios ; Atelier : lecture d'étiquettes, estimation des portions (photos, maquettes) ; **Séance 4** (3h) : FSI et correction : mise en pratique du calcul de bolus complet (glucides + correction) ; Atelier : repas libre au restaurant → comptage et dose en situation réelle → analyse 2h post-prandiale ; **Séance 5** (3h) : Situations spéciales (sport, maladie, alcool, voyages) + gestion des hypoglycémies (pratique glucagon) + bilan éducatif → définition des objectifs individuels de suivi.

### Cas clinique intégré — Module 24

> 📝 **Cas clinique : Léa, 16 ans, DT1 depuis 8 ans**
>
> Léa est sous pompe à insuline + CGM Dexcom G7 (boucle fermée Control-IQ). HbA1c : 8,8 %. TIR : 42 %. Elle déclare « boluser rarement » pour les repas, car « le système se débrouille tout seul ». Elle saute souvent le petit-déjeuner et mange des snacks non bolussés. Son profil AGP montre des pics > 300 mg/dL après chaque repas.
>
> **Questions :**
> 1. Pourquoi la boucle fermée ne suffit-elle pas à contrôler ses glycémies ?
> 2. Quel est le principal déficit éducatif de Léa ?
> 3. Comment restructurer son éducation thérapeutique (objectifs, outils, calendrier) ?
> 4. Comment aborder la question de l'observance chez une adolescente sans être moralisateur ?
> 5. Quel rôle pour les parents dans l'accompagnement d'une ado de 16 ans avec DT1 ?

### Question de synthèse

> 🔄 **Synthèse** : Construisez le programme d'ETP complet pour un patient DT1 nouvellement diagnostiqué, de la phase initiale (hospitalisation) à la phase de renforcement (suivi ambulatoire), en détaillant les compétences visées, les méthodes pédagogiques, et les indicateurs d'évaluation.

---

## Références bibliographiques — Partie 7

1. Riddle MC, Bolli GB, Ziemen M et al. (EDITION). « New insulin glargine 300 units/mL versus glargine 100 units/mL in people with type 2 diabetes using basal and mealtime insulin. » *Diabetes Care*, 2014; 37(10): 2755-2762.
2. Lane W, Bailey TS, Gerber R et al. (SWITCH 1). « Effect of insulin degludec vs insulin glargine U100 on hypoglycemia in patients with type 1 diabetes. » *JAMA*, 2017; 318(1): 33-44.
3. Rosenstock J, Bajaj HS, Janež A et al. (ONWARDS 1). « Once-weekly insulin icodec for treatment-naive type 2 diabetes. » *N Engl J Med*, 2023; 389(4): 297-308.
4. Hassanein M, Al-Arouj M, Hamdy O et al. (IDF-DAR). « Diabetes and Ramadan: practical guidelines. » *Diabetes Res Clin Pract*, 2017; 126: 303-316.
5. Frid AH, Kreugel G, Grassi G et al. (FITTER). « New insulin delivery recommendations. » *Mayo Clin Proc*, 2016; 91(9): 1231-1255.
6. Battelino T, Danne T, Bergenstal RM et al. « Clinical targets for continuous glucose monitoring data interpretation: recommendations from the International Consensus on Time in Range. » *Diabetes Care*, 2019; 42(8): 1593-1603.
7. Benhamou PY, Franc S, Reznik Y et al. (ADAPT). « Closed-loop insulin delivery versus sensor-augmented pump therapy in adults with type 1 diabetes. » *Lancet Digital Health*, 2024; 6(1): e27-e35.
8. Stewart ZA, Wilinska ME, Hartnell S et al. (AiDAPT). « Closed-loop insulin delivery during pregnancy in women with type 1 diabetes. » *N Engl J Med*, 2023; 389(8): 689-698.
9. d'Ivernois JF, Gagnayre R. *Apprendre à éduquer le patient : approche pédagogique.* 6e éd. Paris: Maloine, 2020.
10. Bouhassira D et al. « Development and validation of the Neuropathic Pain Symptom Inventory (DN4). » *Pain*, 2005; 114(1): 29-36.

---

> 🔶 **DIABÉTOLOGIE** | Partie 7/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 8 — Traitement du Diabète de Type 2 (Modules 25-29)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 25 : MESURES HYGIÉNO-DIÉTÉTIQUES — ALIMENTATION, ACTIVITÉ PHYSIQUE, PERTE DE POIDS

**Partie** : VIII — Traitement du DT2
**Durée estimée** : 3h00
**Niveau** : Fondamental
**Prérequis** : Modules 6, 13

## Accroche clinique

> 🏥 **Mise en situation** : M. A., 48 ans, DT2 découvert il y a 3 mois (HbA1c 7,3 %), IMC 34 kg/m², sédentaire, alimentation déséquilibrée (boissons sucrées quotidiennes, fast-food 3×/semaine). Son médecin lui a dit : « On va d'abord essayer le régime et le sport. » Trois mois plus tard, il a perdu 6 kg (−7 %), arrêté les sodas, marche 30 min/jour. HbA1c : 6,4 %. *Les mesures hygiéno-diététiques ne sont pas un « préalable » au traitement médical — elles SONT le traitement fondamental du DT2, capable à elles seules de normaliser l'HbA1c chez de nombreux patients.*

## Objectifs d'apprentissage

1. **Prescrire** une alimentation adaptée au DT2 : principes, macronutriments, index glycémique, régimes méditerranéen et DASH
2. **Prescrire** un programme d'activité physique personnalisé : type, intensité, durée, précautions
3. **Comprendre** l'impact de la perte de poids sur la rémission du DT2
4. **Connaître** les indications et résultats de la chirurgie bariatrique dans le DT2
5. **Intégrer** les MHD dans la stratégie thérapeutique globale

## Structure du contenu

### Section 1 — Alimentation et DT2

**Contenu obligatoire :**

- **Principes généraux** (recommandations ADA 2024, HAS, EASD) : pas de « régime diabétique » unique ; alimentation équilibrée, individualisée, culturellement adaptée, durable ; pas d'interdits alimentaires stricts (approche non-restrictive pour favoriser l'adhésion)
- **Macronutriments** :
  - Glucides : 45-55 % des apports caloriques ; privilégier les glucides complexes, index glycémique (IG) bas (légumineuses, céréales complètes, légumes) ; charge glycémique (CG = IG × quantité de glucides) ; limiter les sucres ajoutés (< 10 % des calories, OMS), les boissons sucrées (association forte avec le DT2 — Malik et al., Diabetes Care, 2010)
  - Lipides : 30-35 % des calories ; favoriser les acides gras mono-insaturés (huile d'olive, avocat, oléagineux) et polyinsaturés (oméga-3 — poissons gras) ; limiter les graisses saturées (< 10 %), supprimer les graisses trans
  - Protéines : 15-20 % des calories (0,8-1 g/kg/j si IRC, protéines végétales à favoriser)
  - Fibres : ≥ 25-30 g/j (ralentissent l'absorption glucidique, améliorent la sensibilité à l'insuline)
- **Régimes à fort niveau de preuve** :
  - **Régime méditerranéen** : le plus étudié dans le DT2, réduction des événements CV de 30 % (PREDIMED — Estruch et al., N Engl J Med, 2018), amélioration du contrôle glycémique, de la dyslipidémie et de la stéatose ; composants : huile d'olive, fruits/légumes, légumineuses, poissons, noix, vin modéré
  - **Régime DASH** : effet antihypertenseur, amélioration du profil métabolique
  - **Low-carb et very low-carb (keto)** : réduction glucides à 50-130 g/j (low-carb) ou < 50 g/j (keto) ; efficacité à court terme sur HbA1c et perte de poids ; préoccupations : durabilité, effet sur les lipides, risque ACD sous iSGLT2 ; position ADA 2024 : option acceptable à court-moyen terme avec suivi médical
  - **Jeûne intermittent** (16:8, 5:2) : données émergentes favorables sur le poids et l'HbA1c ; risque d'hypoglycémie sous sulfonylurées/insuline → adaptation posologique nécessaire
- **Édulcorants** : les édulcorants non nutritifs (aspartame, sucralose, stévia) sont acceptables en quantité modérée ; pas d'effet prouvé sur le contrôle glycémique à long terme ; controverses sur le microbiote (Suez et al., Nature, 2014)
- **Alcool** : modération (≤ 1 verre/j femmes, ≤ 2 verres/j hommes) ; attention aux hypoglycémies sous insuline/sulfonylurées ; les calories de l'alcool (7 kcal/g)

> [MEDIA: 🍽️ MDIAB25-S01-001 — ASSIETTE IDÉALE DU DT2 (modèle du plat : 50 % légumes, 25 % féculents IG bas, 25 % protéines + matière grasse de qualité)]

> [MEDIA: 📊 MDIAB25-S01-002 — TABLEAU INDEX GLYCÉMIQUE DES ALIMENTS COURANTS (classés IG bas < 55, moyen 55-70, élevé > 70)]

> [MEDIA: 📋 MDIAB25-S01-003 — COMPARATIF RÉGIMES DANS LE DT2 (méditerranéen, DASH, low-carb, keto, jeûne intermittent — preuves, avantages, limites)]

### Section 2 — Activité physique

**Contenu obligatoire :**

- **Recommandations** (ADA 2024, OMS) : ≥ 150 min/semaine d'activité aérobie modérée (marche rapide, vélo, natation) OU ≥ 75 min d'intensité vigoureuse ; renforcement musculaire ≥ 2 séances/semaine ; réduction du temps de sédentarité (se lever toutes les 30 min)
- **Bénéfices** : ↓ HbA1c de 0,4-0,7 % (méta-analyse Umpierre et al., JAMA, 2011), amélioration sensibilité à l'insuline (72h post-exercice), ↓ risque CV de 25-40 %, ↓ mortalité toutes causes, ↓ dépression, amélioration stéatose hépatique
- **Types d'exercice et effet glycémique** :
  - Aérobie : ↓ glycémie pendant et après l'effort (↑ captation musculaire glucose GLUT4-indépendante)
  - Résistance : amélioration sensibilité à l'insuline à long terme, ↑ masse maigre, ↓ sarcopénie
  - Combiné (aérobie + résistance) : effet supérieur à chacun séparément sur l'HbA1c
- **Précautions** : ECG d'effort si DT2 à très haut risque CV + sédentaire souhaitant activité intense ; adaptation des traitements hypoglycémiants (↓ sulfonylurées/insuline les jours d'exercice) ; examen des pieds ; hydratation
- **Prescription d'activité physique** : ordonnance APA (activité physique adaptée — loi 2016 en France), sport sur ordonnance, consultation sport-santé

> [MEDIA: 🏃 MDIAB25-S02-001 — PROGRAMME TYPE ACTIVITÉ PHYSIQUE POUR DT2 SÉDENTAIRE (progression semaine par semaine sur 12 semaines)]

### Section 3 — Perte de poids et rémission du DT2

**Contenu obligatoire :**

- **Impact de la perte de poids** :
  - Chaque kg perdu → ↓ HbA1c de 0,1 %
  - Perte de 5 % du poids → amélioration significative de l'HbA1c, PA, lipides
  - Perte de 10-15 % → rémission du DT2 possible (normalisation glycémie sans traitement)
- **Étude DiRECT** (Lean et al., Lancet, 2018) : programme de perte de poids intensive (remplacement repas 825-853 kcal/j pendant 12-20 semaines → réintroduction alimentaire progressive → maintenance) ; résultats : rémission du DT2 chez 46 % des patients à 1 an (86 % si perte > 15 kg) ; rémission maintenue chez 36 % à 2 ans ; mécanisme : dé-stéatose hépatique + restauration de la 1ère phase de sécrétion d'insuline
- **Chirurgie bariatrique** (recommandations HAS 2009, ADA/IFSO 2022) :
  - Indications DT2 : IMC ≥ 40 ou IMC ≥ 35 avec comorbidités (DT2 mal contrôlé = comorbidité) ; recommandation émergente : IMC ≥ 30 avec DT2 non contrôlé (ADA 2024, avis d'experts)
  - Techniques : sleeve gastrectomie (la plus pratiquée), bypass gastrique en Y de Roux (le plus efficace sur le DT2), bypass en oméga, anneau gastrique (en voie d'abandon)
  - Résultats métaboliques : rémission DT2 chez 40-80 % à 5 ans (étude STAMPEDE — Schauer et al., N Engl J Med, 2017) ; bypass > sleeve pour la rémission DT2 ; mécanismes : perte de poids + effets entéro-hormonaux (↑ GLP-1, PYY, modifications du microbiote, acides biliaires)
  - Risques : carences nutritionnelles (B12, fer, calcium, vitamines liposolubles → supplémentation à vie), dumping syndrome, lithiase biliaire, complications chirurgicales (2-5 %), reprise pondérale à long terme

> [MEDIA: 📊 MDIAB25-S03-001 — RÉSULTATS DiRECT (taux de rémission selon perte de poids : 0 %, 7 %, 34 %, 57 %, 86 % pour perte < 5, 5-10, 10-15, > 15 kg)]

> [MEDIA: 📋 MDIAB25-S03-002 — COMPARATIF TECHNIQUES BARIATRIQUES (sleeve vs bypass — mécanisme, perte de poids, rémission DT2, complications)]

## Points clés — Module 25

> 🎯 **Essentiel à retenir**
> 1. Les MHD sont le traitement fondamental du DT2, maintenu à toutes les étapes
> 2. Régime méditerranéen : le plus fort niveau de preuve (PREDIMED — ↓ 30 % événements CV)
> 3. Activité physique : ≥ 150 min/sem aérobie + 2 séances résistance → ↓ HbA1c 0,4-0,7 %
> 4. Perte de 5 % du poids → amélioration métabolique ; 10-15 % → rémission possible (DiRECT)
> 5. Chirurgie bariatrique : rémission DT2 chez 40-80 % à 5 ans (STAMPEDE), bypass > sleeve
> 6. Low-carb/keto : efficace à court terme mais durabilité incertaine
> 7. Pas d'interdits alimentaires stricts — approche non-restrictive pour l'adhésion

## Auto-évaluation — Module 25

### QCM progressifs (8 questions)

**Q1 — 🥉 Bronze** : Quel régime alimentaire a le plus fort niveau de preuve dans le DT2 ?
A. Régime hyperprotéiné
B. Régime méditerranéen
C. Régime cétogène strict
D. Régime sans gluten
> ✅ **B** — Le régime méditerranéen (PREDIMED) réduit les événements CV de 30 % et améliore le contrôle glycémique, la dyslipidémie et la stéatose hépatique. C'est le régime le plus étudié et le plus recommandé dans le DT2.

**Q2 — 🥉 Bronze** : Quelle durée d'activité physique aérobie modérée est recommandée par semaine chez le DT2 ?
A. 30 min
B. 75 min
C. ≥ 150 min
D. 300 min
> ✅ **C** — ≥ 150 min/semaine d'activité aérobie modérée (marche rapide, vélo, natation) OU ≥ 75 min d'intensité vigoureuse + ≥ 2 séances de renforcement musculaire/semaine.

**Q3 — 🥈 Argent** : Quel est le taux de rémission du DT2 dans l'étude DiRECT chez les patients ayant perdu > 15 kg ?
A. 20 %
B. 46 %
C. 86 %
D. 100 %
> ✅ **C** — DiRECT montre un taux de rémission de 86 % chez les patients ayant perdu > 15 kg, grâce à la dé-stéatose hépatique et la restauration de la 1ère phase de sécrétion d'insuline.

**Q4 — 🥈 Argent** : Quelle technique bariatrique est la plus efficace pour la rémission du DT2 ?
A. Anneau gastrique
B. Sleeve gastrectomie
C. Bypass gastrique en Y de Roux
D. Ballon intragastrique
> ✅ **C** — Le bypass gastrique en Y de Roux est la technique la plus efficace sur le DT2, grâce à la combinaison perte de poids + effets entéro-hormonaux (↑ GLP-1/PYY, modifications microbiote, acides biliaires).

**Q5 — 🥇 Or** : Pourquoi l'activité combinée (aérobie + résistance) est-elle supérieure à chaque type seul dans le DT2 ?
A. C'est plus amusant
B. L'aérobie ↓ glycémie aiguë (captation musculaire) + la résistance ↑ masse maigre et sensibilité à l'insuline à long terme → effets complémentaires
C. Seule la résistance a un effet glycémique
D. L'aérobie augmente la masse grasse
> ✅ **B** — L'exercice aérobie améliore la captation musculaire du glucose pendant et après l'effort, tandis que le renforcement musculaire augmente la masse maigre (principal site de captation du glucose) et la sensibilité à l'insuline à long terme. La combinaison a un effet synergique.

**Q6 — 🥇 Or** : Quel est le mécanisme de la rémission du DT2 par perte de poids selon le modèle DiRECT ?
A. Augmentation de la sécrétion de glucagon
B. Dé-stéatose hépatique → restauration sensibilité hépatique à l'insuline + dé-stéatose pancréatique → restauration 1ère phase sécrétion insuline
C. Augmentation de la taille des îlots de Langerhans
D. Modification du génotype
> ✅ **B** — Le modèle « twin cycle hypothesis » (Taylor, Diabetologia, 2008) explique la rémission par : (1) dé-stéatose hépatique → ↓ production hépatique de glucose → ↓ glycémie à jeun, (2) dé-stéatose pancréatique → restauration de la fonction β-cellulaire et de la 1ère phase de sécrétion.

**Q7 — 💎 Diamant** : Un DT2 de 45 ans, IMC 42, HbA1c 9,2 % sous metformine + sémaglutide, PA 145/92, LDL 1,30 g/L. Faut-il proposer la chirurgie bariatrique ? Argumentez.
> ✅ Oui, la chirurgie bariatrique est indiquée : IMC ≥ 40 (critère suffisant seul) + DT2 mal contrôlé (HbA1c 9,2 %) + HTA. Préalable : évaluation multidisciplinaire (endocrinologue, chirurgien, diététicien, psychologue), bilan nutritionnel, endoscopie digestive haute. Technique recommandée : bypass en Y de Roux (meilleure rémission DT2). Résultat attendu : rémission DT2 60-80 %, amélioration HTA, ↓ risque CV. Suivi à vie obligatoire (carences, reprise pondérale).

**Q8 — 💎 Diamant** : Un DT2 demande votre avis sur le régime cétogène. Que lui répondez-vous ?
> ✅ Le régime cétogène (< 50 g glucides/j) montre une efficacité à court terme sur l'HbA1c (↓ 0,5-1 %) et la perte de poids, mais : (1) durabilité incertaine (> 50 % d'abandon à 1 an), (2) risque d'hypoglycémie si sous sulfonylurées/insuline → adaptation obligatoire, (3) risque d'ACD eucétonique si sous iSGLT2, (4) effet sur le LDL-c variable (augmentation possible), (5) difficile socialement. L'ADA 2024 accepte le low-carb comme option à court-moyen terme avec suivi médical. Je préférerais un régime méditerranéen (meilleur niveau de preuve long terme, plus durable) avec réduction modérée des glucides raffinés.

---

# MODULE 26 : ANTIDIABÉTIQUES ORAUX — METFORMINE, SULFONYLURÉES, INHIBITEURS DPP-4

**Partie** : VIII — Traitement du DT2
**Durée estimée** : 3h00
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Module 6

## Accroche clinique

> 🏥 **Mise en situation** : Mme J., 54 ans, DT2 découvert il y a 2 mois (HbA1c 8,1 %), IMC 29, pas de complication. Son médecin instaure la metformine 500 mg × 2/j avec augmentation progressive. À 3 mois, HbA1c : 7,2 %. La metformine est bien tolérée. Faut-il ajouter un 2e antidiabétique ? Si oui, lequel ? *Le choix de la 2e ligne après la metformine n'est plus dicté uniquement par l'HbA1c mais par le profil cardio-rénal du patient — un changement de paradigme.*

## Objectifs d'apprentissage

1. **Prescrire** la metformine : mécanisme, posologie, titration, contre-indications, surveillance
2. **Connaître** les sulfonylurées et les glinides : mécanisme, indications, risques (hypoglycémie, prise de poids)
3. **Prescrire** les inhibiteurs de la DPP-4 (gliptines) : mécanisme, avantages (neutralité pondérale, pas d'hypo)
4. **Connaître** les thiazolidinediones (pioglitazone) et les inhibiteurs de l'alpha-glucosidase
5. **Choisir** le traitement en fonction du profil patient (cardio-rénal, pondéral, risque hypo)

## Structure du contenu

### Section 1 — Metformine

**Contenu obligatoire :**

- **Mécanisme d'action** : biguanide ; activation AMPK → ↓ production hépatique de glucose (néoglucogenèse ↓), ↑ sensibilité musculaire à l'insuline, ↓ absorption intestinale du glucose ; pas de stimulation de la sécrétion d'insuline → pas d'hypoglycémie en monothérapie
- **Pharmacologie** : biodisponibilité 50-60 %, pas de métabolisme hépatique, élimination rénale → accumulation si IRC
- **Efficacité** : ↓ HbA1c de 1-1,5 % ; UKPDS (1998) : seul ADO ayant montré une réduction de la mortalité dans le DT2 en surpoids → « 1ère intention incontestée » pendant 25 ans
- **Posologie** : débuter 500 mg/j (au repas du soir), augmenter de 500 mg/semaine selon tolérance ; dose optimale 2000 mg/j (1000 mg × 2 ou 850 mg × 3) ; dose maximale 3000 mg/j
- **Effets secondaires** : GI (nausées, diarrhée, douleurs abdominales — 20-30 %, améliorés par titration progressive et prise aux repas) ; formes LP (metformine XR) : meilleure tolérance GI ; carence en vitamine B12 (5-10 % long terme → dosage annuel si traitement prolongé, supplémentation si carence)
- **Contre-indications** : DFG < 30 mL/min (arrêt), dose réduite 1 g/j si DFG 30-45 ; insuffisance hépatique sévère ; situations d'anoxie tissulaire (IC aiguë, choc, détresse respiratoire) ; injection de produit de contraste iodé (arrêt 48h) ; chirurgie majeure ; intoxication alcoolique aiguë
- **Acidose lactique associée à la metformine (MALA)** : rare (5 cas/100 000 patients-années) mais gravissime (mortalité 30-50 %) ; survient presque toujours en cas d'accumulation (IRC, déshydratation, sepsis) → respect des CI et situations d'arrêt temporaire

> [MEDIA: 🔬 MDIAB26-S01-001 — MÉCANISME D'ACTION METFORMINE (activation AMPK → effets hépatique, musculaire, intestinal)]

> [MEDIA: 📋 MDIAB26-S01-002 — TABLEAU METFORMINE (posologie, titration, CI, situations d'arrêt, surveillance)]

### Section 2 — Sulfonylurées et glinides (sécrétagogues)

**Contenu obligatoire :**

- **Sulfonylurées (SU)** — mécanisme : liaison au récepteur SUR1 (canal K-ATP) → fermeture canaux → dépolarisation → sécrétion insuline (même en dehors du repas → risque hypo)
  - Molécules : gliclazide (Diamicron® LM 30-120 mg — préféré car métabolisme hépatique, profil CV favorable — étude ADVANCE), glimépiride (Amarel® 1-6 mg), glibenclamide (Daonil® — à éviter si IRC, sujet âgé)
  - Efficacité : ↓ HbA1c 1-1,5 %
  - Effets secondaires : **hypoglycémie** (risque principal, surtout glibenclamide → métabolites actifs, sujet âgé, IRC, repas sauté) ; prise de poids (+2-3 kg)
  - CI : IRC sévère (sauf gliclazide prudemment), insuffisance hépatique sévère, grossesse
  - Place actuelle : en recul au profit des iSGLT2 et aGLP-1 (pas de bénéfice cardio-rénal prouvé), mais reste utilisée dans certains pays/contextes (coût faible, large disponibilité)
- **Glinides** (répaglinide — Novonorm®) : même mécanisme que SU mais demi-vie courte (1h) → effet « couvre-repas » ; prise au début de chaque repas, pas de prise si pas de repas ; moindre risque hypo que SU ; utilisable si IRC modérée ; efficacité : ↓ HbA1c 0,5-1 %

> [MEDIA: 🔬 MDIAB26-S02-001 — MÉCANISME SÉCRÉTAGOGUES (liaison SUR1 → fermeture K-ATP → dépolarisation → sécrétion insuline)]

> [MEDIA: 📋 MDIAB26-S02-002 — COMPARATIF SULFONYLURÉES (gliclazide vs glimépiride vs glibenclamide — posologie, métabolisme, risque hypo, CI)]

### Section 3 — Inhibiteurs de la DPP-4 (gliptines)

**Contenu obligatoire :**

- **Mécanisme** : inhibition de la dipeptidyl peptidase-4 → ↑ GLP-1 et GIP endogènes (×2-3 les taux physiologiques) → sécrétion insuline glucose-dépendante ↑ + glucagon ↓ ; pas d'hypoglycémie (effet incrétin glucose-dépendant) ; pas de perte de poids (neutre)
- **Molécules** :
  - Sitagliptine (Januvia® 100 mg/j) — le plus prescrit, adaptation si IRC
  - Vildagliptine (Galvus® 50 mg × 2/j) — CI si insuffisance hépatique
  - Saxagliptine (Onglyza® 5 mg/j) — signal IC (étude SAVOR-TIMI 53 → augmentation hospitalisation IC) → précaution si IC
  - Linaglyptine (Trajenta® 5 mg/j) — pas d'ajustement rénal (élimination biliaire) → avantage si IRC
  - Alogliptine (Vipidia® 25 mg/j) — adaptation si IRC
- **Efficacité** : ↓ HbA1c 0,5-0,8 % (modeste vs aGLP-1)
- **CVOT** : sécurité CV démontrée (non-infériorité), pas de bénéfice CV démontré (contrairement aux aGLP-1 et iSGLT2) → position dans la stratégie : option si contre-indication/intolérance aux aGLP-1 et iSGLT2
- **Effets secondaires** : rares (rhinopharyngite, céphalées, pancréatite : signal débattu mais non confirmé)
- **Combinaisons fixes** : sitagliptine + metformine (Janumet®), vildaglyptine + metformine (Eucreas®) → amélioration de l'observance

> [MEDIA: 🔬 MDIAB26-S03-001 — MÉCANISME iDPP-4 (DPP-4 dégrade GLP-1 → inhibition → ↑ GLP-1 → sécrétion insuline glucose-dépendante)]

> [MEDIA: 📋 MDIAB26-S03-002 — COMPARATIF GLIPTINES (molécule, posologie, ajustement rénal, CVOT, particularités)]

### Section 4 — Autres antidiabétiques oraux

**Contenu obligatoire :**

- **Pioglitazone** (Actos® 15-45 mg/j) : thiazolidinedione, agoniste PPARγ → ↑ sensibilité à l'insuline (adipocyte → redistribution graisse viscérale→SC, ↑ adiponectine) ; efficacité : ↓ HbA1c 0,5-1,4 % ; étude PROactive : réduction 16 % critère CV secondaire ; bénéfice dans la MASH ; ES : prise de poids (+3-5 kg), rétention hydrique (CI dans IC), fractures osseuses (femmes ménopausées), risque cancer de vessie (débattu, retiré en France en 2011) ; utilisée aux USA, Japon, certains pays
- **Inhibiteurs de l'alpha-glucosidase** (acarbose — Glucor® 50-100 mg × 3, miglitol) : ralentissent la digestion des glucides complexes → ↓ glycémie post-prandiale ; efficacité modeste (↓ HbA1c 0,5-0,8 %) ; ES : flatulences, ballonnements (30-50 %) → mauvaise tolérance → usage limité ; étude STOP-NIDDM : prévention DT2 chez les prédiabétiques
- **Place dans la stratégie** : pioglitazone = niche (MASH, intolérance autres ADO) ; acarbose = peu utilisé en Europe/USA, encore prescrit en Asie

> [MEDIA: 📋 MDIAB26-S04-001 — TABLEAU RÉCAPITULATIF TOUS ADO (classe, mécanisme, ↓ HbA1c, risque hypo, effet poids, bénéfice CV, CI principales)]

## Points clés — Module 26

> 🎯 **Essentiel à retenir**
> 1. Metformine : 1ère intention incontestée, ↓ HbA1c 1-1,5 %, pas d'hypo, seul ADO avec réduction mortalité (UKPDS)
> 2. Titration progressive (500 mg/sem), LP si intolérance GI, arrêt si DFG < 30
> 3. Doser B12 annuellement sous metformine prolongée
> 4. Sulfonylurées : ↓ HbA1c 1-1,5 %, mais risque d'hypoglycémie et prise de poids ; gliclazide préféré
> 5. iDPP-4 : ↓ HbA1c 0,5-0,8 %, pas d'hypo, poids neutre, sécurité CV mais pas de bénéfice CV
> 6. Linagliptine : seul iDPP-4 sans ajustement rénal
> 7. Saxagliptine : précaution si IC (signal SAVOR)
> 8. Le choix de la 2e ligne n'est plus dicté par l'HbA1c mais par le profil cardio-rénal

## Auto-évaluation — Module 26

### QCM progressifs (10 questions)

**Q1 — 🥉 Bronze** : Quel est le mécanisme d'action principal de la metformine ?
A. Stimulation de la sécrétion d'insuline
B. Activation de l'AMPK → ↓ production hépatique de glucose
C. Inhibition de l'alpha-glucosidase
D. Blocage des canaux K-ATP
> ✅ **B** — La metformine active l'AMPK, réduisant la néoglucogenèse hépatique (principal mécanisme), augmentant la sensibilité musculaire et réduisant l'absorption intestinale du glucose. Elle ne stimule pas la sécrétion d'insuline → pas d'hypoglycémie en monothérapie.

**Q2 — 🥉 Bronze** : Pourquoi la metformine ne provoque-t-elle pas d'hypoglycémie en monothérapie ?
A. Car elle est dosée trop faiblement
B. Car elle n'agit pas sur la sécrétion d'insuline
C. Car elle n'est pas absorbée
D. Car elle augmente le glucagon
> ✅ **B** — La metformine est un insulino-sensibilisateur, pas un sécrétagogue. Elle ne stimule pas la sécrétion d'insuline → pas de risque d'hypoglycémie quand elle est utilisée seule.

**Q3 — 🥈 Argent** : Pourquoi le gliclazide est-il préféré aux autres sulfonylurées ?
A. Plus puissant
B. Métabolisme hépatique (pas de métabolites actifs rénaux), profil CV favorable (ADVANCE), moindre risque d'hypoglycémie vs glibenclamide
C. Moins cher
D. Prise unique par semaine
> ✅ **B** — Le gliclazide a un métabolisme hépatique sans métabolites actifs rénaux (utilisable prudemment en IRC modérée), un profil CV favorable dans ADVANCE, et un risque d'hypoglycémie moindre que le glibenclamide.

**Q4 — 🥈 Argent** : Quel iDPP-4 ne nécessite pas d'ajustement posologique en cas d'IRC ?
A. Sitagliptine
B. Vildagliptine
C. Linagliptine
D. Alogliptine
> ✅ **C** — La linagliptine (Trajenta®) a une élimination principalement biliaire → pas d'ajustement de dose nécessaire quel que soit le DFG. C'est son avantage principal par rapport aux autres gliptines.

**Q5 — 🥈 Argent** : L'UKPDS a montré un bénéfice unique de la metformine. Lequel ?
A. Meilleure baisse de l'HbA1c de tous les ADO
B. Seul ADO ayant démontré une réduction de la mortalité toutes causes dans le DT2 en surpoids
C. Prévention du DT2
D. Réduction des complications microvasculaires supérieure aux sulfonylurées
> ✅ **B** — L'UKPDS (1998) a montré que la metformine était le seul ADO à réduire significativement la mortalité toutes causes et les IDM chez les DT2 en surpoids, au-delà de son effet glycémique. Ce résultat a ancré la metformine comme 1ère intention.

**Q6 — 🥇 Or** : Quel signal de sécurité a été identifié avec la saxagliptine dans l'étude SAVOR-TIMI 53 ?
A. Risque de cancer du pancréas
B. Augmentation des hospitalisations pour insuffisance cardiaque
C. Risque d'AVC
D. Pancréatite aiguë
> ✅ **B** — SAVOR-TIMI 53 a montré une augmentation significative des hospitalisations pour IC avec la saxagliptine (HR 1,27, IC 1,07-1,51). Ce signal n'a pas été retrouvé avec les autres iDPP-4 mais justifie la prudence chez les patients à risque d'IC.

**Q7 — 💎 Diamant** : Un patient DT2 de 65 ans, DFG 28 mL/min, sous metformine 2 g/j + gliclazide 60 mg. HbA1c 8,5 %. Que modifiez-vous ?
> ✅ (1) **Arrêt metformine** (DFG < 30 → CI) ; (2) **Prudence gliclazide** : réduction posologique ou relais ; (3) Introduction **iSGLT2** (empagliflozine ou dapagliflozine — initiation possible jusqu'à DFG 20, bénéfice néphroprotecteur ++, CREDENCE/DAPA-CKD) ; (4) Si HbA1c encore élevée : **linagliptine** (pas d'ajustement rénal) ou **agoniste GLP-1** (sémaglutide/dulaglutide — pas d'ajustement, bénéfice rénal FLOW) ; (5) Surveiller : adapter les doses d'insuline si nécessaire (clairance réduite → risque hypo) ; (6) Adresser au néphrologue (DFG < 30).

### Cas clinique intégré — Module 26

> 📝 **Cas clinique : M. B., 52 ans, DT2 découvert il y a 6 mois**
>
> M. B. sous metformine 2 g/j bien tolérée. HbA1c à 6 mois : 7,6 % (initiale 8,3 %). IMC 27. PA 128/78. LDL-c 0,85 g/L sous rosuvastatine. Pas de complication micro/macrovasculaire. DFG 88 mL/min. RAC < 30 mg/g. ECG normal.
>
> **Questions :**
> 1. L'HbA1c est-elle à l'objectif ? Quelle est la cible pour ce patient ?
> 2. Faut-il ajouter un 2e antidiabétique ? Si oui, quel profil cardio-rénal oriente le choix ?
> 3. Comparez les options : iDPP-4 vs iSGLT2 vs aGLP-1 pour ce patient sans complication.
> 4. Si vous choisissez une gliptine, laquelle et pourquoi ?
> 5. Quand réévaluer et quels critères pour changer de stratégie ?

---

# MODULE 27 : TRAITEMENTS INJECTABLES NON INSULINIQUES — AGONISTES GLP-1 ET DOUBLE/TRIPLE AGONISTES

**Partie** : VIII — Traitement du DT2
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 3, 6, 26

## Accroche clinique

> 🏥 **Mise en situation** : M. F., 56 ans, DT2 depuis 8 ans, IMC 38, HbA1c 8,9 % sous metformine 2 g/j + empagliflozine 10 mg. Antécédent d'IDM il y a 2 ans. DFG 65 mL/min. Il aimerait « perdre du poids en même temps que traiter le diabète ». Son médecin lui propose le sémaglutide 1 mg/semaine. *Les agonistes du GLP-1 ont révolutionné le traitement du DT2 en combinant efficacité glycémique, perte de poids et protection cardiovasculaire — et les double/triple agonistes promettent d'aller encore plus loin.*

## Objectifs d'apprentissage

1. **Comprendre** le mécanisme d'action des agonistes GLP-1 : effet incrétin, ralentissement vidange gastrique, satiété centrale
2. **Prescrire** les différents agonistes GLP-1 : sémaglutide, liraglutide, dulaglutide, exénatide
3. **Connaître** les résultats des CVOT et les indications cardio-réno-métaboliques
4. **Comprendre** le tirzépatide (double agoniste GIP/GLP-1) et les triple agonistes
5. **Gérer** les effets secondaires et les précautions d'emploi

## Structure du contenu

### Section 1 — Pharmacologie des agonistes GLP-1

**Contenu obligatoire :**

- **Mécanisme d'action** (effet pléiotrope) :
  - **Pancréas** : sécrétion insuline glucose-dépendante ↑ (pas d'hypo en monothérapie), suppression glucagon ↓
  - **Estomac** : ralentissement vidange gastrique → ↓ pic glycémique post-prandial, satiété précoce
  - **Cerveau** : action sur l'hypothalamus (noyaux arqué et paraventriculaire) → ↓ appétit, ↓ prise alimentaire, ↓ « food noise » (pensées obsédantes liées à la nourriture)
  - **Foie** : ↓ stéatose, ↓ inflammation (données MASH)
  - **Cœur et vaisseaux** : effets anti-inflammatoires, anti-athérosclérotiques, ↓ PA (−2-4 mmHg)
- **Molécules disponibles** :
  - **Exénatide** (Byetta® BID, Bydureon® hebdo) : basé sur l'exendine-4 (monstre de Gila) ; le 1er aGLP-1 commercialisé ; ↓ HbA1c 0,8-1,5 %, perte de poids 2-4 kg
  - **Liraglutide** (Victoza® 1,2-1,8 mg/j ; Saxenda® 3 mg/j = indication obésité) : analogue GLP-1 97 % homologie ; ↓ HbA1c 1-1,5 %, perte de poids 3-5 kg ; CVOT : LEADER (↓ 22 % mortalité CV)
  - **Dulaglutide** (Trulicity® 0,75-4,5 mg/sem) : fusion GLP-1 + Fc IgG4 → longue durée ; ↓ HbA1c 1-1,5 %, perte de poids 3-5 kg ; CVOT : REWIND (↓ 12 % MACE, inclus 69 % prévention primaire)
  - **Sémaglutide SC** (Ozempic® 0,25-0,5-1-2 mg/sem) : le plus puissant ; ↓ HbA1c 1,5-1,8 %, perte de poids 5-7 kg (dose 1 mg) à 6-10 kg (dose 2 mg) ; CVOT : SUSTAIN-6 (↓ 26 % MACE), SELECT (↓ 20 % MACE chez les obèses non DT2 — Lincoff et al., N Engl J Med, 2023)
  - **Sémaglutide oral** (Rybelsus® 3-7-14 mg/j) : formulation orale avec SNAC (sodium N-[8-(2-hydroxybenzoyl) amino] caprylate) → absorption gastrique ; prise à jeun avec ≤ 120 mL d'eau, 30 min avant tout aliment/boisson ; ↓ HbA1c 1-1,4 % ; CVOT : PIONEER 6 (non-infériorité CV)
  - **Sémaglutide SC haute dose** (Wegovy® 2,4 mg/sem = indication obésité) : perte de poids 15-17 % (STEP 1 — Wilding et al., N Engl J Med, 2021) ; SELECT : bénéfice CV chez les obèses sans DT2
- **Effets secondaires** :
  - GI : nausées (15-20 %, surtout en titration), vomissements, diarrhée → titration progressive obligatoire
  - Pancréatite : signal préclinique, non confirmé dans les essais randomisés ; prudence si ATCD de pancréatite
  - Lithiase biliaire : risque accru (perte de poids rapide)
  - Rétinopathie : signal avec sémaglutide dans SUSTAIN-6 (aggravation RD) → probablement « early worsening » lié à l'amélioration glycémique rapide → surveillance ophtalmologique si RD préexistante
  - Tumeurs thyroïdiennes : risque théorique de carcinome médullaire thyroïdien (CMT) chez le rongeur → CI si ATCD personnel ou familial de CMT ou NEM2

> [MEDIA: 🔬 MDIAB27-S01-001 — MÉCANISME D'ACTION PLÉIOTROPE aGLP-1 (effets pancréatiques + gastriques + centraux + hépatiques + CV)]

> [MEDIA: 📊 MDIAB27-S01-002 — COMPARATIF aGLP-1 (molécule, fréquence, ↓ HbA1c, perte de poids, CVOT, ES, posologie)]

> [MEDIA: 📊 MDIAB27-S01-003 — FOREST PLOT CVOT aGLP-1 (LEADER, SUSTAIN-6, REWIND, PIONEER 6, SELECT — MACE, mortalité CV)]

### Section 2 — Tirzépatide et double/triple agonistes

**Contenu obligatoire :**

- **Tirzépatide** (Mounjaro® 2,5-5-7,5-10-12,5-15 mg/sem) — double agoniste GIP/GLP-1 :
  - Mécanisme : activation simultanée des récepteurs GIP et GLP-1 → effet incrétin synergique + effet central sur l'appétit supérieur aux mono-agonistes GLP-1
  - Efficacité : études SURPASS → ↓ HbA1c 2,0-2,4 % (SURPASS-2 : tirzépatide 15 mg > sémaglutide 1 mg — Del Prato et al., N Engl J Med, 2021), perte de poids 12-15 % à la dose maximale
  - Indication obésité : Zepbound® ; SURMOUNT-1 : perte de poids −20,9 % avec 15 mg (Jastreboff et al., N Engl J Med, 2022)
  - CVOT en cours : SURPASS-CVOT → résultats attendus 2025-2026
  - ES : similaires aux aGLP-1 (nausées, diarrhée) ; titration progressive indispensable
- **Sémaglutide haute dose (doses futures)** : doses > 2 mg en développement pour optimiser la perte de poids et les effets métaboliques
- **Triple agonistes (GLP-1/GIP/glucagon)** :
  - Rétaporsen (LY3437943) — triple agoniste en développement (Eli Lilly) : activation GLP-1 + GIP + récepteur du glucagon → perte de poids supérieure (thermogenèse par glucagon ↑), amélioration MASH (glucagon → ↓ lipogenèse hépatique) ; résultats phase 2 prometteurs (perte de poids > 20 %)
  - Survodutide (BI 456906) : double agoniste GLP-1/glucagon (Boehringer) → données MASH (↓ stéatose, ↓ fibrose)
- **Agonistes combinés à l'amyline** : cagrilintide + sémaglutide (CagriSema) → combinaison amyline + GLP-1 → perte de poids et contrôle glycémique supérieurs au sémaglutide seul (études REDEFINE)

> [MEDIA: 📊 MDIAB27-S02-001 — SURPASS-2 : TIRZÉPATIDE vs SÉMAGLUTIDE (↓ HbA1c et perte de poids par dose — head-to-head)]

> [MEDIA: 🔬 MDIAB27-S02-002 — SCHÉMA TRIPLE AGONISME GLP-1/GIP/GLUCAGON (effets de chaque récepteur + synergie)]

> [MEDIA: 📊 MDIAB27-S02-003 — TIMELINE DÉVELOPPEMENT AGONISTES (exénatide 2005 → liraglutide 2010 → sémaglutide 2017 → tirzépatide 2022 → triple agonistes 2025+)]

### Section 3 — Inhibiteurs du SGLT2 (rappel orienté traitement)

**Contenu obligatoire :**

- **Mécanisme** : inhibition du cotransporteur SGLT2 (tubule proximal) → glycosurie → ↓ glycémie (indépendant de l'insuline), perte calorique 200-300 kcal/j → perte de poids, natriurèse/diurèse osmotique → ↓ PA
- **Molécules** :
  - Empagliflozine (Jardiance® 10-25 mg/j) — EMPA-REG OUTCOME, EMPEROR
  - Dapagliflozine (Forxiga® 10 mg/j) — DECLARE, DAPA-HF, DAPA-CKD
  - Canagliflozine (Invokana® 100-300 mg/j) — CANVAS, CREDENCE ; signal amputation CANVAS (non confirmé)
  - Ertugliflozine (Steglatro® 5-15 mg/j) — VERTIS CV (non-infériorité CV, pas de supériorité)
- **Efficacité** : ↓ HbA1c 0,5-1 %, perte de poids 2-4 kg, ↓ PAS 3-5 mmHg
- **Bénéfices prouvés au-delà du glucose** : cardioprotection (↓ mortalité CV, ↓ hospitalisation IC), néphroprotection (↓ progression MRC), IC (ICFEr ET ICFEp)
- **ES** :
  - Infections génitales mycosiques (10-15 % — candidose vulvovaginale/balanite → hygiène, traitement antifungique local)
  - Infections urinaires (modeste augmentation)
  - Acidocétose euglycémique (rare, < 0,1 % ; favorisée par : jeûne, chirurgie, alcool, régime cétogène, réduction insuline → ATTENTION aux DT1 ou LADA non diagnostiqué sous iSGLT2)
  - Gangrène de Fournier (exceptionnel, signal FDA)
  - Hypotension orthostatique (diurèse osmotique → sujet âgé, diurétiques associés)
  - Amputation (signal CANVAS avec canagliflozine → non confirmé avec les autres molécules)
- **CI** : DFG < 20 (pas d'initiation), DT1 (hors AMM), hypersensibilité

> [MEDIA: 📋 MDIAB27-S03-001 — TABLEAU iSGLT2 (molécule, posologie, CVOT, bénéfice CV/rénal/IC, ES principaux)]

## Points clés — Module 27

> 🎯 **Essentiel à retenir**
> 1. Agonistes GLP-1 : triple action (insuline ↑, glucagon ↓, appétit ↓) → ↓ HbA1c + perte de poids + protection CV
> 2. Sémaglutide 1 mg : ↓ HbA1c 1,5-1,8 %, perte de poids 5-7 kg, ↓ MACE 26 % (SUSTAIN-6)
> 3. SELECT : bénéfice CV du sémaglutide chez les obèses SANS DT2
> 4. Tirzépatide (double agoniste GIP/GLP-1) : ↓ HbA1c > 2 %, perte de poids 12-15 % → supérieur au sémaglutide (SURPASS-2)
> 5. Triple agonistes (GLP-1/GIP/glucagon) : perte de poids > 20 %, bénéfice MASH → en développement
> 6. CagriSema (amyline + GLP-1) : combinaison prometteuse
> 7. iSGLT2 : bénéfice triple (CV + rénal + IC), indépendant de l'HbA1c
> 8. Acidocétose euglycémique sous iSGLT2 : rare mais grave → attention si jeûne, chirurgie, LADA méconnu
> 9. Titration progressive obligatoire pour les aGLP-1 (tolérance GI)
> 10. CI aGLP-1 : ATCD CMT ou NEM2

## Auto-évaluation — Module 27

### QCM progressifs (10 questions)

**Q1 — 🥉 Bronze** : Quel est le mécanisme central de la perte de poids sous agoniste GLP-1 ?
A. Malabsorption intestinale
B. Action hypothalamique → ↓ appétit et prise alimentaire
C. Augmentation du métabolisme de base
D. Lipolyse directe
> ✅ **B** — Les aGLP-1 agissent sur les noyaux hypothalamiques (arqué, paraventriculaire) pour réduire l'appétit et la prise alimentaire. Ils ralentissent aussi la vidange gastrique (satiété précoce).

**Q2 — 🥉 Bronze** : Pourquoi les agonistes GLP-1 ne provoquent-ils pas d'hypoglycémie en monothérapie ?
A. Ils ne stimulent pas l'insuline
B. Leur effet insulino-sécréteur est glucose-dépendant
C. Ils augmentent le glucagon
D. Ils bloquent l'absorption du glucose
> ✅ **B** — L'effet incrétin des aGLP-1 est glucose-dépendant : la sécrétion d'insuline stimulée et la suppression du glucagon s'arrêtent quand la glycémie baisse, évitant l'hypoglycémie.

**Q3 — 🥈 Argent** : Dans l'étude SURPASS-2, quel résultat a été observé en comparant tirzépatide 15 mg et sémaglutide 1 mg ?
A. Sémaglutide supérieur sur tous les critères
B. Tirzépatide supérieur sur la baisse d'HbA1c ET la perte de poids
C. Pas de différence significative
D. Tirzépatide inférieur
> ✅ **B** — SURPASS-2 est le premier essai head-to-head : le tirzépatide 15 mg est supérieur au sémaglutide 1 mg pour la baisse d'HbA1c (−2,37 % vs −1,86 %) et la perte de poids (−11,2 kg vs −5,7 kg).

**Q4 — 🥈 Argent** : Quelle contre-indication absolue est commune à tous les agonistes GLP-1 ?
A. Insuffisance rénale
B. Antécédent personnel ou familial de carcinome médullaire thyroïdien ou NEM2
C. Obésité
D. HTA
> ✅ **B** — Tous les aGLP-1 sont contre-indiqués si ATCD de CMT ou NEM2, en raison du risque théorique de tumeurs thyroïdiennes C observé chez les rongeurs (effet pharmacologique exagéré sur les récepteurs GLP-1 thyroïdiens du rongeur, non reproduit chez l'humain).

**Q5 — 🥇 Or** : L'étude SELECT a montré quel résultat inédit du sémaglutide ?
A. Bénéfice CV uniquement chez les DT2
B. Réduction de 20 % des MACE chez les obèses/surpoids SANS DT2
C. Aggravation du risque CV
D. Aucun effet significatif
> ✅ **B** — SELECT (Lincoff et al., 2023) a montré pour la 1ère fois un bénéfice CV d'un aGLP-1 chez des patients obèses/surpoids avec MCV établie SANS DT2 (réduction 20 % MACE). Résultat historique élargissant les indications au-delà du diabète.

**Q6 — 🥇 Or** : Qu'est-ce que l'acidocétose euglycémique sous iSGLT2 et comment la prévenir ?
A. Cétose avec hyperglycémie > 3 g/L, fréquente et bénigne
B. ACD avec glycémie normale ou peu élevée (< 2,50 g/L), rare mais grave ; favorisée par jeûne, chirurgie, alcool, régime cétogène ; prévention : arrêt iSGLT2 3 jours avant chirurgie programmée, éviter le jeûne prolongé
C. Acidose lactique, sans rapport avec les cétones
D. Complication uniquement du DT1
> ✅ **B** — L'ACD euglycémique sous iSGLT2 est un piège diagnostique : glycémie < 2,50 g/L mais cétones élevées (le diagnostic est retardé car « la glycémie est normale »). Prévention : arrêt 3 jours avant chirurgie, éviter jeûne prolongé, attention aux LADA méconnus.

**Q7 — 💎 Diamant** : M. F. (accroche) : DT2, IMC 38, IDM ancien, sous metformine + empagliflozine. Vous ajoutez sémaglutide 1 mg/sem. Quel bénéfice global attendez-vous ?
> ✅ Bénéfice multidimensionnel : (1) **Glycémique** : ↓ HbA1c 1,5 % supplémentaire (de 8,9 → cible ~7,4 %) ; (2) **Pondéral** : perte de poids 5-7 kg (voire plus si dose augmentée à 2 mg) ; (3) **CV** : réduction 22-26 % MACE (LEADER/SUSTAIN-6) — bénéfice additionnel à l'empagliflozine qui protège surtout contre l'IC, le sémaglutide protège contre les événements athérosclérotiques ; (4) **Hépatique** : amélioration potentielle MASLD (probable chez ce patient obèse) ; (5) **Rénal** : bénéfice émergent (FLOW). Triple protection : metformine (base) + empagliflozine (IC + rénal) + sémaglutide (athérosclérose + poids).

### Cas clinique intégré — Module 27

> 📝 **Cas clinique : Mme R., 50 ans, DT2 depuis 5 ans**
>
> Mme R., DT2 sous metformine 2 g/j. HbA1c : 8,7 %. IMC : 42. PA : 135/85 sous amlodipine. LDL-c : 0,65 sous atorvastatine 40 mg. DFG 92 mL/min. RAC < 30. Pas d'ATCD CV. FO normal. Elle veut « perdre du poids et ne pas avoir à se piquer ».
>
> **Questions :**
> 1. Quelles options thérapeutiques combinent efficacité glycémique ET perte de poids significative ?
> 2. Sémaglutide oral vs sémaglutide SC : comparez pour cette patiente.
> 3. Tirzépatide vs sémaglutide SC : quel choix et pourquoi ?
> 4. Discutez l'indication de la chirurgie bariatrique chez cette patiente.
> 5. Comment titrez-vous le sémaglutide SC pour minimiser les effets GI ?

---

# MODULE 28 : INSULINOTHÉRAPIE DU DT2 — INITIATION, SCHÉMAS, INTENSIFICATION

**Partie** : VIII — Traitement du DT2
**Durée estimée** : 2h30
**Niveau** : Intermédiaire
**Prérequis** : Modules 22, 26-27

## Accroche clinique

> 🏥 **Mise en situation** : M. P., 64 ans, DT2 depuis 16 ans, sous metformine 2 g/j + empagliflozine + sémaglutide 1 mg/sem. HbA1c : 9,1 %. IMC : 28. Pas de complication rénale. Son médecin lui dit qu'il faut « passer à l'insuline ». Le patient est anxieux : « L'insuline, c'est la fin, non ? Ça veut dire que mon diabète s'est aggravé ? » *L'initiation de l'insuline dans le DT2 est souvent retardée par « l'inertie thérapeutique » et la peur du patient — alors qu'elle est une étape naturelle de la progression de la maladie.*

## Objectifs d'apprentissage

1. **Identifier** les indications de l'insulinothérapie dans le DT2
2. **Choisir** le schéma d'initiation adapté : basale seule, basale + aGLP-1, premix, basal-bolus
3. **Titrer** l'insuline basale selon les algorithmes (FPG-driven)
4. **Accompagner** le patient dans l'acceptation et l'éducation à l'insuline
5. **Connaître** l'insuline icodec hebdomadaire dans le DT2

## Structure du contenu

### Section 1 — Indications et levée des freins

**Contenu obligatoire :**

- **Indications de l'insuline dans le DT2** :
  - HbA1c très élevée (> 10 %) au diagnostic avec symptômes d'insulinopénie (amaigrissement, cétose) → insuline d'emblée (temporaire le plus souvent)
  - Échec de la trithérapie orale/injectable optimisée → insuline basale
  - Contre-indications ou intolérance aux ADO
  - Situations transitoires : corticothérapie, infection sévère, chirurgie, grossesse
  - Diabète « en fin de course β-cellulaire » : déclin progressif de la fonction β-cellulaire (UKPDS : ~50 % des DT2 nécessitent l'insuline après 10 ans)
- **Inertie thérapeutique** : retard moyen de 3-7 ans entre l'indication et l'initiation de l'insuline (Khunti et al., Diabetes Care, 2013) ; causes : médecin (complexité, temps, crainte hypo), patient (peur des injections, stigmatisation, « échec »)
- **Lever les freins** : dédramatiser (« l'insuline n'est pas une punition mais une aide naturelle »), rassurer (aiguilles 4 mm quasi indolores), montrer les dispositifs (stylos modernes, injection simple), expliquer la progression naturelle du DT2

### Section 2 — Schémas d'insulinothérapie du DT2

**Contenu obligatoire :**

- **Insuline basale seule (BOT — Basal Oral/Other Therapy)** : 1ère étape habituelle
  - Maintenir les ADO (metformine ++ et iSGLT2/aGLP-1 si bénéfice CV/rénal)
  - Insuline basale au coucher (ou au matin selon les préférences) : dégludec, glargine U100/U300
  - Dose initiale : 10 UI/j ou 0,1-0,2 UI/kg/j
  - Titration : augmentation de 2 UI tous les 3 jours jusqu'à glycémie à jeun 0,80-1,30 g/L (algorithme « Treat to Target » — Riddle et al., Diabetes Care, 2003)
  - Avantages : 1 injection/j, association aGLP-1 possible (complémentarité basale-prandiale)
- **Association fixe basale + aGLP-1** :
  - iDegLira (Xultophy® : dégludec + liraglutide) : titration simple (16-50 doses-step/j), ↓ HbA1c 1,8 % avec perte de poids et peu d'hypos
  - iGlarLixi (Soliqua® : glargine + lixisénatide) : option similaire
  - Avantage : simplification (1 injection, 1 stylo), complémentarité des mécanismes (basale = jeun, aGLP-1 = post-prandial + poids)
- **Insulines prémixes** (mélanges fixes rapide/basale) : prémix 25/75 (lispro/lispro protamine), 30/70 (aspart/aspart protamine), 50/50 ; 1-2 injections/j ; moins de flexibilité mais plus simple si patient non éduqué au comptage ; utilisées dans certains contextes (pays en développement, personnes âgées)
- **Schéma basal-bolus** : intensification si insuline basale + ADO insuffisants → ajout bolus prandial au repas le plus hyperglycémiant (basal-plus) → puis 2-3 bolus (basal-bolus complet) ; dose de bolus : 4 UI ou 10 % de la basale au repas principal
- **Insuline icodec hebdomadaire** : ONWARDS 1-6 → non-infériorité vs basale quotidienne ; avantages : 1 injection/semaine → observance ↑, charge réduite ; précautions : titration plus lente, risque d'hypo plus prolongée ; indiquée surtout dans le DT2 (études DT1 en cours)

> [MEDIA: 📋 MDIAB28-S02-001 — ALGORITHME INITIATION INSULINE DT2 (basale seule → basale + aGLP-1 → basale-plus → basal-bolus — critères de passage)]

> [MEDIA: 📊 MDIAB28-S02-002 — PROTOCOLE TITRATION BASALE « TREAT TO TARGET » (dose initiale, augmentation, cible glycémie à jeun)]

> [MEDIA: 📋 MDIAB28-S02-003 — COMPARATIF ASSOCIATIONS FIXES BASALE + aGLP-1 (iDegLira vs iGlarLixi — composants, posologie, titration, résultats)]

### Section 3 — Gestion pratique et éducation

**Contenu obligatoire :**

- **Auto-titration par le patient** : protocole simple (ex. : « augmentez de 2 UI si glycémie à jeun > 1,30 g/L pendant 3 jours consécutifs ») → autonomisation → résultats comparables à la titration médicale
- **Arrêt ou réduction des sécrétagogues** : arrêter les sulfonylurées lors de l'initiation de l'insuline basale (risque hypo additif), maintenir metformine + iSGLT2 + aGLP-1
- **Surveillance** : glycémie à jeun quotidienne pendant la titration, puis selon schéma ; HbA1c tous les 3 mois ; adaptation si hypos, maladie intercurrente
- **Prise de poids sous insuline** : mécanisme (anabolisme + correction glucosurie → rétention calorique) ; prévention : association avec aGLP-1 ou iSGLT2 (compensent le gain pondéral)
- **Passage à l'insuline icodec** : calcul de la dose hebdomadaire (dose quotidienne × 7), titration tous les 7 jours, attention au risque hypo si ajustement trop rapide

## Points clés — Module 28

> 🎯 **Essentiel à retenir**
> 1. ~50 % des DT2 nécessitent l'insuline après 10 ans (progression naturelle)
> 2. L'inertie thérapeutique retarde l'insuline de 3-7 ans → impact pronostique négatif
> 3. BOT (basale + ADO) : schéma de départ, dose initiale 10 UI ou 0,1-0,2 UI/kg/j
> 4. Titration « Treat to Target » : +2 UI tous les 3 jours jusqu'à glycémie à jeun 0,80-1,30 g/L
> 5. Maintenir metformine + iSGLT2 + aGLP-1, ARRÊTER les sulfonylurées
> 6. Associations fixes (iDegLira, iGlarLixi) : 1 injection/j, complémentarité basale + incrétin
> 7. Icodec (1 injection/semaine) : simplification majeure dans le DT2
> 8. Lever les freins : dédramatiser, éducation technique, stylos modernes, aiguilles 4 mm

## Auto-évaluation — Module 28

### QCM progressifs (8 questions)

**Q1 — 🥉 Bronze** : Quelle est la dose initiale habituelle d'insuline basale dans le DT2 ?
A. 0,5 UI/kg/j
B. 10 UI/j ou 0,1-0,2 UI/kg/j
C. 50 UI/j
D. 1 UI/kg/j
> ✅ **B** — La dose initiale est de 10 UI/j ou 0,1-0,2 UI/kg/j, avec titration progressive selon la glycémie à jeun.

**Q2 — 🥉 Bronze** : Faut-il arrêter la metformine quand on démarre l'insuline basale dans le DT2 ?
A. Oui, toujours
B. Non, la maintenir (sauf CI) — et maintenir aussi iSGLT2 et aGLP-1
C. Oui, pour éviter l'acidose lactique
D. La remplacer par une sulfonylurée
> ✅ **B** — Maintenir la metformine (effet complémentaire, pas de surrisque hypo), les iSGLT2 (bénéfice CV/rénal) et les aGLP-1 (bénéfice CV + poids). En revanche, ARRÊTER les sulfonylurées (risque hypo additif avec l'insuline).

**Q3 — 🥈 Argent** : Quel est le retard moyen entre l'indication et l'initiation de l'insuline dans le DT2 (inertie thérapeutique) ?
A. 3-6 mois
B. 3-7 ans
C. 1 mois
D. > 10 ans
> ✅ **B** — L'inertie thérapeutique retarde l'insuline de 3-7 ans en moyenne (Khunti et al., 2013), exposant le patient à des années d'hyperglycémie chronique avec accumulation de complications irréversibles.

**Q4 — 🥈 Argent** : Quel avantage de l'association fixe iDegLira (Xultophy®) ?
A. 3 injections par jour
B. 1 injection/j combinant basale (dégludec) + aGLP-1 (liraglutide) → ↓ HbA1c + perte de poids + peu d'hypos
C. Insuline seule à forte dose
D. Pas de titration nécessaire
> ✅ **B** — L'iDegLira combine dans 1 injection/j les avantages complémentaires du dégludec (couverture basale) et du liraglutide (couverture post-prandiale + perte de poids + peu d'hypos). La titration est simple (16-50 doses-step/j).

**Q5 — 🥇 Or** : Comment titrer l'insuline basale selon le protocole « Treat to Target » ?
A. Augmenter de 10 UI chaque semaine
B. Augmenter de 2 UI tous les 3 jours si glycémie à jeun > 1,30 g/L, jusqu'à cible 0,80-1,30 g/L
C. Doubler la dose chaque mois
D. Dose fixe sans modification
> ✅ **B** — Le protocole « Treat to Target » (Riddle, 2003) prévoit une augmentation progressive de 2 UI tous les 3 jours si la glycémie à jeun reste > 1,30 g/L. Le patient peut réaliser cette titration lui-même.

**Q6 — 💎 Diamant** : M. P. (accroche) passe sous dégludec 10 UI au coucher. Décrivez la stratégie complète d'initiation, titration et suivi.
> ✅ (1) **Initiation** : dégludec 10 UI au coucher (ou matin si préfère), maintenir metformine + empagliflozine + sémaglutide ; (2) **Éducation** : technique d'injection (aiguille 4 mm, rotation sites cuisse/abdomen), auto-surveillance glycémie à jeun quotidienne, resucrage si hypo ; (3) **Titration** : augmenter de 2 UI tous les 3 jours si GAJ > 1,30 g/L, réduire de 2 UI si GAJ < 0,70 g/L ; (4) **Suivi** : HbA1c à M3 → si ≥ 7 %, envisager basale-plus (ajout 1 bolus au repas principal) ; (5) **Psychologie** : rassurer (« l'insuline est une hormone naturelle que votre pancréas ne produit plus assez »), montrer la simplicité du stylo, impliquer le conjoint.

### Cas clinique intégré — Module 28

> 📝 **Cas clinique : Mme W., 70 ans, DT2 depuis 20 ans**
>
> Mme W. sous metformine 1,5 g/j + gliclazide 120 mg + sitagliptine 100 mg. HbA1c : 9,3 %. IMC : 26. DFG 52 mL/min. RAC 120 mg/g. RDNP modérée. Vit seule, IDE 1×/j pour HTAttt.
>
> **Questions :**
> 1. Quelles modifications thérapeutiques proposez-vous avant l'insuline ?
> 2. Si l'insuline est nécessaire, quel schéma d'initiation choisissez-vous pour cette patiente âgée vivant seule ?
> 3. Gliclazide : la maintenez-vous ou l'arrêtez-vous ? Justifiez.
> 4. L'insuline icodec serait-elle avantageuse ici ? Pourquoi ?
> 5. Quelle cible d'HbA1c fixez-vous et pourquoi ?

---

# MODULE 29 : STRATÉGIE THÉRAPEUTIQUE GLOBALE DU DT2 — ALGORITHMES ET PERSONNALISATION

**Partie** : VIII — Traitement du DT2
**Durée estimée** : 3h00
**Niveau** : Avancé
**Prérequis** : Modules 25-28

## Accroche clinique

> 🏥 **Mise en situation** : Vous revoyez 4 patients DT2 dans votre consultation de l'après-midi : (1) M. X., 45 ans, IMC 38, DT2 récent, pas de complication ; (2) Mme Y., 62 ans, DT2 avec ICFEr (FEVG 30 %) ; (3) M. Z., 70 ans, DT2 avec DFG 25 mL/min ; (4) Mme W., 55 ans, DT2 avec coronaropathie. *La stratégie thérapeutique du DT2 en 2024-2025 n'est plus « centrée sur le glucose » mais « centrée sur le patient et ses organes cibles » — le même HbA1c chez ces 4 patients justifie des traitements fondamentalement différents.*

## Objectifs d'apprentissage

1. **Appliquer** l'algorithme thérapeutique ESC/EASD 2023 et ADA/EASD 2022 centré sur les organes cibles
2. **Personnaliser** les cibles glycémiques selon le profil patient
3. **Intégrer** les considérations cardio-réno-métaboliques dans le choix des traitements
4. **Gérer** la déprescription et la simplification thérapeutique
5. **Connaître** les algorithmes futurs intégrant les nouvelles classes

## Structure du contenu

### Section 1 — Changement de paradigme : du « glucocentrisme » au « cardio-réno-métabolisme »

**Contenu obligatoire :**

- **Évolution historique** : UKPDS (1998) → contrôle glycémique réduit complications micro ; ADVANCE/ACCORD/VADT (2008) → pas de bénéfice macro en contrôle intensif chez DT2 ancien ; EMPA-REG/LEADER (2015-2016) → bénéfice CV indépendant du glucose → changement de paradigme
- **Algorithme ESC/EASD 2023** (adapté de Marx et al., Eur Heart J, 2023) : le choix du traitement est guidé en 1er par le profil cardio-rénal, PAS par l'HbA1c :
  - **DT2 + MCVA établie** (coronaropathie, AVC, AOMI) → aGLP-1 à bénéfice CV prouvé (sémaglutide, liraglutide, dulaglutide) ± iSGLT2 → INDÉPENDAMMENT de l'HbA1c et de la metformine
  - **DT2 + IC** → iSGLT2 (empagliflozine ou dapagliflozine) → classe I → indépendamment de l'HbA1c
  - **DT2 + MRC** (DFG < 60 et/ou RAC > 30) → iSGLT2 + IEC/ARA2 + finérénone → aGLP-1 si besoin glycémique supplémentaire
  - **DT2 sans complication CV/rénale** → metformine 1ère intention, puis 2e ligne selon profil : poids (aGLP-1 ou tirzépatide), coût (iDPP-4, SU), risque hypo (iDPP-4, aGLP-1, iSGLT2)
- **Cibles glycémiques personnalisées** (ADA 2024) :
  - HbA1c < 7 % : cible standard (majorité des patients)
  - HbA1c < 6,5 % : DT2 récent, espérance de vie longue, sans complication, sans risque hypo
  - HbA1c < 8 % : patient âgé fragile, comorbidités sévères, espérance de vie limitée, hypoglycémies fréquentes
  - HbA1c < 8,5 % : patient très âgé, dépendant, fin de vie → priorité = confort, éviter les hypos

> [MEDIA: 📋 MDIAB29-S01-001 — ALGORITHME ESC/EASD 2023 (arbre décisionnel : MCVA → IC → MRC → sans complication — choix thérapeutique)]

> [MEDIA: 📋 MDIAB29-S01-002 — TABLEAU CIBLES HbA1c PERSONNALISÉES (profil patient, cible, justification)]

### Section 2 — Arbres décisionnels pratiques

**Contenu obligatoire :**

- **Arbre 1 — DT2 avec MCVA** : metformine + aGLP-1 (sémaglutide 1 mg ou liraglutide 1,8 mg) + iSGLT2 → si HbA1c pas à l'objectif → insuline basale → basal-bolus
- **Arbre 2 — DT2 avec IC** : iSGLT2 (classe I) + metformine → aGLP-1 si objectif glycémique non atteint → insuline si nécessaire ; ÉVITER : pioglitazone (rétention hydrique), saxagliptine (signal IC)
- **Arbre 3 — DT2 avec MRC** : iSGLT2 (dès DFG ≥ 20) + IEC/ARA2 (dès A2) + finérénone (si DFG ≥ 25, K+ < 5, RAC ≥ 30) → aGLP-1 si besoin glycémique → adaptation ADO au DFG (cf. module 17)
- **Arbre 4 — DT2 obèse sans complication** : metformine + aGLP-1 (sémaglutide) ou tirzépatide → iSGLT2 → si HbA1c élevée → insuline ; discuter chirurgie bariatrique si IMC ≥ 35 + échec médical
- **Arbre 5 — DT2 du sujet âgé** : simplification thérapeutique, éviter les hypos, cible HbA1c individualisée (< 8 % si fragile), déprescription si risque > bénéfice (arrêt SU si hypos, simplification schéma insulinique)
- **Déprescription** : quand et comment arrêter un traitement : critères (rémission du DT2 → DiRECT, post-bariatrique, surdosage relatif avec hypos → sujet âgé), progressivité, surveillance rapprochée

> [MEDIA: 📋 MDIAB29-S02-001 — ARBRES DÉCISIONNELS 4 PROFILS (MCVA, IC, MRC, obèse sans complication — algorithmes visuels)]

> [MEDIA: 📋 MDIAB29-S02-002 — CHECK-LIST ANNUELLE DT2 (examen clinique, bilan biologique, dépistage complications, ajustement traitement)]

### Section 3 — Perspectives et algorithmes futurs

**Contenu obligatoire :**

- **Intégration du tirzépatide** : position dans l'algorithme à mesure des résultats CVOT (SURPASS-CVOT attendu)
- **Triple agonistes** : potentiel de simplification thérapeutique (1 molécule couvrant glycémie + poids + MASH + CV)
- **Médecine de précision** : phénotypage du DT2 (clusters d'Ahlqvist — Lancet Diabetes Endocrinol, 2018) → 5 sous-types de diabète avec pronostic et réponse thérapeutique différents (SAID, SIDD, SIRD, MOD, MARD) → traitement personnalisé basé sur le cluster
- **Intelligence artificielle** : algorithmes de recommandation thérapeutique basés sur les données patient (profil clinique, biologique, génomique) → aide à la décision ; systèmes de titration automatisée (insuline basale)
- **Place de la rémission** : l'objectif de rémission du DT2 (HbA1c < 6,5 % sans traitement à 3 mois — consensus ADA 2021) doit être intégré dans la stratégie précoce (intervention pondérale intensive chez le DT2 récent)

> [MEDIA: 📊 MDIAB29-S03-001 — CLUSTERS D'AHLQVIST (5 sous-types DT2 — caractéristiques, pronostic, réponse thérapeutique)]

> [MEDIA: 🔮 MDIAB29-S03-002 — ALGORITHME FUTUR INTÉGRANT TIRZÉPATIDE ET TRIPLE AGONISTES (projection)]

## Points clés — Module 29

> 🎯 **Essentiel à retenir**
> 1. Le choix thérapeutique est guidé par le profil CARDIO-RÉNAL, pas seulement par l'HbA1c
> 2. MCVA → aGLP-1 à bénéfice CV + iSGLT2, indépendamment de l'HbA1c
> 3. IC → iSGLT2 (classe I ESC 2023), indépendamment du statut diabétique
> 4. MRC → iSGLT2 + IEC/ARA2 + finérénone (4 piliers KDIGO)
> 5. Obésité → aGLP-1 (sémaglutide) ou tirzépatide → chirurgie bariatrique si IMC ≥ 35 + échec
> 6. Cibles HbA1c personnalisées : < 7 % standard, < 6,5 % si jeune/récent, < 8 % si fragile/âgé
> 7. Déprescription chez le sujet âgé : simplifier, éviter les hypos, arrêter les SU si risque > bénéfice
> 8. Clusters d'Ahlqvist : 5 sous-types de DT2 → médecine de précision
> 9. Rémission possible si intervention précoce (DiRECT) → intégrer dans la stratégie

## Auto-évaluation — Module 29

### QCM progressifs (10 questions)

**Q1 — 🥉 Bronze** : Quel est le critère principal qui guide le choix thérapeutique dans le DT2 selon ESC/EASD 2023 ?
A. Le taux d'HbA1c
B. Le profil cardio-rénal du patient
C. Le coût du traitement
D. L'âge du patient
> ✅ **B** — L'algorithme ESC/EASD 2023 est centré sur les organes cibles : MCVA → aGLP-1, IC → iSGLT2, MRC → iSGLT2 + finérénone. Le choix est guidé par le profil cardio-rénal, indépendamment de l'HbA1c de départ.

**Q2 — 🥈 Argent** : Chez un DT2 avec ICFEr (FEVG 30 %), quel traitement est recommandé en priorité ?
A. Sulfonylurée
B. iSGLT2 (empagliflozine ou dapagliflozine)
C. Pioglitazone
D. Inhibiteur DPP-4 (saxagliptine)
> ✅ **B** — L'iSGLT2 est recommandé classe I (ESC 2023) dans l'ICFEr, indépendamment du statut diabétique. La pioglitazone est contre-indiquée (rétention hydrique) et la saxagliptine doit être évitée (signal IC dans SAVOR).

**Q3 — 🥈 Argent** : Quelle cible d'HbA1c fixez-vous chez un patient DT2 de 82 ans, fragile, avec comorbidités ?
A. < 6,5 %
B. < 7 %
C. < 8 %
D. < 9 %
> ✅ **C** — Chez un patient âgé fragile avec comorbidités, la cible est < 8 % (ADA 2024). La priorité est d'éviter les hypoglycémies et les effets secondaires. Une cible trop stricte augmenterait le risque d'hypos sans bénéfice prouvé sur les complications.

**Q4 — 🥇 Or** : Un DT2 de 55 ans avec coronaropathie (IDM ancien), HbA1c 6,8 % sous metformine seule. Faut-il ajouter un traitement ?
A. Non, l'HbA1c est à l'objectif
B. Oui, un aGLP-1 à bénéfice CV (sémaglutide ou liraglutide) + un iSGLT2, INDÉPENDAMMENT de l'HbA1c
C. Oui, une sulfonylurée
D. Oui, de l'insuline basale
> ✅ **B** — L'algorithme ESC/EASD 2023 recommande un aGLP-1 à bénéfice CV prouvé et/ou un iSGLT2 chez tout DT2 avec MCVA établie, INDÉPENDAMMENT de l'HbA1c. Le bénéfice CV est indépendant de l'effet glycémique.

**Q5 — 🥇 Or** : Que sont les clusters d'Ahlqvist et quel est leur intérêt ?
A. Des groupes de gènes du diabète
B. 5 sous-types de diabète (SAID, SIDD, SIRD, MOD, MARD) basés sur des variables cliniques, avec des pronostics et réponses thérapeutiques différents → médecine de précision
C. Des classifications anatomiques du pancréas
D. Des stades de sévérité de l'HbA1c
> ✅ **B** — Ahlqvist et al. (2018) ont identifié 5 clusters de diabète basés sur l'âge, l'IMC, l'HbA1c, le HOMA-B, le HOMA-IR et les auto-anticorps. Ex : SIRD (insulino-résistant sévère) a le plus haut risque rénal → iSGLT2 prioritaire. Cette approche ouvre la voie à la personnalisation thérapeutique.

**Q6 — 💎 Diamant** : Prescrivez l'ordonnance complète pour chacun des 4 patients de l'accroche clinique.
> ✅ **(1) M. X., 45 ans, IMC 38, DT2 récent, sans complication** : MHD intensives + metformine 2 g/j + sémaglutide 1 mg/sem (ou tirzépatide) pour perte de poids + contrôle glycémique ; discuter chirurgie bariatrique si perte insuffisante ; cible HbA1c < 6,5 %.
> **(2) Mme Y., 62 ans, ICFEr FEVG 30 %** : empagliflozine 10 mg (classe I) + metformine 2 g/j + agoniste GLP-1 si besoin glycémique ; sacubitril/valsartan, bêtabloquant, ARM (traitement IC) ; PAS de pioglitazone, PAS de saxagliptine ; cible HbA1c < 7 %.
> **(3) M. Z., 70 ans, DFG 25 mL/min** : dapagliflozine 10 mg (poursuite si déjà initié à DFG > 20, néphroprotection), IEC/ARA2, finérénone si K+ < 5 ; ARRÊT metformine (DFG < 30), linagliptine si besoin glycémique ; aGLP-1 (sémaglutide) si besoin ; adapter doses insuline ; adresser au néphrologue ; cible HbA1c < 8 %.
> **(4) Mme W., 55 ans, coronaropathie** : metformine + sémaglutide 1 mg/sem (LEADER/SUSTAIN-6) + empagliflozine 10 mg (EMPA-REG) ; statine forte dose + IEC ; cible HbA1c < 7 %, LDL < 0,55 g/L.

### Cas clinique intégré — Module 29

> 📝 **Cas clinique : Dr M., médecin généraliste, revoit ses 3 patients DT2 en fin de journée**
>
> **Patient 1** : M. L., 48 ans, DT2 depuis 2 ans, IMC 36, HbA1c 7,8 %, pas de complication, sous metformine 2 g/j seule.
> **Patient 2** : Mme C., 68 ans, DT2 depuis 15 ans, DFG 42, RAC 320 mg/g, HbA1c 8,1 %, sous metformine 1 g/j + gliclazide 60 mg.
> **Patient 3** : M. D., 75 ans, DT2 depuis 22 ans, ICFEp, HbA1c 7,2 %, sous metformine 2 g/j + sitagliptine 100 mg + glargine U100 16 UI.
>
> **Pour chaque patient :**
> 1. Identifiez le profil cardio-rénal.
> 2. Appliquez l'algorithme ESC/EASD 2023.
> 3. Proposez les modifications thérapeutiques.
> 4. Fixez la cible HbA1c personnalisée.
> 5. Planifiez le suivi.

### Question de synthèse

> 🔄 **Synthèse** : Construisez un algorithme décisionnel unique pour le traitement du DT2, intégrant les 5 profils de patients (MCVA, IC, MRC, obèse, sujet âgé), en indiquant pour chaque profil le traitement de 1ère, 2e et 3e ligne, les cibles glycémiques et les traitements à éviter.

---

## Références bibliographiques — Partie 8

1. Estruch R, Ros E, Salas-Salvadó J et al. (PREDIMED). « Primary prevention of cardiovascular disease with a Mediterranean diet supplemented with extra-virgin olive oil or nuts. » *N Engl J Med*, 2018; 378(25): e34.
2. Umpierre D, Ribeiro PA, Kramer CK et al. « Physical activity advice only or structured exercise training and association with HbA1c levels in type 2 diabetes. » *JAMA*, 2011; 305(17): 1790-1799.
3. Lean MEJ, Leslie WS, Barnes AC et al. (DiRECT). « Primary care-led weight management for remission of type 2 diabetes. » *Lancet*, 2018; 391(10120): 541-551.
4. Schauer PR, Bhatt DL, Kirwan JP et al. (STAMPEDE). « Bariatric surgery versus intensive medical therapy for diabetes — 5-year outcomes. » *N Engl J Med*, 2017; 376(7): 641-651.
5. Riddle MC, Rosenstock J, Gerich J (Treat to Target). « The treat-to-target trial: randomized addition of glargine or human NPH insulin to oral therapy. » *Diabetes Care*, 2003; 26(11): 3080-3086.
6. Del Prato S, Kahn SE, Pavo I et al. (SURPASS-2). « Tirzepatide versus semaglutide once weekly in patients with type 2 diabetes. » *N Engl J Med*, 2021; 385(6): 503-515.
7. Jastreboff AM, Aronne LJ, Ahmad NN et al. (SURMOUNT-1). « Tirzepatide once weekly for the treatment of obesity. » *N Engl J Med*, 2022; 387(3): 205-216.
8. Lincoff AM, Brown-Frandsen K, Colhoun HM et al. (SELECT). « Semaglutide and cardiovascular outcomes in obesity without diabetes. » *N Engl J Med*, 2023; 389(24): 2221-2232.
9. Wilding JPH, Batterham RL, Calanna S et al. (STEP 1). « Once-weekly semaglutide in adults with overweight or obesity. » *N Engl J Med*, 2021; 384(11): 989-1002.
10. Marx N, Federici M, Schütt K et al. « 2023 ESC Guidelines for the management of cardiovascular disease in patients with diabetes. » *Eur Heart J*, 2023; 44(39): 4043-4140.
11. Khunti K, Wolden ML, Thorsted BL et al. « Clinical inertia in people with type 2 diabetes. » *Diabetes Care*, 2013; 36(11): 3411-3417.
12. Ahlqvist E, Storm P, Käräjämäki A et al. « Novel subgroups of adult-onset diabetes and their association with outcomes. » *Lancet Diabetes Endocrinol*, 2018; 6(5): 361-369.
13. Malik VS, Popkin BM, Bray GA et al. « Sugar-sweetened beverages and risk of metabolic syndrome and type 2 diabetes. » *Diabetes Care*, 2010; 33(11): 2477-2483.

---

> 🔶 **DIABÉTOLOGIE** | Partie 8/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 9 — Situations Particulières (Modules 30-33)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 30 : DIABÈTE ET GROSSESSE — PRÉGESTATIONNEL ET GESTATIONNEL

**Partie** : IX — Situations particulières
**Durée estimée** : 3h30
**Niveau** : Avancé
**Prérequis** : Modules 8, 12-13, 16-17, 22

## Accroche clinique

> 🏥 **Mise en situation** : Mme E., 32 ans, DT1 depuis 14 ans, sous boucle fermée hybride (CamAPS FX). HbA1c : 7,4 %. Elle souhaite une grossesse. Fond d'œil : RDNP minime. DFG 95 mL/min. RAC < 30 mg/g. Pas de neuropathie. Son diabétologue lui explique que la programmation préconceptionnelle est « la consultation la plus importante de sa vie ». *Le diabète prégestationnel expose à des risques majeurs pour la mère et l'enfant — seule une préparation rigoureuse peut les minimiser.*

## Objectifs d'apprentissage

1. **Organiser** la programmation préconceptionnelle chez la femme DT1 et DT2
2. **Fixer** les objectifs glycémiques pendant la grossesse (HbA1c, TIR, cibles glycémiques)
3. **Adapter** l'insulinothérapie au cours de la grossesse (évolution des besoins)
4. **Dépister** et prendre en charge le diabète gestationnel (critères IADPSG)
5. **Connaître** les complications materno-fœtales et la surveillance obstétricale

## Structure du contenu

### Section 1 — Diabète prégestationnel (DT1 et DT2)

**Contenu obligatoire :**

- **Programmation préconceptionnelle** : consultation idéale ≥ 3-6 mois avant la conception :
  - Cible HbA1c < 6,5 % AVANT la conception (< 7 % acceptable si sans hypo sévère)
  - Acide folique 5 mg/j (dose élevée) dès la programmation jusqu'à 12 SA
  - Bilan complications : fond d'œil (RD → traiter avant grossesse si RDNP sévère/RDP), rein (RAC, DFG), neuropathie, ECG ± écho si FRCV
  - Médicaments tératogènes : ARRÊT IEC/ARA2 (risque malformatif rénal, oligohydramnios), statines (risque théorique), iSGLT2, aGLP-1, iDPP-4 ; remplacer par : antihypertenseurs autorisés (alpha-méthyldopa, labétalol, nifédipine)
  - Contraception efficace TANT QUE les objectifs ne sont pas atteints
- **Risques materno-fœtaux** du diabète prégestationnel :
  - Malformations congénitales : risque × 2-4 vs population générale (corrélé à l'HbA1c péri-conceptionnelle : < 6,5 % → risque similaire à la population générale ; > 10 % → risque × 10) ; types : cardiaques (CIV, transposition), neurales (spina bifida, anencéphalie), rénales, squelettiques ; syndrome de régression caudale (rare mais très spécifique)
  - Macrosomie : poids > 4000 g ou > 90e percentile ; hyperinsulinisme fœtal réactionnel à l'hyperglycémie maternelle → anabolisme excessif ; risque : dystocie des épaules, lésion du plexus brachial, césarienne
  - Hydramnios, prématurité, mort fœtale in utero (si diabète déséquilibré)
  - Mère : aggravation RD (early worsening si amélioration glycémique rapide → FO trimestriel), pré-éclampsie (risque × 4), césarienne
- **Objectifs glycémiques pendant la grossesse** (ADA 2024) :
  - GAJ : 0,60-0,95 g/L
  - Glycémie 1h post-prandiale : < 1,40 g/L
  - Glycémie 2h post-prandiale : < 1,20 g/L
  - HbA1c < 6 % si possible sans hypos (< 6,5 % acceptable)
  - CGM : TIR (63-140 mg/dL) ≥ 70 %, TBR (< 63 mg/dL) < 4 %
- **Adaptation insulinothérapie** :
  - T1 : besoins ↓ 10-20 % (nausées, hypos fréquentes) → vigilance hypoglycémies
  - T2 : besoins ↑ progressivement (hormones placentaires : HPL, progestérone, cortisol → insulinorésistance)
  - T3 : besoins × 2-3 vs pré-grossesse (pic à 35-36 SA)
  - Post-partum : chute brutale des besoins → ↓ immédiate des doses de 50 % → risque hypo
  - Boucle fermée CamAPS FX : validée pendant la grossesse (AiDAPT — Stewart et al., N Engl J Med, 2023)

> [MEDIA: 📊 MDIAB30-S01-001 — COURBE BESOINS INSULINIQUES PENDANT LA GROSSESSE (T1 ↓, T2 ↑ progressif, T3 pic, post-partum chute)]

> [MEDIA: 📋 MDIAB30-S01-002 — CHECK-LIST PROGRAMMATION PRÉCONCEPTIONNELLE (HbA1c, FO, rein, médicaments, acide folique, contraception)]

### Section 2 — Diabète gestationnel

**Contenu obligatoire :**

- **Définition** : trouble de la tolérance glucidique diagnostiqué pour la 1ère fois pendant la grossesse (excluant le diabète préexistant méconnu)
- **Dépistage** (stratégie IADPSG/OMS/ADA — adapté de Metzger et al., Diabetes Care, 2010) :
  - **En début de grossesse** (T1, si facteurs de risque) : GAJ ≥ 0,92 g/L → DG ; GAJ ≥ 1,26 g/L → DT2 préexistant méconnu
  - **À 24-28 SA** (systématique ou ciblé selon les pays) : HGPO 75 g (pas 100 g), dosage à T0, T1h, T2h ; seuils IADPSG : T0 ≥ 0,92 g/L OU T1h ≥ 1,80 g/L OU T2h ≥ 1,53 g/L → 1 seule valeur positive suffit
  - Facteurs de risque : âge > 35 ans, IMC ≥ 25, ATCD DG, ATCD familial DT2, macrosomie antérieure, origine ethnique à risque
  - Étude HAPO (Metzger et al., N Engl J Med, 2008) : relation continue entre glycémie maternelle et complications fœtales (macrosomie, hyperinsulinisme néonatal, césarienne, pré-éclampsie) → pas de seuil franc → seuils IADPSG définis par un OR ≥ 1,75
- **Prise en charge** :
  - MHD : 1ère intention (diététique adaptée + activité physique modérée 30 min/j) → suffisantes dans 70-85 % des cas
  - Objectifs : GAJ < 0,95 g/L, glycémie 2h post-prandiale < 1,20 g/L
  - Insuline : si objectifs non atteints après 1-2 semaines de MHD → insuline (rapide et/ou basale) ; metformine : alternative controversée (traverse le placenta → données de sécurité rassurantes à court terme — étude MiG, mais interrogations sur le développement à long terme de l'enfant)
  - Surveillance fœtale : échographies de croissance, Doppler ombilical/utérin si HTA, monitoring du RCF au T3
- **Post-partum** : arrêt de l'insuline immédiatement après l'accouchement ; reclassification à 6-12 semaines : HGPO 75 g → DT2 ? intolérance au glucose ? normalisation ? ; risque de DT2 à long terme : 50 % dans les 10-20 ans → dépistage annuel à vie (GAJ ou HbA1c), prévention (MHD, allaitement ≥ 6 mois — effet protecteur)

> [MEDIA: 📋 MDIAB30-S02-001 — ALGORITHME DÉPISTAGE DG (T1 : GAJ si FR → 24-28 SA : HGPO 75g → seuils IADPSG → PEC)]

> [MEDIA: 📊 MDIAB30-S02-002 — RÉSULTATS HAPO (relation continue glycémie maternelle → macrosomie, hyperinsulinisme, césarienne — courbes OR)]

## Points clés — Module 30

> 🎯 **Essentiel à retenir**
> 1. Programmation préconceptionnelle = consultation essentielle (HbA1c < 6,5 %, FO, rein, médicaments)
> 2. Acide folique 5 mg/j dès la programmation (dose élevée chez la diabétique)
> 3. ARRÊT IEC/ARA2, statines, iSGLT2, aGLP-1 AVANT conception
> 4. Besoins insuliniques : ↓ T1, ↑ T2-T3 (× 2-3), chute post-partum
> 5. CamAPS FX : seule boucle fermée validée pendant la grossesse (AiDAPT)
> 6. DG : HGPO 75 g à 24-28 SA, seuils IADPSG (0,92/1,80/1,53), 1 valeur suffit
> 7. DG : MHD d'abord (suffisantes 70-85 %), insuline si échec
> 8. Post-DG : risque DT2 50 % à 10-20 ans → dépistage annuel à vie

## Auto-évaluation — Module 30

### QCM progressifs (10 questions)

**Q1 — 🥉 Bronze** : Quelle cible d'HbA1c avant la conception chez une femme DT1 ?
A. < 8 %  B. < 7 %  C. < 6,5 %  D. < 5,5 %
> ✅ **C** — HbA1c < 6,5 % avant la conception réduit le risque de malformations congénitales à un niveau comparable à la population générale.

**Q2 — 🥈 Argent** : Quels médicaments doivent être arrêtés avant la grossesse chez une DT2 ?
A. Metformine et insuline  B. IEC/ARA2, statines, iSGLT2, aGLP-1  C. Tous les antidiabétiques  D. Uniquement l'aspirine
> ✅ **B** — IEC/ARA2 (tératogènes rénaux), statines (risque théorique), iSGLT2 et aGLP-1 (pas de données de sécurité suffisantes). La metformine et l'insuline sont autorisées.

**Q3 — 🥈 Argent** : Quels sont les seuils IADPSG pour le diagnostic de DG à l'HGPO 75 g ?
A. T0 ≥ 1,26, T2h ≥ 2,00  B. T0 ≥ 0,92, T1h ≥ 1,80, T2h ≥ 1,53  C. T0 ≥ 1,10, T2h ≥ 1,40  D. T0 ≥ 0,80, T2h ≥ 1,20
> ✅ **B** — Seuils IADPSG : GAJ ≥ 0,92 g/L OU 1h ≥ 1,80 g/L OU 2h ≥ 1,53 g/L. Une seule valeur anormale suffit pour le diagnostic.

**Q4 — 🥇 Or** : Comment évoluent les besoins insuliniques au cours de la grossesse chez une DT1 ?
A. Stables tout au long  B. ↓ T1 (hypos fréquentes), ↑ progressif T2-T3 (× 2-3 pic à 35-36 SA), chute brutale post-partum  C. ↑ uniquement au T1  D. ↓ progressive jusqu'à l'accouchement
> ✅ **B** — T1 : ↓ besoins 10-20 % (nausées, sensibilité accrue → hypos) ; T2-T3 : ↑ progressive (hormones placentaires → insulinorésistance, besoins × 2-3) ; post-partum : chute immédiate → ↓ doses de 50 %.

**Q5 — 🥇 Or** : Quel est le risque à long terme pour une femme ayant eu un DG ?
A. Aucun  B. 50 % de DT2 dans les 10-20 ans  C. 100 % de DT2 dans les 5 ans  D. 10 % de DT1
> ✅ **B** — Le DG est un marqueur de risque majeur de DT2 : 50 % des femmes développeront un DT2 dans les 10-20 ans. D'où le dépistage annuel à vie (GAJ ou HbA1c) et la prévention (MHD, allaitement).

**Q6 — 💎 Diamant** : Construisez le parcours de soins d'une femme DT1 de la programmation préconceptionnelle au post-partum.
> ✅ **Pré-conception** (≥ 3-6 mois) : HbA1c < 6,5 %, FO + bilan rénal + ECG, acide folique 5 mg, arrêt IEC/ARA2, contraception efficace. **T1** : ↓ basale 10-20 %, surveillance hypos, FO de référence, échographie datation. **T2** : ↑ progressive insuline, FO T2, dépistage pré-éclampsie (PA, albuminurie, Doppler utérin), aspirine 150 mg/j si risque (jusqu'à 36 SA), échographie morphologique + croissance. **T3** : ↑ majeure insuline (× 2-3), FO T3, monitoring fœtal rapproché, discussion accouchement (programmation si macrosomie, césarienne si complications). **Accouchement** : insuline IVSE pendant le travail, cible 0,70-1,10 g/L. **Post-partum** : ↓ doses 50 % immédiatement, allaitement encouragé, FO post-partum, reprise IEC si besoin, contraception.

---

# MODULE 31 : DIABÈTE ET CHIRURGIE — GESTION PÉRI-OPÉRATOIRE

**Partie** : IX — Situations particulières
**Durée estimée** : 2h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 14, 22, 28

## Accroche clinique

> 🏥 **Mise en situation** : M. T., 67 ans, DT2 sous insuline basale (glargine 28 UI) + metformine + empagliflozine, HbA1c 7,8 %, doit être opéré d'une prothèse totale de hanche dans 2 semaines. L'anesthésiste vous contacte : « Comment gère-t-on son traitement ? Quand arrête-t-on quoi ? »

## Objectifs d'apprentissage

1. **Évaluer** le risque péri-opératoire du patient diabétique
2. **Adapter** les traitements antidiabétiques en pré, per et post-opératoire
3. **Gérer** la glycémie péri-opératoire (cibles, protocole d'insuline IVSE)
4. **Prévenir** les complications : hypoglycémie, hyperglycémie, ACD, infection

## Structure du contenu

### Section 1 — Évaluation pré-opératoire et adaptation des traitements

**Contenu obligatoire :**

- **Évaluation** : HbA1c récente (si > 8,5-9 % → discuter report chirurgie élective), bilan cardio-rénal (dépistage IMS si FRCV), examen des pieds (prévention escarres), bilan infectieux
- **Adaptation des traitements** (adapté de recommandations SFAR/SFD 2019, NHS Diabetes 2023) :
  - **Metformine** : arrêt la veille au soir et le matin de l'intervention (risque acidose lactique si hypoperfusion) ; reprise dès reprise alimentaire et fonction rénale stable
  - **iSGLT2** : arrêt **3 jours** avant la chirurgie programmée (risque ACD euglycémique péri-opératoire) ; reprise dès alimentation normale et fonction rénale stable
  - **aGLP-1** : recommandation émergente de suspendre 1 semaine avant (risque de contenu gastrique résiduel → aspiration sous AG — données récentes ASA 2023, consensus en évolution) ; vérifier les recommandations locales
  - **Sulfonylurées** : arrêt le matin de l'intervention (risque hypo si jeûne)
  - **iDPP-4** : peuvent être maintenus (pas de risque hypo, pas de risque spécifique)
  - **Insuline basale** : maintenir à dose réduite (−20-30 %) la veille et le matin ; NE PAS arrêter totalement (risque ACD chez DT1, hyperglycémie sévère chez DT2)
  - **Insuline rapide** : arrêt si patient à jeun
- **Chirurgie en urgence** : pas de report possible → évaluation rapide (glycémie, cétonémie, ionogramme, gaz du sang), correction de l'hyperglycémie/ACD avant le bloc si possible

### Section 2 — Gestion per et post-opératoire

**Contenu obligatoire :**

- **Cibles glycémiques péri-opératoires** : 1,10-1,80 g/L (consensus NICE/ADA) ; éviter < 0,70 g/L et > 2,00 g/L
- **Protocole insuline IVSE** : pour les chirurgies majeures, DT1, ou hyperglycémie > 2,00 g/L → protocole standardisé avec titration horaire selon glycémie ; association systématique glucose IV (G5 % ou G10 %) si patient à jeun sous insuline IVSE
- **Chirurgie ambulatoire** : patient opéré en dernier sur le programme (maximiser le temps de jeûne le plus court), maintien basale −20 %, reprise des ADO dès alimentation orale
- **Retour en chambre** : glycémie horaire pendant 6h puis toutes les 4h ; reprise du schéma habituel dès alimentation normale ; attention aux corticoïdes (anti-inflammatoires, anti-émétiques → hyperglycémie)
- **Prévention des complications** : antibioprophylaxie standard, prévention TVP (HBPM), soins de pieds (positionnement, prévention escarres talonnières), reprise alimentation précoce

> [MEDIA: 📋 MDIAB31-S02-001 — TABLEAU GESTION PÉRI-OPÉRATOIRE DES ADO ET INSULINE (molécule, quand arrêter, quand reprendre)]

> [MEDIA: 📋 MDIAB31-S02-002 — PROTOCOLE INSULINE IVSE PÉRI-OPÉRATOIRE (vitesse selon glycémie, débit glucose, surveillance)]

## Points clés — Module 31

> 🎯 **Essentiel à retenir**
> 1. iSGLT2 : arrêt 3 jours avant chirurgie (risque ACD euglycémique)
> 2. Metformine : arrêt la veille au soir, reprise dès alimentation + fonction rénale OK
> 3. Insuline basale : JAMAIS arrêter (↓ 20-30 %), rapide arrêtée si jeûne
> 4. Cible glycémique péri-opératoire : 1,10-1,80 g/L
> 5. aGLP-1 : suspendre 1 semaine avant (risque résidu gastrique → aspiration)

## Auto-évaluation — Module 31

### QCM progressifs (5 questions)

**Q1 — 🥈 Argent** : Quand arrêter un iSGLT2 avant une chirurgie programmée ?
A. La veille  B. 3 jours avant  C. Le matin  D. Pas nécessaire
> ✅ **B** — L'iSGLT2 doit être arrêté 3 jours avant une chirurgie programmée pour prévenir l'ACD euglycémique péri-opératoire.

**Q2 — 🥈 Argent** : Faut-il arrêter l'insuline basale le jour de la chirurgie ?
A. Oui, arrêt complet  B. Non, maintenir à dose réduite (−20-30 %)  C. Doubler la dose  D. Remplacer par du glucose IV seul
> ✅ **B** — L'insuline basale doit être maintenue à dose réduite (−20-30 %). L'arrêt total expose au risque d'ACD (DT1) ou d'hyperglycémie sévère (DT2).

**Q3 — 🥇 Or** : Quelle est la cible glycémique péri-opératoire ?
A. 0,70-1,00 g/L  B. 1,10-1,80 g/L  C. 2,00-3,00 g/L  D. < 0,50 g/L
> ✅ **B** — La cible est 1,10-1,80 g/L (consensus NICE/ADA). Éviter l'hypoglycémie (< 0,70 → complications neurologiques sous AG) et l'hyperglycémie (> 2,00 → infection, retard cicatrisation).

**Q4 — 💎 Diamant** : M. T. (accroche) : planifiez sa gestion péri-opératoire complète.
> ✅ **J-3** : arrêt empagliflozine. **J-1 soir** : arrêt metformine, glargine à 22 UI (−20 %). **J0 matin** : glargine 22 UI, pas de rapide (jeûne), glucose capillaire au bloc, insuline IVSE si glycémie > 2,00 g/L. **Per-op** : perfusion G5 % + insuline IVSE si besoin, glycémie horaire, cible 1,10-1,80. **Post-op** : glycémie /4h, reprise glargine dose habituelle dès J1, reprise metformine dès alimentation orale + DFG vérifié, reprise empagliflozine J3-J5 post-op si alimentation normale. Attention : HBPM pour TVP, soins pieds.

---

# MODULE 32 : DIABÈTE EN RÉANIMATION ET SITUATIONS AIGUËS

**Partie** : IX — Situations particulières
**Durée estimée** : 2h30
**Niveau** : Avancé
**Prérequis** : Modules 14, 22

## Accroche clinique

> 🏥 **Mise en situation** : Patient de 72 ans, DT2, admis en réanimation pour pneumonie sévère et sepsis. Glycémie d'entrée : 3,80 g/L. Pas de cétose. Sous noradrénaline + antibiothérapie. Corticothérapie envisagée. *L'hyperglycémie de stress en réanimation est un facteur de mortalité indépendant — mais le contrôle glycémique trop strict augmente le risque d'hypoglycémie et la mortalité.*

## Objectifs d'apprentissage

1. **Comprendre** l'hyperglycémie de stress en réanimation (mécanismes)
2. **Appliquer** les protocoles d'insulinothérapie IV en réanimation (cibles, IVSE)
3. **Gérer** le diabète sous corticothérapie
4. **Prendre en charge** l'hyperglycémie d'entrée aux urgences (distinguer diabétique connu/inconnu)

## Structure du contenu

### Section 1 — Hyperglycémie de stress en réanimation

**Contenu obligatoire :**

- **Mécanismes** : hormones de stress (cortisol, catécholamines, glucagon, GH) → néoglucogenèse ↑, glycogénolyse ↑, insulinorésistance ↑ ; cytokines pro-inflammatoires (TNF-α, IL-6) → insulinorésistance ; nutrition parentérale/entérale ; corticoïdes ; repos au lit
- **Impact pronostique** : hyperglycémie > 1,80 g/L = facteur de mortalité indépendant en réanimation (méta-analyses) ; mais hypoglycémie < 0,70 g/L = également facteur de surmortalité
- **Étude NICE-SUGAR** (Finfer et al., N Engl J Med, 2009) : contrôle glycémique intensif (0,81-1,08 g/L) vs conventionnel (< 1,80 g/L) → mortalité ↑ dans le groupe intensif (27,5 % vs 24,9 %, p=0,02) principalement par hypoglycémies → fin du « tight glycemic control » en réa → cible 1,40-1,80 g/L
- **Cibles glycémiques en réanimation** (ADA 2024, SSC 2021) : 1,40-1,80 g/L pour la plupart des patients ; glycémie > 1,80 g/L → initier insuline IVSE ; éviter < 0,70 g/L
- **Protocole insuline IVSE** : algorithmes à paliers (Yale, Portland) ; dosage glycémie capillaire /1-2h ; adaptation du débit selon la tendance ; perfusion glucose si patient à jeun
- **Transition IVSE → sous-cutané** : dès que le patient mange → chevaucher 2h (insuline SC basale injectée 2h avant arrêt IVSE) ; dose basale = 60-80 % du débit moyen IVSE sur les dernières 6h × 24

### Section 2 — Diabète et corticothérapie

**Contenu obligatoire :**

- **Effet hyperglycémiant des corticoïdes** : insulinorésistance hépatique et musculaire ↑, ↑ néoglucogenèse ; profil : hyperglycémie prédominant l'après-midi et le soir (pic d'action des corticoïdes matinaux)
- **Diabète cortico-induit** : nouveau diabète survenant sous corticothérapie ; prévalence : 20-50 % des patients sous corticoïdes à dose > 7,5 mg/j de prednisone équivalent ; facteurs de risque : prédiabète, ATCD DG, obésité, corticothérapie forte dose
- **Prise en charge** :
  - DT2 connu + corticoïdes : anticiper l'hyperglycémie → renforcer le traitement (ajout insuline NPH matin si corticoïdes matinaux — cinétique parallèle ; ou augmenter doses basale et bolus)
  - Diabète cortico-induit : metformine si modéré, insuline si HbA1c élevée ou hyperglycémie sévère
  - Réévaluation à la décroissance des corticoïdes : ↓ parallèle des ADO/insuline
  - Bolus de méthylprednisolone IV : hyperglycémie majeure pendant 24-48h → insuline IVSE

> [MEDIA: 📋 MDIAB32-S02-001 — PROFIL GLYCÉMIQUE SOUS CORTICOÏDES (pic hyperglycémie après-midi/soir avec corticoïdes matinaux)]

> [MEDIA: 📋 MDIAB32-S02-002 — ALGORITHME PEC HYPERGLYCÉMIE SOUS CORTICOÏDES (dépistage → metformine si modéré → insuline si sévère → ajustement à la décroissance)]

## Points clés — Module 32

> 🎯 **Essentiel à retenir**
> 1. NICE-SUGAR : contrôle glycémique intensif en réa → surmortalité → cible 1,40-1,80 g/L
> 2. Insuline IVSE : seul traitement de l'hyperglycémie en réa, glycémie /1-2h
> 3. Transition IVSE → SC : chevaucher 2h, basale = 60-80 % du débit moyen × 24
> 4. Corticoïdes : hyperglycémie prédominante après-midi/soir → insuline NPH le matin
> 5. Diabète cortico-induit : 20-50 % sous prednisone > 7,5 mg/j

## Auto-évaluation — Module 32

### QCM progressifs (5 questions)

**Q1 — 🥈 Argent** : Quelle cible glycémique en réanimation selon NICE-SUGAR ?
A. 0,80-1,10 g/L  B. 1,40-1,80 g/L  C. 2,00-3,00 g/L  D. < 0,70 g/L
> ✅ **B** — NICE-SUGAR a montré que le contrôle intensif (0,81-1,08) augmentait la mortalité. La cible recommandée est 1,40-1,80 g/L.

**Q2 — 🥇 Or** : Comment transitionnez-vous de l'insuline IVSE vers le sous-cutané ?
A. Arrêt brutal IVSE et début SC le lendemain  B. Injection basale SC 2h avant arrêt IVSE, dose = 60-80 % du débit moyen × 24  C. Passage direct aux ADO  D. IVSE au long cours
> ✅ **B** — Le chevauchement de 2h évite la fenêtre d'hyperglycémie. La dose basale est calculée à 60-80 % du débit IVSE moyen des dernières 6h × 24.

**Q3 — 🥇 Or** : Un patient DT2 sous corticoïdes matinaux présente des hyperglycémies systématiques à 16h-20h. Quel ajustement ?
A. Augmenter la metformine  B. Ajouter une insuline NPH le matin (cinétique parallèle aux corticoïdes)  C. Ajouter un iSGLT2  D. Ne rien changer
> ✅ **B** — L'insuline NPH injectée le matin a un pic d'action à 4-8h coïncidant avec le pic hyperglycémique des corticoïdes matinaux (après-midi/soir). C'est le choix logique pharmacocinétique.

---

# MODULE 33 : DIABÈTE ET SPORT — PERFORMANCE, ADAPTATION, HAUTE COMPÉTITION

**Partie** : IX — Situations particulières
**Durée estimée** : 2h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 22-23, 25

## Accroche clinique

> 🏥 **Mise en situation** : Marc, 28 ans, DT1 depuis 12 ans, cycliste amateur de niveau régional, prépare une cyclosportive de 120 km avec 2000 m de dénivelé. Sous boucle fermée (Omnipod 5 + Dexcom G7). HbA1c : 6,8 %. Il veut savoir comment adapter son traitement pour la compétition. *Chaque année, des sportifs DT1 participent à des Ironman, des marathons et des ultras — le diabète ne doit plus être un frein à la performance, mais sa gestion pendant l'effort demande une expertise spécifique.*

## Objectifs d'apprentissage

1. **Comprendre** la physiologie de l'exercice chez le diabétique (réponse glycémique selon le type d'effort)
2. **Adapter** l'insulinothérapie et la nutrition pour différents types de sport
3. **Prévenir** les hypoglycémies pendant et après l'effort (dont tardives)
4. **Accompagner** le sportif de haut niveau DT1

## Structure du contenu

### Section 1 — Physiologie et adaptation

**Contenu obligatoire :**

- **Physiologie normale** : exercice → ↑ captation musculaire glucose (GLUT4, contraction-dépendant, indépendant de l'insuline) + ↓ sécrétion insuline + ↑ glucagon → homéostasie glycémique maintenue
- **Spécificités DT1** : l'insuline exogène ne diminue pas pendant l'effort → captation musculaire ↑ sans ↓ insulinémie → risque hypoglycémie ; contre-régulation altérée (neuropathie autonome, hypos répétées) ; risque hyperglycémie si exercice intense/anaérobie (catécholamines)
- **Recommandations** (adapté de Riddell et al., Lancet Diabetes Endocrinol, 2017 — consensus ISPAD/ADCES) :
  - Glycémie cible pré-exercice : 1,26-1,80 g/L (126-180 mg/dL)
  - Si < 0,90 g/L → collation 15-30 g glucides avant effort
  - Si > 2,70 g/L avec cétones → NE PAS faire d'exercice
  - Adaptations selon type :
    - Aérobie > 30 min : ↓ bolus 25-75 %, ↓ basale 20-50 % (ou débit temporaire −50 % pompe), collation glucidique toutes les 30-60 min (30-60 g/h)
    - Résistance/HIIT : pas de réduction systématique du bolus (risque hyperglycémie initiale), correction prudente post-effort
    - Effort mixte (compétition) : stratégie combinée
  - Post-exercice : risque hypoglycémie tardive (6-15h, surtout nocturne) → ↓ basale 20 % la nuit, collation coucher, CGM +++
- **Nutrition sportive** : glucides rapides pendant l'effort (gels, boissons isotoniques), adaptation selon durée et intensité ; protéines et glucides en récupération
- **Sport de haut niveau** : DT1 et compétition (exemples : cyclisme, triathlon, football, rugby) ; antidopage et insuline (AUT — Autorisation d'Usage à des fins Thérapeutiques obligatoire) ; suivi médical renforcé

> [MEDIA: 🏃 MDIAB33-S01-001 — ALGORITHME GESTION GLYCÉMIQUE AUTOUR DE L'EXERCICE (pré-effort, pendant, post-effort — seuils, actions)]

> [MEDIA: 📊 MDIAB33-S01-002 — RÉPONSE GLYCÉMIQUE SELON TYPE D'EXERCICE (aérobie → hypo, résistance → hyper initiale puis hypo, HIIT → variable)]

## Points clés — Module 33

> 🎯 **Essentiel à retenir**
> 1. DT1 et sport : l'insuline exogène ne diminue pas → risque hypo si exercice aérobie
> 2. Glycémie cible pré-exercice : 1,26-1,80 g/L ; < 0,90 → collation ; > 2,70 + cétones → pas d'exercice
> 3. Aérobie > 30 min : ↓ bolus 25-75 %, ↓ basale 20-50 %, collation 30-60 g/h
> 4. Hypoglycémie tardive post-exercice : 6-15h → ↓ basale nocturne, collation coucher
> 5. AUT obligatoire pour l'insuline en compétition officielle

## Auto-évaluation — Module 33

### QCM progressifs (5 questions)

**Q1 — 🥈 Argent** : Quelle est la glycémie cible avant un exercice aérobie prolongé chez un DT1 ?
A. < 0,70 g/L  B. 1,26-1,80 g/L  C. > 3,00 g/L  D. 0,90-1,00 g/L
> ✅ **B** — La glycémie cible pré-exercice est 1,26-1,80 g/L (126-180 mg/dL). Trop bas → risque hypo rapide ; trop haut avec cétones → ACD à l'effort.

**Q2 — 🥇 Or** : Pourquoi l'exercice de résistance/HIIT peut-il provoquer une hyperglycémie initiale ?
A. Absorption accrue de glucose intestinal  B. Décharge catécholaminergique → néoglucogenèse et glycogénolyse  C. Insulinorésistance permanente  D. Erreur de bolus
> ✅ **B** — L'exercice intense/anaérobie provoque une décharge d'adrénaline et de noradrénaline → glycogénolyse hépatique et néoglucogenèse → hyperglycémie transitoire. Chez le DT1, l'insuline exogène ne peut contrebalancer immédiatement.

**Q3 — 💎 Diamant** : Marc (accroche) : cyclosportive 120 km, ~5h d'effort. Planifiez sa gestion complète.
> ✅ **Veille** : dîner riche en glucides complexes, basale habituelle. **Matin** : petit-déjeuner 3h avant départ (100-120 g glucides, bolus ↓ 50 %), glycémie cible départ 1,50-1,80 g/L. **Pompe** : débit temporaire −50 à −80 % dès 1h avant le départ et pendant toute la course. **Pendant** : 40-60 g glucides/h (gels, boissons isotoniques), CGM en continu sur le guidon, cible 1,00-1,80 g/L ; si < 0,90 → gel immédiat + ↓ débit. **Post-course** : collation glucides + protéines dans les 30 min, surveillance CGM 24h, basale ↓ 20-30 % la nuit suivante, collation coucher, alerte CGM < 70 mg/dL.

### Cas clinique intégré — Module 33

> 📝 **Cas clinique** : Un adolescent DT1 de 15 ans, footballeur en centre de formation, veut continuer sa carrière. HbA1c 7,5 %, sous boucle fermée. Il s'entraîne 5×/semaine (2h/séance) et a des hypos récurrentes post-entraînement. Comment l'accompagnez-vous ?

---

## Références bibliographiques — Partie 9

1. Stewart ZA, Wilinska ME, Hartnell S et al. (AiDAPT). « Closed-loop insulin delivery during pregnancy in women with type 1 diabetes. » *N Engl J Med*, 2023; 389(8): 689-698.
2. Metzger BE, Lowe LP, Dyer AR et al. (HAPO Study Cooperative Research Group). « Hyperglycemia and adverse pregnancy outcomes. » *N Engl J Med*, 2008; 358(19): 1991-2002.
3. Metzger BE, Gabbe SG, Persson B et al. (IADPSG). « International association of diabetes and pregnancy study groups recommendations on the diagnosis and classification of hyperglycemia in pregnancy. » *Diabetes Care*, 2010; 33(3): 676-682.
4. Finfer S, Chittock DR, Su SY et al. (NICE-SUGAR Study Investigators). « Intensive versus conventional glucose control in critically ill patients. » *N Engl J Med*, 2009; 360(13): 1283-1297.
5. Riddell MC, Gallen IW, Smart CE et al. « Exercise management in type 1 diabetes: a consensus statement. » *Lancet Diabetes Endocrinol*, 2017; 5(5): 377-390.

---

> 🔶 **DIABÉTOLOGIE** | Partie 9/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 10 — Innovations, Immunothérapie et Recherche (Modules 34-38)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 34 : PRÉVENTION DU DT1 — IMMUNOTHÉRAPIE ET DÉPISTAGE PRÉ-SYMPTOMATIQUE

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h30
**Niveau** : Avancé
**Prérequis** : Module 5

## Accroche clinique

> 🏥 **Mise en situation** : Les parents de Lucas, 10 ans, DT1 diagnostiqué à 8 ans, ont un 2e enfant, Emma, 5 ans. Ils demandent : « Peut-on savoir si Emma va développer le diabète ? Et peut-on l'empêcher ? » Le diabétologue explique que le dépistage des auto-anticorps est désormais possible et qu'un traitement préventif (teplizumab) a été approuvé. *Pour la première fois dans l'histoire du DT1, nous pouvons identifier les individus à risque et retarder l'apparition de la maladie — un changement de paradigme.*

## Objectifs d'apprentissage

1. **Comprendre** les stades pré-cliniques du DT1 (Insel/JDRF : stades 1-3)
2. **Connaître** le dépistage par auto-anticorps (IA-2, GAD65, ZnT8, IAA) et son interprétation
3. **Prescrire** le teplizumab (anti-CD3) : mécanisme, indication, résultats
4. **Connaître** les autres stratégies de prévention en développement

## Structure du contenu

### Section 1 — Stades pré-cliniques et dépistage

**Contenu obligatoire :**

- **Classification en stades** (adapté de Insel et al., Diabetes Care, 2015) :
  - **Stade 1** : ≥ 2 auto-anticorps positifs, normoglycémie → risque de DT1 clinique ~75 % à 10 ans, ~100 % au cours de la vie
  - **Stade 2** : ≥ 2 auto-anticorps + dysglycémie (IFG, IGT, OGTT anormale) → risque de DT1 clinique ~75 % à 5 ans
  - **Stade 3** : DT1 clinique (symptômes + critères diagnostiques)
- **Auto-anticorps** : IAA (anti-insuline — souvent le 1er chez l'enfant), GADA (anti-GAD65 — le plus fréquent), IA-2A (anti-tyrosine phosphatase), ZnT8A (anti-transporteur zinc) ; séroconversion : souvent entre 6 mois et 6 ans ; ≥ 2 auto-anticorps = risque très élevé
- **Programmes de dépistage** : TrialNet (international), TEDDY (The Environmental Determinants of Diabetes in the Young), Fr1da (Bavière — dépistage populationnel à 2-5 ans), EDENT1FI (Europe) ; screening des apparentés au 1er degré ET dépistage populationnel en discussion
- **Bénéfice du dépistage** : identification pré-symptomatique → éducation des familles → réduction dramatique des ACD inaugurales (de 30 % sans dépistage à < 5 % avec dépistage → meilleure préservation β-cellulaire initiale)

> [MEDIA: 📊 MDIAB34-S01-001 — STADES PRÉ-CLINIQUES DT1 (stade 1-2-3 — auto-anticorps, glycémie, masse β-cellulaire, risque)]

> [MEDIA: 📋 MDIAB34-S01-002 — ALGORITHME DÉPISTAGE DT1 (qui dépister, quels auto-anticorps, interprétation, CAT selon résultat)]

### Section 2 — Teplizumab et stratégies de prévention

**Contenu obligatoire :**

- **Teplizumab** (Tzield®) — anti-CD3 monoclonal humanisé :
  - Mécanisme : modulation de la réponse immunitaire T → induction de tolérance (expansion lymphocytes T régulateurs, épuisement T effecteurs auto-réactifs)
  - Étude pivot : TrialNet TN-10 (Herold et al., N Engl J Med, 2019) — apparentés au 1er degré, stade 2, 8-49 ans → teplizumab IV 14 jours vs placebo → retard médian du DT1 clinique de 2 ans (24,4 mois vs 48,4 mois), certains patients > 5 ans de retard
  - Suivi à long terme : retard médian > 3 ans, bénéfice maximal chez les plus jeunes et ceux avec le plus haut taux de C-peptide résiduel
  - Approbation FDA (novembre 2022) : 1er traitement approuvé pour retarder le DT1 de stade 2 chez les ≥ 8 ans ; non encore approuvé en Europe (en cours d'évaluation EMA)
  - Administration : cure de 14 jours IV consécutifs en milieu hospitalier ambulatoire ; effets secondaires : lymphopénie transitoire, rash cutané, syndrome de libération des cytokines (léger), risque infectieux transitoire
- **Autres stratégies en développement** :
  - **Abatacept** (anti-CTLA4) : retarde la perte de C-peptide chez les DT1 récents (étude TrialNet, Orban et al., Lancet, 2011)
  - **Verapamil** : bloqueur calcique protégeant les β-cellules du stress (étude Ovalle et al., Nat Med, 2018 → maintien C-peptide chez DT1 récents)
  - **Baricitinib** (anti-JAK) : préservation β-cellulaire dans le DT1 récent (Waibel et al., N Engl J Med, 2023)
  - **Antigènes spécifiques** : vaccination GAD-alum (résultats mitigés), insuline orale (TrialNet — pas de bénéfice global mais signal dans un sous-groupe)
  - **Thérapie combinée** : association de plusieurs immunomodulateurs (en cours)

> [MEDIA: 📊 MDIAB34-S02-001 — RÉSULTATS TN-10 TEPLIZUMAB (courbes de Kaplan-Meier : temps jusqu'au DT1 clinique — teplizumab vs placebo)]

> [MEDIA: 📋 MDIAB34-S02-002 — PIPELINE PRÉVENTION DT1 (teplizumab, abatacept, verapamil, baricitinib, GAD-alum — phase, mécanisme, résultats)]

## Points clés — Module 34

> 🎯 **Essentiel à retenir**
> 1. DT1 stade 1 (≥ 2 auto-anticorps, normoglycémie) → risque ~100 % au cours de la vie
> 2. Teplizumab (anti-CD3) : 1er traitement approuvé retardant le DT1 de stade 2 (médiane +2 ans)
> 3. Le dépistage pré-symptomatique réduit les ACD inaugurales de 30 % à < 5 %
> 4. Baricitinib (anti-JAK) : préservation β-cellulaire prometteuse dans le DT1 récent
> 5. Dépistage populationnel des auto-anticorps : en discussion (programmes Fr1da, EDENT1FI)

## Auto-évaluation — Module 34

### QCM progressifs (6 questions)

**Q1 — 🥈 Argent** : Que signifie la présence de ≥ 2 auto-anticorps anti-îlots chez un enfant normoglycémique ?
A. DT1 clinique  B. Stade 1 pré-clinique → risque ~100 % de DT1 au cours de la vie  C. DT2  D. Pas de signification
> ✅ **B** — ≥ 2 auto-anticorps positifs = stade 1 pré-clinique, risque cumulatif de DT1 clinique de ~75 % à 10 ans et proche de 100 % au cours de la vie.

**Q2 — 🥇 Or** : Quel est le mécanisme d'action du teplizumab ?
A. Destruction des cellules bêta  B. Anti-CD3 → modulation immunitaire T → tolérance (↑ Treg, épuisement T effecteurs)  C. Stimulation de la sécrétion d'insuline  D. Blocage des auto-anticorps
> ✅ **B** — Le teplizumab est un anti-CD3 monoclonal qui module la réponse immunitaire T : il induit l'expansion des lymphocytes T régulateurs et l'épuisement des T effecteurs auto-réactifs, sans immunosuppression globale.

**Q3 — 🥇 Or** : Quel résultat de l'étude TrialNet TN-10 ?
A. Guérison du DT1  B. Retard médian de 2 ans de l'apparition du DT1 clinique chez les stade 2  C. Prévention totale du DT1  D. Aucun effet significatif
> ✅ **B** — TN-10 a montré un retard médian de ~2 ans (puis > 3 ans en suivi prolongé) de l'apparition du DT1 clinique chez les apparentés au 1er degré en stade 2 traités par teplizumab vs placebo.

**Q4 — 💎 Diamant** : Emma (accroche), 5 ans, apparentée au 1er degré d'un DT1. Quelle conduite proposez-vous ?
> ✅ (1) **Dépistage** : dosage des 4 auto-anticorps (IAA, GADA, IA-2A, ZnT8A) ; (2) Si ≥ 2 positifs : **stade 1** confirmé → HGPO 75 g adaptée à l'enfant pour évaluer la dysglycémie ; (3) Si dysglycémie → **stade 2** → discussion teplizumab (indication FDA si ≥ 8 ans → Emma a 5 ans → surveiller et réévaluer à 8 ans pour l'éligibilité) ; inclusion dans un protocole de recherche (TrialNet) ; (4) Si 0-1 auto-anticorps : faible risque → surveillance annuelle ; (5) Dans tous les cas : éducation des parents aux signes d'alerte (polyurie, polydipsie, amaigrissement → consultation urgente → éviter l'ACD inaugurale).

---

# MODULE 35 : THÉRAPIE CELLULAIRE ET RÉGÉNÉRATION β-CELLULAIRE

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Avancé
**Prérequis** : Modules 1-2, 5

## Accroche clinique

> 🏥 **Mise en situation** : Un patient DT1 de 35 ans, diagnostiqué à 12 ans, avec hypoglycémies sévères récurrentes malgré une boucle fermée, demande : « J'ai lu qu'on pouvait maintenant guérir le diabète avec des cellules souches. C'est vrai ? » *La thérapie cellulaire est le Saint-Graal de la diabétologie — des avancées spectaculaires ont été réalisées, mais la route vers une application clinique large est encore longue.*

## Objectifs d'apprentissage

1. **Connaître** les approches de thérapie cellulaire du DT1 : transplantation d'îlots, cellules souches
2. **Comprendre** les avancées en cellules souches pluripotentes (hESC, iPSC) pour le DT1
3. **Connaître** les stratégies d'immuno-protection des greffons (encapsulation, édition génétique)
4. **Évaluer** le niveau de preuve et les perspectives réalistes

## Structure du contenu

### Section 1 — Transplantation d'îlots de Langerhans

**Contenu obligatoire :**

- **Transplantation d'îlots d'Edmonton** (Shapiro et al., N Engl J Med, 2000) : infusion portale d'îlots isolés de donneurs cadavériques ; protocole d'immunosuppression sans corticoïdes (sirolimus + tacrolimus + daclizumab) ; résultats à 1 an : 100 % d'insulino-indépendance (7/7 patients initiaux) ; à 5 ans : 10 % insulino-indépendants mais ~80 % avec C-peptide détectable et amélioration significative des hypos sévères
- **Indications actuelles** : DT1 avec hypoglycémies sévères récurrentes et hypo-unawareness, malgré traitement optimisé (y compris boucle fermée) ; souvent couplée à une greffe rénale (îlots après rein = IAK, ou îlots seuls = ITA)
- **Limites** : pénurie de donneurs (2-3 pancréas par receveur), immunosuppression à vie (toxicité rénale, infections, cancers), perte progressive du greffon (rejet + récidive auto-immunité), coût
- **Donazpt** (Lantidra®) — 1er produit de thérapie cellulaire allogénique approuvé FDA (2023) pour le DT1 avec hypos sévères non contrôlées

### Section 2 — Cellules souches et bio-ingénierie

**Contenu obligatoire :**

- **Cellules souches embryonnaires humaines (hESC)** :
  - Différenciation dirigée vers des cellules β fonctionnelles (protocoles Pagliuca/Melton, Cell, 2014)
  - **VX-880** (Vertex Pharmaceuticals) : cellules β dérivées de hESC, infusion portale + immunosuppression → 1er patient (Shapiro et al., NEJM, 2023) : insulino-indépendance complète à 1 an → résultat historique ; essai de phase 1/2 en cours
  - **VX-264** : même cellules mais en dispositif d'encapsulation → sans immunosuppression systémique → essai en cours
- **Cellules souches pluripotentes induites (iPSC)** :
  - Reprogrammation de cellules somatiques du patient → différenciation en β → avantage théorique : pas de rejet (cellules autologues) ; mais : récidive auto-immunité dans le DT1 → protection nécessaire ; coût et temps de production
- **Encapsulation** : dispositifs protégeant les cellules greffées du système immunitaire tout en permettant l'échange de nutriments et d'insuline :
  - Macro-encapsulation (ViaCyte/CRISPR — PEC-Direct, PEC-Encap) : dispositif sous-cutané contenant des précurseurs pancréatiques ; résultats modestes (vascularisation insuffisante, fibrose péri-dispositif)
  - Micro-encapsulation (alginate, hydrogels biocompatibles) : meilleur ratio surface/volume ; défis : fibrose, taille, biocompatibilité à long terme
- **Édition génétique (CRISPR)** : cellules β « universelles » avec knock-out des gènes HLA classe I et II (évitement rejet) + knock-in de « ne me mange pas » (CD47) → cellules hypo-immunogènes → plus besoin d'immunosuppression → concept prometteur, stade préclinique/phase 1
- **Régénération endogène** : stimulation de la prolifération des β-cellules restantes (inhibiteurs DYRK1A — harmine), transdifférenciation α→β (artémisinines, GABA), reprogrammation ductale → β ; stade préclinique

> [MEDIA: 🔬 MDIAB35-S02-001 — PIPELINE THÉRAPIE CELLULAIRE DT1 (Edmonton → VX-880 → VX-264 → iPSC → CRISPR hypo-immunogène — timeline et stade)]

> [MEDIA: 🔬 MDIAB35-S02-002 — SCHÉMA ENCAPSULATION (macro vs micro — principe, avantages, limites)]

## Points clés — Module 35

> 🎯 **Essentiel à retenir**
> 1. Transplantation d'îlots (Edmonton) : efficace sur les hypos sévères mais nécessite immunosuppression à vie
> 2. Lantidra® (donislecel) : 1er produit cellulaire approuvé FDA (2023) pour DT1 + hypos sévères
> 3. VX-880 (Vertex) : cellules β de hESC → insulino-indépendance chez le 1er patient → révolution potentielle
> 4. VX-264 : même cellules en dispositif d'encapsulation → sans immunosuppression → essai en cours
> 5. CRISPR : cellules hypo-immunogènes (KO HLA + CD47) → concept prometteur pour éviter l'immunosuppression
> 6. La « guérison » du DT1 par thérapie cellulaire est scientifiquement possible mais pas encore cliniquement disponible à grande échelle

## Auto-évaluation — Module 35

### QCM progressifs (5 questions)

**Q1 — 🥈 Argent** : Quel est le principal résultat du programme VX-880 (Vertex) ?
A. Échec complet  B. Insulino-indépendance complète chez le 1er patient DT1 traité par cellules β dérivées de hESC  C. Amélioration modeste de l'HbA1c  D. Guérison de tous les patients
> ✅ **B** — VX-880 a atteint l'insulino-indépendance complète chez le 1er patient (Shapiro et al., 2023), un résultat historique prouvant le concept de la thérapie cellulaire par cellules souches dans le DT1.

**Q2 — 🥇 Or** : Pourquoi l'encapsulation est-elle une stratégie clé pour la thérapie cellulaire ?
A. Pour augmenter la production d'insuline  B. Pour protéger les cellules greffées du système immunitaire sans immunosuppression systémique  C. Pour faciliter la chirurgie  D. Pour réduire le coût
> ✅ **B** — L'encapsulation crée une barrière physique protégeant les cellules du rejet immunitaire tout en permettant la diffusion de glucose et d'insuline, éliminant le besoin d'immunosuppression systémique.

**Q3 — 💎 Diamant** : Comment expliquez-vous au patient de l'accroche l'état actuel de la thérapie cellulaire ?
> ✅ « Les avancées sont réelles et historiques : pour la première fois, des cellules souches ont été transformées en cellules productrices d'insuline et ont guéri un patient dans un essai clinique (VX-880). Cependant : (1) ce traitement nécessite encore une immunosuppression à vie (avec ses risques) ; (2) les essais portent sur quelques patients → il faut confirmer l'efficacité et la sécurité à grande échelle ; (3) des solutions sans immunosuppression (encapsulation, édition génétique CRISPR) sont en cours d'essai mais ne sont pas encore disponibles ; (4) estimation réaliste : 5-10 ans avant une disponibilité clinique large. En attendant, la boucle fermée hybride est le meilleur traitement disponible pour vos hypos sévères. »

---

# MODULE 36 : INTELLIGENCE ARTIFICIELLE ET DIABÈTE — AIDE AU DIAGNOSTIC, PRÉDICTION, GESTION

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 16, 23, 29

## Accroche clinique

> 🏥 **Mise en situation** : Un centre de santé rural utilise un système de dépistage autonome de la rétinopathie diabétique par IA (IDx-DR) : la patiente pose le menton sur l'appareil photo, l'image est analysée automatiquement en 30 secondes, et le résultat s'affiche : « Rétinopathie diabétique référable — adresser à l'ophtalmologue ». Pas d'ophtalmologue sur place, pas de dilatation, pas d'attente. *L'IA transforme déjà la pratique diabétologique — du dépistage au traitement, en passant par la prédiction.*

## Objectifs d'apprentissage

1. **Connaître** les applications validées de l'IA en diabétologie
2. **Comprendre** le fonctionnement des algorithmes de boucle fermée (AID)
3. **Évaluer** les limites et enjeux éthiques de l'IA en santé
4. **Anticiper** les développements futurs

## Structure du contenu

### Section 1 — Applications validées de l'IA

**Contenu obligatoire :**

- **Dépistage de la RD** : IDx-DR/LumineticsCore (1er système diagnostique autonome approuvé FDA, 2018), EyeArt ; déploiement en soins primaires sans ophtalmologue ; sensibilité > 87 %, spécificité > 90 % ; limites (qualité image, cas limites)
- **Algorithmes de boucle fermée** : les systèmes AID (MiniMed 780G, Control-IQ, Omnipod 5, CamAPS FX) sont des applications d'IA (MPC, PID) ajustant l'insuline en temps réel → millions de patients concernés
- **Prédiction du risque** : modèles de machine learning pour prédire le risque de DT2 (FINDRISC amélioré, scores génomiques), le risque de complications (néphropathie, RD), le risque d'hypoglycémie (analyse des patterns CGM)
- **Aide à la décision thérapeutique** : systèmes de recommandation basés sur le profil patient (IBM Watson, DreaMed Advisor) ; analyse automatisée des données CGM (patterns, AGP, alertes)
- **Chatbots et coaching** : applications d'accompagnement du patient (rappels traitement, coaching nutritionnel, soutien motivationnel par IA conversationnelle)

### Section 2 — Limites, éthique et perspectives

**Contenu obligatoire :**

- **Limites** : biais algorithmiques (sous-représentation de certaines ethnies dans les données d'entraînement → performance réduite), boîte noire (explicabilité), dépendance aux données (qualité, exhaustivité), responsabilité médico-légale (qui est responsable si l'IA se trompe ?)
- **Éthique** : consentement éclairé, protection des données de santé (RGPD), équité d'accès, rôle du médecin (supervision vs autonomie de l'IA), relation médecin-patient
- **Perspectives** : pancréas artificiel « fully closed loop » piloté par IA avancée, diagnostic précoce du DT1 par modèles multi-omiques, médecine de précision par IA (choix thérapeutique optimal basé sur le phénotype complet du patient), digital twins (jumeaux numériques du patient diabétique pour simuler les réponses thérapeutiques)

> [MEDIA: 🖥️ MDIAB36-S01-001 — APPLICATIONS IA EN DIABÉTOLOGIE (dépistage RD, boucle fermée, prédiction, aide décision — exemples concrets)]

> [MEDIA: 🔮 MDIAB36-S02-001 — CONCEPT DIGITAL TWIN DIABÉTIQUE (modèle numérique du patient → simulation réponse thérapeutique → personnalisation)]

## Points clés — Module 36

> 🎯 **Essentiel à retenir**
> 1. IDx-DR : 1er diagnostic autonome par IA approuvé FDA (dépistage RD sans ophtalmologue)
> 2. Les boucles fermées (AID) sont les applications d'IA les plus déployées en diabétologie
> 3. L'IA améliore la prédiction du risque (DT2, complications, hypoglycémies)
> 4. Limites : biais, explicabilité, responsabilité médico-légale
> 5. Digital twins : concept émergent pour la personnalisation thérapeutique

---

# MODULE 37 : NOUVELLES THÉRAPEUTIQUES — MOLÉCULES EN DÉVELOPPEMENT

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Avancé
**Prérequis** : Modules 26-27, 34-35

## Accroche clinique

> 🏥 **Mise en situation** : Un diabétologue revient d'un congrès (ADA 2025) enthousiasmé par les présentations sur les triple agonistes, l'insuline hebdomadaire, et les thérapies cellulaires. Son interne lui demande : « Quelles sont les molécules qui vont vraiment changer la pratique dans les 5 prochaines années ? » *Le pipeline thérapeutique en diabétologie est plus riche qu'il ne l'a jamais été — distinguer les innovations transformatives des améliorations incrémentales est un exercice crucial.*

## Objectifs d'apprentissage

1. **Identifier** les molécules en phase 3 ou récemment approuvées qui vont transformer la pratique
2. **Comprendre** les nouvelles cibles thérapeutiques
3. **Évaluer** le niveau de preuve de chaque innovation
4. **Anticiper** l'impact sur les algorithmes thérapeutiques

## Structure du contenu

### Section 1 — Innovations à court terme (approuvées ou en phase 3)

**Contenu obligatoire :**

- **Insuline icodec** (Awiqli®) : hebdomadaire, approuvée dans certains pays, DT2 → simplification majeure (ONWARDS 1-6)
- **Tirzépatide** (Mounjaro®/Zepbound®) : double agoniste GIP/GLP-1 → efficacité sans précédent (HbA1c + poids) → CVOT en cours
- **Sémaglutide haute dose** (Wegovy® 2,4 mg) : obésité + protection CV même sans DT2 (SELECT)
- **CagriSema** (amyline + sémaglutide) : combinaison → perte de poids supérieure au sémaglutide seul (REDEFINE)
- **Resmétirom** (Rezdiffra®) : agoniste THR-β, 1er traitement MASH approuvé FDA (MAESTRO-NASH)
- **Finérénone** (Kerendia®) : ARM non stéroïdien → néphroprotection + CV (FIDELIO/FIGARO)
- **Teplizumab** (Tzield®) : prévention DT1 stade 2

### Section 2 — Innovations à moyen terme (phase 2-3)

**Contenu obligatoire :**

- **Triple agonistes GLP-1/GIP/glucagon** : rétaporsen (LY3437943, Eli Lilly), survodutide (Boehringer) → perte de poids > 20 %, bénéfice MASH ; phase 3 en cours
- **Orforglipron** (Eli Lilly) : 1er agoniste GLP-1 oral non peptidique (petite molécule) → plus simple que le sémaglutide oral (pas de contrainte de prise à jeun), résultats phase 2 prometteurs (↓ HbA1c 1,6 %, perte de poids 10 %) → phase 3 en cours
- **Danuglipron** (Pfizer) : agoniste GLP-1 oral non peptidique (développement complexe, reformulation)
- **Insuline « smart » glucose-responsive** : phase préclinique avancée/phase 1
- **VX-880/VX-264** (Vertex) : thérapie cellulaire hESC → phase 1/2
- **Baricitinib** : anti-JAK pour la préservation β-cellulaire dans le DT1 récent
- **Imeglimin** (Twymeeg®) : mécanisme mitochondrial, approuvé au Japon, pas en Europe/USA
- **Aldose réductase inhibitors** (épalréstat — Japon) : neuropathie, pas en Occident

> [MEDIA: 📋 MDIAB37-S02-001 — PIPELINE THÉRAPEUTIQUE 2025-2030 (molécule, mécanisme, indication, phase, date estimée disponibilité)]

> [MEDIA: 📊 MDIAB37-S02-002 — COMPARATIF PERTE DE POIDS PAR CLASSE (sémaglutide vs tirzépatide vs triple agoniste vs CagriSema vs chirurgie bariatrique)]

## Points clés — Module 37

> 🎯 **Essentiel à retenir**
> 1. Triple agonistes : perte de poids > 20 % + bénéfice MASH → pourraient supplanter les mono-agonistes
> 2. Orforglipron : 1er aGLP-1 oral non peptidique → simplification majeure si phase 3 positive
> 3. CagriSema : amyline + sémaglutide → perte de poids supérieure au sémaglutide seul
> 4. Icodec : insuline hebdomadaire → transformation de l'initiation insulinique dans le DT2
> 5. Le pipeline 2025-2030 est le plus riche de l'histoire de la diabétologie

---

# MODULE 38 : ÉPIDÉMIOLOGIE MONDIALE, SANTÉ PUBLIQUE ET INÉGALITÉS D'ACCÈS

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 6, 10, 29

## Accroche clinique

> 🏥 **Mise en situation** : Lors d'une conférence, un expert rappelle : « En 2024, 537 millions de personnes vivent avec le diabète dans le monde. En 2045, ce sera 783 millions. La moitié ne sont pas diagnostiquées. Et dans les pays à faible revenu, un enfant DT1 a une espérance de vie de 1 an car l'insuline n'est pas accessible. » *Le diabète est la pandémie silencieuse du XXIe siècle — et l'inégalité d'accès au traitement est un scandale sanitaire mondial.*

## Objectifs d'apprentissage

1. **Connaître** l'épidémiologie mondiale du diabète (IDF Diabetes Atlas 2024)
2. **Comprendre** les déterminants de la pandémie de DT2
3. **Identifier** les inégalités d'accès au diagnostic et au traitement
4. **Connaître** les initiatives mondiales de lutte contre le diabète

## Structure du contenu

### Section 1 — Épidémiologie mondiale

**Contenu obligatoire :**

- **Données IDF Diabetes Atlas 2024** (10e édition) : 537 millions d'adultes (20-79 ans) diabétiques (prévalence 10,5 %) ; 783 millions projetés en 2045 (+46 %) ; 240 millions non diagnostiqués (44 %) ; 6,7 millions de décès/an attribuables au diabète ; coût mondial : 966 milliards USD (15 % des dépenses de santé mondiales)
- **Répartition géographique** : Chine (140 M), Inde (74 M), USA (37 M), Pakistan (33 M), Brésil (22 M) → les pays à revenu intermédiaire concentrent 80 % des diabétiques ; prévalence la plus élevée : Moyen-Orient/Afrique du Nord (~17 %) ; croissance la plus rapide : Afrique (+134 % projeté 2021-2045)
- **DT1** : ~8,75 millions dans le monde (incidence croissante de 3-4 %/an — Patterson et al., Lancet Diabetes Endocrinol, 2019) ; gradient Nord-Sud (Finlande 64/100 000 → Chine 1/100 000)
- **Diabète de l'enfant** : 1,2 million d'enfants < 20 ans avec DT1 ; DT2 pédiatrique en augmentation (obésité) — préoccupation majeure
- **Prédictions** : « diabèse » (diabésité) = convergence pandémie d'obésité + DT2 ; urbanisation, sédentarité, transition nutritionnelle dans les PED (pays en développement)

### Section 2 — Inégalités d'accès et politiques de santé

**Contenu obligatoire :**

- **Accès à l'insuline** : 100 ans après sa découverte (1921), l'insuline reste inaccessible pour ~50 % des DT1 dans les pays à faible revenu → mortalité massive ; coût : 1 flacon d'insuline = 4 USD en Inde vs 300 USD aux USA (avant réforme) ; initiative OMS : insuline dans la liste des médicaments essentiels, programme de pré-qualification OMS pour les biosimilaires
- **Accès aux technologies** : CGM et pompe = < 1 % des diabétiques dans les PED vs > 50 % des DT1 dans les pays nordiques → fracture technologique
- **Barrières** : coût des traitements (aGLP-1, iSGLT2 restent très chers), infrastructure de santé insuffisante, manque de formation des soignants, stigmatisation, faible littératie en santé
- **Initiatives mondiales** : couverture universelle (ODD 3.8 — accès universel aux médicaments essentiels), résolution ONU sur le diabète (2021), programme OMS « Global Diabetes Compact », plaidoyer pour le plafonnement du prix de l'insuline (Inflation Reduction Act USA 2022 → insuline plafonnée à 35 USD/mois pour Medicare)
- **Rôle du médecin** : advocacy, participation aux programmes de prévention, dépistage dans les populations vulnérables, éducation thérapeutique adaptée culturellement

> [MEDIA: 🌍 MDIAB38-S01-001 — CARTE MONDIALE PRÉVALENCE DIABÈTE (IDF Atlas 2024, par région — dégradé de couleurs)]

> [MEDIA: 📊 MDIAB38-S02-001 — GRAPHIQUE INÉGALITÉS D'ACCÈS (insuline, CGM, aGLP-1 — pays à haut vs faible revenu)]

## Points clés — Module 38

> 🎯 **Essentiel à retenir**
> 1. 537 millions de diabétiques en 2024, 783 millions en 2045 — pandémie silencieuse
> 2. 44 % des diabétiques ne sont pas diagnostiqués
> 3. L'insuline reste inaccessible pour ~50 % des DT1 dans les pays à faible revenu
> 4. Fracture technologique : CGM/pompe < 1 % dans les PED vs > 50 % en Scandinavie
> 5. L'Afrique connaîtra la plus forte croissance (+134 % projeté 2021-2045)

## Auto-évaluation — Module 38

### QCM progressifs (5 questions)

**Q1 — 🥉 Bronze** : Combien de personnes vivent avec le diabète dans le monde en 2024 ?
A. 100 millions  B. 537 millions  C. 1 milliard  D. 50 millions
> ✅ **B** — 537 millions d'adultes (IDF Atlas 2024), avec une projection à 783 millions en 2045.

**Q2 — 🥈 Argent** : Quel pourcentage de diabétiques dans le monde ne sont pas diagnostiqués ?
A. 10 %  B. 25 %  C. 44 %  D. 75 %
> ✅ **C** — 44 % (soit ~240 millions) des diabétiques dans le monde ne sont pas diagnostiqués, principalement dans les pays à faible/moyen revenu où le dépistage est insuffisant.

**Q3 — 🥇 Or** : Quelle région du monde connaîtra la plus forte croissance du diabète d'ici 2045 ?
A. Europe  B. Amérique du Nord  C. Afrique (+134 %)  D. Asie du Sud-Est
> ✅ **C** — L'Afrique connaîtra la croissance la plus explosive (+134 % projeté), liée à l'urbanisation rapide, la transition nutritionnelle et le manque d'infrastructures de dépistage/traitement.

**Q4 — 💎 Diamant** : Un enfant DT1 naît dans un pays à faible revenu où l'insuline n'est pas disponible de façon fiable. Quels sont les enjeux et les solutions possibles ?
> ✅ **Enjeux** : mortalité à court terme (ACD sans insuline = décès en quelques jours/semaines) ; espérance de vie < 1 an vs > 70 ans dans les pays riches → inégalité inacceptable. **Solutions** : (1) pré-qualification OMS des biosimilaires d'insuline → ↓ coûts ; (2) stockage adapté (insulines thermostables en développement) ; (3) programmes d'accès (Life for a Child Foundation — IDF) ; (4) formation des soignants locaux au diagnostic et au traitement du DT1 ; (5) plaidoyer international (résolution ONU, Global Diabetes Compact) ; (6) technologies low-cost (glucomètres abordables, CGM flash).

---

## Références bibliographiques — Partie 10

1. Insel RA, Dunne JL, Atkinson MA et al. « Staging presymptomatic type 1 diabetes: a scientific statement of JDRF, the Endocrine Society, and the ADA. » *Diabetes Care*, 2015; 38(10): 1964-1974.
2. Herold KC, Bundy BN, Long SA et al. (TrialNet TN-10). « An anti-CD3 antibody, teplizumab, in relatives at risk for type 1 diabetes. » *N Engl J Med*, 2019; 381(7): 603-613.
3. Waibel M, Wentworth JM, So M et al. « Baricitinib and β-cell function in patients with new-onset type 1 diabetes. » *N Engl J Med*, 2023; 389(23): 2140-2150.
4. Shapiro AMJ, Lakey JRT, Ryan EA et al. « Islet transplantation in seven patients with type 1 diabetes mellitus using a glucocorticoid-free immunosuppressive regimen. » *N Engl J Med*, 2000; 343(4): 230-238.
5. Shapiro AMJ, Thompson D, Donner TW et al. « Insulin expression and C-peptide in type 1 diabetes subjects implanted with stem cell-derived fully differentiated islet cells. » *Cell Rep Med*, 2023; 4(7): 101120.
6. Pagliuca FW, Millman JR, Gürtler M et al. « Generation of functional human pancreatic β cells in vitro. » *Cell*, 2014; 159(2): 428-439.
7. Abràmoff MD, Lavin PT, Birch M et al. « Pivotal trial of an autonomous AI-based diagnostic system for detection of diabetic retinopathy. » *npj Digital Medicine*, 2018; 1: 39.
8. International Diabetes Federation. *IDF Diabetes Atlas*, 10th edition, 2024. Brussels, Belgium.
9. Patterson CC, Harjutsalo V, Rosenbauer J et al. « Trends and cyclical variation in the incidence of childhood type 1 diabetes in 26 European centres. » *Lancet Diabetes Endocrinol*, 2019; 7(11): 850-863.

---

> 🔶 **DIABÉTOLOGIE** | Partie 10/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
# CAHIER DES CHARGES — FORMATION DIABÉTOLOGIE COMPLÈTE
## Partie 11 — Organisation des Soins et Éducation Thérapeutique (Modules 39-40)

**Date** : 13 mars 2026
**Version** : 1.0
**Formation** : Diabétologie Complète
**Plateforme** : VERTEX©

---

# MODULE 39 : PARCOURS DE SOINS DU PATIENT DIABÉTIQUE — ORGANISATION, TÉLÉMÉDECINE, QUALITÉ

**Partie** : XI — Organisation et éducation
**Durée estimée** : 2h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 29

## Accroche clinique

> 🏥 **Mise en situation** : Mme L., 58 ans, DT2 depuis 10 ans, vit dans un village sans diabétologue à proximité (le plus proche est à 80 km). Son médecin traitant assure le suivi mais se sent « dépassé » par les nouvelles recommandations (iSGLT2, aGLP-1, finérénone). Il aimerait un avis spécialisé mais la patiente refuse de « faire la route ». *L'organisation du parcours de soins et la télémédecine sont devenues indispensables pour garantir un accès équitable aux soins diabétologiques.*

## Objectifs d'apprentissage

1. **Organiser** le parcours de soins du diabétique selon les recommandations HAS
2. **Connaître** le rôle de chaque professionnel dans le suivi multidisciplinaire
3. **Utiliser** la télémédecine (téléconsultation, téléexpertise, télésurveillance) en diabétologie
4. **Appliquer** les indicateurs de qualité du suivi diabétique
5. **Connaître** le cadre médico-social : ALD, droits du patient, associations

## Structure du contenu

### Section 1 — Parcours de soins et suivi structuré

**Contenu obligatoire :**

- **Parcours de soins HAS** (guide du parcours de soins DT2 — HAS, mise à jour 2024) :
  - Médecin traitant : pivot du suivi (diagnostic, traitement initial, coordination, renouvellements)
  - Diabétologue/endocrinologue : recours (DT1, DT2 complexe, technologies, complications sévères, grossesse)
  - Infirmier(e) : ETP, injections, surveillance (IDEL, IPA — Infirmier en Pratique Avancée)
  - Diététicien(ne) : bilan nutritionnel, programme alimentaire personnalisé
  - Podologue : soins de pieds (remboursés selon le grade podologique)
  - Ophtalmologue : FO annuel, dépistage RD
  - Néphrologue : si DFG < 30, déclin rapide, ou néphropathie atypique
  - Cardiologue : si FRCV multiples, IC, ischémie silencieuse
  - Psychologue : dépression, détresse, TCA
  - Pharmacien : conseil, adhésion, entretiens pharmaceutiques
- **Bilan annuel structuré** (check-list) :
  - HbA1c (trimestrielle si objectif non atteint, semestrielle si stable)
  - Bilan lipidique (annuel)
  - Créatinine + DFG + RAC (annuel)
  - FO ou rétinophotographie (annuel, biennal si grade 0 stable)
  - ECG de repos (annuel)
  - Examen des pieds + monofilament (annuel)
  - Évaluation diététique
  - Dépistage dépression (PHQ-2)
  - Vaccinations à jour
  - Bilan dentaire (annuel — risque parodontal ↑)
- **ALD 8** (Affection de Longue Durée — diabète de type 1 et 2) : prise en charge 100 % par l'Assurance Maladie pour les soins en rapport ; protocole de soins établi par le médecin traitant ; renouvellement tous les 5 ans

> [MEDIA: 📋 MDIAB39-S01-001 — CHECK-LIST BILAN ANNUEL DT2 (tableau : examen, fréquence, qui réalise, quand adresser)]

> [MEDIA: 📋 MDIAB39-S01-002 — SCHÉMA PARCOURS DE SOINS MULTIDISCIPLINAIRE (médecin traitant au centre, flèches vers spécialistes, fréquence de recours)]

### Section 2 — Télémédecine et e-santé

**Contenu obligatoire :**

- **Cadre réglementaire** : loi de financement SS 2018, avenant 6 (conventions télémédecine) ; 5 actes : téléconsultation, téléexpertise, télésurveillance, téléassistance, régulation médicale
- **Applications en diabétologie** :
  - **Téléconsultation** : consultation vidéo diabétologue-patient → suivi DT2 stable, ajustement ADO, ETP à distance ; avantages : accès en zone sous-médicalisée, gain de temps
  - **Téléexpertise** : avis du diabétologue sollicité par le médecin traitant sans présence du patient → choix thérapeutique, interprétation CGM ; cadre : asynchrone, rémunéré
  - **Télésurveillance** : suivi à distance des données du patient (glycémie CGM, PA, poids) avec alertes ; programme ETAPES puis pérennisation (2023) : remboursement forfaitaire pour le suivi CGM à distance des DT1 et DT2 sous insuline → diabétologue analyse les données AGP et ajuste le traitement à distance
  - **Plateformes numériques** : applications de suivi (MySugr, Diabeloop, LibreView, CareLink) → partage des données CGM/pompe avec l'équipe soignante → télé-ajustements
- **Limites** : fracture numérique (personnes âgées, zones blanches), examen clinique impossible (pieds +++), confidentialité des données, relation médecin-patient altérée

> [MEDIA: 🖥️ MDIAB39-S02-001 — SCHÉMA TÉLÉMÉDECINE EN DIABÉTOLOGIE (téléconsultation, téléexpertise, télésurveillance — flux de données patient/médecin)]

### Section 3 — Indicateurs de qualité et démarches d'amélioration

**Contenu obligatoire :**

- **Indicateurs ROSP** (Rémunération sur Objectifs de Santé Publique — médecin traitant) :
  - % de DT2 avec HbA1c < 7 % (ou cible individualisée atteinte)
  - % de DT2 avec FO réalisé dans l'année
  - % de DT2 avec dosage RAC/créatinine dans l'année
  - % de DT2 sous statine si indication
  - % de DT2 avec examen des pieds documenté
- **Registres et programmes qualité** : Programme Sophia (Assurance Maladie — accompagnement téléphonique par des infirmiers) ; registres régionaux de suivi du DT1 (BPD, SFDT1)
- **Parcours ville-hôpital** : coordination via les CPTS (Communautés Professionnelles Territoriales de Santé), DAC (Dispositifs d'Appui à la Coordination), protocoles de coopération IPA-diabétologue

## Points clés — Module 39

> 🎯 **Essentiel à retenir**
> 1. Le médecin traitant est le pivot du suivi DT2 — le diabétologue intervient en recours
> 2. Bilan annuel structuré : HbA1c, lipides, rein (DFG+RAC), FO, pieds, ECG, dépression
> 3. ALD 8 : 100 % pour les soins en rapport avec le diabète
> 4. La télésurveillance CGM est remboursée (programme ETAPES/pérennisation)
> 5. La téléexpertise permet l'avis diabétologique sans déplacement du patient
> 6. Indicateurs ROSP : outils de suivi de qualité en médecine générale

## Auto-évaluation — Module 39

### QCM progressifs (6 questions)

**Q1 — 🥉 Bronze** : Quelle est la fréquence recommandée du dosage de l'HbA1c chez un DT2 à l'objectif ?
A. Mensuelle  B. Trimestrielle  C. Semestrielle  D. Annuelle
> ✅ **C** — Si l'HbA1c est à l'objectif et stable, un dosage semestriel suffit. En revanche, si l'objectif n'est pas atteint ou en cas de modification thérapeutique, le dosage trimestriel est recommandé.

**Q2 — 🥉 Bronze** : Qu'est-ce que l'ALD 8 ?
A. Un protocole de recherche  B. L'Affection de Longue Durée pour le diabète → prise en charge 100 % par l'AM  C. Un type de diabète  D. Un examen de dépistage
> ✅ **B** — L'ALD 8 est le cadre réglementaire de prise en charge à 100 % par l'Assurance Maladie des soins en rapport avec le diabète (DT1 et DT2).

**Q3 — 🥈 Argent** : Qu'est-ce que la téléexpertise en diabétologie ?
A. Consultation vidéo avec le patient  B. Avis spécialisé du diabétologue sollicité par le médecin traitant, sans présence du patient  C. Surveillance automatique par IA  D. Formation en ligne
> ✅ **B** — La téléexpertise permet au médecin traitant de solliciter l'avis du diabétologue (choix thérapeutique, interprétation CGM) sans que le patient ait besoin de se déplacer. Elle est rémunérée et peut être asynchrone.

**Q4 — 🥇 Or** : Comment la télésurveillance CGM fonctionne-t-elle en pratique ?
A. Le patient envoie ses glycémies par SMS  B. Les données CGM sont partagées automatiquement via une plateforme → le diabétologue analyse l'AGP à distance et ajuste le traitement  C. Un infirmier visite le patient quotidiennement  D. Le patient se déplace mensuellement pour télécharger ses données
> ✅ **B** — La télésurveillance CGM utilise des plateformes numériques (LibreView, CareLink, Dexcom Clarity) où les données sont partagées automatiquement. Le diabétologue analyse l'AGP, identifie les patterns et ajuste le traitement à distance.

**Q5 — 💎 Diamant** : Mme L. (accroche) : proposez un parcours de soins intégrant la télémédecine pour cette patiente en zone sous-médicalisée.
> ✅ (1) **Médecin traitant** : suivi trimestriel présentiel (examen clinique, pieds, PA, prescription bilan), ajustement ADO selon téléexpertise ; (2) **Téléconsultation diabétologue** : semestrielle (bilan complications, stratégie thérapeutique, CGM review si applicable) ; (3) **Téléexpertise** : entre consultations → le MT envoie les résultats et questions → le diabétologue répond sous 72h avec recommandations ; (4) **FO** : rétinophotographie non mydriatique via réseau de télé-ophtalmologie (OPHDIAT) → lecture déportée ; (5) **Podologue** : présentiel selon grade (MSP ou tournée podologique) ; (6) **IPA** : suivi intermédiaire (ETP, titration insuline si nécessaire) → en présentiel ou téléconsultation ; (7) **Pharmacien** : entretiens pharmaceutiques (adhésion), dispensation adaptée.

---

# MODULE 40 : ÉDUCATION THÉRAPEUTIQUE STRUCTURÉE DU DT2 — PROGRAMMES, OUTILS, ÉVALUATION

**Partie** : XI — Organisation et éducation
**Durée estimée** : 2h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Module 24 (ETP DT1), 25, 29

## Accroche clinique

> 🏥 **Mise en situation** : M. K., 60 ans, DT2 depuis 5 ans, sous metformine + sémaglutide. HbA1c : 7,5 %. Il consulte en disant : « Je ne comprends pas pourquoi je prends autant de médicaments. Ma voisine est diabétique aussi et elle ne prend rien. Et d'ailleurs, pourquoi je ne dois pas manger de pain blanc alors que mon père en mangeait et vivait bien ? » *Le DT2 est une maladie où l'éducation thérapeutique n'est pas un complément mais une composante intégrale du traitement — un patient qui comprend sa maladie la gère mieux.*

## Objectifs d'apprentissage

1. **Structurer** un programme d'ETP pour le DT2 : objectifs, méthodes, évaluation
2. **Utiliser** les techniques pédagogiques adaptées au DT2 (entretien motivationnel, approche centrée patient)
3. **Adapter** l'ETP aux populations spécifiques (sujet âgé, migrant, faible littératie)
4. **Évaluer** l'efficacité d'un programme d'ETP (indicateurs cliniques et pédagogiques)

## Structure du contenu

### Section 1 — Principes et méthodes pédagogiques

**Contenu obligatoire :**

- **Entretien motivationnel** (Miller & Rollnick) : technique de communication centrée sur le patient, explorant l'ambivalence face au changement ; principes OARS : Open questions, Affirm, Reflect, Summarize ; efficacité démontrée dans le DT2 (amélioration HbA1c, adhésion, comportements — Ekong & Kavookjian, Patient Educ Couns, 2016)
- **Approche centrée patient** (Patient-Centered Care) : le patient est expert de sa maladie au quotidien ; le soignant est expert du savoir médical → partenariat ; objectifs thérapeutiques négociés, pas imposés
- **Méthodes pédagogiques** :
  - Individuelles : consultation d'ETP (30-45 min), utilisation de supports visuels, teach-back method (le patient explique ce qu'il a compris)
  - Collectives : ateliers en petit groupe (6-10 patients), partage d'expériences, dynamique de groupe → particulièrement efficace pour l'alimentation et l'activité physique
  - Outils numériques : applications de suivi (carnet glycémique, suivi alimentaire), serious games, vidéos éducatives, webinaires

### Section 2 — Programme d'ETP structuré pour le DT2

**Contenu obligatoire :**

- **Diagnostic éducatif** : identique au DT1 (cf. module 24) mais adapté aux spécificités du DT2 (adulte d'âge mûr, souvent comorbidités, souvent découverte fortuite → déni fréquent, représentations culturelles de l'alimentation)
- **Compétences cibles** (adapté de HAS 2007) :
  - Comprendre sa maladie (mécanismes simples du DT2, rôle de l'insuline, progression)
  - Comprendre son traitement (pourquoi chaque médicament, quand le prendre, effets attendus et secondaires)
  - Adapter son alimentation (pas de régime restrictif, équilibre, plaisir alimentaire préservé)
  - Pratiquer une activité physique régulière (adaptée, progressive, durable)
  - Surveiller (glycémie si insuline/SU, pieds, signes d'alerte)
  - Gérer les situations à risque (hypoglycémie si SU/insuline, maladie intercurrente, voyage)
  - Intégrer le diabète dans sa vie quotidienne (travail, famille, vie sociale, sexualité)
- **Programme type** (4-5 séances de 2-3h sur 3-6 mois) :
  - Séance 1 : Diagnostic éducatif + « Qu'est-ce que le DT2 ? » (physiopathologie simplifiée, représentations)
  - Séance 2 : Alimentation (assiette idéale, index glycémique, recettes, convivialité préservée)
  - Séance 3 : Activité physique (prescription personnalisée, obstacles, solutions pratiques)
  - Séance 4 : Traitements et surveillance (mécanismes simplifiés, gestion hypo, observance)
  - Séance 5 : Vivre avec le DT2 (complications à prévenir, droits sociaux, ressources, bilan éducatif)
  - Suivi de renforcement : séances espacées (trimestrielles → semestrielles → annuelles)

> [MEDIA: 📋 MDIAB40-S02-001 — PROGRAMME ETP DT2 TYPE (5 séances — thèmes, objectifs, méthodes pédagogiques, intervenants)]

> [MEDIA: 🍽️ MDIAB40-S02-002 — OUTIL PÉDAGOGIQUE « L'ASSIETTE IDÉALE » (support visuel pour atelier alimentation)]

### Section 3 — Adaptation et populations spécifiques

**Contenu obligatoire :**

- **Sujet âgé** : simplification des messages, priorité à la sécurité (éviter les hypos) et à la qualité de vie, implication de l'aidant, adaptation cognitive (répétition, supports visuels, gros caractères)
- **Patient migrant / faible littératie** : supports visuels et iconographiques (pictogrammes, photos d'aliments locaux), interprète professionnel si barrière linguistique, adaptation culturelle des conseils alimentaires (ne pas imposer un modèle alimentaire « occidental »), médiateur de santé
- **Patient en situation de précarité** : accès aux droits sociaux (ALD, CMU/CSS, CMUC), aide alimentaire adaptée (banques alimentaires avec conseils diététiques), accès aux soins podologiques gratuits
- **Patient réticent ou en déni** : entretien motivationnel +++, ne pas « faire la morale », explorer les freins, commencer par 1 objectif simple et concret, valoriser chaque petit progrès

### Section 4 — Évaluation de l'ETP

**Contenu obligatoire :**

- **Indicateurs cliniques** : HbA1c, poids, PA, LDL-c, taux de complications, hospitalisations
- **Indicateurs pédagogiques** : acquisition de connaissances (questionnaires pré/post), compétences d'auto-soins (auto-surveillance, gestion hypo, adaptation alimentaire), compétences d'adaptation (résolution de problèmes, gestion émotionnelle)
- **Indicateurs de qualité de vie** : DQoL, WHO-5, PAID, satisfaction (DTSQ)
- **Indicateurs de processus** : taux de participation, taux de complétion, satisfaction des patients, attrition
- **Évaluation à long terme** : maintien des acquis à 6 mois, 1 an → sessions de renforcement

> [MEDIA: 📊 MDIAB40-S04-001 — INDICATEURS D'ÉVALUATION ETP (cliniques, pédagogiques, qualité de vie — tableau avec outils de mesure)]

## Points clés — Module 40

> 🎯 **Essentiel à retenir**
> 1. L'ETP est une composante intégrale du traitement du DT2, pas un « complément »
> 2. L'entretien motivationnel est plus efficace que la prescription directive
> 3. Programme structuré : 4-5 séances + suivi de renforcement → amélioration HbA1c + qualité de vie
> 4. Adaptation culturelle obligatoire (alimentation, littératie, langue)
> 5. Le diagnostic éducatif est la 1ère étape indispensable
> 6. Évaluation multidimensionnelle : clinique + pédagogique + qualité de vie
> 7. Le patient est expert de sa maladie au quotidien → partenariat, pas prescription

## Auto-évaluation — Module 40

### QCM progressifs (8 questions)

**Q1 — 🥉 Bronze** : Quel est le principe fondamental de l'entretien motivationnel ?
A. Convaincre le patient par des arguments scientifiques  B. Explorer l'ambivalence du patient face au changement, dans une approche empathique et non jugeante  C. Imposer des règles strictes  D. Menacer le patient avec les complications
> ✅ **B** — L'entretien motivationnel explore l'ambivalence du patient (il veut et ne veut pas changer en même temps) de manière empathique, sans jugement. Le soignant aide le patient à trouver ses propres motivations au changement.

**Q2 — 🥉 Bronze** : Quelle est la 1ère étape de tout programme d'ETP ?
A. L'atelier alimentation  B. Le diagnostic éducatif (bilan éducatif partagé)  C. Le dosage de l'HbA1c  D. La prescription de médicaments
> ✅ **B** — Le diagnostic éducatif (comprendre le patient : connaissances, croyances, vécu, freins, ressources, projets) est toujours la 1ère étape, avant tout enseignement.

**Q3 — 🥈 Argent** : Comment adapter l'ETP pour un patient migrant avec barrière linguistique ?
A. Pas d'ETP possible  B. Supports visuels, interprète professionnel, adaptation culturelle des conseils alimentaires, médiateur de santé  C. ETP en anglais  D. ETP uniquement écrite
> ✅ **B** — L'adaptation passe par des supports visuels et iconographiques, un interprète professionnel (pas un proche), l'adaptation culturelle des conseils (aliments locaux, habitudes alimentaires respectées), et si possible un médiateur de santé.

**Q4 — 🥈 Argent** : La méthode « teach-back » consiste en :
A. Donner un cours magistral au patient  B. Demander au patient d'expliquer avec ses propres mots ce qu'il a compris  C. Faire un test écrit  D. Lire une brochure au patient
> ✅ **B** — Le teach-back vérifie la compréhension en demandant au patient de reformuler avec ses propres mots. Ce n'est pas un test de connaissances mais un outil de communication qui permet d'identifier et de corriger les malentendus.

**Q5 — 🥇 Or** : M. K. (accroche) : « Pourquoi je prends autant de médicaments alors que ma voisine ne prend rien ? » Comment répondez-vous ?
> ✅ « Chaque diabète est différent. Le diabète de votre voisine est peut-être plus récent, moins avancé, ou elle a peut-être perdu beaucoup de poids. Vos médicaments sont là pour 3 raisons précises : (1) la metformine aide votre foie à mieux réguler le sucre — c'est le traitement de base depuis 25 ans ; (2) le sémaglutide aide votre pancréas à mieux sécréter l'insuline pendant les repas ET vous aide à perdre du poids — c'est un médicament récent qui protège aussi votre cœur ; (3) si vous arrêtiez, votre glycémie remonterait et les complications arriveraient silencieusement (yeux, reins, pieds). L'objectif n'est pas de prendre des médicaments pour toujours — si vous perdez suffisamment de poids, on pourrait en réduire certains. »

**Q6 — 🥇 Or** : M. K. : « Pourquoi pas de pain blanc alors que mon père en mangeait ? » Comment répondez-vous en ETP ?
> ✅ « Votre père avait peut-être un pancréas qui fonctionnait mieux que le vôtre. Le pain blanc n'est pas interdit — il fait simplement monter la glycémie très vite (index glycémique élevé). Le pain complet ou aux céréales fait monter la glycémie plus doucement, ce qui est plus facile à gérer pour votre pancréas. Vous pouvez continuer à manger du pain, mais préférez-le complet et en quantité raisonnable. Le but n'est pas de supprimer les aliments que vous aimez mais de trouver des alternatives qui vous plaisent. »

**Q7 — 💎 Diamant** : Un patient DT2 de 68 ans, d'origine maghrébine, faible littératie en français, refuse l'activité physique car « ce n'est pas dans ma culture ». Comment abordez-vous l'ETP ?
> ✅ (1) **Entretien motivationnel** : explorer ses représentations (« Racontez-moi comment vous voyez l'activité physique ») ; (2) **Adaptation culturelle** : identifier les activités déjà pratiquées (marche pour la prière, jardinage, jeux avec les petits-enfants) → valoriser et s'appuyer dessus (« En fait, vous bougez déjà ! ») ; (3) **Ne pas imposer un modèle occidental** (salle de sport) mais proposer des alternatives culturellement acceptables : marche en groupe (avec amis/famille), activités au domicile ; (4) **Supports visuels** : photos d'exercices simples, pas de texte long ; (5) **Médiateur de santé arabophone** si disponible ; (6) **Objectif négocié** : 1 seul objectif concret (« marcher 20 min après le déjeuner, 3 jours par semaine ») ; (7) **Valoriser chaque progrès** à la consultation suivante.

**Q8 — 💎 Diamant** : Construisez un programme d'ETP pour un groupe de 8 patients DT2 nouvellement diagnostiqués, en 5 séances.
> ✅ **Séance 1** (3h) — « Mon diabète et moi » : diagnostic éducatif individuel (20 min chacun en parallèle si 2 animateurs) ; atelier collectif : « Qu'est-ce que le DT2 ? » (physiopathologie simplifiée avec métaphore : clé-serrure-insuline, réservoir qui déborde) ; recueil des représentations et des questions. **Séance 2** (3h) — « Mon assiette » : atelier pratique alimentation (assiette modèle, tri d'aliments photos, lecture d'étiquettes, recettes adaptées) ; accent sur le plaisir et la convivialité, pas les interdits. **Séance 3** (3h) — « Bouger au quotidien » : atelier activité physique (identification des freins, solutions pratiques, démonstration d'exercices simples, objectif SMART personnalisé) ; séance de marche collective de 20 min. **Séance 4** (3h) — « Mes traitements et ma surveillance » : atelier médicaments (pourquoi chaque médicament, comment le prendre, effets secondaires) ; gestion hypo si SU/insuline ; auto-surveillance glycémique (si applicable) ; soins des pieds (démonstration). **Séance 5** (3h) — « Vivre avec le DT2 » : droits sociaux (ALD, CSS), prévention des complications (FO, pieds, rein — pourquoi les bilans), vie sociale et professionnelle, ressources (associations : FFD, AFD) ; bilan éducatif partagé → objectifs de suivi individuels. **Renforcement** : 1 séance à M3, M6, M12 puis annuelle.

### Cas clinique intégré — Module 40

> 📝 **Cas clinique : Mme S., 55 ans, DT2 depuis 2 ans**
>
> Mme S., aide-soignante, DT2 sous metformine 2 g/j. HbA1c : 7,9 %. IMC : 34. Vit seule. Elle dit : « Je n'ai pas le temps de cuisiner, je mange au self de l'hôpital et le soir c'est des plats tout prêts. Je sais que c'est mal mais je suis fatiguée en rentrant. » PHQ-2 : 3/6. Elle ne fait aucune activité physique.
>
> **Questions :**
> 1. Réalisez le diagnostic éducatif de Mme S. (connaissances, freins, ressources, croyances identifiables).
> 2. Quels objectifs éducatifs négocieriez-vous avec elle pour les 3 prochains mois ?
> 3. Comment abordez-vous la question alimentaire sans culpabilisation ?
> 4. Le PHQ-2 à 3/6 : quelle action ?
> 5. Quel suivi éducatif proposez-vous ?

### Question de synthèse

> 🔄 **Synthèse** : Construisez le parcours éducatif complet d'un patient DT2, du diagnostic à 5 ans de suivi, en intégrant les séances initiales, les séances de renforcement, les indicateurs d'évaluation, et les adaptations en fonction de l'évolution de la maladie et du vécu du patient.

---

## Références bibliographiques — Partie 11

1. HAS. « Guide du parcours de soins — Diabète de type 2 de l'adulte. » Mise à jour 2024.
2. HAS. « Éducation thérapeutique du patient — Définition, finalités et organisation. » Recommandations, 2007.
3. Miller WR, Rollnick S. *Motivational Interviewing: Helping People Change.* 3rd ed. New York: Guilford Press, 2013.
4. d'Ivernois JF, Gagnayre R. *Apprendre à éduquer le patient.* 6e éd. Paris: Maloine, 2020.
5. Ekong G, Kavookjian J. « Motivational interviewing and outcomes in adults with type 2 diabetes: A systematic review. » *Patient Educ Couns*, 2016; 99(6): 944-952.
6. Haute Autorité de Santé. « Stratégie médicamenteuse du contrôle glycémique du diabète de type 2. » Recommandation de bonne pratique, mise à jour 2024.

---

> 🔶 **DIABÉTOLOGIE** | Partie 11/12 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
