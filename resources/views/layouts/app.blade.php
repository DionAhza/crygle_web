<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Crygle Academy — Belajar Skill Digital')</title>
  <meta name="description" content="@yield('meta_desc', 'Platform belajar skill digital terbaik. Kuasai web dev, desain, marketing, dan data science dari mentor berpengalaman.')">

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">

  <style>
    :root {
      --blue:    #1B6EF3;
      --blue-dk: #0D3DA0;
      --yellow:  #FFCC00;
      --dark:    #0D1B2A;
      --muted:   #64748B;
      --light:   #F8FAFD;
    }
    body            { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--dark); }
    .font-display   { font-family: 'Sora', sans-serif; }
    .nav-link       { @apply text-slate-600 hover:text-blue-700 font-medium text-sm transition-colors; }
    .btn-primary    { @apply bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-full transition-all shadow-sm hover:shadow-md; }
    .btn-outline    { @apply border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold px-5 py-2.5 rounded-full transition-all; }
    .btn-ghost      { @apply text-slate-600 hover:text-blue-700 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-all; }
    .badge          { @apply inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold; }
    .card           { @apply bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all; }
    .card-hover     { @apply hover:-translate-y-1; }
    .section-title  { @apply font-display text-3xl lg:text-4xl font-bold text-slate-900 leading-tight; }
    .input-field    { @apply w-full border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all; }
    .star-filled    { color: #F59E0B; }
    .star-empty     { color: #E2E8F0; }
    .line-clamp-2   { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3   { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .scrollbar-hide { scrollbar-width: none; }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
  </style>
  @stack('styles')
</head>
<body class="bg-slate-50 antialiased">

{{-- ═══════════════════════════════════════════════════ NAVBAR ══ --}}
<nav class="bg-white border-b border-slate-100 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="flex-shrink-0">
        <img src="{{ asset('logo/crygle-logo.png') }}" class="h-9" alt="Crygle Academy">
      </a>

      {{-- Nav Links --}}
      <div class="hidden lg:flex items-center gap-7">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? '!text-blue-700 font-semibold' : '' }}">Home</a>
        <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? '!text-blue-700 font-semibold' : '' }}">Semua Course</a>
        <a href="#" class="nav-link">Mentor</a>
        <a href="#" class="nav-link">Tentang</a>
      </div>

      {{-- Right --}}
      <div class="flex items-center gap-2">
        @auth
          {{-- Notif + dropdown --}}
          <div class="relative group">
            <button class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl hover:bg-slate-50 transition">
              <img src="{{ auth()->user()->avatarUrl() }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-blue-100">
              <div class="hidden md:block text-left">
                <p class="text-xs font-semibold text-slate-800 leading-none">{{ Str::limit(auth()->user()->name, 15) }}</p>
                <p class="text-xs text-slate-400">{{ auth()->user()->roleLabel() }}</p>
              </div>
              <i class="bi-chevron-down text-slate-400 text-xs hidden md:block"></i>
            </button>

            <div class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 pointer-events-none group-hover:pointer-events-auto">
              <div class="px-4 py-3 border-b border-slate-50">
                <p class="font-semibold text-slate-800 text-sm">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
              </div>
              <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                <i class="bi-grid-1x2 text-blue-500 w-4"></i> Dashboard
              </a>
              @if(auth()->user()->isInstructor())
              <a href="{{ route('instructor.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                <i class="bi-easel2 text-purple-500 w-4"></i> Studio Instructor
              </a>
              @endif
              @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                <i class="bi-shield-check text-emerald-500 w-4"></i> Admin Panel
              </a>
              @endif
              <div class="border-t border-slate-50 mt-1 pt-1">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                    <i class="bi-box-arrow-right w-4"></i> Keluar
                  </button>
                </form>
              </div>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="btn-ghost text-sm hidden sm:block">Masuk</a>
          <a href="{{ route('register') }}" class="btn-primary text-sm">Daftar Gratis</a>
        @endauth

        <button id="mob-toggle" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg">
          <i class="bi-list text-xl"></i>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile menu --}}
  <div id="mob-menu" class="hidden lg:hidden border-t border-slate-100 px-4 py-4 space-y-1 bg-white">
    <a href="{{ route('home') }}" class="block py-2.5 px-3 text-sm text-slate-700 font-medium rounded-lg hover:bg-slate-50">Home</a>
    <a href="{{ route('courses.index') }}" class="block py-2.5 px-3 text-sm text-slate-700 font-medium rounded-lg hover:bg-slate-50">Semua Course</a>
    @auth
      <a href="{{ route('dashboard') }}" class="block py-2.5 px-3 text-sm text-slate-700 font-medium rounded-lg hover:bg-slate-50">Dashboard</a>
    @endauth
  </div>
