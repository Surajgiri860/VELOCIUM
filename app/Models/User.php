<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /* ================= MASS ASSIGNABLE ================= */
    protected $fillable = [
        'prefix',
        'name',
        'email',
        'phone',
        'referal_code',
        'referal_by',

        'activation_balance',
        'withdrawable',
        'staking_balance',
        'direct_balance',
        'level_balance',
        'royalty_balance',
        'total_investment',
        'team_business',

        'type',
        'gender',
        'status',

        'password',
        'wallet_address',

        'account_name',
        'account_number',
        'ifsc_code',
    ];

    /* ================= HIDDEN ================= */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* ================= CASTS ================= */
    protected $casts = [
        'activation_balance' => 'decimal:2',
        'withdrawable'       => 'decimal:2',
        'staking_balance'    => 'decimal:2',
        'level_balance'      => 'decimal:2',
        'royalty_balance'    => 'decimal:2',
        'total_investment'   => 'decimal:2',
        'team_business'      => 'decimal:2',

        'direct_balance'     => 'integer',
        'status'             => 'integer',
        'type'               => 'integer',

        'password'           => 'hashed',
        'created_at'         => 'datetime',
        'updated_at'         => 'datetime',
    ];

    /* ================= RELATIONSHIPS ================= */

    // User ke claim / transaction history
    public function claimHistories()
    {
        return $this->hasMany(TransactionHistory::class, 'user_id', 'id');
    }

    // User ke investments
    public function investmentHistories()
    {
        return $this->hasMany(InvestmentHistory::class, 'user_id', 'id');
    }

    // Direct referrals (jisne is user ka referral code use kiya)
    public function referrals()
    {
        return $this->hasMany(User::class, 'referal_by', 'referal_code');
    }

    // Parent / Sponsor
    public function sponsor()
    {
        return $this->belongsTo(User::class, 'referal_by', 'referal_code');
    }


    public function scopeActive($query)
{
    return $query->where('status', 2);
}

public function scopeInactive($query)
{
    return $query->where('status', 0);
}

}
