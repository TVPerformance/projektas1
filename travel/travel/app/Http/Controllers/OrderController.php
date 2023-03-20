<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::orderBy('created_at', 'desc')
       ->get()
       ->map(function($order){

        $order->order = json_decode($order->order_json);
        return $order;
       });

       return view('back.orders.index', ['orders' => $orders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status = 1;
        $order->save();
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->status == 0) {
            return redirect()->back()->with('no', 'Unfinished orders can not be deleted');
        }

        $order->delete();

        return redirect()->back();

    }
}
