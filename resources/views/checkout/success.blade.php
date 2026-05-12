@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-2">Đặt hàng thành công!</h3>
            <p class="mb-1">Mã đơn hàng: <strong>#{{ $order->id }}</strong></p>
            <p class="mb-1">Trạng thái: <strong>{{ $order->status }}</strong></p>
            <p class="mb-3">Tổng tiền: <strong class="text-danger">{{ number_format($order->total_amount, 0, ',', '.') }} đ</strong></p>

            <a href="{{route('home') }}" class="btn btn-primary">Về trang chủ</a>
            <a href="{{route('cart.index') }}" class="btn btn-outline-secondary">Xem giỏ hàng</a>
        </div>
    </div>
@endsection