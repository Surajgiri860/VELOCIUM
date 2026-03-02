<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddFund;
use App\Models\User;

class AddFundController extends Controller
{
    /**
     * Display pending fund requests
     */
    public function index()
    {
        $add_fund_requests = AddFund::with('user')
                              ->where('status', AddFund::STATUS_PENDING)
                              ->get();

        return view('Admin.add_fund.index', compact('add_fund_requests'));
    }

    /**
     * Display approved fund requests
     */
    public function approved()
    {
        $add_fund_requests = AddFund::with('user')
                              ->where('status', AddFund::STATUS_APPROVED)
                              ->get();

        return view('Admin.add_fund.approved', compact('add_fund_requests'));
    }

    /**
     * Display rejected fund requests
     */
    public function rejected()
    {
        $add_fund_requests = AddFund::with('user')
                              ->where('status', AddFund::STATUS_REJECTED)
                              ->get();

        return view('Admin.add_fund.rejected', compact('add_fund_requests'));
    }

    /**
     * Accept fund request
     */
    public function accept_request(Request $request, string $id)
    {
        try {
            $fundRequest = AddFund::findOrFail($id);
            $user = User::findOrFail($fundRequest->user_id);

            $user->activation_balance += $fundRequest->amount;
            $fundRequest->status = AddFund::STATUS_APPROVED;
            
            $fundRequest->save();
            $user->save();
            
            return redirect()->back()->with('success', 'Fund request accepted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }

    /**
     * Reject fund request
     */
    public function reject_request(Request $request, string $id)
    {
        try {
            $fundRequest = AddFund::findOrFail($id);
            $fundRequest->status = AddFund::STATUS_REJECTED;
            $fundRequest->save();
            
            return redirect()->back()->with('success', 'Fund request rejected successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }
}