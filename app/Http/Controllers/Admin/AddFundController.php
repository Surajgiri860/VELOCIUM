<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddFund;
use App\Models\User;

class AddFundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $add_fund_req = AddFund::with('user')->where('status', 1)->get();
        // dd($Invest_req);

        return view('Admin.add_fund.index', compact('add_fund_req'));
    }

    public function accept_request(Request $request, string $id)
    {
        try {
            $user_invest = AddFund::findOrFail($id);
            $currentUser = User::findOrFail($user_invest->user_id);

            $currentUser->activation_balance += $user_invest->amount;
            $user_invest->status = 2;
            $user_invest->save();
            $currentUser->save();
            return redirect()->back()->with('success', 'Investment request accepted successfully!');
        } catch (\Exception $e) {


            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
