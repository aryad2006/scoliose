# FORMATION DIABÉTOLOGIE — PARTIE VII : TRAITEMENT DU DT1

# MODULE 23 : TECHNOLOGIES DU DIABÈTE — CGM, Pompe à Insuline, Boucle Fermée

**Partie** : VII — Traitement du DT1
**Durée estimée** : 3h30
**Niveau** : Intermédiaire → Avancé
**Prérequis** : Module 22

---

## Accroche clinique

> 🏥 **Mise en situation** : Emma, 14 ans, DT1 depuis 5 ans, est passée sous boucle fermée hybride il y a 8 mois. Son endocrinologue pédiatrique note une HbA1c à 7,1 % (contre 8,9 % sous injections) avec un TIR de 72 % et un TBR < 2 %. Ses parents rapportent un « changement de vie » : plus de glycémies capillaires nocturnes, moins de stress, meilleure qualité de sommeil pour toute la famille. *Les technologies du diabète ont transformé le pronostic du DT1. La boucle fermée hybride est le progrès thérapeutique le plus significatif depuis la découverte de l'insuline par Banting et Best en 1921.*

---

## Objectifs d'apprentissage

À l'issue de ce module, le praticien sera capable de :

1. **Connaître** les systèmes de mesure continue du glucose (CGM) : types, précision, métriques standardisées
2. **Interpréter** un profil ambulatoire du glucose (AGP) et identifier les patterns d'action
3. **Prescrire** et suivre une pompe à insuline (CSII) : indications, programmation, complications
4. **Comprendre** les algorithmes de boucle fermée hybride (AID) et les différences entre systèmes
5. **Connaître** les innovations émergentes : pancréas bihormonaux, insulines intelligentes, capteurs implantables

---

## 23.1 — Mesure continue du glucose (CGM) : principes et métriques

> 🤔 **Question de réflexion** : La glycémie capillaire ponctuée fournit une « photographie » du glucose à un instant T. La mesure continue du glucose en fournit le « film » complet sur 24h. En quoi ce changement de paradigme transforme-t-il fondamentalement l'analyse et les décisions thérapeutiques ? Et pourquoi le TIR est-il un meilleur indicateur du contrôle glycémique que la seule HbA1c ?

### 23.1.1 — Principes techniques des CGM

Le CGM mesure le **glucose interstitiel sous-cutané** (et non la glycémie sanguine) via un micro-capteur enzymatique implanté en sous-cutané :

- **Capteur électrochimique** (majoritaire) : enzyme glucose-oxydase catalyse l'oxydation du glucose → courant électrique proportionnel à la concentration de glucose
- **Capteur à fluorescence** (Eversense) : molécule fluorescente dont le signal varie selon la concentration en glucose

**Décalage physiologique (lag time)** : le glucose interstitiel reflète la glycémie sanguine avec un délai de **5-15 min** (temps de diffusion du glucose du sang vers le tissu interstitiel). Ce décalage est cliniquement important lors des variations rapides (repas, correction rapide) — le CGM peut surestimer une hypoglycémie en cours de remontée ou sous-estimer un pic post-prandial encore en montée.

### 23.1.2 — Types de systèmes CGM disponibles

**CGM en temps réel (rtCGM) :**
- Transmission continue des données (toutes les 1-5 min) vers récepteur/smartphone + **alarmes programmables** (hypoglycémie, hyperglycémie, vitesse de variation → flèches de tendance)
- **Dexcom G7** : durée 10 jours + 12h de grâce ; MARD ~8,2 % ; compatible boucle fermée (Omnipod 5, t:slim X2) ; partage en temps réel (application Dexcom Follow)
- **Medtronic Guardian 4** : compatible MiniMed 780G (boucle fermée) ; calibration non nécessaire

