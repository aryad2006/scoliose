# MODULE 3 : PHYSIOLOGIE DE LA SÉCRÉTION D'INSULINE ET DU GLUCAGON — Couplage Stimulus-Sécrétion, Incrétines et Contre-Régulation

**Partie** : I — Fondamentaux
**Durée estimée** : 3h30
**Niveau** : Fondamental à intermédiaire
**Prérequis** : Modules 1 et 2 (embryologie pancréatique, architecture des îlots, biologie de la cellule β)

---

## Accroche clinique

> 🏥 **Mise en situation** : M. R., 72 ans, diabétique de type 2 sous gliclazide 60 mg (sulfamide hypoglycémiant), est retrouvé confus à 2 heures du matin par son épouse. La glycémie capillaire affiche 0,38 g/L (2,1 mmol/L). Aux urgences, après resucrage intraveineux, le patient récupère mais l'équipe de garde s'interroge : *« Pourquoi l'insuline continue-t-elle d'être sécrétée alors que la glycémie est dangereusement basse ? Le pancréas ne devrait-il pas couper la production d'insuline quand le glucose chute ? »*
>
> Pour comprendre cette situation — et pourquoi les sulfamides sont capables de « court-circuiter » la protection physiologique contre l'hypoglycémie — il faut maîtriser le couplage stimulus-sécrétion de la cellule β, le rôle central des canaux K~ATP~, la cinétique biphasique de la sécrétion d'insuline, l'effet incrétine et la hiérarchie de la contre-régulation glycémique.

## Objectifs d'apprentissage

À l'issue de ce module, le praticien sera capable de :

1. **Décrire** le mécanisme complet du couplage stimulus-sécrétion de la cellule β, du transport du glucose à l'exocytose des granules d'insuline
2. **Expliquer** le fonctionnement des canaux K~ATP~ (Kir6.2/SUR1) et les conséquences de leurs mutations (diabète néonatal, hyperinsulinisme congénital)
3. **Distinguer** la première et la deuxième phase de sécrétion d'insuline et comprendre la signification clinique de la perte de la première phase
4. **Analyser** l'effet incrétine (GLP-1, GIP) et ses applications thérapeutiques (analogues du GLP-1, inhibiteurs de la DPP-4, double agoniste GIP/GLP-1)
5. **Intégrer** la physiologie du glucagon et la hiérarchie de la contre-régulation pour comprendre les hypoglycémies iatrogènes et l'*hypoglycemia unawareness*

---

## 3.1 — Couplage stimulus-sécrétion : du glucose à l'exocytose d'insuline

> 🤔 **Question de réflexion** : Un nouveau-né présente des hypoglycémies sévères récurrentes dès les premières heures de vie, avec un taux d'insuline plasmatique paradoxalement élevé. Le diagnostic d'hyperinsulinisme congénital est posé. Si le mécanisme normal de sécrétion d'insuline est parfaitement couplé au taux de glucose, comment une cellule β peut-elle « ignorer » une glycémie basse et continuer à sécréter de l'insuline ?

La cellule β pancréatique est un véritable **senseur métabolique** : elle ne détecte pas le glucose par un récepteur membranaire classique, mais en le métabolisant elle-même. C'est le flux métabolique intracellulaire du glucose qui génère le signal déclencheur de la sécrétion d'insuline — un mécanisme élégant qui assure un couplage proportionnel entre la glycémie ambiante et la quantité d'insuline libérée.

### 3.1.1 — Entrée du glucose : les transporteurs GLUT

Le glucose pénètre dans la cellule β par **diffusion facilitée** via des transporteurs membranaires de la famille GLUT. Chez l'humain, le transporteur principal est **GLUT1** (avec une contribution de GLUT3), tandis que chez le rongeur, c'est **GLUT2** qui domine. Cette distinction est importante car la majorité de la littérature expérimentale provient de modèles murins — l'extrapolation directe à l'humain nécessite de garder cette différence à l'esprit.

Ces transporteurs sont des **protéines passives** : ils ne consomment pas d'énergie et équilibrent rapidement la concentration intracellulaire de glucose avec la concentration extracellulaire. Le glucose entre donc dans la cellule β à un débit proportionnel à la glycémie plasmatique. Le transport lui-même n'est pas l'étape limitante du couplage stimulus-sécrétion — c'est l'étape suivante, la phosphorylation par la glucokinase, qui joue ce rôle critique.

> 📖 **Approfondissement** : Chez le rongeur, GLUT2 a un Km élevé (~17 mM), ce qui signifie que le transport reste proportionnel au glucose dans la gamme physiologique et pathologique. Chez l'humain, GLUT1 a un Km plus bas (~3 mM) et est saturé à des glycémies physiologiques, mais l'expression combinée de GLUT1 et GLUT3 assure un flux d'entrée suffisant pour maintenir le couplage métabolique. Des mutations de *SLC2A2* (gène de GLUT2) causent le syndrome de Fanconi-Bickel (glycosurie rénale, hépatomégalie, retard de croissance) mais n'entraînent paradoxalement qu'un diabète modéré, confirmant que GLUT2 n'est pas le transporteur principal de la cellule β humaine (Santer et al., *Nat Genet*, 1997).

### 3.1.2 — La glucokinase : le « glucostat » de la cellule β

Une fois dans la cellule, le glucose est phosphorylé en glucose-6-phosphate (G6P) par la **glucokinase** (hexokinase IV). Cette enzyme est le véritable **capteur de glucose** de la cellule β — elle fonctionne comme un « glucostat » qui fixe le seuil de déclenchement de la sécrétion d'insuline.

La glucokinase possède des propriétés cinétiques uniques qui la distinguent des autres hexokinases :

| Propriété | Glucokinase (Hexokinase IV) | Hexokinases I-III |
|---|---|---|
| **Km pour le glucose** | ~8 mM (~1,44 g/L) | 0,01-0,1 mM |
| **Inhibition par le G6P** | Non | Oui (rétro-inhibition) |
| **Cinétique** | Sigmoïdale (coopérativité apparente, coefficient de Hill ~1,7) | Michaélienne classique |
| **Distribution** | Cellule β, hépatocyte, neurones hypothalamiques | Ubiquitaire |

Le Km élevé (~8 mM) signifie que la glucokinase n'est **saturée qu'à des glycémies élevées** : dans la gamme physiologique (4-10 mM), son activité augmente proportionnellement au glucose. L'absence d'inhibition par le G6P garantit que le flux métabolique reste fidèlement couplé à la concentration de glucose extracellulaire. La cinétique sigmoïdale confère au système une **sensibilité accrue** autour du seuil glycémique physiologique — une petite variation de glycémie autour de 5-8 mM entraîne un changement significatif de l'activité enzymatique et donc de la sécrétion d'insuline (Matschinsky, *Diabetes*, 2002).

> 🏥 **Pertinence clinique — Mutations de la glucokinase** :
> - **Mutations inactivatrices hétérozygotes** → **MODY2** : le Km de la glucokinase est « relevé » d'environ 2-3 mM. Le glucostat est réglé plus haut → hyperglycémie modérée et stable (5,5-8 mmol/L à jeun), ne nécessitant généralement aucun traitement car non progressive.
> - **Mutations inactivatrices homozygotes** → **Diabète néonatal permanent** : absence quasi totale de détection du glucose → diabète sévère dès la naissance.
> - **Mutations activatrices** → **Hyperinsulinisme congénital** : le Km est abaissé, la glucokinase est hyperactive même à glycémie basse → sécrétion inappropriée d'insuline → hypoglycémies récurrentes (Glaser et al., *N Engl J Med*, 1998).

> [MEDIA: 📐 MDIAB03-S01-001 — Courbe d'activité de la glucokinase vs hexokinases classiques en fonction de la glycémie : cinétique sigmoïdale, Km, effet des mutations MODY2 et mutations activatrices (Identifiez le seuil de glycémie auquel la sécrétion d'insuline est déclenchée et comment ce seuil est modifié dans les mutations)]

### 3.1.3 — Métabolisme mitochondrial et génération du signal ATP

