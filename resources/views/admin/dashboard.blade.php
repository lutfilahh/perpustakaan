@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#2563eb,#0ea5e9);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:.85rem;opacity:.85;">Total Buku</div>
                    <div style="font-size:2rem;font-weight:700;">{{ $totalBuku }}</div>
                </div>
                <i class="bi bi-book-fill" style="font-size:2.5rem;opacity:.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#16a34a,#22c55e);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:.85rem;opacity:.85;">Buku Tersedia</div>
                    <div style="font-size:2rem;font-weight:700;">{{ $bukuTersedia }}</div>
                </div>
                <i class="bi bi-check-circle-fill" style="font-size:2.5rem;opacity:.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#dc2626,#f87171);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:.85rem;opacity:.85;">Sedang Dipinjam</div>
                    <div style="font-size:2rem;font-weight:700;">{{ $bukuDipinjam }}</div>
                </div>
                <i class="bi bi-bookmark-fill" style="font-size:2.5rem;opacity:.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#d97706,#fbbf24);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div style="font-size:.85rem;opacity:.85;">Menunggu Approval</div>
                    <div style="font-size:2rem;font-weight:700;">{{ $pending }}</div>
                </div>
                <i class="bi bi-hourglass-split" style="font-size:2.5rem;opacity:.5;"></i>
            </div>
        </div>
    </div>
</div>

{{-- Recent Peminjaman --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Permintaan Peminjaman Terbaru</h6>
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPeminjaman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $p->nama_peminjam }}</td>
                        <td>
                            @foreach($p->detailPeminjaman as $d)
                                <span class="badge bg-light text-dark border">{{ $d->buku->judul ?? '-' }}</span>
                            @endforeach
                        </td>
                        <td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>
                        <td>
                            <span class="badge badge-{{ $p->status_peminjaman }} px-2 py-1">
                                {{ ucfirst($p->status_peminjaman) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada peminjaman</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection