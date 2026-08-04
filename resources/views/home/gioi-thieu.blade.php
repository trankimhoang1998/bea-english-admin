@extends('layouts.home', [
    'activePage'  => 'gioi-thieu',
    'title'       => 'Giới Thiệu BEA English – Trung Tâm Tiếng Anh Chất Lượng Cao',
    'description' => 'BEA English – Hơn 10 năm đồng hành cùng học viên Việt Nam. Phương pháp 6P-BeA, giáo viên Philippines chuẩn quốc tế, cam kết đầu ra rõ ràng.',
])
@section('content')
    @php
    echo '<script type="application/ld+json">' . json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Trang chủ', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Giới thiệu', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    @endphp
    @include('home.sections.gioi-thieu.hero')
    @include('home.sections.gioi-thieu.tam-nhin-su-menh')
    @include('home.sections.gioi-thieu.gia-tri-cot-loi')
    @include('home.sections.gioi-thieu.phuong-cham')
    @include('home.sections.gioi-thieu.cam-ket')
    @include('home.sections.shared.contact')
@endsection
