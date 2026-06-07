@extends('layouts.app')

@section('title','Halaman User')

@section('content')
    
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRYGLE Academy</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet"/>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            display: ['Sora', 'sans-serif'],
          },
          colors: {
            blue: {
              50:  '#EBF2FF',
              100: '#D6E5FF',
              500: '#1B6EF3',
              600: '#1455C8',
              700: '#0D3DA0',
            },
            dark:  '#0D1B2A',
            muted: '#5A6A7E',
            light: '#F4F7FB',
            yellow: '#FFD44D',
          },
        }
      }
    }
  </script>
  <style>
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
    .faq-answer.open { max-height: 400px; }
    nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
    .img-slot {
      background: repeating-linear-gradient(
        45deg,
        #EBF2FF 0, #EBF2FF 2px,
        #F4F7FB 2px, #F4F7FB 14px
      );
    }
    .card-hover { transition: transform 0.2s, box-shadow 0.2s; }
    .card-hover:hover { transform: translateY(-6px); }
    .slide-hover { transition: transform 0.2s; }
    .slide-hover:hover { transform: translateX(5px); }
  </style>
</head>
<body class="font-sans bg-white text-dark overflow-x-hidden">

  <!-- ============================================================
       NAVBAR
  ============================================================ -->
 


  <!-- ============================================================
       HERO
  ============================================================ -->
 <section class=" px-6 lg:px-20 pt-16 pb-20">
    <div class="max-w-6xl mx-auto">

        <!-- TOP TEXT -->
        <div class="grid lg:grid-cols-2 gap-10 items-start mb-10">

            <!-- LEFT TITLE -->
            <div>
                <h1 class="text-[5px] lg:text-[50px] leading-none font-bold text-blue-900">
                    Tempat Perjuangan <br>
                    Kreatif Anak Muda <br>
                    Dimulai
                </h1>
            </div>

            <!-- RIGHT TEXT -->
            <div class="lg:pl-10 pt-2">
                <p class="text-lg text-gray-800 leading-relaxed max-w-md mb-8">
                    Bukan hanya teori, tapi juga aksi. Di sini,
                    kamu bisa belajar sambil bikin karya nyata.
                </p>

                <button class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-full shadow-lg transition">
                    Explore Kelas
                </button>
            </div>

        </div>


        <!-- IMAGE SECTION -->
        <div class="relative rounded-3xl overflow-hidden">

            <!-- GANTI GAMBAR -->
            <img src="{{ asset('images/hero-image.jpg') }}"
                class="w-full h-[320px] md:h-[500px] object-cover rounded-3xl">

            <!-- PLAY BUTTON -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-28 h-28 bg-black/40 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <div class="w-0 h-0 border-t-[18px] border-b-[18px] border-l-[28px] border-transparent border-l-white ml-2"></div>
                </div>
            </div>

            <!-- REVIEW BOX -->
            <div class="absolute bottom-5 left-5 bg-white rounded-2xl px-5 py-3 shadow-xl flex items-center gap-4">

                <div class="flex -space-x-3">
                    <img src="avatar1.jpg" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                    <img src="avatar2.jpg" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                    <img src="avatar3.jpg" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                </div>

                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-orange-500 text-sm">★★★★★</span>
                        <span class="font-semibold text-gray-800">4.5</span>
                    </div>
                    <p class="text-sm text-gray-500">From 300+ Reviews</p>
                </div>

            </div>

        </div>

    </div>
