# CAHIER DES CHARGES — PLATEFORME LMS
## Formation en ligne sur la Scoliose avec SpineSim©

---

## 1. CONTEXTE ET OBJECTIFS

### 1.1 Contexte
Mise en place d'une plateforme de formation en ligne (Learning Management System) dédiée à la formation complète sur la scoliose, intégrant l'application de simulation biomécanique SpineSim©. La plateforme doit accueillir des professionnels de santé (chirurgiens orthopédistes, internes, kinésithérapeutes) dans un environnement sécurisé conforme aux exigences de formation médicale continue.

### 1.2 Objectifs
1. Héberger et distribuer **29 modules** de formation (~89 heures de contenu)
2. Intégrer l'application **SpineSim©** (simulation 3D temps réel)
3. Gérer un système d'évaluation progressif à **4 niveaux** (Bronze → Diamant)
4. Délivrer des **certificats de formation** reconnus (DPC, CME)
5. Accueillir **500 à 5 000 apprenants** en année 1, scalable à 20 000+
6. Conformité **RGPD**, hébergement **HDS** pour données DICOM

---

## 2. SPÉCIFICATIONS FONCTIONNELLES

### 2.1 Gestion des utilisateurs

#### 2.1.1 Inscription et authentification
- Inscription en ligne avec vérification d'identité professionnelle (numéro RPPS/ADELI pour la France)
- Authentification OAuth2/OIDC, SSO SAML 2.0 (hôpitaux, universités)
- MFA obligatoire pour accès examen et DICOM
- Profils : apprenant, tuteur, instructeur, admin institution, super admin, content manager
- Rattachement institutionnel (hôpital, université, société savante)

#### 2.1.2 Gestion des profils
- Informations personnelles : nom, prénom, email, spécialité, année d'étude/exercice
- Photo de profil, biographie courte
- Préférences : langue (FR, EN, ES, AR), thème (clair/sombre), notifications
- Portfolio de compétences (badges, certificats, scores SpineSim)

### 2.2 Gestion du contenu pédagogique

#### 2.2.1 Structure des modules
- Arborescence en 8 parties → 29 modules → sous-sections
- Déblocage séquentiel (score ≥ 70% pour passer au suivant) configurable par le formateur
- Contenu multiformat : texte riche (Markdown/HTML), vidéo, audio, PDF, images, modèles 3D interactifs
- Prise en charge SCORM 2004 et xAPI (Tin Can API)
- Sous-titres vidéo (VTT) multilingues +transcription auto (Whisper AI)

#### 2.2.2 Types de contenus
| Type | Format | Taille max | Streaming |
|------|--------|-----------|-----------|
| Vidéo cours | MP4 H.265/AV1 | 5 GB | HLS/DASH adaptatif |
| Animation 3D | WebGL/glTF/GLB | 200 MB | Chargement progressif |
| Images radiologiques | DICOM/WebP/PNG | 100 MB | Viewer DICOM intégré |
| Documents | PDF/PPTX | 50 MB | Viewer en ligne |
| Podcast/Audio | MP3/AAC | 500 MB | Streaming |
| Modèles 3D SpineSim | GLB/USDZ | 500 MB | WebGL streaming |
| Quiz interactifs | JSON/xAPI | — | Temps réel |

#### 2.2.3 Éditeur de contenu (CMS)
- Éditeur WYSIWYG médical avec support LaTeX (formules biomécaniques)
- Import Markdown, Word (.docx), PowerPoint
- Gestion des versions (historique, diff, restauration)
- Workflow de validation : brouillon → revue → approuvé → publié
- Prévisualisation responsive (desktop, tablet, mobile)
- Intégration d'images annotées (marqueurs anatomiques)
- Transcription automatique des vidéos (Whisper AI → sous-titres)

### 2.3 Système d'évaluation

#### 2.3.1 Quiz en ligne
- **QCM** (Question à Choix Multiples) : 1 ou plusieurs réponses correctes
- **QCS** (Question à Choix Simple) : 1 seule réponse
- **Cas cliniques interactifs** : scénarios avec embranchements (vidéo + texte + imagerie)
- **Identification d'images** : pointer des structures anatomiques, mesurer des angles
- **Simulation SpineSim** : évaluation pratique intégrée
- **Drag & drop** : remettre en ordre (étapes chirurgicales, algorithme diagnostique)

#### 2.3.2 Niveaux de difficulté
| Niveau | Icône | Score requis | Contenu évalué |
|--------|-------|-------------|----------------|
| Bronze | 🥉 | ≥ 70% | Connaissances de base, rappels |
| Argent | 🥈 | ≥ 75% | Application clinique, cas standards |
| Or | 🥇 | ≥ 80% | Analyse complexe, planification chirurgicale |
| Diamant | 💎 | ≥ 85% | Cas difficiles, complications, SpineSim |

