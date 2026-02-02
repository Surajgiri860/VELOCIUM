<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentHistory extends Model
{

    use HasFactory;
    protected $table = 'investment_history';
    protected $fillable = [
        'user_id',
        'amount',
        'address',
        'package_id',
        'status',
        'tx_hash',
        'type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }
}
