@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <h3 class="mb-4 text-center">Đăng ký tài khoản</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="card card-body shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input
                    type="text"
                        id="name"
                        name="name"
                    value="{{ old('name') }}"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    required
                >
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    required
                >
            </div>

            <button type="submit" class="btn btn-success w-100">
                Đăng ký
            </button>

            <p class="mt-3 text-center">
                Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập</a>
            </p>
        </form>
    </div>
</div>
@endsection