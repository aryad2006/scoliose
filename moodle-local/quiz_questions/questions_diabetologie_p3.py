"""
VERTEX© — Banque de questions Diabétologie — Partie 3 (Bronze + Argent supplémentaires)
"""

questions_bronze_sup = [

  {
    "id": "DIAB-BR-016",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "Quel est le mécanisme de l'hyperglycémie dans le diabète de type 2 au niveau hépatique ?",
    "type": "mcq",
    "answers": [
      {"text": "Excès de sécrétion d'insuline par le pancréas", "correct": False, "feedback": "Le DT2 est caractérisé par une insulinorésistance, pas un excès d'insuline."},
      {"text": "Production hépatique de glucose non freinée (néoglucogenèse + glycogénolyse) par insulinorésistance hépatique", "correct": True, "feedback": "Exact. Le foie résistant à l'insuline continue à produire du glucose même en période post-prandiale → hyperglycémie à jeun."},
      {"text": "Destruction des hépatocytes par infiltration lymphocytaire", "correct": False, "feedback": "Non. Ce n'est pas le mécanisme du DT2."},
      {"text": "Excès d'absorption intestinale du glucose", "correct": False, "feedback": "Non, bien que ce mécanisme soit partiellement impliqué, ce n'est pas le principal."},
    ],
    "explanation": "Dans le DT2 : insulinorésistance hépatique → la néoglucogenèse et glycogénolyse ne sont pas inhibées après les repas → hyperglycémie à jeun et post-prandiale. La metformine agit précisément sur ce mécanisme (inhibition AMPK).",
    "reference": "DeFronzo RA — Triumvirate to Ominous Octet, Diabetes 2009",
  },

  {
    "id": "DIAB-BR-017",
    "level": "bronze",
    "domain": "diagnostic",
    "question": "Un patient de 55 ans a une GAJ à 1,15 g/L à deux reprises. Comment classifiez-vous cette situation ?",
    "type": "mcq",
    "answers": [
      {"text": "Diabète — traitement médicamenteux immédiat", "correct": False, "feedback": "Non. Le seuil du diabète est GAJ ≥ 1,26 g/L."},
      {"text": "Anomalie de la glycémie à jeun (AGJ) = prédiabète", "correct": True, "feedback": "Exact. AGJ = GAJ entre 1,10 et 1,25 g/L. Stade de prédiabète : risque de progression vers le DT2 de 5-10%/an. Intervention sur le mode de vie recommandée."},
      {"text": "Normal — aucune prise en charge nécessaire", "correct": False, "feedback": "Non. 1,15 g/L dépasse le seuil normal (< 1,00 g/L). C'est une AGJ à surveiller et traiter par MHD."},
      {"text": "Intolérance au glucose — HGPO nécessaire pour confirmer", "correct": False, "feedback": "L'intolérance au glucose (ITG) est diagnostiquée à l'HGPO (glycémie 2h entre 1,40 et 1,99 g/L), pas par la seule GAJ."},
    ],
    "explanation": "Stades de dysrégulation glycémique : Normal (GAJ < 1,00), AGJ (1,10-1,25), DT2 (≥ 1,26). L'AGJ est un stade de prédiabète. Interventions : activité physique 150 min/semaine, perte de poids 5-7%, alimentation équilibrée. La metformine peut être discutée si HbA1c 5,7-6,4% avec facteurs de risque.",
    "reference": "ADA 2024 — Prediabetes",
  },

  {
    "id": "DIAB-BR-018",
    "level": "bronze",
    "domain": "traitement",
    "question": "Un patient DT2 sous metformine 1000 mg × 2 doit être opéré sous anesthésie générale demain matin. Quelle consigne donnez-vous pour la metformine ?",
    "type": "mcq",
    "answers": [
      {"text": "Continuer la metformine comme d'habitude le matin de l'opération", "correct": False, "feedback": "Non. La metformine doit être arrêtée avant une chirurgie (risque d'acidose lactique si hypoperfusion per-opératoire)."},
      {"text": "Arrêter la metformine 48h avant la chirurgie et ne reprendre qu'après 48h post-op si la fonction rénale est normale", "correct": True, "feedback": "Exact. Protocole standard : arrêt 48h avant chirurgie majeure + reprise 48h après si DFG stable."},
      {"text": "Doubler la dose de metformine la veille pour couvrir le jeûne", "correct": False, "feedback": "Non. C'est contre-indiqué et dangereux."},
      {"text": "Remplacer par un sulfamide la veille de l'opération", "correct": False, "feedback": "Non. Les sulfamides posent un risque d'hypoglycémie pendant le jeûne pré-opératoire."},
    ],
    "explanation": "Metformine péri-opératoire : arrêt 48h avant toute chirurgie majeure (risque d'acidose lactique si hypoperfusion, insuffisance rénale aiguë ou hypoxie). Reprise 48h post-op si DFG ≥ 45 et stabilité hémodynamique. Pendant l'arrêt : insuline SC si hyperglycémie > 1,80 g/L.",
    "reference": "HAS 2023 — Metformine et chirurgie",
  },

  {
    "id": "DIAB-BR-019",
    "level": "bronze",
    "domain": "complications",
    "question": "Le test au monofilament de Semmes-Weinstein explore quelle fonction nerveuse dans le dépistage de la neuropathie diabétique ?",
    "type": "mcq",
    "answers": [
      {"text": "La sensibilité vibratoire profonde (pallesthésie)", "correct": False, "feedback": "La pallesthésie est évaluée par le diapason (128 Hz) sur les malléoles."},
      {"text": "La sensibilité protectrice au toucher épicritique (10 g)", "correct": True, "feedback": "Exact. Le monofilament 10g de Semmes-Weinstein évalue la sensibilité protectrice. Son absence = risque majeur d'ulcération plantaire (pied insensible)."},
      {"text": "La force musculaire distale (extenseurs orteils)", "correct": False, "feedback": "La force musculaire est évaluée par le testing musculaire, pas le monofilament."},
      {"text": "Les réflexes ostéo-tendineux achilléens", "correct": False, "feedback": "Les ROT achilléens sont une composante distincte de l'examen neurologique du pied."},
    ],
    "explanation": "Examen neuropathique du pied diabétique (IWGDF 2023) : monofilament 10g (sensibilité protectrice), diapason 128Hz (vibration), pique-touche (douleur), chaud-froid (température), ROT. Pied à risque : monofilament non perçu en ≥ 1 point sur 10 sites testés.",
    "reference": "IWGDF Guidance 2023 — Prevention of Foot Ulcers",
  },

  {
    "id": "DIAB-BR-020",
    "level": "bronze",
    "domain": "urgences",
    "question": "Dans l'acidocétose diabétique, pourquoi les bicarbonates IV ne sont-ils généralement PAS recommandés ?",
    "type": "msq",
    "answers": [
      {"text": "Aggravation de l'hypokaliémie (le bicarbonate fait entrer le K+ dans les cellules)", "correct": True, "feedback": "Exact. L'apport de bicarbonate alcalinise le plasma → le K+ passe intracellulaire → hypokaliémie aggravée → risque d'arythmie."},
      {"text": "Risque d'œdème cérébral par alcalinisation rapide (surtout chez l'enfant)", "correct": True, "feedback": "Exact. La correction trop rapide de l'acidose peut précipiter un œdème cérébral."},
      {"text": "Augmentation paradoxale de la cétonémie par activation de la lipolyse", "correct": False, "feedback": "Non. Les bicarbonates n'augmentent pas directement la lipolyse."},
      {"text": "Ils sont réservés aux pH < 6,90 (acidose extrême menaçant le cœur)", "correct": True, "feedback": "Exact. Les bicarbonates peuvent être discutés si pH < 6,90 (risque d'instabilité cardiaque) mais restent controversés."},
    ],
    "explanation": "Bicarbonates dans l'ACD : non recommandés sauf pH < 6,90. Risques : hypokaliémie aggravée, œdème cérébral (enfant), paradoxe de l'acidose cérébrale (le CO2 produit passe la barrière hémato-encéphalique plus vite que le bicarbonate). La résolution de l'ACD par insuline + hydratation suffit dans la majorité des cas.",
    "reference": "ADA 2024 — DKA bicarbonate controversy",
  },

  {
    "id": "DIAB-BR-021",
    "level": "bronze",
    "domain": "traitement",
    "question": "Parmi les effets indésirables suivants, lequel est spécifique aux inhibiteurs de SGLT2 (iSGLT2) ?",
    "type": "mcq",
    "answers": [
      {"text": "Pancréatite aiguë", "correct": False, "feedback": "La pancréatite est un effet rare des GLP-1 RA et iDPP4."},
      {"text": "Infections génitales mycosiques (candidoses vulvo-vaginales et balanites)", "correct": True, "feedback": "Exact. La glycosurie (mécanisme d'action des iSGLT2) favorise la prolifération de Candida dans la région génitale. Fréquence : 5-10% des patients."},
      {"text": "Acidose lactique", "correct": False, "feedback": "L'acidose lactique est le risque de la metformine."},
      {"text": "Hyponatrémie sévère", "correct": False, "feedback": "Les iSGLT2 peuvent légèrement augmenter le sodium (effet osmotique), pas le réduire."},
    ],
    "explanation": "iSGLT2 effets indésirables spécifiques : 1. Infections génitales mycosiques (glycosurie → milieu sucré propice à Candida), 2. Infections urinaires (moins fréquentes), 3. Acidocétose euglycémique (rare mais grave, surtout si jeûne ou chirurgie), 4. Gangrène de Fournier (très rare). À suspendre en cas de chirurgie ou jeûne prolongé.",
    "reference": "HAS 2023 — iSGLT2 profil de tolérance",
  },

  {
    "id": "DIAB-BR-022",
    "level": "bronze",
    "domain": "diagnostic",
    "question": "Quelle est la fréquence recommandée du dosage de l'HbA1c chez un patient DT2 stable sous traitement oral ?",
    "type": "mcq",
    "answers": [
      {"text": "Tous les mois", "correct": False, "feedback": "Non. L'HbA1c reflète 3 mois — la doser tous les mois n'apporte pas d'information supplémentaire."},
      {"text": "Tous les 3 mois si déséquilibre ou changement de traitement, tous les 6 mois si stable", "correct": True, "feedback": "Exact. HAS 2023 : HbA1c tous les 3 mois si objectif non atteint ou traitement modifié, tous les 6 mois si objectif atteint et stable."},
      {"text": "Une fois par an uniquement", "correct": False, "feedback": "Insuffisant. Une HbA1c annuelle ne permet pas d'adapter le traitement en temps utile."},
      {"text": "Uniquement si symptômes (polyurie, polydipsie)", "correct": False, "feedback": "Non. L'HbA1c est un suivi systématique, indépendant des symptômes."},
    ],
    "explanation": "Suivi biologique du DT2 (HAS 2023) : HbA1c tous les 3 mois si déséquilibre ou ajustement thérapeutique, tous les 6 mois si stable à l'objectif. Autres bilans annuels : RAC, DFG, bilan lipidique, microalbuminurie, fond d'œil.",
    "reference": "HAS 2023 — Protocole de suivi DT2",
  },

  {
    "id": "DIAB-BR-023",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "Le syndrome 'somogyi' ou hyperglycémie de rebond est :",
    "type": "mcq",
    "answers": [
      {"text": "Une hyperglycémie matinale due à la sécrétion nocturne de GH et cortisol (phénomène de l'aube)", "correct": False, "feedback": "C'est le 'phénomène de l'aube' (dawn phenomenon), différent du Somogyi."},
      {"text": "Une hyperglycémie matinale en réponse à une hypoglycémie nocturne non perçue (contre-régulation hormonale excessive)", "correct": True, "feedback": "Exact. Somogyi : hypoglycémie nocturne → sécrétion de glucagon, adrénaline, cortisol, GH → hyperglycémie rebond matinale. Le piège : augmenter l'insuline aggrave le cycle."},
      {"text": "Une hypoglycémie post-prandiale 3-4h après le repas", "correct": False, "feedback": "C'est le late dumping ou l'hypoglycémie réactionnelle post-prandiale."},
      {"text": "Une hyperglycémie persistante due à la résistance aux sulfamides", "correct": False, "feedback": "Non. L'échappement aux sulfamides est un phénomène différent."},
    ],
    "explanation": "Somogyi vs phénomène de l'aube : les deux donnent une hyperglycémie matinale. Distinction par CGM nocturne : si hypoglycémie entre 2h-4h du matin = Somogyi (réduire l'insuline du soir). Si glycémie normale jusqu'à 4h puis hausse = phénomène de l'aube (augmenter la basale du soir ou décaler l'injection).",
    "reference": "Porcellati F et al., Diabetes Care 2013",
  },

  {
    "id": "DIAB-BR-024",
    "level": "bronze",
    "domain": "traitement",
    "question": "Les GLP-1 RA (sémaglutide, liraglutide) sont contre-indiqués en cas de :",
    "type": "msq",
    "answers": [
      {"text": "Antécédent personnel ou familial de carcinome médullaire de la thyroïde (CMT)", "correct": True, "feedback": "Exact. Le GLP-1 stimule la prolifération des cellules C thyroïdiennes (données murines). CI si ATCD CMT ou NEM2."},
      {"text": "Pancréatite chronique ou aiguë en cours", "correct": True, "feedback": "Exact. Bien que la causalité soit débattue, les GLP-1 RA sont contre-indiqués en cas de pancréatite active ou d'antécédent de pancréatite grave."},
      {"text": "Insuffisance rénale légère (DFG 50-60 mL/min)", "correct": False, "feedback": "Non. Les GLP-1 RA (sémaglutide, liraglutide) sont utilisables jusqu'à DFG 15 (dulaglutide) ou DFG 30 (sémaglutide oral). Prudence en cas de déshydratation."},
      {"text": "DT1 (sans peptide C résiduel)", "correct": False, "feedback": "Non contre-indication formelle, mais les GLP-1 RA sont peu efficaces en l'absence de sécrétion résiduelle et ne remplacent pas l'insuline."},
    ],
    "explanation": "CI des GLP-1 RA : CMT personnel ou familial, NEM type 2, pancréatite sévère ATCD. Précautions : gastroparésie (la vidange gastrique ralentie peut être aggravée), grossesse (données insuffisantes), DFG < 15 pour certaines molécules.",
    "reference": "EASD/ADA 2023 — GLP-1 RA prescribing information",
  },

  {
    "id": "DIAB-BR-025",
    "level": "bronze",
    "domain": "complications",
    "question": "La classification de la rétinopathie diabétique comprend (du moins grave au plus grave) :",
    "type": "mcq",
    "answers": [
      {"text": "Pas de RD → RDNP légère → RDNP modérée → RDNP sévère → RDP", "correct": True, "feedback": "Exact. Classification internationale ETDRS : RDNP = rétinopathie diabétique non proliférante (légère/modérée/sévère), RDP = proliférante (néovaisseaux). La maculopathie est une complication à part."},
      {"text": "Pas de RD → RDP légère → RDNP → RDP sévère", "correct": False, "feedback": "Incorrect. La RDNP précède toujours la RDP dans la progression."},
      {"text": "Fond d'œil normal → microanévrismes → exsudats durs → néovaisseaux → décollement", "correct": False, "feedback": "Ce sont des signes anatomiques, pas la classification stadifiée officielle."},
      {"text": "Grade 1 à 5 selon l'échelle de Diabetic Retinopathy Study", "correct": False, "feedback": "L'échelle numérique n'est pas l'appellation standard internationale utilisée en clinique."},
    ],
    "explanation": "Classification ETDRS 2002 : Pas de RD → RDNP légère (quelques microanévrismes) → RDNP modérée → RDNP sévère (règle 4-2-1 : hémorragies 4 quadrants OU anomalies veineuses 2 quadrants OU anomalies microvasculaires 1 quadrant) → RDP (néovaisseaux). La RDP nécessite une photocoagulation panrétinienne (PPR).",
    "reference": "Early Treatment Diabetic Retinopathy Study — ETDRS Report 1991",
  },

]  # fin bronze_sup


