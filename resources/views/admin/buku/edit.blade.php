@extends('layouts.admin')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.buku.update', $buku->id_buku) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Judul Buku</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $buku->judul) }}" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Penulis</label>
                            <input type="text" name="penulis" class="form-control"
                                value="{{ old('penulis', $buku->penulis) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control"
                                value="{{ old('penerbit', $buku->penerbit) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control"
                                value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                min="1900" max="{{ date('Y') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status Buku</label>
                            <select name="status" class="form-select">
                                <option value="tersedia" {{ $buku->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="dipinjam" {{ $buku->status === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Update Buku
                        </button>
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection