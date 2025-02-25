<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'states_id',
        'name'
    ];
}
