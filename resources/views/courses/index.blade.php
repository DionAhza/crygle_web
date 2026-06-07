@extends('layouts.app')
@section('title','Semua Kelas — Crygle Academy')
@section('content')

{{-- Header --}}
<section style="background:#F8FAFD;border-bottom:1px solid #E5E7EB;padding:2.5rem 0;">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <h1 style="font-size:1.75rem;font-weight:800;color:#1B4F9B;margin-bottom:.375rem;">Semua Kelas</h1>
    <p style="color:#6B7280;font-size:.9rem;">Pilih kelas yang sesuai dengan skill yang ingin kamu kuasai</p>
  </div>
</section>

<div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
  <div style="display:flex;flex-direction:column;gap:1.5rem;">

    {{-- Search + Filter bar --}}
    <div style="display:flex;gap:.875rem;flex-wrap:wrap;align-items:center;">
      <form action="{{ route('courses.index') }}" method="GET" style="display:flex;gap:.875rem;flex:1;min-width:280px;" id="search-f">
        <div style="flex:1;position:relative;">
          <i class="bi-search" style="position:absolute;left:.875rem;top:50%;transform:translateY(-50%);color:#9CA3AF;font-size:.875rem;"></i>
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kelas atau topik..."
                 style="width:100%;border:1.5px solid #E5E7EB;border-radius:12px;padding:.75rem .875rem .75rem 2.5rem;font-size:.875rem;outline:none;background:#fff;transition:border .15s;"
                 onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
          @foreach(request()->except('q','page') as $k=>$v)
          <input type="hidden" name="{{ $k }}" value="{{ $v }}">
          @endforeach
        </div>
        <button type="submit" style="background:#1B4F9B;color:#fff;font-weight:700;padding:.75rem 1.5rem;border-radius:12px;border:none;cursor:pointer;font-size:.875rem;white-space:nowrap;">Cari</button>
      </form>

      {{-- Sort --}}
      <select onchange="applySort(this.value)" style="border:1.5px solid #E5E7EB;border-radius:12px;padding:.75rem 1rem;font-size:.875rem;outline:none;background:#fff;cursor:pointer;color:#374151;font-family:inherit;font-weight:600;">
        <option value="latest"    {{ request('sort','latest')==='latest'    ? 'selected':'' }}>Terbaru</option>
        <option value="popular"   {{ request('sort')==='popular'            ? 'selected':'' }}>Terpopuler</option>
        <option value="rating"    {{ request('sort')==='rating'             ? 'selected':'' }}>Rating Tertinggi</option>
        <option value="price_asc" {{ request('sort')==='price_asc'          ? 'selected':'' }}>Harga Terendah</option>
      </select>
    </div>

    {{-- Filter pills --}}
    <form action="{{ route('courses.index') }}" method="GET" id="filter-f" style="display:flex;gap:.625rem;flex-wrap:wrap;align-items:center;">
      @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
      @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif

      {{-- Kategori --}}
      <div style="display:flex;gap:.375rem;flex-wrap:wrap;">
        <label style="cursor:pointer;">
          <input type="radio" name="category" value="" {{ !request('category')?'checked':'' }} class="sr-only" onchange="this.form.submit()">
          <span style="display:inline-block;padding:.4rem 1rem;border-radius:50px;font-size:.8rem;font-weight:600;border:1.5px solid {{ !request('category') ? '#1B4F9B' : '#E5E7EB' }};background:{{ !request('category') ? '#1B4F9B' : '#fff' }};color:{{ !request('category') ? '#fff' : '#374151' }};cursor:pointer;transition:all .15s;">
            Semua
          </span>
        </label>
        @foreach($categories as $cat)
        <label style="cursor:pointer;">
          <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category')===$cat->slug?'checked':'' }} class="sr-only" onchange="this.form.submit()">
          <span style="display:inline-block;padding:.4rem 1rem;border-radius:50px;font-size:.8rem;font-weight:600;border:1.5px solid {{ request('category')===$cat->slug ? '#1B4F9B' : '#E5E7EB' }};background:{{ request('category')===$cat->slug ? '#1B4F9B' : '#fff' }};color:{{ request('category')===$cat->slug ? '#fff' : '#374151' }};cursor:pointer;transition:all .15s;">
            {{ $cat->icon }} {{ $cat->name }}
          </span>
        </label>
        @endforeach
      </div>

      {{-- Level pills --}}
      <div style="width:1px;height:24px;background:#E5E7EB;margin:0 .25rem;"></div>
      @foreach(['' => 'Semua Level', 'beginner' => 'Pemula', 'intermediate' => 'Menengah', 'advanced' => 'Mahir'] as $v=>$l)
      <label style="cursor:pointer;">
        <input type="radio" name="level" value="{{ $v }}" {{ request('level','')===$v?'checked':'' }} class="sr-only" onchange="this.form.submit()">
        <span style="display:inline-block;padding:.4rem .875rem;border-radius:50px;font-size:.78rem;font-weight:600;border:1.5px solid {{ request('level','')===$v ? '#1B4F9B' : '#E5E7EB' }};background:{{ request('level','')===$v ? '#EEF4FF' : '#fff' }};color:{{ request('level','')===$v ? '#1B4F9B' : '#6B7280' }};cursor:pointer;transition:all .15s;">
          {{ $l }}
        </span>
      </label>
      @endforeach

      {{-- Type --}}
      <div style="width:1px;height:24px;background:#E5E7EB;margin:0 .25rem;"></div>
      @foreach(['' => 'Semua', 'free' => '🎁 Gratis', 'paid' => '💳 Berbayar'] as $v=>$l)
      <label style="cursor:pointer;">
        <input type="radio" name="type" value="{{ $v }}" {{ request('type','')===$v?'checked':'' }} class="sr-only" onchange="this.form.submit()">
        <span style="display:inline-block;padding:.4rem .875rem;border-radius:50px;font-size:.78rem;font-weight:600;border:1.5px solid {{ request('type','')===$v ? '#1B4F9B' : '#E5E7EB' }};background:{{ request('type','')===$v ? '#EEF4FF' : '#fff' }};color:{{ request('type','')===$v ? '#1B4F9B' : '#6B7280' }};cursor:pointer;transition:all .15s;">
          {{ $l }}
        </span>
      </label>
      @endforeach

      @if(request()->hasAny(['category','level','type','q']))
      <a href="{{ route('courses.index') }}" style="display:inline-flex;align-items:center;gap:.375rem;padding:.4rem .875rem;border-radius:50px;font-size:.78rem;font-weight:600;color:#EF4444;border:1.5px solid #FECACA;background:#FEF2F2;text-decoration:none;">
        <i class="bi-x-circle"></i> Reset
      </a>
      @endif
    </form>

    {{-- Result info --}}
    <div style="display:flex;align-items:center;justify-content:space-between;">
      <p style="font-size:.875rem;color:#6B7280;">
        Menampilkan <strong style="color:#1A1A2E;">{{ $courses->total() }}</strong> kelas
        @if(request('q')) untuk "<strong>{{ request('q') }}</strong>" @endif
      </p>
    </div>

    {{-- Grid --}}
    @if($courses->isEmpty())
    <div style="text-align:center;padding:4rem 2rem;background:#fff;border-radius:16px;border:1.5px dashed #E5E7EB;">
      <i class="bi-search" style="font-size:2.5rem;color:#CBD5E1;"></i>
      <p style="font-size:1.05rem;font-weight:700;color:#374151;margin-top:1rem;">Kelas tidak ditemukan</p>
      <p style="color:#9CA3AF;font-size:.875rem;margin:.5rem 0 1.5rem;">Coba ubah filter atau kata kunci</p>
      <a href="{{ route('courses.index') }}" style="display:inline-block;background:#1B4F9B;color:#fff;font-weight:700;padding:.75rem 2rem;border-radius:50px;text-decoration:none;font-size:.875rem;">Lihat semua kelas</a>
    </div>
    @else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;">
      @foreach($courses as $course)
      @include('courses._card_home', ['course' => $course])
      @endforeach
    </div>
    @if($courses->hasPages())
    <div style="display:flex;justify-content:center;margin-top:1rem;">{{ $courses->links() }}</div>
    @endif
    @endif
  </div>
</div>

<script>
function applySort(val) {
  const url = new URL(window.location.href);
  url.searchParams.set('sort', val);
  url.searchParams.delete('page');
  window.location.href = url.toString();
}
</script>
@endsection
