# FORMATION DIABÉTOLOGIE — PARTIE X : INNOVATIONS ET RECHERCHE

# MODULE 36 : INTELLIGENCE ARTIFICIELLE ET DIABÈTE

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Modules 16 (CGM), 23 (pompe), 29 (boucle fermée)

---

## Accroche clinique

> 🏥 **Mise en situation** : Un centre de santé rural reçoit un appareil de dépistage de la rétinopathie diabétique autonome (IDx-DR) : la patiente pose le menton sur le support, l'image de fond d'œil est prise automatiquement, l'algorithme l'analyse en 30 secondes et affiche : « Rétinopathie diabétique référable — adresser à l'ophtalmologue ». Pas d'ophtalmologue sur place, pas de dilatation, pas d'attente. *L'IA transforme déjà concrètement la pratique diabétologique — du dépistage des complications au pilotage automatique de l'insuline.*

---

## Objectifs d'apprentissage

1. **Identifier** les applications validées de l'IA en diabétologie (dépistage RD, boucle fermée, prédiction du risque)
2. **Comprendre** le fonctionnement des algorithmes de contrôle automatisé de l'insuline (AID)
3. **Évaluer** les limites et enjeux éthiques de l'IA appliquée à la santé
4. **Anticiper** les développements futurs (pancréas artificiel, digital twins, médecine de précision)

---

## 36.1 — Applications validées de l'IA en diabétologie

> 🤔 **Question de réflexion** : Un algorithme d'IA dépiste la rétinopathie diabétique avec une sensibilité de 87 % et une spécificité de 90 %. Un ophtalmologue expérimenté atteint 80 % de sensibilité dans certaines études. L'IA peut-elle remplacer le spécialiste ? Quelles sont les limites de cette comparaison ?

### 36.1.1 — Dépistage de la rétinopathie diabétique par IA

Le dépistage de la RD représente l'application d'IA la plus mature et la plus déployée en diabétologie clinique :

**IDx-DR / LumineticsCore** :
- 1er système diagnostique **entièrement autonome** approuvé par la FDA (2018) pour la pratique médicale
- Analyse des clichés de fond d'œil sans dilatation pupillaire, sans ophtalmologue
- **Performances** : sensibilité > 87 %, spécificité > 90 % pour la RD référable (comparé au gold standard ophtalmologique)
- Déploiement : cabinets de médecine générale, centres de soins primaires, pharmacies
- Publication pivot : Abràmoff et al., *npj Digital Medicine*, 2018

**EyeArt** (Eyenuk) : concurrent validé, résultats comparables, déployé dans plusieurs systèmes de santé.

**Limites pratiques** : qualité d'image insuffisante dans 10-15 % des cas (cataracte, mauvaise fixation, mydriase insuffisante), cas limites entre RD légère et modérée, absence de diagnostic des pathologies non rétiniennes (glaucome, DMLA).

> [MEDIA: 🖥️ MDIAB36-S01-001 — FLUX DE DÉPISTAGE RD PAR IA (IDx-DR : prise en charge, analyse, résultat — comparaison avec parcours classique ophtalmologique)]

### 36.1.2 — Les boucles fermées : l'IA la plus déployée en diabétologie

Les systèmes AID (*Automated Insulin Delivery*) constituent, à l'échelle mondiale, l'application d'IA la plus largement utilisée en diabétologie — des millions de patients en bénéficient déjà.

**Algorithmes de contrôle** utilisés :
- **MPC** (*Model Predictive Control*) : modélise la pharmacocinétique de l'insuline et prédit les glycémies futures pour ajuster les débits → MiniMed 780G (Medtronic), CamAPS FX
- **PID** (*Proportional-Integral-Derivative*) : réaction proportionnelle à l'écart actuel, intégrale de l'écart passé, dérivée de la tendance → Omnipod 5 (Insulet), Control-IQ (Tandem)

**Performances des systèmes AID de 3e génération (études 2022-2024)** :
- Temps dans la cible (TIR 70-180 mg/dL) : 70-80 % vs 50-60 % en traitement conventionnel
- Réduction de l'HbA1c : 0,5 à 1,2 % selon le niveau de départ
- Réduction des hypoglycémies nocturnes : > 50 %
- Amélioration de la qualité du sommeil et de la qualité de vie

> 💡 **Astuce clinique** : Un TIR ≥ 70 % est l'objectif recommandé par les consensus ADA/EASD pour les boucles fermées. En pratique, même un TIR amélioré de 10 points (passage de 55 % à 65 %) réduit significativement le risque de complications microvasculaires (chaque +10 % de TIR ≈ -0,5 % d'HbA1c).

