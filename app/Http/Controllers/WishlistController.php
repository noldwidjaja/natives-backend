<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::with(['item','customer'])->get()->toArray();
        return $wishlists;
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
            'customer_id' => 'required|uuid|exists:customers,id',
            'item_id' => 'required|uuid|exists:items,id',
        ]);

        $wishlist = new Wishlist([
            'customer_id' => $data['customer_id'],
            'item_id' => $data['item_id'],
        ]);
        $wishlist->save();

        return $wishlist;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        $wishlists = Wishlist::with('item')->where('id',$wishlist->id)->get()->toArray();
        return $wishlist;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        $data = $request->json()->all();
        $request->validate([
            'customer_id' => 'required|uuid|exists:customers,id',
            'item_id' => 'required|uuid|exists:items,id',
        ]);

        $wishlist->customer_id = $data['customer_id'];
        $wishlist->item_id = $data['item_id'];
        $wishlist->save();

        return $wishlist;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return "Item removed from wishlist";
    }
}
