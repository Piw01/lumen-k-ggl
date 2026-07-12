<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

// 1. RUTE PUBLIK: Halaman depan pas baru dibuka (Landing Page / Login)
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. RUTE DASHBOARD STANDAR BREEZE (Bisa diakses semua role setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. RUTE PROTEKSI KETAT: BRIDGES COMMAND CENTER (Hanya Admin & Staff)
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    // Halaman Utama Analitik Kasir
    Route::get('/admin/status', [HomeController::class, 'index'])->name('home');
    
    // CRUD Resource Master Data
    Route::resource('kategori', KategoriController::class);
    Route::resource('alat', AlatController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);
    
    // Aksi Mengubah Status Transaksi
    Route::patch('transaksi/{id}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    // Menampilkan katalog alat yang ready
    Route::get('/katalog', [CustomerController::class, 'katalog'])->name('customer.katalog');
    
    // Eksekusi sewa alat
    Route::post('/sewa/{id}', [CustomerController::class, 'sewa'])->name('customer.sewa');
    
    // Melihat riwayat transaksi milik sendiri
    Route::get('/riwayat-sewa', [CustomerController::class, 'riwayat'])->name('customer.riwayat');
});

// 4. RUTE PENGATURAN PROFIL (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';