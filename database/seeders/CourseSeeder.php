<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // COURSE 1 — Web Development
        // ============================================================
        $course1 = Course::create([
            'title'       => 'Web Development dengan Laravel',
            'description' => 'Pelajari cara membangun aplikasi web modern menggunakan framework Laravel dari nol hingga siap deploy. Cocok untuk pemula yang ingin terjun ke dunia backend development.',
            'price'       => 299000,
            'thumbnail'   => 'https://placehold.co/600x400/1B6EF3/white?text=Laravel',
        ]);

        $s1 = Section::create(['course_id' => $course1->id, 'title' => 'Persiapan & Instalasi', 'order' => 1]);
        Lesson::insert([
            ['section_id' => $s1->id, 'title' => 'Instalasi PHP & Composer',          'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s1->id, 'title' => 'Instalasi Laravel dengan Composer',  'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s1->id, 'title' => 'Struktur Folder Laravel',            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $s2 = Section::create(['course_id' => $course1->id, 'title' => 'Routing & Controller', 'order' => 2]);
        Lesson::insert([
            ['section_id' => $s2->id, 'title' => 'Memahami Routing di Laravel',        'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s2->id, 'title' => 'Membuat Controller Pertama',         'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s2->id, 'title' => 'Resource Controller & REST API',     'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $s3 = Section::create(['course_id' => $course1->id, 'title' => 'Database & Eloquent ORM', 'order' => 3]);
        Lesson::insert([
            ['section_id' => $s3->id, 'title' => 'Migration & Schema Builder',         'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s3->id, 'title' => 'Eloquent Model & Relasi',            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s3->id, 'title' => 'Seeder & Factory untuk Data Dummy',  'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ============================================================
        // COURSE 2 — UI/UX Design
        // ============================================================
        $course2 = Course::create([
            'title'       => 'UI/UX Design dengan Figma',
            'description' => 'Kuasai desain antarmuka dan pengalaman pengguna menggunakan Figma. Mulai dari wireframe, prototype, hingga handoff ke developer. Ideal untuk desainer pemula maupun yang ingin upgrade skill.',
            'price'       => 199000,
            'thumbnail'   => 'https://placehold.co/600x400/F24E1E/white?text=Figma',
        ]);

        $s4 = Section::create(['course_id' => $course2->id, 'title' => 'Dasar Desain & Figma', 'order' => 1]);
        Lesson::insert([
            ['section_id' => $s4->id, 'title' => 'Pengenalan UI vs UX',                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s4->id, 'title' => 'Tur Interface Figma',                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s4->id, 'title' => 'Frame, Layer & Component',           'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $s5 = Section::create(['course_id' => $course2->id, 'title' => 'Wireframing & Prototyping', 'order' => 2]);
        Lesson::insert([
            ['section_id' => $s5->id, 'title' => 'Membuat Wireframe Lo-Fi',            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s5->id, 'title' => 'Upgrade ke Hi-Fi Mockup',            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s5->id, 'title' => 'Membuat Prototype Interaktif',       'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ============================================================
        // COURSE 3 — Digital Marketing (GRATIS)
        // ============================================================
        $course3 = Course::create([
            'title'       => 'Digital Marketing untuk Pemula',
            'description' => 'Pelajari strategi pemasaran digital yang efektif: SEO, social media marketing, email marketing, dan Google Ads. Cocok untuk pebisnis, freelancer, maupun mahasiswa yang ingin memulai karier di bidang marketing.',
            'price'       => 0,
            'thumbnail'   => 'https://placehold.co/600x400/10B981/white?text=Marketing',
        ]);

        $s6 = Section::create(['course_id' => $course3->id, 'title' => 'Fondasi Digital Marketing', 'order' => 1]);
        Lesson::insert([
            ['section_id' => $s6->id, 'title' => 'Apa itu Digital Marketing?',         'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s6->id, 'title' => 'Mengenal Target Audience',           'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $s7 = Section::create(['course_id' => $course3->id, 'title' => 'SEO & Content Marketing', 'order' => 2]);
        Lesson::insert([
            ['section_id' => $s7->id, 'title' => 'Dasar-dasar SEO On-Page',            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s7->id, 'title' => 'Riset Keyword dengan Google',        'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s7->id, 'title' => 'Membuat Konten yang Viral',          'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $s8 = Section::create(['course_id' => $course3->id, 'title' => 'Social Media & Iklan', 'order' => 3]);
        Lesson::insert([
            ['section_id' => $s8->id, 'title' => 'Strategi Instagram & TikTok',        'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_id' => $s8->id, 'title' => 'Membuat Iklan di Meta Ads',          'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $this->command->info('✅ CourseSeeder selesai: 3 course, 8 section, 24 lesson berhasil dibuat!');
    }
}
