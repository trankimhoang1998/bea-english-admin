@extends('layouts.home', [
    'activePage'  => 'tin-tuc',
    'title'       => 'Tin Tức & Góc Học Tiếng Anh | BEA English',
    'description' => 'Cập nhật kiến thức, mẹo học tiếng Anh và tin tức mới nhất từ BEA English.',
])
@section('content')
    @include('home.sections.tin-tuc.hero')
    @include('home.sections.tin-tuc.articles-grid', ['articles' => $articles, 'categories' => $categories])
@endsection
