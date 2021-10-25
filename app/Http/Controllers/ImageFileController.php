<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageFileController extends Controller
{
    public function index()
    {
        return view('watermark.index');
    }

    public function ImageFileUpload(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:4096'
        ]);

        $image = $request->file('file');
        $input['file'] = time() . '.' . $image->getClientOriginalExtension();
        $imageFile = Image::make($image->getRealPath());
        $imageFile->text('© 2021 HafizDarmawan - All Rights Reserved', 120, 100, function ($font) {
            $font->size(100);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(90);
        })->save(public_path('/uploads') . '/' . $input['file']);

        return back()
            ->with('success', 'File Successfully Uploaded')
            ->with('fileName', $input['file']);
    }
}