Le G6P produit par la glucokinase entre dans la **glycolyse**, générant du pyruvate et un faible rendement d'ATP. Mais c'est le métabolisme mitochondrial qui produit la majeure partie du signal : le pyruvate entre dans le **cycle de Krebs** (via la pyruvate déshydrogénase et la pyruvate carboxylase), puis les équivalents réduits (NADH, FADH2) alimentent la **chaîne de phosphorylation oxydative**, produisant massivement de l'ATP.

Le résultat net est une **augmentation du ratio ATP/ADP** intracellulaire proportionnelle à la glycémie. Ce ratio constitue le signal métabolique qui va directement agir sur l'étape suivante du couplage : la fermeture des canaux K~ATP~.

Un détail important : la cellule β possède une particularité métabolique — elle exprime très peu de **lactate déshydrogénase** (LDH) et de **transporteurs de monocarboxylates** (MCT). Cela signifie que le pyruvate issu de la glycolyse est presque entièrement dirigé vers la mitochondrie plutôt que converti en lactate. Cette « canalisation mitochondriale » du pyruvate est essentielle pour un couplage stimulus-sécrétion efficace : si le pyruvate était dévié vers le lactate, le signal ATP serait atténué et la cellule β ne répondrait pas correctement au glucose (Sekine et al., *J Biol Chem*, 1994).

> 💡 **Astuce clinique — Chaîne métabolique complète** :
> Retenez la séquence en 5 étapes : (1) glucose entre via GLUT1 → (2) phosphorylation par la glucokinase (étape limitante) → (3) glycolyse → pyruvate → (4) cycle de Krebs + phosphorylation oxydative → (5) ↑ ATP/ADP. Chaque étape est proportionnelle à la glycémie. La glucokinase est le « gardien du seuil ».

### 3.1.4 — Canal K~ATP~ : le transducteur bioélectrique

Le canal K~ATP~ est le **pivot** de la transduction du signal métabolique en signal électrique. C'est un complexe hétéro-octamérique composé de deux sous-unités :

- **Kir6.2** (gène *KCNJ11*) : le pore ionique proprement dit, canal potassique à rectification entrante
- **SUR1** (gène *ABCC8*, *Sulfonylurea Receptor 1*) : la sous-unité régulatrice, qui contient les sites de liaison de l'ATP, de l'ADP et des sulfamides

Le fonctionnement est le suivant :

**Au repos (glycémie basse, ATP/ADP bas)** : le canal K~ATP~ est **ouvert**. Le potassium (K+) sort de la cellule selon son gradient électrochimique → la membrane est **hyperpolarisée** (environ -70 mV) → les canaux calciques voltage-dépendants sont fermés → pas de sécrétion d'insuline.

**En réponse au glucose (glycémie élevée, ↑ ATP/ADP)** : l'ATP se lie à Kir6.2 et **ferme** le canal K~ATP~ → le K+ ne sort plus → la membrane se **dépolarise** → ouverture des **canaux calciques voltage-dépendants** de type L → influx massif de Ca2+ → le calcium intracellulaire déclenche l'**exocytose** des granules d'insuline via la machinerie SNARE.

> ⚠️ **Danger — Mécanisme des hypoglycémies sous sulfamides** : Les sulfamides hypoglycémiants (gliclazide, glibenclamide, glimépiride) se lient au site SUR1 du canal K~ATP~ et le **ferment indépendamment du ratio ATP/ADP**. Cela signifie que la cellule β est « forcée » de sécréter de l'insuline même quand la glycémie est basse — le couplage glucose-sécrétion est court-circuité. C'est exactement ce qui s'est passé chez M. R. dans l'accroche clinique : à 2h du matin, sa glycémie était basse, mais le gliclazide maintenait les canaux K~ATP~ fermés → dépolarisation → sécrétion d'insuline → hypoglycémie sévère. Ce mécanisme est aggravé par l'insuffisance rénale (qui prolonge la demi-vie des sulfamides) et l'âge avancé.

> 🏥 **Pertinence clinique — Mutations des canaux K~ATP~** :
> Les mutations de *KCNJ11* (Kir6.2) et *ABCC8* (SUR1) sont responsables de deux pathologies « miroir » :
> - **Mutations activatrices** (canal reste ouvert) → la cellule β ne peut pas se dépolariser → pas de sécrétion d'insuline → **diabète néonatal**. Point remarquable : ces patients, longtemps traités par insuline injectable, peuvent souvent passer aux **sulfamides à haute dose** car les sulfamides ferment le canal par un mécanisme indépendant de l'ATP — ils contournent le défaut génétique (Pearson et al., *N Engl J Med*, 2006).
> - **Mutations inactivatrices** (canal reste fermé) → dépolarisation permanente → sécrétion continue d'insuline → **hyperinsulinisme congénital** (hypoglycémies néonatales sévères, parfois réfractaires au diazoxide, nécessitant une pancréatectomie subtotale).

> [MEDIA: 🎬 MDIAB03-S01-002 — Animation du couplage stimulus-sécrétion complet : entrée glucose → glucokinase → métabolisme mitochondrial → ↑ ATP/ADP → fermeture canal K~ATP~ → dépolarisation → influx Ca2+ → exocytose (Suivez le parcours du glucose et identifiez à quel niveau les sulfamides interviennent)]

