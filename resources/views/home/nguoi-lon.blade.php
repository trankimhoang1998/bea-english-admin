@extends('layouts.home', [
    'activePage'  => 'nguoi-lon',
    'title'       => 'Tiếng Anh cho Người Lớn – Giao Tiếp & Công Việc | BEA English',
    'description' => 'Khóa học tiếng Anh cho người lớn 4 cấp độ từ cơ bản đến nâng cao. Phát triển toàn diện 4 kỹ năng, lịch học linh hoạt, hướng đến IELTS, TOEIC, VSTEP.',
])
@section('content')
    @include('home.sections.nguoi-lon.intro')
    @include('home.sections.nguoi-lon.muc-tieu')
    @include('home.sections.nguoi-lon.lo-trinh')
    @include('home.sections.shared.chinh-sach')
    @include('home.sections.shared.contact')
@endsection
