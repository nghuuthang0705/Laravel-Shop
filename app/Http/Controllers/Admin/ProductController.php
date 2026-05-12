<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

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
            'image'       => 'nullable|image|max:2048', // 2MB
        ]);

        // Upload ảnh nếu có
        if ($request->hasFile('image')) {
        // Lưu vào storage/app/public/products
            $data['image'] = $request->file('image')->store('products', 'public');
        }

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
            'image'       => 'nullable|image|max:2048',
        ]);

        // Nếu upload ảnh mới -> xóa ảnh cũ (nếu có) rồi lưu ảnh mới
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            // Không upload ảnh mới -> không đụng tới cột image
            unset($data['image']);
        }

        $product->update($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');

    }

    // DELETE /admin/products/{product}
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }

}



