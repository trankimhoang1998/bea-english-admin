@extends('layouts.home', [
    'activePage'  => 'hoc-sinh',
    'title'       => 'Tiếng Anh cho Học Sinh – Lớp 1 đến 12 | BEA English',
    'description' => 'Khóa học tiếng Anh cho học sinh từ lớp 1 đến 12, bám sát khung chuẩn Cambridge Young Learners và CEFR. Cam kết đầu ra, luyện thi chứng chỉ quốc tế.',
])
@section('content')
    @include('home.sections.hoc-sinh.intro')
    @include('home.sections.hoc-sinh.muc-tieu')
    @include('home.sections.hoc-sinh.lo-trinh')
    @include('home.sections.shared.chinh-sach')
    @include('home.sections.shared.contact')
@endsection
