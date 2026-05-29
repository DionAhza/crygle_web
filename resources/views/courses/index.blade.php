@extends('layouts.app')
@section('title','Semua Course — Crygle Academy')
@section('content')

<section class="bg-gradient-to-br from-slate-900 to-blue-900 text-white py-14 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">
    <h1 class="font-display text-3xl lg:text-4xl font-bold mb-2">Semua Course</h1>
    <p class="text-blue-200 mb-6">Pilih skill yang ingin kamu kuasai dari {{ $courses->total() }} course tersedia</p>
    <form action="{{ route('courses.index') }}" method="GET" class="flex gap-2 max-w-lg" id="search-form">
      <div class="relative flex-1">
        <i class="bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari course atau topik..."
               class="w-full bg-white/10 border border-white/20 rounded-xl pl-10 pr-4 py-3 text-sm text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-white/30">
        @foreach(request()->except('q','page') as $k=>$v)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endforeach
      </div>
      <button class="bg-yellow-400 hover:bg-yellow-300 text-slate-900 font-semibold px-5 rounded-xl transition text-sm">Cari</button>
    </form>
  </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="flex flex-col lg:flex-row gap-8">

    {{-- SIDEBAR FILTER --}}
    <aside class="w-full lg:w-56 flex-shrink-0 space-y-4">
      <form id="filter-form" action="{{ route('courses.index') }}" method="GET">
        @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif

        {{-- Kategori --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-4">
          <h3 class="font-bold text-slate-700 text-xs uppercase tracking-wider mb-3">Kategori</h3>
          <div class="space-y-2">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="category" value="" class="accent-blue-600" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
              <span class="text-sm text-slate-600">Semua</span>
            </label>
            @foreach($categories as $cat)
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="category" value="{{ $cat->slug }}" class="accent-blue-600" {{ request('category')===$cat->slug ? 'checked' : '' }} onchange="this.form.submit()">
              <span class="text-sm text-slate-600">{{ $cat->icon }} {{ $cat->name }}</span>
            </label>
            @endforeach
          </div>
        </div>

        {{-- Level --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-4">
          <h3 class="font-bold text-slate-700 text-xs uppercase tracking-wider mb-3">Level</h3>
          <div class="space-y-2">
            @foreach(['' => 'Semua Level', 'beginner' => '🟢 Pemula', 'intermediate' => '🟡 Menengah', 'advanced' => '🔴 Mahir'] as $v=>$l)
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="level" value="{{ $v }}" class="accent-blue-600" {{ request('level','')===$v ? 'checked' : '' }} onchange="this.form.submit()">
              <span class="text-sm text-slate-600">{{ $l }}</span>
            </label>
            @endforeach
          </div>
        </div>

        {{-- Harga --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-4">
          <h3 class="font-bold text-slate-700 text-xs uppercase tracking-wider mb-3">Harga</h3>
          <div class="space-y-2">
            @foreach(['' => 'Semua', 'free' => '🎁 Gratis', 'paid' => '💳 Berbayar'] as $v=>$l)
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="type" value="{{ $v }}" class="accent-blue-600" {{ request('type','')===$v ? 'checked' : '' }} onchange="this.form.submit()">
              <span class="text-sm text-slate-600">{{ $l }}</span>
            </label>
            @endforeach
          </div>
        </div>

        @if(request()->hasAny(['category','level','type','q']))
        <a href="{{ route('courses.index') }}" class="block text-center text-sm text-red-500 hover:text-red-700 font-medium py-2 border border-red-200 rounded-xl transition">
          <i class="bi-x-circle mr-1"></i> Reset Filter
        </a>
        @endif
      </form>
    </aside>

    {{-- COURSE GRID --}}
    <div class="flex-1 min-w-0">
      <div class="flex items-center justify-between mb-5">
        <p class="text-sm text-slate-500"><strong class="text-slate-800">{{ $courses->total() }}</strong> course ditemukan</p>
        <select name="sort" form="filter-form" onchange="document.getElementById('filter-form').submit()"
                class="text-sm border border-slate-200 rounded-xl px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="latest" {{ request('sort','latest')==='latest' ? 'selected' : '' }}>Terbaru</option>
          <option value="popular" {{ request('sort')==='popular' ? 'selected' : '' }}>Terpopuler</option>
          <option value="rating" {{ request('sort')==='rating' ? 'selected' : '' }}>Rating Tertinggi</option>
          <option value="price_asc" {{ request('sort')==='price_asc' ? 'selected' : '' }}>Harga Terendah</option>
        </select>
      </div>

      @if($courses->isEmpty())
      <div class="bg-white rounded-2xl border border-slate-100 py-20 text-center">
        <p class="text-5xl mb-4">🔍</p>
        <p class="text-xl font-bold text-slate-700 mb-2">Course tidak ditemukan</p>
        <p class="text-slate-400 text-sm mb-5">Coba ubah filter atau kata kunci pencarian</p>
        <a href="{{ route('courses.index') }}" class="btn-primary inline-block text-sm">Lihat semua course</a>
      </div>
      @else
      <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach($courses as $course)
          @include('courses._card', ['course' => $course])
        @endforeach
      </div>
      @if($courses->hasPages())
      <div class="mt-8">{{ $courses->links() }}</div>
      @endif
      @endif
    </div>
  </div>
</div>
@endsection
