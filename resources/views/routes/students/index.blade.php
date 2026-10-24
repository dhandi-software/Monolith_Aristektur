@extends('layouts.app')

@section('title', 'Daftar Siswa')
@section('page_heading', 'Daftar Siswa')

@section('content')
    @if($isMobile)
        @include('features.students.StudentsIndexMobile')
    @else
        @include('features.students.StudentsIndexDesktop')
    @endif
@endsection