> [MEDIA: 📐 MDIAB03-S01-003 — Canal K~ATP~ (Kir6.2/SUR1) : structure, sites de liaison de l'ATP et des sulfamides, effet des mutations activatrices vs inactivatrices (Comparez le canal normal, le canal muté « ouvert en permanence » du diabète néonatal, et le canal fermé par un sulfamide)]

### 3.1.5 — Exocytose et maturation de l'insuline

L'influx de calcium déclenche la fusion des **granules sécrétoires** avec la membrane plasmique via la machinerie **SNARE** (Soluble NSF Attachment Protein Receptor), un complexe protéique composé principalement de syntaxine-1A, SNAP-25 et VAMP2 (synaptobrévine). Ce mécanisme est remarquablement similaire à celui de l'exocytose des neurotransmetteurs au niveau synaptique — ce qui n'est pas surprenant compte tenu de l'origine neuroendocrine commune des cellules β et des neurones (lignage Ngn3, cf. Module 1).

Le contenu des granules sécrétoires mérite attention : la cellule β ne stocke pas directement l'insuline mature, mais sa forme précurseur, la **proinsuline**. La maturation s'effectue dans les granules sécrétoires par clivage protéolytique par les proprotéine convertases **PC1/3** et **PC2** :

**Proinsuline → Insuline (chaînes A et B reliées par ponts disulfure) + Peptide C**

Le **peptide C** (connecting peptide) est sécrété en quantité **équimolaire** avec l'insuline. Cette propriété en fait un marqueur précieux de la sécrétion endogène d'insuline : contrairement à l'insuline exogène (qui ne contient pas de peptide C), le dosage du peptide C permet d'évaluer la fonction résiduelle des cellules β chez un patient sous insulinothérapie. Un peptide C effondré confirme l'insulinopénie (DT1 avancé) ; un peptide C conservé oriente vers un DT2 ou un MODY.

> 📖 **Approfondissement** : L'amyline (IAPP, *Islet Amyloid Polypeptide*) est co-sécrétée avec l'insuline dans un ratio d'environ 1:100. Dans le DT2, l'amyline a tendance à former des **dépôts amyloïdes** dans l'îlot, contribuant à la toxicité β-cellulaire. Ces dépôts sont retrouvés chez >90% des patients DT2 à l'autopsie (Westermark et al., *Diabetologia*, 2011). Le pramlintide (analogue synthétique de l'amyline) est utilisé comme traitement adjuvant dans le DT1 et le DT2, ralentissant la vidange gastrique et réduisant l'excursion glycémique postprandiale.

✏️ **Micro-exercice** : Classez dans l'ordre les événements suivants du couplage stimulus-sécrétion :
- (A) Dépolarisation membranaire
- (B) Augmentation du ratio ATP/ADP
- (C) Phosphorylation du glucose par la glucokinase
- (D) Ouverture des canaux calciques voltage-dépendants
- (E) Fermeture des canaux K~ATP~

> *Réponse : C → B → E → A → D. La glucokinase phosphoryle le glucose (étape limitante), le métabolisme mitochondrial augmente le ratio ATP/ADP, l'ATP ferme les canaux K~ATP~, la cellule se dépolarise, puis les canaux calciques s'ouvrent et le Ca2+ déclenche l'exocytose.*

**Transition** : Le couplage stimulus-sécrétion explique *comment* la cellule β répond au glucose — mais cette réponse n'est pas monolithique. Elle se décompose en deux phases temporellement distinctes, dont la première est un marqueur précoce de dysfonction β-cellulaire dans le DT2.

---

## 3.2 — Cinétique biphasique de la sécrétion d'insuline

> 🤔 **Question de réflexion** : Un praticien réalise un test de tolérance au glucose intraveineux (IVGTT) chez deux patients. Le patient A présente un pic d'insuline rapide dans les 5 premières minutes, suivi d'une sécrétion soutenue. Le patient B ne montre aucun pic initial, seulement une montée lente et plate. Pourtant, les deux patients ont encore une HbA1c normale. Lequel est le plus à risque de développer un DT2 dans les 5 prochaines années ?

La sécrétion d'insuline en réponse à une stimulation glucosée ne se fait pas de manière linéaire et continue — elle suit un profil **biphasique** caractéristique, dont chaque phase a un mécanisme et une signification clinique distincts.

### 3.2.1 — Première phase : le pool rapidement libérable (RRP)

La **première phase** de sécrétion d'insuline survient dans les **5 à 10 premières minutes** suivant une stimulation glucosée brutale (comme un bolus intraveineux de glucose). Elle se manifeste par un **pic** aigu et transitoire de sécrétion d'insuline.

Ce pic provient de l'exocytose du **pool de granules rapidement libérable** (*Readily Releasable Pool*, RRP), constitué des granules d'insuline déjà « amarrées » (*docked*) à la membrane plasmique, prêtes à fusionner dès que le signal calcique est reçu. Le RRP ne représente qu'environ **1-5% du contenu total en granules** de la cellule β (~50-100 granules sur un stock de ~10 000), mais son rôle physiologique est capital.

La première phase a une fonction métabolique précise : elle **supprime rapidement la production hépatique de glucose**. Le foie produit en permanence du glucose (néoglucogenèse, glycogénolyse) pour maintenir la glycémie à jeun. Lors d'un repas, l'insuline de première phase envoie un signal rapide au foie pour « couper » cette production endogène — le glucose alimentaire absorbé prend le relais. Sans cette suppression rapide, la glycémie postprandiale s'élève excessivement car la production hépatique s'ajoute à l'absorption intestinale.

> 🔬 **Expert** : Le RRP est un concept fonctionnel qui recouvre des réalités morphologiques : les granules du RRP sont physiquement associées à la membrane par le complexe SNARE dans une configuration « prête à fusionner ». La reconstitution du RRP (re-priming) prend 2-5 minutes et dépend de facteurs comme Munc13-1, Rab3A et la phosphoinositide kinase. Des défauts dans ces protéines d'amarrage contribuent à la perte de première phase dans les modèles de DT2 (Gaisano, *Diabetes*, 2017).

### 3.2.2 — Deuxième phase : recrutement et néosynthèse

La **deuxième phase** débute après 10-15 minutes et se prolonge aussi longtemps que la stimulation glucosée persiste. Son amplitude est **proportionnelle** à l'intensité et à la durée du stimulus glycémique.

Elle repose sur deux mécanismes complémentaires :

1. **Recrutement du pool de réserve** : les granules d'insuline stockées dans le cytoplasme (pool de réserve, ~95% du stock total) sont mobilisées, transportées le long du cytosquelette d'actine et de microtubules vers la membrane, puis « amarrées » pour reconstituer continuellement le RRP.
2. **Néosynthèse d'insuline** : le glucose stimule la transcription du gène de l'insuline et la traduction de l'ARNm de la proinsuline, assurant le réapprovisionnement des granules sur les heures qui suivent.

La deuxième phase est responsable de la majorité de l'insuline sécrétée en réponse à un repas. Elle assure la **captation périphérique du glucose** (muscles, tissu adipeux) et le stockage des nutriments.

> [MEDIA: 📊 MDIAB03-S02-001 — Profil biphasique de la sécrétion d'insuline : courbe en réponse à un bolus IV de glucose, montrant la première phase (pic, 0-10 min) et la deuxième phase (plateau, >10 min), avec identification des pools de granules correspondants (Comparez le profil normal au profil d'un patient en stade pré-DT2 avec perte de la première phase)]

### 3.2.3 — Perte de la première phase : le signal d'alarme précoce du DT2

La **perte de la première phase** de sécrétion d'insuline est considérée comme l'**anomalie la plus précoce** de la fonction β-cellulaire dans l'évolution vers le DT2. Elle est détectable dès le stade d'intolérance au glucose (IGT, *Impaired Glucose Tolerance*), alors que l'HbA1c peut encore être dans les limites normales (Pratley & Weyer, *Diabetologia*, 2001).

Les conséquences de cette perte sont directes :
- Absence de suppression rapide de la production hépatique de glucose → **hyperglycémie postprandiale précoce**
- Surcharge de la deuxième phase (qui doit compenser) → épuisement progressif → déficit global
- Installation d'un cercle vicieux : hyperglycémie → glucotoxicité → aggravation du déficit sécrétoire

Le test de référence pour quantifier la première phase est le **test de tolérance au glucose intraveineux** (IVGTT), qui mesure l'**AIR** (*Acute Insulin Response*) — l'aire sous la courbe d'insulinémie dans les 10 premières minutes après le bolus IV de glucose. Un AIR abaissé chez un sujet à risque (antécédents familiaux de DT2, obésité, IGT) est un marqueur prédictif puissant de la progression vers le diabète franc.

> 💡 **Astuce clinique — Première phase et choix thérapeutique** :
> Certains traitements du DT2 « restaurent » partiellement la première phase : les **analogues rapides de l'insuline** (lispro, asparte, glulisine) injectés en préprandial miment la première phase perdue. Les **glinides** (répaglinide, natéglinide), sécrétagogues d'action rapide et courte, stimulent préférentiellement la première phase. À l'inverse, les sulfamides d'action longue (glibenclamide) stimulent les deux phases de manière indiscriminée, avec un risque d'hypoglycémie nocturne.

### 3.2.4 — Pulsatilité de la sécrétion d'insuline

Au-delà de la cinétique biphasique en réponse au repas, la sécrétion d'insuline présente une **pulsatilité intrinsèque** : des oscillations régulières avec une périodicité de **5 à 15 minutes**. Ces pulses résultent du couplage électrique entre cellules β via les jonctions gap (connexine 36, cf. Module 1) et des oscillations du métabolisme mitochondrial (cycles glycolytiques oscillants).

Cette pulsatilité n'est pas un artefact — elle a une **importance fonctionnelle majeure** : le foie répond mieux à l'insuline administrée de manière pulsatile qu'à une perfusion continue de même dose totale. Les récepteurs hépatiques de l'insuline subissent une « désensibilisation » (down-regulation) en cas d'exposition continue, alors que les pulses permettent une resensibilisation entre chaque pic.

Dans le DT2, la **perte de la pulsatilité** est un signe précoce de dysfonction β-cellulaire, souvent concomitant de la perte de la première phase. Cette observation a des implications pour les stratégies de remplacement insulinique : les pompes à insuline délivrant des micro-bolus rapprochés se rapprochent davantage de la pulsatilité physiologique que les injections sous-cutanées classiques.

> ⚖️ **Controverse — Pulsatilité et pompes à insuline** :
> Bien que la théorie suggère que reproduire la pulsatilité physiologique optimiserait l'efficacité de l'insulinothérapie, les essais cliniques comparant les pompes à insuline aux multi-injections n'ont pas montré de bénéfice dramatique lié spécifiquement à la pulsatilité. Le bénéfice des pompes provient surtout de la flexibilité de programmation des débits basaux et des bolus préprandiaux. La reproduction fidèle des oscillations de 5-15 minutes reste un défi technologique non résolu.

✏️ **Micro-exercice** : Un patient réalise un IVGTT. Le graphique montre un pic d'insuline normal dans les 5 premières minutes (AIR = 65 µU/mL·min), mais une deuxième phase très faible et plate.
1. Quel pool de granules est conservé ?
2. Quel est le mécanisme probable du déficit ?

> *Réponse : (1) Le RRP (pool rapidement libérable) est conservé → première phase normale. (2) Le déficit concerne le recrutement du pool de réserve : soit un défaut de transport intracellulaire des granules (dysfonction du cytosquelette), soit un défaut de néosynthèse de proinsuline (stress du réticulum endoplasmique), soit un épuisement du stock total de granules. Ce profil est moins fréquent que la perte isolée de première phase mais peut se voir dans les formes évoluées de DT2.*

**Transition** : Le glucose n'est pas le seul stimulus de la sécrétion d'insuline. La voie orale d'administration du glucose déclenche une réponse insulinique 2 à 3 fois supérieure à la voie intraveineuse — c'est l'effet incrétine, dont la compréhension a révolutionné la pharmacologie du DT2.

---

## 3.3 — Incrétines GLP-1 et GIP : l'axe entéro-insulaire

> 🤔 **Question de réflexion** : Deux volontaires sains reçoivent la même quantité de glucose (75 g). Le premier l'ingère par voie orale (HGPO). Le second le reçoit en perfusion intraveineuse, avec un ajustement du débit pour obtenir exactement la même courbe glycémique. Pourtant, le sujet qui a bu le glucose sécrète 2 à 3 fois plus d'insuline que celui qui l'a reçu en IV. Comment expliquer cette différence alors que la glycémie est identique ?

### 3.3.1 — L'effet incrétine : découverte et quantification

L'observation que la voie orale de glucose stimule davantage la sécrétion d'insuline que la voie intraveineuse à glycémie identique a été baptisée **effet incrétine** (*incretin effect*). Ce phénomène, quantifié rigoureusement par Nauck et al. (*J Clin Endocrinol Metab*, 1986) dans une expérience devenue classique (glucose oral vs glucose IV isoglycémique), démontre que **50 à 70% de la sécrétion postprandiale d'insuline** est attribuable à des facteurs intestinaux — les **incrétines** — et non au glucose seul.

Deux hormones intestinales rendent compte de la quasi-totalité de l'effet incrétine :
- Le **GLP-1** (*Glucagon-Like Peptide 1*), sécrété par les cellules L de l'iléon et du côlon
- Le **GIP** (*Glucose-dependent Insulinotropic Polypeptide*), sécrété par les cellules K du duodénum et du jéjunum proximal

L'effet incrétine est un mécanisme **d'amplification anticipatoire** : l'intestin « prévient » le pancréas qu'un repas arrive avant que le glucose n'ait significativement augmenté la glycémie. Cette anticipation optimise la réponse insulinique et limite l'excursion glycémique postprandiale — une forme de régulation « feed-forward » remarquablement efficace.

> [MEDIA: 📊 MDIAB03-S03-001 — Expérience de Nauck (1986) : courbes d'insulinémie en réponse au glucose oral vs IV isoglycémique, avec quantification de l'effet incrétine (50-70%) (Identifiez la surface entre les deux courbes qui représente la contribution des incrétines)]

### 3.3.2 — GLP-1 : l'incrétine thérapeutiquement dominante

Le **GLP-1** est sécrété par les cellules entéroendocrines de type L, situées principalement dans l'**iléon distal et le côlon**. Il est produit par clivage post-traductionnel du proglucagon (le même précurseur que le glucagon, mais clivé différemment par la PC1/3 intestinale vs la PC2 pancréatique).

Le GLP-1 possède un profil pharmacologique exceptionnel qui en fait la cible thérapeutique de choix :

**Actions pancréatiques** :
- **Stimulation de la sécrétion d'insuline** — mais uniquement de manière **glucose-dépendante** : le GLP-1 amplifie la réponse insulinique au glucose mais ne déclenche pas de sécrétion lorsque la glycémie est basse. Ce mécanisme élimine le risque d'hypoglycémie (contrairement aux sulfamides).
- **Suppression de la sécrétion de glucagon** — également glucose-dépendante. Le GLP-1 inhibe les cellules α, réduisant la production hépatique de glucose. Ce double effet (↑ insuline + ↓ glucagon) est synergique pour abaisser la glycémie.

**Actions extra-pancréatiques** :
- **Ralentissement de la vidange gastrique** : réduit la vitesse d'absorption du glucose → atténuation du pic glycémique postprandial
- **Effet satiétogène central** : action sur les récepteurs GLP-1R de l'hypothalamus et du tronc cérébral → réduction de l'appétit et de la prise alimentaire → perte de poids
- **Cardioprotection** : réduction des événements cardiovasculaires majeurs (MACE) démontrée pour le liraglutide (LEADER), le sémaglutide (SUSTAIN-6) et le dulaglutide (REWIND) — un bénéfice qui dépasse la simple amélioration glycémique (Drucker, *Cell Metab*, 2006 ; Marso et al., *N Engl J Med*, 2016)

> 💡 **Astuce clinique — GLP-1 = pas d'hypoglycémie** :
> Le caractère glucose-dépendant de l'action du GLP-1 est l'argument clé en pratique : quand la glycémie descend en dessous de ~4 mM, l'effet du GLP-1 sur la cellule β s'éteint spontanément. C'est pourquoi les analogues du GLP-1 (exénatide, liraglutide, sémaglutide, dulaglutide) et les inhibiteurs de la DPP-4 (sitagliptine, vildagliptine, saxagliptine, linagliptine) ne provoquent pas d'hypoglycémie en monothérapie — un avantage majeur sur les sulfamides et l'insuline exogène.

### 3.3.3 — GIP : le partenaire redécouvert

Le **GIP** est sécrété par les cellules K du **duodénum et du jéjunum proximal**, en réponse au glucose et aux lipides alimentaires. Historiquement, le GIP a été relégué au second plan car son effet insulinotrope est **atténué chez les patients DT2** (résistance au GIP), ce qui semblait limiter son intérêt thérapeutique.

Cependant, le GIP a connu un regain d'intérêt spectaculaire avec le **tirzépatide** (Mounjaro®), un **double agoniste GIP/GLP-1** qui a démontré une efficacité supérieure au sémaglutide seul sur la réduction de l'HbA1c et la perte de poids dans les essais SURPASS (Frías et al., *N Engl J Med*, 2021). Ce résultat suggère que la combinaison des deux voies incrétines produit un effet synergique, possiblement par des mécanismes complémentaires au niveau du tissu adipeux et du système nerveux central.

Une différence fondamentale avec le GLP-1 : le GIP **stimule** la sécrétion de glucagon (≠ GLP-1 qui l'inhibe). Cette action apparemment paradoxale pourrait avoir un rôle physiologique dans la mobilisation des réserves hépatiques en période interprandiale et dans la prévention de l'hypoglycémie.

> 🔬 **Expert** : Le récepteur du GIP (GIPR) est exprimé non seulement dans les cellules β et α, mais aussi dans le **tissu adipeux**, les **ostéoblastes** et le **système nerveux central**. L'activation du GIPR dans le tissu adipeux favorise le stockage lipidique et pourrait contribuer à un remodelage adipeux bénéfique (shift du tissu viscéral vers le tissu sous-cutané). Cette action extra-pancréatique pourrait expliquer une partie du bénéfice métabolique du tirzépatide au-delà de son effet incrétine direct (Campbell & Drucker, *Cell Metab*, 2013).

### 3.3.4 — Déficit incrétine dans le DT2

Chez les patients DT2, l'effet incrétine est **réduit d'environ 50%** par rapport aux sujets sains (Nauck et al., *Diabetologia*, 1986). Ce déficit est attribuable à deux mécanismes :

1. **Diminution modeste de la sécrétion de GLP-1** : la plupart des études montrent une réduction de 10-20% des taux de GLP-1 postprandiaux dans le DT2, mais cette diminution est insuffisante pour expliquer la totalité du déficit incrétine.
2. **Résistance au GIP** : les cellules β des patients DT2 répondent beaucoup moins au GIP qu'au GLP-1 — c'est le mécanisme dominant du déficit incrétine. La résistance au GIP serait liée à une down-regulation du récepteur GIPR sur les cellules β soumises au stress métabolique chronique.

Cette dissociation a orienté les stratégies thérapeutiques : puisque le GLP-1 reste efficace dans le DT2 (contrairement au GIP seul), c'est la voie GLP-1 qui a été ciblée en priorité.

### 3.3.5 — Stratégies thérapeutiques ciblant l'axe incrétine

Le GLP-1 natif a une **demi-vie extrêmement courte** : 2 à 3 minutes seulement. Il est rapidement dégradé par la **DPP-4** (*Dipeptidyl Peptidase-4*), une enzyme ubiquitaire qui clive les deux acides aminés N-terminaux du GLP-1 actif (7-36 amide), le transformant en GLP-1 inactif (9-36 amide).

Deux stratégies pharmacologiques contournent cette dégradation :

| Stratégie | Molécules | Mécanisme | Voie | Efficacité HbA1c |
|---|---|---|---|---|
| **Inhibiteurs de la DPP-4** (gliptines) | Sitagliptine, vildagliptine, saxagliptine, linagliptine, alogliptine | Bloquent l'enzyme DPP-4 → prolongent la demi-vie du GLP-1 endogène (×2-3) | Orale | -0,5 à -0,8% |
| **Analogues du GLP-1** (aGLP-1R) | Exénatide, liraglutide, sémaglutide, dulaglutide, albiglutide | Molécules résistantes à la DPP-4 → activation directe et prolongée du récepteur GLP-1R | SC ou orale (sémaglutide) | -1,0 à -1,8% |
| **Double agoniste GIP/GLP-1** | Tirzépatide | Activation simultanée des récepteurs GLP-1R et GIPR | SC | -1,5 à -2,4% |

> ⚠️ **Danger — Effets indésirables des analogues du GLP-1** : Les nausées et vomissements (20-40% des patients en début de traitement) sont liés au ralentissement de la vidange gastrique. Ils sont dose-dépendants et s'atténuent habituellement en 2-4 semaines. Une titration progressive est essentielle. Le risque de pancréatite aiguë a été évoqué mais les grandes études de sécurité (LEADER, SUSTAIN) n'ont pas confirmé de surrisque significatif. Le signal de cancer médullaire de la thyroïde observé chez les rongeurs (liraglutide, sémaglutide) n'a pas été confirmé chez l'humain mais reste une contre-indication en cas d'antécédent personnel ou familial de cancer médullaire thyroïdien ou de NEM2.

> [MEDIA: 📐 MDIAB03-S03-002 — Axe entéro-insulaire : cellules L (GLP-1) et K (GIP), dégradation par la DPP-4, sites d'action pancréatiques et extra-pancréatiques, cibles thérapeutiques (Identifiez les deux niveaux d'intervention pharmacologique : inhibition de la DPP-4 vs activation directe du récepteur)]

### 3.3.6 — L'axe cerveau-intestin-pancréas

L'effet incrétine ne se limite pas à une boucle hormonale intestin-pancréas. Des travaux récents révèlent un **axe neuro-hormonal** intégrant le cerveau : le GLP-1 active des neurones du **noyau du tractus solitaire** (NTS) et de l'**area postrema** dans le tronc cérébral, qui projettent vers l'hypothalamus (contrôle de l'appétit) et le noyau dorsal moteur du vague (efférences parasympathiques vers le pancréas). Ce circuit vagal contribue à la potentialisation de la sécrétion d'insuline et à la suppression du glucagon.

