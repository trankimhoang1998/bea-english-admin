# Homepage "Programs" Section Redesign

## Context

`resources/views/home/sections/index/programs.blade.php` renders the "Các
Chương Trình Học Tại BEA English" section on the homepage, with two
side-by-side blocks: **Học sinh** (students) and **Người lớn** (adults). Each
block has a text column (badge, heading, description, bullet list, CTA) and a
visual "dashboard" panel on the other side.

Feedback from the site owner, based on a screenshot of the Học sinh block:

1. Bullet descriptions start with a lowercase letter (e.g. "nội dung giáo
   trình..."); should be capitalized.
2. The visual panel shows per-skill percentages (Nghe 88%, Nói 85%, Đọc 90%,
   Viết 82%) as donut charts. The site should not claim a specific teaching
   percentage — replace with skill icons, no numbers. Prefer replacing the
   whole block with a lively illustration (image on top, icons below), like
   the previous website did.
3. The old website had hover micro-interactions (color change, slight
   motion) on content blocks and the nav menu; these feel missing now.
4. The left heading column and right visual panel are visually unbalanced in
   height. Fixing this will make the right panel taller, which is the room
   needed for the illustration.

Follow-up from the owner extended items 1 and 2 to the **Người lớn** block
too (its progress bars claim level-completion percentages — e.g. "A1-A2
100%, B1 72%" — which is equally not defensible, since not every learner
starts at A1), added a color change for both block headings, and asked to
also drop a stray percentage claim from the Người lớn body copy ("...lên đến
90%...80%").

No reference screenshots/URL of the old website are available, so hover
interactions and illustration style are original work, following patterns
already established elsewhere in this codebase (`.mt-card`,
`group-hover:scale-110`, etc.) rather than inventing a new visual language.

## Goals

- Capitalize the first letter of every bullet description in both blocks.
- Remove all percentage claims from both visual panels and from the Người
  lớn body copy.
- Give each visual panel an illustration (inline SVG, flat-design, no
  external assets/URLs) themed to its audience, with skill/level icons below
  it (no numbers), keeping the existing stat tiles and achievement badges
  underneath.
- Balance column heights (`items-stretch` instead of `items-center`) so the
  two panels grow to match the text column instead of being vertically
  centered against it.
- Add subtle hover feedback (color shift + slight motion) to the bullet rows
  and the header nav links, reusing the existing `.mt-card` /
  `group-hover:scale-110` idioms already used elsewhere on the site.
- Change both block headings ("Các Khóa Học Tiếng Anh Cho Học Sinh" / "...Cho
  Người Lớn") from `text-gray-900` to the brand orange
  (`text-primary-container`).

## Non-goals

- No new image/photo assets (none exist in the repo; SVGs are hand-authored,
  not fetched from any URL).
- No changes to the `hoc-sinh`/`nguoi-lon`/`gioi-thieu` detail pages — scope
  is limited to the homepage `programs.blade.php` section, plus the shared
  header component and shared `<style>` block in `layouts/home.blade.php`
  for the new hover rules.
- No redesign of the CTA buttons, divider, or section header pill.

## Design

### 1. Capitalization (both blocks)

In the `@foreach` bullet arrays (student block lines ~32-37, adult block
lines ~183-188), capitalize the first letter of each `$text` description
string. Pure content edit, no markup change.

### 2. Student visual panel

Replace the current "4 skill circles" block with:

```
[ SVG illustration: student at a laptop with headset, flat orange/white style ]

Phát triển 4 kỹ năng
[headphones icon] Nghe   [chat icon] Nói   [menu_book icon] Đọc   [edit icon] Viết

[10 / Khóa học] [6.000+ / Từ vựng] [6–18 / Tuổi]   <- unchanged

[Cambridge YL] [CEFR] [IELTS Ready]                 <- unchanged
```

Icons are small (not circular % gauges) — a Material Symbol per skill with
a short label underneath, no numbers anywhere.

### 3. Adult visual panel

Replace the "Lộ trình học 04 cấp độ" progress-bar block with:

```
[ SVG illustration: adult professional at a laptop, flat orange/white style ]

Lộ trình học 04 cấp độ
[A1-A2]  [B1]  [B2]  [C1]      <- level chips/badges, no percentages

[04 / Cấp độ] [5.000+ / Từ vựng] [A2–B2 / CEFR]     <- unchanged

[IELTS] [TOEIC] [VSTEP]                              <- unchanged
```

Also rewrite the adult body-copy bullet that currently reads "...luyện phát
âm và ngữ điệu chuẩn xác lên đến 90%; nâng cao khả năng nghe hiểu lên đến
80%..." to drop both percentages while keeping the meaning (e.g. "...rèn
luyện phát âm và ngữ điệu chuẩn xác, nâng cao khả năng nghe hiểu, giúp phản
xạ nhanh trong hội thoại công việc và giao tiếp hàng ngày.").

### 4. Illustrations

Two small inline `<svg>` illustrations (no external files/fonts/images),
flat-design, using the site's existing orange palette
(`#f97316`/`#fed7aa`/white), one depicting a student, one an adult, each at
a laptop — simple geometric shapes (circles for heads, rounded rects for
laptops/bodies), consistent stroke/fill weight. Each sits inside the panel
in a rounded container matching the panel's existing card radius.

### 5. Layout balance

In both `grid lg:grid-cols-2 ...` wrappers, change `items-center` to
`items-stretch`. The visual panel's outer div already uses `flex flex-col`;
no further change needed for it to fill the stretched height — the added
illustration is what actually grows it to match the text column.

### 6. Hover interactions

- **Bullet rows**: wrap each row in `group`, add `transition-colors
  duration-300 rounded-2xl hover:bg-primary-container/5` on the row
  container (padding already exists via `py-4`, add `px-3 -mx-3` so the
  highlight has breathing room), `group-hover:scale-110
  transition-transform duration-300` on the icon box (same idiom as
  `muc-tieu.blade.php`), and `group-hover:text-primary-container` on the
  bold title.
- **Header nav** (`resources/views/components/home/header.blade.php`): add
  `hover:-translate-y-0.5` alongside the existing `transition-colors` on the
  top-level nav `<a>` links (Trang chủ, Giới thiệu, Phương pháp, Tin tức) and
  the "Học tại BeA" dropdown trigger, so hover gives a small lift plus the
  existing color change. Dropdown *items* keep their current
  background-highlight hover (already has motion-free color feedback,
  consistent with the menu's own visual language) — no change needed there.

## Testing / Verification

This is a content + Tailwind-class change with no backend logic — no
automated tests apply. Verification is visual: run the app (`docker compose`
stack already running), open `/` in a browser, and check:

- Both bullet lists show capitalized descriptions.
- Both panels show an illustration, icons/badges with no percentages
  anywhere (visual or textual), and stats/badges unchanged below.
- The text column and visual panel in each block have matching top/bottom
  edges.
- Hovering a bullet row highlights it; hovering top nav links shows a slight
  lift in addition to the color change.
