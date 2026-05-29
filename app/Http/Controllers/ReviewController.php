<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $user = auth()->user();

        if (!$user->isEnrolled($course))
            return back()->with('error', 'Hanya peserta yang bisa memberi ulasan.');

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Ulasan berhasil disimpan! ⭐');
    }
}
