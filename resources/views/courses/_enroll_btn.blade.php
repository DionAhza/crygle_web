@if($enrollment)
  @php $next = $enrollment->nextLesson(); $first = $course->sections->first()?->lessons->first(); $target = $next ?? $first; @endphp
  @if($target)
  <a href="{{ route('learn.lesson', [$enrollment, $target]) }}"
     style="display:block;width:100%;background:#22C55E;color:#fff;font-weight:700;padding:1rem;border-radius:50px;text-decoration:none;text-align:center;font-size:.95rem;transition:background .2s;margin-bottom:.875rem;"
     onmouseenter="this.style.background='#16A34A'" onmouseleave="this.style.background='#22C55E'">
    {{ $next ? '▶ Lanjut Belajar' : '🔁 Ulangi Course' }}
  </a>
  @endif
  @php $pct = $enrollment->progressPercent(); @endphp
  <div>
    <div style="display:flex;justify-content:space-between;font-size:.8rem;margin-bottom:.375rem;">
      <span style="color:#6B7280;font-weight:600;">Progress</span>
      <span style="color:#1B4F9B;font-weight:700;">{{ $pct }}%</span>
    </div>
    <div style="height:6px;background:#E5E7EB;border-radius:3px;overflow:hidden;">
      <div style="height:100%;background:#1B4F9B;border-radius:3px;width:{{ $pct }}%;"></div>
    </div>
  </div>

@elseif(isset($hasPending) && $hasPending)
  @php $pendingTx = auth()->user()->transactions()->where('course_id',$course->id)->where('status','pending')->first(); @endphp
  @if($pendingTx)
  <a href="{{ route('payment', $pendingTx) }}"
     style="display:block;width:100%;background:#F59E0B;color:#fff;font-weight:700;padding:1rem;border-radius:50px;text-decoration:none;text-align:center;font-size:.95rem;transition:background .2s;"
     onmouseenter="this.style.background='#D97706'" onmouseleave="this.style.background='#F59E0B'">
    ⏳ Selesaikan Pembayaran
  </a>
  @endif

@elseif(auth()->check())
  <form action="{{ route('checkout', $course) }}" method="POST">
    @csrf
    <button type="submit"
            style="width:100%;background:#1B4F9B;color:#fff;font-weight:700;padding:1rem;border-radius:50px;border:none;cursor:pointer;font-size:.95rem;transition:background .2s;"
            onmouseenter="this.style.background='#143d7a'" onmouseleave="this.style.background='#1B4F9B'">
      {{ $course->isFree() ? '🎉 Mulai Belajar' : '🛒 Daftar Sekarang' }}
    </button>
  </form>
  @if(!$course->isFree())
  <p style="text-align:center;font-size:.78rem;color:#9CA3AF;margin-top:.625rem;">Garansi uang kembali 30 hari</p>
  @endif

@else
  <a href="{{ route('login') }}"
     style="display:block;width:100%;background:#1B4F9B;color:#fff;font-weight:700;padding:1rem;border-radius:50px;text-decoration:none;text-align:center;font-size:.95rem;transition:background .2s;margin-bottom:.5rem;"
     onmouseenter="this.style.background='#143d7a'" onmouseleave="this.style.background='#1B4F9B'">
    Masuk untuk Mendaftar
  </a>
  <a href="{{ route('register') }}"
     style="display:block;width:100%;border:2px solid #1B4F9B;color:#1B4F9B;font-weight:700;padding:.875rem;border-radius:50px;text-decoration:none;text-align:center;font-size:.875rem;transition:all .2s;"
     onmouseenter="this.style.background='#EEF4FF'" onmouseleave="this.style.background='transparent'">
    Daftar Gratis
  </a>
@endif
