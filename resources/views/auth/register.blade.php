<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Daftar — Crygle Academy</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>body{font-family:'Plus Jakarta Sans',sans-serif;} .font-display{font-family:'Sora',sans-serif;} .input-field{@apply w-full border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all;}</style>
</head>
<body class="min-h-screen grid lg:grid-cols-2 bg-slate-50">
  <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-slate-950 via-blue-950 to-blue-900 text-white p-14">
    <a href="{{ route('home') }}"><img src="{{ asset('logo/footer-logo.png') }}" class="h-10"></a>
    <div>
      <h1 class="font-display text-4xl font-bold leading-tight mb-4">Mulai Perjalanan<br>Belajarmu! 🚀</h1>
      <p class="text-blue-200 text-lg mb-8">Gratis selamanya. Tidak perlu kartu kredit. Mulai belajar dari ratusan materi berkualitas.</p>
      <div class="space-y-3">
        @foreach(['✅ Akses course gratis seumur hidup','✅ Sertifikat penyelesaian','✅ Komunitas 5.000+ pelajar aktif','✅ Belajar dari mentor industri berpengalaman'] as $item)
        <p class="text-blue-100 text-sm">{{ $item }}</p>
        @endforeach
      </div>
    </div>
    <div class="grid grid-cols-3 gap-3 opacity-40">
      @foreach(['program-image-1','program-image-2','program-image-3'] as $img)
      <div class="rounded-xl overflow-hidden h-20"><img src="{{ asset('images/'.$img.'.png') }}" class="w-full h-full object-cover"></div>
      @endforeach
    </div>
  </div>

  <div class="flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <div class="lg:hidden mb-8"><a href="{{ route('home') }}"><img src="{{ asset('logo/crygle-logo.png') }}" class="h-9"></a></div>
      <h2 class="font-display text-2xl font-bold text-slate-900 mb-1">Buat Akun Baru 🎉</h2>
      <p class="text-slate-500 text-sm mb-8">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a></p>

      @if($errors->any())
      <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5 space-y-1">
        @foreach($errors->all() as $e)<p class="text-red-700 text-sm flex items-center gap-2"><i class="bi-exclamation-circle text-red-500"></i>{{ $e }}</p>@endforeach
      </div>
      @endif

      <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="Nama kamu">
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="nama@email.com">
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
          <input type="password" name="password" required class="input-field" placeholder="Minimal 8 karakter">
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" required class="input-field" placeholder="Ulangi password">
        </div>
        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl transition shadow-md shadow-blue-200 mt-2">
          Buat Akun Gratis
        </button>
        <p class="text-center text-xs text-slate-400 mt-1">Dengan mendaftar, kamu setuju dengan <a href="#" class="underline">Syarat & Ketentuan</a> kami.</p>
      </form>
    </div>
  </div>
</body>
</html>
