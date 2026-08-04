@extends('layouts.home', [
    'activePage'  => 'home',
    'title'       => 'BEA English – Trung Tâm Anh Ngữ Trực Tuyến 1:1 | Luyện Thi IELTS, TOEIC, Cambridge',
    'description' => 'BEA English – trung tâm tiếng Anh trực tuyến 1:1 với giáo viên nước ngoài chuẩn quốc tế. Khóa học cho học sinh, người lớn và luyện thi IELTS, cam kết chất lượng đầu ra bằng văn bản.',
])

@section('content')
    @include('home.sections.index.hero')
    @include('home.sections.index.stats-strip')
    @include('home.sections.index.free-trial')
    @include('home.sections.index.programs')
    @include('home.sections.index.ielts')
    @include('home.sections.index.commitment')
    @include('home.sections.shared.contact')
@endsection
