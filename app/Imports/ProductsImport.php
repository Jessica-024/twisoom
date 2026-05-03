<?php
namespace App\Imports;

use App\Models\Product;
use App\Models\ProductImage;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    public function model(array $row)
{
    if ($row[0] === 'ProductName' || empty($row[0])) {
        return null;
    }

    $product = Product::create([
        'productName'  => $row[0],
        'productPrice' =>(float) $row[1],
        'type'         => $row[2],
        'productDesc'  => $row[3],
        'image'   => $row[4] ?? null, // 单图备用
    ]);

    if (!empty($row[4])) {
        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $row[4],
        ]);
    }

    return $product;
}
}
