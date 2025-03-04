<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'name'
    ];
    public function cities(): HasMany// Plural naming convention
    {
        return $this->hasMany(City::class);
    }
}
