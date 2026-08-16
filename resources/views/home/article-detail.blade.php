@php
    $ogImage = $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/og-image.png');
@endphp

@extends('layouts.home', [
    'activePage'      => 'tin-tuc',
    'title'           => $article->title . ' | BEA English',
    'description'     => $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 160),
    'ogType'          => 'article',
    'ogImage'         => $ogImage,
    'ogPublishedTime' => $article->published_at?->toIso8601String(),
    'ogModifiedTime'  => $article->updated_at->toIso8601String(),
    'ogAuthor'        => $article->author?->name ?? 'BEA English',
    'ogSection'       => $article->category?->name,
])

@section('content')

{{-- Reading progress bar --}}
<div id="reading-progress"
     class="fixed top-0 left-0 z-[60] h-[3px] w-0 transition-none"
     style="background: linear-gradient(90deg, #ea580c, #f97316, #fb923c);"></div>

{{-- Breadcrumb --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-5 lg:px-8 py-3">
        <nav class="flex items-center gap-1.5 text-[12px] text-gray-400 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-primary-container transition-colors">Trang chủ</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('home.tin-tuc') }}" class="hover:text-primary-container transition-colors">Tin Tức</a>
            @if($article->category)
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('home.tin-tuc', ['category_id' => $article->category->id]) }}"
               class="hover:text-primary-container transition-colors">{{ $article->category->name }}</a>
            @endif
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-gray-500 line-clamp-1 max-w-[200px]">{{ $article->title }}</span>
        </nav>
    </div>
</div>

