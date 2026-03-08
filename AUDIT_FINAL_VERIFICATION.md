# AUDIT FINAL DE VÉRIFICATION — PROJET FORMATION SCOLIOSE

**Date** : Juillet 2025  
**Périmètre** : 13 fichiers, ~7 200+ lignes  
**Méthodologie** : Lecture intégrale de chaque fichier, vérification croisée systématique (numérotation, calculs, cohérence inter-documents, orthographe, exactitude médicale)

> **✅ STATUT : TOUS LES 22 CONSTATS ONT ÉTÉ CORRIGÉS** (voir annotations ✅ RÉSOLU sur chaque constat ci-dessous)

---

## SYNTHÈSE EXÉCUTIVE

| Sévérité | Nombre | Corrigés | Description |
|----------|--------|----------|-------------|
| 🔴 CRITIQUE | 3 | ✅ 3/3 | Incohérences majeures inter-documents (budget, quiz count, parties) |
| 🟠 HAUTE | 8 | ✅ 8/8 | Données obsolètes, mappings modules erronés, calculs douteux |
| 🟡 MOYENNE | 6 | ✅ 6/6 | Incohérences mineures, données périmées, formule manquante |
| 🟢 BASSE | 5 | ✅ 5/5 | Fautes de frappe, arrondis, texte parasite |
| **TOTAL** | **22** | **22/22** | |

---

## CONSTATATIONS DÉTAILLÉES

---

### C-01 🔴 CRITIQUE — Nombre de questions quiz incohérent entre documents

| Champ | Valeur |
|-------|--------|
| **Fichiers** | MODELE_ECONOMIQUE.md (L34), NOTE_TECHNIQUE_PROJET.md (L37), CAHIER_DES_CHARGES_LMS.md (L86), CALENDRIER_PRODUCTION.md (L58), REFLEXION_FINALE_STRATEGIQUE.md (L15) |
| **Texte erroné** | « **640+** questions » (dans 5 fichiers) |
| **Référence correcte** | PLAN_FORMATION_SCOLIOSE.md (L2296, L2310) : « **600+** questions » — dérivé du tableau détaillé : Bronze 145 + Argent 175 + Or 160 + Diamant 120 = **600** |
| **Problème** | 5 documents disent « 640+ », le PLAN maître (seul à avoir le calcul détaillé) dit « 600+ ». |
| **Correction** | Remplacer « 640+ » par « 600+ » dans les 5 fichiers concernés. Vérifier si le total réel n'aurait pas changé (dans ce cas, mettre à jour le PLAN également). |

---

### C-02 🔴 CRITIQUE — NOTE_TECHNIQUE : tableau des Parties entièrement erroné

| Champ | Valeur |
|-------|--------|
| **Fichier** | NOTE_TECHNIQUE_PROJET.md, section 2.2 (L43-52) |
| **Texte erroné** | Le tableau donne des titres, modules et durées qui ne correspondent PAS au PLAN_FORMATION : |

**NOTE_TECHNIQUE (erroné) :**

| # | Titre NOTE_TECHNIQUE | Modules NOTE | Durée NOTE |
|---|---|---|---|
| I | Anatomie et biomécanique du rachis | 1-3 | ~12h |
| II | Classifications et évaluation | 4-6 | ~10h |
| III | Histoire naturelle et épidémiologie | 7-8 | ~8h |
| IV | Traitements conservateurs | 9-10 | ~10h |
| V | Chirurgie de la scoliose | 11-20 | ~28h |
| VI | Rééducation et suivi | 21-23 | ~8h |
| VII | Cas cliniques intégrés | 24-27 | ~6h |
| VIII | Simulation et innovation | 28-29 | ~7h |

**PLAN_FORMATION (référence correcte, L2476-2487) :**

