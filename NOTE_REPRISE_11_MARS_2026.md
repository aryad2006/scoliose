# NOTE DE REPRISE — 17 mars 2026 (mise à jour)

**Projet** : VERTEX© — Formations médicales e-learning
**Dépôt** : aryad2006/scoliose (branche main)
**Dernière session** : 17 mars 2026
**Mise à jour** : 17 mars 2026 — inventaire complet et mémoire Claude configurée

---

## ÉTAT COMPLET DES 12 FORMATIONS VERTEX©

### Formations orthopédiques (les 5 originales)

| # | Formation | Répertoire | Modules/CDC | Cas cliniques | Avancement |
|---|-----------|-----------|-------------|---------------|------------|
| 1 | **Scoliose** | cours-scoliose/ | 25 modules (M01→M25) | ✅ 20 cas (~2 700 lignes) | **95%** |
| 2 | **Prothèse Totale Genou** | cours-ptg/ | 7 CDC (+ intro) | ✅ 20 cas (~3 200 lignes) | **95%** |
| 3 | **Infections Ostéo-Articulaires** | cours-infection-osseuse/ | 10 CDC (+ intro) | ✅ 20 cas (~5 000 lignes) | **95%** |
| 4 | **Tendinites** | cours-tendinites/ | 9 CDC (+ intro) + complet | 🔲 **À FAIRE** | **90%** |
| 5 | **Obésité et Orthopédie** | cours-obesite-orthopedie/ | 9 CDC (+ intro) + complet | 🔲 **À FAIRE** | **90%** |

### Formations médicales (ajoutées mars 2026)

| # | Formation | Répertoire | Modules/CDC | Cas cliniques | Avancement |
|---|-----------|-----------|-------------|---------------|------------|
| 6 | **Diabétologie** | cours-diabetologie/ | 12 CDC (00→11) + complet | ✅ ~20 cas (4 parties + complet) + quiz | **95%** |
| 7 | **HTA** | cours-hta/ | 12 CDC (00→11) + complet | ✅ 35 cas (5 parties) | **95%** |
| 8 | **Hypothyroïdies** | cours-hypothyroidie/ | 12 CDC (00→11) | ✅ 30 cas (3 parties) | **95%** |
| 9 | **Hyperthyroïdies** | cours-hyperthyroidie/ | 12 CDC (00→11) | ✅ 30 cas (3 parties) | **95%** |

### Formations spéciales

| # | Formation | Répertoire | Modules/CDC | Cas cliniques | Avancement |
|---|-----------|-----------|-------------|---------------|------------|
| 10 | **Histoire de l'Orthopédie** | cours-histoire-orthopedie/ | 9 CDC (00→08) + complet | N/A (pas de cas cliniques) | **100%** |
| 11 | **FIV** | cours-fiv/ | 3 CDC (00→02) | 🔲 À faire | **20%** |
| 12 | **Formations futures** | a-venir/ | Planning | — | Planning |

---

## CE QUI RESTE À FAIRE

### Priorité 1 — Cas cliniques manquants (formations ortho)

| # | Fichier | Répertoire | Min. cas | Statut |
|---|---------|------------|----------|--------|
| 1 | `CAS_CLINIQUES_TENDINITES.md` | cours-tendinites/ | 15-24 | 🔲 À faire |
| 2 | `CAS_CLINIQUES_OBO.md` | cours-obesite-orthopedie/ | 15-24 | 🔲 À faire |

### Priorité 2 — Formation FIV (en cours)

- 3 modules créés (intro + histoire + fondamentaux)
- Reste : modules 03 à ~10 + cas cliniques
- Structure CDC à compléter

### Priorité 3 — Finitions

- Mettre les 5 formations ortho à 100% (relecture, cohérence inter-modules)
- Git push final après chaque lot de travail

---

## HISTORIQUE DES SESSIONS

### Avant 11 mars 2026
- ✅ 5 formations CDC complètes (Scoliose, PTG, IOA, Tendinites, Obésité)
- ✅ Section 14 « Cas cliniques progressifs » ajoutée aux REGLES_ECRITURE_CONTENU.md

### 11 mars 2026
- ✅ CAS_CLINIQUES_SCOLIOSE.md — 20 cas, ~2 700 lignes

### 12 mars 2026
- ✅ CAS_CLINIQUES_PTG.md — 20 cas, ~3 200 lignes

### 13 mars 2026
- ✅ CAS_CLINIQUES_IOA.md — 20 cas, ~5 000 lignes

### 14-16 mars 2026
- ✅ Formation Diabétologie complète (12 CDC + cas cliniques 4 parties + quiz)
- ✅ Formation HTA complète (12 CDC + 35 cas cliniques 5 parties)
- ✅ Formation Hypothyroïdies complète (12 CDC + 30 cas cliniques 3 parties)
- ✅ Formation Hyperthyroïdies complète (12 CDC + 30 cas cliniques 3 parties)
- ✅ Formation Histoire de l'Orthopédie complète (9 CDC)
- ✅ Formation FIV commencée (intro + 2 modules)
- ✅ Script convert_to_docx.py (conversion MD→DOCX)
- ✅ Fix alertmanager.yml (monitoring)

### 17 mars 2026
- ✅ Mémoire Claude configurée (4 fichiers mémoire projet)
- ✅ Settings globaux + projet configurés (auto-permissions)
- ✅ CLAUDE.md global créé (~/.claude/CLAUDE.md)
- ✅ Note de reprise mise à jour avec inventaire complet

---

## CONVENTIONS & RÈGLES ACTIVES

| Règle | Source | Description |
|-------|--------|-------------|
| Tags MEDIA obligatoires | Mémoire repo | `> [MEDIA: 📷/📐/🎬 MXX-SYY-ZZZ — Description]` inline dans tout texte d'imagerie |
| Fichiers longs par parties | Mémoire repo | Créer en N parties pour fichiers > 500 lignes |
| Section 14 | REGLES v3.1 | Spécifications cas cliniques (niveaux, structure, checklist 26-33) |
| Pas de plagiat | Mémoire repo | Adapter depuis la littérature, ne pas copier |
| Nommage | Section 14 | `CAS_CLINIQUES_{NOM_FORMATION}.md` dans le répertoire formation |
| Terminologie | REGLES §0 | « praticien » — jamais « apprenant » |

---

## POUR REPRENDRE

1. La mémoire Claude est configurée — pas besoin de relire cette note en détail
2. Prochaine tâche : **CAS_CLINIQUES_TENDINITES.md** (cours-tendinites/)
3. Modèle de référence : `CAS_CLINIQUES_IOA.md`
4. Consulter les 9 CDC Tendinites avant de rédiger
5. Créer par parties (P1, P2, P3…)
6. Tags MEDIA dès la rédaction
7. Distribution : 5-8 Bronze, 5-8 Argent, 3-5 Or, 2-3 Diamant

---

*Note de reprise — 17 mars 2026 — inventaire complet 12 formations*
