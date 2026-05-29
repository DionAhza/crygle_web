<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Masuk — Crygle Academy</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
  <style>body{font-family:'Plus Jakarta Sans',sans-serif;} .font-display{font-family:'Sora',sans-serif;} .input-field{@apply w-full border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all;}</style>
</head>
<body class="min-h-screen grid lg:grid-cols-2 bg-slate-50">

  {{-- LEFT visual --}}
  <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-slate-950 via-blue-950 to-blue-900 text-white p-14">
    <a href="{{ route('home') }}"><img src="{{ asset('logo/footer-logo.png') }}" class="h-10"></a>

    <div>
      <h1 class="font-display text-4xl font-bold leading-tight mb-4">Selamat Datang<br>Kembali! 👋</h1>
      <p class="text-blue-200 text-lg leading-relaxed mb-8">Lanjutkan perjalanan belajarmu dan raih skill digital yang kamu impikan.</p>
      <div class="grid grid-cols-3 gap-4">
        @foreach([['5K+','Pelajar'],['50+','Course'],['20+','Mentor']] as [$v,$l])
        <div class="bg-white/10 rounded-2xl p-4 text-center backdrop-blur-sm border border-white/10">
          <p class="text-2xl font-bold">{{ $v }}</p><p class="text-blue-200 text-xs mt-0.5">{{ $l }}</p>
        </div>
        @endforeach
      </div>
    </div>

    <div class="grid grid-cols-2 gap-3 opacity-40">
      <div class="rounded-xl overflow-hidden h-28"><img src="{{ asset('images/program-image-1.png') }}" class="w-full h-full object-cover"></div>
      <div class="rounded-xl overflow-hidden h-28"><img src="{{ asset('images/program-image-2.png') }}" class="w-full h-full object-cover"></div>
    </div>
  </div>

  {{-- RIGHT form --}}
  <div class="flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">

      <div class="lg:hidden mb-8"><a href="{{ route('home') }}"><img src="{{ asset('logo/crygle-logo.png') }}" class="h-9"></a></div>

      <h2 class="font-display text-2xl font-bold text-slate-900 mb-1">Masuk ke Akun</h2>
      <p class="text-slate-500 text-sm mb-8">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar gratis</a></p>

      @if($errors->any())
      <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5 space-y-1">
        @foreach($errors->all() as $e)<p class="text-red-700 text-sm flex items-center gap-2"><i class="bi-exclamation-circle text-red-500"></i>{{ $e }}</p>@endforeach
      </div>
      @endif

      <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="nama@email.com">
        </div>
        <div>
          <div class="flex justify-between mb-1.5">
            <label class="text-sm font-medium text-slate-700">Password</label>
            <a href="#" class="text-xs text-blue-600 hover:underline">Lupa password?</a>
          </div>
          <input type="password" name="password" required class="input-field" placeholder="Minimal 8 karakter">
        </div>
        <div class="flex items-center gap-2">
          <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-blue-600">
          <label for="remember" class="text-sm text-slate-600">Ingatkan saya</label>
        </div>
        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl transition shadow-md shadow-blue-200 mt-2">
          Masuk
        </button>

        {{-- Demo hint --}}
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-3.5">
          <p class="text-xs font-bold text-blue-700 mb-1.5">🔑 Demo Akun:</p>
          <div class="space-y-1 text-xs text-blue-600">
            <p>👑 Admin: <span class="font-mono">admin@crygle.com</span> / <span class="font-mono">admin1234</span></p>
            <p>🎓 Instructor: <span class="font-mono">rizky@crygle.com</span> / <span class="font-mono">password</span></p>
            <p>👤 Student: <span class="font-mono">budi@example.com</span> / <span class="font-mono">password</span></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
