<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Buku;

class UserController extends Controller
{
    //Dasboard User
    public function dashboard(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $buku = $query->latest()->paginate(12);
        return view('user.dashboard', compact('buku'));
    }

    //Detail Buku
    public function detailBuku($id)
    {
        $buku = Buku::findOrFail($id);
        return view('user.detail-buku', compact('buku'));
    }
}