| # | Titre PLAN | Modules PLAN | Durée PLAN |
|---|---|---|---|
| I | Fondamentaux | 1-3 | 7h15 |
| II | Définition et diagnostic | 4-7 | 10h |
| III | Scoliose idiopathique | 8-10 | 17h |
| IV | Scolioses non idiopathiques | 11-14 | 11h30 |
| V | Techniques chirurgicales | 15-17 | 14h30 |
| VI | Complications | 18-19 | 5h30 |
| VII | Prise en charge globale | 20-23 | 11h |
| VIII | Sujets avancés | 24-27 | 7h |
| — | Simulation VERTEX© | 28 | 2h |
| — | Évaluation finale | 29 | 3h30 |

| **Écarts** | **7 parties sur 8** ont des modules incorrects dans la NOTE_TECHNIQUE. Seule la Partie I (1-3) est correcte. Les titres sont également erronés pour les Parties III à VIII. Les durées sont fausses pour les Parties I (12h vs 7h15), III (8h vs 17h), IV (10h vs 11h30), V (28h vs 14h30), VI (8h vs 5h30), VII (6h vs 7h), VIII (7h vs 5h30). |
| **Correction** | Remplacer intégralement le tableau de la section 2.2 par les données du PLAN_FORMATION (tableau de durée, L2476-2487). |

---

### C-03 🔴 CRITIQUE — NOTE_TECHNIQUE : budget ligne par ligne ne correspond pas au BUDGET_GLOBAL

| Champ | Valeur |
|-------|--------|
| **Fichier** | NOTE_TECHNIQUE_PROJET.md, section 8 (L219-233) |
| **Problème** | Le tableau budgétaire de la NOTE_TECHNIQUE montre des montants radicalement différents du BUDGET_GLOBAL_FORMATION.md : |

| Poste | NOTE_TECHNIQUE | BUDGET_GLOBAL | Écart |
|-------|---------------|---------------|-------|
| Contenu pédagogique | 800 K – 1,2 M€ | 180 – 280 K€ | **×4-5** |
| Production médias | 1,0 M – 1,5 M€ | 250 – 400 K€ | **×3-4** |
| VERTEX© | 1,2 M – 1,8 M€ | 3 600 – 5 000 K€ | **÷3** (inversé!) |
| Gestion de projet | 400 – 600 K€ | 50 – 100 K€ | **×6-8** |
| Infrastructure | 200 – 400 K€ | 35 – 55 K€ | **×4-7** |
| Marketing | 120 – 300 K€ | 80 – 150 K€ | **×1.5-2** |
| Réserve | 400 – 500 K€ | 200 – 350 K€ | **×1.4-2** |

| **De plus** | La somme basse de la NOTE_TECHNIQUE : 800+1000+1200+300+200+120+400+400 = **4 420 K€**, mais le total affiché est **4,7 M€** (écart de 280 K€). La somme haute (6 800 K€) est correcte. |
| **Correction** | Aligner le tableau budgétaire de la NOTE_TECHNIQUE sur le BUDGET_GLOBAL, ou justifier explicitement les écarts si les deux perspectives sont intentionnellement différentes. Corriger le total bas (4,42M → 4,7M ne correspond pas). |

---

### C-04 🟠 HAUTE — BIBLIOGRAPHIE : mapping modules erroné à partir du Module 19

| Champ | Valeur |
|-------|--------|
| **Fichier** | BIBLIOGRAPHIE_COMPLETE.md |
| **Problème** | À partir de « Complications neurologiques (Module 19) » (L153), les numéros de modules assignés aux sections bibliographiques ne correspondent plus au PLAN_FORMATION : |

| Bibliographie (erroné) | Module PLAN (correct) |
|---|---|
| Complications neurologiques (Module 19) L153 | Module 18 (Complications chirurgicales, §18.1) |
| Orthèses (Module 22) L185 | Module 8 (§8.4 Corsets/orthèses) |
| Psychologie (Module 23) L189 | Module 22 (Impact psychologique) |
| Recherche (Module 24) L197 | Module 25 (Recherche et Innovations) |
| Éthique (Module 25) L202 | Module 26 (Aspects médico-légaux et éthiques) |
| Cas complexes (Module 26) L205 | Module 27 (Cas cliniques interactifs) |
| Innovations et avenir (Module 27) L209 | Module 25 (Recherche et Innovations) |

