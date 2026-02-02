<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{

    use HasFactory;
    protected $table = 'transaction_history';

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status',
        'reward_id',
        'to',
        'by',
        'cred_date',
        'withdrawal_address',
        'level',
        'Direct',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'by', 'id'); // The user who made the transaction
    }
    public function user_req()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // The user who made the transaction
    }

    public function referral()
    {
        return $this->belongsTo(User::class, 'by', 'id'); // The user who is being referred, if applicable
    }
}