**Lecteur flash (isCGM — intermittently scanned CGM) :**
- Données disponibles **uniquement lors du scan** du capteur (NFC) sauf activation des alarmes
- **FreeStyle Libre 2** (Abbott) : durée 14 jours ; MARD ~9,2 % ; alarmes optionnelles
- **FreeStyle Libre 3** : durée 14 jours ; MARD ~7,9 % ; le plus petit capteur disponible (~taille d'une pièce de 5 centimes) ; fonctionnalité rtCGM (transmission automatique sans scan)

**CGM implantable :**
- **Eversense E3** (Senseonics) : capteur implantable sous-cutané (bras) → durée **6 mois** ; MARD ~8,5 % ; avantage pour les patients avec irritations cutanées aux adhésifs ; nécessite une procédure ambulatoire d'implantation

> [MEDIA: 🖥️ MDIAB23-S01-001 — COMPARATIF CGM DISPONIBLES (Dexcom G7, FreeStyle Libre 3, Guardian 4, Eversense E3 — taille, durée, MARD, alarmes, compatibilité boucle fermée)]

### 23.1.3 — Métriques CGM standardisées : le consensus international

Le consensus international (*Battelino et al., Diabetes Care, 2019*) a standardisé les métriques CGM et leurs cibles pour le DT1 :

| Métrique | Définition | Cible DT1 |
|---|---|---|
| **TIR** | Time In Range 70-180 mg/dL | **≥ 70 %** |
| **TBR < 70** | Time Below Range < 70 mg/dL | **< 4 %** |
| **TBR < 54** | Time Below Range < 54 mg/dL | **< 1 %** |
| **TAR > 180** | Time Above Range > 180 mg/dL | **< 25 %** |
| **TAR > 250** | Time Above Range > 250 mg/dL | **< 5 %** |
| **GMI** | Glucose Management Indicator (estimation HbA1c) | Personnalisé |
| **CV** | Coefficient de variation (variabilité) | **≤ 36 %** |

> 💡 **Astuce clinique** : Un CV > 36 % signale une instabilité glycémique majeure. Dans ce cas, la **priorité clinique est de réduire les hypoglycémies** (TBR) — avant de chercher à améliorer le TIR ou l'HbA1c. Tenter d'améliorer l'HbA1c d'un patient instable peut aggraver les hypoglycémies.

**Profil Ambulatoire du Glucose (AGP)** : représentation standardisée des données CGM sur 14 jours — courbe médiane (50e percentile) + bandes interquartiles (25e-75e) + percentiles extrêmes (10e-90e percentile). Permet d'identifier les **patterns** récurrents : hyperglycémie post-prandiale systématique, hypoglycémie nocturne, phénomène de l'aube, variabilité inter-journalière.

> [MEDIA: 📊 MDIAB23-S01-002 — PROFIL AGP ANNOTÉ (courbe médiane + percentiles, identification des patterns clés, métriques TIR/TBR/TAR en face)]

> [MEDIA: 📋 MDIAB23-S01-003 — OBJECTIFS CGM STANDARDISÉS (tableau des cibles TIR, TBR, TAR, CV, GMI — consensus Battelino 2019)]

**Indications remboursées (France, 2024) :** DT1 (tous les patients), DT2 sous ≥ 3 injections/jour ou pompe, diabète gestationnel (certains cas), instabilité glycémique documentée.

---

## 23.2 — Pompe à insuline (CSII) : de la prescription à la gestion des complications

> 🤔 **Question de réflexion** : La pompe à insuline supprime l'insuline basale sous-cutanée quotidienne au profit d'une perfusion continue d'insuline ultra-rapide. Pourquoi cette approche offre-t-elle une flexibilité impossible avec le schéma basal-bolus par injections ? Et quel risque spécifique cette absence de « réserve lente » sous-cutanée crée-t-elle en cas de panne ?

### 23.2.1 — Principe et types de pompes

La pompe à insuline (CSII — *Continuous Subcutaneous Insulin Infusion*) administre **uniquement de l'insuline ultra-rapide** (aspart, lispro ou faster aspart) via un cathéter sous-cutané :
- **Débit basal** : programmable heure par heure selon les besoins → reproduction fidèle du profil basal physiologique
- **Bolus à la demande** : calculés par le patient (calculateur de bolus intégré) pour les repas et les corrections
- Avantage majeur vs basal-bolus par injections : possibilité de programmer des profils basaux différents (nuit, week-end, jours de sport) et des débits temporaires (±% pendant x heures)

**Types de pompes disponibles (2024-2025) :**

*Pompes à tubulure (réservoir + tubulure + cathéter) :*
- **Medtronic MiniMed 780G** : algorithme SmartGuard, compatible Guardian 4 → système de boucle fermée
- **Tandem t:slim X2** : compatible Dexcom G7 → algorithme Control-IQ (boucle fermée)

*Pompes patch (sans tubulure, collées directement sur la peau) :*
- **Omnipod 5** (Insulet) : commandée par PDM ou smartphone, étanche, sans tubulure → liberté de mouvement, sport, natation ; compatible Dexcom G7 (boucle fermée SmartAdjust)
- **YpsoPump** (Ypsomed/mylife) : compatible boucle fermée CamAPS FX

> [MEDIA: 💉 MDIAB23-S02-001 — COMPARATIF POMPES À INSULINE (MiniMed 780G, t:slim X2, Omnipod 5, YpsoPump — caractéristiques, compatibilité CGM, indications)]

### 23.2.2 — Indications de la pompe à insuline

Recommandations HAS et ADA 2024 :
- HbA1c cible non atteinte malgré un schéma basal-bolus par injections optimisé
- **Hypoglycémies sévères** ou fréquentes (≥ 1 hypoglycémie sévère/an)
- Variabilité glycémique importante (**CV > 36 %**)
- Phénomène de l'aube marqué non corrigeable par la basale
- Mode de vie nécessitant une grande flexibilité (travail posté, sport de haut niveau, horaires irréguliers)
- **Grossesse** planifiée ou en cours chez DT1 (contrôle fin du débit basal)
- Enfants en bas âge (doses très faibles impossibles avec stylos standard — demi-unité minimum)

### 23.2.3 — Programmation et utilisation avancée

**Calcul du débit basal initial :**
- Débit de base = DTJ basale ÷ 24 = débit moyen (UI/h)
- Exemple : basale habituelle 18 UI/j → débit de base 0,75 UI/h
- Ajustement par tranches horaires : ↑ 4h-8h (phénomène de l'aube), ↓ 2h-4h du matin (si hypoglycémies nocturnes)

**Bolus étendus et combinés** : pour les repas riches en graisses et protéines (pizza, raclette, sushi) qui provoquent un pic glycémique retardé (2-4h après) → une partie du bolus immédiatement + le reste étalé sur 1-3h.

**Débits temporaires** : ↓ 20-50 % avant une activité physique (45-90 min avant) ; ↑ 20-30 % si hyperglycémie persistante sur maladie.

> [MEDIA: 📊 MDIAB23-S02-002 — PROGRAMMATION DÉBIT BASAL (profil 24h avec augmentation aube, réduction nuit profonde — comparaison profil basale by injections vs pompe)]

### 23.2.4 — Complications spécifiques de la pompe

> ⚠️ **Risque majeur spécifique à la pompe — ACD rapide en cas d'obstruction :**
> Contrairement au schéma basal-bolus, il n'y a **aucune réserve d'insuline lente** sous-cutanée avec la pompe. En cas d'obstruction du cathéter ou de déconnexion non remarquée, la glycémie monte en **2-4h** et l'acidocétose peut survenir en **6-12h** — sans symptômes de manque d'insuline long à s'installer. Le patient doit être formé à reconnaître ce risque et à changer le cathéter en urgence dès qu'une hyperglycémie inexpliquée survient.

Autres complications :
- Infections au site d'insertion du cathéter (prévention : changement cathéter toutes les 48-72h, technique aseptique)
- Dermatite de contact (adhésifs — essayer différentes marques, protection cutanée)
- Dysfonctions mécaniques (obstruction partielle → variabilité, alarme occlusion)
- Lipohypertrophies au site de perfusion continu → rotation des sites obligatoire

---

## 23.3 — Boucle fermée hybride (AID) : fonctionnement et résultats

> 🤔 **Question de réflexion** : Un algorithme de boucle fermée ajuste automatiquement le débit d'insuline selon la glycémie en temps réel — c'est le rêve du diabétologue depuis les années 1970. Pourquoi ce système est-il encore « hybride » en 2025 ? Qu'est-ce qui empêche techniquement de supprimer totalement l'annonce des repas ?

### 23.3.1 — Principe de la boucle fermée hybride

Le système AID (*Automated Insulin Delivery*) repose sur une triade :

**CGM** (glucose interstitiel en temps réel) → **Algorithme** (calcule l'ajustement de débit basal + corrections automatiques toutes les 5 min) → **Pompe** (exécute les modifications)

**Pourquoi « hybride » ?** La cinétique de l'insuline sous-cutanée est le facteur limitant : même avec les insulines ultra-rapides, le délai d'action est de 4-15 min et le pic de 30-90 min. Pour couvrir un pic post-prandial qui commence 15-20 min après l'ingestion, l'algorithme ne peut pas réagir suffisamment vite sans annonce préalable du repas. Le patient doit donc encore déclencher le bolus prandial lui-même — d'où le terme « hybride ».

La **boucle fermée complète** (« fully closed loop ») est l'objectif futur : algorithmes de détection automatique des repas (meal detection) + insulines intra-péritonéales ou ultra-rapides encore plus rapides.

### 23.3.2 — Systèmes de boucle fermée disponibles (2024-2025)

| Système | Pompe | CGM | Algorithme | Particularité |
|---|---|---|---|---|
| **Medtronic MiniMed 780G** | MiniMed 780G | Guardian 4 | SmartGuard | Cible personnalisable 100-120 mg/dL, auto-corrections toutes les 5 min |
| **Tandem t:slim X2 — Control-IQ** | t:slim X2 | Dexcom G7 | Prédictif (modèle) | Modes exercice et sommeil (cible plus stricte la nuit) |
| **Omnipod 5** | Omnipod 5 (patch) | Dexcom G7 | SmartAdjust | Cible personnalisable 110-150 mg/dL, pompe patch sans tubulure |
| **CamAPS FX** | YpsoPump / Dana | Dexcom G7 | MPC (Cambridge) | Validé dès 1 an et chez la femme enceinte DT1 (étude AiDAPT) |

> 💡 **Astuce clinique** : Le choix du système de boucle fermée dépend du profil du patient. Pour un enfant < 2 ans ou une femme enceinte DT1 → **CamAPS FX** est le seul système spécifiquement validé. Pour un adolescent sportif préférant la discrétion → **Omnipod 5** (pas de tubulure, natation). Pour un patient déjà sous t:slim ou MiniMed → continuité technologique.

### 23.3.3 — Résultats cliniques de la boucle fermée

Les essais randomisés contrôlés et études en vie réelle convergent :
- **↑ TIR de 10-15 %** en valeur absolue vs basal-bolus par injections ou pompe seule
- **↓ HbA1c de 0,3-0,5 %** (effet relatif, dépend de la valeur initiale)
- **↓ TBR** et hypoglycémies nocturnes — bénéfice majeur et constant
- **↓ Charge mentale et surveillance nocturne** — amélioration qualité de vie significative (étude ADAPT — Benhamou et al., *Lancet Digital Health*, 2024)
- Chez la femme enceinte DT1 : amélioration du TIR gestationnel + réduction des complications fœtales (étude AiDAPT — Stewart et al., *N Engl J Med*, 2023)

**Limites de la boucle fermée hybride :**
- Nécessité d'annoncer les repas (limitation fondamentale)
- Retard capteur-interstitiel lors de variations rapides (repas rapides, sport intense)
- Coût (systèmes non remboursés dans certains pays en 2024)
- Courbe d'apprentissage (quelques semaines avant d'optimiser les réglages)
- Dermatites de contact aux adhésifs (capteur + cathéter)

### 23.3.4 — Systèmes DIY (Do It Yourself)

Les systèmes DIY (OpenAPS, Loop, AndroidAPS) sont des algorithmes **open-source** développés par la communauté de patients (#WeAreNotWaiting) à partir de 2015. Bien que **non approuvés réglementairement**, ils sont utilisés par plus de **30 000 patients** dans le monde avec des résultats comparables aux systèmes commerciaux (études observationnelles). Le praticien peut être confronté à ces patients en consultation — connaissance et non-jugement sont nécessaires.

> [MEDIA: 🖥️ MDIAB23-S03-001 — SCHÉMA FONCTIONNEL BOUCLE FERMÉE HYBRIDE (CGM → algorithme → pompe → glucose → CGM — boucle avec annonce repas)]

> [MEDIA: 📊 MDIAB23-S03-002 — COMPARATIF RÉSULTATS BOUCLE FERMÉE vs INJECTIONS (TIR, TBR, TAR, HbA1c — données essais pivotaux)]

> [MEDIA: 📋 MDIAB23-S03-003 — COMPARATIF SYSTÈMES BOUCLE FERMÉE (780G, Control-IQ, Omnipod 5, CamAPS FX — algorithme, cible, CGM, pompe, indications)]

---

## 23.4 — Innovations : pancréas bihormonal et insulines intelligentes

- **Pancréas artificiel bihormonal** (iLet Bionic Pancreas — Beta Bionics) : double pompe insuline + glucagon → micro-glucagon automatique dès que la glycémie tend à descendre → meilleure correction des hypoglycémies vs boucle monohormonale. Limite : stabilité du glucagon en solution, coût.
- **Insuline « smart »** (glucose-responsive insulin) : activité proportionnelle au glucose ambiant (groupement phénylboronique) → libération augmentée si hyperglycémie, réduite si hypoglycémie. Stade préclinique avancé — potentiel révolutionnaire.
- **Insuline inhalée** (Afrezza®, USA) : délai ~1 min, pic 12-15 min → bolus prandiaux uniquement ; non commercialisée en Europe.

> [MEDIA: 🔮 MDIAB23-S04-001 — TIMELINE INNOVATIONS TECHNOLOGIQUES DIABÈTE (passé : seringue → stylo → pompe → CGM → boucle fermée → futur : bihormonaux, insuline smart, capteurs non invasifs)]

---

## MODULE 24 : ÉDUCATION THÉRAPEUTIQUE DU DT1 — Autonomisation et Qualité de Vie

**Partie** : VII — Traitement du DT1
**Durée estimée** : 2h30
**Niveau** : Fondamental → Intermédiaire
**Prérequis** : Modules 22-23

---

## Accroche clinique

> 🏥 **Mise en situation** : Julien, 22 ans, DT1 depuis 4 ans, a été hospitalisé 2 fois pour acidocétose en 6 mois. Il admet ne pas compter les glucides (« c'est trop compliqué »), injecter l'insuline « au feeling », et avoir abandonné le CGM (« ça bipe tout le temps et ça m'énerve »). Étudiant en droit, il dit que le diabète « ruine sa vie sociale ». *L'éducation thérapeutique n'est pas une option mais un droit du patient (loi HPST 2009) et une obligation du soignant. Un DT1 qui ne comprend pas sa maladie ne peut pas la gérer — quelle que soit la sophistication du traitement prescrit.*

---

## Objectifs d'apprentissage

À l'issue de ce module, le praticien sera capable de :

1. **Connaître** les principes de l'éducation thérapeutique du patient (ETP) selon l'OMS et la HAS
2. **Structurer** un programme d'ETP pour le DT1 : diagnostic éducatif, compétences visées, outils pédagogiques
3. **Enseigner** l'insulinothérapie fonctionnelle : comptage glucidique, calcul des ratios, FSI
4. **Former** à la gestion des urgences : hypoglycémie sévère (glucagon), acidocétose (sick day rules)
5. **Accompagner** le vécu psychologique : burnout du diabète, entretien motivationnel, qualité de vie

---

## 24.1 — Cadre et principes de l'ETP

> 🤔 **Question de réflexion** : Le traitement du DT1 optimal — boucle fermée, insulinothérapie fonctionnelle, CGM calibré — est totalement inutile si le patient ne le comprend pas et ne l'utilise pas. Comment structurer un programme éducatif qui respecte l'autonomie du patient adulte, s'adapte à son contexte de vie, et reste efficace à long terme ?

### 24.1.1 — Définition et cadre réglementaire

**Définition OMS (1998)** : l'ETP vise à aider les patients à acquérir ou maintenir les compétences dont ils ont besoin pour gérer au mieux leur vie avec une maladie chronique. Elle est centrée sur le patient — pas sur la maladie.

**Cadre réglementaire français** : loi HPST 2009 (article L.1161-1 CSP) — l'ETP fait partie intégrante de la prise en charge des maladies chroniques. Programmes autorisés par les ARS, dispensés par une équipe multidisciplinaire formée (40h minimum de formation en ETP), évaluation quadriennale obligatoire.

**Diagnostic éducatif (bilan éducatif partagé)** : première étape **obligatoire** de tout programme ETP — explorer avec le patient ses **connaissances** (ce qu'il sait), ses **croyances** (ce qu'il croit), son **vécu** (ce qu'il ressent), ses **ressources** (ce dont il dispose) et ses **freins** (ce qui bloque). L'objectif est de personnaliser le programme — pas de transmettre un contenu standardisé.

### 24.1.2 — Compétences visées dans l'ETP du DT1

Adapté du modèle d'Ivernois & Gagnayre (*Apprendre à éduquer le patient*, 6e éd., Maloine, 2020) :

**Compétences d'auto-soins :**
- Techniques d'injection correctes (rotation, longueur d'aiguille, zones)
- Adaptation des doses (ratio I/C, FSI, adaptation rétrospective)
- Comptage glucidique (3 niveaux)
- Surveillance glycémique (CGM : lecture, alarmes, AGP)
- Gestion de l'hypoglycémie et de l'hyperglycémie
- Adaptation à l'activité physique
- Sick day rules (journées de maladie)

**Compétences d'adaptation :**
- Gestion émotionnelle et psychologique (burnout, peur de l'hypoglycémie)
- Résolution de problèmes (situations imprévues, voyages, Ramadan)
- Communication avec l'entourage et le milieu professionnel
- Gestion sociale et administrative (PAI, permis de conduire, déclarations)

> 💡 **Astuce clinique** : Le diagnostic éducatif révèle souvent un **décalage entre les connaissances théoriques** du patient (il « sait » qu'il faut compter les glucides) et ses **compétences pratiques** (il ne sait pas les estimer en situation réelle). L'ETP doit travailler sur les compétences en situation — ateliers pratiques, mise en situation, pas uniquement des cours magistraux.

---

## 24.2 — Insulinothérapie fonctionnelle et comptage glucidique

### 24.2.1 — Programme d'insulinothérapie fonctionnelle

L'IF (insulinothérapie fonctionnelle) est l'approche éducative permettant au patient de calculer ses propres doses d'insuline — passant de doses fixes imposées à une autonomie de calcul réelle.

Programme standard sur **5 jours** (hospitalisation ou ambulatoire par demi-journées) :

- **Jours 1-2** : Détermination du débit de base — jeûne relatif (repas sans glucides ou glucides constants) + mesure glycémique toutes les 2h → vérifier l'adéquation de la basale (glycémie stable entre les repas = basale correcte)
- **Jours 3-4** : Détermination du ratio I/C par repas-test standardisé (repas à teneur en glucides précisément connue + suivi glycémique post-prandial à 2h) → si glycémie post-prandiale en cible → ratio validé
- **Jour 5** : Détermination du FSI (test de correction : glycémie élevée + dose de correction isolée → vérifier la descente prédite) + mise en situation (repas libre au restaurant → calcul et injection autonomes) + bilan éducatif

### 24.2.2 — Comptage glucidique : les 3 niveaux

- **Niveau 1** : reconnaître les aliments glucidiques (pain, riz, pâtes, pommes de terre, fruits, lait) vs non-glucidiques (viandes, poissons, légumes verts, graisses)
- **Niveau 2** : estimer visuellement les portions (tranche pain de mie = 15 g, bol riz cuit = 45 g) — photos de portions, applications Gluci-Check/MyFitnessPal
- **Niveau 3** : comptage précis — lecture étiquettes nutritionnelles, pesée ; niveau expert pour patients avec variabilité importante

> [MEDIA: 🍽️ MDIAB24-S02-001 — OUTIL VISUEL COMPTAGE GLUCIDIQUE (photos de portions courantes avec grammes de glucides annotés — pain, riz, pâtes, pommes de terre, fruits)]

> [MEDIA: 📋 MDIAB24-S02-002 — PROGRAMME IF SUR 5 JOURS (étapes, objectifs quotidiens, tests réalisés, résultats attendus)]

---

## 24.3 — Gestion des urgences et situations de vie quotidienne

### 24.3.1 — Resucrage de l'hypoglycémie : la règle des 15

**Définition** : hypoglycémie = glycémie < 0,70 g/L (quelle que soit la présence de symptômes).

**Protocole de resucrage (règle des 15)** :
1. **15 g de sucres rapides** : 3 morceaux de sucre n°4, ou 15 cl de jus de fruit sucré, ou 1 tube de gel de glucose (ex. Glucosport®)
2. **Attendre 15 minutes** sans manger d'autre aliment
3. **Contrôle glycémique** : si toujours < 0,70 g/L → recommencer le resucrage
4. Si glycémie normalisée et prochain repas > 1h → **collation mixte** (glucides lents + protéines : pain + fromage)

**Ne jamais utiliser** : chocolat (graisses retardent l'absorption des glucides), pain seul, jus de légumes (glucides insuffisants).

### 24.3.2 — Glucagon d'urgence : éducation de l'entourage

Indiqué en cas **d'hypoglycémie sévère** (perte de connaissance, convulsions). Administré par **l'entourage** — pas le patient lui-même.

**Formes disponibles :**
- **Baqsimi®** (glucagon nasal 3 mg) : aucune reconstitution → le plus simple pour famille/école
- **Zegalogue®** (dasiglucagon SC auto-injecteur) : stylo SC prêt à l'emploi
- **GlucaGen HypoKit®** (glucagon IM/SC) : reconstitution (flacon + seringue) → moins adapté à l'urgence

> ⚠️ **Formation de l'entourage au glucagon = OBLIGATOIRE** (conjoint, parents, enseignants). Formation pratique indispensable — un seul membre formé est insuffisant.

### 24.3.3 — Scolarité, conduite et voyages

**PAI (Projet d'Accueil Individualisé)** : document réglementaire obligatoire pour tout enfant DT1 scolarisé. Précise : qui administre l'insuline ou le glucagon, où est stocké le matériel, protocole en cas d'hypo/hyperglycémie, accès à la cantine, participation aux activités sportives.

**Permis de conduire** : réglementation française (arrêté du 28 mars 2022) — déclaration obligatoire à la préfecture ; conditions de conduite : glycémie > 1,00 g/L avant de prendre le volant, resucrage dans le véhicule, arrêt en cas de symptômes, glycémie toutes les 2h sur longs trajets. Contre-indication temporaire si hypoglycémies sévères récurrentes (< 3 mois).

**Voyages** : certificat médical bilingue (matériel médical en cabine), insuline en bagage cabine uniquement (risque de gel en soute), stylos en cours d'utilisation → conservation à température ambiante < 30°C pendant 4-8 semaines (selon la molécule).

---

## 24.4 — Vécu psychologique et qualité de vie

> 🤔 **Question de réflexion** : Le DT1 impose 200-300 décisions par jour liées à la maladie (Johnson, 2023). Cette charge mentale permanente est invisible pour l'entourage et souvent sous-estimée en consultation. Comment identifier le burnout du diabète avant que l'HbA1c ne soit le seul signal d'alarme ?

**Burnout du diabète** : épuisement cognitif et émotionnel → désengagement progressif (moins de surveillance, doses fixes) → dégradation de l'équilibre → culpabilité → cercle vicieux. Fréquence : 40-50 % des DT1 sur la vie entière.

**Obstacles à l'observance** : peur de l'hypoglycémie (HFS), stigmatisation sociale (alarmes CGM en public), surprotection parentale, lassitude de la chronicité.

**Outils de mesure de la qualité de vie :**
- **PAID** (Problem Areas In Diabetes, 20 items) : score ≥ 40 → détresse significative → orientation psychologue
- **WHO-5** (5 items) : dépistage rapide de la dépression
- **HFS** (Hypoglycemia Fear Survey) : peur de l'hypoglycémie

**Interventions :**
- **Entretien motivationnel** (Miller & Rollnick) : explorer l'ambivalence sans jugement → plus efficace que l'approche prescriptive pour l'observance à long terme
- **Thérapie ACT** : accepter l'instabilité glycémique inévitable, agir selon ses valeurs
- **Groupes de pairs** : AJD (Association des Jeunes Diabétiques), FFD — normalisation de l'expérience, modèles positifs → à recommander systématiquement
- **Soutien psychologique** : psychologue formé au diabète, travailleur social si besoins médico-sociaux

> [MEDIA: 📋 MDIAB24-S04-001 — PARCOURS ETP DU DT1 (diagnostic éducatif → programme initial → suivi → renforcement — acteurs et outils à chaque étape)]

> [MEDIA: 📊 MDIAB24-S04-002 — QUESTIONNAIRE PAID ABRÉGÉ (5 items, scoring, seuils d'alerte — à utiliser en consultation de routine)]

---

## Points clés — Modules 23 & 24

> 🎯 **Essentiel à retenir — Modules 23 & 24**
> 1. CGM : glucose interstitiel (décalage 5-15 min) ; rtCGM (alarmes) vs isCGM (scan) ; TIR ≥ 70 %, TBR < 4 %, CV ≤ 36 % (Battelino, 2019)
> 2. CV > 36 % → priorité TBR (hypoglycémies) avant HbA1c
> 3. Pompe : débit basal programmable heure/heure ; risque ACD en 6-12h si obstruction cathéter
> 4. Boucle fermée hybride : ↑ TIR 10-15 %, ↓ hypos, ↓ HbA1c 0,3-0,5 % ; CamAPS FX seul validé enceinte DT1 (AiDAPT)
> 5. ETP = droit du patient (HPST 2009) ; diagnostic éducatif = 1ère étape obligatoire
> 6. Insulinothérapie fonctionnelle : programme 5 jours → basale, ratio I/C, FSI → autonomie de calcul
> 7. Règle des 15 : 15 g sucres rapides → 15 min → contrôle → ± re-sucrage
> 8. Glucagon (Baqsimi® nasal, Zegalogue® SC) : formation entourage OBLIGATOIRE
> 9. PAI : obligatoire pour tout enfant DT1 scolarisé
> 10. Burnout du diabète : 200-300 décisions/jour → dépistage PAID systématique → entretien motivationnel

---

## Auto-évaluation — Modules 23 & 24

**Q1.** Quelle est la cible de TIR (Time In Range, 70-180 mg/dL) recommandée dans le DT1 (consensus Battelino 2019) ?
a) ≥ 50 %
b) ≥ 70 %
c) ≥ 90 %

<details><summary>💡 Réponse</summary>

**b)** La cible TIR est ≥ 70 % dans le DT1 (consensus Battelino et al., *Diabetes Care*, 2019). Un TIR de 70 % correspond approximativement à une HbA1c de 7 %. La cible TBR doit être < 4 % (glycémie < 70 mg/dL) et < 1 % pour les valeurs < 54 mg/dL.
</details>

---

**Q2.** Pourquoi la boucle fermée est-elle qualifiée d'« hybride » en 2025 ?
a) Car elle utilise deux types d'insuline différents
b) Car le patient doit encore annoncer les repas et déclencher les bolus prandiaux manuellement
c) Car elle combine un CGM et un lecteur capillaire

<details><summary>💡 Réponse</summary>

**b)** La boucle fermée est « hybride » car l'algorithme ajuste automatiquement le débit basal et les corrections, mais le patient doit annoncer les repas et déclencher les bolus. La limite est la cinétique de l'insuline SC : même avec les ultra-rapides, le délai d'action (4-15 min) et le pic (30-90 min) sont trop lents pour couvrir un pic post-prandial débutant 15-20 min après l'ingestion sans annonce préalable.
</details>

---

**Q3.** Quel risque spécifique à la pompe à insuline n'existe pas avec le schéma basal-bolus par injections ?
a) Hypoglycémie sévère
b) Acidocétose rapide en 6-12h en cas d'obstruction du cathéter (absence de réserve basale SC)
c) Lipohypertrophies au site d'injection