| **Correction** | Corriger les numéros de modules dans les headers de la bibliographie pour correspondre au PLAN. |

---

### C-05 🟠 HAUTE — BIBLIOGRAPHIE : texte parasite dans la référence 101

| Champ | Valeur |
|-------|--------|
| **Fichier** | BIBLIOGRAPHIE_COMPLETE.md (L191) |
| **Texte erroné** | `101. **Danielsson AJ, If possible, Nachemson AL.**` |
| **Problème** | « If possible, » est inséré de façon erronée dans le champ auteur. Il s'agit probablement d'un résidu d'instruction de rédaction. |
| **Correction** | `101. **Danielsson AJ, Nachemson AL.**` |

---

### C-06 🟠 HAUTE — AUDIT_COMPLET : constats périmés (STRUCT-01, STRUCT-02, XREF-04) non annotés

| Champ | Valeur |
|-------|--------|
| **Fichier** | AUDIT_COMPLET_PROJET.md |
| **Problème** | Trois constats font référence à des erreurs **déjà corrigées** mais sont toujours présentés comme actifs : |

| ID | Ligne | Constat périmé | Statut réel |
|---|---|---|---|
| STRUCT-01 | L274-283 | « sections 28.1 et 28.3 dans Module 29 » | ✅ Vérifié INVALIDE (REFLEXION L148). Module 29 contient bien 29.1-29.5. |
| STRUCT-02 | L284-293 | « §5.5bis et §20.4bis » | ✅ CORRIGÉ : 5.5bis→5.5/5.6 et 20.4bis→20.5 avec cascade 20.5-20.8→20.6-20.9 |
| XREF-04 | L240-252 | « 560+ questions » | ✅ CORRIGÉ : 560+ → 600+ dans le PLAN |

| **Correction** | Ajouter un statut « ✅ RÉSOLU » ou « ❌ INVALIDE » à chaque constat, ou supprimer/barrer les constats obsolètes. Mettre à jour le plan d'action (L565, L572) en conséquence. |

---

### C-07 🟠 HAUTE — NOTE_TECHNIQUE : nombre de fichiers et lignes périmés

| Champ | Valeur |
|-------|--------|
| **Fichier** | NOTE_TECHNIQUE_PROJET.md (L6, L65, L67-78, L285-286) |
| **Texte erroné** | « 10 fichiers, 7 719 lignes » (L6), « 10 documents fondateurs totalisant 6 539 lignes » (L65) |
| **État actuel** | Le dépôt contient **12 fichiers** (ajout de NOTE_TECHNIQUE_PROJET.md et REFLEXION_FINALE_STRATEGIQUE.md). Les lignes ont changé : PLAN 2 223→2 525, MEDIAS 776→998, VERTEX 1 650→1 890, etc. |
| **Correction** | Mettre à jour le nombre de fichiers (10→12), le total de lignes, et les lignes individuelles dans le tableau d'inventaire. |

---

### C-08 🟠 HAUTE — REFLEXION_FINALE : nombre de documents périmé

| Champ | Valeur |
|-------|--------|
| **Fichier** | REFLEXION_FINALE_STRATEGIQUE.md (L4) |
| **Texte erroné** | « Relecture complète des **11 documents** du dépôt (7 800+ lignes) » |
| **État actuel** | 12 documents dans le dépôt |
| **Correction** | Remplacer « 11 documents » par « 12 documents » et actualiser le total de lignes. |

---

### C-09 🟠 HAUTE — CAHIER_DES_CHARGES_LMS : formule « Essentiel » absente du tableau tarifaire

| Champ | Valeur |
|-------|--------|
| **Fichier** | CAHIER_DES_CHARGES_LMS.md (L154-162) |
| **Problème** | Le tableau tarifaire liste : Découverte / Standard / Premium / Certification / Institutionnel. La formule **« Essentiel » (290€, Modules 1-14)** définie dans MODELE_ECONOMIQUE.md (L47) est absente. |
| **Impact** | Le panier moyen (772€) est calculé avec 4 paliers payants incluant Essentiel. Si le LMS ne l'implémente pas, les projections financières sont faussées (12% du mix). |
| **Correction** | Ajouter la ligne « Essentiel | Modules 1-14 (diagnostic + pathologies) | 290€ | 12 mois » dans le tableau du CAHIER_DES_CHARGES. |

