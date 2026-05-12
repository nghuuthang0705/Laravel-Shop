@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2> 

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase">Sản phẩm</h6>
                        <h3 class="fw-bold">{{ $totalProducts }}</h3>
                        <p class="mb-0 small text-muted">
                            Tổng số sản phẩm đang có trong hệ thống.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase">Đơn hàng</h6>
                        <h3 class="fw-bold">{{$totalOrders }}</h3>
                        <p class="mb-0 small text-muted">
                            Sẽ cập nhật khi làm chức năng đặt hàng.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase">Người dùng</h6>
                        <h3 class="fw-bold">{{ $totalUsers }}</h3>
                        <p class="mb-0 small text-muted">
                            Sẽ cập nhật khi thống kê user.
                        </p>
                    </div>
                </div> 
            </div>

        </div>

@endsection