<details><summary>💡 Réponse</summary>

**b)** La pompe n'utilise que de l'insuline ultra-rapide — il n'y a aucune réserve d'insuline lente sous-cutanée. En cas d'obstruction du cathéter ou de déconnexion non remarquée, la glycémie monte en 2-4h et l'ACD peut s'installer en 6-12h, potentiellement sans les signes avant-coureurs habituels. C'est un point éducatif majeur à transmettre à chaque patient appareillé avec une pompe.
</details>

---

**Q4.** Quel système de boucle fermée hybride est spécifiquement validé chez la femme enceinte DT1 et dès l'âge de 1 an ?
a) Medtronic MiniMed 780G (SmartGuard)
b) Tandem t:slim X2 Control-IQ
c) CamAPS FX

<details><summary>💡 Réponse</summary>

**c)** CamAPS FX (algorithme MPC de l'Université de Cambridge, compatible YpsoPump ou Dana) est le seul système de boucle fermée hybride spécifiquement étudié et validé chez la femme enceinte DT1 (étude AiDAPT — Stewart et al., *N Engl J Med*, 2023) et approuvé dès l'âge de 1 an. Les autres systèmes ont des limites d'âge plus restrictives et ne disposent pas de données solides chez la femme enceinte.
</details>

---

**Q5.** Un patient DT1 a un CV glycémique de 42 % (cible ≤ 36 %) et une HbA1c à 7,2 %. Quelle est la priorité thérapeutique ?
a) Augmenter les doses d'insuline pour améliorer l'HbA1c
b) Réduire la variabilité et les hypoglycémies (TBR) avant de viser une HbA1c plus basse
c) Passer immédiatement à une boucle fermée hybride

