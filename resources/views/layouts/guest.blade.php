<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BEA English') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                        "secondary":                "#505f76",
                        "on-secondary":             "#ffffff",
                        "secondary-container":      "#d0e1fb",
                        "on-secondary-container":   "#54647a",
                        "error":                    "#ba1a1a",
                        "background":               "#f9f9ff",
                        "on-background":            "#111c2d",
                        "surface":                  "#f9f9ff",
                        "on-surface":               "#111c2d",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low":    "#f0f3ff",
                        "surface-container":        "#e7eeff",
                        "outline":                  "#8c7164",
                        "outline-variant":          "#e0c0b1",
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    spacing: {
                        "xs":  "4px",
                        "sm":  "8px",
                        "md":  "16px",
                        "lg":  "24px",
                        "xl":  "40px",
                        "2xl": "64px",
                    },
                    fontSize: {
                        "display-lg":  ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em" }],
                        "headline-lg": ["32px", { lineHeight: "1.3", letterSpacing: "-0.01em" }],
                        "headline-md": ["24px", { lineHeight: "1.4" }],
                        "headline-sm": ["20px", { lineHeight: "1.4" }],
                        "body-md":     ["16px", { lineHeight: "1.6" }],
                        "body-sm":     ["14px", { lineHeight: "1.5" }],
                        "label-md":    ["14px", { lineHeight: "1", letterSpacing: "0.05em" }],
                        "label-sm":    ["12px", { lineHeight: "1" }],
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
        .academic-pattern {
            background-color: #f9f9ff;
            background-image: radial-gradient(#d0e1fb 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="text-on-background min-h-screen flex items-center justify-center p-md academic-pattern">
    <main class="w-full max-w-[1100px] grid lg:grid-cols-2 bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden min-h-[600px]">
        {{-- Left: Branding --}}
        <section class="hidden lg:flex flex-col justify-between p-2xl bg-surface-container-low relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-sm mb-xl">
                    <div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center text-white">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">school</span>
                    </div>
                    <span class="font-black text-headline-md text-primary">BEA English</span>
                </div>
                <h1 class="font-bold text-display-lg text-on-surface max-w-sm leading-tight">
                    Empowering English education.
                </h1>
                <p class="mt-md text-body-md text-secondary max-w-xs">
                    Manage teachers, students, schedules, and learning materials all in one place.
                </p>
            </div>

            {{-- Feature highlights --}}
            <div class="space-y-md relative z-10">
                <div class="flex items-center gap-md p-md bg-surface-container-lowest/70 rounded-xl border border-outline-variant/50">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[20px]">calendar_month</span>
                    </div>
                    <div>
                        <p class="font-semibold text-body-sm text-on-surface">Smart Scheduling</p>
                        <p class="text-label-sm text-secondary">Manage lessons across all teachers</p>
                    </div>
                </div>
                <div class="flex items-center gap-md p-md bg-surface-container-lowest/70 rounded-xl border border-outline-variant/50">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[20px]">history_edu</span>
                    </div>
                    <div>
                        <p class="font-semibold text-body-sm text-on-surface">Teaching Records</p>
                        <p class="text-label-sm text-secondary">Track every session with notes & videos</p>
                    </div>
                </div>
            </div>

            {{-- Decorative circle --}}
            <div class="absolute -bottom-16 -right-16 w-64 h-64 rounded-full bg-primary/5 border border-primary/10"></div>
            <div class="absolute -top-8 -left-8 w-40 h-40 rounded-full bg-primary-container/10 border border-primary-container/20"></div>
        </section>

        {{-- Right: Form --}}
        <section class="flex flex-col justify-center p-md lg:p-2xl">
            {{-- Mobile logo --}}
            <div class="lg:hidden flex items-center justify-center gap-sm mb-xl">
                <div class="w-9 h-9 bg-primary-container rounded-lg flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">school</span>
                </div>
                <span class="font-black text-headline-sm text-primary">BEA English</span>
            </div>

            <div class="w-full max-w-md mx-auto">
                {{ $slot }}
            </div>
        </section>
    </main>
</body>
</html>
