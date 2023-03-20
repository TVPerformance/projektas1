<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];

    public function countryHotel(){
        return $this->hasMany(Hotel::class, 'country_id', 'id');
    }
}
