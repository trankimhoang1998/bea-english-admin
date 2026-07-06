{{-- resources/views/layouts/home.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <title>{{ $title ?? 'BEA English – Nền Tảng Vững Vàng, Tương Lai Rộng Mở' }}</title>
    <meta name="description" content="{{ $description ?? 'BEA English cung cấp các khóa học tiếng Anh chất lượng cao, luyện thi IELTS và chương trình học thử miễn phí.' }}">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Open Graph -->
    <meta property="og:type"        content="{{ $ogType ?? 'website' }}">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:title"       content="{{ $title ?? 'BEA English – Nền Tảng Vững Vàng, Tương Lai Rộng Mở' }}">
    <meta property="og:description" content="{{ $description ?? 'BEA English cung cấp các khóa học tiếng Anh chất lượng cao, luyện thi IELTS và chương trình học thử miễn phí.' }}">
    <meta property="og:image"       content="{{ $ogImage ?? asset('images/logo.png') }}">
    <meta property="og:locale"      content="vi_VN">
    <meta property="og:site_name"   content="BEA English">
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $title ?? 'BEA English – Nền Tảng Vững Vàng, Tương Lai Rộng Mở' }}">
    <meta name="twitter:description" content="{{ $description ?? 'BEA English cung cấp các khóa học tiếng Anh chất lượng cao, luyện thi IELTS và chương trình học thử miễn phí.' }}">
    <meta name="twitter:image"       content="{{ $ogImage ?? asset('images/logo.png') }}">
    @isset($ogPublishedTime)
    <meta property="article:published_time" content="{{ $ogPublishedTime }}">
    @endisset
    @isset($ogModifiedTime)
    <meta property="article:modified_time"  content="{{ $ogModifiedTime }}">
    @endisset
    @isset($ogAuthor)
    <meta property="article:author"  content="{{ $ogAuthor }}">
    @endisset
    @isset($ogSection)
    <meta property="article:section" content="{{ $ogSection }}">
    @endisset

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
                        "surface-alt":              "#f0f0f0",
                        "outline":                  "#8c7164",
                        "outline-variant":          "#e0c0b1",
                        "inverse-primary":          "#ffb690",
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

        .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .prog-bar { background: linear-gradient(90deg, #ea580c, #f97316, #fb923c); }

        @keyframes floatPulse {
            0%   { transform: scale(1);   opacity: 0.35; }
            100% { transform: scale(1.8); opacity: 0; }
        }
        .float-btn { position: relative; }
        .float-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: inherit;
            animation: floatPulse 2s ease-out infinite;
        }

        @keyframes float-cta {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-7px); }
        }
        .animate-float-cta {
            animation: float-cta 2s ease-in-out infinite;
        }
        @keyframes zoom-pulse {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.07); }
        }
        .animate-zoom-pulse {
            animation: zoom-pulse 2s ease-in-out infinite;
        }
        @keyframes statRing {
            0%   { transform: scale(1);   opacity: 0.7; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        /* ── Shared section animations ── */
        @keyframes rotateSlow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        @keyframes rotateCCW {
            from { transform: rotate(0deg); }
            to   { transform: rotate(-360deg); }
        }
        @keyframes centerGlow {
            0%, 100% { box-shadow: 0 0 24px 4px rgba(249,115,22,.35); }
            50%       { box-shadow: 0 0 42px 10px rgba(249,115,22,.55); }
        }
        @keyframes chipFloat {
            0%, 100% { transform: translate(-50%,-50%) translateY(0);    }
            50%       { transform: translate(-50%,-50%) translateY(-6px); }
        }
        @keyframes hsLevelFloat {
            0%, 100% { transform: translateY(0);    }
            50%       { transform: translateY(-5px); }
        }
        @keyframes ppFloat {
            0%, 100% { transform: translateY(0);     }
            50%       { transform: translateY(-10px); }
        }

        /* ── Shared card styles ── */
        .mt-card {
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }
        .mt-card:hover {
            transform: translateY(-5px);
            border-color: rgba(249,115,22,.3);
            box-shadow: 0 16px 40px rgba(249,115,22,.12);
        }
        .lt-card {
            transition: border-color .25s, box-shadow .25s, transform .25s;
        }
        .lt-card:hover {
            border-color: rgba(249,115,22,.4);
            box-shadow: 0 12px 32px rgba(249,115,22,.14);
        }
        .lt-ielts-card {
            transition: border-color .25s, box-shadow .25s, transform .25s;
        }
        .lt-ielts-card:hover {
            border-color: rgba(249,115,22,.5);
            box-shadow: 0 12px 32px rgba(249,115,22,.15);
        }
        .cs-card {
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }
        .cs-card:hover {
            transform: translateY(-5px);
            border-color: rgba(249,115,22,.3);
            box-shadow: 0 16px 40px rgba(249,115,22,.12);
        }
        .pp-icon { animation: ppFloat 3s ease-in-out infinite; }
    </style>

    <!-- Alpine.js plugins (must load before core) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-on-background antialiased overflow-x-hidden">

<x-home.header :active-page="$activePage ?? 'home'" />

{{-- ===== PAGE CONTENT ===== --}}
<main class="pt-20 lg:pt-[84px]">
    @yield('content')
</main>

<x-home.footer />

<!-- Schema.org: EducationalOrganization -->
@php
echo '<script type="application/ld+json">' . json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'EducationalOrganization',
    'name'        => 'BEA English',
    'url'         => 'https://www.beaenglish.vn',
    'logo'        => asset('images/logo.png'),
    'telephone'   => '+84972291474',
    'email'       => 'info@beaenglish.vn',
    'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => 'Tòa S402 Vinhomes Smart City',
        'addressLocality' => 'Tây Mỗ, Hà Nội',
        'addressCountry'  => 'VN',
    ],
    'sameAs'      => [
        'https://www.facebook.com/beaenglish.vn',
        'https://www.tiktok.com/@beaenglish.vn',
        'https://www.instagram.com/beaenglish.vn',
        'https://www.youtube.com/@beaenglish',
    ],
    'description' => 'Trung tâm tiếng Anh chất lượng cao, luyện thi IELTS, cam kết đầu ra với phương pháp 6P-BeA.',
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
@endphp

{{-- Floating contact buttons --}}
<div class="fixed bottom-6 right-4 z-50 flex flex-col items-center gap-3">

    {{-- Messenger --}}
    <a href="https://m.me/100071128583851" target="_blank" rel="noopener noreferrer"
       aria-label="Nhắn tin Messenger"
       class="float-btn rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200"
       style="width:58px;height:58px;background:#0099ff;">
        <svg fill="white" viewBox="0 0 24 24" width="28" height="28">
            <path d="M12,2C6.36,2 2,6.13 2,11.7C2,14.61 3.19,17.14 5.14,18.87C5.3,19 5.4,19.22 5.41,19.44L5.46,21.22C5.5,21.79 6.07,22.16 6.59,21.93L8.57,21.06C8.74,21 8.93,20.97 9.1,21C10,21.27 11,21.4 12,21.4C17.64,21.4 22,17.27 22,11.7C22,6.13 17.64,2 12,2M18,9.46L15.07,14.13C14.6,14.86 13.6,15.05 12.9,14.5L10.56,12.77C10.35,12.61 10.05,12.61 9.84,12.77L6.68,15.17C6.26,15.5 5.71,15 6,14.54L8.93,9.87C9.4,9.14 10.4,8.95 11.1,9.47L13.44,11.23C13.66,11.39 13.95,11.39 14.16,11.23L17.32,8.83C17.74,8.5 18.29,9 18,9.46Z"/>
        </svg>
    </a>

    {{-- Zalo --}}
    <a href="https://zalo.me/0972291474" target="_blank" rel="noopener noreferrer"
       aria-label="Nhắn tin Zalo"
       class="float-btn rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200"
       style="width:58px;height:58px;background:#0068ff;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 614.501 613.667" width="36" height="36">
            <path fill="#FFFFFF" d="M464.721,301.399c-13.984-0.014-23.707,11.478-23.944,28.312c-0.251,17.771,9.168,29.208,24.037,29.202c14.287-0.007,23.799-11.095,24.01-27.995C489.028,313.536,479.127,301.399,464.721,301.399z"/>
            <path fill="#FFFFFF" d="M291.83,301.392c-14.473-0.316-24.578,11.603-24.604,29.024c-0.02,16.959,9.294,28.259,23.496,28.502c15.072,0.251,24.592-10.87,24.539-28.707C315.214,313.318,305.769,301.696,291.83,301.392z"/>
            <path fill="#FFFFFF" d="M310.518,3.158C143.102,3.158,7.375,138.884,7.375,306.3s135.727,303.142,303.143,303.142c167.415,0,303.143-135.727,303.143-303.142S477.933,3.158,310.518,3.158z M217.858,391.083c-33.364,0.818-66.828,1.353-100.133-0.343c-21.326-1.095-27.652-18.647-14.248-36.583c21.55-28.826,43.886-57.065,65.792-85.621c2.546-3.305,6.214-5.996,7.15-12.705c-16.609,0-32.784,0.04-48.958-0.013c-19.195-0.066-28.278-5.805-28.14-17.652c0.132-11.768,9.175-17.329,28.397-17.348c25.159-0.026,50.324-0.06,75.476,0.026c9.637,0.033,19.604,0.105,25.304,9.789c6.22,10.561,0.284,19.512-5.646,27.454c-21.26,28.497-43.015,56.624-64.559,84.902c-2.599,3.41-5.119,6.88-9.453,12.725c23.424,0,44.123-0.053,64.816,0.026c8.674,0.026,16.662,1.873,19.941,11.267C237.892,379.329,231.368,390.752,217.858,391.083z M350.854,330.211c0,13.417-0.093,26.841,0.039,40.265c0.073,7.599-2.599,13.647-9.512,17.084c-7.296,3.642-14.71,3.028-20.304-2.968c-3.997-4.281-6.214-3.213-10.488-0.422c-17.955,11.728-39.908,9.96-56.597-3.866c-29.928-24.789-30.026-74.803-0.211-99.776c16.194-13.562,39.592-15.462,56.709-4.143c3.951,2.619,6.201,4.815,10.396-0.053c5.39-6.267,13.055-6.761,20.271-3.357c7.454,3.509,9.935,10.165,9.776,18.265C350.67,304.222,350.86,317.217,350.854,330.211z M395.617,369.579c-0.118,12.837-6.398,19.783-17.196,19.908c-10.779,0.132-17.593-6.966-17.646-19.512c-0.179-43.352-0.185-86.696,0.007-130.041c0.059-12.256,7.302-19.921,17.896-19.222c11.425,0.752,16.992,7.448,16.992,18.833c0,22.104,0,44.216,0,66.327C395.677,327.105,395.828,348.345,395.617,369.579z M463.981,391.868c-34.399-0.336-59.037-26.444-58.786-62.289c0.251-35.66,25.304-60.713,60.383-60.396c34.631,0.304,59.374,26.306,58.998,61.986C524.207,366.492,498.534,392.205,463.981,391.868z"/>
        </svg>
    </a>

    {{-- Phone --}}
    <a href="tel:0972291474"
       aria-label="Gọi điện tư vấn"
       class="float-btn rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200"
       style="width:58px;height:58px;background:#34a853;">
        <svg fill="white" viewBox="0 0 24 24" width="26" height="26">
            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
        </svg>
    </a>

</div>

{{-- Scroll reveal --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(el => {
                if (el.isIntersecting) {
                    el.target.classList.add('revealed');
                    observer.unobserve(el.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });
</script>

</body>
</html>
