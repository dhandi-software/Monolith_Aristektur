<div class="arch-banner" style="margin-bottom: 1rem; font-size: 0.75rem;">
    <strong>Pola Mobile Component:</strong> Dipanggil melalui <code>isMobile ? StudentsCreateMobile : StudentsCreateDesktop</code>. Form dioptimasi dengan elemen input sentuh berukuran penuh (full-width) dan tombol aksi yang mudah dijangkau satu tangan.
</div>

<div class="mobile-card" style="padding: 1.25rem;">
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div class="form-group">
                <label for="nis" class="form-label">Nomor Induk Siswa (NIS) <span style="color: var(--danger);">*</span></label>
                <input 
                    type="text" 
                    id="nis" 
                    name="nis" 
                    class="input-text btn-touch @error('nis') input-error @enderror" 
                    value="{{ old('nis') }}" 
                    placeholder="Contoh: 20260101" 
                    required
                >
                @error('nis')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap <span style="color: var(--danger);">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="input-text btn-touch @error('name') input-error @enderror" 
                    value="{{ old('name') }}" 
                    placeholder="Nama siswa" 
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
                    class="input-text btn-touch @error('class_grade') input-error @enderror" 
                    value="{{ old('class_grade') }}" 
                    placeholder="Contoh: X RPL 1" 
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
                    class="input-text btn-touch @error('email') input-error @enderror" 
                    value="{{ old('email') }}" 
                    placeholder="email@sekolah.sch.id" 
                    required
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    class="input-text btn-touch @error('phone') input-error @enderror" 
                    value="{{ old('phone') }}" 
                    placeholder="081234567890"
                >
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status Siswa <span style="color: var(--danger);">*</span></label>
                <select id="status" name="status" class="select-input btn-touch @error('status') input-error @enderror" required>
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="graduated" {{ old('status') === 'graduated' ? 'selected' : '' }}>Lulus</option>
                </select>
                @error('status')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Alamat Domisili</label>
                <textarea 
                    id="address" 
                    name="address" 
                    rows="3" 
                    class="textarea-input @error('address') input-error @enderror" 
                    placeholder="Alamat lengkap..."
                >{{ old('address') }}</textarea>
                @error('address')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-touch" style="width: 100%;">Simpan Siswa</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-touch" style="width: 100%;">Batal</a>
            </div>
        </div>
    </form>
</div>
