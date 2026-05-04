<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_peminjaman';
    protected $table = 'peminjaman';

    protected $fillable = [
        'id_admin',
        'nama_peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'kontak',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'foto_identitas',
        'status_peminjaman',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_lahir' => 'date',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
