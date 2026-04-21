<?php
// app/Http/Controllers/BonanzaRewardsController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RankReward;
use App\Models\RankRewardHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BonanzaRewardsController extends Controller
{
    /**
     * Display the Bonanza rewards page with user's rank and business metrics.
     */
    public function index()
    {
        $user = Auth::user();

        // Get all rank rewards (ordered by required business ascending)
        $rewards = RankReward::orderBy('direct_required', 'asc')->get();

        // Calculate user's business metrics
        $totalDirectBusiness = $user->total_direct_business ?? 0;
        $totalTeamBusiness   = $user->total_business_volume ?? 0;  // Using total_business_volume as team business
        $businessVolume      = $user->team_business ?? 0;

        // Determine current rank based on achieved criteria
        $currentRank = $this->calculateCurrentRank($user, $rewards);

        // Get claimed reward IDs for this user
        $claimedRewards = RankRewardHistory::where('user_id', $user->id)
                            ->where('status', 'claimed')
                            ->pluck('reward_id', 'reward_id')
                            ->toArray();

        return view('BonanzaRewards', compact('rewards', 'totalDirectBusiness', 'totalTeamBusiness', 'businessVolume', 'currentRank', 'claimedRewards'));
    }

    /**
     * Claim a specific rank reward.
     */
    public function claimReward($rewardId)
    {
        $user = Auth::user();
        $reward = RankReward::findOrFail($rewardId);

        // Check if already claimed
        $alreadyClaimed = RankRewardHistory::where('user_id', $user->id)
                            ->where('reward_id', $rewardId)
                            ->where('status', 'claimed')
                            ->exists();

        if ($alreadyClaimed) {
            return redirect()->back()->with('error', 'You have already claimed this reward.');
        }

        // Check eligibility
        $totalDirectBusiness = $user->total_direct_business ?? 0;
        $totalTeamBusiness   = $user->total_business_volume ?? 0;

        if ($totalDirectBusiness >= $reward->direct_required && $totalTeamBusiness >= $reward->team_required) {
            // Begin transaction to ensure data consistency
            DB::beginTransaction();
            try {
                // Create history record
                RankRewardHistory::create([
                    'user_id'     => $user->id,
                    'reward_id'   => $reward->id,
                    'rank_name'   => $reward->rank_name,
                    'reward_name' => $reward->reward_name,
                    'amount'      => $reward->reward_amount,
                    'status'      => 'claimed'
                ]);

                // Add reward amount to user's withdrawable balance (or whichever balance you prefer)
                $user->withdrawable += $reward->reward_amount;
                $user->save();

                DB::commit();
                return redirect()->back()->with('success', 'Reward claimed successfully! $' . number_format($reward->reward_amount, 2) . ' added to your withdrawable balance.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'You are not eligible for this reward yet.');
        }
    }

    /**
     * Calculate the user's current rank based on achieved direct and team business.
     */
    private function calculateCurrentRank($user, $rewards)
    {
        $directBusiness = $user->total_direct_business ?? 0;
        $teamBusiness   = $user->total_business_volume ?? 0;

        $currentRank = 'No Rank';
        foreach ($rewards as $reward) {
            if ($directBusiness >= $reward->direct_required && $teamBusiness >= $reward->team_required) {
                $currentRank = $reward->rank_name;
            } else {
                break; // Since rewards are ordered ascending, stop at first unmet requirement
            }
        }
        return $currentRank;
    }

    /**
 * Get claimed rewards history
 */
public function getHistory()
{
    $user = Auth::user();
    $history = RankRewardHistory::where('user_id', $user->id)
                ->where('status', 'claimed')
                ->with('reward')
                ->orderBy('created_at', 'desc')
                ->get();
    
    return response()->json($history);
}
}