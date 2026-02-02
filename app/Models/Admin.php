<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ensure this is imported
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Specify the table name if it's different from the default.

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
