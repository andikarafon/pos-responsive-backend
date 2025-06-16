<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index get all product
    public function index()
    {
        $products = \App\Models\Product::with('category')->get();
        return response()->json([
            'message' => 'Products retrieved successfully',
            'data' => $products,
        ]);
    }
}
