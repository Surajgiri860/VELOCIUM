<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * Mass assignable attributes
     */
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

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'activation_balance' => 'decimal:2',
        'withdrawable'       => 'decimal:2',
        'staking_balance'    => 'decimal:2',
        'level_balance'      => 'decimal:2',
        'royalty_balance'    => 'decimal:2',
        'total_investment'   => 'decimal:2',
        'team_business'      => 'decimal:2',
        'status'             => 'integer',
        'type'               => 'integer',
        'password'           => 'hashed',
    ];

    /* ================= RELATIONSHIPS ================= */
//    
    public function claimHistories()
    {
        return $this->hasMany(TransactionHistory::class);
    }
    public function Referral()
    {
        return $this->hasMany(TransactionHistory::class, 'by', 'id');
    }
    public function investmentHistory()
    {
        return $this->hasMany(InvestmentHistory::class);
    }
}
