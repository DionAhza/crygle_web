@extends('layouts.app')
@section('title', $course->title . ' — Crygle Academy')
@section('meta_desc', Str::limit($course->description, 160))
@php use Illuminate\Support\Str; @endphp

@section('content')

{{-- ═══════════════════════════ HERO ══ --}}
<section class="bg-gradient-to-br from-slate-950 via-blue-950 to-blue-900 text-white py-14 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">
    {{-- Breadcrumb --}}
    <nav class="text-blue-300 text-xs mb-6 flex items-center gap-2 flex-wrap">
      <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
      <i class="bi-chevron-right text-xs"></i>
      <a href="{{ route('courses.index') }}" class="hover:text-white transition">Course</a>
      @if($course->category)
        <i class="bi-chevron-right text-xs"></i>
        <a href="{{ route('courses.index',['category'=>$course->category->slug]) }}" class="hover:text-white transition">{{ $course->category->name }}</a>
      @endif
      <i class="bi-chevron-right text-xs"></i>
      <span class="text-white/70 truncate max-w-xs">{{ $course->title }}</span>
    </nav>

    <div class="grid lg:grid-cols-3 gap-10 items-start">
      {{-- Left: Info --}}
      <div class="lg:col-span-2">
        @if($course->category)
          <span class="badge bg-blue-600/60 text-blue-100 border border-blue-500/30 mb-4">
            {{ $course->category->icon }} {{ $course->category->name }}
          </span>
        @endif
        <h1 class="font-display text-3xl lg:text-4xl font-bold leading-snug mb-4">{{ $course->title }}</h1>
        <p class="text-blue-200 text-base leading-relaxed mb-5 max-w-2xl">{{ $course->description }}</p>

        {{-- Stats bar --}}
        <div class="flex flex-wrap items-center gap-4 text-sm mb-5">
          @php $avg = $course->averageRating(); $cnt = $course->reviews->count(); @endphp
          @if($cnt > 0)
          <div class="flex items-center gap-1.5">
            <span class="font-bold text-yellow-400">{{ $avg }}</span>
            <div class="flex text-yellow-400 text-xs">@for($i=1;$i<=5;$i++)<i class="bi-star{{ $i<=round($avg)?'-fill':'' }}"></i>@endfor</div>
            <span class="text-blue-300">({{ $cnt }} ulasan)</span>
          </div>
          @endif
          <span class="flex items-center gap-1.5 text-blue-200"><i class="bi-people"></i>{{ $course->totalStudents() }} pelajar</span>
          <span class="flex items-center gap-1.5 text-blue-200"><i class="bi-collection-play"></i>{{ $course->sections->count() }} section · {{ $course->totalLessons() }} lesson</span>
          <span class="flex items-center gap-1.5 text-blue-200"><i class="bi-clock"></i>{{ $course->totalDurationFormatted() }}</span>
          <span class="flex items-center gap-1.5 text-blue-200"><i class="bi-bar-chart"></i>{{ $course->levelLabel() }}</span>
          <span class="flex items-center gap-1.5 text-blue-200"><i class="bi-translate"></i>{{ $course->language }}</span>
        </div>

        {{-- Instructor --}}
        <div class="flex items-center gap-3">
          <img src="{{ $course->instructor->avatarUrl() }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-blue-400/40">
          <div>
            <p class="text-xs text-blue-300">Dibuat oleh</p>
            <p class="font-semibold text-white text-sm">{{ $course->instructor->name }}</p>
          </div>
        </div>
      </div>

      {{-- Right: Enroll Card (desktop) --}}
      <div class="hidden lg:block lg:sticky lg:top-20">
        @include('courses._enroll_card')
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════ MAIN ══ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="grid lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">

      {{-- Yang akan dipelajari --}}
      @if($course->what_you_learn && count($course->what_you_learn) > 0)
      <div class="bg-white border border-slate-100 rounded-2xl p-6">
        <h2 class="font-bold text-slate-900 text-xl mb-4">✅ Yang Akan Kamu Pelajari</h2>
        <div class="grid sm:grid-cols-2 gap-2.5">
          @foreach($course->what_you_learn as $point)
          <div class="flex items-start gap-2.5 text-sm text-slate-700">
            <i class="bi-check-circle-fill text-emerald-500 mt-0.5 flex-shrink-0"></i>
            <span>{{ $point }}</span>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      {{-- Requirements --}}
      @if($course->requirements && count($course->requirements) > 0)
      <div class="bg-white border border-slate-100 rounded-2xl p-6">
        <h2 class="font-bold text-slate-900 text-xl mb-4">📋 Prasyarat</h2>
        <ul class="space-y-2">
          @foreach($course->requirements as $req)
          <li class="flex items-start gap-2.5 text-sm text-slate-700">
            <i class="bi-dot text-slate-400 text-xl mt-0 flex-shrink-0 leading-none"></i>
            <span>{{ $req }}</span>
          </li>
          @endforeach
        </ul>
      </div>
      @endif

      {{-- Kurikulum --}}
      <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-50">
          <div class="flex items-center justify-between">
            <h2 class="font-bold text-slate-900 text-xl">📚 Kurikulum</h2>
            <span class="text-sm text-slate-400">{{ $course->sections->count() }} section · {{ $course->totalLessons() }} lesson · {{ $course->totalDurationFormatted() }}</span>
          </div>
        </div>

        <div x-data="{ openSection: 1 }">
          @foreach($course->sections as $section)
          <div class="border-b border-slate-50 last:border-0">
            {{-- Section header --}}
            <button @click="openSection = openSection === {{ $loop->iteration }} ? null : {{ $loop->iteration }}"
                    class="w-full flex items-center gap-3 px-6 py-4 bg-slate-50/50 hover:bg-slate-50 transition text-left">
              <span class="w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex items-center justify-center flex-shrink-0">
                {{ $loop->iteration }}
              </span>
              <span class="font-semibold text-slate-800 flex-1">{{ $section->title }}</span>
              <span class="text-slate-400 text-xs">{{ $section->lessons->count() }} lesson</span>
              <i class="bi-chevron-down text-slate-400 text-xs transition-transform" :class="openSection === {{ $loop->iteration }} ? 'rotate-180' : ''"></i>
            </button>

            {{-- Lessons --}}
            <div x-show="openSection === {{ $loop->iteration }}" x-collapse>
              <ul class="divide-y divide-slate-50">
                @foreach($section->lessons as $lesson)
                <li class="flex items-center gap-3 px-6 py-3.5 hover:bg-blue-50/30 transition">
                  <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                    {{ $lesson->is_preview ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400' }}">
                    <i class="bi-play-fill text-xs"></i>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm text-slate-700">{{ $lesson->title }}</p>
                    @if($lesson->is_preview)
                      <span class="text-xs text-emerald-600 font-medium">Preview Gratis</span>
                    @endif
                  </div>
                  <span class="text-xs text-slate-400 flex-shrink-0">{{ $lesson->durationFormatted() }}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Instructor Profile --}}
      <div class="bg-white border border-slate-100 rounded-2xl p-6">
        <h2 class="font-bold text-slate-900 text-xl mb-5">👨‍🏫 Tentang Instructor</h2>
        <div class="flex items-start gap-4">
          <img src="{{ $course->instructor->avatarUrl() }}" class="w-16 h-16 rounded-full object-cover flex-shrink-0 ring-2 ring-blue-100">
          <div>
            <h3 class="font-bold text-slate-800 text-lg">{{ $course->instructor->name }}</h3>
            @if($course->instructor->headline)
              <p class="text-blue-600 text-sm mb-2">{{ $course->instructor->headline }}</p>
            @endif
            @if($course->instructor->bio)
              <p class="text-slate-500 text-sm leading-relaxed">{{ $course->instructor->bio }}</p>
            @endif
          </div>
        </div>
      </div>

      {{-- Reviews --}}
      <div class="bg-white border border-slate-100 rounded-2xl p-6" id="reviews">
        <h2 class="font-bold text-slate-900 text-xl mb-6">⭐ Ulasan Pelajar</h2>

        @if($course->reviews->count() > 0)
        {{-- Rating summary --}}
        <div class="flex flex-col sm:flex-row items-center gap-8 mb-8 p-5 bg-slate-50 rounded-2xl">
          <div class="text-center flex-shrink-0">
            <p class="text-6xl font-bold text-slate-900">{{ $avg }}</p>
            <div class="flex justify-center text-amber-400 text-xl my-1">
              @for($i=1;$i<=5;$i++)<i class="bi-star{{ $i<=round($avg)?'-fill':'' }}"></i>@endfor
            </div>
            <p class="text-slate-400 text-xs">{{ $cnt }} ulasan</p>
          </div>
          <div class="flex-1 w-full space-y-2">
            @for($i=5;$i>=1;$i--)
            <div class="flex items-center gap-2 text-xs">
              <span class="w-2 text-slate-500">{{ $i }}</span>
              <div class="flex text-amber-400 text-xs"><i class="bi-star-fill"></i></div>
              <div class="flex-1 bg-slate-200 rounded-full h-2 overflow-hidden">
                <div class="bg-amber-400 h-2 rounded-full transition-all" style="width: {{ $ratingBreakdown[$i]['percent'] }}%"></div>
              </div>
              <span class="w-8 text-right text-slate-400">{{ $ratingBreakdown[$i]['percent'] }}%</span>
            </div>
            @endfor
          </div>
        </div>

        {{-- Review list --}}
        <div class="space-y-5">
          @foreach($course->reviews->take(5) as $review)
          <div class="flex gap-4">
            <img src="{{ $review->user->avatarUrl() }}" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <p class="font-semibold text-slate-800 text-sm">{{ $review->user->name }}</p>
                <div class="flex text-amber-400 text-xs">
                  @for($i=1;$i<=5;$i++)<i class="bi-star{{ $i<=$review->rating?'-fill':'' }}"></i>@endfor
                </div>
                <span class="text-slate-400 text-xs ml-auto">{{ $review->created_at->diffForHumans() }}</span>
              </div>
              @if($review->comment)
                <p class="text-slate-600 text-sm leading-relaxed">{{ $review->comment }}</p>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        @else
          <p class="text-slate-400 text-sm text-center py-8">Belum ada ulasan. Jadilah yang pertama! 🌟</p>
        @endif

        {{-- Form review --}}
        @auth
          @if(auth()->user()->isEnrolled($course))
          <div class="mt-6 pt-6 border-t border-slate-100">
            <h3 class="font-bold text-slate-800 mb-4">{{ $userReview ? 'Edit Ulasan Kamu' : 'Tulis Ulasan' }}</h3>
            <form action="{{ route('review.store', $course) }}" method="POST">
              @csrf
              <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">Rating</label>
                <div class="flex gap-1" id="star-rating">
                  @for($i=1;$i<=5;$i++)
                  <button type="button" data-val="{{ $i }}" onclick="setRating({{ $i }})"
                          class="text-3xl transition star-btn {{ $i <= ($userReview->rating ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">
                    ★
                  </button>
                  @endfor
                </div>
                <input type="hidden" name="rating" id="rating-input" value="{{ $userReview->rating ?? '' }}" required>
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Komentar (opsional)</label>
                <textarea name="comment" rows="3" placeholder="Bagikan pengalamanmu mengikuti course ini..."
                          class="input-field resize-none">{{ $userReview->comment ?? '' }}</textarea>
              </div>
              <button class="btn-primary text-sm">
                {{ $userReview ? 'Update Ulasan' : 'Kirim Ulasan' }}
              </button>
            </form>
          </div>
          @endif
        @endauth
      </div>

      {{-- Related --}}
      @if($related->isNotEmpty())
      <div>
        <h2 class="font-bold text-slate-900 text-xl mb-5">🎯 Course Terkait</h2>
        <div class="grid sm:grid-cols-3 gap-4">
          @foreach($related as $r)
          <a href="{{ route('courses.show',$r) }}" class="bg-white border border-slate-100 rounded-xl overflow-hidden hover:shadow-md transition group">
            <div class="h-28 overflow-hidden"><img src="{{ $r->thumbnailUrl() }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"></div>
            <div class="p-3">
              <p class="font-semibold text-slate-800 text-xs line-clamp-2 mb-1">{{ $r->title }}</p>
              <div class="flex items-center justify-between">
                <span class="text-xs font-bold {{ $r->isFree() ? 'text-emerald-600' : 'text-blue-700' }}">{{ $r->formattedPrice() }}</span>
                @php $rAvg = $r->averageRating(); @endphp
                @if($rAvg > 0)<span class="text-xs text-amber-500">★ {{ $rAvg }}</span>@endif
              </div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @endif
    </div>

    {{-- Right: sticky (empty on desktop, content in hero) --}}
    <div class="hidden lg:block"></div>
  </div>
</div>

{{-- MOBILE sticky enroll bar --}}
<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-4 py-3 shadow-2xl z-40">
  <div class="flex items-center gap-3">
    <div class="flex-shrink-0">
      <p class="font-bold text-lg {{ $course->isFree() ? 'text-emerald-600' : 'text-blue-700' }}">{{ $course->formattedPrice() }}</p>
      @if($course->originalPrice())<p class="text-xs text-slate-400 line-through">{{ $course->originalPrice() }}</p>@endif
    </div>
    <div class="flex-1">@include('courses._enroll_btn')</div>
  </div>
</div>
<div class="lg:hidden h-20"></div>

{{-- Alpine for accordion, star rating script --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js" defer></script>
<script>
function setRating(val) {
  document.getElementById('rating-input').value = val;
  document.querySelectorAll('.star-btn').forEach((btn, i) => {
    btn.classList.toggle('text-amber-400', i < val);
    btn.classList.toggle('text-slate-200', i >= val);
  });
}
</script>
@endsection
