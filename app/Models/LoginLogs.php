<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLogs extends Model
{
    protected $table = 'login_logs';
    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_admin',
        'waktu_login',
        'status_login',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
