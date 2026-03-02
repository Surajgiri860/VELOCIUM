<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutClosing extends Model
{
    use HasFactory;

    protected $table = 'payout_closings';

    protected $fillable = [
        'total_balance',
        'total_withdrawable',
        'file_path', // 👈 yeh add karein
    ];

    protected $casts = [
        'total_balance' => 'decimal:2',
        'total_withdrawable' => 'decimal:2',
    ];
}