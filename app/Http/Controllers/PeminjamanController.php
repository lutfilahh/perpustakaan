<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    // Form peminjaman
    public function formPinjam($id_buku)
    {
        $buku = Buku::where('id_buku', $id_buku)
            ->where('status', 'tersedia')
            ->firstOrFail();

        return view('user.pinjam', compact('buku'));
    }

    // Proses submit peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'  => 'required|string|max:100',
            'kontak'         => 'required|string|max:20',
            'alamat'         => 'required|string|max:255',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date|before:today',
            'foto_identitas' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'id_buku'        => 'required|exists:buku,id_buku',
        ], [
            'nama_peminjam.required'  => 'Nama wajib diisi.',
            'kontak.required'         => 'Nomor kontak wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'tempat_lahir.required'   => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required'  => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'    => 'Tanggal lahir tidak valid.',
            'foto_identitas.required' => 'Kartu identitas wajib diunggah.',
            'foto_identitas.mimes'    => 'Format file harus jpg, jpeg, atau png.',
            'foto_identitas.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $buku = Buku::where('id_buku', $request->id_buku)
            ->where('status', 'tersedia')
            ->firstOrFail();

        // Upload foto identitas
        $fotoPath = $request->file('foto_identitas')
            ->store('identitas', 'public');

        $sudahAda = DetailPeminjaman::whereHas('peminjaman', function ($q) {
            $q->where('status_peminjaman', 'pending');
        })->where('id_buku', $request->id_buku)->exists();

        if ($sudahAda) {
            return back()->with('error', 'Buku ini sedang menunggu persetujuan peminjaman lain. Coba lagi nanti.');
        }

        // Upload foto identitas
        $fotoPath = $request->file('foto_identitas')
            ->store('identitas', 'public');

        // ─── Generate kode unik ───────────────────────────
        $kode = $this->generateKodeUnik();
        // ─────────────────────────────────────────────────

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create([
            'kode_peminjaman'  => $kode,           
            'nama_peminjam'    => $request->nama_peminjam,
            'kontak'           => $request->kontak,
            'alamat'           => $request->alamat,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'foto_identitas'   => $fotoPath,
            'tanggal_pinjam'   => now()->toDateString(),
            'status_peminjaman'=> 'pending',
            'id_admin'         => null,
        ]);

        // Simpan detail peminjaman
        DetailPeminjaman::create([
            'id_peminjaman' => $peminjaman->id_peminjaman,
            'id_buku'       => $buku->id_buku,
            'jumlah'        => 1,
        ]);

        // ─── Redirect ke halaman sukses dengan kode ──────
        return redirect()->route('user.pinjam.sukses', [
            'kode' => $kode
        ]);
        // ─────────────────────────────────────────────────
    }

    // Halaman sukses setelah submit
    public function sukses(Request $request)
    {
        $kode = $request->query('kode');

        if (!$kode) {
            return redirect()->route('user.dashboard');
        }

        $peminjaman = Peminjaman::with('detailPeminjaman.buku')
            ->where('kode_peminjaman', $kode)
            ->firstOrFail();

        return view('user.sukses', compact('peminjaman', 'kode'));
    }

    // Halaman form cek status
    public function formCekStatus()
    {
        return view('user.cek-status');
    }

    // Proses cek status
    public function cekStatus(Request $request)
    {
        $request->validate([
            'kode_peminjaman' => 'required|string',
        ], [
            'kode_peminjaman.required' => 'Kode peminjaman wajib diisi.',
        ]);

        $peminjaman = Peminjaman::with('detailPeminjaman.buku')
            ->where('kode_peminjaman', strtoupper(trim($request->kode_peminjaman)))
            ->first();

        if (!$peminjaman) {
            return back()
                ->withInput()
                ->with('error', 'Kode peminjaman tidak ditemukan. Periksa kembali kode Anda.');
        }

        return view('user.hasil-status', compact('peminjaman'));
    }

    // ─── Helper: Generate kode unik ──────────────────────
    private function generateKodeUnik(): string
    {
        do {
            // Format: PJM-YYYYMMDD-XXXX (contoh: PJM-20260507-A3F2)
            $kode = 'PJM-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        } while (Peminjaman::where('kode_peminjaman', $kode)->exists());

        return $kode;
    }
    // ─────────────────────────────────────────────────────
}