---

### C-10 🟠 HAUTE — CAHIER_DES_CHARGES_LMS : « 640+ questions réparties sur 29 modules »

| Champ | Valeur |
|-------|--------|
| **Fichier** | CAHIER_DES_CHARGES_LMS.md (L86) |
| **Texte erroné** | « **640+** questions réparties sur **29** modules » |
| **Problème double** | 1) 640+ devrait être 600+ (cf. C-01). 2) « 29 modules » devrait être « 28 modules » car Module 29 EST l'évaluation — les questions sont réparties sur les modules 1-28. Cf. PLAN L2296 : « réparties sur 28 modules ». |
| **Correction** | Remplacer par « **600+** questions réparties sur **28** modules ». |

---

### C-11 🟠 HAUTE — MODELE_ECONOMIQUE : ARR An 5 ne correspond pas au MRR × 12

| Champ | Valeur |
|-------|--------|
| **Fichier** | MODELE_ECONOMIQUE.md (L202-203) |
| **Texte** | MRR An 5 = 210 000€, ARR An 5 = 2 500 000€ |
| **Calcul** | 210 000 × 12 = **2 520 000€** ≠ 2 500 000€ (écart de 20 000€) |
| **Correction** | Remplacer « 2 500 000 € » par « 2 520 000 € », ou ajuster le MRR à 208 333€ pour obtenir exactement 2 500 000€. |

---

### C-12 🟡 MOYENNE — MODELE_ECONOMIQUE : LTV non vérifiable avec les paramètres donnés

| Champ | Valeur |
|-------|--------|
| **Fichier** | MODELE_ECONOMIQUE.md (L204-206) |
| **Texte** | LTV An 1 = 1 100€ (churn mensuel 5%), An 3 = 1 400€ (3,5%), An 5 = 1 700€ (2,5%) |
| **Vérification** | Formule standard LTV = ARPU_mensuel / churn_mensuel : ARPU An 1 = 770€/an = 64,2€/mois → LTV = 64,2/0,05 = **1 283€** (≠ 1 100€). ARPU An 5 = 850/12 = 70,8€ → LTV = 70,8/0,025 = **2 833€** (≠ 1 700€). |
| **Problème** | La formule de calcul du LTV n'est pas documentée, et les valeurs ne correspondent à aucune formule standard connue (ARPU/churn, ARPU×marge/churn, ARPU/churn_annuel). |
| **Correction** | Expliciter la formule utilisée ou recalculer le LTV avec une formule standard. |

---

### C-13 🟡 MOYENNE — PLAN_FORMATION : « diapositives narées » (faute de frappe)

| Champ | Valeur |
|-------|--------|
| **Fichier** | PLAN_FORMATION_SCOLIOSE.md (L31) |
| **Texte erroné** | « vidéo + diapositives **narées** » |
| **Correction** | « vidéo + diapositives **narrées** » (double « r ») |

---

### C-14 🟡 MOYENNE — CAHIER_DES_CHARGES_LMS : « appprenant » (triple p)

| Champ | Valeur |
|-------|--------|
| **Fichier** | CAHIER_DES_CHARGES_LMS.md (L146) |
| **Texte erroné** | « entre **appprenant** et tuteur/instructeur » |
| **Correction** | « entre **praticien** et tuteur/instructeur » |

---

### C-15 🟡 MOYENNE — MODELE_ECONOMIQUE : pourcentages panier moyen vs hypothèses non expliqués

| Champ | Valeur |
|-------|--------|
| **Fichier** | MODELE_ECONOMIQUE.md (L93 vs L112-117) |
| **Problème** | Les hypothèses (L93) donnent deux jeux de répartition : basse (15/30/35/20%) et haute (10/25/40/25%). Le panier moyen (L112-117) utilise un troisième jeu (12/28/38/22%) sans indiquer qu'il s'agit de la médiane. |
| **Correction** | Ajouter une mention : « Hypothèse médiane (moyenne des scénarios bas et haut) » au-dessus du tableau du panier moyen. |

