<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\TambahBeritaController;
use App\Http\Controllers\LowonganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;


// Halaman utama
// For the dashboard route
Route::get('/', [AlumniController::class, 'dashboard'])->name('alumni.dashboard');

Route::get('/tentangsmkn1', function () {
    return view('tentangsmkn1');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk Alumni
Route::resource('alumni', AlumniController::class);
Route::get('/alumni/pdf/{id}', [AlumniController::class, 'generatePdf'])->name('alumni.invoice');

// Rute untuk Berita
Route::resource('tmbberita', TambahBeritaController::class);
Route::get('/berita-tampilan', function () {
    $tmbberita = App\Models\TambahBerita::paginate(5);
    return view('layouts.berita.berita', compact('tmbberita'));
});

// Rute User (Bisa diakses tanpa login)
Route::resource('user', UserController::class);

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



// Proteksi hanya untuk fitur tertentu
Route::middleware(['role:admin,petugas'])->group(function () {
    // Rute untuk User (Hanya admin dan petugas)
});

// Auth Routes (Tetap ada untuk fitur login/register)
Auth::routes();

// Rute untuk Pengajar
Route::resource('pengajar', PengajarController::class);
Route::get('/pengajar-tampilan', function () {
    $pengajar = App\Models\Pengajar::paginate(5);
    return view('layouts.pengajar.tampilan', compact('pengajar'));
});