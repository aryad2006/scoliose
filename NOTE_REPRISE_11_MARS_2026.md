# NOTE DE REPRISE — 21 mars 2026

**Projet** : VERTEX© (Virtual Environment for Real-Time EXpertise) — Formations médicales e-learning multi-spécialités
**Dépôt** : aryad2006/scoliose (branche main)
**Dernière session** : 21 mars 2026
**Mise à jour** : 21 mars 2026 — déploiement Moodle complet (12 formations)

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
| 8 | **Hypothyroïdies** | cours-hypothyroidie/ | 12 CDC (00→11) | ✅ 30 cas (3 parties) + quiz 100q | **98%** |
| 9 | **Hyperthyroïdies** | cours-hyperthyroidie/ | 12 CDC (00→11) | ✅ 30 cas (3 parties) + quiz 100q | **98%** |

### Formations spéciales

| # | Formation | Répertoire | Modules/CDC | Cas cliniques | Avancement |
|---|-----------|-----------|-------------|---------------|------------|
| 10 | **Histoire de l'Orthopédie** | cours-histoire-orthopedie/ | 9 CDC (00→08) + complet | N/A (pas de cas cliniques) | **100%** |
| 11 | **FIV** | cours-fiv/ | 14 CDC (00→13) | ✅ 24 cas (3 parties) + quiz 110q | **98%** |
| 12 | **LCA (Ligament Croisé Antérieur)** | cours-lca/ | 1 CDC (00 intro) | 🔲 À faire | **10%** |
| 13 | **Formations futures** | a-venir/ | Planning | — | Planning |

---

## CE QUI RESTE À FAIRE

### Priorité 1 — Cas cliniques manquants (formations ortho)

| # | Fichier | Répertoire | Min. cas | Statut |
|---|---------|------------|----------|--------|
| 1 | `CAS_CLINIQUES_TENDINITES.md` | cours-tendinites/ | 15-24 | 🔲 À faire |
| 2 | `CAS_CLINIQUES_OBO.md` | cours-obesite-orthopedie/ | 15-24 | 🔲 À faire |

### Priorité 2 — Formation LCA (en cours)

- 1 CDC intro rédigé (CDC_LCA_00), reste à produire les modules suivants
- Pas encore de cas cliniques ni de quiz

### Priorité 3 — Quiz manquants

| Formation | Quiz | Statut |
|-----------|------|--------|
| Diabétologie | QUIZ_DIABETOLOGIE.md (99q) | ✅ |
| FIV | QUIZ_FIV.md (110q) | ✅ |
| Hypothyroïdies | QUIZ_HYPOTHYROIDIE.md (100q) | ✅ |
| Hyperthyroïdies | QUIZ_HYPERTHYROIDIE.md (100q) | ✅ |
| HTA | — | 🔲 À faire |
| Scoliose | — | 🔲 À faire |
| PTG | — | 🔲 À faire |
| IOA | — | 🔲 À faire |
| Tendinites | — | 🔲 À faire |
| Obésité-Orthopédie | — | 🔲 À faire |

### Priorité 4 — Finitions

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

### 18-20 mars 2026
- ✅ Formation FIV complète — CDC 03-13, quiz 110 questions, 24 cas cliniques (3 parties)
- ✅ Formation LCA — CDC complet partie 00 (introduction et charte)
- ✅ Section 15 REGLES_ECRITURE_CONTENU — fiabilité des sources et vérification par agent IA
- ✅ Cadre légal marocain AMP intégré (CDC_FIV_12)
- ✅ Quiz hypothyroïdies — 100 questions (4 niveaux, M01-M38)
- ✅ Quiz hyperthyroïdies — 100 questions (4 niveaux, M01-M38)

### 21 mars 2026 — DÉPLOIEMENT MOODLE COMPLET
- ✅ **VERTEX© renommé** : Virtual Environment for Real-Time EXpertise (plus "Rachis")
- ✅ **Moodle local** (Docker) : 12 formations importées, page d'accueil refondue, thème Moove configuré
- ✅ **Plugin VERTEX Coupons** créé (local_vertex_coupons) :
  - Gestion coupons (création, lot, révocation)
  - Inscription directe de praticiens par l'admin
  - Page tarifs bi-régionale (Maroc MAD / International EUR)
  - Page souscription (carte ou virement)
  - Page activation coupon pour praticiens
  - Envoi email automatique
