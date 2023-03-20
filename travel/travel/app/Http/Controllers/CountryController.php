<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CountryController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all()->sortBy('title');

        $countries = $countries->map(function($c){
            $c->startNice = Carbon::parse($c->start)->format('F j, Y');
            $c->endNice = Carbon::parse($c->end)->format('F j, Y');
            return $c;
        });

        return view('back.countries.index', ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
       // $end = Carbon::parse($request->start)->addDays($request->length);

        $country = new Country;

        $country->title = $request->title;
        $country->start = $start;
        $country->end = $end;

        $country->save();
        

        return redirect()->route('countries-index', ['#'.$country->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('back.countries.edit', [
            'country' => $country
           ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->title = $request->country_title;
        $country->start = $request->country_start;
        $country->end = $request->country_end;

        $country->save();
        return redirect()->route('countries-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country, Hotel $hotel)
    {

        $hotels = Hotel::all();

        foreach($hotels as $hotel){
            if($country->id == $hotel->country_id){
                return redirect()->back()->with('no', 'Country with hotels can not be deleted');
            }
        }

        $country->delete();
        return redirect()->back()->with('ok', 'Country been deleted');
    }
}
