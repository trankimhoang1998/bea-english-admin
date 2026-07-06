# Homepage Redesign Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Transform the existing BEA English marketing site screenshot into a premium, modern landing page built in Laravel Blade — comparable to Stripe, Vercel, or Linear in quality.

**Architecture:** Create a new public `GET /` route (outside auth middleware) backed by `HomeController`, rendered via a dedicated `layouts/home.blade.php`, with each section as its own Blade partial under `resources/views/home/partials/`. All interactivity (accordion, mobile nav, scroll reveal, counter animation) uses Alpine.js (already loaded via CDN). All styling uses the existing Tailwind CDN + project design tokens.

**Tech Stack:** Laravel 11, Blade templates, Tailwind CSS (CDN with existing design token config), Alpine.js 3.x, Material Symbols Outlined, Inter font.

---

## File Map

| Action | Path | Responsibility |
|--------|------|----------------|
| Modify | `routes/web.php` | Move `GET /` outside auth, point to HomeController |
| Create | `app/Http/Controllers/HomeController.php` | Return home view |
| Create | `resources/views/layouts/home.blade.php` | Full-page layout: meta, CDN scripts, sticky nav, footer |
| Create | `resources/views/home/index.blade.php` | Assembles all section partials |
| Create | `resources/views/home/partials/hero.blade.php` | Hero: gradient bg, headline, CTA, floating shapes, stats |
| Create | `resources/views/home/partials/stats-strip.blade.php` | Full-width orange strip: 4 × animated metric |
| Create | `resources/views/home/partials/free-trial.blade.php` | Free trial offer: features + pricing + CTA |
| Create | `resources/views/home/partials/courses.blade.php` | Course grid with hover cards |
| Create | `resources/views/home/partials/ielts.blade.php` | IELTS score-range cards |
| Create | `resources/views/home/partials/commitment.blade.php` | 4 benefit columns |
| Create | `resources/views/home/partials/faq.blade.php` | Alpine.js accordion FAQ |
| Create | `resources/views/home/partials/contact.blade.php` | Registration form + contact info |

---

## Task 1: Git Branch Setup

**Files:** None (git only)

- [ ] **Step 1: Checkout main and pull**

```bash
git checkout main
git pull
```

- [ ] **Step 2: Create feature branch**

```bash
git checkout -b feature/ui-home
```

- [ ] **Step 3: Verify clean state**

```bash
git status
```
Expected: `nothing to commit, working tree clean`

---

## Task 2: Route & Controller

**Files:**
- Modify: `routes/web.php:25-27`
- Create: `app/Http/Controllers/HomeController.php`

**Context:** The current `GET /` route (line 25) is outside auth middleware but just redirects to dashboard. We replace it with a proper homepage. Authenticated users visiting `/` will still see the homepage (they can log in from the nav).

- [ ] **Step 1: Create HomeController**

```php
<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
```

- [ ] **Step 2: Update the route**

In `routes/web.php`, replace lines 25–27:

```php
// BEFORE:
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// AFTER:
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
```

- [ ] **Step 3: Verify route resolves**

```bash
php artisan route:list | grep "GET.*/"
```
Expected: a line showing `home` → `HomeController@index`

---

## Task 3: Home Layout

**Files:**
- Create: `resources/views/layouts/home.blade.php`

**Context:** This is a public-facing marketing layout — completely separate from `layouts/app.blade.php` (dashboard) and `layouts/guest.blade.php` (auth forms). It includes:
- The same Tailwind CDN config + Inter font + Alpine.js + Material Symbols
- An extended Tailwind config adding `display-xl` and animation utilities
- A sticky, glassmorphic navigation bar
- A footer with links and social
- A `@yield('content')` slot for section partials

The nav links use anchor scrolling (`#hero`, `#courses`, `#ielts`, `#contact`). The login button points to `route('login')`.

- [ ] **Step 1: Create the layout file**

```blade
{{-- resources/views/layouts/home.blade.php --}}
<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'BEA English – Nền Tảng Vững Vàng, Tương Lai Rộng Mở' }}</title>
    <meta name="description" content="{{ $description ?? 'BEA English cung cấp các khóa học tiếng Anh chất lượng cao, luyện thi IELTS và chương trình học thử miễn phí.' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary":                  "#9d4300",
                        "on-primary":               "#ffffff",
                        "primary-container":        "#f97316",
                        "on-primary-container":     "#582200",
                        "primary-fixed":            "#ffdbca",
                        "primary-fixed-dim":        "#ffb690",
                        "secondary":                "#505f76",
                        "on-secondary":             "#ffffff",
                        "secondary-container":      "#d0e1fb",
                        "on-secondary-container":   "#54647a",
                        "tertiary":                 "#006398",
                        "error":                    "#ba1a1a",
                        "background":               "#f9f9ff",
                        "on-background":            "#111c2d",
                        "surface":                  "#f9f9ff",
                        "on-surface":               "#111c2d",
                        "on-surface-variant":       "#584237",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low":    "#f0f3ff",
                        "surface-container":        "#e7eeff",
                        "surface-container-high":   "#dee8ff",
                        "surface-container-highest":"#d8e3fb",
                        "surface-dim":              "#cfdaf2",
                        "outline":                  "#8c7164",
                        "outline-variant":          "#e0c0b1",
                        "inverse-primary":          "#ffb690",
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    fontSize: {
                        "display-xl":  ["64px", { lineHeight: "1.1", letterSpacing: "-0.03em" }],
                        "display-lg":  ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em" }],
                        "headline-lg": ["32px", { lineHeight: "1.3", letterSpacing: "-0.01em" }],
                        "headline-md": ["24px", { lineHeight: "1.4" }],
                        "headline-sm": ["20px", { lineHeight: "1.4" }],
                        "body-lg":     ["18px", { lineHeight: "1.6" }],
                        "body-md":     ["16px", { lineHeight: "1.6" }],
                        "body-sm":     ["14px", { lineHeight: "1.5" }],
                        "label-md":    ["14px", { lineHeight: "1", letterSpacing: "0.05em" }],
                        "label-sm":    ["12px", { lineHeight: "1" }],
                    },
                    keyframes: {
                        'fade-up': {
                            '0%':   { opacity: '0', transform: 'translateY(24px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        'float': {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%':      { transform: 'translateY(-12px)' },
                        },
                        'pulse-slow': {
                            '0%, 100%': { opacity: '0.4' },
                            '50%':      { opacity: '0.8' },
                        },
                    },
                    animation: {
                        'fade-up':    'fade-up 0.6s ease-out forwards',
                        'float':      'float 4s ease-in-out infinite',
                        'float-slow': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse-slow 3s ease-in-out infinite',
                    },
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .ms-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }

        /* Scroll-reveal: hidden until JS adds .revealed */
        .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* Gradient mesh hero bg */
        .hero-bg {
            background: linear-gradient(135deg, #111c2d 0%, #1a1a2e 40%, #16213e 70%, #0f3460 100%);
        }
        .hero-glow {
            background: radial-gradient(ellipse 60% 50% at 60% 50%, rgba(249,115,22,0.25) 0%, transparent 70%);
        }
        /* Orange gradient strip */
        .orange-strip {
            background: linear-gradient(135deg, #ea6000 0%, #f97316 50%, #fb923c 100%);
        }
        /* Glass card */
        .glass {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.15);
        }
        /* Gradient border card */
        .gradient-border {
            position: relative;
            background: #fff;
            border-radius: 16px;
        }
        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            padding: 1px;
            background: linear-gradient(135deg, #f97316, #ffb690, transparent 60%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            pointer-events: none;
        }
    </style>

    <!-- Alpine.js plugins (must load before core) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-on-background antialiased overflow-x-hidden"
      x-data="{ scrolled: false, mobileOpen: false }"
      @scroll.window="scrolled = window.scrollY > 20">

{{-- ===== NAVIGATION ===== --}}
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm border-b border-outline-variant/30' : 'bg-transparent'">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <nav class="flex items-center justify-between h-16 lg:h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center transition-transform group-hover:scale-105"
                     :class="scrolled ? 'bg-primary-container' : 'bg-primary-container'">
                    <span class="material-symbols-outlined ms-filled text-white text-[20px]">school</span>
                </div>
                <span class="font-black text-lg tracking-tight"
                      :class="scrolled ? 'text-primary' : 'text-white'">BEA English</span>
            </a>

            {{-- Desktop nav --}}
            <ul class="hidden lg:flex items-center gap-1">
                @foreach([
                    ['#about',   'Về chúng tôi'],
                    ['#courses', 'Khóa học'],
                    ['#ielts',   'Luyện thi IELTS'],
                    ['#commitment', 'Cam kết'],
                    ['#contact', 'Liên hệ'],
                ] as [$href, $label])
                <li>
                    <a href="{{ $href }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                       :class="scrolled ? 'text-on-surface hover:bg-surface-container-low' : 'text-white/80 hover:text-white hover:bg-white/10'">
                        {{ $label }}
                    </a>
                </li>
                @endforeach
            </ul>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all"
                   :class="scrolled ? 'text-primary hover:bg-primary/5' : 'text-white hover:bg-white/10'">
                    Đăng nhập
                </a>
                <a href="#contact"
                   class="px-5 py-2.5 bg-primary-container text-white rounded-xl text-sm font-semibold shadow-lg shadow-primary-container/30 hover:bg-primary hover:shadow-primary/30 transition-all duration-200 hover:-translate-y-0.5">
                    Đăng ký học thử
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2 rounded-lg transition-colors"
                    :class="scrolled ? 'text-on-surface hover:bg-surface-container-low' : 'text-white hover:bg-white/10'"
                    aria-label="Toggle menu">
                <span class="material-symbols-outlined" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
            </button>
        </nav>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white border-b border-outline-variant/30 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-1">
            @foreach([
                ['#about',      'Về chúng tôi'],
                ['#courses',    'Khóa học'],
                ['#ielts',      'Luyện thi IELTS'],
                ['#commitment', 'Cam kết'],
                ['#contact',    'Liên hệ'],
            ] as [$href, $label])
            <a href="{{ $href }}" @click="mobileOpen = false"
               class="px-4 py-3 rounded-lg text-sm font-medium text-on-surface hover:bg-surface-container-low transition-colors">
                {{ $label }}
            </a>
            @endforeach
            <div class="border-t border-outline-variant/30 mt-2 pt-3 flex flex-col gap-2">
                <a href="{{ route('login') }}"
                   class="px-4 py-2.5 text-center rounded-xl text-sm font-semibold text-primary border border-primary/30 hover:bg-primary/5 transition-colors">
                    Đăng nhập
                </a>
                <a href="#contact"
                   class="px-4 py-2.5 text-center rounded-xl text-sm font-semibold bg-primary-container text-white hover:bg-primary transition-colors">
                    Đăng ký học thử miễn phí
                </a>
            </div>
        </div>
    </div>
</header>

{{-- ===== PAGE CONTENT ===== --}}
<main>
    @yield('content')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="bg-on-background text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-9 h-9 bg-primary-container rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined ms-filled text-white text-[20px]">school</span>
                    </div>
                    <span class="font-black text-xl text-white">BEA English</span>
                </div>
                <p class="text-sm text-white/60 leading-relaxed max-w-xs">
                    Nền tảng học tiếng Anh vững vàng, đồng hành cùng bạn trên con đường chinh phục tương lai rộng mở.
                </p>
                <div class="flex gap-3 mt-6">
                    <a href="#" aria-label="Facebook"
                       class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary-container/80 flex items-center justify-center transition-colors">
                        <span class="material-symbols-outlined text-[18px]">group</span>
                    </a>
                    <a href="#" aria-label="YouTube"
                       class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary-container/80 flex items-center justify-center transition-colors">
                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                    </a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h3 class="font-semibold text-sm text-white/80 uppercase tracking-wider mb-4">Khóa học</h3>
                <ul class="space-y-2.5">
                    @foreach(['Tiếng Anh giao tiếp', 'Tiếng Anh thiếu nhi', 'Luyện thi IELTS', 'Học thử miễn phí'] as $link)
                    <li><a href="#courses" class="text-sm text-white/50 hover:text-white transition-colors">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="font-semibold text-sm text-white/80 uppercase tracking-wider mb-4">Liên hệ</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-primary-container text-[18px] mt-0.5 shrink-0">location_on</span>
                        <span class="text-sm text-white/50">TP. Hồ Chí Minh, Việt Nam</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-primary-container text-[18px] shrink-0">phone</span>
                        <a href="tel:+84" class="text-sm text-white/50 hover:text-white transition-colors">Hotline tư vấn</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-primary-container text-[18px] shrink-0">mail</span>
                        <a href="mailto:info@beaenglish.vn" class="text-sm text-white/50 hover:text-white transition-colors">info@beaenglish.vn</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-white/30">© {{ date('Y') }} BEA English. Mọi quyền được bảo lưu.</p>
            <a href="{{ route('login') }}"
               class="text-sm text-white/40 hover:text-white transition-colors flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">lock</span>
                Đăng nhập quản trị
            </a>
        </div>
    </div>
</footer>

{{-- Scroll reveal script --}}
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(el => {
            if (el.isIntersecting) {
                el.target.classList.add('revealed');
                observer.unobserve(el.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
```

