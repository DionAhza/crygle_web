<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Tampilkan semua course → /courses
     */
    public function index()
    {
        // Ambil semua course dari database, diurutkan terbaru
        $courses = Course::latest()->get();

        return view('courses.index', compact('courses'));
    }

    /**
     * Tampilkan detail satu course + section & lesson → /courses/{id}
     */
    public function show(string $id)
    {
        // Eager load sections dan lessons sekaligus (efisien, hindari N+1 query)
        $course = Course::with('sections.lessons')->findOrFail($id);

        return view('courses.show', compact('course'));
    }
}
