<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\Config;
use App\Models\Level;
use App\Models\Reward;

class ActiveUserIdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $all_packages = Packages::get();
        // dd($all_packages);
        // $user = User::where('id', auth()->id())->first();
        // dd($all_packages);
        return view('Admin.admin_active_id.index', compact('all_packages'));
    }


    public function activation_user(Request $request)
    {


        try {
            DB::beginTransaction();
            // Fetch the investment history
            $user_invest = Packages::where('id', $request->package_id)->first();
            // Get the current user making the investment
            $currentUser = User::where('referal_code', $request->user_id)->first();
            $currentUser->total_investment += $user_invest->amount;
            $currentUser->team_business += $user_invest->amount;
            $currentUser->status = 2;
            $currentUser->save();
            // Record the investment in the InvestmentHistory table
            InvestmentHistory::create([
                'user_id' => $currentUser->id,
                'amount' => $user_invest->amount,
                'status' => 2,
                'type' => 1,
                'package_id' => $request->package_id,
            ]);
            $config = Config::first();

            for ($i = 0; $i < 20; $i++) {
                $sponsor  = $currentUser->referal_by;

                $sponsorUser = User::where('referal_code', $sponsor)->first();

                if ($sponsorUser->referal_code == 'VEL0008') {
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dummy_id(Request $request)
    {
        return view('Admin.admin_active_id.dummy_id');
    }
    public function active_dummy_id(Request $request)
    {
        try {
            // Check if the package exists
            $user_invest = Packages::where('id', $request->package_id)->first();
            if (!$user_invest) {
                return redirect()->back()->with('error', 'Invalid package selected.');
            }

            // Check if the user exists
            $currentUser = User::where('referal_code', $request->user_id)->first();
            if (!$currentUser) {
                return redirect()->back()->with('error', 'User with the provided referral code not found.');
            }

            $currentUser->status = 2;
            $currentUser->total_investment = $user_invest->amount;
            $currentUser->team_business += $user_invest->amount;
            $currentUser->type = 2;
            $currentUser->save();

            // Proceed with creating the InvestmentHistory
            InvestmentHistory::create([
                'user_id' => $currentUser->id,
                'amount' => $user_invest->amount,
                'status' => 2,
                'type' => 2,
                'package_id' => $request->package_id,
            ]);


            return redirect()->back()->with('success', 'Dummy User Id Activate successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Transaction failed: ', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }
}
