@extends('layouts.app')
@section('title', 'Pembayaran — Crygle Academy')
@section('content')

{{-- Stepper --}}
<div style="background:#F8FAFD;border-bottom:1px solid #E5E7EB;padding:1.5rem 0;">
  <div class="max-w-4xl mx-auto px-6">
    <div style="display:flex;align-items:center;justify-content:center;gap:0;">
      {{-- Step 1: Login (done) --}}
      <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;">
        <div style="width:48px;height:48px;background:#1B4F9B;border-radius:10px;display:flex;align-items:center;justify-content:center;">
          <i class="bi-box-arrow-in-right" style="color:#fff;font-size:1.2rem;"></i>
        </div>
        <span style="font-size:.8rem;color:#1B4F9B;font-weight:600;">Login</span>
      </div>
      <div style="flex:1;max-width:160px;height:2px;background:#CBD5E1;margin:0 .5rem;margin-bottom:1.5rem;border-radius:2px;"></div>
      {{-- Step 2: Pembayaran (active) --}}
      <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;">
        <div style="width:48px;height:48px;background:#1B4F9B;border-radius:10px;display:flex;align-items:center;justify-content:center;">
          <i class="bi-credit-card" style="color:#fff;font-size:1.2rem;"></i>
        </div>
        <span style="font-size:.8rem;color:#1B4F9B;font-weight:600;">Pembayaran</span>
      </div>
      <div style="flex:1;max-width:160px;height:2px;background:#E5E7EB;margin:0 .5rem;margin-bottom:1.5rem;border-radius:2px;"></div>
      {{-- Step 3: Review --}}
      <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;">
        <div style="width:48px;height:48px;background:#E5E7EB;border-radius:10px;display:flex;align-items:center;justify-content:center;">
          <i class="bi-clipboard-check" style="color:#9CA3AF;font-size:1.2rem;"></i>
        </div>
        <span style="font-size:.8rem;color:#9CA3AF;font-weight:600;">Review</span>
      </div>
    </div>
  </div>
</div>

