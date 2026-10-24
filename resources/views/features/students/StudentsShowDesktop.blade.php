<div class="arch-banner">
    <strong>Pola Desktop Component:</strong> Dipanggil melalui <code>isMobile ? StudentsShowMobile : StudentsShowDesktop</code>. Tampilan detail menggunakan layout kartu berstruktur lebar untuk kemudahan membaca metadata.
</div>

<div class="panel" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">{{ $student->name }} (Desktop View)</h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted);">NIS: {{ $student->nis }}</p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>
    <div class="panel-body">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
            <div>
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Status Keaktifan</h3>
                <x-status-badge :status="$student->status" />
            </div>
            <div>
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Kelas / Jurusan</h3>
                <p style="font-size: 0.9375rem; font-weight: 500;">{{ $student->class_grade }}</p>
            </div>
            <div>
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Alamat Email</h3>
                <p style="font-size: 0.9375rem;">{{ $student->email }}</p>
            </div>
            <div>
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Nomor Telepon</h3>
                <p style="font-size: 0.9375rem;">{{ $student->phone ?? 'Belum diisi' }}</p>
            </div>
            <div style="grid-column: span 2;">
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Alamat Domisili</h3>
                <p style="font-size: 0.9375rem; color: var(--text-main);">{{ $student->address ?? 'Tidak ada data alamat.' }}</p>
            </div>
            <div>
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Terdaftar Pada</h3>
                <p style="font-size: 0.8125rem; color: var(--text-muted);">{{ $student->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
            <div>
                <h3 style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-soft); font-weight: 600; margin-bottom: 0.25rem;">Terakhir Diperbarui</h3>
                <p style="font-size: 0.8125rem; color: var(--text-muted);">{{ $student->updated_at->format('d F Y, H:i') }} WIB</p>
            </div>
        </div>
    </div>
</div>
