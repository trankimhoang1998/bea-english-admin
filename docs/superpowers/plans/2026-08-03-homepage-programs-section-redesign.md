# Homepage Programs Section Redesign Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Polish the homepage's "Các Chương Trình Học Tại BEA English" section (Học sinh + Người lớn blocks) — capitalize copy, drop all percentage claims, replace the two skill/level visualizations with illustrated panels, balance column heights, and restore hover micro-interactions.

**Architecture:** Pure Blade/Tailwind edits to three existing view files — no new routes, models, controllers, JS, or CSS files. Illustrations are hand-authored inline `<svg>` markup (no external assets/URLs). Hover effects use Tailwind's built-in `hover:`/`group-hover:` utilities, matching idioms already used elsewhere in the codebase (`.mt-card`, `group-hover:scale-110` in `resources/views/home/sections/hoc-sinh/muc-tieu.blade.php`).

**Tech Stack:** Laravel Blade, Tailwind CSS (utility classes only, no new `<style>` rules needed), Material Symbols icon font (already loaded site-wide).

## Global Constraints

- No external image URLs or new binary asset files — illustrations are inline SVG only.
- No percentage numbers anywhere in either visual panel or in the Người lớn body copy (spec section "Goals").
- Reuse the existing `primary-container` Tailwind color token (already used throughout this file as `text-primary-container`, `bg-primary-container/10`, etc.) — do not introduce new color values.
- Scope is limited to: `resources/views/home/sections/index/programs.blade.php`, `resources/views/components/home/header.blade.php`. Do not touch `hoc-sinh`, `nguoi-lon`, or `gioi-thieu` detail pages.
- Verify every task visually at `http://localhost:8080/` (the Docker stack is already running) before committing.

---

### Task 1: Copy polish — capitalization, heading color, drop stray percentages

**Files:**
- Modify: `resources/views/home/sections/index/programs.blade.php:26-36` (Học sinh block heading + bullet array)
- Modify: `resources/views/home/sections/index/programs.blade.php:176-188` (Người lớn block heading + bullet array)

**Interfaces:** None — pure content/class edit, no new identifiers produced or consumed.

- [ ] **Step 1: Capitalize the Học sinh bullet descriptions and change the heading color**

In `resources/views/home/sections/index/programs.blade.php`, find:

```php
                <h3 class="text-2xl lg:text-[1.9rem] font-black text-gray-900 uppercase leading-tight mb-4">
                    Các Khóa Học Tiếng Anh<br>Cho Học Sinh
                </h3>
```

Replace with:

```php
                <h3 class="text-2xl lg:text-[1.9rem] font-black text-primary-container uppercase leading-tight mb-4">
                    Các Khóa Học Tiếng Anh<br>Cho Học Sinh
                </h3>
```

Then find the Học sinh bullet array:

```php
                    @foreach([
                        ['menu_book',     'Chương trình gồm 10 khóa học',                            'nội dung giáo trình giảng dạy bám sát khung chuẩn Cambridge Young Learners và phù hợp với khung tham chiếu ngôn ngữ chung châu Âu CEFR.'],
                        ['task_alt',      'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết', 'luyện phát âm chuẩn, tăng phản xạ giao tiếp và thuyết trình tự tin. Rèn luyện tư duy phản biện, kỹ năng suy luận bằng tiếng Anh, hỗ trợ học tập ở các cấp độ cao hơn.'],
                        ['verified_user', 'Xây dựng nền tảng vững chắc với 6.000+ từ vựng',         'hàng trăm cấu trúc câu phổ biến, sử dụng hàng ngày trong học tập và cuộc sống.'],
                        ['star',          'Chuẩn bị cho kỳ thi Cambridge',                           'đạt điểm cao với phương pháp luyện thi hiệu quả. Hướng đến mục tiêu IELTS 6.0+, tạo lợi thế du học và cơ hội phát triển trong môi trường quốc tế.'],
                    ] as [$icon, $bold, $text])
```

