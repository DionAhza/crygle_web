<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model {
    protected $fillable = ['user_id','course_id','invoice_number','amount','status','payment_method','gateway_ref','notes'];

    public function user()   { return $this->belongsTo(User::class); }
    public function course() { return $this->belongsTo(Course::class); }

    public static function generateInvoice(): string
    {
        return 'CRY-' . strtoupper(Str::random(4)) . '-' . now()->format('ymd');
    }

    public function statusBadge(): array
    {
        return match($this->status) {
            'paid'     => ['label' => 'Lunas',    'class' => 'bg-emerald-100 text-emerald-700'],
            'pending'  => ['label' => 'Menunggu', 'class' => 'bg-amber-100 text-amber-700'],
            'failed'   => ['label' => 'Gagal',    'class' => 'bg-red-100 text-red-700'],
            'refunded' => ['label' => 'Refund',   'class' => 'bg-gray-100 text-gray-600'],
            default    => ['label' => ucfirst($this->status), 'class' => 'bg-gray-100 text-gray-600'],
        };
    }

    public function formattedAmount(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}
