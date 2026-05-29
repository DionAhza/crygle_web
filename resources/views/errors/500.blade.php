@extends('layouts.app')
@section('title', '500 — Server Error')
@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
  <div class="text-center max-w-md">
    <p class="text-8xl font-black text-amber-100 mb-2 select-none">500</p>
    <h1 class="text-2xl font-bold text-slate-800 mb-2">Terjadi Kesalahan Server</h1>
    <p class="text-slate-500 text-sm mb-8">Maaf, terjadi kesalahan pada server kami. Tim teknis sudah diberitahu.</p>
    <a href="{{ route('home') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-full transition text-sm inline-block">Kembali ke Beranda</a>
  </div>
</div>
@endsection