### 36.1.3 — Prédiction du risque et aide à la décision

L'IA apporte une valeur ajoutée croissante dans l'analyse prédictive et l'aide à la décision clinique :

**Prédiction du risque de DT2** :
- Amélioration du FINDRISC par apprentissage automatique (intégration de données génomiques, comportementales, biologiques)
- Scores polygéniques (*Polygenic Risk Scores*, PRS) : prédiction du risque de DT2 sur la base du génome → utilisés en recherche, en cours de validation clinique

**Prédiction des complications** :
- Modèles ML prédisant la progression vers la néphropathie (à partir de la dynamique de l'albuminurie et du DFG), la RD, la neuropathie
- Systèmes d'alerte précoce dans les DME (*Dossiers Médicaux Électroniques*) : flag automatique pour les patients à risque élevé

**Analyse automatisée du CGM** :
- Génération automatique de l'AGP (*Ambulatory Glucose Profile*) avec interprétation guidée
- Détection des patterns récurrents (Dawn effect, Somogyi, hypoglycémies post-prandiales)
- DreaMed Advisor : recommandations automatiques d'ajustement des réglages de pompe basées sur les données CGM → validé dans plusieurs essais cliniques

**Aide à la décision thérapeutique** :
- Systèmes de recommandation basés sur le phénotype complet du patient (comorbidités, données CGM, biologie)
- Applications d'accompagnement : coaching nutritionnel par IA conversationnelle, rappels de traitement, soutien motivationnel

---

## 36.2 — Limites, éthique et perspectives

> 🤔 **Question de réflexion** : Si un algorithme d'IA recommande un changement thérapeutique qui s'avère délétère pour un patient, qui est responsable — le médecin qui a suivi la recommandation, l'éditeur du logiciel, ou l'établissement qui a déployé le système ?

### 36.2.1 — Limites techniques et éthiques

**Biais algorithmiques** :
- La performance d'un algorithme est directement liée à la représentativité de ses données d'entraînement
- Sous-représentation de certaines ethnies dans les jeux de données → performance réduite dans les populations non représentées (exemple : IDx-DR entraîné principalement sur des populations américaines blanches)
- Biais de genre, socio-économiques, géographiques

**Explicabilité (boîte noire)** :
- Les réseaux de neurones profonds prennent des décisions impossibles à expliquer en termes cliniques
- Problème du « pourquoi » : comment justifier une décision à un patient ou en cas de litige médico-légal ?
- Développement du *Explainable AI* (XAI) : modèles interprétables, cartes d'attention (Grad-CAM pour les images)

**Responsabilité médico-légale** :
- Cadre réglementaire en construction : la FDA et l'EMA développent des voies d'approbation spécifiques pour les SaMD (*Software as a Medical Device*)
- En l'état actuel, le médecin reste responsable des décisions cliniques même basées sur une recommandation algorithmique
- Obligation de supervision active : le médecin ne doit pas déléguer sa responsabilité à l'IA

**Protection des données** :
- RGPD (Europe) : données de santé = données sensibles, consentement explicite, droit à l'effacement
- Risques de réidentification dans les grands jeux de données anonymisés
- Sécurité des échanges (CGM cloud, applications mobiles)

### 36.2.2 — Perspectives : pancréas artificiel et digital twins

**Pancréas artificiel « fully closed loop »** :
- Systèmes actuels = boucles semi-fermées (annonce des repas encore nécessaire dans la plupart)
- Objectif : boucle entièrement fermée avec algorithme prédictif IA avancé → aucune intervention du patient
- Données prometteuses en conditions réelles (IClosedLoop, FLAIR trial) ; défi : hypoglycémies post-exercice et post-alcool

**Digital twins diabétiques** :
- Concept : modèle numérique du patient spécifique intégrant son pharmacocinétique insulinique, sa sensibilité glycémique, son comportement alimentaire, son activité physique
- Application : simulation *in silico* de différents scénarios thérapeutiques avant de les appliquer réellement → personnalisation maximale
- Stade : modèles validés en recherche, début de déploiement expérimental clinique

**Médecine de précision par IA** : stratification phénotypique et génomique des DT2 (MODY, LADA, DT2 insulinodéficient) → modèles multi-omiques pour prédire la réponse individuelle à chaque classe thérapeutique.

> [MEDIA: 🔮 MDIAB36-S02-001 — CONCEPT DIGITAL TWIN DIABÉTIQUE (modèle numérique individuel → simulation thérapeutique → recommandation personnalisée)]

---

## Points clés — Module 36

> 🎯 **Essentiel à retenir**
> 1. IDx-DR : 1er diagnostic médical autonome par IA approuvé FDA (2018) — dépistage RD sans ophtalmologue, Sn > 87 %
> 2. Les systèmes AID (boucle fermée) sont les applications d'IA les plus déployées en diabétologie (millions de patients)
> 3. L'IA améliore la prédiction du risque de DT2, de complications et d'hypoglycémies
> 4. Limites majeures : biais algorithmiques, explicabilité, responsabilité médico-légale
> 5. Digital twins et médecine de précision : les prochaines révolutions en cours de maturation clinique

---

# MODULE 37 : NOUVELLES THÉRAPEUTIQUES — MOLÉCULES EN DÉVELOPPEMENT

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Avancé
**Prérequis** : Modules 26-27 (aGLP-1, iSGLT2), 34-35

---

## Accroche clinique

> 🏥 **Mise en situation** : Un diabétologue revient enthousiaste d'un congrès ADA 2025. Son interne lui demande : « Parmi tout ce qu'on a présenté, quelles sont les 3 molécules qui vont vraiment changer notre pratique dans les 5 prochaines années ? » *Le pipeline thérapeutique en diabétologie 2025-2030 est le plus riche de toute l'histoire de la spécialité — distinguer les innovations transformatives des améliorations incrémentales est un exercice crucial pour le praticien.*

---

## Objectifs d'apprentissage

1. **Identifier** les molécules approuvées récemment ou en phase 3 avancée qui vont transformer la pratique
2. **Comprendre** les nouvelles cibles thérapeutiques (triple agonisme, agonistes oraux non peptidiques, insuline glucose-responsive)
3. **Évaluer** le niveau de preuve de chaque innovation (stade de développement, données d'efficacité)
4. **Anticiper** l'impact sur les algorithmes thérapeutiques du DT2 et de l'obésité

---

## 37.1 — Innovations à impact clinique immédiat (approuvées ou phase 3 avancée)

> 🤔 **Question de réflexion** : L'insuline icodec hebdomadaire simplifie l'initiation de l'insulinothérapie dans le DT2 — mais ce gain de simplicité justifie-t-il son coût supérieur à l'insuline glargine quotidienne ? Comment évaluer la valeur ajoutée d'une innovation incrémentale ?

### 37.1.1 — Insuline icodec (Awiqli®) : hebdomadaire

- Insuline basale à action ultra-prolongée (demi-vie ~196 h → couverture 7 jours)
- Programme ONWARDS (1-6 essais de phase 3) : non-infériorité vs glargine U100 et degludec sur l'HbA1c ; légère augmentation des hypoglycémies légères dans certains essais
- Approbation : Canada (2023), EU (2023), FDA (2024) pour le DT2
- **Impact clinique** : transformation de l'initiation de l'insulinothérapie dans le DT2 — une injection/semaine vs 7 → adhérence potentiellement améliorée

### 37.1.2 — Tirzépatide (Mounjaro® / Zepbound®)

- Double agoniste GIP/GLP-1 — mécanisme synergique sur les récepteurs GIP et GLP-1
- **Efficacité sans précédent** dans le DT2 : ↓ HbA1c jusqu'à -2,1 % à la dose max (15 mg), perte de poids -12 à -15 kg (SURPASS 1-5)
- Dans l'obésité sans DT2 (Zepbound, SURMOUNT) : perte de poids médiane -20,9 % à 72 semaines
- CVOT (SURPASS-CVOT) : résultats attendus 2025 — protection CV à confirmer
- **Position** : remplace progressivement les aGLP-1 mono-agonistes comme traitement de 1re intention dans le DT2 + obésité

### 37.1.3 — Sémaglutide haute dose et combinaisons

**Sémaglutide 2,4 mg (Wegovy®)** :
- Protection cardiovasculaire démontrée même en l'absence de DT2 (étude SELECT, Lincoff et al., *N Engl J Med*, 2023) : ↓ 20 % des événements CV majeurs chez des patients obèses + ATCD CV
- Élargit les indications des aGLP-1 au-delà du seul DT2

**CagriSema (cagrilintide + sémaglutide)** :
- Double combinaison : analogue de l'amyline (cagrilintide) + sémaglutide
- Programme REDEFINE : perte de poids > 22 % à 68 semaines → supérieure au sémaglutide seul et proche de la chirurgie bariatrique
- Phase 3 en cours (Novo Nordisk)

**Résmétirom (Rezdiffra®)** :
- Agoniste sélectif du récepteur THR-β hépatique
- 1er traitement de la MASH (stéatohépatite métabolique) approuvé FDA (mars 2024) — étude MAESTRO-NASH
- Réduction significative de la fibrose hépatique et de la stéatose → pertinence majeure dans le DT2 (prévalence MASH ~50 %)

**Finérénone (Kerendia®)** :
- ARM (*Antagoniste des Récepteurs aux Minéralocorticoïdes*) non stéroïdien
- Protection rénale + cardiovasculaire dans la néphropathie diabétique (FIDELIO-DKD, FIGARO-DKD)
- Complémentaire aux iSGLT2 : association finérénone + iSGLT2 = protection rénale maximale (essai FINEARTS-HF)

> [MEDIA: 📊 MDIAB37-S02-002 — COMPARATIF PERTE DE POIDS PAR CLASSE (sémaglutide vs tirzépatide vs CagriSema vs chirurgie bariatrique — données pondérales médianes)]

---

## 37.2 — Innovations à moyen terme (phase 2-3 en cours)

> 🤔 **Question de réflexion** : L'orforglipron est un agoniste GLP-1 oral non peptidique (petite molécule) qui se prend sans contrainte à jeun. Si ses résultats de phase 3 confirment l'efficacité, cela pourrait-il rendre accessible le traitement aGLP-1 à des millions de patients qui ne s'injectent pas ? Quels sont les enjeux économiques et de santé publique ?

### 37.2.1 — Triple agonistes GLP-1/GIP/glucagon

- **Principe** : combinaison du triple agonisme GLP-1 (sécrétion insuline, satiété) + GIP (métabolisme lipidique) + glucagon (dépense énergétique, lipolyse hépatique) sur une seule molécule
- **Rétaporsen / LY3437943** (Eli Lilly) : phase 3 en cours — perte de poids > 20-25 % attendue, bénéfice sur la MASH
- **Survodutide** (Boehringer Ingelheim) : phase 3 MASH — réduction de la fibrose hépatique
- **Positionnement potentiel** : perte de poids > chirurgie bariatrique dans certains cas → révolution si confirmé en phase 3

### 37.2.2 — Agonistes GLP-1 oraux non peptidiques

La limite majeure des aGLP-1 actuels est leur nature peptidique : injectable ou, pour le sémaglutide oral (Rybelsus®), soumis à des contraintes de prise très strictes (à jeun strict, attendre 30 min avant de manger ou boire).

**Orforglipron** (Eli Lilly) :
- Petite molécule non peptidique agoniste GLP-1 oral
- **Aucune contrainte de prise** : peut se prendre avec ou sans aliments
- Phase 2 (ACHIEVE) : ↓ HbA1c -1,6 %, perte de poids -10 % à 26 semaines
- Phase 3 en cours — résultats attendus 2025-2026
- Si positif : transformation majeure de l'accès aux aGLP-1 (oral, simple, potentiellement moins coûteux)

**Danuglipron** (Pfizer) : développement en reformulation après problèmes hépatiques dans les premières formulations — avenir incertain.

### 37.2.3 — Insuline glucose-responsive (« smart insulin »)

- **Concept** : insuline qui s'active uniquement en présence d'hyperglycémie et reste inactive en cas de normoglycémie → élimination théorique des hypoglycémies induites par l'insuline
- Plusieurs approches en préclinique avancé et phase 1 : NNC2215 (Novo Nordisk), MK-2640 (Merck)
- Défi : cinétique d'activation/désactivation suffisamment rapide pour être utile cliniquement
- **Potentiel révolutionnaire** s'il est validé : supplanter toutes les insulines actuelles

> [MEDIA: 📋 MDIAB37-S02-001 — PIPELINE THÉRAPEUTIQUE 2025-2030 (molécule, mécanisme, indication, phase actuelle, date estimée de disponibilité)]

### 37.2.4 — Autres molécules d'intérêt

| Molécule | Mécanisme | Statut | Commentaire |
|---|---|---|---|
| **Baricitinib** (anti-JAK) | Inhibition JAK1/2 | Phase 2 (DT1) | Préservation β-cellulaire prometteuse (NEJM 2023) |
| **Imeglimin** (Twymeeg®) | Mécanisme mitochondrial | Approuvé au Japon | Pas en Europe/USA à ce jour |
| **Épalréstat** | Inhibiteur aldose réductase | Approuvé en Asie | Neuropathie diabétique ; non disponible en Occident |
| **VX-880/VX-264** | Thérapie cellulaire hESC | Phase 1/2 | Cf. Module 35 — insulino-indépendance DT1 |

---

## Points clés — Module 37

> 🎯 **Essentiel à retenir**
> 1. Triple agonistes (tirzépatide-like + glucagon) : perte de poids > 20-25 % → risquent de supplanter les mono-agonistes
> 2. Orforglipron : 1er aGLP-1 oral non peptidique sans contrainte de prise → transformation majeure de l'accessibilité si phase 3 positive
> 3. CagriSema (amyline + sémaglutide) : perte de poids > 22 % → approche chirurgicale sans chirurgie
> 4. Insuline icodec hebdomadaire (Awiqli®) : approuvée, simplifie l'initiation de l'insulinothérapie dans le DT2
> 5. Résmétirom (Rezdiffra®) : 1er traitement MASH approuvé FDA 2024 — pertinence directe dans le DT2 avec atteinte hépatique

---

# MODULE 38 : ÉPIDÉMIOLOGIE MONDIALE ET INÉGALITÉS D'ACCÈS

**Partie** : X — Innovations et recherche
**Durée estimée** : 2h00
**Niveau** : Intermédiaire
**Prérequis** : Modules 6 (DT2 — physiopathologie et facteurs de risque), 10 (dépistage), 29 (technologies)

---

## Accroche clinique

> 🏥 **Mise en situation** : Lors d'une conférence internationale, un expert de l'IDF rappelle : « En 2024, 537 millions de personnes vivent avec le diabète. En 2045, ce sera 783 millions. Quarante-quatre pour cent ne sont pas diagnostiqués. Et dans certains pays à faible revenu, un enfant DT1 a une espérance de vie de moins d'un an parce que l'insuline n'est pas disponible. » *Le diabète est la pandémie silencieuse du XXIe siècle — et l'inégalité d'accès au traitement constitue un scandale sanitaire mondial auquel tout praticien peut contribuer à répondre.*

---

## Objectifs d'apprentissage

1. **Maîtriser** les chiffres clés de l'épidémiologie mondiale du diabète (IDF Diabetes Atlas 2024)
2. **Comprendre** les déterminants de la pandémie de DT2 (urbanisation, transition nutritionnelle, vieillissement)
3. **Identifier** les inégalités d'accès au diagnostic, à l'insuline et aux technologies
4. **Connaître** les initiatives mondiales de lutte contre le diabète et le rôle du praticien dans ce contexte

---

## 38.1 — Épidémiologie mondiale : les données IDF 2024

> 🤔 **Question de réflexion** : 44 % des diabétiques dans le monde ne sont pas diagnostiqués. Dans votre propre pays, ce pourcentage est de l'ordre de 20-25 %. Quels sont les obstacles au diagnostic précoce ? Quelles stratégies permettraient de les réduire ?

### 38.1.1 — Chiffres clés (IDF Diabetes Atlas, 10e édition, 2024)

| Indicateur | Valeur 2024 | Projection 2045 |
|---|---|---|
| Adultes (20-79 ans) avec diabète | **537 millions** (10,5 %) | **783 millions** (+46 %) |
| Non diagnostiqués | **240 millions** (44 %) | — |
| Décès attribuables au diabète/an | **6,7 millions** | — |
| Coût mondial (USD) | **966 milliards** (15 % dépenses santé) | — |
| Enfants < 20 ans avec DT1 | **1,2 million** | — |

Ces chiffres sont à comparer avec 108 millions de diabétiques en 1980 (OMS) — la prévalence a quadruplé en 40 ans, principalement du fait de l'explosion du DT2.

### 38.1.2 — Répartition géographique

**Les 5 pays avec le plus grand nombre de diabétiques (2024)** :
1. Chine : ~140 millions
2. Inde : ~74 millions
3. États-Unis : ~37 millions
4. Pakistan : ~33 millions
5. Brésil : ~22 millions

**Taux de prévalence les plus élevés** : Moyen-Orient et Afrique du Nord (~17 %) ; Pacifique occidental

**Croissance la plus rapide projetée (2021-2045)** :
- **Afrique : +134 %** — urbanisation rapide, transition nutritionnelle, vieillissement démographique, manque d'infrastructures de dépistage
- Asie du Sud-Est : +74 %
- Moyen-Orient : +87 %

**Les 80 % du problème** : les pays à revenu faible et intermédiaire concentrent 80 % des personnes diabétiques dans le monde — mais ont le moins de ressources pour y faire face.

> [MEDIA: 🌍 MDIAB38-S01-001 — CARTE MONDIALE PRÉVALENCE DU DIABÈTE (IDF Atlas 2024, prévalence par région, en dégradé de couleurs)]

### 38.1.3 — Épidémiologie spécifique du DT1

- **Prévalence mondiale** : ~8,75 millions de personnes avec DT1 (tous âges)
- **Incidence** : en augmentation de 3-4 %/an en Europe depuis 30 ans (Patterson et al., *Lancet Diabetes Endocrinol*, 2019) — mécanismes non élucidés (microbiome, infections virales, facteurs environnementaux)
- **Gradient géographique** : Finlande (64 cas/100 000/an) → Chine (1 cas/100 000/an) — variation de 60 à 1 selon les régions
- **DT2 pédiatrique** : augmentation alarmante parallèle à l'épidémie d'obésité infantile — préoccupation de santé publique majeure pour les 20 prochaines années

### 38.1.4 — Déterminants de la pandémie de DT2

La progression du DT2 est multifactorielle : **urbanisation** (sédentarité, alimentation ultra-transformée), **transition nutritionnelle** (abandon des régimes traditionnels riches en fibres), **vieillissement démographique** (prévalence forte après 60 ans), **obésité** (2 milliards d'adultes en surpoids — OMS). Le concept de **« diabèse »** (*diabesity*) traduit la convergence des pandémies d'obésité et de DT2 en un même phénomène métabolique.

---

## 38.2 — Inégalités d'accès et politiques mondiales de santé

> 🤔 **Question de réflexion** : L'insuline a été découverte il y a plus de 100 ans (Banting et Best, 1921) et son brevet a été cédé pour 1 dollar canadien. En 2024, elle reste inaccessible à des millions de patients dans les pays à faible revenu. Comment expliquer ce paradoxe ? Quelles sont les responsabilités respectives des États, des industriels et de la communauté médicale ?

### 38.2.1 — Fracture d'accès à l'insuline

La situation de l'accès à l'insuline constitue l'une des inégalités sanitaires les plus documentées et les plus inacceptables :

- **Coût comparatif** : 1 flacon d'insuline rapide humaine ≈ 4 USD en Inde (production locale) vs 300 USD aux USA avant la réforme (Inflation Reduction Act, 2022)
- **~50 % des DT1 dans les pays à faible revenu** n'ont pas accès à l'insuline de façon fiable
- **Conséquences** : mortalité rapide sans insuline (acidocétose en quelques jours à semaines), espérance de vie < 1 an pour un enfant DT1 dans certains pays d'Afrique subsaharienne
- **Inflation Reduction Act (USA, 2022)** : plafonnement de l'insuline à 35 USD/mois pour les assurés Medicare — mesure symbolique et concrète

**Actions en cours** :
- Inscription de l'insuline sur la liste OMS des médicaments essentiels (maintenue depuis 2019)
- Programme de pré-qualification OMS pour les biosimilaires d'insuline → réduction des coûts
- Initiative « Life for a Child » (IDF Foundation) : accès à l'insuline pour les enfants dans les PED

### 38.2.2 — Fracture technologique

En termes d'accès aux technologies : CGM > 70 % des DT1 en Scandinavie vs < 1 % dans les PED ; pompe à insuline > 50 % vs < 0,1 % ; HbA1c disponible en routine vs souvent absent. Cette fracture amplifie les inégalités de santé : cécité, insuffisance rénale, amputations frappent massivement les populations qui ont le moins accès aux outils de prévention.

> [MEDIA: 📊 MDIAB38-S02-001 — GRAPHIQUE INÉGALITÉS D'ACCÈS (insuline, CGM, aGLP-1 — pays à haut revenu vs faible revenu — données comparatives)]

### 38.2.3 — Initiatives mondiales et rôle du praticien

**Cadre international** :
- **ODD 3.8** (Objectif de Développement Durable) : accès universel aux médicaments essentiels d'ici 2030
- **Résolution ONU sur le diabète** (2021) : engagement des États membres à améliorer la prévention et l'accès aux soins
- **Global Diabetes Compact** (OMS, 2021) : engagement de 50 % de réduction des décès prématurés par DT2 d'ici 2030, accès universel à l'insuline pour les DT1 d'ici 2030

**Rôle du praticien** :
- **Advocacy** : s'impliquer dans le plaidoyer pour l'accès universel aux médicaments essentiels
- **Dépistage ciblé dans les populations vulnérables** : migrants, populations précaires, travailleurs exposés
- **Éducation thérapeutique adaptée culturellement** : tenir compte des représentations culturelles de la maladie, des barrières linguistiques, des contraintes économiques
- **Formation des soignants dans les PED** : transfert de compétences, télémédecine, formations e-learning (comme la plateforme VERTEX©)

> 💡 **Astuce clinique** : Face à un patient diabétique en situation de précarité (renoncement aux soins pour raisons économiques), orienter vers le dispositif PUMA (Protection Universelle Maladie) et les aides de la CPAM pour les médicaments onéreux (iSGLT2, aGLP-1) — ces thérapies cardio et néphroprotectrices sont maintenant remboursées en France sous conditions.

---

## Points clés — Module 38

> 🎯 **Essentiel à retenir**
> 1. 537 millions de diabétiques en 2024, 783 millions en 2045 → +46 % en 20 ans — pandémie silencieuse
> 2. 44 % des diabétiques ne sont pas diagnostiqués (240 millions de personnes ignorant leur maladie)
> 3. L'insuline reste inaccessible à ~50 % des DT1 dans les pays à faible revenu → mortalité massive évitable
> 4. Fracture technologique : CGM/pompe > 70 % dans les pays nordiques vs < 1 % dans les PED
> 5. L'Afrique connaîtra la croissance la plus forte (+134 % projeté 2021-2045) avec les infrastructures les plus fragiles

---

## Auto-évaluation — Modules 36, 37 & 38

**Q1.** IDx-DR (LumineticsCore) est un système d'IA qui permet :

a) D'ajuster automatiquement les doses d'insuline dans la boucle fermée
b) De détecter la rétinopathie diabétique référable de façon entièrement autonome, sans ophtalmologue
c) De prédire le risque de DT2 à partir du génome
d) D'analyser les données CGM et proposer des ajustements thérapeutiques