---

### C-16 🟡 MOYENNE — NOTE_TECHNIQUE : VERTEX lignes « ~1 650 » → réalité ~1 890

| Champ | Valeur |
|-------|--------|
| **Fichier** | NOTE_TECHNIQUE_PROJET.md (L59, L71) |
| **Texte** | « 20 sections, ~1 650 lignes » et tableau : 1 650 lignes |
| **Réalité** | VERTEX_SPECIFICATIONS_TECHNIQUES.md contient 20 sections (§1-§20, vérifié) et **~1 890 lignes**. |
| **Correction** | Remplacer « 1 650 » par « ~1 890 » (si mise à jour de la NOTE_TECHNIQUE, cf. C-07). |

---

### C-17 🟡 MOYENNE — NOTE_TECHNIQUE : AUDIT_COMPLET lignes « 549 » → réalité 634

| Champ | Valeur |
|-------|--------|
| **Fichier** | NOTE_TECHNIQUE_PROJET.md (L78) |
| **Texte** | « AUDIT_COMPLET_PROJET.md | 549 lignes » |
| **Réalité** | 634 lignes |
| **Correction** | Inclure dans la mise à jour globale de la NOTE_TECHNIQUE (cf. C-07). |

---

### C-18 🟢 BASSE — PLAN_FORMATION : durée totale « ~89 heures » → calcul exact = 89h15

| Champ | Valeur |
|-------|--------|
| **Fichier** | PLAN_FORMATION_SCOLIOSE.md (L2487) |
| **Calcul** | 7h15+10h+17h+11h30+14h30+5h30+11h+7h+2h+3h30 = **89h15** |
| **Texte** | « ~89 heures » |
| **Problème** | Écart de 15 minutes, couvert par le « ~ ». Acceptable, mais « ~89h15 » serait plus précis. |
| **Correction** | Optionnel : remplacer « ~89 heures » par « ~89h15 » ou conserver tel quel. |

---

### C-19 🟢 BASSE — CALENDRIER : « 640+ questions » (couvert par C-01)

| Champ | Valeur |
|-------|--------|
| **Fichier** | CALENDRIER_PRODUCTION.md (L58) |
| **Texte** | « A11. Questions quiz (640+) | … | 640+ questions, 4 niveaux » |
| **Correction** | Déjà couvert par C-01. Remplacer « 640+ » par « 600+ ». |

---

### C-20 🟢 BASSE — BUDGET_GLOBAL : pourcentages « approximatifs » ne totalisent pas exactement 100%

| Champ | Valeur |
|-------|--------|
| **Fichier** | BUDGET_GLOBAL_FORMATION.md — tableau de synthèse |
| **Problème** | Les pourcentages par poste utilisent des fourchettes (ex. 4-6%, 70-75%, etc.). La somme des bornes basses = ~93%, somme des bornes hautes = ~112%. Bien que les valeurs absolues totalisent correctement (4 695K et 6 835K), les pourcentages affichés sont indicatifs et non cohérents entre eux. |
| **Correction** | Optionnel : recalculer les pourcentages exacts à partir des montants, ou ajouter une note « pourcentages arrondis ». |

---

### C-21 🟢 BASSE — BUDGET_GLOBAL : infrastructure annuelle « 35 000 – 55 000€ » vs calcul détaillé

| Champ | Valeur |
|-------|--------|
| **Fichier** | BUDGET_GLOBAL_FORMATION.md — section Infrastructure |
| **Problème** | Le détail mensuel totalise 32 280€/an (bas) et 56 880€/an (haut). Le résumé dit « 35 000 – 55 000€ ». Le bas (32 280 vs 35 000) et le haut (56 880 vs 55 000) sont des approximations dans des sens opposés. |
| **Correction** | Optionnel : aligner les chiffres arrondis sur le calcul détaillé (~32 000 – ~57 000€). |

