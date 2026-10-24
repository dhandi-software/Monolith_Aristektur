# Template Modul Monolith: Manajemen Data Siswa (PHP & Laravel)

Proyek ini dibuat sebagai materi pembelajaran Arsitektur Monolith dan acuan template kode bersih (clean code) untuk tingkat pemula hingga menengah.

## Fitur Utama Pembelajaran
1. **Arsitektur Monolith Berlapis**: Pemisahan jelas antara Routing, Form Request Validation, Thin Controller, Service Layer, Model Eloquent, dan View.
2. **Pola Folder Routes & Features**: Struktur view mengadopsi pola modern:
   - `resources/views/routes/students/`: Berisi file dispatcher rute (`index.blade.php`, `create.blade.php`, dst.) yang mengarahkan ke tampilan Desktop atau Mobile.
   - `resources/views/features/students/`: Berisi komponen implementasi tampilan masing-masing (`StudentsIndexDesktop.blade.php` & `StudentsIndexMobile.blade.php`).
3. **Interactive Device Switcher**: Tombol pengubah mode di bagian atas halaman (Desktop, Mobile, Auto) untuk mempermudah eksplorasi langsung di satu layar laptop tanpa perlu tools khusus.
4. **CRUD Lengkap Siswa**: Create, Read (filter status, search keyword, pagination), Update, dan Delete dengan proteksi CSRF, konfirmasi dialog, dan penanganan status kosong (empty state).
5. **Aksesibilitas & Standar UI**: Target sentuh mobile minimal 44px, kontras warna memenuhi standar WCAG AA, dan formulir ramah pengguna.
6. **100% Siap Uji**: Dilengkapi 13 unit/feature test otomatis (`php artisan test`).

## Panduan Lengkap
Silakan baca panduan lengkap arsitektur dan penjelasannya di:
**[MONOLITH_GUIDE.md](MONOLITH_GUIDE.md)**

## Cara Menjalankan
```powershell
# 1. Jalankan server Laravel (gunakan flag --no-reload untuk Windows)
php artisan serve --no-reload

# 2. Atau bisa juga menggunakan built-in server PHP standar
php -S 127.0.0.1:8000 -t public
```
Buka browser di: `http://127.0.0.1:8000`
