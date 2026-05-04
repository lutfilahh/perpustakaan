<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #0ea5e9 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: #fff; border-radius: 24px; padding: 3rem 2.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,.2); max-width: 420px; width: 100%;
            text-align: center;
        }
        .logo-wrap {
            width: 80px; height: 80px; background: linear-gradient(135deg, #2563eb, #0ea5e9);
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem; font-size: 2.5rem; color: #fff;
        }
        h1 { font-size: 1.6rem; font-weight: 700; color: #1e293b; margin-bottom: .4rem; }
        .subtitle { color: #64748b; margin-bottom: 2.5rem; font-size: .95rem; }
        .role-btn {
            display: flex; align-items: center; gap: 1rem; padding: 1.1rem 1.5rem;
            border-radius: 14px; border: 2px solid #e2e8f0; background: #fff;
            cursor: pointer; transition: all .2s; text-decoration: none; color: inherit;
            margin-bottom: 1rem; width: 100%;
        }
        .role-btn:hover { border-color: #2563eb; background: #eff6ff; transform: translateX(4px); }
        .role-btn .icon-wrap {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .role-user .icon-wrap { background: #dcfce7; color: #16a34a; }
        .role-admin .icon-wrap { background: #dbeafe; color: #2563eb; }
        .role-btn .label { font-weight: 600; color: #1e293b; margin-bottom: 2px; }
        .role-btn .desc { font-size: .8rem; color: #64748b; }
        .divider { display: flex; align-items: center; gap: 1rem; margin: 1.5rem 0; color: #94a3b8; font-size: .85rem; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

        @if(session('success'))
        .alert-flash { display: block; }
        @endif
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-wrap"><i class="bi bi-book-fill"></i></div>
        <h1>Perpustakaan Digital</h1>
        <p class="subtitle">Silakan pilih akses yang sesuai</p>

        @if(session('success'))
            <div class="alert alert-success py-2 mb-3" style="font-size:.9rem;">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            </div>
        @endif

        <a href="{{ route('user.dashboard') }}" class="role-btn role-user">
            <div class="icon-wrap"><i class="bi bi-person-fill"></i></div>
            <div class="text-start">
                <div class="label">Masuk sebagai Pengguna</div>
                <div class="desc">Jelajahi dan pinjam buku tanpa login</div>
            </div>
            <i class="bi bi-chevron-right ms-auto text-muted"></i>
        </a>

        <div class="divider">atau</div>

        <a href="{{ route('admin.login') }}" class="role-btn role-admin">
            <div class="icon-wrap"><i class="bi bi-shield-fill-check"></i></div>
            <div class="text-start">
                <div class="label">Masuk sebagai Admin</div>
                <div class="desc">Kelola buku dan permintaan peminjaman</div>
            </div>
            <i class="bi bi-chevron-right ms-auto text-muted"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>