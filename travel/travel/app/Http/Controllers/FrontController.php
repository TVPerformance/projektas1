<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;


class FrontController extends Controller
{

  public function home(Request $request)
  {
    $hotels = Hotel::all();
    $countries = Country::all()->sortBy('title');
    $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : 'all';

    if (!$request->s) {
      $hotels = match ($request->sort ?? '') {
        'asc_price' => Hotel::orderBy('price'),
        'dsc_price' => Hotel::orderBy('price', 'desc'),
        default => Hotel::where('id', '>', 0)
      };

      if ($perPageShow == 'all') {
        $hotels = $hotels->get();
      } else {
        $hotels = $hotels->paginate($perPageShow)->withQueryString();
      }
    } else {
      $s = explode(' ', $request->s);

      if (count($s) == 1) {
        $hotels = Hotel::where('title', 'like', '%' . $request->s . '%')->get();
      } else {
        $hotels = Hotel::where('title', 'like', '%' . $s[0] . '%' . $s[1] . '%')->orWhere('title', 'like', '%' . $s[1] . '%' . $s[0] . '%')->get();
      }
    }


    return view('front.main', [
      'hotels' => $hotels,
      'countries' => $countries,
      'sortSelect' => Hotel::SORT,
      'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
      'perPageSelect' => Hotel::PER_PAGE,
      'perPageShow' => $perPageShow,
      's' => $request->s ?? ''
    ]);
  }

  public function showCountryHotels(Request $request, Country $country)
  {

    $hotels = Hotel::where('country_id', $country->id);
    $countries = Country::all();

    // return view('front.main', ['hotels' => $hotels], ['countries' => $countries]);

    //  $hotels = Hotel::all();
    //  $countries = Country::all()->sortBy('title');
    $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : 'all';

    if (!$request->s) {
      $hotels = match ($request->sort ?? '') {
        'asc_price' => Hotel::orderBy('price'),
        'dsc_price' => Hotel::orderBy('price', 'desc'),
        default => Hotel::where('country_id', $country->id),
      };

      if ($perPageShow == 'all') {
        $hotels = $hotels->get();
      } else {
        $hotels = $hotels->paginate($perPageShow)->withQueryString();
      }
    } else {
      $s = explode(' ', $request->s);

      if (count($s) == 1) {
        $hotels = Hotel::where('title', 'like', '%' . $request->s . '%')->get();
      } else {
        $hotels = Hotel::where('title', 'like', '%' . $s[0] . '%' . $s[1] . '%')->orWhere('title', 'like', '%' . $s[1] . '%' . $s[0] . '%')->get();
      }
    }



    return view('front.main', [
      'hotels' => $hotels,
      'countries' => $countries,
      'sortSelect' => Hotel::SORT,
      'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
      'perPageSelect' => Hotel::PER_PAGE,
      'perPageShow' => $perPageShow,
      's' => $request->s ?? ''
    ]);
  }

  public function showHotel(Hotel $hotel)
  {
    return view('front.hotel', ['hotel' => $hotel]);
  }

  public function addToCart(Request $request, CartService $cart)
  {
    $id = (int) $request->product;
    $count = (int) $request->count;
    $cart->add($id, $count);
    return redirect()->back();
  }

  public function cart(CartService $cart)
  {
    return view('front.cart', ['cartList' => $cart->list]);
  }

  public function updateCart(Request $request, CartService $cart)
  {
    if ($request->delete) {
      $cart->delete($request->delete);
    } else {
      $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
      $cart->update($updatedCart);
    }
    return redirect()->back();
  }

  public function makeOrder(CartService $cart)
  {
    $order = new Order;
   
    $order->user_id = Auth::user()->id;

    $order->order_json = json_encode($cart->order());

    $order->save();
    $cart->empty();

    return redirect()->route('main');
  }
}
