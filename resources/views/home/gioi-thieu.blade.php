@extends('layouts.home', [
    'activePage'  => 'gioi-thieu',
    'title'       => 'Giới Thiệu BEA English – Trung Tâm Tiếng Anh Chất Lượng Cao',
    'description' => 'BEA English – Hơn 10 năm đồng hành cùng học viên Việt Nam. Phương pháp 6P-BeA, giáo viên Philippines chuẩn quốc tế, cam kết đầu ra rõ ràng.',
])
@section('content')
    @include('home.sections.gioi-thieu.hero')
    @include('home.sections.gioi-thieu.tam-nhin-su-menh')
    @include('home.sections.gioi-thieu.gia-tri-cot-loi')
    @include('home.sections.gioi-thieu.phuong-cham')
    @include('home.sections.gioi-thieu.cam-ket')
    @include('home.sections.shared.contact')
@endsection
