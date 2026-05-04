@extends('layouts.app')

@section('title', $buku->judul . ' — Perpustakaan')

@section('content')
<a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary btn-sm mb-4">
    <i class="bi bi-arrow-left me-1"></i>Kembali
</a>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <span style="font-size:4rem;">📚</span>
                <span class="badge-{{ $buku->status }} fs-6">
                    {{ $buku->status === 'tersedia' ? '✅ Tersedia' : '🔴 Sedang Dipinjam' }}
                </span>
            </div>

            <h2 class="fw-bold mb-3">{{ $buku->judul }}</h2>

            <table class="table table-borderless">
                <tr><td class="text-muted" width="140">Penulis</td><td class="fw-semibold">{{ $buku->penulis }}</td></tr>
                <tr><td class="text-muted">Penerbit</td><td class="fw-semibold">{{ $buku->penerbit }}</td></tr>
                <tr><td class="text-muted">Tahun Terbit</td><td class="fw-semibold">{{ $buku->tahun_terbit }}</td></tr>
            </table>

            @if($buku->status === 'tersedia')
                <a href="{{ route('user.pinjam.form', $buku->id_buku) }}"
                    class="btn btn-primary btn-lg mt-2">
                    <i class="bi bi-bookmark-plus me-2"></i>Pinjam Buku Ini
                </a>
            @else
                <div class="alert alert-warning mt-2">
                    <i class="bi bi-clock-history me-2"></i>
                    Buku ini sedang dipinjam. Silakan cek kembali nanti.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection