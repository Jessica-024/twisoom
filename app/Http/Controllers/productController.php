<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Cloudinary\Api\Admin\AdminApi;
use App\Models\Product;
use App\Models\ProductImage;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    // =========================
    // CLOUDINARY IMPORT
    // =========================
  private function saveImages($product, $images, $source = 'local')
{
    foreach ($images as $img) {

        $path = null;

        // CASE 1: local upload
        if ($source === 'local') {
            $path = $img->store('products', 'public');
        }

        // CASE 2: cloudinary upload
        if ($source === 'cloudinary') {
            $path = cloudinary()
                ->upload($img->getRealPath())
                ->getSecurePath();
        }

        // CASE 3: url (string)
        if ($source === 'url') {
            $path = $img;
        }

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $path,   // ✅ FIXED
        ]);
    }
}
    // =========================
    // STORE (manual / excel)
    // =========================
  public function store(Request $request)
{
    if ($request->hasFile('excelFile')) {
        Excel::import(new ProductsImport, $request->file('excelFile'));
        return back()->with('success', 'Excel 导入成功！');
    }

    if ($request->filled('productName')) {

        $product = Product::create([
            'productName'  => $request->productName,
            'productPrice' => $request->productPrice,
            'type'         => $request->type,
            'productDesc'  => $request->productDesc
        ]);

        // ✅ LOCAL UPLOAD
        if ($request->hasFile('images')) {
            $this->saveImages($product, $request->file('images'), 'local');
        }

        return back()->with('success', '产品添加成功！');
    }

    return back()->with('error', '没有数据');
}
    // =========================
    // VIEW ALL PRODUCTS
    // =========================
    public function view()
    {
        $products = Product::with('images')->get();
        return view('viewProduct', compact('products'));
    }

    // =========================
    // SHOW SINGLE PRODUCT
    // =========================
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('productShow', compact('product'));
    }

    // =========================
    // UPDATE (fixed)
    // =========================
   public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->update([
        'productName'  => $request->productName,
        'productPrice' => $request->productPrice,
        'type'         => $request->type,
        'productDesc'  => $request->productDesc,
    ]);

    // ❗ IMPORTANT: delete old images first
    if ($request->hasFile('images')) {

        ProductImage::where('product_id', $product->id)->delete();

        $this->saveImages($product, $request->file('images'), 'local');
    }

    return redirect('/viewProduct?admin=1');
}

    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $products = Product::with('images')->get();
        return view('product', compact('products'));
    }
}
