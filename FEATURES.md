# BEA English Admin — Tài liệu chức năng & hướng dẫn sử dụng

## Tổng quan hệ thống

BEA English Admin là hệ thống quản lý dạy học nội bộ xây dựng trên **Laravel 11**, giao diện **Tailwind CSS + Alpine.js**. Hệ thống phân quyền 3 vai trò: **Manager**, **Teacher**, **Student**.

---

## Cài đặt & chạy

```bash
# Clone & cài dependency
composer install

# Tạo file .env
cp .env.example .env
php artisan key:generate

# Chạy bằng Docker
docker compose up -d

# Migrate + seed dữ liệu demo
docker compose exec php php artisan migrate --seed
```

Truy cập tại: `http://localhost:8080`
phpMyAdmin tại: `http://localhost:8888`

---

## Tài khoản demo

| Vai trò | Email | Mật khẩu |
|---------|-------|----------|
| Manager | manager@bea.edu.vn | password |
| Teacher | teacher@bea.edu.vn | password |
| Student | student@bea.edu.vn | password |

---

## Phân quyền & điều hướng

Sau khi đăng nhập, hệ thống tự động chuyển người dùng đến dashboard phù hợp với vai trò:

| Vai trò | Trang chủ | Prefix URL |
|---------|-----------|------------|
| Manager | `/dashboard` | `/manager/...` |
| Teacher | `/teacher/` | `/teacher/...` |
| Student | `/student/` | `/student/...` |

Middleware `role:manager/teacher/student` bảo vệ từng nhóm route. Truy cập sai vai trò trả về **HTTP 403**.

---

## Chức năng theo vai trò

---

### MANAGER

#### 1. Dashboard
**URL:** `/dashboard`

Hiển thị tổng quan toàn hệ thống:
- Tổng số giáo viên, học sinh, lịch học, buổi dạy đã ghi nhận
- Danh sách 5 buổi dạy gần nhất
- Nút truy cập nhanh đến Teachers / Students / Schedules

---

#### 2. Quản lý giáo viên (Teachers)
**URL:** `/manager/teachers`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /manager/teachers` | Bảng tất cả giáo viên, phân trang 10 |
| Thêm mới | `GET /manager/teachers/create` | Form tạo giáo viên |
| Lưu | `POST /manager/teachers` | Validate & lưu DB |
| Chi tiết | `GET /manager/teachers/{id}` | Xem thông tin + lịch sử dạy |
| Sửa | `GET /manager/teachers/{id}/edit` | Form cập nhật |
| Cập nhật | `PUT /manager/teachers/{id}` | Lưu thay đổi |
| Xóa | `DELETE /manager/teachers/{id}` | Xóa mềm (SoftDelete) |

**Trường dữ liệu:** Tên (qua User), Email, Mã giáo viên (`teacher_id`), Kinh nghiệm (`experience`).

> Xóa giáo viên dùng SoftDelete — dữ liệu không mất hẳn khỏi DB.

---

#### 3. Quản lý học sinh (Students)
**URL:** `/manager/students`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /manager/students` | Bảng tất cả học sinh, phân trang 10 |
| Thêm mới | `GET /manager/students/create` | Form tạo học sinh |
| Lưu | `POST /manager/students` | Validate & lưu DB |
| Chi tiết | `GET /manager/students/{id}` | Xem thông tin + lịch học |
| Sửa | `GET /manager/students/{id}/edit` | Form cập nhật |
| Cập nhật | `PUT /manager/students/{id}` | Lưu thay đổi |
| Xóa | `DELETE /manager/students/{id}` | Xóa mềm (SoftDelete) |

**Trường dữ liệu:** Tên, Email, Mã học sinh (`student_id`), Tuổi (`age`), Khóa học (`course`).

---

#### 4. Quản lý lịch học (Schedules)
**URL:** `/manager/schedules`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /manager/schedules` | Bảng lịch học, phân trang 10 |
| Thêm mới | `GET /manager/schedules/create` | Form tạo lịch |
| Lưu | `POST /manager/schedules` | Validate & lưu |
| Sửa | `GET /manager/schedules/{id}/edit` | Form cập nhật |
| Cập nhật | `PUT /manager/schedules/{id}` | Lưu thay đổi |
| Xóa | `DELETE /manager/schedules/{id}` | Xóa lịch |

**Trường dữ liệu:** Giáo viên, Học sinh, Thứ trong tuần (`mon`–`sun`), Giờ bắt đầu, Giờ kết thúc.

---

#### 5. Quản lý tài liệu (Learning Materials)
**URL:** `/manager/materials`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /manager/materials` | Bảng tài liệu, phân trang 10 |
| Upload | `GET /manager/materials/create` | Form upload file |
| Lưu | `POST /manager/materials` | Upload file + lưu DB |
| Tải về | `GET /manager/materials/{id}/download` | Download file |
| Xóa | `DELETE /manager/materials/{id}` | Xóa file + bản ghi |