- [ ] **Step 2: Verify syntax by loading the page once the route is wired**

After all tasks: `php artisan serve` then visit `http://localhost:8000`

---

## Task 4: Home Index View (Assembler)

**Files:**
- Create: `resources/views/home/index.blade.php`

**Context:** This file just `@extends` the layout and `@include`s each section partial in order. It is the assembly point — no actual HTML here.

- [ ] **Step 1: Create the index view**

```blade
{{-- resources/views/home/index.blade.php --}}
@extends('layouts.home')

@section('content')
    @include('home.partials.hero')
    @include('home.partials.stats-strip')
    @include('home.partials.free-trial')
    @include('home.partials.courses')
    @include('home.partials.ielts')
    @include('home.partials.commitment')
    @include('home.partials.faq')
    @include('home.partials.contact')
@endsection
```

- [ ] **Step 2: Create the partials directory**

```bash
mkdir -p resources/views/home/partials
```

---

## Task 5: Hero Section

**Files:**
- Create: `resources/views/home/partials/hero.blade.php`

**Design:** Dark gradient background (deep navy) + orange radial glow. Floating geometric shapes (CSS animated circles/blobs). Two-column: left = text content, right = illustration placeholder. Trust badge at top, big display headline, subtitle, dual CTA, inline mini-stats.

- [ ] **Step 1: Create hero partial**

```blade
{{-- resources/views/home/partials/hero.blade.php --}}
<section id="hero" class="relative hero-bg min-h-screen flex items-center overflow-hidden pt-20">

    {{-- Orange radial glow --}}
    <div class="absolute inset-0 hero-glow pointer-events-none"></div>

    {{-- Floating decorative shapes --}}
    <div class="absolute top-1/4 right-[10%] w-72 h-72 rounded-full bg-primary-container/10 blur-3xl animate-float-slow pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-[5%] w-48 h-48 rounded-full bg-primary-container/8 blur-2xl animate-float pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/3 w-2 h-2 rounded-full bg-primary-container animate-pulse-slow pointer-events-none"></div>
    <div class="absolute top-2/3 right-1/4 w-3 h-3 rounded-full bg-primary-fixed animate-pulse-slow pointer-events-none" style="animation-delay:1s"></div>
    <div class="absolute top-1/2 right-[15%] w-1.5 h-1.5 rounded-full bg-white/40 animate-pulse-slow pointer-events-none" style="animation-delay:2s"></div>

    {{-- Grid lines decoration --}}
    <div class="absolute inset-0 opacity-5 pointer-events-none"
         style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 64px 64px;">
    </div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-32 w-full">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Content --}}
            <div>
                {{-- Trust badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 mb-8 reveal">
                    <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">verified</span>
                    <span class="text-sm font-medium text-white/90">Đơn vị đào tạo tiếng Anh hàng đầu</span>
                </div>

                {{-- Headline --}}
                <h1 class="text-display-lg lg:text-display-xl font-black text-white leading-tight mb-6 reveal reveal-delay-1">
                    Nền Tảng<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-container to-primary-fixed-dim">
                        Vững Vàng
                    </span><br>
                    Tương Lai Rộng Mở
                </h1>

                {{-- Subtitle --}}
                <p class="text-body-lg text-white/70 max-w-md mb-10 reveal reveal-delay-2">
                    BEA English đồng hành cùng bạn trên hành trình chinh phục tiếng Anh — từ giao tiếp, kinh doanh đến luyện thi IELTS quốc tế.
                </p>

                {{-- CTA buttons --}}
                <div class="flex flex-wrap gap-4 mb-14 reveal reveal-delay-3">
                    <a href="#contact"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary-container text-white font-semibold rounded-xl shadow-xl shadow-primary-container/40 hover:bg-primary hover:shadow-primary/40 transition-all duration-200 hover:-translate-y-0.5 text-base">
                        <span class="material-symbols-outlined text-[20px]">school</span>
                        Đăng ký học thử miễn phí
                    </a>
                    <a href="#courses"
                       class="inline-flex items-center gap-2 px-7 py-3.5 glass text-white font-semibold rounded-xl hover:bg-white/15 transition-all duration-200 hover:-translate-y-0.5 text-base">
                        Xem khóa học
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                </div>

                {{-- Mini stats --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 reveal reveal-delay-4">
                    @foreach([
                        ['100%', 'Cam kết chất lượng'],
                        ['100%', 'Giáo viên chuyên nghiệp'],
                        ['100%', 'Kết quả đảm bảo'],
                        ['100%', 'Hỗ trợ tận tâm'],
                    ] as [$value, $label])
                    <div class="text-center">
                        <div class="text-2xl font-black text-primary-container mb-1">{{ $value }}</div>
                        <div class="text-xs text-white/50 leading-snug">{{ $label }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Illustration placeholder --}}
            <div class="hidden lg:flex items-center justify-center reveal reveal-delay-2">
                <div class="relative w-full max-w-md">
                    {{-- Main card --}}
                    <div class="glass rounded-2xl p-8 animate-float">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-primary-container/80 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined ms-filled text-white text-[22px]">school</span>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-white">BEA English</div>
                                <div class="text-xs text-white/50">Nền tảng học trực tuyến</div>
                            </div>
                        </div>
                        {{-- Fake progress bars --}}
                        <div class="space-y-4">
                            @foreach([
                                ['Tiếng Anh giao tiếp', '92'],
                                ['Luyện thi IELTS', '78'],
                                ['Tiếng Anh thiếu nhi', '85'],
                            ] as [$course, $pct])
                            <div>
                                <div class="flex justify-between text-xs text-white/70 mb-1.5">
                                    <span>{{ $course }}</span><span>{{ $pct }}%</span>
                                </div>
                                <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-primary-container to-primary-fixed-dim rounded-full"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{-- Student avatars placeholder --}}
                        <div class="flex items-center gap-2 mt-6 pt-4 border-t border-white/10">
                            <div class="flex -space-x-2">
                                @for($i = 0; $i < 4; $i++)
                                <div class="w-7 h-7 rounded-full border-2 border-white/20 flex items-center justify-center text-xs font-bold"
                                     style="background: hsl({{ 20 + $i * 30 }}, 80%, 50%)">{{ chr(65 + $i) }}</div>
                                @endfor
                            </div>
                            <span class="text-xs text-white/60">+1,000 học viên đang học</span>
                        </div>
                    </div>

                    {{-- Floating badge: IELTS score --}}
                    <div class="absolute -top-6 -right-6 glass rounded-xl px-4 py-3 animate-float-slow">
                        <div class="text-xs text-white/60 mb-1">IELTS Target</div>
                        <div class="text-xl font-black text-primary-container">6.5+</div>
                    </div>

                    {{-- Floating badge: Free trial --}}
                    <div class="absolute -bottom-4 -left-6 glass rounded-xl px-4 py-3" style="animation: float 5s ease-in-out infinite">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[18px]">star</span>
                            <div>
                                <div class="text-xs font-semibold text-white">Học thử miễn phí</div>
                                <div class="text-xs text-white/50">Đăng ký ngay hôm nay</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom wave --}}
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80L1440 80L1440 20C1200 60 960 0 720 20C480 40 240 0 0 40Z" fill="white"/>
        </svg>
    </div>
</section>
```

