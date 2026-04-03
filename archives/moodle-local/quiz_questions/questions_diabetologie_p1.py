"""
VERTEX© — Banque de questions Diabétologie — Partie 1 (Bronze + Argent)

Format identique à questions_atlas.py
Domaines : physiopathologie | diagnostic | traitement | complications | urgences | cas_cliniques
"""

questions_bronze = [

  # ── BRONZE — Physiopathologie ────────────────────────────────────────────

  {
    "id": "DIAB-BR-001",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "Quelle est la principale différence physiopathologique entre le diabète de type 1 (DT1) et le diabète de type 2 (DT2) ?",
    "type": "mcq",
    "answers": [
      {"text": "DT1 : destruction auto-immune des cellules bêta ; DT2 : insulinorésistance + épuisement progressif des cellules bêta", "correct": True, "feedback": "Exact. Le DT1 est une maladie auto-immune (anticorps anti-GAD, anti-IA2) ; le DT2 associe insulinorésistance et défaillance sécrétoire progressive."},
      {"text": "DT1 : insulinorésistance hépatique ; DT2 : destruction virale des cellules bêta", "correct": False, "feedback": "Inversé. L'insulinorésistance est caractéristique du DT2."},
      {"text": "DT1 et DT2 partagent le même mécanisme mais différent par l'âge d'apparition", "correct": False, "feedback": "Non. Les mécanismes sont fondamentalement différents."},
      {"text": "DT1 : défaut de sécrétion de glucagon ; DT2 : excès d'insuline", "correct": False, "feedback": "Incorrect. Le glucagon est secondairement impliqué mais n'est pas le mécanisme principal."},
    ],
    "explanation": "Le DT1 résulte d'une destruction auto-immune (lymphocytes T CD8+) des cellules bêta pancréatiques, entraînant une insulinopénie absolue. Le DT2 combine insulinorésistance périphérique (muscle, foie, tissu adipeux) et insuffisance sécrétoire progressive.",
    "reference": "ADA Standards of Care 2024 — Classification and Diagnosis",
  },

  {
    "id": "DIAB-BR-002",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "L'HbA1c (hémoglobine glyquée) reflète le contrôle glycémique des :",
    "type": "mcq",
    "answers": [
      {"text": "7 derniers jours", "correct": False, "feedback": "Non. La glycémie capillaire reflète le moment présent."},
      {"text": "2-3 derniers mois", "correct": True, "feedback": "Correct. L'HbA1c reflète la glycémie moyenne des 2-3 derniers mois, correspondant à la durée de vie des globules rouges (~120 jours)."},
      {"text": "6 derniers mois", "correct": False, "feedback": "Non. La demi-vie des GR est de 60 jours, d'où un reflet sur 2-3 mois."},
      {"text": "12 derniers mois", "correct": False, "feedback": "Non."},
    ],
    "explanation": "L'HbA1c se forme par glycation non enzymatique irréversible de l'hémoglobine. La demi-vie des globules rouges (~60 jours) fait que l'HbA1c reflète les 2-3 derniers mois. Elle est faussée en cas d'anémie hémolytique, d'IRC ou d'hémoglobinopathie.",
    "reference": "ADA 2024, section Glycemic Targets",
  },

  {
    "id": "DIAB-BR-003",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "Quel peptide est sécrété en quantités équimolaires à l'insuline et permet d'évaluer la réserve insulinosécrétoire ?",
    "type": "mcq",
    "answers": [
      {"text": "Peptide YY", "correct": False, "feedback": "Le PYY est une hormone intestinale anorexigène."},
      {"text": "Peptide C", "correct": True, "feedback": "Exact. Le peptide C (connecting peptide) est le fragment clivé lors de la maturation de la pro-insuline. Son dosage évalue la sécrétion résiduelle de cellules bêta."},
      {"text": "Glucagon", "correct": False, "feedback": "Le glucagon est sécrété par les cellules alpha."},
      {"text": "GLP-1", "correct": False, "feedback": "Le GLP-1 est une incrétine d'origine intestinale."},
    ],
    "explanation": "Le peptide C est sécrété en quantités équimolaires à l'insuline mais n'est pas métabolisé par le foie (clairance hépatique nulle) → son dosage est plus fiable que celui de l'insuline pour évaluer la sécrétion endogène. Un peptide C effacé (< 0,1 ng/mL) confirme le DT1.",
    "reference": "Greenbaum CJ et al., Diabetes 2020",
  },

  {
    "id": "DIAB-BR-004",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "L'effet incrétine désigne :",
    "type": "mcq",
    "answers": [
      {"text": "La capacité du glucagon à stimuler la glycogénolyse hépatique", "correct": False, "feedback": "C'est le rôle du glucagon, pas de l'effet incrétine."},
      {"text": "L'augmentation de la sécrétion d'insuline déclenchée par les hormones intestinales (GLP-1, GIP) en réponse au repas oral", "correct": True, "feedback": "Exact. L'effet incrétine explique pourquoi la sécrétion d'insuline est 2-3× supérieure après ingestion orale de glucose vs perfusion IV de la même quantité."},
      {"text": "La résistance à l'insuline au niveau des récepteurs musculaires", "correct": False, "feedback": "C'est l'insulinorésistance."},
      {"text": "La néoglucogenèse hépatique à partir des acides aminés", "correct": False, "feedback": "C'est la néoglucogenèse, non l'effet incrétine."},
    ],
    "explanation": "Le GLP-1 (sécrété par les cellules L iléales) et le GIP (cellules K duodénales) sont libérés en réponse à l'ingestion alimentaire → stimulation glucose-dépendante de la sécrétion d'insuline. Cet effet est réduit de 50% dans le DT2. Les GLP-1 RA et iDPP4 exploitent cette voie.",
    "reference": "Drucker DJ, Cell Metabolism 2018",
  },

  {
    "id": "DIAB-BR-005",
    "level": "bronze",
    "domain": "diagnostic",
    "question": "Parmi les critères diagnostiques du diabète selon l'OMS/ADA 2024, lequel est correct ?",
    "type": "mcq",
    "answers": [
      {"text": "Glycémie à jeun ≥ 1,10 g/L (6,1 mmol/L) confirmée", "correct": False, "feedback": "1,10 g/L est le seuil de l'anomalie de la glycémie à jeun (AGJ), pas du diabète."},
      {"text": "Glycémie à jeun ≥ 1,26 g/L (7,0 mmol/L) à deux reprises", "correct": True, "feedback": "Exact. GAJ ≥ 1,26 g/L à jeun confirmée = diabète. Un seul dosage suffit si symptômes classiques."},
      {"text": "HbA1c ≥ 6,0% confirmée", "correct": False, "feedback": "Le seuil diagnostique de l'HbA1c est ≥ 6,5%, pas 6,0%."},
      {"text": "Glycémie post-prandiale 2h ≥ 1,80 g/L lors de l'HGPO", "correct": False, "feedback": "Le seuil HGPO est ≥ 2,00 g/L à 2h."},
    ],
    "explanation": "4 critères diagnostiques (ADA 2024) : GAJ ≥ 1,26 g/L, glycémie aléatoire ≥ 2,00 g/L + symptômes, HGPO 75g → glycémie 2h ≥ 2,00 g/L, HbA1c ≥ 6,5%. En l'absence de symptômes, 2 dosages concordants sont nécessaires.",
    "reference": "ADA Standards of Care 2024 — Section 2",
  },

  {
    "id": "DIAB-BR-006",
    "level": "bronze",
    "domain": "diagnostic",
    "question": "Le diabète gestationnel est dépisté entre :",
    "type": "mcq",
    "answers": [
      {"text": "8 et 12 SA", "correct": False, "feedback": "Non. Le 1er trimestre est réservé au dépistage du diabète prégestationnel méconnu."},
      {"text": "14 et 18 SA", "correct": False, "feedback": "Non."},
      {"text": "24 et 28 SA", "correct": True, "feedback": "Exact. Le test HGPO 75g (O'Sullivan modifié) est réalisé entre 24 et 28 SA chez les femmes à risque."},
      {"text": "32 et 36 SA", "correct": False, "feedback": "Non. Trop tardif pour un dépistage optimal."},
    ],
    "explanation": "Le diabète gestationnel se développe quand la résistance à l'insuline physiologique de la grossesse (T2-T3) dépasse les capacités sécrétoires. Dépistage : GAJ ≥ 0,92 g/L au T1 (diabète méconnu), puis HGPO 75g entre 24-28 SA (seuils IADPSG : GAJ ≥ 0,92, H1 ≥ 1,80, H2 ≥ 1,53 g/L).",
    "reference": "CNGOF-SFD 2023 — Recommandations diabète gestationnel",
  },

  {
    "id": "DIAB-BR-007",
    "level": "bronze",
    "domain": "traitement",
    "question": "Quel est le mécanisme d'action principal de la metformine ?",
    "type": "mcq",
    "answers": [
      {"text": "Stimulation de la sécrétion d'insuline par les cellules bêta", "correct": False, "feedback": "Non. La metformine n'agit pas sur la sécrétion d'insuline (pas de risque d'hypoglycémie en monothérapie)."},
      {"text": "Inhibition de la néoglucogenèse hépatique via activation d'AMPK", "correct": True, "feedback": "Exact. La metformine active l'AMPK (AMP-activated protein kinase) hépatique → réduction de la production hépatique de glucose de 25-30%. Effet secondaire : malabsorption de la B12."},
      {"text": "Blocage des récepteurs du GLP-1", "correct": False, "feedback": "Non. Les GLP-1 RA activent ces récepteurs ; la metformine n'agit pas sur cette voie."},
      {"text": "Inhibition du cotransporteur SGLT2 rénal", "correct": False, "feedback": "C'est le mécanisme des iSGLT2 (gliflozines), pas de la metformine."},
    ],
    "explanation": "La metformine réduit la production hépatique de glucose par inhibition du complexe I de la chaîne respiratoire mitochondriale → accumulation d'AMP → activation d'AMPK → inhibition de la néoglucogenèse. Elle améliore aussi la sensibilité à l'insuline périphérique.",
    "reference": "Foretz M et al., J Clin Invest 2010",
  },

  {
    "id": "DIAB-BR-008",
    "level": "bronze",
    "domain": "traitement",
    "question": "À partir de quel DFG la metformine est-elle contre-indiquée ?",
    "type": "mcq",
    "answers": [
      {"text": "DFG < 60 mL/min", "correct": False, "feedback": "Réduction de dose recommandée entre 30-60, mais pas de contre-indication absolue."},
      {"text": "DFG < 45 mL/min", "correct": False, "feedback": "Prudence accrue entre 30-45 ; la CI absolue est à 30."},
      {"text": "DFG < 30 mL/min", "correct": True, "feedback": "Exact. Contre-indication absolue si DFG < 30 mL/min (accumulation → risque d'acidose lactique)."},
      {"text": "DFG < 15 mL/min", "correct": False, "feedback": "C'est trop tardif. La CI est établie à 30 mL/min."},
    ],
    "explanation": "Metformine : CI absolue si DFG < 30, prudence entre 30-45 (réduction de dose), surveillance entre 45-60. En cas d'injection de produit de contraste iodé ou de chirurgie : arrêt 48h avant si DFG < 60.",
    "reference": "HAS 2023 — Metformine et fonction rénale",
  },

  {
    "id": "DIAB-BR-009",
    "level": "bronze",
    "domain": "urgences",
    "question": "Un patient DT1 est retrouvé inconscient. Sa glycémie capillaire est de 0,32 g/L. Quel est le traitement de première intention à domicile par les proches ?",
    "type": "mcq",
    "answers": [
      {"text": "Injection d'insuline rapide pour corriger l'hyperglycémie sous-jacente", "correct": False, "feedback": "JAMAIS d'insuline en cas d'hypoglycémie sévère. Fatal."},
      {"text": "Glucagon IM ou SC (1 mg), ou glucagon nasal (3 mg)", "correct": True, "feedback": "Exact. Le glucagon (IM, SC ou intranasal) stimule la glycogénolyse hépatique et remonte rapidement la glycémie chez un patient inconscient."},
      {"text": "Resucrage oral par boisson sucrée", "correct": False, "feedback": "Impossible chez un patient inconscient (risque d'inhalation)."},
      {"text": "Injection de sérum glucosé SC", "correct": False, "feedback": "La voie SC pour le glucose est inefficace. La voie IV (G30%) est réservée aux professionnels de santé."},
    ],
    "explanation": "En cas d'hypoglycémie sévère avec inconscience : glucagon IM/SC 1 mg (kit GlucaGen® ou Baqsimi® intranasal 3 mg). Le glucagon mobilise le glycogène hépatique → remontée glycémique en 10-15 min. Appel du SAMU simultanément. Après reprise de conscience : resucrage oral.",
    "reference": "HAS 2023 — Gestion de l'hypoglycémie sévère",
  },

  {
    "id": "DIAB-BR-010",
    "level": "bronze",
    "domain": "complications",
    "question": "Le premier signe de néphropathie diabétique débutante est :",
    "type": "mcq",
    "answers": [
      {"text": "Une élévation de la créatinine sérique", "correct": False, "feedback": "La créatinine s'élève tardivement, quand 50% des néphrons sont détruits."},
      {"text": "Une microalbuminurie (RAC 30-300 mg/g)", "correct": True, "feedback": "Exact. La microalbuminurie (RAC = Rapport Albumine/Créatinine urinaire) est le premier signe détectable de néphropathie. Elle précède la baisse du DFG de plusieurs années."},
      {"text": "Une hématurie macroscopique", "correct": False, "feedback": "L'hématurie n'est pas caractéristique de la néphropathie diabétique — elle doit faire rechercher une autre cause."},
      {"text": "Une hypertension artérielle", "correct": False, "feedback": "L'HTA est souvent associée mais survient après la microalbuminurie dans le DT1."},
    ],
    "explanation": "Stades de la néphropathie diabétique (Mogensen) : hyperfiltration → microalbuminurie (RAC 30-300) → macroalbuminurie (RAC > 300) → IRC progressive. Le dépistage annuel par RAC est obligatoire dans tout diabète.",
    "reference": "KDIGO 2022 — Diabetic Kidney Disease",
  },

  {
    "id": "DIAB-BR-011",
    "level": "bronze",
    "domain": "complications",
    "question": "Quelle est la fréquence recommandée du fond d'oeil chez un patient DT2 équilibré sans rétinopathie connue ?",
    "type": "mcq",
    "answers": [
      {"text": "Tous les 6 mois", "correct": False, "feedback": "Non. Rythme trop rapproché en l'absence de rétinopathie."},
      {"text": "Tous les ans", "correct": True, "feedback": "Exact. FO annuel recommandé chez tout diabétique pour le dépistage de la rétinopathie (ou tous les 2 ans si DT2 équilibré, pas de facteur de risque — selon HAS 2023)."},
      {"text": "Tous les 5 ans", "correct": False, "feedback": "Trop espacé. La rétinopathie peut évoluer silencieusement."},
      {"text": "Uniquement en cas de baisse d'acuité visuelle", "correct": False, "feedback": "Non. Attendre les symptômes = rétinopathie avancée. Le dépistage est asymptomatique."},
    ],
    "explanation": "HAS 2023 : FO annuel pour tout diabétique. Peut être espacé à 2 ans si DT2 équilibré (HbA1c < 7,5%), sans rétinopathie et sans facteur de risque associé. Rétraction à 1 an lors de toute déstabilisation glycémique.",
    "reference": "HAS 2023 — Stratégie de prise en charge du DT2",
  },

  {
    "id": "DIAB-BR-012",
    "level": "bronze",
    "domain": "traitement",
    "question": "Quel est l'effet secondaire principal des sulfamides hypoglycémiants (gliclazide, glimepiride) ?",
    "type": "mcq",
    "answers": [
      {"text": "Acidose lactique", "correct": False, "feedback": "L'acidose lactique est le risque de la metformine, pas des sulfamides."},
      {"text": "Hypoglycémie et prise de poids", "correct": True, "feedback": "Exact. Les sulfamides stimulent la sécrétion d'insuline de façon glucose-indépendante → hypoglycémie possible même à jeun. Prise de poids systématique (+2-3 kg)."},
      {"text": "Insuffisance cardiaque par rétention hydrosodée", "correct": False, "feedback": "C'est l'effet indésirable des glitazones (pioglitazone)."},
      {"text": "Pancréatite aiguë", "correct": False, "feedback": "La pancréatite est un effet rare des iDPP4 et GLP-1 RA."},
    ],
    "explanation": "Sulfamides : insulinosécréteurs non glucose-dépendants → hypoglycémies prolongées possibles (surtout chez le sujet âgé et en cas d'IRC). À éviter en post-SCA (risque d'arythmie par hypoglycémie) et en IRC avancée.",
    "reference": "EASD/ADA 2022 — Consensus Treatment of Hyperglycemia",
  },

  {
    "id": "DIAB-BR-013",
    "level": "bronze",
    "domain": "physiopathologie",
    "question": "Dans l'acidocétose diabétique (ACD), l'absence d'insuline provoque :",
    "type": "msq",
    "answers": [
      {"text": "Lipolyse massive → acides gras libres → corps cétoniques", "correct": True, "feedback": "Exact. Sans insuline, la lipolyse est freinée → production massive d'acétyl-CoA → cétogenèse hépatique."},
      {"text": "Hyperglycémie par néoglucogenèse et glycogénolyse hepatique non freinées", "correct": True, "feedback": "Exact. L'insuline inhibe normalement la production hépatique de glucose ; son absence lève ce frein."},
      {"text": "Hypokaliémie immédiate par sortie du K+ des cellules", "correct": False, "feedback": "Au contraire : l'ACD provoque une hyperkaliémie initiale (sortie cellulaire du K+ en échange des H+). La kaliémie chute brutalement à l'instauration de l'insuline."},
      {"text": "Acidose métabolique à trou anionique élevé", "correct": True, "feedback": "Exact. Les corps cétoniques (bêta-hydroxybutyrate, acétoacétate) sont des acides forts → acidose métabolique à TA élevé."},
    ],
    "explanation": "L'ACD résulte d'une carence en insuline absolue (arrêt ou oubli) ou relative (infection, stress). Triade diagnostique : hyperglycémie > 2,50 g/L + acidose pH < 7,30 + cétonémie > 3 mmol/L.",
    "reference": "ADA 2024 — Diabetic Ketoacidosis",
  },

  {
    "id": "DIAB-BR-014",
    "level": "bronze",
    "domain": "diagnostic",
    "question": "Le LADA (Latent Autoimmune Diabetes in Adults) se distingue du DT2 par :",
    "type": "msq",
    "answers": [
      {"text": "La présence d'anticorps anti-GAD65 positifs", "correct": True, "feedback": "Exact. Les anti-GAD (anti-décarboxylase de l'acide glutamique) sont positifs dans 80% des LADA."},
      {"text": "Un âge de découverte > 35 ans avec surpoids important", "correct": False, "feedback": "Le LADA est souvent mince à la découverte ; l'obésité oriente vers le DT2."},
      {"text": "Un peptide C effacé ou bas dès la découverte", "correct": False, "feedback": "Le peptide C est encore présent dans le LADA (destruction lente des cellules bêta), contrairement au DT1 aigu."},
      {"text": "Un phénotype initial pseudo-DT2 avec échappement rapide aux ADO", "correct": True, "feedback": "Exact. Le LADA mime le DT2 mais évolue vers l'insulinodépendance en 1-5 ans."},
    ],
    "explanation": "LADA = DT1 à destruction lente chez l'adulte. Anticorps (anti-GAD, anti-IA2, anti-ZnT8) positifs + peptide C encore présent + phénotype DT2. Critères de Maddaloni : âge > 30 ans, anti-GAD+ et non-insulinodépendant à la découverte.",
    "reference": "Maddaloni E et al., Lancet Diabetes Endocrinol 2022",
  },

  {
    "id": "DIAB-BR-015",
    "level": "bronze",
    "domain": "traitement",
    "question": "L'insuline basale (Glargine, Dégludec) a pour objectif principal de :",
    "type": "mcq",
    "answers": [
      {"text": "Couvrir les pics glycémiques post-prandiaux", "correct": False, "feedback": "C'est le rôle des insulines rapides/ultra-rapides (bolus prandial)."},
      {"text": "Contrôler la glycémie à jeun en freinant la production hépatique de glucose nocturne", "correct": True, "feedback": "Exact. L'insuline basale (action prolongée 24h) cible la glycémie à jeun en supprimant la néoglucogenèse et glycogénolyse hépatiques nocturnes."},
      {"text": "Stimuler la sécrétion de GLP-1 intestinal", "correct": False, "feedback": "L'insuline n'agit pas sur la sécrétion de GLP-1."},
      {"text": "Réduire la résistance à l'insuline musculaire", "correct": False, "feedback": "C'est un effet indirect et secondaire, pas l'objectif principal de la basale."},
    ],
    "explanation": "Schéma basal-bolus : insuline basale (1 injection/jour) → glycémie à jeun ; insuline rapide avant chaque repas (bolus prandial) → pic glycémique post-prandial. La dose de basale est ajustée sur la glycémie au réveil.",
    "reference": "Inzucchi SE et al., Diabetes Care 2015",
  },

]  # fin questions_bronze