**Trường dữ liệu:** Tiêu đề (`title`), File đính kèm (`file_path`), Người upload.

---

#### 6. Lịch sử dạy học (Teaching Histories — Manager view)
**URL:** `/manager/histories`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /manager/histories` | Toàn bộ lịch sử, phân trang 10 |
| Chi tiết | `GET /manager/histories/{id}` | Xem đầy đủ 1 buổi |
| Xóa | `DELETE /manager/histories/{id}` | Xóa bản ghi + video |

> Manager chỉ xem & xóa, không tạo/sửa. Teacher mới là người ghi nhận.

---

### TEACHER

#### 7. Dashboard giáo viên
**URL:** `/teacher/`

Hiển thị:
- Lịch dạy trong tuần của giáo viên đang đăng nhập
- Tổng số buổi đã dạy

---

#### 8. Ghi nhận lịch sử dạy học (Teaching Histories)
**URL:** `/teacher/histories`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /teacher/histories` | Lịch sử dạy của chính mình, phân trang 10 |
| Thêm mới | `GET /teacher/histories/create` | Form ghi nhận buổi dạy |
| Lưu | `POST /teacher/histories` | Validate & lưu |
| Chi tiết | `GET /teacher/histories/{id}` | Xem chi tiết 1 buổi |
| Sửa | `GET /teacher/histories/{id}/edit` | Form cập nhật |
| Cập nhật | `PUT /teacher/histories/{id}` | Lưu thay đổi |
| Xóa | `DELETE /teacher/histories/{id}` | Xóa bản ghi |

**Trường dữ liệu:** Học sinh, Tên bài học (`lesson`), Ngày giờ dạy (`taught_at`), Thời lượng (phút), Video log (upload file), Ghi chú.

> Teacher chỉ thấy và sửa được lịch sử **của chính mình** — có kiểm tra ownership trước mọi thao tác.

---

### STUDENT

#### 9. Dashboard học sinh
**URL:** `/student/`

Hiển thị:
- Lịch học trong tuần của học sinh đang đăng nhập
- Tổng số buổi đã học

---

#### 10. Lịch sử học tập (Learning History)
**URL:** `/student/history`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /student/history` | Lịch sử học của chính mình, phân trang 10 |
| Chi tiết | `GET /student/history/{id}` | Xem chi tiết 1 buổi |
| Xem video | `GET /student/history/{id}/video` | Download/stream video log |

> Read-only — học sinh không tạo hay sửa dữ liệu.

---

#### 11. Tài liệu học tập (Materials — Student view)
**URL:** `/student/materials`

| Hành động | URL | Mô tả |
|-----------|-----|-------|
| Danh sách | `GET /student/materials` | Danh sách tài liệu, phân trang 10 |
| Tải về | `GET /student/materials/{id}/download` | Download file |

---

## Hệ thống thông báo Toast

Mọi hành động thành công/thất bại đều hiển thị toast notification góc dưới phải màn hình — **không cần thêm code vào từng view**.

**Controller chỉ cần redirect kèm flash:**

```php
return redirect()->route('manager.teachers.index')
    ->with('success', 'Teacher created successfully.');

return redirect()->back()
    ->with('error', 'File upload failed.');
```

**Các loại toast:**

| Type | Màu | Icon |
|------|-----|------|
| `success` | Xanh lá | `check_circle` |
| `error` | Đỏ | `error` |
| `warning` | Vàng | `warning` |
| `info` | Xanh dương | `info` |

**Trigger từ JavaScript** (nếu cần):

```js
Alpine.store('toast').show('Thao tác thành công!', 'success');
Alpine.store('toast').show('Có lỗi xảy ra.', 'error');
// duration mặc định 4500ms, có thể tùy chỉnh tham số thứ 3
Alpine.store('toast').show('Đang xử lý...', 'info', 6000);
```

Toast tự đóng sau 4.5 giây, có thanh tiến trình và nút đóng thủ công.

---

## Confirm Modal (xóa dữ liệu)

Mọi nút xóa đều mở modal xác nhận thay vì dùng `confirm()` của trình duyệt.

**Cách dùng trong view mới:**

```blade
{{-- 1. Form xóa (ẩn) --}}
<form id="del-item-{{ $item->id }}" method="POST" action="{{ route('...destroy', $item) }}">
    @csrf @method('DELETE')
