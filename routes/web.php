<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('home', ['title' => 'Home | Lumen-K']);
});


// Rute otomatis untuk CRUD (index, create, store, edit, update, destroy)
Route::resource('kategori', KategoriController::class);
Route::resource('alat', AlatController::class);
Route::resource('pelanggan', PelangganController::class);