@foreach($peminjaman as $p)
<div class="card mb-3">
    <div class="card-body">
        <h5>{{ $p->buku->judul }}</h5>

        <span class="badge
            @if($p->status_peminjaman == 'pending') bg-warning text-dark
            @elseif($p->status_peminjaman == 'disetujui') bg-success
            @elseif($p->status_peminjaman == 'ditolak') bg-danger
            @elseif($p->status_peminjaman == 'dikembalikan') bg-info text-dark
            @endif">

            {{ ucfirst($p->status_peminjaman) }}
        </span>
    </div>
</div>
@endforeach