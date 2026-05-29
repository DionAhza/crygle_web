<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Instructor\InstructorCourseController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// PUBLIC
// ─────────────────────────────────────────────
Route::get('/',             [CourseController::class, 'home'])->name('home');
Route::get('/courses',      [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

// ─────────────────────────────────────────────
// GUEST ONLY
// ─────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// ─────────────────────────────────────────────
// AUTHENTICATED USER
// ─────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Enrollment & Checkout
    Route::post('/courses/{course:slug}/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/transactions/{transaction}/payment', [TransactionController::class, 'payment'])->name('payment');
    Route::post('/transactions/{transaction}/confirm', [TransactionController::class, 'confirm'])->name('payment.confirm');

    // Belajar
    Route::get('/learn/{enrollment}/lesson/{lesson}', [LessonController::class, 'show'])->name('learn.lesson');
    Route::post('/learn/{enrollment}/lesson/{lesson}/complete', [LessonController::class, 'complete'])->name('learn.complete');

    // Review
    Route::post('/courses/{course:slug}/review', [ReviewController::class, 'store'])->name('review.store');
});

// ─────────────────────────────────────────────
// INSTRUCTOR
// ─────────────────────────────────────────────
Route::middleware(['auth', 'instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/', [InstructorCourseController::class, 'index'])->name('dashboard');
    Route::resource('courses', InstructorCourseController::class)->except(['show']);
    Route::post('courses/{course}/sections', [InstructorCourseController::class, 'storeSection'])->name('courses.sections.store');
    Route::delete('courses/{course}/sections/{section}', [InstructorCourseController::class, 'destroySection'])->name('courses.sections.destroy');
    Route::post('sections/{section}/lessons', [InstructorCourseController::class, 'storeLesson'])->name('sections.lessons.store');
    Route::delete('sections/{section}/lessons/{lesson}', [InstructorCourseController::class, 'destroyLesson'])->name('sections.lessons.destroy');
    Route::patch('courses/{course}/publish', [InstructorCourseController::class, 'togglePublish'])->name('courses.publish');
});

// ─────────────────────────────────────────────
// ADMIN
// ─────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', AdminCourseController::class)->only(['index', 'destroy']);
    Route::patch('courses/{course}/publish', [AdminCourseController::class, 'togglePublish'])->name('courses.publish');
    Route::resource('users', AdminUserController::class)->only(['index', 'destroy']);
    Route::patch('users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
    Route::resource('transactions', AdminTransactionController::class)->only(['index']);
    Route::patch('transactions/{transaction}/status', [AdminTransactionController::class, 'updateStatus'])->name('transactions.status');
});
