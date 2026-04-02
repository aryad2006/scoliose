# Spec P1 — Foundation VERTEX LMS

**Date** : 3 avril 2026
**Scope** : Phase 1 — Squelette Laravel 12 + React 19 + Auth + Roles + Migrations fondamentales

---

## 1. Objectif

Creer le socle technique du LMS VERTEX : projet Laravel 12 avec Inertia.js v2, React 19 TypeScript, authentification Breeze, roles Spatie, panel admin Filament v4, et les migrations de base (courses, modules, lessons, progress, enrollments).

## 2. Stack technique

| Couche | Technologie |
|---|---|
| Backend | Laravel 12 + PHP 8.4 |
| Frontend | React 19 + TypeScript + Vite + Tailwind CSS |
| Routing | Inertia.js v2 |
| Auth | Laravel Breeze (Inertia/React) |
| Roles | Spatie Laravel Permission |
| Admin | Filament v4 (panel installe, Resources en P5) |
| BDD dev | SQLite |
| BDD prod | PostgreSQL 17 (plus tard) |

## 3. Structure projet

```
vertex-lms/
├── app/
│   ├── Models/
│   │   ├── User.php                 # Breeze + HasRoles (Spatie)
│   │   ├── Course.php               # HasMany modules
│   │   ├── Module.php               # BelongsTo course, HasMany lessons
│   │   ├── Lesson.php               # type enum, content_json
│   │   ├── Progress.php             # BelongsTo user + lesson
│   │   └── Enrollment.php           # BelongsTo user + course
│   ├── Enums/
│   │   └── LessonType.php           # video|text|image|quiz|sim3d
│   ├── Policies/
│   │   ├── CoursePolicy.php         # admin/instructor: CRUD, student: view
│   │   └── LessonPolicy.php         # enrolled students only
│   └── Filament/
│       └── (panel installe, Resources vides)
├── resources/js/
│   ├── Pages/
│   │   ├── Dashboard.tsx
│   │   ├── Welcome.tsx
│   │   └── Auth/                    # Breeze genere
│   ├── Components/
│   ├── Layouts/
│   │   └── AuthenticatedLayout.tsx  # Breeze genere
│   └── types/
│       └── index.d.ts
├── database/
│   ├── migrations/
│   └── seeders/
│       └── RolesAndUsersSeeder.php
└── .env                             # DB_CONNECTION=sqlite
```

## 4. Migrations

### 4.1 courses
```
id              — bigIncrements
slug            — string, unique
title           — string
description     — text, nullable
cover_image     — string, nullable
category        — string, nullable
level           — enum (beginner, intermediate, advanced), default beginner
is_published    — boolean, default false
order           — unsignedInteger, default 0
timestamps
```

### 4.2 modules
```
id              — bigIncrements
course_id       — foreignId, constrained, cascadeOnDelete
title           — string
order           — unsignedInteger, default 0
timestamps
```

### 4.3 lessons
```
id              — bigIncrements
module_id       — foreignId, constrained, cascadeOnDelete
title           — string
type            — enum (video, text, image, quiz, sim3d), default text
content_json    — json, nullable
order           — unsignedInteger, default 0
duration_minutes — unsignedInteger, nullable
timestamps
```

### 4.4 enrollments
```
id              — bigIncrements
user_id         — foreignId, constrained, cascadeOnDelete
course_id       — foreignId, constrained, cascadeOnDelete
enrolled_at     — timestamp
expires_at      — timestamp, nullable
timestamps

unique(user_id, course_id)
```

### 4.5 progress
```
id              — bigIncrements
user_id         — foreignId, constrained, cascadeOnDelete
lesson_id       — foreignId, constrained, cascadeOnDelete
completed_at    — timestamp, nullable
score           — unsignedTinyInteger, nullable
attempts        — unsignedInteger, default 0
timestamps

unique(user_id, lesson_id)
```

## 5. Models — Relations

```
User
  -> hasMany(Enrollment)
  -> hasMany(Progress)
  -> HasRoles (Spatie trait)

Course
  -> hasMany(Module)
  -> hasMany(Enrollment)
  -> scopePublished(): where('is_published', true)
  -> getModulesOrderedAttribute(): modules()->orderBy('order')

Module
  -> belongsTo(Course)
  -> hasMany(Lesson)
  -> getLessonsOrderedAttribute(): lessons()->orderBy('order')

Lesson
  -> belongsTo(Module)
  -> hasMany(Progress)
  -> cast content_json as array
  -> cast type as LessonType enum

Enrollment
  -> belongsTo(User)
  -> belongsTo(Course)
  -> scopeActive(): where(fn => whereNull('expires_at')->orWhere('expires_at', '>', now()))

Progress
  -> belongsTo(User)
  -> belongsTo(Lesson)
  -> isCompleted(): completed_at !== null
```

## 6. Enum LessonType

```php
enum LessonType: string
{
    case Video = 'video';
    case Text = 'text';
    case Image = 'image';
    case Quiz = 'quiz';
    case Sim3d = 'sim3d';
}
```

## 7. Auth & Roles

### 7.1 Roles Spatie
- `admin` — acces Filament, CRUD global
- `instructor` — CRUD ses propres cours
- `student` — consultation, progression

### 7.2 Policies

**CoursePolicy** :
- viewAny : tous les users authentifies
- view : tous (si publie) ou admin/instructor (si brouillon)
- create/update/delete : admin ou instructor (owner)

**LessonPolicy** :
- view : admin, instructor du cours, ou student enrolled

### 7.3 Seeder initial
- 1 admin : admin@vertex.ma / password
- 1 instructor : instructor@vertex.ma / password
- 1 student : student@vertex.ma / password

## 8. Filament v4

- Panel admin sur `/admin`
- Acces restreint : role `admin` uniquement (canAccessPanel)
- Resources Filament vides a ce stade (developpees en P5)

## 9. Packages a installer

```
composer require laravel/breeze --dev
composer require spatie/laravel-permission
composer require filament/filament
```

## 10. Hors scope

- Multi-tenancy (stancl/tenancy) — reporte
- Paiements Stripe/Cashier — P4
- Upload medias S3 / Spatie Media Library — P3
- Simulation 3D — P7
- Tuteur IA / pgvector — P8
- Docker — uniquement pour prod

## 11. Criteres de succes

1. `php artisan serve` lance le backend sans erreur
2. `npm run dev` lance Vite/React sans erreur
3. Pages auth fonctionnelles (register, login, logout)
4. 3 users seedees avec roles corrects
5. Panel Filament accessible sur /admin (admin uniquement)
6. Migrations executees, tables creees en SQLite
7. Models avec relations testables via Tinker
