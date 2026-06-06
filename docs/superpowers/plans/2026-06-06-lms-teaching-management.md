# LMS Teaching Management Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build a full-stack Laravel LMS with 3 roles (Manager, Teacher, Student) — teaching schedules, lesson history with video upload, and learning materials.

**Architecture:** Laravel 13 MVC with Blade views + Tailwind CDN (no build step). Auth via Laravel Breeze (blade preset). Role-based access via `RoleMiddleware`. Single `schedules` table and single `teaching_histories` table serve both Teacher and Student views via filtered queries.

**Tech Stack:** Laravel 13, PHP 8.3, Blade, Tailwind CDN (Play CDN with inline config), Material Symbols Outlined (Google CDN), Inter font (Google CDN), PHPUnit, MySQL (Docker)

**UI Reference:** All screens have HTML mockups in `/Users/concrete/Downloads/stitch_edumanage_teaching_system/`. Use these as pixel-level reference for every view.

---

## File Map

### New files to create

**Migrations:**
- `database/migrations/XXXX_add_role_to_users_table.php`
- `database/migrations/XXXX_create_teachers_table.php`
- `database/migrations/XXXX_create_students_table.php`
- `database/migrations/XXXX_create_schedules_table.php`
- `database/migrations/XXXX_create_teaching_histories_table.php`
- `database/migrations/XXXX_create_learning_materials_table.php`

**Models:**
- `app/Models/Teacher.php`
- `app/Models/Student.php`
- `app/Models/Schedule.php`
- `app/Models/TeachingHistory.php`
- `app/Models/LearningMaterial.php`

**Factories:**
- `database/factories/TeacherFactory.php`
- `database/factories/StudentFactory.php`
- `database/factories/ScheduleFactory.php`
- `database/factories/TeachingHistoryFactory.php`
- `database/factories/LearningMaterialFactory.php`

**Seeders:**
- `database/seeders/DatabaseSeeder.php` (modify)

**Middleware:**
- `app/Http/Middleware/RoleMiddleware.php`

**Observers:**
- `app/Observers/TeacherObserver.php`
- `app/Observers/StudentObserver.php`

**Policies:**
- `app/Policies/TeachingHistoryPolicy.php`

**Controllers:**
- `app/Http/Controllers/Manager/DashboardController.php`
- `app/Http/Controllers/Manager/TeacherController.php`
- `app/Http/Controllers/Manager/StudentController.php`
- `app/Http/Controllers/Manager/ScheduleController.php`
- `app/Http/Controllers/Manager/MaterialController.php`
- `app/Http/Controllers/Manager/HistoryController.php`
- `app/Http/Controllers/Teacher/DashboardController.php`
- `app/Http/Controllers/Teacher/HistoryController.php`
- `app/Http/Controllers/Student/DashboardController.php`
- `app/Http/Controllers/Student/MaterialController.php`

**Views:**
- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/auth.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/manager/dashboard.blade.php`
- `resources/views/manager/teachers/index.blade.php`
- `resources/views/manager/teachers/create.blade.php`
- `resources/views/manager/teachers/edit.blade.php`
- `resources/views/manager/students/index.blade.php`
- `resources/views/manager/students/create.blade.php`
- `resources/views/manager/students/edit.blade.php`
- `resources/views/manager/schedules/index.blade.php`
- `resources/views/manager/schedules/create.blade.php`
- `resources/views/manager/schedules/edit.blade.php`
- `resources/views/manager/materials/index.blade.php`
- `resources/views/manager/histories/index.blade.php`
- `resources/views/manager/histories/edit.blade.php`
- `resources/views/teacher/dashboard.blade.php`
- `resources/views/teacher/history/index.blade.php`
- `resources/views/teacher/history/create.blade.php`
- `resources/views/teacher/history/edit.blade.php`
- `resources/views/student/dashboard.blade.php`
- `resources/views/student/materials/index.blade.php`

**Tests:**
- `tests/Feature/Auth/LoginTest.php`
- `tests/Feature/Auth/RoleMiddlewareTest.php`
- `tests/Feature/Manager/TeacherControllerTest.php`
- `tests/Feature/Manager/StudentControllerTest.php`
- `tests/Feature/Manager/ScheduleControllerTest.php`
- `tests/Feature/Manager/MaterialControllerTest.php`
- `tests/Feature/Manager/HistoryControllerTest.php`
- `tests/Feature/Teacher/DashboardControllerTest.php`
- `tests/Feature/Teacher/HistoryControllerTest.php`
- `tests/Feature/Student/DashboardControllerTest.php`
- `tests/Feature/Student/MaterialControllerTest.php`

### Files to modify
- `app/Models/User.php` — add `role`, relationships to teacher/student
- `database/factories/UserFactory.php` — add role states
- `routes/web.php` — all application routes
- `bootstrap/app.php` — register RoleMiddleware

---

## Task 1: Install Laravel Breeze

**Files:**
- Modify: `composer.json` (via composer)
- Create: Breeze auth views and controllers (auto-generated)
- Modify: `routes/web.php`

- [ ] **Step 1: Install Breeze package**

```bash
cd /path/to/project
composer require laravel/breeze --dev
php artisan breeze:install blade
```

Expected output: Breeze scaffolded. Files created in `resources/views/auth/`, `app/Http/Controllers/Auth/`.

- [ ] **Step 2: Remove self-registration routes**

In `routes/auth.php` (created by Breeze), remove or comment out the register routes:
```php
// Route::get('register', [RegisteredUserController::class, 'create'])
//     ->name('register');
// Route::post('register', [RegisteredUserController::class, 'store']);
```

- [ ] **Step 3: Write failing test**

Create `tests/Feature/Auth/LoginTest.php`:
```php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_manager_redirected_to_manager_dashboard_after_login(): void
    {
        $user = User::factory()->create(['role' => 'manager', 'password' => bcrypt('password')]);
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertRedirect('/manager/dashboard');
    }

    public function test_teacher_redirected_to_teacher_dashboard_after_login(): void
    {
        $user = User::factory()->create(['role' => 'teacher', 'password' => bcrypt('password')]);
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertRedirect('/teacher/dashboard');
    }

    public function test_student_redirected_to_student_dashboard_after_login(): void
    {
        $user = User::factory()->create(['role' => 'student', 'password' => bcrypt('password')]);
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertRedirect('/student/dashboard');
    }
}
```

- [ ] **Step 4: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Auth/LoginTest.php
```

