<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    const SORT = [
        'asc_price' => 'price: lowest first',
        'dsc_price' => 'price: highest first',
    ];

    const PER_PAGE = [
        'all', 5, 8, 13, 21,
    ];

   // public $timestamps = false;

    // protected $casts = [
    //     'start' => 'date',
    //     'end' => 'date',
    // ];

    public function hotelCountry(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function deletePhoto(){
        $fileName = $this->picture;
        if (file_exists(public_path().$fileName)){
            unlink(public_path().$fileName);
        };
        $this->picture = null;
        $this->save();
    }
}