---

## Task 6: Stats Strip

**Files:**
- Create: `resources/views/home/partials/stats-strip.blade.php`

**Design:** Full-width orange gradient strip. 4 columns, each with a large number + label. Alpine.js counter animation triggers when the strip enters the viewport. Clean, bold, high-contrast.

- [ ] **Step 1: Create stats-strip partial**

```blade
{{-- resources/views/home/partials/stats-strip.blade.php --}}
<section class="orange-strip py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8"
             x-data="counterSection()"
             x-intersect.once="startCounters()">
            @foreach([
                ['1000', '+', 'học viên đã theo học'],
                ['100',  '%', 'cam kết chất lượng giảng dạy'],
                ['5',    '+', 'năm kinh nghiệm đào tạo'],
                ['98',   '%', 'học viên đạt mục tiêu IELTS'],
            ] as [$target, $suffix, $label])
            <div class="text-center text-white">
                <div class="text-4xl lg:text-5xl font-black mb-2"
                     x-data="{ display: 0 }"
                     x-text="display + '{{ $suffix }}'">
                    0{{ $suffix }}
                </div>
                <div class="text-sm font-medium text-white/80">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
function counterSection() {
    return {
        startCounters() {
            const targets = [1000, 100, 5, 98];
            this.$el.querySelectorAll('[x-data*="display"]').forEach((el, i) => {
                const target = targets[i];
                let current = 0;
                const step = Math.ceil(target / 60);
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el._x_dataStack[0].display = current;
                    if (current >= target) clearInterval(timer);
                }, 20);
            });
        }
    }
}
</script>
```

**Note:** Alpine's `x-intersect` requires the IntersectionObserver API — available in all modern browsers. The `x-intersect.once` modifier fires only once, preventing re-animation on scroll-up.

---

## Task 7: Free Trial Section

**Files:**
- Create: `resources/views/home/partials/free-trial.blade.php`

**Design:** Two-column layout. Left: headline + feature list with check icons. Right: pricing card with CTA. Section has a light blue-gray background (`surface-container-low`). Features list uses Material Symbols check marks. Pricing card uses gradient border + shadow.

- [ ] **Step 1: Create free-trial partial**

```blade
{{-- resources/views/home/partials/free-trial.blade.php --}}
<section id="about" class="py-24 lg:py-32 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Section label --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-container/10 border border-primary-container/20 mb-4 reveal">
                <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">star</span>
                <span class="text-sm font-semibold text-primary">Ưu đãi đặc biệt</span>
            </div>
            <h2 class="text-headline-lg lg:text-display-lg font-black text-on-surface mb-4 reveal reveal-delay-1">
                Học Thử Trải Nghiệm<br>
                <span class="text-primary-container">Miễn Phí</span>
            </h2>
            <p class="text-body-lg text-secondary max-w-xl mx-auto reveal reveal-delay-2">
                Trải nghiệm phương pháp giảng dạy chuyên nghiệp của BEA English trước khi đăng ký chính thức.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Features --}}
            <div class="space-y-5 reveal reveal-delay-1">
                @foreach([
                    ['verified', 'Buổi học thử với giáo viên thực tế',        'Không phải AI hay video — bạn học với giáo viên chuyên nghiệp 1-1.'],
                    ['assessment', 'Kiểm tra trình độ miễn phí',                'Đánh giá chính xác để xếp lớp phù hợp với bạn.'],
                    ['support_agent', 'Tư vấn lộ trình học cá nhân hoá',        'Chuyên viên tư vấn thiết kế lộ trình riêng cho mục tiêu của bạn.'],
                    ['schedule', 'Linh hoạt thời gian',                          'Chọn khung giờ phù hợp — sáng, chiều hoặc tối.'],
                ] as [$icon, $title, $desc])
                <div class="flex gap-4">
                    <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container text-[20px]">{{ $icon }}</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-on-surface mb-1">{{ $title }}</h3>
                        <p class="text-sm text-secondary leading-relaxed">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Right: Pricing card --}}
            <div class="reveal reveal-delay-2">
                <div class="gradient-border p-8 shadow-xl shadow-primary-container/10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-container to-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary-container/30">
                            <span class="material-symbols-outlined ms-filled text-white text-[24px]">school</span>
                        </div>
                        <div>
                            <div class="font-black text-on-surface text-lg">Gói học chính thức</div>
                            <div class="text-sm text-secondary">Sau buổi học thử miễn phí</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-baseline gap-2 mb-1">
                            <span class="text-4xl font-black text-on-surface">500.000</span>
                            <span class="text-secondary font-medium">VNĐ</span>
                        </div>
                        <div class="text-sm text-secondary">/ tháng · Cam kết hoàn tiền nếu không hài lòng</div>
                    </div>

                    <ul class="space-y-3 mb-8">
                        @foreach([
                            'Lịch học linh hoạt theo yêu cầu',
                            'Giáo viên bản ngữ và Việt Nam',
                            'Tài liệu học độc quyền của BEA',
                            'Hỗ trợ 24/7 qua chat',
                            'Báo cáo tiến độ hàng tháng',
                        ] as $feature)
                        <li class="flex items-center gap-3 text-sm text-on-surface">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[18px] shrink-0">check_circle</span>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>

                    <a href="#contact"
                       class="block w-full text-center px-6 py-3.5 bg-primary-container text-white font-semibold rounded-xl shadow-lg shadow-primary-container/30 hover:bg-primary hover:shadow-primary/30 transition-all duration-200 hover:-translate-y-0.5">
                        Đăng ký học thử miễn phí ngay
                    </a>
                    <p class="text-center text-xs text-secondary mt-3">Không cần thẻ tín dụng · Hủy bất cứ lúc nào</p>
                </div>
            </div>
        </div>
    </div>
</section>
```

