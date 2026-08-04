@extends('layouts.home', [
    'activePage'  => 'ielts',
    'title'       => 'Luyện Thi IELTS – Cam Kết Đầu Ra 3.5 đến 6.5+ | BEA English',
    'description' => '5 lộ trình IELTS từ mất gốc đến 6.5+. Cam kết chất lượng đầu ra bằng văn bản. Luyện đề thi thật, giáo viên Philippines chuẩn quốc tế.',
])
@section('content')
    @include('home.sections.luyen-thi-ielts.intro')
    @include('home.sections.luyen-thi-ielts.thong-tin')
    @include('home.sections.luyen-thi-ielts.muc-tieu')
    @include('home.sections.luyen-thi-ielts.lo-trinh')
    @include('home.sections.shared.chinh-sach')
    @include('home.sections.shared.contact')
@endsection
