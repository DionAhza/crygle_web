<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Course, Enrollment, Review, Transaction, User};

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'       => User::where('role','user')->count(),
            'instructors' => User::where('role','instructor')->count(),
            'courses'     => Course::count(),
            'enrollments' => Enrollment::count(),
            'revenue'     => Transaction::where('status','paid')->sum('amount'),
            'pending_tx'  => Transaction::where('status','pending')->count(),
        ];

        $recentTransactions = Transaction::with('user','course')->latest()->take(8)->get();
        $topCourses = Course::withCount('enrollments')->withAvg('reviews','rating')
                            ->where('status','published')->orderByDesc('enrollments_count')->take(5)->get();
        $recentUsers = User::where('role','user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats','recentTransactions','topCourses','recentUsers'));
    }
}
