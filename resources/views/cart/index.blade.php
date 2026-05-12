@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Giỏ hàng</h2>
            <a href="{{route('home') }}" class="btn btn-outline-secondary btn-sm">Tiếp tục mua sắm</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (empty($cart))
        <div class="alert alert-info">
            Giỏ hàng đang trống.
        </div>
    @else

        <form action="{{ route('cart.update') }}" method="POST">
            @csrf

            <div class="table-responsive">

                <table class="table align-middle table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Sản phẩm</th>
                            <th style="width: 140px;">Giá</th>
                            <th style="width: 140px;">Số lượng</th>
                            <th style="width: 160px; ">Thành tiền</th>
                            <th style="width: 120px; ">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cart as $item)
                            <tr>
                                <td>
                                    <div class="d-flex gap-3 align-items-center">
                                        @if (!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                 alt="{{ $item['name'] }}"
                                                 style="width: 70px; height: 70px; object-fit: cover;">
                                        @else
                                            <img src="https://via.placeholder.com/70?text=No+Image"
                                                 alt="No Image">
                                        @endif

                                        <div>
                                            <div class="fw-semibold">{{ $item['name'] }}</div>
                                            <div class="text-muted small">#{{ $item['product_id'] }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-danger fw-bold">
                                    {{ number_format($item['price'], 0,',','.') }} ₫
                                </td>

                                <td>
                                    <input type="number"
                                        name="qty[{{ $item['product_id'] }}]"
                                        class="form-control";
                                        min="1";
                                        value="{{ $item['qty'] }}">
                                </td>

                                <td class="fw-bold">
                                    {{number_format($item['price'] *$item['qty'], 0,',','.') }} ₫
                                </td>

                                <td>
                                    <form action="{{route('cart.remove', $item['product_id']) }}" method="POST"
                                            onsubmit="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            Xoá
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                
                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <button class="btn btn-primary" type="submit">Cập nhật giỏ hàng</button>

                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Xóa toàn bộ giỏ hàng?');">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit">Xóa tất cả</button>
                    </form>
                </div>

                <div class="fs-5">
                    Tổng tiền:
                    <span class="text-danger fw-bold">
                        {{ number_format($total, 0,',','.') }} ₫
                    </span>
                </div>
            </div>
        </form>

        {{-- Nút đặt hàng: video sau --}}
        <div class="mt-4">
            @auth
                <a href="{{ route('checkout.show') }}" class="btn btn-success">
                    Thanh toán / Đặt hàng
                </a>
            @endauth

            @guest
                <a href="{{route('login') }}" class="btn btn-success">
                    Đăng nhập để đặt hàng
                </a>
            @endguest
        </div>

    @endif

@endsection