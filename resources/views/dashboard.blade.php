@extends('layouts.app')
@section('title','Dashboard — Crygle Academy')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Header --}}
  <div class="flex items-center gap-4 mb-8">
    <img src="{{ auth()->user()->avatarUrl() }}" class="w-14 h-14 rounded-full object-cover ring-4 ring-blue-100">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Halo, {{ auth()->user()->name }} 👋</h1>
      <p class="text-slate-500 text-sm">Lanjutkan belajar dan raih tujuanmu hari ini!</p>
    </div>
  </div>

  {{-- Stats --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
    @foreach([
      ['bi-collection-play','blue',  'Course Diikuti', $stats['total']],
      ['bi-trophy',         'amber', 'Selesai',        $stats['completed']],
      ['bi-lightning',      'blue',  'Sedang Berjalan',$stats['ongoing']],
      ['bi-award',          'emerald','Sertifikat',    $stats['completed']],
    ] as [$icon,$color,$label,$val])
    <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
      <div class="w-10 h-10 rounded-xl bg-{{ $color }}-100 text-{{ $color }}-600 flex items-center justify-center text-lg mb-3">
        <i class="{{ $icon }}"></i>
      </div>
      <p class="text-2xl font-bold text-slate-800">{{ $val }}</p>
      <p class="text-xs text-slate-400 mt-0.5">{{ $label }}</p>
    </div>
    @endforeach
  </div>

  {{-- Course list --}}
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-slate-900">📚 Course Saya</h2>
    <a href="{{ route('courses.index') }}" class="text-blue-600 font-semibold text-sm hover:underline">+ Tambah Course</a>
  </div>

  @if($enrollments->isEmpty())
  <div class="bg-white rounded-2xl border border-dashed border-slate-200 py-20 text-center">
    <p class="text-5xl mb-4">📭</p>
    <p class="text-xl font-bold text-slate-700 mb-2">Belum ada course</p>
    <p class="text-slate-400 text-sm mb-6">Mulai belajar dengan mendaftar course favoritmu</p>
    <a href="{{ route('courses.index') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold px-6 py-3 rounded-full transition inline-block">Explore Course</a>
  </div>
  @else
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($enrollments as $enrollment)
    @php
      $course = $enrollment->course;
      $pct    = $enrollment->progressPercent();
      $next   = $enrollment->nextLesson();
      $first  = $course->sections->first()?->lessons->first();
      $target = $next ?? $first;
    @endphp
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
      <div class="h-36 overflow-hidden relative">
        <img src="{{ $course->thumbnailUrl() }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        @if($pct >= 100)
          <span class="absolute top-2 right-2 badge bg-emerald-500 text-white text-xs">✅ Selesai</span>
        @elseif($pct > 0)
          <span class="absolute top-2 right-2 badge bg-blue-600 text-white text-xs">▶ On Progress</span>
        @else
          <span class="absolute top-2 right-2 badge bg-slate-600 text-white text-xs">Baru</span>
        @endif
      </div>
      <div class="p-4 flex flex-col flex-1">
        @if($course->category)
          <span class="text-xs font-semibold text-blue-600 mb-1">{{ $course->category->icon }} {{ $course->category->name }}</span>
        @endif
        <h3 class="font-bold text-slate-800 text-sm line-clamp-2 flex-1 mb-3">{{ $course->title }}</h3>

        {{-- Progress --}}
        <div class="mb-3">
          <div class="flex justify-between text-xs text-slate-400 mb-1">
            <span>Progress</span>
            <span class="font-semibold {{ $pct >= 100 ? 'text-emerald-600' : 'text-blue-700' }}">{{ $pct }}%</span>
          </div>
          <div class="w-full bg-slate-100 rounded-full h-1.5">
            <div class="h-1.5 rounded-full transition-all {{ $pct >= 100 ? 'bg-emerald-500' : 'bg-blue-600' }}" style="width:{{ $pct }}%"></div>
          </div>
        </div>

        @if($target)
        <a href="{{ route('learn.lesson', [$enrollment, $target]) }}"
           class="block text-center text-sm font-bold py-2.5 rounded-xl transition
                  {{ $pct >= 100 ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-blue-700 text-white hover:bg-blue-800' }}">
          {{ $pct == 0 ? '▶ Mulai Belajar' : ($pct >= 100 ? '🔁 Ulangi' : '▶ Lanjut') }}
        </a>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
@endsection
