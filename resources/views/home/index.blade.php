@extends('layouts.home', ['activePage' => 'home'])

@section('content')
    @include('home.sections.index.hero')
    @include('home.sections.index.stats-strip')
    @include('home.sections.index.free-trial')
    @include('home.sections.index.programs')
    @include('home.sections.index.ielts')
    @include('home.sections.index.commitment')
    @include('home.sections.shared.contact')
@endsection
