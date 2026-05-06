<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminDashboardController;

// ─────────────────────────────────────────────
// HALAMAN UTAMA — Pilih Role
// ─────────────────────────────────────────────
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// ─────────────────────────────────────────────
// ROUTES USER (Tanpa Login)
// ─────────────────────────────────────────────
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/buku/{id}', [UserController::class, 'detailBuku'])->name('buku.detail-buku');
    Route::get('/pinjam/{id_buku}', [PeminjamanController::class, 'formPinjam'])->name('pinjam.form');
    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');
});

// ─────────────────────────────────────────────
// ROUTES ADMIN AUTH
// ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    
    // ─────────────────────────────────────────
    // ROUTES ADMIN (Perlu Login)
    // ─────────────────────────────────────────
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Buku (CRUD)
        Route::resource('buku', BukuController::class);
        Route::resource('buku', BukuController::class)->except(['show']);

        // Manajemen Peminjaman
        Route::get('/peminjaman', [AdminDashboardController::class, 'peminjaman'])->name('peminjaman.index');
        Route::post('/peminjaman/{id}/setujui', [AdminDashboardController::class, 'setujui'])->name('peminjaman.setujui');
        Route::post('/peminjaman/{id}/tolak', [AdminDashboardController::class, 'tolak'])->name('peminjaman.tolak');
        Route::post('/peminjaman/{id}/kembalikan', [AdminDashboardController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    });
});