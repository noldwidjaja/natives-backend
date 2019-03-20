<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return response()->json($images);
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
            'item_id' => 'required|uuid|exists:items,id',
            'picture' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        $photo_path = Storage::putFile('public/uploads/images', $request->file('picture'));

        $image = new Image([
            'directory' => $photo_path,
            'item_id' => $request->item_id,
        ]);
        $image->save();

        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return $image;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $data = $request->json()->all();
        
        $request->validate([
            'item_id' => 'required|uuid|exists:items,id',
            'picture' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        $photo_path = Storage::putFile('public/uploads/images', $request->file('picture'));

        $image->directory = $data['directory'];
        $image->item_id = $data['item_id']; 
        $image->save();

        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return "Deleted";
    }
}
