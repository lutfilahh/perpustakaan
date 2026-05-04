@extends('layouts.app')

@section('title', 'Daftar Buku — Perpustakaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">📚 Koleksi Buku</h3>
        <p class="text-muted mb-0">Temukan buku yang ingin Anda pinjam</p>
    </div>
</div>

{{-- Filter & Search --}}
<form method="GET" class="row g-2 mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control"
                placeholder="Cari judul, penulis, penerbit..."
                value="{{ request('search') }}">
        </div>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-filter me-1"></i>Filter
        </button>
    </div>
</form>

{{-- Daftar Buku --}}
@if($buku->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-search" style="font-size:3rem;color:#94a3b8;"></i>
        <p class="text-muted mt-3">Tidak ada buku ditemukan.</p>
    </div>
@else
    <div class="row g-3">
        @foreach($buku as $b)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span style="font-size:2.5rem;">📖</span>
                        <span class="badge-{{ $b->status }}">
                            {{ $b->status === 'tersedia' ? '✅ Tersedia' : '🔴 Dipinjam' }}
                        </span>
                    </div>
                    <h6 class="fw-bold mb-1 mt-1">{{ $b->judul }}</h6>
                    <p class="text-muted small mb-1">
                        <i class="bi bi-person me-1"></i>{{ $b->penulis }}
                    </p>
                    <p class="text-muted small mb-1">
                        <i class="bi bi-building me-1"></i>{{ $b->penerbit }}
                    </p>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar me-1"></i>{{ $b->tahun_terbit }}
                    </p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('user.buku.detail-buku', $b->id_buku) }}"
                            class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="bi bi-eye me-1"></i>Detail
                        </a>
                        @if($b->status === 'tersedia')
                        <a href="{{ route('user.pinjam.form', $b->id_buku) }}"
                            class="btn btn-primary btn-sm flex-fill">
                            <i class="bi bi-bookmark-plus me-1"></i>Pinjam
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $buku->withQueryString()->links() }}
    </div>
@endif
@endsection