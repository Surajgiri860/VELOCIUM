<?php

namespace App\Http\Controllers\UserPanel;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Packages;
use App\Models\Reward;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_data = User::where('id', auth()->id())->first();
        // dd($user_data);
        $InvestmentHistoryCount = InvestmentHistory::where('user_id', auth()->id())
            ->where('status', 2)
            ->count();

        // dd($total_investment);

        $Active_Directs = User::where('referal_by', $user_data->referal_code)->where('status', 2)
            ->count();


        $pending_reward = TransactionHistory::where('user_id', auth()->id())->where('type', 3)
            ->where('status', 0)
            ->sum('amount');

        $power_leg_business = User::where('referal_by', $user_data->referal_code)
            ->where('status', 2)
            ->pluck('team_business')
            ->max();

        $user_reward = TransactionHistory::where('user_id', auth()->id())
            ->where('status', 0)
            ->where('type', 3)
            ->get();
        $total_leg_business = User::where('referal_by', $user_data->referal_code)
            ->where('status', 2)
            ->pluck('team_business')
            ->sum();
        // dd($power_leg_business);
        $total_business = $total_leg_business;

        $other_team_business = $total_leg_business - $power_leg_business;
        $rewards = Reward::get();
        foreach ($rewards as $reward) {
            if ((int) $power_leg_business >= (int) $reward->team_business && (int) $other_team_business >= (int) $reward->team_business) {
                // Check if the referrer has already received the reward
                $reward_already_received = TransactionHistory::where('user_id', auth()->id())
                    ->where('reward_id', $reward->id)
                    ->exists();

                if (!$reward_already_received) {
                    // Add the reward to the referrer's royalty balance


                    // Record the reward in the transaction history
                    TransactionHistory::create([
                        'user_id' => auth()->id(),
                        'amount' => $reward->reward,
                        'reward_id' => $reward->id,
                        'type' => "3",
                    ]);
                }
            }
        }

        $user_investments = InvestmentHistory::with('package')
            ->where('user_id', auth()->id())
            ->where('status', 2)
            ->get();
        $witdrowal = TransactionHistory::where('user_id', auth()->id())->where('type', 1)
            ->where('status', 2)
            ->sum('amount');

        $total_daily_roi = 0;
        $Balance_Earning = 0 - $witdrowal;
        foreach ($user_investments as $investment) {
            // Ensure amount and daily_ear_per are numeric
            $daily_roi = floatval($investment->package->daily_ear_per); // Force to float
            $amount = floatval($investment->amount); // Force to float


            $one_day_roi = $amount * $daily_roi / 100;
            $amount_3x_earning = $amount * 3;
            $Balance_Earning += $amount_3x_earning;
            // Add the daily ROI of this investment to the total
            $total_daily_roi += $one_day_roi;
        }

        $daily_max_limit = Packages::get(); // Get all packages

        $max_amt = 0;
        $max_ear_per = 0;
        foreach ($daily_max_limit as $package) {
            $max_amt += $package->amount; // Sum the package amounts
            $max_ear_per += $package->daily_ear_per; // Sum the daily earnings percentages
        }
        $max_day_roi = $max_amt * $max_ear_per / 100;
        // dd($total_daily_roi);
        $indirectUsers = $this->getAllIndirectUsers($user_data);  // Use $this here
        $indirectUsersCount = count($indirectUsers);
        // dd($indirectUsersCount);

        $referralLink = url('/register?referral=' . $user_data->referal_code);
        // dd($referralLink);
        return view('Pages.Dashboard', compact(
            'user_data',
            'Balance_Earning',
            'witdrowal',
            'max_day_roi',
            'total_daily_roi',
            'pending_reward',
            'power_leg_business',
            'total_business',
            'other_team_business',
            'indirectUsersCount',
            'user_investments',
            'user_reward',
            'InvestmentHistoryCount',
            'Active_Directs',
            'referralLink'
        ));
    }
    function getAllIndirectUsers($user_data, &$indirectUsers = [])
    {
        // Get all direct users referred by this user's referral code
        $directUsers = User::where('referal_by', $user_data->referal_code)->get(); // Fetch user models instead of just IDs

        // Add direct users to the list of indirect users
        foreach ($directUsers as $directUser) {
            $indirectUsers[] = $directUser->id;
            // Recursive call for each direct user to get their referrals
            $this->getAllIndirectUsers($directUser, $indirectUsers); // Pass the user model, not the ID
        }

        return $indirectUsers;
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