</section>


  <!-- ============================================================
       RANGKAIAN PROGRAM
  ============================================================ -->
 <section class="bg-[#EEF1F4] px-6 lg:px-20 py-20">
    <div class="max-w-6xl mx-auto">

        <!-- Heading -->
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-blue-900 mb-3">
                Rangkaian Program
            </h2>
            <p class="text-gray-600 text-lg">
                Dari seni hingga teknologi, setiap program kami dirancang untuk mengasah imajinasi dan keterampilan masa depan.
            </p>
        </div>

        <!-- Content -->
        <div class="grid lg:grid-cols-2 gap-10 items-start">

            <!-- LEFT IMAGE GRID -->
            <div class="grid grid-cols-2 gap-4">

                <!-- BIG IMAGE -->
                <div class="col-span-2 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/program-image-1.png') }}" class="w-full h-full object-cover">
                </div>

                <!-- SMALL IMAGE -->
                <div class="rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/program-image-2.png') }}" class="w-full h-full object-cover">
                </div>

                <!-- SMALL IMAGE -->
                <div class="rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/program-image-3.png') }}" class="w-full h-full object-cover">
                </div>

            </div>


            <!-- RIGHT CARD LIST -->
            <div class="space-y-2">

                <!-- Card -->
                <div class="bg-white rounded-2xl p-3 border border-gray-200">
                    <div class="text-2xl mb-3"><i class="bi bi-search"></i></div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Tentang Kami</h3>
                    <p class="text-gray-500 leading-relaxed">
                        This can be done by breaking down the number of leads at each stage of the funnel, such as lead qualification
                    </p>
                </div>

                <!-- Active -->
                <div class="bg-white rounded-2xl p-3">
                    <div class="text-2xl mb-3"><i class="bi bi-vector-pen"></i></div>
                    <h3 class="text-2xl font-semibold mb-2 text-gray-800">Kreatif Design</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Menyalurkan imajinasi menjadi karya. Di Kreatif Academy, kreativitas adalah kunci untuk menciptakan solusi unik.
                    </p>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-2xl p-3 border border-gray-200">
                    <div class="text-2xl mb-3"><i class="bi bi-code-square"></i></div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Kreatif Coding</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Bahasa masa depan untuk membangun ide. Disini kamu diajarkan Coding dengan cara kreatif dan aplikatif.
                    </p>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-2xl p-3 border border-gray-200">
                    <div class="text-2xl mb-3"><i class="bi bi-lightbulb"></i></div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Kreatif Robot</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Mengenal teknologi cerdas sejak dini. Belajar merancang dan mengendalikan robot secara kreatif dan menyenangkan.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>


  <!-- ============================================================
       KELAS POPULER
  ============================================================ -->
  <section class="bg-light px-6 lg:px-20 py-20">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-14">
        <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-blue-900 mb-3">Kelas Populer</h2>
        <p class="text-muted text-base max-w-lg mx-auto leading-relaxed">
          Beberapa kelas andalan kami yang bisa di ikuti secara gratis sebelum mengikuti kelas <span class='font-bold'> LEVEL UP</span> yang sudah kami sediakan.
        </p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- ── CARD TEMPLATE ─────────────────────────────────────
             Duplikat blok ini untuk setiap kelas baru.
             Ganti: thumbnail src, level badge, judul, harga.
        ──────────────────────────────────────────────────────── -->

        <!-- Card 1 -->
        <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-blue-500/15 cursor-pointer">
          <div class="aspect-[16/10] img-slot border-b-2 border-dashed border-blue-100 flex items-center justify-center overflow-hidden">
           
              <img src="{{ asset('images/class-popular-1.png') }}" alt="Kelas 1"
                   class="w-full h-full object-cover">
          
            {{-- <div class="text-center select-none pointer-events-none">
              <div class="text-3xl mb-1">📦</div>
              <p class="text-xs font-semibold text-blue-300">Thumbnail Kelas 1</p>
              <p class="text-[10px] text-blue-200">600 × 375px</p>
            </div> --}}
          </div>
          <div class="p-4">
            <span class="inline-block text-[10px] font-bold px-3 py-0.5 rounded-full bg-green-100 text-green-700 uppercase tracking-wide mb-2">Basic Level</span>
            <h3 class="font-display font-bold text-sm text-dark leading-snug mb-2">3D Design : Bagaimana Cara Membuat 3D Objek yang Menjual di Freepik</h3>
            <p class="text-xs text-muted mb-3">Advanced Class | <span class="text-amber-400">★</span> 4.3 (1.6K Reviews)</p>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-display font-extrabold text-base text-green-600">Rp. 0</span>
              <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded">100% off</span>
              <span class="text-xs text-slate-400 line-through">Rp. 159.000</span>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-blue-500/15 cursor-pointer">
          <div class="aspect-[16/10] img-slot border-b-2 border-dashed border-blue-100 flex items-center justify-center overflow-hidden">
            <!--
              GANTI THUMBNAIL:
              <img src="images/class-2.jpg" alt="Kelas 2"
                   class="w-full h-full object-cover">
            -->
            <div class="text-center select-none pointer-events-none">
              <div class="text-3xl mb-1">🎬</div>
              <p class="text-xs font-semibold text-blue-300">Thumbnail Kelas 2</p>
              <p class="text-[10px] text-blue-200">600 × 375px</p>
            </div>
          </div>
          <div class="p-4">
            <span class="inline-block text-[10px] font-bold px-3 py-0.5 rounded-full bg-red-100 text-red-700 uppercase tracking-wide mb-2">Advanced Level</span>
            <h3 class="font-display font-bold text-sm text-dark leading-snug mb-2">3D Design : Membuat Animation 3D Produk di Blender</h3>
            <p class="text-xs text-muted mb-3">Advanced Class |<span class="text-amber-400">★</span> 4.3 (1.6K Reviews)</p>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-display font-extrabold text-base text-blue-500">Rp. 99.000</span>
              <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded">80% off</span>
              <span class="text-xs text-slate-400 line-through">Rp. 449.000</span>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-blue-500/15 cursor-pointer">
          <div class="aspect-[16/10] img-slot border-b-2 border-dashed border-blue-100 flex items-center justify-center overflow-hidden">
            <!--
              GANTI THUMBNAIL:
              <img src="images/class-3.jpg" alt="Kelas 3"
                   class="w-full h-full object-cover">
            -->
            <div class="text-center select-none pointer-events-none">
              <div class="text-3xl mb-1">💎</div>
              <p class="text-xs font-semibold text-blue-300">Thumbnail Kelas 3</p>
              <p class="text-[10px] text-blue-200">600 × 375px</p>
            </div>
          </div>
          <div class="p-4">
            <span class="inline-block text-[10px] font-bold px-3 py-0.5 rounded-full bg-red-100 text-red-700 uppercase tracking-wide mb-2">Advanced Level</span>
            <h3 class="font-display font-bold text-sm text-dark leading-snug mb-2">UI/UX Design : Menghasilkan Dolar Hanya Dengan Menjual Produk UI Kit</h3>
            <p class="text-xs text-muted mb-3">Advanced Class |<span class="text-amber-400">★</span> 4.3 (1.6K Reviews)</p>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-display font-extrabold text-base text-blue-500">Rp. 449.000</span>
              <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded">50% off</span>
              <span class="text-xs text-slate-400 line-through">Rp. 899.000</span>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-blue-500/15 cursor-pointer">
          <div class="aspect-[16/10] img-slot border-b-2 border-dashed border-blue-100 flex items-center justify-center overflow-hidden">
            <!--
              GANTI THUMBNAIL:
              <img src="images/class-4.jpg" alt="Kelas 4"
                   class="w-full h-full object-cover">
            -->
            <div class="text-center select-none pointer-events-none">
              <div class="text-3xl mb-1">🔷</div>
              <p class="text-xs font-semibold text-blue-300">Thumbnail Kelas 4</p>
              <p class="text-[10px] text-blue-200">600 × 375px</p>
            </div>
          </div>
          <div class="p-4">
            <span class="inline-block text-[10px] font-bold px-3 py-0.5 rounded-full bg-orange-100 text-orange-700 uppercase tracking-wide mb-2">Intermediate Level</span>
            <h3 class="font-display font-bold text-sm text-dark leading-snug mb-2">3D Design : Mengembangkan 3D Objek Menjadi 3D Bangun Ruang</h3>
            <p class="text-xs text-muted mb-3">Advanced Class |<span class="text-amber-400">★</span> 4.3 (1.6K Reviews)</p>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-display font-extrabold text-base text-blue-500">Rp. 59.000</span>
              <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded">76% off</span>
              <span class="text-xs text-slate-400 line-through">Rp. 249.000</span>
            </div>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-blue-500/15 cursor-pointer">
          <div class="aspect-[16/10] img-slot border-b-2 border-dashed border-blue-100 flex items-center justify-center overflow-hidden">
            <!--
              GANTI THUMBNAIL:
              <img src="images/class-5.jpg" alt="Kelas 5"
                   class="w-full h-full object-cover">
            -->
            <div class="text-center select-none pointer-events-none">
              <div class="text-3xl mb-1">✏️</div>
              <p class="text-xs font-semibold text-blue-300">Thumbnail Kelas 5</p>
              <p class="text-[10px] text-blue-200">600 × 375px</p>
            </div>
          </div>
          <div class="p-4">
            <span class="inline-block text-[10px] font-bold px-3 py-0.5 rounded-full bg-red-100 text-red-700 uppercase tracking-wide mb-2">Advanced Level</span>
            <h3 class="font-display font-bold text-sm text-dark leading-snug mb-2">Vector Design : Membuat Vector Ilustrasi Menggunakan Figma</h3>
            <p class="text-xs text-muted mb-3">Advanced Class |<span class="text-amber-400">★</span> 4.3 (1.6K Reviews)</p>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-display font-extrabold text-base text-blue-500">Rp. 99.000</span>
              <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded">80% off</span>
              <span class="text-xs text-slate-400 line-through">Rp. 449.000</span>
            </div>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-blue-500/15 cursor-pointer">
          <div class="aspect-[16/10] img-slot border-b-2 border-dashed border-blue-100 flex items-center justify-center overflow-hidden">
            <!--
              GANTI THUMBNAIL:
              <img src="images/class-6.jpg" alt="Kelas 6"
                   class="w-full h-full object-cover">
            -->
            <div class="text-center select-none pointer-events-none">
              <div class="text-3xl mb-1">🌐</div>
              <p class="text-xs font-semibold text-blue-300">Thumbnail Kelas 6</p>
              <p class="text-[10px] text-blue-200">600 × 375px</p>
            </div>
          </div>
          <div class="p-4">
            <span class="inline-block text-[10px] font-bold px-3 py-0.5 rounded-full bg-green-100 text-green-700 uppercase tracking-wide mb-2">Basic Level</span>
            <h3 class="font-display font-bold text-sm text-dark leading-snug mb-2">Front-End : Membuat Web Portfolio Simpel dan Berkelas</h3>
            <p class="text-xs text-muted mb-3">Advanced Class |<span class="text-amber-400">★</span> 4.3 (1.6K Reviews)</p>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-display font-extrabold text-base text-green-600">Rp. 0</span>
              <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded">100% off</span>
              <span class="text-xs text-slate-400 line-through">Rp. 159.000</span>
            </div>
          </div>
        </div>

      </div>

      <div class="text-center mt-10">
        <button class="bg-white border-2 border-blue-500 text-blue-500 font-bold text-sm px-8 py-3 rounded-xl hover:bg-blue-500 hover:text-white transition-all">
          Lihat Lainnya
        </button>
      </div>
    </div>
  </section>


  <!-- ============================================================
       HASIL KARYA ALUMNI
  ============================================================ -->
  <section class="overflow-hidden bg-[#165DA8]">
    <div class="grid lg:grid-cols-2 min-h-screen">

        <!-- LEFT CONTENT -->
        <div class="relative text-white px-8 lg:px-20 py-20 flex flex-col justify-center overflow-hidden">

            <!-- Background Circle -->
            <div class="absolute w-[700px] h-[700px] border border-white/10 rounded-full -left-60 top-10"></div>
            <div class="absolute w-[500px] h-[500px] border border-white/10 rounded-full -left-32 top-40"></div>

            <div class="relative z-10 max-w-md">

                <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                    Hasil Karya Alumni
                </h2>

                <p class="text-white/80 leading-relaxed mb-10">
                    Beberapa hasil karya alumni yang pernah mengikuti kelas CRYGLE Academy.
                    Karya yang dihasilkan memiliki standarisasi dari setiap kelas yang diikuti peserta.
                </p>

                <div class="w-full h-px bg-white/30 mb-10"></div>

                <!-- Portfolio Card -->
                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 rounded-xl bg-white/10 flex items-center justify-center text-2xl">
                        📘
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-2">
                            Strong Portfolio
                        </h3>

                        <p class="text-white/75 leading-relaxed">
                            Memiliki karya yang STRONG dan siap dipublikasi
                            menjadi portfolio yang dapat dibanggakan.
                        </p>
                    </div>

                </div>

            </div>
        </div>



        <!-- RIGHT GALLERY -->
        <div class="relative h-screen overflow-hidden bg-[#165DA8]">

            <div class="grid grid-cols-3 gap-4 px-6 py-6 absolute inset-0">

                <!-- COLUMN 1 -->
                <div class="space-y-4 animate-up">
                    <img src="1.jpg" class="rounded-xl w-full h-48 object-cover">
                    <img src="2.jpg" class="rounded-xl w-full h-72 object-cover">
                    <img src="3.jpg" class="rounded-xl w-full h-52 object-cover">
                    <img src="4.jpg" class="rounded-xl w-full h-64 object-cover">
                </div>

                <!-- COLUMN 2 -->
                <div class="space-y-4 animate-down mt-10">
                    <img src="5.jpg" class="rounded-xl w-full h-72 object-cover">
                    <img src="6.jpg" class="rounded-xl w-full h-48 object-cover">
                    <img src="7.jpg" class="rounded-xl w-full h-64 object-cover">
                    <img src="8.jpg" class="rounded-xl w-full h-52 object-cover">
                </div>

                <!-- COLUMN 3 -->
                <div class="space-y-4 animate-up">
                    <img src="9.jpg" class="rounded-xl w-full h-56 object-cover">
                    <img src="10.jpg" class="rounded-xl w-full h-72 object-cover">
                    <img src="11.jpg" class="rounded-xl w-full h-48 object-cover">
                    <img src="12.jpg" class="rounded-xl w-full h-64 object-cover">
                </div>

            </div>

        </div>

    </div>