</nav>

{{-- ═══════════════════════════════ FLASH MESSAGES ══ --}}
@if(session('success') || session('error') || session('info'))
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4" id="flash-msg">
  @if(session('success'))
  <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
    <i class="bi-check-circle-fill text-emerald-500 flex-shrink-0"></i>
    <span>{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-400 hover:text-emerald-600"><i class="bi-x-lg"></i></button>
  </div>
  @endif
  @if(session('error'))
  <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm">
    <i class="bi-exclamation-circle-fill text-red-500 flex-shrink-0"></i>
    <span>{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600"><i class="bi-x-lg"></i></button>
  </div>
  @endif
  @if(session('info'))
  <div class="flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl px-4 py-3 text-sm">
    <i class="bi-info-circle-fill text-blue-500 flex-shrink-0"></i>
    <span>{{ session('info') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-auto text-blue-400 hover:text-blue-600"><i class="bi-x-lg"></i></button>
  </div>
  @endif
</div>
@endif

<main>@yield('content')</main>

{{-- ═══════════════════════════════════════ FOOTER ══ --}}
<footer class="bg-[#235F9C] text-white/70 mt-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-16 pb-8">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">
      <div>
        <img src="{{ asset('logo/footer-logo.png') }}" class="h-10 mb-4" alt="Crygle">
        <p class="text-sm leading-relaxed mb-5">Platform belajar skill digital untuk generasi muda yang siap bersaing di era modern.</p>
        <div class="flex gap-3">
          @foreach([['bi-instagram','#'], ['bi-youtube','#'], ['bi-linkedin','#'], ['bi-tiktok','#']] as [$icon,$href])
          <a href="{{ $href }}" class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
            <i class="{{ $icon }} text-sm"></i>
          </a>
          @endforeach
        </div>
      </div>
      <div>
        <h4 class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Navigasi</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
          <li><a href="{{ route('courses.index') }}" class="hover:text-white transition">Semua Course</a></li>
          <li><a href="#" class="hover:text-white transition">Mentor</a></li>
          <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Kategori</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="{{ route('courses.index',['category'=>'web-development']) }}" class="hover:text-white transition">Web Development</a></li>
          <li><a href="{{ route('courses.index',['category'=>'ui-ux-design']) }}" class="hover:text-white transition">UI/UX Design</a></li>
          <li><a href="{{ route('courses.index',['category'=>'digital-marketing']) }}" class="hover:text-white transition">Digital Marketing</a></li>
          <li><a href="{{ route('courses.index',['category'=>'data-science']) }}" class="hover:text-white transition">Data Science</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Kontak</h4>
        <ul class="space-y-3 text-sm">
          <li class="flex items-center gap-2"><i class="bi-envelope text-yellow-300"></i><a href="mailto:tanya@crygleacademy.com" class="hover:text-white transition">tanya@crygleacademy.com</a></li>
          <li class="flex items-start gap-2"><i class="bi-geo-alt text-yellow-300 mt-0.5"></i><span>Jl. Cipta Karya, Tampan, Pekanbaru, Riau</span></li>
          <li class="flex items-center gap-2"><i class="bi-telephone text-yellow-300"></i><span>0812-3456-7890</span></li>
        </ul>
      </div>
    </div>
    <div class="border-t border-white/10 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-white/40">
      <span>© {{ date('Y') }} Crygle Academy. Semua hak dilindungi.</span>
      <div class="flex gap-4">
        <a href="#" class="hover:text-white/70 transition">Kebijakan Privasi</a>
        <a href="#" class="hover:text-white/70 transition">Syarat & Ketentuan</a>
      </div>
    </div>
  </div>
</footer>

<script>
  document.getElementById('mob-toggle')?.addEventListener('click', () => {
    document.getElementById('mob-menu').classList.toggle('hidden');
  });
  // Auto-dismiss flash
  setTimeout(() => document.getElementById('flash-msg')?.remove(), 5000);
</script>
@stack('scripts')
</body>
</html>
