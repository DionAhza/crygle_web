@extends('layouts.app')
@section('title','404 — Halaman Tidak Ditemukan')
@section('content')
<div style="min-height:65vh;display:flex;align-items:center;justify-content:center;padding:3rem 1.5rem;text-align:center;">
  <div>
    <p style="font-size:7rem;font-weight:900;color:#EEF4FF;line-height:1;margin-bottom:.5rem;letter-spacing:-4px;">404</p>
    <h1 style="font-size:1.5rem;font-weight:800;color:#1A1A2E;margin-bottom:.75rem;">Halaman Tidak Ditemukan</h1>
    <p style="color:#6B7280;font-size:.9rem;margin-bottom:2rem;">Halaman yang kamu cari mungkin sudah dipindahkan atau tidak ada.</p>
    <div style="display:flex;justify-content:center;gap:.875rem;flex-wrap:wrap;">
      <a href="{{ route('home') }}" style="background:#1B4F9B;color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:50px;text-decoration:none;font-size:.875rem;">Ke Beranda</a>
      <a href="{{ route('courses.index') }}" style="border:2px solid #1B4F9B;color:#1B4F9B;font-weight:700;padding:.875rem 2rem;border-radius:50px;text-decoration:none;font-size:.875rem;">Lihat Kelas</a>
    </div>
  </div>
</div>
@endsection
