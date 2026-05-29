# 🎓 Crygle Academy — Panduan Instalasi

Platform kelas online siap pakai berbasis Laravel 11 dengan fitur lengkap:
course management, enrollment, progress tracking, review, transaksi, instructor studio, dan admin panel.

---

## 📦 Persyaratan Sistem

| Kebutuhan | Versi Minimum |
|-----------|--------------|
| PHP | 8.2+ |
| Laravel | 11.x |
| MySQL / MariaDB | 8.0+ / 10.4+ |
| Composer | 2.x |
| Node.js (opsional) | 18+ |

---

## 🚀 Langkah Instalasi

### 1. Salin Semua File

Salin seluruh isi folder ini ke **root project Laravel** kamu, sesuaikan dengan struktur folder:

```
app/
  Http/Controllers/     ← salin semua controller
  Models/               ← salin semua model
  Middleware/           ← salin AdminMiddleware.php & InstructorMiddleware.php

bootstrap/
  app.php               ← GANTI dengan file ini (ada alias middleware)

database/
  migrations/           ← salin semua file migration
  seeders/
    DatabaseSeeder.php  ← GANTI dengan file ini

resources/views/        ← salin semua folder & file blade

routes/
  web.php               ← GANTI dengan file ini

```

> ⚠️ **Penting:** File `bootstrap/app.php`, `routes/web.php`, dan `DatabaseSeeder.php` **menggantikan** file lama. Jangan merge, langsung replace.

---

### 2. Install Dependensi Composer

```bash
composer install
```

---

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env`, sesuaikan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crygle_academy
DB_USERNAME=root
DB_PASSWORD=

APP_NAME="Crygle Academy"
APP_URL=http://localhost:8000
```

---

### 4. Hapus Migration Lama & Jalankan Migration Baru

```bash
# Hapus migration users yang lama (jika ada) karena kita sudah replace
# Lalu jalankan:

php artisan migrate:fresh
```

---

### 5. Jalankan Seeder

```bash
php artisan db:seed
```

Output seeder akan menampilkan tabel akun:

| Role       | Email                | Password   |
|------------|----------------------|------------|
| Admin      | admin@crygle.com     | admin1234  |
| Instructor | rizky@crygle.com     | password   |
| Instructor | aulia@crygle.com     | password   |
| Instructor | dimas@crygle.com     | password   |
| Student    | budi@example.com     | password   |
| Student    | siti@example.com     | password   |

---

### 6. Setup Storage Link (untuk upload gambar)

```bash
php artisan storage:link
```

---

### 7. Jalankan Server

```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## 🗺️ Peta Halaman Lengkap

### Public
| URL | Keterangan |
|-----|------------|
| `/` | Landing page dengan featured course & kategori |
| `/courses` | Daftar semua course + filter kategori, level, harga |
| `/courses/{slug}` | Detail course: kurikulum, review, enroll card |
| `/login` | Halaman login |
| `/register` | Halaman registrasi |

### Student (perlu login)
| URL | Keterangan |
|-----|------------|
| `/dashboard` | Dashboard pelajar: progress semua course |
| `/courses/{slug}/checkout` | Proses pendaftaran (gratis langsung enroll, berbayar ke payment) |
| `/transactions/{id}/payment` | Halaman pembayaran simulasi |
| `/learn/{enrollment}/lesson/{lesson}` | Halaman belajar dengan video player & sidebar kurikulum |

### Instructor
| URL | Keterangan |
|-----|------------|
| `/instructor` | Dashboard instructor: stats & daftar course |
| `/instructor/courses/create` | Buat course baru |
| `/instructor/courses/{id}/edit` | Edit course + kelola section & lesson inline |

### Admin
| URL | Keterangan |
|-----|------------|
| `/admin` | Dashboard admin: stats, top course, transaksi terbaru |
| `/admin/courses` | Kelola semua course (publish/unpublish/hapus) |
| `/admin/users` | Kelola semua user (ubah role, hapus) |
| `/admin/transactions` | Kelola transaksi (update status manual) |

---

## 🗃️ Struktur Database (ERD)

```
users ──────────────── courses ─────── sections ─── lessons
  │     (instructor)      │                              │
  │                       │                              │
  ├── enrollments ────────┘                    lesson_progress
  │
  ├── reviews ────────────── courses
  │
  └── transactions ───────── courses
