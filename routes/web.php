<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home | Lumen-K']);
});

use App\Http\Controllers\KategoriController;

// Rute otomatis untuk CRUD (index, create, store, edit, update, destroy)
Route::resource('kategori', KategoriController::class);
