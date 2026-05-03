<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'thumbnail',
    ];

    /**
     * Satu Course punya banyak Section
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }

    /**
     * Format harga ke Rupiah
     */
    public function formattedPrice(): string
    {
        if ($this->price == 0) {
            return 'Gratis';
        }
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
