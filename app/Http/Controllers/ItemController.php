<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with([
            'gender:id,name',
            'type:id,name',
            'supplier:id,name',
            'image',
        ])->get()->toArray();
        return $items;
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
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'gender_id' => 'required|uuid|exists:genders,id',
            'type_id' => 'required|uuid|exists:types,id',
            'supplier_id' => 'required|uuid|exists:suppliers,id',
        ]);

        $item = new Item([
            'name' => $data['name'], 
            'price' => $data['price'], 
            'stock' => $data['stock'], 
            'description' => $data['description'], 
            'gender_id' => $data['gender_id'], 
            'type_id' => $data['type_id'], 
            'supplier_id' => $data['supplier_id'], 
        ]);
        $item->save();

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $item = Item::with([
            'gender:id,name',
            'type:id,name',
            'supplier:id,name',
            'image',
        ])->where('id',$item->id)->get()->toArray();
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $data = $request->json()->all();
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'gender_id' => 'required|uuid|exists:genders,id',
            'type_id' => 'required|uuid|exists:types,id',
            'supplier_id' => 'required|uuid|exists:suppliers,id',
        ]);

        $item->name = $data['name']; 
        $item->price = $data['price']; 
        $item->stock = $data['stock']; 
        $item->description = $data['description']; 
        $item->gender_id = $data['gender_id']; 
        $item->type_id = $data['type_id']; 
        $item->supplier_id = $data['supplier_id'];
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return "Deleted";
    }
}
