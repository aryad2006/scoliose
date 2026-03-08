# MODULE ADMINISTRATION — SPÉCIFICATIONS COMPLÈTES
## Plateforme LMS Formation Médicale avec VERTEX©

**Version** : 1.0 — Février 2026
**Référence** : ADMIN-SPEC-001
**Complète** : `CAHIER_DES_CHARGES_LMS.md` (§2.5.3 Dashboard administrateur)

---

## TABLE DES MATIÈRES

1. [Vue d'ensemble et architecture](#1-vue-densemble-et-architecture)
2. [Rôles et permissions (RBAC)](#2-rôles-et-permissions-rbac)
3. [Dashboard principal](#3-dashboard-principal)
4. [Gestion des utilisateurs et étudiants](#4-gestion-des-utilisateurs-et-étudiants)
5. [Gestion des abonnements et licences](#5-gestion-des-abonnements-et-licences)
6. [Gestion financière et comptabilité](#6-gestion-financière-et-comptabilité)
7. [Gestion des formations (multi-cours)](#7-gestion-des-formations-multi-cours)
8. [Gestion des examens et certifications](#8-gestion-des-examens-et-certifications)
9. [Gestion du contenu (CMS admin)](#9-gestion-du-contenu-cms-admin)
10. [Maintenance et opérations](#10-maintenance-et-opérations)
11. [Communication et notifications](#11-communication-et-notifications)
12. [Analytics et reporting](#12-analytics-et-reporting)
13. [Conformité et audit](#13-conformité-et-audit)
14. [Configuration système](#14-configuration-système)
15. [API d'administration](#15-api-dadministration)
16. [Spécifications techniques](#16-spécifications-techniques)
17. [Planning de développement](#17-planning-de-développement)

---

## 1. Vue d'ensemble et architecture

### 1.1 Philosophie

Le module admin est le **centre de contrôle** de la plateforme. Il permet de gérer l'ensemble des opérations sans intervention technique (principe « zero-code admin »). Toutes les actions critiques sont réalisables depuis l'interface web, sans accès serveur.

### 1.2 Architecture du panneau admin

```
┌─────────────────────────────────────────────────────────────────────┐
│                     PANNEAU D'ADMINISTRATION                        │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐ │
│  │Dashboard │ │Utilisat. │ │Finances  │ │Formations│ │Maintenance│ │
│  │Principal │ │& Étudian.│ │& Abonnem.│ │& Examens │ │& Système │ │
│  └────┬─────┘ └────┬─────┘ └────┬─────┘ └────┬─────┘ └────┬─────┘ │
│       │             │            │             │             │       │
│  ┌────▼─────────────▼────────────▼─────────────▼─────────────▼────┐ │
│  │                    API ADMIN (REST + GraphQL)                    │ │
│  │  Authentification : JWT + MFA + IP whitelist + session timeout  │ │
│  └────────────────────────────┬────────────────────────────────────┘ │
│                               │                                      │
│  ┌────────────────────────────▼────────────────────────────────────┐ │
│  │                    Couche de données                             │ │
│  │  PostgreSQL │ Redis │ Elasticsearch │ S3 │ Stripe │ SMTP        │ │
│  └─────────────────────────────────────────────────────────────────┘ │
└─────────────────────────────────────────────────────────────────────┘
```

### 1.3 Accès sécurisé

| Mesure | Détail |
|---|---|
| URL dédiée | `admin.VERTEX.com` (sous-domaine séparé) |
| Authentification | Email + mot de passe + MFA obligatoire (TOTP ou WebAuthn/FIDO2) |
| IP whitelist | Optionnel — restreindre l'accès à des IP fixes (bureaux, VPN) |
| Session timeout | 30 min d'inactivité → déconnexion automatique |
| Audit trail | Chaque action admin est loggée (qui, quoi, quand, IP, user-agent) |
| Rate limiting | 100 req/min par admin, 10 tentatives de login avant blocage 15 min |
| Mode lecture seule | Rôle « auditeur » peut consulter sans modifier |

---

## 2. Rôles et permissions (RBAC)

### 2.1 Hiérarchie des rôles

```
Super Admin (propriétaire)
  ├── Admin plateforme (gestion globale)
  │     ├── Gestionnaire financier (finances, abonnements)
  │     ├── Gestionnaire pédagogique (formations, examens, contenu)
  │     ├── Gestionnaire utilisateurs (étudiants, instructeurs)
  │     ├── Gestionnaire technique (maintenance, infrastructure)
  │     └── Auditeur (lecture seule, conformité)
  ├── Admin institution (délégué pour un établissement)
  │     ├── Instructeur/Formateur
  │     └── Tuteur
  └── Support (tickets, FAQ)
```

### 2.2 Matrice de permissions

| Permission | Super Admin | Admin | Gest. Finance | Gest. Péda | Gest. Users | Gest. Tech | Admin Instit. | Auditeur |
|---|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
| Voir dashboard global | ✅ | ✅ | ✅ (finance) | ✅ (péda) | ✅ (users) | ✅ (tech) | ✅ (instit.) | ✅ |
| Gérer utilisateurs | ✅ | ✅ | ❌ | ❌ | ✅ | ❌ | ✅ (siens) | 👁️ |
| Créer/supprimer admin | ✅ | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ |
| Gérer abonnements | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ (siens) | 👁️ |
| Rembourser | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ | ❌ | ❌ |
| Créer formation/cours | ✅ | ✅ | ❌ | ✅ | ❌ | ❌ | ❌ | ❌ |
| Modifier contenu | ✅ | ✅ | ❌ | ✅ | ❌ | ❌ | ❌ | ❌ |
| Gérer examens | ✅ | ✅ | ❌ | ✅ | ❌ | ❌ | ❌ | 👁️ |
| Voir finances | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ (siens) | 👁️ |
| Export données | ✅ | ✅ | ✅ (finance) | ✅ (péda) | ✅ (users) | ✅ (tech) | ✅ (siens) | ❌ |
| Maintenance système | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ | ❌ |
| Mode maintenance | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ | ❌ |
| Supprimer données | ✅ | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ |
| Voir audit logs | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ | ✅ |
| Configurer système | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ | ❌ |
| Gérer API keys | ✅ | ✅ | ❌ | ❌ | ❌ | ✅ | ❌ | ❌ |

*✅ = accès complet, 👁️ = lecture seule, ❌ = pas d'accès*

### 2.3 Création de rôles personnalisés

Le Super Admin peut créer des **rôles personnalisés** en combinant les permissions unitaires :

```json
{
  "role_name": "Responsable DPC France",
  "permissions": [
    "users.view", "users.export",
    "subscriptions.view", "subscriptions.dpc_manage",
    "certifications.view", "certifications.generate",
    "reports.dpc_export"
  ],
  "scope": "country:FR",
  "expiry": "2027-12-31"
}
```

---

## 3. Dashboard principal

### 3.1 Vue d'ensemble temps réel

Le dashboard principal affiche les métriques clés en temps réel avec des indicateurs de tendance :

```
┌─────────────────────────────────────────────────────────────────────────┐
│  📊 DASHBOARD ADMIN — VERTEX© Platform                    🔔 5  👤 AM │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐ │
│  │   1 247   │  │   892    │  │  67,2%   │  │ 48 520 € │  │   4,7★   │ │
│  │ Inscrits  │  │ Actifs   │  │ Complét. │  │  MRR     │  │   NPS    │ │
│  │  ▲ +12%   │  │  ▲ +8%   │  │  ▲ +3%   │  │  ▲ +15%  │  │  ▲ +0.2  │ │
│  └──────────┘  └──────────┘  └──────────┘  └──────────┘  └──────────┘ │
│                                                                         │
│  ┌────────────────────────────────┐  ┌─────────────────────────────┐   │
│  │  📈 Revenus (12 derniers mois) │  │  🎓 Inscriptions par source │   │
│  │  [graphique linéaire]          │  │  [camembert]                │   │
│  │  MRR / ARR / Churn             │  │  Direct / DPC / Instit. /  │   │
│  │                                │  │  Congrès / Affiliation      │   │
│  └────────────────────────────────┘  └─────────────────────────────┘   │
│                                                                         │
│  ┌────────────────────────────────┐  ┌─────────────────────────────┐   │
│  │  ⚠️ Alertes actives (3)        │  │  🖥️ Santé système           │   │
│  │  • 2 paiements échoués        │  │  CPU: 34% │ RAM: 62%       │   │
│  │  • 1 étudiant inactif 30j     │  │  GPU: 45% │ Disk: 38%      │   │
│  │  • Certificat SSL expire J-30 │  │  Uptime: 99.97% (30j)      │   │
│  └────────────────────────────────┘  └─────────────────────────────┘   │
│                                                                         │
│  ┌──────────────────────────────────────────────────────────────────┐   │
│  │  📚 Formations actives                                           │   │
│  │  ┌─────────────────────┬────────┬────────┬──────────┬─────────┐ │   │
│  │  │ Formation           │ Inscrits│ Actifs │ Complét. │ Revenue │ │   │
│  │  ├─────────────────────┼────────┼────────┼──────────┼─────────┤ │   │
│  │  │ 🦴 Scoliose         │  1 102 │   780  │  64.2%   │ 42.3K€ │ │   │
│  │  │ 🦵 Prothèse genou   │   145  │   112  │  71.0%   │  6.2K€ │ │   │
│  │  └─────────────────────┴────────┴────────┴──────────┴─────────┘ │   │
│  └──────────────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────────┘
```

### 3.2 Widgets personnalisables

L'admin peut configurer son dashboard avec les widgets suivants (drag & drop) :

| Widget | Données | Rafraîchissement |
|---|---|---|
| KPI cards (8 max) | Inscrits, actifs, MRR, ARR, churn, NPS, complétion, tickets | Temps réel (WebSocket) |
| Graphique revenus | MRR/ARR sur 12-24 mois, comparaison N-1 | Quotidien |
| Graphique inscriptions | Par jour/semaine/mois, par source | Quotidien |
| Carte géographique | Répartition des praticiens par pays | Quotidien |
| Alertes | Paiements échoués, inactivité, expiration, erreurs système | Temps réel |
| Santé système | CPU, RAM, GPU, disque, uptime, latence API | 30 secondes |
| Activité récente | Dernières inscriptions, complétions, paiements | Temps réel |
| Formations actives | Tableau récapitulatif multi-cours | Horaire |
| Pipeline VERTEX | Sessions actives, queue FEM, utilisation GPU | 30 secondes |
| Tickets support | Ouverts/en cours/résolus, SLA compliance | Temps réel |
| Calendrier | Webinaires, examens, deadlines, maintenance prévue | Horaire |
| Leaderboard | Top 10 praticiens (opt-in), top institutions | Quotidien |

### 3.3 Alertes et notifications admin

| Type d'alerte | Seuil | Canal | Destinataire |
|---|---|---|---|
| Paiement échoué | Immédiat | Email + in-app | Gest. Finance |
| Paiement échoué (3ème tentative) | Immédiat | Email + SMS | Gest. Finance + Admin |
| Étudiant inactif | >14 jours, >30 jours | In-app | Gest. Users |
| Certificat SSL expire | J-30, J-7, J-1 | Email + SMS | Gest. Tech |
| Espace disque | >80%, >90% | Email + SMS | Gest. Tech |
| Erreur serveur (5xx) | >10/min | SMS + Slack/Teams | Gest. Tech |
| Tentative intrusion | >10 login échoués/IP | Email + SMS + blocage auto | Gest. Tech + Admin |
| Nouvel abonnement institutionnel | Immédiat | Email | Gest. Finance |
| Réclamation/litige Stripe | Immédiat | Email + SMS | Gest. Finance + Admin |
| Examen terminé (lot) | Fin de session examen | In-app | Gest. Péda |
| Mise à jour système disponible | Vérification quotidienne | In-app | Gest. Tech |

---

## 4. Gestion des utilisateurs et étudiants

### 4.1 Liste des utilisateurs

#### 4.1.1 Vue tableau

Tableau principal avec colonnes configurables, tri multi-critères et filtrage avancé :

| Colonne | Type | Filtrable | Triable |
|---|---|---|---|
| ID | Auto-incrémenté | ✅ | ✅ |
| Photo | Avatar | ❌ | ❌ |
| Nom, Prénom | Texte | ✅ (recherche) | ✅ |
| Email | Email | ✅ (recherche) | ✅ |
| Rôle | Enum | ✅ (multi-select) | ✅ |
| Spécialité | Enum | ✅ (multi-select) | ✅ |
| Pays | ISO 3166 | ✅ (multi-select) | ✅ |
| Institution | Texte/relation | ✅ (recherche) | ✅ |
| Formule d'abonnement | Enum | ✅ (multi-select) | ✅ |
| Statut abonnement | Actif/Expiré/Suspendu/Gratuit | ✅ | ✅ |
| Date inscription | Date | ✅ (plage) | ✅ |
| Dernière connexion | Date | ✅ (plage) | ✅ |
| Progression globale | Pourcentage | ✅ (plage) | ✅ |
| Score moyen quiz | Pourcentage | ✅ (plage) | ✅ |
| Certifié | Oui/Non | ✅ | ✅ |
| N° RPPS/ADELI | Texte | ✅ (recherche) | ❌ |

#### 4.1.2 Filtres prédéfinis (vues rapides)

- **Tous les utilisateurs** — vue par défaut
- **Étudiants actifs** — abonnement actif + connexion <14j
- **Étudiants inactifs** — aucune connexion depuis >14j
- **Abonnements expirant bientôt** — expiration dans <30j
- **En difficulté** — progression <20% après >60j d'inscription, ou >3 échecs quiz
- **Candidats à la certification** — progression >90%, non certifiés
- **Institutionnels** — rattachés à une institution
- **DPC en cours** — suivi DPC actif
- **Non vérifiés** — email ou RPPS non confirmé
- **Bloqués/suspendus** — comptes verrouillés

#### 4.1.3 Actions en masse (bulk actions)

| Action | Confirmation | Audit log |
|---|---|---|
| Envoyer un email groupé | Oui (prévisualisation) | ✅ |
| Prolonger abonnement (+X jours) | Oui | ✅ |
| Suspendre les comptes | Oui (motif obligatoire) | ✅ |
| Réactiver les comptes | Oui | ✅ |
| Changer de formule | Oui | ✅ |
| Exporter en CSV/Excel | Non | ✅ |
| Attribuer à une institution | Oui | ✅ |
| Attribuer un badge/certificat manuel | Oui | ✅ |
| Supprimer (RGPD — droit à l'oubli) | Double confirmation + mot de passe admin | ✅ |

### 4.2 Fiche utilisateur détaillée

Chaque utilisateur dispose d'une fiche complète accessible en un clic :

```
┌─────────────────────────────────────────────────────────────────┐
│  👤 Dr. Marie DUPONT — CHP Saint-Louis, Paris                   │
│  📧 m.dupont@chp-saintlouis.fr │ 📱 +33 6 12 34 56 78          │
│  🏥 Chirurgien orthopédiste │ RPPS: 10100123456                │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  [Profil] [Progression] [Abonnement] [Paiements] [Examens]     │
│  [VERTEX] [Communications] [Activité] [Notes admin]          │
│                                                                 │
│  ── Onglet actif : PROFIL ──────────────────────────────────── │
│                                                                 │
│  Statut compte   : ✅ Actif                                    │
│  Formule         : Premium (890€/an)                           │
│  Inscrit le      : 15/03/2026                                  │
│  Expire le       : 15/03/2027 (dans 384 jours)                │
│  Dernière connexion : il y a 2 heures                          │
│  Progression     : ██████████░░░░░ 67% (Module 19/29)         │
│  Score moyen     : 82.4%                                       │
│  Temps total     : 47h 23min                                   │
│  Badges          : 🏅 Anatomiste │ 🏅 Imageur │ 🏅 Opérateur  │
│  Certificat      : ❌ Non certifié (tentative prévue le 20/04) │
│                                                                 │
│  ── Notes admin ─────────────────────────────────────────────  │
│  📝 25/09/2026 (Admin JL) : Demande de facture institutionnelle│
│     → Traitée, facture envoyée le 26/09                        │
│  📝 12/08/2026 (Auto) : Paiement échoué, relance auto envoyée │
│     → Paiement régularisé le 14/08                             │
│                                                                 │
│  [Modifier profil] [Prolonger abo] [Suspendre] [Suppr. RGPD]  │
│  [Envoyer message] [Réinitialiser MDP] [Connexion en tant que] │
└─────────────────────────────────────────────────────────────────┘
```

### 4.3 Gestion des institutions

#### 4.3.1 Fiche institution

| Champ | Type | Description |
|---|---|---|
| Nom | Texte | CHU de Bordeaux |
| Type | Enum | CHU / Clinique / Université / Cabinet / Société savante / Autre |
| Pays | ISO 3166 | France |
| Adresse | Texte | Adresse complète |
| Contact principal | Relation utilisateur | Dr X., chef de service |
| Contact admin | Relation utilisateur | Mme Y., DRH formation |
| Licence | Enum | Institution S / M / L / XL |
| Sièges achetés | Nombre | 50 |
| Sièges utilisés | Nombre (auto) | 34 |
| Date début contrat | Date | 01/01/2027 |
| Date fin contrat | Date | 31/12/2027 |
| Montant contrat | Monnaie | 19 500 € HT |
| Mode paiement | Enum | Virement / CB / Bon de commande |
| SIRET/TVA intra | Texte | FR12345678901 |
| SSO configuré | Bool | SAML 2.0 actif |
| Notes | Texte libre | Historique des échanges |

#### 4.3.2 Dashboard institution

Chaque institution dispose de son propre dashboard (accessible par l'admin institution délégué) :

- Nombre de sièges utilisés / disponibles
- Liste des praticiens rattachés
- Progression moyenne de la cohorte
- Taux de complétion par module
- Rapport de formation (exportable PDF — utile pour DPC institutionnel)
- Facturation et historique des paiements

### 4.4 Vérification d'identité professionnelle

| Étape | Méthode | Automatisation |
|---|---|---|
| 1. Email professionnel | Vérification domaine (@chu-xxx.fr, @aphp.fr) | Automatique (whitelist domaines) |
| 2. N° RPPS/ADELI | Vérification via API annuaire santé (annuaire.sante.fr) | Semi-automatique (API + validation manuelle si échec) |
| 3. Diplôme/attestation | Upload document + vérification manuelle | Manuelle (file d'attente admin) |
| 4. Parrainage institutionnel | L'admin institution valide le rattachement | Automatique dans le périmètre institutionnel |

---

## 5. Gestion des abonnements et licences

### 5.1 Cycle de vie d'un abonnement

```
┌──────────┐    ┌──────────┐    ┌──────────┐    ┌──────────┐    ┌──────────┐
│  Essai   │───▶│  Actif   │───▶│Expiration│───▶│ Grâce    │───▶│ Expiré   │
│ (gratuit)│    │ (payant) │    │ J-30     │    │ (15j)    │    │(suspendu)│
└──────────┘    └─────┬────┘    └──────────┘    └──────────┘    └─────┬────┘
                      │                                               │
                      │         ┌──────────┐                         │
                      ├────────▶│Renouvellé│◀────────────────────────┘
                      │         └──────────┘     (réactivation)
                      │
                      ├────────▶ Upgrade (changement de formule)
                      ├────────▶ Downgrade (changement de formule)
                      ├────────▶ Annulé (remboursement partiel si <30j)
                      └────────▶ Suspendu (admin — motif requis)
```

### 5.2 Interface de gestion des abonnements

| Fonctionnalité | Description |
|---|---|
| Vue d'ensemble | Tableau récapitulatif : abonnements actifs, en grace, expirés, annulés |
| Filtres avancés | Par formule, statut, date début/fin, institution, pays, montant |
| Créer un abonnement manuel | Cas spéciaux : VIP, partenariat, offre spéciale, bourse |
| Modifier un abonnement | Changer formule, prolonger, ajuster prix, ajouter options |
| Annuler un abonnement | Avec calcul automatique du remboursement prorata |
| Suspendre un abonnement | Pause temporaire (ex : congé maternité, maladie) — gel du timer |
| Renouvellement automatique | Configuration ON/OFF, relances email automatiques J-30, J-7, J-1 |
| Codes promo / coupons | Création, durée de validité, nombre d'utilisations max, montant/% |
| Abonnement d'essai | Durée configurable (7j, 14j, 30j), accès à tous les modules ou sélection |

### 5.3 Gestion des coupons et promotions

```
┌─────────────────────────────────────────────────────────────────┐
│  🎟️ Gestion des coupons                                        │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  [+ Nouveau coupon]  [Importer CSV]  [Exporter]                │
│                                                                 │
│  ┌──────────┬────────┬────────┬────────┬────────┬────────────┐ │
│  │ Code     │ Type   │ Valeur │ Utilisé│ Max    │ Expiration │ │
│  ├──────────┼────────┼────────┼────────┼────────┼────────────┤ │
│  │ SFCR2026 │ %      │ 20%    │ 45     │ 100    │ 31/12/2026│ │
│  │ WELCOME  │ Fixe   │ 50€    │ 212    │ ∞      │ —         │ │
│  │ EARLYBIRD│ %      │ 30%    │ 50     │ 50     │ ⚠️ Expiré  │ │
│  │ VIP-CHU  │ Fixe   │ 100%   │ 3      │ 10     │ 30/06/2027│ │
│  └──────────┴────────┴────────┴────────┴────────┴────────────┘ │
│                                                                 │
│  Création de coupon :                                           │
│  • Code : auto-généré ou personnalisé                          │
│  • Type : pourcentage (5-100%) ou montant fixe (1-10000€)      │
│  • Applicable à : toutes les formules / formules spécifiques   │
│  • Restrictions : 1 par utilisateur, nouveaux inscrits only,   │
│    pays spécifiques, formule minimum                           │
│  • Durée : date début/fin ou sans limite                       │
│  • Nombre max d'utilisations : illimité ou plafonné            │
│  • Traçabilité : qui a utilisé quel coupon, quand, quel impact │
└─────────────────────────────────────────────────────────────────┘
```

### 5.4 Gestion des licences institutionnelles

| Fonctionnalité | Description |
|---|---|
| Créer une licence | Institution, nombre de sièges, formule, durée, prix négocié |
| Pool de sièges | L'admin institution distribue les sièges à ses membres |
| Invitation par email | L'admin institution invite des utilisateurs par email (lien d'inscription automatique) |
| Import CSV | Inscription en masse via fichier CSV (nom, prénom, email, service) |
| Transfert de siège | Un siège libéré (départ d'un membre) peut être réattribué |
| Reporting institutionnel | Progression agrégée, export PDF pour le DPC ou la direction |
| Facturation dédiée | Bon de commande, facture à 30/60 jours, virement bancaire |
| SSO | Configuration SAML 2.0 / OIDC par institution |

---

## 6. Gestion financière et comptabilité

### 6.1 Dashboard financier

```
┌─────────────────────────────────────────────────────────────────────┐
│  💰 FINANCES — Février 2027                                         │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌─────────┐ │
│  │ 48 520€ │  │582 240€ │  │ 12 430€ │  │  3 210€ │  │   2.8%  │ │
│  │  MRR    │  │  ARR    │  │ Nouveaux│  │Rembours.│  │  Churn  │ │
│  │ ▲ +15%  │  │ ▲ +22%  │  │  ▲ +8%  │  │ ▼ -12%  │  │ ▼ -0.3% │ │
│  └─────────┘  └─────────┘  └─────────┘  └─────────┘  └─────────┘ │
│                                                                     │
│  ┌─────────────────────────────────┐  ┌────────────────────────┐   │
│  │ 📈 Revenus mensuels             │  │ 🧁 Répartition par     │   │
│  │ [graphique barres empilées]     │  │    formule             │   │
│  │ ■ Individuel  ■ Institutionnel  │  │ [donut chart]          │   │
│  │ ■ DPC        ■ Renouvellement   │  │ Premium 38% │ Std 28% │   │
│  │                                 │  │ Certif 22%  │ Ess 12% │   │
│  └─────────────────────────────────┘  └────────────────────────┘   │
│                                                                     │
│  ┌──────────────────────────────────────────────────────────────┐   │
│  │ 💳 Transactions récentes                          [Voir tout]│   │
│  │ ✅ 25/02 Dr Leroy      Premium    890€    CB ****4521       │   │
│  │ ✅ 25/02 CHU Toulouse  Instit L   14500€  Virement          │   │
│  │ ⚠️ 24/02 Dr Ahmed      Standard   490€    ❌ Paiement refusé│   │
│  │ ✅ 24/02 Dr Martin     Certif     1190€   CB ****8832       │   │
│  │ 🔄 24/02 Dr Rousseau   Premium    890€    Remboursement     │   │
│  └──────────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────┘
```

### 6.2 Transactions et paiements

| Fonctionnalité | Description |
|---|---|
| Liste des transactions | Toutes les transactions avec filtre par date, montant, statut, type, PaymentMethod |
| Détail d'une transaction | Utilisateur, formule, montant HT/TVA/TTC, devise, Stripe payment_intent, date, statut |
| Paiements échoués | File d'attente des relances (auto : J+1, J+3, J+7, puis suspension) |
| Remboursements | Remboursement total ou partiel, motif obligatoire, recalcul prorata |
| Litiges (disputes) | Gestion des réclamations Stripe/PayPal, réponse avec preuves |
| Virements institutionnels | Rapprochement bancaire manuel (upload relevé, pointage des paiements) |
| Export comptable | Export CSV compatible avec les logiciels comptables (FEC pour la France) |

### 6.3 Facturation

| Fonctionnalité | Description |
|---|---|
| Facture automatique | Générée à chaque paiement (PDF conforme, numérotation séquentielle) |
| Facture manuelle | Pour les cas spéciaux (sponsoring, partenariat, rétrofacturation) |
| Facture proforma | Sur demande, pour les institutionnels (avant paiement) |
| Avoir (credit note) | Émis lors d'un remboursement ou d'une erreur de facturation |
| Mentions légales | N° SIRET, TVA intra-UE, adresse, conditions de paiement |
| TVA | Calcul automatique selon le pays (FR 20%, UE reverse charge, hors UE 0%) |
| Modèle personnalisable | Logo, couleurs, texte de pied de page, coordonnées bancaires |
| Envoi automatique | Email avec PDF joint à chaque émission |
| Historique | Accès pour l'admin et pour le praticien (dans son espace) |

### 6.4 Reporting financier

| Rapport | Périodicité | Format | Contenu |
|---|---|---|---|
| **P&L mensuel** | Mensuel | PDF/Excel | CA, charges refacturées, résultat brut |
| **MRR / ARR** | Mensuel | Dashboard + export | Évolution, décomposition (new, expansion, churn, reactivation) |
| **Churn analysis** | Mensuel | Dashboard + export | Churn par cohorte, raisons d'annulation, prédiction |
| **CA par formule** | Mensuel | Dashboard + export | Répartition individuel/institutionnel/DPC, par formule |
| **CA par pays/région** | Trimestriel | Dashboard + export | Top 10 pays, évolution |
| **Prévisions (forecast)** | Trimestriel | Dashboard | Projection à 3/6/12 mois basée sur tendances |
| **Cohort analysis** | Trimestriel | Dashboard | Rétention par cohorte d'inscription (mois 1→12) |
| **LTV / CAC** | Trimestriel | Dashboard | Lifetime Value, Customer Acquisition Cost, ratio |
| **Export FEC** | Annuel | CSV (norme FEC) | Fichier des Écritures Comptables (obligation légale France) |
| **Rapport DPC** | Sur demande | PDF | Suivi des praticiens DPC, heures validées, attestations |

### 6.5 Gestion DPC/OPCO (financement formation)

| Fonctionnalité | Description |
|---|---|
| Dossier DPC | Formulaire de déclaration ANDPC pré-rempli pour le praticien |
| Suivi DPC | Tableau de bord des dossiers DPC en cours (soumis, validé, en attente de paiement) |
| Attestation DPC | Génération automatique de l'attestation de suivi de formation (heures, contenu, évaluation) |
| OPCO | Gestion des dossiers de prise en charge OPCO (pour les salariés) |
| FIF-PL | Gestion des dossiers FIF-PL (pour les libéraux) |
| Convention de formation | Génération automatique (modèle personnalisable) |
| Émargement | Feuille d'émargement numérique (horodatée, géolocalisée si nécessaire) |

---

## 7. Gestion des formations (multi-cours)

### 7.1 Architecture multi-formations

La plateforme est conçue pour **héberger plusieurs formations** au-delà de la scoliose. Chaque formation est une entité indépendante avec son propre catalogue, ses tarifs, ses instructeurs et ses certificats.

```
┌─────────────────────────────────────────────────────────────┐
│                   PLATEFORME VERTEX©                       │
│                                                             │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │ 🦴 Formation │  │ 🦵 Formation │  │ 🧠 Formation │ ... │
│  │  Scoliose    │  │  Prothèse    │  │  Neurochir.  │      │
│  │  (29 modules)│  │  du genou    │  │  Rachis      │      │
│  │  89h         │  │  (12 modules)│  │  (18 modules)│      │
│  │  VERTEX    │  │  KneeSim?    │  │  VERTEX    │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
│         │                 │                 │               │
│  ┌──────▼─────────────────▼─────────────────▼────────────┐  │
│  │              Catalogue de cours partagé                │  │
│  │  Modules communs : Anatomie, Biomécanique, Imagerie   │  │
│  │  VERTEX© partagé : même moteur, scénarios différents│  │
│  └───────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
```

### 7.2 Création d'une formation

| Étape | Champs | Description |
|---|---|---|
| 1. Informations générales | Titre, sous-titre, description courte, description longue, image de couverture, icône, couleur | Identité visuelle de la formation |
| 2. Métadonnées | Catégorie (orthopédie, neurochirurgie, rééducation...), niveau (fondamental, intermédiaire, avancé, expert), langue principale, durée estimée | Classification et recherche |
| 3. Structure | Parties → Modules → Sections (arborescence drag & drop) | Organisation du contenu |
| 4. Prérequis | Formations requises, modules requis, niveau minimal | Conditions d'accès |
| 5. Instructeurs | Assigner des formateurs/auteurs à cette formation | Gestion des droits d'accès contenu |
| 6. Tarification | Prix par formule, coupons spécifiques, accès institutionnel | Modèle économique par formation |
| 7. Certification | Examen final, conditions d'obtention, modèle de certificat | Certification spécifique |
| 8. Publication | Statut : brouillon → revue → pilote → publié → archivé | Workflow de validation |

### 7.3 Modules partagés inter-formations

Certains modules peuvent être **partagés** entre formations :

| Module | Formation Scoliose | Formation Prothèse genou | Formation Neurochir. |
|---|---|---|---|
| Anatomie du rachis | ✅ (Module 1) | — | ✅ (Module 1) |
| Biomécanique | ✅ (Module 3) | ✅ (adapté) | ✅ (adapté) |
| Imagerie | ✅ (Module 7) | ✅ (adapté) | ✅ (adapté) |
| Anesthésie/IONM | ✅ (Module 20) | ✅ (Module 8) | ✅ (Module 12) |
| Complications | ✅ (Modules 18-19) | ✅ (adapté) | ✅ (adapté) |

Un module partagé n'est rédigé qu'une fois, avec des **variantes** optionnelles par formation (cas cliniques adaptés, quiz spécialisés).

### 7.4 Catalogue public

| Fonctionnalité | Description |
|---|---|
| Page catalogue | Liste de toutes les formations avec filtres (catégorie, durée, prix, niveau) |
| Page formation | Syllabus, liste des modules, instructeurs, avis, tarifs, bouton d'achat |
| Preview gratuite | 1-3 modules gratuits par formation (configurable par l'admin) |
| Bundles | Combinaison de formations à prix réduit (ex : « Rachis complet » = Scoliose + Neurochir.) |
| Recommandations | « Les praticiens qui ont suivi Scoliose ont aussi suivi... » |
| Avis et notes | Système de notation (1-5 étoiles) + commentaires modérés |
| Recherche | Recherche full-text dans les titres, descriptions, contenus, instructeurs |

---

## 8. Gestion des examens et certifications

### 8.1 Création et paramétrage d'un examen

| Paramètre | Options | Description |
|---|---|---|
| Titre | Texte | « Examen de certification — Scoliose » |
| Formation associée | Relation | Lié à une formation spécifique |
| Durée | Minutes | 210 min (3h30) |
| Nombre de sections | 1-10 | 5 sections pour la scoliose |
| Questions par section | Nombre | Tirage aléatoire dans un pool |
| Pool de questions | Sélection | Pool par module, par niveau, par type |
| Score minimum | Pourcentage | 70% |
| Tentatives autorisées | 1-5 | 2 |
| Délai entre tentatives | Jours | 30 |
| Proctoring | Oui/Non | Oui (webcam + screen + IA anti-fraude) |
| Prérequis | Conditions | Progression ≥90%, tous les quiz passés |
| Calendrier | Sessions | Sessions programmées (ex : 1er et 15 de chaque mois) ou à la demande |
| Durée de validité du certificat | Mois | 36 mois (renouvellement par examen allégé) |
| Anti-fraude | Options | Mélange questions, mélange options, timer par question, navigateur verrouillé |

### 8.2 Sessions d'examen

| Fonctionnalité | Description |
|---|---|
| Planifier une session | Date, heure, nombre maximum de candidats, proctoring |
| Inscription candidats | Auto-inscription (si prérequis remplis) ou invitation manuelle |
| Surveillance en direct | Vue mosaïque des webcams des candidats (si proctoring humain) |
| Alertes temps réel | Détection IA : regard hors écran, personne tierce, onglet quitté, audio suspect |
| Rapport post-session | Résultats agrégés, incidents, questions problématiques |
| Enregistrements | Stockage des vidéos de proctoring (30 jours ; RGPD : consentement explicite) |

### 8.3 Correction et résultats

| Fonctionnalité | Description |
|---|---|
| Correction automatique | QCM, QCS, drag & drop → correction immédiate |
| Correction manuelle | Cas cliniques ouverts, VERTEX → file d'attente correcteur |
| Double correction | Option pour les cas cliniques complexes (2 correcteurs indépendants) |
| Révision des résultats | L'admin peut réviser les résultats manuellement (avec justification) |
| Recours | Procédure de recours pour les candidats (formulaire + comité de revue) |
| Publication des résultats | Par email + dans l'espace praticien, délai configurable (immédiat ou J+X) |
| Statistiques examen | Taux de réussite, score moyen, distribution, questions discriminantes |

### 8.4 Certificats

| Fonctionnalité | Description |
|---|---|
| Modèle de certificat | Éditeur visuel (WYSIWYG) avec placeholders dynamiques : nom, date, formation, score, numéro |
| Numérotation | Séquentielle automatique (ex : CERT-SCOL-2027-00142) |
| Signature électronique | Signature du responsable pédagogique (image + certif. numérique) |
| QR code de vérification | Lien vers une page publique de vérification (anti-fraude) |
| Blockchain (optionnel) | Hash du certificat enregistré sur blockchain publique (Polygon/Ethereum L2) |
| Durée de validité | Configurable, alerte de renouvellement automatique |
| Téléchargement | PDF haute qualité (150 DPI minimum, format A4 et Letter) |
| Partage | Bouton « Partager sur LinkedIn » pré-configuré |
| Registre | Base de données publique des certificats vérifiables (opt-in de le praticien) |

### 8.5 Gestion DPC/CME des certifications

| Fonctionnalité | Description |
|---|---|
| Crédits DPC | Mapping automatique : durée de formation → crédits DPC |
| Attestation DPC | Génération automatique du document ANDPC normalisé |
| Crédits CME/CPD | Mapping pour l'international (EACCME, AMA PRA Category 1) |
| Déclaration automatique | API ANDPC pour déclaration des actions suivies (si disponible) |
| Renouvellement | Alerte avant expiration du certificat, examen allégé de renouvellement |

---

## 9. Gestion du contenu (CMS admin)

### 9.1 Éditeur de contenu

| Fonctionnalité | Description |
|---|---|
| Éditeur WYSIWYG médical | Rich text avec support : Markdown, HTML, LaTeX (formules), tableaux, alertes, notes |
| Gestion des médias | Upload, bibliothèque, recherche, tags, redimensionnement, watermark |
| Versionning | Historique complet de chaque modification (diff visuel, restauration en 1 clic) |
| Workflow éditorial | Brouillon → En revue → Approuvé → Publié (avec notifications à chaque étape) |
| Collaboration | Co-édition simultanée (type Google Docs), commentaires inline |
| Planification | Publication programmée (date + heure de mise en ligne) |
| Import/export | Import Word (.docx), Markdown (.md), PowerPoint → contenu LMS. Export SCORM/xAPI |
| Prévisualisation | Vue praticien (desktop, tablet, mobile) avant publication |
| Traduction | Interface double panneau (original + traduction), statut de traduction par section |
| Marqueurs [MEDIA] | Détection automatique des marqueurs `[MEDIA: ...]` et lien avec la bibliothèque médias |

### 9.2 Bibliothèque de médias

| Fonctionnalité | Description |
|---|---|
| Upload en masse | Drag & drop, upload multi-fichiers, import depuis URL |
| Organisation | Dossiers, tags, catégories, recherche full-text |
| Métadonnées | Titre, description, auteur, licence, date, dimensions/durée, module associé |
| Transcodage auto | Vidéo : transcodage en HLS multi-résolution (360p→4K) + vignette |
| Optimisation images | Compression WebP/AVIF automatique, redimensionnement responsive |
| CDN | Upload automatique vers CDN avec URL signées (expiration configurable) |
| DRM | Protection des vidéos (Widevine/FairPlay) configurable par contenu |
| Statistiques | Nombre de vues/téléchargements par média, médias orphelins (non utilisés) |
| Droits d'auteur | Champ licence (CC-BY, propriétaire, acheté), date d'expiration des droits |

### 9.3 Gestion des quiz (banque de questions)

| Fonctionnalité | Description |
|---|---|
| Banque de questions | Base centralisée de toutes les questions (600+ pour scoliose, extensible) |
| Catégories | Module, section, niveau (Bronze→Diamant), type (QCM, QCS, cas clinique...) |
| Éditeur de question | Énoncé (texte riche + images), options, réponse correcte, explication détaillée, références |
| Import en masse | Import CSV/Excel (énoncé, options A-E, réponse, explication) |
| Statistiques par question | Taux de réussite, indice de discrimination, temps moyen, signalements |
| Signalement | Les praticiens peuvent signaler une question (erreur, ambiguïté) → file de revue admin |
| Revue périodique | Rappel automatique de révision des questions (tous les 12 mois) |
| Randomisation | Tirage aléatoire dans un pool, mélange des options, paramètres par quiz |
| Anti-triche | Questions ancrées dans des pools larges (ratio 2:1), timer par question optionnel |

---

## 10. Maintenance et opérations

### 10.1 Mode maintenance

| Fonctionnalité | Description |
|---|---|
| Activation | Un clic pour passer en mode maintenance (page personnalisable) |
| Planification | Programmer un créneau de maintenance (date début, date fin) |
| Notification | Email + banner in-app aux utilisateurs avant la maintenance (J-7, J-1, H-1) |
| Page maintenance | Personnalisable (message, durée estimée, contact support) |
| Exclusion | Les admins restent connectés pendant la maintenance |
| Mode dégradé | Option : lecture seule (accès au contenu mais pas aux quiz/VERTEX) |

### 10.2 Sauvegardes et restauration

| Type | Fréquence | Rétention | Stockage |
|---|---|---|---|
| Base de données (PostgreSQL) | Toutes les 6h + avant chaque mise à jour | 90 jours | S3 cross-region (chiffré AES-256) |
| Médias (vidéos, images, 3D) | Quotidien (incrémental) | 365 jours | S3 Glacier |
| Configuration système | À chaque modification | Illimité (Git) | Git privé |
| Données utilisateurs (RGPD) | Quotidien | 30 jours (puis anonymisation) | S3 chiffré, région UE |
| VERTEX (modèles, sessions) | Quotidien | 90 jours | S3 |

| Fonctionnalité | Description |
|---|---|
| Restauration ponctuelle | Restaurer un enregistrement spécifique (utilisateur, question, module) |
| Restauration complète | Restaurer la BDD entière à un point dans le temps (PITR) |
| Test de restauration | Test automatique mensuel (restauration sur env. de test + vérification intégrité) |
| Export manuel | L'admin peut déclencher un backup complet à tout moment |

### 10.3 Mises à jour et déploiement

| Fonctionnalité | Description |
|---|---|
| Mises à jour | Vérification automatique des nouvelles versions (quotidien) |
| Changelog | Affichage des changements (new features, bug fixes, security patches) |
| Déploiement | Blue-green deployment (zéro downtime) via Kubernetes |
| Rollback | Retour à la version précédente en <2 minutes |
| Canary releases | Nouvelle version déployée pour 5% des utilisateurs d'abord, puis 25%, 50%, 100% |
| Environnement de staging | Pré-test de chaque mise à jour (mirroring production) |

### 10.4 Monitoring et santé système

| Métrique | Seuil d'alerte | Seuil critique | Action |
|---|---|---|---|
| CPU | >70% pendant 5 min | >90% pendant 2 min | Auto-scaling horizontal |
| RAM | >80% | >95% | Alerte + restart pods si OOM |
| GPU (VERTEX) | >85% | >95% | File d'attente des sessions FEM |
| Disque | >80% | >95% | Alerte + nettoyage logs/cache auto |
| Latence API (p95) | >500ms | >2s | Alerte + investigation |
| Taux d'erreurs 5xx | >1% | >5% | Alerte + rollback automatique |
| Uptime | <99.95% (mois) | <99.9% (mois) | Post-mortem obligatoire |
| Certificats SSL | Expiration <30j | Expiration <7j | Renouvellement auto (Let's Encrypt / ACM) |
| Taille BDD | >80% du provisioned | >90% | Scale up storage |
| Queue FEM (VERTEX) | >50 en attente | >100 en attente | Scale up GPU nodes |

### 10.5 Logs et debugging

| Type de log | Contenu | Rétention | Outil |
|---|---|---|---|
| Application (LMS) | Requêtes, erreurs, performances | 90 jours | ELK / CloudWatch |
| Accès (Nginx/ALB) | IP, URL, status, user-agent, timing | 90 jours | ELK |
| Audit admin | Actions admin (qui, quoi, quand) | 5 ans (obligation légale) | PostgreSQL + export |
| Sécurité | Tentatives de login, MFA, WAF blocks | 365 jours | SIEM (Wazuh/Splunk) |
| VERTEX | Sessions FEM, GPU usage, erreurs solver | 90 jours | ELK / Grafana |
| Paiement | Webhooks Stripe, erreurs, réconciliation | 7 ans (obligation comptable) | PostgreSQL |

| Fonctionnalité | Description |
|---|---|
| Recherche de logs | Interface web (Kibana) avec filtres par service, niveau, date, utilisateur |
| Alerting | Règles d'alerte configurables (email, Slack, SMS, PagerDuty) |
| Corrélation | Trace ID unique par requête (OpenTelemetry) pour suivre une action de bout en bout |
| Export | Export des logs sur demande (RGPD, audit, investigation sécurité) |

### 10.6 Tâches planifiées (cron jobs)

| Tâche | Fréquence | Description |
|---|---|---|
| Relance abonnements expirants | Quotidien (8h) | Email J-30, J-7, J-1, J+1, J+7, J+15 (grâce) |
| Nettoyage sessions expirées | Toutes les heures | Suppression sessions Redis >24h |
| Transcodage vidéo | À l'upload | File d'attente (AWS MediaConvert) |
| Calcul analytics | Quotidien (2h) | Agrégation des métriques dans TimescaleDB |
| Vérification SSL | Quotidien (6h) | Vérification expiration certificats |
| Backup BDD | Toutes les 6h | Snapshot PostgreSQL → S3 |
| Nettoyage RGPD | Mensuel | Anonymisation des comptes supprimés il y a >30j |
| Rapport financier | Mensuel (1er du mois) | Génération P&L, email au gestionnaire financier |
| Test de restauration | Mensuel | Restauration automatique + vérification intégrité |
| Renouvellement auto | Quotidien | Débit Stripe pour les abonnements à renouveler |
| Détection inactivité | Quotidien | Alertes étudiants inactifs >14j |
| MAJ taux de change | Quotidien | Mise à jour des taux EUR/USD/GBP pour facturation |

---

## 11. Communication et notifications

### 11.1 Centre de messagerie admin

| Fonctionnalité | Description |
|---|---|
| Email en masse | Envoi à tous les utilisateurs, ou filtré (par formule, pays, institution, statut) |
| Templates d'email | Bibliothèque de modèles (bienvenue, relance, newsletter, alerte, promotion) |
| Éditeur d'email | WYSIWYG avec placeholders dynamiques ({{nom}}, {{formation}}, {{progression}}) |
| Planification | Envoi immédiat ou programmé (date + heure + fuseau horaire) |
| A/B testing | Test de 2 variantes (objet, contenu) sur 10% puis envoi du gagnant |
| Statistiques | Taux d'ouverture, taux de clic, désabonnements, bounces |
| Désabonnement | Lien de désabonnement obligatoire (RGPD), gestion des préférences |

### 11.2 Notifications in-app

| Type | Déclencheur | Configurable |
|---|---|---|
| Nouveau contenu | Publication d'un module/mise à jour | ✅ |
| Résultat quiz | Fin de quiz (score, badge obtenu) | ✅ |
| Examen disponible | Prérequis atteints | ✅ |
| Inactivité | >7j, >14j, >30j sans connexion | ✅ (durées) |
| Webinaire | Rappel J-7, J-1, H-1 | ✅ |
| Abonnement | Expiration prochaine, renouvellement, échec paiement | ✅ |
| Système | Maintenance planifiée, nouvelle version | ✅ |
| Social | Réponse forum, message privé | ✅ |

### 11.3 Annonces et bannières

| Fonctionnalité | Description |
|---|---|
| Bannière globale | Message affiché en haut de toutes les pages (info, promo, maintenance) |
| Annonce ciblée | Message visible uniquement pour certains groupes (par formule, institution, pays) |
| Popup modal | Pour les communications importantes (modification CGU, mise à jour sécurité) |
| Expiration | Date de fin automatique (la bannière disparaît seule) |
| Tracking | Nombre de vues, nombre de fermetures (dismiss), CTR si lien |

---

## 12. Analytics et reporting

### 12.1 Reports prédéfinis

| Rapport | Description | Export |
|---|---|---|
| **Activité globale** | Connexions, pages vues, temps passé, par jour/semaine/mois | CSV, PDF |
| **Progression par formation** | Complétion par module, par partie, taux de réussite quiz | CSV, PDF |
| **Progression par cohorte** | Comparaison entre cohortes (institution, date d'inscription) | CSV, PDF |
| **Performance quiz** | Score moyen, distribution, questions problématiques, indice de discrimination | CSV, PDF |
| **Engagement VERTEX** | Sessions, durée, scénarios complétés, amélioration du score | CSV, PDF |
| **Financier mensuel** | MRR, ARR, new, expansion, churn, reactivation, par formule | CSV, PDF, Excel |
| **Acquisition** | Sources d'inscription, taux de conversion funnel, CAC | CSV, PDF |
| **Rétention** | Cohort analysis, churn rate, raisons d'abandon | CSV, PDF |
| **International** | Répartition géographique, CA par pays, langue préférée | CSV, PDF |
| **DPC/CME** | Praticiens en parcours DPC, heures validées, attestations générées | CSV, PDF |
| **Technique** | Uptime, latence, erreurs, utilisation GPU, coûts infra | CSV, PDF |

### 12.2 Générateur de rapports personnalisés

L'admin peut créer des rapports sur mesure :

1. **Sélection des dimensions** : utilisateur, formation, module, pays, institution, formule, date
2. **Sélection des métriques** : inscriptions, complétion, score, temps, CA, sessions VERTEX
3. **Filtres** : plage de dates, pays, formule, institution, statut
4. **Visualisation** : tableau, graphique linéaire, barres, camembert, carte
5. **Planification** : rapport récurrent (quotidien, hebdo, mensuel) envoyé par email
6. **Partage** : lien partageable (avec expiration) ou export PDF/CSV/Excel

### 12.3 Entonnoir de conversion (funnel)

```
Visiteurs site        100%  ████████████████████████████████████████  (10 000/mois)
       ↓
Inscription gratuite   15%  ██████                                   (1 500/mois)
       ↓
Module 1 complété      60%  ████                                     (900/mois)
       ↓
Module 3 complété      40%  ███                                      (600/mois)
       ↓
Achat Essentiel/Std    12%  █                                        (180/mois)
       ↓
Upgrade Premium         6%  ▌                                        (90/mois)
       ↓
Certification           3%  ▏                                        (45/mois)
```

Chaque étape est cliquable → détail des utilisateurs à cette étape, analyse des abandons.

---

## 13. Conformité et audit

### 13.1 RGPD

| Fonctionnalité | Description |
|---|---|
| Registre des traitements | Documentation automatique des traitements de données personnelles |
| Consentements | Gestion des consentements (cookies, emails marketing, analytics) avec historique |
| Droit d'accès | L'praticien peut télécharger toutes ses données (JSON/PDF) depuis son profil |
| Droit à l'oubli | Suppression ou anonymisation complète sur demande (admin valide, audit log) |
| Portabilité | Export des données dans un format standard (JSON) |
| DPO | Contact DPO visible dans les CGU et le panneau admin |
| Breach notification | Procédure de notification en cas de violation (72h CNIL) avec template pré-rempli |
| PIA (Privacy Impact Assessment) | Documentation de l'analyse d'impact pour les données de santé |
| Sous-traitants | Registre des sous-traitants (Stripe, AWS, SendGrid...) avec DPA signé |
| Cookies | Bandeau cookies conforme (TCF 2.2), catégorisation (nécessaire/analytics/marketing) |

### 13.2 Audit trail (journal d'audit)

Chaque action sensible est enregistrée de manière immuable :

| Champ | Contenu |
|---|---|
| Timestamp | ISO 8601 (avec fuseau horaire) |
| Acteur | ID utilisateur + rôle |
| Action | CREATE / UPDATE / DELETE / VIEW / EXPORT / LOGIN / LOGOUT |
| Ressource | Type (user, subscription, exam, content) + ID |
| Détails | Champs modifiés (avant/après), payload de la requête |
| IP | Adresse IP source |
| User-Agent | Navigateur/device |
| Résultat | Succès / Échec (+ code erreur) |

| Fonctionnalité | Description |
|---|---|
| Recherche | Filtres par acteur, action, ressource, date, IP |
| Export | Export CSV/JSON pour audit externe |
| Alertes | Actions sensibles → notification temps réel (suppression de données, accès admin) |
| Rétention | 5 ans minimum (obligation légale formation professionnelle en France) |
| Intégrité | Logs signés (HMAC) pour détecter toute modification |
| Archivage | Archivage automatique des logs >1 an vers stockage froid (S3 Glacier) |

### 13.3 Conformité formation professionnelle

| Exigence | Fonctionnalité |
|---|---|
| Qualiopi (France) | Indicateurs qualité traçables : objectifs, prérequis, évaluation, satisfaction |
| DPC (ANDPC) | Déclaration des actions, attestations, suivi des heures |
| EACCME (Europe) | Crédits CME/CPD, documentation conforme |
| Émargement numérique | Horodaté, géolocalisé (optionnel), exportable pour les OPCA |
| Enquêtes satisfaction | Questionnaire post-formation (NPS, satisfaction globale, suggestions) |
| Bilan pédagogique | Rapport annuel (BPF — Bilan Pédagogique et Financier, obligation française) |

---

## 14. Configuration système

### 14.1 Paramètres généraux

| Paramètre | Description | Valeur par défaut |
|---|---|---|
| Nom de la plateforme | Texte | « VERTEX© — Formation Médicale » |
| Logo | Image (SVG/PNG) | Logo VERTEX |
| Favicon | Image (32x32 ICO/PNG) | — |
| Couleurs principales | Hex codes (primaire, secondaire, accent) | #1E40AF, #1E3A5F, #F59E0B |
| Langue par défaut | Enum | Français |
| Fuseau horaire par défaut | IANA timezone | Europe/Paris |
| Devise par défaut | ISO 4217 | EUR |
| Footer | HTML/texte | Mentions légales, CGU, politique de confidentialité |
| Domaine personnalisé | URL | formation-scoliose.com |
| Mode RGPD strict | Bool | ON (géolocalisation UE) |

### 14.2 Configuration email (SMTP)

| Paramètre | Description |
|---|---|
| Fournisseur | SendGrid / AWS SES / SMTP personnalisé |
| Adresse d'envoi | noreply@VERTEX.com |
| Reply-to | support@VERTEX.com |
| Templates | Configuration des templates pour chaque type d'email |
| Fréquence max | Limite d'envoi par utilisateur par jour (anti-spam) |
| Domaine vérifié | SPF + DKIM + DMARC configurés |

### 14.3 Configuration paiement

| Paramètre | Description |
|---|---|
| Stripe API keys | Clés live et test (échangeables en 1 clic) |
| PayPal credentials | Client ID + Secret |
| Devises acceptées | EUR, USD, GBP, CHF (configurable) |
| TVA | Taux par pays (automatique via TaxJar/Stripe Tax) |
| Factures | Modèle, numérotation, mentions légales |
| Webhooks | URLs de callback pour Stripe, PayPal |
| Mode test | Basculement environnement test/production |

### 14.4 Intégrations (API keys et webhooks)

| Intégration | Paramètres |
|---|---|
| Stripe | API key, webhook secret, prix IDs |
| Google Analytics / Matomo | Tracking ID, domaine |
| Zoom / BBB | API key, webhook URL |
| SendGrid / SES | API key, domaine vérifié |
| Sentry | DSN, project ID |
| Slack / Teams | Webhook URL (alertes admin) |
| ANDPC API | Credentials DPC, numéro organisme |
| annuaire.sante.fr | API key (vérification RPPS) |
| Proctoring (ProctorU) | API key, callback URL |

### 14.5 SEO et méta

| Paramètre | Description |
|---|---|
| Titres des pages | Templates avec placeholders |
| Meta descriptions | Par formation, par module |
| Sitemap XML | Génération automatique |
| robots.txt | Configurable |
| Open Graph / Twitter Cards | Image + description par page |
| Structured data (JSON-LD) | Schema.org Course, Organization |
| Canonical URLs | Gestion des doublons |

---

## 15. API d'administration

### 15.1 API REST

L'ensemble des fonctionnalités admin est accessible via une **API REST documentée** (OpenAPI 3.1) :

```
Base URL : https://api.VERTEX.com/admin/v1

Authentification : Bearer token (JWT) + API key
Rate limiting : 1000 req/min (admin), 100 req/min (API key standard)
Format : JSON
Pagination : cursor-based (next_cursor)
Filtrage : query params (?status=active&country=FR&sort=-created_at)
```

#### Endpoints principaux

| Ressource | GET | POST | PUT/PATCH | DELETE |
|---|---|---|---|---|
| `/users` | Liste/filtre | Créer | Modifier | Supprimer (soft) |
| `/users/{id}/subscriptions` | Historique | Créer | Modifier | Annuler |
| `/users/{id}/progress` | Progression | — | — | Reset |
| `/subscriptions` | Liste/filtre | Créer | Modifier | Annuler |
| `/transactions` | Liste/filtre | — | Rembourser | — |
| `/invoices` | Liste/filtre | Créer (manuelle) | — | — |
| `/courses` | Liste | Créer | Modifier | Archiver |
| `/courses/{id}/modules` | Liste | Créer | Modifier/réordonner | Supprimer |
| `/modules/{id}/content` | Lire | Créer | Modifier | Supprimer |
| `/exams` | Liste | Créer | Modifier | Supprimer |
| `/exams/{id}/sessions` | Liste | Planifier | Modifier | Annuler |
| `/exams/{id}/results` | Liste | — | Réviser | — |
| `/certificates` | Liste | Générer | Révoquer | — |
| `/questions` | Liste/filtre | Créer | Modifier | Supprimer |
| `/coupons` | Liste | Créer | Modifier | Désactiver |
| `/institutions` | Liste | Créer | Modifier | Archiver |
| `/reports` | Liste | Générer | — | Supprimer |
| `/audit-logs` | Liste/filtre | — | — | — |
| `/settings` | Lire | — | Modifier | — |
| `/system/health` | Status | — | — | — |
| `/system/metrics` | Métriques | — | — | — |

### 15.2 Webhooks sortants

L'admin peut configurer des webhooks pour recevoir des événements en temps réel :

| Événement | Payload | Usage typique |
|---|---|---|
| `user.created` | User object | Sync CRM |
| `user.deleted` | User ID | Conformité |
| `subscription.created` | Subscription object | CRM, comptabilité |
| `subscription.cancelled` | Subscription + raison | Analytics churn |
| `payment.succeeded` | Transaction object | Comptabilité |
| `payment.failed` | Transaction + erreur | Relance |
| `exam.completed` | Résultat + user | Reporting |
| `certificate.issued` | Certificate object | Communication |
| `course.published` | Course object | Marketing |
| `alert.triggered` | Alerte object | Monitoring externe |

### 15.3 GraphQL (optionnel)

Endpoint GraphQL pour les requêtes complexes (dashboard custom, reporting avancé) :

```graphql
query AdminDashboard($period: DateRange!) {
  financials(period: $period) {
    mrr
    arr
    newRevenue
    churnRevenue
    byFormula { name amount count }
    byCountry { code amount count }
  }
  users(period: $period) {
    totalActive
    newRegistrations
    churnedUsers
    bySpecialty { name count }
  }
  courses {
    id name
    enrollments
    completionRate
    avgScore
  }
}
```

---

## 16. Spécifications techniques

### 16.1 Stack technique du module admin

| Composant | Technologie | Justification |
|---|---|---|
| Frontend admin | Vue.js 3 + Nuxt 3 + Vuetify/PrimeVue | Cohérence avec le LMS frontend, composants data-heavy |
| State management | Pinia | Réactivité, DevTools |
| Graphiques | Apache ECharts / Chart.js | Dashboards interactifs, performants |
| Tableaux | AG Grid (Enterprise) ou TanStack Table | Tri, filtre, pagination, export, 100K+ lignes |
| API admin | NestJS (TypeScript) | REST + GraphQL, validation, guards, interceptors |
| Authentification | Passport.js + CASL (permissions) | RBAC flexible |
| Base de données | PostgreSQL 17 + Prisma ORM | Requêtes complexes, migrations |
| Cache | Redis | Sessions admin, métriques temps réel |
| Recherche | Elasticsearch | Recherche full-text sur users, logs, content |
| File d'attente | BullMQ (Redis) | Jobs async (emails, exports, transcodage) |
| Email | SendGrid / AWS SES + MJML | Templates responsives |
| PDF | Puppeteer / @react-pdf | Factures, certificats, rapports |
| Tests | Vitest + Cypress + Playwright | Unit, integration, E2E |

### 16.2 Sécurité spécifique admin

| Mesure | Implémentation |
|---|---|
| Accès admin | Sous-domaine séparé + IP whitelist (optionnel) |
| MFA obligatoire | TOTP (Google Authenticator) ou WebAuthn (clé physique FIDO2) |
| CSRF protection | Token CSRF double-submit cookie |
| XSS protection | CSP strict + sanitization input |
| SQL injection | ORM (Prisma) + requêtes paramétrées, jamais de raw SQL sans binding |
| Rate limiting | 100 req/min par admin, 10 login attempts/15 min (fail2ban pattern) |
| Session sécurisée | Cookie HttpOnly, Secure, SameSite=Strict ; expiration 30 min |
| Chiffrement secret | Variables d'environnement via HashiCorp Vault / AWS Secrets Manager |
| Audit trail | Log immuable (HMAC signé) de chaque action admin |
| Pen testing | Test de pénétration annuel (PASSI certifié) |

### 16.3 Performance

| Métrique | Objectif |
|---|---|
| Chargement dashboard | <2s (LCP) |
| Recherche utilisateurs (10K+) | <500 ms |
| Génération rapport | <10s (cache pour les rapports récurrents) |
| Export CSV (100K lignes) | <30s (stream en arrière-plan, notification quand prêt) |
| Mise à jour temps réel | <1s (WebSocket) |
| API admin (p95) | <200 ms |

---

## 17. Planning de développement

### 17.1 Intégration dans le calendrier de production

Le module admin est développé dans le chantier **D. Plateforme LMS** (Mois 8-18) :

| Lot | Mois | Contenu admin |
|---|---|---|
| **Lot 2** | 9-10 | RBAC, gestion des rôles, sécurité admin, audit trail |
| **Lot 4** | 11-12 | Banque de questions, gestion quiz admin |
| **Lot 6** | 13-14 | Dashboard financier, gestion abonnements, Stripe admin, facturation |
| **Lot 7** | 14-15 | Analytics admin, reporting, dashboards, export |
| **Lot 8** | 15-16 | CMS admin, bibliothèque médias, workflow éditorial |
| **Lot 9** | 16-17 | Gestion examens, proctoring admin, certificats |
| **Lot 10** | 17-18 | Multi-cours, institutions, configuration système, maintenance |
| **Lot 11** | 18 | API admin, webhooks, documentation, formation admins |

### 17.2 Effort estimé

| Module admin | Effort (jours-homme) | Équipe |
|---|---|---|
| RBAC + sécurité + audit | 20 j-h | 1 backend + 1 frontend |
| Dashboard principal | 15 j-h | 1 frontend + 1 designer |
| Gestion utilisateurs | 25 j-h | 1 backend + 1 frontend |
| Gestion abonnements | 20 j-h | 1 backend + 1 frontend |
| Gestion financière | 30 j-h | 1 backend + 1 frontend |
| Gestion formations multi-cours | 20 j-h | 1 backend + 1 frontend |
| Gestion examens + certifications | 25 j-h | 1 backend + 1 frontend |
| CMS admin + médias | 25 j-h | 1 backend + 1 frontend |
| Maintenance + monitoring | 15 j-h | 1 backend (DevOps) |
| Communication + notifications | 10 j-h | 1 backend + 1 frontend |
| Analytics + reporting | 20 j-h | 1 backend + 1 data |
| Conformité RGPD + audit | 10 j-h | 1 backend |
| Configuration système | 10 j-h | 1 backend + 1 frontend |
| API REST + webhooks + docs | 15 j-h | 1 backend |
| Tests + QA + sécurité | 20 j-h | 1 QA + 1 dev |
| **TOTAL** | **280 j-h** | **~3-4 développeurs sur 10 mois** |

### 17.3 Budget estimé

| Poste | Coût |
|---|---|
| Développement admin (280 j-h × 450-600 €/j) | 126 000 — 168 000 € |
| Licence AG Grid Enterprise (ou open source TanStack) | 0 — 2 000 €/an |
| Design UX/UI admin (maquettes, design system) | 8 000 — 15 000 € |
| Pen testing dédié admin | 5 000 — 10 000 € |
| **TOTAL module admin** | **139 000 — 195 000 €** |

> Ce budget est **inclus** dans le poste « D. Développement plateforme LMS » du budget global (300 000 — 500 000 €). Le module admin représente ~40-50% du développement LMS total.

---

## Annexe A — Wireframes des écrans principaux

```
Écrans à maquetter (16 écrans principaux) :

1.  Dashboard principal (widgets configurables)
2.  Liste des utilisateurs (tableau filtrable)
3.  Fiche utilisateur détaillée (onglets)
4.  Gestion des abonnements
5.  Gestion des coupons/promotions
6.  Dashboard financier
7.  Liste des transactions
8.  Gestion des factures
9.  Catalogue des formations (multi-cours)
10. Éditeur de formation (arborescence modules)
11. Banque de questions
12. Gestion des examens
13. Gestion des certificats
14. Centre de communication (emails, notifications)
15. Configuration système
16. Audit trail / logs
```

---

## Annexe B — Checklist de recette module admin

- [ ] Authentification admin avec MFA fonctionnelle
- [ ] Tous les rôles RBAC opérationnels avec permissions correctes
- [ ] Dashboard principal avec données temps réel
- [ ] CRUD complet sur les utilisateurs (création, modification, suspension, suppression RGPD)
- [ ] Actions en masse fonctionnelles (email, prolongation, suspension)
- [ ] Gestion complète du cycle de vie des abonnements
- [ ] Coupons/promotions fonctionnels (création, application, statistiques)
- [ ] Dashboard financier avec données réelles (MRR, ARR, churn)
- [ ] Facturation automatique et manuelle conforme (TVA, mentions légales)
- [ ] Remboursements fonctionnels via Stripe
- [ ] Création d'une nouvelle formation (multi-cours) de A à Z
- [ ] Import de contenu (Markdown, Word) fonctionnel
- [ ] Banque de questions avec import CSV et statistiques
- [ ] Création et planification d'examens
- [ ] Génération de certificats avec QR code de vérification
- [ ] Reporting exportable (CSV, PDF, Excel)
- [ ] Audit trail complet (recherche, export, intégrité HMAC)
- [ ] Mode maintenance activable/planifiable
- [ ] Backup/restore testés
- [ ] API REST documentée (Swagger) et fonctionnelle
- [ ] Performance conforme aux SLA (dashboard <2s, API <200ms p95)
- [ ] Pen testing admin validé
- [ ] Documentation admin livrée

---

*Module Administration — Spécifications complètes — Version 1.0*
*Complète le CAHIER_DES_CHARGES_LMS.md avec le détail de l'interface d'administration*
*Février 2026 — Formation Scoliose avec VERTEX©*
