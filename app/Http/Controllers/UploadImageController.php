<?php

namespace App\Http\Controllers;

use App\Models\UploadImage;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('uploadimage.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'image'  => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        // cara 1
        // $request->image->storeAs('images', $imageName);
        // storage/app/images/file.png

        // cara 2
        // $request->image->move(public_path('images'), $imageName);
        // public/images/file.png

        // cara 3
        // $request->image->storeAs('images', $imageName, 's3')

        $validasidata = $request->all();
        $request->image->move(public_path('images'), $imageName);
        $validasidata['foto'] = $imageName;
        UploadImage::create($validasidata);
        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('foto', $imageName);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UploadImage  $uploadImage
     * @return \Illuminate\Http\Response
     */
    public function show(UploadImage $uploadImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UploadImage  $uploadImage
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadImage $uploadImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UploadImage  $uploadImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UploadImage $uploadImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UploadImage  $uploadImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadImage $uploadImage)
    {
        //
    }
}
