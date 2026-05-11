@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="mb-4 text-center">Đăng nhập</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <form action="{{ route('login') }}" method="POST" class="card card-body shadow-sm">
                @csrf

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

                <button type="submit" class="btn btn-primary w-100">
                    Đăng nhập
                </button>

                <p class="mt-3 text-center">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}">Đăng ký ngay</a>
                </p>
            </form>
        </div>
    </div>

@endsection