<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TambahBeritaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::resource('alumni', App\Http\Controllers\AlumniController::class);

//Route::get('/alumni/pdf/{id}', [AlumniController::class, 'create'])->name('alumni.create');
Route::get('/alumni/pdf/{id}', [AlumniController::class, 'invoice'])->name('alumni.invoice');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Route untuk Berita
Route::resource('tmbberita', App\Http\Controllers\TambahBeritaController::class);


