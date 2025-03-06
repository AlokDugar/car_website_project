<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends EloquentModel
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'maker_id',
        'name'
    ];
    public function cars():HasMany
    {
        return $this->hasMany(Car::class, 'model_id');
    }
    public function maker():BelongsTo
    {
        return $this->belongsTo(Maker::class, 'maker_id');
    }
}
