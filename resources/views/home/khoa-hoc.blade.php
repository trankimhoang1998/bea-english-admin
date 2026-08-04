@extends('layouts.home', [
    'activePage'  => 'hoc-sinh',
    'title'       => 'Tiếng Anh cho Học Sinh – Lớp 1 đến 12 | BEA English',
    'description' => 'Khóa học tiếng Anh cho học sinh từ lớp 1 đến 12, bám sát khung chuẩn Cambridge Young Learners và CEFR. Cam kết đầu ra, luyện thi chứng chỉ quốc tế.',
])
@section('content')
    @php
    echo '<script type="application/ld+json">' . json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => 'Tiếng Anh cho Học Sinh',
        'description' => 'Khóa học tiếng Anh trực tuyến 1:1 cho học sinh từ lớp 1 đến 12, bám sát khung chuẩn Cambridge Young Learners và CEFR.',
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
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tiếng Anh cho Học Sinh', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    @endphp
    @include('home.sections.hoc-sinh.intro')
    @include('home.sections.hoc-sinh.muc-tieu')
    @include('home.sections.hoc-sinh.lo-trinh')
    @include('home.sections.shared.chinh-sach')
    @include('home.sections.shared.contact')
@endsection
