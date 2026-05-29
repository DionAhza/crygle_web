<?php
// database/migrations/2026_05_25_000001_create_course_platform.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ── CATEGORIES ──────────────────────────────
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('color', 20)->default('#1B6EF3');
            $table->timestamps();
        });

        // ── COURSES ─────────────────────────────────
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();       // instructor
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('what_you_learn')->nullable();
            $table->json('requirements')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->enum('type', ['free', 'paid'])->default('free');
            $table->string('thumbnail')->nullable();
            $table->string('trailer_url')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('language', 50)->default('Indonesia');
            $table->timestamps();
        });

        // ── SECTIONS ────────────────────────────────
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ── LESSONS ─────────────────────────────────
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('video_url')->nullable();
            $table->text('notes')->nullable();
            $table->integer('duration_seconds')->default(0);
            $table->boolean('is_preview')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ── ENROLLMENTS ─────────────────────────────
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['active', 'expired', 'refunded'])->default('active');
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->timestamp('enrolled_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'course_id']);
        });

        // ── LESSON PROGRESS ─────────────────────────
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_completed')->default(false);
            $table->integer('watched_seconds')->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'lesson_id']);
        });

        // ── REVIEWS ─────────────────────────────────
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('rating'); // 1-5
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'course_id']);
        });

        // ── TRANSACTIONS ─────────────────────────────
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('gateway_ref')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('lesson_progress');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('categories');
    }
};
