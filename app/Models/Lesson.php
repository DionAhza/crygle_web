<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'video_url',
        'notes',
        'duration_seconds',
        'is_preview',
        'order'
    ];

    protected $casts = [
        'is_preview' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isCompletedBy(int $userId): bool
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->exists();
    }

    public function durationFormatted(): string
    {
        $seconds = $this->duration_seconds;

        if ($seconds <= 0) {
            return '—';
        }

        $minutes = intdiv($seconds, 60);
        $secs = $seconds % 60;

        return sprintf('%d:%02d', $minutes, $secs);
    }

    public function embedUrl(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        // YouTube URL parser
        if (preg_match(
            '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([a-zA-Z0-9_-]{11})/',
            $this->video_url,
            $matches
        )) {
            return "https://www.youtube.com/embed/{$matches[1]}?rel=0&modestbranding=1";
        }

        return $this->video_url;
    }
}