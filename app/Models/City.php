<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'id',
        'states_id',
        'name'
    ];
    public function state():BelongsTo
    {
        return $this->belongsTo(State::class); // Adjust this to match your actual relationship
    }
}