Expected: FAIL (role column doesn't exist yet)

- [ ] **Step 5: Commit Breeze scaffold**

```bash
git add .
git commit -m "feat: install Laravel Breeze blade preset"
```

---

## Task 2: Database Migrations

**Files:**
- Create: 6 migration files (via artisan)
- Modify: `database/migrations/0001_01_01_000000_create_users_table.php`

- [ ] **Step 1: Generate migrations**

```bash
php artisan make:migration add_role_to_users_table --table=users
php artisan make:migration create_teachers_table
php artisan make:migration create_students_table
php artisan make:migration create_schedules_table
php artisan make:migration create_teaching_histories_table
php artisan make:migration create_learning_materials_table
```

- [ ] **Step 2: Write `add_role_to_users_table` migration**

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['manager', 'teacher', 'student'])->default('student')->after('password');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
```

- [ ] **Step 3: Write `create_teachers_table` migration**

```php
public function up(): void
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('teacher_id')->unique(); // e.g. TEA101
        $table->string('experience');           // display-only, e.g. "5 years"
        $table->softDeletes();
        $table->timestamps();
    });
}
```

- [ ] **Step 4: Write `create_students_table` migration**

```php
public function up(): void
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('student_id')->unique(); // e.g. STU1011
        $table->unsignedSmallInteger('age');
        $table->string('course');               // e.g. "120 lessons"
        $table->softDeletes();
        $table->timestamps();
    });
}
```

- [ ] **Step 5: Write `create_schedules_table` migration**

```php
public function up(): void
{
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
        $table->foreignId('student_id')->constrained()->cascadeOnDelete();
        $table->enum('day_of_week', ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']);
        $table->time('start_time');
        $table->time('end_time');
        $table->timestamps();
    });
}
```

- [ ] **Step 6: Write `create_teaching_histories_table` migration**

```php
public function up(): void
{
    Schema::create('teaching_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('teacher_id')->constrained()->restrictOnDelete();
        $table->foreignId('student_id')->constrained()->restrictOnDelete();
        $table->string('lesson');
        $table->dateTime('taught_at');
        $table->unsignedSmallInteger('duration'); // 25 or 50
        $table->string('video_path')->nullable();
        $table->text('note')->nullable();
        $table->timestamps();
    });
}
```

- [ ] **Step 7: Write `create_learning_materials_table` migration**

```php
public function up(): void
{
    Schema::create('learning_materials', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('file_path');
        $table->foreignId('uploaded_by')->constrained('users')->restrictOnDelete();
        $table->timestamps();
    });
}
```

- [ ] **Step 8: Run migrations**

```bash
php artisan migrate
```

Expected: all 6 new tables created + role column on users.

- [ ] **Step 9: Commit**

```bash
git add database/migrations/
git commit -m "feat: add migrations for teachers, students, schedules, histories, materials"
```

---

## Task 3: Models & Relationships

**Files:**
- Modify: `app/Models/User.php`
- Create: `app/Models/Teacher.php`, `Student.php`, `Schedule.php`, `TeachingHistory.php`, `LearningMaterial.php`

- [ ] **Step 1: Update `User` model**

```php
<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function isManager(): bool { return $this->role === 'manager'; }
    public function isTeacher(): bool { return $this->role === 'teacher'; }
    public function isStudent(): bool { return $this->role === 'student'; }
}
```

- [ ] **Step 2: Create `Teacher` model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'teacher_id', 'experience'];

    public function user() { return $this->belongsTo(User::class); }
    public function schedules() { return $this->hasMany(Schedule::class); }
    public function histories() { return $this->hasMany(TeachingHistory::class); }
}
```

- [ ] **Step 3: Create `Student` model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'student_id', 'age', 'course'];

    protected $casts = ['age' => 'integer'];

    public function user() { return $this->belongsTo(User::class); }
    public function schedules() { return $this->hasMany(Schedule::class); }
    public function histories() { return $this->hasMany(TeachingHistory::class); }
}
```

- [ ] **Step 4: Create `Schedule` model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'student_id', 'day_of_week', 'start_time', 'end_time'];

    public function teacher() { return $this->belongsTo(Teacher::class); }
    public function student() { return $this->belongsTo(Student::class); }

    const DAYS = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
}
```

- [ ] **Step 5: Create `TeachingHistory` model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingHistory extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'student_id', 'lesson', 'taught_at', 'duration', 'video_path', 'note'];

    protected $casts = [
        'taught_at' => 'datetime',
        'duration' => 'integer',
    ];

    public function teacher() { return $this->belongsTo(Teacher::class); }
    public function student() { return $this->belongsTo(Student::class); }
}
```

- [ ] **Step 6: Create `LearningMaterial` model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file_path', 'uploaded_by'];

    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
```

- [ ] **Step 7: Commit**

```bash
git add app/Models/
git commit -m "feat: add Teacher, Student, Schedule, TeachingHistory, LearningMaterial models"
```

---

## Task 4: Factories & Seeder

**Files:**
- Modify: `database/factories/UserFactory.php`
- Create: 5 factory files
- Modify: `database/seeders/DatabaseSeeder.php`

- [ ] **Step 1: Update `UserFactory` with role states**

Add to existing `UserFactory.php`:
```php
public function manager(): static
{
    return $this->state(['role' => 'manager']);
}

public function teacher(): static
{
    return $this->state(['role' => 'teacher']);
}

public function student(): static
{
    return $this->state(['role' => 'student']);
}
```

Also add `'role' => 'student'` to the `definition()` array as default.

- [ ] **Step 2: Create `TeacherFactory`**

```bash
php artisan make:factory TeacherFactory --model=Teacher
```

```php
public function definition(): array
{
    return [
        'user_id' => User::factory()->teacher(),
        'teacher_id' => 'TEA' . $this->faker->unique()->numberBetween(100, 999),
        'experience' => $this->faker->numberBetween(1, 15) . ' years',
    ];
}
```

- [ ] **Step 3: Create `StudentFactory`**

```bash
php artisan make:factory StudentFactory --model=Student
```

```php
public function definition(): array
{
    return [
        'user_id' => User::factory()->student(),
        'student_id' => 'STU' . $this->faker->unique()->numberBetween(1000, 9999),
        'age' => $this->faker->numberBetween(8, 25),
        'course' => $this->faker->randomElement(['60 lessons', '120 lessons', '180 lessons']),
    ];
}
```

- [ ] **Step 4: Create `ScheduleFactory`**

```bash
php artisan make:factory ScheduleFactory --model=Schedule
```

```php
public function definition(): array
{
    $start = $this->faker->randomElement(['18:00', '18:30', '19:00', '19:30']);
    $end = date('H:i', strtotime($start) + 25 * 60);
    return [
        'teacher_id' => Teacher::factory(),
        'student_id' => Student::factory(),
        'day_of_week' => $this->faker->randomElement(Schedule::DAYS),
        'start_time' => $start,
        'end_time' => $end,
    ];
}
```

- [ ] **Step 5: Create `TeachingHistoryFactory`**

```bash
php artisan make:factory TeachingHistoryFactory --model=TeachingHistory
```

```php
public function definition(): array
{
    return [
        'teacher_id' => Teacher::factory(),
        'student_id' => Student::factory(),
        'lesson' => $this->faker->sentence(4),
        'taught_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        'duration' => $this->faker->randomElement([25, 50]),
        'video_path' => null,
        'note' => $this->faker->optional()->paragraph(),
    ];
}
```

- [ ] **Step 6: Create `LearningMaterialFactory`**

```bash
php artisan make:factory LearningMaterialFactory --model=LearningMaterial
```

```php
public function definition(): array
{
    return [
        'title' => $this->faker->sentence(3),
        'file_path' => 'materials/' . $this->faker->uuid() . '.pdf',
        'uploaded_by' => User::factory()->manager(),
    ];
}
```

- [ ] **Step 7: Update `DatabaseSeeder` to seed a default manager**

