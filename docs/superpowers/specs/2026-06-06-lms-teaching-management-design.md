# LMS Teaching Management System — Design Spec

**Date:** 2026-06-06
**Project:** BEA English Admin (Laravel)

---

## 1. Overview

A web-based Learning Management System for an English tutoring center. Three account types (Manager, Teacher, Student) each have role-specific dashboards and capabilities. A Manager creates and manages all entities; Teachers log lesson history; Students view their schedule, history, and download materials.

---

## 2. Account Roles

| Role | Description |
|---|---|
| Manager | Full system access: create/edit teachers, students, schedules, materials, histories |
| Teacher | View own schedule, log teaching history (lesson, video, notes) |
| Student | View own schedule, view learning history, download materials |

- Manager creates all accounts (no self-registration)
- Single login page `/login`, redirect after login based on role

---

## 3. Database Schema

### `users`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | string | |
| email | string unique | |
| password | string hashed | |
| role | enum(manager, teacher, student) | |
| timestamps | | |

### `teachers`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users | cascade delete |
| teacher_id | string unique | e.g. TEA101 |
| experience | string | Display-only, e.g. "5 years". Not used for sorting/filtering. Shown on detail/edit view only. |
| deleted_at | timestamp nullable | Soft-delete via SoftDeletes trait |
| timestamps | | |

### `students`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users | cascade delete |
| student_id | string unique | e.g. STU1011 |
| age | integer | |
| course | string | e.g. "120 lessons" |
| deleted_at | timestamp nullable | Soft-delete via SoftDeletes trait |
| timestamps | | |

### `schedules`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| teacher_id | FK → teachers | cascade delete |
| student_id | FK → students | cascade delete |
| day_of_week | enum(mon,tue,wed,thu,fri,sat,sun) | |
| start_time | time | e.g. 18:00 |
| end_time | time | e.g. 18:25 |
| timestamps | | |

One row per student-teacher-timeslot assignment. Schedules repeat weekly with no date range (perpetual). Teacher's Teaching Schedule and Student's Learning Schedule both query this table, filtered by their own ID.

### `teaching_histories`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| teacher_id | FK → teachers | restrict delete (no cascade — preserve history) |
| student_id | FK → students | restrict delete (no cascade — preserve history) |
| lesson | string | Lesson name/topic |
| taught_at | datetime | Date + time of class |
| duration | integer | Cast to int. Values: 25 or 50 (minutes). |
| video_path | string nullable | Stored as `videos/{uuid}.{ext}` under storage/app/public/ |
| note | text nullable | Teacher's notes |
| timestamps | | |

Student's Learning History reads from this table filtered by student_id. Sync is implicit (same table).

### `learning_materials`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| title | string | |
| file_path | string | Path under storage/app/public/materials/ |
| uploaded_by | FK → users | Manager's user_id |
| timestamps | | |

---

## 4. Routes & Controllers

### Auth
| Route | Controller | Notes |
|---|---|---|
| GET /login | Auth\AuthenticatedSessionController | Breeze |
| POST /login | Auth\AuthenticatedSessionController | Redirect by role after login |
| POST /logout | Auth\AuthenticatedSessionController | |

### Manager (`/manager`, middleware: auth + role:manager)
| Route | Action |
|---|---|
| GET /manager/dashboard | Dashboard overview |
| GET/POST /manager/teachers | List + create teacher |
| GET/PUT/DELETE /manager/teachers/{id} | Show + edit + delete (soft-deletes schedules; history preserved) |
| GET/POST /manager/students | List + create student |
| GET/PUT/DELETE /manager/students/{id} | Show + edit + delete (soft-deletes schedules; history preserved) |
| GET/POST /manager/schedules | List all schedules + create |
| GET/PUT /manager/schedules/{id} | Edit schedule entry |
| DELETE /manager/schedules/{id} | Delete schedule entry (does not affect history) |
| GET/POST /manager/materials | List + upload material |
| DELETE /manager/materials/{id} | Delete material |
| GET /manager/histories | List all teaching history entries (filterable by teacher/student) |
| GET/PUT /manager/histories/{id} | Edit a history entry |
| DELETE /manager/histories/{id} | Delete a history entry |

### Teacher (`/teacher`, middleware: auth + role:teacher)
| Route | Action |
|---|---|
| GET /teacher/dashboard | Dashboard: weekly schedule + last 10 history entries |
| GET/POST /teacher/history | History list (own only) + create entry |
| GET/PUT /teacher/history/{id} | Edit own history entry (policy enforced) |

### Student (`/student`, middleware: auth + role:student)
| Route | Action |
|---|---|
| GET /student/dashboard | Dashboard: weekly schedule + learning history |
| GET /student/materials | List materials |
| GET /student/materials/{id}/download | Stream/download material file (auth-gated, not a public URL) |
| GET /student/history/{id}/video | Stream/download video (auth-gated) |

---

## 5. Frontend

### Stack
- **Blade templates** + **Tailwind CSS CDN** (with custom config from Academic Precision design system)
- No build step required
- **Material Symbols Outlined** icons (Google CDN)
- **Inter** font (Google Fonts CDN)
- All Blade forms must include `@csrf`

