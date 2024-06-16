<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\produkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('beranda');
});

Route::get('/produk', [produkController::class, 'index']);
Route::post('/tambah-produk', [produkController::class, 'store']);
Route::post('/beli-produk/{id}', [produkController::class, 'beli']);
Route::post('/edit-produk/{id}', [produkController::class, 'edit']);
Route::post('/hapus-produk/{id}', [produkController::class, 'hapus']);
Route::get('/login', [authController::class, 'login']);
Route::get('/register', [authController::class, 'register']);
Route::post('/post-regis', [authController::class, 'post_regist']);
Route::post('/post-login', [authController::class, 'post_login']);
Route::post('/logout', [authController::class, 'logout']);