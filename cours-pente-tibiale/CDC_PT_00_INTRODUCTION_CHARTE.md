# CAHIER DES CHARGES — FORMATION COMPLÈTE : GESTION DE LA PENTE TIBIALE EN CHIRURGIE DU GENOU

## Partie 0 — Introduction générale, Charte graphique et Architecture pédagogique

**Date** : 29 mars 2026
**Version** : 1.0
**Statut** : Document fondateur — Cahier des charges complet
**Plateforme** : VERTEX© — Formation médicale en ligne
**Formation** : La Pente Tibiale en Chirurgie du Genou — *Posterior Tibial Slope Management in Knee Surgery*

---

# TABLE DES MATIÈRES — PARTIE 0

1. [Synthèse exécutive](#1-synthèse-exécutive)
2. [Public cible et prérequis](#2-public-cible-et-prérequis)
3. [Architecture pédagogique globale](#3-architecture-pédagogique-globale)
4. [Charte graphique — Plateforme VERTEX©](#4-charte-graphique--plateforme-vertex)
5. [Code couleur — Formation Pente Tibiale](#5-code-couleur--formation-pente-tibiale)
6. [Règles d'écriture du contenu](#6-règles-décriture-du-contenu)
7. [Structure des fichiers du CDC](#7-structure-des-fichiers-du-cdc)
8. [Correspondance inter-formations](#8-correspondance-inter-formations)

---

# 1. SYNTHÈSE EXÉCUTIVE

## 1.1 Ce qu'est cette formation

La **Formation Gestion de la Pente Tibiale en Chirurgie du Genou** est un programme e-learning exhaustif destiné aux chirurgiens orthopédistes, couvrant **l'intégralité** de la pente tibiale postérieure (*Posterior Tibial Slope*, PTS) — de son histoire et son évolution conceptuelle à son rôle central dans chaque technique chirurgicale du genou : ostéotomie, ligamentoplastie du LCA et du LCP, prothèse totale (PTG), prothèse unicompartimentale (PUC), chirurgie de reprise, et les innovations robotiques et assistées par ordinateur.

La pente tibiale est un paramètre biomécanique **critique et transversal** dont la maîtrise conditionne le succès de toute chirurgie du genou. Son importance a été historiquement sous-estimée et reste aujourd'hui mal enseignée malgré une littérature scientifique abondante démontrant son impact sur :
- La stabilité antéro-postérieure du genou natif et prothésé
- La fonction et les performances du ligament croisé antérieur natif et reconstruit
- La cinématique prothétique et la satisfaction des patients
- Le taux d'échec des ligamentoplasties et des prothèses
- La survie à long terme des implants

Elle constitue la **quatorzième formation** de la plateforme VERTEX©. Les formations partagent :
- La même **plateforme LMS** (architecture, authentification, évaluation)
- La même **charte graphique** de base (typographie, mise en page, icônes)
- Les mêmes **règles d'écriture pédagogique** (cas cliniques, mnémoniques, niveaux de profondeur)
- Les mêmes **standards d'évaluation** (Bronze → Diamant, cas cliniques progressifs)
- Le même **moteur de simulation** VERTEX© (adapté : SlopeSim© pour la modélisation biomécanique de la pente tibiale, simulation de coupes osseuses, planification 3D des ostéotomies et des PTG)

## 1.2 Périmètre de la formation

- **Modules** : 30 modules en 10 parties
- **Durée** : ~90-100 heures
- **Niveau** : Fondamental → Intermédiaire → Expert
- **Spécialité** : Chirurgie orthopédique — genou
- **Simulation** : SlopeSim© (modélisation 3D, coupes osseuses, forces de cisaillement)
- **Certification** : Certificat VERTEX© Pente Tibiale, éligible DPC/CME
- **Langue** : Français (terminologie bilingue FR/EN)

### Couverture — Volet fondamental

Histoire, anatomie du plateau tibial, embryologie, biomécanique (statique, dynamique, FEM), imagerie et mesure (radiographie, TDM, IRM, EOS), variabilité anatomique (âge, sexe, ethnie, morphotype).

### Couverture — Volet chirurgical

- LCA (natif et reconstruit)
- LCP et instabilités multiligamentaires
- Ostéotomie tibiale (HTO ouverture, fermeture, biplan)
- PTG (alignement mécanique, cinématique, fonctionnel)
- PUC (médiale, latérale, patello-fémorale)
- Chirurgie de reprise (analyse d'échec, reconstruction)
- Traumatologie (fractures du plateau, malunion)
- Arthrose (genèse, progression, axe mécanique)

### Couverture — Volet technologique

Navigation, robotique (MAKO, ROSA, CORI, Velys), PSI, planification 3D, intelligence artificielle.

## 1.3 Justification scientifique de cette formation dédiée

La pente tibiale postérieure (PTS) est un paramètre biomécanique fondamental du genou dont l'importance a été progressivement révélée par la littérature :

### Niveau de preuve — Données clés

| Fait scientifique | Référence | Niveau de preuve |
|---|---|---|
| Chaque degré d'augmentation de PTS augmente la translation tibiale antérieure (TTA) de ~6% | Dejour & Bonnin, Rev Chir Orthop 1994 ; Giffin et al., AJSM 2004 | Études biomécaniques cadavériques (NP II) |
| PTS > 12° = facteur de risque indépendant de rupture du LCA | Brandon et al., AJSM 2006 ; Christensen et al., AJSM 2017 | Méta-analyses (NP I) |
| PTS > 12° après reconstruction LCA = facteur de risque de re-rupture | Webb et al., AJSM 2013 ; Salmon et al., KSSTA 2018 | Études de cohorte (NP II) |
| En PTG, chaque degré de PTS augmenté au-delà de 7° accroît la contrainte sur le polyéthylène de 8-10% | Whiteside & Amador, Clin Orthop 1988 ; Fujimoto et al., JBJS 2014 | Études biomécaniques et FEM (NP II) |
| L'ostéotomie tibiale de valgisation par ouverture médiale augmente la PTS de 2-4° en moyenne si non contrôlée | Noyes et al., AJSM 2005 ; Lustig et al., KSSTA 2015 | Études radiologiques (NP III) |
| La pente tibiale influence significativement la cinématique prothétique (rollback, mid-flexion instability) | Kang et al., JBJS 2017 ; Chia et al., KSSTA 2022 | Études biomécaniques in vivo (fluoroscopie) |
| Alignement cinématique vs mécanique : la restauration de la pente native est associée à de meilleurs scores fonctionnels | Howell et al., JBJS 2019 ; Lee et al., KSSTA 2021 | Essais randomisés (NP I) |

### Pourquoi une formation dédiée ?

1. **Transversalité** : La pente tibiale intervient dans TOUTES les chirurgies du genou — c'est le paramètre le plus transversal et pourtant le moins systématiquement enseigné
2. **Impact clinique majeur** : Les erreurs de gestion de la pente sont responsables d'échecs de ligamentoplasties, d'instabilités prothétiques, de descellements précoces et de fractures du polyéthylène
3. **Évolution conceptuelle récente** : Le passage de l'alignement mécanique classique (pente fixe 0-3°) à l'alignement cinématique (restauration de la pente native 5-9°) a bouleversé les pratiques
4. **Lacune pédagogique** : Aucune formation existante ne traite la pente tibiale de manière exhaustive et transversale — elle est toujours abordée comme un sous-chapitre d'une autre technique
5. **Complexité technique** : La mesure, la planification et la réalisation peropératoire de la pente correcte nécessitent une compréhension profonde de l'anatomie, de la biomécanique et de la technique chirurgicale

## 1.4 Objectifs pédagogiques globaux

À l'issue de cette formation, le praticien sera capable de :

1. **Décrire** l'anatomie du plateau tibial et les déterminants anatomiques de la pente tibiale postérieure
2. **Mesurer** la pente tibiale sur radiographies standard, TDM et IRM selon les méthodes validées
3. **Expliquer** l'impact biomécanique de la pente tibiale sur la stabilité antéro-postérieure, la cinématique du genou et les contraintes sur les structures ligamentaires et prothétiques
4. **Identifier** les situations cliniques où la pente tibiale pathologique (excessive ou insuffisante) est un facteur de risque ou une cause d'échec
5. **Planifier** la correction ou la préservation de la pente tibiale dans chaque type de chirurgie du genou (ostéotomie, ligamentoplastie, PTG, PUC, reprise)
6. **Maîtriser** les techniques chirurgicales de contrôle de la pente (positionnement des guides de coupe, orientation des ostéotomies, ajustement des résections tibiales)
7. **Intégrer** les technologies modernes (navigation, robotique, PSI, planification 3D) dans la gestion de la pente
8. **Analyser** les échecs liés à la pente tibiale et planifier les stratégies de correction en reprise
9. **Évaluer** de manière critique la littérature sur la pente tibiale et ses implications pratiques
10. **Appliquer** les concepts d'alignement mécanique, cinématique et fonctionnel en relation avec la pente tibiale

---

# 2. PUBLIC CIBLE ET PRÉREQUIS

## 2.1 Public cible

| Niveau | Public | Modules obligatoires | Modules optionnels |
|---|---|---|---|
| **Niveau 1 — Fondamental** | Internes orthopédie (3ème-5ème année), chirurgiens en début de pratique, médecins du sport | Modules 1-10, 27-28 | 29-30 |
| **Niveau 2 — Intermédiaire** | Chirurgiens orthopédistes en pratique courante, fellows genou | Modules 1-22, 27-28 | 23-26, 29-30 |
| **Niveau 3 — Expert** | Chirurgiens spécialisés genou, experts en arthroplastie ou ligamentoplastie, universitaires, R&D implants | Modules 1-30 (intégralité) | — |

## 2.2 Prérequis

- Diplôme de médecine (ou en cours d'obtention, ≥3ème année d'internat)
- Connaissances en anatomie du membre inférieur
- Notions de biomécanique articulaire (souhaitées mais couvertes dans les Modules 4-5)
- Formation PTG de VERTEX© recommandée (non obligatoire)

---

# 3. ARCHITECTURE PÉDAGOGIQUE GLOBALE

## 3.1 Organisation en 10 parties — 30 modules

```
FORMATION PENTE TIBIALE — GESTION DE LA PENTE TIBIALE EN CHIRURGIE DU GENOU
│
├── PARTIE I — HISTOIRE ET ÉVOLUTION CONCEPTUELLE (Modules 1-2)
│   ├── Module 1  : Histoire de la pente tibiale — De l'observation anatomique au paramètre chirurgical
│   │               (Antiquité → Weber 1836 → Dejour 1994 → alignement cinématique 2020s)
│   └── Module 2  : Évolution des concepts d'alignement du genou — Mécanique, anatomique, cinématique, fonctionnel
│                   (Insall → Hungerford → Howell → Rivière — impact sur la gestion de la pente)
│
├── PARTIE II — ANATOMIE ET EMBRYOLOGIE (Modules 3-4)
│   ├── Module 3  : Anatomie descriptive et fonctionnelle du plateau tibial
│   │               (Morphologie, plateaux médial/latéral, différence de pente, structures méniscales et ligamentaires, variabilité interindividuelle)
│   └── Module 4  : Embryologie, croissance et développement de la pente tibiale
│                   (Développement fœtal, ossification, évolution de la pente avec l'âge, facteurs génétiques et mécaniques, morphotypes ethniques)
│
├── PARTIE III — BIOMÉCANIQUE (Modules 5-7)
│   ├── Module 5  : Biomécanique fondamentale de la pente tibiale
│   │               (Forces de cisaillement, vecteur de charge, décomposition des forces, translation tibiale antérieure, modèle du plan incliné)
│   ├── Module 6  : Pente tibiale et stabilité ligamentaire — Interaction LCA/LCP
│   │               (Rôle de la pente dans la charge du LCA, contrainte sur le LCP, concept de « pente fonctionnelle », interaction ménisques-pente)
│   └── Module 7  : Biomécanique avancée — Modélisation par éléments finis et études in vivo
│                   (Modèles FEM, fluoroscopie dynamique, analyse de la marche, simulateurs de genou, études cadavériques — corrélations cliniques)
│
├── PARTIE IV — IMAGERIE ET MESURE (Modules 8-10)
│   ├── Module 8  : Mesure radiographique de la pente tibiale — Méthodes et pièges
│   │               (Radiographie de profil strict, méthodes de mesure : axe anatomique vs cortical, influence de la rotation, reproductibilité, valeurs normales)
│   ├── Module 9  : Imagerie avancée — TDM, IRM et EOS
│   │               (Mesure 3D de la pente médiale et latérale séparément, reconstructions multiplanaires, EOS et analyse debout charge, cartographie 3D du plateau)
│   └── Module 10 : Variabilité anatomique de la pente tibiale — Facteurs de variation
│                   (Âge, sexe, ethnie, morphotype, latéralité, IMC, pente médiale vs latérale, bases de données normatives, implications cliniques)
│
├── PARTIE V — PENTE TIBIALE ET LIGAMENT CROISÉ ANTÉRIEUR (Modules 11-14)
│   ├── Module 11 : Pente tibiale et LCA natif — Facteur de risque de rupture
│   │               (Épidémiologie, méta-analyses, PTS comme facteur de risque indépendant, seuils critiques, interaction avec d'autres facteurs : index de notch, laxité, facteurs neuromusculaires)
│   ├── Module 12 : Pente tibiale et reconstruction du LCA — Impact sur les résultats
│   │               (PTS et survie du greffon, re-rupture, laxité résiduelle, stratégies : faut-il corriger la pente avant/pendant la ligamentoplastie ?)
│   ├── Module 13 : Ostéotomie de déflexion tibiale — Correction de la pente dans le genou instable chronique
│   │               (Technique de Dejour, technique de coupes, technique Puddu, combined HTO + ligamentoplastie, indications, planification, résultats)
│   └── Module 14 : Pente tibiale et retour au sport après ligamentoplastie du LCA
│                   (Critères biomécaniques, performance, risque de re-rupture, rôle de la pente dans la décision de retour, programmes de prévention)
│
├── PARTIE VI — PENTE TIBIALE ET PROTHÈSE TOTALE DU GENOU (Modules 15-19)
│   ├── Module 15 : Pente tibiale en PTG — Principes fondamentaux
│   │               (Objectifs de pente selon la philosophie d'alignement, impact sur la flexion, rollback, gap balancing, stabilité AP, contraintes sur le PE)
│   ├── Module 16 : Pente tibiale et alignement mécanique classique
│   │               (Technique standard : PTS 0-3°, rationale biomécanique, résultats cliniques, limites, insatisfaction résiduelle 15-20%)
│   ├── Module 17 : Pente tibiale et alignement cinématique/fonctionnel
│   │               (Restauration de la pente native, philosophie de Howell, restricted kinematic alignment de Rivière, functional alignment, résultats comparatifs, controverses)
│   ├── Module 18 : Techniques chirurgicales de contrôle de la pente en PTG
│   │               (Positionnement du guide de coupe tibiale : extramedullaire vs intramédullaire, repères anatomiques, vérification peropératoire, erreurs fréquentes, tips & tricks)
│   └── Module 19 : Complications liées à la pente en PTG — Instabilité, usure et descellement
│                   (Pente excessive → instabilité en flexion, subluxation postérieure du PE ; pente insuffisante → limitation de flexion, douleur antérieure ; impact sur la survie, analyse d'échec, registres)
│
├── PARTIE VII — PENTE TIBIALE DANS LES AUTRES CHIRURGIES (Modules 20-23)
│   ├── Module 20 : Pente tibiale en prothèse unicompartimentale (PUC)
│   │               (PUC médiale : importance capitale de la pente native, Oxford vs Persona vs Zimmer, résections minimales, pente et survie, pente et progression du compartiment latéral)
│   ├── Module 21 : Pente tibiale en ostéotomie tibiale de valgisation (HTO)
│   │               (Modification involontaire de la pente lors de l'ouverture médiale, techniques de contrôle : biplan vs monoplan, planning Miniaci, fixation, résultats radiologiques)
│   ├── Module 22 : Pente tibiale et LCP — Instabilités postérieures et multiligamentaires
│   │               (Rôle protecteur de la pente sur le LCP, pente et lésion isolée du LCP, ostéotomie d'augmentation de la pente, combined surgery, protocoles de rééducation adaptés)
│   └── Module 23 : Pente tibiale en traumatologie — Fractures du plateau tibial
│                   (Fractures unicondylaires et bicondylaires, perte de la pente native après consolidation, malunion et pente vicieuse, ostéotomie correctrice secondaire, cal vicieux en recurvatum/flessum)
│
├── PARTIE VIII — CHIRURGIE DE REPRISE ET ANALYSE D'ÉCHEC (Modules 24-26)
│   ├── Module 24 : Analyse d'échec liée à la pente tibiale
│   │               (Algorithme diagnostique, pente excessive/insuffisante en PTG, conversion PUC → PTG et gestion de la pente, pente et descellement aseptique, imagerie comparative)
│   ├── Module 25 : Reprise de PTG avec correction de la pente
│   │               (Ostéotomie du tubercule tibial, augments métalliques, cônes et manchons, technique de coupe dans l'os remanié, planification 3D, résultats)
│   └── Module 26 : Reprise de ligamentoplastie avec correction de la pente
│                   (Échec de greffe LCA avec pente excessive, ostéotomie de déflexion + révision LCA, protocoles combinés, résultats à moyen/long terme)
│
├── PARTIE IX — TECHNOLOGIES ET INNOVATIONS (Modules 27-29)
│   ├── Module 27 : Navigation assistée par ordinateur et gestion de la pente
│   │               (Navigation optique, imageless navigation, CT-based navigation, précision de la coupe tibiale, courbes d'apprentissage, méta-analyses de précision)
│   ├── Module 28 : Robotique et pente tibiale — MAKO, ROSA, CORI, Velys
│   │               (Planification 3D robotique, exécution haptique/autonome, précision comparative, résultats cliniques, analyse coût-efficacité, registres)
│   └── Module 29 : PSI, impression 3D et intelligence artificielle
│                   (Guides de coupe patient-spécifiques, modèles 3D imprimés, IA pour la mesure automatique de la pente, deep learning et planification chirurgicale, perspectives)
│
└── PARTIE X — SYNTHÈSE, CAS CLINIQUES ET PERSPECTIVES (Module 30)
    └── Module 30 : Synthèse intégrative — Arbre décisionnel de la pente tibiale
                    (Algorithme global de gestion de la pente selon l'indication chirurgicale, synthèse des seuils, controverses actuelles, perspectives de recherche, registres en cours)
```

## 3.2 Structure standardisée de chaque module

Chaque module suit le **même format** que les autres formations VERTEX© (cf. REGLES_ECRITURE_CONTENU.md) :

1. **En-tête** : titre, partie, durée, niveau, prérequis
2. **Accroche clinique** : vignette patient ou mise en situation réelle (3-5 lignes)
3. **Objectifs d'apprentissage** : 3-7 objectifs (verbes de Bloom)
4. **Sections de contenu** : 3-6 sections principales avec cas cliniques intégrés
5. **Points clés** : 5-8 messages essentiels
6. **Auto-évaluation** : 5-10 questions (QCM, QROC, cas clinique)
7. **Références bibliographiques** : sources vérifiables (PubMed, JBJS, AJSM, KSSTA, Clin Orthop)

## 3.3 Parcours praticien — Déblocage séquentiel

```
Module 1 → Module 2 → Module 3 → Module 4
                                       ↓
Module 5 → Module 6 → Module 7
                            ↓
Module 8 → Module 9 → Module 10
                            ↓
          ┌─────────────────┼─────────────────┐
          ↓                 ↓                 ↓
Module 11→14          Module 15→19       Module 20→23
(LCA)                 (PTG)              (Autres)
          └─────────────────┼─────────────────┘
                            ↓
                    Module 24→26 (Reprises)
                            ↓
                    Module 27→29 (Technologies)
                            ↓
                    Module 30 (Synthèse)
```

### Prérequis inter-modules

| Module | Prérequis obligatoire |
|---|---|
| Modules 5-7 (Biomécanique) | Modules 3-4 (Anatomie) |
| Modules 8-10 (Imagerie) | Module 3 (Anatomie) |
| Modules 11-14 (LCA) | Modules 5-6 (Biomécanique) + Module 8 (Imagerie) |
| Modules 15-19 (PTG) | Modules 5-6 (Biomécanique) + Module 8 (Imagerie) |
| Modules 20-23 (Autres chirurgies) | Modules 5-6 (Biomécanique) + Module 8 (Imagerie) |
| Modules 24-26 (Reprises) | Au moins une des parties V, VI ou VII |
| Modules 27-29 (Technologies) | Modules 5-6 + au moins une partie chirurgicale |
| Module 30 (Synthèse) | Tous les modules précédents recommandés |

## 3.4 Volume horaire et évaluation

| Partie | Modules | Heures | Quiz | Cas cliniques |
|---|---|---|---|---|
| I. Histoire | 1-2 | 6h | 15 | 2 |
| II. Anatomie | 3-4 | 8h | 20 | 4 |
| III. Biomécanique | 5-7 | 12h | 25 | 6 |
| IV. Imagerie | 8-10 | 10h | 25 | 6 |
| V. LCA | 11-14 | 14h | 30 | 8 |
| VI. PTG | 15-19 | 16h | 30 | 10 |
| VII. Autres chirurgies | 20-23 | 12h | 25 | 8 |
| VIII. Reprises | 24-26 | 8h | 20 | 6 |
| IX. Technologies | 27-29 | 8h | 15 | 4 |
| X. Synthèse | 30 | 4h | 10 | 6 |
| **TOTAL** | **30** | **~98h** | **215** | **60** |

---

# 4. CHARTE GRAPHIQUE — PLATEFORME VERTEX©

La Formation Pente Tibiale respecte la **charte graphique unifiée VERTEX©** (cf. REGLES_ECRITURE_CONTENU.md et CDC_PTG_00_INTRODUCTION_CHARTE.md).

## 4.1 Éléments partagés (toutes formations)

- **Police** : Inter (titres et corps)
- **Icônes** : Font Awesome 6 Pro
- **Mise en page** : responsive, mobile-first
- **Tags MEDIA** : format standardisé `> [MEDIA: 📷/📐/🎬 MPTxx-Syy-zzz — Description]`
- **Encadrés cliniques** : bordure gauche colorée 4px

## 4.2 Palette de couleurs commune

| Élément | Couleur | Hex |
|---|---|---|
| Fond principal | Blanc | `#FFFFFF` |
| Texte corps | Gris très foncé | `#333333` |
| Titres H1 | Bleu foncé VERTEX | `#1A237E` |
| Titres H2-H3 | Bleu primaire | `#0D47A1` |
| Liens | Bleu moyen | `#1565C0` |
| Fond accroches | Bleu très pâle | `#E3F2FD` |

---

# 5. CODE COULEUR — FORMATION PENTE TIBIALE

## 5.1 Couleur identitaire

| Formation | Couleur | Hex | Emoji |
|---|---|---|---|
| Scoliose | Bleu roi | `#1565C0` | 🔵 |
| PTG | Vert émeraude | `#2E7D32` | 🟢 |
| IOA | Marron terre | `#795548` | 🟤 |
| Tendinites | Gris acier | `#607D8B` | 🩶 |
| Obésité-Orthopédie | Orange foncé | `#E65100` | 🟠 |
| **Pente tibiale** | **Indigo profond** | **`#4A148C`** | **🟣** |

## 5.2 Palette spécifique Pente Tibiale

| Élément | Couleur | Hex |
|---|---|---|
| Accroche clinique | Violet très pâle | `#F3E5F5` |
| Encadré important | Indigo | `#4A148C` |
| Succès/correct | Vert | `#2E7D32` |
| Erreur/incorrect | Rouge | `#C62828` |
| Avertissement | Ambre | `#FF8F00` |
| Biomécanique | Bleu profond | `#1A237E` |
| Chirurgie | Indigo clair | `#7B1FA2` |
| Technologie | Cyan | `#00838F` |

## 5.3 Tags MEDIA — Préfixe

Format : `> [MEDIA: {type} MPT{module}-S{section}-{numéro} — {Description}]`

- **MPT** = Module Pente Tibiale
- Types : 📷 (image/photo), 📐 (schéma/diagramme), 🎬 (vidéo/animation), 🖥️ (simulation SlopeSim©)

Exemples :
- `> [MEDIA: 📷 MPT03-S02-001 — Vue anatomique du plateau tibial : pente médiale vs latérale]`
- `> [MEDIA: 📐 MPT05-S01-003 — Schéma biomécanique : décomposition des forces sur le plan incliné tibial]`
- `> [MEDIA: 🎬 MPT18-S03-002 — Vidéo chirurgicale : positionnement du guide de coupe tibiale extramedullaire en PTG]`
- `> [MEDIA: 🖥️ MPT07-S02-001 — SlopeSim© : simulation FEM de l'impact de la pente sur la translation tibiale antérieure]`

---

# 6. RÈGLES D'ÉCRITURE DU CONTENU

Les règles d'écriture sont identiques à celles de la plateforme VERTEX© (cf. REGLES_ECRITURE_CONTENU.md). Rappel des points essentiels :

## 6.1 Terminologie

- ✅ **« praticien »** / **« praticiens »** — TOUJOURS
- ❌ JAMAIS « apprenant », « étudiant »
- Terminologie bilingue systématique : terme français suivi de *(terme anglais)* à la première occurrence

## 6.2 Rigueur scientifique — Spécificités Pente Tibiale

| Exigence | Détail |
|---|---|
| **Classifications** | Dejour (pente tibiale et instabilité), Noyes (pente et HTO), ISAKOS (alignement) — exactes et référencées |
| **Valeurs numériques** | Toutes les valeurs de pente en degrés avec intervalle de confiance ou écart-type quand disponible |
| **Méthodes de mesure** | Préciser systématiquement la méthode utilisée (axe anatomique, axe cortical postérieur, plateau spécifique) |
| **Niveaux de preuve** | Citer le niveau de preuve (NP I à V) pour les affirmations thérapeutiques clés |
| **Sources** | JBJS (Am/Br), AJSM, KSSTA, Clin Orthop, Arthroscopy, JEO, Knee, OTSR — PubMed uniquement |
| **Consensus** | Préciser quand il n'y a PAS de consensus (ex : pente idéale en PTG = sujet controversé) |

## 6.3 Valeurs de référence à utiliser

| Paramètre | Valeur normale | Source |
|---|---|---|
| Pente tibiale globale (profil) | 7° ± 3° (range 3-13°) | Dejour & Bonnin, Rev Chir Orthop 1994 |
| Pente plateau médial | 8° ± 3° | Hashemi et al., AJSM 2008 |
| Pente plateau latéral | 5° ± 3° | Hashemi et al., AJSM 2008 |
| Différence médial-latéral | 3° ± 2° (médial > latéral) | Hudek et al., KSSTA 2011 |
| Seuil de risque LCA | >12° (PTS globale) | Brandon et al., AJSM 2006 |
| Cible PTG alignement mécanique | 0-3° (voire 5° CR) | Insall & Scott, Surgery of the Knee |
| Cible PTG alignement cinématique | Pente native (5-9°) | Howell et al., JBJS 2019 |
| Augmentation PTS après HTO ouverture | +2-4° si non contrôlée | Noyes et al., AJSM 2005 |

---

# 7. STRUCTURE DES FICHIERS DU CDC

```
cours-pente-tibiale/
├── CDC_PT_00_INTRODUCTION_CHARTE.md       ← Ce fichier
├── CDC_PT_01_HISTOIRE_CONCEPTS.md         ← Partie I (Modules 1-2)
├── CDC_PT_02_ANATOMIE_EMBRYOLOGIE.md      ← Partie II (Modules 3-4)
├── CDC_PT_03_BIOMECANIQUE.md              ← Partie III (Modules 5-7)
├── CDC_PT_04_IMAGERIE_MESURE.md           ← Partie IV (Modules 8-10)
├── CDC_PT_05_LCA.md                       ← Partie V (Modules 11-14)
├── CDC_PT_06_PTG.md                       ← Partie VI (Modules 15-19)
├── CDC_PT_07_AUTRES_CHIRURGIES.md         ← Partie VII (Modules 20-23)
├── CDC_PT_08_REPRISES.md                  ← Partie VIII (Modules 24-26)
├── CDC_PT_09_TECHNOLOGIES.md              ← Partie IX (Modules 27-29)
├── CDC_PT_10_SYNTHESE.md                  ← Partie X (Module 30)
├── QUIZ_PENTE_TIBIALE.md                  ← 215 questions (4 niveaux)
├── CAS_CLINIQUES_PT_P1.md                 ← Cas cliniques 1-20 (Bronze/Argent)
├── CAS_CLINIQUES_PT_P2.md                 ← Cas cliniques 21-40 (Or)
└── CAS_CLINIQUES_PT_P3.md                 ← Cas cliniques 41-60 (Diamant)
```

---

# 8. CORRESPONDANCE INTER-FORMATIONS

## 8.1 Liens avec la Formation PTG

| Module PT | Lien avec Formation PTG | Type |
|---|---|---|
| Module 15 (Pente en PTG — Principes) | PTG Module 14 (Planification chirurgicale) | Approfondissement |
| Module 16 (Alignement mécanique) | PTG Module 16 (Technique standard) | Complément |
| Module 18 (Techniques de contrôle) | PTG Module 16-17 (Technique + équilibrage) | Focus spécifique |
| Module 19 (Complications pente) | PTG Module 21-22 (Complications) | Analyse causale |
| Module 25 (Reprise PTG pente) | PTG Module 24-25 (Chirurgie de reprise) | Approfondissement |
| Module 28 (Robotique) | PTG Module 18 (Navigation, robotique, PSI) | Approfondissement |

## 8.2 Liens avec les autres formations

| Module PT | Lien | Formation |
|---|---|---|
| Module 11-14 (LCA) | LCA Module (ligamentoplastie) | Formation LCA |
| Module 21 (HTO) | Obésité Module 4 (arthroplastie) | Formation Obésité |
| Module 23 (Traumatologie) | IOA (fractures ouvertes) | Formation IOA |
| Module 5-7 (Biomécanique) | Scoliose Module 2 (biomécanique rachis) | Formation Scoliose |

## 8.3 Simulateur SlopeSim© — Fonctionnalités dédiées

| Fonctionnalité | Module(s) | Description |
|---|---|---|
| Mesure interactive PTS | M8-M10 | Le praticien mesure la pente sur des radiographies simulées |
| Simulation plan incliné | M5-M6 | Visualisation 3D des forces de cisaillement selon la pente |
| Simulation coupe tibiale PTG | M15-M18 | Le praticien positionne le guide de coupe et visualise l'impact sur la pente résultante |
| Simulation HTO | M21 | Planification Miniaci avec contrôle de la pente |
| Simulation ostéotomie de déflexion | M13 | Correction de la pente dans le genou instable |
| Analyse d'échec | M24-M26 | Le praticien analyse un cas d'échec et identifie l'erreur de pente |
| FEM dynamique | M7 | Modélisation par éléments finis de l'impact de la pente sur la TTA |

---

*Partie 0 — Document fondateur v1.0 — 29 mars 2026*
*Formation Pente Tibiale — VERTEX© — 30 modules, ~98h, 215 quiz, 60 cas cliniques*



