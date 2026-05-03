<?php

namespace App\Http\Controllers;
use Cloudinary\Api\Admin\AdminApi;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Models\ProductImage;
class CloudinaryController extends Controller
{


public function getImages()
{
    $cloudinary = new AdminApi([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ]
    ]);

    $result = $cloudinary->assets([
        'type' => 'upload',
        'resource_type' => 'image',
        'max_results' => 100
    ]);

    $urls = [];

    foreach ($result['resources'] as $img) {
        $urls[] = $img['secure_url'];
    }

    return response()->json($urls);
}
}
