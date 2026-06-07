<?php
namespace App\Http\Controllers;

use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Redirect instructor/admin ke panel masing-masing
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        if ($user->isInstructor()) return redirect()->route('instructor.dashboard');

        $enrollments = Enrollment::with('course.sections.lessons','course.category')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $stats = [
            'total'     => $enrollments->count(),
            'completed' => $enrollments->filter(fn($e) => $e->progressPercent() >= 100)->count(),
            'ongoing'   => $enrollments->filter(fn($e) => $e->progressPercent() > 0 && $e->progressPercent() < 100)->count(),
        ];

        return view('dashboard.index', compact('enrollments', 'stats'));
    }
}
