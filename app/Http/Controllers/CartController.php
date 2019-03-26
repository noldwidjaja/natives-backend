<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with('item')->get()->toArray();
        return $carts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json->all();
        $request->validate([
            'customer_id' => 'required|uuid|exists:customers,id',
            'item_id' => 'required|uuid|exists:items,id',
            'item_quantity' => 'required|integer',
        ]);

        $cart = new Cart([
            'customer_id' => $data['customer_id'],
            'item_id' => $data['item_id'],
            'item_quantity' => $data['item_quantity'],
        ]);
        $cart->save();

        return $cart;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        $cart = Cart::with(['item','customer'])->where('id',$cart->id)->get()->toArray();
        return $cart;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $data = $request->json->all();
        $request->validate([
            'customer_id' => 'required|uuid|exists:customers,id',
            'item_id' => 'required|uuid|exists:items,id',
            'item_quantity' => 'required|integer',
        ]);

        $cart->customer_id = $data['customer_id'];
        $cart->item_id = $data['item_id'];
        $cart->item_quantity = $data['item_quantity'];
        $cart->save();

        return $cart;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return "Item removed from cart";
    }
}
