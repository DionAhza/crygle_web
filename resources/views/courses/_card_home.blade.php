@php
  $avg = $course->averageRating();
  $cnt = $course->reviews->count();
  $levelClass = match($course->level) {
    'intermediate' => 'badge-intermediate',
    'advanced'     => 'badge-advanced',
    default        => 'badge-basic',
  };
  $levelLabel = match($course->level) {
    'intermediate' => 'Intermediate',
    'advanced'     => 'Advanced',
    default        => 'Basic',
  };
@endphp
<a href="{{ route('courses.show', $course) }}" class="card-course" style="text-decoration:none;display:flex;flex-direction:column;">
  {{-- Thumbnail --}}
  <div style="height:180px;overflow:hidden;position:relative;background:#EEF4FF;">
    <img src="{{ $course->thumbnailUrl() }}" alt="{{ $course->title }}"
         style="width:100%;height:100%;object-fit:cover;" onerror="this.src='https://placehold.co/600x360/EEF4FF/1B4F9B?text=Course'">
  </div>

  {{-- Body --}}
  <div style="padding:1rem;flex:1;display:flex;flex-direction:column;">
    <h3 style="font-weight:700;color:#1A1A2E;font-size:.9rem;line-height:1.5;margin-bottom:.5rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
      {{ $course->title }}
    </h3>

    {{-- Level + Rating --}}
    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.875rem;flex-wrap:wrap;">
      <span class="badge-level {{ $levelClass }}">{{ $levelLabel }} Level Class</span>
      <span style="display:flex;align-items:center;gap:.25rem;font-size:.8rem;color:#374151;">
        <span style="color:#F59E0B;">★</span>
        <strong>{{ $avg > 0 ? $avg : '4.3' }}</strong>
        <span style="color:#6B7280;">({{ $cnt > 0 ? number_format($cnt/100,1).'K' : '1.6K' }} Reviews)</span>
      </span>
    </div>

    {{-- Harga --}}
    <div style="display:flex;align-items:center;gap:.625rem;margin-top:auto;">
      <span style="font-weight:800;color:#1A1A2E;font-size:.95rem;">
        @if($course->isFree()) Rp. 0
        @else Rp. {{ number_format($course->effectivePrice(), 0, ',', '.') }}
        @endif
      </span>
      @if($course->discountPercent())
        <span style="background:#22C55E;color:#fff;font-size:.65rem;font-weight:700;padding:.15rem .5rem;border-radius:4px;">{{ $course->discountPercent() }}% off</span>
        <span class="price-strike">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
      @elseif($course->isFree())
        <span style="background:#22C55E;color:#fff;font-size:.65rem;font-weight:700;padding:.15rem .5rem;border-radius:4px;">100% off</span>
        @if($course->price > 0)
        <span class="price-strike">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
        @endif
      @endif
    </div>
  </div>
</a>