<details><summary>💡 Réponse</summary>

**b)** Un CV > 36 % indique une instabilité glycémique significative. Dans ce cas, augmenter les doses pour améliorer l'HbA1c risque d'aggraver les hypoglycémies. La priorité est de **réduire la variabilité** et le TBR (hypoglycémies). Une fois la variabilité contrôlée, l'HbA1c s'optimise plus facilement et en toute sécurité. La boucle fermée peut être une option thérapeutique à discuter, mais pas nécessairement en urgence.
</details>

---

**Q6.** Quelle est la règle des 15 pour le traitement d'une hypoglycémie (glycémie < 0,70 g/L) ?
a) 15 UI d'insuline rapide + attendre 15 min
b) 15 g de sucres rapides → attendre 15 min → contrôle glycémique → ± re-sucrage
c) 15 cl de lait demi-écrémé + 15 min de repos

<details><summary>💡 Réponse</summary>

**b)** La règle des 15 : 15 g de sucres rapides (3 morceaux de sucre, 15 cl de jus de fruit, 1 gel de glucose) → attendre 15 min (ne pas manger d'autre aliment entretemps) → contrôle glycémique → si toujours < 0,70 g/L → nouveau resucrage. Si glycémie normalisée et prochain repas > 1h → collation complexe (glucides lents + protéines) pour éviter une rechute hypoglycémique.
</details>

---

**Q7.** Qu'est-ce que le PAI et dans quel contexte est-il obligatoire ?
a) Un Plan d'Adaptation à l'Insuline — pour les patients sous pompe
b) Un Projet d'Accueil Individualisé — document réglementaire obligatoire pour la scolarisation de tout enfant DT1
c) Un Programme d'Accompagnement Individuel — pour les patients en ETP ambulatoire

