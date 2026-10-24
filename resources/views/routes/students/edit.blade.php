@extends('layouts.app')

@section('title', 'Ubah Siswa')
@section('page_heading', 'Ubah Siswa')

@section('content')
    @if($isMobile)
        @include('features.students.StudentsEditMobile')
    @else
        @include('features.students.StudentsEditDesktop')
    @endif
@endsection
