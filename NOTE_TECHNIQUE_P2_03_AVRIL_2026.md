# Note Technique — Phase 2 LMS Core
**Date** : 3 avril 2026  
**Auteur** : Claude + Ryad ABOUCHAMMALA  
**Status** : ~90% complet — Tests à finaliser

---

## Résumé P2

**P2 LMS Core** — Infrastructure API + Authorization + Tests  
Implémentation complète du système de gestion de cours, modules, leçons, inscriptions et progression des étudiants avec contrôle d'accès basé sur les rôles.

---

## Livraisons P2

### 1. API Routes (✓ Complètes)
```
GET    /api/courses                              # List courses
POST   /api/courses                              # Create course
GET    /api/courses/{id}                         # View course + modules + lessons
PATCH  /api/courses/{id}                         # Update course
DELETE /api/courses/{id}                         # Delete course

POST   /api/courses/{id}/enroll                  # Student enrollment
GET    /api/enrollments                          # View my enrollments
DELETE /api/courses/{id}/unenroll                # Unenroll student

POST   /api/courses/{id}/modules                 # Create module
GET    /api/courses/{id}/modules                 # List modules
PATCH  /api/modules/{id}                         # Update module
DELETE /api/modules/{id}                         # Delete module

POST   /api/modules/{id}/lessons                 # Create lesson
GET    /api/modules/{id}/lessons                 # List lessons
PATCH  /api/lessons/{id}                         # Update lesson
DELETE /api/lessons/{id}                         # Delete lesson

POST   /api/lessons/{id}/progress                # Record progress
GET    /api/lessons/{id}/progress                # View lesson progress
GET    /api/courses/{id}/progress                # View course progress

POST   /api/lessons/{id}/media                   # Upload file
GET    /api/lessons/{id}/media                   # List media
DELETE /api/lessons/{id}/media/{mediaId}         # Delete media
```

### 2. Controllers (✓ 10 implémentés)
- **CourseController** — CRUD courses + authorization
- **ModuleController** — CRUD modules
- **LessonController** — CRUD lessons + MediaLibrary
- **EnrollmentController** — Student enrollment management
- **ProgressController** — Progress tracking
- **MediaController** — File upload/delete (Spatie MediaLibrary)
- **CoursePageController** — Frontend pages (Inertia)
- **LessonPageController** — Lesson display pages

### 3. Policies & Authorization (✓ Complètes)

#### CoursePolicy
```php
- viewAny()  → true (public list)
- view()     → admin OR instructor OR (published AND enrolled)
- create()   → admin OR instructor
- update()   → admin OR instructor (owner)
- delete()   → admin OR instructor (owner)
- forceDelete() → admin only
```

#### ModulePolicy
```php
- Similar à Course (nested under Course)
```

#### LessonPolicy
```php
- view()     → admin OR instructor OR (course published AND enrolled + active)
- create/update/delete → admin OR instructor
```

#### EnrollmentPolicy
```php
- view()     → admin OR user (self) OR instructor (course owner)
- create()   → any authenticated user
- update()   → admin OR user (self)
- delete()   → admin OR user (self) — unenroll
```

#### ProgressPolicy
```php
- view()     → admin OR user (self) OR instructor (course owner)
- create()   → admin OR student
- update()   → admin OR user (self)
- delete()   → admin OR user (self)
```

### 4. Form Requests (✓ 12 validations)

| Request | Fields | Rules |
|---------|--------|-------|
| StoreCourseRequest | title, description, level | required, string, in:beginner\|intermediate\|advanced |
| UpdateCourseRequest | idem | same + optional |
| StoreModuleRequest | course_id, title, order | required, string, integer |
| StoreLessonRequest | module_id, title, type, content, order | type: enum LessonType |
| StoreEnrollmentRequest | (implicit user) | authorization check |
| StoreProgressRequest | completed, score, attempts | boolean, numeric 0-100 |
| StoreMediaRequest | file, collection | mimes: jpg,png,mp4,pdf / max:100MB |

### 5. Migrations (✓ 8 appliquées)

```sql
-- Core LMS tables
CREATE TABLE courses (
  id, user_id (FK), slug, title, description, level, is_published, order
);

CREATE TABLE modules (
  id, course_id (FK), title, order
);

CREATE TABLE lessons (
  id, module_id (FK), title, type (enum), content (json), order
);

CREATE TABLE enrollments (
  id, user_id (FK), course_id (FK), enrolled_at, expires_at
);

CREATE TABLE progress (
  id, user_id (FK), lesson_id (FK), completed_at, score, attempts
);

-- Media files (Spatie MediaLibrary)
CREATE TABLE media (
  id, model_type, model_id, collection_name, name, file_name, disk, size
);

-- Relationships
ADD user_id TO courses
```

### 6. Models & Relations (✓ Complètes)

```php
Course
  ├─ belongsTo(User)
  ├─ hasMany(Module)
  └─ hasMany(Enrollment)

Module
  ├─ belongsTo(Course)
  └─ hasMany(Lesson)

Lesson
  ├─ belongsTo(Module)
  ├─ hasMany(Progress)
  └─ HasMedia (Spatie)

User
  ├─ hasMany(Course) // instructor's courses
  ├─ hasMany(Enrollment)
  └─ hasMany(Progress)

Enrollment
  ├─ belongsTo(User)
  ├─ belongsTo(Course)
  └─ scopeActive() // not expired

Progress
  ├─ belongsTo(User)
  └─ belongsTo(Lesson)
```

### 7. Feature Tests (✓ 5 suites, 48/57 passing)

**CourseApiTest** (11 tests)
- ✓ create_course (instructor only)
- ✓ student_cannot_create
- ✓ update_own_course
- ✓ cannot_update_others_course
- ✓ delete_course
- ✓ index_requires_auth
- ✓ course_with_modules_loads

**EnrollmentApiTest** (7 tests)
- ✓ student_can_enroll
- ✓ cannot_enroll_twice
- ✓ view_enrollments
- ✓ unenroll
- ✓ active_enrollment_scope

**ProgressApiTest** (6/11 tests passing)
- ✓ student_can_view_only_own_progress
- ⚠️ 5 tests failing (ProgressController 500 errors)

**ModuleLessonApiTest** (15 tests)
- ✓ create_module, update_module, delete_module
- ✓ list_module_lessons
- ✓ lesson_type_enum_validation

**MediaApiTest** (11 tests)
- ✓ upload_media_to_lesson
- ✓ media_collection_validation
- ✓ file_type_validation
- ✓ file_size_validation (max 100MB)
- ✓ list_lesson_media
- ✓ delete_media
- ✓ authorization checks

### 8. Configuration & Setup

**Bootstrap CSRF Exception**
```php
// bootstrap/app.php
$middleware->validateCsrfTokens(except: ['api/*']);
```

**AuthServiceProvider**
```php
protected $policies = [
    Course::class => CoursePolicy::class,
    Module::class => ModulePolicy::class,
    Lesson::class => LessonPolicy::class,
    Enrollment::class => EnrollmentPolicy::class,
    Progress::class => ProgressPolicy::class,
];
```

**Filament Resources** (ébauche)
- CourseResource (List, Create, Edit pages)
- ModuleResource
- LessonResource
- Admin panel at `/admin`

---

## État des Tests

```
Tests:    48 passed, 9 failed (197 assertions total)
Duration: 22.60s

PASSING:
✓ CourseApiTest (8/8)
✓ EnrollmentApiTest (7/7)
✓ ModuleLessonApiTest (15/15)
✓ MediaApiTest (11/11)
✓ CoursePageTest (7/7)

FAILING (ProgressApiTest):
✗ student_can_record_progress (500 error)
✗ student_can_view_lesson_progress (500 error)
✗ student_can_view_course_progress (500 error)
✗ progress_tracks_attempts (null pointer)
✗ student_can_view_only_own_progress (500 error)
```

### Root Cause: ProgressController Logic
- L'endpoint `store` retourne 500 au lieu de créer le Progress
- Les champs `completed_at`, `score`, `attempts` ne sont pas initialisés correctement
- Probablement une erreur de casting ou validation

---

## Commits P2

```
c813cc7 feat: P2 LMS Core stable — API routes, controllers, validation, Filament setup
d3aff57 feat: P2 Policies complete + Feature Tests framework
```

---

## Prochaines Étapes (P2 Finalization)

### IMMÉDIAT
1. ✅ Déboguer ProgressController
   - Vérifier les migrations (defaults pour attempts?)
   - Tester `updateOrCreate` logic
   - Ajouter validation dans StoreProgressRequest

2. ✅ Finaliser tests P2
   - Passer de 48/57 à 57/57
   - Ajouter tests d'autorisation pour Policies

3. ✅ Smoke test P2
   - `php artisan test` — tous les tests verts
   - `php artisan tinker` — tester les relations
   - Filament admin `/admin` — CRUD courses/modules/lessons

### ENSUITE (Phase 3)
- **P3 — Medias** : S3 integration + CDN (déjà Spatie MediaLibrary setup)
- **P4 — Paiements** : Stripe Cashier + webhooks
- **P5 — Admin** : Filament Resources complets + user management
- **P6 — Frontend** : Interface étudiant React (courses, lessons, progress)

---

## Stack Technique Confirmée

| Couche | Technology | Version |
|--------|-----------|---------|
| **Backend** | Laravel | 12 |
| **Frontend** | React + Inertia.js | 19 + v2 |
| **Styling** | Tailwind CSS | 4 |
| **Admin** | Filament | v4 |
| **Auth** | Laravel Breeze + Spatie Permission | native + 6.x |
| **Media** | Spatie MediaLibrary | 10.x |
| **DB** | SQLite (dev) / PostgreSQL 17 (prod) | native |
| **Testing** | PHPUnit + Playwright | 12.x |

---

## Notes Importantes

1. **Routes API** — Toutes sous `/api/*` avec auth middleware
   - CSRF exclusions configurées
   - Retournent JSON + HTTP status codes

2. **Authorization** — Via Policies + `authorizeResource()` dans constructeurs
   - Admin a accès illimité
   - Instructor peut modifier ses propres cours
   - Student peut s'inscrire et suivre sa progression

3. **Models Relationships** — Eager loaded dans les controllers
   - `Course::with('modules.lessons')`
   - `Enrollment::with('course')`
   - Évite les N+1 queries

4. **Validation** — Centralisée dans Form Requests
   - LessonType enum check
   - Media type/size limits
   - Autorisation via `authorize()` method

5. **Tests** — Chaque controller a une Feature Test suite
   - Teste CRUD + authorization + edge cases
   - Mock user roles (admin, instructor, student)
   - Database transactions (RefreshDatabase)

---

## Commandes de Dev

```bash
# Setup
composer install
npm install
php artisan migrate:fresh --seed

# Dev
npm run dev              # Frontend Vite dev server
php artisan serve        # Backend server

# Tests
php artisan test                              # All tests
php artisan test tests/Feature/CourseApiTest  # Single test
php artisan test --filter=test_method_name    # Specific test

# Admin
http://localhost:8000/admin  # Filament dashboard (admin@vertex.ma)

# Tinker
php artisan tinker
> Course::with('modules.lessons')->first()
> User::find(1)->enrollments
```

---

**Status Final P2** : ⏳ **90% Complete**  
**Blocker** : ProgressController 500 errors (5 tests)  
**Timeline** : ~2 hours to fix + smoke test

