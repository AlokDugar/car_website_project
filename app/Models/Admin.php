<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    // You can define your table name if it is not the default 'admins'
    protected $table = 'admins';

    // If you want to allow mass assignment for certain fields, define the $fillable property.
    protected $fillable = ['username', 'email', 'password'];

    // Optionally, you may want to hide sensitive fields like password from the model's array and JSON representation.
    protected $hidden = ['password', 'remember_token'];

    // Optionally, you can define custom casts
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
