<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('summernote.index');
    }

    public function fileUpload(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'content'   => 'required',
        ]);

        $content = $request->content;
        $dom = new \DOMDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data)  = explode(';', $data);
            list(, $data)        = explode(',', $data);

            $imgData    = base64_decode($data);
            $image_name = "/uploads" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();
        $fileUpload = new Employee();
        $fileUpload->name = $request->name;
        $fileUpload->content = $content;
        $fileUpload->save();
        dd($content);
    }
}