<div class="bg-white min-h-screen">
    <div class="max-w-5xl mx-auto px-5 lg:px-8 py-6 lg:py-14">

        <div class="lg:grid lg:grid-cols-[1fr_240px] lg:gap-12">

            {{-- ══════════════ MAIN CONTENT ══════════════ --}}
            <article>

                {{-- Article header --}}
                <header class="mb-5 lg:mb-8">
                    @if($article->category)
                    <a href="{{ route('home.tin-tuc', ['category_id' => $article->category->id]) }}"
                       class="inline-block bg-orange-50 text-primary-container text-[12px] font-bold px-3 py-1 rounded-full mb-3 lg:mb-4 hover:bg-orange-100 transition-colors">
                        {{ $article->category->name }}
                    </a>
                    @endif

                    <h1 class="font-black text-on-background leading-tight mb-3 lg:mb-5"
                        style="font-size: clamp(1.35rem, 4vw, 2.4rem);">
                        {{ $article->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-2.5 lg:gap-4 text-[12px] lg:text-[13px] text-gray-400 pb-4 lg:pb-5 border-b border-gray-100">
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary-container">person</span>
                            {{ $article->author?->name ?? 'BEA English' }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary-container">calendar_today</span>
                            {{ $article->published_at?->translatedFormat('d/m/Y') }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary-container">schedule</span>
                            {{ $readingTime }} phút đọc
                        </span>
                    </div>
                </header>

                {{-- Thumbnail --}}
                @if($article->thumbnail)
                <div class="mb-5 lg:mb-8 rounded-2xl overflow-hidden">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}"
                         alt="{{ $article->title }}"
                         class="w-full max-h-[480px] object-cover">
                </div>
                @endif

                {{-- Excerpt --}}
                @if($article->excerpt)
                <div class="mb-5 lg:mb-8 px-4 py-3 lg:px-5 lg:py-4 bg-orange-50 border-l-4 border-primary-container rounded-r-xl">
                    <p class="text-[14px] lg:text-[15px] text-gray-700 leading-relaxed italic">{{ $article->excerpt }}</p>
                </div>
                @endif


                {{-- Article content --}}
                <div id="article-content"
                     class="prose prose-base max-w-none text-gray-800
                            prose-headings:font-black prose-headings:text-on-background
                            prose-h2:text-[1.35rem] prose-h2:mt-10 prose-h2:mb-4
                            prose-h3:text-[1.1rem] prose-h3:mt-7 prose-h3:mb-3
                            prose-p:leading-[1.85] prose-p:mb-5
                            prose-a:text-primary-container prose-a:no-underline hover:prose-a:underline
                            prose-strong:text-on-background
                            prose-blockquote:border-primary-container prose-blockquote:bg-orange-50 prose-blockquote:rounded-r-xl prose-blockquote:py-1
                            prose-img:rounded-xl prose-img:max-w-full
                            prose-ul:space-y-1 prose-ol:space-y-1
                            prose-li:leading-relaxed
                            prose-code:bg-gray-100 prose-code:rounded prose-code:px-1
                            prose-pre:bg-gray-900 prose-pre:rounded-xl
                            [&_table]:w-full [&_table]:block [&_table]:overflow-x-auto
                            [&_figure.table]:w-full [&_figure.table]:overflow-x-auto
                            [&_img]:mx-auto break-words">
                    {!! $article->content !!}
                </div>

                {{-- Tags --}}
                @if($article->tags->count() > 0)
                <div class="mt-6 pt-4 lg:mt-10 lg:pt-6 border-t border-gray-100">
                    <span class="text-[12px] font-bold text-gray-400 uppercase tracking-widest mr-3">Tags</span>
                    @foreach($article->tags as $tag)
                    <span class="inline-block bg-orange-50 text-primary-container text-[12px] font-semibold px-3 py-1 rounded-full mr-1.5 mb-1.5">
                        #{{ $tag->name }}
                    </span>
                    @endforeach
                </div>
                @endif

                {{-- Share bar — bottom --}}
                <div class="mt-5 pt-4 lg:mt-8 lg:pt-6 border-t border-gray-100 flex flex-wrap items-center gap-3 lg:gap-4">
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Chia sẻ</span>
                    <div class="flex items-center gap-2">
                        @include('home.sections.tin-tuc._share-buttons')
                    </div>
                    <a href="{{ route('home.tin-tuc') }}"
                       class="ml-auto flex items-center gap-1.5 text-[13px] text-gray-400 hover:text-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Về danh sách
                    </a>
                </div>

            </article>

            {{-- ══════════════ STICKY SIDEBAR ══════════════ --}}
            <aside class="hidden lg:block">
                <div class="sticky top-24 space-y-6">

                    {{-- Table of Contents --}}
                    <div id="toc-card" class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hidden">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4">Mục lục</p>
                        <nav id="toc-nav" class="space-y-1 text-[13px]"></nav>
                    </div>

                    {{-- Back to top --}}
                    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"
                            class="hidden w-full items-center justify-center gap-2 px-4 py-2.5 bg-gray-50 text-gray-600 text-[13px] font-semibold rounded-xl hover:bg-gray-100 transition-colors border border-gray-200">
                        <span class="material-symbols-outlined text-[16px]">arrow_upward</span>
                        Lên đầu trang
                    </button>

                </div>
            </aside>

        </div>

        {{-- ══════════════ RELATED ARTICLES ══════════════ --}}
        @if($related->count() > 0)
        <section class="mt-8 pt-5 lg:mt-16 lg:pt-10 border-t border-gray-100">
            <h2 class="font-black text-on-background text-[1.2rem] lg:text-[1.4rem] mb-4 lg:mb-7">Bài viết liên quan</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-6">
                @foreach($related as $rel)
                <a href="{{ route('home.article-detail', $rel->slug) }}"
                   class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 flex flex-col">
                    <div class="relative aspect-[16/9] bg-gradient-to-br from-orange-50 to-orange-100 overflow-hidden">
                        @if($rel->thumbnail)
                        <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                             alt="{{ $rel->title }}"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined ms-filled text-primary-container/30 text-[48px]">article</span>
                        </div>
                        @endif
                        @if($rel->category)
                        <span class="absolute top-2 left-2 bg-primary-container text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                            {{ $rel->category->name }}
                        </span>
                        @endif
                    </div>
                    <div class="p-3 lg:p-4 flex flex-col flex-1">
                        <h3 class="font-bold text-on-background text-[14px] leading-snug mb-2 line-clamp-2 group-hover:text-primary-container transition-colors">
                            {{ $rel->title }}
                        </h3>
                        <p class="text-gray-400 text-[12px] mt-auto pt-2">
                            {{ $rel->published_at?->format('d/m/Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

    </div>
</div>

@include('home.sections.shared.contact')

{{-- Toast notification --}}
<div id="toast"
     class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[70] bg-gray-900 text-white text-[13px] font-semibold px-5 py-3 rounded-full shadow-xl
            transition-all duration-300 opacity-0 translate-y-2 pointer-events-none flex items-center gap-2">
    <span class="material-symbols-outlined text-[16px] text-green-400">check_circle</span>
    Đã sao chép liên kết!
</div>

{{-- Schema.org Article --}}
@php
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'Article',
    'headline'        => $article->title,
    'description'     => $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 160),
    'image'           => $ogImage,
    'datePublished'   => $article->published_at?->toIso8601String(),
    'dateModified'    => $article->updated_at->toIso8601String(),
    'author'          => ['@type' => 'Person', 'name' => $article->author?->name ?? 'BEA English'],
    'publisher'       => [
        '@type' => 'Organization',
        'name'  => 'BEA English',
        'logo'  => ['@type' => 'ImageObject', 'url' => asset('images/logo.png')],
    ],
    'mainEntityOfPage'=> ['@type' => 'WebPage', '@id' => url()->current()],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';

// BreadcrumbList
$breadcrumbs = [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Trang chủ', 'item' => route('home')],
    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tin Tức',   'item' => route('home.tin-tuc')],
];
if ($article->category) {
    $breadcrumbs[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $article->category->name, 'item' => route('home.tin-tuc', ['category_id' => $article->category->id])];
    $breadcrumbs[] = ['@type' => 'ListItem', 'position' => 4, 'name' => $article->title, 'item' => url()->current()];
} else {
    $breadcrumbs[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $article->title, 'item' => url()->current()];
}
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => $breadcrumbs,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
@endphp

<script>
    // ── Reading progress bar ──
    const progressBar = document.getElementById('reading-progress');
    window.addEventListener('scroll', () => {
        const scrollTop  = window.scrollY;
        const docHeight  = document.documentElement.scrollHeight - window.innerHeight;
        const pct        = docHeight > 0 ? Math.min(100, (scrollTop / docHeight) * 100) : 0;
        progressBar.style.width = pct + '%';

        // Back-to-top button
        const btn = document.getElementById('back-to-top');
        if (btn) {
            if (scrollTop > 400) { btn.classList.remove('hidden'); btn.classList.add('flex'); }
            else                 { btn.classList.add('hidden');    btn.classList.remove('flex'); }
        }
    }, { passive: true });

    // ── Share functions ──
    const _shareUrl   = encodeURIComponent(location.href);
    const _shareTitle = encodeURIComponent(document.title);

    function shareFacebook() {
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + _shareUrl, '_blank', 'width=600,height=400');
    }
    function shareX() {
        window.open('https://twitter.com/intent/tweet?url=' + _shareUrl + '&text=' + _shareTitle, '_blank', 'width=600,height=400');
    }
    function shareLinkedIn() {
        window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + _shareUrl + '&title=' + _shareTitle, '_blank', 'width=600,height=500');
    }
    function copyLink() {
        navigator.clipboard.writeText(location.href).then(() => {
            // Flash all copy buttons green
            document.querySelectorAll('.copy-btn-icon').forEach(el => {
                el.textContent = 'check';
                el.classList.add('text-green-500');
                setTimeout(() => { el.textContent = 'link'; el.classList.remove('text-green-500'); }, 2000);
            });
            showToast();
        });
    }

    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.remove('opacity-0', 'translate-y-2');
        toast.classList.add('opacity-100', 'translate-y-0');
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            toast.classList.remove('opacity-100', 'translate-y-0');
        }, 2200);
    }

    // ── Table of Contents ──
    document.addEventListener('DOMContentLoaded', () => {
        const content  = document.getElementById('article-content');
        const tocNav   = document.getElementById('toc-nav');
        const tocCard  = document.getElementById('toc-card');
        if (!content || !tocNav) return;

        const headings = content.querySelectorAll('h2, h3');
        if (headings.length < 2) return;

        tocCard.classList.remove('hidden');

        headings.forEach((h, i) => {
            if (!h.id) h.id = 'heading-' + i;
            const a = document.createElement('a');
            a.href        = '#' + h.id;
            a.textContent = h.textContent;
            a.dataset.id  = h.id;
            a.className   = h.tagName === 'H2'
                ? 'block text-gray-600 hover:text-primary-container transition-colors py-0.5 font-semibold toc-link'
                : 'block text-gray-400 hover:text-primary-container transition-colors py-0.5 pl-3 toc-link';
            a.addEventListener('click', e => {
                e.preventDefault();
                document.getElementById(h.id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
            tocNav.appendChild(a);
        });

        // Highlight active heading
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const link = tocNav.querySelector(`[data-id="${entry.target.id}"]`);
                if (!link) return;
                if (entry.isIntersecting) {
                    tocNav.querySelectorAll('.toc-link').forEach(l => l.classList.remove('text-primary-container', 'font-bold'));
                    link.classList.add('text-primary-container', 'font-bold');
                }
            });
        }, { rootMargin: '-20% 0px -70% 0px' });

        headings.forEach(h => observer.observe(h));
    });
</script>

@endsection
