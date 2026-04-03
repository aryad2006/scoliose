# Note Technique — 3 avril 2026

## Objet : Lancement developpement VERTEX LMS Next-Gen

---

## Decisions prises

### Stack retenue
- **Laravel 12** + PHP 8.4 (backend)
- **React 19** + TypeScript + Vite + Tailwind CSS (frontend)
- **Inertia.js v2** (routing SPA sans API separee)
- **Laravel Breeze** (authentification)
- **Spatie Laravel Permission** (roles admin/instructor/student)
- **Filament v4** (panel admin sur /admin)
- **SQLite** en developpement, PostgreSQL 17 en production

### Architecture
- Projet mono-tenant au demarrage, multi-tenancy (stancl/tenancy) ajoutee en Phase 2+
- Pas de Docker en developpement — PHP, Node.js et Composer natifs
- Docker reserve a la mise en production

### Modele de donnees initial
5 tables fondamentales :
- **courses** — slug, title, description, level, is_published, order
- **modules** — course_id (FK), title, order
- **lessons** — module_id (FK), title, type (video|text|image|quiz|sim3d), content_json, order
- **enrollments** — user_id + course_id, enrolled_at, expires_at (scope active)
- **progress** — user_id + lesson_id, completed_at, score, attempts

### Roles et acces
| Role | Filament | CRUD cours | Consultation |
|---|---|---|---|
| admin | Oui | Global | Tout |
| instructor | Non | Ses cours | Tout |
| student | Non | Non | Cours publies + enrolled |

### Users de dev (seeder)
- admin@vertex.ma / password
- instructor@vertex.ma / password
- student@vertex.ma / password

---

## Plan d'implementation Phase 1

9 tasks sequentielles :

1. Setup Laravel 12 + Breeze React/TS + SQLite
2. Install Spatie Permission + Filament v4
3. Enum LessonType + 5 migrations
4. Models avec relations (Course, Module, Lesson, Enrollment, Progress)
5. Seeder roles + users de dev
6. Policies (CoursePolicy, LessonPolicy)
7. Tests models & relations (factories + Feature tests)
8. Tests roles & policies
9. Smoke test final (auth, Filament, Tinker)

**Spec detaillee** : `docs/superpowers/specs/2026-04-03-p1-foundation-design.md`
**Plan detaille** : `docs/superpowers/plans/2026-04-03-p1-foundation-plan.md`

---

## Phases suivantes (rappel)

| Phase | Contenu | Statut |
|---|---|---|
| P1 — Foundation | Squelette Laravel + React + Auth + Models | **En cours** |
| P2 — LMS Core | CRUD cours/modules/lecons + progression | A venir |
| P3 — Medias | Upload S3 + CDN + Spatie Media Library | A venir |
| P4 — Paiements | Stripe Cashier + webhooks | A venir |
| P5 — Admin | Filament Resources complets | A venir |
| P6 — Frontend | Interface etudiant React mobile-first | A venir |

**MVP = P1 a P6**

---

## Environnement de dev

- Windows 11 Pro
- PHP 8.4.17
- Node.js 24.13.0
- Composer 2.9.5
- Pas de Docker, XAMPP ou Laragon

**Auteur** : Ryad ABOUCHAMMALA
**Date** : 3 avril 2026