```php
public function run(): void
{
    User::factory()->create([
        'name' => 'Admin Manager',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'manager',
    ]);
}
```

- [ ] **Step 8: Run seeder**

```bash
php artisan db:seed
```

Expected: 1 manager user created (`admin@example.com` / `password`).

- [ ] **Step 9: Commit**

```bash
git add database/factories/ database/seeders/
git commit -m "feat: add model factories and seed default manager account"
```

---

## Task 5: RoleMiddleware, Observers, Policy

**Files:**
- Create: `app/Http/Middleware/RoleMiddleware.php`
- Create: `app/Observers/TeacherObserver.php`
- Create: `app/Observers/StudentObserver.php`
- Create: `app/Policies/TeachingHistoryPolicy.php`
- Modify: `bootstrap/app.php`

- [ ] **Step 1: Write failing authorization test**

Create `tests/Feature/Auth/RoleMiddlewareTest.php`:
```php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_access_manager_dashboard(): void
    {
        $user = User::factory()->manager()->create();
        $this->actingAs($user)->get('/manager/dashboard')->assertStatus(200);
    }

    public function test_teacher_cannot_access_manager_dashboard(): void
    {
        $user = User::factory()->teacher()->create();
        $this->actingAs($user)->get('/manager/dashboard')->assertStatus(403);
    }

    public function test_student_cannot_access_teacher_dashboard(): void
    {
        $user = User::factory()->student()->create();
        $this->actingAs($user)->get('/teacher/dashboard')->assertStatus(403);
    }

    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $this->get('/manager/dashboard')->assertRedirect('/login');
    }
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Auth/RoleMiddlewareTest.php
```

Expected: FAIL (routes don't exist yet)

- [ ] **Step 3: Create `RoleMiddleware`**

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        abort_if(auth()->user()?->role !== $role, 403);
        return $next($request);
    }
}
```

- [ ] **Step 4: Register middleware in `bootstrap/app.php`**

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias(['role' => \App\Http\Middleware\RoleMiddleware::class]);
})
```

- [ ] **Step 5: Create `TeacherObserver`**

```bash
php artisan make:observer TeacherObserver --model=Teacher
```

```php
public function deleted(Teacher $teacher): void
{
    $teacher->schedules()->delete();
}
```

- [ ] **Step 6: Create `StudentObserver`**

```bash
php artisan make:observer StudentObserver --model=Student
```

```php
public function deleted(Student $student): void
{
    $student->schedules()->delete();
}
```

- [ ] **Step 7: Register observers in `AppServiceProvider`**

In `app/Providers/AppServiceProvider.php`, add to `boot()`:
```php
use App\Models\Teacher;
use App\Models\Student;
use App\Observers\TeacherObserver;
use App\Observers\StudentObserver;

Teacher::observe(TeacherObserver::class);
Student::observe(StudentObserver::class);
```

- [ ] **Step 8: Create `TeachingHistoryPolicy`**

```bash
php artisan make:policy TeachingHistoryPolicy --model=TeachingHistory
```

Replace the generated file content:
```php
<?php

namespace App\Policies;

use App\Models\TeachingHistory;
use App\Models\User;

class TeachingHistoryPolicy
{
    public function update(User $user, TeachingHistory $history): bool
    {
        return $user->teacher && $history->teacher_id === $user->teacher->id;
    }
}
```

- [ ] **Step 9: Register policy in `AppServiceProvider::boot()`**

```php
use App\Models\TeachingHistory;
use App\Policies\TeachingHistoryPolicy;
use Illuminate\Support\Facades\Gate;

Gate::policy(TeachingHistory::class, TeachingHistoryPolicy::class);
```

- [ ] **Step 10: Commit**

```bash
git add app/Http/Middleware/ app/Observers/ app/Policies/ app/Providers/ bootstrap/app.php
git commit -m "feat: add RoleMiddleware, TeacherObserver, StudentObserver, TeachingHistoryPolicy"
```

---

## Task 6: Routes

**Files:**
- Modify: `routes/web.php`

- [ ] **Step 1: Override Breeze login redirect**

In `app/Http/Controllers/Auth/AuthenticatedSessionController.php`, update the `store()` method redirect:
```php
$role = auth()->user()->role;
return redirect()->intended(match($role) {
    'manager' => '/manager/dashboard',
    'teacher' => '/teacher/dashboard',
    default   => '/student/dashboard',
});
```

- [ ] **Step 2: Write all routes in `routes/web.php`**

```php
<?php

use App\Http\Controllers\Manager;
use App\Http\Controllers\Teacher;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

// Manager routes

Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('dashboard', [Manager\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('teachers', Manager\TeacherController::class);
    Route::resource('students', Manager\StudentController::class);
    Route::resource('schedules', Manager\ScheduleController::class);
    Route::resource('materials', Manager\MaterialController::class)->except(['show', 'edit', 'update']);
    Route::resource('histories', Manager\HistoryController::class)->only(['index', 'edit', 'update', 'destroy']);
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('dashboard', [Teacher\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('history', Teacher\HistoryController::class)->except(['show', 'destroy']);
});

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');
    Route::get('materials', [Student\MaterialController::class, 'index'])->name('materials.index');
    Route::get('materials/{material}/download', [Student\MaterialController::class, 'download'])->name('materials.download');
    Route::get('history/{history}/video', [Student\DashboardController::class, 'downloadVideo'])->name('history.video');
});

require __DIR__.'/auth.php';
```

- [ ] **Step 3: Run role middleware test — expect partial PASS**

```bash
php artisan test tests/Feature/Auth/RoleMiddlewareTest.php
```

Expected: now passes once controllers are created (stubs in next step).

- [ ] **Step 4: Create stub controllers** (so routes resolve without 500 errors)

```bash
php artisan make:controller Manager/DashboardController
php artisan make:controller Manager/TeacherController --resource
php artisan make:controller Manager/StudentController --resource
php artisan make:controller Manager/ScheduleController --resource
php artisan make:controller Manager/MaterialController --resource
php artisan make:controller Manager/HistoryController --resource
php artisan make:controller Teacher/DashboardController
php artisan make:controller Teacher/HistoryController --resource
php artisan make:controller Student/DashboardController
php artisan make:controller Student/MaterialController
```

Add a minimal `index()` to each that returns a view (or `response('ok')` temporarily):
```php
public function index() { return response('ok'); }
```

- [ ] **Step 5: Run role middleware tests — expect PASS**

```bash
php artisan test tests/Feature/Auth/RoleMiddlewareTest.php
```

Expected: All 4 tests PASS.

- [ ] **Step 6: Run login tests — expect PASS**

```bash
php artisan test tests/Feature/Auth/LoginTest.php
```

Expected: All 4 tests PASS.

- [ ] **Step 7: Commit**

```bash
git add routes/ app/Http/Controllers/
git commit -m "feat: add routes and stub controllers for all three roles"
```

---

## Task 7: Blade Layouts (Design System)

**Files:**
- Create: `resources/views/layouts/app.blade.php`
- Create: `resources/views/layouts/auth.blade.php`
- Delete: Breeze-generated layouts that conflict

The Tailwind config (Academic Precision design system colors, typography, spacing) goes in the `<head>` of `app.blade.php`. Copy the `tailwind.config` script block from any mockup HTML file (they all have the same config).

