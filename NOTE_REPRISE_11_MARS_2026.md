# NOTE DE REPRISE — 12 mars 2026 (mise à jour)

**Projet** : VERTEX© — Formations médicales e-learning
**Dépôt** : aryad2006/scoliose (branche main)
**Dernière session** : 12 mars 2026
**Mise à jour** : 12 mars 2026 — session 3 (cas cliniques PTG)

---

## HISTORIQUE DES SESSIONS

### Sessions précédentes (avant 11 mars 2026)

- ✅ 5 formations CDC complètes (Scoliose, PTG, IOA, Tendinites, Obésité)
- ✅ Formation Obésité (commit `3ce04a8`)
- ✅ Section 14 « Cas cliniques progressifs » ajoutée aux REGLES_ECRITURE_CONTENU.md
- ✅ `à-venir/FORMATIONS_FUTURES_VERTEX.md` mis à jour

### Session du 11 mars 2026 — CE QUI A ÉTÉ FAIT ✅

#### 1. CAS_CLINIQUES_SCOLIOSE.md — CRÉÉ ET COMPLET ✅

**Fichier** : `cours-scoliose/CAS_CLINIQUES_SCOLIOSE.md`
**Volume** : ~2 700 lignes, 20 cas cliniques complets

| Niveau | Nb cas | Thématiques |
|--------|--------|-------------|
| 🥉 Bronze (1-7) | 7 | SIA dépistage, Scheuermann, spondylolisthésis, cyphose posturale, hernie discale, fracture ostéoporotique, fracture burst |
| 🥈 Argent (8-13) | 6 | Ostéome ostéoïde, scoliose infantile, NF1 dystrophique, sténose dégénérative, Marfan, déséquilibre sagittal |
| 🥇 Or (14-17) | 4 | SIA sévère Lenke, DMD neuromusculaire, scoliose congénitale, scoliose dégénérative complexe |
| 💎 Diamant (18-20) | 3 | Déficit neurologique peropératoire, pseudarthrose/PJK, infection post-arthrodèse |

#### 2. Règles enregistrées ✅

- Tags MEDIA obligatoires dans les cas cliniques
- Création fichiers longs par parties (> 500 lignes)

### Session du 12 mars 2026 — CE QUI A ÉTÉ FAIT ✅

#### 1. CAS_CLINIQUES_PTG.md — CRÉÉ ET COMPLET ✅

**Fichier** : `cours-ptg/CAS_CLINIQUES_PTG.md`
**Volume** : ~3 200 lignes, 20 cas cliniques complets

| Niveau | Nb cas | Thématiques |
|--------|--------|-------------|
| 🥉 Bronze (1-7) | 7 | Gonarthrose typique, bilan imagerie, indication PTG vs conservateur, choix CR/PS, rééducation RAAC, genu varum bilatéral, PUC vs PTG |
| 🥈 Argent (8-13) | 6 | PR et immunosuppresseurs, ostéonécrose Ahlbäck, raideur post-PTG, obésité morbide, gonarthrose post-traumatique + matériel, TVP/EP |
| 🥇 Or (14-17) | 4 | Valgum sévère + nerf fibulaire, PTG bilatérale + comorbidités, instabilité CR récidivante, robotique vs conventionnelle |
| 💎 Diamant (18-20) | 3 | Infection périprothétique chronique (2 temps), fracture périprothétique supracondylienne, descellement + perte osseuse AORI 3 |

**Caractéristiques** :
- Chaque cas : présentation → ATCD → examen clinique → investigations → 5-7 questions progressives → réponses argumentées → points d'apprentissage
- **~50 tags `> [MEDIA: 📷/📐 MPTGXX-SYY-ZZZ — Description]`** insérés inline
- Références croisées aux modules PTG (Modules 1-28)
- Cas pluridisciplinaires : cas 8 (rhumatologie), cas 13 (médecine vasculaire), cas 15 (cardiologie/pneumologie), cas 18 (infectiologie), cas 19 (gériatrie)
- Cas décision partagée : cas 3 (patient jeune demandeur), cas 11 (obésité morbide), cas 15 (PTG bilatérale)
- CAT structurées dans chaque réponse
- Couverture des 28 modules de la formation PTG

