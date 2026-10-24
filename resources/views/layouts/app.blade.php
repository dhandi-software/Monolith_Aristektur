<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Akademik Siswa') - Monolith Architecture</title>
    <link rel="stylesheet" href="{{ asset('css/monolith.css') }}">
</head>
<body style="{{ $isMobile ? 'background-color: #e2e8f0;' : '' }}">
    <x-device-bar />

    @if($isMobile)
        <div class="mobile-app-shell">
            <header class="mobile-header">
                <div>
                    <h1 class="mobile-header-title">@yield('page_heading', 'Sistem Siswa')</h1>
                    <p style="font-size: 0.75rem; color: var(--text-soft);">Tampilan Mobile</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Daftar</a>
            </header>

            <main class="mobile-content">
                <x-alert />
                @yield('content')
            </main>
        </div>
    @else
        <header class="desktop-header">
            <div class="desktop-header-inner">
                <div class="desktop-brand">
                    <div>
                        <h1 class="desktop-brand-title">Sistem Akademik Siswa</h1>
                        <p class="desktop-brand-subtitle">Modul Pembelajaran Arsitektur Monolith (Tampilan Desktop)</p>
                    </div>
                </div>
                <nav style="display: flex; gap: 0.75rem; align-items: center;">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Daftar Siswa</a>
                    <a href="{{ route('students.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
                </nav>
            </div>
        </header>

        <main class="desktop-container">
            <x-alert />
            @yield('content')
        </main>

        <footer style="text-align: center; padding: 2rem 1rem; color: var(--text-soft); font-size: 0.8125rem; border-top: 1px solid var(--border-subtle); margin-top: 3rem;">
            <p>Template Monolith Architecture - Laravel Clean Code Reference</p>
        </footer>
    @endif
</body>
</html>
