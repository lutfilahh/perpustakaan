@extends('layouts.app')

@section('title', 'Hasil Cek Status')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        {{-- Header status --}}
        @php
            $status = $peminjaman->status_peminjaman;
            $config = match($status) {
                'pending'   => ['emoji' => '⏳', 'label' => 'Menunggu Persetujuan', 'bg' => '#fff7ed', 'border' => '#fed7aa', 'text' => '#92400e'],
                'disetujui' => ['emoji' => '✅', 'label' => 'Disetujui', 'bg' => '#f0fdf4', 'border' => '#86efac', 'text' => '#166534'],
                'ditolak'   => ['emoji' => '❌', 'label' => 'Ditolak', 'bg' => '#fff1f2', 'border' => '#fecdd3', 'text' => '#9f1239'],
                default     => ['emoji' => '❓', 'label' => ucfirst($status), 'bg' => '#f8fafc', 'border' => '#e2e8f0', 'text' => '#475569'],
            };
        @endphp

        <div class="card mb-4" style="border-radius:20px;border:2px solid {{ $config['border'] }}; background:{{ $config['bg'] }};">
             <div class="card-body text-center p-4">
                <div style="font-size:3.5rem;margin-bottom:.5rem;">{{ $config['emoji'] }}</div>
                    <h4 class="fw-bold" style="color:{{ $config['text'] }};">{{ $config['label'] }}</h4>
                        <div style="font-family:monospace;font-size:.95rem;color:{{ $config['text'] }};opacity:.7;">
                            {{ $peminjaman->kode_peminjaman }}
                        </div>
                </div>
            </div>
        </div>

        {{-- Detail peminjaman --}}
        <div class="card p-4" style="border-radius:16px;">
            <h6 class="fw-bold mb-3 text-muted text-uppercase small">Detail Peminjaman</h6>

            <div class="mb-3 p-3" style="background:#f8fafc;border-radius:12px;">
                <div class="small text-muted mb-1">Buku yang Dipinjam</div>
                @foreach($peminjaman->detailPeminjaman as $detail)
                    <div class="fw-bold">📖 {{ $detail->buku->judul ?? '-' }}</div>
                    <div class="text-muted small">{{ $detail->buku->penulis ?? '' }}</div>
                @endforeach
            </div>

            <table class="table table-borderless table-sm mb-0">
                <tr>
                    <td class="text-muted" style="width:140px;">Nama Peminjam</td>
                    <td class="fw-semibold">{{ $peminjaman->nama_peminjam }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Tanggal Pinjam</td>
                    <td class="fw-semibold">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                </tr>

                @if($status === 'disetujui')
                <tr>
                    <td class="text-muted">Tanggal Kembali</td>
                    <td class="fw-semibold text-danger">
                        {{ $peminjaman->tanggal_kembali?->format('d M Y') ?? '-' }}
                    </td>
                </tr>
                @endif
            </table>

            {{-- Pesan khusus per status --}}
            @if($status === 'disetujui')
                <div class="alert alert-success small mt-3 mb-0">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Selamat!</strong> Peminjaman kamu disetujui.
                    Silakan ambil buku di perpustakaan dan kembalikan sebelum
                    <strong>{{ $peminjaman->tanggal_kembali?->format('d M Y') }}</strong>.
                </div>
            @elseif($status === 'ditolak')
                <div class="alert alert-danger small mt-3 mb-0">
                    <i class="bi bi-x-circle-fill me-2"></i>
                    <strong>Permintaan ditolak.</strong>
                    Silakan hubungi petugas perpustakaan untuk informasi lebih lanjut.
                </div>
            @elseif($status === 'pending')
                <div class="alert alert-warning small mt-3 mb-0">
                    <i class="bi bi-hourglass-split me-2"></i>
                    Permintaanmu sedang ditinjau admin. Cek kembali beberapa saat lagi.
                </div>
            @endif
        </div>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('user.cek-status') }}" class="btn btn-outline-primary flex-fill">
                <i class="bi bi-arrow-repeat me-1"></i>Cek Kode Lain
            </a>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary flex-fill">
                <i class="bi bi-house me-1"></i>Beranda
            </a>
        </div>

    </div>
</div>
@endsection