<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function checkout(Course $course)
    {
        $user = auth()->user();
        abort_if(!$course->isPublished(), 404);

        if ($user->isEnrolled($course))
            return back()->with('info', 'Kamu sudah terdaftar di course ini.');

        // Free course — langsung enroll
        if ($course->isFree()) {
            Enrollment::create([
                'user_id'     => $user->id,
                'course_id'   => $course->id,
                'status'      => 'active',
                'amount_paid' => 0,
                'enrolled_at' => now(),
            ]);
            return redirect()->route('dashboard')->with('success', "Berhasil mendaftar ke \"{$course->title}\"! 🎉");
        }

        // Cek apakah ada transaksi pending
        $existing = Transaction::where('user_id', $user->id)
                                ->where('course_id', $course->id)
                                ->where('status','pending')->first();
        if ($existing) return redirect()->route('payment', $existing);

        $transaction = Transaction::create([
            'user_id'        => $user->id,
            'course_id'      => $course->id,
            'invoice_number' => Transaction::generateInvoice(),
            'amount'         => $course->effectivePrice(),
            'status'         => 'pending',
        ]);

        return redirect()->route('payment', $transaction);
    }

    public function payment(Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);
        $transaction->load('course','user');
        return view('payment', compact('transaction'));
    }

    public function confirm(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Simulasi konfirmasi — di produksi ini terhubung ke payment gateway
        $transaction->update([
            'status'         => 'paid',
            'payment_method' => $request->payment_method,
            'gateway_ref'    => 'SIM-' . strtoupper(substr(md5(uniqid()), 0, 8)),
        ]);

        // Buat enrollment
        Enrollment::firstOrCreate(
            ['user_id' => $transaction->user_id, 'course_id' => $transaction->course_id],
            ['status' => 'active', 'amount_paid' => $transaction->amount, 'enrolled_at' => now()]
        );

        return redirect()->route('dashboard')->with('success', "Pembayaran berhasil! Kamu sudah bisa mulai belajar. 🎉");
    }
}