<details><summary>💡 Réponse</summary>

**b)** IDx-DR (renommé LumineticsCore) est le 1er système diagnostique entièrement autonome approuvé par la FDA (2018), capable de détecter la rétinopathie diabétique référable à partir de photos de fond d'œil sans dilatation et sans ophtalmologue sur place. Sensibilité > 87 %, spécificité > 90 % (Abràmoff et al., *npj Digital Medicine*, 2018). Il peut être déployé en soins primaires, en pharmacie, dans des zones sans ophtalmologue.
</details>

---

**Q2.** Quelle est la principale limite éthique des algorithmes d'IA appliqués au dépistage en diabétologie ?

a) Ils sont trop coûteux pour les hôpitaux
b) Ils ne peuvent analyser que des images, pas des données biologiques
c) Les biais algorithmiques liés à la sous-représentation de certaines ethnies dans les données d'entraînement réduisent leurs performances dans ces populations
d) Ils sont interdits par le RGPD

<details><summary>💡 Réponse</summary>

**c)** Les biais algorithmiques constituent la limite éthique majeure : si les données d'entraînement ne sont pas représentatives de la diversité des populations (ethnies, âges, sexes, niveaux socio-économiques), les algorithmes sont moins performants dans les groupes sous-représentés — reproduisant et amplifiant les inégalités de santé existantes. Ce problème est documenté pour IDx-DR et les systèmes d'analyse CGM. Le RGPD encadre les données (réponse d) mais ne les interdit pas.
</details>