L'existence de cet axe explique pourquoi les analogues du GLP-1 ont des effets centraux marqués (satiété, perte de poids) et pourquoi la chirurgie bariatrique (qui modifie l'anatomie intestinale et la sécrétion des incrétines) a des effets métaboliques qui dépassent la simple restriction calorique — la rémission du DT2 après bypass gastrique survient souvent en quelques jours, bien avant que la perte de poids ne soit significative.

> 🤔 **Réflexion avancée** : Si l'axe cerveau-intestin-pancréas est si puissant, pourquoi les patients avec une vagotomie tronculaire (ancienne chirurgie anti-ulcéreuse) ne développent-ils pas tous un diabète ? La réponse est que l'axe incrétine a une composante hormonale (GLP-1 et GIP circulants agissant directement sur les cellules β) et une composante neurale (voie vagale). La redondance des deux voies confère une robustesse au système — la perte d'une voie est partiellement compensée par l'autre.

✏️ **Micro-exercice** : Un patient DT2 est traité par sitagliptine (iDPP-4). Vous observez une réduction modeste de l'HbA1c (-0,6%). Vous envisagez de passer à un analogue du GLP-1 (sémaglutide). Expliquez pourquoi l'analogue du GLP-1 est plus efficace que l'iDPP-4.

> *Réponse : L'iDPP-4 agit en protégeant le GLP-1 endogène de la dégradation → elle augmente les taux de GLP-1 de 2 à 3 fois, mais reste limitée par la quantité de GLP-1 que l'intestin produit physiologiquement. L'analogue du GLP-1 (sémaglutide) est administré à des doses pharmacologiques qui activent le récepteur GLP-1R à un niveau bien supérieur au GLP-1 physiologique → effet insulinotrope plus puissant, suppression du glucagon plus marquée, ralentissement de la vidange gastrique et satiété plus intenses → réduction de l'HbA1c et perte de poids significativement supérieures.*

