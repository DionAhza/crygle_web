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
            return back()->with('info', 'Kamu sudah terdaftar di kelas ini.');

        // Free course → langsung enroll
        if ($course->isFree()) {
            $enrollment = Enrollment::create([
                'user_id'     => $user->id,
                'course_id'   => $course->id,
                'status'      => 'active',
                'amount_paid' => 0,
                'enrolled_at' => now(),
            ]);
            return redirect()->route('payment.success.page', $enrollment)
                             ->with('success', "Berhasil mendaftar ke \"{$course->title}\"! 🎉");
        }

        // Cek pending transaction
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
        return view('payment.checkout', compact('transaction'));
    }

    public function confirm(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $request->validate(['payment_method' => 'required|string']);

        // Update transaksi
        $transaction->update([
            'status'         => 'paid',
            'payment_method' => $request->payment_method,
            'gateway_ref'    => 'CRY-' . strtoupper(substr(md5(uniqid()), 0, 8)),
        ]);

        // Buat enrollment
        $enrollment = Enrollment::firstOrCreate(
            ['user_id' => $transaction->user_id, 'course_id' => $transaction->course_id],
            ['status' => 'active', 'amount_paid' => $transaction->amount, 'enrolled_at' => now()]
        );

        // Redirect ke halaman sukses
        return redirect()->route('payment.success.page', $enrollment)
                         ->with('success', 'Pembayaran berhasil! Selamat belajar! 🎉');
    }

    // Halaman processing (tampilkan animasi singkat lalu auto-submit)
    public function processing(Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);
        $transaction->load('course');
        return view('payment.processing', compact('transaction'));
    }

    // Halaman sukses setelah enroll
    public function success(Enrollment $enrollment)
    {
        abort_if($enrollment->user_id !== auth()->id(), 403);
        $enrollment->load('course.sections.lessons','course.category');
        return view('payment.success', compact('enrollment'));
    }
}
