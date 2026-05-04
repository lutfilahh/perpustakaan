<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --accent: #f59e0b;
        }
        body { background: #f8fafc; font-family: 'Segoe UI', sans-serif; }
        .navbar-brand { font-weight: 700; font-size: 1.4rem; color: var(--primary) !important; }
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,.08); }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .badge-tersedia { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-size: .8rem; font-weight: 600; }
        .badge-dipinjam { background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 20px; font-size: .8rem; font-weight: 600; }
        .card { border: none; box-shadow: 0 2px 12px rgba(0,0,0,.06); border-radius: 12px; transition: transform .2s; }
        .card:hover { transform: translateY(-3px); }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">
            <i class="bi bi-book-fill me-2"></i>Perpustakaan
        </a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-shield-lock me-1"></i>Keluar
            </a>
        </div>
    </div>
</nav>

<main class="container pb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>