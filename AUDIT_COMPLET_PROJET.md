# AUDIT COMPLET — Formation Scoliose avec VERTEX©
## Rapport structuré en 10 dimensions

*Date : Février 2026 — Version 1.0*
*Perspective : Chirurgien orthopédiste enseignant la scoliose + Architecte logiciel EdTech*

---

## SYNTHÈSE EXÉCUTIVE

L'analyse exhaustive des 9 documents du projet (2 525 + 1 890 + 998 + 356 + 309 + 274 + 260 + 250 + 233 = **7 095 lignes**) révèle un projet ambitieux et remarquablement détaillé sur le plan médical et technique. Néanmoins, **47 constatations** sont identifiées, dont **7 critiques**, **15 hautes**, **16 moyennes** et **9 basses**.

| Catégorie | CRITICAL | HIGH | MEDIUM | LOW | Total |
|-----------|:--------:|:----:|:------:|:---:|:-----:|
| INCONSISTENCY | 3 | 3 | 2 | 1 | 9 |
| MISSING | 2 | 6 | 5 | 3 | 16 |
| INSUFFICIENT | 2 | 4 | 5 | 2 | 13 |
| SUGGESTION | 0 | 2 | 4 | 3 | 9 |
| **Total** | **7** | **15** | **16** | **9** | **47** |

---

## 1. LACUNES DE CONTENU MÉDICAL

### 1.1
| Champ | Valeur |
|-------|--------|
| **ID** | CONT-01 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | HIGH |
| **Description** | Les Modules 21 (Rééducation), 22 (Psychologie) et 24 (Dépistage) sont rédigés sous forme de listes de titres (bullet points) sans aucun contenu développé, contrairement aux Modules 15-20 et 28 qui contiennent des explications détaillées, des protocoles chiffrés et du contenu clinique structuré. L'écart de profondeur est de ~500 lignes (Module 20) vs ~30 lignes (Module 21). |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Modules 21 (§21.1-21.5), 22 (§22.1-22.4), 24 (§24.1-24.2) |
| **Solution proposée** | Développer le contenu au même niveau de détail que les modules chirurgicaux. Pour le Module 21 : protocoles de kinésithérapie jour par jour (J1→J90), critères de reprise sportive chiffrés, calendrier de suivi avec paramètres mesurés. Pour le Module 22 : échelles psychométriques (PHQ-9, GAD-7, BDI), protocoles d'évaluation psychologique standardisés, techniques d'entretien motivationnel. Pour le Module 24 : algorithme décisionnel de dépistage avec seuils, organisation d'une campagne-type, formulaires. |

### 1.2
| Champ | Valeur |
|-------|--------|
| **ID** | CONT-02 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | Aucun contenu explicite sur la déformation cervicothoracique (jonction cervicothoracique), pourtant fréquente dans les scolioses neuromusculaires et la neurofibromatose (NF1 mentionnée au Module 13 mais la correction CT n'est pas détaillée techniquement). |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Modules 13, 15 |
| **Solution proposée** | Ajouter une section 15.6bis « Instrumentation cervicothoracique » couvrant : points d'entrée de vis latéral mass C3-C6, vis pédiculaires C2/C7/T1, fixation occipitocervicale, stratégies de correction et risques (artère vertébrale). |

### 1.3
| Champ | Valeur |
|-------|--------|
| **ID** | CONT-03 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | Aucune mention des techniques de chirurgie mini-invasive (MIS) pour la scoliose adulte, hormis une référence à ApiFix dans les innovations (Module 25). Les techniques de LIF/OLIF percutané + fixation percutanée postérieure, de plus en plus utilisées en scoliose dégénérative, sont absentes. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Module 10 (adulte), Module 15 (techniques) |
| **Solution proposée** | Ajouter une section dédiée à la chirurgie MIS (mini-open, percutanée) dans le Module 15 ou 10, incluant : indication (courbes flexibles <40°, scoliose dégénérative), techniques (XLIF/OLIF staging + PPS), avantages/limites, courbe d'apprentissage, résultats comparés. |

### 1.4
| Champ | Valeur |
|-------|--------|
| **ID** | CONT-04 |
| **Catégorie** | MISSING |
| **Priorité** | LOW |
| **Description** | Pas de contenu spécifique sur la scoliose dans les pays à ressources limitées (LMIC) : techniques de Luque/SSI, chirurgie sans IONM, corsets low-cost. Pourtant, le marché cible inclut des pays arabophones (i18n en AR mentionné dans le LMS). |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — aucun module dédié |
| **Solution proposée** | Ajouter un sous-module dans la Partie VIII « Scoliose en contexte de ressources limitées » couvrant l'instrumentation SSI, la chirurgie sans navigation, les références OMS/WHO, les partenariats (SIGN, AO Alliance). |

### 1.5
| Champ | Valeur |
|-------|--------|
| **ID** | CONT-05 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | MEDIUM |
| **Description** | Le contenu sur le Vertebral Body Tethering (VBT) est dispersé (Module 8 mention, Module 25 résultats, Module 28 simulation) mais ne fait pas l'objet d'une section technique structurée avec indications précises, technique complète, résultats, complications spécifiques (overcorrection, rupture du tether) et suivi radiologique. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Modules 8, 25, 28 |
| **Solution proposée** | Consolider tout le contenu VBT dans une section dédiée du Module 8 (§8.11 ou sous-module), avec un renvoi croisé strict depuis les Modules 25 et 28. Inclure : critères de Sanders, indications Lenke/Cobb/flexibilité, technique opératoire vidéo, résultats à 2-5 ans (Samdani 2021), gestion de l'overcorrection. |

### 1.6
| Champ | Valeur |
|-------|--------|
| **ID** | CONT-06 |
| **Catégorie** | MISSING |
| **Priorité** | LOW |
| **Description** | Aucun contenu explicite sur les objectifs d'apprentissage (ILO — Intended Learning Outcomes) par module. Les « Objectifs pédagogiques » ne sont pas formulés selon la taxonomie de Bloom (« l'apprenant sera capable de... »). |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — tous les modules |
| **Solution proposée** | Ajouter en début de chaque module une section « Objectifs d'apprentissage » avec 3-5 ILOs formulés selon Bloom (savoir, comprendre, appliquer, analyser, évaluer, créer). Mapper ces ILOs aux questions de quiz et aux compétences VERTEX. |

---

## 2. LACUNES MÉDIAS

