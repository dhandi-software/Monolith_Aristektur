<div class="arch-banner">
    <strong>Pola Desktop Component:</strong> Dipanggil melalui <code>isMobile ? StudentsIndexMobile : StudentsIndexDesktop</code>. Menggunakan tata letak lebar dengan ringkasan statistik 4-kolom dan tabel data tabular.
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Siswa</div>
        <div class="stat-value">{{ $statistics['total'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Siswa Aktif</div>
        <div class="stat-value" style="color: var(--success);">{{ $statistics['active'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Siswa Nonaktif</div>
        <div class="stat-value" style="color: #d97706;">{{ $statistics['inactive'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Alumni / Lulus</div>
        <div class="stat-value" style="color: var(--text-soft);">{{ $statistics['graduated'] }}</div>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <h2 class="panel-title">Master Data Siswa (Desktop View)</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">+ Tambah Siswa</a>
    </div>
    <div class="panel-body">
        <form method="GET" action="{{ route('students.index') }}" class="filter-bar">
            <div class="search-input-wrapper">
                <input 
                    type="text" 
                    name="search" 
                    class="input-text" 
                    placeholder="Cari berdasarkan nama, NIS, kelas, atau email..." 
                    value="{{ $filters['search'] ?? '' }}"
                >
            </div>
            <div style="min-width: 160px;">
                <select name="status" class="select-input">
                    <option value="all" {{ ($filters['status'] ?? '') === 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="active" {{ ($filters['status'] ?? '') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="graduated" {{ ($filters['status'] ?? '') === 'graduated' ? 'selected' : '' }}>Lulus</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Filter</button>
            @if(!empty($filters['search']) || (!empty($filters['status']) && $filters['status'] !== 'all'))
                <a href="{{ route('students.index') }}" class="btn btn-secondary" title="Reset filter">Reset</a>
            @endif
        </form>

        @if($students->isEmpty())
            <div class="empty-state">
                <h3 class="empty-state-title">Belum Ada Data Siswa</h3>
                <p class="empty-state-desc">Tidak ada data siswa yang cocok dengan filter pencarian Anda.</p>
                <a href="{{ route('students.create') }}" class="btn btn-primary">+ Tambah Siswa Sekarang</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas / Jurusan</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td style="font-family: monospace; font-weight: 600;">{{ $student->nis }}</td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" style="font-weight: 600; color: var(--primary);">
                                        {{ $student->name }}
                                    </a>
                                </td>
                                <td>{{ $student->class_grade }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone ?? '-' }}</td>
                                <td>
                                    <x-status-badge :status="$student->status" />
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 0.375rem;">
                                        <a href="{{ route('students.show', $student) }}" class="btn btn-secondary btn-sm" title="Lihat detail">Lihat</a>
                                        <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm" title="Ubah data">Edit</a>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ $student->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1.25rem;">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>
