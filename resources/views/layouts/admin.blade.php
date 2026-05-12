<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Laravel Shop')</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
        min-height: 100vh;
    }
    .admin-sidebar {
        min-height: 100vh;
    }
    </style>
</head>

<body>
        {{-- Top Navbar --}}
        <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        Admin Panel
                    </a>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light me-3">
                            Về trang Home
                        </a>

                        <span class="text-light me-3">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </span>

                        <form action="{{ route('logout') }}" method="POST" class="mb-0">
                            @csrf
                                <button class="btn btn-sm btn-outline-light" type="submit">
                                    Đăng xuất
                                </button>
                        </form>
                 </div>
                </div>
        </nav>

        {{-- Layout 2 cột: sidebar trái + content phải --}}
        <div class="container-fluid">
            <div class="row">
                {{-- Sidebar --}}
                <aside class="col-12 col-md-3 col-lg-2 bg-light border-end admin-sidebar p-3">
                    <h6 class="text-uppercase text-muted mb-3">Menu admin</h6>
                    <ul class="nav nav-pills flex-column gap-1">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" 
                            class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                            Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" 
                                class="nav-link @if(request()->routeIs('admin.products.*')) active @endif">
                                Quản lý sản phẩm
                            </a>
                        </li>
                        {{-- Sau này có thể thêm: Đơn hàng, User, ... --}}
                    </ul>
                </aside>

                {{-- Nội dung chính --}}
                <main class="col-12 col-md-9 col-lg-10 p-4">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>

</body> 
</html>