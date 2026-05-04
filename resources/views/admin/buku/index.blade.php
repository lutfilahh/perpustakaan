@extends('layouts.admin')

@section('title', 'Kelola Buku')
@section('page-title', 'Kelola Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Total: <strong>{{ $buku->total() }}</strong> buku</p>
    <a href="{{ route('admin.buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Buku
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku as $b)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration + ($buku->currentPage()-1)*$buku->perPage() }}</td>
                        <td class="fw-semibold">{{ $b->judul }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tahun_terbit }}</td>
                        <td>
                            <span class="badge {{ $b->status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.buku.edit', $b->id_buku) }}"
                                class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.buku.destroy', $b->id_buku) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus buku ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4 text-muted">Belum ada buku</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $buku->links() }}</div>
    </div>
</div>
@endsection