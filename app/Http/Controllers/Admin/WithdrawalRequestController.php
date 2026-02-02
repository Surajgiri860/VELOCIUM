<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;
use App\Models\User;

class WithdrawalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdral_req = TransactionHistory::with('user_req')->where('type', 1)->where('status', 0)->paginate(10); // 10 items per page
        return view('Admin.withdraw.index', compact('withdral_req'));
    }

    public function acceptWithdrawRequest($id)
    {
        // Find the withdrawal request by ID
        $withdrawRequest = TransactionHistory::find($id);
        // dd($withdrawRequest);
        if ($withdrawRequest && $withdrawRequest->status == 0) {
            // Update the status to "accepted" (assuming 1 means accepted)
            $withdrawRequest->status = 2;
            $withdrawRequest->save();

            // Return a success message
            return redirect()->back()->with('success', 'Withdrawal request accepted successfully.');
        }

        // Return an error message if the request doesn't exist or is already accepted
        return redirect()->back()->with('error', 'Invalid request or it has already been processed.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $withdrawRequest = TransactionHistory::find($id);
        $user = User::find($withdrawRequest->user_id);

        if ($withdrawRequest && $withdrawRequest->status == 0) {
            // Update the status to "accepted" (assuming 1 means accepted)
            $withdrawRequest->status = 3;
            $user->withdrawable += $withdrawRequest->amount;
            $withdrawRequest->save();
            $user->save();

            // Return a success message
            return redirect()->back()->with('success', 'Withdrawal request Rejected successfully.');
        }

        // Return an error message if the request doesn't exist or is already accepted
        return redirect()->back()->with('error', 'Invalid request or it has already been processed.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
