"""
VERTEX© — Banque de questions Diabétologie — Partie 2 (Or + Diamant)
"""

questions_or = [

  # ── OR — Décision multi-facteurs ─────────────────────────────────────────

  {
    "id": "DIAB-OR-001",
    "level": "or",
    "domain": "traitement",
    "question": "Mme Leclerc, DT1 sous pompe, veut être enceinte. Son HbA1c est à 7,4% et son TIR à 62%. Quels sont les objectifs glycémiques à atteindre AVANT d'autoriser la grossesse ?",
    "type": "msq",
    "answers": [
      {"text": "HbA1c < 6,5% (idéalement) ou < 7,0% (acceptable)", "correct": True, "feedback": "Exact. SFD/CNGOF 2023 : HbA1c < 6,5% avant conception si atteignable sans hypoglycémies."},
      {"text": "TIR > 70%", "correct": True, "feedback": "Exact. TIR 70-180 mg/dL > 70% est l'objectif CGM pré-conceptionnel."},
      {"text": "TBR (< 70 mg/dL) < 4%", "correct": True, "feedback": "Exact. TBR doit être réduit avant la grossesse (objectif < 4%)."},
      {"text": "Arrêt de la pompe et passage en basal-bolus par stylos", "correct": False, "feedback": "Non. La pompe est un avantage en grossesse (modulation fine des débits). Elle n'est pas à arrêter."},
    ],
    "explanation": "Bilan pré-conceptionnel DT1 : HbA1c < 6,5%, TIR > 70%, TBR < 4%, acide folique 5 mg/j (pas 0,4 mg), FO dilaté (risque d'aggravation rétinopathie en grossesse), RAC + DFG, TSH + anti-TPO, arrêt médicaments tératogènes (statine, IEC, ARA2).",
    "reference": "SFD/CNGOF 2023 — Diabète et Grossesse",
  },

  {
    "id": "DIAB-OR-002",
    "level": "or",
    "domain": "traitement",
    "question": "Dans la grossesse compliquée de DT1, les besoins en insuline évoluent selon quel schéma ?",
    "type": "mcq",
    "answers": [
      {"text": "Augmentation constante de T1 à T3 puis chute post-partum", "correct": False, "feedback": "Non. Au T1, les besoins diminuent souvent."},
      {"text": "Baisse au T1, augmentation progressive T2-T3 (+30-100%), chute brutale post-partum", "correct": True, "feedback": "Exact. T1 : nausées + diminution de l'apport → réduction de 10-20%. T2-T3 : insulinorésistance placentaire (HPL, cortisol) → besoins ×1,5-2. Post-partum : chute immédiate des doses (diviser par 2)."},
      {"text": "Stables pendant toute la grossesse puis augmentation brutale au T3", "correct": False, "feedback": "Non. La variation est progressive et bien connue."},
      {"text": "Réduction continue de T1 à T3 par adaptation des récepteurs à l'insuline", "correct": False, "feedback": "Non. L'insulinorésistance placentaire augmente les besoins au T2-T3."},
    ],
    "explanation": "Évolution des besoins insuliniques en grossesse : T1 (semaines 6-12) → souvent réduction de 10-20% (nausées, cétoses nocturnes). T2 (semaines 13-26) → hausse progressive +30-50%. T3 (semaines 27-40) → besoins peuvent doubler. Post-partum immédiat → chute brutale (diviser les doses par 2 en salle de naissance).",
    "reference": "Mathiesen ER et al., Diabetes Care 2023",
  },

  {
    "id": "DIAB-OR-003",
    "level": "or",
    "domain": "complications",
    "question": "M. Nguyen présente un pied de Charcot aigu + ulcère profond. Quel est le traitement de base (non chirurgical) du pied de Charcot aigu ?",
    "type": "mcq",
    "answers": [
      {"text": "Antibiothérapie IV large spectre pendant 6 semaines", "correct": False, "feedback": "L'antibiothérapie traite l'infection associée, pas le Charcot lui-même."},
      {"text": "Mise en décharge totale et immobilisation (TCC ou botte) pendant 6-12 semaines minimum", "correct": True, "feedback": "Exact. La mise en décharge totale (TCC = Total Contact Cast) est le pilier du traitement du Charcot aigu. Elle stoppe le cycle destruction osseuse/charge mécanique."},
      {"text": "Chirurgie de reconstruction et arthrodèse en urgence", "correct": False, "feedback": "Non. La chirurgie reconstructrice (arthrodèse) est réservée au stade chronique (Eichenholtz 3), pas au stade aigu."},
      {"text": "Biphosphonates IV pour stopper la résorption osseuse", "correct": False, "feedback": "Les biphosphonates ont été étudiés mais leur bénéfice n'est pas démontré dans le Charcot diabétique."},
    ],
    "explanation": "Pied de Charcot aigu (stade 1 d'Eichenholtz) : phase de fragmentation active. Traitement : décharge totale en TCC ou botte immobilisante (pas d'appui) pendant 3-6 mois jusqu'à la phase de coalescence (stade 2 = température normalisée, œdème réduit). L'objectif est d'éviter la déformation en 'tampon buvard'.",
    "reference": "IWGDF 2023 — Charcot Foot Guidelines",
  },

  {
    "id": "DIAB-OR-004",
    "level": "or",
    "domain": "urgences",
    "question": "Dans le protocole ACD sévère, pourquoi ne faut-il PAS arrêter l'insuline IVSE quand la glycémie descend à 2,50 g/L ?",
    "type": "mcq",
    "answers": [
      {"text": "Parce que l'insuline est nécessaire pour corriger l'acidose, même si la glycémie est normale", "correct": True, "feedback": "Exact. L'insuline IVSE est maintenue pour stopper la cétogenèse et résoudre l'acidose. On ajoute du glucose (G5% ou G10%) pour éviter l'hypoglycémie tout en maintenant le débit d'insuline."},
      {"text": "Parce que l'hyperglycémie rebondit systématiquement à l'arrêt de l'insuline", "correct": False, "feedback": "Partiellement vrai, mais la raison principale est la persistance de la cétose."},
      {"text": "Pour éviter une dépression respiratoire liée à la correction de l'acidose", "correct": False, "feedback": "Non. Ce n'est pas la raison."},
      {"text": "Pour maintenir la diurèse osmotique et éliminer les corps cétoniques", "correct": False, "feedback": "Non. La réhydratation assure l'élimination rénale des corps cétoniques."},
    ],
    "explanation": "La résolution de l'ACD nécessite que l'insuline supprime complètement la cétogenèse hépatique. La glycémie se normalise avant la cétonémie : l'insuline doit être continuée jusqu'à pH > 7,30 + bicarbonates > 18 + cétonémie < 0,6 mmol/L. Ajout de G5% pour éviter l'hypoglycémie quand glycémie < 2,50 g/L.",
    "reference": "ADA 2024 — DKA Management",
  },

  {
    "id": "DIAB-OR-005",
    "level": "or",
    "domain": "traitement",
    "question": "M. Lambert (DT2 + SCA + FEVG 48% + DFG 58 + RAC 120 mg/g). Pourquoi ne peut-on PAS associer finerenone ET éplérénone chez ce patient ?",
    "type": "mcq",
    "answers": [
      {"text": "Interaction pharmacocinétique (inhibition du CYP3A4)", "correct": False, "feedback": "La finerenone est métabolisée par CYP3A4 mais ce n'est pas la contre-indication principale."},
      {"text": "Double blocage des récepteurs minéralocorticoïdes → hyperkaliémie sévère potentiellement fatale", "correct": True, "feedback": "Exact. Finerenone + éplérénone = double ARM (antagoniste des récepteurs minéralocorticoïdes) → risque d'hyperkaliémie sévère, potentialisé par l'IEC et la MRC."},
      {"text": "Risque de gynecomastie", "correct": False, "feedback": "La gynecomastie est un effet indésirable de la spironolactone (ARM stéroïdien), non de la finerenone."},
      {"text": "Contre-indication absolue chez le patient coronarien", "correct": False, "feedback": "Non. La contre-indication est l'hyperkaliémie par double ARM, pas la coronaropathie."},
    ],
    "explanation": "La finerenone (ARM non stéroïdien) et l'éplérénone (ARM stéroïdien) bloquent tous deux les récepteurs aldostérone → association formellement contre-indiquée (hyperkaliémie majeure). Si finerenone indiquée pour la néphroprotection, elle peut remplacer l'éplérénone après discussion cardio-néphro.",
    "reference": "FIDELIO-DKD, FIGARO-DKD — Bakris GL, NEJM 2020",
  },

  {
    "id": "DIAB-OR-006",
    "level": "or",
    "domain": "diagnostic",
    "question": "Pour distinguer un pied de Charcot aigu d'une ostéomyélite à l'IRM, quels éléments orientent vers le Charcot plutôt que l'ostéomyélite ?",
    "type": "msq",
    "answers": [
      {"text": "Atteinte péri-articulaire diffuse (oedème des surfaces articulaires multiples)", "correct": True, "feedback": "Exact. Le Charcot touche les articulations, l'ostéomyélite touche l'os en regard de l'ulcère."},
      {"text": "Absence de trajet fistuleux connectant l'ulcère à l'os", "correct": True, "feedback": "Exact. Un trajet fistuleux visible à l'IRM (STIR, gadolinium) est très évocateur d'ostéomyélite."},
      {"text": "Rehaussement au gadolinium limité à un seul os", "correct": False, "feedback": "Non. Un rehaussement focal sur un seul os en regard de l'ulcère oriente plutôt vers l'ostéomyélite."},
      {"text": "Fragmentation et subluxation articulaire (déformation architecturale)", "correct": True, "feedback": "Exact. La fragmentation et subluxation caractérisent le Charcot (destruction mécanique progressive)."},
    ],
    "explanation": "Charcot IRM : oedème péri-articulaire diffus, fragmentation osseuse, subluxation, pas de trajet fistuleux. Ostéomyélite IRM : oedème médullaire focal (T1 hyposignal, STIR hypersignal) sur l'os en regard de l'ulcère, rehaussement gadolinium, trajet fistuleux possible. Les 2 coexistent fréquemment.",
    "reference": "IWGDF 2023 — Osteomyelitis Diagnosis",
  },

  {
    "id": "DIAB-OR-007",
    "level": "or",
    "domain": "traitement",
    "question": "Le schéma d'insulinothérapie du diabète gestationnel en cas d'échec des mesures hygiénodiétetiques est :",
    "type": "mcq",
    "answers": [
      {"text": "Metformine 500 mg × 2/jour en première intention", "correct": False, "feedback": "La metformine traverse le placenta. Non recommandée en France comme traitement de 1ère intention du DG (débat international)."},
      {"text": "Insuline rapide avant chaque repas (bolus prandial) ± insuline basale selon le profil", "correct": True, "feedback": "Exact. DG : si les objectifs glycémiques ne sont pas atteints à J5-7 des MHD → insuline. Bolus prandial si hyperglycémie post-prandiale, basale si hyperglycémie à jeun."},
      {"text": "Sulfamide (gliclazide) à faible dose", "correct": False, "feedback": "Les sulfamides sont contre-indiqués pendant la grossesse (passage transplacentaire → hypoglycémie néonatale)."},
      {"text": "GLP-1 RA (sémaglutide) faible dose", "correct": False, "feedback": "Les GLP-1 RA sont contre-indiqués pendant la grossesse (données de sécurité insuffisantes)."},
    ],
    "explanation": "DG : objectifs glycémiques ADA 2024 = GAJ < 0,95 g/L, GPP 1h < 1,40 g/L, GPP 2h < 1,20 g/L. Si non atteints après 5-7 jours de MHD → insuline. Séquence : 1. bolus avant le repas qui dépasse le seuil, 2. ajout d'une basale si GAJ > 0,95 persistante.",
    "reference": "ADA 2024 — Gestational Diabetes",
  },

  {
    "id": "DIAB-OR-008",
    "level": "or",
    "domain": "traitement",
    "question": "Lors du relais insuline IVSE → insuline sous-cutanée en fin d'ACD, quel est le risque si on arrête l'IVSE sans délai après la 1ère injection SC ?",
    "type": "mcq",
    "answers": [
      {"text": "Hypoglycémie sévère par double dosage", "correct": False, "feedback": "Possible mais ce n'est pas le risque principal."},
      {"text": "Rebond cétonique et récidive de l'ACD par absence d'insulinémie résiduelle", "correct": True, "feedback": "Exact. L'insuline basale SC (dégludec, glargine) a un délai d'action de 2-4h. Si l'IVSE est arrêtée sans chevauchement, la fenêtre sans insuline permet un rebond de la cétogenèse."},
      {"text": "Insuffisance rénale aiguë par précipitation des corps cétoniques", "correct": False, "feedback": "Non. Ce n'est pas un mécanisme reconnu."},
      {"text": "Arythmie par hypokaliémie de rebond", "correct": False, "feedback": "Non. Le K+ est surveillé et supplémenté pendant l'IVSE."},
    ],
    "explanation": "Relais IVSE → SC : la 1ère injection d'insuline basale SC doit être faite 2 heures AVANT l'arrêt de l'IVSE. Ce chevauchement (overlap) assure une insulinémie continue et évite le rebond de la cétogenèse pendant le délai d'absorption SC.",
    "reference": "ADA 2024 — Transition from IV to SC Insulin",
  },

  {
    "id": "DIAB-OR-009",
    "level": "or",
    "domain": "complications",
    "question": "En prévention de la pré-éclampsie chez une diabétique pré-gestationnelle, l'aspirine est recommandée à partir de quel terme et jusqu'à quand ?",
    "type": "mcq",
    "answers": [
      {"text": "Dès la conception jusqu'au terme", "correct": False, "feedback": "Non. L'aspirine n'est pas recommandée au T1 (avant 12 SA)."},
      {"text": "12 SA jusqu'à 36 SA", "correct": True, "feedback": "Exact. Aspirine 100-150 mg/jour de 12 SA à 36 SA pour la prévention de la pré-éclampsie chez la diabétique pré-gestationnelle (recommandation universelle)."},
      {"text": "20 SA jusqu'au terme", "correct": False, "feedback": "Trop tardif pour une prévention optimale (la pré-éclampsie précoce se développe avant 20 SA)."},
      {"text": "Uniquement si HTA gravidique confirmée", "correct": False, "feedback": "Non. L'aspirine est recommandée en prévention (avant que la pré-éclampsie ne se développe)."},
    ],
    "explanation": "Prévention de la pré-éclampsie : aspirine 100-150 mg/jour à partir de 12 SA jusqu'à 36 SA chez toute diabétique pré-gestationnelle (haut risque). Mécanisme : inhibition de la synthèse du thromboxane A2 (vasoconstricteur placentaire).",
    "reference": "CNGOF 2023 — Pré-éclampsie prévention",
  },

  {
    "id": "DIAB-OR-010",
    "level": "or",
    "domain": "traitement",
    "question": "Le tirzepatide se distingue du sémaglutide par :",
    "type": "mcq",
    "answers": [
      {"text": "Une action uniquement sur le récepteur GLP-1", "correct": False, "feedback": "Non. Le tirzepatide est un double agoniste GIP/GLP-1 (twincretin). Le sémaglutide est uniquement GLP-1 RA."},
      {"text": "Un double agonisme GIP/GLP-1 avec perte de poids supérieure (-13 à -22 kg dans SURPASS)", "correct": True, "feedback": "Exact. Le tirzepatide active à la fois GIP-R et GLP-1-R → effet synergique sur l'insulinosécrétion et l'appétit → perte de poids supérieure au sémaglutide."},
      {"text": "Une administration quotidienne (vs hebdomadaire pour le sémaglutide)", "correct": False, "feedback": "Non. Le tirzepatide est aussi hebdomadaire SC (Mounjaro)."},
      {"text": "Une absence d'indication dans le DT2", "correct": False, "feedback": "Non. Le tirzepatide est indiqué dans le DT2 (AMM européenne 2023) et l'obésité (SURMOUNT)."},
    ],
    "explanation": "Tirzepatide (Mounjaro) : double agoniste GIP/GLP-1. Dans SURPASS-2 vs sémaglutide 1 mg : réduction HbA1c -2,4% (vs -2,0%) et poids -9,5 kg (vs -6,0 kg). Classe la plus efficace actuellement sur la perte de poids.",
    "reference": "Frías JP et al., SURPASS-2, NEJM 2021",
  },

  {
    "id": "DIAB-OR-011",
    "level": "or",
    "domain": "cas_cliniques",
    "question": "Dans le cas n°16 (pied de Charcot + ostéomyélite), le prélèvement bactériologique recommandé est :",
    "type": "mcq",
    "answers": [
      {"text": "Écouvillonnage de la plaie en surface", "correct": False, "feedback": "L'écouvillon superficiel a une fiabilité médiocre (contamination par la flore cutanée saprophyte)."},
      {"text": "Hémocultures uniquement", "correct": False, "feedback": "Les hémocultures sont souvent négatives dans l'ostéomyélite du pied (infection locorégionale chronique)."},
      {"text": "Prélèvement profond per-opératoire (biopsie osseuse et tissus profonds)", "correct": True, "feedback": "Exact. Le prélèvement profond per-opératoire (biopsie osseuse + tissus profonds) est le gold standard bactériologique. Il doit être fait AVANT l'antibiothérapie ou après 14 jours d'arrêt."},
      {"text": "ECBU (examen cytobactériologique urinaire)", "correct": False, "feedback": "L'ECBU n'est pas indiqué pour le diagnostic de l'ostéomyélite du pied."},
    ],
    "explanation": "Prélèvements bactériologiques dans l'ostéomyélite du pied : biopsie osseuse + prélèvements de tissus profonds per-opératoires = gold standard. Idéalement réalisés avant l'antibiothérapie. L'écouvillon superficiel est insuffisant (guideline IWGDF 2023).",
    "reference": "IWGDF 2023 — Infection Guidelines",
  },

  {
    "id": "DIAB-OR-012",
    "level": "or",
    "domain": "traitement",
    "question": "L'insuline URLi (Lispro ultra-rapide, Lyumjev) se distingue de l'insuline Lispro classique (Humalog) par :",
    "type": "mcq",
    "answers": [
      {"text": "Un début d'action en 2-3 minutes (vs 10-15 min pour Humalog)", "correct": True, "feedback": "Exact. L'URLi contient de l'acide citrique et du treprostinil sodique qui accélèrent l'absorption sous-cutanée → début d'action 2-3 min, pic en 15-20 min."},
      {"text": "Une durée d'action prolongée sur 24h (analogue basal)", "correct": False, "feedback": "Non. L'URLi est un analogue ultra-rapide, pas basal. Sa durée d'action est d'environ 3-4h."},
      {"text": "Un profil post-prandial amélioré avec réduction du pic TAR", "correct": True, "feedback": "Exact. La rapidité d'action améliore le profil post-prandial → réduction du TAR, meilleur TIR."},
      {"text": "Une voie d'administration uniquement IV (pas SC)", "correct": False, "feedback": "Non. L'URLi est administrée SC (ou IV en milieu hospitalier comme Lispro classique)."},
    ],
    "explanation": "Insulines ultra-rapides disponibles : Fiasp (Aspart ultra-rapide, Novo Nordisk) et Lyumjev/URLi (Lispro ultra-rapide, Lilly). Avantages vs analogues rapides classiques : meilleur contrôle post-prandial, possibilité d'injection au moment du repas voire après. Particulièrement utiles en boucle fermée.",
    "reference": "Russell-Jones D et al., Diabetes Care 2020",
  },

]  # fin questions_or