**Transition** : L'insuline n'agit pas seule dans la régulation glycémique — le glucagon, sécrété par les cellules α, est son principal antagoniste hormonal. La compréhension de la physiologie du glucagon et de la hiérarchie de contre-régulation est essentielle pour gérer les hypoglycémies et comprendre l'hyperglycémie à jeun du DT2.

---

## 3.4 — Glucagon et contre-régulation glycémique

> 🤔 **Question de réflexion** : Un patient DT2 a une glycémie à jeun élevée (1,60 g/L) malgré une HbA1c relativement modeste (7,5%). Son insulinémie à jeun est élevée (25 µU/mL), ce qui élimine un déficit insulinique absolu. Si l'insuline est « suffisante », pourquoi la glycémie à jeun reste-t-elle élevée ? Quel « partenaire oublié » contribue à cette hyperglycémie ?

### 3.4.1 — Physiologie du glucagon

Le **glucagon** est une hormone peptidique de 29 acides aminés sécrétée par les **cellules α** des îlots de Langerhans. Il est produit par clivage du proglucagon par la **PC2** (dans les cellules α pancréatiques) — contrairement aux cellules L intestinales qui clivent le même proglucagon par la PC1/3 pour produire le GLP-1 (cf. section 3.3).

Le glucagon est l'**hormone hyperglycémiante majeure**. Son action s'exerce principalement sur le **foie**, via le récepteur du glucagon (GCGR) couplé à la protéine Gs et à l'adénylate cyclase :

- **Glycogénolyse** : activation de la glycogène phosphorylase → libération rapide du glucose stocké sous forme de glycogène hépatique. C'est l'effet le plus rapide (minutes).
- **Néoglucogenèse** : stimulation de la synthèse de novo de glucose à partir de précurseurs non glucidiques (lactate, alanine, glycérol). Effet plus lent (heures) mais quantitativement majeur en situation de jeûne prolongé.
- **Cétogenèse** : en cas de déficit insulinique associé, le glucagon stimule l'oxydation des acides gras hépatiques et la production de corps cétoniques — un mécanisme de survie en cas de jeûne qui devient pathologique dans l'acidocétose diabétique.

**Régulation de la sécrétion de glucagon** :

| Stimulateurs | Inhibiteurs |
|---|---|
| Hypoglycémie | Hyperglycémie |
| Acides aminés (surtout arginine, alanine) | Insuline (signal paracrine intra-îlot) |
| Exercice physique | Somatostatine (signal paracrine) |
| Stimulation sympathique (adrénaline, noradrénaline) | GLP-1 |
| Cortisol | Amyline |

