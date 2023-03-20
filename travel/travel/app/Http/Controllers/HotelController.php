<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\ImageManager;


class HotelController extends Controller
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
    public function index( Request $request)
    {
        $hotels = Hotel::all();
        $countries = Country::all()->sortBy('title');

        $countries = $countries->map(function($c){
            $c->startNice = Carbon::parse($c->start)->format('F j, Y');
            $c->endNice = Carbon::parse($c->end)->format('F j, Y');
            return $c;
        });
        
       
        return view('back.hotels.index', ['hotels' => $hotels], ['countries' => $countries]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->sortBy('title');
        return view('back.hotels.create', ['countries' => $countries]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $hotel = new Hotel;
          
        $hotel->title = $request->hotel_title;
        $hotel->price = $request->price;
        $hotel->duration = $request->length;
        $hotel->country_id = $request->country_id;
        $hotel->desc = $request->hotel_desc;

        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            $photo->move(public_path().'/hotels', $file);
            $hotel->picture ='/hotels' . '/' . $file;
 
            
           // $manager = new ImageManager(['driver' => 'GD']);

            // $image = $manager->make($photo);
            // $image->crop(400, 600);
            
            
            // $image->save(public_path().'/hotels/'.$file);

        }


        $hotel->save();
        return redirect()->route('hotels-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return view('back.hotels.show', ['hotel' => $hotel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::all()->sortBy('title');
        return view('back.hotels.edit', [
            'hotel' => $hotel, 'countries' => $countries
           ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        
        if($request->delete_photo) { 
            $hotel->deletePhoto();
            return redirect()->back()->with('ok', 'Photo was deleted');
        }
        
        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            $photo->move(public_path().'/hotels', $file);
            $hotel->picture = '/hotels' . '/' . $file;
        }


        $hotel->title = $request->hotel_title;
        $hotel->price = $request->hotel_price;
        $hotel->duration = $request->hotel_duration;
        $hotel->desc = $request->hotel_desc;
        $hotel->save();

        return redirect()->route('hotels-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->back()->with('ok', 'Hotel been deleted');
    }

    public function pdf(Hotel $hotel)
    {
        $pdf = Pdf::loadView('back.hotels.pdf', [
            'hotel' => $hotel,
           ]);
        return $pdf->download($hotel->title.'.pdf');
    }
}
