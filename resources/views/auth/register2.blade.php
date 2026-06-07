<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Daftar — Crygle Academy</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>
    body { font-family:'Plus Jakarta Sans',sans-serif; }
    .input-field { width:100%; border:1.5px solid #E5E7EB; border-radius:10px; padding:.75rem 1rem; font-size:.9rem; outline:none; transition:border .15s; background:#fff; }
    .input-field:focus { border-color:#1B4F9B; box-shadow:0 0 0 3px rgba(27,79,155,.1); }
    .btn-register { width:100%; background:#1B4F9B; color:#fff; font-weight:700; padding:.875rem; border-radius:50px; font-size:.95rem; transition:background .2s; cursor:pointer; border:none; }
    .btn-register:hover { background:#143d7a; }
  </style>
</head>
<body style="background:#EEF4FF; min-height:100vh; display:grid; grid-template-columns:1fr 1fr;">

  {{-- LEFT --}}
  <div style="background:#EEF4FF; padding:3rem 2.5rem; display:flex; flex-direction:column; justify-content:center; align-items:center;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; width:100%; max-width:520px;">
      <div style="grid-column:1/-1; background:#fff; border-radius:20px; padding:1.5rem; display:flex; align-items:center; justify-content:center; min-height:240px; box-shadow:0 2px 12px rgba(0,0,0,.06);">
        <div style="text-align:center;">
          <div style="width:120px; height:120px; background:#EEF4FF; border-radius:16px; margin:0 auto; display:flex; align-items:center; justify-content:center;">
            <i class="bi-palette2" style="font-size:4rem; color:#1B4F9B;"></i>
          </div>
          <p style="margin-top:1rem; font-weight:700; font-size:1.5rem; color:#1B4F9B; letter-spacing:-1px;">DESIGN</p>
        </div>
      </div>
      <div style="background:#fff; border-radius:16px; padding:1.25rem; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:160px; box-shadow:0 2px 10px rgba(0,0,0,.06);">
        <div style="width:70px; height:70px; background:#EEF4FF; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:.75rem;">
          <i class="bi-robot" style="font-size:2.2rem; color:#1B4F9B;"></i>
        </div>
        <p style="font-weight:800; font-size:1rem; color:#1B4F9B; letter-spacing:-.5px;">ROBOTIC</p>
      </div>
      <div style="background:#fff; border-radius:16px; padding:1.25rem; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:160px; box-shadow:0 2px 10px rgba(0,0,0,.06);">
        <div style="width:70px; height:70px; background:#EEF4FF; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:.75rem;">
          <i class="bi-code-slash" style="font-size:2.2rem; color:#1B4F9B;"></i>
        </div>
        <p style="font-weight:800; font-size:1rem; color:#1B4F9B; letter-spacing:-.5px;">CODING</p>
      </div>
    </div>
  </div>

  {{-- RIGHT --}}
  <div style="background:#fff; display:flex; align-items:center; justify-content:center; padding:2.5rem 3.5rem; overflow-y:auto;">
    <div style="width:100%; max-width:420px;">
      <div style="display:flex; align-items:center; gap:.75rem; margin-bottom:2rem;">
        <div style="width:42px; height:42px; background:#1B4F9B; border-radius:10px; display:flex; align-items:center; justify-content:center;">
          <i class="bi-book-half" style="color:#fff; font-size:1.2rem;"></i>
        </div>
        <div>
          <p style="font-weight:800; color:#1B4F9B; font-size:1.05rem; line-height:1.1;">Crygle</p>
          <p style="font-weight:800; color:#1B4F9B; font-size:1.05rem; line-height:1.1;">Academy</p>
        </div>
      </div>

      <h1 style="font-size:1.7rem; font-weight:800; color:#1A1A2E; margin-bottom:.375rem;">Silahkan Membuat Akun</h1>
      <p style="color:#6B7280; font-size:.9rem; margin-bottom:1.75rem;">Please masukin detail disini</p>

      @if($errors->any())
      <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; padding:.875rem 1rem; margin-bottom:1.25rem;">
        @foreach($errors->all() as $e)
        <p style="color:#DC2626; font-size:.85rem; display:flex; align-items:center; gap:.5rem;">
          <i class="bi-exclamation-circle"></i> {{ $e }}
        </p>
        @endforeach
      </div>
      @endif

      <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:.875rem; margin-bottom:1rem;">
          <div>
            <label style="display:block; font-weight:600; font-size:.85rem; color:#374151; margin-bottom:.4rem;">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required class="input-field" placeholder="Dion">
          </div>
          <div>
            <label style="display:block; font-weight:600; font-size:.85rem; color:#374151; margin-bottom:.4rem;">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" class="input-field" placeholder="Ahza">
          </div>
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; font-weight:600; font-size:.85rem; color:#374151; margin-bottom:.4rem;">Email Address</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="dionahza@crygleacademy.com">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; font-weight:600; font-size:.85rem; color:#374151; margin-bottom:.4rem;">Password</label>
          <input type="password" name="password" required class="input-field" placeholder="••••••••••••••••">
        </div>
        <div style="margin-bottom:1rem; display:none;">
          <input type="password" name="password_confirmation" id="pass_conf" class="input-field">
        </div>
        <div style="margin-bottom:1.5rem; display:flex; align-items:center; gap:.625rem;">
          <input type="checkbox" name="terms" id="terms" required style="width:1.1rem; height:1.1rem; accent-color:#1B4F9B;">
          <label for="terms" style="font-size:.875rem; color:#374151; cursor:pointer;">I agree to the <a href="#" style="color:#1B4F9B; font-weight:600;">Terms & Conditions</a></label>
        </div>
        <button type="submit" class="btn-register">Buat Akun</button>
      </form>

      <p style="text-align:center; margin-top:1.25rem; font-size:.9rem; color:#6B7280;">
        Sudah punya akun? <a href="{{ route('login') }}" style="color:#1B4F9B; font-weight:700; text-decoration:none;">Masuk</a>
      </p>
    </div>
  </div>
</body>
<script>
// Mirror password ke confirmation karena form lama hanya ada 1 field password
document.querySelector('form').addEventListener('submit', function() {
  document.getElementById('pass_conf').value = document.querySelector('[name=password]').value;
  // Merge first_name + last_name -> name
  const fn = document.querySelector('[name=first_name]').value.trim();
  const ln = document.querySelector('[name=last_name]').value.trim();
  // inject hidden name field
  const h = document.createElement('input');
  h.type='hidden'; h.name='name'; h.value=fn+(ln?' '+ln:'');
  this.appendChild(h);
});
</script>
</html>