### 2.1
| Champ | Valeur |
|-------|--------|
| **ID** | MED-01 |
| **Catégorie** | MISSING |
| **Priorité** | HIGH |
| **Description** | Le Module 20 a été considérablement enrichi (~500 lignes : IONM détaillé avec D-waves, protocoles d'analgésie multimodale, gestion transfusionnelle, préparation du malade jour-J, nutrition/santé osseuse) mais le catalogue médias (MEDIAS_PRODUCTION_SCOLIOSE.md) ne semble pas avoir été mis à jour en proportion. Aucun média spécifique n'est répertorié pour : D-waves (animations), ESP block (schéma échoguidé), algorithme transfusionnel TEG/ROTEM, protocole ERAS, préhabilitation. |
| **Localisation** | `MEDIAS_PRODUCTION_SCOLIOSE.md` — section M20 |
| **Solution proposée** | Ajouter au catalogue médias : animation D-wave (signal normal→perte partielle→perte complète), schéma ESP block échoguidé, infographie algorithme transfusionnel, infographie protocole ERAS rachis, vidéo préparation jour-J (checklist OMS), schéma nutrition/vitamine D. Estimation : +12-15 médias. |

### 2.2
| Champ | Valeur |
|-------|--------|
| **ID** | MED-02 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | MEDIUM |
| **Description** | Très peu de médias dédiés aux Modules 21-23 (rééducation, psychologie, impacts respiratoires). Ces modules étant moins développés (voir CONT-01), les médias sont également clairsemés. Pour une formation en ligne, le Module 21 (rééducation) nécessite des vidéos de démonstration d'exercices. |
| **Localisation** | `MEDIAS_PRODUCTION_SCOLIOSE.md` — sections M21-M23 |
| **Solution proposée** | Produire : vidéos d'exercices de kinésithérapie postopératoire (J1, J7, J30, J90), animation spirométrie/EFR interprétation, infographies des scores (SRS-22, ODI), vidéo de consultation psychologique type. Estimation : +15-20 médias. |

### 2.3
| Champ | Valeur |
|-------|--------|
| **ID** | MED-03 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | Aucune vidéo d'examen clinique du rachis complète n'est listée dans le catalogue médias. Le Module 6 (Examen clinique) décrit en détail les techniques (test d'Adams, scoliomètre, mesure de la gibbosité, signes de Marfan, réflexes cutanés abdominaux) mais aucune vidéo de démonstration de la séquence d'examen n'est cataloguée. |
| **Localisation** | `MEDIAS_PRODUCTION_SCOLIOSE.md` — section M06 |
| **Solution proposée** | Produire une vidéo complète d'examen clinique du rachis (15-20 min) avec un patient standardisé, couvrant l'inspection, le test d'Adams, la mesure au scoliomètre, l'examen neurologique, les signes d'alerte. Ajouter des clip-segments séparés par geste pour réutilisation dans les quiz. |

### 2.4
| Champ | Valeur |
|-------|--------|
| **ID** | MED-04 |
| **Catégorie** | SUGGESTION |
| **Priorité** | LOW |
| **Description** | Pas de médias liés à la télémédecine (Module 21.5) ni aux applications mobiles de suivi de scoliose. Ce contenu nouveau (ajouté post-v1) n'a pas de support visuel. |
| **Localisation** | `MEDIAS_PRODUCTION_SCOLIOSE.md` — pas de section dédiée |
| **Solution proposée** | Ajouter des captures d'écran annotées d'applications de suivi (Bunnell connecté, apps posture), une vidéo de démonstration de téléconsultation, une infographie des cadres réglementaires. |

---

## 3. LACUNES TECHNIQUES VERTEX

### 3.1
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-01 |
| **Catégorie** | MISSING |
| **Priorité** | CRITICAL |
| **Description** | Aucune mention de la réglementation des dispositifs médicaux (FDA 510(k), marquage CE MDR 2017/745, classification logiciel dispositif médical — SaMD). VERTEX modélise des anatomies patient-spécifiques (import DICOM), calcule des contraintes biomécaniques et produit des « prédictions » (PJK, probabilité de révision). Selon la FDA et l'UE, un logiciel qui analyse des données patient pour aider à la décision clinique est un SaMD de Classe IIa minimum. Ignorer cette contrainte expose à un risque juridique majeur et potentiellement à l'interdiction de commercialisation. |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — aucune section réglementaire SaMD |
| **Solution proposée** | 1) Ajouter une section « 21. Réglementation SaMD » couvrant la classification FDA/CE, la voie réglementaire 510(k)/De Novo, le marquage CE MDR, le QMS (ISO 13485), les normes IEC 62304 (cycle logiciel), IEC 82304 (produit santé), et ISO 14971 (gestion des risques). 2) Alternative : positionner VERTEX explicitement comme outil pédagogique NON destiné à la planification chirurgicale réelle (disclaimer « for educational purposes only »), ce qui réduirait les exigences mais limiterait la proposition de valeur. 3) Budgéter €100-300K pour le processus réglementaire dans le budget global. |

### 3.2
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-02 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | HIGH |
| **Description** | La dépendance exclusive à CUDA.jl pour l'accélération GPU côté serveur impose des GPU NVIDIA. Aucune stratégie pour le support AMD (ROCm/AMDGPU.jl) ou Intel (oneAPI). Côté client, le pré-requis « NVIDIA GTX 1060+ » exclut : tous les Mac Apple Silicon (M1/M2/M3), les Chromebooks, les PC portables sans GPU discret (~60% du marché laptop), et les appareils institutionnels (hôpitaux) souvent équipés de GPU intégrés. |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §5 (GPU), `PLAN_FORMATION_SCOLIOSE.md` — Ressources techniques requises |
| **Solution proposée** | 1) Serveur : spécifier une abstraction GPU via KernelAbstractions.jl (déjà listé comme dépendance) qui supporte CUDA, ROCm et Metal. 2) Client : clarifier que le GPU dédié est requis uniquement pour le mode desktop haute-fidélité, et que le mode navigateur WebGL fonctionne sur GPU intégré (Intel HD 620+, Apple M1+). 3) Ajouter un test de compatibilité automatique au lancement (WebGL capabilities check). 4) Considérer WebGPU comme successeur de WebGL à moyen terme. |

### 3.3
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-03 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | HIGH |
| **Description** | Les spécifications de charge concurrent pour le solveur FEM sont absentes. Les tests de performance mentionnent 500 utilisateurs simultanés pour « la plateforme web » mais pas pour les sessions de simulation biomécanique (qui consomment GPU/CPU serveur-side significatifs). Un seul solveur FEM en Julia avec CUDA peut servir combien de simulations simultanées ? Quel est le temps de réponse sous charge ? Le coût GPU serveur par session ? |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §15 (Tests de performance), §10 (Déploiement) |
| **Solution proposée** | 1) Définir un objectif de sessions FEM simultanées (ex. 50-100) avec un budget hardware associé. 2) Spécifier l'architecture de queuing/load balancing pour les jobs FEM (ex. Celery/Redis queue avec pool de workers GPU). 3) Estimer le coût cloud GPU par session (ex. A100 à ~$3/h, si une session = 10 min GPU → €0.50/session). 4) Inclure dans les tests de performance un benchmark de solver concurrency. |

### 3.4
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-04 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | Aucune mention de HIPAA (Health Insurance Portability and Accountability Act) pour le marché américain, bien que le modèle économique cible un marché international (i18n EN, 79K professionnels adressables). Seule la RGPD est couverte. Pour les clients institutionnels américains (universités, hôpitaux), la conformité HIPAA est un deal-breaker. |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §12 (Sécurité), `CAHIER_DES_CHARGES_LMS.md` — sécurité |
| **Solution proposée** | Ajouter une section « Conformité HIPAA » couvrant : PHI (Protected Health Information), BAA (Business Associate Agreement), encryption at rest (AES-256) et in transit (TLS 1.3), audit logging, access controls, breach notification. Certaines mesures (chiffrement, audit logs) sont déjà prévues pour la RGPD et sont réutilisables. |

