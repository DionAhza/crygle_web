@php
  $avg = $course->averageRating();
  $cnt = $course->reviews->count();
@endphp
<a href="{{ route('courses.show', $course) }}"
   class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col group">

  {{-- Thumbnail --}}
  <div class="relative h-44 overflow-hidden bg-slate-100">
    <img src="{{ $course->thumbnailUrl() }}" alt="{{ $course->title }}"
         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
    {{-- Badges --}}
    <div class="absolute top-3 left-3 flex gap-1.5">
      <span class="badge bg-white/90 text-slate-700 text-xs backdrop-blur-sm">{{ $course->levelLabel() }}</span>
    </div>
    @if($course->isFree())
      <span class="absolute top-3 right-3 badge bg-emerald-500 text-white">Gratis</span>
    @elseif($course->discountPercent())
      <span class="absolute top-3 right-3 badge bg-red-500 text-white">-{{ $course->discountPercent() }}%</span>
    @endif
  </div>

  {{-- Body --}}
  <div class="p-4 flex flex-col flex-1">
    @if($course->category)
      <span class="text-xs font-semibold text-blue-600 mb-1.5">{{ $course->category->icon }} {{ $course->category->name }}</span>
    @endif
    <h3 class="font-bold text-slate-800 text-sm leading-snug line-clamp-2 flex-1 mb-2">{{ $course->title }}</h3>
    <p class="text-slate-400 text-xs mb-1 truncate">oleh {{ $course->instructor->name }}</p>

    {{-- Rating --}}
    @if($cnt > 0)
    <div class="flex items-center gap-1 mb-3">
      <span class="text-amber-500 font-bold text-xs">{{ $avg }}</span>
      <div class="flex text-amber-400 text-xs">
        @for($i=1;$i<=5;$i++)<i class="bi-star{{ $i <= round($avg) ? '-fill' : '' }}"></i>@endfor
      </div>
      <span class="text-slate-400 text-xs">({{ $cnt }})</span>
    </div>
    @else
    <div class="mb-3"></div>
    @endif

    {{-- Footer --}}
    <div class="flex items-center justify-between pt-3 border-t border-slate-50">
      <div>
        @if($course->originalPrice())
          <span class="text-xs text-slate-400 line-through">{{ $course->originalPrice() }}</span><br>
        @endif
        <span class="font-bold text-base {{ $course->isFree() ? 'text-emerald-600' : 'text-blue-700' }}">
          {{ $course->formattedPrice() }}
        </span>
      </div>
      <div class="flex items-center gap-2 text-xs text-slate-400">
        <span><i class="bi-people"></i> {{ $course->totalStudents() }}</span>
        <span><i class="bi-play-circle"></i> {{ $course->totalLessons() }}</span>
      </div>
    </div>
  </div>
</a>
