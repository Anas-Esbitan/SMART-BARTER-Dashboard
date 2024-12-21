<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PublicProductController extends Controller
{
    
   public function index()
{
    $products = Product::all();
    return view('userside.index', compact('products'));
}
public function show($id)
{
    $product = Product::with('image')->find($id);
    return response()->json([
        'name' => $product->name,
        'price' => $product->price,
        'description' => $product->description,
        'images' => $product->images->pluck('path')
    ]);
}

}