### 3.5
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-05 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | MEDIUM |
| **Description** | Le dataset de validation biomécanique (50 cas de référence avec tolérance ±5%) est modeste pour un simulateur revendiquant une fidélité FEM. Les publications de référence (Panjabi, White) sont anciennes. Pas de protocole de validation clinique prospective (comparaison simulation vs résultat chirurgical réel). |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §15.5 (Tests de régression biomécanique), §8 (Validation) |
| **Solution proposée** | 1) Augmenter à ≥200 cas de référence, incluant les 6 types Lenke, les scolioses neuromusculaires, et les adultes. 2) Définir un protocole de validation clinique : comparer les prédictions de correction VERTEX avec les résultats postopératoires réels (angle de Cobb post-op, SVA) sur une cohorte prospective de 30-50 patients. 3) Publier les résultats de validation dans un journal peer-reviewed (Spine, JBJS). |

### 3.6
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-06 |
| **Catégorie** | SUGGESTION |
| **Priorité** | LOW |
| **Description** | Pas de mention du support Apple Vision Pro (visionOS) ni de la réalité mixte (MR). Les spécifications VR ne mentionnent que Meta Quest 2/3 et HTC Vive. Le marché médical AR/MR est en forte croissance avec visionOS et les HoloLens. |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §18.2 (Accessibilité VR/XR) |
| **Solution proposée** | Ajouter à la roadmap (Phase 9-10) le support visionOS via WebXR ou SDK natif SwiftUI+RealityKit. Le positionnement MR (superposition du modèle VERTEX sur un mannequin réel) serait un différenciateur majeur. |

