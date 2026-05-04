@extends('layouts.app')

@section('title', 'Form Peminjaman — Perpustakaan')

@section('content')
<a href="{{ route('user.buku.detail-buku', $buku->id_buku) }}" class="btn btn-outline-secondary btn-sm mb-4">
    <i class="bi bi-arrow-left me-1"></i>Kembali
</a>

<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Info Buku -->
        <div class="card mb-4 border-primary" style="border-width:2px !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <span style="font-size:2.5rem;">📖</span>
                <div>
                    <div class="fw-bold fs-5">{{ $buku->judul }}</div>
                    <div class="text-muted small">{{ $buku->penulis }} · {{ $buku->penerbit }}</div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Data Peminjam</h5>

                <form action="{{ route('user.pinjam.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror"
                                value="{{ old('nama_peminjam') }}" placeholder="Masukkan nama lengkap" required>
                            @error('nama_peminjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor Kontak <span class="text-danger">*</span></label>
                            <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                                value="{{ old('kontak') }}" placeholder="08xxxxxxxxxx" required>
                            @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                rows="2" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                value="{{ old('tempat_lahir') }}" placeholder="Kota tempat lahir" required>
                            @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required>
                            @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Upload Kartu Identitas <span class="text-danger">*</span></label>
                            <input type="file" name="foto_identitas" class="form-control @error('foto_identitas') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png" required>
                            <div class="form-text"><i class="bi bi-info-circle me-1"></i>Format: JPG, JPEG, PNG. Maks: 2MB</div>
                            @error('foto_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        Setelah submit, permintaan peminjaman akan ditinjau oleh admin.
                        Status awal: <strong>Menunggu Persetujuan</strong>.
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-send me-2"></i>Kirim Permintaan Peminjaman
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection