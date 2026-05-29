<?php
namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstructorCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category','enrollments','reviews')
            ->where('user_id', auth()->id())
            ->withCount('enrollments')
            ->latest()->paginate(10);

        $stats = [
            'total'    => Course::where('user_id', auth()->id())->count(),
            'students' => \App\Models\Enrollment::whereHas('course', fn($q) => $q->where('user_id', auth()->id()))->count(),
            'revenue'  => \App\Models\Transaction::whereHas('course', fn($q) => $q->where('user_id', auth()->id()))->where('status','paid')->sum('amount'),
        ];

        return view('instructor.dashboard', compact('courses','stats'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|max:255',
            'category_id'    => 'nullable|exists:categories,id',
            'description'    => 'required',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'level'          => 'required|in:beginner,intermediate,advanced',
            'language'       => 'required',
            'thumbnail'      => 'nullable|url',
            'trailer_url'    => 'nullable|url',
            'what_you_learn' => 'nullable|string',
            'requirements'   => 'nullable|string',
        ]);

        $data['user_id']        = auth()->id();
        $data['slug']           = Str::slug($data['title']) . '-' . Str::random(5);
        $data['type']           = $data['price'] == 0 ? 'free' : 'paid';
        $data['status']         = 'draft';
        $data['what_you_learn'] = $this->parseLines($data['what_you_learn'] ?? '');
        $data['requirements']   = $this->parseLines($data['requirements'] ?? '');

        Course::create($data);
        return redirect()->route('instructor.dashboard')->with('success', 'Course berhasil dibuat!');
    }

    public function edit(Course $course)
    {
        abort_if($course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $course->load('sections.lessons');
        $categories = Category::all();
        return view('instructor.courses.edit', compact('course','categories'));
    }

    public function update(Request $request, Course $course)
    {
        abort_if($course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);

        $data = $request->validate([
            'title'          => 'required|max:255',
            'category_id'    => 'nullable|exists:categories,id',
            'description'    => 'required',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'level'          => 'required|in:beginner,intermediate,advanced',
            'language'       => 'required',
            'thumbnail'      => 'nullable|url',
            'trailer_url'    => 'nullable|url',
            'what_you_learn' => 'nullable|string',
            'requirements'   => 'nullable|string',
        ]);

        $data['type']           = $data['price'] == 0 ? 'free' : 'paid';
        $data['what_you_learn'] = $this->parseLines($data['what_you_learn'] ?? '');
        $data['requirements']   = $this->parseLines($data['requirements'] ?? '');

        $course->update($data);
        return back()->with('success', 'Course berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        abort_if($course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $course->delete();
        return redirect()->route('instructor.dashboard')->with('success', 'Course dihapus.');
    }

    public function togglePublish(Course $course)
    {
        abort_if($course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $course->update(['status' => $course->status === 'published' ? 'draft' : 'published']);
        $label = $course->fresh()->status === 'published' ? 'dipublikasikan' : 'dijadikan draft';
        return back()->with('success', "Course berhasil {$label}.");
    }

    // ── Section ──────────────────────────────────────
    public function storeSection(Request $request, Course $course)
    {
        abort_if($course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $request->validate(['title' => 'required|max:255']);
        $course->sections()->create([
            'title' => $request->title,
            'order' => $course->sections()->max('order') + 1,
        ]);
        return back()->with('success', 'Section ditambahkan!');
    }

    public function destroySection(Course $course, Section $section)
    {
        abort_if($course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $section->delete();
        return back()->with('success', 'Section dihapus.');
    }

    // ── Lesson ───────────────────────────────────────
    public function storeLesson(Request $request, Section $section)
    {
        abort_if($section->course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $request->validate([
            'title'            => 'required|max:255',
            'video_url'        => 'nullable|url',
            'duration_seconds' => 'nullable|integer|min:0',
            'is_preview'       => 'nullable|boolean',
            'notes'            => 'nullable|string',
        ]);
        $section->lessons()->create([
            'title'            => $request->title,
            'video_url'        => $request->video_url,
            'duration_seconds' => $request->duration_seconds ?? 0,
            'is_preview'       => $request->boolean('is_preview'),
            'notes'            => $request->notes,
            'order'            => $section->lessons()->max('order') + 1,
        ]);
        return back()->with('success', 'Lesson ditambahkan!');
    }

    public function destroyLesson(Section $section, Lesson $lesson)
    {
        abort_if($section->course->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403);
        $lesson->delete();
        return back()->with('success', 'Lesson dihapus.');
    }

    private function parseLines(string $raw): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}
