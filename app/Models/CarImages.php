<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarImages extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'car_id',
        'image_path',
        'position'
    ];
}
