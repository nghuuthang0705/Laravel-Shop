@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Quản lý sản phẩm</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        + Thêm sản phẩm
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($products->isEmpty())

    <div class="alert alert-info">
        Chưa có sản phẩm nào.
    </div>

@else

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>Tên</th>
                    <th style="width:120px;">Giá</th>
                    <th style="width:100px;">Ảnh</th>
                    <th style="width:160px;">Tạo lúc</th>
                    <th style="width:180px;">Hành động</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($products as $product)

                    <tr>

                        <td>{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td>
                            {{ number_format($product->price, 0, ',', '.') }} đ
                        </td>

                        <td>
                            @if ($product->image)
                                <img
                                    src="{{ $product->image }}"
                                    alt="{{ $product->name }}"
                                    style="width:60px;height:60px;object-fit:cover;"
                                >
                            @endif
                        </td>

                        <td>
                            {{ $product->created_at?->format('d/m/Y H:i') }}
                        </td>

                        <td>

                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-sm btn-outline-secondary">
                                Sửa
                            </a>

                            <form
                                action="{{ route('admin.products.destroy', $product) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Bạn chắc chắn muốn xoá sản phẩm này?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                    Xóa
                                </button>
                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

@endif

@endsection