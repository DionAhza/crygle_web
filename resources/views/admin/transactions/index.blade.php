@extends('layouts.admin')
@section('title','Transaksi')
@section('page-title','Manajemen Transaksi')
@section('page-sub','Semua transaksi pembayaran')
@section('content')

{{-- Summary --}}
<div class="grid grid-cols-3 gap-4 mb-6">
  <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
    <p class="text-xs text-slate-400 mb-1">Total Revenue</p>
    <p class="text-xl font-bold text-slate-800">Rp {{ number_format($summary['total'],0,',','.') }}</p>
  </div>
  <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
    <p class="text-xs text-slate-400 mb-1">Revenue Paid</p>
    <p class="text-xl font-bold text-emerald-600">Rp {{ number_format($summary['paid'],0,',','.') }}</p>
  </div>
  <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
    <p class="text-xs text-slate-400 mb-1">Transaksi Pending</p>
    <p class="text-xl font-bold text-amber-600">{{ $summary['pending'] }}</p>
  </div>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100 text-xs">
        <tr>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Invoice</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">User</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Course</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Metode</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Status</th>
          <th class="px-5 py-3.5">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-50">
        @forelse($transactions as $tx)
        @php $badge = $tx->statusBadge(); @endphp
        <tr class="hover:bg-slate-50 transition">
          <td class="px-5 py-3.5">
            <p class="font-mono text-xs text-slate-700">{{ $tx->invoice_number }}</p>
            <p class="text-xs text-slate-400">{{ $tx->created_at->format('d M Y') }}</p>
          </td>
          <td class="px-5 py-3.5 hidden md:table-cell">
            <div class="flex items-center gap-2">
              <img src="{{ $tx->user->avatarUrl() }}" class="w-6 h-6 rounded-full object-cover flex-shrink-0">
              <span class="text-xs text-slate-700 truncate max-w-28">{{ $tx->user->name }}</span>
            </div>
          </td>
          <td class="px-5 py-3.5 hidden lg:table-cell">
            <p class="text-xs text-slate-600 truncate max-w-40">{{ $tx->course->title }}</p>
          </td>
          <td class="px-5 py-3.5 font-semibold text-slate-800 text-xs">{{ $tx->formattedAmount() }}</td>
          <td class="px-5 py-3.5 text-xs text-slate-500">{{ $tx->payment_method ?? '—' }}</td>
          <td class="px-5 py-3.5"><span class="badge {{ $badge['class'] }} text-xs">{{ $badge['label'] }}</span></td>
          <td class="px-5 py-3.5">
            <form action="{{ route('admin.transactions.status',$tx) }}" method="POST" class="flex gap-1">
              @csrf @method('PATCH')
              <select name="status" onchange="this.form.submit()"
                      class="text-xs border border-slate-200 rounded-lg px-2 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach(['pending'=>'Pending','paid'=>'Paid','failed'=>'Failed','refunded'=>'Refund'] as $v=>$l)
                <option value="{{ $v }}" {{ $tx->status===$v ? 'selected' : '' }}>{{ $l }}</option>
                @endforeach
              </select>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-12 text-slate-400">Belum ada transaksi.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($transactions->hasPages())
  <div class="px-5 py-4 border-t border-slate-100">{{ $transactions->links() }}</div>
  @endif
</div>
@endsection