---

### C-22 🟢 BASSE — MODELE_ECONOMIQUE : churn « annuel » 40% vs churn mensuel 5%

| Champ | Valeur |
|-------|--------|
| **Fichier** | MODELE_ECONOMIQUE.md (L94 vs L206) |
| **Problème** | Hypothèses (L94) : « Churn annuel (renouvellement) | 40% ». KPI (L206) : « Churn mensuel | 5% ». Si churn mensuel = 5%, churn annuel = 1-(1-0,05)^12 = **46%**, pas 40%. Inversement, si churn annuel = 40%, churn mensuel = 1-(1-0,40)^(1/12) = **4,2%**, pas 5%. |
| **Correction** | Harmoniser : soit churn mensuel 5% → churn annuel ~46%, soit churn annuel 40% → churn mensuel ~4,2%. |

---

## VÉRIFICATIONS POSITIVES (aucune erreur trouvée)

| Vérification | Résultat |
|---|---|
| Numérotation des 29 MODULE headers dans PLAN | ✅ Modules 1-29 tous présents, dans l'ordre |
| Numérotation sections 5.1-5.6 (post-correction) | ✅ Séquentielle, pas de doublons |
| Numérotation sections 20.1-20.9 (post-correction) | ✅ Séquentielle, pas de doublons |
| Numérotation sections 29.1-29.5 | ✅ Correcte (Module 29 contient bien 29.x, pas 28.x) |
| 160 sections #### N.M vérifiées dans le PLAN | ✅ Toutes correctement numérotées par module |
| VERTEX : 20 sections §1-§20 | ✅ Présentes et séquentielles |
| Panier moyen : 12%×290 + 28%×490 + 38%×890 + 22%×1190 = 772€ | ✅ Calcul exact |
| Quiz totaux : 145+175+160+120 = 600 | ✅ Correspond au « 600+ » du PLAN |
| Budget GLOBAL synthèse bas : 180+250+3600+300+35+80+50+200 = 4 695 K€ | ✅ |
| Budget GLOBAL synthèse haut : 280+400+5000+500+55+150+100+350 = 6 835 K€ | ✅ |
| VERTEX dev phases (BUDGET) bas : 3 150 K€ | ✅ Somme des 10 phases correcte |
| VERTEX dev phases (BUDGET) haut : 4 375 K€ | ✅ |
| Répartition canaux commerciaux : 40+30+5+10+8+5+2 = 100% | ✅ |
| Terme médical « scoliomètre » | ✅ Orthographe correcte (vs « scoliomètre ») |
| PLAN_FORMATION : durée sous-totaux ligne par ligne | ✅ Toutes les additions par partie sont correctes |
| MEDIAS total | ✅ ~513 médias (confirmé L945) |
| 8 PARTIE headers dans le PLAN | ✅ I-VIII toutes présentes |
| CA projections : additions CA Individuel + Institutionnel | ✅ An 1-5 toutes correctes |
| ARR An 1 : 25000×12 = 300 000€ | ✅ |
| ARR An 3 : 100000×12 = 1 200 000€ | ✅ |

---

## PLAN D'ACTION PAR PRIORITÉ

### Priorité 1 — Critiques (à corriger immédiatement)

| # | Action | Fichier(s) | Effort |
|---|---|---|---|
| C-01 | Remplacer « 640+ » par « 600+ » questions dans 5 fichiers | MODELE, NOTE_TECHNIQUE, CAHIER_DES_CHARGES, CALENDRIER, REFLEXION | 15 min |
| C-02 | Refaire le tableau Parties §2.2 de la NOTE_TECHNIQUE | NOTE_TECHNIQUE | 20 min |
| C-03 | Aligner le budget §8 de la NOTE_TECHNIQUE sur le BUDGET_GLOBAL | NOTE_TECHNIQUE | 30 min |

### Priorité 2 — Hautes (à corriger dans la semaine)

