<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankRewardHistory extends Model
{
    protected $table = 'rank_reward_histories';

    protected $fillable = [
        'user_id',
        'reward_id',
        'rank_name',
        'reward_name',
        'amount',
        'status'
    ];

    // 🔗 Relation: History belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Relation: History belongs to reward
    public function reward()
    {
        return $this->belongsTo(RankReward::class, 'reward_id');
    }
}