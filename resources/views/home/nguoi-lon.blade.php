@extends('layouts.home', [
    'activePage'  => 'nguoi-lon',
    'title'       => 'Tiếng Anh cho Người Lớn – Giao Tiếp & Công Việc | BEA English',
    'description' => 'Khóa học tiếng Anh cho người lớn 4 cấp độ từ cơ bản đến nâng cao. Phát triển toàn diện 4 kỹ năng, lịch học linh hoạt, hướng đến IELTS, TOEIC, VSTEP.',
])
@section('content')
    @php
    echo '<script type="application/ld+json">' . json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => 'Tiếng Anh cho Người Lớn',
        'description' => 'Khóa học tiếng Anh trực tuyến 1:1 cho người lớn, 4 cấp độ từ cơ bản đến nâng cao, hướng đến IELTS, TOEIC, VSTEP.',
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
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tiếng Anh cho Người Lớn', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    @endphp
    @include('home.sections.nguoi-lon.intro')
    @include('home.sections.nguoi-lon.muc-tieu')
    @include('home.sections.nguoi-lon.lo-trinh')
    @include('home.sections.shared.chinh-sach')
    @include('home.sections.shared.contact')
@endsection
