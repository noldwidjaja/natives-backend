<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Cart;
use App\Wishlist;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with([
            'cart',
            'wishlist',
            'gender:id,name',
            'user:id,email,role_id',
            'user.role:id,name',
        ])->get()->toArray();
        return $customers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender_id' => 'required|uuid|exists:genders,id',
            'date_of_birth' => 'required|date',
            'phone_number' => "required|integer",
            'user_id' => "required|uuid|exists:users,id"
        ]);

        $customer = new Customer([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender_id' => $data['gender_id'],
            'date_of_birth' => $data['date_of_birth'],
            'phone_number' => $data['phone_number'],
            'user_id' => $data['user_id']
        ]);
        $customer->save();

        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customer = Customer::with([
            'cart',
            'wishlist',
            'gender:id,name'
        ])->where('id',$customer->id)->get()->toArray();
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->json()->all();
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender_id' => 'required|uuid|exists:genders,id',
            'date_of_birth' => 'required|date',
            'phone_number' => "required|integer",
            'user_id' => "required|uuid|exists:users,id"
        ]);

        $customer->first_name = $data['first_name'];
        $customer->last_name = $data['last_name'];
        $customer->gender_id = $data['gender_id'];
        $customer->date_of_birth = $data['date_of_birth'];
        $customer->phone_number = $data['phone_number'];
        $customer->user_id = $data['user_id'];
        $customer->save();

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $cart = Cart::where('customer_id',$customer->id)->delete();
        $wishlist = Wishlist::where('customer_id',$customer->id)->delete();
        $customer->delete();
        return "Deleted Successfully";
    }
}
