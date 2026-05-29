@extends('layouts.app')
@section('title', '403 — Akses Ditolak')
@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
  <div class="text-center max-w-md">
    <p class="text-8xl font-black text-red-100 mb-2 select-none">403</p>
    <h1 class="text-2xl font-bold text-slate-800 mb-2">Akses Ditolak</h1>
    <p class="text-slate-500 text-sm mb-8">Kamu tidak memiliki izin untuk mengakses halaman ini.</p>
    <div class="flex flex-wrap justify-center gap-3">
      <a href="{{ route('home') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-full transition text-sm">Kembali ke Beranda</a>
    </div>
  </div>
</div>
@endsection
