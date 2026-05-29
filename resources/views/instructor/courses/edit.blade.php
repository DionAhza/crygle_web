@extends('layouts.instructor')
@section('title','Edit Course')
@section('page-title','Edit Course')
@section('page-sub', Str::limit($course->title, 50))
@php use Illuminate\Support\Str; @endphp
@section('content')

@if($errors->any())
<div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5 space-y-1">
  @foreach($errors->all() as $e)<p class="text-red-700 text-sm flex items-center gap-2"><i class="bi-exclamation-circle text-red-400"></i>{{ $e }}</p>@endforeach
</div>
@endif

<div class="grid lg:grid-cols-5 gap-6 items-start">

  {{-- LEFT: Edit form --}}
  <div class="lg:col-span-2">
    <form action="{{ route('instructor.courses.update',$course) }}" method="POST">
      @csrf @method('PUT')
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 space-y-3 mb-4">
        <h3 class="font-bold text-slate-600 text-xs uppercase tracking-wider border-b border-slate-100 pb-2">Info Course</h3>

        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Judul *</label>
          <input type="text" name="title" value="{{ old('title',$course->title) }}" required class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Kategori</label>
            <select name="category_id" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="">Pilih...</option>
              @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id',$course->category_id)==$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Level *</label>
            <select name="level" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
              @foreach(['beginner'=>'🟢 Pemula','intermediate'=>'🟡 Menengah','advanced'=>'🔴 Mahir'] as $v=>$l)
              <option value="{{ $v }}" {{ old('level',$course->level)===$v ? 'selected' : '' }}>{{ $l }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Harga (Rp) *</label>
            <input type="number" name="price" value="{{ old('price',$course->price) }}" min="0" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Harga Diskon</label>
            <input type="number" name="discount_price" value="{{ old('discount_price',$course->discount_price) }}" min="0" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Bahasa</label>
          <input type="text" name="language" value="{{ old('language',$course->language) }}" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Thumbnail URL</label>
          <input type="url" name="thumbnail" value="{{ old('thumbnail',$course->thumbnail) }}" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Trailer URL (YouTube)</label>
          <input type="url" name="trailer_url" value="{{ old('trailer_url',$course->trailer_url) }}" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Deskripsi *</label>
          <textarea name="description" rows="4" required class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('description',$course->description) }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Yang Dipelajari (1 per baris)</label>
          <textarea name="what_you_learn" rows="4" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('what_you_learn', $course->what_you_learn ? implode("\n",$course->what_you_learn) : '') }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">Prasyarat (1 per baris)</label>
          <textarea name="requirements" rows="3" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('requirements', $course->requirements ? implode("\n",$course->requirements) : '') }}</textarea>
        </div>
      </div>
      <button type="submit" class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 rounded-full transition text-sm">
        Simpan Perubahan
      </button>
    </form>

    {{-- Publish toggle --}}
    <form action="{{ route('instructor.courses.publish',$course) }}" method="POST" class="mt-3">
      @csrf @method('PATCH')
      <button class="w-full border-2 {{ $course->isPublished() ? 'border-amber-400 text-amber-700 hover:bg-amber-50' : 'border-emerald-500 text-emerald-700 hover:bg-emerald-50' }} font-semibold py-3 rounded-full transition text-sm">
        {{ $course->isPublished() ? '📝 Jadikan Draft' : '🌐 Publikasikan Course' }}
      </button>
    </form>
  </div>

  {{-- RIGHT: Curriculum manager --}}
  <div class="lg:col-span-3 space-y-4">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-slate-800">📚 Kurikulum</h3>
        <span class="text-xs text-slate-400">{{ $course->sections->count() }} section · {{ $course->totalLessons() }} lesson</span>
      </div>
      {{-- Add section --}}
      <form action="{{ route('instructor.courses.sections.store',$course) }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="title" required placeholder="Nama section baru..."
               class="flex-1 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button class="bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition flex-shrink-0">+ Section</button>
      </form>
    </div>

    @forelse($course->sections as $section)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
      {{-- Section header --}}
      <div class="flex items-center gap-3 px-5 py-4 bg-slate-50 border-b border-slate-100">
        <span class="w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex items-center justify-center flex-shrink-0">{{ $loop->iteration }}</span>
        <span class="font-semibold text-slate-800 text-sm flex-1">{{ $section->title }}</span>
        <span class="text-xs text-slate-400">{{ $section->lessons->count() }} lesson</span>
        <button onclick="toggleEl('es-{{ $section->id }}')" class="text-slate-400 hover:text-blue-600 transition text-sm"><i class="bi-pencil"></i></button>
        <form action="{{ route('instructor.courses.sections.destroy',[$course,$section]) }}" method="POST" onsubmit="return confirm('Hapus section ini dan semua lessonnya?')">@csrf @method('DELETE')
          <button class="text-slate-400 hover:text-red-600 transition text-sm"><i class="bi-trash"></i></button>
        </form>
      </div>
      {{-- Edit section --}}
      <div id="es-{{ $section->id }}" class="hidden px-5 py-3 bg-blue-50 border-b border-slate-100">
        <form action="{{ route('instructor.courses.sections.update',[$course,$section]) }}" method="POST" class="flex gap-2">
          @csrf @method('PUT')
          <input type="text" name="title" value="{{ $section->title }}" required class="flex-1 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          <button class="bg-blue-700 text-white text-sm px-4 py-2 rounded-xl">Simpan</button>
          <button type="button" onclick="toggleEl('es-{{ $section->id }}')" class="text-slate-500 text-sm px-3">Batal</button>
        </form>
      </div>

      {{-- Lessons --}}
      <div class="divide-y divide-slate-50">
        @forelse($section->lessons as $lesson)
        <div class="px-5 py-3">
          <div class="flex items-center gap-3">
            <div class="w-7 h-7 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center flex-shrink-0 text-xs"><i class="bi-play-fill"></i></div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-slate-800 truncate">{{ $lesson->title }}</p>
              <div class="flex items-center gap-3 text-xs text-slate-400">
                @if($lesson->duration_seconds > 0)<span>{{ $lesson->durationFormatted() }}</span>@endif
                @if($lesson->is_preview)<span class="text-emerald-600 font-medium">Preview</span>@endif
              </div>
            </div>
            <button onclick="toggleEl('el-{{ $lesson->id }}')" class="text-slate-400 hover:text-blue-600 transition text-sm flex-shrink-0"><i class="bi-pencil"></i></button>
            <form action="{{ route('instructor.sections.lessons.destroy',[$section,$lesson]) }}" method="POST" onsubmit="return confirm('Hapus lesson ini?')">@csrf @method('DELETE')
              <button class="text-slate-400 hover:text-red-600 transition text-sm"><i class="bi-trash"></i></button>
            </form>
          </div>
          {{-- Edit lesson --}}
          <div id="el-{{ $lesson->id }}" class="hidden mt-3 bg-slate-50 rounded-xl p-4">
            <form action="{{ route('instructor.sections.lessons.update',[$section,$lesson]) }}" method="POST">
              @csrf @method('PUT')
              <div class="grid grid-cols-2 gap-3 mb-3">
                <div class="col-span-2"><input type="text" name="title" value="{{ $lesson->title }}" required placeholder="Judul lesson" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></div>
                <div class="col-span-2"><input type="url" name="video_url" value="{{ $lesson->video_url }}" placeholder="URL YouTube" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></div>
                <input type="number" name="duration_seconds" value="{{ $lesson->duration_seconds }}" placeholder="Durasi (detik)" min="0" class="border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <label class="flex items-center gap-2 text-sm text-slate-600">
                  <input type="checkbox" name="is_preview" {{ $lesson->is_preview ? 'checked' : '' }} class="accent-blue-600"> Preview Gratis
                </label>
                <div class="col-span-2"><textarea name="notes" rows="2" placeholder="Catatan lesson..." class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ $lesson->notes }}</textarea></div>
              </div>
              <div class="flex gap-2">
                <button class="bg-blue-700 text-white text-sm px-4 py-2 rounded-xl">Simpan</button>
                <button type="button" onclick="toggleEl('el-{{ $lesson->id }}')" class="text-slate-500 text-sm px-3">Batal</button>
              </div>
            </form>
          </div>
        </div>
        @empty
        <div class="px-5 py-3 text-xs text-slate-400 italic">Belum ada lesson.</div>
        @endforelse
      </div>

      {{-- Add lesson --}}
      <div class="px-5 py-4 bg-slate-50 border-t border-slate-100">
        <form action="{{ route('instructor.sections.lessons.store',$section) }}" method="POST">
          @csrf
          <div class="grid grid-cols-2 gap-2 mb-2">
            <div class="col-span-2"><input type="text" name="title" placeholder="Judul lesson baru..." required class="w-full border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500"></div>
            <input type="url" name="video_url" placeholder="URL YouTube" class="border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="number" name="duration_seconds" placeholder="Durasi (detik)" min="0" class="border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
            <label class="flex items-center gap-1.5 text-xs text-slate-500 col-span-2">
              <input type="checkbox" name="is_preview" class="accent-blue-600"> Preview Gratis
            </label>
          </div>
          <button class="w-full text-xs text-blue-700 border border-blue-200 hover:bg-blue-50 py-2 rounded-xl transition font-semibold">+ Tambah Lesson</button>
        </form>
      </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl border border-dashed border-slate-200 py-10 text-center text-slate-400 text-sm">
      Belum ada section. Tambahkan section di atas.
    </div>
    @endforelse
  </div>
</div>

@push('scripts')
<script>
function toggleEl(id) {
  const el = document.getElementById(id);
  el.classList.toggle('hidden');
}
</script>
@endpush
@endsection