#### 2.3.3 Banque de questions
- **600+ questions** réparties sur 28 modules
- Chaque question : énoncé, options, explication détaillée, références bibliographiques
- Randomisation : ordre des questions et des options
- Pool de questions : tirage aléatoire dans un pool plus large (ratio 1.5:1)
- Statistiques par question : taux de réussite, indice de discrimination, temps moyen

#### 2.3.4 Examen de certification
- Durée : 3h30 (chronométré)
- 5 sections : QCM (60 min), cas cliniques (45 min), imagerie (30 min), planification (45 min), SpineSim pratique (30 min)
- Proctoring en ligne : webcam + screen recording + IA anti-fraude
- 2 tentatives autorisées (délai 30 jours entre tentatives)
- Note ≥ 70% pour réussir
- Certificat numérique vérifiable (blockchain optionnel, QR code)

### 2.4 Intégration SpineSim©

#### 2.4.1 Lancement depuis le LMS
- Bouton de lancement contextuel dans chaque module pertinent
- Passage du contexte (module, scénario, niveau) via paramètres LTI 1.3
- Single Sign-On transparent (token JWT partagé)
- Retour automatique des scores et de la progression dans le LMS (xAPI statements)

#### 2.4.2 Scénarios pédagogiques intégrés
- Pré-configurés par module (ex : Module 15 → placement de vis pédiculaires)
- Objectifs de simulation liés aux objectifs du module
- Score SpineSim intégré dans la note du module (pondération configurable)
- Mode guidé (tutoriel) et mode libre (sandbox)

#### 2.4.3 Prérequis techniques
- Détection automatique des capacités du navigateur (WebGL2, WebAssembly, GPU)
- Message d'alerte si matériel insuffisant avec alternatives (mode simplifié, mode vidéo)
- Version de secours en streaming cloud (GPU distant) si GPU local insuffisant

### 2.5 Suivi et analytics

#### 2.5.1 Dashboard apprenant
- Progression globale (barre de progression par partie et module)
- Radar de compétences (anatomie, imagerie, chirurgie, biomécanique...)
- Historique des quiz (score, temps, évolution)
- Badges et certificats obtenus
- Recommandations personnalisées (module suivant, révision, SpineSim)
- Temps total passé, streak de connexion

#### 2.5.2 Dashboard instructeur/tuteur
- Vue d'ensemble de la cohorte (progression moyenne, taux complétion)
- Identification des étudiants en difficulté (alerte inactivité > 14j, échecs répétés)
- Analyse par question (taux de réussite, temps, discrimination)
- Comparaison inter-cohortes
- Export CSV/PDF des rapports
- Messagerie directe aux apprenants

#### 2.5.3 Dashboard administrateur
- KPI globaux : inscriptions, taux de complétion, CA, NPS
- Statistiques par institution, par pays
- Utilisation des ressources serveur (GPU, bande passante)
- Conformité et audit (logs, RGPD)

### 2.6 Communication et collaboration

- **Forum de discussion** : par module, avec modération et recherche
- **Messagerie privée** : entre apprenant et tuteur/instructeur
- **Webinaires live** : intégration Zoom/Teams/BBB (Big Blue Button)
- **Annotations collaboratives** : annotation partagée sur images et 3D
- **Notifications** : email, push navigateur, in-app (nouveau contenu, deadline, live session)

### 2.7 Paiement et facturation

#### 2.7.1 Modèles de tarification
| Formule | Contenu | Prix indicatif | Durée |
|---------|---------|----------------|-------|
| **Découverte** | Modules 1-3 (fondamentaux) | Gratuit | Illimité |
| **Essentiel** | Modules 1-14 (diagnostic + pathologies) | 290€ | 12 mois |
| **Standard** | Tous modules sans SpineSim | 490€ | 12 mois |
| **Premium** | Tous modules + SpineSim complet + VR | 890€ | 12 mois |
| **Certification** | Premium + examen + certificat | 1 190€ | 12 mois |
| **Institutionnel** | Licence par siège (min 10) | 590€/siège | 12 mois |

#### 2.7.2 Passerelle de paiement
- Stripe (CB, Apple Pay, Google Pay)
- PayPal
- Virement bancaire (institutionnel)
- Prise en charge DPC/OPCO (France) : intégration des formulaires administratifs
- Factures automatiques (PDF), conformité TVA intra-UE

### 2.8 Internationalisation

- Interface multilingue : français (principal), anglais, espagnol, arabe
- Contenu traduit professionnellement (pas de traduction automatique pour le médical)
- Adaptation culturelle des cas cliniques par région
- Fuseau horaire configurable
- Monnaie locale pour la facturation
- RTL support pour l'arabe

