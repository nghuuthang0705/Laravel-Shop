@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')
    <h2 class="mb-4">Sửa sản phẩm # {{ $product->id }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="card card-body shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Tên sản phẩm</label>
        <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
    </div>

    <div class="mb-3">
    <label class="form-label">Giá (VND)</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" min="0" required>
    </div>

    <div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="mb-3">
    <label class="form-label">Link ảnh (URL)</label>
    <input name="image" class="form-control" value="{{ old('image', $product->image) }}">
    </div>

    <button class="btn btn-primary" type="submit">Lưu</button>
    <a href="{{route('admin.products.index') }}" class="btn btn-link">Quay lại</a>
    </form>

@endsection