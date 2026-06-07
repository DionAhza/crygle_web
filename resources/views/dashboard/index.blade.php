<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Kelas Saya — Crygle Academy</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>
    body { font-family:'Plus Jakarta Sans',sans-serif; background:#F0F4F8; }
    .sidebar-link { display:flex; align-items:center; gap:.875rem; padding:.75rem 1.25rem; border-radius:10px; font-size:.875rem; font-weight:500; color:#6B7280; text-decoration:none; transition:all .15s; cursor:pointer; }
    .sidebar-link:hover { background:#EEF4FF; color:#1B4F9B; }
    .sidebar-link.active { background:#EEF4FF; color:#1B4F9B; font-weight:700; }
    .sidebar-link .icon { width:22px; display:flex; justify-content:center; }
  </style>
</head>
<body>
<div style="display:flex;min-height:100vh;">

  {{-- ═══ SIDEBAR ═══ --}}
  <aside style="width:220px;background:#fff;border-right:1px solid #E5E7EB;flex-shrink:0;display:flex;flex-direction:column;padding:1.25rem 1rem;">
    {{-- Logo --}}
    <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.625rem;margin-bottom:2rem;text-decoration:none;padding:.25rem .25rem;">
      <div style="width:36px;height:36px;background:#1B4F9B;border-radius:8px;display:flex;align-items:center;justify-content:center;">
        <i class="bi-book-half" style="color:#fff;font-size:1rem;"></i>
      </div>
      <div>
        <p style="font-weight:800;color:#1B4F9B;font-size:.9rem;line-height:1.1;">Crygle</p>
        <p style="font-weight:800;color:#1B4F9B;font-size:.9rem;line-height:1.1;">Academy</p>
      </div>
    </a>

    {{-- Nav --}}
    <nav style="flex:1;space-y:.25rem;">
      <a href="#" class="sidebar-link">
        <span class="icon"><i class="bi-grid-1x2"></i></span> Overview
      </a>
      <a href="{{ route('dashboard') }}" class="sidebar-link active">
        <span class="icon"><i class="bi-book-open"></i></span> Kelas Saya
      </a>
      <a href="{{ route('courses.index') }}" class="sidebar-link">
        <span class="icon"><i class="bi-compass"></i></span> Explore Kelas
      </a>
      <a href="#" class="sidebar-link">
        <span class="icon"><i class="bi-chat-dots"></i></span> Chat Mentor
      </a>
      <a href="#" class="sidebar-link">
        <span class="icon"><i class="bi-person-badge"></i></span> Affiliate
      </a>
      <a href="#" class="sidebar-link">
        <span class="icon"><i class="bi-gear"></i></span> Setting
      </a>
    </nav>

    {{-- User profile bottom --}}
    <div style="border-top:1px solid #F0F4F8;padding-top:1rem;margin-top:1rem;">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button style="display:flex;align-items:center;gap:.625rem;width:100%;background:none;border:none;cursor:pointer;padding:.5rem .25rem;border-radius:8px;transition:background .1s;" onmouseenter="this.style.background='#FEF2F2'" onmouseleave="this.style.background='none'">
          <i class="bi-box-arrow-right" style="color:#EF4444;font-size:1rem;"></i>
          <span style="font-size:.85rem;font-weight:600;color:#EF4444;">Keluar</span>
        </button>
      </form>
    </div>
  </aside>

  {{-- ═══ MAIN ═══ --}}
  <div style="flex:1;min-width:0;display:flex;flex-direction:column;">

    {{-- Top bar --}}
    <header style="background:#fff;border-bottom:1px solid #E5E7EB;padding:1rem 1.75rem;display:flex;align-items:center;justify-content:space-between;">
      <h1 style="font-size:1.4rem;font-weight:800;color:#1A1A2E;">Kelas Saya</h1>
      <div style="display:flex;align-items:center;gap:1rem;">
        <button style="width:38px;height:38px;border-radius:50%;border:1.5px solid #E5E7EB;background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;position:relative;">
          <i class="bi-bell" style="color:#374151;font-size:1rem;"></i>
          <span style="position:absolute;top:6px;right:7px;width:8px;height:8px;background:#EF4444;border-radius:50%;border:2px solid #fff;"></span>
        </button>
        <img src="{{ auth()->user()->avatarUrl() }}" style="width:38px;height:38px;border-radius:50%;object-fit:cover;cursor:pointer;">
      </div>
    </header>

    {{-- Content --}}
    <main style="flex:1;padding:1.75rem;overflow-y:auto;">

      {{-- Flash --}}
      @if(session('success'))
      <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:10px;padding:.75rem 1rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:.625rem;font-size:.875rem;color:#15803D;">
        <i class="bi-check-circle-fill"></i> {{ session('success') }}
      </div>
      @endif

      {{-- Search & Filter --}}
      <div style="display:flex;gap:.875rem;margin-bottom:1.75rem;flex-wrap:wrap;">
        <div style="flex:1;min-width:220px;position:relative;">
          <i class="bi-search" style="position:absolute;left:.875rem;top:50%;transform:translateY(-50%);color:#9CA3AF;font-size:.875rem;"></i>
          <input type="text" placeholder="Search  Course Name/Mentor"
                 style="width:100%;border:1.5px solid #E5E7EB;border-radius:12px;padding:.75rem .875rem .75rem 2.5rem;font-size:.85rem;outline:none;background:#fff;"
                 onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
        </div>
        <button style="display:flex;align-items:center;gap:.5rem;border:1.5px solid #E5E7EB;background:#fff;border-radius:12px;padding:.75rem 1.125rem;font-size:.85rem;font-weight:600;color:#374151;cursor:pointer;">
          <i class="bi-bar-chart" style="color:#1B4F9B;"></i> Level
        </button>
        <button style="display:flex;align-items:center;gap:.5rem;border:1.5px solid #E5E7EB;background:#fff;border-radius:12px;padding:.75rem 1.125rem;font-size:.85rem;font-weight:600;color:#374151;cursor:pointer;">
          <i class="bi-grid" style="color:#1B4F9B;"></i> Category
        </button>
        <button style="display:flex;align-items:center;gap:.5rem;border:1.5px solid #E5E7EB;background:#fff;border-radius:12px;padding:.75rem 1.125rem;font-size:.85rem;font-weight:600;color:#374151;cursor:pointer;">
          <i class="bi-funnel" style="color:#1B4F9B;"></i> Sort By : Popular
        </button>
      </div>

      {{-- Course cards --}}
      @if($enrollments->isEmpty())
      <div style="text-align:center;padding:4rem 2rem;background:#fff;border-radius:16px;border:1.5px dashed #E5E7EB;">
        <i class="bi-collection-play" style="font-size:3rem;color:#CBD5E1;"></i>
        <p style="font-size:1.1rem;font-weight:700;color:#374151;margin-top:1rem;">Belum ada kelas</p>
        <p style="color:#9CA3AF;font-size:.875rem;margin:.5rem 0 1.5rem;">Mulai belajar dengan mendaftar course favoritmu</p>
        <a href="{{ route('courses.index') }}" style="display:inline-block;background:#1B4F9B;color:#fff;font-weight:700;padding:.75rem 2rem;border-radius:50px;text-decoration:none;font-size:.875rem;">
          Explore Kelas
        </a>
      </div>
      @else
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;">
        @foreach($enrollments as $enrollment)
        @php
          $course        = $enrollment->course;
          $pct           = $enrollment->progressPercent();
          $totalLessons  = $course->totalLessons();
          $doneLessons   = $totalLessons > 0 ? (int) round($pct / 100 * $totalLessons) : 0;
          $next          = $enrollment->nextLesson();
          $first         = $course->sections->first()?->lessons->first();
          $target        = $next ?? $first;
          $progressColor = $pct >= 100 ? '#22C55E' : ($pct >= 50 ? '#1B4F9B' : '#F59E0B');
          $levelLabel    = match($course->level) { 'intermediate'=>'Intermediate', 'advanced'=>'Advanced', default=>'Basic' };
        @endphp
        <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 1px 6px rgba(0,0,0,.06);transition:box-shadow .2s;" onmouseenter="this.style.boxShadow='0 6px 20px rgba(0,0,0,.1)'" onmouseleave="this.style.boxShadow='0 1px 6px rgba(0,0,0,.06)'">
          {{-- Thumbnail --}}
          <div style="height:160px;overflow:hidden;position:relative;background:#EEF4FF;">
            <img src="{{ $course->thumbnailUrl() }}" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='https://placehold.co/600x360/EEF4FF/1B4F9B?text=Course'">
          </div>
          {{-- Body --}}
          <div style="padding:1.125rem;">
            <h3 style="font-weight:700;color:#1A1A2E;font-size:.9rem;line-height:1.45;margin-bottom:.375rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $course->title }}</h3>
            <p style="font-size:.78rem;color:#6B7280;margin-bottom:1rem;">{{ $levelLabel }} Level Class</p>

            {{-- Progress bar --}}
            <div>
              <div style="height:5px;background:#E5E7EB;border-radius:3px;overflow:hidden;margin-bottom:.5rem;">
                <div style="height:100%;background:{{ $progressColor }};border-radius:3px;width:{{ $pct }}%;transition:width .4s;"></div>
              </div>
              <div style="display:flex;justify-content:space-between;align-items:center;">
                <span style="font-size:.78rem;color:#6B7280;font-weight:600;">
                  {{ $doneLessons }}/{{ $totalLessons }} Modul
                </span>
                <span style="font-size:.78rem;font-weight:700;color:{{ $progressColor }};">{{ $pct }}%</span>
              </div>
            </div>

            {{-- CTA --}}
            @if($target)
            <a href="{{ route('learn.lesson', [$enrollment, $target]) }}"
               style="display:block;margin-top:.875rem;background:#EEF4FF;color:#1B4F9B;font-weight:700;text-align:center;padding:.625rem;border-radius:8px;text-decoration:none;font-size:.8rem;transition:background .15s;"
               onmouseenter="this.style.background='#1B4F9B';this.style.color='#fff'" onmouseleave="this.style.background='#EEF4FF';this.style.color='#1B4F9B'">
              {{ $pct == 0 ? '▶ Mulai Belajar' : ($pct >= 100 ? '🔁 Ulangi' : '▶ Lanjut Belajar') }}
            </a>
            @endif
          </div>
        </div>
        @endforeach
      </div>
      @endif

    </main>
  </div>
</div>
</body>
</html>
