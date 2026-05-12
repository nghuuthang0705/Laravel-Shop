@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="mb-3">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <- Quay lại trang chủ
        </a>
    </div>

    <div class="row g-4">
        {{-- Ảnh sản phẩm --}}
        <div class="col-md-5">
            <div class="card shadow-sm">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/800x600?text=No+Image"
                         class="card-img-top" alt="No Image">
                @endif
            </div>
        </div>

        {{-- Thông tin --}}
        <div class="col-md-7">
            <h2 class="mb-2">{{$product->name}}</h2>

            <div class="mb-3">
                <span class="badge text-bg-success">Còn hàng</span>
                <span class="ms-2 text-muted small">
                    Mã SP: #{{ $product->id }}
                </span>
            </div>

            <h4 class="text-danger fw-bold mb-3">
                {{ number_format($product->price, 0, ',','.') }} ₫
            </h4>

            <div class="mb-4">
                <h6 class="text-muted">Mô tả</h6>
                    <p class="mb-0">
                        {{ $product->description ?: 'Chưa có mô tả cho sản phẩm nay.' }}
                    </p>
            </div>

            {{-- Nút giỏ hàng (để video sau làm) --}}
            @auth
                <button button clas="btn btn-primary me-2" disabled>
                    Thêm vào giỏ hàng (Video sau)
                </button>
            @endauth

            @guest
                <a href="{{route('login') }}" class="btn btn-primary me-2">
                    Đăng nhập để mua
                </a>
            @endguest

            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                Tiếp tục xem sản phẩm
            </a>
        </div>
    </div>

    {{-- Sản phẩm liên quan --}}
    @if ($relatedProducts->isNotEmpty())
        <hr class="my-5">

        <h4 class="mb-3">Sản phẩm khác</h4>

        <div class="row">
            @foreach ($relatedProducts as $p)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($p->image)
                            <img src="{{ $p->image }}" class="card-img-top" alt="{{ $p->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="mb-1">{{ $p->name }}</h6>
                            <p class="text-danger fw-bold mb-2">
                                {{ number_format($p->price, 0, ',', '.') }} ₫
                            </p>
                            <a href="{{route('products.show', $p) }}" class="btn btn-sm btn-outline-primary mt-auto">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection 