<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalOrders   = 0;
        $totalUsers    = 0;

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalUsers') );
    }
}