### Layout Structure
```
resources/views/
  layouts/
    app.blade.php       ← main layout: sidebar + header + content slot
    auth.blade.php      ← centered login layout
  manager/
    dashboard.blade.php
    teachers/index.blade.php, create.blade.php, edit.blade.php
    students/index.blade.php, create.blade.php, edit.blade.php
    schedules/index.blade.php, create.blade.php, edit.blade.php
    materials/index.blade.php
    histories/index.blade.php, edit.blade.php
  teacher/
    dashboard.blade.php
    history/index.blade.php, create.blade.php, edit.blade.php
  student/
    dashboard.blade.php
    materials/index.blade.php
  auth/
    login.blade.php
```

### Design System (Academic Precision)
- **Primary color:** `#9d4300` (orange accent: `#f97316`)
- **Font:** Inter (all weights)
- **Sidebar:** 280px fixed, white background, orange left-border active indicator
- **Cards:** white background, 1px border `#e2e8f0`, 8px border-radius, 24px padding
- **Buttons:** Primary = solid orange; Secondary = white + border
- **Tables:** borderless rows, 1px horizontal dividers, hover background

### Weekly Schedule Grid
- 7-column grid (Mon–Sun)
- Each cell shows student cards: Name + Student ID, colored by student
- Manager's full overview shows all teachers' schedules
- Teacher view shows own students only
- Student view shows teacher name + ID in each cell

### Pagination
- Teaching history lists are paginated (15 per page) to handle large datasets

---

## 6. File Storage

- **Videos:** `storage/app/public/videos/{uuid}.{ext}` — UUID generated before DB insert, ensuring the path is known before the record is saved
- **Materials:** `storage/app/public/materials/{uuid}.{ext}`
- Laravel `storage:link` is **not** used for downloads. All file downloads are served through auth-gated controller routes (`/student/materials/{id}/download`, `/student/history/{id}/video`) that stream the file using `Storage::download()`. Files are not publicly accessible via direct URL.
- When a teacher replaces a video on an existing history entry, the previous `video_path` file is deleted from storage before saving the new path.
- Max upload size configured in `php.ini` / nginx (recommend 500MB for videos)

---

## 7. Key Business Rules

1. Only Manager can create/edit Teacher and Student accounts
2. Teacher can only view and edit **their own** schedule and history entries. Enforced via `TeachingHistoryPolicy`: `abort_if($history->teacher_id !== auth()->user()->teacher->id, 403)`
3. Student can only view their own schedule and history
4. Teaching History → Learning History: same `teaching_histories` table, filtered by student_id
5. Teaching Schedule → Learning Schedule: same `schedules` table, Teacher sees by teacher_id, Student sees by student_id
6. Learning Materials: Manager uploads, **all** Students can download (no per-student or per-course scoping in v1)
7. Duration: only two values — 25 or 50 (integer minutes)
8. Schedule conflict validation: on creation or edit, validate that a teacher has no existing schedule with overlapping time on the same `day_of_week` (i.e., `new_start_time < existing_end_time AND new_end_time > existing_start_time`), and same check for student. Return a validation error if conflict detected.
9. Cascade rules:
   - Deleting a **teacher** or **student** → soft-delete via `deleted_at` (SoftDeletes). `schedules` rows are hard-deleted via application logic. `teaching_histories` rows are **preserved** intact (FK stays valid since teacher/student rows still exist in DB as soft-deleted).
   - Deleting a **schedule** entry → does **not** affect any `teaching_histories` already logged.
   - Deleting a **history entry** (teacher edit or manager delete) → removes the video file from storage if `video_path` is set.
10. Schedules are **recurring weekly** with no start/end date. When a course ends, Manager manually deletes the schedule entries.
11. Soft-deleted teachers/students are **excluded** from all Manager list views by default (global `SoftDeletes` scope applies). No trash/restore UI in v1. Soft-deleted records are removed from all dropdowns (schedule creation, etc.).
11. Teacher dashboard shows: weekly schedule grid (current week) + last 10 teaching history entries sorted by `taught_at` DESC.
12. `taught_at` validation: must be a valid datetime, cannot be a future date (`before_or_equal:now`).
13. Teachers **cannot delete** their own history entries. Only Manager can delete histories via `/manager/histories/{id}`.
14. Teacher can edit all fields of their own history entry (lesson, duration, taught_at, video, note). No time-lock restriction in v1.
15. `auth()->user()->teacher` may be null if teacher was soft-deleted. Guard: `abort_if(!auth()->user()->teacher || $history->teacher_id !== auth()->user()->teacher->id, 403)`.
16. Schedule hard-delete cascade on teacher/student soft-delete is handled via **model observer** (`TeacherObserver::deleted()` / `StudentObserver::deleted()`) that calls `$teacher->schedules()->delete()`.

---

## 8. Middleware & Authorization

```php
// app/Http/Middleware/RoleMiddleware.php
// Checks auth()->user()->role against required role
// Aborts with 403 if mismatch
// Must be registered in bootstrap/app.php (Laravel 11+) as 'role'
```

Route groups:
```php
Route::middleware(['auth', 'role:manager'])->prefix('manager')->group(...)
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(...)
Route::middleware(['auth', 'role:student'])->prefix('student')->group(...)
```

After login, redirect:
- manager → `/manager/dashboard`
- teacher → `/teacher/dashboard`
- student → `/student/dashboard`

**TeachingHistoryPolicy:** Applied to teacher history edit route. Confirms `$history->teacher_id === auth()->user()->teacher->id`.

---

## 9. Out of Scope

- Email notifications
- Real-time features (WebSockets)
- Self-registration
- Password reset (can add later via Breeze)
- Multi-language UI
- Per-student or per-course material scoping
- Schedule date ranges / one-off rescheduling
- Experience-based teacher sorting/filtering
