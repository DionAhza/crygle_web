<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="bg-white container">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="flex justify-between h-16 items-center">

      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <img src="{{ asset('logo/crygle-logo.png') }}" class="h-10">
      </div>

      <!-- Menu -->
      <div class="hidden md:flex items-center space-x-8  font-medium text-gray-300" style="font-size: 16px">
        <a href="#" class="text-blue-900 font-semibold">Home</a>
        <div class="flex items-center space-x-6">

  <!-- Dropdown E-learning -->
  <div class="relative group">
    <button class="hover:text-blue-900 flex items-center gap-1">
      E-learning
      ⌄ 
    </button>

    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-40">
      <a href="#" class="block px-4 py-2 hover:bg-gray-100">Test 1</a>
      <a href="#" class="block px-4 py-2 hover:bg-gray-100">Test 2</a>
    </div>
  </div>

  <!-- Dropdown Pelatihan -->
  <div class="relative group">
    <button class="hover:text-blue-900 flex items-center gap-1">
      Pelatihan & Kursus
      ⌄ 
    </button>

    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-48">
      <a href="#" class="block px-4 py-2 hover:bg-gray-100">Frontend</a>
      <a href="#" class="block px-4 py-2 hover:bg-gray-100">Backend</a>
    </div>
  </div>

</div>
        <a href="#" class="hover:text-blue-900">Mentor</a>
        <a href="#" class="hover:text-blue-900">Tentang</a>
      </div>

      <!-- Right Button -->
      <div class="flex items-center space-x-4">
        <a href="/login" class="text-blue-900 font-medium hover:underline">
          Masuk
        </a>
        <a href="/register" class="bg-blue-900 text-white px-5 py-2 rounded-full shadow-md hover:bg-blue-700 transition">
          Daftar
        </a>
      </div>

    </div>
  </div>
</nav>

 <main class=" py-8">
    @yield('content')
 </main>
  <footer class="bg-[#235F9C] text-white/70 px-6 lg:px-20 pt-16 pb-8">
    <div class="max-w-6xl mx-auto">
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">

        <!-- Brand -->
        <div>
          <div class="flex items-center gap-2.5 mb-4">
            <div class="">
              
                <img src="{{ asset('logo/footer-logo.png') }}" alt="Logo" class="w-full h-full object-cover">
            
              {{-- <span class="font-display font-bold text-white text-sm">C</span> --}}
            </div>
            {{-- <span class="font-display font-bold text-white text-base">Crygle Academy</span> --}}
          </div>
          <p class="text-sm leading-relaxed mb-5">Belajar kreatif digital dari nol untuk masa depan yang lebih siap.</p>
          <div class="text-sm leading-loose">
            <p><i class="bi-envelope text-yellow-400 mr-2"></i> <a href="mailto:tanya@crygleacademy.com" class="hover:text-white transition-colors">tanya@crygleacademy.com</a></p>
            <p class="mt-1"><i class="bi-geo-alt text-yellow-400 mr-2"></i> Jl. Cipta Karya, Sidomulyo Bar., Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
          </div>
        </div>

        <!-- Navigasi -->
        <div>
          <h4 class="font-display font-bold text-white text-xs uppercase tracking-widest mb-5">Navigasi</h4>
          <ul class="space-y-3 text-sm list-none p-0 m-0">
            <li><a href="#" class="hover:text-white transition-colors no-underline">Home</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">E-Learning</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Courses & Classes</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Mentor</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Testimoni</a></li>
          </ul>
        </div>

        <!-- Program -->
        <div>
          <h4 class="font-display font-bold text-white text-xs uppercase tracking-widest mb-5">Program</h4>
          <ul class="space-y-3 text-sm list-none p-0 m-0">
            <li><a href="#" class="hover:text-white transition-colors no-underline">Creative Design</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Creative Coding</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Creative Robotics</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Consulting</a></li>
          </ul>
        </div>

        <!-- Dukungan -->
        <div>
          <h4 class="font-display font-bold text-white text-xs uppercase tracking-widest mb-5">Dukungan</h4>
          <ul class="space-y-3 text-sm list-none p-0 m-0">
            <li><a href="#" class="hover:text-white transition-colors no-underline">Pusat Bantuan</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Kontak Kami</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Kebijakan Privasi</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">Syarat & Ketentuan</a></li>
            <li><a href="#" class="hover:text-white transition-colors no-underline">FAQ</a></li>
          </ul>
        </div>

      </div>
      <div class="border-t border-white/10 pt-6 text-center text-xs text-white/40">
        © 2026 CRYGLE Academy. All rights reserved.
      </div>
    </div>
  </footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/bootstrap-icons.svg"></script>
</body>
</html>