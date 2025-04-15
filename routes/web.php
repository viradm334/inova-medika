<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObatController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AdminController::class, 'index']);
Route::resource('/obat', ObatController::class);
