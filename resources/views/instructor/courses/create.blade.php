@extends('layouts.instructor')
@section('title','Buat Course')
@section('page-title','Buat Course Baru')
@section('page-sub','Isi semua informasi course dengan lengkap')
@section('content')

<div class="max-w-2xl">
  @if($errors->any())
  <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5 space-y-1">
    @foreach($errors->all() as $e)<p class="text-red-700 text-sm flex items-center gap-2"><i class="bi-exclamation-circle text-red-400"></i>{{ $e }}</p>@endforeach
  </div>
  @endif

  <form action="{{ route('instructor.courses.store') }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-5 space-y-4">
      <h3 class="font-bold text-slate-700 text-xs uppercase tracking-wider border-b border-slate-100 pb-3">Informasi Dasar</h3>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Course *</label>
        <input type="text" name="title" value="{{ old('title') }}" required
               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="Contoh: Laravel 11 Masterclass: Dari Nol ke Full-Stack">
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori</label>
          <select name="category_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Pilih kategori...</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Level *</label>
          <select name="level" required class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="beginner" {{ old('level')=='beginner' ? 'selected' : '' }}>🟢 Pemula</option>
            <option value="intermediate" {{ old('level')=='intermediate' ? 'selected' : '' }}>🟡 Menengah</option>
            <option value="advanced" {{ old('level')=='advanced' ? 'selected' : '' }}>🔴 Mahir</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga (Rp) *</label>
          <input type="number" name="price" value="{{ old('price',0) }}" min="0" required
                 class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0 = Gratis">
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Diskon (Rp)</label>
          <input type="number" name="discount_price" value="{{ old('discount_price') }}" min="0"
                 class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Opsional">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Bahasa *</label>
        <input type="text" name="language" value="{{ old('language','Indonesia') }}" required
               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">URL Thumbnail</label>
        <input type="url" name="thumbnail" value="{{ old('thumbnail') }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="https://...">
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">URL Trailer (YouTube)</label>
        <input type="url" name="trailer_url" value="{{ old('trailer_url') }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="https://youtube.com/watch?v=...">
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi *</label>
        <textarea name="description" rows="5" required
                  class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                  placeholder="Jelaskan tentang course ini...">{{ old('description') }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Yang Akan Dipelajari</label>
        <textarea name="what_you_learn" rows="5"
                  class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                  placeholder="Satu poin per baris:&#10;Memahami routing Laravel&#10;Membuat REST API...">{{ old('what_you_learn') }}</textarea>
        <p class="text-xs text-slate-400 mt-1">Satu poin per baris</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Prasyarat</label>
        <textarea name="requirements" rows="3"
                  class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                  placeholder="Satu syarat per baris...">{{ old('requirements') }}</textarea>
      </div>
    </div>

    <div class="flex gap-3">
      <button type="submit" class="bg-purple-700 hover:bg-purple-800 text-white font-bold px-6 py-3 rounded-full transition">Simpan Course</button>
      <a href="{{ route('instructor.dashboard') }}" class="border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold px-6 py-3 rounded-full transition">Batal</a>
    </div>
  </form>
</div>
@endsection
