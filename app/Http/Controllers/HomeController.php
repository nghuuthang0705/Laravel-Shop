<?php
    namespace App\Http\Controllers;
    use App\Models\Product;
    use Illuminate\Http\Request;

    class HomeController extends Controller
    {
        public function index()
        {
            # lấy 8 sản phẩm từ bảng dữ liệu
            $products = Product::latest()->take(8)->get();

            return view('home', compact('products'));
        }
    }
?>