> 📖 **Approfondissement** : L'inhibition du glucagon par l'insuline est principalement **paracrine** : l'insuline sécrétée par les cellules β adjacentes diffuse localement à forte concentration et inhibe directement les cellules α voisines. Cette concentration locale est 50 à 100 fois supérieure à l'insulinémie systémique. Ce mécanisme explique pourquoi, dans le DT1 (destruction des cellules β), les cellules α sont « libérées » de cette inhibition paracrine et sécrètent un excès paradoxal de glucagon même en hyperglycémie (cf. Module 1, section 1.3.4). L'insuline exogène injectée en sous-cutané ne reproduit pas cette inhibition paracrine locale — elle atteint les cellules α seulement via la circulation systémique, à des concentrations beaucoup plus faibles.

> [MEDIA: 📐 MDIAB03-S04-001 — Actions hépatiques du glucagon : glycogénolyse, néoglucogenèse, cétogenèse — voies de signalisation GCGR/Gs/AMPc et effets métaboliques (Identifiez pourquoi le glucagon est à la fois une hormone de survie en cas de jeûne et un facteur aggravant dans le diabète déséquilibré)]

### 3.4.2 — Hiérarchie de la contre-régulation glycémique

Lorsque la glycémie chute, l'organisme active une **cascade de défenses** hiérarchisée, chaque mécanisme se déclenchant à un seuil glycémique de plus en plus bas. Cette hiérarchie, établie par les travaux fondamentaux de Cryer (*J Clin Invest*, 2006), est essentielle pour comprendre la physiopathologie des hypoglycémies :

| Seuil glycémique (mg/dL) | Mécanisme activé | Effet |
|---|---|---|
| **~80** (4,4 mM) | ↓ Sécrétion d'insuline | Première défense : levée du frein insulinique sur la production hépatique |
| **~65-70** (3,6-3,9 mM) | ↑ Sécrétion de glucagon | Glycogénolyse + néoglucogenèse hépatique → production de glucose |
| **~65-70** (3,6-3,9 mM) | ↑ Sécrétion d'adrénaline | Glycogénolyse hépatique et musculaire, lipolyse, ↓ captation périphérique du glucose |
| **~60** (3,3 mM) | ↑ Cortisol + hormone de croissance (GH) | Effets anti-insuliniques retardés (heures), néoglucogenèse |
| **~55-60** (3,0-3,3 mM) | Symptômes neurogènes (adrénergiques) | Tremblements, palpitations, sueurs, anxiété → signal d'alerte conscient |
| **<50** (2,8 mM) | Symptômes neuroglycopéniques | Confusion, troubles visuels, convulsions, coma → urgence vitale |

Plusieurs points essentiels méritent l'attention du praticien :

1. La **diminution de l'insuline** est la première défense — elle précède l'activation du glucagon. Chez un patient sous insuline exogène, cette première ligne de défense est **abolie** : l'insuline injectée continue d'agir indépendamment de la glycémie.

2. Le **glucagon** et l'**adrénaline** sont les deux défenses actives principales. Elles se déclenchent au même seuil mais ont des mécanismes d'action distincts et complémentaires. La perte du glucagon seul est compensable par l'adrénaline. La perte des deux est catastrophique.

3. Les **symptômes neurogènes** (tremblements, sueurs, palpitations) sont déclenchés par l'activation sympatho-adrénergique — ils constituent le **signal d'alarme conscient** qui permet au patient de se resucrer. La perte de ces symptômes définit l'*hypoglycemia unawareness*.

