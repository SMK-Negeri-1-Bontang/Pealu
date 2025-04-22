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

Route::get('/home', function () {
    return view('home');
});

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/berita', function () {
    return view('layouts.berita.berita');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk Alumni
Route::resource('alumni', AlumniController::class);
Route::get('/alumni/pdf/{id}', [AlumniController::class, 'generatePdf'])->name('alumni.invoice');
Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');

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

// ATAU jika hanya butuh index
Route::get('/Pengajar', [\App\Http\Controllers\PengajarController::class, 'index'])->name('pengajar.index');

// Route khusus untuk invoice
Route::get('/pengajar/invoice/{id}', [PengajarController::class, 'invoice'])->name('pengajar.invoice');

// Lowongan
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/tmblowongan', [LowonganController::class, 'create'])->name('lowongan.create');
Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
Route::get('/lowongan/{id}', [LowonganController::class, 'show'])->name('lowongan.show');
Route::get('/lowongan/{id}/edit', [LowonganController::class, 'edit'])->name('lowongan.edit');
Route::put('/lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');
Route::delete('/lowongan/{id}/delete', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
