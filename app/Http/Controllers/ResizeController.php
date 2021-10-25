<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ResizeController extends Controller
{
    public function index()
    {
        return view('resize.index');
    }

    public function resizeImage(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|image|mimes:png,jpg,png,jpeg,svg|max:2048'
        ]);

        $image = $request->file('file');
        $input['file'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/thumbnails');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRation();
        })->save($destinationPath . '/' . $input['file']);
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['file']);
        return back()
            ->with('success', 'Image has successfully Uploaded')
            ->with('fileName', $input['file']);
    }
}