---

## Task 8: Courses Section

**Files:**
- Create: `resources/views/home/partials/courses.blade.php`

**Design:** Full-width white section. Section label + headline centered at top. Below: a `grid-cols-1 md:grid-cols-2 lg:grid-cols-3` of course cards. Each card: icon, course name, short description, level badge, "Xem chi tiết" link. Cards have gradient border, hover lift, shadow.

- [ ] **Step 1: Create courses partial**

```blade
{{-- resources/views/home/partials/courses.blade.php --}}
<section id="courses" class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-container/10 border border-primary-container/20 mb-4 reveal">
                <span class="material-symbols-outlined text-primary-container text-[16px]">menu_book</span>
                <span class="text-sm font-semibold text-primary">Chương trình học</span>
            </div>
            <h2 class="text-headline-lg lg:text-display-lg font-black text-on-surface mb-4 reveal reveal-delay-1">
                Các Khóa Học Tại<br>
                <span class="text-primary-container">BEA English</span>
            </h2>
            <p class="text-body-lg text-secondary max-w-xl mx-auto reveal reveal-delay-2">
                Từ giao tiếp cơ bản đến luyện thi IELTS quốc tế — chúng tôi có khóa học phù hợp với mọi mục tiêu.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'icon'  => 'chat_bubble',
                    'title' => 'Tiếng Anh Giao Tiếp',
                    'desc'  => 'Phát triển kỹ năng nghe – nói tự nhiên, tự tin giao tiếp trong mọi tình huống cuộc sống và công việc.',
                    'level' => 'Mọi trình độ',
                    'color' => 'bg-blue-50 text-blue-600',
                    'badge' => 'bg-blue-100 text-blue-700',
                ],
                [
                    'icon'  => 'business_center',
                    'title' => 'Tiếng Anh Thương Mại',
                    'desc'  => 'Làm chủ ngôn ngữ kinh doanh: thuyết trình, đàm phán, viết email và họp quốc tế.',
                    'level' => 'Trung cấp – Nâng cao',
                    'color' => 'bg-purple-50 text-purple-600',
                    'badge' => 'bg-purple-100 text-purple-700',
                ],
                [
                    'icon'  => 'child_care',
                    'title' => 'Tiếng Anh Thiếu Nhi',
                    'desc'  => 'Chương trình học vui – sáng tạo giúp trẻ từ 4–12 tuổi yêu thích và làm quen với tiếng Anh.',
                    'level' => '4 – 12 tuổi',
                    'color' => 'bg-green-50 text-green-600',
                    'badge' => 'bg-green-100 text-green-700',
                ],
                [
                    'icon'  => 'emoji_events',
                    'title' => 'Luyện Thi IELTS',
                    'desc'  => 'Chiến lược thi IELTS toàn diện – tập trung vào 4 kỹ năng với lộ trình cá nhân hoá theo band điểm mục tiêu.',
                    'level' => 'Band 4.0 → 7.0+',
                    'color' => 'bg-orange-50 text-orange-600',
                    'badge' => 'bg-orange-100 text-orange-700',
                ],
                [
                    'icon'  => 'work',
                    'title' => 'Tiếng Anh Cho Người Đi Làm',
                    'desc'  => 'Cải thiện tiếng Anh thực tế trong môi trường công sở – linh hoạt thời gian, phù hợp lịch làm việc.',
                    'level' => 'Sơ cấp – Nâng cao',
                    'color' => 'bg-teal-50 text-teal-600',
                    'badge' => 'bg-teal-100 text-teal-700',
                ],
                [
                    'icon'  => 'school',
                    'title' => 'Tiếng Anh Học Thuật',
                    'desc'  => 'Chuẩn bị cho môi trường đại học và nghiên cứu quốc tế: đọc – viết học thuật, thuyết trình.',
                    'level' => 'Trung cấp – Nâng cao',
                    'color' => 'bg-indigo-50 text-indigo-600',
                    'badge' => 'bg-indigo-100 text-indigo-700',
                ],
            ] as $index => $course)
            <div class="group gradient-border p-6 hover:shadow-xl hover:shadow-primary-container/10 hover:-translate-y-1 transition-all duration-300 reveal"
                 style="transition-delay: {{ $index * 0.08 }}s">
                <div class="w-12 h-12 {{ $course['color'] }} rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined text-[22px]">{{ $course['icon'] }}</span>
                </div>
                <h3 class="font-bold text-on-surface text-lg mb-2">{{ $course['title'] }}</h3>
                <p class="text-sm text-secondary leading-relaxed mb-4">{{ $course['desc'] }}</p>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $course['badge'] }}">
                        {{ $course['level'] }}
                    </span>
                    <a href="#contact"
                       class="text-sm font-semibold text-primary-container hover:text-primary flex items-center gap-1 transition-colors">
                        Tìm hiểu
                        <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
```

---

## Task 9: IELTS Section

**Files:**
- Create: `resources/views/home/partials/ielts.blade.php`

**Design:** Dark background (`on-background`) for contrast. Score range cards in a horizontal row with score "from → to" display, key features per package, CTA. A progress-style score bar visualizes each target. Feels premium, data-driven.

- [ ] **Step 1: Create ielts partial**

