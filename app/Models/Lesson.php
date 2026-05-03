<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'video_url',
        'order',
    ];

    /**
     * Lesson milik satu Section
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