Replace with (only the description strings' first letters changed):

```php
                    @foreach([
                        ['menu_book',     'Chương trình gồm 10 khóa học',                            'Nội dung giáo trình giảng dạy bám sát khung chuẩn Cambridge Young Learners và phù hợp với khung tham chiếu ngôn ngữ chung châu Âu CEFR.'],
                        ['task_alt',      'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết', 'Luyện phát âm chuẩn, tăng phản xạ giao tiếp và thuyết trình tự tin. Rèn luyện tư duy phản biện, kỹ năng suy luận bằng tiếng Anh, hỗ trợ học tập ở các cấp độ cao hơn.'],
                        ['verified_user', 'Xây dựng nền tảng vững chắc với 6.000+ từ vựng',         'Hàng trăm cấu trúc câu phổ biến, sử dụng hàng ngày trong học tập và cuộc sống.'],
                        ['star',          'Chuẩn bị cho kỳ thi Cambridge',                           'Đạt điểm cao với phương pháp luyện thi hiệu quả. Hướng đến mục tiêu IELTS 6.0+, tạo lợi thế du học và cơ hội phát triển trong môi trường quốc tế.'],
                    ] as [$icon, $bold, $text])
```

- [ ] **Step 2: Capitalize the Người lớn bullet descriptions, change heading color, and drop the two percentages from the body copy**

Find:

```php
                <h3 class="text-2xl lg:text-[1.9rem] font-black text-gray-900 uppercase leading-tight mb-4">
                    Các Khóa Học Tiếng Anh<br>Cho Người Lớn
                </h3>
```

Replace with:

```php
                <h3 class="text-2xl lg:text-[1.9rem] font-black text-primary-container uppercase leading-tight mb-4">
                    Các Khóa Học Tiếng Anh<br>Cho Người Lớn
                </h3>
```

Then find the Người lớn bullet array:

```php
                    @foreach([
                        ['auto_awesome', 'Chương trình gồm 04 cấp độ với 10 khóa học chuyên sâu',       'phù hợp cả với người mới bắt đầu và người muốn học nâng cao toàn diện.'],
                        ['timer',        'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết',      'rèn luyện phát âm và ngữ điệu chuẩn xác lên đến 90%; nâng cao khả năng nghe hiểu lên đến 80%, giúp phản xạ nhanh trong hội thoại công việc và giao tiếp hàng ngày.'],
                        ['menu_book',   'Tích lũy lên đến 5.000+ từ vựng thông dụng',                   'về các chủ đề xung quanh cuộc sống và công việc thường ngày. Làm chủ hàng trăm cấu trúc câu phổ biến trong giao tiếp, giúp bạn tự tin bắt đầu và duy trì cuộc trò chuyện.'],
                        ['star',        'Cam kết chuẩn đầu ra theo khung CEFR từ A2 đến B2',            'Hướng đến mục tiêu chinh phục các kỳ thi IELTS, TOEIC, VSTEP... tạo lợi thế du học và cơ hội nghề nghiệp trong môi trường quốc tế.'],
                    ] as [$icon, $bold, $text])
```

Replace with (capitalized first letters; the "lên đến 90%" / "lên đến 80%" clause is rewritten without numbers):

```php
                    @foreach([
                        ['auto_awesome', 'Chương trình gồm 04 cấp độ với 10 khóa học chuyên sâu',       'Phù hợp cả với người mới bắt đầu và người muốn học nâng cao toàn diện.'],
                        ['timer',        'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết',      'Rèn luyện phát âm và ngữ điệu chuẩn xác, nâng cao khả năng nghe hiểu, giúp phản xạ nhanh trong hội thoại công việc và giao tiếp hàng ngày.'],
                        ['menu_book',   'Tích lũy lên đến 5.000+ từ vựng thông dụng',                   'Về các chủ đề xung quanh cuộc sống và công việc thường ngày. Làm chủ hàng trăm cấu trúc câu phổ biến trong giao tiếp, giúp bạn tự tin bắt đầu và duy trì cuộc trò chuyện.'],
                        ['star',        'Cam kết chuẩn đầu ra theo khung CEFR từ A2 đến B2',            'Hướng đến mục tiêu chinh phục các kỳ thi IELTS, TOEIC, VSTEP... tạo lợi thế du học và cơ hội nghề nghiệp trong môi trường quốc tế.'],
                    ] as [$icon, $bold, $text])
```

- [ ] **Step 3: Verify in browser**

Open `http://localhost:8080/` and scroll to the "Các Chương Trình Học Tại BEA English" section. Confirm: both headings are now orange, every bullet description starts with a capital letter, and the Người lớn "4 kỹ năng" bullet no longer mentions 90%/80%.

- [ ] **Step 4: Commit**

```bash
git add resources/views/home/sections/index/programs.blade.php
git commit -m "content: capitalize program bullet copy, orange headings, drop stray %"
```

---

### Task 2: Bullet row hover interactions (both blocks)

**Files:**
- Modify: `resources/views/home/sections/index/programs.blade.php:38-46` (Học sinh bullet row markup)
- Modify: `resources/views/home/sections/index/programs.blade.php:189-197` (Người lớn bullet row markup)

**Interfaces:** None — class-only edit, no new identifiers.

- [ ] **Step 1: Add hover feedback to the Học sinh bullet rows**

Find:

```php
                    <div class="flex gap-4 py-4">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center mt-0.5">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[14px] mb-1">{{ $bold }}</p>
                            <p class="text-[13px] text-gray-500 leading-relaxed">{{ $text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.khoa-hoc') }}"
```

Replace with:

```php
                    <div class="group flex gap-4 py-4 px-3 -mx-3 rounded-2xl transition-colors duration-300 hover:bg-primary-container/5">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center mt-0.5 transition-transform duration-300 group-hover:scale-110">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[14px] mb-1 transition-colors duration-300 group-hover:text-primary-container">{{ $bold }}</p>
                            <p class="text-[13px] text-gray-500 leading-relaxed">{{ $text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.khoa-hoc') }}"
```

- [ ] **Step 2: Add the same hover feedback to the Người lớn bullet rows**

Find:

```php
                    <div class="flex gap-4 py-4">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center mt-0.5">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[14px] mb-1">{{ $bold }}</p>
                            <p class="text-[13px] text-gray-500 leading-relaxed">{{ $text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.nguoi-lon') }}"
```

Replace with:

```php
                    <div class="group flex gap-4 py-4 px-3 -mx-3 rounded-2xl transition-colors duration-300 hover:bg-primary-container/5">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center mt-0.5 transition-transform duration-300 group-hover:scale-110">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[14px] mb-1 transition-colors duration-300 group-hover:text-primary-container">{{ $bold }}</p>
                            <p class="text-[13px] text-gray-500 leading-relaxed">{{ $text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.nguoi-lon') }}"
```

> Note: both blocks have an identically-structured row `<div class="flex gap-4 py-4">` before the edit — use the surrounding `route('home.khoa-hoc')` / `route('home.nguoi-lon')` anchors shown above to target the correct one for each edit.

- [ ] **Step 3: Verify in browser**

Open `http://localhost:8080/`, hover over each of the 4 bullet rows in both blocks. Confirm: a light orange background highlight appears behind the row, the icon box scales up slightly, and the bold title text turns orange — all with a smooth (not instant) transition.

- [ ] **Step 4: Commit**

```bash
git add resources/views/home/sections/index/programs.blade.php
git commit -m "feat: add hover feedback to program bullet rows"
```

---

### Task 3: Header nav hover lift

**Files:**
- Modify: `resources/views/components/home/header.blade.php:32-52` (top-level nav links + dropdown trigger)

**Interfaces:** None — class-only edit.

- [ ] **Step 1: Add a hover lift to the three plain nav links**

Find (three occurrences — Trang chủ, Giới thiệu, Phương pháp — plus the fourth, Tin tức sự kiện, further down):

```php
                       class="px-4 py-2 text-[16px] block transition-colors {{ $activePage === 'home' ? $activeClass : $inactiveClass }}">
```

Replace with:

```php
                       class="px-4 py-2 text-[16px] block transition-all duration-200 hover:-translate-y-0.5 {{ $activePage === 'home' ? $activeClass : $inactiveClass }}">
```

Apply the same `transition-colors` → `transition-all duration-200 hover:-translate-y-0.5` swap to the other three nav `<a>` tags in this file that follow the identical pattern:

```php
                       class="px-4 py-2 text-[16px] block transition-colors {{ $activePage === 'gioi-thieu' ? $activeClass : $inactiveClass }}">
```
```php
                       class="px-4 py-2 text-[16px] block transition-colors {{ $activePage === 'phuong-phap' ? $activeClass : $inactiveClass }}">
```
```php
                       class="px-4 py-2 text-[16px] block transition-colors {{ $activePage === 'tin-tuc' ? $activeClass : $inactiveClass }}">
```

Each becomes `transition-all duration-200 hover:-translate-y-0.5` in place of `transition-colors`, keeping the rest of the class string (including the `{{ $activePage === '...' ? $activeClass : $inactiveClass }}` conditional) unchanged.

- [ ] **Step 2: Add the same lift to the "Học tại BeA" dropdown trigger**

Find:

```php
                    <button class="flex items-center gap-0.5 px-4 py-2 text-[16px] transition-colors {{ $dropdownActive ? 'font-semibold text-primary-container' : 'font-medium text-on-surface hover:text-primary-container' }}"
```

Replace with:

```php
                    <button class="flex items-center gap-0.5 px-4 py-2 text-[16px] transition-all duration-200 hover:-translate-y-0.5 {{ $dropdownActive ? 'font-semibold text-primary-container' : 'font-medium text-on-surface hover:text-primary-container' }}"
```

- [ ] **Step 3: Verify in browser**

Open `http://localhost:8080/`, hover over each top-level nav item (Trang chủ, Giới thiệu, Phương pháp, Học tại BeA, Tin tức sự kiện). Confirm each lifts slightly upward in addition to the existing color-change-on-hover, and the dropdown still opens correctly on hover/click.

- [ ] **Step 4: Commit**

```bash
git add resources/views/components/home/header.blade.php
git commit -m "feat: add hover lift to header nav links"
```

---

### Task 4: Học sinh visual panel — illustration + skill icons, no percentages

**Files:**
- Modify: `resources/views/home/sections/index/programs.blade.php:17` (grid alignment)
- Modify: `resources/views/home/sections/index/programs.blade.php:64-80` (skill circles block)

**Interfaces:** None — self-contained markup replacement within the existing panel `<div>`.

- [ ] **Step 1: Stretch the Học sinh grid instead of centering it**

Find:

```php
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-16 lg:mb-24 reveal">
```

Replace with:

```php
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-stretch mb-16 lg:mb-24 reveal">
```

- [ ] **Step 2: Replace the 4 skill-percentage circles with an illustration + plain skill icons**

Find:

```php
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- 4 Skill circles --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Phát triển 4 kỹ năng</p>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['Nghe' => 88, 'Nói' => 85, 'Đọc' => 90, 'Viết' => 82] as $skill => $pct)
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center"
                                     style="background: conic-gradient(#f97316 0% {{ $pct }}%, #fed7aa {{ $pct }}% 100%);">
                                    <div class="w-11 h-11 rounded-full bg-white flex items-center justify-center">
                                        <span class="text-[11px] font-black text-primary-container">{{ $pct }}%</span>
                                    </div>
                                </div>
                                <span class="text-[12px] font-semibold text-gray-600">{{ $skill }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['10', 'Khóa học'], ['6.000+', 'Từ vựng'], ['6–18', 'Tuổi']] as [$num, $label])
```

Replace with:

```php
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- Illustration --}}
                    <div class="rounded-2xl bg-primary-container/5 flex items-center justify-center px-4 pt-5">
                        <svg viewBox="0 0 300 200" class="w-full max-w-[260px] h-auto" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Học sinh học tiếng Anh trực tuyến">
                            <ellipse cx="150" cy="175" rx="120" ry="14" fill="#fed7aa" opacity="0.5"/>
                            <rect x="60" y="150" width="180" height="10" rx="5" fill="#fdba74"/>
                            <rect x="110" y="120" width="80" height="34" rx="6" fill="#f97316"/>
                            <rect x="118" y="86" width="64" height="46" rx="6" fill="#ffffff" stroke="#f97316" stroke-width="4"/>
                            <rect x="126" y="96" width="48" height="6" rx="3" fill="#fed7aa"/>
                            <rect x="126" y="108" width="34" height="6" rx="3" fill="#fed7aa"/>
                            <rect x="128" y="60" width="44" height="46" rx="18" fill="#fb923c"/>
                            <circle cx="150" cy="42" r="22" fill="#fdba74"/>
                            <path d="M130 38 a20 20 0 0 1 40 0" fill="none" stroke="#f97316" stroke-width="5" stroke-linecap="round"/>
                            <circle cx="130" cy="42" r="6" fill="#f97316"/>
                            <circle cx="170" cy="42" r="6" fill="#f97316"/>
                            <g transform="translate(220,50)">
                                <rect x="0" y="0" width="34" height="24" rx="3" fill="#ffffff" stroke="#f97316" stroke-width="3"/>
                                <line x1="17" y1="0" x2="17" y2="24" stroke="#f97316" stroke-width="3"/>
                            </g>
                            <g transform="translate(50,70)">
                                <path d="M12 0 L15 8 L24 8 L17 13 L19 22 L12 17 L5 22 L7 13 L0 8 L9 8 Z" fill="#fdba74"/>
                            </g>
                        </svg>
                    </div>
                    {{-- 4 Skill icons --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Phát triển 4 kỹ năng</p>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['Nghe' => 'headphones', 'Nói' => 'record_voice_over', 'Đọc' => 'menu_book', 'Viết' => 'edit'] as $skill => $skillIcon)
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $skillIcon }}</span>
                                </div>
                                <span class="text-[12px] font-semibold text-gray-600">{{ $skill }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['10', 'Khóa học'], ['6.000+', 'Từ vựng'], ['6–18', 'Tuổi']] as [$num, $label])
```

- [ ] **Step 3: Verify in browser**

Open `http://localhost:8080/`. Confirm: the Học sinh panel now shows an illustration of a student at a laptop above 4 skill icons (headphones/mic/book/pencil) with no percentage numbers anywhere, the stat tiles (10/6.000+/6–18) and badges (Cambridge YL/CEFR/IELTS Ready) are unchanged below, and the panel's top/bottom edges now line up with the text column on its left (no large empty gap from the old `items-center` centering).

- [ ] **Step 4: Commit**

```bash
git add resources/views/home/sections/index/programs.blade.php
git commit -m "feat: replace student skill percentages with illustration + icons"
```

---

### Task 5: Người lớn visual panel — illustration + level badges, no percentages

**Files:**
- Modify: `resources/views/home/sections/index/programs.blade.php:112` (grid alignment)
- Modify: `resources/views/home/sections/index/programs.blade.php:121-149` (level progress-bar block)

**Interfaces:** None — self-contained markup replacement within the existing panel `<div>`.

- [ ] **Step 1: Stretch the Người lớn grid instead of centering it**

Find:

```php
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center reveal">
```

Replace with:

```php
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-stretch reveal">
```

- [ ] **Step 2: Replace the level progress bars with an illustration + plain level badges**

Find:

```php
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- Level progress bars --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Lộ trình học 04 cấp độ</p>
                        <div class="space-y-4">
                            @foreach([
                                ['A1–A2', 'Cơ bản',     100, true],
                                ['B1',    'Trung cấp',    72, false],
                                ['B2',    'Nâng cao',     40, false],
                                ['C1',    'Thành thạo',   12, false],
                            ] as [$code, $label, $pct, $done])
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-black px-2 py-0.5 rounded-md {{ $done ? 'bg-primary-container text-white' : 'bg-primary-container/10 text-primary-container' }}">{{ $code }}</span>
                                        <span class="text-[13px] font-semibold text-gray-700">{{ $label }}</span>
                                        @if($done)
                                        <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">check_circle</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold text-primary-container">{{ $pct }}%</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full prog-bar" style="width:{{ $pct }}%;"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['04', 'Cấp độ'], ['5.000+', 'Từ vựng'], ['A2–B2', 'CEFR']] as [$num, $label])
```

Replace with:

```php
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- Illustration --}}
                    <div class="rounded-2xl bg-primary-container/5 flex items-center justify-center px-4 pt-5">
                        <svg viewBox="0 0 300 200" class="w-full max-w-[260px] h-auto" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Người lớn học tiếng Anh trực tuyến">
                            <ellipse cx="150" cy="175" rx="120" ry="14" fill="#fed7aa" opacity="0.5"/>
                            <rect x="60" y="150" width="180" height="10" rx="5" fill="#fdba74"/>
                            <rect x="110" y="120" width="80" height="34" rx="6" fill="#f97316"/>
                            <rect x="118" y="86" width="64" height="46" rx="6" fill="#ffffff" stroke="#f97316" stroke-width="4"/>
                            <rect x="126" y="96" width="48" height="6" rx="3" fill="#fed7aa"/>
                            <rect x="126" y="108" width="34" height="6" rx="3" fill="#fed7aa"/>
                            <path d="M128 106 L128 66 Q128 58 138 58 L162 58 Q172 58 172 66 L172 106 Z" fill="#78350f"/>
                            <path d="M150 58 L140 74 L150 90 L160 74 Z" fill="#ffffff"/>
                            <circle cx="150" cy="40" r="22" fill="#fdba74"/>
                            <path d="M129 34 a21 21 0 0 1 42 0 q0 -14 -21 -14 t-21 14" fill="#3f2a1a"/>
                            <g transform="translate(215,95)">
                                <rect x="0" y="6" width="40" height="28" rx="4" fill="#78350f"/>
                                <rect x="14" y="0" width="12" height="10" rx="2" fill="none" stroke="#78350f" stroke-width="3"/>
                                <rect x="0" y="18" width="40" height="4" fill="#fdba74"/>
                            </g>
                            <g transform="translate(48,68)">
                                <path d="M12 0 L15 8 L24 8 L17 13 L19 22 L12 17 L5 22 L7 13 L0 8 L9 8 Z" fill="#fdba74"/>
                            </g>
                        </svg>
                    </div>
                    {{-- Level badges --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Lộ trình học 04 cấp độ</p>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['A1-A2', 'B1', 'B2', 'C1'] as $code)
                            <div class="flex items-center justify-center py-2.5 rounded-xl bg-primary-container/10">
                                <span class="text-[13px] font-black text-primary-container">{{ $code }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['04', 'Cấp độ'], ['5.000+', 'Từ vựng'], ['A2–B2', 'CEFR']] as [$num, $label])
```

> Note: after this edit, `prog-bar` (the CSS class defined in `resources/views/layouts/home.blade.php:115`) is no longer referenced anywhere in `programs.blade.php`. Leave the CSS rule itself alone — do not delete it — since it is a shared, generically-named utility class that may be reused elsewhere later; removing it is out of scope for this plan.

- [ ] **Step 3: Verify in browser**

Open `http://localhost:8080/`. Confirm: the Người lớn panel now shows an illustration of a professional at a laptop above 4 level badges (A1-A2/B1/B2/C1) with no percentage numbers or progress bars anywhere, the stat tiles (04/5.000+/A2–B2) and badges (IELTS/TOEIC/VSTEP) are unchanged below, and the panel's top/bottom edges line up with its text column.

- [ ] **Step 4: Final full-page check and commit**

Reload `http://localhost:8080/` one more time and re-check every item from the spec's "Testing / Verification" section in one pass: capitalization, orange headings, no percentages anywhere (visual or text), both illustrations present, both panels height-matched with their text columns, bullet-row hover, nav hover lift.

```bash
git add resources/views/home/sections/index/programs.blade.php
git commit -m "feat: replace adult level percentages with illustration + badges"
```
