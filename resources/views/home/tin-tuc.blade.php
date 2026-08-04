@extends('layouts.home', [
    'activePage'  => 'tin-tuc',
    'title'       => 'Tin Tức & Góc Học Tiếng Anh | BEA English',
    'description' => 'Cập nhật kiến thức, mẹo học tiếng Anh và tin tức mới nhất từ BEA English.',
])
@section('content')
    @php
    echo '<script type="application/ld+json">' . json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Trang chủ', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tin tức', 'item' => route('home.tin-tuc')],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    @endphp
    @include('home.sections.tin-tuc.hero')
    @include('home.sections.tin-tuc.articles-grid', ['articles' => $articles, 'categories' => $categories])
    @include('home.sections.shared.contact')
@endsection
