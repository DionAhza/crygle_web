<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Crygle Academy')</title>
  <meta name="description" content="@yield('meta_desc', 'Tempat Perjuangan Kreatif Anak Muda Dimulai. Belajar Design, Coding, dan Robotics.')">

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">

  <style>
    :root {
      --blue:     #1B4F9B;   /* navy biru dari PDF */
      --blue-mid: #2563C1;
      --blue-lt:  #EEF4FF;
      --yellow:   #F5A623;
      --text:     #1A1A2E;
      --muted:    #6B7280;
      --border:   #E5E7EB;
      --bg:       #F0F4F8;
    }
    body            { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text); background: #fff; }
    .nav-link       { color: #374151; font-weight: 500; font-size: 0.875rem; transition: color .15s; }
    .nav-link:hover { color: var(--blue); }
    .nav-link.active{ color: var(--blue); font-weight: 600; }
    .btn-primary    { background: var(--blue); color: #fff; font-weight: 600; padding: .625rem 1.5rem; border-radius: 50px; transition: background .2s, box-shadow .2s; }
    .btn-primary:hover { background: #143d7a; box-shadow: 0 4px 14px rgba(27,79,155,.35); }
    .btn-outline    { border: 2px solid var(--blue); color: var(--blue); font-weight: 600; padding: .5rem 1.4rem; border-radius: 50px; transition: all .2s; }
    .btn-outline:hover { background: var(--blue); color: #fff; }
    .badge-level    { display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .6rem; border-radius:50px; font-size:.7rem; font-weight:600; }
    .badge-basic    { background:#F0FDF4; color:#16A34A; }
    .badge-intermediate { background:#FFFBEB; color:#D97706; }
    .badge-advanced { background:#FEF2F2; color:#DC2626; }
    .star           { color: #F59E0B; }
    .card-course    { background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,.08); transition: box-shadow .2s, transform .2s; }
    .card-course:hover { box-shadow:0 8px 24px rgba(0,0,0,.12); transform:translateY(-2px); }
    .tab-active     { color: var(--blue); border-bottom: 2px solid var(--blue); font-weight: 600; }
    .tab-inactive   { color: var(--muted); border-bottom: 2px solid transparent; }
    .accordion-header { background: var(--blue); color: #fff; border-radius: 8px; }
    .accordion-open   { background: var(--blue); }
    .faq-q          { background: var(--blue); color: #fff; border-radius: 8px; padding: .875rem 1.25rem; font-weight:600; font-size:.9rem; display:flex; justify-content:space-between; align-items:center; cursor:pointer; }
    .price-strike   { color: #9CA3AF; text-decoration: line-through; font-size:.8rem; }
    .discount-badge { background: #DCFCE7; color: #16A34A; font-size:.65rem; font-weight:700; padding:.15rem .4rem; border-radius:4px; }
    /* Scrollbar thin */
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
    /* Dropdown */
    .dropdown-menu { position:absolute; top:calc(100% + 8px); left:0; background:#fff; border:1px solid var(--border); border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.12); min-width:200px; padding:.5rem; z-index:100; opacity:0; visibility:hidden; transition:all .15s; }
    .has-dropdown:hover .dropdown-menu { opacity:1; visibility:visible; }
    .dropdown-item { display:block; padding:.5rem .875rem; font-size:.85rem; color:#374151; border-radius:8px; transition:background .1s; }
    .dropdown-item:hover { background: var(--blue-lt); color: var(--blue); }
  </style>
  @stack('styles')
</head>
<body>

{{-- ════════════════════════ NAVBAR ════════════════════════ --}}
<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
       <img src="{{ asset('logo/crygle-logo.png') }}" class="h-8" alt="Crygle Logo">
      </a>

      {{-- Nav Links --}}
      <div class="hidden lg:flex items-center gap-7">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

        {{-- Course dropdown --}}
        <div class="relative has-dropdown">
          <button class="nav-link flex items-center gap-1 {{ request()->routeIs('courses.*') ? 'active' : '' }}">
            Course <i class="bi-chevron-down text-xs"></i>
          </button>
          <div class="dropdown-menu">
            <a href="{{ route('courses.index') }}" class="dropdown-item">Semua Course</a>
            <a href="{{ route('courses.index', ['category'=>'ui-ux-design']) }}" class="dropdown-item">Creative Design</a>
            <a href="{{ route('courses.index', ['category'=>'web-development']) }}" class="dropdown-item">Creative Coding</a>
            <a href="{{ route('courses.index', ['category'=>'mobile-development']) }}" class="dropdown-item">Creative Robotics</a>
          </div>
        </div>

        {{-- Bootcamp dropdown --}}
        <div class="relative has-dropdown">
          <button class="nav-link flex items-center gap-1">
            Bootcamp Intensif <i class="bi-chevron-down text-xs"></i>
          </button>
          <div class="dropdown-menu">
            <a href="#" class="dropdown-item">UI/UX Bootcamp</a>
            <a href="#" class="dropdown-item">Coding Bootcamp</a>
            <a href="#" class="dropdown-item">Robotics Bootcamp</a>
          </div>
        </div>

        <a href="#" class="nav-link">Mentor</a>
        <a href="#" class="nav-link">Tentang</a>
      </div>

      {{-- Auth --}}
      <div class="flex items-center gap-3">
        @auth
          <div class="relative has-dropdown">
            <button class="flex items-center gap-2 py-1 px-2 rounded-xl hover:bg-gray-50 transition">
              <img src="{{ auth()->user()->avatarUrl() }}" class="w-8 h-8 rounded-full object-cover">
              <span class="text-sm font-medium text-gray-700 hidden md:block">{{ Str::limit(auth()->user()->name, 14) }}</span>
              <i class="bi-chevron-down text-gray-400 text-xs hidden md:block"></i>
            </button>
            <div class="dropdown-menu right-0 left-auto">
              <div class="px-3 py-2 border-b border-gray-100 mb-1">
                <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
              </div>
              @if(auth()->user()->isAdmin() || auth()->user()->isInstructor())
              <a href="{{ route('dashboard') }}" class="dropdown-item">
                <i class="bi-grid mr-1.5 text-blue-500"></i> Kelas Saya
              </a>
              @else
              <a href="{{ route('dashboard') }}" class="dropdown-item">
                <i class="bi-collection-play mr-1.5 text-blue-500"></i> Kelas Saya
              </a>
              @endif
              @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                <i class="bi-shield-check mr-1.5 text-emerald-500"></i> Admin Panel
              </a>
              @endif
              @if(auth()->user()->isInstructor())
              <a href="{{ route('instructor.dashboard') }}" class="dropdown-item">
                <i class="bi-easel2 mr-1.5 text-purple-500"></i> Studio Instructor
              </a>
              @endif
              <div class="border-t border-gray-100 mt-1 pt-1">
                <form action="{{ route('logout') }}" method="POST">@csrf
                  <button class="dropdown-item w-full text-left text-red-600 hover:bg-red-50">
                    <i class="bi-box-arrow-right mr-1.5"></i> Keluar
                  </button>
                </form>
              </div>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="nav-link hidden sm:block">Masuk</a>
          <a href="{{ route('register') }}" class="btn-primary text-sm">Daftar</a>
        @endauth

        <button id="mob-btn" class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
          <i class="bi-list text-xl"></i>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile menu --}}
  <div id="mob-menu" class="hidden lg:hidden border-t border-gray-100 px-5 py-4 space-y-1 bg-white">
    <a href="{{ route('home') }}" class="block py-2.5 text-sm font-medium text-gray-700">Home</a>
    <a href="{{ route('courses.index') }}" class="block py-2.5 text-sm font-medium text-gray-700">Course</a>
    <a href="#" class="block py-2.5 text-sm font-medium text-gray-700">Bootcamp Intensif</a>
    <a href="#" class="block py-2.5 text-sm font-medium text-gray-700">Mentor</a>
    <a href="#" class="block py-2.5 text-sm font-medium text-gray-700">Tentang</a>
    @guest
    <div class="flex gap-2 pt-2">
      <a href="{{ route('login') }}" class="btn-outline text-sm flex-1 text-center py-2.5">Masuk</a>
      <a href="{{ route('register') }}" class="btn-primary text-sm flex-1 text-center py-2.5">Daftar</a>
    </div>
    @endguest
  </div>
</nav>

{{-- Flash messages --}}
@if(session('success') || session('error') || session('info'))
<div class="max-w-7xl mx-auto px-6 lg:px-8 pt-4" id="flash-container">
  @if(session('success'))
  <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm mb-2">
    <i class="bi-check-circle-fill text-green-500 flex-shrink-0"></i>
    <span class="flex-1">{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-600 ml-auto"><i class="bi-x"></i></button>
  </div>
  @endif
  @if(session('error'))
  <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm mb-2">
    <i class="bi-exclamation-circle-fill text-red-500 flex-shrink-0"></i>
    <span class="flex-1">{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 ml-auto"><i class="bi-x"></i></button>
  </div>
  @endif
  @if(session('info'))
  <div class="flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl px-4 py-3 text-sm mb-2">
    <i class="bi-info-circle-fill text-blue-500 flex-shrink-0"></i>
    <span class="flex-1">{{ session('info') }}</span>
    <button onclick="this.parentElement.remove()" class="text-blue-400 hover:text-blue-600 ml-auto"><i class="bi-x"></i></button>
  </div>
  @endif
</div>
@endif

<main>@yield('content')</main>

{{-- ════════════════════ FOOTER ════════════════════ --}}
<footer style="background:#1B4F9B;" class="text-white mt-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-14 pb-8">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

      {{-- Brand --}}
      <div>
        <div class="flex items-center gap-2.5 mb-4">
          <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center">
            <i class="bi-book-half text-lg text-yellow-300"></i>
          </div>
          <div>
            <p class="font-bold text-white text-sm leading-none">Crygle</p>
            <p class="font-bold text-white text-sm leading-none">Academy</p>
          </div>
        </div>
        <p class="text-blue-200 text-sm leading-relaxed mb-5">
          Belajar kreatif digital dari nol untuk masa depan yang lebih siap.
        </p>
        <div class="space-y-2.5">
          <a href="mailto:tanya@crygleacademy.com" class="flex items-center gap-2.5 text-blue-200 text-sm hover:text-white transition">
            <div class="w-7 h-7 border border-blue-400/40 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="bi-envelope text-xs"></i>
            </div>
            tanya@crygleacademy.com
          </a>
          <div class="flex items-start gap-2.5 text-blue-200 text-sm">
            <div class="w-7 h-7 border border-blue-400/40 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
              <i class="bi-geo-alt text-xs"></i>
            </div>
            <span>Jl. Cipta Karya, Sidomulyo Bar., Kec. Tampan, Kota Pekanbaru, Riau 28293</span>
          </div>
        </div>
      </div>

      {{-- Navigasi --}}
      <div>
        <h4 class="font-bold text-white text-xs uppercase tracking-widest mb-5">NAVIGASI</h4>
        <ul class="space-y-3 text-sm text-blue-200">
          <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
          <li><a href="#" class="hover:text-white transition">E-Learning</a></li>
          <li><a href="{{ route('courses.index') }}" class="hover:text-white transition">Courses & Classes</a></li>
          <li><a href="#" class="hover:text-white transition">Mentor</a></li>
          <li><a href="#" class="hover:text-white transition">Testimoni</a></li>
        </ul>
      </div>

      {{-- Program --}}
      <div>
        <h4 class="font-bold text-white text-xs uppercase tracking-widest mb-5">PROGRAM</h4>
        <ul class="space-y-3 text-sm text-blue-200">
          <li><a href="{{ route('courses.index', ['category'=>'ui-ux-design']) }}" class="hover:text-white transition">Creative Design</a></li>
          <li><a href="{{ route('courses.index', ['category'=>'web-development']) }}" class="hover:text-white transition">Creative Coding</a></li>
          <li><a href="{{ route('courses.index', ['category'=>'mobile-development']) }}" class="hover:text-white transition">Creative Robotics</a></li>
          <li><a href="#" class="hover:text-white transition">Consulting</a></li>
        </ul>
      </div>

      {{-- Dukungan --}}
      <div>
        <h4 class="font-bold text-white text-xs uppercase tracking-widest mb-5">DUKUNGAN</h4>
        <ul class="space-y-3 text-sm text-blue-200">
          <li><a href="#" class="hover:text-white transition">Pusat Bantuan</a></li>
          <li><a href="#" class="hover:text-white transition">Kontak Kami</a></li>
          <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
          <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
          <li><a href="#" class="hover:text-white transition">FAQ</a></li>
        </ul>
      </div>
    </div>

    <div class="border-t border-blue-700/60 pt-6 text-center text-sm text-blue-300">
      © {{ date('Y') }} CRYGLE Academy. All rights reserved.
    </div>
  </div>
</footer>

<script>
  // Mobile toggle
  document.getElementById('mob-btn')?.addEventListener('click', () => {
    document.getElementById('mob-menu').classList.toggle('hidden');
  });
  // Auto dismiss flash
  setTimeout(() => document.getElementById('flash-container')?.remove(), 5000);
</script>
@stack('scripts')
</body>
</html>
