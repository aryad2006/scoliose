"""
VERTEX© — Banque de questions Diabétologie — Partie 4 (Or + Diamant supplémentaires)
"""

questions_or_sup = [

  {
    "id": "DIAB-OR-013",
    "level": "or",
    "domain": "traitement",
    "question": "Une patiente DT1 est à 34 SA sous boucle fermée hybride (Medtronic 780G). Son TIR grossesse (63-140 mg/dL) est à 65%. Quelle adaptation proposez-vous ?",
    "type": "msq",
    "answers": [
      {"text": "Abaisser la cible de l'algorithme au minimum autorisé (100 mg/dL)", "correct": True, "feedback": "Exact. Réduire la cible de l'algorithme au minimum pour augmenter le nombre de micro-corrections automatiques."},
      {"text": "Augmenter les ratios I/C de 10-15% si les TAR sont post-prandiaux", "correct": True, "feedback": "Exact. Au T3, l'insulinorésistance placentaire augmente fortement → ratios I/C à durcir."},
      {"text": "Passer en mode manuel (sans algorithme AID) pour plus de précision", "correct": False, "feedback": "Non. Le mode AID est supérieur au mode manuel en grossesse pour le TIR."},
      {"text": "Vérifier et ajuster les pré-bolus prandiaux (15-20 min avant repas)", "correct": True, "feedback": "Exact. Le pré-bolus prandial reste essentiel même sous AID pour limiter les pics post-prandiaux."},
    ],
    "explanation": "TIR grossesse (63-140 mg/dL) objectif > 70%. À 34 SA : insulinorésistance max → ratios I/C à augmenter de 20-40%, doses totales souvent doublées vs avant grossesse. Le système AID gère le basal mais les bolus prandiaux restent le principal levier.",
    "reference": "ADA 2024 — Diabetes in Pregnancy",
  },

  {
    "id": "DIAB-OR-014",
    "level": "or",
    "domain": "complications",
    "question": "L'anti-VEGF (ranibizumab, bévacizumab) en ophtalmologie est indiqué dans la rétinopathie diabétique pour :",
    "type": "msq",
    "answers": [
      {"text": "L'œdème maculaire diabétique (OMD) avec baisse d'acuité visuelle", "correct": True, "feedback": "Exact. L'anti-VEGF est le traitement de 1ère ligne de l'OMD cliniquement significatif."},
      {"text": "La rétinopathie diabétique proliférante (néovaisseaux actifs)", "correct": True, "feedback": "Exact. Anti-VEGF peut traiter les néovaisseaux actifs (en complément ou en alternative à la PPR dans certains cas)."},
      {"text": "La RDNP légère asymptomatique en prévention primaire", "correct": False, "feedback": "Non. La RDNP légère se traite par contrôle glycémique et TA optimal. Les injections intravitréennes ne sont pas indiquées en prévention primaire."},
      {"text": "Le décollement de rétine tractionnel", "correct": False, "feedback": "Non. Le décollement tractionnel est chirurgical (vitrectomie)."},
    ],
    "explanation": "Anti-VEGF (ranibizumab = Lucentis, aflibercept = Eylea, bévacizumab hors AMM) : injections intravitréennes dans l'OMD et la RDP néovasculaire. PPR (photocoagulation panrétinienne) reste le traitement de référence de la RDP. Anti-VEGF et PPR peuvent être associés.",
    "reference": "HAS 2023 — Traitement de la rétinopathie diabétique",
  },

  {
    "id": "DIAB-OR-015",
    "level": "or",
    "domain": "traitement",
    "question": "Chez un patient DT2 à très haut risque cardiovasculaire (ATCD de SCA, DFG 52, IC avec FEVG 38%), quelle est la combinaison antidiabétique de référence en 2024 ?",
    "type": "mcq",
    "answers": [
      {"text": "Metformine + sulfamide + insuline basale", "correct": False, "feedback": "Non. Les sulfamides n'ont pas de bénéfice CV. Cette combinaison est dépassée."},
      {"text": "Metformine + iSGLT2 + GLP-1 RA", "correct": True, "feedback": "Exact. Recommandations ESC/EASD 2023 : triple association metformine + iSGLT2 (pour IC et néphroprotection) + GLP-1 RA (pour cardioprotection et poids). Chaque classe apporte un bénéfice spécifique."},
      {"text": "iDPP4 + metformine uniquement", "correct": False, "feedback": "Non. Les iDPP4 sont neutres sur la mortalité CV. Insuffisant pour ce profil à très haut risque."},
      {"text": "Insuline basale seule pour contrôle glycémique rapide", "correct": False, "feedback": "Non. L'insuline ne protège pas le myocarde. Les classes à bénéfice CV prouvé sont prioritaires."},
    ],
    "explanation": "Triple thérapie de référence en prévention secondaire avec IC + MRC (ESC/EASD 2023) : Metformine (si DFG ≥ 30) + iSGLT2 (cardio + néphroprotection, DFG 52 compatible) + GLP-1 RA (MACE, poids). L'HbA1c n'est plus le seul critère de décision thérapeutique : le profil CV/rénal guide les choix.",
    "reference": "ESC/EASD 2023 Guidelines",
  },

  {
    "id": "DIAB-OR-016",
    "level": "or",
    "domain": "physiopathologie",
    "question": "La néphropathie diabétique évolue en 5 stades selon Mogensen. Quel stade correspond à la macroalbuminurie (protéinurie > 0,5 g/24h) avec DFG encore conservé ?",
    "type": "mcq",
    "answers": [
      {"text": "Stade 1 (hyperfiltration initiale)", "correct": False, "feedback": "Stade 1 : hyperfiltration (DFG ↑), microstructure normale, pas d'albuminurie."},
      {"text": "Stade 2 (lésions silencieuses)", "correct": False, "feedback": "Stade 2 : épaississement de la membrane basale, microalbuminurie absente ou intermittente."},
      {"text": "Stade 3 (néphropathie incipiens)", "correct": False, "feedback": "Stade 3 : microalbuminurie persistante (RAC 30-300 mg/g), DFG encore normal ou légèrement ↓."},
      {"text": "Stade 4 (néphropathie avérée)", "correct": True, "feedback": "Exact. Stade 4 : macroalbuminurie (RAC > 300 mg/g ou protéinurie > 0,5 g/24h), DFG encore partiellement conservé mais en déclin (3-12 mL/min/an)."},
    ],
    "explanation": "Stades de Mogensen (modifiés KDIGO 2022) : 1. Hyperfiltration, 2. Lésions silencieuses, 3. Microalbuminurie (RAC 30-300), 4. Macroalbuminurie (RAC > 300), 5. IRC avancée/terminale. Au stade 4 : intervention néphroprotectrice urgente (IEC/ARA2 + iSGLT2 + finerenone) pour ralentir la progression.",
    "reference": "Mogensen CE, KDIGO 2022",
  },

  {
    "id": "DIAB-OR-017",
    "level": "or",
    "domain": "urgences",
    "question": "Un patient DT1 sous boucle fermée hybride (Omnipod 5) est retrouvé en hypoglycémie sévère (glycémie 0,25 g/L, GCS 12). Le système AID était pourtant en fonctionnement. Quelle cause évoquez-vous en premier ?",
    "type": "msq",
    "answers": [
      {"text": "Exercice physique intense non annoncé au système → débit de base maintenu malgré baisse glycémique rapide", "correct": True, "feedback": "Exact. Même les systèmes AID avancés ne peuvent pas anticiper une baisse glycémique très rapide lors d'un exercice intense non annoncé."},
      {"text": "Hypoglycémie post-prandiale tardive (2-3h après bolus prandial trop important)", "correct": True, "feedback": "Exact. Les bolus prandiaux surestimés sont la cause fréquente d'hypoglycémie retardée, même sous AID."},
      {"text": "Défaillance du capteur CGM (perte de signal → l'algorithme n'a pas réduit le débit)", "correct": True, "feedback": "Exact. Si le capteur perd la glycémie, l'algorithme continue au dernier débit connu → hypoglycémie non détectée."},
      {"text": "L'AID est parfaitement sécurisé — l'hypoglycémie sévère est impossible sous ce système", "correct": False, "feedback": "Non. Aucun système AID actuel n'est parfaitement protégé contre les hypoglycémies sévères dans toutes les situations."},
    ],
    "explanation": "Hypoglycémies sévères restantes sous AID (1-2% par an dans les essais) : causes principales = exercice non annoncé, bolus prandial excessif, alcool (inhibe la néoglucogenèse), défaillance capteur. Prévention : mode 'exercice' activé avant l'activité, boutons de correction accessibles à l'entourage, glucagon disponible.",
    "reference": "Dovc K et al., Lancet Diabetes 2023",
  },

  {
    "id": "DIAB-OR-018",
    "level": "or",
    "domain": "traitement",
    "question": "La finerenone (Kerendia) se distingue de la spironolactone par :",
    "type": "msq",
    "answers": [
      {"text": "Structure non stéroïdienne → moins d'effets hormonaux (gynecomastie, troubles sexuels réduits)", "correct": True, "feedback": "Exact. La finerenone est non stéroïdienne → sélectivité accrue pour le récepteur aldostérone → moins d'effets anti-androgènes."},
      {"text": "Plus grande sélectivité pour les récepteurs minéralocorticoïdes rénaux et cardiaques vs cérébraux", "correct": True, "feedback": "Exact. La distribution tissulaire différente confère un bénéfice réno-cardiovasculaire plus sélectif."},
      {"text": "Risque d'hyperkaliémie plus faible que la spironolactone", "correct": False, "feedback": "Non. Le risque d'hyperkaliémie existe avec la finerenone (CI si K+ > 5,0 mmol/L à l'initiation). Pas nécessairement inférieur à la spironolactone."},
      {"text": "Indication validée par FIDELIO-DKD et FIGARO-DKD dans le DT2 avec MRC et protéinurie", "correct": True, "feedback": "Exact. Les deux essais ont prouvé la réduction des événements rénaux et CV majeurs chez le DT2 avec MRC."},
    ],
    "explanation": "Finerenone (ARM non stéroïdien) : indication DT2 + MRC avec RAC ≥ 30 mg/g + DFG 25-75 mL/min. Réduction de 18% des événements rénaux majeurs (FIDELIO-DKD) et 13% des MACE (FIGARO-DKD). CI : K+ > 5,0 mmol/L, DFG < 25, grossesse.",
    "reference": "Bakris GL et al., FIDELIO-DKD, NEJM 2020",
  },

  {
    "id": "DIAB-OR-019",
    "level": "or",
    "domain": "cas_cliniques",
    "question": "M. Antoine (DT1 brittle, cas n°20) souhaite reprendre le travail (ingénieur, travail sur écrans). Quels critères de contrôle glycémique sont nécessaires AVANT la reprise du permis de conduire ?",
    "type": "msq",
    "answers": [
      {"text": "TBR < 54 mg/dL ≤ 1% prouvé sur 3 mois par rapport CGM", "correct": True, "feedback": "Exact. Moins de 15 minutes par jour en hypoglycémie sévère sur 3 mois consécutifs."},
      {"text": "Absence d'hypoglycémie sévère (nécessitant tierce personne) depuis ≥ 3 mois", "correct": True, "feedback": "Exact. Critère EU : pas d'épisode d'hypoglycémie sévère sur les 3 mois précédant la reprise."},
      {"text": "CGM en temps réel obligatoire lors de la conduite + glycémie > 0,90 g/L avant démarrer", "correct": True, "feedback": "Exact. Directive européenne sur la conduite automobile avec DT1 : CGM temps réel, mesure avant conduite, arrêt si < 0,70 g/L ou alerte hypoglycémie."},
      {"text": "HbA1c < 6,5% pendant 6 mois", "correct": False, "feedback": "Non. L'HbA1c seule n'est pas le critère de conduite. C'est le TBR et l'absence d'hypoglycémies sévères."},
    ],
    "explanation": "Conduite automobile et DT1 (directive EU 2016/126) : CGM obligatoire, glycémie > 90 mg/dL avant conduite, arrêt de conduite si alerte hypoglycémie, pas de conduite si hypoglycémie sévère dans les 3 mois. Après transplantation d'îlots réussie (insulino-indépendance) : reprise possible après stabilisation.",
    "reference": "EASD/ESC 2023 — Driving and Diabetes",
  },

  {
    "id": "DIAB-OR-020",
    "level": "or",
    "domain": "traitement",
    "question": "L'alimentation thérapeutique recommandée dans le DT2 en 2024 est :",
    "type": "msq",
    "answers": [
      {"text": "Régime méditerranéen (huile d'olive, légumes, légumineuses, poissons gras, fruits à coque) — réduction de 30% du risque cardiovasculaire", "correct": True, "feedback": "Exact. L'essai PREDIMED (2013) a montré une réduction de 30% des MACE sous régime méditerranéen complémenté en huile d'olive ou noix."},
      {"text": "Régime très pauvre en glucides (LCHF < 50g/j) efficace à court terme sur l'HbA1c mais difficile à maintenir", "correct": True, "feedback": "Exact. Le régime LCHF (Low Carb High Fat) réduit significativement l'HbA1c à 3-6 mois. Bénéfice maintenu à 1-2 ans si adhérence, mais difficile à maintenir."},
      {"text": "Régime pauvre en graisses saturées (< 7% des calories) comme unique recommandation", "correct": False, "feedback": "Non. Les recommandations actuelles sont plus globales (qualité des glucides et des graisses, pas seulement réduction des graisses saturées)."},
      {"text": "Fractionnement des repas en 5-6 petits repas par jour pour éviter les pics glycémiques", "correct": False, "feedback": "Non. Le fractionnement des repas n'est pas prouvé supérieur au 3 repas/jour pour le contrôle glycémique dans le DT2."},
    ],
    "explanation": "Alimentation dans le DT2 (ADA/EASD 2024) : pas de régime unique recommandé. Les mieux étudiés : régime méditerranéen (bénéfice CV prouvé), régime LCHF (réduction HbA1c à court terme), régime DASH (HTA + DT2). Principes communs : qualité des glucides (index glycémique bas), réduction des ultra-transformés, légumineuses, fibres.",
    "reference": "ADA 2024 — Nutrition therapy recommendations",
  },

  {
    "id": "DIAB-OR-021",
    "level": "or",
    "domain": "complications",
    "question": "La neuropathie autonome diabétique peut toucher le tube digestif. Quel tableau clinique caractérise la gastroparésie diabétique ?",
    "type": "msq",
    "answers": [
      {"text": "Nausées post-prandiales prolongées, vomissements d'aliments non digérés ingérés plusieurs heures avant", "correct": True, "feedback": "Exact. La gastroparésie = vidange gastrique ralentie → les aliments stagnent dans l'estomac → nausées et vomissements retardés (aliments reconnaissables des repas précédents)."},
      {"text": "Hypoglycémies post-prandiales précoces par décalage entre l'insuline rapide et l'absorption retardée des glucides", "correct": True, "feedback": "Exact. Si l'insuline rapide est injectée avant le repas et que la vidange est ralentie → hypoglycémie précoce puis hyperglycémie tardive (profil inverse)."},
      {"text": "Constipation sévère alternant avec des épisodes diarrhéiques nocturnes", "correct": False, "feedback": "Ce tableau (trouble du transit diabétique) est lié à la neuropathie du côlon, différent de la gastroparésie."},
      {"text": "Instabilité glycémique inexpliquée malgré traitement optimisé", "correct": True, "feedback": "Exact. La gastroparésie est souvent diagnostiquée devant une instabilité glycémique chronique malgré une bonne observance (absorption imprévisible des glucides)."},
    ],
    "explanation": "Gastroparésie diabétique : diagnostic par scintigraphie de la vidange gastrique (Tc-99m) — vidange < 50% à 4h = gastroparésie. Traitement : repas fractionnés (petits volumes, pauvres en graisses et fibres), bolus d'insuline APRÈS le repas (ou ultra-rapide), métoclopramide (court terme), dompéridone. Semaglutide peut aggraver la gastroparésie.",
    "reference": "Camilleri M et al., Clinical Gastroenterology 2022",
  },

  {
    "id": "DIAB-OR-022",
    "level": "or",
    "domain": "traitement",
    "question": "Un patient DT1 doit aller en randonnée de 4h à intensité modérée (marche nordique). Quelles adaptations insuliniques recommandez-vous avant l'activité physique ?",
    "type": "msq",
    "answers": [
      {"text": "Réduire la dose de bolus du repas précédant l'exercice de 30-50%", "correct": True, "feedback": "Exact. L'activité physique augmente la sensibilité à l'insuline → le bolus prandial pré-exercice doit être réduit."},
      {"text": "Activer le mode 'exercice' sur le système AID (cible glycémique relevée à 150-180 mg/dL) 90 min avant", "correct": True, "feedback": "Exact. Le mode exercice (disponible sur Medtronic 780G, Control-IQ, Omnipod 5) réduit le débit basal automatique pour prévenir les hypoglycémies per-exercice."},
      {"text": "Partir avec glycémie capillaire entre 1,20 et 1,80 g/L (pas < 1,00 ni > 2,50)", "correct": True, "feedback": "Exact. Glycémie cible au départ de l'exercice : 1,20-1,80 g/L pour le DT1 sous insuline."},
      {"text": "Doubler la dose de basale la veille pour 'faire des réserves'", "correct": False, "feedback": "Non. Doubler la basale provoquerait une hypoglycémie. C'est le contraire qui est recommandé."},
    ],
    "explanation": "Activité physique dans le DT1 : 1. Réduire bolus prandial pré-exercice (30-50%), 2. Activer mode exercice sur AID 90 min avant, 3. Contrôler glycémie avant, pendant (>45 min) et après, 4. Emporter du glucose rapide (15-30g), 5. Réduire la basale du soir de 20-30% si exercice tardif (hypoglycémie nocturne).",
    "reference": "Riddell MC et al., Lancet Diabetes 2017 — Exercise in T1D",
  },

  {
    "id": "DIAB-OR-023",
    "level": "or",
    "domain": "diagnostic",
    "question": "Le bilan lipidique d'un patient DT1 mal équilibré montre : TG = 8,50 g/L (N < 1,50), LDL non mesurable, HDL = 0,30 g/L. Quelle est l'urgence thérapeutique ?",
    "type": "mcq",
    "answers": [
      {"text": "Débuter une statine puissante (rosuvastatine 40 mg) immédiatement", "correct": False, "feedback": "Non. La priorité n'est pas la statine. Les TG à 8,50 g/L imposent une urgence spécifique."},
      {"text": "Rééquilibrage glycémique urgent (TG > 5 g/L = risque de pancréatite aiguë hypertriglycéridémique) + fibrates", "correct": True, "feedback": "Exact. TG > 5 g/L = risque de pancréatite aiguë. Urgence : insuline IV pour réduire la lipolyse + fibrates (fénofibrate). La correction du diabète réduit massivement les TG."},
      {"text": "Régime hypolipidémiant strict pendant 3 mois avant toute décision", "correct": False, "feedback": "Non. TG 8,50 g/L = urgence. Le régime seul est insuffisant."},
      {"text": "Plasmaphérèse d'urgence pour éliminer les TG circulants", "correct": False, "feedback": "La plasmaphérèse est réservée aux hypertriglycéridémies extrêmes (> 10-15 g/L) avec pancréatite active."},
    ],
    "explanation": "Hypertriglycéridémie sévère dans le DT1 mal équilibré : la carence insulinique → activation de la lipoprotéine lipase inhibée → accumulation de VLDL → TG > 5 g/L. Risque : pancréatite aiguë (10% de mortalité). Traitement : insulinothérapie intensive + fibrates. Le LDL est non calculable quand TG > 4 g/L (formule de Friedewald invalide).",
    "reference": "Berglund L et al., J Clin Lipidol 2022",
  },

  {
    "id": "DIAB-OR-024",
    "level": "or",
    "domain": "traitement",
    "question": "Le programme d'éducation thérapeutique (ETP) dans le DT2 est recommandé. Quel objectif mesurable l'ETP doit-elle viser en priorité ?",
    "type": "msq",
    "answers": [
      {"text": "Autosurveillance glycémique appropriée (fréquence, technique, interprétation des résultats)", "correct": True, "feedback": "Exact. L'autosurveillance glycémique efficace est un pilier de l'ETP."},
      {"text": "Reconnaissance et traitement de l'hypoglycémie (resucrage 15g, règle des 15 min)", "correct": True, "feedback": "Exact. La sécurité hypoglycémique est une compétence essentielle pour tout patient sous insuline ou sulfamides."},
      {"text": "Gestion des 'jours de maladie' (sick day rules) avec adaptation des doses", "correct": True, "feedback": "Exact. Les hospitalisations pour ACD sont majoritairement dues à l'arrêt de l'insuline lors d'une maladie intercurrente → prévention par ETP."},
      {"text": "Mémorisation de toutes les valeurs de référence biologiques (sans compréhension)", "correct": False, "feedback": "Non. L'ETP vise des compétences pratiques et comportementales, pas la mémorisation passive."},
    ],
    "explanation": "ETP dans le diabète : compétences prioritaires (HAS 2018) = 1. Autosurveillance glycémique, 2. Gestion de l'hypoglycémie, 3. Ajustement des doses d'insuline, 4. Gestion des jours de maladie, 5. Soins du pied (auto-examen), 6. Alimentation pratique. Les programmes structurés (DAFNE, DIABEST) réduisent l'HbA1c de 0,3-0,9%.",
    "reference": "HAS 2018 — Éducation thérapeutique du patient diabétique",
  },

]  # fin or_sup


