# GLOSSAIRE IOA — Définitions, Scores et Performances Diagnostiques

**Formation IOA — Plateforme VERTEX©**
**Date** : 8 mars 2026

---

## Table des matières

1. [PCT — Procalcitonine](#1-pct--procalcitonine)
2. [MALDI-TOF](#2-maldi-tof)
3. [NGS — Next-Generation Sequencing](#3-ngs--next-generation-sequencing)
4. [DAIR — Debridement, Antibiotics, Irrigation, Retention](#4-dair--debridement-antibiotics-irrigation-retention)
5. [Membrane Induite — Technique de Masquelet](#5-membrane-induite--technique-de-masquelet)
6. [IA et Algorithmes Diagnostiques pour les IOA](#6-ia-et-algorithmes-diagnostiques-pour-les-ioa)
7. [VPP et VPN — Valeurs Prédictives](#7-vpp-et-vpn--valeurs-prédictives)
8. [Se et Sp — Sensibilité et Spécificité](#8-se-et-sp--sensibilité-et-spécificité)
9. [Performances diagnostiques par examen isolé](#9-performances-diagnostiques-par-examen-isolé)
10. [Performances des combinaisons diagnostiques](#10-performances-des-combinaisons-diagnostiques)
11. [VPP et VPN selon le contexte clinique](#11-vpp-et-vpn-selon-le-contexte-clinique)
12. [Alpha-défensine](#12-alpha-défensine)
13. [Critères ICM 2018](#13-critères-icm-2018)

---

## 1. PCT — Procalcitonine

La **procalcitonine (PCT)** est un biomarqueur sanguin d'infection bactérienne systémique.

- **Nature** : pro-hormone de la calcitonine (13 kDa), produite par les cellules C de la thyroïde et par les tissus extra-thyroïdiens en cas d'infection bactérienne
- **Valeur normale** : < 0.05 ng/mL
- **Seuils** :
  - < 0.25 ng/mL → infection bactérienne peu probable
  - 0.25 – 0.5 ng/mL → zone grise
  - 0.5 – 2 ng/mL → infection bactérienne probable
  - > 2 ng/mL → infection bactérienne sévère / sepsis
  - > 10 ng/mL → choc septique

**Intérêt en IOA** :
- Plus spécifique que la CRP pour les infections bactériennes (non élevée dans les inflammations non infectieuses)
- Utile pour différencier une infection post-opératoire d'une inflammation chirurgicale normale
- Cinétique rapide : pic à 6-12h, demi-vie 24h → suivi de l'efficacité du traitement
- Limite en IOA : sensibilité plutôt faible (53-76%) car les IOA sont souvent des infections localisées sans bactériémie importante

### Exemples pratiques — PCT

**Exemple 1 — PCT utile : Différencier infection vs inflammation post-opératoire**
> Mme Dupont, 72 ans, J5 après PTH. Fièvre 38.5°C, genou rouge, douloureux.
> - CRP = 120 mg/L → **Attendu** : la CRP est normalement élevée après chirurgie (pic J2-J3, normalisation en 2-3 semaines). CRP seule = non informative à J5.
> - PCT = 0.08 ng/mL → **Normal** → inflammation post-opératoire banale, PAS d'argument pour une infection bactérienne systémique.
> - **Conduite** : surveillance simple, pas d'antibiothérapie.
>
> Si la PCT avait été à 2.5 ng/mL → forte suspicion d'infection bactérienne → ponction articulaire urgente + hémocultures.

**Exemple 2 — PCT faussement rassurante : infection localisée**
> M. Martin, 55 ans, PTG douloureuse à 6 mois. Pas de fièvre. Genou modérément gonflé.
> - CRP = 45 mg/L (élevée)
> - PCT = 0.12 ng/mL (**normale !**)
> - Ponction articulaire : 15 000 leucocytes/μL, alpha-défensine positive
> - Cultures : *S. epidermidis*
> - **Diagnostic** : infection chronique bas-grade. La PCT est NORMALE car l'infection est localisée, sans bactériémie. Ne pas se fier à la PCT seule !

**Exemple 3 — PCT pour le suivi de traitement**
> M. Ahmed, 60 ans, arthrite septique du genou à *S. aureus*. Sepsis.
> - J0 : PCT = 15 ng/mL → choc septique
> - J2 (sous ATB IV) : PCT = 8 ng/mL → en baisse = bonne réponse au traitement
> - J5 : PCT = 1.2 ng/mL → franche diminution
> - J10 : PCT = 0.15 ng/mL → quasi-normale
> - **Interprétation** : la cinétique de la PCT (demi-vie 24h) permet de confirmer l'efficacité de l'antibiothérapie jour par jour, bien avant la CRP (demi-vie 48h).

---

## 2. MALDI-TOF

**MALDI-TOF** = **M**atrix-**A**ssisted **L**aser **D**esorption **I**onization — **T**ime **O**f **F**light

Technique d'identification microbiologique rapide par spectrométrie de masse.

### Principe
1. La colonie bactérienne est déposée sur une plaque avec une matrice cristalline
2. Un laser UV vaporise et ionise les protéines bactériennes
3. Les ions sont accélérés dans un tube de vol
4. Le temps de vol (TOF) dépend du rapport masse/charge → spectre de masse unique = "empreinte digitale"
5. Le spectre est comparé à une base de données (~3000 espèces) → identification en quelques secondes

### Performance
- **Identification correcte** : 95-99% au niveau de l'espèce
- **Délai** : 1-2 minutes (vs 24-48h pour les méthodes conventionnelles)
- **Coût** : ~1-2€ par identification (après investissement initial ~150-200k€ pour l'appareil)

### En IOA
- Identification rapide du pathogène à partir des cultures (hémocultures, liquide articulaire, prélèvements peropératoires)
- Émergence de la prédiction de résistance aux ATB par MALDI-TOF (recherche)
- Systèmes : bioMérieux VITEK® MS, Bruker MALDI Biotyper®

### Exemples pratiques — MALDI-TOF

**Exemple 1 — Identification rapide en urgence**
> M. Karim, 45 ans, arthrite septique du genou, fièvre 39°C. Hémocultures prélevées à l'admission.
> - J0, 18h : hémoculture signalée positive (flacon détecté par l'automate)
> - J0, 18h15 : prélèvement direct → **MALDI-TOF : *Staphylococcus aureus* en 2 minutes**
> - J0, 18h30 : antibiothérapie ciblée débutée (oxacilline + gentamicine)
> - J1 (lendemain) : l'antibiogramme classique confirme → *S. aureus* méticilline-sensible (SASM)
> - **Gain** : 24h d'avance sur l'identification → antibiothérapie ciblée dès le 1er jour au lieu d'un traitement empirique probabiliste.

**Exemple 2 — MALDI-TOF en peropératoire**
> Mme Bernard, 68 ans, reprise de PTG pour suspicion d'infection chronique. 5 prélèvements peropératoires.
> - Culture classique : **3/5 positifs à J3** → colonies blanchâtres, petites
> - MALDI-TOF sur colonie : ***Cutibacterium acnes*** (identifié en 90 secondes)
> - Sans MALDI-TOF : il aurait fallu attendre J5-J7 pour des tests biochimiques conventionnels (catalase, API)
> - **Impact** : confirmation rapide que le germe est un *C. acnes* (et non un contaminant) → adaptation du schéma ATB (amoxicilline + rifampicine)

**Exemple 3 — Limitation du MALDI-TOF**
> M. Leclerc, 58 ans. Liquide articulaire trouble. Examen direct : cocci Gram+.
> - Culture : positive seulement en bouillon d'enrichissement, pas de colonies isolées sur gélose.
> - **MALDI-TOF impossible** : le MALDI-TOF nécessite une colonie isolée (ou une détection directe en flacon d'hémoculture). Pas de colonie = pas de spectre.
> - **Solution alternative** : PCR 16S ou FilmArray® (biologie moléculaire directe)

---

## 3. NGS — Next-Generation Sequencing

**NGS** = **N**ext-**G**eneration **S**equencing (Séquençage de nouvelle génération)

Technique de séquençage ADN haut débit capable d'identifier tous les micro-organismes présents dans un prélèvement, y compris les non-cultivables.

### Types utilisés en IOA
| Type | Principe | Application |
|------|----------|-------------|
| **Métagénomique ciblée (16S/18S/ITS)** | Séquençage du gène ARN 16S ribosomal (bactéries) | Identification pan-bactérienne |
| **Métagénomique shotgun** | Séquençage de tout l'ADN | Identification de tous les pathogènes + gènes de résistance |

### Intérêt en IOA
- Détection de pathogènes non cultivables ou à croissance lente (*Cutibacterium acnes*, mycobactéries atypiques)
- Fonctionne même sous antibiothérapie (détecte l'ADN résiduel)
- Identification des gènes de résistance directement depuis le prélèvement
- Délai : 24-72h (vs 5-14 jours pour certaines cultures)

### Limites
- Coût élevé (~300-800€ par analyse)
- Contamination environnementale (ADN bactérien ambiant)
- Difficulté à distinguer une infection active d'une colonisation ou contamination
- Nécessite une expertise bioinformatique pour l'interprétation

### Exemples pratiques — NGS

**Exemple 1 — NGS sauve le diagnostic après antibiothérapie intempestive**
> Mme Rousseau, 75 ans, PTH douloureuse à 2 ans. Son médecin traitant a prescrit 2 semaines d'amoxicilline-acide clavulanique avant de l'adresser au CRIOA.
> - Ponction articulaire au CRIOA : leucocytes = 12 000/μL (infecté !), alpha-défensine positive
> - Cultures : **TOUTES NÉGATIVES** (5 prélèvements peropératoires, 14 jours d'incubation) → les antibiotiques préalables ont stérilisé les cultures
> - **NGS (16S métagénomique)** sur le liquide articulaire : ***Staphylococcus lugdunensis*** détecté
> - **Impact** : sans le NGS, le germe n'aurait jamais été identifié → antibiothérapie « à l'aveugle ». Avec le NGS → traitement ciblé adapté.
> - **Leçon** : NE JAMAIS donner d'antibiotiques avant les prélèvements !

**Exemple 2 — NGS révèle une infection à germe non cultivable**
> M. Petit, 42 ans, ostéomyélite chronique tibiale post-traumatique. 3 chirurgies antérieures pour séquestrectomie + ATB, rechutes à chaque fois. Cultures toujours négatives.
> - NGS shotgun sur biopsie osseuse : ***Mycobacterium abscessus*** détecté
> - Diagnostic : **mycobactérie atypique** — bactérie à croissance extrêmement lente, rarement identifiée par culture standard
> - Les gènes de résistance erm(41) et rrl sont identifiés → résistance à la clarithromycine intrinsèque inductible
> - **Impact** : traitement adapté (amikacine + imipénème + tigécycline pendant 12 mois). Guérison après 4e chirurgie + ATB ciblé.

**Exemple 3 — Faux positif du NGS**
> Mme Girard, 60 ans, PTG non douloureuse, reprise pour usure du polyéthylène (pas de suspicion infectieuse). Prélèvements per-opératoires « de routine ».
> - Cultures : négatives (5/5)
> - Alpha-défensine : négative
> - NGS systématique (protocole de recherche) : **détection d'ADN de *Staphylococcus epidermidis***
> - **Interprétation** : CONTAMINATION. L'ADN de *S. epidermidis* est ubiquitaire (peau du patient, environnement). En l'absence de tout argument clinique/biologique d'infection → faux positif du NGS.
> - **Leçon** : le NGS détecte de l'ADN, pas nécessairement une infection active. Toujours interpréter dans le contexte clinique.

---

## 4. DAIR — Debridement, Antibiotics, Irrigation, Retention

**DAIR** = **D**ebridement, **A**ntibiotics, **I**rrigation, **R**etention

Stratégie chirurgicale conservatrice de prise en charge d'une infection périprothétique **précoce**, qui consiste à conserver l'implant en place.

### Principe
1. **Debridement** : nettoyage chirurgical agressif (excision des tissus infectés, synovectomie)
2. **Antibiotics** : antibiothérapie ciblée prolongée (IV puis relais oral, 6-12 semaines)
3. **Irrigation** : lavage abondant per-opératoire (6-9 litres de sérum physiologique)
4. **Retention** : conservation de la prothèse en place (changement des pièces mobiles : polyéthylène, tête fémorale)

### Indications
- Infection **aiguë** post-opératoire (< 4 semaines après l'implantation)
- Infection **hématogène aiguë** (< 3 semaines de symptômes)
- Implant **stable** (non descellé)
- Germe **identifié** et **sensible** aux antibiotiques à bonne biodisponibilité orale (notamment la rifampicine pour les staphylocoques)

### Taux de succès
- 55-80% selon les séries (dépend de la sélection des patients)
- Facteurs de bon pronostic : durée des symptômes < 3 semaines, staphylocoque sensible à la rifampicine, CRP initiale basse, pas de fistule

### Alternative si échec
- Changement prothétique en **1 temps** ou **2 temps** (gold standard en cas d'échec du DAIR)

### Exemples pratiques — DAIR

**Exemple 1 — DAIR réussi : infection aiguë post-opératoire**
> M. Legrand, 65 ans, PTG gauche il y a 12 jours. Depuis J8, douleur croissante, rougeur, fièvre 38.8°C, écoulement trouble sur la cicatrice.
> - CRP = 180 mg/L, PCT = 1.2 ng/mL
> - Ponction articulaire : 45 000 leucocytes/μL, 95% PNN
> - **Décision** : DAIR en urgence (< 4 semaines post-op, implant stable)
> - **Au bloc** : synovectomie complète, lavage 9L, échange polyéthylène, 5 prélèvements
> - Cultures : *S. aureus* méticilline-sensible, sensible à la rifampicine
> - ATB : oxacilline IV 2 semaines → relais oral lévofloxacine + rifampicine 10 semaines
> - **Résultat** : guérison à 2 ans, prothèse en place, pas de récidive.

**Exemple 2 — DAIR échoué : mauvaise sélection**
> Mme Moreau, 70 ans, PTH douloureuse depuis 4 mois (symptômes chroniques). Fistule intermittente en regard du grand trochanter.
> - CRP = 35 mg/L, VS = 65 mm/h
> - DAIR tenté malgré : durée des symptômes > 3 semaines + fistule
> - Cultures peropératoires : *S. aureus* SARM, résistant à la rifampicine
> - **3 mois plus tard** : récidive infectieuse, fistule réapparaît
> - **Erreur** : DAIR contre-indiqué ici (symptômes chroniques + fistule + germe résistant à la rifampicine = triple facteur d'échec)
> - **Solution** : changement prothétique en 2 temps (explantation → spacer 8 semaines → réimplantation)

**Exemple 3 — DAIR en infection hématogène aiguë**
> M. Blanc, 58 ans, PTG droite à 3 ans, fonctionnelle et indolore. Bactériémie à *Streptococcus* groupe B après infection urinaire. Apparition brutale d'un genou chaud, rouge, douloureux (en 48h).
> - CRP = 250 mg/L, hémocultures positives à *S. agalactiae*
> - Ponction articulaire : purulent, 80 000 leucocytes/μL
> - **Décision** : DAIR en urgence (infection hématogène aiguë, < 3 semaines de symptômes, implant bien fixé)
> - Au bloc : pus franc, synovectomie, lavage abondant, échange du polyéthylène
> - ATB : amoxicilline IV 2 semaines → relais oral amoxicilline 6 semaines
> - **Résultat** : guérison. Le streptocoque est un germe de bon pronostic en DAIR (taux de succès ~80-90%).

**Exemple 4 — Algorithme décisionnel DAIR vs changement**

```
Infection périprothétique confirmée
           │
     ┌─────┴──────┐
     ▼            ▼
  AIGUË         CHRONIQUE
(< 4 sem        (> 4 sem ou
post-op ou      symptômes
< 3 sem         > 3 sem)
symptômes)         │
     │             ▼
     ▼        Changement
  DAIR ?      prothétique
     │        (1 ou 2 temps)
     ▼
┌─ Implant stable ? ─── Non ──→ Changement
│
├─ Germe identifié ? ── Non ──→ Prudence (changement préféré)
│
├─ Rifampicine-S      
│  (si staph) ? ─────── Non ──→ Changement (si staph)
│
├─ Fistule ? ─────────── Oui ─→ Changement
│
└─ Tous les critères OK → DAIR
```

---

## 5. Membrane Induite — Technique de Masquelet

La **technique de la membrane induite** (technique de **Masquelet**), du nom du Pr Alain-Charles Masquelet, est une technique chirurgicale en **deux temps** pour la reconstruction de **pertes de substance osseuse** massives (> 4-5 cm).

### Principe

**1er temps — Induction de la membrane** :
- Débridement radical du foyer (résection osseuse, nettoyage infectieux)
- Mise en place d'un **espaceur en ciment** (PMMA, souvent chargé en antibiotiques) dans le défect osseux
- En 4 à 8 semaines, l'organisme forme une **membrane biologique vascularisée** autour du ciment (la « membrane induite »)
- Cette membrane sécrète des **facteurs de croissance** (BMP-2, VEGF, TGF-β) et constitue un environnement biologiquement actif

**2e temps — Greffe osseuse** (6-8 semaines plus tard) :
- Ouverture soigneuse de la membrane **sans la détruire**
- Retrait du ciment
- Comblement de la cavité par **greffe osseuse autologue** (crête iliaque, RIA) ± allogreffe
- La membrane agit comme une **chambre biologique** qui empêche la résorption du greffon, le vascularise et favorise la consolidation

### Avantages
- Permet de reconstruire des **défects osseux massifs** (jusqu'à 25 cm décrits dans la littérature)
- Particulièrement adaptée en contexte **septique** (le ciment aux antibiotiques traite l'infection au 1er temps)
- Alternative aux techniques de transport osseux (Ilizarov) avec moins de contraintes pour le patient

### Indications en IOA
- Ostéomyélite chronique avec perte de substance osseuse étendue
- Reprises après échec de traitement initial
- Pseudarthrose septique
- Reconstruction après résection carcinologique

### Exemples pratiques — Masquelet

**Exemple 1 — Masquelet classique pour ostéomyélite chronique**
> M. Diallo, 35 ans, ostéomyélite chronique du tibia après fracture ouverte (accident de moto, 2 ans auparavant). Fistule cutanée productive depuis 18 mois. Radiographie : séquestre osseux de 8 cm, cavité diaphysaire.
> - **1er temps** (J0) : résection radicale du séquestre + tissu infecté → perte de substance osseuse de 9 cm. Mise en place d'un espaceur en ciment PMMA chargé en gentamicine + vancomycine. Cultures : *S. aureus* SASM.
> - ATB : oxacilline IV 2 semaines → lévofloxacine + rifampicine oral 4 semaines
> - **Suivi à 6 semaines** : CRP normalisée, fistule fermée, pas de signe d'infection
> - **2e temps** (J56) : ouverture de la membrane induite (membrane épaisse, bien vascularisée), retrait du ciment, comblement par greffe osseuse autologue (crête iliaque) + allogreffe lyophilisée.
> - **Résultat à 12 mois** : consolidation complète, appui total, pas de récidive infectieuse. Le patient marche sans boiterie.

**Exemple 2 — Masquelet après échec de traitement conventionnel**
> Mme Fernandez, 52 ans, pseudarthrose septique du fémur après ostéosynthèse par clou centromédullaire pour fracture. 2 interventions antérieures (ablation du matériel + curetage) avec rechute à chaque fois. Perte de substance de 6 cm.
> - **1er temps** : ablation du matériel résiduel, résection large incluant les berges sclérotiques, espaceur ciment aux ATB, fixateur externe temporaire
> - **2e temps (7 semaines)** : greffe RIA (Reamer-Irrigator-Aspirator) prélevée dans le canal médullaire fémoral controlatéral + ostéosynthèse par plaque
> - **Avantage du RIA** : grande quantité de greffe autologue (jusqu'à 40 mL) sans morbidité du site de prélèvement iliaque
> - **Résultat à 18 mois** : consolidation acquise, infection éradiquée

**Exemple 3 — Échec du Masquelet : membrane détruite**
> M. Kovac, 40 ans, Masquelet pour ostéomyélite tibiale. 2e temps réalisé à 8 semaines.
> - Lors de l'ouverture chirurgicale, la membrane a été **largement déchirée et excisée partiellement** par le chirurgien (erreur technique)
> - Greffe osseuse mise en place → à 6 mois : **résorption de 60% du greffon**, pas de consolidation
> - **Erreur** : la membrane induite DOIT être préservée intacte. C'est elle qui sécrète les facteurs de croissance et empêche la résorption.
> - **Reprise** : nouveau Masquelet complet (1er + 2e temps). Consolidation à 14 mois.

---

## 6. IA et Algorithmes Diagnostiques pour les IOA

### Ce que l'IA peut faire dans le diagnostic des IOA

L'intelligence artificielle dans le domaine des IOA exploite **3 types de données** :

### 6.1. Imagerie médicale

| Modalité | Application IA | Exemple |
|----------|---------------|---------|
| **Radiographie standard** | Descellement prothétique, ostéolyse, signes d'ostéomyélite | Rx genou : septique vs aseptique |
| **IRM** | Détection ostéomyélite, abcès, collections | Signal médullaire anormal |
| **Scanner** | Séquestres osseux, érosions corticales | Ostéomyélite chronique |
| **Scintigraphie/TEP** | Foyer infectieux actif | Fixation anormale |

Nécessite : images DICOM, modèle CNN (ResNet, EfficientNet, Vision Transformer), GPU pour entraînement.

### 6.2. Données clinico-biologiques (pas d'imagerie)

| Donnée | Application IA | Exemple |
|--------|---------------|---------|
| **Biologie** | Score prédictif d'infection | CRP, PCT, leucocytes, fibrinogène, D-dimères |
| **Données patient** | Risque d'ISO pré-opératoire | Age, IMC, diabète (HbA1c), tabac, ASA, durée opératoire |
| **Données peropératoires** | Prédiction échec DAIR | Durée des symptômes, type de germe, état de l'implant |
| **Critères MSIS/ICM** | Aide à la classification | Combinaison de critères majeurs/mineurs |

Nécessite : un simple formulaire web, pas d'imagerie.

### 6.3. Données microbiologiques

| Donnée | Application IA | Exemple |
|--------|---------------|---------|
| **Antibiogramme** | Prédiction résistance, choix ATB optimal | Profil de résistance → schéma ATB recommandé |
| **Données génomiques (NGS)** | Identification pathogène par séquençage | Métagénomique ciblée |
| **MALDI-TOF** | Identification rapide + prédiction résistance | Spectre de masse → espèce + résistance |

### Complexité par type d'outil

| Type d'outil | Imagerie nécessaire ? | Matériel spécial ? | Complexité |
|-------------|:--------------------:|:------------------:|:----------:|
| **Score prédictif IOA** (formulaire) | Non | Non | Simple |
| **Aide au choix ATB** (antibiogramme) | Non | Non | Simple |
| **Analyse radiographie** (descellement) | Oui (Rx DICOM) | GPU entraînement | Moyen |
| **Analyse IRM** (ostéomyélite) | Oui (IRM DICOM) | GPU obligatoire | Complexe |

### Exemples pratiques — IA diagnostique

**Exemple 1 — Score prédictif IOA (sans imagerie)**
> Calculateur IOA-SCORE© sur VERTEX©. Le praticien remplit le formulaire :
> - Patient : homme, 68 ans, IMC 32, diabète type 2 (HbA1c 8.2%), tabagisme actif
> - PTG à J14 post-op, fièvre 38.5°C
> - CRP = 95 mg/L, VS = 55 mm/h, PCT = 0.8 ng/mL, leucocytes = 13 500/mm³
> - **L'algorithme de machine learning analyse les 12 variables et calcule** :
>   - Probabilité d'infection : **78%**
>   - Facteurs les plus discriminants (importance SHAP) : PCT > 0.5 (poids 0.28), CRP > 50 à J14 (poids 0.22), diabète mal équilibré (poids 0.15)
>   - Recommandation : « Ponction articulaire urgente recommandée. Probabilité d'infection élevée. »
> - **Utilité** : le praticien qui hésite entre « inflammation post-opératoire normale » et « infection débutante » reçoit une aide quantifiée.

**Exemple 2 — Prédiction du risque d'ISO pré-opératoire**
> Avant une PTG programmée, le chirurgien entre les données du patient :
> - Femme, 75 ans, IMC 38, diabète insulinodépendant, corticothérapie au long cours, ATCD d'ISO sur chirurgie abdominale
> - ASA III, durée opératoire prévue 120 min
> - **L'IA calcule un risque d'ISO de 8.5%** (vs 1-2% en population standard)
> - Recommandations générées : optimisation HbA1c < 7% avant chirurgie, sevrage tabac 6 semaines, dépistage/décontamination portage nasal *S. aureus* (mupirocine), antibioprophylaxie adaptée au poids (céfazoline 3g au lieu de 2g si > 120 kg)

**Exemple 3 — IA et prédiction d'échec du DAIR**
> Le chirurgien a décidé un DAIR pour une infection aiguë post-opératoire. L'IA évalue les chances de succès :
> - Entrées : durée symptômes (18 jours), germe (*S. aureus* SASM, rifampicine-sensible), CRP initiale (120 mg/L), pas de fistule, implant stable
> - **Prédiction** : probabilité de succès du DAIR = **72%**
> - Si les symptômes avaient duré 35 jours → probabilité tombe à **38%** → l'IA recommande un changement prothétique

---

## 7. VPP et VPN — Valeurs Prédictives

### VPP — Valeur Prédictive Positive

Si le test est **positif**, quelle est la probabilité que le patient soit **réellement infecté** ?

**VPP = Vrais Positifs / (Vrais Positifs + Faux Positifs)**

Exemple : VPP de 85% → sur 100 patients avec un test positif, **85 sont réellement infectés** et 15 sont des faux positifs.

### VPN — Valeur Prédictive Négative

Si le test est **négatif**, quelle est la probabilité que le patient soit **réellement non infecté** ?

**VPN = Vrais Négatifs / (Vrais Négatifs + Faux Négatifs)**

Exemple : VPN de 95% → sur 100 patients avec un test négatif, **95 sont réellement sains** et 5 ont une infection ratée.

### Différence avec sensibilité/spécificité

| Mesure | Question posée | Dépend de la prévalence ? |
|--------|---------------|:-------------------------:|
| **Sensibilité** | Le test détecte-t-il les malades ? | Non |
| **Spécificité** | Le test identifie-t-il les sains ? | Non |
| **VPP** | Si test ⊕, est-ce un vrai malade ? | **Oui** |
| **VPN** | Si test ⊖, est-ce un vrai sain ? | **Oui** |

Point clé : VPP et VPN varient selon la **prévalence** de la maladie dans la population testée.

### Exemples pratiques — VPP et VPN

**Exemple 1 — CRP positive chez le généraliste vs au CRIOA**
> Le même test (CRP > 10 mg/L, Se=85%, Sp=70%) chez deux patients différents :
>
> **Patient A** — Chez le généraliste (prévalence IOA = 0.5%) :
> - CRP positive à 25 mg/L
> - VPP = 1.4% → **98.6% de chances que ce soit un faux positif** (polyarthrite rhumatoïde, grippe, entorse inflammatoire...)
> - Conduite : ne PAS traiter comme une IOA. Adresser au spécialiste si suspicion clinique.
>
> **Patient B** — Au CRIOA (prévalence IOA = 50%) :
> - CRP positive à 25 mg/L
> - VPP = 73.9% → **3 chances sur 4 d'infection réelle**
> - Conduite : ponction articulaire urgente + bilan complet ICM 2018.

**Exemple 2 — VPN pour exclure une infection**
> Mme Leroy, 65 ans. PTH douloureuse à 1 an. Consultation spécialisée (prévalence 25%).
> - CRP = 3 mg/L (normale), VS = 8 mm/h (normale), IRM hanche normale
> - Tous les tests négatifs → VPN combinée > 98%
> - **Interprétation** : probabilité d'infection < 2%. La douleur est probablement d'autre origine (tendinopathie, bursite trochantérienne, douleur projetée lombaire).
> - **Leçon** : quand tous les tests sont négatifs, la VPN élevée permet d'exclure avec confiance → éviter une ponction invasive inutile.

**Exemple 3 — Le piège du test « excellent » en population à basse prévalence**
> Médecin des urgences, 500 patients/mois avec douleur articulaire (prévalence IOA = 2%).
> - S'il utilisait l'alpha-défensine (Se=97%, Sp=97%) sur TOUS les patients :
> - Sur 500 patients : 10 infectés, 490 non infectés
> - Vrais positifs : 10 × 0.97 = 9.7 → ~10 détectés
> - Faux positifs : 490 × 0.03 = 14.7 → ~15 faux positifs
> - **VPP = 10 / (10+15) = 40%** → plus de faux positifs que de vrais positifs !
> - **Leçon** : même un excellent test (Se=Sp=97%) donne 60% de faux positifs si la prévalence est basse. D'où l'importance de trier cliniquement AVANT de prescrire.

---

## 8. Se et Sp — Sensibilité et Spécificité

**Se = Sensibilité** — Capacité du test à détecter les **malades**.

**Se = Vrais Positifs / (Vrais Positifs + Faux Négatifs)**

Se = 92% signifie que sur 100 patients infectés, le test en détecte 92 et en rate 8.

**Sp = Spécificité** — Capacité du test à identifier les **sains**.

**Sp = Vrais Négatifs / (Vrais Négatifs + Faux Positifs)**

Sp = 85% signifie que sur 100 patients non infectés, le test est correctement négatif pour 85 et faussement positif pour 15.

### Résumé

| | Le test répond bien chez... | Erreur associée |
|---|---|---|
| **Se (sensibilité)** | les **malades** | Faux négatif (rate un malade) |
| **Sp (spécificité)** | les **sains** | Faux positif (inquiète un sain) |

- **Se élevée** → peu de malades ratés → bon pour **exclure** (si test ⊖ = rassurant)
- **Sp élevée** → peu de faux positifs → bon pour **confirmer** (si test ⊕ = fiable)

### Exemples pratiques — Se et Sp

**Exemple 1 — Test très sensible mais peu spécifique : la scintigraphie Tc99m**
> Se = 95%, Sp = 40% → détecte quasi tous les infectés, mais beaucoup de faux positifs.
> - 100 patients avec PTH douloureuse, dont 20 infectés :
>   - Scinti positive chez 19/20 infectés (vrais ⊕) + 48/80 non infectés (faux ⊕) = 67 positifs au total
>   - Le chirurgien ne sait pas distinguer les 19 vrais des 48 faux → la scinti seule est inutilisable pour confirmer
>   - MAIS : si la scinti est négative (seulement 1 infecté raté + 32 vrais négatifs) → quasi-exclusion
> - **Usage** : test de **dépistage/exclusion** (SnNout : Sensitivity Negative rules OUT)

**Exemple 2 — Test très spécifique mais peu sensible : la fistule**
> Se = 15%, Sp = 100% → rare mais pathognomonique.
> - Sur 100 patients infectés, seulement 15 ont une fistule. Mais si fistule présente → infection CERTAINE (aucun faux positif).
> - **Usage** : test de **confirmation** (SpPin : Specificity Positive rules IN)
> - C'est pourquoi la fistule est un critère MAJEUR dans les critères ICM 2018.

**Exemple 3 — Comment choisir entre Se et Sp en pratique**
> Aux urgences, face à un genou aigu fébrile :
> - **1ère intention** : demander un test SENSIBLE (CRP, NFS) → EXCLURE l'infection si négatif
> - **2ème intention** (si le test de dépistage est positif) : demander un test SPÉCIFIQUE (alpha-défensine, cultures) → CONFIRMER l'infection
> - **Séquence logique** : Se d'abord (filet large) → Sp ensuite (tri fin)

---

## 9. Performances diagnostiques par examen isolé

### Imagerie

| Examen | Sensibilité | Spécificité | VPP | VPN | Meilleure indication |
|--------|:-----------:|:-----------:|:---:|:---:|---------------------|
| **Radiographie standard** | 14-54% | 70-85% | ~50% | ~60% | Tardif : ostéolyse, descellement (>2 sem) |
| **Scanner (TDM)** | 67-81% | 70-80% | ~65% | ~80% | Séquestres, érosions corticales, collections |
| **IRM** | 82-100% | 75-96% | ~85% | ~95% | Gold standard imagerie : œdème médullaire, abcès |
| **Scintigraphie osseuse (Tc99m)** | 73-100% | 30-73% | ~50% | ~85% | Très sensible mais peu spécifique |
| **Scintigraphie leucocytes marqués** | 80-90% | 85-95% | ~85% | ~90% | Différencie infectieux vs non-infectieux |
| **TEP-FDG (PET-scan)** | 92-100% | 76-93% | ~80% | ~97% | Excellent pour ostéomyélite chronique, rachis |
| **TEP-FDG + TDM** | 94-100% | 87-97% | ~90% | ~98% | Meilleure combinaison imagerie nucléaire |
| **Échographie** | 50-70% | 80-90% | ~65% | ~75% | Collections superficielles, épanchement articulaire |

### Biologie sanguine

| Marqueur | Sensibilité | Spécificité | Seuil habituel | Délai de réponse |
|----------|:-----------:|:-----------:|:--------------:|:---------------:|
| **CRP** | 73-91% | 60-86% | >10 mg/L | 6-12h |
| **VS** | 75-93% | 40-60% | >30 mm/h | Lent (jours) |
| **Leucocytes sanguins** | 45-68% | 55-75% | >10 000/mm³ | Immédiat |
| **PCT (procalcitonine)** | 53-76% | 78-92% | >0.5 ng/mL | 4-6h |
| **Fibrinogène** | 63-80% | 57-72% | >4 g/L | Immédiat |
| **D-dimères** | 73-89% | 55-79% | >850 ng/mL | Immédiat |
| **IL-6** | 81-97% | 79-88% | >10 pg/mL | 2-4h |

### Biologie synoviale (articulation)

| Marqueur | Sensibilité | Spécificité | Seuil | Commentaire |
|----------|:-----------:|:-----------:|:-----:|------------|
| **Leucocytes synoviaux** | 89-97% | 88-96% | >3000 (genou) >4200 (hanche) | Excellent à lui seul |
| **% PNN synoviaux** | 84-97% | 85-95% | >65-80% | Très performant |
| **Alpha-défensine (latéral flow)** | 85-97% | 95-100% | Positif/Négatif | Meilleur marqueur synovial unique |
| **Alpha-défensine (ELISA)** | 97-100% | 95-97% | >5.2 mg/L | Gold standard synovial |
| **Leukocyte esterase (bandelette)** | 81-93% | 87-100% | ++ ou +++ | Rapide, au bloc |
| **CRP synoviale** | 85-95% | 80-90% | >6.9 mg/L | Complément utile |

---

## 10. Performances des combinaisons diagnostiques

### Combinaisons biologiques

| Combinaison | Sensibilité | Spécificité | Probabilité d'infection si tous positifs | Commentaire |
|-------------|:-----------:|:-----------:|:----------------------------------------:|------------|
| **CRP seule** | 85% | 70% | ~55% | Insuffisant isolément |
| **CRP + VS** | 91% | 63% | ~60% | Sensible mais peu spécifique |
| **CRP + VS + leucocytes** | 93% | 56% | ~58% | Sensibilité ↑, spécificité ↓ |
| **CRP + PCT** | 86% | 82% | ~72% | Bonne combinaison |
| **CRP + D-dimères** | 90% | 69% | ~65% | Screening correct |
| **CRP + VS + D-dimères + fibrinogène** | 95% | 55% | ~62% | Très sensible, screening |
| **CRP + IL-6** | 93% | 83% | ~78% | Excellente combinaison |
| **Alpha-défensine seule (ELISA)** | 97% | 97% | ~95% | Quasi-suffisant isolément |
| **Alpha-défensine + leucocytes synoviaux** | 99% | 96% | ~97% | Quasi-certitude |
| **Alpha-défensine + CRP + VS** | 99% | 93% | ~93% | Redondance utile |

### Combinaisons imagerie + biologie

| Combinaison | Sensibilité | Spécificité | Probabilité infection si concordants ⊕ | Probabilité infection si discordants | Intérêt clinique |
|-------------|:-----------:|:-----------:|:--------------------------------------:|:-----------------------------------:|-----------------|
| **Rx + CRP** | 60% | 82% | ~65% | ~25% | Screening initial, urgences |
| **Rx + CRP + VS** | 65% | 78% | ~60% | ~30% | Bilan de 1ère intention |
| **Rx + CRP + VS + PCT** | 70% | 83% | ~72% | ~22% | Bon screening rapide |
| **Scanner + CRP** | 75% | 80% | ~70% | ~20% | Bilan séquestres + inflammation |
| **Scanner + CRP + VS** | 80% | 76% | ~68% | ~18% | Bilan complet ostéomyélite |
| **IRM seule** | 92% | 85% | ~82% | ~8% | Très bon isolément |
| **IRM + CRP** | 95% | 87% | ~87% | ~6% | Excellente combinaison |
| **IRM + CRP + VS** | 96% | 84% | ~85% | ~5% | Standard clinique habituel |
| **IRM + CRP + PCT** | 96% | 90% | ~91% | ~4% | Très performant |
| **IRM + CRP + VS + PCT** | 97% | 88% | ~89% | ~3% | Complet mais redondant |
| **IRM + alpha-défensine** | 99% | 96% | ~97% | ~2% | Quasi-certitude diagnostique |
| **IRM + leucocytes synoviaux + CRP** | 98% | 92% | ~93% | ~3% | Excellent en pratique |
| **Scinti Tc99m + CRP** | 88% | 65% | ~55% | ~15% | Sensible mais flou |
| **Scinti leucocytes marqués + CRP** | 92% | 88% | ~85% | ~8% | Bon si IRM non dispo |
| **TEP-FDG + CRP** | 96% | 82% | ~83% | ~4% | Excellent, surtout rachis |
| **TEP-FDG/TDM + CRP** | 97% | 90% | ~91% | ~3% | Top combinaison nucléaire |
| **TEP-FDG/TDM + CRP + VS** | 98% | 88% | ~90% | ~2% | Très complet |
| **Rx + IRM + CRP + VS** | 96% | 86% | ~87% | ~5% | Bilan standard complet |
| **Rx + Scanner + IRM** | 95% | 88% | ~88% | ~5% | Triple imagerie (rarement nécessaire) |

### Exemples pratiques — Stratégies diagnostiques combinées

**Exemple 1 — Stratégie en escalade aux urgences**
> M. Dupuis, 55 ans, arrive aux urgences avec un genou droit chaud, gonflé depuis 48h. Fièvre 38.5°C. PTG il y a 2 ans.
> - **Étape 1 (5 min)** : Biologie urgente → CRP = 145 mg/L ⊕, leucocytes = 14 500 ⊕
>   - Probabilité : ~60% → suspicion renforcée, mais insuffisant pour confirmer
> - **Étape 2 (30 min)** : Radiographie → pas de descellement évident, pas d'ostéolyse → Rx seule peu utile
>   - CRP ⊕ + Rx normale : ne change pas la probabilité de façon significative
> - **Étape 3 (même jour)** : Ponction articulaire en urgence → leucocytes synoviaux = 52 000/μL, 93% PNN
>   - CRP ⊕ + synoviale ⊕ : probabilité > 95%
> - **Étape 4 (J2)** : Cultures → *S. aureus* SASM
> - **Conclusion** : inutile d'attendre une IRM quand la ponction est possible et contributive. L'IRM rallonge le délai sans changer la prise en charge aux urgences.

**Exemple 2 — Quand l'IRM est indispensable**
> Mme Perrin, 48 ans, rachialgie lombaire intense depuis 3 semaines. Fièvre intermittente 38.2°C. CRP = 85 mg/L.
> - Radiographie rachidienne : **NORMALE** (les radiographies sont normales pendant les 2-4 premières semaines de spondylodiscite)
> - Scanner : pincement discal suspect L3-L4, mais non spécifique
> - **IRM rachidienne** : hypersignal T2 des plateaux vertébraux L3-L4, prise de contraste discale, collection pré-vertébrale de 2 cm
> - Biopsie disco-vertébrale sous scanner : *S. aureus*
> - **Ici l'IRM est irremplaçable** : c'est le seul examen capable de diagnostiquer une spondylodiscite au stade précoce. → Se = 92%, Sp = 85%.

**Exemple 3 — Résultats discordants : que faire ?**
> M. Costa, 70 ans, PTH douloureuse à 3 ans. Bilan au CRIOA :
> - CRP = 22 mg/L → **élevée** ⊕
> - IRM hanche : **normale** ⊖ (pas de collection, pas d'hypersignal)
> - Ponction : leucocytes = 2 100/μL → **normal** ⊖
> - Alpha-défensine : **négative** ⊖
> - **Résultats discordants** : CRP ⊕ / tout le reste ⊖
> - Probabilité infection si discordants = ~5-8%
> - **Chercher une autre cause de CRP élevée** : infection urinaire ? dentaire ? pathologie inflammatoire ? néoplasie ?
> - Bilan complet : **infection urinaire à E. coli** traitée → CRP se normalise → la hanche n'était pas infectée.
> - **Leçon** : la CRP est un marqueur systémique, pas spécifique de l'articulation. Résultats discordants → chercher ailleurs.

---

## 11. VPP et VPN selon le contexte clinique

### Prévalence estimée de l'IOA selon le contexte

| Contexte clinique | Prévalence IOA estimée | Profil patient type |
|-------------------|:----------------------:|---------------------|
| **Médecine générale** | 0.1-1% | Douleur articulaire banale, tout-venant |
| **Urgences générales** | 1-5% | Fièvre + douleur ostéoarticulaire |
| **Consultation orthopédique** | 5-10% | Douleur post-opératoire, prothèse douloureuse |
| **Consultation spécialisée IOA** | 15-30% | Adressé pour suspicion d'infection |
| **Clinique orthopédique (post-op)** | 1-3% | Surveillance post-chirurgicale systématique |
| **Hôpital — service d'orthopédie** | 10-20% | Patients hospitalisés, reprises chirurgicales |
| **CRIOA / Centre de référence IOA** | 40-70% | Patients adressés pour IOA probable/confirmée |
| **Bloc opératoire (révision prothétique)** | 30-50% | Descellement à confirmer septique vs aseptique |

### CRP (Se=85%, Sp=70%) selon le contexte

| Contexte | Prévalence | **VPP** | **VPN** | Interprétation |
|----------|:----------:|:-------:|:-------:|----------------|
| Médecine générale | 0.5% | **1.4%** | 99.9% | CRP ⊕ = faux positif dans 98.6% des cas |
| Urgences | 3% | **8.1%** | 99.3% | CRP ⊕ quasi inutile pour diagnostiquer |
| Consultation ortho | 7% | **17.6%** | 98.4% | CRP ⊕ = 1 chance sur 5 d'infection |
| Consultation IOA spécialisée | 25% | **48.6%** | 93.3% | CRP ⊕ = 1 chance sur 2 |
| Hôpital orthopédie | 15% | **33.4%** | 96.4% | CRP ⊕ = 1 chance sur 3 |
| CRIOA | 50% | **73.9%** | 82.4% | CRP ⊕ = 3 chances sur 4 |
| Bloc (révision) | 40% | **65.4%** | 87.5% | CRP ⊕ = 2 chances sur 3 |

### IRM (Se=92%, Sp=85%) selon le contexte

| Contexte | Prévalence | **VPP** | **VPN** | Interprétation |
|----------|:----------:|:-------:|:-------:|----------------|
| Médecine générale | 0.5% | **3.0%** | 99.95% | IRM ⊕ = faux positif dans 97% des cas |
| Urgences | 3% | **15.9%** | 99.7% | IRM ⊕ = 1 chance sur 6 |
| Consultation ortho | 7% | **31.6%** | 99.3% | IRM ⊕ = 1 chance sur 3 |
| Consultation IOA spécialisée | 25% | **67.2%** | 96.9% | IRM ⊕ = 2 chances sur 3 |
| Hôpital orthopédie | 15% | **52.0%** | 98.4% | IRM ⊕ = 1 chance sur 2 |
| CRIOA | 50% | **86.0%** | 91.4% | IRM ⊕ = très fiable |
| Bloc (révision) | 40% | **80.3%** | 94.1% | IRM ⊕ = fiable |

### Alpha-défensine ELISA (Se=97%, Sp=97%) selon le contexte

| Contexte | Prévalence | **VPP** | **VPN** | Interprétation |
|----------|:----------:|:-------:|:-------:|----------------|
| Médecine générale | 0.5% | **14.0%** | 99.98% | Même un excellent test : faux ⊕ en prévalence basse |
| Urgences | 3% | **50.0%** | 99.9% | 1 chance sur 2 |
| Consultation ortho | 7% | **70.9%** | 99.8% | Bon mais pas suffisant |
| Consultation IOA spécialisée | 25% | **91.5%** | 99.0% | Très fiable |
| Hôpital orthopédie | 15% | **85.1%** | 99.5% | Très fiable |
| CRIOA | 50% | **97.0%** | 97.0% | Quasi-certitude |
| Bloc (révision) | 40% | **95.6%** | 98.0% | Quasi-certitude |

### CRP + IRM (Se=95%, Sp=87%) selon le contexte

| Contexte | Prévalence | **VPP** | **VPN** | Interprétation |
|----------|:----------:|:-------:|:-------:|----------------|
| Médecine générale | 0.5% | **3.6%** | 99.97% | Inutile en ville |
| Urgences | 3% | **18.4%** | 99.8% | Screening correct |
| Consultation ortho | 7% | **35.5%** | 99.6% | 1 chance sur 3 |
| Consultation IOA spécialisée | 25% | **70.9%** | 98.1% | Bon |
| Hôpital orthopédie | 15% | **56.3%** | 99.0% | 1 chance sur 2 |
| CRIOA | 50% | **88.0%** | 94.6% | Excellent |
| Bloc (révision) | 40% | **83.7%** | 96.3% | Excellent |

### CRP + IRM + Alpha-défensine (Se=99%, Sp=96%) selon le contexte

| Contexte | Prévalence | **VPP** | **VPN** | Interprétation |
|----------|:----------:|:-------:|:-------:|----------------|
| Médecine générale | 0.5% | **11.1%** | 99.99% | Exclusion quasi-parfaite si ⊖ |
| Urgences | 3% | **43.3%** | 99.97% | VPN remarquable |
| Consultation ortho | 7% | **65.1%** | 99.9% | Bon |
| Consultation IOA spécialisée | 25% | **89.2%** | 99.7% | Excellent |
| Hôpital orthopédie | 15% | **81.4%** | 99.9% | Excellent |
| CRIOA | 50% | **96.1%** | 98.9% | Quasi-certitude |
| Bloc (révision) | 40% | **94.3%** | 99.3% | Quasi-certitude |

### Tableau synthèse — VPP par contexte et par test

| Test / Contexte | Généraliste (0.5%) | Urgences (3%) | Ortho (7%) | Spécialiste IOA (25%) | CRIOA (50%) |
|----------------|:------------------:|:-------------:|:----------:|:--------------------:|:-----------:|
| **CRP seule** | 1.4% | 8% | 18% | 49% | 74% |
| **CRP + VS** | 1.7% | 10% | 21% | 52% | 77% |
| **IRM seule** | 3.0% | 16% | 32% | 67% | 86% |
| **CRP + IRM** | 3.6% | 18% | 36% | 71% | 88% |
| **Alpha-défensine** | 14% | 50% | 71% | 92% | 97% |
| **CRP + IRM + α-déf** | 11% | 43% | 65% | 89% | 96% |
| **ICM 2018 complet** | 12% | 46% | 68% | 91% | 97% |

### Règle d'or

- **En médecine générale (prévalence <1%)** : aucun test n'a de bonne VPP. Mais VPN excellente → si test normal = infection quasi-exclue. Rôle du test = EXCLURE, pas confirmer.
- **En centre spécialisé / CRIOA (prévalence 40-70%)** : VPP excellente → test ⊕ = infection quasi-certaine. C'est là que les tests CONFIRMENT le diagnostic.
- **Un test positif chez le généraliste ≠ un test positif au CRIOA**

### Exemples pratiques — VPP/VPN en situation réelle

**Exemple 1 — Généraliste : CRP positive, que faire ?**
> Dr Martin, médecin généraliste. Son patient M. Robert, 60 ans, PTH à 1 an, se plaint de douleurs de hanche modérées. CRP = 18 mg/L.
> - Prévalence en médecine générale : 0.5%
> - VPP de la CRP = **1.4%** → 98.6% de chances que ce soit un faux positif
> - **Conduite correcte** : ne PAS mettre sous antibiotiques ! Adresser au spécialiste orthopédiste pour avis. Demander une VS en complément.
> - **Erreur fréquente** : « CRP élevée + prothèse douloureuse = infection → antibiotiques d'emblée ». C'est FAUX en ville.

**Exemple 2 — CRIOA : les mêmes résultats, stratégie opposée**
> Même patient, même CRP = 18 mg/L, mais vu au CRIOA (prévalence 50%).
> - VPP de la CRP = **73.9%** → 3 chances sur 4 d'infection réelle
> - **Conduite** : ponction articulaire le jour même, bilan complet ICM 2018, hémocultures, mise en attente du bloc opératoire.

**Exemple 3 — Urgences : IRM positive chez un patient fébrile**
> Urgences, M. Petit, 45 ans, fièvre + douleur genou. IRM : épanchement articulaire avec prise de contraste synoviale (prévalence urgences : 3%).
> - VPP de l'IRM = **15.9%** → seulement 1 chance sur 6 d'infection
> - Les autres causes possibles d'IRM positive : goutte, chondrocalcinose, arthrite réactionnelle, polyarthrite rhumatoïde
> - **Conduite** : ponction articulaire systématique. L'IRM ne suffit jamais seule aux urgences pour conclure.

**Exemple 4 — Bloc opératoire : alpha-défensine positive en révision prothétique**
> Bloc opératoire, révision PTG, prévalence = 40%.
> - Alpha-défensine Synovasure® positive au bloc
> - VPP = **95.6%** → quasi-certitude d'infection
> - **Conduite** : modifier la stratégie chirurgicale immédiatement (spacer au lieu de nouveau implant)
> - Le chirurgien peut prendre cette décision avec confiance car la VPP est > 95% dans ce contexte.

---

## 12. Alpha-défensine

L'**alpha-défensine** est une **protéine antimicrobienne** produite par les **polynucléaires neutrophiles** (globules blancs) en réponse à une infection.

### Principe
- Quand une articulation est infectée, les neutrophiles affluent et libèrent massivement de l'alpha-défensine dans le **liquide synovial**
- En l'absence d'infection, le taux d'alpha-défensine est très bas
- C'est un **marqueur direct de l'activité immunitaire locale** contre un pathogène

### Deux formats de test

| Test | Méthode | Résultat | Sensibilité | Spécificité | Délai |
|------|---------|----------|:-----------:|:-----------:|:-----:|
| **Lateral flow** (Synovasure®) | Bandelette (comme un test de grossesse) | Positif / Négatif | 85-97% | 95-100% | 10 min |
| **ELISA** (laboratoire) | Dosage quantitatif | Valeur en mg/L (seuil >5.2) | 97-100% | 95-97% | 24-48h |

### Pourquoi c'est le meilleur marqueur synovial
1. **Non affecté** par les antibiotiques en cours (contrairement aux cultures)
2. **Non affecté** par les pathologies inflammatoires (polyarthrite rhumatoïde, goutte) → très spécifique de l'infection
3. **Fonctionne** même sur les germes à croissance lente (*C. acnes*, *S. epidermidis*)
4. **Inclus** dans les critères ICM 2018 (Parvizi) comme critère majeur

### En pratique
- Le chirurgien fait une **ponction articulaire** (genou, hanche, épaule)
- Au **bloc opératoire** → bandelette Synovasure® (résultat en 10 min)
- Au **laboratoire** → ELISA (résultat plus précis, 24-48h)
- Alpha-défensine positive = infection très probable (VPP > 95% en contexte spécialisé)

### Limite
- Le test nécessite un **liquide synovial de qualité** (non contaminé par du sang → faux positifs possibles si ponction traumatique)
- Coût élevé du test Synovasure® (~150-200€ par bandelette)

### Exemples pratiques — Alpha-défensine

**Exemple 1 — Alpha-défensine au bloc : décision peropératoire**
> M. Garcia, 62 ans, reprise de PTG pour descellement supposé « mécanique ». Pas de fièvre, CRP = 8 mg/L (limite), VS = 25 mm/h.
> - Au bloc, le chirurgien ouvre l'articulation : liquide synovial un peu trouble, tissu légèrement inflammatoire mais pas de pus franc.
> - **Test Synovasure® au bloc** (bandelette lateral flow) : résultat en 10 minutes → **POSITIF**
> - Le chirurgien modifie immédiatement sa stratégie : au lieu d'un simple changement de prothèse en 1 temps, il réalise une **explantation** + mise en place d'un **spacer aux antibiotiques** (stratégie en 2 temps).
> - Cultures peropératoires (résultat à J5) : *Staphylococcus epidermidis* sur 4/5 prélèvements → infection confirmée.
> - **Sans la bandelette** : le chirurgien aurait posé une nouvelle prothèse dans un milieu infecté → échec quasi-certain.

**Exemple 2 — Alpha-défensine sous antibiotiques**
> Mme Nguyen, 58 ans, PTH gauche à 8 mois, déjà sous amoxicilline depuis 3 semaines (prescrite par son généraliste pour « suspicion d'infection »).
> - Ponction au CRIOA sous échographie : liquide clair
> - **Cultures** : toutes NÉGATIVES (stérilisées par les ATB)
> - **Alpha-défensine ELISA** : **7.8 mg/L → POSITIF** (seuil > 5.2 mg/L)
> - Leucocytes synoviaux : 9 500/μL (élevé)
> - **Interprétation** : l'alpha-défensine n'est PAS affectée par les antibiotiques (elle est produite par les neutrophiles, pas par les bactéries). Le diagnostic d'infection est confirmé malgré les cultures négatives.
> - Décision : changement en 2 temps. Le germe sera finalement identifié par NGS : *Cutibacterium acnes*.

**Exemple 3 — Faux positif lié à une ponction traumatique**
> M. Dubois, 72 ans, PTG à 5 ans, exploration pour douleur mécanique. Ponction en consultation.
> - Liquide articulaire très **hémorragique** (ponction difficile, 3 tentatives)
> - Alpha-défensine Synovasure® : **POSITIF**
> - Leucocytes synoviaux : 1 200/μL (normal)
> - CRP = 4 mg/L (normal), cultures négatives
> - **Interprétation** : FAUX POSITIF. Le sang contient de l'alpha-défensine (dans les neutrophiles circulants). Un liquide très hémorragique fausse le test.
> - **Conduite** : nouvelle ponction à 2 semaines, liquide clair cette fois → alpha-défensine NÉGATIVE. Pas d'infection.
> - **Leçon** : si le liquide est sanglant, l'alpha-défensine n'est pas fiable. Refaire la ponction ou utiliser l'ELISA (moins sensible à la contamination sanguine).

**Exemple 4 — Alpha-défensine et polyarthrite rhumatoïde**
> Mme Laurent, 55 ans, polyarthrite rhumatoïde active, PTG gauche à 3 ans. Genou gonflé, chaud.
> - CRP = 60 mg/L → élevée, mais ininterprétable (la PR élève la CRP !)
> - Leucocytes synoviaux = 18 000/μL → élevé, mais la PR aussi donne des leucocytes élevés
> - **Alpha-défensine ELISA** : **1.8 mg/L → NÉGATIF**
> - **Interprétation** : la PR donne de faux positifs sur CRP et leucocytes synoviaux, mais PAS sur l'alpha-défensine. Alpha-défensine négative = pas d'infection surajoutée → poussée inflammatoire de la PR.
> - **C'est pourquoi l'alpha-défensine est le marqueur de choix chez les patients avec maladies inflammatoires chroniques.**

---

## 13. Critères ICM 2018

Les **critères ICM 2018** (International Consensus Meeting 2018, Philadelphia) sont le **standard international** pour le diagnostic d'infection périprothétique (IPP), publiés par **Javad Parvizi et al.**

### Critères MAJEURS (1 seul suffit = infection confirmée)

| Critère | Détail |
|---------|--------|
| **2 cultures peropératoires positives** | Même germe isolé sur ≥2 prélèvements distincts |
| **Fistule** | Communication directe entre l'articulation et la peau |

Si un seul critère majeur est présent = **infection confirmée**, pas besoin d'aller plus loin.

### Critères MINEURS (système de score pondéré)

Si aucun critère majeur, on additionne les points :

#### Critères sériques (sang)

| Critère | Score | Seuil |
|---------|:-----:|-------|
| **CRP élevée** | 2 points | >10 mg/L |
| **D-dimères élevés** | 2 points | >860 ng/mL |
| **VS élevée** | 1 point | >30 mm/h |

#### Critères synoviaux (ponction articulaire)

| Critère | Score | Seuil |
|---------|:-----:|-------|
| **Leucocytes synoviaux élevés** | 3 points | >3000/μL (chronique) ou >10 000/μL (aiguë) |
| **Alpha-défensine positive** | 3 points | Test lateral flow ou ELISA >5.2 mg/L |
| **Leukocyte esterase positive** | 3 points | ++ sur bandelette |
| **% PNN synoviaux élevé** | 2 points | >80% (chronique) ou >90% (aiguë) |
| **CRP synoviale élevée** | 1 point | >6.9 mg/L |

#### Critères peropératoires (au bloc)

| Critère | Score | Détail |
|---------|:-----:|-------|
| **Histologie positive** | 3 points | >5 PNN/champ (×400) sur ≥5 champs |
| **Aspect purulent** | 3 points | Pus macroscopique per-opératoire |
| **1 culture peropératoire positive** | 2 points | 1 seul prélèvement positif |

### Interprétation du score total

| Score | Diagnostic |
|:-----:|------------|
| **≥ 6 points** | **Infecté** |
| **4-5 points** | **Possiblement infecté** (investigation complémentaire) |
| **≤ 3 points** | **Non infecté** |

### Performances des critères ICM 2018

| Métrique | Valeur |
|----------|:------:|
| **Sensibilité** | 97.7% |
| **Spécificité** | 99.5% |
| **VPP (en centre spécialisé)** | ~97% |
| **VPN** | ~99% |

### Différence avec les anciens critères MSIS 2011

| | MSIS 2011 | ICM 2018 |
|---|---|---|
| **Système** | Critères majeurs/mineurs binaires | Score pondéré (points) |
| **D-dimères** | Non inclus | Inclus (2 pts) |
| **Alpha-défensine** | Non inclus | Inclus (3 pts) |
| **CRP synoviale** | Non inclus | Inclus (1 pt) |
| **Leukocyte esterase** | Non inclus | Inclus (3 pts) |
| **Zone grise** | Oui/Non seulement | Zone "possiblement infecté" (4-5 pts) |
| **Performance** | Se 79-97%, Sp 78-99% | Se 97.7%, Sp 99.5% |

### Exemple pratique

Patient avec prothèse de genou douloureuse à 18 mois :
- CRP = 35 mg/L → 2 pts
- D-dimères = 1200 ng/mL → 2 pts
- Ponction : leucocytes synoviaux = 8500/μL → 3 pts
- Alpha-défensine positive → 3 pts
- **Total = 10 points → INFECTÉ**

### Exemples pratiques — Application des critères ICM 2018

**Exemple 1 — Diagnostic clair : infection aiguë post-opératoire**
> M. Faure, 60 ans, PTG droite à J10 post-opératoire. Fièvre 39°C, genou rouge, tendu, douloureux.
> - **Critère majeur** : pas de fistule, pas encore de cultures peropératoires
> - **Critères mineurs** :
>   - CRP = 210 mg/L → 2 pts
>   - D-dimères = 3500 ng/mL → 2 pts (attention : D-dimères élevés aussi en post-op récent, à interpréter avec prudence)
>   - VS = 85 mm/h → 1 pt
>   - Ponction : leucocytes synoviaux = 65 000/μL → 3 pts
>   - Alpha-défensine = positive → 3 pts
>   - % PNN synoviaux = 95% → 2 pts
> - **Total = 13 points → INFECTÉ** (largement au-dessus du seuil de 6)
> - **Conduite** : DAIR en urgence

**Exemple 2 — Zone grise diagnostique**
> Mme Collet, 68 ans, PTH gauche à 14 mois. Douleur à la marche, légère boiterie. Pas de fièvre, pas de rougeur.
> - **Pas de critère majeur**
> - **Critères mineurs** :
>   - CRP = 12 mg/L → 2 pts (juste au-dessus du seuil)
>   - D-dimères = 750 ng/mL → 0 pt (< 860)
>   - VS = 35 mm/h → 1 pt
>   - Ponction articulaire sèche (pas de liquide récupéré)
> - **Total = 3 points → NON INFECTÉ** d'après le score
> - MAIS la ponction était sèche → pas de marqueurs synoviaux disponibles → score potentiellement sous-estimé
> - **Conduite** : nouvelle ponction écho-guidée, ou arthrographie + ponction. Si faisable :
>   - Leucocytes synoviaux = 5 200/μL → +3 pts → total passe à **6 → INFECTÉ**
> - **Leçon** : une ponction sèche est un piège. NE PAS conclure « non infecté » sans les marqueurs synoviaux.

**Exemple 3 — Critère majeur seul suffit**
> M. Benali, 75 ans, PTG à 3 ans. Fistule productive en regard du bord médial du genou depuis 2 mois. Écoulement clair, non purulent.
> - CRP = 15 mg/L (modérément élevée)
> - **Fistule = critère MAJEUR → infection CONFIRMÉE d'emblée**
> - Pas besoin de calculer le score mineur, pas besoin de ponction, pas besoin d'alpha-défensine
> - **Conduite** : changement prothétique en 2 temps (fistule = facteur d'échec du DAIR)

**Exemple 4 — Infection à germe bas-grade : le diagnostic difficile**
> Mme Werner, 55 ans, PTH douloureuse à 2 ans. Douleur sourde, permanente, jamais de fièvre. Pas de rougeur, pas d'écoulement.
> - **Critères mineurs** :
>   - CRP = 8 mg/L → 0 pt (< 10 → sous le seuil !)
>   - D-dimères = 920 ng/mL → 2 pts
>   - VS = 28 mm/h → 0 pt (< 30)
>   - Leucocytes synoviaux = 2 800/μL → 0 pt (< 3000 — juste sous le seuil !)
>   - Alpha-défensine ELISA = 5.8 mg/L → 3 pts (> 5.2 → positif)
>   - % PNN = 78% → 0 pt (< 80)
> - **Total = 5 points → POSSIBLEMENT INFECTÉ** (zone grise 4-5 pts)
> - **Conduite** : prélèvements peropératoires indiqués. Biopsie synoviale sous arthroscopie.
>   - Histologie : 8 PNN/champ (> 5) → +3 pts → total = **8 → INFECTÉ**
>   - Cultures : *Cutibacterium acnes* (3/5 positives à J10) → critère majeur → confirmé
> - **Leçon** : les infections chroniques bas-grade (C. acnes, S. epidermidis) sont en dessous des seuils biologiques classiques. L'alpha-défensine et l'histologie sont les meilleurs outils pour ces cas limites.

**Exemple 5 — Diagnostic rapide avec la bandelette au bloc**
> M. Torres, 70 ans, révision de PTG supposée « mécanique ». Le chirurgien suspecte une infection en peropératoire (tissus inflammatoires).
> - **Chronologie au bloc** :
>   - 14h00 : ouverture articulaire → tissu inflammatoire, pas de pus
>   - 14h05 : prélèvement liquide synovial + 5 biopsies + **bandelette Synovasure®**
>   - 14h15 : **Synovasure® = POSITIF**
>   - 14h20 : **décision immédiate** → changement en 2 temps au lieu de la révision simple prévue
>   - 14h30 : explantation de la prothèse, mise en place d'un spacer PMMA + vancomycine + gentamicine
> - **J5** : cultures → *S. epidermidis* résistant à la méticilline sur 3/5 prélèvements
> - **Résultat** : le résultat de la bandelette en 10 minutes a modifié la stratégie chirurgicale en temps réel et évité un échec prévisible.

---

| Score / Critères | Composants | Sensibilité | Spécificité | Référence |
|-----------------|-----------|:-----------:|:-----------:|-----------|
| **MSIS 2011** | CRP, VS, leuco synovial, % PNN, culture, histologie | 79-97% | 78-99% | Parvizi et al. 2011 |
| **ICM 2018** | CRP, D-dimères, VS, leuco synovial, alpha-défensine, leukocyte esterase, % PNN, culture | 97% | 95% | Parvizi et al. 2018 |
| **Score WAIOT 2019** | CRP + VS + imagerie + clinique + microbiologie | 94% | 90% | Romano et al. 2019 |
| **Score Tsukayama** | Clinique + délai + culture peropératoire | Classification pronostique | — | Tsukayama 1996 |
| **Critères de McPherson** | Terrain + type infection + état local | Score pronostique chirurgical | — | McPherson 2002 |

---

## 14. Small Colony Variants (SCV)

### Définition

Les **Small Colony Variants** sont des sous-populations bactériennes phénotypiquement modifiées, caractérisées par une croissance très lente et des colonies anormalement petites (environ 1/10 de la taille normale) sur milieu de culture standard.

### Aspect macroscopique (sur la gélose)

| Caractéristique | Phénotype normal *S. aureus* | Phénotype SCV |
|----------------|:----------------------------:|:-------------:|
| **Taille des colonies** | 2-4 mm à 24h | **< 1 mm** (souvent 0.1-0.3 mm), même après 48-72h |
| **Pigmentation** | Dorée (staphyloxanthine) | **Blanche, grisâtre, non pigmentée** |
| **Hémolyse** (gélose au sang) | β-hémolyse franche (halo clair) | **Absente ou très réduite** |
| **Aspect de la colonie** | Bombée, opaque, lisse | **Plate, translucide, « fried egg »** (œuf au plat) |
| **Odeur** | Caractéristique | Absente ou modifiée |
| **Temps d'apparition** | 18-24h | **48-72h**, parfois **5-7 jours** |

> **Piège diagnostique majeur** : à 24h de culture, les SCV sont souvent **invisibles à l'œil nu** ou confondues avec des contaminants environnementaux.

### Les 3 auxotrophies classiques

#### SCV déficientes en ménadione (vitamine K)

| Propriété | Détail |
|-----------|--------|
| **Voie affectée** | Biosynthèse des ménaquinones (coenzyme de la chaîne respiratoire) |
| **Conséquence** | ↓↓ production d'ATP via la phosphorylation oxydative |
| **Gènes mutés** | *menB*, *menC*, *menD*, *menE*, *menF* |
| **Réversion** | Croissance restaurée par ajout de **ménadione** au milieu de culture |
| **Test diagnostique** | Stries croisées avec *S. aureus* producteur de ménadione → restauration de la croissance au croisement |
| **Fréquence** | La plus fréquente en clinique |

#### SCV déficientes en hémine

| Propriété | Détail |
|-----------|--------|
| **Voie affectée** | Biosynthèse de l'hème (cytochromes a et b de la chaîne respiratoire) |
| **Conséquence** | ↓↓ respiration aérobie, bascule vers fermentation |
| **Gènes mutés** | *hemA*, *hemB*, *hemH*, *ctaA* |
| **Réversion** | Croissance restaurée par ajout d'**hémine** ou de **sang** au milieu |
| **Fréquence** | Fréquente, souvent en association avec déficit en ménadione |

#### SCV déficientes en thymidine

| Propriété | Détail |
|-----------|--------|
| **Voie affectée** | Synthèse de la thymidine (nucléotide pour l'ADN) |
| **Conséquence** | ↓↓ réplication de l'ADN, division cellulaire ralentie |
| **Gènes mutés** | *thyA* (thymidylate synthase) |
| **Réversion** | Croissance restaurée par ajout de **thymidine** au milieu |
| **Sélection** | Fortement sélectionnées par le **cotrimoxazole** (TMP-SMX) qui bloque la voie des folates |
| **Particularité** | **Résistance au cotrimoxazole** car la bactérie utilise la thymidine exogène (des tissus humains) |
| **Piège** | In vitro sur milieu sans thymidine → « sensible » à TMP-SMX. In vivo → **résistante** (thymidine tissulaire disponible) |

### Résistance aux antibiotiques (phénotypique, non génétique)

| Antibiotique | Phénotype normal | SCV | Commentaire |
|-------------|:----------------:|:---:|-------------|
| **Aminosides** (gentamicine, tobramycine) | Sensible | **RÉSISTANT** | ↓↓ potentiel de membrane → pas de transport |
| **Bêta-lactamines** | Sensible (si MSSA) | **RÉDUIT** | ↓ croissance = ↓ cibles PBP actives |
| **Cotrimoxazole** (TMP-SMX) | Sensible | **RÉSISTANT** (SCV thyA) | In vivo, thymidine tissulaire disponible |
| **Rifampicine** | Sensible | **SENSIBLE ✓** | Actif même sur métabolisme lent |
| **Daptomycine** | Sensible | **SENSIBLE ✓** | Membrane intacte, actif en intracellulaire |
| **Linézolide** | Sensible | **SENSIBLE ✓** | Actif sur ribosome 50S, bonne pénétration intracellulaire |

### Facteurs de virulence

| Facteur | Phénotype normal | SCV |
|---------|:----------------:|:---:|
| **α-toxine** (hémolysine) | +++ | **−** ou traces |
| **Protéine A** | +++ | **↓** |
| **Coagulase** | +++ | **↓** (test en tube peut être retardé) |
| **Staphyloxanthine** (pigment) | +++ (colonies dorées) | **−** (colonies blanches) |
| **Biofilm** | ++ | **+++** (formation accrue !) |
| **Protéines d'adhésion** (FnBP) | ++ | **+++** (adhérence accrue) |
| **Invasion cellulaire** | + (faible) | **+++** (invasion massive des ostéoblastes) |

> **Paradoxe des SCV** : virulence extracellulaire réduite (moins de toxines → infection « silencieuse ») MAIS capacité d'invasion et de persistance intracellulaire considérablement augmentée.

### Invasion et persistance intracellulaire

Les SCV se réfugient **à l'intérieur des ostéoblastes, ostéocytes et cellules endothéliales** via la liaison FnBP-A/B → intégrine α5β1. Elles survivent dans le phagosome sans produire de toxines lytiques, échappant ainsi au système immunitaire et à la plupart des antibiotiques extracellulaires. Seuls la rifampicine, le linézolide et la daptomycine pénètrent suffisamment pour atteindre les SCV intracellulaires.

### Germes les plus fréquemment en SCV

| Bactérie | Fréquence SCV en IOA |
|----------|:-------------------:|
| ***Staphylococcus aureus*** | **Le plus fréquent** — modèle de référence |
| *S. epidermidis* / SCN | Fréquent sur matériel prothétique |
| *Pseudomonas aeruginosa* | Rare, décrit dans l'ostéomyélite chronique |

### Implications cliniques en IOA

| Situation | Impact des SCV |
|-----------|---------------|
| **IOA chronique avec cultures négatives** | Penser aux SCV ! Prolonger les cultures à **14 jours** |
| **Rechute après traitement bien conduit** | SCV intracellulaires libérées après arrêt des antibiotiques |
| **« Guérison » apparente puis récidive à distance** | Réversion phénotypique : SCV → phénotype normal virulent |
| **Échec du DAIR** | SCV dans le biofilm résiduel, non éradiquées |

### Réversion phénotypique — Le danger clinique

Le phénotype SCV est **réversible** : en retirant la pression de sélection (arrêt des antibiotiques), la bactérie peut reverter au phénotype normal et redevenir pleinement virulente, provoquant une **rechute clinique** à 3, 6, 12 mois après une « guérison » apparente.

### Identification au laboratoire

| Méthode | Capacité de détection SCV | Commentaire |
|---------|:-------------------------:|-------------|
| **Culture standard 24h** | **FAIBLE** — souvent ratées | Colonies trop petites pour être vues |
| **Culture prolongée 5-14 jours** | **BONNE** | Protocole recommandé en IOA |
| **Milieu enrichi** (hémine + ménadione) | **EXCELLENTE** | Restaure la croissance normale |
| **MALDI-TOF** | **Variable** | Spectre altéré, base de données parfois insuffisante |
| **PCR universelle 16S** | **EXCELLENTE** | Détecte l'ADN bactérien indépendamment du phénotype |
| **Sonication du matériel** | **TRÈS BONNE** | Détache les SCV du biofilm → augmente la sensibilité |

#### Test d'auxotrophie (identification du sous-type SCV)

Sur une gélose Mueller-Hinton, déposer 3 disques :
1. **Hémine** → si croissance autour = SCV hémine-dépendante
2. **Ménadione** → si croissance autour = SCV ménadione-dépendante
3. **Thymidine** → si croissance autour = SCV thymidine-dépendante

### Exemples pratiques — SCV en situation clinique

**Exemple 1 — Cultures négatives malgré une infection évidente**
> Mme Laurent, 62 ans, PTH gauche à 18 mois. Douleur chronique, CRP fluctuante entre 8 et 15 mg/L. Ponction articulaire : leucocytes synoviaux = 4 200/μL, cultures standard négatives à 48h. Alpha-défensine ELISA = 6.1 mg/L (positive).
> - **Problème** : cultures négatives mais alpha-défensine positive → discordance
> - **Conduite** : reprise chirurgicale (changement en 2 temps). Prélèvements peropératoires mis en culture **14 jours** sur milieux enrichis.
> - **J7** : apparition de colonies minuscules, non pigmentées sur un prélèvement. J10 : 3/5 prélèvements positifs.
> - **Identification** : *S. aureus* phénotype SCV, déficit en ménadione confirmé par test d'auxotrophie.
> - **Antibiogramme** : sensible rifampicine, résistant gentamicine (phénotypique, pas de gène de résistance).
> - **Traitement** : rifampicine + daptomycine 6 semaines, puis rifampicine + lévofloxacine orale 3 mois.
> - **Leçon** : sans la culture prolongée à 14 jours, cette infection serait restée « à cultures négatives ».

**Exemple 2 — Rechute tardive après DAIR réussi**
> M. Dupont, 58 ans, PTG infectée à 3 semaines post-opératoire. DAIR réalisé en urgence. Cultures peropératoires : *S. aureus* MSSA. Traitement : oxacilline IV 2 semaines puis rifampicine + lévofloxacine 3 mois. Bonne évolution, CRP normalisée.
> - **M+8** : douleur progressive du genou, CRP remonte à 18 mg/L.
> - **Ponction** : leucocytes = 6 500/μL, cultures : *S. aureus* SCV (thymidine-dépendant) → même souche (typage moléculaire).
> - **Explication** : les SCV avaient persisté en intracellulaire et dans le biofilm résiduel pendant le DAIR. Après arrêt des antibiotiques, réversion vers le phénotype normal virulent.
> - **Conduite** : changement en 2 temps (le DAIR a échoué).

**Exemple 3 — Piège du cotrimoxazole avec SCV thymidine-dépendantes**
> Mme Morel, 70 ans, IOA à *S. aureus* MSSA sur PTH. Changement en 2 temps en cours, spacer en place. Antibiogramme : sensible à tout, y compris cotrimoxazole. Traitement de relais oral : rifampicine + cotrimoxazole (choisi car bonne biodisponibilité orale et bonne diffusion osseuse).
> - **M+4** : cultures de contrôle lors de la reimplantation : *S. aureus* SCV thymidine-dépendant sur 2/5 prélèvements.
> - **Explication** : le cotrimoxazole bloque la voie des folates → sélection des mutants *thyA* → SCV thymidine-dépendantes. In vivo, la thymidine des tissus humains nourrit ces SCV → le cotrimoxazole est **inefficace**.
> - **Leçon** : le cotrimoxazole sélectionne les SCV thymidine-dépendantes. Préférer la lévofloxacine ou le linézolide en association avec la rifampicine si risque de SCV.

---

| Score / Critères | Composants | Sensibilité | Spécificité | Référence |
|-----------------|-----------|:-----------:|:-----------:|-----------|
| **MSIS 2011** | CRP, VS, leuco synovial, % PNN, culture, histologie | 79-97% | 78-99% | Parvizi et al. 2011 |
| **ICM 2018** | CRP, D-dimères, VS, leuco synovial, alpha-défensine, leukocyte esterase, % PNN, culture | 97% | 95% | Parvizi et al. 2018 |
| **Score WAIOT 2019** | CRP + VS + imagerie + clinique + microbiologie | 94% | 90% | Romano et al. 2019 |
| **Score Tsukayama** | Clinique + délai + culture peropératoire | Classification pronostique | — | Tsukayama 1996 |
| **Critères de McPherson** | Terrain + type infection + état local | Score pronostique chirurgical | — | McPherson 2002 |

---

*Document généré pour la Formation IOA — Plateforme VERTEX© — 8 mars 2026*
