<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'name'
    ];
    public function cars():HasMany
    {
        return $this->hasMany(Car::class, 'fuel_type_id');
    }

}
