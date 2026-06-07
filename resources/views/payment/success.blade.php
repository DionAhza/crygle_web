@extends('layouts.app')
@section('title', 'Pembayaran Berhasil — Crygle Academy')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:3rem 1.5rem;">
  <div style="max-width:520px;width:100%;text-align:center;">

    {{-- Checkmark --}}
    <div style="width:90px;height:90px;background:#F0FDF4;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 1.75rem;box-shadow:0 4px 20px rgba(34,197,94,.15);">
      <i class="bi-check-circle-fill" style="font-size:3rem;color:#22C55E;"></i>
    </div>

    <h1 style="font-size:2rem;font-weight:800;color:#1A1A2E;margin-bottom:.75rem;">Pembayaran Berhasil! 🎉</h1>
    <p style="color:#6B7280;font-size:.95rem;line-height:1.7;margin-bottom:2.5rem;">
      Kamu sudah berhasil bergabung di kelas ini. Perjalanan belajarmu<br>dimulai sekarang di sanctuary digital kami.
    </p>

    {{-- Course card --}}
    @if(isset($enrollment))
    <div style="background:#fff;border:1.5px solid #E5E7EB;border-radius:16px;padding:1.25rem;margin-bottom:2rem;text-align:left;">
      <div style="display:flex;gap:.875rem;align-items:flex-start;margin-bottom:1.25rem;">
        <div style="width:56px;height:56px;border-radius:10px;overflow:hidden;flex-shrink:0;background:#EEF4FF;">
          <img src="{{ $enrollment->course->thumbnailUrl() }}" style="width:100%;height:100%;object-fit:cover;">
        </div>
        <div>
          <p style="font-weight:700;color:#1A1A2E;font-size:.875rem;line-height:1.4;">{{ $enrollment->course->title }}</p>
          <p style="font-size:.8rem;color:#1B4F9B;margin-top:.2rem;">{{ $enrollment->course->category?->name ?? 'Advanced UI/UX Design' }}</p>
        </div>
      </div>
      <div>
        <div style="display:flex;justify-content:space-between;margin-bottom:.375rem;">
          <span style="font-size:.85rem;color:#374151;font-weight:600;">Progress Belajar</span>
          <span style="font-size:.85rem;color:#1B4F9B;font-weight:700;">0%</span>
        </div>
        <div style="height:6px;background:#E5E7EB;border-radius:3px;overflow:hidden;margin-bottom:.375rem;">
          <div style="width:2%;height:100%;background:#1B4F9B;border-radius:3px;"></div>
        </div>
        <p style="font-size:.78rem;color:#9CA3AF;text-align:center;">Belum ada materi yang diselesaikan</p>
      </div>
    </div>

    {{-- Buttons --}}
    @php $firstLesson = $enrollment->course->sections->first()?->lessons->first(); @endphp
    <div style="display:flex;gap:1rem;justify-content:center;margin-bottom:2rem;">
      @if($firstLesson)
      <a href="{{ route('learn.lesson', [$enrollment, $firstLesson]) }}"
         style="background:#1B4F9B;color:#fff;font-weight:700;padding:1rem 2rem;border-radius:50px;text-decoration:none;font-size:.9rem;transition:background .2s;">
        Mulai Belajar
      </a>
      @endif
      <a href="{{ route('dashboard') }}"
         style="border:2px solid #1B4F9B;color:#1B4F9B;font-weight:700;padding:1rem 2rem;border-radius:50px;text-decoration:none;font-size:.9rem;transition:all .2s;"
         onmouseenter="this.style.background='#EEF4FF'" onmouseleave="this.style.background='transparent'">
        Lihat Kuitansi
      </a>
    </div>

    {{-- Feature badges --}}
    <div style="display:flex;justify-content:center;gap:2.5rem;flex-wrap:wrap;">
      @foreach([['bi-shield-check','AKSES SELAMANYA'],['bi-award','SERTIFIKAT RESMI'],['bi-chat-dots','GRUP KOMUNITAS']] as [$icon,$label])
      <div style="display:flex;flex-direction:column;align-items:center;gap:.375rem;">
        <div style="width:40px;height:40px;background:#EEF4FF;border-radius:10px;display:flex;align-items:center;justify-content:center;">
          <i class="{{ $icon }}" style="color:#1B4F9B;font-size:1.1rem;"></i>
        </div>
        <span style="font-size:.65rem;font-weight:700;color:#6B7280;letter-spacing:.5px;">{{ $label }}</span>
      </div>
      @endforeach
    </div>
    @else
    <a href="{{ route('dashboard') }}" style="display:inline-block;background:#1B4F9B;color:#fff;font-weight:700;padding:1rem 2.5rem;border-radius:50px;text-decoration:none;">
      Ke Dashboard
    </a>
    @endif
  </div>
</div>
@endsection
