<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TambahBeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HomeController;

// Halaman utama
Route::get('/', function () {
    return view('beranda');
});
Route::get('/tentangsmkn1', function () {
    return view('tentangsmkn1');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/alumni', function () {
    return view('alumni');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk Alumni
Route::resource('alumni', AlumniController::class);
Route::get('/alumni/pdf/{id}', [AlumniController::class, 'invoice'])->name('alumni.invoice');

// Rute untuk Berita
Route::resource('tmbberita', TambahBeritaController::class);
Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');

// Rute User (Bisa diakses tanpa login)
Route::resource('user', UserController::class);

// Proteksi hanya untuk fitur tertentu
Route::middleware(['role:admin,petugas'])->group(function () {
    // Rute untuk User (Hanya admin dan petugas)
});

// Auth Routes (Tetap ada untuk fitur login/register)
Auth::routes();