questions_diamant_sup = [

  {
    "id": "DIAB-DI-013",
    "level": "diamant",
    "domain": "traitement",
    "question": "Un patient DT1 de 45 ans, IRC stade G4 (DFG 22 mL/min), est inscrit sur liste d'attente SPK. Sa FEVG est à 42%. Quel bilan complémentaire cardio-vasculaire est obligatoire avant inscription ?",
    "type": "msq",
    "answers": [
      {"text": "Coronarographie ou coronaro-scanner si FEVG < 50% et/ou facteurs de risque CV", "correct": True, "feedback": "Exact. Les comités de transplantation exigent un bilan coronarien (coronarographie ou angioTDM) chez tout candidat avec FEVG ≤ 50% ou ATCD coronarien."},
      {"text": "Échocardiographie de stress (dobutamine ou dipyridamole) pour évaluer la réserve contractile", "correct": True, "feedback": "Exact. L'échocardiographie de stress est systématique dans le bilan pré-transplantation pour détecter une ischémie silencieuse (fréquente en DT1)."},
      {"text": "Echo-Doppler des artères iliaques et aortiques (qualité des vaisseaux pour l'anastomose)", "correct": True, "feedback": "Exact. La greffe de rein et de pancréas est anastomosée sur les vaisseaux iliaques. Une AOMI sévère peut contre-indiquer la greffe."},
      {"text": "IRM cardiaque pour quantifier la fibrose myocardique", "correct": False, "feedback": "L'IRM cardiaque peut être demandée mais n'est pas systématique dans le bilan pré-transplantation standard."},
    ],
    "explanation": "Bilan pré-transplantation SPK (Agence de Biomédecine 2023) : coronarographie ± revascularisation si nécessaire, échocardiographie de stress, écho-Doppler vasculaire, bilan infectieux (VIH, VHB, VHC, EBV, CMV, toxoplasmose, tuberculose), typage HLA, bilan dentaire. FEVG minimum acceptable : > 35-40% selon les centres.",
    "reference": "Agence de Biomédecine 2023 — Critères de listing SPK",
  },

  {
    "id": "DIAB-DI-014",
    "level": "diamant",
    "domain": "physiopathologie",
    "question": "Dans la physiopathologie de la neuropathie douloureuse diabétique (NDD), quels mécanismes moléculaires sont impliqués ?",
    "type": "msq",
    "answers": [
      {"text": "Glycation des protéines nerveuses (AGE) → dysfonction de la myéline et des canaux ioniques", "correct": True, "feedback": "Exact. Les AGE (Advanced Glycation End-products) altèrent la structure de la myéline et la fonction des canaux sodiques → hyperexcitabilité neuronale."},
      {"text": "Activation de la voie des polyols (aldose réductase) → accumulation de sorbitol intra-neuronal → stress osmotique", "correct": True, "feedback": "Exact. L'aldose réductase convertit le glucose en sorbitol → accumulation intraneuronale → stress osmotique + réduction du myo-inositol."},
      {"text": "Stress oxydatif mitochondrial → dysfonction des cellules de Schwann → démyélinisation segmentaire", "correct": True, "feedback": "Exact. L'hyperglycémie → surproduction de ROS mitochondriaux → dommages aux cellules de Schwann → démyélinisation."},
      {"text": "Auto-anticorps anti-neurones (mécanisme auto-immun similaire au DT1)", "correct": False, "feedback": "Non. La NDD n'est pas d'origine auto-immune (contrairement à certaines polyradiculonévrites)."},
    ],
    "explanation": "Mécanismes moléculaires de la neuropathie diabétique : 1. Voie des polyols (sorbitol), 2. Glycation des protéines (AGE), 3. Activation de la PKC (protéine kinase C), 4. Stress oxydatif mitochondrial, 5. Ischémie endoneurale (microangiopathie des vasa nervorum). Ces mécanismes convergent vers la dégénérescence axonale et la démyélinisation.",
    "reference": "Feldman EL et al., Nat Rev Neurol 2019",
  },

  {
    "id": "DIAB-DI-015",
    "level": "diamant",
    "domain": "traitement",
    "question": "L'immunosuppression de la transplantation d'îlots (tacrolimus + MMF) peut avoir un effet diabétogène. Pourquoi ?",
    "type": "msq",
    "answers": [
      {"text": "Le tacrolimus est directement toxique pour les cellules bêta (inhibe la sécrétion d'insuline de façon dose-dépendante)", "correct": True, "feedback": "Exact. Le tacrolimus (inhibiteur de la calcineurine) réduit la sécrétion d'insuline par inhibition de la transcription du gène de l'insuline."},
      {"text": "Les corticoïdes (sparing regime sans corticoïdes justement pour éviter cet effet)", "correct": True, "feedback": "Exact. Les protocoles d'immunosuppression post-transplantation d'îlots évitent les corticoïdes (sans stéroïdes) pour cette raison."},
      {"text": "Le MMF réduit la vascularisation des îlots dans le foie", "correct": False, "feedback": "Non. Le MMF n'a pas d'effet direct sur la vascularisation des îlots."},
      {"text": "Le tacrolimus aggrave l'insulinorésistance hépatique", "correct": True, "feedback": "Exact. En plus de la toxicité directe des cellules bêta, le tacrolimus aggrave l'insulinorésistance hépatique."},
    ],
    "explanation": "Diabète post-transplantation (PTDM) : le tacrolimus est la principale cause d'effet diabétogène (toxicité directe cellules bêta + insulinorésistance). Prévalence du PTDM : 20-50% après transplantation rénale. Pour la transplantation d'îlots : protocole sans corticoïdes spécifiquement pour préserver la fonction des îlots.",
    "reference": "Manu MA et al., Am J Transplant 2019",
  },

  {
    "id": "DIAB-DI-016",
    "level": "diamant",
    "domain": "diagnostic",
    "question": "Un patient DT2 obèse présente une hypertriglycéridémie à 12 g/L, une lipémie rétinienne (fond d'œil : veines et artères blanc-laiteux), une xanthomatose éruptive. Quel syndrome évoquez-vous et quelle est l'urgence ?",
    "type": "mcq",
    "answers": [
      {"text": "Hyperlipoprotéinémie de type IV — traitement différé par fibrates", "correct": False, "feedback": "Non. TG 12 g/L + xanthomes éruptifs + lipémie rétinienne = syndrome chylomicronémique (type I ou V) — urgence absolue."},
      {"text": "Syndrome de chylomicronémie (type I ou V de Fredrickson) — urgence : risque de pancréatite aiguë mortelle", "correct": True, "feedback": "Exact. TG > 10 g/L = syndrome de chylomicronémie. Triade : xanthomes éruptifs + lipémie rétinienne + risque de pancréatite aiguë mortelle. Urgence : insuline IV + régime hypoglucidique strictement sans graisses."},
      {"text": "Rétinopathie lipémique par athérosclérose accélérée — biologie différée", "correct": False, "feedback": "Non. La lipémie rétinienne n'est pas de l'athérosclérose — c'est un signe de chylomicronémie massive."},
      {"text": "Stéatohépatite non alcoolique (NASH) avec hyperlipidémie réactionnelle", "correct": False, "feedback": "Non. La NASH peut être associée mais ce tableau est celui du syndrome chylomicronémique."},
    ],
    "explanation": "Syndrome chylomicronémique (TG > 10 g/L) : urgence métabolique. Causes dans le DT2 : insulinorésistance sévère + trouble génétique sous-jacent (LPL déficiente, apoC-II déficiente). Traitement urgent : insuline IV (active la lipoprotéine lipase), régime sans graisses strictement, fibrates. Pancréatite aiguë possible à tout moment.",
    "reference": "Bhatt DL et al., NEJM 2019 — Chylomicronemia",
  },

  {
    "id": "DIAB-DI-017",
    "level": "diamant",
    "domain": "traitement",
    "question": "Le traitement conservateur (non-dialyse) de l'insuffisance rénale terminale chez un patient diabétique âgé est une option éthique valide. Quels soins de support sont prioritaires ?",
    "type": "msq",
    "answers": [
      {"text": "Contrôle du prurit urémique (antihistaminiques, gabapentine, dialysat cutané 'aqua')", "correct": True, "feedback": "Exact. Le prurit urémique est l'un des symptômes les plus invalidants en IRT non dialysée. Gabapentine ou difélikefaline (nouveau traitement)."},
      {"text": "Contrôle de la dyspnée et de la surcharge hydro-sodée (diurétiques à doses élevées si possible)", "correct": True, "feedback": "Exact. La surcharge volémique est une source majeure d'inconfort. Furosémide à doses élevées peut être maintenu même en IRT si diurèse résiduelle."},
      {"text": "Maintien d'une qualité de vie : alimentation sans restriction sévère, activité adaptée, soutien psychologique", "correct": True, "feedback": "Exact. En soins conservateurs, l'objectif est le confort et la qualité de vie, pas la prolongation à tout prix."},
      {"text": "Dialyse d'urgence si urée > 2,00 g/L pour éviter l'encéphalopathie", "correct": False, "feedback": "Non. En soins conservateurs, la dialyse n'est pas initiée même si l'urée s'élève. L'objectif est le confort, pas la correction biologique."},
    ],
    "explanation": "Traitement conservateur de l'IRT (non-dialyse) : approche légale et éthique en France. Objectifs : contrôle des symptômes (prurit, dyspnée, fatigue, nausées), nutrition adaptée, soutien psychologique, soins palliatifs précoces. Survie médiane : 6-12 mois en IRT G5 sans dialyse, mais qualité de vie souvent préservée plus longtemps que sous dialyse.",
    "reference": "KDIGO 2022 — Conservative Management of CKD G5",
  },

  {
    "id": "DIAB-DI-018",
    "level": "diamant",
    "domain": "physiopathologie",
    "question": "Dans le DT1 de longue durée, la réponse glucagonique à l'hypoglycémie est abolie. Pourquoi ?",
    "type": "msq",
    "answers": [
      {"text": "Destruction des cellules alpha par le processus auto-immun (co-destruction avec les cellules bêta)", "correct": True, "feedback": "Exact. Les cellules alpha sont progressivement détruites par l'inflammation auto-immune ou par l'infiltration lymphocytaire îlotaire."},
      {"text": "Perte du signal paracrines des cellules bêta vers les cellules alpha (l'insuline inhibe normalement le glucagon, mais son absence fait perdre la 'pulsatilité' du signal)", "correct": True, "feedback": "Exact. La sécrétion pulsatile d'insuline par les cellules bêta régule les cellules alpha. En DT1, la perte de cette communication paracrine dérègle la réponse glucagonique."},
      {"text": "Hypoglycémies répétées → adaptation des cellules alpha qui 'oublient' de sécréter du glucagon en réponse à la baisse de glucose", "correct": True, "feedback": "Exact. Les hypoglycémies répétées 'épuisent' ou désensibilisent la réponse glucagonique → cercle vicieux de l'IAH."},
      {"text": "Le glucagon est dégradé plus rapidement par l'insuline exogène injectée", "correct": False, "feedback": "Non. L'insuline exogène ne dégrade pas le glucagon."},
    ],
    "explanation": "Réponse glucagonique abolie en DT1 : phénomène complexe impliquant la co-destruction des cellules alpha, la perte de communication paracrine îlotaire, et le désensibilisation par les hypoglycémies répétées. Ce déficit est l'une des raisons pour lesquelles les hypoglycémies sévères sont plus fréquentes et plus prolongées en DT1 avancé.",
    "reference": "Cryer PE, Cell Metabolism 2021",
  },

  {
    "id": "DIAB-DI-019",
    "level": "diamant",
    "domain": "cas_cliniques",
    "question": "M. Karim (cas n°18, DT1 + IRC terminale + cécité) est inscrit sur liste SPK. L'attente est estimée à 3-4 ans. Quelle dialyse peritoneale automatisée (APD) est la mieux adaptée à son profil ?",
    "type": "mcq",
    "answers": [
      {"text": "DPCA (dialyse peritoneale continue ambulatoire) : 3-4 échanges manuels par jour de 2L", "correct": False, "feedback": "Non. La DPCA impose des manipulations diurnes précises → difficile chez un patient aveugle."},
      {"text": "APD (dialyse peritoneale automatisée) nocturne : cycleur automatique la nuit + aide infirmière à domicile pour connexion/déconnexion", "correct": True, "feedback": "Exact. L'APD nocturne libère la journée, réduit le nombre de manipulations (connexion le soir, déconnexion le matin). Avec aide infirmière HAD, accessible aux patients aveugles."},
      {"text": "Hémodialyse ambulatoire 3×/semaine en centre", "correct": False, "feedback": "L'HD est plus difficile pour M. Karim (cécité → problème de transport, accès vasculaire compromis par l'AOMI)."},
      {"text": "Hémodialyse à domicile quotidienne", "correct": False, "feedback": "L'HD à domicile requiert une formation du patient et de l'entourage → difficile avec cécité isolée."},
    ],
    "explanation": "APD nocturne pour M. Karim : le cycleur automatique réalise 4-6 échanges automatiques sur 8-10h la nuit. L'infirmière HAD vient connecter et déconnecter. Avantages : liberté diurne, moins de manipulations, hémodynamique stable (adapté à IC + neuropathie autonome). Matériel spécifique adapté aux déficients visuels disponible.",
    "reference": "KDIGO 2022 — Peritoneal Dialysis",
  },

  {
    "id": "DIAB-DI-020",
    "level": "diamant",
    "domain": "traitement",
    "question": "Le sémaglutide oral (Rybelsus) se distingue du sémaglutide SC (Ozempic) par :",
    "type": "msq",
    "answers": [
      {"text": "Biodisponibilité orale faible (1%) → nécessite une prise à jeun 30-60 min avant le premier repas avec un verre d'eau (max 120 mL)", "correct": True, "feedback": "Exact. La biodisponibilité du sémaglutide oral est de 1% sans excipient spécial. Le SNAC (sodium N-[8-(2-hydroxybenzoyl)amino] caprylate) améliore l'absorption mais impose des conditions strictes de prise."},
      {"text": "Efficacité sur l'HbA1c légèrement inférieure au sémaglutide SC 1 mg (Rybelsus 14 mg vs Ozempic 1 mg)", "correct": True, "feedback": "Exact. Dans PIONEER 7 (Rybelsus 14 mg vs Ozempic 1 mg) : HbA1c similaire (-1,2% vs -1,4%). La forme SC reste légèrement supérieure."},
      {"text": "Absence d'effet sur la perte de poids", "correct": False, "feedback": "Non. Rybelsus 14 mg induit une perte de poids significative (-4,4 kg dans PIONEER 1), comparable à la forme SC à dose équivalente."},
      {"text": "Interaction majeure avec les médicaments modifiant le pH gastrique (IPP, antiacides)", "correct": True, "feedback": "Exact. Les IPP et antiacides modifient le pH gastrique et réduisent la biodisponibilité du sémaglutide oral → prendre à distance des IPP."},
    ],
    "explanation": "Sémaglutide oral (Rybelsus) : révolution galénique. Biodisponibilité 1% améliorée par le SNAC. Conditions de prise strictes : 30-60 min à jeun, max 120 mL d'eau, pas d'autre médicament dans les 30 min. Efficacité proche de la forme SC mais légèrement inférieure à forte dose.",
    "reference": "Aroda VR et al., PIONEER program, Diabetes Care 2022",
  },

]  # fin diamant_sup


questions = questions_or_sup + questions_diamant_sup