### 3.7
| Champ | Valeur |
|-------|--------|
| **ID** | TECH-07 |
| **Catégorie** | MISSING |
| **Priorité** | LOW |
| **Description** | Aucune stratégie de pérennité de l'écosystème Julia côté serveur. Julia reste un langage de niche (~0.3% TIOBE). Si des packages clés (FinEtools.jl, Ferrite.jl, Genie.jl) deviennent non-maintenus, le projet est vulnérable. Pas de plan B. |
| **Localisation** | `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §9 (Dépendances Julia) |
| **Solution proposée** | 1) Documenter les packages critiques et leur statut de maintenance (commits récents, nombre de contributeurs, funding). 2) Prévoir un budget d'implication dans la communauté Julia (contribution open source, sponsoring de packages critiques). 3) Identifier des alternatives en Python (FEniCS, dolfinx) ou C++ (deal.II) au cas où. 4) Architecturer le solver avec une interface API propre pour faciliter un rewrite futur si nécessaire. |

---

## 4. INCOHÉRENCES DE RÉFÉRENCES CROISÉES

### 4.1
| Champ | Valeur |
|-------|--------|
| **ID** | XREF-01 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | CRITICAL |
| **Description** | **Break-even contradictoire entre les documents** : `BUDGET_GLOBAL_FORMATION.md` annonce un break-even en **Année 5** (avec 1 500-2 000 abonnés premium cumulés), tandis que `MODELE_ECONOMIQUE.md` annonce un break-even en **Année 3** (scénario médian), **Année 4** (pessimiste), ou **Année 2** (optimiste). Les projections financières sont fondamentalement différentes entre les deux documents. |
| **Localisation** | `BUDGET_GLOBAL_FORMATION.md` — section Phasage financier ; `MODELE_ECONOMIQUE.md` — §5.3 (Break-even), §7 (Scénarios) |
| **Solution proposée** | Unifier les projections financières en un seul modèle avec 3 scénarios (pessimiste/médian/optimiste). Le Budget doit refléter les hypothèses du Modèle Économique et vice-versa. Utiliser un tableur unique (Excel/GSheets) comme source de vérité, avec les documents MD comme exports narratifs. |

### 4.2
| Champ | Valeur |
|-------|--------|
| **ID** | XREF-02 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | CRITICAL |
| **Description** | **Revenus Year 1 avant le lancement** : Le `MODELE_ECONOMIQUE.md` projette des revenus dès l'An 1 (€305K médian, €150K pessimiste, €600K optimiste). Or le `CALENDRIER_PRODUCTION.md` indique un lancement public au **mois 22**. Si « An 1 » du modèle économique correspond aux mois 1-12 du calendrier de production, il n'y a pas de produit disponible. Si « An 1 » = première année post-lancement (mois 22-34), alors An 5 = mois 82 (>6 ans après le début du projet), ce qui rend le break-even encore plus tardif. |
| **Localisation** | `MODELE_ECONOMIQUE.md` — §5 (Projections) ; `CALENDRIER_PRODUCTION.md` — section Jalons (J8 lancement mois 22) |
| **Solution proposée** | 1) Clarifier explicitement que « An 1 » = première année commerciale post-lancement. 2) Ajouter un mapping temporel : An 1 = mois 22-34, An 2 = mois 34-46, etc. 3) Mettre à jour le calendrier pour inclure les projections de revenus par phase. 4) Recalculer le break-even total en incluant les 22 mois de développement pré-revenus. |

### 4.3
| Champ | Valeur |
|-------|--------|
| **ID** | XREF-03 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | HIGH |
| **Description** | **VERTEX v1.0 à mois 40, mais intégration LMS à mois 18** : Le `CALENDRIER_PRODUCTION.md` montre VERTEX v1.0 au mois 40 (fin du projet global). L'intégration LMS est prévue aux mois 8-18. La formation est lancée au mois 22. Comment intégrer un simulateur qui ne sera complet qu'18 mois après le lancement ? Quelles fonctionnalités VERTEX sont disponibles au mois 22 vs mois 40 ? |
| **Localisation** | `CALENDRIER_PRODUCTION.md` — Gantt ; `VERTEX_SPECIFICATIONS_TECHNIQUES.md` — §7 (Phases) ; `CAHIER_DES_CHARGES_LMS.md` — §4 (Intégration VERTEX) |
| **Solution proposée** | 1) Définir explicitement un « Minimum Viable Simulator (MVS) » pour le mois 22 : quels modules VERTEX sont disponibles ? (suggestion : anatomie 3D, vis pédiculaires, 3-5 scénarios Lenke basiques — sans VR, sans FEM complet). 2) Documenter la roadmap incrémentale VERTEX dans le calendrier de production avec les features par phase. 3) Clarifier dans le plan de formation quels ateliers VERTEX sont disponibles au lancement vs ajoutés progressivement. |

### 4.4
| Champ | Valeur |
|-------|--------|
| **ID** | XREF-04 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | HIGH |
| **Description** | **Nombre de questions quiz** : ~~Le Module 29 mentionne « **560+** questions réparties sur 28 modules » puis, 20 lignes plus bas, un tableau totalisant **600** questions (145+175+160+120 = 600). 560+ ≠ 600.~~ **✅ RÉSOLU** — Corrigé à « 600+ » dans tous les documents. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Module 29, §28.1 (sic) |
| **Solution proposée** | Corriger le texte introductif à « 600 questions » pour correspondre au tableau, ou recalculer le tableau. Vérifier que chaque module a effectivement ≥20 questions comme annoncé (600/28 = 21.4 en moyenne, mais la distribution est inégale). |

### 4.5
| Champ | Valeur |
|-------|--------|
| **ID** | XREF-05 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | MEDIUM |
| **Description** | **Coûts récurrents** : `BUDGET_GLOBAL_FORMATION.md` annonce €390-660K/an de coûts récurrents. Mais le `MODELE_ECONOMIQUE.md` projette un résultat net An 1 de -€1,2M pour un CA de €305K, ce qui implique des coûts totaux An 1 de ~€1,5M, bien au-delà des €390-660K récurrents. Même en ajoutant les coûts de développement initiaux amortis, l'écart n'est pas expliqué. |
| **Localisation** | `BUDGET_GLOBAL_FORMATION.md` — Coûts récurrents ; `MODELE_ECONOMIQUE.md` — §5 Projections An 1 |
| **Solution proposée** | Distinguer clairement : 1) Coûts CAPEX (développement initial amortis sur 3-5 ans), 2) Coûts OPEX récurrents (infra, maintenance, équipe minimum), 3) Coûts variables (marketing, support proportionnel au nombre d'apprenants). Réconcilier les deux documents avec un état des flux de trésorerie (cash flow) cohérent. |

### 4.6
| Champ | Valeur |
|-------|--------|
| **ID** | XREF-06 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | MEDIUM |
| **Description** | **Plateforme LMS** : Le `CAHIER_DES_CHARGES_LMS.md` spécifie un développement custom (Vue.js/NestJS ou Django, PostgreSQL) avec 11 lots de livraison, tandis que d'autres endroits du projet mentionnent Moodle/Canvas comme options. Un développement custom est 3-5x plus cher qu'un déploiement Moodle avec plugins mais offre plus de contrôle. Le choix n'est pas tranché. |
| **Localisation** | `CAHIER_DES_CHARGES_LMS.md` — §3 (Architecture technique) ; mentions Moodle dans d'autres documents |
| **Solution proposée** | Trancher : 1) Custom build (comme détaillé dans le CdC) — budget €300-500K, timeline 12 mois, risque de non-delivery plus élevé, ou 2) Moodle + plugins custom (LTI VERTEX, quiz avancé, analytics) — budget €100-200K, timeline 6-8 mois, compromis sur l'UX. Faire un tableau comparatif décisionnel formalisé. |

---

## 5. PROBLÈMES STRUCTURELS

### 5.1
| Champ | Valeur |
|-------|--------|
| **ID** | STRUCT-01 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | HIGH |
| **Description** | ~~**Erreur de numérotation des sections dans le Module 29**~~ : **✅ RÉSOLU — Vérification montre que 28.1 et 28.3 sont bien dans le Module 28 (VERTEX), pas dans le Module 29. Le Module 29 utilise correctement 29.1-29.5. Ce constat était invalide.** |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Module 29, lignes ~2370 (« #### 28.1 Quiz par module ») et ~2440 (« #### 28.3 Évaluation par palier ») |
| **Solution proposée** | Corriger « #### 28.1 Quiz par module » → « #### 29.1 Quiz par module » et « #### 28.3 Évaluation par palier » → « #### 29.3 Évaluation par palier ». |

### 5.2
| Champ | Valeur |
|-------|--------|
| **ID** | STRUCT-02 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | LOW |
| **Description** | ~~**Numérotation irrégulière** : Deux sections utilisent le suffixe « bis » au lieu d'une numérotation standard : §5.5bis (classifications additionnelles) et §20.4bis (protocoles d'analgésie).~~ **✅ RÉSOLU** — Renuméroté : §5.5bis→§5.5, §20.4bis→§20.5. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — §5.5bis, §20.4bis |
| **Solution proposée** | Re-numéroter proprement : §5.5bis → §5.6 (décaler les suivants) et §20.4bis → §20.5 (décaler §20.5→20.6, §20.6→20.7, etc.). |

### 5.3
| Champ | Valeur |
|-------|--------|
| **ID** | STRUCT-03 |
| **Catégorie** | SUGGESTION |
| **Priorité** | MEDIUM |
| **Description** | **Module 20 surdimensionné** : Le Module 20 (Anesthésie et gestion périopératoire) fait ~500 lignes et couvre : évaluation préopératoire, anesthésie, IONM (PES/PEM/D-waves/EMG), protocoles d'analgésie, gestion transfusionnelle, équipe multidisciplinaire, préparation du malade, nutrition/santé osseuse. C'est 3-4x plus long que les autres modules et constitue en réalité 3-4 modules distincts. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Module 20 complet (lignes ~1505-1825) |
| **Solution proposée** | Scinder en : Module 20A « Anesthésie et monitoring IONM » (§20.1-20.3), Module 20B « Analgésie et gestion transfusionnelle » (§20.4-20.5), Module 20C « Équipe multidisciplinaire et préparation du malade » (§20.6-20.7), Module 20D « Nutrition et santé osseuse en chirurgie » (§20.8). Conséquence : passer à 32 modules au lieu de 29, ajuster tous les numéros en aval. |

### 5.4
| Champ | Valeur |
|-------|--------|
| **ID** | STRUCT-04 |
| **Catégorie** | SUGGESTION |
| **Priorité** | LOW |
| **Description** | **Profondeur de contenu asymétrique** : Les modules chirurgicaux et techniques (M15-20, M28) sont rédigés à un niveau de détail exceptionnel (protocoles chiffrés, algorithmes de décision, doses), tandis que les modules non-chirurgicaux (M21-24) restent au stade de plan. Cette asymétrie rend la formation déséquilibrée. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — comparaison M15-20 vs M21-24 |
| **Solution proposée** | Prioriser la rédaction complète des Modules 21-24 dans la Phase A1 (contenu, mois 1-6) du calendrier de production. Assigner un rédacteur dédié (MPR ou kinésithérapeute pour M21, psychologue pour M22, pneumologue pour M23). |

---

## 6. LACUNES PÉDAGOGIQUES

### 6.1
| Champ | Valeur |
|-------|--------|
| **ID** | PEDA-01 |
| **Catégorie** | MISSING |
| **Priorité** | HIGH |
| **Description** | **Aucune évaluation diagnostique d'entrée** (pre-test). La formation suppose un niveau de base mais ne le vérifie pas. Un interne de 1ère année et un chirurgien de 15 ans d'expérience accèdent au même contenu séquentiel. Aucun test de positionnement pour adapter le parcours ou valider les prérequis. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — aucune section prérequis testés ; `GUIDE_FORMATEUR.md` — pas de pre-test |
| **Solution proposée** | Ajouter un test de positionnement obligatoire (30 QCM, 20 min) couvrant anatomie de base, biomécanique, et lecture de radiographies. Résultats : 1) Si score >80% → possibilité de sauter les Modules 1-3. 2) Si score <50% → recommandation de prérequis additionnels. 3) Stocker les résultats pour analyse comparative pré-post formation. |

### 6.2
| Champ | Valeur |
|-------|--------|
| **ID** | PEDA-02 |
| **Catégorie** | MISSING |
| **Priorité** | HIGH |
| **Description** | **Pas de système de révision espacée** (spaced repetition). La formation utilise un modèle séquentiel linéaire (débloquer module par module). Or les données sur la rétention montrent que 80% du contenu est oublié en 30 jours sans révision. Pour 89h de contenu sur 12-16 semaines, les modules initiaux seront oubliés lors de l'examen final. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — architecture pédagogique ; `CAHIER_DES_CHARGES_LMS.md` — pas de feature spaced rep. |
| **Solution proposée** | 1) Intégrer un système de flashcards dérivées des quiz (type Anki) avec reprise espacée algorithmique. 2) Ajouter des « quiz récapitulatifs inter-parties » toutes les 2-3 parties, mélangeant des questions des parties précédentes. 3) Spécifier cette fonctionnalité dans le CdC LMS. |

### 6.3
| Champ | Valeur |
|-------|--------|
| **ID** | PEDA-03 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | MEDIUM |
| **Description** | **Activités collaboratives limitées** : Hormis le forum et les webinaires, aucune activité d'apprentissage par les pairs n'est structurée (peer review des cas cliniques, correction croisée, travaux de groupe, journal clubs). La littérature EdTech montre que l'apprentissage social augmente la rétention de 50%. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — modalités ; `GUIDE_FORMATEUR.md` — §4 (Animation) |
| **Solution proposée** | Ajouter : 1) Peer review des cas cliniques VERTEX (observer et commenter la simulation d'un pair, guidé par une grille d'évaluation). 2) Journal clubs mensuels : lecture collective d'un article récent avec discussion structurée. 3) Travaux collaboratifs : planification chirurgicale en binôme sur un cas VERTEX complexe. |

### 6.4
| Champ | Valeur |
|-------|--------|
| **ID** | PEDA-04 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | **Pas de parcours adaptatif** : La progression est linéaire (séquentiel avec seuil 70%). Pas de parcours différencié selon le profil (chirurgien orthopédiste vs neurochirurgien vs rééducateur vs radiologue), le niveau d'expérience, ou les lacunes identifiées par le pre-test. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — structure ; `CAHIER_DES_CHARGES_LMS.md` — pas de spec adaptive learning |
| **Solution proposée** | 1) Définir 3-4 « tracks » (parcours) : Chirurgien opérant, Rééducation & suivi, Imagerie & diagnostic, Panorama complet. 2) Certains modules seraient obligatoires pour tous, d'autres spécifiques au track. 3) Permettre aux médecins expérimentés de tester directement le quiz Bronze/Argent d'un module pour le valider sans suivre le cours. |

---

## 7. ÉLÉMENTS PRATIQUES MANQUANTS

### 7.1
| Champ | Valeur |
|-------|--------|
| **ID** | PRAT-01 |
| **Catégorie** | MISSING |
| **Priorité** | HIGH |
| **Description** | **Aucun template de document clinique téléchargeable** : Malgré le contenu détaillé sur la préparation du malade (§20.7), le consentement éclairé (§22.4, §26.1), la checklist OMS (§20.7.4), et l'IONM (§20.3), aucun modèle de document prêt à l'emploi n'est fourni. Ce sont des livrables à forte valeur ajoutée pour les praticiens, simples à produire. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — M20, M22, M26 ; `MEDIAS_PRODUCTION_SCOLIOSE.md` — pas de catégorie « Documents » |
| **Solution proposée** | Créer et intégrer à la formation des templates téléchargeables (PDF/DOCX) : 1) Formulaire de consentement éclairé scoliose (adulte + mineur), 2) Checklist préopératoire rachis (adaptation OMS), 3) Fiche de report IONM, 4) Fiche de suivi postopératoire, 5) Feuille de score SRS-22r / ODI, 6) Template de planification chirurgicale (niveaux, implants, objectifs). |

### 7.2
| Champ | Valeur |
|-------|--------|
| **ID** | PRAT-02 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | **Pas de passerelle formation virtuelle → pratique réelle** : La formation est 100% en ligne. Aucun parcours de transition vers la pratique chirurgicale réelle n'est défini : pas de stage hands-on, pas de cadaveric lab, pas de proctoring au bloc, pas de partenariat avec des centres de simulation physique (AO, Simulation Centres). |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — aucune section ; `MODELE_ECONOMIQUE.md` — aucune offre hybride |
| **Solution proposée** | 1) Ajouter un Module 29bis « Passerelle vers la pratique » ou une Annexe G décrivant les étapes recommandées post-certification. 2) Établir des partenariats formels avec des centres de simulation chirurgicale (AO Spine courses, Sawbones labs). 3) Proposer une option premium « certification + stage pratique 2 jours » avec cadaveric lab. 4) Intégrer ce parcours hybride dans le modèle économique comme offre premium (€2 500-3 500). |

### 7.3
| Champ | Valeur |
|-------|--------|
| **ID** | PRAT-03 |
| **Catégorie** | MISSING |
| **Priorité** | LOW |
| **Description** | **Pas d'accès aux logiciels de planification chirurgicale commerciaux (Surgimap, Mediview, CASSOS)** ni de tutorial d'utilisation. VERTEX est un simulateur pédagogique, pas un outil de planification clinical-grade. Les apprenants ne sont pas formés aux outils qu'ils utiliseront en pratique. |
| **Localisation** | `PLAN_FORMATION_SCOLIOSE.md` — Module 17, Annexe E |
| **Solution proposée** | Ajouter des vidéos tutorielles de 15-20 min pour les 2-3 logiciels de planification les plus utilisés (Surgimap, CASSOS). Négocier des licences éducatives temporaires avec les éditeurs. |

---

## 8. COHÉRENCE BUDGET / CALENDRIER

### 8.1
| Champ | Valeur |
|-------|--------|
| **ID** | BUDCAL-01 |
| **Catégorie** | INCONSISTENCY |
| **Priorité** | CRITICAL |
| **Description** | **Budget marketing sous-dimensionné** : Le budget alloue €80-150K au marketing sur 40 mois. Le calendrier prévoit du marketing des mois 6 à 40+ (~34 mois). Cela représente €2 350-4 400/mois de budget marketing. Pour une CAC cible de €200 (An 1) et un objectif de 390 apprenants payants en An 1 (médian), il faudrait €78 000 de dépenses d'acquisition la première année seule — consommant 50-100% du budget marketing total de 40 mois en 12 mois. Le budget marketing est incompatible avec les objectifs d'acquisition du modèle économique. |
| **Localisation** | `BUDGET_GLOBAL_FORMATION.md` — Marketing ; `MODELE_ECONOMIQUE.md` — §4 (Distribution), §6.1 (KPI: CAC) |
| **Solution proposée** | 1) Revoir le budget marketing à la hausse : min €200-400K sur 40 mois (€5-10K/mois). 2) Ou revoir les hypothèses d'acquisition à la baisse (moins d'apprenants, break-even plus tardif). 3) Intégrer le marketing dans les coûts récurrents annuels du budget. 4) Détailler les canaux marketing (SEO : coût 0 mais temps, SEA : coût CPC, congrès : stands, KOL : honoraires). |

### 8.2
| Champ | Valeur |
|-------|--------|
| **ID** | BUDCAL-02 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | HIGH |
| **Description** | **Pas de budget pour la réglementation SaMD/CE/FDA** : Le budget prévoit €50-100K pour « Certification/réglementaire » mais cela couvre uniquement l'accréditation DPC et les certifications pédagogiques. Aucun budget pour un processus de marquage CE ou 510(k) qui coûte typiquement €100-500K (incluant consultant réglementaire, rédaction du Technical File, tests IEC 62304, audit de l'organisme notifié). Voir TECH-01. |
| **Localisation** | `BUDGET_GLOBAL_FORMATION.md` — Certification/réglementaire |
| **Solution proposée** | 1) Si VERTEX est positionné comme SaMD : ajouter €200-500K au budget réglementaire + 12-18 mois au calendrier (soumission en Phase 7-8). 2) Si VERTEX est positionné comme « educational only » : formaliser ce choix dans les specs et ajouter des disclaimers légaux sur tout output de simulation. |

### 8.3
| Champ | Valeur |
|-------|--------|
| **ID** | BUDCAL-03 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | MEDIUM |
| **Description** | **Budget contenu sous-estimé pour le volume produit** : €180-280K pour la création de contenu de 29 modules totalisant 89h. Cela représente €2 000-3 150/heure de formation produite. Le benchmark EdTech médical est €3 000-8 000/heure pour du contenu expert validé (source : Training Industry). Le bas de la fourchette (€180K) est irréaliste si le contenu est rédigé par des chirurgiens experts (honoraires typiques : €150-300/h). |
| **Localisation** | `BUDGET_GLOBAL_FORMATION.md` — Création de contenu |
| **Solution proposée** | 1) Revoir à la hausse : €350-500K minimum pour 89h de contenu expert. 2) Détailler le budget par poste : rédaction (chirurgiens auteurs), relecture (comité scientifique), mise en forme (ingénieur pédagogique), traduction (4 langues). 3) Ou réduire le volume à 50-60h en se concentrant sur le contenu différenciant (les modules chirurgicaux détaillés + VERTEX). |

### 8.4
| Champ | Valeur |
|-------|--------|
| **ID** | BUDCAL-04 |
| **Catégorie** | SUGGESTION |
| **Priorité** | MEDIUM |
| **Description** | **Absence de budget de contingence** : Le budget ne prévoit aucune réserve pour dépassement (overrun). Les projets logiciels dépassent leur budget de 45% en moyenne (Standish Group). Les fourchettes haute-basse (€4.7-6.8M) ne constituent pas une contingence mais un delta entre scénarios. |
| **Localisation** | `BUDGET_GLOBAL_FORMATION.md` — toutes sections |
| **Solution proposée** | Ajouter une ligne « Contingence / Imprévus » de 15-20% du budget (€700K-1.4M). Associer cette réserve à des critères de déblocage (revue trimestrielle, approbation comité de pilotage). |

---

## 9. COMPLÉTUDE DU CAHIER DES CHARGES LMS

### 9.1
| Champ | Valeur |
|-------|--------|
| **ID** | LMS-01 |
| **Catégorie** | MISSING |
| **Priorité** | HIGH |
| **Description** | **Pas de spécification de proctoring pour l'examen de certification** : Le Module 29 du plan de formation spécifie un examen de 3h30 « en conditions surveillées (proctored) ». Le `CAHIER_DES_CHARGES_LMS.md` ne contient aucune spécification de proctoring : pas de choix entre proctoring humain vs IA, pas d'intégration avec un prestataire (Proctorio, ExamSoft, ProctorU), pas de specs d'enregistrement vidéo, pas de vérification d'identité. |
| **Localisation** | `CAHIER_DES_CHARGES_LMS.md` — absent ; `PLAN_FORMATION_SCOLIOSE.md` — Module 29, Examen final |
| **Solution proposée** | Ajouter un lot dédié au proctoring dans le CdC LMS : 1) Vérification d'identité (pièce d'identité + reconnaissance faciale). 2) Surveillance par webcam + micro + partage d'écran. 3) Détection d'anomalies par IA (regard, présence de tiers, onglets). 4) Intégration LTI avec un prestataire (ProctorU, Proctorio). 5) Stockage et relecture des enregistrements (30 jours). Budget estimé : €15-30K + €20-50/session. |

### 9.2
| Champ | Valeur |
|-------|--------|
| **ID** | LMS-02 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | **Pas de critères d'évaluation des offres fournisseurs** : Le CdC contient les exigences fonctionnelles et techniques mais aucune grille de notation pondérée pour évaluer les réponses fournisseurs. Pas de poids relatif entre les critères (fonctionnel, technique, coût, délai, références, SLA). |
| **Localisation** | `CAHIER_DES_CHARGES_LMS.md` — absent |
| **Solution proposée** | Ajouter une section « Critères d'évaluation des offres » avec une grille pondérée : Adéquation fonctionnelle (30%), Architecture technique (20%), Coût (TCO 5 ans) (20%), Références EdTech santé (15%), Délais (10%), SLA et maintenance (5%). |

### 9.3
| Champ | Valeur |
|-------|--------|
| **ID** | LMS-03 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | **Pas de spécification d'outil auteur (authoring tool)** : Le CdC mentionne SCORM 2004 et xAPI comme standards de packaging mais ne spécifie pas comment le contenu sera produit. Quel outil auteur ? (Articulate 360, H5P, iSpring, custom editor ?). Comment les 513 médias sont-ils encapsulés dans des activités SCORM ? Comment les quiz sont-ils créés ? |
| **Localisation** | `CAHIER_DES_CHARGES_LMS.md` — §2 (Gestion de contenu) |
| **Solution proposée** | 1) Spécifier l'outil auteur retenu (recommandation : H5P pour les quiz interactifs et les activités, car open source et intégrable à tout LMS). 2) Définir le workflow de production de contenu : rédaction (MD/DOCX) → mise en forme (authoring tool) → packaging (SCORM/xAPI) → publication (LMS). 3) Former l'équipe de contenus à l'outil choisi. |

### 9.4
| Champ | Valeur |
|-------|--------|
| **ID** | LMS-04 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | LOW |
| **Description** | **SLA incomplet** : Le CdC mentionne 99.9% d'uptime mais ne spécifie pas : GTI (Garantie de Temps d'Intervention), GTR (Garantie de Temps de Rétablissement), niveaux de sévérité des incidents (P1/P2/P3/P4), pénalités contractuelles, crédits de service, compte-rendu mensuel. |
| **Localisation** | `CAHIER_DES_CHARGES_LMS.md` — §8 (SLA) |
| **Solution proposée** | Compléter le SLA avec : P1 (plateforme down) → GTI 30 min, GTR 4h, pénalité 10% facture mensuelle/jour. P2 (fonctionnalité majeure) → GTI 2h, GTR 24h. P3 (anomalie mineure) → GTI 8h, GTR 5j ouvrés. P4 (évolution) → backlog sprint planning. |

### 9.5
| Champ | Valeur |
|-------|--------|
| **ID** | LMS-05 |
| **Catégorie** | MISSING |
| **Priorité** | LOW |
| **Description** | **Pas de plan de migration de données** ni de stratégie de réversibilité. Si le fournisseur LMS doit être changé, comment exporter les données apprenants, les progressions, les contenus ? Le CdC ne mentionne pas la portabilité des données. |
| **Localisation** | `CAHIER_DES_CHARGES_LMS.md` — absent |
| **Solution proposée** | Ajouter une clause de réversibilité : 1) Export complet des données en format ouvert (CSV/JSON/xAPI). 2) Documentation de la structure de données. 3) Période de réversibilité assistée de 6 mois. 4) Propriété des données et du code source (escrow de code). |

---

## 10. RÉALISME DU MODÈLE ÉCONOMIQUE

### 10.1
| Champ | Valeur |
|-------|--------|
| **ID** | ECO-01 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | CRITICAL |
| **Description** | **Aucune validation marché effectuée** : Le document lui-même note « À mettre à jour après la phase de validation marché (interviews, landing page test) ». Les projections financières (€4.7-6.8M d'investissement) reposent sur des benchmarks EdTech génériques (Osmosis, Lecturio) qui ne sont pas des plateformes de simulation chirurgicale. La taille de marché (79K) est une estimation théorique sans enquête terrain. Investir >€4M sans validation préalable du Product-Market Fit est un risque majeur. |
| **Localisation** | `MODELE_ECONOMIQUE.md` — note de fin de document |
| **Solution proposée** | **Avant tout développement majeur** : 1) Conduire 30-50 interviews qualitatives (chirurgiens du rachis, chefs de service, DPC, DRH hôpitaux). 2) Créer une landing page avec proposition de valeur + collecte d'emails (objectif : 500 pré-inscriptions en 3 mois comme signal de PMF). 3) Tester le pricing via conjoint analysis ou Gabor-Granger. 4) Valider l'intérêt pour VERTEX spécifiquement (vs contenu seul) par un prototype cliquable. |

### 10.2
| Champ | Valeur |
|-------|--------|
| **ID** | ECO-02 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | HIGH |
| **Description** | **Churn de 5% mensuel en An 1 incompatible avec les projections** : Un churn mensuel de 5% signifie que (1-0.05)^12 = 54% des abonnés survivent après 1 an. Avec 390 apprenants payants en An 1, seulement ~210 sont encore actifs en fin d'année. L'ARPU de €770 est calculé sur quoi ? Une souscription annuelle unique ? Si c'est un abonnement mensuel, le churn de 5% réduit la LTV à €770/0.05 = €15 400, ce qui est incohérent avec le LTV annoncé de €1 100 en An 1. La mécanique de churn et le modèle de récurrence ne sont pas clairs. |
| **Localisation** | `MODELE_ECONOMIQUE.md` — §6.1 (KPI SaaS) |
| **Solution proposée** | 1) Clarifier le modèle de récurrence : abonnement mensuel, annuel, ou achat unique avec renouvellement ? 2) Recalculer le LTV en cohérence avec le churn : LTV = ARPU / churn_annuel. 3) Un churn mensuel réaliste en EdTech santé est plutôt 2-3%. 4) Prévoir un modèle de cohortes (cohort analysis) plutôt qu'un agrégat. |

### 10.3
| Champ | Valeur |
|-------|--------|
| **ID** | ECO-03 |
| **Catégorie** | INSUFFICIENT |
| **Priorité** | HIGH |
| **Description** | **Risque de concurrence sous-estimé** : AO Spine (filiale éducative de la fondation AO, la plus grande organisation d'éducation orthopédique au monde) dispose déjà d'une plateforme e-learning complète, de 500+ chirurgiens experts, d'un réseau de 40 000+ membres, et de budgets supérieurs à €20M/an. AO Spine pourrait développer un simulateur similaire plus rapidement grâce à ses ressources. Le modèle économique mentionne AO Spine dans le benchmark mais sous-estime la menace concurrentielle. |
| **Localisation** | `MODELE_ECONOMIQUE.md` — §2 (Avantage concurrentiel) |
| **Solution proposée** | 1) Réaliser une analyse concurrentielle détaillée (SWOT, Porter) incluant AO Spine, ISSGF, Medtronic Academy, DePuy Synthes Institute, Stryker Spine Academy. 2) Identifier une niche défendable (ex. francophonie + simulation FEM = différenciateur unique). 3) Envisager une stratégie de partenariat plutôt que de concurrence avec AO Spine (licence VERTEX à AO Spine ?). 4) Protéger la propriété intellectuelle (brevet sur les algorithmes FEM spécifiques). |

### 10.4
| Champ | Valeur |
|-------|--------|
| **ID** | ECO-04 |
| **Catégorie** | MISSING |
| **Priorité** | MEDIUM |
| **Description** | **Pas de funnel de conversion détaillé** (Free → Essentiel → Avancé → Certification). Taux de conversion free-to-paid ? Taux de upgrade entre tiers ? Temps moyen dans le funnel ? Ces métriques sont essentielles pour un modèle freemium mais sont absentes. |
| **Localisation** | `MODELE_ECONOMIQUE.md` — §3 (Pricing) |
| **Solution proposée** | Ajouter un modèle de funnel : Inscription gratuite (100%) → Activation (complète Module 1 : 60%) → Achat Essentiel (15-20%) → Upgrade Avancé (40% des Essentiel) → Certification (60% des Avancé). Calibrer ces taux sur les benchmarks EdTech médical (Osmosis free-to-paid : ~5-8%). |

### 10.5
| Champ | Valeur |
|-------|--------|
| **ID** | ECO-05 |
| **Catégorie** | SUGGESTION |
| **Priorité** | MEDIUM |
| **Description** | **Dépendance DPC risquée** : Le modèle cite le DPC (Développement Professionnel Continu) comme canal de distribution (10%) et levier de rétention. Or le DPC français est financé par un budget annuel plafonné (~€300M pour 400 000+ médecins, soit ~€750/médecin/an), réparti de manière opaque. Le financement DPC dépend d'un agrément tri-annuel de l'ANDPC, soumis à des critères changeants. L'accès au DPC n'est pas garanti. |
| **Localisation** | `MODELE_ECONOMIQUE.md` — §3.3 (DPC), §4.3 (Distribution) |
| **Solution proposée** | 1) Ne pas baser plus de 10% des revenus sur le DPC. 2) Prévoir un plan B en cas de refus d'agrément ou de changement de politique DPC. 3) Explorer le FIF-PL (pour les libéraux) et l'OPCO (pour les hospitaliers) comme alternatives/compléments. 4) Viser l'accréditation européenne EACCME pour la portabilité internationale. |

---

## SYNTHÈSE DES ACTIONS PRIORITAIRES

### Actions CRITIQUES (à résoudre AVANT le début du développement)

| # | ID | Action | Effort estimé | Impact | Statut |
|---|-----|--------|--------------|--------|--------|
| 1 | ECO-01 | Validation marché (interviews, landing page, pricing test) | 2-3 mois, €10-30K | Valide ou invalide l'ensemble du projet | **✅ Plan défini** — `MODELE_ECONOMIQUE.md` §8 (40 interviews, landing page, Gabor-Granger, Go/No-Go) |
| 2 | TECH-01 | Décision réglementaire SaMD : « educational only » vs marquage CE/FDA | 1 mois (comité juridique) | Impacte budget (+€200-500K), timeline (+12-18 mois), scope | **✅ RÉSOLU** — `VERTEX_SPECIFICATIONS_TECHNIQUES.md` §21 : Phase 1 « educational only » + critères Phase 2 SaMD |
| 3 | XREF-01 | Unification des projections financières (Budget ↔ Modèle Économique) | 2 semaines | Crédibilité auprès des investisseurs | **✅ RÉSOLU** — Break-even opérationnel (An 3) vs cumulé (An 5) harmonisé dans les deux documents |
| 4 | XREF-02 | Clarification temporelle An 1 = post-lancement, recalcul break-even total | 1 semaine | Réalisme financier | **✅ RÉSOLU** — Notes d'harmonisation ajoutées : An 1 = mois 22-34 post-lancement |
| 5 | BUDCAL-01 | Revalorisation budget marketing (€80-150K → €200-400K minimum) | Décision budgétaire | Cohérence acquisition/CA | 🟡 Ouvert |
| 6 | ECO-02 | Clarification modèle de récurrence et recalcul churn/LTV | 1 semaine | Cohérence SaaS metrics | 🟡 Ouvert |
| 7 | XREF-03 | Définition du Minimum Viable Simulator (MVS) pour le lancement M22 | 2 semaines | Planification réaliste | **✅ RÉSOLU** — `CALENDRIER_PRODUCTION.md` : MVS défini avec features incluses/exclues au mois 22 |

### Actions HAUTES (à résoudre dans les 3 premiers mois du projet)

| # | ID | Action | Effort estimé |
|---|-----|--------|--------------|
| 8 | CONT-01 | Rédaction complète des Modules 21-24 | 4-6 semaines rédaction |
| 9 | MED-01 | Mise à jour catalogue médias M20 (+12-15 médias) | 2 semaines catalogue |
| 10 | TECH-02 | Clarification compatibilité GPU client (WebGL vs desktop) | 1 semaine specs |
| 11 | TECH-03 | Spécification concurrence solveur FEM + architecture queuing | 2 semaines specs |
| 12 | STRUCT-01 | ~~Correction numérotation Module 29 (28.1→29.1, 28.3→29.3)~~ **Invalide** | ~~10 minutes~~ |
| 13 | PEDA-01 | Conception du test de positionnement d'entrée | 2-3 semaines |
| 14 | PEDA-02 | Spécification du système de révision espacée | 1-2 semaines spec |
| 15 | PRAT-01 | Création des templates cliniques téléchargeables | 3-4 semaines contenu |
| 16 | LMS-01 | Spécification proctoring dans le CdC LMS | 1 semaine |
| 17 | BUDCAL-02 | Décision et budgétisation réglementaire SaMD | Dépend de TECH-01 |
| 18 | ECO-03 | Analyse concurrentielle détaillée (SWOT, stratégie différenciation) | 2 semaines |
| 19 | XREF-04 | ~~Correction incohérence 560+/600 questions~~ **✅ RÉSOLU** | ~~10 minutes~~ |

---

## ANNEXE : MATRICE DE TRAÇABILITÉ DES CONSTATATIONS

| ID | Doc source | Dimensions d'audit | Catégorie | Priorité |
|----|-----------|-------------------|-----------|----------|
| CONT-01 | PLAN | Contenu | INSUFFICIENT | HIGH |
| CONT-02 | PLAN | Contenu | MISSING | MEDIUM |
| CONT-03 | PLAN | Contenu | MISSING | MEDIUM |
| CONT-04 | PLAN | Contenu | MISSING | LOW |
| CONT-05 | PLAN | Contenu | INSUFFICIENT | MEDIUM |
| CONT-06 | PLAN | Contenu | MISSING | LOW |
| MED-01 | MEDIAS, PLAN | Médias | MISSING | HIGH |
| MED-02 | MEDIAS, PLAN | Médias | INSUFFICIENT | MEDIUM |
| MED-03 | MEDIAS, PLAN | Médias | MISSING | MEDIUM |
| MED-04 | MEDIAS, PLAN | Médias | SUGGESTION | LOW |
| TECH-01 | VERTEX | VERTEX tech | MISSING | CRITICAL |
| TECH-02 | VERTEX, PLAN | VERTEX tech | INSUFFICIENT | HIGH |
| TECH-03 | VERTEX | VERTEX tech | INSUFFICIENT | HIGH |
| TECH-04 | VERTEX, LMS | VERTEX tech | MISSING | MEDIUM |
| TECH-05 | VERTEX | VERTEX tech | INSUFFICIENT | MEDIUM |
| TECH-06 | VERTEX | VERTEX tech | SUGGESTION | LOW |
| TECH-07 | VERTEX | VERTEX tech | MISSING | LOW |
| XREF-01 | BUDGET, MODELE | Cohérence croisée | INCONSISTENCY | CRITICAL |
| XREF-02 | MODELE, CALENDRIER | Cohérence croisée | INCONSISTENCY | CRITICAL |
| XREF-03 | CALENDRIER, VERTEX, LMS | Cohérence croisée | INCONSISTENCY | HIGH |
| XREF-04 | PLAN | Cohérence croisée | INCONSISTENCY | HIGH |
| XREF-05 | BUDGET, MODELE | Cohérence croisée | INCONSISTENCY | MEDIUM |
| XREF-06 | LMS | Cohérence croisée | INCONSISTENCY | MEDIUM |
| STRUCT-01 | PLAN | Structure | INCONSISTENCY | HIGH |
| STRUCT-02 | PLAN | Structure | INCONSISTENCY | LOW |
| STRUCT-03 | PLAN | Structure | SUGGESTION | MEDIUM |
| STRUCT-04 | PLAN | Structure | SUGGESTION | LOW |
| PEDA-01 | PLAN, GUIDE | Pédagogie | MISSING | HIGH |
| PEDA-02 | PLAN, LMS | Pédagogie | MISSING | HIGH |
| PEDA-03 | PLAN, GUIDE | Pédagogie | INSUFFICIENT | MEDIUM |
| PEDA-04 | PLAN, LMS | Pédagogie | MISSING | MEDIUM |
| PRAT-01 | PLAN, MEDIAS | Pratique | MISSING | HIGH |
| PRAT-02 | PLAN, MODELE | Pratique | MISSING | MEDIUM |
| PRAT-03 | PLAN | Pratique | MISSING | LOW |
| BUDCAL-01 | BUDGET, MODELE, CALENDRIER | Budget/Calendrier | INCONSISTENCY | CRITICAL |
| BUDCAL-02 | BUDGET, VERTEX | Budget/Calendrier | INSUFFICIENT | HIGH |
| BUDCAL-03 | BUDGET | Budget/Calendrier | INSUFFICIENT | MEDIUM |
| BUDCAL-04 | BUDGET | Budget/Calendrier | SUGGESTION | MEDIUM |
| LMS-01 | LMS, PLAN | CdC LMS | MISSING | HIGH |
| LMS-02 | LMS | CdC LMS | MISSING | MEDIUM |
| LMS-03 | LMS | CdC LMS | MISSING | MEDIUM |
| LMS-04 | LMS | CdC LMS | INSUFFICIENT | LOW |
| LMS-05 | LMS | CdC LMS | MISSING | LOW |
| ECO-01 | MODELE | Modèle économique | INSUFFICIENT | CRITICAL |
| ECO-02 | MODELE | Modèle économique | INSUFFICIENT | HIGH |
| ECO-03 | MODELE | Modèle économique | INSUFFICIENT | HIGH |
| ECO-04 | MODELE | Modèle économique | MISSING | MEDIUM |
| ECO-05 | MODELE | Modèle économique | SUGGESTION | MEDIUM |

---

*Audit réalisé le 2026-02-XX — Version 1.0*
*Basé sur l'analyse exhaustive de 7 095 lignes de documentation projet*
*Prochaine revue recommandée : après résolution des 7 actions CRITIQUES*
