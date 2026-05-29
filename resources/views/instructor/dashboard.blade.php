@extends('layouts.instructor')
@section('title','Instructor Dashboard')
@section('page-title','Instructor Studio')
@section('page-sub','Kelola course dan pantau perkembangan pelajarmu')
@section('content')

{{-- Stats --}}
<div class="grid grid-cols-3 gap-4 mb-8">
  <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
    <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-3"><i class="bi-collection-play"></i></div>
    <p class="text-2xl font-bold text-slate-800">{{ $stats['total'] }}</p>
    <p class="text-xs text-slate-400 mt-0.5">Total Course</p>
  </div>
  <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-3"><i class="bi-people"></i></div>
    <p class="text-2xl font-bold text-slate-800">{{ $stats['students'] }}</p>
    <p class="text-xs text-slate-400 mt-0.5">Total Pelajar</p>
  </div>
  <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-3"><i class="bi-cash-stack"></i></div>
    <p class="text-lg font-bold text-slate-800">Rp {{ number_format($stats['revenue'],0,',','.') }}</p>
    <p class="text-xs text-slate-400 mt-0.5">Total Revenue</p>
  </div>
</div>

{{-- Course list --}}
<div class="flex items-center justify-between mb-4">
  <h2 class="font-bold text-slate-800">Course Saya</h2>
  <a href="{{ route('instructor.courses.create') }}" class="bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold px-4 py-2 rounded-full transition flex items-center gap-2">
    <i class="bi-plus-lg"></i> Buat Course
  </a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100 text-xs">
        <tr>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Course</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Pelajar</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Harga</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Status</th>
          <th class="px-5 py-3.5">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-50">
        @forelse($courses as $c)
        @php $badge = $c->statusBadge(); @endphp
        <tr class="hover:bg-slate-50 transition">
          <td class="px-5 py-4">
            <div class="flex items-center gap-3">
              <div class="w-12 h-9 rounded-lg overflow-hidden flex-shrink-0"><img src="{{ $c->thumbnailUrl() }}" class="w-full h-full object-cover"></div>
              <div class="min-w-0">
                <p class="font-semibold text-slate-800 truncate max-w-48">{{ $c->title }}</p>
                <p class="text-xs text-slate-400">{{ $c->levelLabel() }}</p>
              </div>
            </div>
          </td>
          <td class="px-5 py-4 hidden md:table-cell text-slate-600">{{ $c->enrollments_count }}</td>
          <td class="px-5 py-4 hidden lg:table-cell font-semibold {{ $c->isFree() ? 'text-emerald-600' : 'text-blue-700' }}">{{ $c->formattedPrice() }}</td>
          <td class="px-5 py-4"><span class="badge {{ $badge['class'] }} text-xs">{{ $badge['label'] }}</span></td>
          <td class="px-5 py-4">
            <div class="flex items-center gap-2 justify-end">
              <a href="{{ route('instructor.courses.edit',$c) }}" class="text-slate-400 hover:text-blue-600 transition" title="Edit"><i class="bi-pencil text-sm"></i></a>
              <form action="{{ route('instructor.courses.publish',$c) }}" method="POST">@csrf @method('PATCH')
                <button class="text-slate-400 hover:text-amber-600 transition text-xs" title="{{ $c->isPublished() ? 'Draft' : 'Publish' }}">
                  <i class="bi-{{ $c->isPublished() ? 'eye-slash' : 'eye' }} text-sm"></i>
                </button>
              </form>
              <form action="{{ route('instructor.courses.destroy',$c) }}" method="POST" onsubmit="return confirm('Hapus course ini?')">@csrf @method('DELETE')
                <button class="text-slate-400 hover:text-red-600 transition"><i class="bi-trash text-sm"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-12 text-slate-400">
          Belum ada course. <a href="{{ route('instructor.courses.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($courses->hasPages())<div class="px-5 py-4 border-t border-slate-100">{{ $courses->links() }}</div>@endif
</div>
@endsection
