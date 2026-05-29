<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model {
    protected $fillable = ['user_id','course_id','status','amount_paid','enrolled_at','completed_at'];
    protected $casts    = ['enrolled_at' => 'datetime', 'completed_at' => 'datetime'];

    public function user()   { return $this->belongsTo(User::class); }
    public function course() { return $this->belongsTo(Course::class)->with('sections.lessons'); }

    public function progressPercent(): int
    {
        $course = $this->course;
        $total  = $course->sections->sum(fn($s) => $s->lessons->count());
        if ($total === 0) return 0;
        $done = LessonProgress::where('user_id', $this->user_id)
                               ->whereIn('lesson_id', $course->sections->flatMap->lessons->pluck('id'))
                               ->where('is_completed', true)
                               ->count();
        return (int) round(($done / $total) * 100);
    }

    public function completedLessonIds(): array
    {
        $lessonIds = $this->course->sections->flatMap->lessons->pluck('id');
        return LessonProgress::where('user_id', $this->user_id)
                              ->whereIn('lesson_id', $lessonIds)
                              ->where('is_completed', true)
                              ->pluck('lesson_id')
                              ->toArray();
    }

    public function nextLesson(): ?Lesson
    {
        $done    = $this->completedLessonIds();
        $lessons = $this->course->sections->flatMap->lessons;
        return $lessons->first(fn($l) => !in_array($l->id, $done));
    }
}
