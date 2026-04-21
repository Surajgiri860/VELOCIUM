<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankReward extends Model
{
    protected $table = 'rank_rewards';

    protected $fillable = [
        'direct_required',
        'team_required',
        'reward_name',
        'reward_amount',
        'rank_name'
    ];

    // 🔗 Relation: One reward → many histories
    public function histories()
    {
        return $this->hasMany(RankRewardHistory::class, 'reward_id');
    }
}