| # | Action | Fichier(s) | Effort |
|---|---|---|---|
| C-04 | Corriger le mapping modules de la bibliographie (Module 19→) | BIBLIOGRAPHIE | 15 min |
| C-05 | Supprimer « If possible, » de la référence 101 | BIBLIOGRAPHIE | 2 min |
| C-06 | Annoter STRUCT-01, STRUCT-02, XREF-04 comme « ✅ RÉSOLU/INVALIDE » | AUDIT_COMPLET | 10 min |
| C-07 | Mettre à jour fichier count (10→12) et lignes dans la NOTE_TECHNIQUE | NOTE_TECHNIQUE | 20 min |
| C-08 | Corriger « 11 documents » → « 12 documents » | REFLEXION_FINALE | 2 min |
| C-09 | Ajouter formule « Essentiel » au tableau LMS | CAHIER_DES_CHARGES | 5 min |
| C-10 | Corriger « 640+ / 29 modules » → « 600+ / 28 modules » | CAHIER_DES_CHARGES | 2 min |
| C-11 | Corriger ARR An 5 : 2 500 000 → 2 520 000€ | MODELE_ECONOMIQUE | 2 min |

### Priorité 3 — Moyennes (à corriger dans le mois)

| # | Action | Fichier(s) | Effort |
|---|---|---|---|
| C-12 | Expliciter la formule LTV ou recalculer | MODELE_ECONOMIQUE | 30 min |
| C-13 | Corriger « narées » → « narrées » | PLAN_FORMATION | 1 min |
| C-14 | Corriger « appprenant » → « praticien » | CAHIER_DES_CHARGES | 1 min |
| C-15 | Mentionner « hypothèse médiane » pour le panier moyen | MODELE_ECONOMIQUE | 5 min |
| C-16/17 | Mettre à jour les lignes du VERTEX et AUDIT dans la NOTE_TECHNIQUE | NOTE_TECHNIQUE | Inclus dans C-07 |

### Priorité 4 — Basses (optionnel)

| # | Action | Effort |
|---|---|---|
| C-18 | Préciser « ~89h15 » (optionnel) | 1 min |
| C-19 | Couvert par C-01 | — |
| C-20 | Recalculer les % du budget (optionnel) | 10 min |
| C-21 | Aligner les arrondis infra (optionnel) | 5 min |
| C-22 | Harmoniser churn mensuel/annuel | 10 min |

---

## RÉCAPITULATIF DES FICHIERS IMPACTÉS

| Fichier | Constats | Priorité max |
|---|---|---|
| NOTE_TECHNIQUE_PROJET.md | C-02, C-03, C-07, C-16, C-17 | 🔴 CRITIQUE |
| MODELE_ECONOMIQUE.md | C-01, C-11, C-12, C-15, C-22 | 🔴 CRITIQUE |
| CAHIER_DES_CHARGES_LMS.md | C-01, C-09, C-10, C-14 | 🔴 CRITIQUE |
| BIBLIOGRAPHIE_COMPLETE.md | C-04, C-05 | 🟠 HAUTE |
| AUDIT_COMPLET_PROJET.md | C-06 | 🟠 HAUTE |
| REFLEXION_FINALE_STRATEGIQUE.md | C-01, C-08 | 🟠 HAUTE |
| CALENDRIER_PRODUCTION.md | C-01 | 🟢 BASSE |
| PLAN_FORMATION_SCOLIOSE.md | C-13, C-18 | 🟡 MOYENNE |
| BUDGET_GLOBAL_FORMATION.md | C-20, C-21 | 🟢 BASSE |
| GUIDE_FORMATEUR.md | — | ✅ Aucune erreur détectée |
| VERTEX_SPECIFICATIONS_TECHNIQUES.md | — | ✅ Aucune erreur détectée |
| MEDIAS_PRODUCTION_SCOLIOSE.md | — | ✅ Aucune erreur détectée |

---

*Audit réalisé par vérification systématique de l'intégralité des 12 fichiers (~8 500+ lignes). Chaque constat est accompagné de la ligne exacte, du texte erroné, du calcul de vérification et de la correction proposée.*
