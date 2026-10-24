<div class="arch-banner">
    <strong>Pola Desktop Component:</strong> Dipanggil melalui <code>isMobile ? StudentsEditMobile : StudentsEditDesktop</code>. Form edit otomatis terisi data awal dari instance model <code>Student</code>.
</div>

<div class="panel" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-header">
        <h2 class="panel-title">Ubah Data: {{ $student->name }} (Desktop View)</h2>
        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="panel-body">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="nis" class="form-label">Nomor Induk Siswa (NIS) <span style="color: var(--danger);">*</span></label>
                    <input 
                        type="text" 
                        id="nis" 
                        name="nis" 
                        class="input-text @error('nis') input-error @enderror" 
                        value="{{ old('nis', $student->nis) }}" 
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
                        value="{{ old('name', $student->name) }}" 
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
                        value="{{ old('class_grade', $student->class_grade) }}" 
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
                        value="{{ old('email', $student->email) }}" 
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
                        value="{{ old('phone', $student->phone) }}"
                    >
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status Siswa <span style="color: var(--danger);">*</span></label>
                    <select id="status" name="status" class="select-input @error('status') input-error @enderror" required>
                        <option value="active" {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $student->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="graduated" {{ old('status', $student->status) === 'graduated' ? 'selected' : '' }}>Lulus</option>
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
                    >{{ old('address', $student->address) }}</textarea>
                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui Data</button>
            </div>
        </form>
    </div>
</div>
