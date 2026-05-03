<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
       protected $fillable = [
        'image',
        'productPrice',
        'productDesc',
        'productName',
        'type'


        ];

public function images()
{
    return $this->hasMany(ProductImage::class, 'product_id');
}
}
