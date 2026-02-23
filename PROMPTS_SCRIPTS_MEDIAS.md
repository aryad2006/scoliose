# PROMPTS ET SCRIPTS DE PRODUCTION MÉDIAS — FORMATION SCOLIOSE

**Date** : Février 2026  
**Objectif** : Fournir les prompts prêts à l'emploi pour les 4 outils de production médias  
**Périmètre** : ~513 médias à produire, organisés par outil et par module

---

## TABLE DES MATIÈRES

1. [BioRender — Illustrations scientifiques](#1-biorender)
2. [Runway Gen-3 Alpha — Animations et vidéos IA](#2-runway-gen-3)
3. [BioDigital Human — Modèles 3D interactifs](#3-biodigital)
4. [HeyGen — Présentateur IA et narration](#4-heygen)
5. [Workflow de production intégré](#5-workflow)

---

# 1. BIORENDER — ILLUSTRATIONS SCIENTIFIQUES ET SCHÉMAS ANATOMIQUES

> **Outil** : BioRender (biorender.com)  
> **Usage** : Schémas anatomiques (📐), infographies (📊), illustrations médicales  
> **Format de sortie** : SVG / PNG vectoriel haute résolution (300 dpi)  
> **Licence** : Académique ou Institutionnelle (vérifier droits de publication)

## 1.1 Paramètres généraux de style

```
CHARTE GRAPHIQUE BIORENDER :
- Palette principale : Bleu médical (#1B4F72), Rouge chirurgical (#C0392B), 
  Vert os (#27AE60), Orange tendon (#E67E22), Violet neuro (#8E44AD)
- Fond : blanc (#FFFFFF) ou gris clair (#F8F9FA)
- Police des légendes : Helvetica Neue / Arial, 12-14pt
- Flèches : noires, pointe triangulaire, épaisseur 1.5pt
- Échelle : toujours inclure une barre d'échelle quand pertinent
- Orientation anatomique : toujours indiquer S/I, A/P, D/G
- Langue : FRANÇAIS pour toutes les légendes
```

## 1.2 Prompts par module

### MODULE 1 — Anatomie du rachis

**M01-S01-002 — Vertèbre cervicale typique**
```
BIORENDER PROMPT :
Créer un schéma anatomique d'une vertèbre cervicale typique (C3-C6) en :
- Vue supérieure (axiale) et vue latérale côte à côte
- Légendes : corps vertébral, pédicules, lames, processus épineux bifide, 
  processus transverses, foramen transversaire, uncus (processus unciforme),
  canal rachidien, facettes articulaires supérieures
- Couleurs : os cortical (ivoire #F5F5DC), os spongieux (beige #DEB887),
  cartilage articulaire (bleu clair #AED6F1)
- Dimensions typiques indiquées : diamètre AP ~15mm, transversal ~25mm
- Orientation : antérieur en haut sur la vue axiale
FORMAT : SVG vectoriel, 2400x1200 px
```

**M01-S01-004 — Vertèbre thoracique typique**
```
BIORENDER PROMPT :
Créer un schéma anatomique d'une vertèbre thoracique typique en :
- 3 vues : supérieure, latérale, postérieure
- Légendes : corps vertébral, pédicules, lames, processus épineux long et 
  incliné vers le bas, processus transverses avec facette costale 
  transversaire, facettes costales supérieures et inférieures sur le corps,
  canal rachidien (plus petit que cervical et lombaire)
- Couleurs : même palette que M01-S01-002
- Annoter : orientation des facettes articulaires (plan frontal ≈ 60° → rotation)
FORMAT : SVG vectoriel, 3600x1200 px (3 vues)
```

**M01-S01-006 — Vertèbre lombaire typique**
```
BIORENDER PROMPT :
Créer un schéma anatomique d'une vertèbre lombaire typique (L3-L4) en :
- Vue supérieure et vue latérale côte à côte
- Légendes : corps vertébral massif, pédicules épais, canal rachidien 
  triangulaire, processus épineux court et horizontal, facettes articulaires 
  en plan sagittal, processus mamillaire et accessoire
- Comparer taille avec encart miniature de vertèbre cervicale (échelle identique)
- Dimensions : diamètre AP ~35mm, transversal ~50mm, hauteur ~28mm
FORMAT : SVG vectoriel, 2400x1200 px
```

**M01-S01-007 — Sacrum et coccyx**
```
BIORENDER PROMPT :
Créer un schéma du sacrum et coccyx en :
- 2 vues : antérieure et postérieure
- + 1 coupe médiane sagittale
- Légendes : promontoire sacré, ailes du sacrum, foramens sacrés antérieurs 
  et postérieurs (S1-S4), crête sacrée médiane, latérale et intermédiaire,
  hiatus sacré, cornes sacrées, articulation sacro-iliaque (surface auriculaire),
  coccyx (3-5 segments)
FORMAT : SVG vectoriel, 3600x1600 px
```

**M01-S01-008 — Tableau comparatif des vertèbres**
```
BIORENDER PROMPT :
Créer une infographie comparative "side by side" :
- 3 colonnes : Cervicale | Thoracique | Lombaire
- Pour chaque colonne : dessin schématique (vue supérieure) +
  tableau de caractéristiques en dessous
- Caractéristiques à comparer : taille du corps, forme du canal, 
  orientation des facettes, processus épineux, foramens, mobilité principale
- Couleurs distinctes pour chaque type (bleu/vert/orange)
- Flèches de mouvement principal pour chaque type
FORMAT : PNG, 2400x1800 px, orientation paysage
```

**M01-S04-004 — Artère d'Adamkiewicz**
```
BIORENDER PROMPT :
Créer un schéma de la vascularisation médullaire :
- Vue antérieure du rachis thoraco-lombaire (T8-L2)
- Artère spinale antérieure (ligne médiane, rouge vif)
- Artère d'Adamkiewicz : origine T9-T12 gauche (75% des cas),
  trajet en "épingle à cheveux" caractéristique vers le haut
- Artères radiculaires segmentaires bilatérales
- Zone à risque en cas de ligature chirurgicale (highlight en rouge translucide)
- Légende : "CRITIQUE pour la chirurgie de la scoliose — risque de paraplégie"
- Territoire vascularisé par Adamkiewicz en vert translucide
FORMAT : SVG vectoriel, 1800x2400 px, orientation portrait
```

**M01-S05-001 — Courbures sagittales normales**
```
BIORENDER PROMPT :
Créer un schéma de profil du rachis entier :
- Vue latérale (orientation : antérieur à gauche)
- Courbures physiologiques annotées avec arcs de mesure :
  • Lordose cervicale : 20-40° (C2-C7)
  • Cyphose thoracique : 20-45° (T1-T12, méthode Cobb)
  • Lordose lombaire : 40-60° (L1-S1)
- Plumb line C7 (ligne verticale rouge pointillée depuis C7)
- SVA (Sagittal Vertical Axis) : distance C7-S1 en mm
- Incidence pelvienne schématisée sur le bassin
- Silhouette simplifiée du patient en superposition transparente
FORMAT : SVG vectoriel, 1200x2400 px, orientation portrait
```

### MODULE 3 — Biomécanique

**M03-S02-001 — Cercle vicieux de Stokes**
```
BIORENDER PROMPT :
Créer un diagramme circulaire (cercle vicieux) illustrant :
- Centre : vertèbre cunéiforme (coupe frontale)
- Flèches circulaires reliant :
  1. "Charge asymétrique" →
  2. "Croissance asymétrique (Hueter-Volkmann)" →
  3. "Cunéiformisation vertébrale et discale" →
  4. "Augmentation de la courbure" →
  5. "Aggravation de la charge asymétrique" → retour à 1
- Chaque étape : icône schématique + texte
- Couleur : dégradé du vert (début) au rouge (aggravation)
- Titre : "Cercle vicieux de la scoliose idiopathique (Stokes, 2007)"
FORMAT : PNG, 2000x2000 px, carré
```

**M03-S02-002 — Déformation tridimensionnelle**
```
BIORENDER PROMPT :
Créer une illustration 3D de la déformation scoliotique montrant :
- Rachis normal à gauche vs rachis scoliotique à droite
- Plan frontal : inclinaison latérale (courbure en "S")
- Plan sagittal : modification du profil (hypocyphose thoracique)
- Plan axial : rotation vertébrale + gibbosité costale
- Vue de dessus (axiale) en médaillon : rotation de la vertèbre apicale
- Flèches directionnelles pour chaque composante de la déformation
- Légendes en français : "Plan frontal", "Plan sagittal", "Plan axial"
FORMAT : SVG vectoriel, 3600x1800 px
```

### MODULE 5 — Classification des scolioses

**M05-S01-001 — Classification de Lenke complète**
```
BIORENDER PROMPT :
Créer une infographie complète de la classification de Lenke :
- Section 1 : 6 types de courbes (1-6) avec schémas simplifiés des 4 régions
  (PT, MT, TL/L, T) en positif/négatif/structural
- Section 2 : Modificateur lombaire (A, B, C) avec CSVL sur schémas coronaux
- Section 3 : Modificateur sagittal thoracique (-, N, +) avec profil et angles
- Tableau récapitulatif : "1AN" = Type 1, modificateur lombaire A, sagittal Normal
- Code couleur : rouge (structural majeur), orange (structural mineur), 
  gris (non structural)
FORMAT : PNG, 4800x3600 px (poster), orientation paysage
```

### MODULE 8 — SIA

**M08-S04-001 — Types de corsets**
```
BIORENDER PROMPT :
Créer une planche comparative des principaux corsets pour scoliose :
- 6 panels : Boston, Chêneau/Rigo-Chêneau, Milwaukee, Charleston, Providence, SpineCor
- Pour chaque corset : vue de face + profil du patient portant le corset (silhouette)
- Zones de pression (flèches rouges) et fenêtres d'expansion (zones vertes)
- Indication du type : TLSO / CTLSO / Night-time / Souple
- Port recommandé (heures/jour) en badge
FORMAT : PNG, 4800x2400 px, orientation paysage
```

**M08-S07-001 — Technique de dérotation de tige**
```
BIORENDER PROMPT :
Créer une séquence en 4 étapes de la manœuvre de dérotation de tige (CD) :
1. Vis pédiculaires en place, tige pré-cintrée positionnée horizontalement
2. Tige engagée dans les vis, plan coronal
3. Rotation de 90° de la tige (manœuvre de dérotation) avec flèche courbe
4. Résultat : correction de la courbure dans les 3 plans
- Vue postérieure du rachis pour chaque étape
- Flèches montrant les forces de correction
- Légendes : "Avant correction", "Tige engagée", "Dérotation", "Correction finale"
FORMAT : SVG vectoriel, 4800x1200 px (bande horizontale)
```

### MODULES 15-17 — Techniques chirurgicales

**M15-S07-001 — Vis pédiculaire — Anatomie et technique**
```
BIORENDER PROMPT :
Créer un schéma détaillé de mise en place d'une vis pédiculaire :
- Vue axiale d'une vertèbre thoracique montrant :
  • Point d'entrée (à la jonction pars/transverse)
  • Trajectoire dans le pédicule (couloir pédiculaire)
  • Vis en place dans le corps vertébral
  • Parois médiale et latérale du pédicule (zones à risque)
  • Structures adjacentes : moelle épinière (médial), aorte/veine cave (antérieur),
    plèvre (latéral au thoracique)
- Overlay semi-transparent montrant les zones danger (rouge) et sécurité (vert)
- Angles de convergence annotés par niveau : T4 (15°), T8 (20°), L1 (10°), L4 (15°)
FORMAT : SVG vectoriel, 2400x2400 px
```

**M15-S07-008 — Instrumentation complète face et profil**
```
BIORENDER PROMPT :
Créer un schéma de l'instrumentation complète :
- Face (coronale) et profil (sagittale) côte à côte
- Montage typique T4-L4 pour scoliose thoracique droite
- Composants légendés :
  • Vis pédiculaires polyaxiales (T4-L4)
  • 2 tiges (CoCr 5.5mm, pré-cintrées)
  • Barre transversale (cross-link)
  • Set-screws (boulons de verrouillage)
- Face : correction coronale visible (rachis droit)
- Profil : cyphose thoracique restaurée, lordose lombaire
FORMAT : SVG vectoriel, 2400x3000 px
```

### MODULE 18-19 — Complications

**M18-S01-001 — Algorithme de gestion de la perte de signal IONM**
```
BIORENDER PROMPT :
Créer un organigramme (flowchart) :
- Titre : "Protocole de perte de signal IONM peropératoire"
- Nœud initial (rouge) : "ALERTE : Perte de signal PES/PEM"
- Branche 1 : Vérifications techniques (électrodes, anesthésie, température)
- Branche 2 : Si technique OK → Évaluation chirurgicale
  • Retrait du dernier geste (vis, distraction)
  • Augmentation de la PAM > 80 mmHg
  • Steakhouse test (corticothérapie IV)
- Branche 3 : Si pas de récupération dans 15 min → Wake-up test
- Branche 4 : Si déficit confirmé → Retrait d'instrumentation
- Couleurs : rouge (alerte), orange (vérification), vert (récupération), noir (déficit)
FORMAT : PNG, 2400x3600 px, orientation portrait
```

### MODULES 21-24 — Modules développés

**M21-S01-001 — Protocole de rééducation postopératoire (4 phases)**
```
BIORENDER PROMPT :
Créer une infographie chronologique en 4 phases :
- Phase 1 (J0-6 semaines) : fond bleu clair
  • Icônes : lit → fauteuil → marche assistée → escaliers
  • Exercices : respiratoire, isométrie
- Phase 2 (6-12 semaines) : fond vert clair
  • Icônes : gainage, proprioception
  • Exercices progressifs
- Phase 3 (3-6 mois) : fond orange clair
  • Icônes : renforcement dynamique, endurance
  • Natation autorisée
- Phase 4 (> 6 mois) : fond violet clair
  • Icônes : sport adapté, réathlétisation
  • Retour au sport progressif
- Flèche chronologique en bas avec jalons (semaines/mois)
- Icônes d'interdiction : rotation tronc, charge lourde pendant 6 mois
FORMAT : PNG, 4800x1800 px, orientation paysage
```

**M23-S01-001 — Retentissement respiratoire et seuils critiques**
```
BIORENDER PROMPT :
Créer un schéma combiné :
- Gauche : coupe frontale du thorax montrant compression parenchymateuse
  côté concave, expansion côté convexe, déformation de la cage thoracique
- Droite : graphique Cobb (°) vs CVF (% prédite) :
  • Zone verte (< 60°) : "Retentissement minime"
  • Zone orange (60-90°) : "Retentissement modéré à sévère"
  • Zone rouge (> 90°) : "Insuffisance respiratoire chronique"
  • Courbe de corrélation non linéaire avec effet seuil
- Encadré : "Seuil critique > 60-70° : surveillance EFR systématique"
FORMAT : SVG vectoriel, 3600x1800 px
```

**M24-S01-001 — Test d'Adams et scoliomètre**
```
BIORENDER PROMPT :
Créer une planche illustrative du dépistage :
- Panel A : Patient debout de dos (silhouette) — inspection visuelle
  • Flèches annotant : asymétrie épaules, triangle de taille, gibbosité, bassin
- Panel B : Test d'Adams (patient penché en avant)
  • Vue de face et vue de dos
  • Gibbosité costale visible côté convexe
  • Examinateur observant à hauteur du dos
- Panel C : Scoliomètre de Bunnell en position sur le dos du patient
  • Zoom sur le cadran du scoliomètre avec lecture de l'angle
  • Seuils : < 5° (normal), 5-7° (surveiller), > 7° (référer)
- Annotations : sensibilité 70-85%, spécificité 60-80%
FORMAT : PNG, 3600x2400 px
```

---

# 2. RUNWAY GEN-3 ALPHA — ANIMATIONS ET VIDÉOS IA

> **Outil** : Runway Gen-3 Alpha (runway.ml)  
> **Usage** : Animations 2D/3D (🎬), vidéos explicatives (🎥)  
> **Format** : MP4, 1080p, 10-60 secondes par segment, assemblage dans DaVinci Resolve  
> **Workflow** : Prompt → Génération → Upscale → Montage → Narration (HeyGen)

## 2.1 Paramètres de style vidéo

```
STYLE GUIDE RUNWAY :
- Style : rendu médical 3D photoréaliste, éclairage studio chirurgical
- Caméra : mouvements lents et fluides (orbite 360°, zoom progressif, travelling)
- Anatomie : précision médicale, textures réalistes (os, muscle, nerf)
- Couleurs : palette médicale (blancs, bleus, rouges anatomiques)
- Pas de texte incrusté (ajouté en post-production)
- Durée : 10-15 secondes par clip, assembler en séquences de 30-120s
- Résolution : 1280x768 (Gen-3), upscale à 1920x1080 en post
```

## 2.2 Prompts par module

### MODULE 1 — Anatomie

**M01-S01-003 — Atlas (C1) et Axis (C2)**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of the atlas (C1) and axis (C2) vertebrae. 
Camera slowly orbits around detailed anatomical models showing: 
the ring-shaped atlas with anterior and posterior arches, lateral masses, 
then the axis with its prominent odontoid process (dens). 
The camera zooms into the atlantoaxial joint showing the 
rotational movement. Clean white background, medical lighting, 
photorealistic bone texture. 10 seconds."
---
CLIP 2 : "Smooth transition to show the rotation movement 
of the head using the atlas-axis joint. The atlas rotates around 
the odontoid process of the axis, demonstrating 50% of total 
cervical rotation. Transparent soft tissue overlay becomes visible 
showing the transverse ligament. Medical quality, 10 seconds."
```

**M01-S01-005 — Articulations costo-vertébrales et respiration**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation showing a thoracic vertebra with attached ribs. 
Camera shows the costovertebral joint (rib articulating with vertebral 
body) and costotransverse joint (rib with transverse process). 
The animation demonstrates the pump-handle movement of upper ribs 
(AP expansion) and bucket-handle movement of lower ribs 
(lateral expansion) during breathing. Slow, clear movement. 
Medical lighting, photorealistic, 15 seconds."
```

**M01-S02-001 — Segment mobile de Junghans**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of the functional spinal unit (Junghans mobile 
segment): two adjacent vertebrae with intervertebral disc, facet joints, 
and ligaments. The animation shows sequential movement in all 3 planes: 
first flexion-extension (sagittal), then lateral bending (coronal), 
then rotation (axial). Each movement highlighted with colored arrows. 
Clean medical rendering, 15 seconds."
```

**M01-S02-002 — Structure du disque intervertébral**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation: progressive cross-section cut through an 
intervertebral disc. Camera zooms from macro view of the disc 
between two vertebrae, then a sagittal cut reveals the internal 
structure: central nucleus pulposus (gelatinous, translucent blue), 
concentric layers of annulus fibrosus (fibrous, white-beige), 
and cartilaginous endplates. Arrows show load distribution. 
Photorealistic medical rendering, 12 seconds."
```

**M01-S02-004 — Système ligamentaire rachidien**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation: sagittal median view of 3 lumbar vertebrae. 
Ligaments appear sequentially with color coding:
1. Anterior longitudinal ligament (green) along vertebral bodies
2. Posterior longitudinal ligament (red) inside canal
3. Ligamentum flavum (yellow) between laminae
4. Interspinous ligament (blue) between spinous processes
5. Supraspinous ligament (purple) over spinous process tips
Each ligament fades in with its name label. 
Medical quality rendering, 15 seconds."
```

**M01-S04-004 — Artère d'Adamkiewicz**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation: anterior view of thoracolumbar spine (T8-L2). 
Blood flow animation shows segmental arteries branching from the aorta, 
then highlights the artery of Adamkiewicz originating from the left 
side at T9-T12 level. The camera zooms in to show its characteristic 
hairpin turn ascending to join the anterior spinal artery. 
Red blood flow animation along the vessel. 
A warning zone pulses in red showing the surgical risk area. 
Medical rendering, dramatic lighting, 15 seconds."
```

### MODULE 2 — Embryologie

**M02-S01-001 — Formation des somites**
```
RUNWAY GEN-3 PROMPT :
"Embryological 3D animation: time-lapse of human embryo development 
from day 20 to day 30. Paraxial mesoderm segments into paired somites 
(block-like structures along the neural tube). Camera shows dorsal 
view of the embryo as somites form sequentially from cranial to caudal. 
Then zoom into a single somite showing differentiation into 
sclerotome (ventromedial, blue) and dermomyotome (dorsolateral, red). 
Clean scientific rendering, soft lighting, 15 seconds."
```

**M02-S01-003 — Neurulation (formation du tube neural)**
```
RUNWAY GEN-3 PROMPT :
"Embryological 3D animation of neurulation: the neural plate 
(flat ectoderm) folds upward to form the neural groove, then 
the edges (neural folds) meet and fuse to create the neural tube. 
Show craniocaudal closure (like a zipper). End by showing 
neural crest cells migrating laterally. 
Then briefly show what happens when closure fails: 
spina bifida (posterior view). 
Scientific medical animation, 15 seconds."
```

### MODULE 3 — Biomécanique

**M03-S02-002 — Déformation 3D de la scoliose**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation: a normal straight spine on the left 
gradually transforms into a scoliotic spine on the right. 
Show the three-dimensional nature of the deformity:
1. Coronal plane: lateral curve forming an S-shape
2. Sagittal plane: loss of thoracic kyphosis (flat back)
3. Axial plane: vertebral rotation with rib hump developing
Camera rises from frontal view to an aerial (axial) view 
showing the rotation clearly. Smooth morphing animation, 
medical quality, 15 seconds."
```

**M03-S03-001 — Principes de correction chirurgicale**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of surgical correction principles:
Scene 1: Scoliotic thoracic spine with pedicle screws in place
Scene 2: Pre-contoured rod is engaged into the screws
Scene 3: Rod rotation maneuver — the rod rotates 90° converting 
the coronal curve into the desired sagittal profile
Scene 4: Result — corrected spine in all 3 planes
Each step shown with force arrows. 
Metallic instrumentation (titanium colored). 
Operating room lighting, 15 seconds."
```

### MODULE 8 — SIA

**M08-S09-001 — Vertebral Body Tethering (VBT)**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of Vertebral Body Tethering (VBT):
1. Lateral view: thoracoscopic approach, camera enters between ribs
2. Vertebral body screws placed on the convex side (T5-T12)
3. A polyethylene cord (tether) is threaded through the screw heads
4. Tension is applied — the convex side is compressed
5. Over time animation: growth on the concave side 
   (Hueter-Volkmann principle) gradually straightens the spine
6. Final result: corrected spine WITHOUT fusion
Medical rendering, progressive time lapse, 20 seconds total."
```

**M08-S11-001 — Thoracoplastie costale**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of costoplasty (thoracoplasty):
1. Posterior view: scoliotic spine with visible rib hump on convex side
2. Surgical exposure: 3-5 ribs identified on convex side
3. Subperiosteal rib resection: segments of ribs removed
4. Result: flattened rib prominence, improved cosmesis
5. Resected rib bone shown being used as autograft for fusion
Camera orbits from posterior to lateral view to show 
the cosmetic improvement. Medical quality, 15 seconds."
```

**M08-S13-001 — Traction halo-gravitaire**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of halo-gravity traction:
1. Halo ring positioned on patient's skull (4 pins visible)
2. Pulley system attached above (wheelchair or bed mount)
3. Weight applied progressively: 15-20% then 30-50% of body weight
4. Show the severe rigid scoliosis (>90°) gradually straightening 
   over 2-6 weeks of traction (time-lapse)
5. Final: patient in halo-wheelchair ambulating
Clean medical rendering, hospital setting, 15 seconds."
```

### MODULE 15 — Instrumentation

**M15-S07-002 — Mise en place vis pédiculaire (free-hand)**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation of free-hand pedicle screw placement:
1. Posterior view of exposed thoracic spine (surgical field)
2. Entry point identified at junction of transverse process and pars
3. Probe/awl creates a pilot hole through the cortical bone
4. Pedicle finder advances through the pedicle corridor (bone boundaries 
   shown in transparent overlay — medial wall = danger zone in red)
5. Pedicle screw is inserted and advanced into vertebral body
6. Final: triggered EMG check (stimulation probe on screw)
Step-by-step with anatomical overlay, medical quality, 20 seconds."
```

**M15-S06-001 — Voie d'abord postérieure**
```
RUNWAY GEN-3 PROMPT :
"Surgical 3D animation of posterior spinal approach:
1. Prone patient on operating table (Jackson frame)
2. Midline incision marked along spinous processes
3. Dissection through skin, subcutaneous tissue, fascia
4. Subperiosteal dissection exposing laminae and facets bilaterally
5. Clear view of surgical anatomy: spinous processes, laminae, 
   transverse processes, facet joints, pars interarticularis
6. Pedicle screws placed bilaterally
Camera follows surgical progression from superficial to deep.
Operating room lighting, realistic tissue rendering, 20 seconds."
```

### MODULES 21-24

**M21-S03-001 — Pathologie du segment adjacent (ASD/PJK)**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation: long posterior spinal fusion (T4-L4).
Time-lapse showing 5-10 year progression:
1. Initial post-op result: well-aligned spine
2. Progressive disc degeneration at adjacent levels (above and below fusion)
3. Proximal Junctional Kyphosis (PJK) develops at upper junction
   — vertebra above tilts forward, kyphotic angle increases
4. Worst case: Proximal Junctional Failure (PJF) — 
   fracture of superior vertebra and screw pullout
Show cross-section of degenerated disc vs normal.
Medical rendering, gradual progression, 15 seconds."
```

**M23-S02-001 — Cœur pulmonaire dans scoliose sévère**
```
RUNWAY GEN-3 PROMPT :
"Medical 3D animation: pathophysiology of cor pulmonale in severe scoliosis.
1. Severely deformed thoracic cage (Cobb > 100°) compressing lungs
2. Reduced pulmonary vascular bed → pulmonary vasoconstriction
3. Pulmonary hypertension develops (arteries thicken, pressure arrows)
4. Right ventricle dilates and hypertrophies
5. Right heart failure: tricuspid regurgitation, hepatic congestion
Camera transitions from thoracic cage to heart cross-section.
Medical rendering with blood flow visualization, 15 seconds."
```

---

# 3. BIODIGITAL HUMAN — MODÈLES 3D INTERACTIFS

> **Outil** : BioDigital Human (biodigital.com)  
> **Usage** : Modèles 3D rotatifs et interactifs (🧊) intégrés via iframe dans le LMS  
> **Format** : WebGL embed (iframe), URL partageable  
> **Intégration LMS** : iframe responsive dans le contenu SCORM/xAPI

## 3.1 Configuration des modèles

```
BIODIGITAL PARAMÈTRES :
- API : BioDigital Human SDK v3
- Mode : Interactive embed (rotation, zoom, pan)
- Couches anatomiques : os, muscles, nerfs, vaisseaux (pelables)
- Annotations : étiquettes cliquables en français
- Quiz mode : cacher les légendes → étudiant doit identifier
- Export : iframe code pour intégration LMS
- Responsive : adaptatif mobile et desktop
```

## 3.2 Modèles à configurer

### MODULE 1 — Rachis complet interactif

**M01-S01-001 — Rachis complet 3D**
```
BIODIGITAL CONFIG :
Modèle : Complete Spine (C1-Coccyx)
Couches activées :
  - Os (vertèbres individuelles, cliquables)
  - Disques intervertébraux (semi-transparents)
  - Ligaments (optionnel, toggle on/off)
  - Moelle épinière et racines nerveuses (optionnel)
  - Vascularisation (optionnel, artère d'Adamkiewicz highlighted)
Annotations (FR) : 
  - C1 "Atlas", C2 "Axis", C7 "Proéminente"
  - T1-T12 numérotées, L1-L5 numérotées
  - "Cyphose thoracique 20-45°", "Lordose lombaire 40-60°"
  - "Lordose cervicale 20-40°"
Vues prédéfinies :
  1. "Vue postérieure" (par défaut)
  2. "Vue latérale droite"  
  3. "Vue antérieure"
  4. "Vue supérieure C1"
Mode quiz : masquer les noms des vertèbres, demander identification
```

**M01-S03-001 — Muscles du rachis 3D**
```
BIODIGITAL CONFIG :
Modèle : Back muscles + Spine
Couches pelables :
  1. Peau et fascia (superficiel)
  2. Trapèze + Grand dorsal (couche superficielle)
  3. Érecteurs du rachis : iliocostal (latéral), longissimus (intermédiaire), 
     épineux (médial)
  4. Multifides et rotateurs (couche profonde)
  5. Plan osseux (squelette seul)
Utilisateur : peut cliquer pour reveal / peel chaque couche
Annotations fonctionnelles : actions de chaque muscle, innervation
```

### MODULE 3 — Biomécanique et scoliose

**M03-S02-003 — Scoliose 3D interactive**
```
BIODIGITAL CONFIG :
Modèle : Scoliotic spine (right thoracic curve, Lenke type 1)
Fonctionnalités :
  - Rotation libre 360° pour visualiser la déformation dans les 3 plans
  - Slider "Angle de Cobb" : 0° → 100° (morphing progressif de la déformation)
  - Toggle "Cage thoracique" : montrer/cacher les côtes et la gibbosité
  - Toggle "Vertèbre apicale" : highlight avec rotation visible
  - Mesure interactive de l'angle de Cobb (outil de mesure intégré)
Annotations :
  - Vertèbre limite supérieure (upper end vertebra)
  - Vertèbre apicale (apex)
  - Vertèbre limite inférieure (lower end vertebra)
  - Gibbosité costale (rib hump)
  - Direction de la rotation vertébrale
```

### MODULE 5 — Classifications

**M05-S01-002 — Classification de Lenke 3D**
```
BIODIGITAL CONFIG :
Modèle : 6 modèles de rachis scoliotiques (Lenke types 1-6)
Navigation : onglets ou carousel pour passer d'un type à l'autre
Pour chaque type :
  - Courbe(s) majeure(s) en rouge, mineure(s) en orange
  - Annotations : "Structural" vs "Non-structural"
  - Toggle "Bending test" : montrer la correction en inclinaison latérale
  - Modificateur lombaire (A, B, C) sélectionnable
  - CSVL line (Center Sacral Vertical Line) affichable
```

### MODULE 8 — Instrumentation

**M08-S07-002 — Instrumentation postérieure 3D**
```
BIODIGITAL CONFIG :
Modèle : Instrumented scoliosis correction (T4-L4)
Éléments interactifs :
  - Toggle pré/post-opératoire (morphing de la correction)
  - Cliquer sur chaque vis pour info (taille, convergence, position)
  - Visualiser les tiges (CoCr, pré-cintrées)
  - Toggle cross-link (barre transversale)
  - Vue transparente des pédicules pour voir le placement des vis
  - Mesure : angle de Cobb pré (65°) vs post (15°) avec outil interactif
Vues prédéfinies :
  1. "Postérieure" (vision chirurgien)
  2. "Latérale" (profil sagittal)
  3. "Axiale apicale" (dérotation)
  4. "Vue antérieure" (relation avec structures vasculaires)
```

### MODULE 28 — SpineSim©

**M28-S01-001 — Modèle biomécanique SpineSim© (lien BioDigital)**
```
BIODIGITAL CONFIG :
Modèle : Full spine + pelvis + rib cage
Mode avancé (via SpineSim© API) :
  - Intégration des données patient (DICOM → modèle 3D personnalisé)
  - Simulation de forces : vis-à-vis des vis, forces de correction en N
  - Propriétés mécaniques des vertèbres (Young modulus, Poisson ratio)
  - Animation : correction chirurgicale simulée en temps réel
  - Export : plan chirurgical avec coordonnées de vis et angles
NOTE : Ce modèle sert de pont entre BioDigital (visualisation) 
et SpineSim© (simulation biomécanique Julia backend)
```

---

# 4. HEYGEN — PRÉSENTATEUR IA ET NARRATION

> **Outil** : HeyGen (heygen.com)  
> **Usage** : Vidéos avec présentateur IA narrant le contenu, synthèse vocale  
> **Format** : MP4 1080p, 2-10 min par vidéo, FR et EN  
> **Personnage** : Avatar médecin (blouse blanche, bureau ou fond médical)

## 4.1 Configuration de l'avatar

```
HEYGEN AVATAR SETTINGS :
- Avatar : "Dr. Expert" — homme/femme, 40-50 ans, professionnel
- Tenue : blouse blanche, badge "Formation Scoliose"
- Fond : bureau médical avec bibliothèque, écran de consultation,
  ou fond neutre branded (logo SpineSim©)
- Voix : française, professionnelle, claire
  • Option 1 : voix masculine grave (style conférence médicale)
  • Option 2 : voix féminine claire (style cours universitaire)
- Langue : français principal, sous-titres EN/ES/AR en option
- Gesticulation : modérée, professionnelle
- Regard : face caméra avec légers mouvements naturels
```

## 4.2 Scripts de narration — Introduction des modules

### INTRODUCTION GÉNÉRALE DE LA FORMATION

```
HEYGEN SCRIPT — Vidéo d'accueil (2 min)
---
AVATAR : face caméra, souriant, bureau médical

"Bienvenue dans cette formation complète sur la scoliose.

Je suis le Docteur [Nom], chirurgien orthopédiste pédiatrique 
spécialisé dans la chirurgie du rachis, et je serai votre guide 
tout au long de ces 29 modules et 89 heures de formation.

[TRANSITION : slide titre avec logo]

Cette formation a été conçue pour les chirurgiens orthopédistes, 
les neurochirurgiens, les internes en formation, et tout professionnel 
de santé impliqué dans la prise en charge de la scoliose.

[TRANSITION : slide structure]

Elle est organisée en 8 grandes parties, couvrant :
les fondamentaux anatomiques et biomécaniques,
le diagnostic et la classification,
les différents types de scoliose,
les techniques chirurgicales détaillées,
les complications et leur gestion,
la prise en charge globale du patient,
et des sujets avancés de recherche.

[TRANSITION : slide SpineSim©]

L'un des éléments uniques de cette formation est SpineSim©, 
notre simulateur biomécanique de chirurgie virtuelle. 
Il vous permettra de pratiquer des gestes chirurgicaux 
dans un environnement sûr, avant le bloc opératoire.

[TRANSITION : retour avatar]

À la fin de cette formation, vous passerez un examen de certification 
avec 600 questions réparties sur 4 niveaux : 
Bronze, Argent, Or et Diamant.

Commençons sans plus tarder par les fondamentaux de l'anatomie du rachis.

Bonne formation !"
---
DURÉE : ~2 min
SLIDES À INCRUSTER : 3-4 slides titre/structure en picture-in-picture
```

### MODULE 1 — Introduction

```
HEYGEN SCRIPT — M01 Introduction (1 min 30)
---
"Module 1 : Anatomie du rachis. Durée estimée : 2 heures 30.

Avant d'aborder la scoliose elle-même, il est indispensable 
de maîtriser parfaitement l'anatomie normale du rachis.

Dans ce module, nous étudierons :

[SLIDE : anatomie descriptive]
Premièrement, l'anatomie descriptive : les vertèbres cervicales, 
thoraciques, lombaires, le sacrum, et leurs particularités morphologiques.

[SLIDE : anatomie fonctionnelle]
Deuxièmement, l'anatomie fonctionnelle : le segment mobile de Junghans, 
le disque intervertébral, les articulations facettaires, 
et le système ligamentaire.

[SLIDE : musculature]
Troisièmement, la musculature rachidienne : les érecteurs du rachis, 
les multifides, les abdominaux, et leur rôle dans l'équilibre postural.

[SLIDE : neuroanatomie]
Quatrièmement, la neuroanatomie : la moelle épinière, les racines 
nerveuses, et surtout l'artère d'Adamkiewicz — un repère vasculaire 
critique pour la chirurgie.

[SLIDE : courbures]
Et enfin, les courbures physiologiques et les paramètres d'équilibre 
sagittal, qui sont fondamentaux pour comprendre la scoliose.

Commençons par l'anatomie descriptive du rachis."
---
DURÉE : ~1 min 30
```

### MODULE 8 — Introduction

```
HEYGEN SCRIPT — M08 Introduction (2 min)
---
"Module 8 : Scoliose idiopathique de l'adolescent, ou SIA. 
C'est le module le plus complet de cette formation, 
avec une durée estimée de 7 heures.

La SIA représente 80% de toutes les scolioses. 
C'est la forme que vous rencontrerez le plus en pratique clinique.

[SLIDE : contenu du module]

Dans ce module exceptionnellement détaillé, nous aborderons :

La physiopathologie et les théories étiologiques — facteurs génétiques, 
neuromusculaires, hormonaux et biomécaniques.

L'histoire naturelle — comment prédire quelles courbes vont progresser, 
avec les critères de Lonstein et Carlson.

Les trois piliers du traitement conservateur : l'observation, 
le corsetage — avec une revue complète des types de corsets 
et des preuves de l'étude BrAIST — et la kinésithérapie spécifique 
avec les exercices de type Schroth et SEAS.

Le traitement chirurgical en détail : les indications, l'arthrodèse 
postérieure avec technique de dérotation, les règles de sélection 
des niveaux de Lenke, le choix de l'instrumentation, 
et le monitoring neurophysiologique.

Les techniques de préservation de la croissance : growing rods, 
MAGEC, et le tethering vertébral antérieur — VBT —, 
qui représente l'avenir de la chirurgie conservatrice.

Et des sujets spéciaux : la thoracoplastie, les médecines 
complémentaires et la traction halo-gravitaire.

Chaque sujet est accompagné d'illustrations interactives, 
de cas cliniques dans SpineSim©, et de quiz de validation.

C'est parti."
---
DURÉE : ~2 min
```

### MODULE 21 — Introduction

```
HEYGEN SCRIPT — M21 Introduction (1 min 30)
---
"Module 21 : Rééducation et suivi à long terme. Durée estimée : 3 heures.

La chirurgie n'est qu'une étape dans le parcours du patient scoliotique.
Ce qui vient après — la rééducation, le retour au sport, 
et le suivi à long terme — est tout aussi important.

[SLIDE : contenu]

Nous aborderons :

Le protocole de rééducation postopératoire en 4 phases, 
de la mobilisation précoce à la réathlétisation.

Le retour au sport après fusion : quels sports sont autorisés, 
lesquels sont déconseillés, et comment accompagner le sportif 
de haut niveau.

Le suivi à long terme : de 2 semaines à 10 ans et au-delà, 
avec la surveillance de la pathologie du segment adjacent — 
un enjeu majeur de la chirurgie de la scoliose.

Les scores et questionnaires de suivi — les PROMs — 
qui permettent de mesurer objectivement le résultat 
du point de vue du patient.

Et enfin, la télémédecine et les outils connectés 
qui transforment le suivi de la scoliose.

Commençons par le protocole de rééducation postopératoire."
---
DURÉE : ~1 min 30
```

### MODULE 24 — Introduction

```
HEYGEN SCRIPT — M24 Introduction (1 min 30)
---
"Module 24 : Dépistage de la scoliose. Durée estimée : 1 heure 30.

Le dépistage est la porte d'entrée du parcours de soins 
en scoliose. Un dépistage efficace permet une prise en charge 
précoce, et une prise en charge précoce sauve des chirurgies.

[SLIDE : contenu]

Ce module couvre :

Les programmes de dépistage scolaire : histoire, recommandations 
des sociétés savantes — SRS, AAOS, SOSORT, USPSTF — 
et la controverse sur le rapport coût-efficacité.

Les méthodes de dépistage : le test d'Adams, le scoliomètre 
de Bunnell, la topographie de surface, et les nouvelles 
applications smartphone.

Le diagnostic différentiel : car toute courbure rachidienne 
n'est pas une scoliose. Nous passerons en revue les attitudes 
scoliotiques, les tumeurs rachidiennes, les spondylolisthésis, 
les infections, et les pathologies neurologiques qui peuvent 
mimer une scoliose.

Et enfin, les critères de référence au spécialiste : 
quand référer, quelles informations transmettre, 
et le rôle du médecin de première ligne.

Commençons par les programmes de dépistage."
---
DURÉE : ~1 min 30
```

## 4.3 Scripts de narration — Slides narrées (exemples)

### Exemple : Slide "Artère d'Adamkiewicz" (M01-S04)

```
HEYGEN SCRIPT — Slide narrée (45 secondes)
---
[FOND : schéma M01-S04-004 affiché en plein écran]
[AVATAR : petit format en bas à droite, picture-in-picture]

"L'artère d'Adamkiewicz est un repère vasculaire absolutement critique 
en chirurgie de la scoliose.

Elle naît de l'aorte, le plus souvent du côté gauche, 
entre T9 et T12, dans 75% des cas.

Elle présente un trajet caractéristique en épingle à cheveux 
[POINTEUR : highlight sur l'animation] — elle remonte pour rejoindre 
l'artère spinale antérieure, qui vascularise les deux tiers 
antérieurs de la moelle épinière.

Sa lésion — lors d'une libération antérieure, d'une ostéotomie, 
ou d'un saignement per-opératoire — est la cause principale 
de paraplégie postopératoire.

C'est pourquoi le monitoring neurophysiologique peropératoire 
avec les potentiels évoqués moteurs est indispensable 
dans toute chirurgie de la scoliose."
---
DURÉE : ~45 secondes
```

### Exemple : Slide "Classification de Lenke" (M05-S01)

```
HEYGEN SCRIPT — Slide narrée (1 min 30)
---
[FOND : infographie M05-S01-001 classification de Lenke]
[AVATAR : picture-in-picture]

"La classification de Lenke, publiée en 2001, est le système 
de classification le plus utilisé au monde pour la scoliose 
idiopathique de l'adolescent.

Elle repose sur 3 composantes :

[HIGHLIGHT type de courbe]
Premièrement, le type de courbe — de 1 à 6 — basé sur la région 
de la courbe majeure. Le type 1, courbe thoracique principale, 
est le plus fréquent.

[HIGHLIGHT modificateur lombaire]
Deuxièmement, le modificateur lombaire — A, B ou C — 
déterminé par la position de l'apex lombaire par rapport 
à la CSVL, la ligne sacrée centrale verticale.
A : apex entre les pédicules, B : apex touche la CSVL, 
C : apex au-delà de la CSVL.

[HIGHLIGHT modificateur sagittal]
Troisièmement, le modificateur sagittal thoracique : 
trait d'union pour hypocyphose, N pour normal, 
plus pour hypercyphose.

Ensemble, ces 3 éléments guident directement le choix 
des niveaux de fusion. Par exemple, un type 1-A-N implique 
une fusion thoracique sélective, épargnant le rachis lombaire."
---
DURÉE : ~1 min 30
```

---

# 5. WORKFLOW DE PRODUCTION INTÉGRÉ

## 5.1 Pipeline de production par média

```
ÉTAPE 1 — CRÉATION DES ASSETS BRUTS
┌─────────────────────────────────────────────────────────────┐
│ BioRender  →  Schémas PNG/SVG (📐 📊)                       │
│ Runway     →  Clips MP4 10-15s (🎬)                         │
│ BioDigital →  Modèles 3D interactifs embed (🧊)             │
│ Photos     →  Captures chirurgicales HD (📷 🎥)              │
└─────────────────────────────────────────────────────────────┘
                         ↓
ÉTAPE 2 — POST-PRODUCTION
┌─────────────────────────────────────────────────────────────┐
│ DaVinci Resolve :                                           │
│   • Montage des clips Runway en séquences 30-120s           │
│   • Ajout de légendes FR sur les schémas BioRender          │
│   • Color grading médical (tons bleus/blancs)               │
│   • Transitions douces entre slides                         │
│   • Export MP4 1080p 30fps                                   │
└─────────────────────────────────────────────────────────────┘
                         ↓
ÉTAPE 3 — NARRATION
┌─────────────────────────────────────────────────────────────┐
│ HeyGen :                                                    │
│   • Avatar présente l'introduction du module (1-2 min)      │
│   • Narration en picture-in-picture sur les animations      │
│   • Voix off sur les schémas statiques                      │
│   • Export MP4 final avec narration intégrée                 │
└─────────────────────────────────────────────────────────────┘
                         ↓
ÉTAPE 4 — INTÉGRATION LMS
┌─────────────────────────────────────────────────────────────┐
│ Upload sur le LMS :                                         │
│   • Vidéos MP4 → lecteur vidéo SCORM/xAPI                   │
│   • Schémas → image responsive dans le cours                │
│   • Modèles 3D → iframe BioDigital intégré                  │
│   • Player adaptatif (qualité, sous-titres, vitesse)        │
│   • Tracking : durée de visionnage, interactions 3D         │
└─────────────────────────────────────────────────────────────┘
```

## 5.2 Planning de production par priorité

| Phase | Mois | Outils | Modules | Médias estimés |
|-------|------|--------|---------|----------------|
| **P1** | 1-4 | BioRender + Runway | M1-3 (anatomie, embryologie, biomécanique) | ~80 |
| **P2** | 3-6 | BioRender + Runway + BioDigital | M4-7 (classification, diagnostic, imagerie) | ~70 |
| **P3** | 5-8 | Runway + BioRender + HeyGen | M8-10 (SIA, traitement) | ~90 |
| **P4** | 7-10 | BioRender + Runway | M11-14 (scolioses non idiopathiques) | ~50 |
| **P5** | 9-12 | Runway + BioDigital | M15-17 (chirurgie détaillée) + SpineSim© | ~70 |
| **P6** | 11-14 | BioRender + Runway | M18-20 (complications, périopératoire) | ~50 |
| **P7** | 13-16 | BioRender + HeyGen | M21-24 (rééducation, psychologie, dépistage) | ~40 |
| **P8** | 15-18 | BioRender + BioDigital + HeyGen | M25-29 (recherche, cas cliniques, SpineSim©, évaluation) | ~63 |
| **HeyGen** | 1-18 | HeyGen (en continu) | Tous : introductions + narrations (29 intros + ~300 slides narrées) | ~330 vidéos |

## 5.3 Budget estimé par outil

| Outil | Licence | Coût/an | Usage |
|-------|---------|---------|-------|
| **BioRender** | Institutional | ~2 000-5 000 € | ~215 schémas/infographies |
| **Runway Gen-3** | Pro (unlimited) | ~1 200-3 600 € | ~90 animations × 4-8 générations chacune |
| **BioDigital** | Enterprise/API | ~5 000-15 000 € | 8 modèles 3D interactifs + SDK |
| **HeyGen** | Enterprise | ~3 000-6 000 € | ~330 vidéos avec avatar (intros + slides) |
| **DaVinci Resolve** | Studio | ~295 € (licence unique) | Post-production, montage |
| **TOTAL** | | **~11 500-30 000 €/an** | 513+ médias sur 18 mois |

## 5.4 Checklist qualité par média

```
CONTRÔLE QUALITÉ MÉDIA :
□ Précision anatomique / médicale validée par expert
□ Légendes en français, orthographe vérifiée
□ Résolution suffisante (min 1080p vidéo, 300dpi image)
□ Accessibilité : alt-text, sous-titres, description audio
□ Cohérence chromatique avec la charte graphique
□ Identifiant unique attribué (MXX-SYY-ZZZ)
□ Métadonnées renseignées (titre, module, section, type, durée)
□ Test d'affichage LMS (desktop + mobile + tablette)
□ Droits vérifiés (licence BioRender, liberation Runway)
□ Validation par le comité scientifique (signature)
```

---

*Prompts et scripts médias — Formation Scoliose — Février 2026*  
*4 outils : BioRender (schémas), Runway Gen-3 (animations), BioDigital (3D interactif), HeyGen (narration IA)*  
*~513 médias couverts, organisés par module et par priorité de production*
