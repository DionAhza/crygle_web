@extends('layouts.app')

@section('title', $course->title . ' — Crygle Academy')

@section('content')

{{-- ============================================================
     HERO / HEADER COURSE
     ============================================================ --}}
<section class="bg-gradient-to-br from-blue-900 to-blue-700 text-white py-14 px-6">
    <div class="max-w-5xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="text-blue-300 text-sm mb-6">
            <a href="/" class="hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <a href="/courses" class="hover:text-white">Course</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $course->title }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            {{-- Kiri: Info teks --}}
            <div class="flex-1">
                <h1 class="text-3xl lg:text-4xl font-bold leading-snug mb-4">
                    {{ $course->title }}
                </h1>
                <p class="text-blue-200 text-base leading-relaxed mb-6">
                    {{ $course->description }}
                </p>

                {{-- Statistik singkat --}}
                <div class="flex flex-wrap gap-6 text-sm text-blue-100">
                    <span>📚 {{ $course->sections->count() }} Section</span>
                    <span>🎬 {{ $course->sections->sum(fn($s) => $s->lessons->count()) }} Lesson</span>
                </div>
            </div>

            {{-- Kanan: Card harga --}}
            <div class="bg-white text-gray-800 rounded-2xl shadow-xl p-6 w-full lg:w-72 flex-shrink-0">

                {{-- Thumbnail --}}
                @if ($course->thumbnail)
                    <img src="{{ $course->thumbnail }}"
                         alt="{{ $course->title }}"
                         class="w-full h-36 object-cover rounded-xl mb-4">
                @endif

                <div class="text-2xl font-bold {{ $course->price == 0 ? 'text-green-600' : 'text-blue-700' }} mb-4">
                    {{ $course->formattedPrice() }}
                </div>

                <button class="w-full bg-blue-700 hover:bg-blue-600 text-white font-semibold py-3 rounded-xl transition">
                    {{ $course->price == 0 ? '🎉 Mulai Belajar Gratis' : '🛒 Daftar Sekarang' }}
                </button>

                <p class="text-gray-400 text-xs text-center mt-3">
                    Akses seumur hidup · Sertifikat · Komunitas
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     KURIKULUM / DAFTAR SECTION & LESSON
     ============================================================ --}}
<section class="max-w-5xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📋 Kurikulum Course</h2>

    @if ($course->sections->isEmpty())
        <div class="bg-gray-50 rounded-xl p-10 text-center text-gray-400">
            <p>Belum ada materi yang ditambahkan.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($course->sections as $section)

                {{-- SECTION --}}
                <div class="border border-gray-200 rounded-xl overflow-hidden">

                    {{-- Header section --}}
                    <div class="bg-gray-50 px-5 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                Section {{ $loop->iteration }}
                            </span>
                            <h3 class="font-semibold text-gray-800">{{ $section->title }}</h3>
                        </div>
                        <span class="text-gray-400 text-sm">
                            {{ $section->lessons->count() }} lesson
                        </span>
                    </div>

                    {{-- LESSON LIST --}}
                    @if ($section->lessons->isNotEmpty())
                        <ul class="divide-y divide-gray-100">
                            @foreach ($section->lessons as $lesson)
                                <li class="flex items-center gap-4 px-5 py-3 hover:bg-blue-50 transition-colors">

                                    {{-- Icon video --}}
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 text-blue-600 text-sm">
                                        ▶
                                    </div>

                                    {{-- Judul lesson --}}
                                    <span class="flex-1 text-gray-700 text-sm">
                                        {{ $lesson->title }}
                                    </span>

                                    {{-- Link video jika ada --}}
                                    @if ($lesson->video_url)
                                        <a href="{{ $lesson->video_url }}"
                                           target="_blank"
                                           class="text-blue-500 hover:text-blue-700 text-xs underline flex-shrink-0">
                                            Tonton
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="px-5 py-4 text-gray-400 text-sm">Belum ada lesson di section ini.</p>
                    @endif

                </div>

            @endforeach
        </div>
    @endif

</section>

{{-- ============================================================
     TOMBOL KEMBALI
     ============================================================ --}}
<div class="max-w-5xl mx-auto px-6 pb-12">
    <a href="/courses"
       class="inline-flex items-center gap-2 text-blue-700 hover:underline font-medium">
        ← Kembali ke semua course
    </a>
</div>

@endsection
