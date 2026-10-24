<div class="arch-banner">
    <strong>Pola Desktop Component:</strong> Dipanggil melalui <code>isMobile ? StudentsCreateMobile : StudentsCreateDesktop</code>. Menggunakan formulir 2-kolom yang nyaman untuk input data via keyboard monitor.
</div>

<div class="panel" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-header">
        <h2 class="panel-title">Form Tambah Siswa Baru (Desktop View)</h2>
        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="panel-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="nis" class="form-label">Nomor Induk Siswa (NIS) <span style="color: var(--danger);">*</span></label>
                    <input 
                        type="text" 
                        id="nis" 
                        name="nis" 
                        class="input-text @error('nis') input-error @enderror" 
                        value="{{ old('nis') }}" 
                        placeholder="Contoh: 20260101" 
                        required
                    >
                    @error('nis')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap Siswa <span style="color: var(--danger);">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="input-text @error('name') input-error @enderror" 
                        value="{{ old('name') }}" 
                        placeholder="Contoh: Ahmad Fauzan" 
                        required
                    >
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="class_grade" class="form-label">Kelas / Jurusan <span style="color: var(--danger);">*</span></label>
                    <input 
                        type="text" 
                        id="class_grade" 
                        name="class_grade" 
                        class="input-text @error('class_grade') input-error @enderror" 
                        value="{{ old('class_grade') }}" 
                        placeholder="Contoh: XII Rekayasa Perangkat Lunak 1" 
                        required
                    >
                    @error('class_grade')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email <span style="color: var(--danger);">*</span></label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="input-text @error('email') input-error @enderror" 
                        value="{{ old('email') }}" 
                        placeholder="nama@sekolah.sch.id" 
                        required
                    >
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Nomor Telepon / WhatsApp</label>
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        class="input-text @error('phone') input-error @enderror" 
                        value="{{ old('phone') }}" 
                        placeholder="081234567890"
                    >
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status Siswa <span style="color: var(--danger);">*</span></label>
                    <select id="status" name="status" class="select-input @error('status') input-error @enderror" required>
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="graduated" {{ old('status') === 'graduated' ? 'selected' : '' }}>Lulus</option>
                    </select>
                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-span-2">
                    <label for="address" class="form-label">Alamat Domisili</label>
                    <textarea 
                        id="address" 
                        name="address" 
                        rows="3" 
                        class="textarea-input @error('address') input-error @enderror" 
                        placeholder="Masukkan alamat lengkap siswa..."
                    >{{ old('address') }}</textarea>
                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Siswa</button>
            </div>
        </form>
    </div>
</div>
