<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\User;
use App\Item;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
        $this->middleware('role:supplier')->only('supplier');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
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
            'phone_number' => "required|integer",
            'user_id' => "required|uuid|exists:users,id"
        ]);
        $supplier = Supplier::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'user_id' => $data['user_id']
        ]);
        return response()->json($supplier);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->json()->all();
        $request->validate([
            'name' => 'required|string',
            'phone_number' => "required|integer",
            'user_id' => "required|uuid|exists:users,id"
        ]);
        $supplier = new Supplier([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'user_id' => $data['user_id']
        ]);
        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return "Deleted";
    }

    public function createItem(Request $request)
    {
        $user = auth()->user();
        $supplier = User::find($user->id)->supplier_profile->id;
        $data = $request->json()->all();
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'gender_id' => 'required|uuid|exists:genders,id',
            'type_id' => 'required|uuid|exists:types,id',
        ]);

        $item = new Item([
            'name' => $data['name'], 
            'price' => $data['price'], 
            'stock' => $data['stock'], 
            'description' => $data['description'], 
            'gender_id' => $data['gender_id'], 
            'type_id' => $data['type_id'], 
            'supplier_id' => $supplier, 
        ]);
        $item->save();

        return $item;
    }
}
