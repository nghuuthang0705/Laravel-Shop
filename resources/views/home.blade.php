@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <div id="homeCarousel" class="carousel slide mb-4" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner rounded-3 shadow-sm">

            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x350?text=Laravel+Shop+Mini"
                    class="d-block w-100"
                    alt="Laravel Shop">
                <div class="carousel-caption d-none d-md-block text-start">
                    <h5>Chào mừng đến Laravel Shop mini</h5>
                    <p>Website bán hàng đơn giản được xây dựng trong series 5 video Laravel. </p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x350?text=San+pham+noi+bat"
                    class="d-block w-100"
                    alt="Sản phẩm nổi bật">
                <div class="carousel-caption d-none d-md-block text-start">
                    <h5>Sản phẩm nổi bật</h5>
                    <p>Hiển thị danh sách sản phẩm từ database bằng Eloquent Model. </p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x350?text=Dang+nhap+de+dat+hang"
                    class="d-block w-100"
                    alt="Đang nhap đe đặt hàng">
                <div class="carousel-caption d-none d-md-block text-start">
                    <h5>Đăng nhập để đặt hàng</h5>
                    <p>Đăng ký tài khoản, đăng nhập và trải nghiệm chức năng giỏ hàng, đặt hàng. </p>
                </div>
            </div>

        </div>

        {{-- Nút điều hướng trái/phải --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Trước</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Tiếp</span>
        </button>

    </div>

    {{-- PHẦN 2: GRID SẢN PHẨM --}}

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Sản phẩm mới nhất</h4>
        @guest
            <small class="text-muted">
                <a href="{{route('login') }}">Đăng nhập</a> hoặc
                <a href="{{ route('register') }}">Đăng ký</a> để đặt hàng.
            </small>
        @endguest

        @auth
            <small class="text-muted">
                Xin chào, <strong>{{ Auth::user()->name }}</strong>
            </small>
        @endauth
    </div>

    @if ( $products->isEmpty() )
        <div class="alert alert-info">
            Chưa có sản phẩm nào. Hãy thêm dữ liệu vào bảng <strong>products</strong> hoặc chạy seeder.
        </div>

    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">

                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="card-img-top"
                                alt="{{ $product->name }}">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1">
                                {{ Str :: limit($product->name, 40) }}
                            </h6>

                            <p class="card-text text-danger fw-bold mb-1">
                                    {{ number_format($product->price, 0, ',','.') }} đ
                            </p>

                            <p class="card-text text-muted small flex-grow-1 mb-2">
                                    {{ Str :: limit($product->description, 60) }}
                            </p>

                            {{-- Nút tạm thời disabled, video sau sẽ làm chi tiết + giỏ hàng --}}
                            <button class="btn btn-sm btn-outline-primary mt-auto" disabled>
                                Xem chi tiết (sau)
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    @endif


@endsection