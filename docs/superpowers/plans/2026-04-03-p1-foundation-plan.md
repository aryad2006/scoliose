# P1 — Foundation VERTEX LMS — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Create the Laravel 12 + React 19 technical foundation for VERTEX LMS with auth, roles, admin panel, and core data models.

**Architecture:** Laravel 12 monolith with Inertia.js v2 bridging to React 19 TypeScript frontend. SQLite for dev. Breeze for auth, Spatie for roles, Filament v4 for admin panel. Project lives in `vertex-lms/` subdirectory within the scoliose repo.

**Tech Stack:** PHP 8.4, Laravel 12, React 19, TypeScript, Inertia.js v2, Vite, Tailwind CSS, Spatie Permission, Filament v4, SQLite

---

## File Map

### Files created by scaffolding (Task 1-2)
- `vertex-lms/` — entire Laravel 12 project (Breeze generates auth pages, layouts, etc.)

### Files to create manually
- `vertex-lms/app/Enums/LessonType.php` — lesson type enum
- `vertex-lms/database/migrations/xxxx_create_courses_table.php`
- `vertex-lms/database/migrations/xxxx_create_modules_table.php`
- `vertex-lms/database/migrations/xxxx_create_lessons_table.php`
- `vertex-lms/database/migrations/xxxx_create_enrollments_table.php`
- `vertex-lms/database/migrations/xxxx_create_progress_table.php`
- `vertex-lms/app/Models/Course.php`
- `vertex-lms/app/Models/Module.php`
- `vertex-lms/app/Models/Lesson.php`
- `vertex-lms/app/Models/Enrollment.php`
- `vertex-lms/app/Models/Progress.php`
- `vertex-lms/database/seeders/RolesAndUsersSeeder.php`
- `vertex-lms/app/Policies/CoursePolicy.php`
- `vertex-lms/app/Policies/LessonPolicy.php`
- `vertex-lms/tests/Feature/Models/CourseTest.php`
- `vertex-lms/tests/Feature/Models/EnrollmentTest.php`
- `vertex-lms/tests/Feature/Models/ProgressTest.php`
- `vertex-lms/tests/Feature/Auth/RolesTest.php`
- `vertex-lms/tests/Feature/Policies/CoursePolicyTest.php`
- `vertex-lms/tests/Feature/Policies/LessonPolicyTest.php`

### Files to modify
- `vertex-lms/app/Models/User.php` — add HasRoles trait, relations
- `vertex-lms/database/seeders/DatabaseSeeder.php` — call RolesAndUsersSeeder
- `vertex-lms/app/Providers/Filament/AdminPanelProvider.php` — restrict to admin role

---

## Task 1: Create Laravel 12 project + Breeze React/TS

**Files:**
- Create: `vertex-lms/` (entire Laravel scaffold)

- [ ] **Step 1: Create Laravel project**

```bash
cd /c/Users/USER/Documents/scoliose
composer create-project laravel/laravel vertex-lms
```

- [ ] **Step 2: Install Breeze with React + TypeScript**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
composer require laravel/breeze --dev
php artisan breeze:install react --typescript
```

- [ ] **Step 3: Configure SQLite**

Edit `vertex-lms/.env`:
```
DB_CONNECTION=sqlite
# Remove or comment out DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD lines
```

Create the SQLite database file:
```bash
touch /c/Users/USER/Documents/scoliose/vertex-lms/database/database.sqlite
```

- [ ] **Step 4: Run initial migrations + install npm deps**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan migrate
npm install
```

- [ ] **Step 5: Verify everything works**

Run in two terminals (or background one):
```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan serve
```
```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
npm run dev
```

Visit `http://localhost:8000` — should see Laravel welcome page.
Visit `http://localhost:8000/register` — should see Breeze register form.

- [ ] **Step 6: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git init
git add -A
git commit -m "feat: init Laravel 12 + Breeze React/TS + SQLite"
```

---

## Task 2: Install Spatie Permission + Filament v4

**Files:**
- Modify: `vertex-lms/app/Models/User.php`
- Create: `vertex-lms/app/Providers/Filament/AdminPanelProvider.php` (via artisan)

- [ ] **Step 1: Install Spatie Permission**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

- [ ] **Step 2: Add HasRoles trait to User model**

Modify `vertex-lms/app/Models/User.php` — add the trait import and usage:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

- [ ] **Step 3: Install Filament v4**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
composer require filament/filament
php artisan filament:install --panels
```

