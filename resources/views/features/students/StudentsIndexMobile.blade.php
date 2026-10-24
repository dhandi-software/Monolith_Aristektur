<div class="arch-banner" style="margin-bottom: 1rem; font-size: 0.75rem;">
    <strong>Pola Mobile Component:</strong> Dipanggil melalui <code>isMobile ? StudentsIndexMobile : StudentsIndexDesktop</code>. Format diubah menjadi kartu vertikal yang optimal untuk orientasi gawai dan layar sentuh.
</div>

<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; margin-bottom: 1rem;">
    <div style="background-color: #ffffff; padding: 0.75rem; border-radius: var(--radius-sm); border: 1px solid var(--border-subtle); text-align: center;">
        <div style="font-size: 0.6875rem; color: var(--text-soft); text-transform: uppercase;">Total</div>
        <div style="font-size: 1.25rem; font-weight: 700;">{{ $statistics['total'] }}</div>
    </div>
    <div style="background-color: #ffffff; padding: 0.75rem; border-radius: var(--radius-sm); border: 1px solid var(--border-subtle); text-align: center;">
        <div style="font-size: 0.6875rem; color: var(--text-soft); text-transform: uppercase;">Aktif</div>
        <div style="font-size: 1.25rem; font-weight: 700; color: var(--success);">{{ $statistics['active'] }}</div>
    </div>
</div>

<form method="GET" action="{{ route('students.index') }}" style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem;">
    <input 
        type="text" 
        name="search" 
        class="input-text" 
        placeholder="Cari nama, NIS, kelas..." 
        value="{{ $filters['search'] ?? '' }}"
    >
    <div style="display: flex; gap: 0.5rem;">
        <select name="status" class="select-input" style="flex: 1;">
            <option value="all" {{ ($filters['status'] ?? '') === 'all' ? 'selected' : '' }}>Semua Status</option>
            <option value="active" {{ ($filters['status'] ?? '') === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            <option value="graduated" {{ ($filters['status'] ?? '') === 'graduated' ? 'selected' : '' }}>Lulus</option>
        </select>
        <button type="submit" class="btn btn-secondary btn-touch" style="min-width: 80px;">Cari</button>
    </div>
</form>

@if($students->isEmpty())
    <div class="empty-state" style="background-color: #ffffff; border-radius: var(--radius-md); border: 1px solid var(--border-subtle);">
        <h3 class="empty-state-title" style="font-size: 1rem;">Tidak Ada Siswa</h3>
        <p class="empty-state-desc" style="font-size: 0.8125rem;">Tidak ditemukan siswa yang sesuai filter.</p>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-touch">+ Tambah Siswa Baru</a>
    </div>
@else
    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        @foreach($students as $student)
            <div class="mobile-card">
                <div class="mobile-card-header">
                    <div>
                        <a href="{{ route('students.show', $student) }}" class="mobile-card-title">
                            {{ $student->name }}
                        </a>
                        <div class="mobile-card-subtitle">NIS: {{ $student->nis }}</div>
                    </div>
                    <x-status-badge :status="$student->status" />
                </div>

                <div class="mobile-card-body">
                    <div><strong>Kelas:</strong> {{ $student->class_grade }}</div>
                    <div><strong>Email:</strong> {{ $student->email }}</div>
                    @if($student->phone)
                        <div><strong>Telp:</strong> {{ $student->phone }}</div>
                    @endif
                </div>

                <div class="mobile-card-footer">
                    <a href="{{ route('students.show', $student) }}" class="btn btn-secondary btn-sm" style="min-height: 38px; min-width: 60px;">Detail</a>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm" style="min-height: 38px; min-width: 60px;">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Hapus data siswa {{ $student->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="min-height: 38px;">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 1rem;">
        {{ $students->links() }}
    </div>
@endif

<a href="{{ route('students.create') }}" class="fab-add" title="Tambah Siswa Baru" aria-label="Tambah Siswa Baru">+</a>
