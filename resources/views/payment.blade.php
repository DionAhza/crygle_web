@extends('layouts.app')
@section('title','Pembayaran — Crygle Academy')
@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-12">
  <div class="text-center mb-8">
    <h1 class="text-2xl font-bold text-slate-900 mb-1">Selesaikan Pembayaran</h1>
    <p class="text-slate-500 text-sm">Invoice: <span class="font-mono font-semibold text-blue-700">{{ $transaction->invoice_number }}</span></p>
  </div>

  <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    {{-- Course info --}}
    <div class="flex items-center gap-4 p-5 border-b border-slate-50">
      <div class="w-20 h-14 rounded-xl overflow-hidden flex-shrink-0">
        <img src="{{ $transaction->course->thumbnailUrl() }}" class="w-full h-full object-cover">
      </div>
      <div class="flex-1 min-w-0">
        <p class="font-bold text-slate-800 text-sm line-clamp-2">{{ $transaction->course->title }}</p>
        <p class="text-xs text-slate-400 mt-0.5">oleh {{ $transaction->course->instructor->name }}</p>
      </div>
    </div>
    {{-- Amount --}}
    <div class="px-5 py-4 bg-blue-50 border-b border-slate-100">
      <div class="flex justify-between items-center">
        <span class="text-slate-600 font-medium">Total Pembayaran</span>
        <span class="text-2xl font-bold text-blue-700">{{ $transaction->formattedAmount() }}</span>
      </div>
    </div>

    {{-- Payment form --}}
    <form action="{{ route('payment.confirm', $transaction) }}" method="POST" class="p-5">
      @csrf
      <label class="block text-sm font-bold text-slate-800 mb-3">Pilih Metode Pembayaran</label>
      <div class="grid grid-cols-2 gap-3 mb-5">
        @foreach([
          ['transfer_bank','🏦','Transfer Bank','BCA, Mandiri, BNI, BRI'],
          ['virtual_account','💳','Virtual Account','Semua bank'],
          ['qris','📱','QRIS','GoPay, OVO, DANA, dll'],
          ['gopay','💚','GoPay','Saldo GoPay'],
        ] as [$val,$icon,$name,$desc])
        <label class="flex items-center gap-3 border-2 border-slate-200 hover:border-blue-400 rounded-xl p-3.5 cursor-pointer transition group has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
          <input type="radio" name="payment_method" value="{{ $val }}" class="sr-only" required>
          <span class="text-2xl">{{ $icon }}</span>
          <div>
            <p class="font-semibold text-slate-800 text-sm">{{ $name }}</p>
            <p class="text-xs text-slate-400">{{ $desc }}</p>
          </div>
        </label>
        @endforeach
      </div>

      {{-- Simulasi note --}}
      <div class="bg-amber-50 border border-amber-200 rounded-xl p-3.5 mb-5">
        <p class="text-amber-700 text-xs font-medium flex items-center gap-2">
          <i class="bi-info-circle-fill"></i>
          Ini adalah simulasi pembayaran. Klik konfirmasi untuk langsung mendapatkan akses course.
        </p>
      </div>

      <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 rounded-xl transition shadow-md shadow-blue-200 text-sm">
        ✅ Konfirmasi Pembayaran
      </button>
      <a href="{{ route('courses.show', $transaction->course) }}" class="block text-center text-slate-400 text-sm mt-3 hover:text-slate-600 transition">
        Batalkan & kembali
      </a>
    </form>
  </div>

  <p class="text-center text-xs text-slate-400">
    <i class="bi-shield-lock-fill text-emerald-500 mr-1"></i>Pembayaran diamankan dengan enkripsi SSL 256-bit
  </p>
</div>
@endsection
