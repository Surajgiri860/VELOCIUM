<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{

    use HasFactory;
    protected $table = 'config';
    protected $fillable = [
        'admin_address',
        'direct_sponser',
        'min_deposit',
        'min_wothdrawal',
        'admin_charge'
    ];
}