</form>

{{-- 2. Nút trigger modal --}}
<button type="button"
        @click="$store.confirmModal.show('Xóa item này?', 'del-item-{{ $item->id }}')"
        class="...">
    Xóa
</button>
```

Tham số thứ 3 là tiêu đề modal (mặc định: `Confirm Delete`):

```js
$store.confirmModal.show('Nội dung xác nhận', 'form-id', 'Tiêu đề tùy chỉnh')
```

---

## Thiết kế & UI

### Design system tokens (Tailwind classes)

**Màu sắc:**
```
text-primary           → #9d4300  (cam đậm)
bg-primary-container   → #f97316  (cam sáng — nút chính)
text-secondary         → #505f76  (xám xanh)
bg-secondary-container → #d0e1fb  (xanh nhạt)
text-error             → #ba1a1a  (đỏ)
bg-surface-container-lowest → #ffffff
bg-surface-container-low    → #f0f3ff
bg-background               → #f9f9ff
text-on-surface        → #111c2d
```

**Spacing:**
```
p-xs  → 4px    p-sm  → 8px
p-md  → 16px   p-lg  → 24px
p-xl  → 40px   p-2xl → 64px
```

**Font sizes:**
```
text-display-lg  → 48px    text-headline-lg → 32px
text-headline-sm → 20px    text-body-md     → 16px
text-body-sm     → 14px    text-label-md    → 14px (tracking)
text-label-sm    → 12px
```

### Icons

Dự án dùng **Material Symbols Outlined** (Google Fonts):

```blade
<span class="material-symbols-outlined text-[20px]">check_circle</span>
<span class="material-symbols-outlined text-[18px]">delete</span>
```

Tra cứu icon: https://fonts.google.com/icons

### Layout

- **Sidebar cố định** 280px bên trái, collapse trên mobile
- **Mobile**: hamburger menu ở top bar, sidebar slide in từ trái
- **Nội dung**: `p-md md:p-lg xl:p-2xl`
- **Header trang**: sticky dưới sidebar/top bar, chứa tiêu đề + nút action

---

## Pagination

Tất cả bảng dữ liệu hiển thị 10 bản ghi/trang. Controller dùng:

```php
$items = Model::paginate(10);
```

View hiển thị pagination:

```blade
@if($items->hasPages())
    <div class="px-lg py-md border-t border-outline-variant">
        {{ $items->links() }}
    </div>
@endif
```

Template pagination tùy chỉnh nằm tại `resources/views/vendor/pagination/tailwind.blade.php`.

---

## Cấu trúc thư mục quan trọng

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Manager/          # TeacherController, StudentController,
│   │   │                     # ScheduleController, LearningMaterialController,
│   │   │                     # TeachingHistoryManagerController
│   │   ├── Teacher/          # TeachingHistoryController
│   │   └── Student/          # LearningHistoryController, MaterialDownloadController
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── User.php              # role: manager|teacher|student
│   ├── Teacher.php           # SoftDelete
│   ├── Student.php           # SoftDelete
│   ├── Schedule.php
│   ├── TeachingHistory.php
│   └── LearningMaterial.php

resources/views/
├── layouts/
│   ├── app.blade.php         # Layout chính (sidebar, toast, modal)
│   ├── navigation.blade.php  # Sidebar navigation
│   └── guest.blade.php       # Layout trang login
├── manager/                  # Views cho Manager
├── teacher/                  # Views cho Teacher
├── student/                  # Views cho Student
└── auth/                     # Login, forgot password

routes/
└── web.php                   # Toàn bộ routes phân theo role
```

---

## Thêm chức năng mới

### Thêm 1 resource mới (ví dụ: Courses)

**1. Model + Migration:**
```bash
php artisan make:model Course -m
```

**2. Controller:**
```bash
php artisan make:controller Manager/CourseController --resource
```

**3. Route** (trong `routes/web.php`, trong nhóm `manager`):
```php
Route::resource('courses', CourseController::class);
```

**4. View** — copy pattern từ `resources/views/manager/teachers/index.blade.php`.

**5. Sidebar** — thêm link vào `resources/views/layouts/navigation.blade.php` trong block `@if(Auth::user()->isManager())`.

**6. Toast** — controller dùng `->with('success', '...')` như bình thường, toast tự hiện.

**7. Confirm xóa** — dùng pattern `$store.confirmModal.show(...)` như mô tả ở trên.
