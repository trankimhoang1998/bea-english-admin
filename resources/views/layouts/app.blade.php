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
        .nav-active {
            background-color: #d0e1fb;
            color: #54647a;
            border-left: 4px solid #9d4300;
            padding-left: calc(1.5rem - 4px);
        }
        [x-cloak] { display: none !important; }
        @keyframes toast-shrink {
            from { width: 100%; }
            to   { width: 0%; }
        }
        .toast-progress {
            animation: toast-shrink linear forwards;
        }
    </style>

    <!-- Pass Laravel flash messages to JS -->
    <script>
        window.__flash = {
            success: @json(session('success')),
            error:   @json(session('error')),
            warning: @json(session('warning')),
            info:    @json(session('info')),
        };
    </script>

    <!-- Alpine.js stores (must run before Alpine boots) -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('confirmModal', {
                open:         false,
                title:        'Confirm',
                message:      '',
                targetFormId: null,

                show(message, formId, title = 'Confirm Delete') {
                    this.title        = title;
                    this.message      = message;
                    this.targetFormId = formId;
                    this.open         = true;
                },
                confirm() {
                    if (this.targetFormId) {
                        document.getElementById(this.targetFormId).submit();
                    }
                    this.open = false;
                },
                cancel() {
                    this.open = false;
                }
            });

            Alpine.store('toast', {
                items: [],
                _id: 0,

                show(message, type = 'success', duration = 4500) {
                    const id = ++this._id;
                    this.items.push({ id, message, type, duration, visible: true });
                    setTimeout(() => this.dismiss(id), duration);
                },

                dismiss(id) {
                    const item = this.items.find(i => i.id === id);
                    if (item) item.visible = false;
                    setTimeout(() => {
                        this.items = this.items.filter(i => i.id !== id);
                    }, 300);
                }
            });
        });

        // Show page-load flash messages as toasts once Alpine is ready
        document.addEventListener('alpine:initialized', () => {
            const f = window.__flash || {};
            const store = Alpine.store('toast');
            if (f.success) store.show(f.success, 'success');
            if (f.error)   store.show(f.error,   'error');
            if (f.warning) store.show(f.warning, 'warning');
            if (f.info)    store.show(f.info,    'info');
        });
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background text-on-surface antialiased">
<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    {{-- ── Mobile top bar (hidden on md+) ── --}}
    <header class="md:hidden fixed top-0 left-0 right-0 z-50 h-14 bg-surface-container-lowest border-b border-outline-variant flex items-center gap-md px-md">
        <button @click="sidebarOpen = true"
                class="p-sm rounded-lg hover:bg-surface-container-low transition-colors text-secondary">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <span class="font-black text-headline-sm text-primary leading-none">BEA English</span>
        <div class="ml-auto text-label-sm text-secondary capitalize">{{ Auth::user()->role }}</div>
    </header>

    {{-- ── Sidebar backdrop (mobile) ── --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="md:hidden fixed inset-0 bg-on-surface/40 z-40 backdrop-blur-sm"
         style="display:none;">
    </div>

    {{-- ── Sidebar ── --}}
    @include('layouts.navigation')

    {{-- ── Main content ── --}}
    <main class="flex-1 md:ml-[280px] min-h-screen bg-background pt-14 md:pt-0">
        @isset($header)
            <div class="bg-surface-container-lowest border-b border-outline-variant px-md md:px-lg py-md sticky top-14 md:top-0 z-10">
                {{ $header }}
            </div>
        @endisset

        <div class="p-md md:p-lg xl:p-2xl">
            {{ $slot }}
        </div>
    </main>

    {{-- ── Confirm-delete modal (global, triggered via Alpine.store) ── --}}
    <div x-data
         x-show="$store.confirmModal.open"
         x-cloak
         @keydown.escape.window="$store.confirmModal.cancel()"
         class="fixed inset-0 z-[200] flex items-end sm:items-center justify-center p-md">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-sm"
             @click="$store.confirmModal.cancel()"
             x-transition:enter="transition-opacity ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        {{-- Modal card --}}
        <div class="relative bg-surface-container-lowest rounded-xl shadow-2xl border border-outline-variant w-full max-w-sm p-lg"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            {{-- Icon + title --}}
            <div class="flex items-center gap-md mb-md">
                <div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-error text-[22px]">delete_forever</span>
                </div>
                <h3 class="font-semibold text-headline-sm text-on-surface" x-text="$store.confirmModal.title"></h3>
            </div>

            <p class="text-body-sm text-secondary mb-lg" x-text="$store.confirmModal.message"></p>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-md">
                <button @click="$store.confirmModal.cancel()"
                        type="button"
                        class="px-lg py-sm border border-outline-variant text-secondary text-label-md rounded-lg hover:bg-surface-container-low transition-all active:scale-95">
                    Cancel
                </button>
                <button @click="$store.confirmModal.confirm()"
                        type="button"
                        class="inline-flex items-center gap-xs px-lg py-sm bg-error text-white text-label-md font-semibold rounded-lg hover:brightness-110 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Delete
                </button>
            </div>
        </div>
    </div>

    {{-- ── Toast notification container (global) ── --}}
    <div x-data
         class="fixed bottom-lg right-md sm:right-lg z-[400] flex flex-col-reverse gap-sm pointer-events-none"
         style="width: min(calc(100vw - 2rem), 380px)">
        <template x-for="item in $store.toast.items" :key="item.id">
            <div x-show="item.visible"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-8"
                 class="pointer-events-auto relative bg-surface-container-lowest rounded-xl shadow-lg border overflow-hidden"
                 :class="{
                     'border-green-200': item.type === 'success',
                     'border-error/30':  item.type === 'error',
                     'border-amber-300': item.type === 'warning',
                     'border-outline-variant': item.type === 'info',
                 }">

                {{-- Left accent bar --}}
                <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-xl"
                     :class="{
                         'bg-green-500': item.type === 'success',
                         'bg-error':     item.type === 'error',
                         'bg-amber-500': item.type === 'warning',
                         'bg-tertiary':  item.type === 'info',
                     }">
                </div>

                {{-- Content --}}
                <div class="flex items-start gap-sm py-md pr-md" style="padding-left: calc(1rem + 4px)">
                    <span class="material-symbols-outlined text-[20px] shrink-0"
                          :class="{
                              'text-green-600': item.type === 'success',
                              'text-error':     item.type === 'error',
                              'text-amber-500': item.type === 'warning',
                              'text-tertiary':  item.type === 'info',
                          }"
                          x-text="{ success: 'check_circle', error: 'error', warning: 'warning', info: 'info' }[item.type]">
                    </span>
                    <p class="flex-1 text-body-sm text-on-surface leading-snug" x-text="item.message"></p>
                    <button @click="$store.toast.dismiss(item.id)"
                            class="shrink-0 ml-sm text-secondary hover:text-on-surface transition-colors rounded-lg hover:bg-surface-container-low p-xs -mt-xs -mr-xs">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </button>
                </div>

                {{-- Progress bar --}}
                <div class="h-[3px] toast-progress"
                     :style="`animation-duration:${item.duration}ms`"
                     :class="{
                         'bg-green-500': item.type === 'success',
                         'bg-error':     item.type === 'error',
                         'bg-amber-400': item.type === 'warning',
                         'bg-tertiary':  item.type === 'info',
                     }">
                </div>
            </div>
        </template>
    </div>

</div>
</body>
</html>