- ✅ **162 fichiers HTML** générés (generate_moodle_content.py)
- ✅ **244 questions quiz** converties GIFT+XML (convert_quiz_to_gift.py)
- ✅ **Hébergement Infomaniak** acquis : doctraining.ma (mutualisé PHP 8.2 + MariaDB 10.11)
- ✅ **Moodle 4.5 installé en production** sur https://doctraining.ma
- ✅ **12 formations importées** en production via API REST
- ✅ **Plugin coupons installé** en production
- ✅ **Thème Moove installé** en production (configuration en cours)
- ✅ **Web Services activés** en production (token créé)

---

## INFRA PRODUCTION — doctraining.ma

| Info | Valeur |
|------|--------|
| Domaine | doctraining.ma |
| Hébergeur | Infomaniak (mutualisé) |
| PHP | 8.2 |
| BDD | MariaDB 10.11 |
| Serveur MySQL | ws5ihj.myd.infomaniak.com:3306 |
| Base | ws5ihj_doctraining |
| Utilisateur MySQL | ws5ihj_aryad2006 |
| Utilisateur SSH | uid361285 (terminal Infomaniak) |
| Chemin Moodle | ~/sites/doctraining.ma/ |
| Chemin moodledata | ~/moodledata/ |
| Token API prod | 6c7f8707caa3219c4799c6d223929640 |
| Email support | contact@doctraining.ma |

### Cours en production (IDs)

| # | Formation | ID prod |
|---|-----------|---------|
| 1 | Scoliose | 2 |
| 2 | PTG | 3 |
| 3 | IOA | 4 |
| 4 | Tendinites | 5 |
| 5 | Obésité | 6 |
| 6 | Diabétologie | 7 |
| 7 | HTA | 8 |
| 8 | Hypothyroïdies | 9 |
| 9 | Hyperthyroïdies | 10 |
| 10 | FIV | 11 |
| 11 | Histoire Orthopédie | 12 |
| 12 | LCA | 13 |

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

## CE QUI RESTE À FAIRE

### Priorité 1 — Production (doctraining.ma)
- Finaliser la **configuration du thème Moove** en production (slider, marketing, FAQ, CSS custom)
- Configurer le **SMTP** Infomaniak pour les emails (contact@doctraining.ma)
- Configurer le **cron** Moodle (tâches planifiées Infomaniak)
- Masquer le crédit Conecti.me et le footer Moodle (CSS custom)
- Ajouter le **logo SVG VERTEX©** et le **favicon** dans le thème
- Remplir les **coordonnées bancaires** sur la page virement
- Configurer le **paiement en ligne** (Stripe ou CMI Maroc)

### Priorité 2 — Contenu
- Cas cliniques manquants : **Obésité-Orthopédie**
- Quiz manquants : HTA, Scoliose, PTG, IOA, Tendinites, Obésité-Orthopédie
- Formation LCA : poursuivre les CDC (01+)
- Importer les quiz GIFT dans la banque de questions Moodle (prod)

### Priorité 3 — Améliorations
- Installer plugins additionnels en prod (H5P, customcert, attendance)
- Configurer les inscriptions payantes (enrol_fee ou plugin custom)
- Ajouter le plugin mod_vertex (simulateur) en prod

## POUR REPRENDRE

1. La mémoire Claude est configurée
2. **Site en production** : https://doctraining.ma (Moodle 4.5, Infomaniak)
3. **Site local** : http://localhost:8890 (Docker, thème Moove complet)
4. **13 formations** au total (12 + LCA en cours)
5. Le thème Moove est installé en prod mais pas encore configuré (slider, marketing, FAQ)
6. Le plugin coupons est installé en local ET en prod
7. Scripts d'import : `import_all_formations.py`, `generate_moodle_content.py`, `convert_quiz_to_gift.py`
8. Token API prod : `6c7f8707caa3219c4799c6d223929640`
9. Pour déployer un fichier en prod : push sur GitHub puis `wget` depuis le SSH Infomaniak
10. Quiz faits : Diabétologie (70q), FIV (48q), Hypothyroïdies (30q), Hyperthyroïdies (96q)
11. Modèle de référence quiz : `QUIZ_HYPOTHYROIDIE.md` ou `QUIZ_HYPERTHYROIDIE.md`
12. Modèle de référence cas cliniques : `CAS_CLINIQUES_IOA.md`

---

*Note de reprise — 21 mars 2026 — 13 formations, site en production sur doctraining.ma*
