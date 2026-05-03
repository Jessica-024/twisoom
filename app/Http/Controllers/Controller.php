<?php

namespace App\Http\Controllers;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
abstract class Controller
{
public function index()
{
    $products = product::all();
    return view('product', compact('products'));
}

}
