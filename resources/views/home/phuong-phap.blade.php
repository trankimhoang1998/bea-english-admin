@extends('layouts.home', [
    'activePage'  => 'phuong-phap',
    'title'       => 'Phương Pháp 6P-BeA – Học Tiếng Anh Hiệu Quả | BEA English',
    'description' => 'Phương pháp giảng dạy 6P-BeA: Personalized – Practice – Partnership – Purposeful – Progress – Practical. Lộ trình cá nhân hóa theo từng học viên.',
])
@section('content')
    @php
    echo '<script type="application/ld+json">' . json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Trang chủ', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Phương pháp', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    @endphp
    @include('home.sections.phuong-phap.6p')
    @include('home.sections.shared.contact')
@endsection
