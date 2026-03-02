<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFund extends Model
{
    use HasFactory;

    protected $table = 'add_funds';

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'type',
        'transaction_id',
        'remarks',
    ];

    // Status Constants
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;

    // Type Constants
    const TYPE_DEPOSIT = 1;
    const TYPE_WITHDRAWAL = 2;

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'integer',
        'type' => 'integer',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for readable status
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            1 => 'Pending',
            2 => 'Approved',
            3 => 'Rejected',
            default => 'Unknown',
        };
    }

    // Accessor for readable type
    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            1 => 'Deposit',
            2 => 'Withdrawal',
            default => 'Unknown',
        };
    }
}