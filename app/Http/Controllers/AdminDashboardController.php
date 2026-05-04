<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Admin;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBuku       = Buku::count();
        $bukuTersedia    = Buku::where('status', 'tersedia')->count();
        $bukuDipinjam    = Buku::where('status', 'dipinjam')->count();
        $totalPeminjaman = Peminjaman::count();
        $pending         = Peminjaman::where('status_peminjaman', 'pending')->count();
        $disetujui       = Peminjaman::where('status_peminjaman', 'disetujui')->count();
        $ditolak         = Peminjaman::where('status_peminjaman', 'ditolak')->count();

        $recentPeminjaman = Peminjaman::with('detailPeminjaman.buku')
            ->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBuku', 'bukuTersedia', 'bukuDipinjam',
            'totalPeminjaman', 'pending', 'disetujui', 'ditolak',
            'recentPeminjaman'
        ));
    }

    // Daftar peminjaman 
    public function peminjaman(Request $request)
    {
        $query = Peminjaman::with('detailPeminjaman.buku');

        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        $peminjaman = $query->latest()->paginate(10);

        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    // Setujui peminjaman
    public function setujui($id)
    {
        $peminjaman = Peminjaman::with('detailPeminjaman.buku')->findOrFail($id);

        if ($peminjaman->status_peminjaman !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $peminjaman->update([
            'status_peminjaman' => 'disetujui',
            'tanggal_kembali'   => now()->addDays(7)->toDateString(),
            'id_admin'          => session('admin_id'),
        ]);

        foreach ($peminjaman->detailPeminjaman as $detail) {
            $detail->buku->update(['status' => 'dipinjam']);
        }

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    // Tolak peminjaman
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_peminjaman !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $peminjaman->update([
            'status_peminjaman' => 'ditolak',
            'id_admin'          => session('admin_id'),
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    } 
}