<details><summary>💡 Réponse</summary>

**b)** Le PAI est un document réglementaire signé par les parents, le médecin scolaire et le directeur d'établissement. Il précise : les modalités d'administration de l'insuline en milieu scolaire, le stockage du matériel, le protocole en cas d'hypoglycémie ou d'hyperglycémie, l'accès à la cantine, les activités sportives autorisées, et qui administrer le glucagon en cas d'urgence. Il est obligatoire pour tout enfant DT1 scolarisé.
</details>

---

**Q8.** Un praticien reçoit en consultation Julien (22 ans, DT1, HbA1c 9,5 %, 2 ACD, abandonne le CGM et compte « au feeling »). Quelle est la 1ère étape de la prise en charge éducative ?
a) Lui prescrire immédiatement un programme d'IF de 5 jours
b) Réaliser le diagnostic éducatif : comprendre ses freins, son vécu, ses représentations du diabète et ses projets de vie
c) Lui expliquer les risques des ACD répétées pour le motiver

<details><summary>💡 Réponse</summary>

**b)** La 1ère étape est le **diagnostic éducatif** — avant toute prescription de programme éducatif. Il s'agit de comprendre pourquoi Julien abandonne le CGM (alarmes ? esthétique ? charge mentale ?), pourquoi il ne compte pas les glucides (complexité ? représentation négative ?), quel est son vécu du diabète (stigmatisation sociale ? dépression ? burnout ?). Sans ce diagnostic, tout programme proposé risque de ne pas correspondre à ses besoins réels. L'entretien motivationnel permet cette exploration sans jugement.
</details>

