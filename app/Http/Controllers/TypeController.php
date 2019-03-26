<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
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
        $types = Type::with([
            'items',
            'items.supplier:id,name'
        ])->get()->toArray();
        return $types;
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
            'category_id' => 'required|exists:categories,id',
        ]);

        $type = new Type([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
        ]);
        $type->save();

        return $type;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $type = Type::with([
            'items',
            'items.supplier:id,name'])->where('id',$type->id)->get()->toArray();
        return $type;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->json()->all();

        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $type->name = $data['name'];
        $type->category_id = $data['category_id'];
        $type->save();

        return $type;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return "Deleted";
    }
}
