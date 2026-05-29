<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'avatar', 'bio', 'headline'];
    protected $hidden   = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Roles ──────────────────────────────────────────
    public function isAdmin(): bool      { return $this->role === 'admin'; }
    public function isInstructor(): bool { return in_array($this->role, ['instructor', 'admin']); }
    public function isUser(): bool       { return $this->role === 'user'; }

    // ── Relationships ───────────────────────────────────
    public function courses()       { return $this->hasMany(Course::class); } // as instructor
    public function enrollments()   { return $this->hasMany(Enrollment::class); }
    public function reviews()       { return $this->hasMany(Review::class); }
    public function transactions()  { return $this->hasMany(Transaction::class); }
    public function lessonProgress(){ return $this->hasMany(LessonProgress::class); }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('status', 'amount_paid', 'enrolled_at', 'completed_at')
                    ->withTimestamps();
    }

    // ── Helpers ────────────────────────────────────────
    public function isEnrolled(Course $course): bool
    {
        return $this->enrollments()->where('course_id', $course->id)->exists();
    }

    public function getEnrollment(Course $course): ?Enrollment
    {
        return $this->enrollments()->where('course_id', $course->id)->first();
    }

    public function hasPendingTransaction(Course $course): bool
    {
        return $this->transactions()
                    ->where('course_id', $course->id)
                    ->where('status', 'pending')
                    ->exists();
    }

    public function avatarUrl(): string
    {
        if ($this->avatar && str_starts_with($this->avatar, 'http')) return $this->avatar;
        if ($this->avatar) return asset('storage/' . $this->avatar);
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name)
             . '&background=1B6EF3&color=fff&size=128&bold=true';
    }

    public function roleLabel(): string
    {
        return match($this->role) {
            'admin'      => 'Admin',
            'instructor' => 'Instructor',
            default      => 'Student',
        };
    }
}
