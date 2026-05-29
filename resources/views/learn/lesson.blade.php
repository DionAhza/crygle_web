<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>{{ $lesson->title }} — Crygle Academy</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>
    body{font-family:'Plus Jakarta Sans',sans-serif;}
    .sidebar{overflow-y:auto;scrollbar-width:thin;scrollbar-color:#334155 transparent;}
    .sidebar::-webkit-scrollbar{width:4px;}
    .sidebar::-webkit-scrollbar-track{background:transparent;}
    .sidebar::-webkit-scrollbar-thumb{background:#334155;border-radius:4px;}
  </style>
</head>
<body class="bg-slate-950 text-white flex flex-col h-full min-h-screen">

{{-- TOP NAV --}}
<header class="bg-slate-900 border-b border-slate-800 px-4 py-3 flex items-center gap-3 flex-shrink-0 z-10">
  <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition p-1.5 hover:bg-slate-800 rounded-lg">
    <i class="bi-arrow-left text-lg"></i>
  </a>
  <div class="flex-1 min-w-0">
    <p class="text-xs text-slate-400 truncate">{{ $course->title }}</p>
    <p class="font-semibold text-sm truncate">{{ $lesson->title }}</p>
  </div>
  {{-- Progress bar --}}
  <div class="hidden md:flex items-center gap-3">
    <div class="w-32 bg-slate-700 rounded-full h-1.5">
      <div class="bg-blue-500 h-1.5 rounded-full transition-all" style="width:{{ $progress }}%"></div>
    </div>
    <span class="text-xs text-slate-400">{{ $progress }}%</span>
  </div>
  <a href="{{ route('courses.show', $course) }}" class="text-xs text-slate-400 hover:text-white transition hidden md:block">
    <i class="bi-info-circle mr-1"></i>Info Course
  </a>
</header>

<div class="flex flex-1 overflow-hidden">

  {{-- SIDEBAR --}}
  <aside class="hidden lg:flex flex-col w-80 bg-slate-900 border-r border-slate-800 flex-shrink-0 sidebar">
    {{-- Header --}}
    <div class="px-4 py-4 border-b border-slate-800 sticky top-0 bg-slate-900 z-10">
      <h3 class="font-bold text-sm mb-2">Kurikulum Course</h3>
      @php
        $totalL = $allLessons->count();
        $doneL  = count($completedIds);
      @endphp
      <div class="flex justify-between text-xs text-slate-400 mb-1.5">
        <span>{{ $doneL }}/{{ $totalL }} selesai</span>
        <span class="text-blue-400 font-semibold">{{ $totalL > 0 ? round($doneL/$totalL*100) : 0 }}%</span>
      </div>
      <div class="w-full bg-slate-700 rounded-full h-1.5">
        <div class="bg-blue-500 h-1.5 rounded-full" style="width:{{ $totalL > 0 ? round($doneL/$totalL*100) : 0 }}%"></div>
      </div>
    </div>

    {{-- Sections & lessons --}}
    @foreach($course->sections as $section)
    <div>
      <div class="px-4 py-3 bg-slate-800/50 border-y border-slate-800/80">
        <p class="text-xs font-bold text-slate-300 uppercase tracking-wider">{{ $section->title }}</p>
        <p class="text-xs text-slate-500 mt-0.5">{{ $section->lessons->count() }} lesson</p>
      </div>
      @foreach($section->lessons as $les)
      @php
        $isActive = $les->id === $lesson->id;
        $isDone   = in_array($les->id, $completedIds);
      @endphp
      <a href="{{ route('learn.lesson', [$enrollment, $les]) }}"
         class="flex items-center gap-3 px-4 py-3 border-b border-slate-800/40 transition group
                {{ $isActive ? 'bg-blue-700/20 border-l-2 border-l-blue-500' : 'hover:bg-slate-800' }}">
        <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs
          {{ $isActive ? 'bg-blue-500 text-white' : ($isDone ? 'bg-emerald-500 text-white' : 'bg-slate-700 text-slate-400') }}">
          @if($isActive)<i class="bi-play-fill"></i>
          @elseif($isDone)<i class="bi-check-lg"></i>
          @else<i class="bi-play text-xs"></i>@endif
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-xs {{ $isActive ? 'text-white font-semibold' : 'text-slate-300 group-hover:text-white' }} truncate transition">{{ $les->title }}</p>
          @if($les->duration_seconds > 0)<p class="text-xs text-slate-500">{{ $les->durationFormatted() }}</p>@endif
        </div>
        @if($isDone && !$isActive)<i class="bi-check-circle-fill text-emerald-500 text-xs flex-shrink-0"></i>@endif
      </a>
      @endforeach
    </div>
    @endforeach
  </aside>

  {{-- MAIN CONTENT --}}
  <main class="flex-1 overflow-y-auto">

    {{-- VIDEO --}}
    <div class="bg-black">
      @if($lesson->embedUrl())
      <div class="aspect-video w-full max-w-5xl mx-auto">
        <iframe src="{{ $lesson->embedUrl() }}" class="w-full h-full" frameborder="0"
                allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture" allowfullscreen></iframe>
      </div>
      @else
      <div class="aspect-video w-full max-w-5xl mx-auto flex items-center justify-center bg-slate-900">
        <div class="text-center text-slate-500">
          <i class="bi-camera-video-off text-5xl mb-3"></i>
          <p>Video belum tersedia</p>
        </div>
      </div>
      @endif
    </div>

    {{-- LESSON INFO --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

      {{-- Navigation & actions --}}
      <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <p class="text-sm text-slate-400">{{ $lesson->section->title }}</p>
        <div class="flex items-center gap-2 flex-wrap">
          {{-- Prev --}}
          @if($prevLesson)
          <a href="{{ route('learn.lesson',[$enrollment,$prevLesson]) }}"
             class="flex items-center gap-1.5 text-sm text-slate-400 hover:text-white border border-slate-700 hover:border-slate-500 px-3 py-2 rounded-xl transition">
            <i class="bi-arrow-left"></i> Sebelumnya
          </a>
          @endif

          {{-- Mark complete --}}
          @php $isDone = in_array($lesson->id, $completedIds); @endphp
          @if(!$isDone)
          <form action="{{ route('learn.complete',[$enrollment,$lesson]) }}" method="POST">
            @csrf
            <button class="flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
              <i class="bi-check-circle"></i> Tandai Selesai
            </button>
          </form>
          @else
          <span class="flex items-center gap-1.5 bg-emerald-600/20 text-emerald-400 text-sm font-semibold px-4 py-2 rounded-xl">
            <i class="bi-check-circle-fill"></i> Selesai
          </span>
          @endif

          {{-- Next --}}
          @if($nextLesson)
          <a href="{{ route('learn.lesson',[$enrollment,$nextLesson]) }}"
             class="flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            Berikutnya <i class="bi-arrow-right"></i>
          </a>
          @endif
        </div>
      </div>

      {{-- Title --}}
      <h1 class="text-2xl font-bold text-white mb-2">{{ $lesson->title }}</h1>
      @if($lesson->duration_seconds > 0)
        <p class="text-slate-400 text-sm mb-6"><i class="bi-clock mr-1"></i>{{ $lesson->durationFormatted() }}</p>
      @endif

      {{-- Notes --}}
      @if($lesson->notes)
      <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 mb-6">
        <h3 class="font-bold text-slate-200 text-sm mb-3 flex items-center gap-2"><i class="bi-journal-text text-blue-400"></i>Catatan Lesson</h3>
        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $lesson->notes }}</p>
      </div>
      @endif

      {{-- Overall progress --}}
      <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">
        <div class="flex items-center justify-between text-sm mb-2">
          <span class="text-slate-400">Progress keseluruhan</span>
          <span class="font-bold text-blue-400">{{ $progress }}%</span>
        </div>
        <div class="w-full bg-slate-800 rounded-full h-2 mb-2">
          <div class="bg-blue-500 h-2 rounded-full transition-all" style="width:{{ $progress }}%"></div>
        </div>
        <p class="text-xs text-slate-500">{{ count($completedIds) }} dari {{ $allLessons->count() }} lesson selesai</p>

        @if($progress >= 100)
        <div class="mt-4 bg-emerald-600/20 border border-emerald-500/30 rounded-xl p-4 text-center">
          <p class="text-emerald-400 font-bold">🎉 Selamat! Kamu telah menyelesaikan course ini!</p>
          <a href="{{ route('courses.show', $course) }}" class="text-xs text-emerald-300 hover:underline mt-1 inline-block">Lihat halaman course →</a>
        </div>
        @endif
      </div>
    </div>
  </main>
</div>
</body>
</html>