---

## Références bibliographiques — Partie 7

1. Riddle MC, Bolli GB, Ziemen M et al. (EDITION). « New insulin glargine 300 units/mL versus glargine 100 units/mL in people with type 2 diabetes using basal and mealtime insulin. » *Diabetes Care*, 2014; 37(10): 2755-2762.
2. Lane W, Bailey TS, Gerber R et al. (SWITCH 1). « Effect of insulin degludec vs insulin glargine U100 on hypoglycemia in patients with type 1 diabetes. » *JAMA*, 2017; 318(1): 33-44.
3. Rosenstock J, Bajaj HS, Janež A et al. (ONWARDS 1). « Once-weekly insulin icodec for treatment-naive type 2 diabetes. » *N Engl J Med*, 2023; 389(4): 297-308.
4. Frid AH, Kreugel G, Grassi G et al. (FITTER). « New insulin delivery recommendations. » *Mayo Clin Proc*, 2016; 91(9): 1231-1255.
5. Battelino T, Danne T, Bergenstal RM et al. « Clinical targets for continuous glucose monitoring data interpretation: recommendations from the International Consensus on Time in Range. » *Diabetes Care*, 2019; 42(8): 1593-1603.
6. Benhamou PY, Franc S, Reznik Y et al. (ADAPT). « Closed-loop insulin delivery versus sensor-augmented pump therapy in adults with type 1 diabetes. » *Lancet Digital Health*, 2024; 6(1): e27-e35.
7. Stewart ZA, Wilinska ME, Hartnell S et al. (AiDAPT). « Closed-loop insulin delivery during pregnancy in women with type 1 diabetes. » *N Engl J Med*, 2023; 389(8): 689-698.
8. Hassanein M, Al-Arouj M, Hamdy O et al. (IDF-DAR). « Diabetes and Ramadan: practical guidelines. » *Diabetes Res Clin Pract*, 2017; 126: 303-316.
9. d'Ivernois JF, Gagnayre R. *Apprendre à éduquer le patient : approche pédagogique.* 6e éd. Paris: Maloine, 2020.

---

> 🔶 **DIABÉTOLOGIE** | Partie 7/12 — Modules 22, 23, 24 | Couleur : Bleu pétrole `#1A5276`
> *Document généré pour la plateforme VERTEX© — Formation Diabétologie Complète*
