<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Product;

class CartController extends Controller
{
    // GET /cart
    public function index()
    {

        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $qty = (int) $request->input('qty', 1);
        if ($qty < 1) $qty = 1;

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => (int) $product->price,
                'image'      => $product->image, // path trong storage
                'qty'        => $qty,
            ];
        }

        session(['cart' => $cart]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
        
    }

    // POST /cart/update
    public function update(Request $request)
    {
        $data = $request->validate([
        'qty' => 'required|array',
        'qty .* ' => 'integer|min:1',
        ]);

        $cart = session('cart', []);

        foreach ($data['qty'] as $productId => $qty) {
            if (isset($cart[$productId])) {
                $cart[$productId]['qty'] = (int) $qty;
            }
        }   

        session(['cart' => $cart]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Cập nhật giỏ hàng thành công.');
    }

    // POST /cart/remove/{productId}
    public function remove ($productId)
    {
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    // POST /cart/clear
    public function clear()
    {
        session()->forget('cart');

        return redirect()
        ->route('cart.index')
        ->with('success', 'Đã xóa toàn bộ giỏ hàng.');

    }

}
