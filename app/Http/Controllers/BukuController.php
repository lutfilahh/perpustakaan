<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->paginate(10);
        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:200',
            'penulis'     => 'required|string|max:100',
            'penerbit'    => 'required|string|max:100',
            'tahun_terbit'=> 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        Buku::create([
            'judul'        => $request->judul,
            'penulis'      => $request->penulis,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'status'       => 'tersedia',
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul'        => 'required|string|max:200',
            'penulis'      => 'required|string|max:100',
            'penerbit'     => 'required|string|max:100',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'status'       => 'required|in:tersedia,dipinjam',
        ]);

        $buku->update($request->only([
            'judul', 'penulis', 'penerbit',
            'tahun_terbit', 'status'
        ]));

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}