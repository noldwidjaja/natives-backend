<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
}
