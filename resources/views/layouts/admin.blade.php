<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Admin') — Crygle Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>body{font-family:'Plus Jakarta Sans',sans-serif;} .badge{@apply inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold;}</style>
</head>
<body class="bg-slate-100 text-slate-900">
<div class="flex min-h-screen">

  {{-- SIDEBAR --}}
  <aside class="w-64 bg-slate-900 text-white flex-shrink-0 flex flex-col">
    <div class="px-5 py-5 border-b border-slate-800">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-sm">C</div>
        <div><p class="font-bold text-sm">Crygle</p><p class="text-xs text-slate-400">Admin Panel</p></div>
      </div>
    </div>

    <nav class="flex-1 px-3 py-5 space-y-0.5">
      @php
        $links = [
          ['route'=>'admin.dashboard',         'icon'=>'bi-grid-1x2', 'label'=>'Dashboard'],
          ['route'=>'admin.courses.index',      'icon'=>'bi-play-circle', 'label'=>'Courses'],
          ['route'=>'admin.users.index',        'icon'=>'bi-people', 'label'=>'Users'],
          ['route'=>'admin.transactions.index', 'icon'=>'bi-receipt', 'label'=>'Transaksi'],
        ];
      @endphp
      @foreach($links as $l)
      <a href="{{ route($l['route']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition
        {{ request()->routeIs($l['route']) ? 'bg-blue-700 text-white font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="{{ $l['icon'] }}"></i>{{ $l['label'] }}
      </a>
      @endforeach
      <div class="border-t border-slate-800 pt-3 mt-3">
        <a href="{{ route('instructor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition">
          <i class="bi-easel2"></i> Studio Instructor
        </a>
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition">
          <i class="bi-box-arrow-up-right"></i> Lihat Website
        </a>
      </div>
    </nav>

    <div class="px-4 py-4 border-t border-slate-800">
      <div class="flex items-center gap-2.5">
        <img src="{{ auth()->user()->avatarUrl() }}" class="w-9 h-9 rounded-full object-cover">
        <div class="flex-1 min-w-0"><p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p><p class="text-xs text-slate-400">Administrator</p></div>
        <form action="{{ route('logout') }}" method="POST">@csrf
          <button class="text-slate-400 hover:text-red-400 transition"><i class="bi-box-arrow-right"></i></button>
        </form>
      </div>
    </div>
  </aside>

  {{-- MAIN --}}
  <div class="flex-1 flex flex-col min-w-0">
    <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
      <div>
        <h1 class="font-bold text-slate-800 text-lg">@yield('page-title','Dashboard')</h1>
        <p class="text-xs text-slate-400">@yield('page-sub','')</p>
      </div>
      <span class="text-xs text-slate-400 hidden md:block">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
    </header>

    @if(session('success')||session('error'))
    <div class="px-6 pt-4">
      @if(session('success'))<div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm flex items-center gap-2"><i class="bi-check-circle-fill text-emerald-500"></i>{{ session('success') }}</div>@endif
      @if(session('error'))<div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm flex items-center gap-2"><i class="bi-exclamation-circle-fill text-red-500"></i>{{ session('error') }}</div>@endif
    </div>
    @endif

    <main class="flex-1 p-6 overflow-auto">@yield('content')</main>
  </div>
</div>
@stack('scripts')
</body>
</html>
