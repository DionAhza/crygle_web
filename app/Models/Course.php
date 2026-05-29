<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'description',
        'what_you_learn', 'requirements', 'price', 'discount_price',
        'type', 'thumbnail', 'trailer_url', 'level', 'status', 'language',
    ];

    protected $casts = [
        'what_you_learn' => 'array',
        'requirements'   => 'array',
        'price'          => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    // ── Relationships ───────────────────────────────────
    public function instructor()  { return $this->belongsTo(User::class, 'user_id'); }
    public function category()    { return $this->belongsTo(Category::class); }
    public function sections()    { return $this->hasMany(Section::class)->orderBy('order'); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
    public function reviews()     { return $this->hasMany(Review::class); }
    public function transactions(){ return $this->hasMany(Transaction::class); }

    // ── Computed ───────────────────────────────────────
    public function isPublished(): bool { return $this->status === 'published'; }
    public function isFree(): bool      { return $this->type === 'free' || $this->price == 0; }

    public function effectivePrice(): float
    {
        if ($this->discount_price && $this->discount_price < $this->price) {
            return (float) $this->discount_price;
        }
        return (float) $this->price;
    }

    public function formattedPrice(): string
    {
        if ($this->isFree()) return 'Gratis';
        return 'Rp ' . number_format($this->effectivePrice(), 0, ',', '.');
    }

    public function originalPrice(): ?string
    {
        if ($this->discount_price && $this->discount_price < $this->price) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }
        return null;
    }

    public function discountPercent(): ?int
    {
        if ($this->discount_price && $this->discount_price < $this->price && $this->price > 0) {
            return (int) round((1 - $this->discount_price / $this->price) * 100);
        }
        return null;
    }

    public function totalLessons(): int
    {
        return $this->sections->sum(fn($s) => $s->lessons->count());
    }

    public function totalDurationSeconds(): int
    {
        return $this->sections->sum(fn($s) => $s->lessons->sum('duration_seconds'));
    }

    public function totalDurationFormatted(): string
    {
        $total = $this->totalDurationSeconds();
        $h = intdiv($total, 3600);
        $m = intdiv($total % 3600, 60);
        if ($h > 0) return "{$h} jam {$m} menit";
        return "{$m} menit";
    }

    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function totalStudents(): int
    {
        return $this->enrollments()->count();
    }

    public function levelLabel(): string
    {
        return match($this->level) {
            'beginner'     => 'Pemula',
            'intermediate' => 'Menengah',
            'advanced'     => 'Mahir',
            default        => ucfirst($this->level),
        };
    }

    public function thumbnailUrl(): string
    {
        if (!$this->thumbnail) {
            return 'https://placehold.co/800x450/1B6EF3/ffffff?text=' . urlencode($this->title);
        }
        if (str_starts_with($this->thumbnail, 'http')) return $this->thumbnail;
        return asset('storage/' . $this->thumbnail);
    }

    public function statusBadge(): array
    {
        return match($this->status) {
            'published' => ['label' => 'Published', 'class' => 'bg-emerald-100 text-emerald-700'],
            default     => ['label' => 'Draft',     'class' => 'bg-amber-100 text-amber-700'],
        };
    }
}
