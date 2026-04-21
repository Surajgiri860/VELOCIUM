<?php
// app/Http/Controllers/Admin/BonanzaAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RankReward;
use App\Models\RankRewardHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonanzaAdminController extends Controller
{
    public function index()
    {
        $claims = RankRewardHistory::with('user')
                    ->orderBy('id', 'desc')
                    ->paginate(20);

        return view('admin.bonanza-history', compact('claims'));
    }

    public function release($id)
{
    $claim = RankRewardHistory::findOrFail($id);

    if ($claim->status == 0) {

        DB::beginTransaction();

        try {
            // Update status
            $claim->status = 1;
            $claim->processed_by = auth()->guard('admin')->id();
            $claim->processed_at = now();
            $claim->save();

            // Add amount to user wallet
            $user = User::find($claim->user_id);
            $user->withdrawable += $claim->amount;
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Reward Released Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    return redirect()->back()->with('error', 'Already Released');
}
}