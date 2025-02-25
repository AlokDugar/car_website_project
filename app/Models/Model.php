<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends EloquentModel
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'maker_id',
        'name'
    ];
}
