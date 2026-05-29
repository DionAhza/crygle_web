<div class="bg-white rounded-2xl shadow-2xl shadow-blue-900/20 border border-slate-100 overflow-hidden">
  <div class="h-40 overflow-hidden">
    <img src="{{ $course->thumbnailUrl() }}" class="w-full h-full object-cover">
  </div>
  <div class="p-5">
    <div class="mb-4">
      <div class="flex items-baseline gap-2">
        <span class="text-2xl font-bold {{ $course->isFree() ? 'text-emerald-600' : 'text-blue-700' }}">{{ $course->formattedPrice() }}</span>
        @if($course->originalPrice())
          <span class="text-sm text-slate-400 line-through">{{ $course->originalPrice() }}</span>
          <span class="badge bg-red-100 text-red-600 text-xs">-{{ $course->discountPercent() }}%</span>
        @endif
      </div>
      @if($course->discount_price && $course->discount_price < $course->price)
        <p class="text-xs text-red-500 font-medium mt-1">⏰ Harga promo terbatas!</p>
      @endif
    </div>

    @include('courses._enroll_btn')

    {{-- Details list --}}
    <div class="border-t border-slate-50 mt-4 pt-4 space-y-2.5">
      @foreach([
        ['bi-collection-play','Konten',       $course->sections->count() . ' section · ' . $course->totalLessons() . ' lesson'],
        ['bi-clock',          'Durasi',        $course->totalDurationFormatted()],
        ['bi-bar-chart',      'Level',         $course->levelLabel()],
        ['bi-translate',      'Bahasa',        $course->language],
        ['bi-infinity',       'Akses',         'Seumur hidup'],
        ['bi-award',          'Sertifikat',    'Ya, saat selesai'],
        ['bi-phone',          'Perangkat',     'Mobile & Desktop'],
      ] as [$icon,$label,$val])
      <div class="flex items-center gap-2 text-sm">
        <i class="{{ $icon }} text-blue-500 w-4 flex-shrink-0"></i>
        <span class="text-slate-500 flex-shrink-0">{{ $label }}</span>
        <span class="text-slate-700 font-medium ml-auto text-right text-xs">{{ $val }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>