<div class="max-w-5xl mx-auto px-6 py-10">
  <h1 style="font-size:1.5rem;font-weight:800;color:#1A1A2E;margin-bottom:2rem;">Metode Pembayaran</h1>

  <div class="grid lg:grid-cols-2 gap-10">

    {{-- Kiri: Form pembayaran --}}
    <div>
      <form action="{{ route('payment.confirm', $transaction) }}" method="POST" id="pay-form">
        @csrf

        {{-- Debit/Credit Card (default selected) --}}
        <div style="margin-bottom:1.25rem;">
          <label style="display:flex;align-items:center;gap:.875rem;margin-bottom:1rem;cursor:pointer;">
            <div style="width:22px;height:22px;border-radius:50%;border:2px solid #1B4F9B;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <div style="width:10px;height:10px;border-radius:50%;background:#1B4F9B;" id="radio-dot-card"></div>
            </div>
            <span style="font-weight:700;font-size:1rem;color:#1A1A2E;">Debit/Credit Card</span>
            <input type="radio" name="payment_method" value="Kartu Debit/Kredit" checked style="display:none;" id="radio-card">
          </label>

          {{-- Card form --}}
          <div id="card-form" style="padding-left:1.875rem;space-y:.875rem;">
            <div style="margin-bottom:.875rem;">
              <label style="font-size:.8rem;font-weight:600;color:#6B7280;display:block;margin-bottom:.4rem;">Card Number</label>
              <input type="text" placeholder="3897 22XX 1900 3890" maxlength="19" oninput="formatCard(this)"
                     style="width:100%;border:1.5px solid #E5E7EB;border-radius:10px;padding:.75rem 1rem;font-size:.9rem;outline:none;transition:border .15s;"
                     onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
            </div>
            <div style="margin-bottom:.875rem;">
              <label style="font-size:.8rem;font-weight:600;color:#6B7280;display:block;margin-bottom:.4rem;">Card Name</label>
              <input type="text" placeholder="Dimas Pradipa Abiyuda"
                     style="width:100%;border:1.5px solid #E5E7EB;border-radius:10px;padding:.75rem 1rem;font-size:.9rem;outline:none;transition:border .15s;"
                     onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:1.25rem;">
              <div>
                <label style="font-size:.8rem;font-weight:600;color:#6B7280;display:block;margin-bottom:.4rem;">Expiry Date</label>
                <input type="text" placeholder="09/26" maxlength="5" oninput="formatExpiry(this)"
                       style="width:100%;border:1.5px solid #E5E7EB;border-radius:10px;padding:.75rem 1rem;font-size:.9rem;outline:none;transition:border .15s;"
                       onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
              </div>
              <div>
                <label style="font-size:.8rem;font-weight:600;color:#6B7280;display:block;margin-bottom:.4rem;">CVV</label>
                <input type="password" placeholder="•••" maxlength="4"
                       style="width:100%;border:1.5px solid #E5E7EB;border-radius:10px;padding:.75rem 1rem;font-size:.9rem;outline:none;transition:border .15s;"
                       onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
              </div>
            </div>
            <button type="button" style="background:#1B4F9B;color:#fff;font-weight:700;padding:.75rem 1.75rem;border-radius:50px;border:none;cursor:pointer;font-size:.875rem;">
              Add Card
            </button>
          </div>
        </div>

        {{-- Other methods --}}
        @foreach([
          ['BNI Virtual Account',     'bni_va',     'bi-bank'],
          ['Bank Mandiri Virtual Account','mandiri_va','bi-bank2'],
          ['BSI Virtual Account',     'bsi_va',     'bi-bank'],
          ['QRIS',                    'qris',       'bi-qr-code'],
        ] as [$name,$val,$icon])
        <label style="display:flex;align-items:center;gap:.875rem;padding:1rem 0;border-top:1px solid #F0F4F8;cursor:pointer;" onclick="selectMethod('{{ $val }}')">
          <div style="width:22px;height:22px;border-radius:50%;border:2px solid #D1D5DB;display:flex;align-items:center;justify-content:center;flex-shrink:0;" id="radio-dot-{{ $val }}">
            <div style="width:10px;height:10px;border-radius:50%;background:transparent;"></div>
          </div>
          <i class="{{ $icon }}" style="color:#1B4F9B;font-size:1.1rem;"></i>
          <span style="font-weight:600;color:#374151;font-size:.95rem;">{{ $name }}</span>
          <input type="radio" name="payment_method" value="{{ $name }}" style="display:none;" id="radio-{{ $val }}">
        </label>
        @endforeach
      </form>
    </div>

    {{-- Kanan: Pesanan --}}
    <div>
      <div style="background:#fff;border:1.5px solid #E5E7EB;border-radius:16px;overflow:hidden;">

        {{-- Header --}}
        <div style="padding:1.25rem;border-bottom:1px solid #F0F4F8;">
          <p style="font-weight:700;color:#1A1A2E;margin-bottom:1rem;">Pesanan Saya</p>
          <div style="display:flex;gap:.875rem;align-items:flex-start;">
            <div style="width:64px;height:64px;border-radius:10px;overflow:hidden;flex-shrink:0;background:#EEF4FF;">
              <img src="{{ $transaction->course->thumbnailUrl() }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div>
              <p style="font-size:.65rem;font-weight:700;color:#1B4F9B;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.25rem;">KATEGORI KELAS</p>
              <p style="font-weight:700;color:#1A1A2E;font-size:.875rem;line-height:1.4;">{{ $transaction->course->title }}</p>
              <div style="display:flex;align-items:center;gap:.875rem;margin-top:.375rem;">
                <span style="font-size:.75rem;color:#6B7280;display:flex;align-items:center;gap:.25rem;">
                  <i class="bi-clock" style="font-size:.65rem;"></i> 12 Weeks
                </span>
                <span style="font-size:.75rem;color:#6B7280;display:flex;align-items:center;gap:.25rem;">
                  <i class="bi-award" style="font-size:.65rem;"></i> Certification
                </span>
              </div>
            </div>
          </div>
        </div>

        {{-- Kode Promo --}}
        <div style="padding:1.25rem;border-bottom:1px solid #F0F4F8;">
          <p style="font-weight:700;color:#1A1A2E;margin-bottom:.75rem;font-size:.875rem;">Kode Promo</p>
          <div style="display:flex;gap:.5rem;">
            <input type="text" placeholder="Masukan Kode Promo"
                   style="flex:1;border:1.5px solid #E5E7EB;border-radius:10px;padding:.625rem .875rem;font-size:.85rem;outline:none;"
                   onfocus="this.style.borderColor='#1B4F9B'" onblur="this.style.borderColor='#E5E7EB'">
            <button style="background:#1B4F9B;color:#fff;font-weight:700;padding:.625rem 1rem;border-radius:10px;border:none;cursor:pointer;font-size:.85rem;white-space:nowrap;">
              Pakai
            </button>
          </div>
        </div>

        {{-- Rincian harga --}}
        <div style="padding:1.25rem;border-bottom:1px solid #F0F4F8;">
          <p style="font-weight:700;color:#1A1A2E;margin-bottom:.875rem;font-size:.875rem;">Rincian Harga</p>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.625rem;">
            <span style="font-size:.875rem;color:#374151;">Invest Ilmu</span>
            <span style="font-size:.875rem;font-weight:600;color:#1A1A2E;">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.875rem;">
            <span style="font-size:.875rem;color:#374151;">Registration Fee</span>
            <span style="font-size:.875rem;font-weight:600;color:#1A1A2E;">Rp8.000</span>
          </div>
          <div style="border-top:1px solid #F0F4F8;padding-top:.875rem;">
            <div style="display:flex;justify-content:space-between;align-items:baseline;">
              <span style="font-size:.875rem;color:#374151;font-weight:600;">Total Invest</span>
              <span style="font-size:1.5rem;font-weight:800;color:#1B4F9B;">Rp{{ number_format($transaction->amount + 8000, 0, ',', '.') }}</span>
            </div>
          </div>
        </div>

        {{-- Bayar button --}}
        <div style="padding:1.25rem;">
          <button onclick="document.getElementById('pay-form').submit()" style="width:100%;background:#1B4F9B;color:#fff;font-weight:700;padding:1rem;border-radius:50px;border:none;cursor:pointer;font-size:.95rem;transition:background .2s;">
            Bayar Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
function formatCard(el) {
  let v = el.value.replace(/\D/g,'').substring(0,16);
  el.value = v.replace(/(.{4})/g,'$1 ').trim();
}
function formatExpiry(el) {
  let v = el.value.replace(/\D/g,'').substring(0,4);
  if (v.length >= 3) v = v.substring(0,2)+'/'+v.substring(2);
  el.value = v;
}
function selectMethod(id) {
  // Reset all
  ['bni_va','mandiri_va','bsi_va','qris'].forEach(m => {
    const dot = document.getElementById('radio-dot-'+m);
    if (dot) { dot.style.borderColor='#D1D5DB'; dot.querySelector('div').style.background='transparent'; }
    const radio = document.getElementById('radio-'+m);
    if (radio) radio.checked = false;
  });
  // Deselect card
  document.getElementById('radio-dot-card').style.background='transparent';
  document.getElementById('card-form').style.display='none';
  // Select chosen
  const dot = document.getElementById('radio-dot-'+id);
  dot.style.borderColor='#1B4F9B'; dot.querySelector('div').style.background='#1B4F9B';
  document.getElementById('radio-'+id).checked=true;
}
</script>
@endpush
@endsection
