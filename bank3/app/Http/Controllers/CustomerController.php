<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
    public function index(Request $request)
    {

        $customers = match($request->sort ?? '') {
            'asc_surname' => Customer::orderBy('surname'),
            'desc_surname' => Customer::orderBy('surname', 'desc'),
            'asc_balance' => Customer::orderBy('balance'),
            'desc_balance' => Customer::orderBy('balance', 'desc'),
             default => Customer::orderBy('surname')
        };


        $perPageShow = in_array($request->per_page, Customer::PER_PAGE) ? $request->per_page : 'all';
        if($perPageShow == 'all'){
            $customers = $customers->get();
        } else {
             $customers = $customers->paginate($perPageShow)->withQueryString();
        }
       

    //    $customers = Customer::all()->sortBy('surname');
    //    return view('back.customers.index', ['customers' => $customers]);

       return view('back.customers.index', [
        'customers' => $customers,
        'sortSelect' => Customer::SORT,
        'sortShow' => isset(Customer::SORT[$request->sort]) ? $request->sort : '',
        'perPageSelect' => Customer::PER_PAGE,
        'perPageShow' => $perPageShow,
       ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('back.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(), 
            [
                'customer_name' => 'required|alpha|min:3|max:100',
                'customer_surname' => 'required|alpha|min:3|max:100',
                'customer_pers_id' => 'required|integer|unique:customers,pers_id|regex:/^([3-6]{1})([0-9]{2})([0-1]{1})([0-9]{1})([0-3]{1})([0-9]{1})([0-9999]{4})$/',
            ]
            );

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $customer = new Customer;
        $customer->name = $request->customer_name;
        $customer->surname = $request->customer_surname;
        $customer->pers_id = $request->customer_pers_id;
        $customer->account = $request->customer_account;
        $customer->balance = 0;
        $customer->save();

        return redirect()->route('customers-index')->with('ok', 'Atidaryta sąskaita naujam klientui');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
       return view('back.customers.edit', [
        'customer' => $customer
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {   

        if($request->minus == 5 && $customer->balance - $request->sum < 0) {
            $request->flash();
          return redirect()->route('customers-edit', [
            'customer' => $customer
           ])->with('no', 'Sąskaitoje nepakanka lėšų');
        }

        if($request->minus == 5){ 
            $customer->balance = $customer->balance - $request->sum;
            $customer->save();
            return redirect()->route('customers-edit', [
                'customer' => $customer
               ])->with('ok', 'Lėšos buvo nuskaičiuotos');
        } else {$customer->balance = $customer->balance + $request->sum;
            $customer->save();
            return redirect()->route('customers-edit', [
                'customer' => $customer
               ])->with('ok', 'Lėšos buvo pridėtos');};

        $customer->save();
        return redirect()->route('customers-edit', [
            'customer' => $customer
           ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)  {
   
            if ($customer->balance == 0) {      
                $customer->delete();      
                return redirect()->route('customers-index')->with('ok', 'Sąskaita buvo sėkmingai ištrinta');
            } 

                return redirect()->back()->with('no', 'Sąskaitos kurioje yra lėšų ištrinti negalima');
            }
                    // $customer->delete();    // return redirect()->route('customers-index');  }}
        }