```blade
{{-- resources/views/home/partials/ielts.blade.php --}}
<section id="ielts" class="py-24 lg:py-32 bg-on-background">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 mb-4 reveal">
                <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">emoji_events</span>
                <span class="text-sm font-semibold text-white/80">Luyện thi IELTS</span>
            </div>
            <h2 class="text-headline-lg lg:text-display-lg font-black text-white mb-4 reveal reveal-delay-1">
                Chinh Phục<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-container to-primary-fixed-dim">
                    IELTS Mọi Band Điểm
                </span>
            </h2>
            <p class="text-body-lg text-white/60 max-w-xl mx-auto reveal reveal-delay-2">
                Lộ trình học IELTS được cá nhân hoá — bắt đầu từ trình độ hiện tại và đạt band điểm mục tiêu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
            @foreach([
                [
                    'from' => '4.0', 'to' => '5.0',
                    'label' => 'Nền tảng IELTS',
                    'duration' => '3 tháng',
                    'color' => 'from-blue-500 to-blue-600',
                    'pct' => 55,
                    'features' => ['Từ vựng học thuật cơ bản', 'Ngữ pháp nền tảng', 'Kỹ thuật làm bài Listening', 'Viết đoạn văn Task 1'],
                ],
                [
                    'from' => '4.5', 'to' => '5.5',
                    'label' => 'Phát triển IELTS',
                    'duration' => '4 tháng',
                    'color' => 'from-teal-500 to-teal-600',
                    'pct' => 65,
                    'features' => ['Reading skimming & scanning', 'Writing Task 2 cơ bản', 'Speaking Part 1 & 2', 'Mock test hàng tuần'],
                ],
                [
                    'from' => '5.0', 'to' => '6.5',
                    'label' => 'Nâng cao IELTS',
                    'duration' => '5 tháng',
                    'color' => 'from-primary-container to-orange-600',
                    'pct' => 80,
                    'features' => ['Academic writing nâng cao', 'Chiến lược Reading tốc độ cao', 'Speaking Part 3 fluency', 'Full mock test mỗi tuần'],
                    'highlight' => true,
                ],
                [
                    'from' => '6.0', 'to' => '7.0+',
                    'label' => 'Tốc độ & Đỉnh cao',
                    'duration' => '3 tháng',
                    'color' => 'from-purple-500 to-purple-600',
                    'pct' => 95,
                    'features' => ['Intensive mock tests', 'Band 7+ Writing strategies', 'Examiner-level feedback', 'Speaking fluency coaching'],
                ],
            ] as $pkg)
            <div class="relative rounded-2xl overflow-hidden reveal
                        {{ isset($pkg['highlight']) ? 'ring-2 ring-primary-container shadow-2xl shadow-primary-container/30 scale-[1.02]' : '' }}">

                @if(isset($pkg['highlight']))
                <div class="absolute top-4 right-4 z-10">
                    <span class="px-2.5 py-1 bg-primary-container text-white text-xs font-bold rounded-full">Phổ biến nhất</span>
                </div>
                @endif

                {{-- Card --}}
                <div class="bg-white/5 border border-white/10 h-full p-6 flex flex-col">
                    {{-- Score range --}}
                    <div class="flex items-center gap-3 mb-5">
                        <div class="text-2xl font-black text-white">{{ $pkg['from'] }}</div>
                        <span class="material-symbols-outlined text-primary-container">arrow_forward</span>
                        <div class="text-2xl font-black text-primary-container">{{ $pkg['to'] }}</div>
                    </div>

                    <h3 class="font-bold text-white mb-1">{{ $pkg['label'] }}</h3>
                    <p class="text-xs text-white/40 mb-5">{{ $pkg['duration'] }}</p>

                    {{-- Progress bar --}}
                    <div class="mb-5">
                        <div class="flex justify-between text-xs text-white/40 mb-1.5">
                            <span>Tiến độ mục tiêu</span>
                            <span>{{ $pkg['pct'] }}%</span>
                        </div>
                        <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r {{ $pkg['color'] }} rounded-full"
                                 style="width: {{ $pkg['pct'] }}%"></div>
                        </div>
                    </div>

                    {{-- Features --}}
                    <ul class="space-y-2.5 mb-6 flex-1">
                        @foreach($pkg['features'] as $feat)
                        <li class="flex items-start gap-2 text-sm text-white/70">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[16px] shrink-0 mt-0.5">check_circle</span>
                            {{ $feat }}
                        </li>
                        @endforeach
                    </ul>

                    <a href="#contact"
                       class="block text-center px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200
                              {{ isset($pkg['highlight'])
                                 ? 'bg-primary-container text-white shadow-lg shadow-primary-container/30 hover:bg-primary'
                                 : 'bg-white/10 text-white hover:bg-white/20' }}">
                        Đăng ký khóa học
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
```

---

## Task 10: Commitment Section

**Files:**
- Create: `resources/views/home/partials/commitment.blade.php`

**Design:** Light `surface-container-low` background. 4 commitment cards in a grid. Each card: large icon, title, 2–3 sentence description. Cards have a top-border accent in primary-container color. Staggered reveal animation. At bottom: a full-width CTA banner.

- [ ] **Step 1: Create commitment partial**

```blade
{{-- resources/views/home/partials/commitment.blade.php --}}
<section id="commitment" class="py-24 lg:py-32 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-container/10 border border-primary-container/20 mb-4 reveal">
                <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">verified</span>
                <span class="text-sm font-semibold text-primary">Cam kết của chúng tôi</span>
            </div>
            <h2 class="text-headline-lg lg:text-display-lg font-black text-on-surface mb-4 reveal reveal-delay-1">
                Đầu Tư Cho Tương Lai<br>
                <span class="text-primary-container">Xứng Đáng Với Niềm Tin Của Bạn</span>
            </h2>
            <p class="text-body-lg text-secondary max-w-xl mx-auto reveal reveal-delay-2">
                Mỗi học viên là một cam kết — chúng tôi không dừng lại cho đến khi bạn đạt được mục tiêu.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            @foreach([
                [
                    'icon' => 'workspace_premium',
                    'title' => 'Chất lượng giảng dạy hàng đầu',
                    'desc' => 'Phương pháp giảng dạy hiện đại, tài liệu độc quyền được nghiên cứu bài bản — đảm bảo hiệu quả tối đa trong mỗi buổi học.',
                ],
                [
                    'icon' => 'person_check',
                    'title' => 'Đội ngũ giáo viên chuyên nghiệp',
                    'desc' => 'Tất cả giáo viên BEA đều được chứng nhận quốc tế (CELTA/IELTS 8.0+) và có nhiều năm kinh nghiệm giảng dạy thực tế.',
                ],
                [
                    'icon' => 'trending_up',
                    'title' => 'Đảm bảo kết quả đầu ra',
                    'desc' => 'Cam kết hoàn tiền 100% nếu bạn không cải thiện sau 3 tháng học theo đúng lộ trình. Kết quả đo lường, minh bạch.',
                ],
                [
                    'icon' => 'support_agent',
                    'title' => 'Hỗ trợ tận tâm 24/7',
                    'desc' => 'Đội ngũ hỗ trợ luôn sẵn sàng giải đáp mọi thắc mắc — từ lịch học, tài liệu đến chiến lược ôn thi.',
                ],
            ] as $index => $item)
            <div class="bg-surface-container-lowest rounded-2xl p-6 border-t-4 border-primary-container shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 reveal"
                 style="transition-delay: {{ $index * 0.1 }}s">
                <div class="w-12 h-12 bg-primary-container/10 rounded-xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-primary-container text-[24px]">{{ $item['icon'] }}</span>
                </div>
                <h3 class="font-bold text-on-surface mb-3 leading-snug">{{ $item['title'] }}</h3>
                <p class="text-sm text-secondary leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- CTA banner --}}
        <div class="rounded-2xl orange-strip p-8 lg:p-12 text-center reveal">
            <h3 class="text-headline-lg font-black text-white mb-3">Bắt đầu hành trình của bạn ngay hôm nay</h3>
            <p class="text-white/80 mb-8 max-w-md mx-auto">Học thử miễn phí, không cần cam kết. Cảm nhận sự khác biệt của BEA English.</p>
            <a href="#contact"
               class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-primary font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                <span class="material-symbols-outlined text-[20px]">school</span>
                Đăng ký ngay — Miễn phí
            </a>
        </div>
    </div>
</section>
```