- [ ] **Step 1: Create `resources/views/layouts/auth.blade.php`**

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EduFlow Admin</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  <style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
  </style>
  <script>
    tailwind.config = { /* paste full config from mockup */ }
  </script>
</head>
<body class="bg-background text-on-background font-body-md flex items-center justify-center min-h-screen">
  @yield('content')
</body>
</html>
```

**Copy the full `tailwind.config` object from `/Users/concrete/Downloads/stitch_edumanage_teaching_system/teacher_dashboard_ann_oliver/code.html` lines 30–127 into the `<script>` block.**

- [ ] **Step 2: Create `resources/views/layouts/app.blade.php`**

The layout has:
1. `<head>` with same Tailwind config as auth layout
2. Sidebar `<aside>` — nav items vary by role (use `@if(auth()->user()->isManager())` etc.)
3. `<main class="md:ml-[280px] min-h-screen">`
4. Header inside main
5. `@yield('content')` in the main content area
6. Mobile bottom nav

The sidebar nav items per role:
- **Manager:** Dashboard, Teachers, Students, Schedules, Materials, Histories
- **Teacher:** Dashboard, Schedule (links to dashboard), History
- **Student:** Dashboard, Materials

Use `request()->routeIs('manager.dashboard')` etc. to set active state.

Active nav item style: `bg-secondary-container text-on-secondary-container border-l-4 border-primary`
Inactive nav item style: `text-secondary hover:bg-surface-container-low`

Reference the full sidebar HTML from `teacher_dashboard_ann_oliver/code.html` lines 131–178.

- [ ] **Step 3: Commit**

```bash
git add resources/views/layouts/
git commit -m "feat: add app and auth blade layouts with Academic Precision design system"
```

---

## Task 8: Login Page

**Files:**
- Modify: `resources/views/auth/login.blade.php`

- [ ] **Step 1: Replace Breeze login view with Academic Precision design**

Extend `layouts.auth`. The form uses POST `/login` with `@csrf`, email + password fields, and a submit button.

Style reference: centered white card, orange primary button, Inter font. Use `#[on-primary]` white text on orange button.

```blade
@extends('layouts.auth')
@section('content')
<div class="w-full max-w-md bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm p-xl">
  <div class="text-center mb-xl">
    <h1 class="font-headline-md text-headline-md text-primary">EduFlow Admin</h1>
    <p class="text-secondary font-body-sm mt-xs">Sign in to your account</p>
  </div>
  @if($errors->any())
    <div class="bg-error-container text-on-error-container rounded-lg p-md mb-md text-body-sm">
      {{ $errors->first() }}
    </div>
  @endif
  <form method="POST" action="/login" class="space-y-md">
    @csrf
    <div>
      <label class="block font-label-sm text-on-surface mb-xs">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required
             class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-0 font-body-sm"/>
    </div>
    <div>
      <label class="block font-label-sm text-on-surface mb-xs">Password</label>
      <input type="password" name="password" required
             class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-0 font-body-sm"/>
    </div>
    <button type="submit"
            class="w-full bg-primary-container text-on-primary font-label-md py-md rounded-lg hover:brightness-110 transition-all active:scale-95">
      Sign In
    </button>
  </form>
</div>
@endsection
```

- [ ] **Step 2: Manually test login flow**

Start the dev server and visit `http://localhost:8000/login`. Log in with `admin@example.com` / `password`. Confirm redirect to `/manager/dashboard`.

- [ ] **Step 3: Commit**

```bash
git add resources/views/auth/login.blade.php
git commit -m "feat: add login page with Academic Precision design"
```

---

## Task 9: Manager — Teacher CRUD

**Files:**
- Modify: `app/Http/Controllers/Manager/TeacherController.php`
- Create: `resources/views/manager/teachers/index.blade.php`
- Create: `resources/views/manager/teachers/create.blade.php`
- Create: `resources/views/manager/teachers/edit.blade.php`
- Create: `tests/Feature/Manager/TeacherControllerTest.php`

- [ ] **Step 1: Write failing tests**

```php
<?php

namespace Tests\Feature\Manager;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->manager = User::factory()->manager()->create();
    }

    public function test_manager_can_list_teachers(): void
    {
        Teacher::factory()->count(3)->create();
        $this->actingAs($this->manager)->get('/manager/teachers')->assertStatus(200)->assertSee('TEA');
    }

    public function test_manager_can_create_teacher(): void
    {
        $teacherUser = User::factory()->teacher()->create();
        $this->actingAs($this->manager)->post('/manager/teachers', [
            'user_id'     => $teacherUser->id,
            'teacher_id'  => 'TEA999',
            'experience'  => '3 years',
        ])->assertRedirect('/manager/teachers');
        $this->assertDatabaseHas('teachers', ['teacher_id' => 'TEA999']);
    }

    public function test_manager_can_update_teacher(): void
    {
        $teacher = Teacher::factory()->create();
        $this->actingAs($this->manager)->put("/manager/teachers/{$teacher->id}", [
            'teacher_id' => 'TEA888',
            'experience' => '10 years',
        ])->assertRedirect('/manager/teachers');
        $this->assertDatabaseHas('teachers', ['id' => $teacher->id, 'teacher_id' => 'TEA888']);
    }

    public function test_manager_can_soft_delete_teacher(): void
    {
        $teacher = Teacher::factory()->create();
        $this->actingAs($this->manager)->delete("/manager/teachers/{$teacher->id}")->assertRedirect('/manager/teachers');
        $this->assertSoftDeleted('teachers', ['id' => $teacher->id]);
    }

    public function test_soft_deleting_teacher_hard_deletes_their_schedules(): void
    {
        $teacher = Teacher::factory()->create();
        $schedule = Schedule::factory()->create(['teacher_id' => $teacher->id]);
        $this->actingAs($this->manager)->delete("/manager/teachers/{$teacher->id}");
        $this->assertDatabaseMissing('schedules', ['id' => $schedule->id]);
    }

    public function test_teacher_role_cannot_access_teacher_management(): void
    {
        $teacher = Teacher::factory()->create();
        $this->actingAs($teacher->user)->get('/manager/teachers')->assertStatus(403);
    }
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Manager/TeacherControllerTest.php
```

Expected: FAIL

- [ ] **Step 3: Implement `TeacherController`**

```php
public function index()
{
    $teachers = Teacher::with('user')->latest()->paginate(15);
    return view('manager.teachers.index', compact('teachers'));
}

public function create()
{
    // Only users with role=teacher and no existing teacher profile
    $users = User::where('role', 'teacher')
        ->whereDoesntHave('teacher')
        ->get();
    return view('manager.teachers.create', compact('users'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'user_id'    => 'required|exists:users,id',
        'teacher_id' => 'required|string|unique:teachers,teacher_id',
        'experience' => 'required|string|max:50',
    ]);
    Teacher::create($validated);
    return redirect()->route('manager.teachers.index')->with('success', 'Teacher created.');
}

public function edit(Teacher $teacher)
{
    return view('manager.teachers.edit', compact('teacher'));
}

public function update(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'teacher_id' => 'required|string|unique:teachers,teacher_id,' . $teacher->id,
        'experience' => 'required|string|max:50',
    ]);
    $teacher->update($validated);
    return redirect()->route('manager.teachers.index')->with('success', 'Teacher updated.');
}

public function destroy(Teacher $teacher)
{
    $teacher->delete(); // SoftDeletes — observer handles schedule cascade
    return redirect()->route('manager.teachers.index')->with('success', 'Teacher deleted.');
}
```

