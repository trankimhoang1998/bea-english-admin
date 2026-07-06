@extends('layouts.home', [
    'activePage'  => 'phuong-phap',
    'title'       => 'Phương Pháp 6P-BeA – Học Tiếng Anh Hiệu Quả | BEA English',
    'description' => 'Phương pháp giảng dạy 6P-BeA: Personalized – Practice – Partnership – Purposeful – Progress – Practical. Lộ trình cá nhân hóa theo từng học viên.',
])
@section('content')
    @include('home.sections.phuong-phap.6p')
    @include('home.sections.shared.contact')
@endsection
