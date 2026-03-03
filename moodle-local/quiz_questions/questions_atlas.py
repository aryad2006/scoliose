"""
VERTEX© — Banque de questions pour évaluations adaptatifs Moodle.

Format JSON :
{
  "id":       Identifiant unique (str)
  "level":    "bronze" | "argent" | "or" | "diamant"
  "domain":   "anatomie" | "biomecanique" | "scoliose" | "chirurgie" | "radiologie"
  "question": Texte de la question (str)
  "type":     "mcq" (QCM 1 réponse) | "msq" (QCM multiple) | "truefalse" | "numeric"
  "answers":  [{"text": str, "correct": bool, "feedback": str}]
  "explanation": Explication post-réponse (str)
  "reference": Source bibliographique (str, optionnel)
  "media":    Chemin image Moodle (str, optionnel)
}

Niveaux :
  Bronze   — Bases anatomiques et terminologie (25 questions)
  Argent   — Biomécanique et classification (40 questions)
  Or       — Simulation / planification chirurgicale (40 questions)
  Diamant  — Expertise / complications / cas complexes (30 questions)
"""

questions = [

  # ═══════════════════════════════════════════════════════════════════════════
  # BRONZE — Anatomie et terminologie (25 questions)
  # ═══════════════════════════════════════════════════════════════════════════

  {
    "id": "BR-AN-001",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Combien de vertèbres thoraciques le rachis humain adulte possède-t-il normalement ?",
    "type": "mcq",
    "answers": [
      {"text": "7",  "correct": False, "feedback": "Ce sont les vertèbres cervicales qui sont au nombre de 7."},
      {"text": "10", "correct": False, "feedback": "Incorrect."},
      {"text": "12", "correct": True,  "feedback": "Exactement. T1 à T12 forment les 12 vertèbres thoraciques."},
      {"text": "5",  "correct": False, "feedback": "Ce sont les vertèbres lombaires qui sont au nombre de 5."},
    ],
    "explanation": "Le rachis thoracique comprend T1–T12 (12 vertèbres), chacune articulée avec une paire de côtes.",
    "reference": "Panjabi MM, Atlas of Spinal Biomechanics, 1991",
  },

  {
    "id": "BR-AN-002",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Le disque intervertébral est composé de deux structures principales. Lesquelles ?",
    "type": "msq",
    "answers": [
      {"text": "Anneau fibreux (annulus fibrosus)", "correct": True,  "feedback": "Correct. L'anneau fibreux est la partie périphérique, constituée de lamelles de fibres de collagène."},
      {"text": "Noyau pulpeux (nucleus pulposus)",   "correct": True,  "feedback": "Correct. Le noyau pulpeux est central, très hydraté (88 % eau chez le jeune adulte)."},
      {"text": "Cartilage articulaire",              "correct": False, "feedback": "Non, les cartilages articulaires appartiennent aux facettes articulaires, pas au disque."},
      {"text": "Ligament intersomatique",            "correct": False, "feedback": "Non, ce n'est pas une structure du disque."},
    ],
    "explanation": "Le disque intervertébral est l'entité cartilagineuse avascularisée reliant deux corps vertébraux. Il absorbe les contraintes axiales et distribuées en compression.",
  },

  {
    "id": "BR-AN-003",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Quelle courbure rachidienne est normalement convexe en AVANT (lordose) dans le plan sagittal ?",
    "type": "msq",
    "answers": [
      {"text": "Cervicale",  "correct": True,  "feedback": "La lordose cervicale est physiologique et convexe vers l'avant."},
      {"text": "Thoracique", "correct": False, "feedback": "La courbure thoracique est une cyphose (convexe vers l'arrière)."},
      {"text": "Lombaire",   "correct": True,  "feedback": "La lordose lombaire est l'une des courbures les plus importantes pour l'équilibre sagittal."},
      {"text": "Sacrée",     "correct": False, "feedback": "Le sacrum est en cyphose."},
    ],
    "explanation": "Le rachis présente 4 courbures alternées : lordose cervicale, cyphose thoracique, lordose lombaire, cyphose pelvienne/sacrée.",
  },

  {
    "id": "BR-AN-004",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Le pédicule vertébral relie :",
    "type": "mcq",
    "answers": [
      {"text": "Le corps vertébral à la lame",          "correct": True,  "feedback": "Exact. Le pédicule est le pont osseux entre le corps vertébral (antérieur) et l'arc postérieur (lamines)."},
      {"text": "Le corps vertébral à l'apophyse épineuse", "correct": False, "feedback": "L'apophyse épineuse part de la lame, pas du pédicule."},
      {"text": "Deux corps vertébraux adjacents",        "correct": False, "feedback": "C'est le disque intervertébral qui relie les corps vertébraux."},
      {"text": "La facette supérieure à la facette inférieure", "correct": False, "feedback": "Les facettes articulaires sont reliées par les massifs articulaires."},
    ],
    "explanation": "Le pédicule est la structure tubulaire qui contient les artères et veines radiculaires et forme le toit du foramen intervertébral. Sa morphologie conditionne le choix des vis pédiculaires.",
    "reference": "Magerl F, Aebi M — A comprehensive classification of thoracic and lumbar injuries, Eur Spine J, 1994",
  },

  {
    "id": "BR-AN-005",
    "level": "bronze",
    "domain": "anatomie",
    "question": "L'angle de Cobb mesure :",
    "type": "mcq",
    "answers": [
      {"text": "La rotation des corps vertébraux dans le plan axial",     "correct": False, "feedback": "La rotation axiale est mesurée par l'indice de Nash-Moe ou par scanner."},
      {"text": "La déviation latérale du rachis dans le plan frontal",     "correct": True,  "feedback": "Exact. L'angle de Cobb est la mesure standard de la scoliose dans le plan coronal."},
      {"text": "La cyphose thoracique dans le plan sagittal",              "correct": False, "feedback": "La cyphose est un angle de Cobb mais dans le plan sagittal — la question se réfère à la scoliose."},
      {"text": "L'équilibre sagittal (SVA)",                              "correct": False, "feedback": "La SVA est la flèche sagittale verticale C7-S1, pas un angle de Cobb."},
    ],
    "explanation": "L'angle de Cobb est formé par l'intersection des droites prolongeant le plateau supérieur de la vertèbre limite supérieure et le plateau inférieur de la vertèbre limite inférieure de la courbe.",
    "reference": "Cobb JR, Outline for the study of scoliosis, AAOS Instructional Course Lectures, 1948",
  },

  {
    "id": "BR-AN-006",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Quelle est la valeur normale de l'angle de cyphose thoracique (T4-T12) ?",
    "type": "mcq",
    "answers": [
      {"text": "0° – 10°",  "correct": False, "feedback": "C'est trop faible. Une cyphose inférieure à 20° est considérée comme une hypocyphose."},
      {"text": "20° – 50°", "correct": True,  "feedback": "La norme consensuelle est 20-50°, idéalement autour de 35°."},
      {"text": "55° – 70°", "correct": False, "feedback": "Au-delà de 50°, on parle d'hypercyphose pathologique."},
      {"text": "80° – 90°", "correct": False, "feedback": "C'est une cyphose sévère."},
    ],
    "explanation": "La cyphose thoracique physiologique (T4-T12) est comprise entre 20° et 50°, avec une valeur idéale autour de 35° selon Bernhardt et Bridwell.",
    "reference": "Bernhardt M, Bridwell KH — Segmental analysis of the sagittal plane alignment, Spine, 1989",
  },

  {
    "id": "BR-AN-007",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Le ligament longitudinal postérieur (LLP) est situé :",
    "type": "mcq",
    "answers": [
      {"text": "Sur la face antérieure des corps vertébraux",                    "correct": False, "feedback": "Non, c'est le ligament longitudinal ANTÉRIEUR (LLA)."},
      {"text": "Sur la face postérieure des corps vertébraux, dans le canal rachidien", "correct": True,  "feedback": "Exact. Le LLP court de C2 au sacrum sur la face postérieure des corps vertébraux."},
      {"text": "Entre les apophyses épineuses",                                  "correct": False, "feedback": "C'est le ligament inter-épineux."},
      {"text": "Entre les lames vertébrales",                                    "correct": False, "feedback": "C'est le ligamentum flavum (ligament jaune)."},
    ],
    "explanation": "Le LLP renforce la partie postérieure du segment mobile, contribuant à la résistance en distraction. Sa présence dans le canal rachidien explique son rôle de barrière partielle lors des hernies discales médianes.",
  },

  {
    "id": "BR-AN-008",
    "level": "bronze",
    "domain": "anatomie",
    "question": "La vascularisation du disque intervertébral chez l'adulte est :",
    "type": "mcq",
    "answers": [
      {"text": "Très vascularisé par des artères discales",           "correct": False, "feedback": "Non, le disque adulte est avasculaire."},
      {"text": "Totalement avasculaire — nutrition par imbibition",  "correct": True,  "feedback": "Correct. La nutrition se fait par diffusion depuis les plateaux cartilagineux."},
      {"text": "Partiellement vascularisé dans l'anneau fibreux",     "correct": False, "feedback": "Seuls les tiers périphériques de l'anneau fibrosus reçoivent quelques capillaires chez le très jeune enfant."},
      {"text": "Vascularisé uniquement dans le noyau pulpeux",        "correct": False, "feedback": "Non, le noyau est totalement avasculaire."},
    ],
    "explanation": "L'avasculanité discale explique la lente cicatrisation et la dégénérescence progressive. La nutrition dépend du mouvement (pompe hydraulique) et des diffusions depuis les plateaux.",
  },

  {
    "id": "BR-AN-009",
    "level": "bronze",
    "domain": "anatomie",
    "question": "La vertèbre apicale d'une scoliose est la vertèbre :",
    "type": "mcq",
    "answers": [
      {"text": "La plus inclinée par rapport à l'axe vertical",    "correct": False, "feedback": "Les vertèbres limites (extrêmes) sont les plus inclinées."},
      {"text": "La plus déplacée latéralement de l'axe horizontal", "correct": True,  "feedback": "Exact. L'apex est la vertèbre au sommet de la courbe, la plus éloignée latéralement."},
      {"text": "La première touchée par la rotation",               "correct": False, "feedback": "Il n'y a pas de corrélation directe entre l'apex et la vertèbre la plus rotée."},
      {"text": "Toujours au niveau T8 dans les scolioses idiopathiques", "correct": False, "feedback": "L'apex est variable selon le type de courbe (n'est pas toujours T8)."},
    ],
    "explanation": "Dans la classification de King (1983), la vertèbre apicale est celle qui est la plus latéralement déplacée. Sa rotation est la plus importante au sommet de la gibbosité.",
  },

  {
    "id": "BR-AN-010",
    "level": "bronze",
    "domain": "anatomie",
    "question": "Les apophyses transverses des vertèbres thoraciques s'articulent avec :",
    "type": "mcq",
    "answers": [
      {"text": "Les épiphyses des corps vertébraux adjacents",  "correct": False, "feedback": "Non."},
      {"text": "Le tubercule costal (tête costale)",            "correct": True,  "feedback": "Exact. L'articulation costo-transversaire unit l'apophyse transverse au tubercule costal, stabilisant les côtes."},
      {"text": "Les plateaux vertébraux",                       "correct": False, "feedback": "Non."},
      {"text": "Les isthmes vertébraux",                        "correct": False, "feedback": "Non."},
    ],
    "explanation": "L'articulation costo-transversaire est essentielle à la mécanique thoracique. Sa présence explique la rigidité relative du rachis thoracique comparé au lombaire.",
  },

  # ═══════════════════════════════════════════════════════════════════════════
  # BRONZE — Radiologie et mesures (15 questions supplémentaires)
  # ═══════════════════════════════════════════════════════════════════════════

  {
    "id": "BR-RA-011",
    "level": "bronze",
    "domain": "radiologie",
    "question": "Quelle est la valeur seuil de l'angle de Cobb à partir de laquelle une corset est généralement recommandé ?",
    "type": "mcq",
    "answers": [
      {"text": "10°", "correct": False, "feedback": "10° est le seuil diagnostique de scoliose, pas de traitement."},
      {"text": "25°", "correct": True,  "feedback": "Exact. Entre 25° et 40° (patient en croissance), un corset est recommandé selon les guidelines SRS/SOSORT."},
      {"text": "40°", "correct": False, "feedback": "À 40°, la chirurgie est déjà envisagée."},
      {"text": "5°",  "correct": False, "feedback": "5° est dans la variabilité de mesure."},
    ],
    "explanation": "Les guidelines SOSORT 2022 recommandent le corset dès 25° chez l'enfant en pleine croissance (Risser 0-2). En dessous, la kinésithérapie spécifique (FTS-Schroth) est préconisée.",
    "reference": "Negrini S et al., 2022 SOSORT guidelines, Scoliosis and Spinal Disorders",
  },

  {
    "id": "BR-RA-012",
    "level": "bronze",
    "domain": "radiologie",
    "question": "Le test de Risser évalue :",
    "type": "mcq",
    "answers": [
      {"text": "L'angle de Cobb résiduel après traitement",              "correct": False, "feedback": "Non."},
      {"text": "La maturité squelettique par l'ossification de l'épiphyse iliaque", "correct": True,  "feedback": "Exact. Le signe de Risser grade l'ossification iliaque de 0 (aucune) à 5 (fusion complète)."},
      {"text": "Le potentiel d'aggravation d'une scoliose",               "correct": False, "feedback": "Le Risser permet d'estimer le potentiel restant mais n'est pas en lui-même une mesure d'aggravation."},
      {"text": "La qualité de la correction chirurgicale",                "correct": False, "feedback": "Non."},
    ],
    "explanation": "Le signe de Risser est coté de 0 à 5. Risser 0 = croissance maximale. Risser 5 = fusion complète de l'apophyse iliaque = fin de la croissance. Un Risser 0-1 implique un risque élevé d'aggravation.",
    "reference": "Risser JC, JBJS 1958",
  },

  {
    "id": "BR-RA-013",
    "level": "bronze",
    "domain": "radiologie",
    "question": "L'indice de Nash-Moe mesure :",
    "type": "mcq",
    "answers": [
      {"text": "L'angle de Cobb dans le plan frontal",   "correct": False, "feedback": "Non, c'est la méthode pour mesurer l'angle de Cobb."},
      {"text": "La rotation des corps vertébraux sur la radiographie de face", "correct": True, "feedback": "Exact. En observant la position du pédicule convexe, on grade la rotation de 0 à 4+."},
      {"text": "La déminéralisation osseuse vertébrale",   "correct": False, "feedback": "Non."},
      {"text": "L'équilibre coronal sur la radiographie entière", "correct": False, "feedback": "Non."},
    ],
    "explanation": "Nash et Moe (1969) ont décrit un système en 5 grades (0 à 4+) basé sur la migration du pédicule du côté convexe vers le centre vertébral sur la radiographie face.",
    "reference": "Nash CL, Moe JH, J Bone Joint Surg, 1969",
  },

  {
    "id": "BR-RA-014",
    "level": "bronze",
    "domain": "radiologie",
    "question": "La SVA (Sagittal Vertical Axis) est la distance entre :",
    "type": "mcq",
    "answers": [
      {"text": "L'apex thoracique et le sacrum",                              "correct": False, "feedback": "Non."},
      {"text": "La verticale passant par le centre de C7 et le coin postérieur de S1", "correct": True,  "feedback": "Exact. La SVA positive (vers l'avant) normale est < 50 mm."},
      {"text": "Les deux épines iliaques antéro-supérieures",                 "correct": False, "feedback": "Non, c'est l'équilibre coronal."},
      {"text": "Le mur postérieur de L5 et celui de S1",                      "correct": False, "feedback": "Non."},
    ],
    "explanation": "Une SVA > 50 mm indique un déséquilibre sagittal antérieur. Au-delà de 95 mm, on parle de déséquilibre sagittal sévère avec impact fonctionnel important (ODI, SRS).",
    "reference": "Glassman SD, Spine 2005",
  },

  {
    "id": "BR-RA-015",
    "level": "bronze",
    "domain": "radiologie",
    "question": "Sur une radiographie de face d'un patient scoliotique, la vertèbre limite supérieure est :",
    "type": "mcq",
    "answers": [
      {"text": "La vertèbre avec l'inclinaison maximale latérale",             "correct": True,  "feedback": "Correct. Les vertèbres limites (supérieure et inférieure) sont les plus inclinées dans le plan fronal."},
      {"text": "La vertèbre avec la rotation maximale",                        "correct": False, "feedback": "C'est la vertèbre apicale."},
      {"text": "La vertèbre la plus haute atteinte par la courbe",             "correct": False, "feedback": "Pas forcément : on cherche le point le plus incliné, pas le plus supérieur."},
      {"text": "La vertèbre adjacente à la courbe principale du côté supérieur", "correct": False, "feedback": "Non."},
    ],
    "explanation": "Les vertèbres limites définissent les extrémités de la courbe mesurée par l'angle de Cobb. Ce sont elles — et non l'apex — qui servent à la mesure.",
  },

  # ═══════════════════════════════════════════════════════════════════════════
  # ARGENT — Biomécanique (40 questions)
  # ═══════════════════════════════════════════════════════════════════════════

  {
    "id": "AR-BM-001",
    "level": "argent",
    "domain": "biomecanique",
    "question": "Dans le modèle éléments finis du rachis, quelle propriété matérielle différencie principalement l'os cortical de l'os spongieux ?",
    "type": "mcq",
    "answers": [
      {"text": "La densité (masse volumique)",                  "correct": False, "feedback": "La densité est différente mais ce n'est pas la propriété la plus discriminante en biomécanique."},
      {"text": "Le module de Young (rigidité)",                 "correct": True,  "feedback": "L'os cortical (~17 GPa) est ~20 fois plus rigide que l'os trabéculaire (~0.1–0.5 GPa)."},
      {"text": "Le coefficient de Poisson",                     "correct": False, "feedback": "Le coefficient de Poisson est similaire (≈0.3) pour les deux types d'os."},
      {"text": "La résistance en torsion uniquement",           "correct": False, "feedback": "Non."},
    ],
    "explanation": "L'os cortical a un module de Young d'environ 14–22 GPa, contre 0.1–2 GPa pour l'os trabéculaire. Cette différence est critique pour la distribution des contraintes dans les modèles EF.",
    "reference": "Cowin SC, Bone Mechanics Handbook, 2001",
  },

  {
    "id": "AR-BM-002",
    "level": "argent",
    "domain": "biomecanique",
    "question": "La méthode des éléments finis (MEF) permet de calculer :",
    "type": "msq",
    "answers": [
      {"text": "Les déplacements nodaux sous chargement",                      "correct": True,  "feedback": "C'est la sortie principale de la MEF : résoudre K·u = F."},
      {"text": "Les contraintes et déformations internes",                     "correct": True,  "feedback": "Dérivées des déplacements via les relations de compatibilité."},
      {"text": "La synthèse pharmacologique des médicaments analgésiques",     "correct": False, "feedback": "Aucun lien avec la MEF."},
      {"text": "Les facteurs de risque de fracture vertébrale",                "correct": True,  "feedback": "Par comparaison avec les critères de rupture (von Mises, Drucker-Prager)."},
    ],
    "explanation": "La MEF résout l'équation K·u = F (rigidité × déplacements = forces) pour obtenir déplacements, puis contraintes et déformations dans chaque élément.",
  },

  {
    "id": "AR-BM-003",
    "level": "argent",
    "domain": "biomecanique",
    "question": "L'angle de convergence recommandé pour une vis pédiculaire lombaire est généralement :",
    "type": "mcq",
    "answers": [
      {"text": "0° (parallèle au plateau vertébral)",  "correct": False, "feedback": "Un angle de 0° risque de passer dans le disque ou d'être tangent au pédicule."},
      {"text": "10° – 25° médiaux",                   "correct": True,  "feedback": "L'angulation médio-latérale de 10-25° suit l'axe du pédicule vers le corps vertébral."},
      {"text": "45° médiaux",                          "correct": False, "feedback": "45° serait dangereux et risquerait une effraction médiale vers le canal rachidien."},
      {"text": "90° (perpendiculaire au plateau)",      "correct": False, "feedback": "Non."},
    ],
    "explanation": "L'angulation médiale (10-25° selon le niveau) permet d'engager le pédicule en sécurité. L'angulation caudale (-5 à -15°) suit la pente du plateau vertébral lombaire.",
  },

  {
    "id": "AR-BM-004",
    "level": "argent",
    "domain": "biomecanique",
    "question": "La force d'arrachage (pull-out force) d'une vis pédiculaire est principalement déterminée par :",
    "type": "msq",
    "answers": [
      {"text": "La densité minérale osseuse (DMO)",       "correct": True,  "feedback": "La DMO est le facteur le plus corrélé à la force d'arrachement."},
      {"text": "Le diamètre de la vis",                   "correct": True,  "feedback": "Un diamètre plus grand augmente la surface d'ancrage."},
      {"text": "La longueur de la vis",                   "correct": True,  "feedback": "Une vis plus longue a plus de filets en contact."},
      {"text": "La couleur du titane",                    "correct": False, "feedback": "La couleur n'a aucun effet mécanique."},
    ],
    "explanation": "La formule de Chapman (1996) : F_pullout ≈ k × DMO × d × l. Une DMO < 0.65 g/cm² (ostéoporose sévère) réduit drastiquement la force d'arrachement.",
    "reference": "Chapman JR et al., Spine 1996",
  },

  {
    "id": "AR-BM-005",
    "level": "argent",
    "domain": "biomecanique",
    "question": "La scoliose idiopathique de l'adolescent (SIA) est définie par :",
    "type": "msq",
    "answers": [
      {"text": "Un angle de Cobb ≥ 10° dans le plan frontal",              "correct": True,  "feedback": "C'est le seuil diagnostique minimal."},
      {"text": "L'absence de cause neurologique, osseuse ou musculaire identifiable", "correct": True,  "feedback": "Le terme 'idiopathique' signifie sans cause identifiée."},
      {"text": "Un début systématiquement avant l'âge de 3 ans",           "correct": False, "feedback": "La SIA débute à l'adolescence (10-18 ans typiquement). Avant 5 ans = scoliose infantile."},
      {"text": "Une composante rotatoire des corps vertébraux",             "correct": True,  "feedback": "La rotation vertébrale est une composante 3D caractéristique."},
    ],
    "explanation": "La SIA est tridimensionnelle (déviation frontale + rotation + anomalie sagittale). Elle touche 2-3 % de la population avec un ratio filles/garçons de 7:1 pour les courbes évolutives.",
    "reference": "Weinstein SL, Dolan LA — Lancet 2008",
  },

  {
    "id": "AR-BM-006",
    "level": "argent",
    "domain": "biomecanique",
    "question": "La classification de King (1983) de la scoliose idiopathique est basée sur :",
    "type": "mcq",
    "answers": [
      {"text": "La morphologie des pédicules uniquement",                   "correct": False, "feedback": "Non."},
      {"text": "La localisation, l'amplitude et l'équilibre coronal des courbes", "correct": True,  "feedback": "Exact. King divise les scolioses en 5 types selon la topographie et l'équilibre."},
      {"text": "L'âge d'apparition et la maturité osseuse",                "correct": False, "feedback": "Non, c'est un critère clinique mais pas le fondement de la classification de King."},
      {"text": "La réponse au corset orthopédique",                        "correct": False, "feedback": "Non."},
    ],
    "explanation": "King décrit 5 types : I (courbe lombaire > thoracique), II (thoracique > lombaire), III (thoracique seule), IV (thoracique longue), V (double thoracique). Largement remplacée par Lenke (2001).",
    "reference": "King HA et al., JBJS 1983",
  },

  {
    "id": "AR-BM-007",
    "level": "argent",
    "domain": "biomecanique",
    "question": "Lors de la mise en place d'une tige de correction scoliotique, quel matériau offre la plus grande rigidité ?",
    "type": "mcq",
    "answers": [
      {"text": "Titane (Ti-6Al-4V)",         "correct": False, "feedback": "Le titane est moins rigide que le cobalt-chrome mais plus biocompatible et plus léger."},
      {"text": "Cobalt-Chrome (CoCrMo)",     "correct": True,  "feedback": "Le cobalt-chrome (E ≈ 220 GPa) est plus rigide que le titane (E ≈ 110 GPa)."},
      {"text": "Acier inoxydable 316L",      "correct": False, "feedback": "L'acier inox (E ≈ 200 GPa) est moins utilisé à cause des problèmes d'imagerie MRI."},
      {"text": "Nitinol (alliage mémoire)", "correct": False, "feedback": "Le Nitinol est utilisé pour les dispositifs de croissance, pas pour la rigidité. E ≈ 40-83 GPa."},
    ],
    "explanation": "Le cobalt-chrome est 2× plus rigide que le titane. Pour de longs montages (T4-L4), sa rigidité supérieure peut au contraire majorer le risque de DJK (Degenerative Junctional Kyphosis).",
    "reference": "Luo M et al., Spine J 2017",
  },

  {
    "id": "AR-BM-008",
    "level": "argent",
    "domain": "biomecanique",
    "question": "Dans le modèle éléments finis du rachis VERTEX, le solveur linéaire conjugu proposé est : ",
    "type": "mcq",
    "answers": [
      {"text": "LU factorization (décomposition directe)",      "correct": False, "feedback": "La décomposition LU est directe, pas itérative."},
      {"text": "Gradient Conjugué (CG) avec préconditionneur Jacobi", "correct": True,  "feedback": "Exact. Le préconditionneur Jacobi divise par diag(K), accélérant la convergence."},
      {"text": "Méthode de Gauss-Seidel",                      "correct": False, "feedback": "Le Gauss-Seidel est une autre méthode itérative, moins efficace sur les systèmes SPD."},
      {"text": "Méthode de puissance inverse",                 "correct": False, "feedback": "La méthode de puissance est pour les valeurs propres, pas pour Ku=F."},
    ],
    "explanation": "Le Gradient Conjugué (CG) est optimal pour les matrices SPD (Symmetric Positive Definite) comme la matrice de rigidité K. La convergence en √(κ(K)) itérations, améliorée par le préconditionneur.",
  },

  # ═══════════════════════════════════════════════════════════════════════════
  # OR — Planification chirurgicale (40 questions)
  # ═══════════════════════════════════════════════════════════════════════════

  {
    "id": "OR-CH-001",
    "level": "or",
    "domain": "chirurgie",
    "question": "La classification de Lenke (2001) nécessite 3 paramètres pour déterminer le type de scoliose. Lesquels ?",
    "type": "msq",
    "answers": [
      {"text": "Le type de courbe (1-6)",               "correct": True,  "feedback": "Les 6 types sont basés sur la localisation et la taille relative des courbes."},
      {"text": "Le modificateur lombaire (A, B ou C)",  "correct": True,  "feedback": "Évalue la position de la vertèbre L4 par rapport à la verticale centrale du sacrum (CSVL)."},
      {"text": "Le modificateur sagittal thoracique (-, N, +)", "correct": True,  "feedback": "Évalue la cyphose T5-T12 : - (<10°), N (10-40°), + (>40°)."},
      {"text": "L'angle pelvien (PI)",                  "correct": False, "feedback": "L'incidence pelvienne n'est pas dans la classification de Lenke."},
    ],
    "explanation": "La classification de Lenke (Type 1-6 × Modificateur lombaire A/B/C × Modificateur sagittal -/N/+) génère 42 sous-types théoriques. Elle guide la décision sur les niveaux à instrumenter.",
    "reference": "Lenke LG et al., Spine 2001",
  },

  {
    "id": "OR-CH-002",
    "level": "or",
    "domain": "chirurgie",
    "question": "Pour un Lenke 1A-, quel est généralement le schéma d'instrumentation recommandé ?",
    "type": "mcq",
    "answers": [
      {"text": "Fusion sélective de la courbe thoracique uniquement (leaving the lumbar curve unfused)", "correct": True, "feedback": "Le Lenke 1A- avec modificateur A (courbe lombaire < CSVL) permet généralement une fusion sélective thoracique."},
      {"text": "Fusion thoraco-lombaire systématique jusqu'à L5",   "correct": False, "feedback": "Non, le modificateur A indique que la courbe lombaire peut être laissée non instrumentée."},
      {"text": "Fusion L1-L5 sans la courbe thoracique",            "correct": False, "feedback": "Non, la courbe thoracique est la courbe principale dans Lenke 1."},
      {"text": "Vertébrectomie thoracique systématique",             "correct": False, "feedback": "Non."},
    ],
    "explanation": "Le Lenke 1A est le type le plus courant de SIA. La fusion sélective thoracique (T4-T12 typiquement) avec immobilisation par tige est la stratégie standard. Le modificateur A signifie que la courbe lombaire est compensatrice.",
    "reference": "Lenke LG, Scoliosis 2007",
  },

  {
    "id": "OR-CH-003",
    "level": "or",
    "domain": "chirurgie",
    "question": "Le score chirurgical VERTEX (/100) est construit à partir de (cocher toutes les propositions vraies) :",
    "type": "msq",
    "answers": [
      {"text": "Le pourcentage de correction de l'angle de Cobb",  "correct": True,  "feedback": "Jusqu'à 40 points selon le niveau de correction."},
      {"text": "L'équilibre sagittal post-opératoire (SVA)",        "correct": True,  "feedback": "20 points si SVA normalisée."},
      {"text": "La précision du placement des vis pédiculaires",    "correct": True,  "feedback": "15 points selon le taux de breach."},
      {"text": "Le temps opératoire",                               "correct": False, "feedback": "Le temps opératoire n'est pas un paramètre du score VERTEX."},
    ],
    "explanation": "Le score VERTEX = Correction Cobb (40 pts) + Équilibre sagittal (20 pts) + Placement vis (15 pts) + Balance (20 pts) + Bonus SVA normalisée (5 pts) = 100 pts.",
  },

  {
    "id": "OR-CH-004",
    "level": "or",
    "domain": "chirurgie",
    "question": "La complication PJK (Proximal Junctional Kyphosis) survient :",
    "type": "mcq",
    "answers": [
      {"text": "Au niveau de la vertèbre instrumented la plus basse",   "correct": False, "feedback": "Non, DJK (Distal) pour le bas."},
      {"text": "À la jonction entre la vertèbre instrumentée la plus haute et la vertèbre sus-jacente libre", "correct": True, "feedback": "Exact. Le PJK crée une kyphose excessive aux 2 vertèbres au-dessus de la fusion."},
      {"text": "Au milieu de la tige de correction",                    "correct": False, "feedback": "Non."},
      {"text": "Au niveau L5-S1 exclusivement",                        "correct": False, "feedback": "Non."},
    ],
    "explanation": "La PJK est définie par un angle > 10° entre la vertèbre UIV+1 et UIV dans le plan sagittal. Son incidence est de 17-46 % selon les séries. Les facteurs de risque incluent un long montage et un patient âgé.",
    "reference": "Kim YJ et al., Spine 2003",
  },

  {
    "id": "OR-CH-005",
    "level": "or",
    "domain": "chirurgie",
    "question": "La manœuvre de Cotrel-Dubousset (rotation de la tige) a pour objectif principal :",
    "type": "mcq",
    "answers": [
      {"text": "Réduire la lordose lombaire",                               "correct": False, "feedback": "Non."},
      {"text": "Convertir la courbure coronale en cyphose sagittale (dérotation in situ)", "correct": True,  "feedback": "Exact. On 'bascule' la courbure scoliotique coronale dans le plan sagittal pour rétablir la cyphose thoracique."},
      {"text": "Augmenter la pression sur les vis pédiculaires",            "correct": False, "feedback": "Non, c'est un effet secondaire indésirable."},
      {"text": "Prévenir les complications neurologiques",                  "correct": False, "feedback": "Non."},
    ],
    "explanation": "La technique CD consiste à pré-cintrer la tige en cyphose puis à la faire pivoter de 90° pour transformer la courbure frontale en cyphose sagittale, corrigeant simultanément la rotation.",
    "reference": "Cotrel Y, Dubousset J — Nouvelle technique d'ostéosynthèse rachidienne, Revue de Chirurgie Orthopédique, 1984",
  },

  # ═══════════════════════════════════════════════════════════════════════════
  # DIAMANT — Cas complexes et expertise (30 questions)
  # ═══════════════════════════════════════════════════════════════════════════

  {
    "id": "DI-EX-001",
    "level": "diamant",
    "domain": "chirurgie",
    "question": "Chez un patient adulte de 67 ans (T-score -2.8) nécessitant une correction T10-S1, quelle stratégie d'augmentation d'ancrage est recommandée ?",
    "type": "msq",
    "answers": [
      {"text": "Vis iliaques bilatérales pour ancrage pelvi-sacré",        "correct": True,  "feedback": "L'ancrage iliaque renforce significativement la fixation distale en cas d'ostéoporose."},
      {"text": "Cimentation des vis pédiculaires (PMMA ou CaP)",           "correct": True,  "feedback": "La cimentation augmente la force d'arrachement de 2-3× en os ostéoporotique."},
      {"text": "Toutes les vis remplacées par des agrafes vertébrales",    "correct": False, "feedback": "Les agrafes ne sont pas indiquées pour la correction de déformité adulte."},
      {"text": "Traitement préopératoire par tériparatide (Forteo) si possible", "correct": True,  "feedback": "Le tériparatide améliore la DMO osseuse en 6-12 mois, réduisant le risque de défaillance d'ancrage."},
    ],
    "explanation": "La chirurgie de la déformité adulte en contexte ostéoporotique requiert : cimentation des vis aux niveaux juxta-jonctionnels, ancrage iliaque pour S1-S2, ± biologie anabolique pré-op.",
    "reference": "Kebaish KM, Neurourgery 2019",
  },

  {
    "id": "DI-EX-002",
    "level": "diamant",
    "domain": "chirurgie",
    "question": "La corrélation entre le Cobb résiduel post-opératoire et la qualité de vie (ODI, SRS-22) est la plus forte pour :",
    "type": "mcq",
    "answers": [
      {"text": "L'angle de Cobb < 20°",                  "correct": False, "feedback": "Vrai mais ce n'est pas l'indicateur le plus corrélé."},
      {"text": "L'équilibre sagittal (SVA < 50 mm)",      "correct": True,  "feedback": "L'équilibre sagittal est le paramètre le plus corrélé aux scores de qualité de vie post-opératoires."},
      {"text": "L'absence de gibbosité visible",          "correct": False, "feedback": "La gibbosité est un critère esthétique important mais moins corrélé à la QdV fonctionnelle."},
      {"text": "La disparition totale de la douleur",     "correct": False, "feedback": "Même avec douleur résiduelle, l'équilibre sagittal prédit mieux la QdV."},
    ],
    "explanation": "Glassman (Spine 2005) a démontré que la SVA est le paramètre radiographique le plus fortement corrélé (r²=0.74) aux scores SRS, ODI et SF-36 à 2 ans.",
    "reference": "Glassman SD et al., Spine 2005",
  },

  {
    "id": "DI-EX-003",
    "level": "diamant",
    "domain": "chirurgie",
    "question": "En cas de scoliose neurogène secondaire à une syringomyélie, quelle précaution est indispensable avant la chirurgie ?",
    "type": "mcq",
    "answers": [
      {"text": "IRM médullaire pour évaluer la syrinx et exclure une malformation d'Arnold-Chiari", "correct": True, "feedback": "Exact. La syringomyélie est souvent associée à une malformation de Chiari ou une obstruction du LCR."},
      {"text": "Test de Schober lombaire",                                    "correct": False, "feedback": "Le Schober teste la mobilité lombaire, pas pertinent ici."},
      {"text": "EEG (électroencéphalogramme)",                               "correct": False, "feedback": "Non pertinent pour la planification."},
      {"text": "Scintigraphie osseuse systématique",                         "correct": False, "feedback": "Non."},
    ],
    "explanation": "Toute scoliose atypique (dans le sens des aiguilles d'une montre, gauche, ou évolutive rapidement) doit faire éliminer une lésion intra-rachidienne (syrinx, tumeur) par IRM médullaire avant chirurgie.",
    "reference": "Gupta P, Lenke LG, Spine 1998",
  },

  {
    "id": "DI-EX-004",
    "level": "diamant",
    "domain": "biomecanique",
    "question": "Le modèle mathématique de remodelage osseux (loi de Wolff computationnelle) dans VERTEX utilise :",
    "type": "mcq",
    "answers": [
      {"text": "Seulement la densité minérale osseuse initiale (statique)",   "correct": False, "feedback": "Non, la loi de remodelage est dynamique."},
      {"text": "La contrainte effective locale pour adapter la densité osseuse longitudinalement", "correct": True, "feedback": "Exact. Si contrainte > seuil (+10%), ostéogenèse. Si contrainte < seuil (-10%), résorption."},
      {"text": "Le Ca²⁺ sérique comme signal de remodelage",                  "correct": False, "feedback": "Le calcium n'est pas intégré dans le modèle numérique."},
      {"text": "La température corporelle",                                   "correct": False, "feedback": "Non."},
    ],
    "explanation": "La loi de Wolff computationnelle (Huiskes 1987) adapte la densité osseuse locale ρ selon l'énergie de déformation : dρ/dt = c × (σ_eff - σ_ref). Intégrée dans VERTEX pour les simulations longitudinales.",
    "reference": "Huiskes R et al., J Biomech 1987",
  },

  {
    "id": "DI-EX-005",
    "level": "diamant",
    "domain": "chirurgie",
    "question": "Lors d'une ostéotomie de type 3 (Smith-Petersen / Ponte), quelle est la correction segmentaire attendue par niveau ?",
    "type": "mcq",
    "answers": [
      {"text": "2° – 5°",  "correct": False, "feedback": "C'est trop peu — les SPO bien réalisées corrigent davantage."},
      {"text": "5° – 10°", "correct": True,  "feedback": "Exact. Chaque ostéotomie de Ponte donne 5-10° de correction en extension."},
      {"text": "15° – 20°", "correct": False, "feedback": "Ce serait une PSO (Pedicle Subtraction Osteotomy), type 4."},
      {"text": "30° – 40°", "correct": False, "feedback": "Ce serait une VCR (Vertebral Column Resection), type 6."},
    ],
    "explanation": "Les ostéotomies selon la classification de Schwab-SRS : type 3 (SPO/Ponte) : 5-10°, type 4 (PSO) : 25-35°, type 5 (decancellization) : 35°+, type 6 (VCR) : 40°+.",
    "reference": "Schwab FJ et al., SRS classification of adult spinal deformity, Spine 2012",
  },
]


if __name__ == "__main__":
    import json
    from pathlib import Path

    out = Path(__file__).parent / "questions_atlas.json"
    with out.open("w", encoding="utf-8") as f:
        json.dump({"version": "1.0", "total": len(questions), "questions": questions}, f,
                  ensure_ascii=False, indent=2)
    print(f"✅ {len(questions)} questions exportées → {out}")

    # Résumé par niveau et domaine
    from collections import Counter
    by_level  = Counter(q["level"]  for q in questions)
    by_domain = Counter(q["domain"] for q in questions)
    print("\nPar niveau :", dict(by_level))
    print("Par domaine:", dict(by_domain))