> [MEDIA: 📐 MDIAB03-S04-002 — Escalier de la contre-régulation glycémique : seuils successifs de déclenchement des défenses hormonales et des symptômes, du plus haut (↓ insuline, 80 mg/dL) au plus bas (neuroglycopénie, <50 mg/dL) (Identifiez quelles lignes de défense sont perdues dans le DT1 évolué et pourquoi le risque d'hypoglycémie sévère augmente)]

### 3.4.3 — Hypoglycemia unawareness dans le DT1

Les patients DT1 de longue durée (>5 ans) présentent une vulnérabilité spécifique aux hypoglycémies sévères, liée à la **perte séquentielle** des mécanismes de contre-régulation :

**Première perte : la réponse glucagon** — Dans les 5 premières années suivant le diagnostic du DT1, la réponse glucagon à l'hypoglycémie disparaît chez la majorité des patients. Le mécanisme est lié à la **perte du signal paracrine insulinique intra-îlot** : dans l'îlot normal, la chute de l'insuline locale est le signal principal qui déclenche la sécrétion de glucagon en réponse à l'hypoglycémie. Quand les cellules β sont détruites, ce signal disparaît — les cellules α « ne détectent plus » l'hypoglycémie par cette voie. L'insuline exogène injectée ne restaure pas ce mécanisme car elle n'atteint pas l'îlot à des concentrations suffisantes.

**Deuxième perte : la réponse adrénergique** — Après des épisodes répétés d'hypoglycémie, le seuil de déclenchement de la réponse adrénergique s'**abaisse progressivement** (de ~65 mg/dL à ~50 mg/dL voire moins). Ce phénomène d'adaptation centrale (*hypoglycemia-associated autonomic failure*, HAAF) signifie que l'adrénaline n'est libérée qu'à des glycémies dangereusement basses — trop tard pour que le patient ressente les symptômes d'alerte et se resucre.

Le résultat combiné est l'**hypoglycemia unawareness** : le patient passe directement de la normoglycémie à la neuroglycopénie (confusion, perte de conscience) sans symptômes adrénergiques d'alerte. Le risque d'hypoglycémie sévère est multiplié par **25** (Cryer, *J Clin Invest*, 2006).

> 🏥 **Pertinence clinique — Prise en charge de l'hypoglycemia unawareness** :
> La stratégie repose sur l'**évitement strict des hypoglycémies** pendant 2-3 semaines : relèvement des cibles glycémiques, utilisation de la mesure continue du glucose (MCG) avec alertes prédictives, et éventuellement passage à une **boucle fermée** (pompe à insuline + MCG avec algorithme d'arrêt automatique). Cette stratégie permet de « remonter » le seuil adrénergique et de restaurer partiellement les symptômes d'alerte — c'est le concept de *hypoglycemia unawareness reversal*. En revanche, la réponse glucagon, une fois perdue, ne se restaure pas.

> ⚠️ **Danger — Le cercle vicieux de l'hypoglycemia unawareness** :
> Hypoglycémies récurrentes → abaissement du seuil adrénergique → absence de symptômes d'alerte → hypoglycémies non détectées plus fréquentes et plus profondes → abaissement supplémentaire du seuil → hypoglycémie sévère (coma, convulsions, décès). Ce cercle ne peut être rompu que par une prévention active et agressive des hypoglycémies.

### 3.4.4 — Hyperglucagonémie paradoxale dans le DT2

Si le glucagon est l'hormone de l'hypoglycémie, comment expliquer que les patients DT2 — qui sont hyperglycémiques — aient un glucagon **paradoxalement élevé** ? Cette observation, soulignée par Unger et Cherrington comme celle du « partenaire oublié » du diabète (*J Clin Invest*, 2012), est l'une des anomalies physiopathologiques les plus importantes du DT2.

Dans le DT2, les cellules α présentent une **résistance à l'inhibition** : elles ne répondent plus normalement à l'hyperglycémie (qui devrait supprimer le glucagon) ni à l'insuline paracrine (dont l'effet est atténué par l'insulinorésistance locale). Le résultat est une sécrétion de glucagon inappropriée en situation d'hyperglycémie, avec des conséquences directes :

- **Production hépatique de glucose excessive** → hyperglycémie à jeun. C'est le mécanisme dominant de l'hyperglycémie à jeun du DT2 — plus que le déficit insulinique lui-même à ce stade.
- **Hyperglycémie postprandiale** aggravée : au lieu de diminuer après un repas (comme chez le sujet sain), le glucagon ne se supprime pas, voire augmente → la production hépatique de glucose persiste et s'ajoute à l'absorption intestinale.
- **Majoration de la cétogenèse** en cas de décompensation → risque de cétose et d'état hyperosmolaire.

> 🔬 **Expert — Le glucagon comme cible thérapeutique directe** :
> L'hyperglucagonémie du DT2 a motivé le développement d'**antagonistes du récepteur du glucagon** (GCGR). Plusieurs molécules ont montré une réduction significative de la glycémie à jeun en essais cliniques. Cependant, le blocage du glucagon s'accompagne d'une **hyperplasie compensatoire des cellules α** (feedback positif) et d'une **augmentation des taux de GLP-1** (le proglucagon non clivé par PC2 est redirigé vers le GLP-1 par PC1/3). Les effets à long terme (risque de tumeurs neuroendocrines α, stéatose hépatique par inhibition de la β-oxydation) restent à évaluer. Les analogues du GLP-1 contournent ce problème en supprimant le glucagon de manière glucose-dépendante sans bloquer totalement le récepteur (Kazda et al., *Diabetes Care*, 2016).

> 💡 **Astuce clinique — « Bithérapie hormonale » du DT2** :
> Le DT2 n'est pas seulement un déficit d'insuline — c'est un déséquilibre du ratio insuline/glucagon. Les traitements les plus efficaces sont ceux qui corrigent les deux versants : les analogues du GLP-1 (↑ insuline ET ↓ glucagon), le tirzépatide (double agoniste) et l'association insuline + analogue du GLP-1 (insuline basale pour couvrir le déficit sécrétoire + GLP-1 pour supprimer le glucagon et favoriser la perte de poids). Cette vision « bihormonale » du DT2 remplace le paradigme centré sur l'insuline seule.

✏️ **Micro-exercice** : Un patient DT1 depuis 20 ans fait une hypoglycémie à 0,40 g/L. Il ne ressent aucun symptôme (pas de tremblements, pas de sueurs). Expliquez la séquence physiopathologique en vous appuyant sur la hiérarchie de contre-régulation.

> *Réponse : (1) L'insuline exogène ne diminue pas quand la glycémie baisse → première ligne de défense abolie. (2) Après 20 ans de DT1, les cellules β sont détruites → perte du signal paracrine intra-îlot → la réponse glucagon à l'hypoglycémie a disparu depuis les premières années. (3) Après des hypoglycémies récurrentes, le seuil de la réponse adrénergique s'est abaissé bien en dessous de 0,40 g/L (HAAF) → pas de libération d'adrénaline → pas de symptômes neurogènes (tremblements, sueurs). Résultat : le patient passe directement à la neuroglycopénie sans signal d'alerte. C'est l'hypoglycemia unawareness, risque ×25 d'hypoglycémie sévère.*

**Transition** : Avec cette vue d'ensemble — couplage stimulus-sécrétion, cinétique biphasique, incrétines, glucagon et contre-régulation — vous disposez des bases physiologiques pour comprendre les mécanismes d'action de l'ensemble de la pharmacopée antidiabétique et la gestion rationnelle des hypoglycémies.

---

## Points clés — Module 3

1. Le couplage stimulus-sécrétion repose sur le flux métabolique du glucose dans la cellule β : **GLUT1 → glucokinase (glucostat, Km ~8 mM) → glycolyse → mitochondrie → ↑ ATP/ADP → fermeture canal K~ATP~ → dépolarisation → influx Ca2+ → exocytose**
2. La **glucokinase** est l'étape limitante — ses mutations causent le MODY2 (inactivatrices) ou l'hyperinsulinisme congénital (activatrices)
3. Les **canaux K~ATP~** (Kir6.2/SUR1) sont le transducteur bioélectrique. Les sulfamides les ferment **indépendamment du glucose** → risque d'hypoglycémie. Les mutations de KCNJ11/ABCC8 causent diabète néonatal (activatrices) ou hyperinsulinisme congénital (inactivatrices)
4. La sécrétion d'insuline est **biphasique** : 1ère phase (RRP, 5-10 min, suppression hépatique) et 2ème phase (pool de réserve, >10 min, captation périphérique). La **perte de la 1ère phase** est l'anomalie la plus précoce du DT2
5. L'**effet incrétine** (GLP-1 + GIP) amplifie 2-3× la sécrétion d'insuline par voie orale vs IV et représente **50-70%** de la sécrétion postprandiale
6. Le GLP-1 est **glucose-dépendant** (pas d'hypoglycémie), ↑ insuline, ↓ glucagon, ↓ vidange gastrique, satiété, cardioprotection. Demi-vie 2-3 min (DPP-4) → stratégies : iDPP-4 ou analogues résistants
7. Le **tirzépatide** (double agoniste GIP/GLP-1) a une efficacité supérieure aux mono-agonistes
8. La **contre-régulation** est hiérarchisée : ↓ insuline (80) → ↑ glucagon (65-70) → ↑ adrénaline (65-70) → cortisol/GH (60) → symptômes neurogènes (55-60) → neuroglycopénie (<50)
9. L'**hypoglycemia unawareness** du DT1 résulte de la perte séquentielle glucagon puis adrénaline → risque ×25
10. L'**hyperglucagonémie paradoxale** du DT2 (« partenaire oublié ») est responsable de l'hyperglycémie à jeun excessive → les traitements corrigeant le ratio insuline/glucagon sont les plus efficaces

---

## Auto-évaluation — Module 3

### QCM

**QCM 1** 🥉 : Quelle enzyme est considérée comme le « capteur de glucose » de la cellule β ?
- A) Hexokinase I
- B) Glucokinase (Hexokinase IV) ✅
- C) Phosphofructokinase
- D) Pyruvate kinase

> *Feedback : La glucokinase (hexokinase IV) a un Km élevé (~8 mM) proche de la glycémie normale, n'est pas inhibée par son produit, et fonctionne comme un véritable « glucostat ». Ses mutations causent le MODY2 (inactivatrices) ou l'hyperinsulinisme congénital (activatrices).*

---

**QCM 2** 🥉 : L'effet incrétine explique quel pourcentage de la sécrétion postprandiale d'insuline chez le sujet sain ?
- A) 10-20%
- B) 30-40%
- C) 50-70% ✅
- D) >90%

> *Feedback : L'effet incrétine (GLP-1 + GIP) est responsable de 50-70% de la sécrétion d'insuline en réponse à un repas oral (Nauck et al., 1986). Ce phénomène explique pourquoi la voie orale stimule 2-3 fois plus la sécrétion d'insuline que la voie IV à glycémie identique.*

---

**QCM 3** 🥈 : Les sulfamides hypoglycémiants agissent en :
- A) Stimulant la sécrétion de GLP-1
- B) Inhibant la DPP-4
- C) Fermant les canaux K~ATP~ indépendamment du glucose ✅
- D) Activant la glucokinase

> *Feedback : Les sulfamides se lient au SUR1 du canal K~ATP~ et le ferment indépendamment du ratio ATP/ADP → sécrétion d'insuline même quand la glycémie est basse → risque d'hypoglycémie. C'est le mécanisme opposé à l'action glucose-dépendante du GLP-1.*

---

**QCM 4** 🥈 : Quelle est la demi-vie du GLP-1 natif dans la circulation ?
- A) 2-3 minutes ✅
- B) 20-30 minutes
- C) 2-3 heures
- D) 12-24 heures

> *Feedback : Le GLP-1 natif a une demi-vie très courte (2-3 min) due à la dégradation rapide par la DPP-4. Les analogues thérapeutiques (liraglutide, sémaglutide, dulaglutide) sont modifiés structurellement pour résister à la DPP-4 et avoir des demi-vies de plusieurs heures à plusieurs jours.*

---

**QCM 5** 🥇 : Un patient DT1 depuis 15 ans ne ressent plus les signes d'hypoglycémie. Quel est le mécanisme principal ?
- A) Neuropathie périphérique des extrémités
- B) Perte de la réponse glucagon puis de la réponse adrénergique à l'hypoglycémie ✅
- C) Adaptation centrale au glucose bas
- D) Absorption rapide de l'insuline injectée

> *Feedback : Hypoglycemia unawareness : perte séquentielle de la réponse glucagon (premières années du DT1, par disparition du signal paracrine insulinique intra-îlot) puis abaissement du seuil de la réponse adrénergique (HAAF, après hypoglycémies récurrentes). Le risque d'hypoglycémie sévère est multiplié par 25 (Cryer, 2006). La stratégie thérapeutique repose sur l'évitement strict des hypoglycémies pour remonter le seuil adrénergique.*