---

## Task 11: FAQ Section

**Files:**
- Create: `resources/views/home/partials/faq.blade.php`

**Design:** White background. Two-column layout: left = headline + supporting text + contact nudge; right = Alpine.js accordion with 6 FAQ items. Accordion items have smooth open/close animation. First item open by default.

- [ ] **Step 1: Create faq partial**

```blade
{{-- resources/views/home/partials/faq.blade.php --}}
<section class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start">

            {{-- Left: intro --}}
            <div class="lg:sticky top-28 reveal">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-container/10 border border-primary-container/20 mb-4">
                    <span class="material-symbols-outlined text-primary-container text-[16px]">help</span>
                    <span class="text-sm font-semibold text-primary">FAQ</span>
                </div>
                <h2 class="text-headline-lg lg:text-display-lg font-black text-on-surface mb-4 leading-tight">
                    Câu Hỏi<br>
                    <span class="text-primary-container">Thường Gặp</span>
                </h2>
                <p class="text-body-md text-secondary leading-relaxed mb-8">
                    Chưa tìm được câu trả lời? Đội ngũ tư vấn của chúng tôi luôn sẵn sàng hỗ trợ bạn.
                </p>
                <a href="#contact"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-container text-white font-semibold rounded-xl shadow-lg shadow-primary-container/30 hover:bg-primary transition-all duration-200 hover:-translate-y-0.5 text-sm">
                    <span class="material-symbols-outlined text-[18px]">chat</span>
                    Liên hệ tư vấn
                </a>
            </div>

            {{-- Right: accordion --}}
            <div class="space-y-3 reveal reveal-delay-1"
                 x-data="{ open: 0 }">
                @foreach([
                    [
                        'q' => 'Tôi cần trình độ như thế nào để bắt đầu học?',
                        'a' => 'BEA English nhận học viên ở mọi trình độ — từ người mới bắt đầu hoàn toàn đến người muốn nâng cao. Chúng tôi sẽ kiểm tra trình độ miễn phí và xếp lớp phù hợp nhất cho bạn.',
                    ],
                    [
                        'q' => 'Buổi học thử có thực sự miễn phí không?',
                        'a' => 'Hoàn toàn miễn phí và không có bất kỳ điều kiện ràng buộc nào. Bạn sẽ học 1 buổi thực tế với giáo viên, được kiểm tra trình độ và nhận tư vấn lộ trình học.',
                    ],
                    [
                        'q' => 'Lịch học có linh hoạt không?',
                        'a' => 'Có. Bạn có thể chọn học sáng, chiều hoặc tối — kể cả cuối tuần. Chúng tôi sắp xếp lịch học theo lịch rảnh của bạn, không phải ngược lại.',
                    ],
                    [
                        'q' => 'Giáo viên của BEA English được đào tạo như thế nào?',
                        'a' => 'Tất cả giáo viên BEA đều có chứng chỉ quốc tế (CELTA, IELTS 8.0+) và tối thiểu 3 năm kinh nghiệm giảng dạy. Chúng tôi có cả giáo viên bản ngữ và Việt Nam, được đào tạo thêm về phương pháp BEA.',
                    ],
                    [
                        'q' => 'Cam kết hoàn tiền hoạt động như thế nào?',
                        'a' => 'Nếu sau 3 tháng học đầy đủ theo lộ trình mà không có cải thiện đo lường được, chúng tôi hoàn tiền 100% — không hỏi lý do. Điều khoản minh bạch, rõ ràng từ đầu.',
                    ],
                    [
                        'q' => 'Tôi có thể học online không?',
                        'a' => 'Có. BEA English hỗ trợ cả hình thức học trực tiếp tại trung tâm và học online qua Zoom/Meet. Chất lượng và phương pháp hoàn toàn như nhau.',
                    ],
                ] as $i => $faq)
                <div class="rounded-xl border border-outline-variant/40 overflow-hidden hover:border-primary-container/30 transition-colors">
                    <button @click="open = (open === {{ $i }} ? -1 : {{ $i }})"
                            class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left hover:bg-surface-container-low transition-colors"
                            :class="open === {{ $i }} ? 'bg-surface-container-low' : ''">
                        <span class="font-semibold text-on-surface text-sm leading-snug">{{ $faq['q'] }}</span>
                        <span class="material-symbols-outlined text-primary-container shrink-0 transition-transform duration-200"
                              :class="open === {{ $i }} ? 'rotate-180' : ''">
                            expand_more
                        </span>
                    </button>
                    <div x-show="open === {{ $i }}"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         class="px-6 pb-5">
                        <p class="text-sm text-secondary leading-relaxed border-t border-outline-variant/30 pt-4">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
```

---

## Task 12: Contact / CTA Section

**Files:**
- Create: `resources/views/home/partials/contact.blade.php`

**Design:** Dark `on-background` background. Two columns: left = headline + contact info (phone, address, hours); right = registration form with name, phone, course dropdown, note. Form submits as a `mailto:` or posts to a placeholder route (no backend required — just the UI). Floating decorative shapes match the hero section. Alpine.js handles form submission feedback.

- [ ] **Step 1: Create contact partial**

