<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none; border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
            max-width: 420px; width: 100%; padding: 2.5rem;
        }
        .form-control {
            border-radius: 10px; border: 2px solid #e2e8f0;
            padding: .7rem 1rem; transition: border .2s;
        }
        .form-control:focus { border-color: #2563eb; box-shadow: none; }
        .btn-login {
            background: linear-gradient(135deg, #1e3a5f, #2563eb);
            color: #fff; border: none; border-radius: 10px;
            padding: .8rem; font-weight: 600; width: 100%;
            font-size: 1rem; transition: opacity .2s;
        }
        .btn-login:hover { opacity: .9; color: #fff; }
        label { font-weight: 500; color: #374151; font-size: .9rem; }
        .back-link { color: #6b7280; font-size: .85rem; }
    </style>
</head>
<body>
    <div class="card">
        <div class="text-center mb-4">
            <div style="width:60px;height:60px;background:linear-gradient(135deg,#1e3a5f,#2563eb);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.8rem;color:#fff;">
                <i class="bi bi-shield-fill-check"></i>
            </div>
            <h4 class="fw-bold mb-1">Login Admin</h4>
            <p class="text-muted small">Masukkan kredensial Anda</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2 mb-3 small">
                <i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email">Email</label>
                <div class="input-group mt-1">
                    <span class="input-group-text rounded-start-3 border-end-0 bg-white border-2">
                        <i class="bi bi-envelope text-muted"></i>
                    </span>
                    <input type="email" name="email" id="email"
                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="admin@perpustakaan.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="password">Password</label>
                <div class="input-group mt-1">
                    <span class="input-group-text rounded-start-3 border-end-0 bg-white border-2">
                        <i class="bi bi-lock text-muted"></i>
                    </span>
                    <input type="password" name="password" id="password"
                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                        placeholder="••••••••" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="back-link">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke halaman utama
            </a>
        </div>
    </div>
</body>
</html>