</section>



<style>
@keyframes upMove {
    0% {transform: translateY(0);}
    50% {transform: translateY(-60px);}
    100% {transform: translateY(0);}
}

@keyframes downMove {
    0% {transform: translateY(0);}
    50% {transform: translateY(60px);}
    100% {transform: translateY(0);}
}

.animate-up{
    animation: upMove 8s ease-in-out infinite;
}

.animate-down{
    animation: downMove 8s ease-in-out infinite;
}
</style>


 <section class="bg-[#EEF1F4] px-6 lg:px-20 py-24">
    <div class="max-w-6xl mx-auto">

        <!-- Heading -->
        <div class="text-center mb-14">
            <h2 class="text-4xl lg:text-5xl font-bold text-blue-900 mb-3">
                Apa Kata Alumni Kelas
            </h2>
            <p class="text-gray-500 text-lg">
                Dari nggak tahu apa-apa, sekarang bisa bikin karya sendiri.
            </p>
        </div>


        <!-- CONTENT -->
        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <!-- LEFT TESTIMONIAL -->
            <div>

                <div class="relative">
                    <div class="text-[120px] text-blue-200 absolute -top-14 left-0 leading-none">
                        “
                    </div>

                    <div class="relative z-10 pt-12">
                        <p id="testimonialText"
                           class="text-gray-700 leading-relaxed text-lg mb-10 border-b border-gray-300 pb-8">
                            Awalnya aku nggak ngerti coding sama sekali dan bingung harus mulai dari mana.
                            Setelah ikut Crygle Academy, materinya gampang dipahami karena step by step.
                            Sekarang aku sudah bisa bikin game sederhana sendiri!
                        </p>

                        <!-- USER -->
                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-4">
                                <img id="testimonialImage"
                                     src="user1.jpg"
                                     class="w-14 h-14 rounded-full object-cover border-2 border-blue-600">

                                <div>
                                    <h4 id="testimonialName"
                                        class="font-semibold text-xl text-gray-800">
                                        Andi Hidayat
                                    </h4>

                                    <p id="testimonialRole"
                                       class="text-gray-500">
                                        Peserta Creative Coding
                                    </p>
                                </div>
                            </div>

                            <!-- BUTTON -->
                            <div class="flex items-center gap-3">

                                <button onclick="prevTestimonial()"
                                    class="w-10 h-10 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                    ‹
                                </button>

                                <div class="flex gap-2">
                                    <span class="dot w-2.5 h-2.5 rounded-full bg-blue-700"></span>
                                    <span class="dot w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                                    <span class="dot w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                                </div>

                                <button onclick="nextTestimonial()"
                                    class="w-10 h-10 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                    ›
                                </button>

                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <!-- RIGHT IMAGE -->
            <div class="relative rounded-3xl overflow-hidden">

                <img src="meeting.jpg"
                     class="w-full h-[420px] object-cover rounded-3xl">

                <!-- PLAY BUTTON -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-20 h-20 bg-white/90 rounded-full flex items-center justify-center shadow-xl cursor-pointer hover:scale-110 transition">
                        <div class="w-0 h-0 border-t-[12px] border-b-[12px] border-l-[18px] border-transparent border-l-gray-700 ml-1"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>