---

**Q3.** Quelle molécule constitue le premier agoniste GLP-1 oral non peptidique (petite molécule) en phase 3 ?

a) Sémaglutide (Rybelsus®)
b) Tirzépatide (Mounjaro®)
c) Orforglipron (Eli Lilly)
d) Imeglimin (Twymeeg®)

<details><summary>💡 Réponse</summary>

**c)** L'orforglipron (Eli Lilly) est le premier agoniste GLP-1 oral non peptidique (petite molécule) à atteindre la phase 3. À la différence du sémaglutide oral (Rybelsus®) qui est un peptide nécessitant une prise à jeun stricte, l'orforglipron n'a aucune contrainte de prise (avec ou sans aliments). Les résultats de phase 2 montrent ↓ HbA1c -1,6 % et perte de poids -10 % à 26 semaines. Si la phase 3 est positive, il pourrait transformer radicalement l'accessibilité des aGLP-1 à l'échelle mondiale.
</details>

---

**Q4.** Selon l'IDF Diabetes Atlas 2024, quelle région du monde connaîtra la croissance de prévalence du diabète la plus forte entre 2021 et 2045 ?

a) Europe (+25 %)
b) Amérique du Nord (+35 %)
c) Asie du Sud-Est (+74 %)
d) Afrique (+134 %)

