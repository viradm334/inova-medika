<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\JenisKunjunganController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TindakanController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('/obat', ObatController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/tindakan', TindakanController::class);
    Route::resource('/jeniskunjungan', JenisKunjunganController::class);
    Route::get('/kunjungan', [AdminController::class, 'kunjungans']);
});

// Petugas Pendaftaran
Route::middleware(['auth', 'role:Petugas Pendaftaran'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
    Route::get('/pendaftaran-pasien', [PendaftaranController::class, 'create']);
    Route::post('/pendaftaran-pasien', [PendaftaranController::class, 'store']);
    Route::get('/detail-pendaftaran/{id}', [PendaftaranController::class, 'show']);
});

// Dokter
Route::middleware(['auth', 'role:Dokter'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index']);
    Route::get('/resep', [DokterController::class, 'resepobattindakan']);
    Route::post('/resep', [DokterController::class, 'store']);
    Route::post('/checkin', [DokterController::class, 'checkin']);
    Route::get('/arsip', [DokterController::class, 'arsipkunjungan']);
});

// Kasir
Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index']);
    Route::get('/payment/{id}', [KasirController::class, 'paymentpage']);
    Route::post('/pay', [KasirController::class, 'pay']);
});

// Auth
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Home
Route::get('/', [GuestController::class, 'index'])->middleware('guest');
