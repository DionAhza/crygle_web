@extends('layouts.app')
@section('title','Crygle Academy — Belajar Skill Digital')
@section('content')

{{-- ═══════════════════════════════════════════════════ HERO ══ --}}
<section class="relative bg-gradient-to-br from-slate-950 via-blue-950 to-blue-900 text-white overflow-hidden">
  <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 25% 50%, #1B6EF3 0%, transparent 60%),radial-gradient(circle at 75% 20%, #8B5CF6 0%, transparent 50%)"></div>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <span class="inline-flex items-center gap-2 bg-blue-500/20 border border-blue-400/30 text-blue-200 text-xs font-semibold px-3.5 py-1.5 rounded-full mb-6">
          🔥 Platform Belajar #1 untuk Generasi Digital Indonesia
        </span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold leading-[1.05] mb-5">
          Tempat Perjuangan<br>
          <span class="text-yellow-400">Kreatif Anak Muda</span><br>
          Dimulai
        </h1>
        <p class="text-blue-200 text-lg leading-relaxed mb-8 max-w-lg">
          Kuasai skill digital dari mentor berpengalaman. Web dev, desain, marketing, data science — semua ada di sini.
        </p>
        <div class="flex flex-wrap gap-3 mb-10">
          <a href="{{ route('courses.index') }}" class="bg-yellow-400 hover:bg-yellow-300 text-slate-900 font-bold px-7 py-3.5 rounded-full transition shadow-lg shadow-yellow-400/20 flex items-center gap-2">
            Explore Course <i class="bi-arrow-right"></i>
          </a>
          <a href="{{ route('register') }}" class="border border-white/20 hover:bg-white/10 text-white font-semibold px-7 py-3.5 rounded-full transition flex items-center gap-2">
            Daftar Gratis <i class="bi-person-plus"></i>
          </a>
        </div>
        <div class="flex items-center gap-8 pt-8 border-t border-white/10">
          @foreach([[$stats['students'].'K+','Pelajar Aktif'],[$stats['courses'].'+','Course Tersedia'],[$stats['reviews'].'+','Ulasan Positif']] as [$val,$lbl])
          <div><p class="text-2xl font-bold text-white">{{ $val }}</p><p class="text-blue-300 text-xs mt-0.5">{{ $lbl }}</p></div>
          @endforeach
        </div>
      </div>

      {{-- Visual --}}
      <div class="hidden lg:grid grid-cols-2 gap-4">
        <div class="space-y-4">
          <div class="rounded-2xl overflow-hidden aspect-video bg-blue-800/20">
            <img src="{{ asset('images/program-image-1.png') }}" class="w-full h-full object-cover opacity-90">
          </div>
          <div class="rounded-2xl overflow-hidden h-32 bg-blue-800/20">
            <img src="{{ asset('images/program-image-2.png') }}" class="w-full h-full object-cover opacity-90">
          </div>
        </div>
        <div class="mt-6 space-y-4">
          <div class="rounded-2xl overflow-hidden h-32 bg-blue-800/20">
            <img src="{{ asset('images/program-image-3.png') }}" class="w-full h-full object-cover opacity-90">
          </div>
          {{-- Floating card --}}
          <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
            <p class="text-xs text-blue-200 font-semibold mb-2.5">⚡ Course Populer</p>
            @foreach($featured->take(3) as $c)
            <div class="flex items-center gap-2 py-1.5 border-b border-white/5 last:border-0">
              <span class="text-base">{{ $c->category?->icon ?? '📚' }}</span>
              <p class="text-xs text-white truncate flex-1">{{ $c->title }}</p>
              <span class="text-xs text-yellow-300 font-semibold">{{ $c->formattedPrice() }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ KATEGORI ══ --}}
<section class="py-16 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-10">
      <h2 class="section-title mb-2">Belajar Apa Hari Ini?</h2>
      <p class="text-slate-500">Pilih skill yang ingin kamu kuasai</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
      @foreach($categories as $cat)
      <a href="{{ route('courses.index',['category'=>$cat->slug]) }}"
         class="bg-white hover:bg-blue-50 border border-slate-100 hover:border-blue-200 rounded-2xl p-5 text-center transition-all hover:-translate-y-1 group cursor-pointer">
        <div class="text-4xl mb-3">{{ $cat->icon }}</div>
        <p class="font-semibold text-slate-800 text-sm group-hover:text-blue-700 transition-colors">{{ $cat->name }}</p>
        <p class="text-xs text-slate-400 mt-1">{{ $cat->courses_count }} course</p>
      </a>
      @endforeach
    </div>
  </div>
</section>

{{-- ════════════════════════ FEATURED COURSES ══ --}}
<section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-end justify-between mb-10">
      <div>
        <h2 class="section-title mb-1">Course Unggulan</h2>
        <p class="text-slate-500">Dipilih oleh ribuan pelajar aktif</p>
      </div>
      <a href="{{ route('courses.index') }}" class="text-blue-600 font-semibold text-sm hover:underline hidden md:flex items-center gap-1">
        Lihat semua <i class="bi-arrow-right"></i>
      </a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($featured as $course)
      @include('courses._card', ['course' => $course])
      @endforeach
    </div>
    <div class="text-center mt-8 md:hidden">
      <a href="{{ route('courses.index') }}" class="btn-outline inline-block">Lihat Semua Course</a>
    </div>
  </div>
</section>

{{-- ════════════════════════ WHY CRYGLE ══ --}}
<section class="py-16 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-12">
      <h2 class="section-title mb-2">Kenapa Crygle Academy?</h2>
      <p class="text-slate-500 max-w-xl mx-auto">Kami bukan sekadar platform belajar. Kami adalah komunitas yang mendorong kamu berkembang.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach([
        ['🎯','Mentor Expert','Belajar dari praktisi industri dengan pengalaman rata-rata 7+ tahun.'],
        ['📱','Belajar Fleksibel','Akses materi kapan saja, di mana saja, dari perangkat apapun.'],
        ['🏆','Sertifikat Resmi','Dapatkan sertifikat yang diakui oleh ratusan perusahaan mitra.'],
        ['👥','Komunitas Aktif','Bergabung dengan 5.000+ pelajar dan bangun network kariermu.'],
      ] as [$icon,$title,$desc])
      <div class="bg-white rounded-2xl border border-slate-100 p-6 text-center hover:shadow-md transition">
        <div class="text-4xl mb-4">{{ $icon }}</div>
        <h3 class="font-bold text-slate-800 mb-2">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ════════════════════════ CTA ══ --}}
<section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
  <div class="max-w-4xl mx-auto">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-3xl p-12 text-white text-center shadow-2xl shadow-blue-200">
      <h2 class="font-display text-3xl lg:text-4xl font-bold mb-4">Siap Mulai Perjalananmu?</h2>
      <p class="text-blue-100 text-lg mb-8 max-w-lg mx-auto">Ribuan pelajar sudah memulai. Sekarang giliran kamu.</p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-300 text-slate-900 font-bold px-8 py-4 rounded-full transition shadow-lg">
          Mulai Belajar Gratis
        </a>
        <a href="{{ route('courses.index') }}" class="border border-white/30 hover:bg-white/10 text-white font-semibold px-8 py-4 rounded-full transition">
          Lihat Course
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
