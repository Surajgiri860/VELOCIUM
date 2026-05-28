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
use Illuminate\Support\Facades\DB;  

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
              ->where('type', 1);
    })->get();

    foreach ($users as $user) {
        try {
            Log::info("Processing ROI for user: {$user->id}");

            $lastClaim = TransactionHistory::where('user_id', $user->id)
                ->where('type', 4)
                ->latest()
                ->first();

            // ✅ FIX 1: Last claim date determine karo
            if ($lastClaim === null) {
                // Pehli baar claim — user ki investment start date se calculate karo
                // ya safe option: sirf 1 din ka ROI do
                $lastClaimDate = $currentDate->copy()->subDays(1);
            } else {
                $lastClaimDate = $lastClaim->created_at;
            }

            $hoursSinceLastClaim = $lastClaimDate->diffInHours($currentDate);

            // 24 ghante pura hua ya nahi
            if ($hoursSinceLastClaim < 24) {
                Log::info("User {$user->id} already credited today. Hours since last: {$hoursSinceLastClaim}");
                continue;
            }

            // ✅ FIX 2: Cap days — max 7 din tak hi allow karo (cron miss ho toh bhi safe)
            $daysToCredit = min(floor($hoursSinceLastClaim / 24), 7);

            // ✅ FIX 3: Investments fetch karo with null-safe package check
            $user_investments = InvestmentHistory::with('package')
                ->where('user_id', $user->id)
                ->where('status', 2)
                ->get();

            $totalBalance = 0;

            foreach ($user_investments as $investment) {
                // ✅ FIX 4: Package null check
                if (!$investment->package) {
                    Log::warning("User {$user->id}, Investment {$investment->id} has no package. Skipping.");
                    continue;
                }

                $daily_roi = floatval($investment->package->daily_ear_per);
                $amount    = floatval($investment->amount);

                // Investment ke active hone ke baad ka actual time calculate karo
                $investmentStart = Carbon::parse($investment->created_at);
                $effectiveStart  = $investmentStart->greaterThan($lastClaimDate)
                    ? $investmentStart
                    : $lastClaimDate;

                $effectiveDays = min(
                    floor($effectiveStart->diffInHours($currentDate) / 24),
                    $daysToCredit
                );

                if ($effectiveDays <= 0) continue;

                $one_day_roi   = $amount * $daily_roi / 100;
                $totalBalance += $one_day_roi * $effectiveDays;

                Log::info("User {$user->id} | Investment {$investment->id} | Days: {$effectiveDays} | ROI: {$one_day_roi} | Total so far: {$totalBalance}");
            }

            if ($totalBalance <= 0) {
                Log::info("User {$user->id} — totalBalance is 0, skipping transaction.");
                continue;
            }

            // ✅ FIX 5: DB Transaction — atomic operation
            DB::transaction(function () use ($user, $totalBalance, $currentDate) {
                TransactionHistory::create([
                    'user_id'    => $user->id,
                    'amount'     => $totalBalance,
                    'type'       => 4,
                    'claimed_at' => $currentDate,
                ]);

                // increment() se race condition avoid hogi
                User::where('id', $user->id)->increment('staking_balance', $totalBalance);
            });

            Log::info("User {$user->id} credited ₹{$totalBalance} successfully.");

        } catch (\Exception $e) {
            // ✅ FIX 6: Ek user fail ho toh baaki process hote rahe
            Log::error("ROI failed for user {$user->id}: " . $e->getMessage());
            continue;
        }
    }

    Log::info("claimDaily completed at {$currentDate}");
    echo "Successfully executed";
}

   public function level_income()
{
    $today = now()->format('Y-m-d');

    // Saare users aur level stats
    $allUsers = User::all();
    $levelStats = Level::all()->keyBy('level');

    foreach ($allUsers as $user) {

        Log::info("Processing User: {$user->id}");

        $referrerCode = $user->referal_by;
        $currentLevel = 1;

        // Max 10 levels
        while ($currentLevel <= 10) {

            if (!$referrerCode) {
                Log::info("No referrer for User {$user->id} at level {$currentLevel}");
                break;
            }

            // Referrer user
            $referrerUser = User::where('referal_code', $referrerCode)
                ->where('status', 2)
                ->first();

            if (!$referrerUser) {
                Log::info("Invalid/Inactive referrer at level {$currentLevel}");
                break;
            }

            // ✅ Direct condition (LEVEL = DIRECT REQUIRED)
            $requiredDirects = $currentLevel;
            $userDirects = $referrerUser->total_direct;

            Log::info("Level {$currentLevel} Check -> Required: {$requiredDirects}, User Has: {$userDirects}");

            if ($userDirects >= $requiredDirects) {

                // Level stats check
                if (!isset($levelStats[$currentLevel])) {
                    Log::info("Level {$currentLevel} stats not found");
                    break;
                }

                $levelStat = $levelStats[$currentLevel];

                // Already income mila ya nahi check
                if (!$this->hasReceivedIncome($referrerUser->id, $user->id, $currentLevel, $today)) {

                    // Income calculation
                   $incomeAmount = ($user->total_investment * $levelStat->level_per) / 3000;

                    // User ke active investment me package check karo
                    $hasHalfLevelPackage = InvestmentHistory::where('user_id', $user->id)
                        ->whereIn('package_id', [8, 9, 10])
                        ->where('status', 2) // agar active investment status 1 hai
                        ->exists();

                    if ($hasHalfLevelPackage) {
                        $incomeAmount = $incomeAmount / 2;
                    }

                    if ($incomeAmount > 0) {

                        // Direct increment (no double save)
                        $referrerUser->increment('level_balance', $incomeAmount);

                        // Log income
                        $this->logIncome(
                            $referrerUser->id,
                            $user->id,
                            $incomeAmount,
                            $currentLevel,
                            $today
                        );

                        Log::info("✅ Level {$currentLevel} Income {$incomeAmount} given to User {$referrerUser->id}");
                    }

                } else {
                    Log::info("⛔ Already paid Level {$currentLevel} to User {$referrerUser->id}");
                }

            } else {
                Log::info("❌ Direct condition failed at Level {$currentLevel} for User {$referrerUser->id}");
            }

            // Next upline
            $referrerCode = $referrerUser->referal_by;
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
