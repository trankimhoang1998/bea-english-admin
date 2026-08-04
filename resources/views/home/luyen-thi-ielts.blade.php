@extends('layouts.home', [
    'activePage'  => 'ielts',
    'title'       => 'Luyện Thi IELTS – Cam Kết Đầu Ra 3.5 đến 6.5+ | BEA English',
    'description' => '5 lộ trình IELTS từ mất gốc đến 6.5+. Cam kết chất lượng đầu ra bằng văn bản. Luyện đề thi thật, giáo viên Philippines chuẩn quốc tế.',
])
@section('content')
    @php
    echo '<script type="application/ld+json">' . json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => 'Luyện Thi IELTS',
        'description' => '5 lộ trình luyện thi IELTS trực tuyến 1:1 từ mất gốc đến 6.5+, cam kết chất lượng đầu ra bằng văn bản.',
        'provider'    => [
            '@type' => 'Organization',
            'name'  => 'BEA English',
            'sameAs' => 'https://www.beaenglish.vn',
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';

    echo '<script type="application/ld+json">' . json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Trang chủ', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Luyện Thi IELTS', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    @endphp
    @include('home.sections.luyen-thi-ielts.intro')
    @include('home.sections.luyen-thi-ielts.thong-tin')
    @include('home.sections.luyen-thi-ielts.muc-tieu')
    @include('home.sections.luyen-thi-ielts.lo-trinh')
    @include('home.sections.shared.chinh-sach')
    @include('home.sections.shared.contact')
@endsection
