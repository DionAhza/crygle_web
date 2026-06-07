# 🎨 Crygle Academy — Redesign Views

Kumpulan file Blade view yang sudah disesuaikan persis dengan desain PDF Research_Web_Academy.

---

## 📁 Isi Paket

```
resources/views/
├── layouts/
│   └── app.blade.php          ← Navbar + Footer baru (warna #1B4F9B, dropdown nav)
├── auth/
│   ├── login.blade.php        ← 2 kolom: ilustrasi kiri, form kanan
│   └── register.blade.php     ← Sama + First Name / Last Name
├── home.blade.php             ← Landing page lengkap (hero, program, kelas populer, alumni, FAQ, CTA)
├── courses/
│   ├── index.blade.php        ← Grid kelas + filter pill + search
│   ├── show.blade.php         ← Detail course + tab Overview/Kurikulum/Mentor/Reviews
│   ├── _card_home.blade.php   ← Card kelas (thumbnail, level badge, rating, harga coret)
│   └── _enroll_btn.blade.php  ← Tombol enroll/lanjut/bayar
├── dashboard/
│   └── index.blade.php        ← Dashboard siswa: sidebar kiri, card kelas + progress bar
├── learn/
│   └── lesson.blade.php       ← Halaman belajar: sidebar modul + video + tab Resources
├── payment/
│   ├── checkout.blade.php     ← Form pembayaran: stepper, kartu kredit, VA, QRIS
│   ├── processing.blade.php   ← Halaman "Memproses pembayaran kamu..."
│   └── success.blade.php      ← "Pembayaran Berhasil!" + progress card
└── errors/
    ├── 403.blade.php
    ├── 404.blade.php
    └── 500.blade.php

app/Http/Controllers/
├── DashboardController.php    ← Redirect ke dashboard/index.blade.php
└── TransactionController.php  ← Pakai view payment/* baru + route payment.success.page

routes/
└── web.php                    ← Tambahan route: payment.processing, payment.success.page
```

---

## 🚀 Cara Install

### 1. Salin semua file ke project Laravel

Salin semua file mengikuti struktur folder di atas. **Timpa** file yang sudah ada.

### 2. Daftarkan AuthController baru (jika register punya first_name/last_name)

Di `app/Http/Controllers/Auth/AuthController.php`, pastikan method `register()` menerima `name` dari input:

```php
public function register(Request $request)
{
    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);
    // Form sudah inject hidden input 'name' via JavaScript di view register.blade.php
    ...
}
```

### 3. Pastikan route `payment.success.page` tersedia

File `routes/web.php` yang disertakan sudah menambahkan:
```php
Route::get('/enrollments/{enrollment}/success', [TransactionController::class, 'success'])->name('payment.success.page');
```

### 4. Jalankan server

```bash
php artisan serve
```

---

## 🎨 Warna Brand (sesuai PDF)

| Variabel     | Nilai     | Penggunaan             |
|--------------|-----------|------------------------|
| Navy Blue    | `#1B4F9B` | Warna utama, navbar, tombol |
| Light Blue   | `#EEF4FF` | Background section, badge |
| Yellow       | `#F59E0B` | Bintang rating         |
| Green        | `#22C55E` | Badge gratis, progress selesai |
| Text Dark    | `#1A1A2E` | Judul, teks utama      |
| Text Muted   | `#6B7280` | Deskripsi, label       |

---

## 📌 Halaman yang Sudah Didesain Ulang

| Halaman | URL | Status |
|---------|-----|--------|
| Login | `/login` | ✅ Sesuai PDF hal.1 |
| Register | `/register` | ✅ Sesuai PDF hal.2 |
| Landing Page | `/` | ✅ Sesuai PDF hal.3 |
| Daftar Kelas | `/courses` | ✅ Card + filter |
| Detail Course | `/courses/{slug}` | ✅ Sesuai PDF hal.4-6 |
| Pembayaran | `/transactions/{id}/payment` | ✅ Sesuai PDF hal.7 |
| Processing | `/transactions/{id}/processing` | ✅ Sesuai PDF hal.9 |
| Sukses | `/enrollments/{id}/success` | ✅ Sesuai PDF hal.10 |
| Dashboard Siswa | `/dashboard` | ✅ Sesuai PDF hal.11 |
| Halaman Belajar | `/learn/{enrollment}/lesson/{lesson}` | ✅ Sesuai PDF hal.12 |

---

Dibuat dengan ❤️ untuk Crygle Academy
