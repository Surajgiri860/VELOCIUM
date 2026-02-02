<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFund extends Model
{
    protected $table = 'add_funds';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'type',
        'transaction_id',
        'remarks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
