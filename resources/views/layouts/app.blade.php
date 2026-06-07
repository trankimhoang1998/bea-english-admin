<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'BEA English') }}</title>

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
                        "primary-fixed-dim":        "#ffb690",
                        "secondary":                "#505f76",
                        "on-secondary":             "#ffffff",
                        "secondary-container":      "#d0e1fb",
                        "on-secondary-container":   "#54647a",
                        "tertiary":                 "#006398",
                        "error":                    "#ba1a1a",
                        "on-error":                 "#ffffff",
                        "error-container":          "#ffdad6",
                        "on-error-container":       "#93000a",
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
                        "body-lg":     ["18px", { lineHeight: "1.6" }],
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
        /* Sidebar active link left border */
        .nav-active {
            background-color: #d0e1fb;
            color: #54647a;
            border-left: 4px solid #9d4300;
            padding-left: calc(1.5rem - 4px);
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background text-on-surface antialiased">
    <div class="flex min-h-screen">
        {{-- Fixed sidebar --}}
        @include('layouts.navigation')

        {{-- Main content area --}}
        <main class="flex-1 ml-[280px] min-h-screen bg-background">
            @isset($header)
                <div class="bg-surface-container-lowest border-b border-outline-variant px-lg py-md sticky top-0 z-10">
                    {{ $header }}
                </div>
            @endisset

            <div class="p-lg md:p-2xl">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
