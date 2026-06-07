<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>{{ $lesson->title }} — Crygle Academy</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>
    body { font-family:'Plus Jakarta Sans',sans-serif; background:#F0F4F8; }
    .lesson-item { display:flex; align-items:center; justify-content:space-between; padding:.625rem 1rem; border-radius:8px; cursor:pointer; transition:background .1s; font-size:.825rem; }
    .lesson-item:hover { background:#F0F4F8; }
    .lesson-item.active { color:#1B4F9B; font-weight:600; }
    .tab-btn { padding:.75rem 1rem; font-size:.875rem; font-weight:600; border:none; background:transparent; cursor:pointer; border-bottom:2px solid transparent; color:#6B7280; transition:all .15s; }
    .tab-btn.active { color:#1B4F9B; border-bottom-color:#1B4F9B; }
    .module-toggle { display:flex; align-items:center; justify-content:space-between; padding:.875rem 1rem; border-radius:10px; background:#fff; border:1.5px solid #E5E7EB; cursor:pointer; font-weight:700; font-size:.875rem; color:#1A1A2E; transition:all .15s; margin-bottom:.5rem; }
    .module-toggle:hover { border-color:#1B4F9B; }
    .module-lessons { background:#fff; border:1.5px solid #E5E7EB; border-top:none; border-radius:0 0 10px 10px; margin-top:-.5rem; margin-bottom:.5rem; overflow:hidden; }
    .sidebar-scroll { overflow-y:auto; scrollbar-width:thin; scrollbar-color:#CBD5E1 transparent; }
    .sidebar-scroll::-webkit-scrollbar { width:3px; }
    .sidebar-scroll::-webkit-scrollbar-thumb { background:#CBD5E1; border-radius:2px; }
  </style>
</head>
<body>
<div style="display:flex;flex-direction:column;height:100vh;overflow:hidden;">

  {{-- ═══ TOP HEADER ═══ --}}
  <header style="background:#fff;border-bottom:1px solid #E5E7EB;padding:.875rem 1.75rem;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;z-index:10;">
    <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;color:#374151;font-weight:600;font-size:.875rem;">
      <div style="width:32px;height:32px;background:#EEF4FF;border-radius:8px;display:flex;align-items:center;justify-content:center;">
        <i class="bi-book-half" style="color:#1B4F9B;font-size:.9rem;"></i>
      </div>
      <i class="bi-arrow-left" style="font-size:.85rem;margin-left:.25rem;"></i>
      Back to Dashboard
    </a>

    <h2 style="font-size:1.15rem;font-weight:800;color:#1A1A2E;flex:1;text-align:center;padding:0 1.5rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
      Semangat dan mulai Belajar! 💪
    </h2>

    <div style="display:flex;align-items:center;gap:1rem;">
      <button style="width:36px;height:36px;border-radius:50%;border:1.5px solid #E5E7EB;background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;position:relative;">
        <i class="bi-bell" style="color:#374151;font-size:.9rem;"></i>
        <span style="position:absolute;top:5px;right:6px;width:7px;height:7px;background:#EF4444;border-radius:50%;border:1.5px solid #fff;"></span>
      </button>
      <div style="display:flex;align-items:center;gap:.625rem;">
        <img src="{{ auth()->user()->avatarUrl() }}" style="width:34px;height:34px;border-radius:50%;object-fit:cover;">
        <span style="font-size:.875rem;font-weight:600;color:#1A1A2E;">{{ auth()->user()->name }}</span>
      </div>
    </div>
  </header>

  {{-- ═══ MAIN LAYOUT ═══ --}}
  <div style="display:flex;flex:1;overflow:hidden;">

    {{-- SIDEBAR --}}
    <aside style="width:300px;background:#fff;border-right:1px solid #E5E7EB;flex-shrink:0;display:flex;flex-direction:column;overflow:hidden;">
      {{-- Course info --}}
      <div style="padding:1.25rem;border-bottom:1px solid #F0F4F8;flex-shrink:0;">
        <h3 style="font-weight:800;color:#1A1A2E;font-size:.875rem;line-height:1.5;margin-bottom:.875rem;">{{ $course->title }}</h3>
        {{-- Progress --}}
        <div style="height:5px;background:#E5E7EB;border-radius:3px;overflow:hidden;margin-bottom:.375rem;">
          <div style="height:100%;background:#22C55E;border-radius:3px;width:{{ $progress }}%;transition:width .4s;"></div>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:.78rem;">
          <span style="color:#6B7280;font-weight:600;">{{ count($completedIds) }}/{{ $allLessons->count() }} Modul</span>
          <span style="color:#1B4F9B;font-weight:700;">{{ $progress }}%</span>
        </div>
      </div>

      {{-- Accordion modules --}}
      <div class="sidebar-scroll" style="flex:1;padding:1rem;">
        @foreach($course->sections as $section)
        @php $isOpen = $section->lessons->contains('id', $lesson->id); @endphp
        <div>
          <div class="module-toggle" onclick="toggleMod({{ $loop->index }})" id="mod-{{ $loop->index }}">
            <span>MODUL {{ $loop->iteration }}: {{ $section->title }}</span>
            <i class="bi-chevron-{{ $isOpen ? 'up' : 'down' }}" id="mod-icon-{{ $loop->index }}" style="font-size:.75rem;color:#6B7280;"></i>
          </div>
          <div id="mod-panel-{{ $loop->index }}" style="{{ $isOpen ? '' : 'display:none;' }}" class="module-lessons">
            @foreach($section->lessons as $les)
            @php
              $isDone   = in_array($les->id, $completedIds);
              $isActive = $les->id === $lesson->id;
            @endphp
            <a href="{{ route('learn.lesson', [$enrollment, $les]) }}"
               class="lesson-item {{ $isActive ? 'active' : '' }}"
               style="text-decoration:none;color:{{ $isActive ? '#1B4F9B' : '#374151' }};">
              <div style="display:flex;align-items:center;gap:.625rem;flex:1;min-width:0;">
                @if($isDone)
                  <div style="width:20px;height:20px;border-radius:50%;background:#22C55E;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi-check" style="color:#fff;font-size:.65rem;"></i>
                  </div>
                @elseif($isActive)
                  <div style="width:20px;height:20px;border-radius:50%;border:2px solid #1B4F9B;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi-play-fill" style="color:#1B4F9B;font-size:.5rem;margin-left:1px;"></i>
                  </div>
                @else
                  <div style="width:20px;height:20px;border-radius:50%;border:1.5px solid #D1D5DB;flex-shrink:0;"></div>
                @endif
                <span style="font-size:.8rem;truncate;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">{{ $les->title }}</span>
              </div>
              @if($les->duration_seconds > 0)
              <span style="font-size:.75rem;color:#9CA3AF;flex-shrink:0;margin-left:.5rem;">{{ $les->durationFormatted() }}</span>
              @endif
            </a>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>

      {{-- Instructor card --}}
      <div style="padding:1rem;border-top:1px solid #F0F4F8;flex-shrink:0;">
        <div style="background:#F8FAFD;border-radius:12px;padding:1rem;display:flex;flex-direction:column;gap:.875rem;">
          <div style="display:flex;align-items:center;gap:.75rem;">
            <img src="{{ $course->instructor->avatarUrl() }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;">
            <div>
              <p style="font-weight:700;color:#1A1A2E;font-size:.85rem;">{{ $course->instructor->name }}</p>
              <p style="font-size:.75rem;color:#6B7280;">{{ $course->instructor->headline ?? 'Instructor Crygle Academy' }}</p>
            </div>
          </div>
          <a href="#" style="display:flex;align-items:center;justify-content:center;gap:.5rem;background:#1A1A2E;color:#fff;font-weight:700;padding:.75rem;border-radius:50px;text-decoration:none;font-size:.8rem;">
            <i class="bi-chat-dots"></i> Chat Mentor Terkait
          </a>
        </div>
      </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main style="flex:1;overflow-y:auto;background:#F0F4F8;">

      {{-- Video player --}}
      <div style="background:#1A1A2E;position:relative;">
        @if($lesson->embedUrl())
        <div style="aspect-ratio:16/9;max-height:420px;background:#000;">
          <iframe src="{{ $lesson->embedUrl() }}" style="width:100%;height:100%;border:none;" allowfullscreen allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture"></iframe>
        </div>
        @else
        <div style="aspect-ratio:16/9;max-height:420px;background:linear-gradient(135deg,#1B4F9B,#2563C1);display:flex;align-items:center;justify-content:center;position:relative;">
          <img src="{{ $course->thumbnailUrl() }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.5;" onerror="this.style.display='none'">
          <button style="width:72px;height:72px;background:rgba(255,255,255,.9);border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;position:relative;z-index:2;">
            <i class="bi-play-fill" style="color:#1B4F9B;font-size:1.75rem;margin-left:4px;"></i>
          </button>
        </div>
        {{-- Fake controls --}}
        <div style="background:#1A1A2E;padding:.75rem 1.25rem;display:flex;align-items:center;gap:.875rem;">
          <button style="background:none;border:none;color:#fff;cursor:pointer;font-size:1rem;"><i class="bi-play-fill"></i></button>
          <button style="background:none;border:none;color:#fff;cursor:pointer;font-size:1rem;"><i class="bi-skip-end-fill"></i></button>
          <button style="background:none;border:none;color:#fff;cursor:pointer;font-size:1rem;"><i class="bi-volume-up-fill"></i></button>
          <span style="color:#9CA3AF;font-size:.8rem;">00:00 / {{ $lesson->durationFormatted() }}</span>
          <div style="flex:1;height:3px;background:#374151;border-radius:2px;cursor:pointer;position:relative;">
            <div style="height:100%;width:35%;background:#fff;border-radius:2px;"></div>
            <div style="position:absolute;top:50%;right:65%;transform:translate(50%,-50%);width:10px;height:10px;background:#fff;border-radius:50%;"></div>
          </div>
          <button style="background:none;border:none;color:#fff;cursor:pointer;font-size:.9rem;"><i class="bi-gear"></i></button>
          <button style="background:none;border:none;color:#fff;cursor:pointer;font-size:.9rem;"><i class="bi-fullscreen"></i></button>
        </div>
        @endif
      </div>

      {{-- Lesson info --}}
      <div style="padding:1.5rem;">

        {{-- Title row --}}
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:1.25rem;flex-wrap:wrap;">
          <h2 style="font-size:1.35rem;font-weight:800;color:#1A1A2E;">{{ $lesson->title }}</h2>
          <div style="display:flex;align-items:center;gap:.75rem;">
            {{-- Mark complete --}}
            @php $isDone = in_array($lesson->id, $completedIds); @endphp
            @if(!$isDone)
            <form action="{{ route('learn.complete', [$enrollment, $lesson]) }}" method="POST">
              @csrf
              <button style="display:flex;align-items:center;gap:.5rem;background:#22C55E;color:#fff;font-weight:700;padding:.625rem 1.25rem;border-radius:50px;border:none;cursor:pointer;font-size:.8rem;">
                <i class="bi-check-circle"></i> Tandai Selesai
              </button>
            </form>
            @else
            <span style="display:flex;align-items:center;gap:.5rem;background:#F0FDF4;color:#15803D;font-weight:700;padding:.625rem 1.25rem;border-radius:50px;font-size:.8rem;">
              <i class="bi-check-circle-fill"></i> Selesai
            </span>
            @endif

            {{-- Next lesson --}}
            @if($nextLesson)
            <a href="{{ route('learn.lesson', [$enrollment, $nextLesson]) }}"
               style="display:flex;align-items:center;gap:.5rem;background:#1B4F9B;color:#fff;font-weight:700;padding:.625rem 1.25rem;border-radius:50px;text-decoration:none;font-size:.8rem;">
              Next Modul <i class="bi-arrow-right"></i>
            </a>
            @endif
          </div>
        </div>

        {{-- TABS --}}
        <div style="border-bottom:2px solid #E5E7EB;margin-bottom:1.5rem;">
          <div style="display:flex;gap:0;">
            @foreach(['resources'=>'Recources','summary'=>'Ringkasan','reviews'=>'Review'] as $k=>$v)
            <button class="tab-btn {{ $k==='resources' ? 'active' : '' }}" onclick="switchLearnTab('{{ $k }}')">{{ $v }}</button>
            @endforeach
          </div>
        </div>

        {{-- Tab: Resources --}}
        <div id="lpanel-resources">
          <h3 style="font-weight:700;color:#1A1A2E;margin-bottom:1rem;">Downloadable Assets</h3>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
            <div style="border:1.5px solid #E5E7EB;border-radius:12px;padding:1rem;display:flex;align-items:center;justify-content:space-between;background:#fff;">
              <div style="display:flex;align-items:center;gap:.75rem;">
                <div style="width:38px;height:38px;background:#EEF4FF;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                  <i class="bi-file-earmark-text" style="color:#1B4F9B;"></i>
                </div>
                <div>
                  <p style="font-weight:600;font-size:.825rem;color:#1A1A2E;">UI Kit Asset.fig</p>
                  <p style="font-size:.72rem;color:#6B7280;">12.4 MB • Figma Design</p>
                </div>
              </div>
              <button style="width:32px;height:32px;border-radius:50%;border:1.5px solid #E5E7EB;background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                <i class="bi-download" style="font-size:.8rem;color:#374151;"></i>
              </button>
            </div>
            <div style="border:1.5px solid #E5E7EB;border-radius:12px;padding:1rem;display:flex;align-items:center;justify-content:space-between;background:#fff;">
              <div style="display:flex;align-items:center;gap:.75rem;">
                <div style="width:38px;height:38px;background:#EEF4FF;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                  <i class="bi-chat-dots" style="color:#1B4F9B;"></i>
                </div>
                <div>
                  <p style="font-weight:600;font-size:.825rem;color:#1A1A2E;">Group Community</p>
                  <p style="font-size:.72rem;color:#6B7280;">WhatsApp Group</p>
                </div>
              </div>
              <button style="width:32px;height:32px;border-radius:50%;border:1.5px solid #E5E7EB;background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                <i class="bi-box-arrow-up-right" style="font-size:.8rem;color:#374151;"></i>
              </button>
            </div>
          </div>

          @if($lesson->notes)
          <div style="margin-top:1.5rem;background:#fff;border-radius:12px;padding:1.25rem;border:1.5px solid #E5E7EB;">
            <h4 style="font-weight:700;color:#1A1A2E;font-size:.875rem;margin-bottom:.625rem;">Catatan Lesson</h4>
            <p style="color:#374151;font-size:.875rem;line-height:1.7;white-space:pre-line;">{{ $lesson->notes }}</p>
          </div>
          @endif
        </div>

        {{-- Tab: Ringkasan --}}
        <div id="lpanel-summary" style="display:none;">
          <div style="background:#fff;border-radius:12px;padding:1.25rem;border:1.5px solid #E5E7EB;">
            <h4 style="font-weight:700;color:#1A1A2E;margin-bottom:.625rem;">Ringkasan: {{ $lesson->title }}</h4>
            <p style="color:#374151;font-size:.875rem;line-height:1.7;">
              {{ $lesson->notes ?? 'Rangkuman materi akan tersedia setelah kamu menyelesaikan lesson ini.' }}
            </p>
          </div>
        </div>

        {{-- Tab: Review --}}
        <div id="lpanel-reviews" style="display:none;">
          @auth
          @if(auth()->user()->isEnrolled($course))
          <form action="{{ route('review.store', $course) }}" method="POST">
            @csrf
            <div style="margin-bottom:1rem;">
              <label style="font-weight:600;font-size:.875rem;color:#1A1A2E;display:block;margin-bottom:.5rem;">Beri Rating Course</label>
              <div style="display:flex;gap:.3rem;" id="learn-stars">
                @for($i=1;$i<=5;$i++)
                <button type="button" onclick="setLearnRating({{ $i }})" data-val="{{ $i }}"
                        style="font-size:1.75rem;color:#E5E7EB;background:none;border:none;cursor:pointer;line-height:1;">★</button>
                @endfor
              </div>
              <input type="hidden" name="rating" id="learn-rating" required>
            </div>
            <textarea name="comment" rows="3" placeholder="Bagikan pengalamanmu mengikuti kelas ini..."
                      style="width:100%;border:1.5px solid #E5E7EB;border-radius:10px;padding:.75rem 1rem;font-size:.875rem;outline:none;resize:none;font-family:inherit;background:#fff;"></textarea>
            <button type="submit" style="margin-top:.875rem;background:#1B4F9B;color:#fff;font-weight:700;padding:.75rem 2rem;border-radius:50px;border:none;cursor:pointer;font-size:.875rem;">
              Kirim Review
            </button>
          </form>
          @else
          <p style="color:#6B7280;font-size:.875rem;text-align:center;padding:2rem;">Selesaikan course ini untuk memberi ulasan.</p>
          @endif
          @endauth
        </div>

      </div>
    </main>
  </div>
</div>

<script>
function toggleMod(idx) {
  const panel = document.getElementById('mod-panel-'+idx);
  const icon  = document.getElementById('mod-icon-'+idx);
  const tog   = document.getElementById('mod-'+idx);
  if (panel.style.display === 'none') {
    panel.style.display = 'block';
    icon.className = 'bi-chevron-up'; icon.style.fontSize='.75rem'; icon.style.color='#6B7280';
  } else {
    panel.style.display = 'none';
    icon.className = 'bi-chevron-down'; icon.style.fontSize='.75rem'; icon.style.color='#6B7280';
  }
}
function switchLearnTab(id) {
  ['resources','summary','reviews'].forEach(t => {
    const p = document.getElementById('lpanel-'+t);
    const b = document.querySelector('.tab-btn[onclick="switchLearnTab(\''+t+'\')"]');
    if (!p || !b) return;
    p.style.display = t===id ? 'block' : 'none';
    b.classList.toggle('active', t===id);
  });
}
function setLearnRating(val) {
  document.getElementById('learn-rating').value = val;
  document.querySelectorAll('#learn-stars button').forEach((b,i) => {
    b.style.color = i < val ? '#F59E0B' : '#E5E7EB';
  });
}
</script>
</body>
</html>
