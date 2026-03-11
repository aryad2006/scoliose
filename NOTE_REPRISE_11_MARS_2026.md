# NOTE DE REPRISE — 11 mars 2026 (mise à jour)

**Projet** : VERTEX© — Formations médicales e-learning  
**Dépôt** : aryad2006/scoliose (branche main)  
**Dernière session** : 11 mars 2026  
**Mise à jour** : 11 mars 2026 — session 2 (cas cliniques)

---

## HISTORIQUE DES SESSIONS

### Session précédente (avant 11 mars 2026)

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

**Caractéristiques** :
- Chaque cas : présentation → ATCD → examen clinique → investigations → 5-7 questions progressives → réponses argumentées → points d'apprentissage
- **47 tags `> [MEDIA: 📷/📐 MXX-SYY-ZZZ — Description]`** insérés inline dans les sections investigations et contexte peropératoire
- Références croisées aux modules (Module 1-25)
- Cas pluridisciplinaires : cas 15 (DMD : pneumo/cardio/neuro/ortho), cas 17 (gériatrie multi-spécialités), cas 20 (infectiologie)
- Cas décision partagée : cas 12 (Marfan), cas 15 (DMD), cas 17 (adulte âgé)
- CAT structurées dans chaque réponse

#### 2. Règle « médias dans les cas cliniques » — ENREGISTRÉE ✅

Nouvelle règle persistante (sauvée en mémoire) applicable à TOUTES les formations :
> **TOUJOURS intégrer des tags `> [MEDIA: 📷/📐/🎬 MXX-SYY-ZZZ — Description]` directement dans le flux du texte des cas cliniques**, au sein des sections Investigations, Examen clinique, et Réponses. Ne JAMAIS laisser une description textuelle d'imagerie sans tag MEDIA associé.

#### 3. Règle « création fichiers longs par parties » — ENREGISTRÉE ✅

Pour les fichiers > 500 lignes, créer le fichier en parties successives (Partie 1/4, 2/4…) pour éviter les pertes de contexte.

---

## CE QUI RESTE À FAIRE

### Priorité 1 — Créer les 4 cahiers de cas cliniques restants

| # | Fichier | Répertoire | Min. cas | Statut |
|---|---------|------------|----------|--------|
| 1 | `CAS_CLINIQUES_PTG.md` | `cours-ptg/` | 15-24 | 🔲 À faire |
| 2 | `CAS_CLINIQUES_IOA.md` | `cours-infection-osseuse/` | 15-24 | 🔲 À faire |
| 3 | `CAS_CLINIQUES_TENDINITES.md` | `cours-tendinites/` | 15-24 | 🔲 À faire |
| 4 | `CAS_CLINIQUES_OBO.md` | `cours-obesite-orthopedie/` | 15-24 | 🔲 À faire |

**Rappels importants pour la suite** :
- Appliquer la règle des tags MEDIA dès la rédaction (ne pas les ajouter après coup)
- Créer chaque fichier en parties (règle fichiers longs)
- Chaque formation possède son propre catalogue médias (à créer ou consulter : `MEDIAS_PRODUCTION_{FORMATION}.md`)
- Respecter la distribution : 5-8 Bronze, 5-8 Argent, 3-5 Or, 2-3 Diamant
- Structure PTG : 7 parties CDC (Fondamentaux, Pathologies, Implants, Planification/Chirurgie, Résultats/Complications, Reprises, Rééducation/Innovations)
- Structure IOA : 10 parties CDC (Introduction, Histoire, Immunologie, Diagnostic, Antibiothérapie, Ostéomyélite, IPP, Infections spécifiques, Chirurgie, Prévention)
- Structure OBO : 9 parties CDC (Introduction, Fondamentaux, Traitement, Biomécanique, Arthroplastie, Rachis, Traumatologie, Périopératoire, Populations/Éthique)

### Priorité 2 — Git push final

Après création de tous les cahiers, commit et push global.

---

## ÉTAT DES 5 FORMATIONS VERTEX©

| Formation | Modules | CDC | Cas cliniques | Statut global |
|-----------|---------|-----|---------------|--------------|
| Scoliose | 25+ modules | ✅ | ✅ 20 cas (47 médias) | **95%** |
| PTG | 7 CDC | ✅ | 🔲 À faire | 90% |
| IOA | 10 CDC | ✅ | 🔲 À faire | 90% |
| Tendinites | 9 CDC | ✅ | 🔲 À faire | 90% |
| Obésité et Orthopédie | 25 modules / 9 CDC | ✅ | 🔲 À faire | 90% |

---

## POUR REPRENDRE

1. Lire cette note en premier
2. Lire `REGLES_ECRITURE_CONTENU.md` Section 14 pour les spécifications
3. Consulter `cours-scoliose/CAS_CLINIQUES_SCOLIOSE.md` comme **modèle de référence** pour les autres formations
4. Suivre l'ordre : PTG → IOA → Tendinites → Obésité
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

*Note de reprise — 11 mars 2026 — mise à jour session 2*
