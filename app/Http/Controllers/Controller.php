<?php

namespace App\Http\Controllers;
use App\Models\Product;

abstract class Controller
{
    public function show(Product $product)
    {
        $relatedProducts = Product::where('id', '!=', $product->id)->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}


