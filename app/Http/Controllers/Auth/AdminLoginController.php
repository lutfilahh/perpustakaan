<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\LoginLogs;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ],
        [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id_admin,
                'admin_name' => $admin->nama,
            ]);

            LoginLogs::create([
                'id_admin' => $admin->id_admin,
                'waktu_login' => now(),
                'status_login' => 'success',
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, '.$admin->nama.'!');
    
    }

    //  Simpan Login Gagal
    if ($admin) {
        LoginLogs::create([
            'id_admin' => $admin->id_admin,
            'waktu_login' => now(),
            'status_login' => 'failed',
        ]);
    }
    
        return back()->with('error', 'Email atau password salah. Silakan coba lagi.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_name');
        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }
}
