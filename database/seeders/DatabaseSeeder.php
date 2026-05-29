<?php
namespace Database\Seeders;

use App\Models\{Category, Course, Enrollment, Lesson, LessonProgress, Review, Section, Transaction, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── USERS ──────────────────────────────────────────
        $admin = User::create([
            'name' => 'Admin Crygle', 'email' => 'admin@crygle.com',
            'password' => Hash::make('admin1234'), 'role' => 'admin',
            'headline' => 'Founder & Platform Admin',
        ]);

        $instructors = collect([
            ['name' => 'Rizky Firmansyah', 'email' => 'rizky@crygle.com', 'headline' => 'Senior Full-Stack Developer · 8 Tahun Pengalaman'],
            ['name' => 'Aulia Putri',       'email' => 'aulia@crygle.com', 'headline' => 'UI/UX Designer & Brand Strategist'],
            ['name' => 'Dimas Prasetyo',    'email' => 'dimas@crygle.com', 'headline' => 'Digital Marketing Expert · Google Certified'],
        ])->map(fn($d) => User::create([...$d, 'password' => Hash::make('password'), 'role' => 'instructor']));

        $students = collect([
            ['name' => 'Budi Santoso',  'email' => 'budi@example.com'],
            ['name' => 'Siti Rahayu',   'email' => 'siti@example.com'],
            ['name' => 'Ahmad Fauzi',   'email' => 'ahmad@example.com'],
            ['name' => 'Dewi Lestari',  'email' => 'dewi@example.com'],
            ['name' => 'Eko Prasetyo',  'email' => 'eko@example.com'],
        ])->map(fn($d) => User::create([...$d, 'password' => Hash::make('password'), 'role' => 'user']));

        // ── CATEGORIES ─────────────────────────────────────
        $cats = collect([
            ['name' => 'Web Development',   'slug' => 'web-development',   'icon' => '💻', 'color' => '#1B6EF3'],
            ['name' => 'UI/UX Design',       'slug' => 'ui-ux-design',       'icon' => '🎨', 'color' => '#F24E1E'],
            ['name' => 'Digital Marketing',  'slug' => 'digital-marketing',  'icon' => '📣', 'color' => '#10B981'],
            ['name' => 'Data Science',       'slug' => 'data-science',       'icon' => '📊', 'color' => '#8B5CF6'],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development', 'icon' => '📱', 'color' => '#06B6D4'],
        ])->mapWithKeys(fn($d) => [$d['slug'] => Category::create($d)]);

        // ── COURSES ────────────────────────────────────────
        $coursesData = [
            [
                'instructor' => $instructors[0],
                'category'   => 'web-development',
                'title'      => 'Laravel 11 Masterclass: Dari Nol ke Full-Stack',
                'desc'       => 'Kuasai Laravel 11 secara menyeluruh — routing, Eloquent, authentication, REST API, hingga deployment ke VPS. Cocok untuk pemula yang ingin menjadi full-stack developer profesional.',
                'price'      => 0, 'discount' => null,
                'level'      => 'beginner', 'thumb' => 'https://placehold.co/800x450/1B6EF3/ffffff?text=Laravel+11',
                'learn'      => ['Memahami arsitektur MVC Laravel', 'Membuat REST API yang scalable', 'Eloquent ORM & Database Relations', 'Authentication & Authorization', 'Deployment ke VPS dengan Nginx'],
                'req'        => ['Mengerti dasar HTML & PHP', 'Sudah install Composer', 'Semangat belajar tinggi'],
                'sections'   => [
                    ['title' => 'Mulai dari Nol', 'lessons' => [
                        ['title' => 'Instalasi Laravel & Setup Project', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 720, 'preview' => true],
                        ['title' => 'Memahami Struktur Folder Laravel', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 540],
                        ['title' => 'Konfigurasi .env & Database', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 480],
                    ]],
                    ['title' => 'Routing & Controller', 'lessons' => [
                        ['title' => 'Routing Dasar & Named Routes', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900, 'preview' => true],
                        ['title' => 'Resource Controller', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 780],
                        ['title' => 'Middleware & Route Group', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 660],
                    ]],
                    ['title' => 'Eloquent & Database', 'lessons' => [
                        ['title' => 'Migration & Schema Builder', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 840],
                        ['title' => 'Eloquent Model & Query Builder', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1020],
                        ['title' => 'Relasi One-to-Many & Many-to-Many', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1200],
                        ['title' => 'Seeder & Factory', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 600],
                    ]],
                    ['title' => 'Authentication & API', 'lessons' => [
                        ['title' => 'Laravel Breeze Authentication', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900],
                        ['title' => 'Membuat REST API dengan Sanctum', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1080],
                    ]],
                ],
            ],
            [
                'instructor' => $instructors[1],
                'category'   => 'ui-ux-design',
                'title'      => 'UI/UX Design Profesional dengan Figma 2025',
                'desc'       => 'Belajar desain produk digital dari wireframe hingga prototype interaktif. Pelajari design system, UX research, dan cara kerja sama dengan developer yang sesungguhnya.',
                'price'      => 299000, 'discount' => 199000,
                'level'      => 'beginner', 'thumb' => 'https://placehold.co/800x450/F24E1E/ffffff?text=UI%2FUX+Figma',
                'learn'      => ['Prinsip dasar UI & UX Design', 'Membuat wireframe & mockup', 'Design System & Component Library', 'Prototype interaktif di Figma', 'User Research & Usability Testing'],
                'req'        => ['Tidak perlu background desain', 'Laptop dengan Figma terinstall (gratis)'],
                'sections'   => [
                    ['title' => 'Fondasi Design Thinking', 'lessons' => [
                        ['title' => 'UI vs UX: Perbedaan yang Harus Kamu Tahu', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 600, 'preview' => true],
                        ['title' => 'Prinsip Visual Design', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 720],
                        ['title' => 'Teori Warna & Tipografi', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 840],
                    ]],
                    ['title' => 'Figma dari Dasar', 'lessons' => [
                        ['title' => 'Tour Interface Figma', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 660, 'preview' => true],
                        ['title' => 'Frame, Layer, & Group', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 780],
                        ['title' => 'Components & Variants', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 960],
                        ['title' => 'Auto Layout Mastery', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900],
                    ]],
                    ['title' => 'Prototyping & Handoff', 'lessons' => [
                        ['title' => 'Membuat Prototype Interaktif', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1080],
                        ['title' => 'Developer Handoff dengan Figma', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 720],
                    ]],
                ],
            ],
            [
                'instructor' => $instructors[2],
                'category'   => 'digital-marketing',
                'title'      => 'Digital Marketing & Growth Hacking 2025',
                'desc'       => 'Strategi pemasaran digital modern yang terbukti: SEO, Meta Ads, TikTok Marketing, Email Automation, dan analitik data. Langsung praktek dengan studi kasus bisnis nyata.',
                'price'      => 349000, 'discount' => null,
                'level'      => 'beginner', 'thumb' => 'https://placehold.co/800x450/10B981/ffffff?text=Digital+Marketing',
                'learn'      => ['SEO On-Page & Off-Page', 'Meta Ads & TikTok Ads', 'Email Marketing Automation', 'Google Analytics 4', 'Strategi konten viral'],
                'req'        => ['Memiliki produk/bisnis yang ingin dipasarkan (opsional)', 'Tidak perlu background marketing'],
                'sections'   => [
                    ['title' => 'Fondasi Digital Marketing', 'lessons' => [
                        ['title' => 'Ekosistem Digital Marketing 2025', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 720, 'preview' => true],
                        ['title' => 'Mengenal & Riset Target Audience', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900],
                    ]],
                    ['title' => 'SEO & Content Strategy', 'lessons' => [
                        ['title' => 'Riset Keyword yang Efektif', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 960, 'preview' => true],
                        ['title' => 'SEO On-Page: Optimasi Konten', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1080],
                        ['title' => 'Link Building & Off-Page SEO', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 840],
                    ]],
                    ['title' => 'Social Media & Iklan Berbayar', 'lessons' => [
                        ['title' => 'Meta Ads: Facebook & Instagram', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1320],
                        ['title' => 'TikTok Ads & Organic Strategy', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1080],
                        ['title' => 'Email Marketing dengan Mailchimp', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900],
                    ]],
                ],
            ],
            [
                'instructor' => $instructors[0],
                'category'   => 'data-science',
                'title'      => 'Python Data Science & Machine Learning Bootcamp',
                'desc'       => 'Kuasai analisis data dan machine learning dengan Python. Dari pandas dan visualisasi data hingga model prediktif dengan scikit-learn. Dilengkapi project portfolio nyata.',
                'price'      => 449000, 'discount' => 299000,
                'level'      => 'intermediate', 'thumb' => 'https://placehold.co/800x450/8B5CF6/ffffff?text=Python+DS',
                'learn'      => ['Python untuk Data Science', 'Analisis data dengan Pandas & NumPy', 'Visualisasi dengan Matplotlib & Seaborn', 'Machine Learning dengan Scikit-learn', 'Project: Prediksi harga rumah'],
                'req'        => ['Dasar pemrograman Python', 'Mengerti matematika SMA'],
                'sections'   => [
                    ['title' => 'Python Fundamentals', 'lessons' => [
                        ['title' => 'Setup Python & Jupyter Notebook', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 660, 'preview' => true],
                        ['title' => 'NumPy: Array & Matrix Operations', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1080],
                    ]],
                    ['title' => 'Data Analysis dengan Pandas', 'lessons' => [
                        ['title' => 'Load & Explore Dataset', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900, 'preview' => true],
                        ['title' => 'Data Cleaning & Preprocessing', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1200],
                        ['title' => 'Exploratory Data Analysis (EDA)', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1320],
                    ]],
                    ['title' => 'Machine Learning', 'lessons' => [
                        ['title' => 'Pengenalan Machine Learning', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 840],
                        ['title' => 'Regresi Linear & Logistik', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1440],
                        ['title' => 'Random Forest & Evaluasi Model', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1200],
                    ]],
                ],
            ],
            [
                'instructor' => $instructors[1],
                'category'   => 'mobile-development',
                'title'      => 'Flutter & Dart: Build Apps iOS & Android',
                'desc'       => 'Bangun aplikasi mobile cross-platform yang indah dengan Flutter. Dari komponen dasar, state management Provider/Riverpod, integrasi REST API, hingga publish ke App Store dan Play Store.',
                'price'      => 399000, 'discount' => null,
                'level'      => 'intermediate', 'thumb' => 'https://placehold.co/800x450/06B6D4/ffffff?text=Flutter',
                'learn'      => ['Dart Programming Language', 'Flutter Widget System', 'State Management dengan Riverpod', 'REST API Integration', 'Publish ke Play Store & App Store'],
                'req'        => ['Dasar pemrograman (bahasa apapun)', 'Mac OS untuk build iOS (opsional)'],
                'sections'   => [
                    ['title' => 'Dart & Flutter Basics', 'lessons' => [
                        ['title' => 'Kenalan dengan Dart', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 840, 'preview' => true],
                        ['title' => 'Flutter Setup & First App', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 960],
                        ['title' => 'Widget Tree: Stateless & Stateful', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1080],
                    ]],
                    ['title' => 'UI Flutter', 'lessons' => [
                        ['title' => 'Layout: Row, Column, Stack, Flex', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1200, 'preview' => true],
                        ['title' => 'ListView, GridView & Scrolling', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 900],
                        ['title' => 'Navigation & Routes', 'url' => 'https://youtu.be/MFh0Fd7BsjE', 'dur' => 1020],
                    ]],
                ],
            ],
        ];

        $created = [];
        foreach ($coursesData as $d) {
            $course = Course::create([
                'user_id'        => $d['instructor']->id,
                'category_id'    => $cats[$d['category']]->id,
                'title'          => $d['title'],
                'slug'           => Str::slug($d['title']) . '-' . Str::random(4),
                'description'    => $d['desc'],
                'price'          => $d['price'],
                'discount_price' => $d['discount'],
                'type'           => $d['price'] == 0 ? 'free' : 'paid',
                'thumbnail'      => $d['thumb'],
                'level'          => $d['level'],
                'status'         => 'published',
                'what_you_learn' => $d['learn'],
                'requirements'   => $d['req'],
            ]);

            $sOrd = 1;
            foreach ($d['sections'] as $sData) {
                $section = Section::create(['course_id' => $course->id, 'title' => $sData['title'], 'order' => $sOrd++]);
                $lOrd = 1;
                foreach ($sData['lessons'] as $lData) {
                    Lesson::create([
                        'section_id'       => $section->id,
                        'title'            => $lData['title'],
                        'video_url'        => $lData['url'],
                        'duration_seconds' => $lData['dur'],
                        'is_preview'       => $lData['preview'] ?? false,
                        'order'            => $lOrd++,
                    ]);
                }
            }
            $created[] = $course;
        }

        // ── ENROLLMENTS & REVIEWS ──────────────────────────
        $enrollPairs = [
            [$students[0], $created[0], 0, 5, 'Luar biasa! Penjelasan sangat detail dan mudah dipahami.'],
            [$students[0], $created[2], 349000, 4, 'Materi lengkap, studi kasusnya sangat membantu.'],
            [$students[1], $created[0], 0, 5, 'Best course! Sudah bisa bikin project sendiri setelah selesai.'],
            [$students[1], $created[1], 199000, 4, 'Mentornya keren, penjelasan logis dan sistematis.'],
            [$students[2], $created[3], 299000, 5, 'Worth it banget! Langsung bisa apply di kerjaan.'],
            [$students[3], $created[0], 0, 4, 'Bagus, tapi kalau ada lebih banyak latihan akan lebih baik.'],
            [$students[3], $created[4], 399000, 5, 'Sangat komprehensif, Flutter-ku jadi jauh lebih jago!'],
            [$students[4], $created[2], 349000, 5, 'Strategi marketingnya langsung bisa dipraktekkan!'],
        ];

        foreach ($enrollPairs as [$student, $course, $paid, $rating, $comment]) {
            $enrollment = Enrollment::create([
                'user_id' => $student->id, 'course_id' => $course->id,
                'status' => 'active', 'amount_paid' => $paid, 'enrolled_at' => now()->subDays(rand(5,60)),
            ]);

            // Progress beberapa lesson
            $lessons = $course->sections->flatMap->lessons;
            $doneCount = rand(1, max(1, $lessons->count() - 1));
            foreach ($lessons->take($doneCount) as $lesson) {
                LessonProgress::create(['user_id' => $student->id, 'lesson_id' => $lesson->id, 'is_completed' => true]);
            }

            Review::create(['user_id' => $student->id, 'course_id' => $course->id, 'rating' => $rating, 'comment' => $comment]);

            // Transaction untuk yang berbayar
            if ($paid > 0) {
                Transaction::create([
                    'user_id'        => $student->id,
                    'course_id'      => $course->id,
                    'invoice_number' => Transaction::generateInvoice(),
                    'amount'         => $paid,
                    'status'         => 'paid',
                    'payment_method' => collect(['Transfer Bank', 'QRIS', 'Virtual Account', 'GoPay', 'OVO'])->random(),
                    'gateway_ref'    => 'SIM-' . strtoupper(Str::random(8)),
                ]);
            }
        }

        // Beberapa transaksi pending
        Transaction::create([
            'user_id' => $students[2]->id, 'course_id' => $created[1]->id,
            'invoice_number' => Transaction::generateInvoice(), 'amount' => 199000,
            'status' => 'pending', 'payment_method' => 'Transfer Bank',
        ]);

        $this->command->info('✅ Seeder selesai!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin',      'admin@crygle.com', 'admin1234'],
                ['Instructor', 'rizky@crygle.com', 'password'],
                ['Student',    'budi@example.com', 'password'],
            ]
        );
    }
}
