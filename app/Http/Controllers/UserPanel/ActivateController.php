<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\InvestmentHistory;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Level;
use App\Models\User;
use App\Models\TransactionHistory;

class ActivateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_packages = Packages::get();
        // dd($all_packages);
        $user = User::where('id', auth()->id())->first();
        // dd($user);
        return view('Pages.activation.ActivateMyID', compact('all_packages', 'user'));
    }

    public function invest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = User::where('id', auth()->id())->first();

        // dd($user);

        try {
            $Packages_detals = Packages::where('id', $request->package_id)->first();

            if ($user->activation_balance < $Packages_detals->amount) {
                return redirect()->back()->with('error', 'Insufficient balance!');
            }

            $investmentHistory = InvestmentHistory::create([
                'user_id' => auth()->id(),
                'amount' => $Packages_detals->amount,
                'status' => 1,
                'type' => 1,
                'package_id' => $request->package_id,
            ]);
            // dd(auth()->id());

            $user->activation_balance -= $Packages_detals->amount;
            $user->save();
            return redirect()->back()->with('success', 'Package activated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction

            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    public function claimDaily()
    {
        $currentDate = Carbon::now();

        $users = User::whereHas('investmentHistory', function ($query) {
            $query->where('status', 2)
                ->where('type', 1); // Only include users with active investments
        })->get();

        foreach ($users as $user) {
            Log::info("Active user  {$user->id}");

            $lastClaim = TransactionHistory::where('user_id', $user->id)
                ->where('type', 4)
                ->latest()
                ->first();

            // Determine last claim date
            if ($lastClaim === null) {
                $lastClaimDate = $user->created_at; // Use the user's created date if no claims
            } else {
                $lastClaimDate = $lastClaim->created_at;
            }

            // Calculate the number of hours since the last claim
            $hoursSinceLastClaim = $lastClaimDate->diffInHours($currentDate);
            if ($hoursSinceLastClaim >= 24) {
                $user_investments = InvestmentHistory::with('package')
                    ->where('user_id', $user->id)
                    ->where('status', 2)
                    ->get();

                $totalBalance = 0;

                // Calculate total ROI for the number of days since the last claim
                foreach ($user_investments as $investment) {
                    $daily_roi = floatval($investment->package->daily_ear_per); // ROI percentage
                    $amount = floatval($investment->amount); // Investment amount

                    // Calculate daily ROI for the number of days since the last claim
                    $one_day_roi = $amount * $daily_roi / 100;
                    $totalBalance += $one_day_roi * ($hoursSinceLastClaim / 24);
                }

                if ($totalBalance > 0) {
                    // Create a transaction record for the user
                    TransactionHistory::create([
                        'user_id' => $user->id,
                        'amount' => $totalBalance,
                        'type' => "4",
                        'claimed_at' => $currentDate, // Capture the claim time
                    ]);

                    // Update the user's balance
                    $user->staking_balance += $totalBalance; // Directly add the total balance
                    $user->save();
                }
            } else {
                echo "user id " . $user->id . "already credited with today roi income";
            }
        }
        echo "successfull executed";
    }

    public function level_income()
    {
        // Get today's date to prevent double payouts
        $today = now()->format('Y-m-d');

        // Get all users and level stats from the database
        $allUsers = User::all();
        $levelStats = Level::all()->keyBy('level'); // Fetch level stats and key by level

        // Iterate over each user in the system
        foreach ($allUsers as $user) {
            Log::info("Processing User: {$user->id}");

            // Check if the user has a referrer
            $referrer = $user->referal_by;
            $currentLevel = 1; // Start from level 1

            // Loop through up to 20 levels to distribute income
            while ($currentLevel <= 20) {
                // If no referrer code is present, break out of the loop
                if (!$referrer) {
                    Log::info("No referrer found for User ID: {$user->id} at Level: {$currentLevel}. Ending distribution.");
                    break;
                }

                // Get the referrer user data
                $referrerUser = User::where('referal_code', $referrer)
                    ->where('status', 2)
                    ->first();

                // If referrer user does not exist or is inactive, log and move to the next level
                if (!$referrerUser) {
                    Log::info("Referrer User not found or inactive for referral code: {$referrer}. Skipping to next level.");
                    $currentLevel++;
                    $referrer = null; // Set referrer to null to exit in the next iteration
                    continue;
                }

                // Check the referrer's direct referral count
                $referrerUserCount = User::where('referal_by', $referrerUser->referal_code)
                    ->where('status', 2)
                    ->count();

                // Ensure that the current level exists in levelStats
                if (isset($levelStats[$currentLevel])) {
                    $levelStat = $levelStats[$currentLevel];
                    Log::info("Level {$currentLevel} Stats - Required Directs: {$levelStat->direct}");

                    // Check if the direct condition is fulfilled for the current level
                    if ($referrerUserCount >= $levelStat->direct) {
                        Log::info("Referrer User ID: {$referrerUser->id} meets direct condition.");

                        // If the referrer hasn't received income for this level and user today
                        if (!$this->hasReceivedIncome($referrerUser->id, $user->id, $currentLevel, $today)) {
                            // Calculate income based on the user's total investment and level percentage
                            $incomeAmount = ($user->total_investment * $levelStat->level_per) / 3000;
                            $referrerUser->level_balance += $incomeAmount;
                            $referrerUser->save();
                            $referrerUser->increment('level_balance', $incomeAmount); // Update referrer’s level balance

                            // Log the income distribution
                            $this->logIncome($referrerUser->id, $user->id, $incomeAmount, $currentLevel, $today);

                            Log::info("Distributed Income: {$incomeAmount} to Referrer User ID: {$referrerUser->id} at Level: {$currentLevel}");
                        } else {
                            Log::info("Income already distributed for Referrer User ID: {$referrerUser->id} at Level: {$currentLevel}.");
                        }
                    } else {
                        Log::info("Direct condition not met for Referrer User ID: {$referrerUser->id} at Level: {$currentLevel}. Moving to next level.");
                    }
                } else {
                    Log::info("Level stats not found for Level: {$currentLevel}. Ending distribution.");
                    break;
                }

                // Move to the next level and update referrer
                $referrer = $referrerUser->referal_by;
                $currentLevel++;
            }
        }
    }





    /**
     * Check if the user already received income from the given user at the given level today.
     */
    private function hasReceivedIncome($referrerId, $userId, $level, $date)
    {
        return TransactionHistory::where('to', $referrerId)
            ->where('by', $userId)
            ->where('level', $level)
            ->where('cred_date', $date)
            ->where('type', 2)
            ->exists();
    }

    /**
     * Log the income payment in the database to prevent multiple payouts.
     */
    private function logIncome($referrerId, $userId, $amount, $level, $date)
    {
        TransactionHistory::create([
            'to' => $referrerId,
            'by' => $userId,
            'amount' => $amount,
            'level' => $level,
            'cred_date' => $date,
            'type' => 2
        ]);
    }



















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
