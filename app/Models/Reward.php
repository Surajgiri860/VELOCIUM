<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'rewards';
    use HasFactory;

    protected $fillable = [
        'name',
        'r_name',
        'team_business',
        'reward',
    ];
}
