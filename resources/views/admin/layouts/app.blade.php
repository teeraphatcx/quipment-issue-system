<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'ระบบแอดมิน')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">ระบบแอดมิน</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> แดชบอร์ด
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.issues.index')) active @endif" href="{{ route('admin.issues.index') }}">
                        <i class="bi bi-list-check"></i> รายการแจ้งปัญหา
                    </a>
                </li>
                {{-- เพิ่มเมนูอื่น ๆ ได้ที่นี่ --}}
            </ul>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">ออกจากระบบ</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
