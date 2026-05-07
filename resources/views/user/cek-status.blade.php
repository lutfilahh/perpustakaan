@extends('layouts.app')

@section('title', 'Cek Status Peminjaman')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="text-center mb-4">
            <div style="font-size:3rem;">🔍</div>
            <h3 class="fw-bold mt-2">Cek Status Peminjaman</h3>
            <p class="text-muted">Masukkan kode yang kamu terima saat mengajukan peminjaman</p>
        </div>

        <div class="card p-4">
            @if(session('error'))
                <div class="alert alert-danger small mb-3">
                    <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.cek-status.post') }}" method="POST">
                @csrf
                <label class="form-label fw-semibold">Kode Peminjaman</label>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-key text-primary"></i>
                    </span>
                    <input
                        type="text"
                        name="kode_peminjaman"
                        class="form-control @error('kode_peminjaman') is-invalid @enderror"
                        placeholder="Contoh: PJM-20260507-A3F2"
                        value="{{ old('kode_peminjaman') }}"
                        style="font-family:monospace;font-size:1rem;letter-spacing:.05rem;"
                        autocomplete="off"
                        required>
                    @error('kode_peminjaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Cek Status Sekarang
                </button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Kode diberikan setelah kamu mengajukan peminjaman
                </small>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('user.dashboard') }}" class="text-muted small">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke daftar buku
            </a>
        </div>
    </div>
</div>
@endsection