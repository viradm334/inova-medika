<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TindakanController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AdminController::class, 'index']);
Route::resource('/obat', ObatController::class);
Route::resource('/user', UserController::class);
Route::resource('/tindakan', TindakanController::class);
Route::get('/kasir', [KasirController::class, 'index']);

// Petugas Pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/pendaftaran-pasien', [PendaftaranController::class, 'create']);
Route::post('/pendaftaran-pasien', [PendaftaranController::class, 'store']);
Route::get('/detail-pendaftaran/{id}', [PendaftaranController::class, 'show']);

// Dokter
Route::get('/dokter', [DokterController::class, 'index']);
Route::get('/resep', [DokterController::class, 'resepobattindakan']);
Route::post('/resep', [DokterController::class, 'store']);
Route::get('/checkin', [DokterController::class, 'checkinpage']);
Route::post('/checkin', [DokterController::class, 'checkin']);

// Auth
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
