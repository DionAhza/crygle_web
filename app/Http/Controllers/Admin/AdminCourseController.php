<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category','instructor')
            ->withCount('enrollments')
            ->withAvg('reviews','rating')
            ->latest()->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function togglePublish(Course $course)
    {
        $course->update(['status' => $course->status === 'published' ? 'draft' : 'published']);
        return back()->with('success', 'Status course diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course dihapus.');
    }
}
