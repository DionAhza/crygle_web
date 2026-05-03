@extends('layouts.app')

@section('title', 'Semua Course — Crygle Academy')

@section('content')

{{-- ============================================================
     HERO SECTION
     ============================================================ --}}
<section class="bg-gradient-to-br from-blue-900 to-blue-700 text-white py-16 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-3">Semua Course</h1>
        <p class="text-blue-200 text-lg">Pilih kelas yang sesuai dengan tujuan belajarmu</p>
    </div>
</section>

{{-- ============================================================
     COURSE GRID
     ============================================================ --}}
<section class="max-w-6xl mx-auto px-6 py-12">

    {{-- Jika tidak ada course --}}
    @if ($courses->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <p class="text-5xl mb-4">📭</p>
            <p class="text-xl font-medium">Belum ada course tersedia.</p>
            <p class="text-sm mt-2">Silakan jalankan seeder terlebih dahulu.</p>
        </div>

    {{-- Tampilkan daftar course --}}
    @else
        <p class="text-gray-500 mb-8">Menampilkan <strong>{{ $courses->count() }}</strong> course</p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($courses as $course)
                <a href="/courses/{{ $course->id }}"
                   class="bg-white rounded-2xl shadow-md overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-200 flex flex-col">

                    {{-- Thumbnail --}}
                    <div class="h-44 bg-blue-50 overflow-hidden">
                        @if ($course->thumbnail)
                            <img src="{{ $course->thumbnail }}"
                                 alt="{{ $course->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-blue-300 text-5xl">🎓</div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-5 flex flex-col flex-1">
                        <h2 class="font-bold text-gray-800 text-lg leading-snug mb-2">
                            {{ $course->title }}
                        </h2>
                        <p class="text-gray-500 text-sm leading-relaxed flex-1 line-clamp-3">
                            {{ $course->description }}
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            {{-- Harga --}}
                            <span class="{{ $course->price == 0 ? 'text-green-600' : 'text-blue-700' }} font-bold text-lg">
                                {{ $course->formattedPrice() }}
                            </span>

                            {{-- Tombol --}}
                            <span class="bg-blue-700 text-white text-sm px-4 py-2 rounded-full hover:bg-blue-600 transition">
                                Lihat Course →
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</section>

@endsection