questions_diamant = [

  # ── DIAMANT — Expertise / cas complexes ─────────────────────────────────

  {
    "id": "DIAB-DI-001",
    "level": "diamant",
    "domain": "traitement",
    "question": "Pourquoi l'HbA1c est-elle artificiellement basse en insuffisance rénale terminale (IRT) et quel marqueur utiliser en remplacement ?",
    "type": "msq",
    "answers": [
      {"text": "Hémolyse (réduction de la durée de vie des GR en IRT) → moins de temps de glycation de l'hémoglobine", "correct": True, "feedback": "Exact. En IRT, la demi-vie des GR est réduite à 40-60 jours (vs 120 jours) → HbA1c sous-estimée."},
      {"text": "Utiliser la fructosamine ou le glyco-albumine (albumine glyquée)", "correct": True, "feedback": "Exact. La fructosamine reflète la glycémie des 2-3 dernières semaines. Le glyco-albumine (GA) reflète les 2-3 dernières semaines et n'est pas affecté par l'hémolyse."},
      {"text": "Carbamylation de l'hémoglobine en IRT qui fausse le dosage HPLC", "correct": True, "feedback": "Exact. L'urémie provoque la carbamylation (réaction avec l'urée) de l'hémoglobine → certaines méthodes de dosage HPLC surestiment ou sous-estiment l'HbA1c."},
      {"text": "L'HbA1c est normalement surestimée en IRT (jamais sous-estimée)", "correct": False, "feedback": "Non. L'HbA1c est artificiellement BASSE en IRT (hémolyse + carbamylation), pas haute."},
    ],
    "explanation": "En IRT : HbA1c non fiable (faussement basse par hémolyse et carbamylation). Alternatives : fructosamine (reflet 2-3 semaines, affecté par l'hypoalbuminurie), albumine glyquée/GA (le meilleur choix en IRT). Cible HbA1c relâchée en IRT : 7,5-8,5% (éviter hypoglycémie).",
    "reference": "Freedman BI et al., Kidney Int 2010",
  },

  {
    "id": "DIAB-DI-002",
    "level": "diamant",
    "domain": "traitement",
    "question": "Chez M. Karim (DT1, IRC terminale, dialyse péritonéale envisagée), quels sont les avantages spécifiques de la DP versus l'hémodialyse ?",
    "type": "msq",
    "answers": [
      {"text": "Évite l'instabilité hémodynamique per-dialytique (bénéfique en cas de neuropathie autonome + IC)", "correct": True, "feedback": "Exact. La DP est plus douce hémodynamiquement que l'HD (extraction progressive du volume vs bolus)."},
      {"text": "Préservation plus longue de la fonction rénale résiduelle", "correct": True, "feedback": "Exact. La DP préserve mieux la FRR à long terme que l'HD."},
      {"text": "Pas de risque d'hypoglycémie per-dialytique", "correct": False, "feedback": "Non. La DP apporte 100-200 g de glucose/jour (via le dialysat glucosé) → risque d'hyperglycémie post-DP, et potentiellement d'hypoglycémie si les doses d'insuline ne sont pas ajustées."},
      {"text": "Réalisable à domicile avec systèmes automatisés (APD nocturne)", "correct": True, "feedback": "Exact. La DP automatisée (APD) est particulièrement utile chez M. Karim (aveugle) avec aide infirmière à domicile."},
    ],
    "explanation": "Dialyse péritonéale avantages vs HD pour le DT1 compliqué : hémodynamique stable (pas d'hypotension per-dialytique), FRR préservée plus longtemps, possibilité d'APD à domicile. Inconvénient : absorption du glucose du dialysat → hyperglycémie, prise de poids, majoration des besoins insuliniques.",
    "reference": "Kidney International Supplements 2022",
  },

  {
    "id": "DIAB-DI-003",
    "level": "diamant",
    "domain": "physiopathologie",
    "question": "Le score de Clarke (IAH) est positif (≥ 4) chez M. Antoine. Quel mécanisme principal explique la non-perception des hypoglycémies après 30 ans de DT1 ?",
    "type": "msq",
    "answers": [
      {"text": "Réponse adrénergique érodée : le seuil de décharge de l'adrénaline s'abaisse après des hypoglycémies répétées", "correct": True, "feedback": "Exact. Chaque hypoglycémie abaisse le seuil de perception adrénergique → spirale descendante → IAH."},
      {"text": "Adaptation cérébrale : upregulation des transporteurs GLUT1 → le cerveau consomme le glucose efficacement à des concentrations basses", "correct": True, "feedback": "Exact. Le cerveau 's'adapte' à l'hypoglycémie chronique → les symptômes neuroglycopéniques précoces disparaissent."},
      {"text": "Destruction des cellules alpha → réponse glucagonique abolie en DT1 avancé", "correct": True, "feedback": "Exact. Le glucagon est le principal contre-régulateur aigu. Son absence en DT1 avancé élimine le premier rempart contre l'hypoglycémie."},
      {"text": "Neuropathie autonome cardiaque bloquant la tachycardie adrénergique", "correct": True, "feedback": "Exact. La neuropathie autonome (fréquente après 20 ans de DT1) altère la réponse sympathique → les palpitations/tremblements sont absents."},
    ],
    "explanation": "IAH = syndrome multifactoriel : 1. Épuisement des contre-régulateurs (glucagon abolie, adrénaline érodée), 2. Adaptation cérébrale (GLUT1 upregulé), 3. Neuropathie autonome (bloque les signes adrénergiques). Réversibilité partielle : 2-3 semaines de normoglycémie stricte permettent de 'réinitialiser' le seuil.",
    "reference": "Cryer PE, Diabetes 2022 — Hypoglycemia Unawareness",
  },

  {
    "id": "DIAB-DI-004",
    "level": "diamant",
    "domain": "traitement",
    "question": "La transplantation d'îlots de Langerhans est indiquée dans le DT1 brittle. Quel en est le PRINCIPAL bénéfice attendu à 1 an selon le registre CITR ?",
    "type": "mcq",
    "answers": [
      {"text": "Indépendance insulinique complète (arrêt de l'insuline)", "correct": False, "feedback": "L'indépendance insulinique est obtenue chez 60-70% à 1 an, mais ce n'est pas le bénéfice le plus important cliniquement."},
      {"text": "Suppression des hypoglycémies sévères (90% des patients sans hypoglycémie sévère à 1 an)", "correct": True, "feedback": "Exact. Même sans indépendance insulinique complète, 90% des patients n'ont plus d'hypoglycémie sévère à 1 an. C'est le bénéfice principal qui justifie la procédure."},
      {"text": "Guérison complète de toutes les complications diabétiques", "correct": False, "feedback": "La transplantation stabilise les complications (rétinopathie) mais ne guérit pas les dommages établis."},
      {"text": "Réduction de l'immunosuppression à vie", "correct": False, "feedback": "Au contraire : la transplantation impose une immunosuppression à vie."},
    ],
    "explanation": "Registre CITR 2024 : transplantation d'îlots dans le DT1 brittle → indépendance insulinique 60-70% à 1 an (40-50% à 5 ans), mais suppression des hypoglycémies sévères dans 90% des cas à 1 an. Ce dernier résultat est le plus important cliniquement (retour au travail, permis de conduire, qualité de vie).",
    "reference": "CITR 2024 — Collaborative Islet Transplant Registry",
  },

  {
    "id": "DIAB-DI-005",
    "level": "diamant",
    "domain": "physiopathologie",
    "question": "Mme Jacqueline a eu une sleeve gastrectomie il y a 6 ans avec remission initiale du DT2, puis récidive à 4 ans. Parmi les mécanismes suivants, lesquels expliquent la récidive ?",
    "type": "msq",
    "answers": [
      {"text": "Reprise pondérale par contournement de la sleeve (grignotage de liquides caloriques)", "correct": True, "feedback": "Exact. La reprise pondérale est la cause principale de récidive (60-70% des cas)."},
      {"text": "Dilatation progressive de la poche gastrique résiduelle", "correct": True, "feedback": "Exact. La sleeve se dilate avec le temps (remodelage tissulaire), augmentant la capacité gastrique."},
      {"text": "Épuisement progressif des cellules bêta (histoire naturelle du DT2)", "correct": True, "feedback": "Exact. La chirurgie retarde l'épuisement mais ne l'arrête pas. Peptide C de Mme Jacqueline encore présent mais diminué."},
      {"text": "Ré-apparition d'anticorps anti-GAD après 5 ans (LADA révélé par la chirurgie)", "correct": False, "feedback": "Non. Les anti-GAD négatifs persistent. La récidive est liée aux mécanismes ci-dessus."},
    ],
    "explanation": "La récidive du DT2 après sleeve gastrectomie (30-50% à 5-10 ans) est multifactorielle : 1. reprise pondérale, 2. dilatation de la sleeve, 3. épuisement des cellules bêta, 4. atténuation de l'effet incrétine (pic GLP-1 post-prandial diminue avec le temps). L'évaluation doit inclure un transit baryté et le peptide C.",
    "reference": "Buchwald H et al., SOARD 2022",
  },

  {
    "id": "DIAB-DI-006",
    "level": "diamant",
    "domain": "traitement",
    "question": "La conversion sleeve gastrectomie → bypass gastrique (RYGB) après récidive du DT2 est recommandée. Quels sont les mécanismes supplémentaires du RYGB par rapport à la sleeve ?",
    "type": "msq",
    "answers": [
      {"text": "Dérivation duodéno-jéjunale (exclusion du duodénum) → modification du signal hormonal de la phase céphalique", "correct": True, "feedback": "Exact. L'exclusion du duodénum modifie la sécrétion de GIP et d'autres facteurs du 'foregut' → amélioration de l'insulinosensibilité indépendamment du poids."},
      {"text": "Malabsorption partielle (anse alimentaire court-circuitée) → moins de calories absorbées", "correct": True, "feedback": "Exact. Le RYGB est une procédure mixte (restrictive + malabsorptive légère) → déficit calorique supplémentaire."},
      {"text": "Augmentation du GLP-1 post-prandial encore plus massive qu'après sleeve seule", "correct": True, "feedback": "Exact. Le transit alimentaire accéléré vers l'iléon après RYGB produit un pic de GLP-1 encore plus important."},
      {"text": "Résection complète du pancréas exocrine pour réduire l'inflammation", "correct": False, "feedback": "Non. Le RYGB ne touche pas le pancréas."},
    ],
    "explanation": "RYGB vs sleeve : le RYGB est une procédure mixte (restrictive + malabsorptive) qui agit en plus via l'exclusion duodénale ('foregut hypothesis'), l'augmentation massive du GLP-1 et la modification des acides biliaires. Taux de remission du DT2 : sleeve ~50% à 5 ans, RYGB ~65-70% à 5 ans.",
    "reference": "Rubino F et al., Lancet 2022 — RYGB mechanisms",
  },

  {
    "id": "DIAB-DI-007",
    "level": "diamant",
    "domain": "traitement",
    "question": "La boucle fermée totale (TLC) se distingue de la boucle fermée hybride (AID) par :",
    "type": "mcq",
    "answers": [
      {"text": "L'automatisation complète des bolus prandiaux sans annonce des repas par le patient", "correct": True, "feedback": "Exact. En boucle fermée hybride, le patient doit annoncer les repas et saisir les glucides pour que la pompe génère un bolus. La TLC supprime cette contrainte → idéale pour l'IAH."},
      {"text": "L'utilisation d'une insuline à action prolongée (dégludec) au lieu d'une insuline rapide", "correct": False, "feedback": "Non. Les systèmes de boucle fermée (hybride ou totale) utilisent des insulines rapides ou ultra-rapides en continu (pas d'analogue lent)."},
      {"text": "Une administration combinée d'insuline ET de glucagon (boucle bihormonale)", "correct": False, "feedback": "La boucle bihormonale est un concept différent (insuline + glucagon). La TLC est monohormonale mais automatise les bolus prandiaux."},
      {"text": "Une précision inférieure à l'AID hybride car sans annonce des repas", "correct": False, "feedback": "Non. Les algorithmes TLC montrent des TIR équivalents ou supérieurs à la boucle hybride dans les essais."},
    ],
    "explanation": "Boucle fermée totale (TLC) : automatise AUSSI le bolus prandial (pas d'annonce repas). Les essais (iLet Bionic Pancreas, CLOSE-AP) montrent un TIR > 78% sans saisie de glucides. Particulièrement adaptée au DT1 brittle avec IAH (M. Antoine, cas n°20).",
    "reference": "Russell SJ et al., iLet Bionic Pancreas, NEJM 2022",
  },

  {
    "id": "DIAB-DI-008",
    "level": "diamant",
    "domain": "complications",
    "question": "La complication neurologique post-bariatrique la plus grave et potentiellement fatale est :",
    "type": "mcq",
    "answers": [
      {"text": "La polyneuropathie sensitivo-motrice distal par carence en B12", "correct": False, "feedback": "Grave mais rarement fatale avec traitement."},
      {"text": "L'encéphalopathie de Wernicke par carence en thiamine (B1)", "correct": True, "feedback": "Exact. Triade : confusion + troubles oculomoteurs + ataxie cérébelleuse. Fatale ou séquellaire si non traitée. Le glucose IV sans thiamine préalable est fatal (pousse la carence à l'extrême)."},
      {"text": "Le syndrome de dumping tardif (hypoglycémie réactionnelle)", "correct": False, "feedback": "Symptomatique mais non fatale en général."},
      {"text": "La méralgie paresthésique (compression du nerf cutané fémoral latéral)", "correct": False, "feedback": "Complication bénigne liée à la perte de poids rapide."},
    ],
    "explanation": "Wernicke post-bariatrique : urgence neurologique. Traitement : thiamine IV 500 mg × 3/jour × 3-5 jours en urgence. NE JAMAIS administrer du glucose IV sans thiamine chez un patient dénutri (Wernicke précipité). Prévention : supplémenter systématiquement en thiamine après chirurgie bariatrique.",
    "reference": "Becker DA et al., Neurology Clinical Practice 2018",
  },

  {
    "id": "DIAB-DI-009",
    "level": "diamant",
    "domain": "cas_cliniques",
    "question": "M. Antoine (DT1 brittle, IAH sévère) a son permis de conduire suspendu. Quel TBR (< 54 mg/dL) doit-il atteindre pour envisager la reprise de la conduite selon les recommandations européennes ?",
    "type": "mcq",
    "answers": [
      {"text": "TBR < 54 mg/dL < 5%", "correct": False, "feedback": "Non. Ce seuil est la cible générale, insuffisant pour autoriser la conduite en cas d'IAH."},
      {"text": "TBR < 54 mg/dL < 1% ET absence d'hypoglycémie sévère depuis ≥ 3 mois", "correct": True, "feedback": "Exact. Recommandations européennes (EASD/ESC 2023 et directive européenne) : TBR < 54 < 1% ET pas d'hypoglycémie sévère sur 3 mois → reprise possible avec CGM obligatoire et arrêt si glycémie < 0,70 avant de démarrer."},
      {"text": "HbA1c < 7% pendant 6 mois consécutifs", "correct": False, "feedback": "L'HbA1c n'est pas le critère retenu pour la conduite en DT1 brittle."},
      {"text": "Transplantation d'îlots réussie (indépendance insulinique prouvée)", "correct": False, "feedback": "La reprise de conduite n'est pas conditionnée à la transplantation."},
    ],
    "explanation": "Conduite automobile et DT1 : recommandations EU 2023 : CGM continu obligatoire, glycémie > 0,90 g/L avant de démarrer, arrêt si alerte < 0,70. Pour M. Antoine (IAH + antécédents d'accident) : réhabilitation glycémique à démontrer (TBR < 1% à 3 mois) avant toute demande de levée de suspension.",
    "reference": "EASD/ESC 2023 — Driving Recommendations in Diabetes",
  },

  {
    "id": "DIAB-DI-010",
    "level": "diamant",
    "domain": "traitement",
    "question": "Dans la transplantation simultanée pancréas-rein (SPK) pour le DT1 + IRT, quel bénéfice la greffe de pancréas apporte-t-elle par rapport à une transplantation rénale isolée ?",
    "type": "msq",
    "answers": [
      {"text": "Guérison définitive du DT1 → normoglycémie sans insuline → arrêt de la destruction du greffon rénal par la néphropathie diabétique", "correct": True, "feedback": "Exact. La greffe de pancréas supprime le diabète → le rein greffé n'est plus soumis à la néphropathie diabétique."},
      {"text": "Meilleure survie du patient à 5 ans vs transplantation rénale isolée en DT1", "correct": True, "feedback": "Exact. Les registres internationaux montrent une meilleure survie à 5-10 ans en SPK vs rein seul chez le DT1 (réduction des événements CV)."},
      {"text": "Amélioration de la neuropathie et de la rétinopathie existantes", "correct": True, "feedback": "Exact. La normoglycémie prolongée post-SPK stabilise voire améliore partiellement la neuropathie (régénérescence axonale) et stabilise la rétinopathie."},
      {"text": "Absence totale d'immunosuppression après SPK (tolérance immune)", "correct": False, "feedback": "Non. L'immunosuppression (tacrolimus + MMF) est maintenue à vie pour les deux greffons."},
    ],
    "explanation": "SPK (Simultaneous Pancreas-Kidney) : meilleure option pour DT1 + IRT selon les recommandations EASD/ERA 2024. Bénéfices vs rein isolé : guérison DT1, protection du greffon rénal, survie supérieure, amélioration neuropathie/rétinopathie. Contre-indications : FEVG < 35%, coronaropathie non revascularisable, IMC > 30.",
    "reference": "Gruessner RWG et al., NEJM 2016 — Pancreas Transplantation",
  },

  {
    "id": "DIAB-DI-011",
    "level": "diamant",
    "domain": "physiopathologie",
    "question": "Le 'late dumping syndrome' après sleeve gastrectomie est souvent confondu avec une hypoglycémie diabétique. Quelle caractéristique permet de les distinguer ?",
    "type": "mcq",
    "answers": [
      {"text": "Le late dumping survient 1-3h APRES le repas (pic insulinique décalé) ; l'hypoglycémie diabétique peut survenir à jeun ou à distance des repas", "correct": True, "feedback": "Exact. Late dumping = hypoglycémie post-prandiale réactionnelle tardive (1-3h post-repas) due au pic d'insuline décalé après transit rapide. L'hypoglycémie diabétique peut être à jeun."},
      {"text": "Le late dumping est associé à une glycémie > 3,00 g/L en phase initiale (hyperglycémie biphasique)", "correct": False, "feedback": "Non. Le late dumping n'est pas biphasique. Il y a un pic hyperglycémique précoce puis hypoglycémie tardive."},
      {"text": "Le late dumping ne répond pas au resucrage oral", "correct": False, "feedback": "Si. Le resucrage oral (glucose rapide) corrige le late dumping comme une hypoglycémie classique."},
      {"text": "Le late dumping survient uniquement chez les patients DT1, pas DT2", "correct": False, "feedback": "Non. Le late dumping est une complication de la chirurgie bariatrique, indépendante du type de diabète."},
    ],
    "explanation": "Late dumping : hyper-insulinisme réactionnel post-prandial (pic de GLP-1 → sécrétion exagérée d'insuline). Diagnostic : HGPO 75g avec glycémies horaires → nadir hypoglycémique à H2-H3. Traitement : fractionnement des repas, éviction des sucres rapides, acarbose (retarde l'absorption glucidique).",
    "reference": "Tack J et al., Gut 2020",
  },

  {
    "id": "DIAB-DI-012",
    "level": "diamant",
    "domain": "traitement",
    "question": "Dans le cadre de la loi Leonetti-Claeys, qu'est-ce que la 'personne de confiance' pour un patient diabétique en stade terminal (cas n°18) ?",
    "type": "mcq",
    "answers": [
      {"text": "Le médecin référent (diabétologue ou néphrologue) désigné par le patient", "correct": False, "feedback": "Non. La personne de confiance est un proche (non médecin en principe) désigné librement par le patient."},
      {"text": "La personne que le patient désigne pour le représenter et être consultée en cas d'incapacité à s'exprimer", "correct": True, "feedback": "Exact. La personne de confiance (loi du 02/02/2016) peut être un parent, un ami ou toute personne choisie. Elle est consultée quand le patient ne peut exprimer sa volonté."},
      {"text": "Le tuteur légal désigné par le juge des tutelles", "correct": False, "feedback": "Non. La tutelle est un dispositif juridique distinct de la personne de confiance médicale."},
      {"text": "Le patient lui-même, qui signe un formulaire de consentement", "correct": False, "feedback": "Non. Le consentement et la personne de confiance sont deux notions distinctes."},
    ],
    "explanation": "Loi Leonetti-Claeys (2016) : droits du patient en fin de vie. Directives anticipées : document écrit exprimant les souhaits du patient sur sa fin de vie (révocables à tout moment). Personne de confiance : représentant du patient si celui-ci ne peut s'exprimer. Ces deux outils sont centraux dans la prise en charge de M. Karim.",
    "reference": "Loi n°2016-87 du 2 février 2016 — Leonetti-Claeys",
  },

]  # fin questions_diamant


questions = questions_or + questions_diamant