questions_argent = [

  # ── ARGENT — Diagnostic différentiel ────────────────────────────────────

  {
    "id": "DIAB-AR-001",
    "level": "argent",
    "domain": "diagnostic",
    "question": "Un patient de 35 ans, mince (IMC 22), présente un diabète découvert fortuitement. HbA1c 7,8%, GAJ 1,45 g/L. Il a un frère et une mère diabétiques (non insulinodépendants). Anti-GAD négatifs, peptide C à 1,9 ng/mL. Quel type de diabète évoquez-vous en premier ?",
    "type": "mcq",
    "answers": [
      {"text": "DT1 d'apparition tardive", "correct": False, "feedback": "Les anti-GAD négatifs et le peptide C conservé sont contre le DT1."},
      {"text": "MODY (diabète monogénique)", "correct": True, "feedback": "Exact. MODY évoqué devant : jeune âge, mince, ATCD familiaux sur 2-3 générations, anti-corps négatifs, peptide C conservé. MODY GCK probable (hyperglycémie modérée stable)."},
      {"text": "DT2 classique", "correct": False, "feedback": "Le DT2 est possible mais l'absence d'obésité, l'âge jeune et l'hérédité dominante sur 3 générations orientent vers un MODY."},
      {"text": "Diabète cortico-induit", "correct": False, "feedback": "Pas de contexte de corticothérapie mentionné."},
    ],
    "explanation": "Le MODY (Maturity Onset Diabetes of the Young) touche < 35 ans, mince, avec histoire familiale dominante (père ou mère diabétique). MODY 2 (GCK) : hyperglycémie modérée stable, ne nécessite pas de traitement. MODY 3 (HNF-1α) : hyperglycémie progressive, très sensible aux sulfamides.",
    "reference": "Hattersley AT et al., Lancet 2018",
  },

  {
    "id": "DIAB-AR-002",
    "level": "argent",
    "domain": "traitement",
    "question": "Un patient DT2 avec insuffisance cardiaque à fraction d'éjection réduite (FEVG 35%) et DFG 55 mL/min. Quel antidiabétique offre le meilleur bénéfice cardiovasculaire démontré dans ce contexte ?",
    "type": "mcq",
    "answers": [
      {"text": "Sitagliptine (iDPP4)", "correct": False, "feedback": "La sitagliptine est neutre sur la mortalité CV mais ne réduit pas les hospitalisations pour IC (essai TECOS)."},
      {"text": "Empagliflozine ou dapagliflozine (iSGLT2)", "correct": True, "feedback": "Exact. Les iSGLT2 réduisent les hospitalisations pour IC de 35% et la mortalité cardiovasculaire (EMPA-REG, DAPA-HF). Bénéfice indépendant de l'effet hypoglycémiant."},
      {"text": "Pioglitazone (glitazone)", "correct": False, "feedback": "La pioglitazone est contre-indiquée en IC (rétention hydrosodée, aggravation)."},
      {"text": "Gliclazide (sulfamide)", "correct": False, "feedback": "Pas de bénéfice CV démontré en IC, risque hypoglycémique."},
    ],
    "explanation": "Les iSGLT2 sont le traitement de référence du DT2 avec IC : réduction des hospitalisations pour IC (EMPA-REG -35%, EMPEROR-Reduced, DAPA-HF). Mécanisme : réduction de la précharge et postcharge via glycosurie + effet osmotique, réduction de la fibrose myocardique.",
    "reference": "McMurray JJV et al., DAPA-HF, NEJM 2019",
  },

  {
    "id": "DIAB-AR-003",
    "level": "argent",
    "domain": "complications",
    "question": "La neuropathie douloureuse diabétique est caractérisée par :",
    "type": "msq",
    "answers": [
      {"text": "Des douleurs à prédominance nocturne, en brûlures ou décharges électriques", "correct": True, "feedback": "Correct. Les douleurs neuropathiques diabétiques sont typiquement nocturnes, aggravées au repos, avec brûlures, allodynie, dysesthésies."},
      {"text": "Une topographie en chaussettes (pieds et jambes) bilatérale et symétrique", "correct": True, "feedback": "Correct. La polyneuropathie sensitive distale symétrique est la forme la plus fréquente."},
      {"text": "Une douleur à la palpation des masses musculaires (fibromyalgie associée)", "correct": False, "feedback": "Non. Les douleurs neuropathiques sont liées à une dysfonction nerveuse, pas à une atteinte musculaire."},
      {"text": "Une amélioration de la douleur par la marche", "correct": False, "feedback": "Non. La marche aggrave souvent la douleur neuropathique (allodynie au contact)."},
    ],
    "explanation": "La neuropathie douloureuse diabétique (NDD) touche 20-30% des diabétiques. Traitements de 1ère ligne : duloxétine (IRSN) 60-120 mg/jour, prégabaline/gabapentine. 2ème ligne : amitriptyline, tramadol, capsaïcine topique.",
    "reference": "Pop-Busui R et al., Diabetes Care 2022",
  },

  {
    "id": "DIAB-AR-004",
    "level": "argent",
    "domain": "traitement",
    "question": "Les 4 piliers de la néphroprotection dans le DT2 avec MRC sont :",
    "type": "msq",
    "answers": [
      {"text": "IEC ou ARA2 (blocage du SRAA)", "correct": True, "feedback": "1er pilier. Réduction de la protéinurie et du DFG si RAC > 30 mg/g + HTA."},
      {"text": "iSGLT2 (empagliflozine ou dapagliflozine)", "correct": True, "feedback": "2ème pilier. EMPA-KIDNEY, DAPA-CKD : réduction de 39% de la progression de la MRC."},
      {"text": "GLP-1 RA (sémaglutide SC)", "correct": True, "feedback": "3ème pilier. Bénéfice rénal dans SUSTAIN-6, FLOW (sémaglutide)."},
      {"text": "Finerenone (ARM non stéroïdien)", "correct": True, "feedback": "4ème pilier. FIDELIO-DKD, FIGARO-DKD : réduction de 18% des événements rénaux majeurs."},
    ],
    "explanation": "Les 4 piliers de la néphroprotection dans le DT2 (consensus KDIGO/EASD 2023) : IEC/ARA2 + iSGLT2 + GLP-1 RA + finerenone. Attention aux interactions K+ : IEC + finerenone = risque d'hyperkaliémie, surveillance rapprochée.",
    "reference": "KDIGO 2022 — Management of Diabetic Kidney Disease",
  },

  {
    "id": "DIAB-AR-005",
    "level": "argent",
    "domain": "traitement",
    "question": "Un patient DT2 reçoit de la metformine + gliclazide. Son HbA1c est à 8,5% depuis 6 mois malgré observance correcte. Comment qualifiez-vous cette situation et quelle est votre stratégie ?",
    "type": "mcq",
    "answers": [
      {"text": "Échappement secondaire aux ADO — escalade thérapeutique vers iSGLT2 ou GLP-1 RA", "correct": True, "feedback": "Exact. L'échappement secondaire = HbA1c > cible malgré observance optimale. Les recommandations ESC/EASD 2023 orientent vers l'ajout d'un iSGLT2 (si IC ou MRC) ou d'un GLP-1 RA (si obésité ou ASCVD)."},
      {"text": "Augmenter la dose de gliclazide au maximum (120 mg/j)", "correct": False, "feedback": "La dose maximale de gliclazide LM est 120 mg/jour, mais l'escalade vers un sulfamide seul n'est pas recommandée en cas d'échappement."},
      {"text": "Ajouter de l'insuline basale immédiatement", "correct": False, "feedback": "L'insuline est une option mais l'escalade par iSGLT2 ou GLP-1 RA est recommandée en première intention avant l'insuline."},
      {"text": "Doubler la dose de metformine", "correct": False, "feedback": "La metformine est déjà à dose optimale."},
    ],
    "explanation": "L'échappement secondaire aux ADO concerne ~50% des patients DT2 à 10 ans (épuisement progressif des cellules bêta). Escalade recommandée (ESC/EASD 2023) : 1. iSGLT2 si IC/MRC, 2. GLP-1 RA si obésité/ASCVD, 3. iDPP4 si bien toléré, 4. insuline si HbA1c > 10% ou symptômes.",
    "reference": "ESC/EASD Guidelines 2023",
  },

  {
    "id": "DIAB-AR-006",
    "level": "argent",
    "domain": "urgences",
    "question": "Dans le protocole de réanimation de l'ACD sévère, à quel moment débutez-vous l'insuline IVSE ?",
    "type": "mcq",
    "answers": [
      {"text": "Immédiatement à l'arrivée, avant tout bilan biologique", "correct": False, "feedback": "Dangereux. Si kaliémie inconnue et < 3,5 mmol/L : l'insuline aggrave l'hypokaliémie → arrêt cardiaque."},
      {"text": "Après avoir confirmé que le K+ ≥ 3,5 mmol/L et après 1-2L de NaCl 0,9%", "correct": True, "feedback": "Exact. Protocole ADA : réhydratation d'abord, puis insuline si K+ ≥ 3,5. Si K+ < 3,5 : supplémenter en K+ AVANT de commencer l'insuline."},
      {"text": "Seulement quand la glycémie dépasse 5,00 g/L", "correct": False, "feedback": "Non. La décision de débuter l'insuline ne dépend pas d'un seuil de glycémie mais du K+."},
      {"text": "En bolus IV (0,4 UI/kg) puis perfusion continue", "correct": False, "feedback": "Les bolus d'insuline ne sont pas recommandés chez l'adulte jeune en ACD (risque d'œdème cérébral)."},
    ],
    "explanation": "Protocole ADA/ACD adulte : 1. NaCl 0,9% 1L/h × 1-2h, 2. Ionogramme urgent, 3. Si K+ ≥ 3,5 : insuline IVSE 0,1 UI/kg/h. Si K+ < 3,5 : supplémenter en KCl d'abord. La cétonémie (pas la glycémie) guide l'arrêt de l'insuline IVSE.",
    "reference": "ADA 2024 — DKA Management Protocol",
  },

  {
    "id": "DIAB-AR-007",
    "level": "argent",
    "domain": "traitement",
    "question": "Un patient DT2 est hospitalisé pour pneumonie avec hyperglycémie (glycémies entre 2,50 et 3,80 g/L). Il est habituellement sous metformine + gliclazide. Quelle est la stratégie insulinique pendant l'hospitalisation ?",
    "type": "mcq",
    "answers": [
      {"text": "Continuer le gliclazide et corriger les hyperglycémies par bolus d'insuline rapide uniquement", "correct": False, "feedback": "Non. Le gliclazide est contre-indiqué en situation aiguë (infection, risque d'hypoglycémie). Les corrections seules sont insuffisantes."},
      {"text": "Arrêt des ADO, insuline basal-bolus avec objectif glycémique 1,40-1,80 g/L en hospitalisation", "correct": True, "feedback": "Exact. En situation aiguë (infection, chirurgie) : arrêt des ADO, insulinothérapie IV ou SC basal-bolus. Cible 1,40-1,80 g/L en médecine générale, 1,40-1,80 en réanimation."},
      {"text": "Maintenir la metformine et ajouter un iSGLT2", "correct": False, "feedback": "La metformine doit être arrêtée si risque d'hypoxie ou de défaillance d'organe. Les iSGLT2 sont contre-indiqués en situation aiguë (risque d'euDKA)."},
      {"text": "Insuline IVSE continue à 0,1 UI/kg/h pour toute la durée d'hospitalisation", "correct": False, "feedback": "L'IVSE est réservée aux situations sévères (réanimation). En médecine, l'insuline SC basal-bolus est préférable."},
    ],
    "explanation": "Hyperglycémie intra-hospitalière : arrêt des ADO (metformine, sulfamides, iSGLT2), insuline basal-bolus SC. Cibles ADA pour l'hospitalisation hors réanimation : 1,40-1,80 g/L. Reprise des ADO à la sortie si stable.",
    "reference": "ADA 2024 — Hospital Management of Hyperglycemia",
  },

  {
    "id": "DIAB-AR-008",
    "level": "argent",
    "domain": "complications",
    "question": "Le diabète cortico-induit se caractérise par :",
    "type": "msq",
    "answers": [
      {"text": "Hyperglycémie prédominant en post-prandial et l'après-midi (pic de la corticothérapie)", "correct": True, "feedback": "Exact. Les corticoïdes augmentent la néoglucogenèse hépatique et la résistance à l'insuline → hyperglycémie surtout post-prandiale (contrairement au DT2 classique où la GAJ est perturbée en premier)."},
      {"text": "Glycémie à jeun souvent normale ou peu élevée", "correct": True, "feedback": "Exact. Le profil typique du diabète cortico-induit : GAJ normale le matin (avant la prise de cortisone) mais hyperglycémie massive l'après-midi."},
      {"text": "Réversion complète à l'arrêt des corticoïdes dans la majorité des cas", "correct": True, "feedback": "Exact si pas de prédisposition diabétique sous-jacente. Mais le diabète cortico-induit peut démasquer un DT2 latent → surveillance prolongée."},
      {"text": "Traitement exclusivement par metformine", "correct": False, "feedback": "Non. L'insuline NPH ou la glargine (à injecter le matin pour les schémas avec prednisone matin) est souvent nécessaire. La metformine seule est insuffisante."},
    ],
    "explanation": "Diabète cortico-induit : hyperglycémie après-midi et post-prandiale. Traitement adapté au schéma de corticothérapie : prednisone 1×/jour le matin → insuline NPH ou dégludec le matin. Bolus d'insuline rapide si repas importants.",
    "reference": "Diabetes Care 2023 — Corticosteroid-induced Diabetes",
  },

  {
    "id": "DIAB-AR-009",
    "level": "argent",
    "domain": "traitement",
    "question": "Le Time in Range (TIR) est l'indicateur CGM qui mesure :",
    "type": "mcq",
    "answers": [
      {"text": "Le pourcentage du temps passé entre 0,70 et 1,80 g/L (3,9-10 mmol/L)", "correct": True, "feedback": "Exact. TIR = % du temps dans la cible glycémique (70-180 mg/dL). Cible : > 70% pour la plupart des DT1/DT2."},
      {"text": "La variabilité glycémique sur 24h (coefficient de variation)", "correct": False, "feedback": "Le CV (coefficient de variation) est un indicateur séparé de la variabilité. Cible CV < 36%."},
      {"text": "La glycémie moyenne des 14 derniers jours", "correct": False, "feedback": "C'est le GMI (Glucose Management Indicator), analogue estimé de l'HbA1c."},
      {"text": "Le temps passé en hypoglycémie (< 0,70 g/L)", "correct": False, "feedback": "C'est le TBR (Time Below Range). TIR et TBR sont des indicateurs distincts."},
    ],
    "explanation": "Indicateurs CGM (consensus international 2019) : TIR (70-180) > 70%, TBR (< 70) < 4%, TBR (< 54) < 1%, TAR (> 180) < 25%, TAR (> 250) < 5%, CV < 36%. Dans la grossesse : TIR 63-140 mg/dL > 70%.",
    "reference": "Battelino T et al., Diabetes Care 2019",
  },

  {
    "id": "DIAB-AR-010",
    "level": "argent",
    "domain": "complications",
    "question": "Quel signe clinique simple a une valeur prédictive positive de 89% pour l'ostéomyélite du pied diabétique ?",
    "type": "mcq",
    "answers": [
      {"text": "L'érythème péri-lésionnel > 2 cm", "correct": False, "feedback": "Signe d'infection des tissus mous, non spécifique de l'ostéomyélite."},
      {"text": "Le probe-to-bone test positif (sonde métallique touchant l'os)", "correct": True, "feedback": "Exact. Le probe-to-bone test : introduction d'une sonde stérile dans l'ulcère — si contact osseux → VPP 89% pour ostéomyélite (Grayson et al., JAMA 1995)."},
      {"text": "La CRP > 100 mg/L", "correct": False, "feedback": "Signe d'infection mais non spécifique de l'atteinte osseuse."},
      {"text": "Le pied rouge et chaud (delta T° > 2°C vs controlatéral)", "correct": False, "feedback": "Signe du pied de Charcot aigu plutôt que de l'ostéomyélite spécifiquement."},
    ],
    "explanation": "Le probe-to-bone test (test de la sonde) : sonde métallique stérile introduite dans l'ulcère → contact osseux = VPP 89%. IRM = gold standard pour confirmer l'ostéomyélite (sensibilité 90%, spécificité 80%). Biopsie osseuse per-opératoire pour la bactériologie.",
    "reference": "Grayson ML et al., JAMA 1995",
  },

  {
    "id": "DIAB-AR-011",
    "level": "argent",
    "domain": "cas_cliniques",
    "question": "Lucas, 14 ans (cas n°1), arrive avec pH 6,95, bicarbonates 4 mmol/L, cétonémie 7,2 mmol/L. L'ADA classe cette ACD comme :",
    "type": "mcq",
    "answers": [
      {"text": "Légère (pH 7,25-7,30)", "correct": False, "feedback": "ACD légère : pH 7,25-7,30, bicarbonates 15-18 mmol/L."},
      {"text": "Modérée (pH 7,00-7,24)", "correct": False, "feedback": "ACD modérée : pH 7,00-7,24. Ce patient a un pH < 7,00."},
      {"text": "Sévère (pH < 7,00)", "correct": True, "feedback": "Exact. pH 6,95 < 7,00 + bicarbonates < 5 mmol/L + cétonémie > 6 → ACD sévère. Critère d'admission en réanimation."},
      {"text": "Non classifiable car trop d'anomalies", "correct": False, "feedback": "Non. La classification ADA est bien applicable."},
    ],
    "explanation": "Classification ADA de l'ACD : Légère (pH 7,25-7,30, bicarb 15-18, conscient), Modérée (pH 7,00-7,24, bicarb 10-15, somnolent), Sévère (pH < 7,00, bicarb < 10, stupeur/coma). Ce cas = sévère avec GCS 10 et pH 6,95.",
    "reference": "ADA Standards of Care 2024",
  },

  {
    "id": "DIAB-AR-012",
    "level": "argent",
    "domain": "traitement",
    "question": "En prévention secondaire cardiovasculaire (DT2 + ATCD de SCA), l'objectif LDL recommandé est :",
    "type": "mcq",
    "answers": [
      {"text": "< 1,00 g/L", "correct": False, "feedback": "Objectif pour le haut risque CV sans ASCVD documentée."},
      {"text": "< 0,70 g/L", "correct": False, "feedback": "Objectif très haut risque sans ASCVD. En prévention secondaire, la cible est encore plus basse."},
      {"text": "< 0,55 g/L", "correct": True, "feedback": "Exact. ESC/EAS 2022 : LDL < 0,55 g/L en très haut risque (ASCVD documentée). Et réduction ≥ 50% du LDL basal."},
      {"text": "< 0,40 g/L", "correct": False, "feedback": "Pas de seuil officiel à 0,40. Certaines études montrent un bénéfice à des LDL très bas mais la recommandation standard est < 0,55."},
    ],
    "explanation": "ESC/EAS 2022 : très haut risque = ASCVD documentée (SCA, AVC, artériopathie) → LDL < 0,55 g/L ET réduction ≥ 50%. Si non atteint sous statine max + ézétimibe : anti-PCSK9 (évolocumab, alirocumab).",
    "reference": "ESC/EAS Guidelines on Dyslipidaemia 2022",
  },

  {
    "id": "DIAB-AR-013",
    "level": "argent",
    "domain": "physiopathologie",
    "question": "Après sleeve gastrectomie, la remission du DT2 est rapide (< 30 jours) avant la perte de poids maximale. Quel mécanisme principal explique cette précocité ?",
    "type": "mcq",
    "answers": [
      {"text": "Réduction de l'absorption intestinale des glucides", "correct": False, "feedback": "La sleeve est une procédure restrictive, pas malabsorptive. L'intestin grêle n'est pas court-circuité."},
      {"text": "Réduction de la ghréline + augmentation du GLP-1 post-prandial + modification du flux biliaire", "correct": True, "feedback": "Exact. La sleeve excise le fundus (principale source de ghréline anorexigène) et accélère la vidange vers l'iléon → pic de GLP-1 ×3-5 → effet incrétine amplifié → remission glycémique précoce."},
      {"text": "Restriction calorique post-opératoire immédiate", "correct": False, "feedback": "La restriction explique une partie mais pas la rapidité de la remission (quelques jours seulement)."},
      {"text": "Augmentation de la sensibilité à l'insuline musculaire par l'exercice post-opératoire", "correct": False, "feedback": "Non. Ce mécanisme est secondaire et tardif."},
    ],
    "explanation": "La remission précoce (< 30j) après chirurgie bariatrique est due à des mécanismes métaboliques indépendants de la perte de poids : réduction de la ghréline (fundus réséqué), augmentation du GLP-1 et PYY (transit iléal accéléré), modification de la circulation entéro-hépatique des acides biliaires (FXR, TGR5).",
    "reference": "Rubino F et al., Lancet 2022",
  },

  {
    "id": "DIAB-AR-014",
    "level": "argent",
    "domain": "traitement",
    "question": "Quelle est la principale différence entre les iDPP4 (sitagliptine) et les GLP-1 RA (sémaglutide) en termes d'effet clinique ?",
    "type": "msq",
    "answers": [
      {"text": "Les GLP-1 RA induisent une perte de poids significative (-5 à -15 kg) ; les iDPP4 sont neutres sur le poids", "correct": True, "feedback": "Exact. Les GLP-1 RA agissent sur les récepteurs hypothalamiques → réduction de l'appétit. Les iDPP4 n'ont pas cet effet central."},
      {"text": "Les GLP-1 RA ont un bénéfice cardiovasculaire et rénal prouvé (MACE, hospitalisation IC) ; les iDPP4 sont neutres ou légèrement défavorables (saxagliptine → IC)", "correct": True, "feedback": "Exact. SUSTAIN-6, LEADER, OUTCOME : GLP-1 RA réduisent les MACE. SAVOR-TIMI (saxagliptine) : légère augmentation des hospitalisations pour IC."},
      {"text": "Les iDPP4 peuvent être utilisés en IV à l'hôpital ; les GLP-1 RA seulement en ambulatoire", "correct": False, "feedback": "Non. Les iDPP4 oraux peuvent être utilisés en hospitalisation (dose adaptée à la fonction rénale), mais aucun n'est en IV."},
      {"text": "Les iDPP4 sont beaucoup moins chers et disponibles en génériques ; les GLP-1 RA sont coûteux", "correct": True, "feedback": "Exact. La sitagliptine est disponible en générique depuis 2023. Le sémaglutide reste onéreux (remboursement sous conditions en France)."},
    ],
    "explanation": "iDPP4 : inhibe la DPP-4 → augmente GLP-1 endogène actif. Effet modéré (HbA1c -0,5-0,8%), neutre poids, neutre CV. GLP-1 RA : agoniste du récepteur GLP-1 → effet supra-physiologique. HbA1c -1,5-2,2%, perte de poids importante, bénéfice CV démontré.",
    "reference": "ESC/EASD 2023 consensus",
  },

  {
    "id": "DIAB-AR-015",
    "level": "argent",
    "domain": "cas_cliniques",
    "question": "M. Lambert (cas n°15, DT2 + SCA récent) est sous gliclazide. Pourquoi doit-il être arrêté en urgence ?",
    "type": "msq",
    "answers": [
      {"text": "Risque d'hypoglycémie qui peut déclencher arythmie et ischémie myocardique en post-SCA", "correct": True, "feedback": "Exact. L'hypoglycémie augmente le tonus adrénergique → tachycardie, arythmies, ischémie. Particulièrement dangereux en post-SCA."},
      {"text": "Aucun bénéfice cardiovasculaire démontré pour les sulfamides", "correct": True, "feedback": "Exact. Aucun essai n'a montré de réduction des MACE avec les sulfamides."},
      {"text": "Interaction avec le clopidogrel (DAPT post-SCA)", "correct": False, "feedback": "Pas d'interaction pharmacologique cliniquement significative."},
      {"text": "Contre-indication absolue en cas de FEVG < 50%", "correct": False, "feedback": "Il n'existe pas de contre-indication formelle du gliclazide en cas d'IC légère mais son utilisation est déconseillée."},
    ],
    "explanation": "Les sulfamides sont déconseillés en post-SCA : risque hypoglycémique (arythmie), absence de bénéfice CV, prise de poids. La priorité est l'instauration d'un iSGLT2 + GLP-1 RA (recommandations ESC/EASD 2023 indépendamment de l'HbA1c).",
    "reference": "Cosentino F et al., ESC Guidelines 2023",
  },

]  # fin questions_argent


# Fusion
questions = questions_bronze + questions_argent