<script>
const testimonials = [
{
name: "Andi Hidayat",
role: "Peserta Creative Coding",
image: "user1.jpg",
text: "Awalnya aku nggak ngerti coding sama sekali dan bingung harus mulai dari mana. Setelah ikut Crygle Academy, materinya gampang dipahami karena step by step. Sekarang aku sudah bisa bikin game sederhana sendiri!"
},
{
name: "Rizky Maulana",
role: "Peserta UI/UX Design",
image: "user2.jpg",
text: "Dulu saya tidak punya portfolio. Setelah belajar di Crygle Academy saya berhasil membuat project sendiri dan lebih percaya diri melamar kerja."
},
{
name: "Siti Rahma",
role: "Peserta Robotics",
image: "user3.jpg",
text: "Belajarnya seru dan mudah dipahami. Sekarang saya sudah paham dasar robotik dan bisa membuat mini project sederhana."
}
];

let current = 0;

function showTestimonial(index){
document.getElementById("testimonialName").innerText = testimonials[index].name;
document.getElementById("testimonialRole").innerText = testimonials[index].role;
document.getElementById("testimonialText").innerText = testimonials[index].text;
document.getElementById("testimonialImage").src = testimonials[index].image;

document.querySelectorAll(".dot").forEach((dot,i)=>{
dot.classList.remove("bg-blue-700");
dot.classList.add("bg-gray-300");

if(i === index){
dot.classList.remove("bg-gray-300");
dot.classList.add("bg-blue-700");
}
});
}