When prompted for the panel ID, enter: `admin`

- [ ] **Step 4: Restrict Filament to admin role**

Modify `vertex-lms/app/Providers/Filament/AdminPanelProvider.php` — in the `panel()` method, find the `->login()` line and add auth gate. Also modify `vertex-lms/app/Models/User.php` to implement `FilamentUser`:

```php
<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }
}
```

- [ ] **Step 5: Verify Filament panel loads**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan serve
```

Visit `http://localhost:8000/admin` — should see Filament login page.

- [ ] **Step 6: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: install Spatie Permission + Filament v4 admin panel"
```

---

## Task 3: LessonType enum + migrations

**Files:**
- Create: `vertex-lms/app/Enums/LessonType.php`
- Create: 5 migration files (courses, modules, lessons, enrollments, progress)

- [ ] **Step 1: Create LessonType enum**

Create `vertex-lms/app/Enums/LessonType.php`:

```php
<?php

namespace App\Enums;

enum LessonType: string
{
    case Video = 'video';
    case Text = 'text';
    case Image = 'image';
    case Quiz = 'quiz';
    case Sim3d = 'sim3d';
}
```

- [ ] **Step 2: Create courses migration**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan make:migration create_courses_table
```

Edit the generated file in `database/migrations/xxxx_create_courses_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('category')->nullable();
            $table->string('level')->default('beginner');
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
```

- [ ] **Step 3: Create modules migration**

```bash
php artisan make:migration create_modules_table
```

Edit the generated file:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
```

- [ ] **Step 4: Create lessons migration**

```bash
php artisan make:migration create_lessons_table
```

Edit the generated file:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('type')->default('text');
            $table->json('content_json')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
```

- [ ] **Step 5: Create enrollments migration**

```bash
php artisan make:migration create_enrollments_table
```

Edit the generated file:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->timestamp('enrolled_at');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
```

- [ ] **Step 6: Create progress migration**

```bash
php artisan make:migration create_progress_table
```

Edit the generated file:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedTinyInteger('score')->nullable();
            $table->unsignedInteger('attempts')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'lesson_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
```

- [ ] **Step 7: Run all migrations**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan migrate
```

Expected: all 5 new tables created without error.

- [ ] **Step 8: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: enum LessonType + migrations courses/modules/lessons/enrollments/progress"
```

---

## Task 4: Models with relations

**Files:**
- Create: `vertex-lms/app/Models/Course.php`
- Create: `vertex-lms/app/Models/Module.php`
- Create: `vertex-lms/app/Models/Lesson.php`
- Create: `vertex-lms/app/Models/Enrollment.php`
- Create: `vertex-lms/app/Models/Progress.php`
- Modify: `vertex-lms/app/Models/User.php`

- [ ] **Step 1: Create Course model**

Create `vertex-lms/app/Models/Course.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'cover_image',
        'category',
        'level',
        'is_published',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('order');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
```

- [ ] **Step 2: Create Module model**

Create `vertex-lms/app/Models/Module.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'order',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }
}
```

- [ ] **Step 3: Create Lesson model**

Create `vertex-lms/app/Models/Lesson.php`:

```php
<?php

namespace App\Models;

use App\Enums\LessonType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'type',
        'content_json',
        'order',
        'duration_minutes',
    ];

    protected function casts(): array
    {
        return [
            'type' => LessonType::class,
            'content_json' => 'array',
        ];
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }
}
```

- [ ] **Step 4: Create Enrollment model**

Create `vertex-lms/app/Models/Enrollment.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrolled_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'enrolled_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }
}
```

- [ ] **Step 5: Create Progress model**

Create `vertex-lms/app/Models/Progress.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'completed_at',
        'score',
        'attempts',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }
}
```

- [ ] **Step 6: Add relations to User model**

Modify `vertex-lms/app/Models/User.php` — add enrollment and progress relations:

```php
<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }
}
```

- [ ] **Step 7: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: models Course/Module/Lesson/Enrollment/Progress avec relations"
```

---

## Task 5: Seeder — roles + users de dev

**Files:**
- Create: `vertex-lms/database/seeders/RolesAndUsersSeeder.php`
- Modify: `vertex-lms/database/seeders/DatabaseSeeder.php`

- [ ] **Step 1: Create RolesAndUsersSeeder**

Create `vertex-lms/database/seeders/RolesAndUsersSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $instructor = Role::firstOrCreate(['name' => 'instructor']);
        $student = Role::firstOrCreate(['name' => 'student']);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@vertex.ma'],
            [
                'name' => 'Admin VERTEX',
                'password' => bcrypt('password'),
            ]
        );
        $adminUser->assignRole($admin);

        $instructorUser = User::firstOrCreate(
            ['email' => 'instructor@vertex.ma'],
            [
                'name' => 'Dr. Formateur',
                'password' => bcrypt('password'),
            ]
        );
        $instructorUser->assignRole($instructor);

        $studentUser = User::firstOrCreate(
            ['email' => 'student@vertex.ma'],
            [
                'name' => 'Etudiant Test',
                'password' => bcrypt('password'),
            ]
        );
        $studentUser->assignRole($student);
    }
}
```

- [ ] **Step 2: Call seeder from DatabaseSeeder**

Modify `vertex-lms/database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndUsersSeeder::class,
        ]);
    }
}
```

- [ ] **Step 3: Run seeder**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan db:seed
```

Expected: 3 roles created, 3 users created with roles assigned.

- [ ] **Step 4: Verify in Tinker**

```bash
php artisan tinker
```

```php
App\Models\User::where('email', 'admin@vertex.ma')->first()->getRoleNames();
// => ["admin"]

App\Models\User::where('email', 'instructor@vertex.ma')->first()->getRoleNames();
// => ["instructor"]

App\Models\User::where('email', 'student@vertex.ma')->first()->getRoleNames();
// => ["student"]
```

- [ ] **Step 5: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: seeder roles admin/instructor/student + 3 users dev"
```

---

## Task 6: Policies

**Files:**
- Create: `vertex-lms/app/Policies/CoursePolicy.php`
- Create: `vertex-lms/app/Policies/LessonPolicy.php`

- [ ] **Step 1: Create CoursePolicy**

Create `vertex-lms/app/Policies/CoursePolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Course $course): bool
    {
        if ($course->is_published) {
            return true;
        }

        return $user->hasRole(['admin', 'instructor']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'instructor']);
    }

    public function update(User $user, Course $course): bool
    {
        return $user->hasRole('admin') || $user->hasRole('instructor');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }
}
```

- [ ] **Step 2: Create LessonPolicy**

Create `vertex-lms/app/Policies/LessonPolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->hasRole(['admin', 'instructor'])) {
            return true;
        }

        $courseId = $lesson->module->course_id;

        return $user->enrollments()->active()->where('course_id', $courseId)->exists();
    }
}
```

- [ ] **Step 3: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: policies CoursePolicy + LessonPolicy"
```

---

## Task 7: Tests — Models & Relations

**Files:**
- Create: `vertex-lms/tests/Feature/Models/CourseTest.php`
- Create: `vertex-lms/tests/Feature/Models/EnrollmentTest.php`
- Create: `vertex-lms/tests/Feature/Models/ProgressTest.php`
- Create: model factories

- [ ] **Step 1: Create Course factory**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan make:factory CourseFactory --model=Course
```

Edit `vertex-lms/database/factories/CourseFactory.php`:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(4),
            'title' => $title,
            'description' => fake()->paragraph(),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'is_published' => false,
            'order' => 0,
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => ['is_published' => true]);
    }
}
```

- [ ] **Step 2: Create Module factory**

```bash
php artisan make:factory ModuleFactory --model=Module
```

Edit `vertex-lms/database/factories/ModuleFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(2),
            'order' => 0,
        ];
    }
}
```

- [ ] **Step 3: Create Lesson factory**

```bash
php artisan make:factory LessonFactory --model=Lesson
```

Edit `vertex-lms/database/factories/LessonFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Enums\LessonType;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'title' => fake()->sentence(3),
            'type' => LessonType::Text,
            'content_json' => null,
            'order' => 0,
        ];
    }
}
```

- [ ] **Step 4: Create Enrollment factory**

```bash
php artisan make:factory EnrollmentFactory --model=Enrollment
```

Edit `vertex-lms/database/factories/EnrollmentFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'course_id' => Course::factory(),
            'enrolled_at' => now(),
            'expires_at' => null,
        ];
    }

    public function expired(): static
    {
        return $this->state(fn () => ['expires_at' => now()->subDay()]);
    }
}
```

- [ ] **Step 5: Create Progress factory**

```bash
php artisan make:factory ProgressFactory --model=Progress
```

Edit `vertex-lms/database/factories/ProgressFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'completed_at' => null,
            'score' => null,
            'attempts' => 0,
        ];
    }

    public function completed(int $score = 100): static
    {
        return $this->state(fn () => [
            'completed_at' => now(),
            'score' => $score,
            'attempts' => 1,
        ]);
    }
}
```

- [ ] **Step 6: Write CourseTest**

Create `vertex-lms/tests/Feature/Models/CourseTest.php`:

```php
<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_has_modules(): void
    {
        $course = Course::factory()->create();
        Module::factory()->count(3)->create(['course_id' => $course->id]);

        $this->assertCount(3, $course->modules);
    }

    public function test_course_has_enrollments(): void
    {
        $course = Course::factory()->create();
        Enrollment::factory()->count(2)->create(['course_id' => $course->id]);

        $this->assertCount(2, $course->enrollments);
    }

    public function test_scope_published(): void
    {
        Course::factory()->create(['is_published' => false]);
        Course::factory()->published()->create();

        $this->assertCount(1, Course::published()->get());
    }

    public function test_modules_ordered(): void
    {
        $course = Course::factory()->create();
        Module::factory()->create(['course_id' => $course->id, 'order' => 2]);
        Module::factory()->create(['course_id' => $course->id, 'order' => 0]);
        Module::factory()->create(['course_id' => $course->id, 'order' => 1]);

        $orders = $course->modules->pluck('order')->toArray();
        $this->assertEquals([0, 1, 2], $orders);
    }
}
```

- [ ] **Step 7: Write EnrollmentTest**

Create `vertex-lms/tests/Feature/Models/EnrollmentTest.php`:

```php
<?php

namespace Tests\Feature\Models;

use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_scope_active_includes_no_expiry(): void
    {
        Enrollment::factory()->create(['expires_at' => null]);

        $this->assertCount(1, Enrollment::active()->get());
    }

    public function test_scope_active_includes_future_expiry(): void
    {
        Enrollment::factory()->create(['expires_at' => now()->addMonth()]);

        $this->assertCount(1, Enrollment::active()->get());
    }

    public function test_scope_active_excludes_expired(): void
    {
        Enrollment::factory()->expired()->create();

        $this->assertCount(0, Enrollment::active()->get());
    }
}
```

- [ ] **Step 8: Write ProgressTest**

Create `vertex-lms/tests/Feature/Models/ProgressTest.php`:

```php
<?php

namespace Tests\Feature\Models;

use App\Models\Progress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_completed_returns_false_when_null(): void
    {
        $progress = Progress::factory()->create(['completed_at' => null]);

        $this->assertFalse($progress->isCompleted());
    }

    public function test_is_completed_returns_true_when_set(): void
    {
        $progress = Progress::factory()->completed()->create();

        $this->assertTrue($progress->isCompleted());
    }
}
```

- [ ] **Step 9: Run all tests**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan test
```

Expected: all tests pass.

- [ ] **Step 10: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: factories + tests models Course/Enrollment/Progress"
```

---

## Task 8: Tests — Roles & Policies

**Files:**
- Create: `vertex-lms/tests/Feature/Auth/RolesTest.php`
- Create: `vertex-lms/tests/Feature/Policies/CoursePolicyTest.php`
- Create: `vertex-lms/tests/Feature/Policies/LessonPolicyTest.php`

- [ ] **Step 1: Write RolesTest**

Create `vertex-lms/tests/Feature/Auth/RolesTest.php`:

```php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'instructor']);
        Role::firstOrCreate(['name' => 'student']);
    }

    public function test_user_can_be_assigned_admin_role(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $this->assertTrue($user->hasRole('admin'));
    }

    public function test_user_can_be_assigned_instructor_role(): void
    {
        $user = User::factory()->create();
        $user->assignRole('instructor');

        $this->assertTrue($user->hasRole('instructor'));
    }

    public function test_user_can_be_assigned_student_role(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $this->assertTrue($user->hasRole('student'));
    }

    public function test_admin_can_access_filament_panel(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $this->assertTrue($user->canAccessPanel(new \Filament\Panel()));
    }

    public function test_student_cannot_access_filament_panel(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $this->assertFalse($user->canAccessPanel(new \Filament\Panel()));
    }
}
```

- [ ] **Step 2: Write CoursePolicyTest**

Create `vertex-lms/tests/Feature/Policies/CoursePolicyTest.php`:

```php
<?php

namespace Tests\Feature\Policies;

use App\Models\Course;
use App\Models\User;
use App\Policies\CoursePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CoursePolicyTest extends TestCase
{
    use RefreshDatabase;

    private CoursePolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new CoursePolicy();
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'instructor']);
        Role::firstOrCreate(['name' => 'student']);
    }

    public function test_any_user_can_view_any(): void
    {
        $user = User::factory()->create();

        $this->assertTrue($this->policy->viewAny($user));
    }

    public function test_anyone_can_view_published_course(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');
        $course = Course::factory()->published()->create();

        $this->assertTrue($this->policy->view($user, $course));
    }

    public function test_student_cannot_view_unpublished_course(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');
        $course = Course::factory()->create(['is_published' => false]);

        $this->assertFalse($this->policy->view($user, $course));
    }

    public function test_admin_can_view_unpublished_course(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $course = Course::factory()->create(['is_published' => false]);

        $this->assertTrue($this->policy->view($user, $course));
    }

    public function test_instructor_can_create_course(): void
    {
        $user = User::factory()->create();
        $user->assignRole('instructor');

        $this->assertTrue($this->policy->create($user));
    }

    public function test_student_cannot_create_course(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $this->assertFalse($this->policy->create($user));
    }

    public function test_only_admin_can_delete_course(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');
        $course = Course::factory()->create();

        $this->assertTrue($this->policy->delete($admin, $course));
        $this->assertFalse($this->policy->delete($instructor, $course));
    }
}
```

- [ ] **Step 3: Write LessonPolicyTest**

Create `vertex-lms/tests/Feature/Policies/LessonPolicyTest.php`:

```php
<?php

namespace Tests\Feature\Policies;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use App\Policies\LessonPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LessonPolicyTest extends TestCase
{
    use RefreshDatabase;

    private LessonPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new LessonPolicy();
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'instructor']);
        Role::firstOrCreate(['name' => 'student']);
    }

    public function test_admin_can_view_any_lesson(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $lesson = Lesson::factory()->create();

        $this->assertTrue($this->policy->view($user, $lesson));
    }

    public function test_enrolled_student_can_view_lesson(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        Enrollment::factory()->create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $this->assertTrue($this->policy->view($user, $lesson));
    }

    public function test_unenrolled_student_cannot_view_lesson(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');
        $lesson = Lesson::factory()->create();

        $this->assertFalse($this->policy->view($user, $lesson));
    }

    public function test_expired_enrollment_denies_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        Enrollment::factory()->expired()->create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $this->assertFalse($this->policy->view($user, $lesson));
    }
}
```

- [ ] **Step 4: Run all tests**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan test
```

Expected: all tests pass (models + roles + policies).

- [ ] **Step 5: Commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "feat: tests roles + policies CoursePolicy/LessonPolicy"
```

---

## Task 9: Smoke test — full verification

**Files:** none (verification only)

- [ ] **Step 1: Fresh migrate + seed**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
php artisan migrate:fresh --seed
```

Expected: all tables created, 3 users with roles seeded.

- [ ] **Step 2: Run full test suite**

```bash
php artisan test --verbose
```

Expected: all tests pass.

- [ ] **Step 3: Verify Breeze auth**

Start server: `php artisan serve` + `npm run dev`

1. Visit `http://localhost:8000/register` — register a new user
2. Visit `http://localhost:8000/login` — login with `admin@vertex.ma` / `password`
3. Visit `http://localhost:8000/dashboard` — should see Breeze dashboard

- [ ] **Step 4: Verify Filament admin**

1. Visit `http://localhost:8000/admin/login`
2. Login with `admin@vertex.ma` / `password` — should access admin panel
3. Login with `student@vertex.ma` / `password` — should be denied access

- [ ] **Step 5: Verify models in Tinker**

```bash
php artisan tinker
```

```php
use App\Models\{Course, Module, Lesson};

$course = Course::create(['slug' => 'test-course', 'title' => 'Test', 'is_published' => true]);
$module = Module::create(['course_id' => $course->id, 'title' => 'Module 1', 'order' => 0]);
$lesson = Lesson::create(['module_id' => $module->id, 'title' => 'Lecon 1', 'type' => 'text', 'order' => 0]);

$course->modules->count(); // 1
$module->lessons->count(); // 1
$lesson->module->course->title; // "Test"
```

- [ ] **Step 6: Final commit**

```bash
cd /c/Users/USER/Documents/scoliose/vertex-lms
git add -A
git commit -m "docs: Phase 1 Foundation — verification complete"
```
