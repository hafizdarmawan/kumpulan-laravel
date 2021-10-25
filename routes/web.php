<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 1. crud Pemula
Route::resource('products', ProductController::class);
// 

// 2. Validasi
Route::get('user/create', [HomeController::class, 'create']);
Route::post('user/create', [HomeController::class, 'store']);

// 3. Upload Image
Route::get('upload-image', [UploadImageController::class, 'create'])->name('image.upload');
Route::post('upload-image', [UploadImageController::class, 'store'])->name('image.upload.post');

// 4. Multiple Upload
Route::get('file', [FileController::class, 'create']);
Route::post('file', [FileController::class, 'store']);

// 5. Contoh Penggunaan Helper
// link contoh helper laravel8: // link contoh helper laravel 8
//https://www.itsolutionstuff.com/post/laravel-8-create-custom-helper-functions-tutorialexample.html 
Route::get('helper1', function () {
    $imageName = 'example.png';
    $fullpath = productImagePath($imageName);
    dd($fullpath);
});
Route::get('helper2', function () {
    $newDateFormat = changeDateFormat(date('Y-m-d'), 'm/d/Y');
    dd($newDateFormat);
});

// 6. Upload File
Route::get('upload-file', [UploadFileController::class, 'fileUpload'])->name('file.upload');
Route::post('upload-file', [UploadFileController::class, 'UploadPost'])->name('file.upload.post');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 7. DomPdf
// link : https://www.itsolutionstuff.com/post/laravel-8-pdf-laravel-8-generate-pdf-file-using-dompdfexample.html
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);


// 8. Send Email
// Link : https://www.itsolutionstuff.com/post/laravel-8-mail-laravel-8-send-email-tutorialexample.html
Route::get('send-mail', function () {
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    Mail::to('mckckck@gmail.com')->send(new \App\Mail\MyTestMail($details));
    dd("Email is Sent");
});


// 9. Excel
Route::get('importExportView', [MyController::class, 'importExportView']);
Route::get('export', [MyController::class, 'export'])->name('export');
Route::post('import', [MyController::class, 'import'])->name('import');

// 10. ajax Create

Route::get('ajaxRequest', [AjaxController::class, 'ajaxRequest']);
Route::post('ajaxRequest', [AjaxController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');


// 11. Yajra Datatable
Route::get('users', [UserController::class, 'index'])->name('users.index');


// 12. Ajax Validasi
Route::get('my-form', [AjaxController::class, 'myform']);
Route::post('my-form', [AjaxController::class, 'myformPost'])->name('my.form');