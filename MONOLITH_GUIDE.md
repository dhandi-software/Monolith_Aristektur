# Panduan Pembelajaran Arsitektur Monolith (PHP & Laravel)

Dokumen ini disusun sebagai materi dan acuan template kode (clean code) untuk memahami **Arsitektur Monolith** serta teknik pemisahan tampilan **Desktop** dan **Mobile** pada framework Laravel.

---

## 1. Apa Itu Arsitektur Monolith?

Dalam rekayasa perangkat lunak, **Monolith** adalah arsitektur di mana seluruh komponen sistem (antarmuka/UI, routing, logika bisnis, validasi, dan akses database) dikemas dan dijalankan dalam satu kesatuan basis kode (single codebase).

### Karakteristik Utama Monolith:
1. **Satu Repositori dan Satu Deployment**: Seluruh fitur dideploy bersamaan ke server.
2. **Komunikasi Dalam Memori (In-Process Calls)**: Controller memanggil Service atau Model secara langsung via PHP, tanpa overhead network HTTP atau message broker seperti di Microservices.
3. **Integritas Transaksi Database**: ACID transaction mudah diterapkan karena seluruh tabel berada dalam database yang sama.
4. **Kesederhanaan Operasional**: Setup lokal dan debugging jauh lebih cepat untuk tim pemula maupun menengah.

---

## 2. Pemisahan Tampilan Desktop vs Mobile di Monolith

### Problem Statement
Sering kali desainer UI/UX menginginkan pengalaman yang berbeda antara desktop dan mobile:
- **Desktop**: Layar lebar, tabel data multi-kolom, filter kompleks, dialog modal, tombol batch.
- **Mobile**: Layar sempit vertikal, format kartu yang dapat di-scroll (touch cards), tombol aksi melayang (Floating Action Button), input berukuran minimal 44px agar nyaman disentuh jari.

Pada aplikasi Single Page Application (SPA) seperti React, biasanya ditulis:
```tsx
const { isMobile } = useOutletContext<{ isMobile: boolean }>();
return isMobile ? <CreateAccountMobile /> : <CreateAccountDesktop />;
```

### Solusi pada Laravel Monolith (View Resolver Pattern)
Pada arsitektur Monolith server-side rendering (SSR), pemisahan ini dipecahkan di layer backend sebelum HTML dikirim ke browser:

```
[ Request Masuk dari Pengguna ]
                │
                ▼
      DetectDeviceMiddleware
   (Membaca User-Agent atau query ?device=mobile)
                │
                ▼
       StudentController
  (Memproses request, memanggil StudentService)
                │
                ▼
resources/views/routes/students/index.blade.php
  (File dispatcher: @if($isMobile) @include('features...') @else @include('features...') @endif)
                │
        ┌───────┴───────┐
        ▼               ▼
StudentsIndexMobile  StudentsIndexDesktop
 (di folder features)  (di folder features)
```

### Struktur Folder Tampilan (Pola Routes & Features):
```text
resources/views/
├── components/
│   ├── alert.blade.php
│   ├── device-bar.blade.php
│   └── status-badge.blade.php
├── layouts/
│   └── app.blade.php
├── routes/
│   └── students/
│       ├── index.blade.php    <-- File pengarah: if($isMobile) render mobile else desktop
│       ├── create.blade.php   <-- File pengarah create
│       ├── edit.blade.php     <-- File pengarah edit
│       └── show.blade.php     <-- File pengarah show
└── features/
    └── students/
        ├── StudentsIndexDesktop.blade.php   <-- Tabel penuh, stat card 4 kolom
        ├── StudentsIndexMobile.blade.php    <-- Card list, touch targets >= 44px, FAB
        ├── StudentsCreateDesktop.blade.php  <-- Form 2 kolom untuk monitor
        ├── StudentsCreateMobile.blade.php   <-- Form 1 kolom vertikal layar sentuh
        ├── StudentsEditDesktop.blade.php
        ├── StudentsEditMobile.blade.php
        ├── StudentsShowDesktop.blade.php
        └── StudentsShowMobile.blade.php
```

---

## 3. Struktur Clean Code dalam Proyek Ini

Proyek ini menerapkan pembagian layer yang rapi agar siswa memahami peran masing-masing komponen:

1. **Routing (`routes/web.php`)**
   Hanya mendefinisikan rute HTTP dan memetakan ke controller yang berwenang.

2. **Form Request (`app/Http/Requests/`)**
   - `StoreStudentRequest.php`
   - `UpdateStudentRequest.php`
   Bertanggung jawab memvalidasi input pengguna (NIS unik, email valid, batas karakter) sebelum data sampai ke controller.

3. **Controller (`app/Http/Controllers/StudentController.php`)**
   Menggunakan pola **Thin Controller**. Controller tidak melakukan query SQL langsung, melainkan mengorkestrasi alur antara Request, Service, dan ViewResolver.

4. **Service Layer (`app/Services/StudentService.php`)**
   Tempat logika bisnis dan query database terpusat: pagination, filter pencarian, kalkulasi statistik siswa, penyimpanan, dan penghapusan data.

5. **Device Detector & View Resolver (`app/Services/`)**
   - `DeviceDetector.php`: Memeriksa string `User-Agent` HTTP header dan menangani session override.
   - `ViewResolver.php`: Mencari file view yang sesuai (`desktop.` atau `mobile.`) dengan fallback otomatis ke view umum jika belum ada pemisahan.
   - Helper global `view_device('students.index', $data)` atau macro `View::device(...)`.

6. **Model & Query Scope (`app/Models/Student.php`)**
   Mendefinisikan atribut yang boleh diisi (`$fillable`), konstanta status, serta query scope lokal (`scopeSearch` dan `scopeFilterStatus`).

---

## 4. Cara Menjalankan Proyek

### Langkah 1: Masuk ke folder proyek
```bash
cd Monolith_Arsitektur
```

### Langkah 2: Jalankan migrasi dan seeder database
Database SQLite lokal sudah disiapkan di `database/database.sqlite`. Jika ingin mereset dan mengisi ulang data simulasi:
```bash
php artisan migrate:fresh --seed
```

### Langkah 3: Jalankan server pengembangan
```bash
php artisan serve
```
Akses aplikasi melalui browser di: `http://127.0.0.1:8000`

---

## 5. Menguji Fitur Pemisahan Desktop vs Mobile

Untuk memudahkan pembelajaran di laptop, di bagian paling atas halaman telah disediakan **Device Bar**:
1. Klik tombol **Desktop** untuk memaksa server merender template desktop.
2. Klik tombol **Mobile** untuk memaksa server merender template mobile.
3. Klik tombol **Auto** untuk mengembalikan deteksi otomatis sesuai User-Agent browser yang digunakan.

Anda juga dapat menambahkan query parameter secara manual di URL:
- `http://127.0.0.1:8000/students?device=mobile`
- `http://127.0.0.1:8000/students?device=desktop`

---

## 6. Menjalankan Unit & Feature Tests

Proyek ini telah dilengkapi dengan 15 pengujian otomatis untuk memverifikasi fungsionalitas CRUD dan resolusi perangkat:
```bash
php artisan test
```
Hasil pengujian mencakup:
- Pengujian Create, Read, Update, Delete data siswa.
- Validasi data NIS dan Email unik.
- Resolusi view Desktop untuk User-Agent Desktop.
- Resolusi view Mobile untuk User-Agent gawai.
- Mekanisme override resolusi view melalui session/query parameter.