questions_argent_sup = [

  {
    "id": "DIAB-AR-016",
    "level": "argent",
    "domain": "traitement",
    "question": "Un patient DT1 utilise le système Medtronic 780G en mode Auto (boucle fermée hybride). Son TIR est de 68% avec un TBR < 54 mg/dL à 2%. Pour améliorer son TIR, quelle est la première intervention ?",
    "type": "mcq",
    "answers": [
      {"text": "Augmenter la cible glycémique de l'algorithme de 100 à 140 mg/dL", "correct": False, "feedback": "Non. Augmenter la cible réduit les hypoglycémies mais risque d'augmenter le TAR et de réduire le TIR."},
      {"text": "Analyser les périodes de TAR sur le rapport AGP et optimiser la précision du comptage glucidique", "correct": True, "feedback": "Exact. Le TIR de 68% est proche de l'objectif (70%). La principale cause de TAR est le bolus prandial impprécis (glucides sous-estimés). L'analyse AGP identifie les créneaux à améliorer."},
      {"text": "Passer immédiatement à la transplantation d'îlots", "correct": False, "feedback": "Non. TIR 68% ne justifie pas une procédure invasive."},
      {"text": "Ajouter de la metformine pour réduire l'insulinorésistance", "correct": False, "feedback": "La metformine peut être discutée en complément dans le DT1 adulte mais n'est pas la 1ère étape."},
    ],
    "explanation": "Optimisation d'une boucle fermée hybride : 1. Analyse du rapport AGP (identifier créneaux TAR/TBR), 2. Ajuster les ratios I/C si TAR post-prandiaux systématiques, 3. Améliorer la précision du comptage glucidique, 4. Ajuster le profil basal si TAR nocturnes. Le TIR de 68% est à 2 points de l'objectif — optimisation ciblée suffisante.",
    "reference": "Battelino T et al., Diabetes Care 2023",
  },

  {
    "id": "DIAB-AR-017",
    "level": "argent",
    "domain": "complications",
    "question": "Un patient DT2 de 70 ans développe une neuropathie autonome cardiaque (NAC). Quelle conséquence clinique doit vous alerter en premier ?",
    "type": "mcq",
    "answers": [
      {"text": "Bradycardie réflexe aggravant l'IC", "correct": False, "feedback": "La NAC cause une tachycardie de repos et une absence de variabilité de la FC, plutôt qu'une bradycardie."},
      {"text": "Hypotension orthostatique et tachycardie de repos", "correct": True, "feedback": "Exact. NAC : tachycardie de repos (FC > 100 au repos), hypotension orthostatique (chute PA > 20/10 mmHg debout), absence de variabilité de la fréquence cardiaque (test de Valsalva, test respiratoire)."},
      {"text": "Hyperglycémie réfractaire par excès de catécholamines", "correct": False, "feedback": "Non. La NAC ne provoque pas d'excès de catécholamines."},
      {"text": "Insuffisance cardiaque diastolique isolée", "correct": False, "feedback": "La NAC est associée à un risque CV accru mais n'est pas en soi la cause directe d'IC diastolique."},
    ],
    "explanation": "NAC (neuropathie autonome cardiaque) : complications graves — mort subite (risque ×2-3), ischémie silencieuse (70% des IDM sont indolores), allongement QT. Dépistage : variabilité FC à l'ECG (test de la respiration profonde, Valsalva, orthostatisme). Traitement : équilibre glycémique, fludrocortisone si hypotension orthostatique.",
    "reference": "Pop-Busui R et al., Diabetes Care 2017",
  },

  {
    "id": "DIAB-AR-018",
    "level": "argent",
    "domain": "traitement",
    "question": "Quelle est la différence entre l'insuline NPH et l'insuline Glargine U100 comme basale ?",
    "type": "msq",
    "answers": [
      {"text": "La Glargine U100 a une durée d'action plate (~24h) sans pic ; la NPH a un pic d'action à 4-8h", "correct": True, "feedback": "Exact. Le pic de la NPH expose à des hypoglycémies nocturnes (4-8h après injection). La glargine est sans pic notable."},
      {"text": "La NPH est suspendue et doit être mélangée avant injection (aspect laiteux)", "correct": True, "feedback": "Exact. La NPH est une suspension d'insuline-protamine → aspect laiteux, retourner 20 fois avant injection. La glargine est une solution claire."},
      {"text": "La Glargine peut être mélangée avec une insuline rapide dans la même seringue", "correct": False, "feedback": "Non. La glargine NE DOIT PAS être mélangée avec d'autres insulines (précipitation, modification du profil PK)."},
      {"text": "La Glargine U100 est moins chère que la NPH", "correct": False, "feedback": "Non. La NPH (insuline humaine d'action intermédiaire) est moins chère que les analogues lents comme la glargine."},
    ],
    "explanation": "NPH vs analogues lents : NPH = insuline humaine semi-rapide (pic à 4-8h, durée 12-16h), 2 injections/jour souvent nécessaires, risque d'hypoglycémie nocturne. Glargine/dégludec = analogues lents sans pic, 1 injection/jour, profil plus prévisible. Les analogues sont recommandés en première intention quand l'HbA1c cible est < 7%.",
    "reference": "NICE 2022 — Insulin therapy in type 2 diabetes",
  },

  {
    "id": "DIAB-AR-019",
    "level": "argent",
    "domain": "diagnostic",
    "question": "Un patient de 45 ans présente un diabète découvert fortuitement (GAJ 1,48 g/L). Il est obèse (BMI 38), sans anticorps anti-GAD, avec peptide C à 2,4 ng/mL. Son bilan montre : insuline à jeun élevée avec HOMA-IR = 5,8. Quel est le diagnostic le plus probable ?",
    "type": "mcq",
    "answers": [
      {"text": "DT1 adulte (LADA)", "correct": False, "feedback": "Non. Anti-GAD négatifs et peptide C élevé excluent le LADA."},
      {"text": "DT2 avec insulinorésistance marquée", "correct": True, "feedback": "Exact. HOMA-IR > 2,5 = insulinorésistance. Obésité + anti-GAD– + peptide C élevé + HOMA-IR élevé → DT2 classique avec insulinorésistance majeure."},
      {"text": "MODY 2 (GCK)", "correct": False, "feedback": "Non. Le MODY 2 donne une hyperglycémie modérée stable chez un sujet mince avec ATCD familiaux. Ce patient est obèse avec HOMA-IR élevé."},
      {"text": "Diabète secondaire à une pancréatopathie (pancréatite chronique)", "correct": False, "feedback": "Possible si ATCD, mais non évoqué ici. Le profil est celui d'un DT2 classique."},
    ],
    "explanation": "HOMA-IR (Homeostasis Model Assessment-Insulin Resistance) = (insuline à jeun × GAJ) / 22,5. HOMA-IR > 2,5 = insulinorésistance. HOMA-β = sécrétion des cellules bêta. Chez ce patient obèse avec HOMA-IR 5,8 et peptide C élevé : DT2 avec insulinorésistance sévère → cible thérapeutique principale = réduction de l'insulinorésistance (metformine, iSGLT2, perte de poids).",
    "reference": "Matthews DR et al., HOMA model, Diabetologia 1985",
  },

  {
    "id": "DIAB-AR-020",
    "level": "argent",
    "domain": "traitement",
    "question": "Chez un patient DT2 traité par iSGLT2, une infection intercurrente grave (pneumonie, sepsis) impose :",
    "type": "mcq",
    "answers": [
      {"text": "Maintien de l'iSGLT2 car l'hyperglycémie aggrave le pronostic infectieux", "correct": False, "feedback": "Non. Le risque d'acidocétose euglycémique sous iSGLT2 en situation de stress métabolique est réel et potentiellement fatal."},
      {"text": "Arrêt immédiat de l'iSGLT2 et relais par insuline", "correct": True, "feedback": "Exact. Les iSGLT2 doivent être arrêtés en cas d'infection grave, chirurgie, jeûne prolongé ou déshydratation sévère (risque d'acidocétose euglycémique = EuDKA)."},
      {"text": "Réduction de dose de l'iSGLT2 de 50%", "correct": False, "feedback": "Non. L'arrêt complet est recommandé en situation aiguë, pas une simple réduction."},
      {"text": "Ajout d'un iDPP4 pour compenser", "correct": False, "feedback": "Non. L'iDPP4 ne prévient pas l'EuDKA et ne remplace pas l'insuline en situation aiguë."},
    ],
    "explanation": "EuDKA (Euglycemic DKA) sous iSGLT2 : acidocétose avec glycémie normale ou peu élevée (< 2,50 g/L) → diagnostic retardé (glycémie non suspecte). Mécanisme : jeûne ou stress → lipolyse + augmentation du glucagon → cétogenèse malgré glycémie normale (glycosurie compense l'hyperglycémie). Traitement = insuline + glucose IV.",
    "reference": "Peters AL et al., Diabetes Care 2015 — EuDKA",
  },

  {
    "id": "DIAB-AR-021",
    "level": "argent",
    "domain": "cas_cliniques",
    "question": "Mme Jacqueline (cas n°19) a une carence en vitamine B12 post-sleeve. Pourquoi le comprimé oral de B12 est-il insuffisant après sleeve gastrectomie ?",
    "type": "mcq",
    "answers": [
      {"text": "La sleeve provoque une malabsorption intestinale des vitamines hydrosolubles", "correct": False, "feedback": "Non. La sleeve est restrictive, pas malabsorptive. L'intestin est intact."},
      {"text": "La réduction de la sécrétion de facteur intrinsèque gastrique diminue l'absorption iléale de la B12", "correct": True, "feedback": "Exact. La B12 alimentaire nécessite le facteur intrinsèque (FI) sécrété par les cellules pariétales gastriques pour être absorbée dans l'iléon terminal. La réduction du volume gastrique diminue la sécrétion de FI → malabsorption de B12 spécifique."},
      {"text": "La B12 est dégradée par les bactéries intestinales après sleeve", "correct": False, "feedback": "Non. Ce n'est pas le mécanisme."},
      {"text": "La B12 orale est contre-indiquée après chirurgie gastrique", "correct": False, "feedback": "Non. Les formes sublinguale et injectable sont préférées car elles contournent le mécanisme FI."},
    ],
    "explanation": "Après sleeve : réduction du volume gastrique → moins de cellules pariétales → moins de facteur intrinsèque → malabsorption de la B12 alimentaire. Solution : B12 sublinguale 1000 µg/jour (absorption directe muqueuse, indépendante du FI) ou injection IM 1000 µg/mois. Les comprimés oraux classiques sont inefficaces.",
    "reference": "EASO/IFSO 2023 — Nutritional Guidelines after Bariatric Surgery",
  },

  {
    "id": "DIAB-AR-022",
    "level": "argent",
    "domain": "physiopathologie",
    "question": "Le 'ominous octet' de DeFronzo décrit les 8 organes impliqués dans la physiopathologie du DT2. Lesquels sont cités ?",
    "type": "msq",
    "answers": [
      {"text": "Pancréas (↓ sécrétion insuline + ↑ glucagon), foie (↑ production glucose), muscle (↓ captage glucose)", "correct": True, "feedback": "Exact. Pancréas, foie et muscle sont les 3 organes classiques du 'triumvirat'. Le foie produit du glucose en excès, le muscle le capte moins."},
      {"text": "Tissu adipeux (↑ lipolyse), intestin (↓ effet incrétine), cerveau (↑ appétit), rein (↑ réabsorption glucose), cellules alpha (↑ glucagon)", "correct": True, "feedback": "Exact. Les 5 organes supplémentaires de l'octet : tissu adipeux, intestin, cerveau, rein (SGLT2), cellules alpha."},
      {"text": "Thyroïde (dysfonction en DT2 fréquente)", "correct": False, "feedback": "La thyroïde est fréquemment associée mais n'est pas dans l'octet de DeFronzo."},
      {"text": "Endothélium vasculaire (résistance à l'insuline vasculaire)", "correct": False, "feedback": "L'endothélium est impliqué dans les complications mais pas dans l'octet initial de DeFronzo."},
    ],
    "explanation": "Octet de DeFronzo (2009) : 1. Pancréas (↓ insuline, ↑ glucagon), 2. Foie (↑ glucose), 3. Muscle (↓ captage), 4. Tissu adipeux (↑ lipolyse), 5. Intestin (↓ incrétine), 6. Cerveau (↑ appétit), 7. Rein (↑ réabsorption glucose via SGLT2), 8. Cellules alpha (glucagon). Les iSGLT2 agissent sur le rein, les GLP-1 RA sur l'intestin et le cerveau.",
    "reference": "DeFronzo RA, Diabetes 2009 — Ominous Octet",
  },

  {
    "id": "DIAB-AR-023",
    "level": "argent",
    "domain": "traitement",
    "question": "La réhabilitation du seuil de perception des hypoglycémies (IAH) est possible. Quel protocole est recommandé ?",
    "type": "mcq",
    "answers": [
      {"text": "Injections répétées de glucagon pour entraîner la contre-régulation", "correct": False, "feedback": "Non. Les injections de glucagon ne réhabilitent pas le seuil de perception."},
      {"text": "2-3 semaines de normoglycémie stricte (éviter TOUTE hypoglycémie < 0,70 g/L) avec cible glycémique temporairement relevée à 1,40 g/L", "correct": True, "feedback": "Exact. Prévenir toutes les hypoglycémies pendant 2-3 semaines 'réinitialise' le seuil de perception adrénergique. La cible glycémique est temporairement relevée pour éviter les hypoglycémies pendant cette période."},
      {"text": "Arrêt total de l'insuline pendant 1 semaine", "correct": False, "feedback": "Impossible et dangereux en DT1."},
      {"text": "Traitement par corticoïdes pour augmenter la sécrétion d'adrénaline", "correct": False, "feedback": "Non. Les corticoïdes aggravent l'hyperglycémie."},
    ],
    "explanation": "Réhabilitation de l'IAH : prévenir strictement toute hypoglycémie pendant 2-3 semaines → le cerveau 'désapprend' son adaptation aux glycémies basses → restauration partielle de la perception adrénergique. Moyens : boucle fermée avec cible relevée temporairement (140 mg/dL), CGM avec alarmes basses actives, éducation thérapeutique intensive.",
    "reference": "Cryer PE, Diabetes 2022 — IAH Reversal",
  },

  {
    "id": "DIAB-AR-024",
    "level": "argent",
    "domain": "complications",
    "question": "La classification de l'infection du pied diabétique selon l'IWGDF/IDSA classe 'sévère' (grade 4) est définie par :",
    "type": "mcq",
    "answers": [
      {"text": "Érythème peri-lésionnel > 2 cm + odeur nauséabonde", "correct": False, "feedback": "Critères d'infection modérée (grade 3)."},
      {"text": "Signes systémiques d'infection (fièvre > 38°C, tachycardie > 90, leucocytes > 12000 OU < 4000, CRP élevée) + infection des tissus profonds", "correct": True, "feedback": "Exact. Infection sévère IWGDF = infection modérée + signes systémiques (SIRS) OU atteinte vasculaire (ischémie critique) compromettant le membre."},
      {"text": "Ulcère de grade UT 1A uniquement", "correct": False, "feedback": "Non. UT 1A = superficiel non infecté. La classification UT et la classification infectieuse IWGDF sont différentes."},
      {"text": "Contact osseux positif (probe-to-bone)", "correct": False, "feedback": "Le probe-to-bone positif signale une ostéomyélite probable mais n'est pas en soi le critère de classification 'sévère' de l'infection."},
    ],
    "explanation": "Classification infection pied diabétique IWGDF 2023 : Grade 1 (pas d'infection), Grade 2 (légère : érythème < 2 cm, tissu superficiel), Grade 3 (modérée : érythème > 2 cm OU tissu profond sans signes systémiques), Grade 4 (sévère : signes systémiques SIRS OU ischémie). Grade 4 = hospitalisation + antibiothérapie IV urgente.",
    "reference": "IWGDF 2023 — Infection Classification",
  },

  {
    "id": "DIAB-AR-025",
    "level": "argent",
    "domain": "traitement",
    "question": "Quelle est la règle des 'jours de maladie' (sick day rules) en DT1 pour la gestion insulinique lors d'un épisode infectieux avec vomissements ?",
    "type": "msq",
    "answers": [
      {"text": "Ne JAMAIS arrêter l'insuline basale, même en cas de jeûne ou vomissements", "correct": True, "feedback": "Exact. L'insuline basale maintient un taux d'insulinémie basal essentiel pour prévenir la cétogenèse. L'infection augmente les besoins de 30-50%."},
      {"text": "Contrôler la cétonémie capillaire si glycémie > 2,50 g/L (cétonémie > 1,5 mmol/L = urgence)", "correct": True, "feedback": "Exact. Cétonémie > 1,5 mmol/L avec signes de malaise = appel médical urgent, injection de correction d'insuline rapide, hydratation forcée."},
      {"text": "Réduire l'insuline bolus de 50% car le patient ne mange pas", "correct": False, "feedback": "Non. L'insuline basale est maintenue. Les bolus prandiaux sont adaptés à ce qui est ingéré réellement. Si vomissements : injection post-prandiale selon ce qui a été mangé."},
      {"text": "Augmenter les doses d'insuline rapide de 20-30% pour contrer l'insulinorésistance infectieuse", "correct": True, "feedback": "Exact. L'infection provoque une insulinorésistance liée aux cytokines (TNF-α, IL-6) → besoins en insuline augmentés de 20-50%."},
    ],
    "explanation": "Règles des jours de maladie (sick day rules) : 1. Ne jamais arrêter l'insuline basale, 2. Contrôler glycémie toutes les 2-4h, 3. Contrôler cétonémie si glycémie > 2,50 g/L, 4. Augmenter les bolus de correction si besoin, 5. S'hydrater (eau, bouillon), 6. Appeler en urgence si cétonémie > 1,5 ou nausées incontrôlables.",
    "reference": "ISPAD 2022 — Sick Day Management",
  },

  {
    "id": "DIAB-AR-026",
    "level": "argent",
    "domain": "diagnostic",
    "question": "Le diabète MODY 3 (mutation HNF-1α) se distingue du MODY 2 (GCK) par quelle caractéristique majeure ?",
    "type": "mcq",
    "answers": [
      {"text": "Le MODY 3 est une hyperglycémie stable légère qui ne progresse pas ; le MODY 2 est progressif et sévère", "correct": False, "feedback": "Inversé. C'est le MODY 2 (GCK) qui est stable et léger. Le MODY 3 (HNF-1α) est progressif."},
      {"text": "Le MODY 3 est progressif (risque de complications microvasculaires) et très sensible aux sulfamides ; le MODY 2 est une hyperglycémie stable légère ne nécessitant pas de traitement", "correct": True, "feedback": "Exact. MODY 2 (GCK) : hyperglycémie modérée stable (1,10-1,40 g/L), pas de complications, pas de traitement habituellement. MODY 3 (HNF-1α) : hyperglycémie progressive, complications, extrêmement sensible aux sulfamides (doses 10× plus faibles que le DT2)."},
      {"text": "Le MODY 3 est associé à une obésité morbide ; le MODY 2 survient chez des patients minces", "correct": False, "feedback": "Les deux types de MODY surviennent chez des patients minces."},
      {"text": "Le MODY 2 requiert de l'insuline dès la découverte ; le MODY 3 est contrôlé par les MHD", "correct": False, "feedback": "Non. C'est le contraire."},
    ],
    "explanation": "MODY 2 (GCK, 20% des MODY) : hyperglycémie modérée stable toute la vie (point de réglage glycémique décalé), complications rares, pas de traitement sauf grossesse. MODY 3 (HNF-1α, 30% des MODY) : hyperglycémie progressive, risque de complications, sensibilité extreme aux sulfamides (diagnostic thérapeutique).",
    "reference": "Hattersley AT et al., Lancet 2018 — MODY",
  },

  {
    "id": "DIAB-AR-027",
    "level": "argent",
    "domain": "traitement",
    "question": "Un patient DT2 sous aspirine 75 mg + clopidogrel (DAPT post-SCA) doit débuter un GLP-1 RA. Quelle interaction médicamenteuse faut-il surveiller ?",
    "type": "mcq",
    "answers": [
      {"text": "Risque de surdosage de l'aspirine par diminution de la glycémie", "correct": False, "feedback": "Non. Pas d'interaction aspirine-GLP-1 RA via ce mécanisme."},
      {"text": "Ralentissement de la vidange gastrique par le GLP-1 RA → absorption retardée et pic plasmatique réduit pour les médicaments oraux pris au même moment", "correct": True, "feedback": "Exact. Les GLP-1 RA ralentissent la vidange gastrique → délai d'absorption des médicaments oraux co-administrés (anticoagulants oraux, hormones thyroïdiennes, antibiotiques). Prise à jeun ou à distance pour les médicaments sensibles."},
      {"text": "Interaction pharmacodynamique entre GLP-1 RA et clopidogrel : risque hémorragique majoré", "correct": False, "feedback": "Non. Pas d'interaction pharmacodynamique significative."},
      {"text": "La nausée du GLP-1 RA peut réduire l'observance du clopidogrel (crainte des effets secondaires)", "correct": False, "feedback": "Possible mais ce n'est pas une interaction médicamenteuse au sens strict."},
    ],
    "explanation": "GLP-1 RA et médicaments oraux : le ralentissement de la vidange gastrique peut retarder l'absorption de médicaments à marge thérapeutique étroite (anticoagulants, statines, hormones thyroïdiennes, antibiotiques, contraceptifs oraux). Recommandation : prendre ces médicaments 1h avant ou 4h après l'injection de GLP-1 RA.",
    "reference": "EMA Product Information — Semaglutide drug interactions",
  },

  {
    "id": "DIAB-AR-028",
    "level": "argent",
    "domain": "complications",
    "question": "Dans le pied diabétique, l'IPS (Indice de Pression Systolique) mesure :",
    "type": "mcq",
    "answers": [
      {"text": "La pression artérielle à la cheville / pression artérielle au bras (ratio)", "correct": True, "feedback": "Exact. IPS = PA systolique cheville (tibiale antérieure ou pédieuse) / PA systolique humérale. IPS normal : 1,0-1,3. IPS < 0,9 = AOMI. IPS > 1,3 = artères calcifiées (DT2 avancé)."},
      {"text": "La vitesse de propagation de l'onde de pouls dans l'artère fémorale", "correct": False, "feedback": "C'est la mesure de la rigidité artérielle (pulse wave velocity)."},
      {"text": "Le débit sanguin en ml/min dans l'artère tibiale postérieure par Doppler couleur", "correct": False, "feedback": "Non. L'IPS est un ratio de pressions, pas un débit."},
      {"text": "La réserve vasculaire en réponse à l'exercice (test de marche sur tapis roulant)", "correct": False, "feedback": "C'est le test d'effort vasculaire, pas l'IPS de repos."},
    ],
    "explanation": "IPS : outil de dépistage de l'AOMI en consultation. IPS < 0,9 = AOMI (sensibilité 79%, spécificité 96%). IPS 0,7-0,9 = AOMI modérée, 0,5-0,7 = sévère, < 0,5 = critique. IPS > 1,3 = artères non compressibles (calcifications, fréquentes dans le DT2 avancé et IRC) → artériographie ou TcPO2.",
    "reference": "TASC II — TransAtlantic Inter-Society Consensus 2007",
  },

  {
    "id": "DIAB-AR-029",
    "level": "argent",
    "domain": "traitement",
    "question": "Un patient DT2 avec obésité (BMI 41) et HbA1c 9,2% malgré metformine + gliclazide + glargine 30 UI. La chirurgie bariatrique est envisagée. Quelles sont les conditions requises selon les recommandations HAS 2022 ?",
    "type": "msq",
    "answers": [
      {"text": "BMI ≥ 35 avec au moins une comorbidité (DT2, HTA, SAOS, etc.)", "correct": True, "feedback": "Exact. Indication HAS : BMI ≥ 40 sans comorbidité OU BMI ≥ 35 avec ≥ 1 comorbidité améliorable par la chirurgie. DT2 mal équilibré = comorbidité de premier choix."},
      {"text": "Échec d'un traitement médical bien conduit pendant ≥ 6 mois (diététique, activité physique, comportemental)", "correct": True, "feedback": "Exact. La chirurgie est une option après échec du traitement médical structuré."},
      {"text": "Évaluation psychiatrique préopératoire obligatoire (absence de troubles mentaux décompensés)", "correct": True, "feedback": "Exact. Bilan préop multidisciplinaire obligatoire incluant psychiatrie/psychologie."},
      {"text": "Âge impérativement < 50 ans", "correct": False, "feedback": "Non. La limite d'âge n'est pas 50 ans. La chirurgie est possible jusqu'à 65 ans environ selon la balance bénéfice/risque. Au-delà, discussion au cas par cas."},
    ],
    "explanation": "Indications HAS 2022 de la chirurgie bariatrique : BMI ≥ 40 OU ≥ 35 + comorbidité (DT2, HTA, SAOS, NASH...) + échec du traitement médical ≥ 6 mois + bilan préopératoire multidisciplinaire (nutritionniste, psychiatre, endocrinologue, chirurgien). Âge : 18-65 ans (discussion au cas par cas au-delà).",
    "reference": "HAS 2022 — Chirurgie bariatrique indications",
  },

  {
    "id": "DIAB-AR-030",
    "level": "argent",
    "domain": "cas_cliniques",
    "question": "Dans le cas n°17 (ACD sévère, Mme Dubois), la lipase est à 280 UI/L (N < 60). Quelle complication ce résultat signale-t-il et comment la gérez-vous ?",
    "type": "mcq",
    "answers": [
      {"text": "Pancréatite aiguë métabolique associée à l'ACD — traitement spécifique par antiprotéases IV", "correct": False, "feedback": "La pancréatite dans l'ACD ne nécessite pas d'antiprotéases IV. Le traitement de l'ACD est le traitement principal."},
      {"text": "Pancréatite aiguë métabolique associée à l'ACD — traitement conservateur (NPO, hydratation) ; régression habituelle avec la résolution de l'ACD", "correct": True, "feedback": "Exact. L'hyperlipasémie dans l'ACD est fréquente (20-25% des cas) — liée à l'acidose, l'hypertriglycéridémie et l'agression enzymatique. Régression habituelle avec le traitement de l'ACD. Scanner abdominal si clinique évocatrice de pancréatite sévère."},
      {"text": "Lithiase biliaire obstructive — cholécystectomie d'urgence", "correct": False, "feedback": "Non. La lipase élevée dans l'ACD est métabolique, pas lithiasique. Pas d'indication chirurgicale urgente."},
      {"text": "Artefact biologique — ignorer ce résultat", "correct": False, "feedback": "Non. L'hyperlipasémie est réelle et doit être interprétée mais elle est attendue dans l'ACD."},
    ],
    "explanation": "Hyperlipasémie dans l'ACD : fréquente (20-25%), souvent ≤ 3N, due à l'agression pancréatique par l'acidose et l'hypertriglycéridémie. Pancréatite vraie possible mais rare. Traitement : résolution avec l'ACD (réhydratation, insuline). Si clinique : douleur abdominale persistante après correction ACD → scanner abdominal.",
    "reference": "Nair S et al., Diabetes Care 2000",
  },

]  # fin argent_sup


questions = questions_bronze_sup + questions_argent_sup