<details><summary>💡 Réponse</summary>

**d)** L'Afrique connaîtra la croissance projetée la plus explosive, avec +134 % entre 2021 et 2045. Cette croissance s'explique par l'urbanisation rapide, la transition nutritionnelle (abandon des régimes traditionnels riches en fibres), l'explosion de l'obésité, le vieillissement démographique, et — de façon préoccupante — le manque d'infrastructures de dépistage et de traitement pour absorber cette vague. Les systèmes de santé africains, déjà sous tension, seront confrontés à un défi considérable.
</details>

---

**Q5.** Quel est le mécanisme d'action du tirzépatide (Mounjaro®) qui explique son efficacité supérieure aux aGLP-1 mono-agonistes ?

a) Inhibition de la DPP-4 plus puissante que les gliptines
b) Double agonisme GIP/GLP-1 : potentialisation synergique sur la sécrétion d'insuline, la satiété et le métabolisme lipidique
c) Inhibition du SGLT2 en plus du GLP-1
d) Action directe sur les récepteurs glucagon → lipolyse accrue

<details><summary>💡 Réponse</summary>

**b)** Le tirzépatide est un double agoniste GIP/GLP-1 (co-agoniste). L'activation simultanée des récepteurs GIP (glucose-dependent insulinotropic polypeptide) et GLP-1 produit un effet synergique sur la sécrétion d'insuline glucose-dépendante, la réduction de la glucagonémie, la vidange gastrique ralentie, et la satiété centrale. Cette synergie explique une efficacité glycémique (↓ HbA1c jusqu'à -2,1 %) et pondérale (-15 à -21 kg) significativement supérieure aux aGLP-1 mono-agonistes dans les essais de phase 3 (programme SURPASS).
</details>

---

**Q6.** Un enfant DT1 de 8 ans naît dans un pays où l'insuline n'est pas disponible de façon fiable. Quelle est son espérance de vie sans accès à l'insuline, et quelles sont les solutions concrètes disponibles ?

a) Il vivra avec un diabète mal équilibré mais survivra grâce au régime seul
b) Son espérance de vie est < 1 an sans insuline — les solutions passent par l'OMS, les biosimilaires, les ONG et les programmes d'accès type Life for a Child
c) Le glucagon peut remplacer l'insuline en traitement de fond
d) Les médicaments oraux (metformine) peuvent contrôler le DT1

<details><summary>💡 Réponse</summary>

**b)** Sans insuline, un enfant DT1 décède en quelques semaines à mois d'acidocétose diabétique incontrôlée — l'espérance de vie est estimée à < 1 an dans les pays à faible revenu où l'insuline n'est pas accessible (IDF, Lancet Diabetes Endocrinol). Les solutions mobilisables : (1) pré-qualification OMS des biosimilaires d'insuline pour réduire les coûts ; (2) programme « Life for a Child » (IDF Foundation) — fourniture directe d'insuline aux enfants dans les PED ; (3) inscription sur la liste OMS des médicaments essentiels et advocacy gouvernemental ; (4) développement d'insulines thermostables (ne nécessitant pas de chaîne du froid) ; (5) formation des soignants locaux au diagnostic et à la gestion du DT1.
</details>

---

## Références bibliographiques — Partie 10

1. Insel RA, Dunne JL, Atkinson MA et al. « Staging presymptomatic type 1 diabetes. » *Diabetes Care*, 2015; 38(10): 1964-1974.
2. Herold KC, Bundy BN, Long SA et al. (TrialNet TN-10). « An anti-CD3 antibody, teplizumab, in relatives at risk for type 1 diabetes. » *N Engl J Med*, 2019; 381(7): 603-613.
3. Waibel M, Wentworth JM, So M et al. « Baricitinib and β-cell function in patients with new-onset type 1 diabetes. » *N Engl J Med*, 2023; 389(23): 2140-2150.
4. Shapiro AMJ, Lakey JRT, Ryan EA et al. « Islet transplantation in seven patients with type 1 diabetes mellitus. » *N Engl J Med*, 2000; 343(4): 230-238.
5. Shapiro AMJ, Thompson D, Donner TW et al. « Insulin expression and C-peptide in type 1 diabetes subjects implanted with stem cell-derived fully differentiated islet cells. » *Cell Rep Med*, 2023; 4(7): 101120.
6. Pagliuca FW, Millman JR, Gürtler M et al. « Generation of functional human pancreatic β cells in vitro. » *Cell*, 2014; 159(2): 428-439.
7. Abràmoff MD, Lavin PT, Birch M et al. « Pivotal trial of an autonomous AI-based diagnostic system for detection of diabetic retinopathy. » *npj Digital Medicine*, 2018; 1: 39.
8. Lincoff AM, Brown-Frandsen K, Colhoun HM et al. (SELECT). « Semaglutide and cardiovascular outcomes in obesity without diabetes. » *N Engl J Med*, 2023; 389(24): 2221-2232.
9. International Diabetes Federation. *IDF Diabetes Atlas*, 10th edition, 2024. Brussels, Belgium.
10. Patterson CC, Harjutsalo V, Rosenbauer J et al. « Trends and cyclical variation in the incidence of childhood type 1 diabetes in 26 European centres. » *Lancet Diabetes Endocrinol*, 2019; 7(11): 850-863.

---

> 🔶 **DIABÉTOLOGIE** | Partie 10/12 — P2 | Modules 36-37-38
> *Plateforme VERTEX© — Formation Diabétologie Complète*
