<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    protected $fillable = ['user_id','course_id','rating','comment'];
    public function user()   { return $this->belongsTo(User::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function stars(): string { return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating); }
}
