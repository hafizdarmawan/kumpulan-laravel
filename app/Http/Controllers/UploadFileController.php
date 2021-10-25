<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function fileUpload()
    {
        return view('fileupload.index');
    }

    public function UploadPost(Request $request)
    {
        $request->validate([
            'file'  => 'required|mimes:pdf,xlsx,csv|max:2048'
        ]);
        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('files'), $fileName);

        // simpan ke dalam database
        UploadFile::create(['file' => $fileName]);
        return back()->with('success', 'You have successfully')->with('file', $fileName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UploadFile  $uploadFile
     * @return \Illuminate\Http\Response
     */
    public function show(UploadFile $uploadFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UploadFile  $uploadFile
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadFile $uploadFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UploadFile  $uploadFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UploadFile $uploadFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UploadFile  $uploadFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadFile $uploadFile)
    {
        //
    }
}
