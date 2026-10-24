@extends('layouts.app')

@section('title', 'Detail Siswa: ' . $student->name)
@section('page_heading', 'Detail Siswa')

@section('content')
    @if($isMobile)
        @include('features.students.StudentsShowMobile')
    @else
        @include('features.students.StudentsShowDesktop')
    @endif
@endsection
