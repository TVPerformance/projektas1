<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const SORT = [
        'asc_surname' => 'Surname A-Z',
        'desc_surname' => 'Surname Z-A',
        'asc_balance' => 'Balance min->max',
        'desc_balance' => 'Balance max->min',
    ];

    const PER_PAGE = [
        'all', 5, 8, 13, 21
    ];
}
