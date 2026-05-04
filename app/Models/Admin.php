<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
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

    protected $casts = [
        'password' => 'hashed'
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
