<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;
use App\Models\TransactionHistory;

class RoyaltyRewardsController extends Controller
{
    public function Royalty()
    {
        $Reward = Reward::get();
        // dd($Reward);
        return view('Pages.Royalty', compact('Reward'));
    }

    public function claimReward(TransactionHistory $reward)
    {
        // Ensure the reward belongs to the logged-in user and hasn't been claimed yet
        if ($reward->user_id == auth()->id() && $reward->status == 0 && $reward->type == 3) {

            // Retrieve the user using the correct method
            $user = User::findOrFail($reward->user_id); // Find the user by ID

            // Add the reward amount to the user's balance
            $user->royalty_balance += $reward->amount;
            $user->save();

            // Mark the reward as claimed (set status to 1)
            $reward->status = 1;
            $reward->save();

            // Redirect back with success message
            return back()->with('success', 'Reward claimed successfully!');
        }

        // Redirect back with error if the reward is not valid
        return back()->with('error', 'Invalid reward or already claimed.');
    }
}
