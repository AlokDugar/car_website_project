<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'maker_id',
        'carModel_id',
        'year',
        'price',
        'vin',
        'mileage',
        'car_type_id',
        'fuel_type_id',
        'user_id',
        'city_id',
        'address',
        'phone',
        'description',
        'published_at'
    ];

    public function features(): HasOne
    {
        return $this->hasOne(CarFeatures::class, 'car_id');
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(CarImages::class)->orderBy('position', 'asc');
    }

    public function carImages():HasMany
    {
        return $this->hasMany(CarImages::class);
    }
    public function carType():BelongsTo
    {
        return $this->belongsTo(CarType::class);
    }
    public function favouritedByUsers():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_cars'); // Many-to-Many
    }
    public function maker():BelongsTo
    {
        return $this->belongsTo(Maker::class);
    }
    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function fuelType():BelongsTo
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }
    public function owner():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function carModel():BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'carModel_id');
    }
}
