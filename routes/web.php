<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\CloudinaryController;

// show form + list
Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);
// store
Route::get('/cloudinary-images', [CloudinaryController::class, 'getImages']);

// view list
Route::get('/viewProduct', [ProductController::class, 'view']);

Route::get('/twisoom', function () {
    return view('twisoom');
});
// edit
Route::get('/edit/{id}', function ($id) {
    $product = product::findOrFail($id);
    return view('edit', compact('product'));
});
//http://twisoom.test/viewProduct?admin=1
Route::get('/product/{id}', [ProductController::class, 'show']);
// update
Route::post('/update/{id}', [ProductController::class, 'update']);

// delete
Route::post('/delete/{id}', function ($id) {
    product::findOrFail($id)->delete();
    return redirect('/viewProduct?admin=1');
});

Route::post('/product/import', [ProductController::class, 'importExcel']);
Route::post('/product/import-zip', [ProductController::class, 'importZip']);
Route::get('/import-cloudinary', [ProductController::class, 'importFromCloudinary']);