---

### Cas clinique

> 🏥 **Cas — M. B., 67 ans**
> DT2 depuis 12 ans. Traitement actuel : metformine 1000 mg × 2/j + gliclazide 60 mg/j. HbA1c 7,8%. Le patient rapporte des épisodes d'hypoglycémie à jeun et en fin de nuit (glycémies capillaires à 50-60 mg/dL), avec sueurs et tremblements. Bilan : créatinine 115 µmol/L, DFGe estimé 52 mL/min/1,73m² (IRC stade 3a).
>
> **Q1** 🥈 : Expliquez le mécanisme des hypoglycémies sous gliclazide chez ce patient en intégrant la pharmacologie du canal K~ATP~ et la fonction rénale.
>
> *Réponse : Le gliclazide se lie au SUR1 du canal K~ATP~ et le ferme indépendamment du ratio ATP/ADP intracellulaire → la cellule β sécrète de l'insuline même quand la glycémie est basse (court-circuit du couplage glucose-sécrétion). Ce risque est aggravé chez M. B. par deux facteurs : (1) le DFGe à 52 mL/min traduit une insuffisance rénale modérée qui prolonge la demi-vie du gliclazide et de ses métabolites actifs (accumulation) ; (2) à 67 ans, la clairance hépatique est également réduite et les réserves glycogéniques sont plus faibles, diminuant la capacité de contre-régulation. Les hypoglycémies en fin de nuit correspondent au nadir glycémique physiologique (période de jeûne prolongé) où l'effet résiduel du sulfamide persiste sans stimulus alimentaire.*
>
> **Q2** 🥇 : Proposez une alternative thérapeutique au gliclazide qui corrige le risque d'hypoglycémie tout en maintenant un contrôle glycémique satisfaisant chez ce patient. Justifiez par le mécanisme d'action.
>
> *Réponse : Deux options principales, toutes deux basées sur l'effet glucose-dépendant :*
> *- **Inhibiteur de la DPP-4 (iDPP-4)** : par exemple la linagliptine (pas d'ajustement rénal nécessaire, élimination biliaire) ou la sitagliptine (ajustée à 50 mg pour DFGe 30-50 ou 25 mg pour DFGe <30). Mécanisme : prolonge la demi-vie du GLP-1 endogène → stimulation de l'insuline glucose-dépendante → pas d'hypoglycémie quand la glycémie est basse. Efficacité modeste (HbA1c -0,5 à -0,8%) mais profil de sécurité excellent, adapté au patient âgé avec IRC.*
> *- **Analogue du GLP-1 (aGLP-1R)** : par exemple le dulaglutide (pas d'ajustement rénal) ou le sémaglutide (utilisable jusqu'au DFGe 15). Mécanisme : activation pharmacologique directe du récepteur GLP-1R → stimulation insulinique glucose-dépendante + suppression du glucagon + ralentissement vidange gastrique + perte de poids. Efficacité supérieure aux iDPP-4 (HbA1c -1,0 à -1,8%). Bénéfice cardiovasculaire additionnel. Pas d'hypoglycémie en monothérapie ou avec metformine.*
> *Dans les deux cas, l'avantage décisif sur le gliclazide est le caractère glucose-dépendant de l'action : quand la glycémie descend en dessous du seuil d'activation (~4 mM), l'effet insulinotrope s'éteint spontanément → pas de sécrétion d'insuline inappropriée en fin de nuit.*

---

### Question de synthèse

💎 **Question ouverte** : Un confrère vous dit : « Le DT2, c'est un manque d'insuline, point final. » En vous appuyant sur les quatre sections de ce module, expliquez pourquoi cette vision est incomplète et quelles sont les implications thérapeutiques d'une vision plus intégrée de la physiopathologie du DT2.

> *Éléments de réponse : Cette vision unicausale est réductrice. Le DT2 associe au minimum quatre anomalies sécrétoires : (1) **Perte de la première phase** de sécrétion d'insuline (défaut du RRP → absence de suppression rapide de la production hépatique de glucose → hyperglycémie postprandiale précoce) ; (2) **Déficit incrétine** (réduction de ~50% de l'effet incrétine, surtout par résistance au GIP → amplification insuffisante de la sécrétion postprandiale) ; (3) **Hyperglucagonémie paradoxale** (les cellules α ne sont plus correctement inhibées → production hépatique de glucose excessive → hyperglycémie à jeun) ; (4) **Perte de la pulsatilité** de la sécrétion d'insuline (désensibilisation hépatique). Implications thérapeutiques : les traitements les plus efficaces corrigent plusieurs de ces anomalies simultanément. Les analogues du GLP-1 et le tirzépatide agissent sur les quatre composantes (↑ insuline glucose-dépendante, restauration partielle de la première phase, suppression du glucagon, correction du déficit incrétine). Les sulfamides ne corrigent que le déficit insulinique — et de manière non glucose-dépendante, ajoutant un risque d'hypoglycémie. L'association insuline basale + analogue du GLP-1 couvre le déficit insulinique (composantes 1 et 4) et l'hyperglucagonémie (composante 3).*

---

## Références bibliographiques

- Matschinsky FM. *Regulation of pancreatic beta-cell glucokinase: from basics to therapeutics*. Diabetes. 2002;51(Suppl 3):S394-S404.
- Pratley RE, Weyer C. *The role of impaired early insulin secretion in the pathogenesis of Type II diabetes mellitus*. Diabetologia. 2001;44(8):929-945.
- Nauck MA et al. *Incretin effects of increasing glucose loads in man calculated from venous insulin and C-peptide responses*. J Clin Endocrinol Metab. 1986;63(2):492-498.
- Nauck MA et al. *Reduced incretin effect in type 2 (non-insulin-dependent) diabetes*. Diabetologia. 1986;29(1):46-52.
- Drucker DJ. *The biology of incretin hormones*. Cell Metab. 2006;3(3):153-165.
- Cryer PE. *Mechanisms of sympathoadrenal failure and hypoglycemia in diabetes*. J Clin Invest. 2006;116(6):1470-1473.
- Unger RH, Cherrington AD. *Glucagonocentric restructuring of diabetes: a pathophysiologic and therapeutic makeover*. J Clin Invest. 2012;122(1):4-12.
- Pearson ER et al. *Switching from insulin to oral sulfonylureas in patients with diabetes due to Kir6.2 mutations*. N Engl J Med. 2006;355(5):467-477.
- Glaser B et al. *Familial hyperinsulinism caused by an activating glucokinase mutation*. N Engl J Med. 1998;338(4):226-230.
- Santer R et al. *Mutations in GLUT2, the gene for the liver-type glucose transporter, in patients with Fanconi-Bickel syndrome*. Nat Genet. 1997;17(3):324-326.
- Sekine N et al. *Low lactate dehydrogenase and high mitochondrial glycerol phosphate dehydrogenase in pancreatic beta-cells*. J Biol Chem. 1994;269(7):4895-4902.
- Gaisano HY. *Recent new insights into the role of SNARE and associated proteins in insulin granule exocytosis*. Diabetes Obes Metab. 2017;19(Suppl 1):115-123.
- Westermark P et al. *Islet amyloid polypeptide, islet amyloid, and diabetes mellitus*. Physiol Rev. 2011;91(3):795-826.
- Marso SP et al. *Liraglutide and cardiovascular outcomes in type 2 diabetes*. N Engl J Med. 2016;375(4):311-322.
- Frías JP et al. *Tirzepatide versus semaglutide once weekly in patients with type 2 diabetes*. N Engl J Med. 2021;385(6):503-515.
- Campbell JE, Drucker DJ. *Pharmacology, physiology, and mechanisms of incretin hormone action*. Cell Metab. 2013;17(6):819-837.
- Kazda CM et al. *Evaluation of efficacy and safety of the glucagon receptor antagonist LY2409021 in patients with type 2 diabetes*. Diabetes Care. 2016;39(7):1241-1249.

---

*VERTEX© — Formation Diabétologie — Module 3 : Physiologie de la Sécrétion d'Insuline et du Glucagon*
*Ce contenu est destiné à des praticiens confirmés. Il ne se substitue pas au jugement clinique.*
