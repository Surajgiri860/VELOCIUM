<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\Config;
use App\Models\Level;
use App\Models\Packages;


class InvestmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Invest_req = InvestmentHistory::with('user')->where('status', 1)->get();
        // dd($Invest_req);

        return view('Admin.investment.index', compact('Invest_req'));
    }

    public function active()
    {
        $Invest_req = InvestmentHistory::with('user')->where('status', 2)->get();
        // dd($Invest_req);

        return view('Admin.investment.active', compact('Invest_req'));
    }
    public function reject()
    {
        $Invest_req = InvestmentHistory::with('user')->where('status', 3)->get();
        // dd($Invest_req);

        return view('Admin.investment.reject', compact('Invest_req'));
    }

    public function reject_request($id, Request $request)
    {
        // Find the investment by ID
        $investment = InvestmentHistory::findOrFail($id);
        $user = User::where('id', $investment->user_id)->first();
        dd($investment);
        // Update the investment status to 'rejected'
        $user->activation_balance += $investment->amount;
        $investment->status = 3; // Adjust based on your status field
        $investment->save();
        $user->save();

        return redirect()->route('invest_req.index')->with('success', 'Investment rejected successfully.');
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


    // Active user packege
    public function update(Request $request, string $id)
    {

        try {
            DB::beginTransaction();  // Start transaction
            // Fetch the investment history
            $user_invest = InvestmentHistory::with('package')->where('id', $id)
                ->first();

            // Get the current user making the investment
            $currentUser = User::where('id', $user_invest->user_id)->first();

            $currentUser->total_investment += $user_invest->package->amount;
            $currentUser->team_business += $user_invest->amount;
            $currentUser->status = 2;
            $user_invest->status = 2;
            $user_invest->save();
            $currentUser->save();
            // Record the investment in the InvestmentHistory table

            $config = Config::first();

            for ($i = 0; $i < 20; $i++) {
                $sponsor  = $currentUser->referal_by;

                $sponsorUser = User::where('referal_code', $sponsor)->first();

                if ($sponsorUser) {
                    Log::info("No sponsor found for User ID {$currentUser->id}. Stopping the loop.");
                    break; // Exit the loop if no sponsor is found
                }
                $sponsorUser->team_business += $user_invest->amount;

                if ($i == 0) {
                    $direct_bonus = $user_invest->amount * $config->direct_sponser / 100;
                    $sponsorUser->direct_balance += $direct_bonus;

                    // Create transaction history for the direct sponsor bonus
                    TransactionHistory::create([
                        'to' => $sponsorUser->id,
                        'by' => $currentUser->id,
                        'amount' => $direct_bonus,
                        'type' => "5",
                    ]);
                }


                $sponsorUser->save();
                // change the stat
                $currentUser = $sponsorUser;
            }



            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->back()->with('success', 'Investment request accepted successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollback();
            Log::error('Transaction failed: ', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
