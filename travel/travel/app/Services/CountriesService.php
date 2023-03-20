<?php

namespace App\Services;
use App\Models\Country;



class CountriesService
{
 
    public function test()
    {
        return 'Hello u';
    }

    public function get()
    {
        return Country::all()->sortBy('title');
    }

}