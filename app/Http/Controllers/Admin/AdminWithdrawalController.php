<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    /**
     * Display all withdrawal requests with tab filter (pending, approved, rejected, all).
     */
    public function index(Request $request)
    {
        $statusFilter = $request->query('status', 'pending');

        $query = Withdrawal::with('user')->latest();

        if (in_array($statusFilter, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $statusFilter);
        }

        $withdrawals = $query->paginate(20);

        // Stats summary
        $pendingCount = Withdrawal::where('status', 'pending')->count();
        $pendingBdt = Withdrawal::where('status', 'pending')->sum('amount_bdt');
        $approvedCount = Withdrawal::where('status', 'approved')->count();
        $approvedBdt = Withdrawal::where('status', 'approved')->sum('amount_bdt');
        $rejectedCount = Withdrawal::where('status', 'rejected')->count();

        return view('admin.withdrawals.index', compact(
            'withdrawals',
            'statusFilter',
            'pendingCount',
            'pendingBdt',
            'approvedCount',
            'approvedBdt',
            'rejectedCount'
        ));
    }

    /**
     * Approve a pending withdrawal request.
     */
    public function approve(Request $request, $id)
    {
        $withdrawal = Withdrawal::with('user')->findOrFail($id);

        if ($withdrawal->status === 'approved') {
            return redirect()->back()->with('error', 'এই রিকোয়েস্টটি ইতিমধ্যে অ্যাপ্রুভ করা হয়েছে।');
        }

        $adminNote = $request->input('admin_note', 'Payment completed by admin');

        $withdrawal->update([
            'status' => 'approved',
            'admin_note' => $adminNote,
        ]);

        return redirect()->back()->with('success', "🎉 #{$withdrawal->id} উইথড্রল রিকোয়েস্টটি সফলভাবে অ্যাপ্রুভ করা হয়েছে! ৳{$withdrawal->amount_bdt} ইউজারকে প্রদান করা হয়েছে।");
    }

    /**
     * Reject a pending withdrawal request and refund coins to user.
     */
    public function reject(Request $request, $id)
    {
        $withdrawal = Withdrawal::with('user')->findOrFail($id);

        if ($withdrawal->status === 'rejected') {
            return redirect()->back()->with('error', 'এই রিকোয়েস্টটি ইতিমধ্যে বাতিল করা হয়েছে।');
        }

        $reason = $request->input('rejection_reason', 'Withdrawal request rejected by admin');

        // If it was pending, refund the deducted coins to user
        if ($withdrawal->status === 'pending' && $withdrawal->user) {
            $withdrawal->user->increment('points', $withdrawal->coins);
        }

        $withdrawal->update([
            'status' => 'rejected',
            'admin_note' => $reason,
        ]);

        return redirect()->back()->with('success', "❌ #{$withdrawal->id} উইথড্রল রিকোয়েস্টটি বাতিল করা হয়েছে এবং ইউজারকে {$withdrawal->coins} কয়েন রিফান্ড করা হয়েছে।");
    }
}
