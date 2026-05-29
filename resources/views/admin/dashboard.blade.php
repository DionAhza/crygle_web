@extends('layouts.admin')
@section('title','Dashboard Admin')
@section('page-title','Dashboard')
@section('page-sub','Selamat datang, ' . auth()->user()->name)
@section('content')

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
  @foreach([
    ['bi-people-fill',         'blue',   'Total Students',    number_format($stats['users'])],
    ['bi-easel2',              'purple', 'Instructor',        number_format($stats['instructors'])],
    ['bi-collection-play-fill','indigo', 'Total Course',      number_format($stats['courses'])],
    ['bi-person-check-fill',   'cyan',   'Total Enrollment',  number_format($stats['enrollments'])],
    ['bi-cash-stack',          'emerald','Revenue (Paid)',     'Rp '.number_format($stats['revenue'],0,',','.')],
    ['bi-hourglass-split',     'amber',  'Pending Transaksi', $stats['pending_tx']],
  ] as [$icon,$color,$label,$val])
  <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
    <div class="w-9 h-9 rounded-xl bg-{{ $color }}-100 text-{{ $color }}-600 flex items-center justify-center mb-3">
      <i class="{{ $icon }} text-sm"></i>
    </div>
    <p class="text-lg font-bold text-slate-800 leading-tight">{{ $val }}</p>
    <p class="text-xs text-slate-400 mt-0.5">{{ $label }}</p>
  </div>
  @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-6">
  {{-- Top Courses --}}
  <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-bold text-slate-800">🏆 Top Course</h2>
      <a href="{{ route('admin.courses.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua</a>
    </div>
    <div class="space-y-3">
      @foreach($topCourses as $c)
      <div class="flex items-center gap-3">
        <div class="w-10 h-8 rounded-lg overflow-hidden flex-shrink-0">
          <img src="{{ $c->thumbnailUrl() }}" class="w-full h-full object-cover">
        </div>
        <div class="flex-1 min-w-0">
          <p class="font-medium text-slate-800 text-sm truncate">{{ $c->title }}</p>
          <p class="text-xs text-slate-400">{{ $c->enrollments_count }} pelajar · ★ {{ round($c->reviews_avg_rating ?? 0,1) }}</p>
        </div>
        @php $badge = $c->statusBadge(); @endphp
        <span class="badge {{ $badge['class'] }} text-xs flex-shrink-0">{{ $badge['label'] }}</span>
      </div>
      @endforeach
    </div>
  </div>

  {{-- Recent Users --}}
  <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-bold text-slate-800">👤 User Terbaru</h2>
      <a href="{{ route('admin.users.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua</a>
    </div>
    <div class="space-y-3">
      @foreach($recentUsers as $u)
      <div class="flex items-center gap-3">
        <img src="{{ $u->avatarUrl() }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
        <div class="flex-1 min-w-0">
          <p class="font-medium text-slate-800 text-sm truncate">{{ $u->name }}</p>
          <p class="text-xs text-slate-400 truncate">{{ $u->email }}</p>
        </div>
        <span class="text-xs text-slate-400 flex-shrink-0">{{ $u->created_at->diffForHumans() }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- Recent Transactions --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
  <div class="px-5 py-4 border-b border-slate-50 flex items-center justify-between">
    <h2 class="font-bold text-slate-800">💳 Transaksi Terbaru</h2>
    <a href="{{ route('admin.transactions.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua</a>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100 text-xs">
        <tr>
          <th class="text-left px-5 py-3 font-semibold text-slate-500 uppercase tracking-wider">Invoice</th>
          <th class="text-left px-5 py-3 font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">User</th>
          <th class="text-left px-5 py-3 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Course</th>
          <th class="text-left px-5 py-3 font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
          <th class="text-left px-5 py-3 font-semibold text-slate-500 uppercase tracking-wider">Status</th>
          <th class="px-5 py-3"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-50">
        @foreach($recentTransactions as $tx)
        @php $badge = $tx->statusBadge(); @endphp
        <tr class="hover:bg-slate-50 transition">
          <td class="px-5 py-3.5 font-mono text-xs text-slate-600">{{ $tx->invoice_number }}</td>
          <td class="px-5 py-3.5 hidden md:table-cell">
            <div class="flex items-center gap-2">
              <img src="{{ $tx->user->avatarUrl() }}" class="w-6 h-6 rounded-full object-cover">
              <span class="text-slate-700 text-xs truncate max-w-28">{{ $tx->user->name }}</span>
            </div>
          </td>
          <td class="px-5 py-3.5 hidden lg:table-cell text-slate-600 text-xs max-w-40 truncate">{{ $tx->course->title }}</td>
          <td class="px-5 py-3.5 font-semibold text-slate-800 text-xs">{{ $tx->formattedAmount() }}</td>
          <td class="px-5 py-3.5"><span class="badge {{ $badge['class'] }} text-xs">{{ $badge['label'] }}</span></td>
          <td class="px-5 py-3.5 text-xs text-slate-400">{{ $tx->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
