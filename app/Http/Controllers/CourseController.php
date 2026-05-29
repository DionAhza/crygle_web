<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function home()
    {
        $featured   = Course::with('category','instructor','reviews')
                            ->where('status','published')->latest()->take(6)->get();
        $categories = Category::withCount(['courses' => fn($q) => $q->where('status','published')])->get();
        $stats = [
            'students' => \App\Models\Enrollment::count(),
            'courses'  => Course::where('status','published')->count(),
            'reviews'  => \App\Models\Review::count(),
        ];
        return view('home', compact('featured','categories','stats'));
    }

    public function index(Request $request)
    {
        $query = Course::with('category','instructor','reviews','sections.lessons')
                       ->where('status','published');

        if ($request->filled('q'))
            $query->where('title','like',"%{$request->q}%");
        if ($request->filled('category'))
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        if ($request->filled('level'))
            $query->where('level', $request->level);
        if ($request->filled('type'))
            $query->where('type', $request->type);

        $sort = $request->get('sort', 'latest');
        match($sort) {
            'popular'  => $query->withCount('enrollments')->orderByDesc('enrollments_count'),
            'rating'   => $query->withAvg('reviews','rating')->orderByDesc('reviews_avg_rating'),
            'price_asc'=> $query->orderBy('price'),
            default    => $query->latest(),
        };

        $courses    = $query->paginate(9)->withQueryString();
        $categories = Category::all();
        return view('courses.index', compact('courses','categories'));
    }

    public function show(Course $course)
    {
        abort_if(!$course->isPublished(), 404);
        $course->load('sections.lessons','category','instructor','reviews.user','enrollments');

        $enrollment = auth()->check() ? auth()->user()->getEnrollment($course) : null;
        $userReview = auth()->check() ? $course->reviews->where('user_id', auth()->id())->first() : null;
        $hasPending = auth()->check() ? auth()->user()->hasPendingTransaction($course) : false;

        $related = Course::with('category','reviews')
            ->where('category_id', $course->category_id)
            ->where('id','!=',$course->id)
            ->where('status','published')->take(3)->get();

        $ratingBreakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $cnt = $course->reviews->where('rating', $i)->count();
            $ratingBreakdown[$i] = [
                'count'   => $cnt,
                'percent' => $course->reviews->count() > 0 ? round($cnt / $course->reviews->count() * 100) : 0,
            ];
        }

        return view('courses.show', compact('course','enrollment','userReview','hasPending','related','ratingBreakdown'));
    }
}
