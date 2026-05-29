@if($enrollment)
  {{-- Already enrolled --}}
  @php $next = $enrollment->nextLesson(); $first = $course->sections->first()?->lessons->first(); $target = $next ?? $first; @endphp
  @if($target)
  <a href="{{ route('learn.lesson', [$enrollment, $target]) }}"
     class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl text-center transition mb-2 text-sm">
    {{ $next ? '▶ Lanjut Belajar' : '🔁 Ulangi Course' }}
  </a>
  @endif
  @php $pct = $enrollment->progressPercent(); @endphp
  <div>
    <div class="flex justify-between text-xs text-slate-500 mb-1">
      <span>Progress</span><span class="font-semibold text-blue-700">{{ $pct }}%</span>
    </div>
    <div class="w-full bg-slate-100 rounded-full h-2">
      <div class="bg-blue-600 h-2 rounded-full transition-all" style="width:{{ $pct }}%"></div>
    </div>
  </div>

@elseif($hasPending ?? false)
  {{-- Pending payment --}}
  @php $pendingTx = auth()->user()->transactions()->where('course_id',$course->id)->where('status','pending')->first(); @endphp
  @if($pendingTx)
  <a href="{{ route('payment', $pendingTx) }}"
     class="block w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3.5 rounded-xl text-center transition mb-2 text-sm">
    ⏳ Selesaikan Pembayaran
  </a>
  @endif

@elseif(auth()->check())
  {{-- Checkout --}}
  <form action="{{ route('checkout', $course) }}" method="POST">
    @csrf
    <button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl transition mb-2 text-sm shadow-md shadow-blue-200">
      {{ $course->isFree() ? '🎉 Daftar Gratis Sekarang' : '🛒 Daftar Sekarang' }}
    </button>
  </form>
  @if(!$course->isFree())
    <p class="text-center text-xs text-slate-400">Garansi uang kembali 30 hari</p>
  @endif

@else
  {{-- Guest --}}
  <a href="{{ route('login') }}"
     class="block w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl text-center transition mb-2 text-sm">
    Masuk untuk Mendaftar
  </a>
  <a href="{{ route('register') }}"
     class="block w-full border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold py-3 rounded-xl text-center transition text-sm">
    Daftar Gratis
  </a>
@endif
