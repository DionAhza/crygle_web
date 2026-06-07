@extends('layouts.app')
@section('title', $course->title . ' — Crygle Academy')
@php use Illuminate\Support\Str; @endphp
@section('content')

{{-- Breadcrumb --}}
<div style="background:#F8FAFD;border-bottom:1px solid #E5E7EB;padding:.75rem 0;">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <nav style="font-size:.8rem;color:#6B7280;display:flex;align-items:center;gap:.5rem;">
      <a href="{{ route('home') }}" style="color:#6B7280;text-decoration:none;">Home</a>
      <i class="bi-chevron-right" style="font-size:.65rem;"></i>
      <a href="{{ route('courses.index') }}" style="color:#6B7280;text-decoration:none;">Course</a>
      <i class="bi-chevron-right" style="font-size:.65rem;"></i>
      <span style="color:#1A1A2E;font-weight:500;">{{ Str::limit($course->title, 50) }}</span>
    </nav>
  </div>
</div>

<div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
  <div class="grid lg:grid-cols-3 gap-8 items-start">

    {{-- ═══ KIRI (2/3) ═══ --}}
    <div class="lg:col-span-2">

      {{-- Video/Thumbnail --}}
      <div style="border-radius:16px;overflow:hidden;background:#1A1A2E;position:relative;margin-bottom:1.5rem;">
        <div style="position:relative;height:340px;">
          <img src="{{ $course->thumbnailUrl() }}" style="width:100%;height:100%;object-fit:cover;opacity:.85;" onerror="this.style.opacity=0">
          <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <a href="{{ $course->trailer_url ?? '#' }}" target="_blank"
               style="width:56px;height:56px;background:rgba(255,255,255,.9);border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:transform .2s;"
               onmouseenter="this.style.transform='scale(1.1)'" onmouseleave="this.style.transform='scale(1)'">
              <i class="bi-play-fill" style="color:#1B4F9B;font-size:1.4rem;margin-left:3px;"></i>
            </a>
          </div>
          <div style="position:absolute;bottom:.75rem;right:.75rem;">
            <a href="{{ $course->trailer_url ?? '#' }}" target="_blank"
               style="background:rgba(0,0,0,.7);color:#fff;font-size:.75rem;padding:.3rem .7rem;border-radius:6px;text-decoration:none;display:flex;align-items:center;gap:.3rem;">
              <i class="bi-youtube text-red-500"></i> Watch on YouTube
            </a>
          </div>
        </div>
      </div>

      {{-- Judul & Meta --}}
      <h1 style="font-size:1.5rem;font-weight:800;color:#1A1A2E;line-height:1.35;margin-bottom:.625rem;">{{ $course->title }}</h1>
      <p style="color:#6B7280;font-size:.9rem;line-height:1.6;margin-bottom:1rem;">{{ Str::limit($course->description, 180) }}</p>

      {{-- Stats row --}}
      @php $avg = $course->averageRating(); $cnt = $course->reviews->count(); @endphp
      <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;padding:1rem 0;border-top:1px solid #F0F4F8;border-bottom:1px solid #F0F4F8;margin-bottom:1.5rem;">
        <div style="display:flex;flex-direction:column;gap:.15rem;">
          <span style="font-size:.7rem;color:#6B7280;text-transform:uppercase;letter-spacing:.5px;font-weight:600;">Review</span>
          <div style="display:flex;align-items:center;gap:.3rem;">
            <span style="color:#F59E0B;font-size:1rem;">★</span>
            <span style="font-weight:700;color:#1A1A2E;font-size:.9rem;">{{ $avg > 0 ? $avg : '4.3' }}</span>
            <span style="color:#6B7280;font-size:.8rem;">({{ $cnt > 0 ? number_format($cnt/100,1).'K' : '1.6K' }} Reviews)</span>
          </div>
        </div>
        <div style="width:1px;height:32px;background:#E5E7EB;"></div>
        <div style="display:flex;flex-direction:column;gap:.15rem;">
          <span style="font-size:.7rem;color:#6B7280;text-transform:uppercase;letter-spacing:.5px;font-weight:600;">Durasi</span>
          <span style="font-weight:600;color:#1A1A2E;font-size:.9rem;">{{ $course->totalDurationFormatted() ?: '20 Jam 20 Menit' }}</span>
        </div>
        <div style="margin-left:auto;">
          <button style="display:flex;align-items:center;gap:.5rem;border:1.5px solid #E5E7EB;background:#fff;padding:.5rem 1.125rem;border-radius:50px;cursor:pointer;font-size:.85rem;font-weight:600;color:#374151;">
            <i class="bi-share" style="color:#1B4F9B;"></i> Share
          </button>
        </div>
      </div>

      {{-- TABS --}}
      <div style="border-bottom:2px solid #F0F4F8;margin-bottom:1.75rem;" id="tabs">
        <div style="display:flex;gap:0;">
          @foreach(['overview'=>'Overview','kurikulum'=>'Kurikulum Kelas','mentor'=>'Tentang Mentor','reviews'=>'Reviews'] as $k=>$v)
          <button onclick="switchTab('{{ $k }}')" id="tab-{{ $k }}"
                  style="padding:.875rem 1.25rem;font-size:.875rem;font-weight:600;border:none;background:transparent;cursor:pointer;border-bottom:2px solid transparent;margin-bottom:-2px;transition:all .15s;"
                  class="{{ $k === 'overview' ? 'tab-active-btn' : '' }}">
            {{ $v }}
          </button>
          @endforeach
        </div>
      </div>

      {{-- Tab: Overview --}}
      <div id="panel-overview">
        <h3 style="font-weight:700;color:#1A1A2E;margin-bottom:.875rem;">Course Overview</h3>
        <p style="color:#374151;font-size:.9rem;line-height:1.8;margin-bottom:1rem;">{{ $course->description }}</p>

        @if($course->what_you_learn && count($course->what_you_learn) > 0)
        <h3 style="font-weight:700;color:#1A1A2E;margin:1.5rem 0 .875rem;">Apa yang Akan Kamu Dapat?</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.625rem;">
          @foreach($course->what_you_learn as $point)
          <div style="display:flex;align-items:flex-start;gap:.625rem;font-size:.875rem;color:#374151;">
            <div style="width:20px;height:20px;border-radius:50%;border:1.5px solid #1B4F9B;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
              <i class="bi-check" style="color:#1B4F9B;font-size:.7rem;"></i>
            </div>
            <span>{{ $point }}</span>
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- Tab: Kurikulum --}}
      <div id="panel-kurikulum" style="display:none;">
        @if($course->sections->isEmpty())
        <p style="color:#6B7280;text-align:center;padding:2rem;">Belum ada kurikulum.</p>
        @else
        <div class="space-y-2" x-data="{ open: 0 }">
          @foreach($course->sections as $sec)
          @php $isFirst = $loop->first; @endphp
          <div>
            {{-- Chapter header --}}
            <button onclick="toggleChapter({{ $loop->index }})" id="ch-btn-{{ $loop->index }}"
                    style="width:100%;background:#1B4F9B;color:#fff;border:none;border-radius:10px;padding:.875rem 1.25rem;display:flex;justify-content:space-between;align-items:center;cursor:pointer;font-weight:600;font-size:.875rem;text-align:left;">
              <span>Chapter {{ $loop->iteration }} : {{ $sec->title }}</span>
              <i class="bi-chevron-{{ $isFirst ? 'up' : 'down' }}" id="ch-icon-{{ $loop->index }}" style="font-size:.8rem;"></i>
            </button>
            {{-- Lessons --}}
            <div id="ch-{{ $loop->index }}" style="{{ $isFirst ? '' : 'display:none;' }}border:1px solid #E5E7EB;border-top:none;border-radius:0 0 10px 10px;">
              @foreach($sec->lessons as $lesson)
              <div style="display:flex;align-items:center;gap:.875rem;padding:.875rem 1.25rem;border-bottom:1px solid #F0F4F8;last-child:border-0;">
                <div style="width:24px;height:24px;border-radius:50%;border:1.5px solid {{ $lesson->is_preview ? '#1B4F9B' : '#E5E7EB' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                  <i class="bi-check" style="color:{{ $lesson->is_preview ? '#1B4F9B' : '#9CA3AF' }};font-size:.7rem;"></i>
                </div>
                <span style="flex:1;font-size:.875rem;color:#374151;">{{ $lesson->title }}</span>
                @if($lesson->is_preview)
                <div style="width:32px;height:32px;border-radius:50%;background:#EEF4FF;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                  <i class="bi-play-fill" style="color:#1B4F9B;font-size:.75rem;margin-left:2px;"></i>
                </div>
                @else
                <div style="width:32px;height:32px;border-radius:50%;background:#F0F4F8;display:flex;align-items:center;justify-content:center;">
                  <i class="bi-play-fill" style="color:#9CA3AF;font-size:.75rem;margin-left:2px;"></i>
                </div>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- Tab: Mentor --}}
      <div id="panel-mentor" style="display:none;">
        <div style="border:1px solid #E5E7EB;border-radius:16px;padding:1.75rem;">
          <div style="display:flex;align-items:flex-start;gap:1.25rem;margin-bottom:1.25rem;">
            <img src="{{ $course->instructor->avatarUrl() }}" style="width:72px;height:72px;border-radius:50%;object-fit:cover;flex-shrink:0;">
            <div>
              <h3 style="font-weight:800;color:#1A1A2E;font-size:1.1rem;">{{ $course->instructor->name }}</h3>
              <p style="color:#1B4F9B;font-size:.875rem;margin-top:.2rem;">{{ $course->instructor->headline ?? 'Instructor di Crygle Academy' }}</p>
            </div>
          </div>
          <p style="color:#374151;font-size:.875rem;line-height:1.8;margin-bottom:1.25rem;">
            {{ $course->instructor->bio ?? 'Seorang profesional berpengalaman yang telah membantu ribuan pelajar menguasai skill digital.' }}
          </p>
          <div style="display:flex;gap:2.5rem;padding-top:1rem;border-top:1px solid #F0F4F8;">
            <div>
              <div style="display:flex;align-items:center;gap:.3rem;">
                <span style="color:#F59E0B;">★</span>
                <span style="font-weight:700;color:#1A1A2E;">4.8</span>
              </div>
              <p style="color:#6B7280;font-size:.8rem;">(2.650 Reviews)</p>
            </div>
            <div>
              <p style="font-weight:700;color:#1A1A2E;">3.000 Siswa</p>
              <p style="color:#6B7280;font-size:.8rem;">Total Siswa</p>
            </div>
            <div>
              <p style="font-weight:700;color:#1A1A2E;">{{ \App\Models\Course::where('user_id',$course->user_id)->count() }} Course</p>
              <p style="color:#6B7280;font-size:.8rem;">Total Course</p>
            </div>
          </div>
          <p style="margin-top:1.25rem;font-style:italic;color:#374151;font-size:.875rem;border-top:1px solid #F0F4F8;padding-top:1rem;">
            "Semua orang bisa mulai dari nol. Yang penting adalah mulai dulu dan konsisten."
          </p>
        </div>
      </div>

      {{-- Tab: Reviews --}}
      <div id="panel-reviews" style="display:none;">
        @if($course->reviews->count() > 0)
        {{-- Rating summary --}}
        <div style="display:flex;gap:2.5rem;align-items:center;background:#F8FAFD;border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;flex-wrap:wrap;">
          <div style="text-align:center;">
            <p style="font-size:3.5rem;font-weight:800;color:#1A1A2E;line-height:1;">{{ $course->averageRating() }}</p>
            <div style="color:#F59E0B;font-size:1.2rem;">★★★★★</div>
            <p style="color:#6B7280;font-size:.8rem;margin-top:.25rem;">{{ $cnt }} ulasan</p>
          </div>
          <div style="flex:1;min-width:200px;space-y:.5rem;">
            @for($i=5;$i>=1;$i--)
            @php $pct = $course->reviews->count() > 0 ? round($course->reviews->where('rating',$i)->count()/$course->reviews->count()*100) : 0; @endphp
            <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:.375rem;">
              <span style="font-size:.75rem;color:#374151;width:8px;">{{ $i }}</span>
              <span style="color:#F59E0B;font-size:.75rem;">★</span>
              <div style="flex:1;height:6px;background:#E5E7EB;border-radius:3px;overflow:hidden;">
                <div style="height:100%;background:#F59E0B;border-radius:3px;width:{{ $pct }}%;"></div>
              </div>
              <span style="font-size:.75rem;color:#6B7280;width:28px;text-align:right;">{{ $pct }}%</span>
            </div>
            @endfor
          </div>
        </div>
        {{-- Review list --}}
        <div class="space-y-4">
          @foreach($course->reviews->take(5) as $rev)
          <div style="display:flex;gap:.875rem;">
            <img src="{{ $rev->user->avatarUrl() }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;flex-shrink:0;">
            <div style="flex:1;">
              <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.25rem;flex-wrap:wrap;">
                <span style="font-weight:700;font-size:.875rem;color:#1A1A2E;">{{ $rev->user->name }}</span>
                <span style="color:#F59E0B;font-size:.8rem;">{{ str_repeat('★',$rev->rating) }}</span>
                <span style="color:#9CA3AF;font-size:.75rem;margin-left:auto;">{{ $rev->created_at->diffForHumans() }}</span>
              </div>
              @if($rev->comment)<p style="color:#374151;font-size:.875rem;line-height:1.6;">{{ $rev->comment }}</p>@endif
            </div>
          </div>
          @endforeach
        </div>
        @else
        <p style="text-align:center;color:#6B7280;padding:2.5rem;">Belum ada ulasan untuk course ini.</p>
        @endif

        {{-- Form review --}}
        @auth
        @if(auth()->user()->isEnrolled($course))
        <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid #F0F4F8;">
          <h3 style="font-weight:700;color:#1A1A2E;margin-bottom:1rem;">{{ $userReview ? 'Edit Ulasanmu' : 'Tulis Ulasan' }}</h3>
          <form action="{{ route('review.store', $course) }}" method="POST">
            @csrf
            <div style="margin-bottom:1rem;">
              <label style="font-size:.85rem;font-weight:600;color:#374151;display:block;margin-bottom:.5rem;">Rating</label>
              <div style="display:flex;gap:.375rem;" id="stars">
                @for($i=1;$i<=5;$i++)
                <button type="button" onclick="setRating({{ $i }})" data-val="{{ $i }}"
                        style="font-size:2rem;color:{{ $i <= ($userReview->rating ?? 0) ? '#F59E0B' : '#E5E7EB' }};background:none;border:none;cursor:pointer;transition:color .1s;line-height:1;">★</button>
                @endfor
              </div>
              <input type="hidden" name="rating" id="rating-val" value="{{ $userReview->rating ?? '' }}" required>
            </div>
            <div style="margin-bottom:1rem;">
              <label style="font-size:.85rem;font-weight:600;color:#374151;display:block;margin-bottom:.5rem;">Komentar</label>
              <textarea name="comment" rows="3" style="width:100%;border:1.5px solid #E5E7EB;border-radius:10px;padding:.75rem 1rem;font-size:.875rem;outline:none;resize:none;font-family:inherit;" placeholder="Bagikan pengalamanmu...">{{ $userReview->comment ?? '' }}</textarea>
            </div>
            <button type="submit" style="background:#1B4F9B;color:#fff;font-weight:700;padding:.75rem 2rem;border-radius:50px;border:none;cursor:pointer;font-size:.875rem;">
              {{ $userReview ? 'Update Ulasan' : 'Kirim Ulasan' }}
            </button>
          </form>
        </div>
        @endif
        @endauth
      </div>

      {{-- Course Serupa --}}
      @if($related->isNotEmpty())
      <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid #F0F4F8;">
        <h2 style="font-size:1.25rem;font-weight:800;color:#1A1A2E;margin-bottom:1.25rem;">Course Serupa</h2>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
          @foreach($related as $r)
          @include('courses._card_home', ['course' => $r])
          @endforeach
        </div>
      </div>
      @endif
    </div>

    {{-- ═══ KANAN: Invest Card (sticky) ═══ --}}
    <div style="position:sticky;top:80px;">
      <div style="background:#fff;border:1.5px solid #E5E7EB;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);">
        <div style="padding:1.25rem 1.25rem .5rem;">
          <p style="font-size:.75rem;color:#6B7280;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.25rem;">Invest</p>
          <div style="display:flex;align-items:baseline;gap:.625rem;margin-bottom:.375rem;">
            <span style="font-size:1.75rem;font-weight:800;color:#1B4F9B;">
              @if($course->isFree()) Rp0
              @else Rp{{ number_format($course->effectivePrice(), 0, ',', '.') }}
              @endif
            </span>
            @if($course->originalPrice())
              <span style="color:#9CA3AF;text-decoration:line-through;font-size:.85rem;">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
              <span style="background:#FEE2E2;color:#DC2626;font-size:.65rem;font-weight:700;padding:.15rem .5rem;border-radius:4px;">{{ $course->discountPercent() }}% off</span>
            @endif
          </div>
        </div>

        <div style="padding:.875rem 1.25rem 1.25rem;">
          {{-- CTA Button --}}
          @include('courses._enroll_btn')

          {{-- Features list --}}
          <div style="margin-top:1.25rem;space-y:.625rem;">
            @foreach([
              ['bi-clock','20+ Jam Durasi Belajar'],
              ['bi-bar-chart',''.($course->levelLabel()).' Level Class'],
              ['bi-chat-dots','Konsultasi Kapan Saja'],
              ['bi-infinity','Lifetime Access/Akses Seumur Hidup'],
              ['bi-award','Certificate of Completion'],
            ] as [$icon,$label])
            <div style="display:flex;align-items:center;gap:.75rem;padding:.5rem 0;border-bottom:1px solid #F8FAFD;">
              <div style="width:34px;height:34px;background:#EEF4FF;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="{{ $icon }}" style="color:#1B4F9B;font-size:.9rem;"></i>
              </div>
              <span style="font-size:.85rem;color:#374151;font-weight:500;">{{ $label }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@push('scripts')
<script>
// Tab switching
const tabs = ['overview','kurikulum','mentor','reviews'];
function switchTab(id) {
  tabs.forEach(t => {
    document.getElementById('panel-'+t).style.display = t===id ? 'block' : 'none';
    const btn = document.getElementById('tab-'+t);
    if (t===id) { btn.style.color='#1B4F9B'; btn.style.borderBottomColor='#1B4F9B'; }
    else         { btn.style.color='#6B7280'; btn.style.borderBottomColor='transparent'; }
  });
}
// Init: set tab-overview active
switchTab('overview');

// Chapter accordion
function toggleChapter(idx) {
  const panel = document.getElementById('ch-'+idx);
  const icon  = document.getElementById('ch-icon-'+idx);
  if (panel.style.display === 'none') {
    panel.style.display = 'block';
    icon.className = 'bi-chevron-up';
  } else {
    panel.style.display = 'none';
    icon.className = 'bi-chevron-down';
  }
}

// Star rating
function setRating(val) {
  document.getElementById('rating-val').value = val;
  document.querySelectorAll('#stars button').forEach((b,i) => {
    b.style.color = i < val ? '#F59E0B' : '#E5E7EB';
  });
}
</script>
@endpush
@endsection
