@extends('layouts.app')
@section('title', 'Memproses Pembayaran — Crygle Academy')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:3rem 1.5rem;">
  <div style="background:#fff;border-radius:20px;border:1.5px solid #E5E7EB;padding:3rem 2.5rem;max-width:500px;width:100%;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,.06);">

    {{-- Icon --}}
    <div style="width:80px;height:80px;border-radius:50%;border:3px solid #1B4F9B;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
      <i class="bi-credit-card-2-front" style="font-size:2.25rem;color:#1B4F9B;"></i>
    </div>

    <h2 style="font-size:1.5rem;font-weight:800;color:#1A1A2E;margin-bottom:.75rem;">Memproses pembayaran<br>kamu...</h2>
    <p style="color:#6B7280;font-size:.9rem;line-height:1.7;margin-bottom:2rem;">
      Mohon tunggu sebentar, kami sedang memastikan transaksi kamu berjalan aman di Sanctuary kami.
    </p>

    <div style="background:#F8FAFD;border-radius:14px;padding:1.25rem;margin-bottom:2rem;">
      <div style="display:flex;justify-content:space-between;align-items:center;padding:.625rem 0;border-bottom:1px solid #E5E7EB;">
        <span style="color:#6B7280;font-size:.875rem;">Merchant</span>
        <span style="font-weight:700;color:#1A1A2E;font-size:.875rem;">CRYGLE Academy</span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:.625rem 0;border-bottom:1px solid #E5E7EB;">
        <span style="color:#6B7280;font-size:.875rem;">Order ID</span>
        <span style="font-weight:700;color:#1A1A2E;font-size:.875rem;font-family:monospace;">#{{ $transaction->invoice_number }}</span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:.625rem 0;">
        <span style="color:#6B7280;font-size:.875rem;">Total</span>
        <span style="font-weight:800;color:#1B4F9B;font-size:1.1rem;">{{ $transaction->formattedAmount() }}</span>
      </div>
    </div>

    <div style="display:flex;align-items:center;justify-content:center;gap:.5rem;color:#6B7280;font-size:.8rem;">
      <i class="bi-shield-lock-fill" style="color:#22C55E;"></i>
      Secured by Encrypted Gateway
    </div>

    {{-- Auto submit form setelah 2 detik --}}
    <form action="{{ route('payment.confirm', $transaction) }}" method="POST" id="auto-confirm" style="display:none;">
      @csrf
      <input type="hidden" name="payment_method" value="{{ $transaction->payment_method ?? 'Transfer Bank' }}">
    </form>
  </div>
</div>
@push('scripts')
<script>
  // Simulate processing then auto-confirm
  setTimeout(() => document.getElementById('auto-confirm').submit(), 2500);
</script>
@endpush
@endsection
