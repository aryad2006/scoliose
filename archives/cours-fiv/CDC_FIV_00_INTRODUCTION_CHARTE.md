# 🩷 CAHIER DES CHARGES — FORMATION COMPLÈTE FÉCONDATION IN VITRO

## De la révolution de Louise Brown à l'ère de la médecine reproductive de précision

---

**Badge formation** : 🩷 FIV
**Date** : 16 mars 2026
**Version** : 1.0
**Statut** : Document fondateur — Cahier des charges complet
**Formation** : Fécondation In Vitro et Assistance Médicale à la Procréation — *In Vitro Fertilization & Assisted Reproductive Technology*
**Plateforme** : VERTEX© (Virtual Environment for Rachis Training and EXploration)

---

# TABLE DES MATIÈRES — PARTIE 0

1. [Synthèse exécutive](#1-synthèse-exécutive)
2. [Public cible et prérequis](#2-public-cible-et-prérequis)
3. [Architecture pédagogique globale](#3-architecture-pédagogique-globale)
4. [Code couleur — Formation FIV](#4-code-couleur--formation-fiv)
5. [Conventions et charte](#5-conventions-et-charte)
6. [Structure des fichiers du CDC](#6-structure-des-fichiers-du-cdc)
7. [Correspondance inter-formations](#7-correspondance-inter-formations)
8. [Références bibliographiques fondatrices](#8-références-bibliographiques-fondatrices)

---

# 1. SYNTHÈSE EXÉCUTIVE

## 1.1 Ce qu'est cette formation

La **Formation Fécondation In Vitro et AMP** est un programme e-learning exhaustif destiné aux internes en gynécologie-obstétrique, gynécologues praticiens, radiologues spécialisés en échographie gynécologique, médecins biologistes de la reproduction et embryologistes, couvrant **l'intégralité** de la fécondation in vitro et de l'assistance médicale à la procréation — depuis l'histoire fascinante des pionniers (Pincus, Chang, Edwards, Steptoe, la naissance de Louise Brown en 1978), l'anatomie et la physiologie de la reproduction humaine, la physiopathologie de l'infertilité, le bilan complet du couple infertile, les protocoles de stimulation ovarienne, le monitorage échographique, la ponction ovocytaire échoguidée, les techniques de laboratoire (FIV classique, ICSI, culture prolongée, time-lapse), le transfert embryonnaire, la cryopréservation (vitrification), le diagnostic préimplantatoire (PGT), la préservation de la fertilité, le don de gamètes, jusqu'aux innovations révolutionnaires (intelligence artificielle, gamètes artificiels, utérus artificiel, édition génomique, médecine reproductive de précision).

Elle constitue la **dixième formation** de la plateforme VERTEX©. Les formations partagent :

- La même **plateforme LMS** (architecture, authentification, évaluation)
- La même **charte graphique** de base (typographie, mise en page, icônes)
- Les mêmes **règles d'écriture pédagogique** (cas cliniques, mnémoniques, niveaux de profondeur)
- Les mêmes **standards d'évaluation** (Bronze → Diamant, cas cliniques progressifs)
- Le même **moteur de simulation** VERTEX© (adapté : **ReproSim©** pour la modélisation de la folliculogenèse, la simulation de protocoles de stimulation, la cinétique embryonnaire et les scénarios de ponction/transfert échoguidés)

## 1.2 Périmètre de la formation FIV

| Dimension | Détail |
|---|---|
| **Nombre de modules** | 45 modules organisés en 13 parties |
| **Durée estimée** | ~150-180 heures de contenu |
| **Niveau** | Fondamental → Intermédiaire → Expert |
| **Spécialités concernées** | Gynécologie-obstétrique, biologie de la reproduction, radiologie (échographie), andrologie, endocrinologie, génétique médicale, psychologie médicale, éthique biomédicale |
| **Couverture — Histoire** | Des premières tentatives animales (1890, Walter Heape) à Louise Brown (1978), l'essor de l'ICSI (Palermo, 1992), la révolution de la vitrification (Kuwayama, 2005), l'ère du PGT et de l'IA (2010-2026) |
| **Couverture — Fondamentaux** | Anatomie détaillée de l'appareil reproducteur féminin et masculin, folliculogenèse (du follicule primordial au corps jaune), ovogenèse, spermatogenèse, axe hypothalamo-hypophyso-gonadique, fécondation naturelle, implantation embryonnaire, dialogue materno-embryonnaire |
| **Couverture — Bilan d'infertilité** | Épidémiologie de l'infertilité (15% des couples), bilan féminin (réserve ovarienne — AMH, CFA, FSH/E2 J3, HSG, hystéroscopie, cœlioscopie), bilan masculin (spermogramme selon OMS 2021, OATS, fragmentation ADN, biopsie testiculaire), infertilité inexpliquée, bilan immunologique |
| **Couverture — Stimulation ovarienne** | Pharmacologie complète (FSH recombinante, HMG, analogues GnRH agonistes et antagonistes, hCG, kisspeptine), protocoles (long agoniste, court agoniste, antagoniste flexible/fixe, mild stimulation, natural cycle, DuoStim, random start), monitorage échographique et biologique, déclenchement (hCG, agoniste GnRH, double trigger), prévention et prise en charge du SHO |
| **Couverture — Techniques de laboratoire** | Ponction ovocytaire échoguidée (technique, anesthésie, complications), recueil et préparation spermatique (gradient, swim-up, MACS, microfluidique), FIV classique (insémination conventionnelle), ICSI (technique de Palermo), IMSI, PICSI, culture embryonnaire (milieux séquentiels vs uniques, co-culture), classification embryonnaire (Istanbul consensus, Gardner), time-lapse (EmbryoScope, GERI), intelligence artificielle pour la sélection embryonnaire |
| **Couverture — Transfert et implantation** | Transfert embryonnaire (technique, cathéters, échoguidage transabdominal), soutien de la phase lutéale (progestérone, E2, hCG), réceptivité endométriale (ERA, fenêtre d'implantation), diagnostic précoce de grossesse, suivi initial, grossesse gémellaire |
| **Couverture — Cryopréservation** | Congélation lente vs vitrification, vitrification ovocytaire (technique Kuwayama — Cryotop), vitrification embryonnaire (J3 vs blastocyste), TEC (cycles naturel, substitué, stimulé), préservation de la fertilité (oncofertilité, préservation sociétale, cortex ovarien) |
| **Couverture — Techniques avancées** | PGT-A (aneuploïdies — NGS, biopsie trophectoderme), PGT-M (maladies monogéniques), PGT-SR (remaniements structuraux), mosaïcisme embryonnaire, don d'ovocytes, don de sperme, accueil d'embryons, GPA (aspects internationaux), maturation in vitro (MIV), activation ovocytaire (AOA), TESE/micro-TESE, injection de spermatides rondes (ROSI) |
| **Couverture — Échographie en AMP** | Échographie pelvienne systématique (utérus, ovaires, CFA), monitorage folliculaire (croissance, E2 corrélé), écho-Doppler ovarien et utérin, échographie 3D utérine (malformations, polypes, synéchies), SonoHSG, ponction échoguidée (technique pas-à-pas), transfert échoguidé, échographie du 1er trimestre post-FIV |
| **Couverture — Biologie de la reproduction** | Organisation du laboratoire de FIV (normes COFRAC/ESHRE), contrôle qualité (KPI — taux de fécondation, clivage, blastulation, grossesse), andrologie clinique et biologique, évaluation de la qualité ovocytaire (morphologie, spindle view), milieux de culture, incubateurs (tri-gas, benchtop), cryobiologie appliquée |
| **Couverture — Complications** | SHO (classification Golan, OHSS severe), grossesses multiples (prévention par SET, réduction embryonnaire), grossesse extra-utérine post-FIV, torsion d'annexe, hémorragie post-ponction, complications infectieuses, échecs répétés d'implantation (RIF), fausses couches à répétition (RPL), insuffisance ovarienne prématurée (IOP), SOPK et FIV, endométriose sévère et FIV |
| **Couverture — Éthique et législation** | Loi de bioéthique française (2021, 2024), cadre réglementaire de l'AMP, AMP pour toutes (couples femmes, femmes seules), autoconservation ovocytaire, anonymat et accès aux origines, CECOS, Agence de la biomédecine, comparaison internationale (Espagne, Belgique, USA, Israël, Japon), accompagnement psychologique du couple, deuil périnatal, burn-out du parcours AMP |
| **Couverture — Innovations** | IA et deep learning pour la sélection embryonnaire (Fairtility, Vitrolife), IA pour la prédiction de réponse ovarienne, pharmacogénomique de la stimulation, gamètes artificiels (IVG — in vitro gametogenesis), utérus artificiel (ectogenèse), édition génomique (CRISPR — enjeux éthiques post-He Jiankui), rajeunissement ovarien (PRP, cellules souches), transplantation utérine, médecine reproductive de précision |
| **Simulation** | ReproSim© — module VERTEX© dédié (simulation de protocoles de stimulation, cinétique folliculaire, simulation de ponction échoguidée, morphocinétique embryonnaire, aide à la décision de transfert, scénarios de complications) |
| **Certification** | Certificat VERTEX© FIV-AMP, éligible DPC/CME |
| **Langue** | Français (traduction EN/ES prévue) |

## 1.3 Objectifs pédagogiques globaux

À l'issue de cette formation, le praticien sera capable de :

1. **Retracer** l'histoire de la FIV depuis les expériences pionnières de Walter Heape (1890) et Gregory Pincus (1930s) jusqu'à la naissance de Louise Brown (Edwards & Steptoe, 1978), la révolution ICSI (Palermo et al., *Lancet*, 1992), la vitrification (Kuwayama, *Theriogenology*, 2007) et l'avènement de l'IA en reproduction (2020s)
2. **Décrire** l'anatomie détaillée de l'appareil reproducteur féminin et masculin en lien avec les gestes de l'AMP (ponction, transfert, biopsie testiculaire)
3. **Expliquer** la physiologie de la folliculogenèse, de l'ovogenèse, de la spermatogenèse, et les mécanismes de la fécondation naturelle et de l'implantation embryonnaire
4. **Réaliser** le bilan complet d'un couple infertile selon les recommandations ESHRE/ASRM et prescrire les examens de première et deuxième intention
5. **Interpréter** les marqueurs de réserve ovarienne (AMH, CFA, FSH/E2 J3) et prédire la réponse ovarienne à la stimulation (critères de Bologne, POSEIDON)
6. **Prescrire** et adapter un protocole de stimulation ovarienne selon le profil de la patiente (normo-répondeuse, faible répondeuse, hyper-répondeuse, SOPK)
7. **Réaliser** et interpréter le monitorage échographique de la stimulation ovarienne (croissance folliculaire, épaisseur endométriale, corrélation écho-biologique)
8. **Maîtriser** la technique de ponction ovocytaire échoguidée (positionnement, analgésie, rinçage, gestion des complications)
9. **Comprendre** les techniques de laboratoire : FIV classique, ICSI, IMSI, culture embryonnaire, classification selon le consensus d'Istanbul, time-lapse
10. **Réaliser** un transfert embryonnaire échoguidé dans les règles de l'art (préparation, cathéter, contrôle échographique, position)
11. **Prescrire** et adapter le soutien de la phase lutéale (progestérone vaginale/IM, E2, hCG faible dose)
12. **Maîtriser** les indications et techniques de cryopréservation par vitrification (ovocytes, embryons, cortex ovarien) et les protocoles de TEC
13. **Interpréter** les résultats du PGT-A, PGT-M et PGT-SR et conseiller les couples sur les implications
14. **Organiser** un programme de préservation de la fertilité (oncofertilité, préservation sociétale) dans le respect du cadre légal
15. **Dépister** et prendre en charge le syndrome d'hyperstimulation ovarienne (prévention, classification, traitement ambulatoire et hospitalier)
16. **Analyser** les causes d'échecs répétés d'implantation et de fausses couches à répétition, et proposer un bilan et une stratégie adaptés
17. **Prendre en charge** les situations complexes : SOPK, endométriose sévère, insuffisance ovarienne prématurée, azoospermie, âge maternel avancé
18. **Connaître** le cadre légal français de l'AMP (loi de bioéthique 2021/2024), les règles d'agrément des centres, le rôle de l'Agence de la biomédecine
19. **Accompagner** psychologiquement le couple dans le parcours AMP (information, décision partagée, gestion du stress et de l'échec)
20. **Maîtriser** les innovations : IA pour la sélection embryonnaire, pharmacogénomique, gamètes artificiels, ectogenèse, édition génomique, transplantation utérine

## 1.4 Ce qui distingue cette formation

Cette formation se distingue par son approche **multi-publics** intégrée :

| Public | Angle spécifique | Modules à focus renforcé |
|---|---|---|
| **Internes gynéco-obstétrique** | Pratique clinique, gestes techniques, décision thérapeutique | M12-M22, M36-M39 |
| **Gynécologues praticiens** | Protocoles actualisés, gestion des complications, cas complexes | M08-M15, M23-M25, M36-M39 |
| **Radiologues / échographistes** | Échographie diagnostique et interventionnelle en AMP | M30-M32 (partie dédiée) |
| **Biologistes de la reproduction** | Laboratoire, qualité, techniques, innovations | M33-M35 (partie dédiée) |

Chaque module signale les sections spécifiquement pertinentes pour chaque public par un tag :
- 🔷 **CLINICIEN** — pertinent pour gynécologues et internes
- 🔶 **ÉCHOGRAPHISTE** — pertinent pour radiologues
- 🟢 **BIOLOGISTE** — pertinent pour biologistes et embryologistes
- 🟣 **TOUS** — pertinent pour l'ensemble des publics

---

# 2. PUBLIC CIBLE ET PRÉREQUIS

## 2.1 Public cible

| Niveau | Public | Modules obligatoires | Modules optionnels |
|---|---|---|---|
| **Niveau 1 — Fondamental** | Internes en gynéco-obstétrique (début de DES), médecins généralistes intéressés par la fertilité | M01-M11, M36, M40-M42 | M12-M35, M37-M45 |
| **Niveau 2 — Intermédiaire** | Internes gynéco fin de cursus, gynécologues praticiens, radiologues en échographie gynécologique | M01-M32, M36-M39, M40-M42 | M33-M35, M43-M45 |
| **Niveau 3 — Expert** | Gynécologues spécialisés en AMP, biologistes de la reproduction, embryologistes, médecins de centres de FIV | M01-M45 (intégralité) | — |

## 2.2 Prérequis

- Diplôme de médecine (ou en cours d'obtention) — ou diplôme de biologiste/pharmacien spécialisé
- Connaissances de base en anatomie pelvienne et physiologie de la reproduction (souhaitées — les Modules 4-7 reprennent les fondamentaux)
- Pour les modules d'échographie (M30-M32) : formation de base en échographie gynécologique recommandée
- Pour les modules de biologie (M33-M35) : formation de base en biologie de la reproduction recommandée
- Formation VERTEX© Endocrinologie recommandée en complément (liens croisés : axe hypothalamo-hypophyso-gonadique, SOPK)

## 2.3 Prérequis techniques

- Navigateur web récent (Chrome, Firefox, Safari, Edge)
- Module ReproSim© : WebGL compatible (GPU recommandé pour les simulations 3D de ponction échoguidée)
- Connexion internet stable (vidéos HD de gestes techniques)

---

# 3. ARCHITECTURE PÉDAGOGIQUE GLOBALE

## 3.1 Plan général — 13 parties, 45 modules

| Partie | Titre | Modules | Contenu | Heures |
|--------|-------|---------|---------|--------|
| **00** | **Introduction et charte** | — | Plan, conventions, bibliographie fondatrice | 1h |
| **01** | **Histoire de la FIV** | M01-M03 | Des pionniers à l'ère moderne, Prix Nobel, jalons | 8h |
| **02** | **Fondamentaux de la reproduction** | M04-M07 | Anatomie, folliculogenèse, spermatogenèse, fécondation | 16h |
| **03** | **Bilan d'infertilité** | M08-M11 | Épidémiologie, bilan féminin, bilan masculin, infertilité inexpliquée | 14h |
| **04** | **Stimulation ovarienne** | M12-M15 | Pharmacologie, protocoles, monitorage, déclenchement/SHO | 16h |
| **05** | **Ponction et techniques de laboratoire** | M16-M19 | Ponction échoguidée, préparation sperme, FIV/ICSI, culture embryonnaire | 16h |
| **06** | **Transfert et implantation** | M20-M22 | Transfert échoguidé, phase lutéale, grossesse précoce | 10h |
| **07** | **Cryopréservation** | M23-M25 | Vitrification, TEC, préservation de la fertilité | 12h |
| **08** | **Techniques avancées** | M26-M29 | PGT, don de gamètes, MIV, techniques émergentes | 14h |
| **09** | **Échographie en AMP** | M30-M32 | Écho diagnostique, monitorage, interventionnelle | 12h |
| **10** | **Biologie de la reproduction** | M33-M35 | Laboratoire FIV, andrologie, évaluation embryonnaire | 12h |
| **11** | **Complications et situations particulières** | M36-M39 | SHO, grossesses multiples, échecs répétés, pathologies associées | 14h |
| **12** | **Éthique, législation, psychologie** | M40-M42 | Cadre légal, bioéthique, accompagnement psychologique | 10h |
| **13** | **Innovations et avenir** | M43-M45 | IA, gamètes artificiels, médecine de précision | 10h |
| | | | **TOTAL** | **~155h** |

## 3.2 Détail des modules

### Partie 01 — Histoire de la FIV (M01-M03)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M01** | Des pionniers à Louise Brown (1890-1978) | 3h | Walter Heape (transfert embryonnaire chez le lapin, 1890), Gregory Pincus (FIV lapin, 1934), Min Chueh Chang (FIV mammifères, 1959), John Rock (FIV humaine tentatives, 1944), Miriam Menkin, Landrum Shettles, **Robert Edwards** (maturation ovocytaire in vitro, culture embryonnaire humaine, 1960s), **Patrick Steptoe** (cœlioscopie et ponction folliculaire), collaboration Edwards-Steptoe à Oldham, échecs 1966-1977, **naissance de Louise Brown** (25 juillet 1978, Oldham General Hospital), Jean Purdy (embryologiste oubliée), première FIV en France (Amandine, 24 février 1982, Frydman-Testart), premiers programmes mondiaux |
| **M02** | L'essor mondial et les révolutions techniques (1978-2000) | 3h | Dissémination mondiale des programmes FIV, premiers registres (FIVNAT France, ESHRE), **congélation embryonnaire** (Trounson, 1983 — Zoe, premier bébé né d'embryon congelé), **don d'ovocytes** (Lutjen, 1984), **ICSI** (Gianpiero Palermo, Bruxelles, 1992 — révolution pour l'infertilité masculine sévère), maturation in vitro, **diagnostic préimplantatoire** (Handyside, 1990), éclosion assistée, co-culture, débats éthiques 1980-2000, **Prix Nobel de Médecine 2010** (Robert Edwards) |
| **M03** | L'ère moderne : de la vitrification à l'IA (2000-2026) | 2h | **Vitrification** (Kuwayama, technique Cryotop, 2005 — révolution de la cryopréservation), transfert sélectif unique (SET — politique scandinave), **PGT-A par NGS** (biopsie trophectoderme, résolution des mosaïcismes), **time-lapse** (EmbryoScope, morphocinétique), **IA et deep learning** pour la sélection embryonnaire (2018-2026), préservation sociétale de la fertilité, AMP pour toutes (France, 2021), loi bioéthique 2024, registres mondiaux (>10 millions d'enfants nés par FIV), état des lieux 2026 |

### Partie 02 — Fondamentaux de la reproduction (M04-M07)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M04** | Anatomie de l'appareil reproducteur féminin | 4h | Ovaires (anatomie macroscopique, vascularisation — artère ovarienne, anastomose utéro-ovarienne, drainage veineux, plexus pampiniforme, innervation), anatomie chirurgicale pour la ponction (rapports avec les vaisseaux iliaques, l'uretère, le rectum, la vessie), trompes (segments, muqueuse ciliée, rôle dans le transport ovocytaire et la fécondation), utérus (corps, isthme, col — anatomie échographique, cavité utérine, endomètre et ses variations cycliques, vascularisation artérielle utérine et sous-endométriale), anatomie échographique pelvienne pour l'AMP |
| **M05** | Physiologie ovarienne et folliculogenèse | 4h | Réserve ovarienne (pool de follicules primordiaux — ~1-2 millions à la naissance, décroissance exponentielle, modèle de Faddy-Gosden), recrutement initial (follicule primordial → primaire → secondaire — AMH, BMP-15, GDF-9), recrutement cyclique (follicule antral → sélection du dominant — fenêtre FSH, théorie du seuil de Brown), maturation folliculaire terminale (expansion du cumulus, reprise méiotique — pic de LH), ovulation (cascade protéolytique, prostaglandines, rupture stigma), corps jaune (formation, fonction lutéale, sauvetage par hCG), atrésie folliculaire, concept de cohorte recruitable et implications pour la stimulation |
| **M06** | Reproduction masculine : spermatogenèse et andrologie | 4h | Anatomie testiculaire (tubes séminifères, cellules de Sertoli, cellules de Leydig, rete testis, épididyme, canal déférent), spermatogenèse (mitose des spermatogonies, méiose, spermiogenèse — 74 jours), maturation épididymaire, capacitation, réaction acrosomique, axe hypothalamo-hypophyso-testiculaire (GnRH, FSH, LH, testostérone, inhibine B), spermogramme selon OMS 2021 (normes de référence 6e édition), classification OATS, fragmentation de l'ADN spermatique (SCSA, TUNEL, SCD), stress oxydatif et qualité spermatique |
| **M07** | Fécondation naturelle et implantation | 4h | Transport spermatique dans le tractus féminin (glaire cervicale, transport utérin actif, réservoir tubaire isthmique), transport ovocytaire (captation par le pavillon, transport tubaire — cils + contractions), **fécondation** (liaison zona pellucida — ZP3/ZP2, réaction acrosomique, fusion des membranes, activation ovocytaire, formation des pronuclei, syngamie, première division), développement pré-implantatoire (zygote → 2 cellules → 4 cellules → morula → blastocyste — chronologie, activation du génome embryonnaire au stade 4-8 cellules chez l'humain), **implantation** (apposition, adhésion, invasion trophoblastique, fenêtre d'implantation J20-J24, rôle des pinopodes, dialogue moléculaire — LIF, intégrines, mucines, prostaglandines), décidualisation endométriale |

### Partie 03 — Bilan d'infertilité (M08-M11)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M08** | Épidémiologie de l'infertilité et parcours du couple | 4h | Définitions (infertilité OMS — 12 mois, infécondité, stérilité), épidémiologie mondiale (~15% des couples, 48,5 millions de couples — WHO 2023), tendances séculaires (déclin de la fertilité, recul de l'âge maternel), facteurs de risque modifiables (tabac, alcool, cannabis, obésité, perturbateurs endocriniens — BPA, phtalates, pesticides), étiologies (facteur féminin 35%, masculin 30%, mixte 20%, inexpliqué 15%), impact psychologique de l'infertilité, parcours AMP en France (bilan → centres agréés → tentatives remboursées — 4 FIV, 6 IIU jusqu'à 43 ans), délai de prise en charge |
| **M09** | Bilan féminin de l'infertilité | 4h | Interrogatoire (cycles, dysménorrhée, ATCD chirurgicaux, IST), examen clinique, **réserve ovarienne** (AMH — normes, seuils de mauvaise réponse <1,1 ng/mL, normo <3,5 ng/mL, excès >5 ng/mL ; CFA échographique — seuils, corrélation AMH ; FSH/E2 J2-J3), bilan hormonal (LH, PRL, TSH, T, DHEAS, 17-OHP, progestérone J22), **hystérosalpingographie** (technique, interprétation, perméabilité tubaire, hydrosalpinx — impact FIV — Strandell et al., *NEJM*, 1999), **échographie pelvienne** (CFA, pathologie utérine — fibrome, polype, adénomyose, endométriome), SonoHSG (HyCoSy, HyFoSy), **hystéroscopie** diagnostique et opératoire, cœlioscopie diagnostique (chromopertubation), bilan thrombophilie et auto-immunité (cas sélectionnés) |
| **M10** | Bilan masculin de l'infertilité | 3h | Interrogatoire (antécédents — cryptorchidie, torsion, varicocèle, IST, toxiques, médicaments gonadotoxiques, exposition professionnelle), examen clinique andrologique (volume testiculaire — orchidimètre de Prader, varicocèle, déférent palpable), **spermogramme** (OMS 2021, 6e édition — recueil, délai d'abstinence, normes : volume >1,4 mL, concentration >16 M/mL, mobilité progressive >30%, formes typiques >4% Kruger strict, vitalité >54%, leucocytes <1 M/mL), spermoculture, test de migration-survie (TMS), **spermocytogramme** (classification David modifiée, Kruger strict), bilan hormonal masculin (FSH, LH, testostérone, inhibine B, PRL), échographie scrotale (varicocèle, microlithiase, TART), génétique (caryotype, microdélétions Yq — AZFa/b/c, CFTR), **fragmentation ADN** (SCSA, TUNEL — seuils), biopsie testiculaire (indications, TESE, micro-TESE — Schlegel, *Hum Reprod*, 1999) |
| **M11** | Infertilité inexpliquée et stratégie thérapeutique | 3h | Définition (bilan complet normal — ovulation, perméabilité tubaire, spermogramme), prévalence (10-15%), mécanismes suspectés (dysfonction tubaire subtile, endométriose minime, anomalies de la fécondation, défaut d'implantation, facteurs immunologiques), bilans complémentaires de 2e ligne (laparoscopie, test post-coïtal — abandonné, ERA, test EMMA/ALICE, bilan immunologique endométrial — NK utérins), arbre décisionnel thérapeutique (expectative si <35 ans et <2 ans, IIU + stimulation modérée, FIV), méta-analyses clés (Pandian et al., *Cochrane*, 2015 — IIU vs expectative ; Tjon-Kon-Fat et al., *BMJ*, 2016 — IIU-SO vs FIV-SET), concept de pronostic naturel (modèle d'Hunault) |

### Partie 04 — Stimulation ovarienne (M12-M15)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M12** | Pharmacologie de la stimulation ovarienne | 4h | **Gonadotrophines** : FSH recombinante (follitropine α — Gonal-F, follitropine β — Puregon, follitropine δ — Rekovelle — posologie individualisée AMH/poids), FSH urinaire hautement purifiée (Fostimon), HMG (Menopur — FSH + LH), LH recombinante (Luveris), corifollitropine α (Elonva — FSH longue durée d'action) ; **Analogues GnRH agonistes** (triptoréline — Décapeptyl, leuproréline — Enantone, nafaréline — Synarel — mécanisme flare-up puis désensibilisation), **Antagonistes GnRH** (cétrorélix — Cetrotide, ganirélix — Orgalutran, élagolyx oral — en développement — blocage compétitif immédiat), **Déclencheurs d'ovulation** (hCG urinaire — Ovitrelle 250 µg, hCG recombinante, agoniste GnRH — déclenchement endogène de LH, double trigger), **Autres** (citrate de clomifène, létrozole — off-label, kisspeptine — en recherche) |
| **M13** | Protocoles de stimulation : du standard au personnalisé | 4h | **Protocole long agoniste** (désensibilisation J21 ou J1, stimulation après 14 jours — historiquement le gold standard, profil de la réponse homogène, inconvénient : SHO, durée), **Protocole court agoniste** (effet flare-up — abandonné dans beaucoup de centres), **Protocole antagoniste flexible** (stimulation J2 → antagoniste quand follicule ≥14 mm — standard actuel ESHRE 2019), **Protocole antagoniste fixe** (antagoniste J5 ou J6), **Mild stimulation** (faible dose FSH 100-150 UI ± clomifène/létrozole — philosophie Nargund, moins d'ovocytes mais meilleure qualité ?), **Natural cycle IVF** (pas de stimulation, 1 ovocyte — Pelinck et al.), **DuoStim** (double stimulation phase folliculaire + lutéale — pour faibles répondeuses), **Random start** (urgence oncofertilité — Cakmak et al., *Fertil Steril*, 2013), **Progestin-primed ovarian stimulation (PPOS)** (MPA + gonadotrophines — Kuang et al., protocole Shanghai), **Individualisation** : algorithme POSEIDON (stratification des patientes en 4 groupes), nomogrammes de dose (La Marca, Arce), choix du protocole selon AMH/CFA/âge/IMC |
| **M14** | Monitorage échographique et biologique | 4h | Objectifs du monitorage (sécurité — prévention SHO, efficacité — timing du déclenchement), **échographie de monitorage** (technique transvaginale, mesure folliculaire — 2 diamètres perpendiculaires, suivi de la cohorte folliculaire, classification par taille, corrélation taille/maturité ovocytaire — follicule ≥17-18 mm = ovocyte mature, épaisseur et aspect endométrial — triple ligne, seuil ≥7 mm), **dosages biologiques** (E2 — corrélation ~200-300 pg/mL par follicule ≥14 mm, LH — détection pic prématuré, progestérone — seuil d'élévation prématurée >1,5 ng/mL — impact sur réceptivité — Bosch et al., *Fertil Steril*, 2010), fréquence du monitorage (J5-J6, puis tous les 2 jours, puis quotidien en fin de stimulation), critères de déclenchement (≥3 follicules ≥17 mm, E2 corrélé, pas de risque SHO), ajustement des doses (augmentation/diminution FSH, coasting — abandonné, freeze-all si risque) |
| **M15** | Déclenchement de l'ovulation et prévention du SHO | 4h | **Déclenchement par hCG** (Ovitrelle 250 µg SC — mimétique du pic de LH, demi-vie longue — risque SHO, ovulation ~36h post-injection), **déclenchement par agoniste GnRH** (bolus de triptoréline 0,2 mg — pic endogène de LH + FSH, demi-vie courte — prévention SHO +++, inconvénient : insuffisance lutéale — nécessité de supplémentation renforcée ou freeze-all), **double trigger** (agoniste + faible dose hCG 1000-1500 UI — compromis), **SHO** : physiopathologie (VEGF, perméabilité capillaire, 3e secteur, hémoconcentration, risque thromboembolique), classification (Golan — léger/modéré/sévère/critique), facteurs de risque (jeune âge, SOPK, AMH >5, CFA >20, E2 >3000-4000 pg/mL, nombre d'ovocytes >15-20), **prévention** (protocole antagoniste, déclenchement agoniste, freeze-all, cabergoline 0,5 mg/j x 8 jours, perfusion d'albumine — controversé, coasting — abandonné), **traitement** (ambulatoire : repos, hydratation, HBPM, surveillance poids/diurèse ; hospitalier : paracentèse, correction hypovolémie, anticoagulation, réanimation si critique), pronostic (résolution en 7-10 jours si pas de grossesse, aggravation si grossesse — late-onset OHSS) |

### Partie 05 — Ponction et techniques de laboratoire (M16-M19)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M16** | Ponction ovocytaire échoguidée | 4h | 🔷🔶 Histoire (passage de la ponction cœlioscopique à l'échoguidage transvaginal — Wikland et al., 1985), **technique** pas-à-pas (préparation — antisepsie vaginale sans toxique pour ovocytes, sonde endovaginale avec guide de ponction, aiguille 17G simple ou double lumière, aspiration -120 à -150 mmHg, rinçage folliculaire — utilité controversée — Haydardedeoglu et al., 2017), **anesthésie** (sédation consciente — propofol + alfentanil/rémifentanil, anesthésie locale paracervicale — lidocaïne 1%, rachianesthésie — cas particuliers), ponction des ovaires difficiles d'accès (ovaires hauts, post-chirurgie, transabdominale), **complications** (hémorragie intrapéritonéale — 0,1-0,5%, ponction vasculaire iliaque, infection — abcès pelvien 0,01-0,5%, torsion d'annexe, perforation intestinale — exceptionnel), remise des ovocytes au laboratoire (identification, milieu tamponné HEPES, température 37°C) |
| **M17** | Recueil et préparation du sperme | 4h | 🟢🔷 Recueil par masturbation (conditions, abstinence 2-5 jours selon OMS 2021), recueil par électro-éjaculation (lésions médullaires), prélèvement chirurgical (TESE, micro-TESE — indications : azoospermie non obstructive, MESA — azoospermie obstructive), **préparation spermatique** : gradient de densité (PureSperm/ISolate — 45%/90%, centrifugation, sélection des mobiles progressifs), swim-up (migration ascendante — spermatozoïdes les plus mobiles), MACS (élimination des spermatozoïdes apoptotiques par annexine V), techniques microfluidiques (sélection sans centrifugation — Fertile Plus, ZyMōt), préparation pour FIV classique vs ICSI (concentration finale, critères de bascule FIV→ICSI), utilisation de sperme congelé (techniques de décongélation, perte de mobilité 30-50%) |
| **M18** | FIV classique et ICSI | 4h | 🟢🔷 **FIV classique** (insémination conventionnelle — 50 000-100 000 spermatozoïdes mobiles/mL par ovocyte, co-incubation 16-20h, vérification de la fécondation — 2 pronuclei à H16-18, indications : facteur tubaire, endométriose légère, infertilité inexpliquée avec spermogramme normal), **ICSI** (injection intra-cytoplasmique — Palermo et al., *Lancet*, 1992 : technique de micromanipulation — microinjecteur, pipette de maintien, pipette d'injection, immobilisation du spermatozoïde, pénétration de la zona à 3h, injection dans l'ooplasme, indications : OAT sévère, azoospermie — spermatozoïdes testiculaires, échec de fécondation FIV, FIV sur faible nombre d'ovocytes, PGT), **IMSI** (injection avec sélection morphologique à fort grossissement ×6300 — vacuoles, étude IMSI trial — Teixeira et al., pas de bénéfice en non-sélectionné), **PICSI** (sélection par liaison à l'acide hyaluronique — Worrilow et al., *Reprod BioMed Online*, 2013 — réduction fausses couches ?), taux de fécondation attendus (FIV ~65-70%, ICSI ~70-80%), échec total de fécondation (incidence, conduite à tenir — rescue ICSI tardif, AOA calcium ionophore) |
| **M19** | Culture embryonnaire et classification | 4h | 🟢 **Milieux de culture** (séquentiels — G1/G2, Vitrolife vs milieux uniques — Global, LifeGlobal — méta-analyse Sfontouris et al., 2017 : pas de différence significative), conditions de culture (37°C, 5-6% CO₂, 5% O₂ — culture à faible O₂ vs atmosphérique — Cochrane Bontekoe et al., 2012 : bénéfice de la faible O₂), incubateurs (grandes chambres — K-MINC, Thermo Fisher vs benchtop — EmbryoScope, GERI — récupération rapide du pH/T°), **classification embryonnaire** : J1 (2PN — pronuclei, corps polaires), J2 (4 cellules — régularité, fragmentation), J3 (8 cellules — compaction), J4 (morula — compaction complète), J5-J6 (**blastocyste** — classification de Gardner : expansion 1-6, ICM A-B-C, trophectoderme A-B-C — ex. « 4AA » = blastocyste expansé, ICM bien défini, trophectoderme cohésif), **time-lapse** (EmbryoScope+ — 11 plans focaux toutes les 10 min, morphocinétique — timings de division t2, t3, t5, cc2, s2, paramètres de sélection — Meseguer et al., *Hum Reprod*, 2011, KIDScore, iDAScore — algorithme IA), transfert J3 vs J5 (méta-analyse Glujovsky et al., Cochrane 2022 — taux de grossesse clinique supérieur en J5 par transfert, mais taux cumulatif comparable) |

### Partie 06 — Transfert et implantation (M20-M22)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M20** | Transfert embryonnaire | 4h | 🔷🔶 Technique (préparation — vessie semi-pleine, cathéter souple — Wallace, Frydman, Cook — choix selon anatomie cervicale, passage du col sous échoguidage transabdominal — visualisation du cathéter et du flash de dépôt, profondeur de dépôt — 1-2 cm du fond, retrait lent, vérification de l'absence de rétention embryonnaire sur cathéter), **transfert échoguidé** (supériorité démontrée — Abou-Setta et al., Cochrane 2014 : taux de grossesse clinique +40%), difficultés techniques (col sténosé — dilatation préalable, utérus rétroversé — mandrin, antéflexion marquée), **politique de transfert** : SET (*Single Embryo Transfer*) vs DET — ESHRE/ASRM : SET recommandé chez <38 ans avec blastocyste de bonne qualité, résultats cumulatifs comparables avec cryopréservation (McLernon et al., *BMJ*, 2010), prévention des grossesses multiples, transfert à J3 vs J5 (indications respectives — faible cohorte = J3, ≥4 embryons = J5), transfert de blastocyste congelé-décongelé (TEC — tendance freeze-all), repos post-transfert (aucun bénéfice démontré — Purcell et al., *Fertil Steril*, 2007) |
| **M21** | Soutien de la phase lutéale | 3h | 🔷 Physiopathologie de l'insuffisance lutéale post-stimulation (aspiration des cellules de la granulosa lors de la ponction, effet inhibiteur des analogues GnRH sur le corps jaune), **progestérone** (voie vaginale — Utrogestan 600 mg/j, Crinone 8% — gold standard, voie IM — progestérone huileuse 50-100 mg/j — USA, voie SC — progestérone sous-cutanée Prolutex 25 mg/j, voie orale — dydrogestérone 30 mg/j — étude LOTUS I & II, Tournaye et al., *NEJM*, 2017 — non-infériorité), **estradiol** (complément — valérate d'estradiol 4-6 mg/j, patch, pas de bénéfice clair — Cochrane Farquhar, 2017), **hCG faible dose** (1500 UI J+3 et J+6 — efficace mais risque SHO — abandonné en routine), durée du soutien lutéal (jusqu'à 8-12 SA — controversé, études de retrait précoce), protocole TEC (cycle substitué : E2V croissant + progestérone J14-J15, cycle naturel modifié : hCG/progestérone post-ovulation) |
| **M22** | Grossesse précoce post-FIV et suivi initial | 3h | 🔷 **βhCG** (dosage J12-J14 post-transfert J3/J5, cinétique de doublement — 48h, seuils pronostiques, βhCG >100 UI/L — bon pronostic, cinétique lente ou plateau — grossesse arrêtée ou GEU, attention : hCG exogène résiduelle si déclenchement hCG), **échographie précoce** (5 SA — sac gestationnel intrautérin, 6 SA — vésicule vitelline, 6-7 SA — embryon avec activité cardiaque, datation — LCC), grossesse gémellaire post-FIV (incidence après DET 20-25%, monozygotique après blastocyste 2-5% — risque MCBA, suivi rapproché), **grossesse extra-utérine** (incidence post-FIV 2-5%, facteurs de risque — hydrosalpinx, ATCD GEU, transfert profond, diagnostic — βhCG + écho, traitement — MTX ou chirurgie), grossesse hétérotopique (rare mais classique en AMP — 1/100 vs 1/30 000 naturel), grossesse biochimique (βhCG+ puis chute — ~30% des transferts positifs), fausse couche précoce post-FIV (incidence comparable à la conception naturelle ajustée sur l'âge), suivi obstétrical spécifique des grossesses AMP (risques : pré-éclampsie, RCIU, prématurité, placenta praevia — Hansen et al., *NEJM*, 2002 ; Pinborg, *Hum Reprod Update*, 2019) |

### Partie 07 — Cryopréservation (M23-M25)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M23** | Vitrification ovocytaire et embryonnaire | 4h | 🟢 Histoire de la cryopréservation (congélation lente — Whittingham, 1972, souris ; Trounson, 1983, humain ; limites — cristaux de glace, dommages cellulaires), **vitrification** (principe — solidification vitreuse sans cristallisation, concentrations élevées de cryoprotecteurs — DMSO + éthylène glycol, vitesse de refroidissement ultra-rapide >20 000°C/min), **technique Cryotop** (Kuwayama — outil à volume minimal, charge en 2 étapes — équilibration 8 min puis vitrification 1 min, plongeon dans N₂ liquide, stockage -196°C), vitrification ovocytaire (taux de survie >90%, résultats comparables aux ovocytes frais — Cobo et al., *Fertil Steril*, 2010 — étude randomisée), vitrification embryonnaire (J3 vs blastocyste — survie >95% au stade blastocyste, taux d'implantation comparables au frais), systèmes fermés vs ouverts (risque de contamination croisée — Cryolock, CBS, Rapid-i vs Cryotop ouvert), **dévitrification** (réchauffement rapide — bain 37°C, dilution progressive des cryoprotecteurs — saccharose, survie et reprise du développement), gestion des cuves de stockage (monitoring température, alarmes, traçabilité), aspects médico-légaux (durée de conservation, destruction, devenir en cas de séparation/décès) |
| **M24** | Transfert d'embryons congelés (TEC) | 4h | 🔷🔶 **Indications du TEC** (embryons surnuméraires, freeze-all — prévention SHO, élévation progestérone, PGT en attente, segmentation du cycle — Devroey et al., concept de « banking »), **protocole cycle naturel** (ovulation spontanée détectée par LH urinaire ou échographie + LH plasmatique, transfert LH+7 pour J5, avantage : physiologique, inconvénient : nécessite cycles réguliers, risque de lutéinisation prématurée), **protocole cycle substitué** (blocage par GnRH agoniste ou pilule + E2V croissant oral/patch/vaginal + progestérone vaginale J14-J15, transfert P+5 pour blastocyste, avantage : programmable, inconvénient : pas de corps jaune — supplémentation prolongée), **protocole cycle stimulé** (FSH faible dose + hCG — rarement utilisé), résultats (taux de grossesse TEC comparable voire supérieur au transfert frais — étude FREEZE-ALL, Chen et al., *NEJM*, 2016, étude E-Freeze, Vuong et al., *NEJM*, 2018), débat freeze-all systématique vs sélectif (risques obstétricaux du TEC en cycle substitué — pré-éclampsie, LGA — Maheshwari et al., *Hum Reprod*, 2018 ; Von Versen-Höynck et al., *Hypertension*, 2020 — absence de corps jaune et dysfonction placentaire), **réceptivité endométriale** (ERA — Endometrial Receptivity Array, Díaz-Gimeno et al., *Fertil Steril*, 2011 — fenêtre d'implantation personnalisée, pré-réceptif/réceptif/post-réceptif, ajustement du timing progestérone) |
| **M25** | Préservation de la fertilité | 4h | 🔷🟢🟣 **Oncofertilité** (concept — Woodruff, 2007, prise en charge urgente avant traitement gonadotoxique), indications oncologiques (chimiothérapie alkylante — cyclophosphamide, radiothérapie pelvienne, chirurgie ovarienne/testiculaire), **techniques féminines** : vitrification ovocytaire (stimulation en urgence — random start, protocole antagoniste court 10-14 jours, taux de survie >90%), vitrification embryonnaire (si partenaire), cryopréservation de cortex ovarien (seule option prépubertaire, lamelles de cortex, greffe orthotopique — Donnez et al., *Lancet*, 2004 — premières naissances, >200 naissances mondiales en 2026), transposition ovarienne (avant radiothérapie pelvienne), analogues GnRH (protection ovarienne pendant chimio — controversé, Del Mastro et al., *JAMA*, 2011), **techniques masculines** : cryopréservation de sperme (CECOS, recueil avant traitement, adolescent), cryopréservation de tissu testiculaire (prépubère — recherche), **préservation sociétale** (social freezing — autoconservation ovocytaire sans indication médicale, légale en France depuis 2021 — loi bioéthique, âge optimal <35 ans, résultats selon âge — Doyle et al., *Fertil Steril*, 2016 : taux cumulatif de naissance vivante ~70% si ≥15 ovocytes vitrifiés avant 35 ans, counseling, enjeux sociétaux et éthiques) |

### Partie 08 — Techniques avancées (M26-M29)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M26** | Diagnostic préimplantatoire (PGT) | 4h | 🟢🔷 Histoire (Handyside et al., *Nature*, 1990 — premier DPI pour mucoviscidose et maladies liées à l'X), **PGT-M** (maladies monogéniques — mucoviscidose, drépanocytose, myotonie de Steinert, Huntington, BRCA1/2, technique — PCR + haplotypage STR, NGS ciblé, biopsie J3 1-2 blastomères — historique vs biopsie trophectoderme J5 5-10 cellules — standard actuel, délai de résultat, enjeux éthiques — sélection, bébé médicament — HLA typing), **PGT-A** (aneuploïdies — screening chromosomique complet, technique — biopsie trophectoderme J5 + NGS/array CGH, indications : âge maternel avancé, fausses couches à répétition, échecs d'implantation, facteur masculin sévère, résultats — débat STAR trial, Munné et al., *Fertil Steril*, 2019 — pas de bénéfice en taux de naissance cumulatif chez <38 ans, ESHRE position paper 2020 — PGT-A non recommandé en routine), **PGT-SR** (remaniements chromosomiques structuraux — translocations réciproques et robertsoniennes, inversions), **mosaïcisme** (biopsie de trophectoderme ≠ ICM, mosaïcisme confiné au placenta, transfert d'embryons mosaïques — PGDIS guidelines 2019, classification low-level/high-level, counseling), **tests non-invasifs** (niPGT — ADN dans le milieu de culture — Xu et al., *PNAS*, 2016, validation en cours, limites — contamination maternelle) |
| **M27** | Don de gamètes et accueil d'embryons | 3h | 🔷🟣 **Don d'ovocytes** (indications : IOP, syndrome de Turner, dysgénésie gonadique, échecs FIV répétés avec propres ovocytes, risque génétique maternel ; donneuse : 18-37 ans, bilan complet — caryotype, sérologies, ATCD, stimulation-ponction, résultats : taux de grossesse 50-60%/transfert — Sauer et al., principaux centres — Espagne, République tchèque, Grèce), **don de sperme** (indications : azoospermie non obstructive sans TESE possible, risque génétique paternel, femmes seules, couples de femmes — AMP pour toutes loi 2021 ; CECOS — banques de sperme françaises, critères donneurs, appariement phénotypique, sérologies, caryotype, AMP-vigilance, résultats IIU-D vs FIV-D), **accueil d'embryons** (don d'embryons — couples ayant des embryons surnuméraires, anonymat, procédure judiciaire en France — TGI, résultats), **cadre légal français** (gratuité, anonymat — levée partielle depuis loi 2021 — accès aux origines pour les personnes nées de don à leur majorité via CAPADD, CECOS et Agence de la biomédecine), comparaison internationale (Espagne — don anonyme rémunéré, USA — libre marché, UK — identifiable donor depuis 2005, Belgique — double guichet) |
| **M28** | Gestation pour autrui et aspects internationaux | 3h | 🟣 **GPA** (gestation pour autrui — *surrogacy*), GPA gestationnelle (embryon du couple commanditaire, pas de lien génétique avec la gestatrice) vs GPA traditionnelle (ovocyte de la gestatrice — quasi abandonnée), **cadre légal** : France — interdite (article 16-7 du Code civil), pénalement réprimée (provocation à l'abandon, supposition d'enfant), transcription des actes de naissance étrangers — évolution jurisprudentielle (arrêts Mennesson et Labassée, CEDH 2014, Cass. 2019, 2020), **pays autorisant** : USA (Californie, Nevada, Connecticut — GPA commerciale, agences, contrats, 80 000-150 000 $), Canada (GPA altruiste uniquement), UK (GPA altruiste, parental order), Ukraine (GPA commerciale, accessible aux couples hétérosexuels mariés), Inde (GPA commerciale interdite depuis 2021 — Surrogacy Regulation Act), Israël (GPA encadrée), Grèce (GPA altruiste), **enjeux éthiques** (marchandisation du corps, exploitation des femmes, tourisme procréatif, intérêt de l'enfant, filiation), **enjeux médicaux** (sélection et suivi de la gestatrice, risques obstétricaux, lien d'attachement, suivi psychologique) |
| **M29** | Maturation in vitro et techniques émergentes | 4h | 🟢🔷 **MIV** (Maturation In Vitro — *In Vitro Maturation*), principe (ponction de follicules immatures 6-12 mm sans ou avec stimulation minimale, maturation ovocytaire in vitro 24-48h en milieu enrichi — FSH, LH, EGF, amphiréguline), indications (SOPK — risque SHO +++, oncofertilité urgente, stimulation impossible), résultats historiques (taux de grossesse inférieurs à la FIV conventionnelle — 25-35% vs 40-50%), **IVM capacitation** (système CAPA-IVM — Vuong et al., université de Vrije Brussel, *NEJM*, 2021 — maturation en 2 étapes : pré-maturation avec C-type natriuretic peptide + maturation, résultats améliorés), **activation ovocytaire artificielle (AOA)** (calcium ionophore A23187 ou ionomycine, indication : échec total de fécondation après ICSI, globozoospermie, résultats — Vanden Meerschaut et al., *Hum Reprod*, 2014), **injection de spermatides rondes (ROSI)** (Tanaka et al., Japon — pour azoospermie non obstructive sans spermatozoïdes à la micro-TESE, résultats très faibles — <5% grossesse/cycle), **transfert mitochondrial** (technique du spindle transfer — MRT, « 3 parents IVF », autorisé au UK depuis 2015 — HFEA, prévention des maladies mitochondriales, premier enfant — Zhang et al., 2016, enjeux éthiques), **ovogenèse in vitro** (culture de follicules primordiaux jusqu'à l'ovocyte mature — souris Morohaku et al., *PNAS*, 2016, humain — en recherche, étape de la science-fiction à la réalité) |

### Partie 09 — Échographie en AMP (M30-M32)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M30** | Échographie pelvienne diagnostique en infertilité | 4h | 🔶🔷 **Échographie transvaginale systématique** (sonde haute fréquence 5-9 MHz, exploration bilatérale des ovaires — position, taille, morphologie, CFA), **compte des follicules antraux (CFA)** (technique standardisée — follicules 2-9 mm, les 2 ovaires, corrélation AMH — r=0,7-0,8, seuils : <5 = diminished ovarian reserve, 5-15 = normal, >20 = SOPK suspect — critères de Rotterdam), **ovaires** (endométriome — ground glass, tératome, cystadenome, ovaire inaccessible — post-chirurgie, adhérences), **utérus** (mesure — longueur, épaisseur, largeur, fibromes — classification FIGO 2011, impact sur FIV selon localisation — sous-muqueux type 0-2 = impact ++, intramural >4 cm = discuté, sous-séreux = pas d'impact, polype endométrial — diagnostic écho + SonoHSG, adénomyose — signes écho : asymétrie myométriale, kystes myométriaux, stries linéaires, zone jonctionnelle >12 mm, impact sur FIV — Vercellini et al., *Hum Reprod Update*, 2014), **malformations utérines** (écho 3D ++ — utérus cloisonné, bicorne, unicorne, didelphe — classification ESHRE/ESGE 2013, impact sur FIV et pronostic obstétrical), **SonoHSG** (HyCoSy — mousse Gynesonics/ExEm, HyFoSy — mousse aérée, évaluation de la perméabilité tubaire, remplacement progressif de l'HSG — Dreyer et al., *NEJM*, 2017 — TFO-test, pas de différence en taux de grossesse HSG vs SonoHSG), **écho-Doppler** (artères utérines — index de pulsatilité PI, résistance RI, notch protodiastolique, vascularisation sous-endométriale — corrélation réceptivité ?, artères ovariennes — PSV) |
| **M31** | Échographie de monitorage folliculaire | 4h | 🔶🔷 Objectifs (suivi de la réponse ovarienne, sécurité — prévention SHO, timing du déclenchement), **technique de mesure folliculaire** (2 diamètres perpendiculaires — moyenne, follicules ≥10 mm mesurés individuellement, <10 mm comptés, convention : plus grand follicule = follicule directeur en cycle naturel vs cohorte en stimulation), **cinétique de croissance** (cycle naturel : 1-2 mm/jour, stimulation : 1-3 mm/jour, corrélation taille-maturité ovocytaire — 17-18 mm = métaphase II en protocole antagoniste, 18-20 mm en protocole agoniste — Abbara et al., *Front Endocrinol*, 2018), **endomètre** (épaisseur — coupe sagittale médiane, mesure maximale, seuils : <7 mm = implantation compromise, >7-8 mm = favorable, >14 mm = pas de bénéfice supplémentaire, aspect : triple ligne = oestrogénisé pré-ovulatoire = optimal, hyperéchogène = progestatif — transformation sécrétoire prématurée ?), **corrélation écho-biologique** (E2 ~200-300 pg/mL par follicule mature, discordance écho-bio — quand s'inquiéter), **critères de déclenchement** (≥3 follicules ≥17 mm — protocole standard, ≥2 follicules ≥18 mm — mild/natural, E2 corrélé et <5000 pg/mL — sécurité SHO), **monitorage de l'ovulation en cycle naturel/TEC** (follicule dominant, pic LH — corrélation écho, rupture folliculaire, corps jaune — diagnostic écho), échographie 3D et automatisée (SonoAVC — Automated Volume Calculation, comptage folliculaire automatique, reproductibilité — Deb et al., *Ultrasound Obstet Gynecol*, 2009) |
| **M32** | Échographie interventionnelle en AMP | 4h | 🔶🔷 **Ponction ovocytaire échoguidée** (cf. M16 — rappel technique, focus radiologique : réglages échographiques optimaux — fréquence, gain, focus, guide de ponction — angle, calibration, distance, sécurité — repérage vasculaire iliaque pré-ponction en Doppler, vessie vide, trajectoire de ponction — paroi vaginale → ovaire, distance minimale, ponction des ovaires difficiles d'accès — ovaire haut latéral : trajet transabdominal écho-guidé, ovaire post-cœlioscopie : adhérences, ovaire unique), **ponction d'hydrosalpinx** ou de kyste endométriosique (avant FIV — aspiration-sclérose écho-guidée, alcoolisation — controversé), **transfert embryonnaire échoguidé** (technique d'échoguidage transabdominal — sonde convexe 3,5-5 MHz, vessie semi-pleine, visualisation du cathéter hyperéchogène, flash de dépôt à 1-2 cm du fond, mesures de qualité), **autres gestes échoguidés** (réduction embryonnaire échoguidée — KCl intracardique, amniocentèse précoce post-FIV, cerclage échoguidé), **sécurité et complications** (protocole de check-list pré-ponction, identito-vigilance — vérification identité patiente-ovocytes, gestion de l'urgence hémorragique) |

### Partie 10 — Biologie de la reproduction (M33-M35)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M33** | Le laboratoire de FIV : organisation et qualité | 4h | 🟢 **Architecture du laboratoire** (salle blanche — norme ISO 5-7, pression positive, filtration HEPA/CODA, absence de COV — composés organiques volatils, matériaux biocompatibles, plan — zone de recueil, zone de tri ovocytaire, zone ICSI, zone culture, zone cryo, zone PGT — séparée), **équipement** (PSM — poste de sécurité microbiologique classe II, microscope inversé avec Hoffman/DIC, micromanipulateur — Narishige/Eppendorf, platine chauffante, incubateurs tri-gas, time-lapse — EmbryoScope+, GERI, système de vitrification, cuve de stockage N₂ liquide — monitoring 24h/24), **contrôle qualité** (KPI — key performance indicators : taux de fécondation — seuil >65% FIV, >70% ICSI, taux de clivage >95%, taux de blastulation >40-50%, taux de survie vitrification-dévitrification >90%, taux de grossesse clinique >30% <38 ans — ESHRE benchmarks, Vienna consensus, audit annuel), **accréditation** (COFRAC — ISO 15189 en France, ESHRE certification, Agence de la biomédecine — agrément des centres AMP, rapport annuel d'activité), **AMP-vigilance** (déclaration des événements indésirables — erreurs d'identification, contamination, perte de gamètes/embryons, incidents matériel, système qualité et gestion des risques), **traçabilité** (système de suivi — étiquetage code-barres/RFID, double identification — RI Witness, Gidget, Matcher, témoin électronique — prévention erreurs de gamètes) |
| **M34** | Andrologie biologique et techniques de sélection spermatique | 4h | 🟢 **Analyse spermatique approfondie** (au-delà du spermogramme standard — OMS 2021, 6e édition, analyse cinétique CASA — Computer Assisted Sperm Analysis, morphologie assistée — IVOS II, SCA), **fragmentation de l'ADN spermatique** (mécanismes — stress oxydatif, apoptose défectueuse, compaction déficiente, tests — SCSA flow cytometry DFI, TUNEL, SCD halo, comet assay, seuils — DFI >30% = impact négatif, corrélation avec échecs FIV/ICSI et fausses couches — Zini et al., *Hum Reprod*, 2008 ; Simon et al., *Fertil Steril*, 2017 — méta-analyse, stratégies — antioxydants, sélection spermatique, TESE si DFI testiculaire < éjaculé), **techniques avancées de sélection** (MACS — Magnetic Activated Cell Sorting — élimination des apoptotiques par annexine V magnétique, microfluidique — ZyMōt, Fertile Plus — sélection sans centrifugation, tri par charge de surface — Zeta potential, PICSI — sélection par liaison acide hyaluronique, IMSI — sélection morphologique ×6300), **spermatozoïdes testiculaires** (traitement des biopsies TESE/micro-TESE — dissection mécanique, dissection enzymatique — collagénase, identification — microscope inversé, motilité vs non-mobile viable — test hypo-osmotique, pentoxifylline, laser, cryopréservation des spermatozoïdes testiculaires — technique en paillettes), **auto-anticorps anti-spermatozoïdes** (MAR test, IBT — impact controversé) |
| **M35** | Évaluation embryonnaire : de la morphologie à l'intelligence artificielle | 4h | 🟢 **Évaluation morphologique classique** (J1 — zygote : 2PN centraux symétriques, corps polaires, halos pronucléaires — score Z-score Alpha/ESHRE, J2-J3 — embryon clivé : nombre de cellules, régularité de taille, fragmentation — grade I <10%, II 10-25%, III >25%, multinucléation, compaction prématurée, J5-J6 — blastocyste : classification de Gardner — degré d'expansion 1-6, ICM A/B/C, TE A/B/C, corrélation morphologie-euploïdie — Capalbo et al., *Hum Reprod*, 2014), **morphocinétique et time-lapse** (paramètres clés — t2, t3, t5, tSB, tB, cc2=t3-t2, s2=t4-t3, algorithmes — KIDScore D5, iDAScore, ERICA, avantages — culture ininterrompue, documentation complète, sélection objectivée, limites — coût, courbe d'apprentissage, pas de bénéfice démontré en RCT sur taux de naissance vivante — Armstrong et al., Cochrane 2019), **intelligence artificielle** (deep learning sur images time-lapse — Life Whisperer, Fairtility CHLOE, Vitrolife iDAScore, AIVF EMA — prédiction de l'euploïdie, du potentiel d'implantation, sélection embryonnaire assistée par IA, validation clinique — Chavez-Badiola et al., *Hum Reprod*, 2020, enjeux — biais de dataset, explicabilité, réglementation CE/FDA), **tests métabolomiques** (consommation d'oxygène, profil métabolique du milieu de culture — métabolomique, protéomique, sécrétome embryonnaire — en recherche), **niPGT** (non-invasive PGT — analyse de l'ADN cellulaire libre dans le milieu de culture — cf. M26, validation en cours, Rubio et al., *Fertil Steril*, 2020) |

### Partie 11 — Complications et situations particulières (M36-M39)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M36** | Syndrome d'hyperstimulation ovarienne | 4h | 🔷🟣 cf. M15 pour prévention, ici focus prise en charge, **physiopathologie détaillée** (VEGF — facteur clé, récepteur VEGFR-2, perméabilité capillaire généralisée, fuite plasmatique vers le 3e secteur — ascite, épanchement pleural, œdème, hémoconcentration — Ht >45%, hypovolémie efficace → insuffisance rénale fonctionnelle, risque thromboembolique — thrombophilie acquise, thrombose veineuse profonde, embolie pulmonaire, thrombose artérielle), **classification de Golan révisée** (léger : distension abdominale, nausées, ovaires 5-12 cm ; modéré : ascite écho, douleurs, ovaires >12 cm ; sévère : ascite clinique, oligurie <500 mL/24h, Ht >45%, créat >1,2 mg/dL, dyspnée ; critique : IRA, SDRA, thrombose, HELLP-like), **prise en charge ambulatoire** (critères : SHO léger-modéré, pas de vomissements, diurèse conservée — surveillance quotidienne poids/périmètre abdominal/diurèse, hydratation orale 2-3 L/j, protéines, HBPM prophylactique si facteurs de risque, antalgiques — paracétamol, éviter AINS), **prise en charge hospitalière** (critères d'hospitalisation : SHO sévère, vomissements, oligurie, épanchement pleural, suspicion thrombose — perfusion NaCl 0,9% + HEA/albumine 20-25% si hypoprotéinémie, correction des désordres électrolytiques, HBPM curative si thrombose, paracentèse échoguidée si ascite tendue — transvaginale ou transabdominale, thoracocentèse si épanchement compressif, réanimation si critique), **SHO tardif** (lié à la grossesse — hCG endogène, aggravation ou apparition secondaire, pronostic plus long), **prévention récapitulative** (protocole antagoniste, trigger agoniste, freeze-all, cabergoline, coasting historique — abandonné) |
| **M37** | Grossesses multiples : prévention et prise en charge | 3h | 🔷🟣 **Épidémiologie** (grossesse gémellaire post-FIV : 20-25% après DET, 2-3% après SET — la plupart monozygotes, grossesse triple+ : quasi éliminée par SET, taux de grossesse multiple marqueur de qualité d'un centre AMP — objectif <10%), **risques des grossesses multiples** (maternels : pré-éclampsie x3, diabète gestationnel x2, hémorragie du post-partum, césarienne >70% pour jumeaux ; fœtaux : prématurité — 50% <37 SA pour jumeaux, RCIU, mortalité périnatale x5 pour jumeaux vs singleton, handicap — paralysie cérébrale x4), **grossesse gémellaire monozygote post-FIV** (incidence augmentée après blastocyste et hatching assisté — 2-5% vs 0,4% spontané, mécanisme — herniation du blastocyste, types — MCBA le plus fréquent = risque STT, TAPS, séquence anémie-polycythémie), **prévention** (politique de SET — *Single Embryo Transfer*, recommandations ESHRE/ASRM, critères de sélection pour SET : <38 ans, 1er ou 2e cycle, embryon de bonne qualité, résultats cumulatifs comparables avec TEC — Pandian et al., Cochrane 2013, législation — Belgique, Suède : SET obligatoire <36 ans), **réduction embryonnaire** (indication : grossesse triple+, technique — KCl intracardique échoguidé 11-13 SA, réduction de triplet à jumeaux — perte fœtale 5-7% vs 30% risque de grande prématurité sans réduction, réduction de jumeaux à singleton — débat éthique, counseling, aspects psychologiques — Evans & Britt, *Semin Perinatol*, 2005) |
| **M38** | Échecs répétés d'implantation et fausses couches à répétition | 4h | 🔷🟢 **Échec répété d'implantation (RIF)** (définition : absence de grossesse clinique après transfert de ≥3 embryons de bonne qualité ou ≥2 blastocystes — Coughlan et al., *J Obstet Gynaecol*, 2014), **bilan de RIF** : facteur embryonnaire (PGT-A pour exclure aneuploïdies, time-lapse pour morphocinétique optimale), facteur endométrial (hystéroscopie — polype, synéchies, endométrite chronique — CD138, antibiothérapie doxycycline, ERA — fenêtre d'implantation déplacée chez 25% des RIF — Ruiz-Alonso et al., *Fertil Steril*, 2013, EMMA/ALICE — microbiome endométrial, Doppler utérin — perfusion sous-endométriale), facteur immunologique (NK utérins — biopsie endométriale CD56+/CD16-, ratio NK cytotoxiques, traitement — intralipides, corticoïdes, IGIV — preuves faibles, HLA parental — controversé), facteur thrombophilique (SAPL — anticoagulant lupique, anti-cardiolipine, anti-β2GP1 — traitement aspirine + HBPM si positif, thrombophilies héréditaires — FV Leiden, mutation prothrombine — rôle discuté en RIF), **traitements adjuvants** (scratching endométrial — Nastri et al., Cochrane 2015 — bénéfice initial non confirmé par Lensen et al., *NEJM*, 2019, PRP intrautérin — en recherche, G-CSF — en recherche, culture endométriale autologue), **fausses couches à répétition (RPL)** (définition : ≥3 FC consécutives <14 SA ou ≥2 FC — ESHRE 2017, bilan — caryotype couple, utérus — hystéroscopie/écho 3D, SAPL, TSH, glycémie, thrombophilies héréditaires — discuté, traitements — aspirine + HBPM si SAPL, progestérone — étude PROMISE Coomarasamy et al., *NEJM*, 2015 puis PRISM Coomarasamy et al., *NEJM*, 2019 — bénéfice de la progestérone chez les femmes avec saignement précoce et ATCD FC, soutien psychologique — TLC tender loving care) |
| **M39** | Pathologies associées : SOPK, endométriose, IOP, âge maternel | 4h | 🔷 **SOPK et FIV** (risque SHO +++ — protocole antagoniste obligatoire, trigger agoniste, mild stimulation ou IVM, metformine en co-traitement — réduit SHO — Tang et al., Cochrane 2012, drilling ovarien — avant IIU/FIV si résistance au CC, résultats FIV dans le SOPK — taux d'ovocytes élevé mais qualité discutée, taux de naissance vivante comparable), **endométriose et FIV** (impact sur réserve ovarienne — endométriome et chirurgie ovarienne, impact sur qualité ovocytaire et implantation — IL-6, TNF-α, stress oxydatif dans liquide péritonéal, chirurgie avant FIV — Cochrane Benschop et al., 2010 : pas de bénéfice de la kystectomie avant FIV pour endométriome récidivant, sclérose échoguidée — alternative, traitement prolongé par agoniste GnRH 3 mois avant FIV — bénéfice modéré, endométriose stade III-IV — résultats FIV inférieurs, protocoles adaptés), **insuffisance ovarienne prématurée (IOP)** (diagnostic : <40 ans, FSH >25 UI/L x2, aménorrhée, causes — auto-immune, génétique Turner/FMR1, iatrogène, idiopathique, FIV dans l'IOP — très faibles taux, accumulation d'embryons, don d'ovocytes — solution principale, PRP ovarien — en recherche, OFFA — en recherche), **âge maternel avancé (>38-40 ans)** (déclin exponentiel de la réserve ovarienne et augmentation des aneuploïdies — >50% après 40 ans, taux de naissance/cycle FIV : 30% à 35 ans, 15% à 40 ans, <5% à 43 ans — registres ABM, stratégies — stimulation agressive, DuoStim, accumulation d'ovocytes/embryons, PGT-A — discuté, don d'ovocytes si échecs, counseling — réalisme des chances, accompagnement) |

### Partie 12 — Éthique, législation, psychologie (M40-M42)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M40** | Cadre légal de l'AMP en France et dans le monde | 4h | 🟣 **Loi de bioéthique française** (chronologie : loi 1994 — première loi, 2004 — révision, 2011 — révision, **2021** — loi n°2021-1017 : AMP pour les couples de femmes et les femmes non mariées, autoconservation ovocytaire sans indication médicale, levée partielle de l'anonymat du don — CAPADD, 2024 — ajustements), **cadre réglementaire** (agrément des centres AMP — Agence de la biomédecine, conditions d'exercice, rapport annuel d'activité obligatoire, registres nationaux, remboursement — 4 tentatives FIV, 6 IIU, jusqu'à 43 ans, conditions : <43 ans femme, pas de limite homme), **AMP pour toutes** (parcours spécifique : couples de femmes — ROPA autorisée ?, femmes seules, accès au don de sperme, prise en charge financière — 100% SS), **accès aux origines** (CAPADD — Commission d'accès des personnes nées d'une AMP aux données des tiers donneurs, donneurs anciens — consentement rétroactif, nouveaux donneurs — consentement obligatoire à la levée de l'anonymat, impact sur le recrutement des donneurs), **comparaison internationale** (Espagne : pas de limite d'âge légale, don anonyme rémunéré, GPA interdite ; Belgique : loi 2007 souple, DPI élargi, double guichet anonyme/identifié ; USA : pas de loi fédérale, libre marché, GPA commerciale, PGT-sexe autorisé, sélection de donneurs ; Israël : pro-nataliste, remboursement illimité, GPA encadrée ; Japon : restrictif, pas de don d'ovocytes légal), **AMP post-mortem** (interdite en France, autorisée en Espagne, Belgique, UK — avec consentement écrit préalable) |
| **M41** | Bioéthique en assistance médicale à la procréation | 3h | 🟣 **Principes fondamentaux** (autonomie, bienfaisance, non-malfaisance, justice — Beauchamp & Childress), **statut de l'embryon** (débat philosophique et juridique — personne potentielle, bien meuble, sujet de droit ? — position française : « respect dû à l'être humain dès le commencement de sa vie » — Comité consultatif national d'éthique, CCNE), **consentement éclairé** (information complète — taux de succès par âge, risques, alternatives, temps de réflexion — 1 mois, droit de retrait à tout moment, consentement au devenir des embryons surnuméraires — projet parental, don, recherche, destruction), **sélection embryonnaire** (PGT-M — indications médicales strictes en France, HLA typing — bébé médicament, PGT-A — screening, débat : eugénisme ou médecine préventive ?, PGT pour prédispositions — BRCA, débat international), **modification du génome embryonnaire** (CRISPR-Cas9 — He Jiankui, bébés génétiquement modifiés 2018, moratoire international — Baltimore et al., *Nature*, 2015, position ISSCR 2021 — interdit en clinique), **âge maternel et limites** (droit à la reproduction vs intérêt de l'enfant, limites d'âge — différences internationales, grossesse à 60+ ans post-don — enjeux), **marchandisation de la reproduction** (tourisme procréatif, commerce de gamètes, GPA commerciale — exploitation vs autonomie, inégalités d'accès socio-économiques), **recherche sur l'embryon** (autorisée en France depuis 2013 — protocoles encadrés — ABM, règle des 14 jours — ISSCR 2021 : assouplissement proposé, organoïdes et modèles embryonnaires — blastoïdes) |
| **M42** | Accompagnement psychologique du couple en AMP | 3h | 🟣🔷 **Impact psychologique de l'infertilité** (deuil de la fertilité naturelle, atteinte de l'identité — masculinité/féminité, impact conjugal — 50% des couples rapportent des tensions, isolement social, prévalence anxiété 30-40%, dépression 15-25% — Verhaak et al., *Hum Reprod*, 2007), **stress du parcours AMP** (médicalisation du corps et de la sexualité, injections quotidiennes, monitorage répétitif, attente des résultats — « two-week wait », annonce des échecs — deuil répété, impact professionnel — absentéisme, discrimination), **entretien psychologique** (obligatoire en France avant AMP avec don ou autoconservation — décret 2021, recommandé avant toute AMP — évaluation de la stabilité du couple, des motivations, des ressources psychiques, du réseau de soutien), **techniques d'accompagnement** (TCC — gestion du stress et de l'anxiété, mindfulness — MBSR adapté infertilité — Domar et al., *Fertil Steril*, 2011 : réduction stress et amélioration taux de grossesse ?, acupuncture — Manheimer et al., Cochrane 2013 — résultats non concluants, groupes de soutien — Réseau FIV France, associations BAMP, Maia), **décision d'arrêt** (quand s'arrêter ? — absence de consensus, deuil de l'enfant biologique, alternatives — don, adoption, vie sans enfant — « childfree after infertility », accompagnement de la transition), **impact sur la parentalité** (parentalité après AMP — études rassurantes, développement des enfants nés par FIV — Golombok et al., *J Child Psychol*, 2009 : pas de différence, annonce du mode de conception à l'enfant — recommandé, accompagnement spécifique — don, GPA) |

### Partie 13 — Innovations et avenir (M43-M45)

| Module | Titre | Durée | Contenu clé |
|--------|-------|-------|-------------|
| **M43** | Intelligence artificielle en médecine reproductive | 4h | 🟢🟣 **IA et sélection embryonnaire** (deep learning sur images time-lapse — réseaux convolutionnels CNN, algorithmes commerciaux : iDAScore Vitrolife — score 1-9,9, Life Whisperer — prédiction d'implantation, CHLOE Fairtility — euploïdie prédite, AIVF EMA — automated morphological assessment, performance — AUC 0,7-0,8, supériorité vs embryologistes juniors, comparable aux seniors — Tran et al., *Hum Reprod*, 2019), **IA et prédiction de réponse ovarienne** (modèles prédictifs — âge + AMH + CFA + IMC → dose optimale de FSH, Oviprep — algorithme de Nyboe Andersen, PIVET — modèle australien, réduction du SHO et des annulations), **IA et qualité spermatique** (CASA amélioré par IA, détection automatique des spermatozoïdes — SpermSearch, prédiction de fragmentation ADN), **IA et réceptivité endométriale** (analyse échographique de l'endomètre par IA — texture, vascularisation, prédiction de réceptivité, complément ou remplacement de l'ERA ?), **IA et pronostic** (prédiction des chances de grossesse — IVFpredict, SART patient predictor, modèles de machine learning — random forest, XGBoost, réseaux de neurones, variables — âge, AMH, BMI, étiologie, rang de tentative, type d'embryon), **limites et enjeux** (biais de dataset — centres occidentaux, populations caucasiennes, explicabilité — black box, réglementation CE-IVDR/FDA — dispositifs médicaux IA, responsabilité médicale, acceptabilité par les patients et les praticiens) |
| **M44** | Gamètes artificiels, utérus artificiel et thérapie génique | 3h | 🟢🟣 **Gamétogenèse in vitro (IVG)** (concept — production de gamètes fonctionnels à partir de cellules somatiques, via cellules iPS — induced pluripotent stem cells, Hayashi et al., *Science*, 2012 — souris : cellules de peau → iPS → cellules germinales primordiales → ovocytes → souriceaux viables, Ishikura et al., *Science*, 2016 — spermatogenèse in vitro souris, humain — en recherche, obstacles majeurs : reprogrammation épigénétique complète, méiose fidèle, qualité des gamètes, applications potentielles — IOP, azoospermie totale, couples de même sexe, âge avancé, enjeux éthiques vertigineux — sélection, design, reproduction sans limites d'âge), **ectogenèse et utérus artificiel** (concept — gestation extra-corporelle, Partridge et al., *Nature Communications*, 2017 — BioBag — agneau prématuré maintenu 4 semaines en milieu extra-utérin, applications : grande prématurité — sauvetage des 22-24 SA, ectogenèse totale — science-fiction encore ?, enjeux éthiques — statut du fœtus, lien maternel, maternité sans grossesse), **édition génomique CRISPR en reproduction** (potentiel — correction de mutations avant implantation, He Jiankui — modification CCR5 2018 — condamnation mondiale, risques — effets off-target, mosaïcisme, modifications héréditaires — lignée germinale, moratoire international — OMS 2019, ISSCR 2021, applications légitimes — recherche fondamentale sur l'embryon, modèles de maladies, thérapie somatique post-natale ≠ germinale), **transfert mitochondrial** (spindle transfer, pronuclear transfer — prévention des maladies mitochondriales, autorisé au UK — HFEA 2015, Newcastle — premier enfant né, « bébé à 3 parents » — DNA mitochondrial de donneuse) |
| **M45** | Médecine reproductive de précision et avenir | 3h | 🟣🔷🟢🔶 **Pharmacogénomique de la stimulation** (polymorphismes FSHR — Asn680Ser — réponse à la FSH, polymorphismes LHR, FSHB, ESR1, ESR2, adaptation des doses selon le génotype — Alviggi et al., *Hum Reprod Update*, 2018, Rekovelle — follitropine delta — première gonadotrophine à posologie individualisée AMH/poids), **biomarqueurs de réceptivité endométriale** (ERA transcriptomique — 238 gènes, fenêtre d'implantation personnalisée, EMMA/ALICE — microbiome endométrial — Lactobacillus dominant = favorable, Moreno et al., *Am J Obstet Gynecol*, 2016, E-INTEGRA — profil multiomique endométrial), **omiques en reproduction** (génomique — GWAS infertilité, transcriptomique — profil folliculaire, protéomique — liquide folliculaire et milieu de culture, métabolomique — prédiction qualité embryonnaire, lipidomique — membrane ovocytaire), **rajeunissement ovarien** (PRP intra-ovarien — Platelet Rich Plasma, Sfakianoudis et al., — résultats préliminaires controversés, OFFA — Ovarian Fragmentation for Follicular Activation — Kawamura et al., *PNAS*, 2013, perfusion autologue de cellules souches — en recherche), **transplantation utérine** (Brännström et al., Suède — premier enfant né après transplantation utérine de donneuse vivante, *Lancet*, 2015, >100 transplantations mondiales en 2026, donneuses vivantes vs décédées, enjeux — chirurgie lourde, immunosuppression, temporaire — explantation après grossesse), **reproduction et espace** (cryopréservation en conditions spatiales, fécondation en microgravité — Wakayama et al., souris ISS, enjeux de la reproduction humaine hors Terre), **vision 2030-2050** (convergence IA + génomique + cryobiologie, FIV entièrement automatisée ?, gamètes artificiels en routine ?, fin de l'infertilité biologique ?, enjeux sociétaux — démographie, inégalités, transhumanisme reproductif) |

---

# 4. CODE COULEUR — FORMATION FIV

## 4.1 Couleurs principales

| Élément | Couleur | Code hex | Usage |
|---|---|---|---|
| **Couleur dominante** | Rose gynécologie | `#E91E63` | Titres H1, H2, bandeau formation |
| **Couleur accent** | Violet biologie | `#7B1FA2` | Titres H3, encadrés techniques labo |
| **Fond alerte urgence** | Rouge vif | `#F44336` fond `#FFEBEE` | SHO sévère, complications aiguës |
| **Fond recommandation** | Bleu ESHRE | `#1565C0` fond `#E3F2FD` | Guidelines ESHRE/ASRM/HAS |
| **Fond bonne pratique** | Vert clinique | `#2E7D32` fond `#E8F5E9` | Bonnes pratiques, protocoles validés |
| **Fond échographie** | Orange écho | `#EF6C00` fond `#FFF3E0` | Spécifique radiologues/échographistes |
| **Fond biologie** | Violet labo | `#6A1B9A` fond `#F3E5F5` | Spécifique biologistes/embryologistes |
| **Fond éthique** | Gris anthracite | `#455A64` fond `#ECEFF1` | Questions éthiques et légales |

## 4.2 Tags de public

| Tag | Public | Couleur |
|---|---|---|
| 🔷 **CLINICIEN** | Gynécologues, internes | Bleu |
| 🔶 **ÉCHOGRAPHISTE** | Radiologues, échographistes | Orange |
| 🟢 **BIOLOGISTE** | Biologistes, embryologistes | Vert |
| 🟣 **TOUS** | Ensemble des publics | Violet |

---

# 5. CONVENTIONS ET CHARTE

## 5.1 Tags médias

Format : `> [MEDIA: {EMOJI} MFIV{module}-S{section}-{numéro} — {TITRE} ({INSTRUCTION_PÉDAGOGIQUE})]`

Types de médias :
- 🔬 : Images microscopiques (ovocytes, spermatozoïdes, embryons, histologie)
- 📷 : Photos cliniques (gestes techniques, matériel, salle de FIV)
- 📊 : Schémas, algorithmes, arbres décisionnels
- 🖼️ : Illustrations anatomiques et physiologiques
- 🎬 : Vidéos de gestes (ponction, ICSI, transfert, time-lapse embryonnaire)
- 📈 : Courbes, graphiques, données épidémiologiques, cinétiques
- 💊 : Tableaux pharmacologiques (gonadotrophines, protocoles)
- 🏥 : Cas cliniques illustrés
- 📐 : Schémas échographiques annotés

## 5.2 Quiz

- 10-15 questions par module
- 4 niveaux : 🥉 Bronze, 🥈 Argent, 🥇 Or, 💎 Diamant
- Questions intégrant les recommandations ESHRE 2023, ASRM 2024, HAS
- Questions spécifiques par public : tag 🔷🔶🟢🟣

## 5.3 Cas cliniques progressifs

- **Minimum 30 cas cliniques** (formation plus longue = plus de cas)
- Niveaux : 8 Bronze, 8 Argent, 8 Or, 6 Diamant
- Cas multi-publics : clinicien + échographiste + biologiste intégrés dans les cas Or et Diamant
- Réponses détaillées avec justifications physiopathologiques et références

## 5.4 Encadrés spéciaux

| Marqueur | Nom | Usage |
|---|---|---|
| 🚨 **URGENCE** | Situations nécessitant une prise en charge immédiate (SHO sévère, torsion, hémorragie) |
| 📋 **RECOMMANDATION** | Guidelines ESHRE, ASRM, HAS, NICE |
| 💡 **POINT PRATIQUE** | Astuces cliniques pour le praticien |
| ⚠️ **PIÈGE** | Erreurs fréquentes à éviter |
| 🔬 **EXPERT** | Détail technique avancé (labo, chirurgie) |
| ⚖️ **ÉTHIQUE** | Questions éthiques et débats |
| 🔷 **CLINICIEN** | Section spécifique cliniciens |
| 🔶 **ÉCHO** | Section spécifique échographistes |
| 🟢 **BIO** | Section spécifique biologistes |

## 5.5 Simulation ReproSim©

Chaque partie comporte au minimum 1 exercice de simulation :

- **Simulation de protocole** : choix FSH, monitorage virtuel, déclenchement (Partie 04)
- **Simulation de ponction** : écho virtuelle, guidage de l'aiguille, anatomie 3D (Partie 05/09)
- **Simulation ICSI** : micromanipulation virtuelle (Partie 05/10)
- **Simulation de transfert** : échoguidage, positionnement cathéter (Partie 06/09)
- **Simulation de sélection embryonnaire** : morphologie, time-lapse, score IA (Partie 10)
- **Scénarios de complications** : SHO progressif, hémorragie post-ponction (Partie 11)

---

# 6. STRUCTURE DES FICHIERS DU CDC

| Fichier | Contenu |
|---------|---------|
| `CDC_FIV_00_INTRODUCTION_CHARTE.md` | Ce document — architecture, conventions, bibliographie |
| `CDC_FIV_01_HISTOIRE.md` | Partie 01 — Histoire de la FIV (M01-M03) |
| `CDC_FIV_02_FONDAMENTAUX.md` | Partie 02 — Fondamentaux de la reproduction (M04-M07) |
| `CDC_FIV_03_BILAN_INFERTILITE.md` | Partie 03 — Bilan d'infertilité (M08-M11) |
| `CDC_FIV_04_STIMULATION.md` | Partie 04 — Stimulation ovarienne (M12-M15) |
| `CDC_FIV_05_PONCTION_LABORATOIRE.md` | Partie 05 — Ponction et techniques de laboratoire (M16-M19) |
| `CDC_FIV_06_TRANSFERT_IMPLANTATION.md` | Partie 06 — Transfert et implantation (M20-M22) |
| `CDC_FIV_07_CRYOPRESERVATION.md` | Partie 07 — Cryopréservation (M23-M25) |
| `CDC_FIV_08_TECHNIQUES_AVANCEES.md` | Partie 08 — Techniques avancées (M26-M29) |
| `CDC_FIV_09_ECHOGRAPHIE_AMP.md` | Partie 09 — Échographie en AMP (M30-M32) |
| `CDC_FIV_10_BIOLOGIE_REPRODUCTION.md` | Partie 10 — Biologie de la reproduction (M33-M35) |
| `CDC_FIV_11_COMPLICATIONS.md` | Partie 11 — Complications et situations particulières (M36-M39) |
| `CDC_FIV_12_ETHIQUE_LEGISLATION.md` | Partie 12 — Éthique, législation, psychologie (M40-M42) |
| `CDC_FIV_13_INNOVATIONS.md` | Partie 13 — Innovations et avenir (M43-M45) |
| `CAS_CLINIQUES_FIV_P1.md` | Cas cliniques Bronze + Argent (cas 1-16) |
| `CAS_CLINIQUES_FIV_P2.md` | Cas cliniques Or + Diamant (cas 17-30) |
| `QUIZ_FIV.md` | Banque de quiz (~500 questions) |

---

# 7. CORRESPONDANCE INTER-FORMATIONS

| Thème transversal | Formation FIV | Autres formations VERTEX© |
|---|---|---|
| Axe hypothalamo-hypophyso-gonadique | M05, M06, M12 | Endocrinologie |
| SOPK et syndrome métabolique | M39 | Obésité-Orthopédie, Diabétologie |
| Thrombophilie et anticoagulation | M36, M38 | HTA |
| Échographie interventionnelle | M30-M32 | — |
| Éthique biomédicale | M40-M42 | — |
| IA en médecine | M43 | Diabétologie (DiabSim©) |
| Complications thromboemboliques | M36 | HTA |
| Grossesse et pathologies | M22, M37, M39 | HTA (HTA gravidique), Hypothyroïdie (grossesse) |

---

# 8. RÉFÉRENCES BIBLIOGRAPHIQUES FONDATRICES

## 8.1 Ouvrages de référence

- **Gardner DK, Weissman A, Howles CM, Shoham Z.** *Textbook of Assisted Reproductive Techniques*. 6th ed. CRC Press; 2024.
- **Fauser BCJM, Devroey P, Macklon NS.** *Multiple Births from Assisted Reproductive Technologies*. ESHRE Monograph; 2018.
- **Elder K, Dale B.** *In-Vitro Fertilization*. 4th ed. Cambridge University Press; 2020.
- **Speroff L, Fritz MA.** *Clinical Gynecologic Endocrinology and Infertility*. 9th ed. Wolters Kluwer; 2020.
- **ESHRE.** *ART Fact Sheet — Latest European data*. 2024.

## 8.2 Articles princeps

- **Edwards RG, Steptoe PC.** *A matter of life: the story of a medical breakthrough*. Hutchinson; 1980.
- **Palermo G, Joris H, Devroey P, Van Steirteghem AC.** Pregnancies after intracytoplasmic injection of single spermatozoon into an oocyte. *Lancet*. 1992;340(8810):17-18.
- **Kuwayama M.** Highly efficient vitrification method for cryopreservation of human oocytes. *Reprod Biomed Online*. 2005;11(3):300-308.
- **Handyside AH, Kontogianni EH, Hardy K, Winston RM.** Pregnancies from biopsied human preimplantation embryos sexed by Y-specific DNA amplification. *Nature*. 1990;344(6268):768-770.
- **Chen ZJ, Shi Y, Sun Y, et al.** Fresh versus frozen embryos for infertility in the polycystic ovary syndrome. *N Engl J Med*. 2016;375(6):523-533.
- **Vuong LN, Dang VQ, Ho TM, et al.** IVF transfer of fresh or frozen embryos in women without polycystic ovaries. *N Engl J Med*. 2018;378(2):137-147.
- **Donnez J, Dolmans MM, Demylle D, et al.** Livebirth after orthotopic transplantation of cryopreserved ovarian tissue. *Lancet*. 2004;364(9443):1405-1410.
- **Brännström M, Johannesson L, Bokström H, et al.** Livebirth after uterus transplantation. *Lancet*. 2015;385(9968):607-616.

## 8.3 Guidelines de référence

- **ESHRE.** Guideline on ovarian stimulation for IVF/ICSI. 2019 (update 2023).
- **ESHRE.** Guideline on recurrent pregnancy loss. 2017 (update 2022).
- **ASRM.** Committee opinions on embryo transfer, PGT, oocyte cryopreservation. 2023-2024.
- **NICE.** Fertility problems: assessment and treatment. CG156. 2013 (update 2023).
- **HAS.** Recommandations AMP — Agence de la biomédecine. 2024.
- **OMS.** WHO laboratory manual for the examination and processing of human semen. 6th ed. 2021.
- **PGDIS.** Position statement on the transfer of mosaic embryos. 2019 (update 2021).

## 8.4 Études récentes clés (2020-2026)

- **Lensen S, et al.** Endometrial scratching before IVF: a multicentre RCT. *N Engl J Med*. 2019;380(4):325-334.
- **Coomarasamy A, et al.** Micronized vaginal progesterone to prevent miscarriage (PRISM). *N Engl J Med*. 2019;380(19):1815-1824.
- **Munné S, et al.** Preimplantation genetic testing for aneuploidy versus morphology as embryo selection strategy (STAR trial). *Fertil Steril*. 2019;112(5):870-877.
- **Vuong LN, et al.** In-vitro maturation of oocytes versus conventional IVF in women with infertility and a high antral follicle count (IVFM trial). *Lancet*. 2020;396(10262):1445-1453.
- **Tran D, et al.** Deep learning as a predictive tool for fetal heart pregnancy following IVF. *Hum Reprod*. 2019;34(6):1011-1018.
- **Pinborg A.** Short- and long-term outcomes in children born after assisted reproduction. *BJOG*. 2019;126(2):145-148.

---

# 9. PATIENT FIL ROUGE

## 9.1 Fil rouge principal — Mme et M. L.

**Mme Claire L., 34 ans, professeure des écoles** et **M. Thomas L., 36 ans, ingénieur informatique**

Ce couple traverse l'ensemble du parcours AMP et sert de fil conducteur tout au long de la formation :

- **M08** : Consultation initiale après 18 mois d'essai. Interrogatoire, facteurs de risque
- **M09** : Bilan féminin — AMH 1,8 ng/mL, CFA 12, HSG — trompe droite obstruée (hydrosalpinx)
- **M10** : Bilan masculin — spermogramme : OAT modéré (8 M/mL, 25% progressifs, 3% Kruger)
- **M11** : Synthèse du bilan — indication FIV-ICSI, information du couple
- **M13** : Choix du protocole — antagoniste flexible, FSH 225 UI/j
- **M14** : Monitorage — J8 : 8 follicules ≥12 mm, E2 = 1200 pg/mL, endomètre 9 mm triple ligne
- **M15** : Déclenchement — Ovitrelle 250 µg, 10 follicules ≥14 mm
- **M16** : Ponction — 9 ovocytes recueillis
- **M18** : ICSI — 7 ovocytes matures, 5 fécondés (2PN)
- **M19** : Culture — J5 : 2 blastocystes (4AA et 3BB), 1 morula
- **M20** : Transfert SET du 4AA — échoguidé, cathéter Wallace
- **M23** : Vitrification du 3BB
- **M21** : Phase lutéale — progestérone vaginale 600 mg/j
- **M22** : βhCG J14 = 312 UI/L → grossesse clinique ! Écho 7 SA : 1 embryon, AC+
- **M37** : Suivi obstétrical — grossesse singleton, accouchement terme — Léa, 3 250 g

## 9.2 Fil rouge secondaire — Mme S. (don d'ovocytes)

**Mme Sarah S., 42 ans, cadre supérieure, célibataire** — parcours AMP pour femme seule avec don d'ovocytes :

- **M40** : Cadre légal — AMP pour toutes, loi 2021
- **M27** : Don d'ovocytes — choix de la donneuse, appariement
- **M24** : TEC en cycle substitué
- **M42** : Accompagnement psychologique

## 9.3 Fil rouge tertiaire — Mme et M. D. (préservation fertilité)

**Mme Emma D., 29 ans, interne en médecine, diagnostiquée cancer du sein** — oncofertilité :

- **M25** : Préservation de la fertilité en urgence — stimulation random start, vitrification ovocytaire
- Retour 3 ans plus tard — TEC post-rémission

---

# 10. GLOSSAIRE — TERMES CLÉS DE LA FORMATION

Le module doit introduire progressivement les termes suivants (liste non exhaustive — ~300 termes) :

**A** : Acide hyaluronique, Activation ovocytaire, Adhésion embryonnaire, AMH, Amniocentèse, Aménorrhée, Amphiréguline, Aneuploïdie, Annexine V, Antagoniste GnRH, Atrésie folliculaire, Autoconservation, Azoospermie

**B** : Biopsie trophectoderme, Blastocyste, Blastocoele, BMP-15, Boucle de rétrocontrôle

**C** : Capacitation, CASA, Cathéter de transfert, CECOS, CFA, Clivage, COFRAC, Compaction, Corps jaune, Cortex ovarien, Cryoprotecteur, Cryotop, Cumulus oophorus, Cycle substitué

**D** : Décidualisation, Déclenchement, Deep learning, Dénudation ovocytaire, DFI, DHEA, Dialogue materno-embryonnaire, DuoStim

**E** : Éclosion assistée, Ectogenèse, Embryoscope, Endométriose, ERA, ESHRE, Estradiol, Expansion du blastocyste

**F** : Fécondation, Fenêtre d'implantation, FIV classique, Follicule antral, Follicule dominant, Folliculogenèse, Fragmentation ADN, FSH, Freeze-all

**G** : Gamétogenèse in vitro, Gardner (classification), GDF-9, GERI, Globozoospermie, GnRH, Gonadotrophines, Granulosa, GPA

**H-I** : hCG, HEPES, HMG, HSG, Hydrosalpinx, Hyperrépondeuse, ICSI, ICM, Implantation, IMSI, Incubateur, IOP, iPS, IVG, IVM

**K-L** : KIDScore, Kisspeptine, Kuwayama, Lactobacillus, LH, Liquide folliculaire, Lutéinisation

**M-N** : MACS, Maturation ovocytaire, Méiose, Métaphase II, Microfluidique, Micro-TESE, Mild stimulation, Morula, Mosaïcisme, Mucines, NGS, niPGT, NK utérins

**O-P** : OAT, Oncofertilité, Ovogenèse, Palermo, Paracentèse, PGT-A, PGT-M, PGT-SR, PICSI, Pinopodes, POSEIDON, PPOS, Progestérone, Pronuclei, PRP

**R-S** : Random start, Réaction acrosomique, Réceptivité endométriale, Recombinante, ReproSim©, ROSI, Sertoli, SET, SHO, SonoHSG, Spermatogenèse, Spermatide, Spermogramme, Spindle transfer, Stigma, Swim-up, Syngamie

**T-V** : TEC, TESE, Time-lapse, Trigger, Trophoblaste, Trophectoderme, TUNEL, Utérus artificiel, VEGF, Vitrification, Vésicule vitelline, Zona pellucida, Zygote

---

*Ce document est le cahier des charges fondateur de la Formation FIV-AMP VERTEX©. Il constitue la référence unique pour la rédaction de tous les modules, cas cliniques et quiz de cette formation. Toute modification doit être validée et versionnée.*

*Rédigé selon les REGLES_ECRITURE_CONTENU.md de la plateforme VERTEX©.*
