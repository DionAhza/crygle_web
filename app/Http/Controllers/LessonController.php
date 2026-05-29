<?php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;

class LessonController extends Controller
{
    public function show(Enrollment $enrollment, Lesson $lesson)
    {
        abort_if($enrollment->user_id !== auth()->id(), 403);
        $course  = $enrollment->course;
        abort_if($lesson->section->course_id !== $course->id, 404);

        $allLessons = $course->sections->flatMap->lessons;
        $idx        = $allLessons->search(fn($l) => $l->id === $lesson->id);
        $prevLesson = $idx > 0 ? $allLessons->get($idx - 1) : null;
        $nextLesson = $allLessons->get($idx + 1);

        $completedIds = $enrollment->completedLessonIds();
        $progress     = $enrollment->progressPercent();

        return view('learn.lesson', compact(
            'enrollment','course','lesson','allLessons',
            'prevLesson','nextLesson','completedIds','progress'
        ));
    }

    public function complete(Enrollment $enrollment, Lesson $lesson)
    {
        abort_if($enrollment->user_id !== auth()->id(), 403);

        LessonProgress::updateOrCreate(
            ['user_id' => auth()->id(), 'lesson_id' => $lesson->id],
            ['is_completed' => true]
        );

        // Tandai course selesai jika semua lesson done
        $course  = $enrollment->course;
        $total   = $course->sections->sum(fn($s) => $s->lessons->count());
        $done    = $enrollment->completedLessonIds();
        if ($total > 0 && count($done) >= $total && !$enrollment->completed_at) {
            $enrollment->update(['completed_at' => now()]);
        }

        return back()->with('success', 'Lesson selesai! ✅');
    }
}
