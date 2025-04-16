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
Route::get('/dokter', [DokterController::class, 'index']);
Route::get('/kasir', [KasirController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);

// Auth
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
