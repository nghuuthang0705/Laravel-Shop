<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('success', 'Giỏ hàng đang trống. Hãy thêm sản phẩm trước.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // Prefill thông tin (tùy chọn)
        $user = Auth::user();

        return view('checkout.show', compact('cart', 'total', 'user'));
    }

    public function placeOrder(Request $request)
    {

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('success', 'Giỏ hàng đang trống. Không thể đặt hàng.');
        }

        $data = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:30',
            'customer_address' => 'required|string|max:500',
        ]);

        // Tính tổng tiền từ session
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // Transaction: tao order + items
        $order = DB::transaction(function () use ($data, $cart, $total) {
            $order = Order::create([
                'user_id'          => Auth::id(),
                'customer_name'    => $data['customer_name'],
                'customer_phone'   => $data['customer_phone'],
                'customer_address' => $data['customer_address'],
                'total_amount'     => $total,
                // status để default 'pending' (nếu DB đã default)
                'status' => 'pending',
            ]);
        
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'price'      => $item['price'],
                    'quantity'   => $item['qty'],
                    // Nếu bạn có cột subtotal thì mở dòng này:
                    // 'subtotal' => $item['price'] * $item['qty'],
            ]);
            }

            return $order;

        });

        // Clear cart sau khi đặt thành công
        session()->forget('cart');

        return redirect()
        ->route('checkout.success', $order->id)
        ->with('success', 'Đặt hàng thành công!');

    }


    // GET /checkout/success/{order}
    public function success($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}
