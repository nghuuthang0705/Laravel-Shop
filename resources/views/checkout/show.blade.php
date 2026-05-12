@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')

    <h2 class="mb-4">Thanh toán / Đặt hàng</h2>

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    <div class="row g-4">

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Thông tin nhận hàng</h5>
            
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" name="customer_name" class="form-control"
                                value="{{old('customer_name', $user->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="customer_phone" class="form-control"
                                value="{{old('customer_phone') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chi</label>
                            <textarea name="customer_address" rows="3" class="form-control" required>{{ old('customer_address') }}</textarea>
                        </div>

                        <button class="btn btn-success" type="submit">
                            Xác nhận đặt hàng
                        </button>

                        <a href="{{route('cart.index') }}" class="btn btn-outline-secondary">
                            Quay lại giỏ hàng
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Tóm tắt đơn hàng</h5>

                    <ul class="list-group mb-3">
                        @foreach ($cart as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold">{{ $item['name'] }}</div>
                                    <div class="text-muted small">
                                        {{ number_format($item['price'], 0, ',', '.') }} d {{ $item['qty'] }}
                                    </div>
                                </div>
                                <div class="fw-bold">
                                    {{number_format($item['price'] * $item['qty'], 0, ',', '.') }} ₫
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold">Tổng cộng</span>
                        <span class="text-danger fw-bold">
                            {{number_format($total, 0,',','.') }} ₫
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection