<?php

namespace App\Models;

use App\Models\Model as Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maker extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'name'
    ];

    public function carModels():HasMany
    {
        return $this->hasMany(CarModel::class, 'maker_id');
    }
}
