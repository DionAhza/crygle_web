@extends('layouts.app')
@section('title','403 — Akses Ditolak')
@section('content')
<div style="min-height:65vh;display:flex;align-items:center;justify-content:center;padding:3rem 1.5rem;text-align:center;">
  <div>
    <p style="font-size:7rem;font-weight:900;color:#FEF2F2;line-height:1;margin-bottom:.5rem;letter-spacing:-4px;">403</p>
    <h1 style="font-size:1.5rem;font-weight:800;color:#1A1A2E;margin-bottom:.75rem;">Akses Ditolak</h1>
    <p style="color:#6B7280;font-size:.9rem;margin-bottom:2rem;">Kamu tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ route('home') }}" style="background:#1B4F9B;color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:50px;text-decoration:none;font-size:.875rem;">Kembali ke Beranda</a>
  </div>
</div>
@endsection
