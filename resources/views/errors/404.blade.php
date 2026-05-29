@extends('layouts.app')
@section('title', '404 — Halaman Tidak Ditemukan')
@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
  <div class="text-center max-w-md">
    <p class="text-8xl font-black text-blue-100 mb-2 select-none">404</p>
    <h1 class="text-2xl font-bold text-slate-800 mb-2">Halaman tidak ditemukan</h1>
    <p class="text-slate-500 text-sm mb-8">Halaman yang kamu cari mungkin sudah dipindahkan atau tidak pernah ada.</p>
    <div class="flex flex-wrap justify-center gap-3">
      <a href="{{ route('home') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-full transition text-sm">Kembali ke Beranda</a>
      <a href="{{ route('courses.index') }}" class="border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold px-6 py-3 rounded-full transition text-sm">Lihat Course</a>
    </div>
  </div>
</div>
@endsection
