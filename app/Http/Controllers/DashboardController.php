<?php
namespace App\Http\Controllers;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $enrollments = Enrollment::with('course.sections.lessons','course.category')
            ->where('user_id', $user->id)->latest()->get();

        $stats = [
            'total'     => $enrollments->count(),
            'completed' => $enrollments->filter(fn($e) => $e->progressPercent() >= 100)->count(),
            'ongoing'   => $enrollments->filter(fn($e) => $e->progressPercent() > 0 && $e->progressPercent() < 100)->count(),
        ];

        return view('dashboard', compact('enrollments','stats'));
    }
}