```

**Tabel lengkap:**
- `users` — dengan kolom `role` (user/instructor/admin)
- `categories` — kategori course dengan icon & warna
- `courses` — course dengan harga, diskon, level, status, slug
- `sections` — bab/chapter dalam course
- `lessons` — lesson dengan video URL, durasi, preview gratis
- `enrollments` — relasi user-course saat enroll
- `lesson_progress` — tracking progress per lesson
- `reviews` — ulasan & rating 1-5 bintang
- `transactions` — transaksi pembayaran dengan status & gateway ref

---

## 🎨 Fitur Lengkap

### Landing Page
- Hero section dengan statistik live dari DB
- Grid kategori dengan jumlah course
- Featured courses terbaru
- Section "Kenapa Crygle" + CTA

### Course List
- Filter: kategori, level, harga (gratis/berbayar)
- Sort: terbaru, terpopuler, rating tertinggi, harga terendah
- Pagination
- Search by keyword
- Card course dengan rating, jumlah pelajar, harga + diskon

### Course Detail
- Breadcrumb navigasi
- Info: durasi total, jumlah lesson, level, bahasa
- Preview thumbnail & trailer
- Kurikulum accordion per section
- Rating breakdown (bintang 1-5 dengan persentase)
- Daftar ulasan pelajar
- Form tulis ulasan (untuk yang sudah enroll)
- Related courses
- Sticky enroll card (desktop) + sticky bottom bar (mobile)
- Harga diskon dengan badge persentase

### Sistem Belajar
- Video player (YouTube embed)
- Sidebar kurikulum dengan status selesai/belum
- Progress bar keseluruhan course
- Navigasi prev/next lesson
- Tombol "Tandai Selesai"
- Deteksi course selesai 100% otomatis

### Dashboard Pelajar
- Statistik: total course, selesai, sedang berjalan
- Card per course dengan progress bar
- Tombol lanjut belajar / mulai belajar

### Sistem Pembayaran (Simulasi)
- Checkout langsung untuk course gratis
- Halaman pembayaran dengan pilihan metode
- Simulasi konfirmasi bayar → auto enroll
- Admin bisa update status transaksi manual

### Instructor Studio
- Dashboard dengan stats: course, pelajar, revenue
- Buat/edit/hapus course
- Kelola section & lesson inline (tanpa pindah halaman)
- Publish/unpublish course
- Form lesson: judul, URL video, durasi, catatan, preview toggle

### Admin Panel
- Dashboard: 6 statistik utama + grafik transaksi terbaru
- Kelola semua course (publish/unpublish/hapus)
- Kelola users (ubah role dropdown, hapus)
- Kelola transaksi (update status, lihat detail)

---

## 🔧 Kustomisasi

### Ganti Logo
Taruh file logo di:
- `public/logo/crygle-logo.png` — logo navbar (gelap)
- `public/logo/footer-logo.png` — logo footer (putih/terang)

### Ganti Warna Brand
Di `resources/views/layouts/app.blade.php`, ubah variabel CSS:
```css
:root {
  --blue:    #1B6EF3;  /* warna utama */
  --blue-dk: #0D3DA0;  /* warna gelap */
  --yellow:  #FFCC00;  /* warna aksen */
}
```

### Tambah Kategori
Edit `database/seeders/DatabaseSeeder.php` bagian `CATEGORIES`, atau tambah langsung via Admin Panel.

### Integrasi Payment Gateway (Midtrans/Xendit)
Edit `app/Http/Controllers/TransactionController.php`:
- Method `checkout()` — buat transaksi ke gateway
- Method `confirm()` — verifikasi webhook dari gateway

---

## 📁 Seluruh File yang Dibuat

```
52 file total, termasuk:
├── 2  migrations
├── 1  seeder
├── 9  models
├── 14 controllers
├── 2  middleware
├── 1  bootstrap/app.php
├── 1  routes/web.php
└── 22 blade views
```

---

## ❓ Troubleshooting

**`Class not found` saat migrate**
```bash
composer dump-autoload
php artisan migrate:fresh --seed
```

**Route tidak ditemukan**
```bash
php artisan route:clear
php artisan cache:clear
```

**View error `Str::limit`**
Pastikan ada `@php use Illuminate\Support\Str; @endphp` di view yang menggunakannya, atau gunakan `{{ Str::limit(...) }}` langsung (sudah di-facade di Laravel 11).

**Logo tidak muncul**
Letakkan file logo di `public/logo/`. Jika menggunakan storage, jalankan `php artisan storage:link`.

---

Dibuat dengan ❤️ untuk Crygle Academy