function nextTestimonial(){
current++;
if(current >= testimonials.length) current = 0;
showTestimonial(current);
}

function prevTestimonial(){
current--;
if(current < 0) current = testimonials.length - 1;
showTestimonial(current);
}
</script>
<section style="background:#F8FAFD;" class="px-6 lg:px-8 py-16">
  <div class="max-w-7xl mx-auto">
    <div style="text-align:center;margin-bottom:3rem;">
      <h2 style="font-size:1.75rem;font-weight:800;color:#1B4F9B;margin-bottom:.5rem;">Frequently Asked Questions</h2>
      <p style="color:#6B7280;font-size:.9rem;">Masih bingung? Kami bantu jawab di sini.</p>
    </div>

    @php
    $faqs = [
      ['Apakah Crygle Academy cocok untuk pemula?', 'Sangat cocok. <strong>CRYGLE</strong> Academy dirancang khusus untuk pemula dari tingkat SD hingga SMK. Materi disusun secara bertahap dari dasar hingga lanjutan dengan penjelasan yang mudah dipahami.', true],
      ['Apakah pembelajaran hanya berupa video?', '', false],
      ['Saya belum pernah belajar coding, robotik dan desain, apakah bisa ikut?', '', false],
      ['Apakah saya bisa membuat proyek sendiri?', 'Ya, Tentu! Setiap jalur pembelajaran dilengkapi dengan proyek yang bisa kamu kerjakan. Proyek ini dirancang agar kamu bisa menerapkan langsung apa yang sudah dipelajari.<br><br>Hasil proyek ini juga bisa kamu gunakan sebagai portofolio untuk masa depan.', true],
      ['Apa saja yang bisa saya pelajari di CRYGLE Academy?', '', false],
      ['Apakah saya bisa belajar kapan saja?', '', false],
      ['Bagaimana jika saya tidak memahami materi saat belajar?', '', false],
      ['Apakah saya akan mendapatkan sertifikat?', '', false],
      ['', 'Apa keunggulan CRYGLE Academy dibanding platform lain?', false],
    ];
    @endphp

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;" class="lg:grid-cols-2">
      @php $col1 = array_filter($faqs, fn($k) => $k % 2 == 0, ARRAY_FILTER_USE_KEY);
           $col2 = array_filter($faqs, fn($k) => $k % 2 == 1, ARRAY_FILTER_USE_KEY); @endphp

      <div class="space-y-3">
        @foreach($col1 as $i => $faq)
        @if($faq[0])
        <div>
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>{{ $faq[0] }}</span>
            <i class="bi-chevron-{{ $faq[2] ? 'up' : 'down' }} text-sm transition-transform"></i>
          </div>
          @if($faq[2])
          <div style="padding:1rem 1.25rem;font-size:.875rem;color:#374151;line-height:1.7;border:1px solid #E5E7EB;border-top:none;border-radius:0 0 8px 8px;background:#fff;">
            {!! $faq[1] !!}
          </div>
          @endif
        </div>
        @endif
        @endforeach
      </div>

      <div class="space-y-3">
        @foreach($col2 as $i => $faq)
        @if($faq[0] || $faq[1])
        <div>
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>{{ $faq[0] ?: $faq[1] }}</span>
            <i class="bi-chevron-{{ $faq[2] ? 'up' : 'down' }} text-sm"></i>
          </div>
          @if($faq[2] && $faq[1])
          <div style="padding:1rem 1.25rem;font-size:.875rem;color:#374151;line-height:1.7;border:1px solid #E5E7EB;border-top:none;border-radius:0 0 8px 8px;background:#fff;">
            {!! $faq[1] !!}
          </div>
          @endif
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  
</section>



