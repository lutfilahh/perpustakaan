@extends('layouts.admin')

@section('title', 'Manajemen Peminjaman')
@section('page-title', 'Manajemen Peminjaman')

@section('content')
{{-- Filter Status --}}
<div class="d-flex gap-2 mb-3">
    @foreach(['', 'pending', 'disetujui', 'ditolak'] as $s)
    <a href="{{ route('admin.peminjaman.index', $s ? ['status' => $s] : []) }}"
        class="btn btn-sm {{ request('status') === $s || (!request('status') && $s === '') ? 'btn-primary' : 'btn-outline-secondary' }}">
        {{ $s === '' ? 'Semua' : ucfirst($s) }}
    </a>
    @endforeach
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama Peminjam</th>
                        <th>Kontak</th>
                        <th>Buku Dipinjam</th>
                        <th>Tgl Pinjam</th>
                        <th>Identitas</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $p)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration + ($peminjaman->currentPage()-1)*$peminjaman->perPage() }}</td>
                        <td>
                            <div class="fw-semibold">{{ $p->nama_peminjam }}</div>
                            <div class="text-muted small">{{ $p->alamat }}</div>
                        </td>
                        <td>{{ $p->kontak }}</td>
                        <td>
                            @foreach($p->detailPeminjaman as $d)
                                <div class="badge bg-light text-dark border">{{ $d->buku->judul ?? '-' }}</div>
                            @endforeach
                        </td>
                        <td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>  
                        <td>
                            <a href="{{ asset('storage/' . $p->foto_identitas) }}" target="_blank"
                                class="btn btn-sm btn-outline-info">
                                <i class="bi bi-image me-1"></i>Lihat
                            </a>
                        </td>
                        <td>
                            @php
                                $badgeClass = match($p->status_peminjaman) {
                                    'pending'   => 'badge-pending',
                                    'disetujui' => 'badge-disetujui',
                                    'ditolak'   => 'badge-ditolak',
                                    default     => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} px-2 py-1 fw-semibold">
                                {{ ucfirst($p->status_peminjaman) }}
                            </span>
                            @if($p->status_peminjaman === 'disetujui' && $p->tanggal_kembali)
                                <div class="text-muted small mt-1">
                                    Kembali: {{ $p->tanggal_kembali->format('d M Y') }}
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($p->status_peminjaman === 'pending')
                                <form action="{{ route('admin.peminjaman.setujui', $p->id_peminjaman) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success me-1"
                                        onclick="return confirm('Setujui peminjaman ini?')">
                                        <i class="bi bi-check-lg me-1"></i>Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.peminjaman.tolak', $p->id_peminjaman) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Tolak peminjaman ini?')">
                                        <i class="bi bi-x-lg me-1"></i>Tolak
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada data peminjaman
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $peminjaman->withQueryString()->links() }}</div>
    </div>
</div>
@endsection