<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_admin', 'id_admin');
    }

    public function loginLogs()
    {
        return $this->hasMany(LoginLogs::class, 'id_admin', 'id_admin');
    }
}
