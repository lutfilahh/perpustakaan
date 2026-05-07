@extends('layouts.app')

@section('title', 'Peminjaman Berhasil Dikirim')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card text-center p-4" style="border-radius:20px;">

            {{-- Animasi centang --}}
            <div class="mb-3" style="font-size:4rem;">🎉</div>
            <h4 class="fw-bold mb-1">Permintaan Terkirim!</h4>
            <p class="text-muted mb-4">
                Permintaan peminjaman <strong>{{ $peminjaman->detailPeminjaman->first()->buku->judul ?? '' }}</strong>
                telah dikirim ke admin.
            </p>

            {{-- Kotak Kode Unik --}}
            <div class="p-4 mb-4" style="background:#f0f9ff;border:2px dashed #2563eb;border-radius:16px;">
                <p class="text-muted small mb-2 fw-semibold text-uppercase letter-spacing">
                    🔑 Kode Peminjaman Anda
                </p>
                <div id="kodeText"
                    style="font-size:1.8rem;font-weight:800;letter-spacing:.2rem;color:#1d4ed8;font-family:monospace;">
                    {{ $kode }}
                </div>
                <button onclick="salinKode()" id="btnSalin"
                    class="btn btn-sm btn-outline-primary mt-3">
                    <i class="bi bi-clipboard me-1"></i>Salin Kode
                </button>
            </div>

            {{-- Peringatan simpan kode --}}
            <div class="alert alert-warning text-start small mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Penting!</strong> Simpan kode ini baik-baik.
                Kode digunakan untuk mengecek status peminjaman kapan saja.
            </div>

            {{-- Info timeline --}}
            <div class="text-start mb-4">
                <p class="fw-semibold mb-2 small text-muted text-uppercase">Status Saat Ini</p>
                <div class="d-flex align-items-center gap-3 p-3"
                    style="background:#fff7ed;border-radius:12px;border:1px solid #fed7aa;">
                    <span style="font-size:1.5rem;">⏳</span>
                    <div>
                        <div class="fw-semibold">Menunggu Persetujuan Admin</div>
                        <div class="text-muted small">Diajukan {{ now()->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column gap-2">
                <a href="{{ route('user.cek-status') }}"
                    class="btn btn-primary">
                    <i class="bi bi-search me-2"></i>Cek Status Peminjaman
                </a>
                <a href="{{ route('user.dashboard') }}"
                    class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Buku
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function salinKode() {
    const kode = document.getElementById('kodeText').innerText;
    navigator.clipboard.writeText(kode).then(() => {
        const btn = document.getElementById('btnSalin');
        btn.innerHTML = '<i class="bi bi-check-lg me-1"></i>Tersalin!';
        btn.classList.replace('btn-outline-primary', 'btn-success');
        setTimeout(() => {
            btn.innerHTML = '<i class="bi bi-clipboard me-1"></i>Salin Kode';
            btn.classList.replace('btn-success', 'btn-outline-primary');
        }, 2000);
    });
}
</script>
@endpush
@endsection