- [ ] **Step 4: Create `manager/teachers/index.blade.php`**

Extend `layouts.app`. Show a table of teachers: Name, Teacher ID, Experience, Actions (Edit, Delete).

Reference: `students_directory_manager/code.html` for table styling.

- [ ] **Step 5: Create `manager/teachers/create.blade.php` and `edit.blade.php`**

Forms with: User dropdown (create only), Teacher ID input, Experience input. Primary submit button.

- [ ] **Step 6: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Manager/TeacherControllerTest.php
```

- [ ] **Step 7: Commit**

```bash
git add app/Http/Controllers/Manager/TeacherController.php resources/views/manager/teachers/ tests/Feature/Manager/TeacherControllerTest.php
git commit -m "feat: manager teacher CRUD with soft-delete"
```

---

## Task 10: Manager — Student CRUD

**Files:**
- Modify: `app/Http/Controllers/Manager/StudentController.php`
- Create: views in `resources/views/manager/students/`
- Create: `tests/Feature/Manager/StudentControllerTest.php`

Follows exact same pattern as Task 9. Differences:

- Fields: `user_id`, `student_id`, `age`, `course`
- Validation: `age` is `required|integer|min:1|max:100`, `course` is `required|string|max:100`
- Also uses SoftDeletes

- [ ] **Step 1: Write failing tests** (mirror Task 9 structure, adapt fields)

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Manager/StudentControllerTest.php
```

- [ ] **Step 3: Implement `StudentController`** (same pattern as TeacherController)

- [ ] **Step 4: Create views** (same pattern as teacher views)

Reference: `student_dashboard_mai_huong/code.html` for student card styling.

- [ ] **Step 5: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Manager/StudentControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Manager/StudentController.php resources/views/manager/students/ tests/Feature/Manager/StudentControllerTest.php
git commit -m "feat: manager student CRUD with soft-delete"
```

---

## Task 11: Manager — Schedule Management

**Files:**
- Modify: `app/Http/Controllers/Manager/ScheduleController.php`
- Create: views in `resources/views/manager/schedules/`
- Create: `tests/Feature/Manager/ScheduleControllerTest.php`

- [ ] **Step 1: Write failing tests**

```php
public function test_manager_can_create_schedule(): void
{
    $teacher = Teacher::factory()->create();
    $student = Student::factory()->create();
    $this->actingAs($this->manager)->post('/manager/schedules', [
        'teacher_id'  => $teacher->id,
        'student_id'  => $student->id,
        'day_of_week' => 'mon',
        'start_time'  => '18:00',
        'end_time'    => '18:25',
    ])->assertRedirect('/manager/schedules');
    $this->assertDatabaseHas('schedules', ['teacher_id' => $teacher->id, 'day_of_week' => 'mon']);
}

public function test_schedule_conflict_is_rejected(): void
{
    $teacher = Teacher::factory()->create();
    $student = Student::factory()->create();
    Schedule::factory()->create([
        'teacher_id' => $teacher->id, 'student_id' => $student->id,
        'day_of_week' => 'mon', 'start_time' => '18:00', 'end_time' => '18:25',
    ]);
    // Overlapping time: 18:10 - 18:35 conflicts with 18:00 - 18:25
    $this->actingAs($this->manager)->post('/manager/schedules', [
        'teacher_id'  => $teacher->id,
        'student_id'  => Student::factory()->create()->id,
        'day_of_week' => 'mon',
        'start_time'  => '18:10',
        'end_time'    => '18:35',
    ])->assertSessionHasErrors();
}

public function test_schedule_deleted_does_not_affect_histories(): void
{
    $schedule = Schedule::factory()->create();
    $history = TeachingHistory::factory()->create([
        'teacher_id' => $schedule->teacher_id,
        'student_id' => $schedule->student_id,
    ]);
    $this->actingAs($this->manager)->delete("/manager/schedules/{$schedule->id}");
    $this->assertDatabaseMissing('schedules', ['id' => $schedule->id]);
    $this->assertDatabaseHas('teaching_histories', ['id' => $history->id]);
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Manager/ScheduleControllerTest.php
```

- [ ] **Step 3: Implement conflict validation in `ScheduleController`**

The conflict check in `store()` and `update()`:
```php
private function validateConflict(Request $request, ?int $excludeId = null): void
{
    $conflictTeacher = Schedule::where('teacher_id', $request->teacher_id)
        ->where('day_of_week', $request->day_of_week)
        ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
        ->where('start_time', '<', $request->end_time)
        ->where('end_time', '>', $request->start_time)
        ->exists();

    $conflictStudent = Schedule::where('student_id', $request->student_id)
        ->where('day_of_week', $request->day_of_week)
        ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
        ->where('start_time', '<', $request->end_time)
        ->where('end_time', '>', $request->start_time)
        ->exists();

    if ($conflictTeacher) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'start_time' => 'This teacher already has a class at this time.',
        ]);
    }
    if ($conflictStudent) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'start_time' => 'This student already has a class at this time.',
        ]);
    }
}
```

- [ ] **Step 4: Implement full `ScheduleController`** (index, create, store, edit, update, destroy)

`index()` returns all schedules with teacher+student eager loaded, grouped for the weekly grid view.

- [ ] **Step 5: Create schedule views**

- `index.blade.php`: Full weekly grid (7 columns Mon–Sun). Show ALL teachers' schedules. Reference: `full_schedule_overview_manager/code.html`
- `create.blade.php`: Form with teacher dropdown, student dropdown, day select, start_time, end_time
- `edit.blade.php`: Same form pre-populated

- [ ] **Step 6: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Manager/ScheduleControllerTest.php
```

- [ ] **Step 7: Commit**

```bash
git add app/Http/Controllers/Manager/ScheduleController.php resources/views/manager/schedules/ tests/Feature/Manager/ScheduleControllerTest.php
git commit -m "feat: manager schedule management with time-overlap conflict validation"
```

---

## Task 12: Manager — Learning Materials

**Files:**
- Modify: `app/Http/Controllers/Manager/MaterialController.php`
- Create: `resources/views/manager/materials/index.blade.php`
- Create: `tests/Feature/Manager/MaterialControllerTest.php`

- [ ] **Step 1: Write failing tests**

```php
public function test_manager_can_upload_material(): void
{
    Storage::fake('public');
    $file = UploadedFile::fake()->create('lesson.pdf', 500, 'application/pdf');
    $this->actingAs($this->manager)->post('/manager/materials', [
        'title' => 'IELTS Grammar Guide',
        'file'  => $file,
    ])->assertRedirect('/manager/materials');
    $this->assertDatabaseHas('learning_materials', ['title' => 'IELTS Grammar Guide']);
    // file_path already includes the 'materials/' prefix, so don't double-prefix
    Storage::disk('public')->assertExists(LearningMaterial::latest()->first()->file_path);
}

public function test_manager_can_delete_material(): void
{
    Storage::fake('public');
    $material = LearningMaterial::factory()->create(['file_path' => 'materials/test.pdf']);
    Storage::disk('public')->put('materials/test.pdf', 'content');
    $this->actingAs($this->manager)->delete("/manager/materials/{$material->id}")->assertRedirect('/manager/materials');
    $this->assertDatabaseMissing('learning_materials', ['id' => $material->id]);
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Manager/MaterialControllerTest.php
```