<script>
function toggleFaq(button){

    const currentBox = button.parentElement;
    const content = currentBox.querySelector(".faq-content");
    const icon = currentBox.querySelector(".faq-icon");

    const allFaq = document.querySelectorAll(".faq-content");
    const allIcon = document.querySelectorAll(".faq-icon");

    allFaq.forEach(item => {
        if(item !== content){
            item.classList.add("hidden");
            item.classList.remove("block");
        }
    });

    allIcon.forEach(i => {
        if(i !== icon){
            i.classList.remove("rotate-180");
        }
    });

    if(content.classList.contains("hidden")){
        content.classList.remove("hidden");
        content.classList.add("block");
        icon.classList.add("rotate-180");
    }else{
        content.classList.add("hidden");
        content.classList.remove("block");
        icon.classList.remove("rotate-180");
    }
}
</script> 


 <section class="bg-[#EEF1F4] px-6 lg:px-20 py-24">
    <div class="max-w-6xl mx-auto">

        <!-- CTA BOX -->
        <div class="relative overflow-hidden rounded-3xl border border-blue-200 bg-[#EAF3FF] px-8 lg:px-20 py-14">

            <!-- LEFT PIXEL SHAPE -->
            <div class="absolute left-0 bottom-0 opacity-60">
                <div class="grid grid-cols-4 gap-0">
                    <div class="w-8 h-8 bg-blue-200"></div>
                    <div class="w-8 h-8 bg-blue-100"></div>
                    <div class="w-8 h-8 bg-transparent"></div>
                    <div class="w-8 h-8 bg-transparent"></div>

                    <div class="w-8 h-8 bg-blue-300"></div>
                    <div class="w-8 h-8 bg-blue-200"></div>
                    <div class="w-8 h-8 bg-blue-100"></div>
                    <div class="w-8 h-8 bg-transparent"></div>

                    <div class="w-8 h-8 bg-blue-100"></div>
                    <div class="w-8 h-8 bg-blue-300"></div>
                    <div class="w-8 h-8 bg-blue-200"></div>
                    <div class="w-8 h-8 bg-blue-100"></div>

                    <div class="w-8 h-8 bg-blue-200"></div>
                    <div class="w-8 h-8 bg-blue-100"></div>
                    <div class="w-8 h-8 bg-blue-300"></div>
                    <div class="w-8 h-8 bg-blue-200"></div>
                </div>
            </div>


            <!-- RIGHT ILLUSTRATION -->
            <div class="absolute right-8 bottom-4 hidden lg:block">

                <img src="{{ asset('icon/cta-newspaper.svg') }}"
                    class="w-52">

                {{-- <div class="absolute -left-8 top-2 bg-yellow-400 text-white px-2 py-1 rounded-md text-xs font-bold">
                    &lt;/&gt;
                </div> --}}

                <div class="absolute -left-14 bottom-6 rotate-12">
                    <img src="{{ asset('icon/cta-image.svg') }}" class="w-8">
                </div>

            </div>


            <!-- CONTENT -->
            <div class="relative z-10 text-center max-w-2xl mx-auto">

                <h2 class="text-3xl lg:text-5xl font-bold text-gray-800 mb-4">
                    Bangun Skill Masa Depanmu Hari Ini
                </h2>

                <p class="text-gray-500 text-lg leading-relaxed mb-8">
                    Persiapkan dirimu dengan skill design, coding, dan robotics
                    yang dibutuhkan di masa depan.
                </p>

                <button class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-full shadow-xl transition flex items-center gap-3 mx-auto">
                    Mulai Perjalananmu
                    <span>➜</span>
                </button>

            </div>

        </div>

    </div>
</section>

  <!-- ============================================================
       FOOTER
  ============================================================ -->


  <!-- ============================================================
       JAVASCRIPT
  ============================================================ -->
  <script>
    // ── FAQ Toggle ──────────────────────────────────────────────
    function toggleFaq(el) {
      const answer = el.nextElementSibling;
      const chev   = el.querySelector('.faq-chev');
      const isOpen = answer.classList.contains('open');

      // Close all
      document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
      document.querySelectorAll('.faq-q').forEach(q => {
        q.classList.remove('!bg-blue-500', '!text-white');
        q.querySelector('.faq-chev').style.transform = '';
      });

      // Open if was closed
      if (!isOpen) {
        answer.classList.add('open');
        el.style.background = '#1B6EF3';
        el.style.color = '#fff';
        chev.style.transform = 'rotate(180deg)';
      } else {
        el.style.background = '';
        el.style.color = '';
      }
    }

    // ── Program Card Active Toggle ───────────────────────────────
    document.querySelectorAll('.slide-hover').forEach(card => {
      card.addEventListener('click', function () {
        document.querySelectorAll('.slide-hover').forEach(c => {
          c.classList.remove('bg-blue-500', 'shadow-lg', 'shadow-blue-500/30');
          c.classList.add('border', 'border-slate-100');
          c.querySelectorAll('h3').forEach(h => { h.classList.remove('text-white'); h.classList.add('text-dark'); });
          c.querySelectorAll('p').forEach(p => { p.classList.remove('text-white/80'); p.classList.add('text-muted'); });
          const icon = c.querySelector('div:first-child');
          if (icon) { icon.classList.remove('bg-white/20'); icon.classList.add('bg-blue-50'); }
        });
        this.classList.add('bg-blue-500', 'shadow-lg', 'shadow-blue-500/30');
        this.classList.remove('border', 'border-slate-100');
        this.querySelectorAll('h3').forEach(h => { h.classList.add('text-white'); h.classList.remove('text-dark'); });
        this.querySelectorAll('p').forEach(p => { p.classList.add('text-white/80'); p.classList.remove('text-muted'); });
        const icon = this.querySelector('div:first-child');
        if (icon) { icon.classList.add('bg-white/20'); icon.classList.remove('bg-blue-50'); }
      });
    });
  </script>

</body>
</html>
@endsection