---

## CE QUI RESTE À FAIRE

### Priorité 1 — Créer les 3 cahiers de cas cliniques restants

| # | Fichier | Répertoire | Min. cas | Statut |
|---|---------|------------|----------|--------|
| 1 | `CAS_CLINIQUES_IOA.md` | `cours-infection-osseuse/` | 15-24 | 🔲 À faire |
| 2 | `CAS_CLINIQUES_TENDINITES.md` | `cours-tendinites/` | 15-24 | 🔲 À faire |
| 3 | `CAS_CLINIQUES_OBO.md` | `cours-obesite-orthopedie/` | 15-24 | 🔲 À faire |

**Rappels importants pour la suite** :
- Appliquer la règle des tags MEDIA dès la rédaction (ne pas les ajouter après coup)
- Créer chaque fichier en parties (règle fichiers longs)
- Chaque formation possède son propre catalogue médias (à créer ou consulter : `MEDIAS_PRODUCTION_{FORMATION}.md`)
- Respecter la distribution : 5-8 Bronze, 5-8 Argent, 3-5 Or, 2-3 Diamant
- Structure IOA : 10 parties CDC (Introduction, Histoire, Immunologie, Diagnostic, Antibiothérapie, Ostéomyélite, IPP, Infections spécifiques, Chirurgie, Prévention)
- Structure Tendinites : 9 parties CDC
- Structure OBO : 9 parties CDC (Introduction, Fondamentaux, Traitement, Biomécanique, Arthroplastie, Rachis, Traumatologie, Périopératoire, Populations/Éthique)
- **Modèles de référence** : `CAS_CLINIQUES_SCOLIOSE.md` et `CAS_CLINIQUES_PTG.md`

### Priorité 2 — Git push final

Après création de tous les cahiers, commit et push global.

---

## ÉTAT DES 5 FORMATIONS VERTEX©

| Formation | Modules | CDC | Cas cliniques | Statut global |
|-----------|---------|-----|---------------|--------------|
| Scoliose | 25+ modules | ✅ | ✅ 20 cas (47 médias) | **95%** |
| PTG | 28 modules / 7 CDC | ✅ | ✅ 20 cas (~50 médias) | **95%** |
| IOA | 10 CDC | ✅ | 🔲 À faire | 90% |
| Tendinites | 9 CDC | ✅ | 🔲 À faire | 90% |
| Obésité et Orthopédie | 25 modules / 9 CDC | ✅ | 🔲 À faire | 90% |

---

## POUR REPRENDRE

1. Lire cette note en premier
2. Lire `REGLES_ECRITURE_CONTENU.md` Section 14 pour les spécifications
3. Consulter `CAS_CLINIQUES_SCOLIOSE.md` et `CAS_CLINIQUES_PTG.md` comme **modèles de référence**
4. Suivre l'ordre : IOA → Tendinites → Obésité
5. Pour chaque formation : consulter les CDC correspondants + catalogue médias
6. Intégrer les tags MEDIA dès la rédaction
7. Créer par parties (Partie 1/N, 2/N…)
8. Git commit + push à la fin de chaque session

---

## CONVENTIONS & RÈGLES ACTIVES

| Règle | Source | Description |
|-------|--------|-------------|
| Tags MEDIA obligatoires | Mémoire repo | `> [MEDIA: 📷/📐/🎬 MXX-SYY-ZZZ — Description]` inline dans tout texte d'imagerie |
| Fichiers longs par parties | Mémoire repo | Créer en N parties pour fichiers > 500 lignes |
| Section 14 | REGLES v3.1 | Spécifications cas cliniques (niveaux, structure, checklist 26-33) |
| Pas de plagiat | Mémoire repo | Adapter depuis la littérature, ne pas copier |
| Nommage | Section 14 | `CAS_CLINIQUES_{NOM_FORMATION}.md` dans le répertoire formation |

---

*Note de reprise — 12 mars 2026 — mise à jour session 3*
