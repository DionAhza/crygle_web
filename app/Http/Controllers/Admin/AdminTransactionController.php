<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Enrollment, Transaction};
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user','course')
            ->latest()->paginate(20);
        $summary = [
            'total'   => Transaction::sum('amount'),
            'paid'    => Transaction::where('status','paid')->sum('amount'),
            'pending' => Transaction::where('status','pending')->count(),
        ];
        return view('admin.transactions.index', compact('transactions','summary'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate(['status' => 'required|in:pending,paid,failed,refunded']);

        $oldStatus = $transaction->status;
        $transaction->update(['status' => $request->status]);

        // Jika dipaid manual, buat enrollment
        if ($request->status === 'paid' && $oldStatus !== 'paid') {
            Enrollment::firstOrCreate(
                ['user_id' => $transaction->user_id, 'course_id' => $transaction->course_id],
                ['status' => 'active', 'amount_paid' => $transaction->amount, 'enrolled_at' => now()]
            );
        }

        return back()->with('success', 'Status transaksi diperbarui.');
    }
}
