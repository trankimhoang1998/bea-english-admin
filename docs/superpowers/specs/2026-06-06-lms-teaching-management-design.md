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
| Manager | Full system access: create/edit teachers, students, schedules, materials |
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
| user_id | FK → users | |
| teacher_id | string unique | e.g. TEA101 |
| experience | string | e.g. "5 years" |
| timestamps | | |

### `students`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users | |
| student_id | string unique | e.g. STU1011 |
| age | integer | |
| course | string | e.g. "120 lessons" |
| timestamps | | |

### `schedules`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| teacher_id | FK → teachers | |
| student_id | FK → students | |
| day_of_week | enum(mon,tue,wed,thu,fri,sat,sun) | |
| start_time | time | e.g. 18:00 |
| end_time | time | e.g. 18:25 |
| timestamps | | |

One row per student-teacher-timeslot assignment. Teacher's Teaching Schedule and Student's Learning Schedule both query this table, filtered by their own ID.

### `teaching_histories`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| teacher_id | FK → teachers | |
| student_id | FK → students | |
| lesson | string | Lesson name/topic |
| taught_at | datetime | Date + time of class |
| duration | enum(25, 50) | Minutes |
| video_path | string nullable | Path under storage/app/public/videos/ |
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
| GET/PUT/DELETE /manager/teachers/{id} | Show + edit + delete |
| GET/POST /manager/students | List + create student |
| GET/PUT/DELETE /manager/students/{id} | Show + edit + delete |
| GET/POST /manager/schedules | List all schedules + create |
| DELETE /manager/schedules/{id} | Delete schedule entry |
| GET/POST /manager/materials | List + upload material |
| DELETE /manager/materials/{id} | Delete material |

### Teacher (`/teacher`, middleware: auth + role:teacher)
| Route | Action |
|---|---|
| GET /teacher/dashboard | Dashboard: weekly schedule + recent history |
| GET/POST /teacher/history | History list + create entry |
| GET/PUT /teacher/history/{id} | Edit history entry |

### Student (`/student`, middleware: auth + role:student)
| Route | Action |
|---|---|
| GET /student/dashboard | Dashboard: weekly schedule + learning history |
| GET /student/materials | List + download materials |

---

## 5. Frontend

### Stack
- **Blade templates** + **Tailwind CSS CDN** (with custom config from Academic Precision design system)
- No build step required
- **Material Symbols Outlined** icons (Google CDN)
- **Inter** font (Google Fonts CDN)

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
    schedules/index.blade.php, create.blade.php
    materials/index.blade.php
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

---

## 6. File Storage

- **Videos:** `storage/app/public/videos/{teaching_history_id}/`
- **Materials:** `storage/app/public/materials/`
- Laravel `storage:link` exposes files at `/storage/...`
- Students can download via signed URL or direct public link
- Max upload size configured in `php.ini` / nginx (recommend 500MB for videos)

---

## 7. Key Business Rules

1. Only Manager can create/edit Teacher and Student accounts
2. Teacher can only view their own schedule and history
3. Student can only view their own schedule and history
4. Teaching History → Learning History: same `teaching_histories` table, filtered by student_id
5. Teaching Schedule → Learning Schedule: same `schedules` table, Teacher sees by teacher_id, Student sees by student_id
6. Learning Materials: Manager uploads, all Students can download
7. Duration: only two values — 25 min or 50 min

---

## 8. Middleware

```php
// app/Http/Middleware/RoleMiddleware.php
// Checks auth()->user()->role against required role
// Aborts with 403 if mismatch
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

---

## 9. Out of Scope

- Email notifications
- Real-time features (WebSockets)
- Self-registration
- Password reset (can add later via Breeze)
- Multi-language UI
