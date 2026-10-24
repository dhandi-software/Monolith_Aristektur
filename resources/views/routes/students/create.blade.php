@extends('layouts.app')

@section('title', 'Tambah Siswa')
@section('page_heading', 'Tambah Siswa')

@section('content')
    @if($isMobile)
        @include('features.students.StudentsCreateMobile')
    @else
        @include('features.students.StudentsCreateDesktop')
    @endif
@endsection
