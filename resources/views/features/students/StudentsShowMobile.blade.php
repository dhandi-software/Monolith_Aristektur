<div class="arch-banner" style="margin-bottom: 1rem; font-size: 0.75rem;">
    <strong>Pola Mobile Component:</strong> Dipanggil melalui <code>isMobile ? StudentsShowMobile : StudentsShowDesktop</code>. Tampilan detail dioptimasi untuk orientasi vertikal gawai.
</div>

<div class="mobile-card" style="padding: 1.25rem;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border-subtle);">
        <div>
            <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main);">{{ $student->name }} (Mobile)</h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted);">NIS: {{ $student->nis }}</p>
        </div>
        <x-status-badge :status="$student->status" />
    </div>

    <div style="display: flex; flex-direction: column; gap: 0.875rem; font-size: 0.875rem;">
        <div>
            <div style="font-size: 0.75rem; color: var(--text-soft); text-transform: uppercase;">Kelas / Jurusan</div>
            <div style="font-weight: 600; color: var(--text-main);">{{ $student->class_grade }}</div>
        </div>

        <div>
            <div style="font-size: 0.75rem; color: var(--text-soft); text-transform: uppercase;">Email</div>
            <div style="color: var(--text-main);">{{ $student->email }}</div>
        </div>

        <div>
            <div style="font-size: 0.75rem; color: var(--text-soft); text-transform: uppercase;">Nomor Telepon</div>
            <div style="color: var(--text-main);">{{ $student->phone ?? 'Belum diisi' }}</div>
        </div>

        <div>
            <div style="font-size: 0.75rem; color: var(--text-soft); text-transform: uppercase;">Alamat Domisili</div>
            <div style="color: var(--text-main);">{{ $student->address ?? 'Tidak ada data alamat.' }}</div>
        </div>

        <div style="padding-top: 0.5rem; border-top: 1px solid var(--border-subtle); font-size: 0.75rem; color: var(--text-muted);">
            <div>Terdaftar: {{ $student->created_at->format('d M Y, H:i') }} WIB</div>
            <div>Diperbarui: {{ $student->updated_at->format('d M Y, H:i') }} WIB</div>
        </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 1.25rem;">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary btn-touch" style="width: 100%;">Edit Data Siswa</a>
        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Hapus siswa {{ $student->name }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-touch" style="width: 100%;">Hapus Siswa</button>
        </form>
    </div>
</div>
