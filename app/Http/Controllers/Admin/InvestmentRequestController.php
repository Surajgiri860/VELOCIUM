<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\RankReward;
use App\Models\RankRewardHistory;
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
            // $currentUser->team_business += $user_invest->amount;
            $currentUser->status = 2;
            $user_invest->status = 2;
            $user_invest->save();
            $currentUser->save();
            // Record the investment in the InvestmentHistory table

            $config = Config::first();
            
            $this->checkRankReward($currentUser);

           for ($i = 0; $i < 20; $i++) {

                $sponsor  = $currentUser->referal_by;
                $sponsorUser = User::where('referal_code', $sponsor)->first();

                if (!$sponsorUser) {
                    break;
                }

                // ✅ 20 level business (already existing)
                $sponsorUser->team_business += $user_invest->amount;

                // ✅ Level 1 = Direct Business
                if ($i == 0) {
                    $sponsorUser->total_direct_business += $user_invest->amount;
                }

                // ✅ Level 1 to 4 = Business Volume
                if ($i < 4) {
                    $sponsorUser->total_business_volume += $user_invest->amount;
                }

                // ✅ Direct bonus (same as before)
                if ($i == 0) {
                    $direct_bonus = $user_invest->amount * $config->direct_sponser / 100;
                    $sponsorUser->direct_balance += $direct_bonus;

                    TransactionHistory::create([
                        'to' => $sponsorUser->id,
                        'by' => $currentUser->id,
                        'amount' => $direct_bonus,
                        'type' => "5",
                    ]);
                }

                $sponsorUser->save();

                  $this->checkRankReward($sponsorUser);
                  $this->updateAllUsersRankFromHistory();

                // Next upline
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

   

public function checkRankReward($user)
{
    $rewards = DB::table('rank_rewards')
        ->orderBy('direct_required', 'asc')
        ->get();

    $highestRank = null;
    $highestValue = 0;

    foreach ($rewards as $reward) {

        if (
            $user->total_direct_business >= $reward->direct_required &&
            $user->total_business_volume >= $reward->team_required
        ) {

            // Track highest rank
            if ($reward->direct_required > $highestValue) {
                $highestValue = $reward->direct_required;
                $highestRank = $reward->rank_name;
            }

            $exists = DB::table('rank_reward_histories')
                ->where('user_id', $user->id)
                ->where('reward_id', $reward->id)
                ->exists();

            if (!$exists) {
                DB::table('rank_reward_histories')->insert([
                    'user_id' => $user->id,
                    'reward_id' => $reward->id,
                    'rank_name' => $reward->rank_name,
                    'reward_name' => $reward->reward_name,
                    'amount' => $reward->reward_amount,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // ✅ FINAL: set only highest rank
    // if ($highestRank) {
    //     $user->current_rank = $highestRank;
    //     $user->save();
    // }
}

public function updateAllUsersRankFromHistory()
{
    // Sab users ke unique IDs le lo history se
    $userIds = DB::table('rank_reward_histories')
        ->select('user_id')
        ->distinct()
        ->pluck('user_id');

    foreach ($userIds as $userId) {

        // Highest rank find karo
        $highest = DB::table('rank_reward_histories')
            ->where('rank_reward_histories.user_id', $userId)
            ->join('rank_rewards', 'rank_reward_histories.reward_id', '=', 'rank_rewards.id')
            ->orderBy('rank_rewards.direct_required', 'desc') // highest first
            ->select('rank_reward_histories.rank_name')
            ->first();

        if ($highest) {
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'current_rank' => $highest->rank_name
                ]);
        }
    }

    return true;
}
}
