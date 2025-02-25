<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maker extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable=[
        'id',
        'name'
    ];

}