```blade
{{-- resources/views/home/partials/contact.blade.php --}}
<section id="contact" class="py-24 lg:py-32 bg-on-background relative overflow-hidden">

    {{-- Decorative shapes --}}
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-primary-container/8 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-primary-container/5 blur-2xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start">

            {{-- Left: info --}}
            <div class="reveal">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 mb-4">
                    <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">contact_support</span>
                    <span class="text-sm font-semibold text-white/80">Tư vấn miễn phí</span>
                </div>
                <h2 class="text-headline-lg lg:text-display-lg font-black text-white mb-4 leading-tight">
                    Đăng Ký<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-container to-primary-fixed-dim">
                        Học Thử Miễn Phí
                    </span>
                </h2>
                <p class="text-body-md text-white/60 leading-relaxed mb-10 max-w-sm">
                    Điền form bên cạnh — chuyên viên tư vấn sẽ liên hệ trong vòng 30 phút để sắp xếp buổi học thử và tư vấn lộ trình phù hợp nhất cho bạn.
                </p>

                <div class="space-y-5">
                    @foreach([
                        ['location_on', 'Địa chỉ', 'TP. Hồ Chí Minh, Việt Nam'],
                        ['phone', 'Hotline tư vấn', 'Liên hệ để nhận số điện thoại'],
                        ['schedule', 'Giờ làm việc', 'Thứ 2 – Chủ nhật: 7:00 – 21:00'],
                        ['mail', 'Email', 'info@beaenglish.vn'],
                    ] as [$icon, $label, $value])
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <div class="text-xs text-white/40 mb-0.5 uppercase tracking-wider">{{ $label }}</div>
                            <div class="text-sm text-white/80 font-medium">{{ $value }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: form --}}
            <div class="reveal reveal-delay-2"
                 x-data="{ submitted: false, loading: false }">

                <div x-show="!submitted"
                     class="glass rounded-2xl p-8">
                    <h3 class="font-bold text-white text-lg mb-6">Thông tin đăng ký</h3>

                    <form x-on:submit.prevent="
                            loading = true;
                            setTimeout(() => { submitted = true; loading = false; }, 800);
                          "
                          class="space-y-5">

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-white/60 uppercase tracking-wider mb-2">Họ và tên *</label>
                                <input type="text" required placeholder="Nguyễn Văn A"
                                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/30 text-sm focus:outline-none focus:border-primary-container focus:bg-white/15 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-white/60 uppercase tracking-wider mb-2">Số điện thoại *</label>
                                <input type="tel" required placeholder="0901 234 567"
                                       class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/30 text-sm focus:outline-none focus:border-primary-container focus:bg-white/15 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-white/60 uppercase tracking-wider mb-2">Khóa học quan tâm</label>
                            <select class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white text-sm focus:outline-none focus:border-primary-container focus:bg-white/15 transition-colors appearance-none"
                                    style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='rgba(255,255,255,0.4)'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.2em;">
                                <option value="" class="bg-on-background">-- Chọn khóa học --</option>
                                <option value="giao-tiep" class="bg-on-background">Tiếng Anh giao tiếp</option>
                                <option value="thuong-mai" class="bg-on-background">Tiếng Anh thương mại</option>
                                <option value="thieu-nhi" class="bg-on-background">Tiếng Anh thiếu nhi</option>
                                <option value="ielts" class="bg-on-background">Luyện thi IELTS</option>
                                <option value="nguoi-di-lam" class="bg-on-background">Tiếng Anh cho người đi làm</option>
                                <option value="hoc-thuat" class="bg-on-background">Tiếng Anh học thuật</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-white/60 uppercase tracking-wider mb-2">Ghi chú thêm</label>
                            <textarea rows="3" placeholder="Mục tiêu, thời gian rảnh, yêu cầu đặc biệt..."
                                      class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/30 text-sm focus:outline-none focus:border-primary-container focus:bg-white/15 transition-colors resize-none"></textarea>
                        </div>

                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-primary-container text-white font-bold rounded-xl shadow-xl shadow-primary-container/30 hover:bg-primary transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-60"
                                :disabled="loading">
                            <span x-show="!loading" class="material-symbols-outlined text-[20px]">send</span>
                            <svg x-show="loading" class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"/>
                                <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            <span x-text="loading ? 'Đang gửi...' : 'Đăng ký tư vấn miễn phí'"></span>
                        </button>

                        <p class="text-center text-xs text-white/30">
                            Thông tin của bạn được bảo mật tuyệt đối.
                        </p>
                    </form>
                </div>

                <div x-show="submitted"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="glass rounded-2xl p-12 text-center">
                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-5">
                        <span class="material-symbols-outlined ms-filled text-green-400 text-[32px]">check_circle</span>
                    </div>
                    <h3 class="font-bold text-white text-xl mb-2">Đăng ký thành công!</h3>
                    <p class="text-white/60 text-sm leading-relaxed max-w-xs mx-auto">
                        Chuyên viên tư vấn sẽ liên hệ bạn trong vòng 30 phút. Hẹn gặp bạn tại BEA English!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
```

---

## Task 13: Final Wiring & Smoke Test

**Files:** No new files.

- [ ] **Step 1: Verify all partials exist**

```bash
ls resources/views/home/partials/
```
Expected: `hero.blade.php  stats-strip.blade.php  free-trial.blade.php  courses.blade.php  ielts.blade.php  commitment.blade.php  faq.blade.php  contact.blade.php`

- [ ] **Step 2: Start the dev server**

```bash
php artisan serve
```

- [ ] **Step 3: Visit homepage in browser**

Open `http://localhost:8000` — should render the full homepage without errors.

- [ ] **Step 4: Check for Blade errors in logs**

```bash
tail -20 storage/logs/laravel.log
```
Expected: no errors.

- [ ] **Step 5: Test responsive layout**

Open browser DevTools → toggle mobile viewport (375px) → verify:
- Nav collapses to hamburger
- Hero stacks to single column
- Course grid shows 1 column
- IELTS cards stack vertically
- Form is full width

- [ ] **Step 6: Test all anchor links**

Click: "Về chúng tôi", "Khóa học", "Luyện thi IELTS", "Cam kết", "Liên hệ" — each should smooth-scroll to the correct section.

- [ ] **Step 7: Test Alpine.js interactions**

- Mobile menu opens/closes correctly
- FAQ accordion opens/closes individual items
- Contact form shows spinner → success state
- Nav background changes on scroll (transparent → white/glass)

- [ ] **Step 8: Verify login route still works**

Visit `http://localhost:8000/login` — should still show the login page normally.

- [ ] **Step 9: Verify dashboard redirect still works for authenticated users**

Log in → should land on `/dashboard` as before.

---

## Summary: File Map

```
routes/web.php                                  ← MODIFIED: new HomeController route
app/Http/Controllers/HomeController.php         ← CREATED
resources/views/layouts/home.blade.php          ← CREATED (nav + footer + CDN)
resources/views/home/index.blade.php            ← CREATED (assembler)
resources/views/home/partials/
    hero.blade.php                              ← CREATED
    stats-strip.blade.php                       ← CREATED
    free-trial.blade.php                        ← CREATED
    courses.blade.php                           ← CREATED
    ielts.blade.php                             ← CREATED
    commitment.blade.php                        ← CREATED
    faq.blade.php                               ← CREATED
    contact.blade.php                           ← CREATED
```

**Total: 12 files (1 modified, 11 created)**
