@extends('layouts.admin')
@section('title','Kelola Course')
@section('page-title','Kelola Course')
@section('page-sub','Semua course di platform')
@section('content')
<div class="flex justify-between items-center mb-5">
  <p class="text-sm text-slate-500">Total <strong>{{ $courses->total() }}</strong> course</p>
</div>
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100 text-xs">
        <tr>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Course</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Instructor</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Pelajar</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Rating</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Status</th>
          <th class="px-5 py-3.5"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-50">
        @forelse($courses as $c)
        @php $badge = $c->statusBadge(); @endphp
        <tr class="hover:bg-slate-50 transition">
          <td class="px-5 py-4">
            <div class="flex items-center gap-3">
              <div class="w-12 h-9 rounded-lg overflow-hidden flex-shrink-0">
                <img src="{{ $c->thumbnailUrl() }}" class="w-full h-full object-cover">
              </div>
              <div class="min-w-0">
                <p class="font-semibold text-slate-800 truncate max-w-52">{{ $c->title }}</p>
                <p class="text-xs text-slate-400">{{ $c->levelLabel() }} · {{ $c->formattedPrice() }}</p>
              </div>
            </div>
          </td>
          <td class="px-5 py-4 hidden md:table-cell text-slate-600 text-xs">{{ $c->instructor->name }}</td>
          <td class="px-5 py-4 hidden lg:table-cell text-slate-600">{{ $c->enrollments_count }}</td>
          <td class="px-5 py-4 hidden lg:table-cell">
            @if($c->reviews_avg_rating)
              <span class="text-amber-500 font-semibold text-xs">★ {{ round($c->reviews_avg_rating,1) }}</span>
            @else <span class="text-slate-300 text-xs">—</span> @endif
          </td>
          <td class="px-5 py-4"><span class="badge {{ $badge['class'] }} text-xs">{{ $badge['label'] }}</span></td>
          <td class="px-5 py-4">
            <div class="flex items-center gap-2 justify-end">
              <a href="{{ route('courses.show',$c) }}" target="_blank" class="text-slate-400 hover:text-blue-600 transition" title="Lihat"><i class="bi-eye"></i></a>
              <form action="{{ route('admin.courses.publish',$c) }}" method="POST">@csrf @method('PATCH')
                <button class="text-slate-400 hover:text-amber-600 transition text-xs" title="{{ $c->isPublished() ? 'Jadikan Draft' : 'Publish' }}">
                  <i class="bi-{{ $c->isPublished() ? 'eye-slash' : 'eye' }}"></i>
                </button>
              </form>
              <form action="{{ route('admin.courses.destroy',$c) }}" method="POST" onsubmit="return confirm('Hapus course ini?')">@csrf @method('DELETE')
                <button class="text-slate-400 hover:text-red-600 transition"><i class="bi-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-12 text-slate-400">Tidak ada course.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($courses->hasPages())
  <div class="px-5 py-4 border-t border-slate-100">{{ $courses->links() }}</div>
  @endif
</div>
@endsection
