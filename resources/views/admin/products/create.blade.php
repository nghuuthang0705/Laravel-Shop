@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <h2 class="mb-4">Thêm sản phẩm</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="card card-body shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá (VND)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-text">Chọn ảnh .jpg/.png/.webp... (tối đa 2MB)</div>
        </div>

        <button class="btn btn-primary" type="submit">Luu</button>
            <a href="{{route('admin.products.index') }}" class="btn btn-link">Quay lại</a>
    </form>

@endsection