- [ ] **Step 3: Implement `MaterialController`**

```php
public function index()
{
    $materials = LearningMaterial::latest()->paginate(15);
    return view('manager.materials.index', compact('materials'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'file'  => 'required|file|max:51200', // 50MB
    ]);
    $uuid = \Str::uuid();
    $ext = $request->file('file')->getClientOriginalExtension();
    $path = "materials/{$uuid}.{$ext}";
    $request->file('file')->storeAs('materials', "{$uuid}.{$ext}", 'public');
    LearningMaterial::create([
        'title'       => $validated['title'],
        'file_path'   => $path,
        'uploaded_by' => auth()->id(),
    ]);
    return redirect()->route('manager.materials.index')->with('success', 'Material uploaded.');
}

public function destroy(LearningMaterial $material)
{
    \Storage::disk('public')->delete($material->file_path);
    $material->delete();
    return redirect()->route('manager.materials.index')->with('success', 'Material deleted.');
}
```

- [ ] **Step 4: Create `manager/materials/index.blade.php`**

Table: Title, Uploaded At, Actions (Delete). Upload form at top with title + file input.

- [ ] **Step 5: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Manager/MaterialControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Manager/MaterialController.php resources/views/manager/materials/ tests/Feature/Manager/MaterialControllerTest.php
git commit -m "feat: manager learning materials upload and delete"
```

---

## Task 13: Manager — Teaching History Management

**Files:**
- Modify: `app/Http/Controllers/Manager/HistoryController.php`
- Create: `resources/views/manager/histories/index.blade.php`
- Create: `resources/views/manager/histories/edit.blade.php`
- Create: `tests/Feature/Manager/HistoryControllerTest.php`

- [ ] **Step 1: Write failing tests**

```php
public function test_manager_can_list_all_histories(): void
{
    TeachingHistory::factory()->count(5)->create();
    $this->actingAs($this->manager)->get('/manager/histories')->assertStatus(200);
}

public function test_manager_can_edit_history(): void
{
    $history = TeachingHistory::factory()->create();
    $this->actingAs($this->manager)->put("/manager/histories/{$history->id}", [
        'lesson'    => 'Updated Lesson',
        'taught_at' => '2026-01-15 18:00:00',
        'duration'  => 50,
        'note'      => 'Updated note',
    ])->assertRedirect('/manager/histories');
    $this->assertDatabaseHas('teaching_histories', ['id' => $history->id, 'lesson' => 'Updated Lesson']);
}

public function test_manager_can_delete_history_and_video_file_is_removed(): void
{
    Storage::fake('public');
    $history = TeachingHistory::factory()->create(['video_path' => 'videos/test.mp4']);
    Storage::disk('public')->put('videos/test.mp4', 'video');
    $this->actingAs($this->manager)->delete("/manager/histories/{$history->id}")->assertRedirect('/manager/histories');
    $this->assertDatabaseMissing('teaching_histories', ['id' => $history->id]);
    Storage::disk('public')->assertMissing('videos/test.mp4');
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Manager/HistoryControllerTest.php
```

- [ ] **Step 3: Implement `HistoryController` (manager)**

```php
public function index(Request $request)
{
    $query = TeachingHistory::with(['teacher.user', 'student.user'])->latest('taught_at');
    if ($request->teacher_id) $query->where('teacher_id', $request->teacher_id);
    if ($request->student_id) $query->where('student_id', $request->student_id);
    $histories = $query->paginate(15)->withQueryString();
    $teachers = Teacher::with('user')->get();
    $students = Student::with('user')->get();
    return view('manager.histories.index', compact('histories', 'teachers', 'students'));
}

public function edit(TeachingHistory $history)
{
    return view('manager.histories.edit', compact('history'));
}

public function update(Request $request, TeachingHistory $history)
{
    $validated = $request->validate([
        'lesson'    => 'required|string|max:255',
        'taught_at' => 'required|date|before_or_equal:now',
        'duration'  => 'required|in:25,50',
        'note'      => 'nullable|string',
    ]);
    $history->update($validated);
    return redirect()->route('manager.histories.index')->with('success', 'History updated.');
}

public function destroy(TeachingHistory $history)
{
    if ($history->video_path) {
        \Storage::disk('public')->delete($history->video_path);
    }
    $history->delete();
    return redirect()->route('manager.histories.index')->with('success', 'History deleted.');
}
```

- [ ] **Step 4: Create views**

`index.blade.php`: Table with filters (teacher dropdown, student dropdown). Columns: Student, Teacher, Lesson, Date, Duration, Video, Notes, Actions.

`edit.blade.php`: Form for lesson, taught_at, duration (select 25/50), note.

- [ ] **Step 5: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Manager/HistoryControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Manager/HistoryController.php resources/views/manager/histories/ tests/Feature/Manager/HistoryControllerTest.php
git commit -m "feat: manager teaching history view, edit, delete"
```

---

## Task 14: Teacher — Dashboard & Schedule

**Files:**
- Modify: `app/Http/Controllers/Teacher/DashboardController.php`
- Create: `resources/views/teacher/dashboard.blade.php`

- [ ] **Step 1: Write failing test**

```php
public function test_teacher_dashboard_shows_own_schedule_and_history(): void
{
    $teacher = Teacher::factory()->create();
    $schedule = Schedule::factory()->create(['teacher_id' => $teacher->id]);
    $history = TeachingHistory::factory()->create(['teacher_id' => $teacher->id]);
    TeachingHistory::factory()->create(); // another teacher's history

    $this->actingAs($teacher->user)->get('/teacher/dashboard')
        ->assertStatus(200)
        ->assertSee($schedule->student->user->name)
        ->assertSee($history->lesson)
        ->assertDontSee(TeachingHistory::where('teacher_id', '!=', $teacher->id)->first()->lesson);
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Teacher/DashboardControllerTest.php
```

- [ ] **Step 3: Implement `Teacher/DashboardController`**

```php
public function index()
{
    $teacher = auth()->user()->teacher;
    abort_if(!$teacher, 403); // guard: soft-deleted teacher has no profile row
    // Weekly schedule grouped by day_of_week
    $schedules = $teacher->schedules()->with('student.user')->get()->groupBy('day_of_week');
    // Last 10 history entries
    $histories = $teacher->histories()->with('student.user')->latest('taught_at')->take(10)->get();
    return view('teacher.dashboard', compact('teacher', 'schedules', 'histories'));
}
```

- [ ] **Step 4: Create `teacher/dashboard.blade.php`**

Reference: `teacher_dashboard_ann_oliver/code.html` — this is almost pixel-perfect to the final view.

Two sections:
1. Weekly grid: loop over `['mon','tue','wed','thu','fri','sat','sun']`, show student cards from `$schedules[$day] ?? []`
2. Teaching history table: loop `$histories`

- [ ] **Step 5: Run test — expect PASS**

```bash
php artisan test tests/Feature/Teacher/DashboardControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Teacher/DashboardController.php resources/views/teacher/dashboard.blade.php
git commit -m "feat: teacher dashboard with weekly schedule and recent history"
```

---

## Task 15: Teacher — History CRUD

**Files:**
- Modify: `app/Http/Controllers/Teacher/HistoryController.php`
- Create: views in `resources/views/teacher/history/`
- Create: `tests/Feature/Teacher/HistoryControllerTest.php`

- [ ] **Step 1: Write failing tests**

```php
public function test_teacher_can_create_history_entry(): void
{
    Storage::fake('public');
    $teacher = Teacher::factory()->create();
    $student = Student::factory()->create();
    $video = UploadedFile::fake()->create('class.mp4', 10240, 'video/mp4');

    $this->actingAs($teacher->user)->post('/teacher/history', [
        'student_id' => $student->id,
        'lesson'     => 'IELTS Speaking',
        'taught_at'  => '2026-06-01 18:00:00',
        'duration'   => 25,
        'video'      => $video,
        'note'       => 'Good progress',
    ])->assertRedirect('/teacher/history');

    $this->assertDatabaseHas('teaching_histories', ['lesson' => 'IELTS Speaking']);
    $entry = TeachingHistory::where('lesson', 'IELTS Speaking')->first();
    Storage::disk('public')->assertExists($entry->video_path);
}

public function test_teacher_cannot_edit_another_teachers_history(): void
{
    $teacher1 = Teacher::factory()->create();
    $teacher2 = Teacher::factory()->create();
    $history = TeachingHistory::factory()->create(['teacher_id' => $teacher1->id]);

    $this->actingAs($teacher2->user)->put("/teacher/history/{$history->id}", [
        'lesson' => 'Hacked', 'taught_at' => '2026-01-01 18:00', 'duration' => 25,
    ])->assertStatus(403);
}

public function test_teacher_cannot_delete_own_history(): void
{
    $teacher = Teacher::factory()->create();
    $history = TeachingHistory::factory()->create(['teacher_id' => $teacher->id]);
    // destroy is excluded from the teacher history resource route
    $this->actingAs($teacher->user)->delete("/teacher/history/{$history->id}")->assertStatus(404);
}

public function test_taught_at_cannot_be_future_date(): void
{
    $teacher = Teacher::factory()->create();
    $student = Student::factory()->create();
    $this->actingAs($teacher->user)->post('/teacher/history', [
        'student_id' => $student->id,
        'lesson'     => 'Test',
        'taught_at'  => now()->addDay()->format('Y-m-d H:i:s'),
        'duration'   => 25,
    ])->assertSessionHasErrors('taught_at');
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Teacher/HistoryControllerTest.php
```

- [ ] **Step 3: Implement `Teacher/HistoryController`**

```php
public function index()
{
    $teacher = auth()->user()->teacher;
    abort_if(!$teacher, 403);
    $histories = $teacher->histories()->with('student.user')->latest('taught_at')->paginate(15);
    return view('teacher.history.index', compact('histories'));
}

public function create()
{
    $teacher = auth()->user()->teacher;
    abort_if(!$teacher, 403);
    // Only students who have a schedule with this teacher
    $students = $teacher->schedules()->with('student.user')->get()
        ->pluck('student')->unique('id');
    return view('teacher.history.create', compact('students'));
}

public function store(Request $request)
{
    $teacher = auth()->user()->teacher;
    abort_if(!$teacher, 403);
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'lesson'     => 'required|string|max:255',
        'taught_at'  => 'required|date|before_or_equal:now',
        'duration'   => 'required|in:25,50',
        'video'      => 'nullable|file|mimes:mp4,mov,avi|max:512000',
        'note'       => 'nullable|string',
    ]);
    $videoPath = null;
    if ($request->hasFile('video')) {
        $uuid = \Str::uuid();
        $ext = $request->file('video')->getClientOriginalExtension();
        $videoPath = "videos/{$uuid}.{$ext}";
        $request->file('video')->storeAs('videos', "{$uuid}.{$ext}", 'public');
    }
    TeachingHistory::create([
        'teacher_id' => $teacher->id,
        'student_id' => $validated['student_id'],
        'lesson'     => $validated['lesson'],
        'taught_at'  => $validated['taught_at'],
        'duration'   => $validated['duration'],
        'video_path' => $videoPath,
        'note'       => $validated['note'] ?? null,
    ]);
    return redirect()->route('teacher.history.index')->with('success', 'History entry saved.');
}

public function edit(TeachingHistory $history)
{
    $this->authorize('update', $history);
    $teacher = auth()->user()->teacher;
    $students = $teacher->schedules()->with('student.user')->get()->pluck('student')->unique('id');
    return view('teacher.history.edit', compact('history', 'students'));
}

public function update(Request $request, TeachingHistory $history)
{
    $this->authorize('update', $history);
    $validated = $request->validate([
        'lesson'    => 'required|string|max:255',
        'taught_at' => 'required|date|before_or_equal:now',
        'duration'  => 'required|in:25,50',
        'video'     => 'nullable|file|mimes:mp4,mov,avi|max:512000',
        'note'      => 'nullable|string',
    ]);
    if ($request->hasFile('video')) {
        if ($history->video_path) {
            \Storage::disk('public')->delete($history->video_path);
        }
        $uuid = \Str::uuid();
        $ext = $request->file('video')->getClientOriginalExtension();
        $history->video_path = "videos/{$uuid}.{$ext}";
        $request->file('video')->storeAs('videos', "{$uuid}.{$ext}", 'public');
    }
    $history->fill($validated)->save();
    return redirect()->route('teacher.history.index')->with('success', 'History updated.');
}
```

Note: No `destroy()` method — DELETE route is not defined for teachers (returns 405 Method Not Allowed).

- [ ] **Step 4: Create teacher history views**

`index.blade.php`: Table with all history entries. Columns: Student, Lesson, Date, Duration, Video (play link), Notes, Edit button.

`create.blade.php`: Form with student select, lesson input, taught_at datetime-local, duration select (25/50), video upload, notes textarea.

`edit.blade.php`: Same form pre-populated. Show existing video if present.

- [ ] **Step 5: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Teacher/HistoryControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Teacher/HistoryController.php resources/views/teacher/history/ tests/Feature/Teacher/HistoryControllerTest.php
git commit -m "feat: teacher history CRUD with video upload and policy enforcement"
```

---

## Task 16: Student — Dashboard & Learning History

**Files:**
- Modify: `app/Http/Controllers/Student/DashboardController.php`
- Create: `resources/views/student/dashboard.blade.php`

- [ ] **Step 1: Write failing tests**

```php
public function test_student_dashboard_shows_own_schedule_and_history(): void
{
    $student = Student::factory()->create();
    $schedule = Schedule::factory()->create(['student_id' => $student->id]);
    $history = TeachingHistory::factory()->create(['student_id' => $student->id]);

    $this->actingAs($student->user)->get('/student/dashboard')
        ->assertStatus(200)
        ->assertSee($schedule->teacher->user->name)
        ->assertSee($history->lesson);
}

public function test_student_can_download_their_own_video(): void
{
    Storage::fake('public');
    $student = Student::factory()->create();
    $history = TeachingHistory::factory()->create([
        'student_id' => $student->id,
        'video_path' => 'videos/test.mp4',
    ]);
    Storage::disk('public')->put('videos/test.mp4', 'video content');

    $this->actingAs($student->user)
        ->get("/student/history/{$history->id}/video")
        ->assertStatus(200);
}

public function test_student_cannot_download_another_students_video(): void
{
    $student1 = Student::factory()->create();
    $student2 = Student::factory()->create();
    $history = TeachingHistory::factory()->create([
        'student_id' => $student1->id,
        'video_path' => 'videos/test.mp4',
    ]);

    $this->actingAs($student2->user)
        ->get("/student/history/{$history->id}/video")
        ->assertStatus(403);
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Student/DashboardControllerTest.php
```

- [ ] **Step 3: Implement `Student/DashboardController`**

```php
public function index()
{
    $student = auth()->user()->student;
    $schedules = $student->schedules()->with('teacher.user')->get()->groupBy('day_of_week');
    $histories = $student->histories()->with('teacher.user')->latest('taught_at')->paginate(15);
    return view('student.dashboard', compact('student', 'schedules', 'histories'));
}

public function downloadVideo(TeachingHistory $history)
{
    abort_if($history->student_id !== auth()->user()->student?->id, 403);
    abort_if(!$history->video_path, 404);
    return \Storage::disk('public')->download($history->video_path);
}
```

- [ ] **Step 4: Create `student/dashboard.blade.php`**

Reference: `student_dashboard_mai_huong/code.html`.

Two sections:
1. Learning Schedule weekly grid: shows teacher name + teacher_id in each cell
2. Learning History table: Lesson, Date, Duration, Video (download link if available), Notes

- [ ] **Step 5: Run test — expect PASS**

```bash
php artisan test tests/Feature/Student/DashboardControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Student/DashboardController.php resources/views/student/dashboard.blade.php
git commit -m "feat: student dashboard with learning schedule and history"
```

---

## Task 17: Student — Materials Download

**Files:**
- Modify: `app/Http/Controllers/Student/MaterialController.php`
- Create: `resources/views/student/materials/index.blade.php`
- Create: `tests/Feature/Student/MaterialControllerTest.php`

- [ ] **Step 1: Write failing tests**

```php
public function test_student_can_list_materials(): void
{
    $student = Student::factory()->create();
    LearningMaterial::factory()->count(3)->create();
    $this->actingAs($student->user)->get('/student/materials')->assertStatus(200);
}

public function test_student_can_download_material(): void
{
    Storage::fake('public');
    $student = Student::factory()->create();
    $material = LearningMaterial::factory()->create(['file_path' => 'materials/guide.pdf']);
    Storage::disk('public')->put('materials/guide.pdf', 'PDF content');

    $response = $this->actingAs($student->user)->get("/student/materials/{$material->id}/download");
    $response->assertStatus(200);
}

public function test_teacher_cannot_access_student_materials_page(): void
{
    $teacher = Teacher::factory()->create();
    $this->actingAs($teacher->user)->get('/student/materials')->assertStatus(403);
}
```

- [ ] **Step 2: Run test — expect FAIL**

```bash
php artisan test tests/Feature/Student/MaterialControllerTest.php
```

- [ ] **Step 3: Implement `Student/MaterialController`**

```php
public function index()
{
    $materials = LearningMaterial::latest()->paginate(15);
    return view('student.materials.index', compact('materials'));
}

public function download(LearningMaterial $material)
{
    abort_if(!\Storage::disk('public')->exists($material->file_path), 404);
    return \Storage::disk('public')->download($material->file_path, $material->title);
}
```

- [ ] **Step 4: Create `student/materials/index.blade.php`**

Table: Title, Uploaded At, Download button (links to `/student/materials/{id}/download`).

- [ ] **Step 5: Run tests — expect PASS**

```bash
php artisan test tests/Feature/Student/MaterialControllerTest.php
```

- [ ] **Step 6: Commit**

```bash
git add app/Http/Controllers/Student/MaterialController.php resources/views/student/materials/ tests/Feature/Student/MaterialControllerTest.php
git commit -m "feat: student materials list and auth-gated file download"
```

---

## Task 18: Manager Dashboard & Final Wiring

**Files:**
- Modify: `app/Http/Controllers/Manager/DashboardController.php`
- Create: `resources/views/manager/dashboard.blade.php`
- Run: `php artisan storage:link` (only for local dev reference — downloads go through controller)

- [ ] **Step 1: Implement `Manager/DashboardController`**

```php
public function index()
{
    return view('manager.dashboard', [
        'teacherCount'  => Teacher::count(),
        'studentCount'  => Student::count(),
        'scheduleCount' => Schedule::count(),
        'recentHistories' => TeachingHistory::with(['teacher.user', 'student.user'])
            ->latest('taught_at')->take(5)->get(),
    ]);
}
```

- [ ] **Step 2: Create `manager/dashboard.blade.php`**

Reference: `manager_management_portal/code.html`.

Show stat cards: Total Teachers, Total Students, Total Schedules. Show recent activity table.

- [ ] **Step 3: Run full test suite**

```bash
php artisan test
```

Expected: all tests pass.

- [ ] **Step 4: Final end-to-end manual test**

1. Visit `/login` → log in as `admin@example.com` → confirm redirect to `/manager/dashboard`
2. Create a teacher (Teachers → Create)
3. Create a student (Students → Create)
4. Create a schedule (Schedules → Create)
5. Log out, log in as the teacher → see the schedule on dashboard
6. Create a history entry with video upload
7. Log out, log in as the student → see the history entry, download video
8. Log back in as manager → verify history visible in `/manager/histories`
9. Upload a material as manager → log in as student → download it

- [ ] **Step 5: Final commit**

```bash
git add .
git commit -m "feat: complete LMS teaching management system — all roles, CRUD, file uploads"
```

---

## Quick Reference

### Run all tests
```bash
php artisan test
```

### Run specific test file
```bash
php artisan test tests/Feature/Manager/TeacherControllerTest.php
```

### Reset DB and reseed
```bash
php artisan migrate:fresh --seed
```

### Start dev server
```bash
php artisan serve
```

### UI Mockup references
| Screen | File |
|---|---|
| Teacher Dashboard | `/Users/concrete/Downloads/stitch_edumanage_teaching_system/teacher_dashboard_ann_oliver/code.html` |
| Student Dashboard | `/Users/concrete/Downloads/stitch_edumanage_teaching_system/student_dashboard_mai_huong/code.html` |
| Manager Portal | `/Users/concrete/Downloads/stitch_edumanage_teaching_system/manager_management_portal/code.html` |
| Full Schedule | `/Users/concrete/Downloads/stitch_edumanage_teaching_system/full_schedule_overview_manager/code.html` |
| Student Directory | `/Users/concrete/Downloads/stitch_edumanage_teaching_system/students_directory_manager/code.html` |
| Reports | `/Users/concrete/Downloads/stitch_edumanage_teaching_system/reports_analytics_manager/code.html` |
