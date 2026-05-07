<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f1f5f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            width: 250px; min-height: 100vh; background: #1e293b;
            position: fixed; top: 0; left: 0; z-index: 100;
            padding-top: 1rem; transition: all .3s;
        }
        .sidebar .brand { color: #f8fafc; font-size: 1.2rem; font-weight: 700; padding: 1rem 1.5rem 1.5rem; border-bottom: 1px solid #334155; }
        .sidebar .nav-link { color: #94a3b8; padding: .6rem 1.5rem; border-radius: 0; transition: all .2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #f8fafc; background: #334155; }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 250px; padding: 1.5rem 2rem; min-height: 100vh; }
        .topbar { background: #fff; border-radius: 12px; padding: .8rem 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.05); display: flex; align-items: center; justify-content: space-between; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
        .stat-card { border-radius: 16px; padding: 1.5rem; color: #fff; border: none; }
        .badge-pending   { background: #fef3c7; color: #92400e; }
        .badge-disetujui { background: #dcfce7; color: #166534; }
        .badge-ditolak   { background: #fee2e2; color: #991b1b; }
        .badge-dikembalikan { background: #dbeafe; color: #2563eb; }
    </style>
    @stack('styles')
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="brand"><i class="bi bi-book-fill me-2"></i>Admin Panel</div>
    <nav class="nav flex-column mt-3">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.buku.index') }}" class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
            <i class="bi bi-book me-2"></i> Kelola Buku
        </a>
        <a href="{{ route('admin.peminjaman.index') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check me-2"></i> Peminjaman
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <div>
            <h5 class="mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted"><i class="bi bi-person-circle me-1"></i>{{ session('admin_nama') }}</span>
            <form action="{{ route('admin.logout') }}" method="POST" class="mb-0">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>