---

## 3. SPÉCIFICATIONS TECHNIQUES

### 3.1 Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                      Utilisateurs                               │
│  Desktop (Chrome/Firefox/Edge) │ Mobile (PWA) │ VR (Quest)      │
└────────────────────────────────┴──────────────┴─────────────────┘
                    │                    │                │
         ┌──────────▼────────────────────▼────────────────▼──────┐
         │                    CDN / WAF                          │
         │              (CloudFlare / CloudFront)                │
         └──────────────────────┬────────────────────────────────┘
                                │
         ┌──────────────────────▼────────────────────────────────┐
         │                Load Balancer (ALB)                     │
         │              TLS 1.3 termination                      │
         └────────┬─────────────┬─────────────┬──────────────────┘
                  │             │             │
         ┌────────▼──────┐ ┌───▼─────┐ ┌─────▼───────┐
         │  LMS Backend  │ │SpineSim │ │ Media Server│
         │  (Node.js /   │ │ API     │ │ (Video      │
         │   Django)     │ │ (Julia  │ │  streaming) │
         │               │ │  Genie) │ │             │
         └────────┬──────┘ └───┬─────┘ └─────┬───────┘
                  │            │              │
         ┌────────▼────────────▼──────────────▼──────────────────┐
         │                   Data Layer                           │
         │  PostgreSQL │ Redis │ S3/MinIO │ Elasticsearch        │
         └───────────────────────────────────────────────────────┘
```

### 3.2 Stack technologique

| Couche | Technologie | Justification |
|--------|-------------|---------------|
| **Frontend LMS** | Vue.js 3 / Nuxt 3 | SSR, performances, écosystème riche |
| **Backend LMS** | Node.js (NestJS) ou Python (Django) | Robustesse, communauté, ORM mature |
| **Backend SpineSim** | Julia (Genie.jl) | Performance calcul scientifique, FEM |
| **Base de données** | PostgreSQL 16 + pgvector | Données relationnelles, recherche vectorielle |
| **Cache** | Redis 7 Cluster | Sessions, cache, queues, rate limiting |
| **Stockage objets** | AWS S3 / MinIO | Vidéos, modèles 3D, DICOM, sauvegardes |
| **Recherche** | Elasticsearch / OpenSearch | Full-text, logs, analytics |
| **Video streaming** | AWS MediaConvert + CloudFront | Transcodage HLS/DASH, DRM |
| **Message broker** | RabbitMQ / Apache Kafka | Async (FEM jobs, notifications, xAPI) |
| **CI/CD** | GitHub Actions | Build, test, deploy (voir SpineSim specs) |
| **Monitoring** | Prometheus + Grafana + Sentry | Métriques, alertes, error tracking |
| **Container** | Docker + Kubernetes (EKS/GKE) | Orchestration, scaling, déploiement |

### 3.3 Performance

| Métrique | Objectif | Mesure |
|----------|----------|--------|
| TTFB (Time To First Byte) | < 200 ms | Synthetics |
| LCP (Largest Contentful Paint) | < 2.5s | Lighthouse |
| FID (First Input Delay) | < 100 ms | RUM |
| CLS (Cumulative Layout Shift) | < 0.1 | Lighthouse |
| Score Lighthouse | ≥ 90 (performance) | CI/CD |
| Temps chargement vidéo | < 3s (start playback) | RUM |
| Temps lancement SpineSim | < 10s | RUM |
| API response p95 | < 200 ms | APM |
| Uptime | 99.9% | Monitoring |

### 3.4 Sécurité (résumé)
- Voir **SPINESIM_SPECIFICATIONS_TECHNIQUES.md §12** pour le détail complet
- Chiffrement TLS 1.3 + données au repos AES-256
- Authentification OAuth2/OIDC + MFA
- Conformité RGPD, hébergement HDS
- WAF, rate limiting, audit logs
- Pen testing annuel (PASSI)

### 3.5 Intégrations externes

| Système | Protocole | Usage |
|---------|-----------|-------|
| LRS (Learning Record Store) | xAPI (Tin Can) | Stockage des traces d'apprentissage |
| LMS tiers (Moodle, Canvas) | LTI 1.3 | Intégration SpineSim dans LMS existants |
| Viewer DICOM | DICOMweb (WADO-RS) | Affichage images médicales |
| Visioconférence | API Zoom/Teams/BBB | Webinaires live |
| DPC / ANDPC | API DPC | Déclaration des actions de formation |
| Stripe | API REST + webhooks | Paiement |
| SMTP | SMTP/SendGrid/SES | Emails transactionnels |
| Analytics | Google Analytics 4 / Matomo | Usage du site (RGPD-compliant avec Matomo) |

---

## 4. HÉBERGEMENT ET INFRASTRUCTURE

### 4.1 Environnements

| Environnement | Usage | Infra |
|---------------|-------|-------|
| **Développement** | Dev + tests locaux | Docker Compose local |
| **Staging** | Tests d'intégration, UAT | K8s cluster dédié (1 node) |
| **Pre-production** | Tests de charge, validation finale | K8s (réplique production réduite) |
| **Production** | Utilisateurs réels | K8s multi-node, GPU, HA |

### 4.2 Dimensionnement production (année 1)

| Ressource | Quantité | Coût estimé/mois |
|-----------|----------|-------------------|
| Serveurs API (K8s nodes) | 3-6 nodes (4 vCPU, 16 GB RAM) | 400-800€ |
| GPU nodes (SpineSim FEM) | 1-3 nodes (NVIDIA T4/A10G) | 800-2400€ |
| PostgreSQL (RDS) | db.r6g.xlarge + replica | 600€ |
| Redis (ElastiCache) | cache.r6g.large (3 nodes) | 400€ |
| S3 stockage | ~5 TB (vidéos, modèles, DICOM) | 120€ |
| CDN (CloudFront) | ~10 TB/mois transfert | 300€ |
| Monitoring (Grafana Cloud) | Pro tier | 50€ |
| Backups cross-region | ~500 GB | 15€ |
| **TOTAL** | | **~2 700 - 4 700€/mois** |

### 4.3 Hébergeur HDS recommandé
- **OVHcloud** (HDS certifié, datacenters France) — option économique
- **Scaleway** (HDS certifié, Paris/Amsterdam) — K8s Kapsule
- **AWS** (HDS via partenaire certifié) — flexibilité maximale, GPU
- **Azure** (HDS via partenaire certifié) — intégration Microsoft SSO

---

## 5. LIVRABLES ET PLANNING

### 5.1 Lots de livraison

| Lot | Contenu | Délai |
|-----|---------|-------|
| **Lot 1** | Architecture, design system, base technique | Mois 1-2 |
| **Lot 2** | Auth, gestion utilisateurs, profils | Mois 2-3 |
| **Lot 3** | CMS, import contenu, lecteur vidéo | Mois 3-5 |
| **Lot 4** | Système de quiz et évaluation | Mois 5-6 |
| **Lot 5** | Intégration SpineSim (LTI, SSO, xAPI) | Mois 6-8 |
| **Lot 6** | Paiement, facturation, DPC | Mois 7-8 |
| **Lot 7** | Analytics, dashboards, reporting | Mois 8-9 |
| **Lot 8** | PWA, mode hors-ligne, responsive | Mois 9-10 |
| **Lot 9** | Tests, optimisation, sécurité | Mois 10-11 |
| **Lot 10** | Lancement beta, formation admins | Mois 11-12 |
| **Lot 11** | Lancement public, support | Mois 12 |

### 5.2 Critères de recette

- [ ] Inscription et authentification fonctionnelles (SSO, MFA)
- [ ] 29 modules accessibles avec contenu multimédia
- [ ] Quiz fonctionnels aux 4 niveaux de difficulté
- [ ] SpineSim intégré et lançable depuis chaque module pertinent
- [ ] Scores SpineSim remontés dans le LMS
- [ ] Examen de certification avec proctoring opérationnel
- [ ] Paiement par CB et virement fonctionnel
- [ ] Dashboards apprenant, instructeur et admin opérationnels
- [ ] Performance conforme aux SLA (TTFB, LCP, uptime)
- [ ] Tests de sécurité validés (pentesting, RGPD)
- [ ] Documentation technique et utilisateur livrée
- [ ] Formation des administrateurs réalisée

---

## 6. MAINTENANCE ET SUPPORT

### 6.1 SLA

| Priorité | Description | Temps de réponse | Temps de résolution |
|----------|-------------|-----------------|---------------------|
| **Critique** | Plateforme inaccessible, perte de données | 30 min | 4h |
| **Haute** | Fonctionnalité majeure indisponible (quiz, SpineSim) | 2h | 24h |
| **Moyenne** | Bug fonctionnel non bloquant | 8h | 72h |
| **Basse** | Amélioration, question | 24h | 2 semaines |

### 6.2 Mises à jour
- **Contenu** : mise à jour annuelle (nouvelles publications, recommandations)
- **Sécurité** : patches critiques sous 48h
- **Fonctionnalités** : releases trimestrielles (sprint 2 semaines)
- **SpineSim** : mises à jour selon le plan de développement (voir specs techniques)

---

*Cahier des charges LMS — Formation Scoliose avec SpineSim© — Version 1.0*
*Document de référence pour la sélection du prestataire et le développement de la plateforme*
