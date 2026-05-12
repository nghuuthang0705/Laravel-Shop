<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // /admin/products
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));   
    }

    // // GET /admin/products/create

    public function create()
    {
        return view('admin.products.create');
    }

    // // POST /admin/products
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
        ]);

        Product::create($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    // // POST /admin/products/edit
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
        ]);

        $product->update($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');

    }

    // DELETE /admin/products/{product}
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }

}



