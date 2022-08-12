<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KainController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::group(['middleware' => ['auth', 'level:1,2']], function () {
    // User
    Route::get('/users/dataAjax', [UsersController::class, 'dataAjax']);
    Route::resource('/users', UsersController::class);

    // Route::get('/users', [UsersController::class, 'index']);
    // Route::post('/users/store', [UsersController::class, 'store']);
    // Route::post('/users/{id}/update', [UsersController::class, 'update']);
    // Route::get('/users/{id}/destroy', [UsersController::class, 'destroy']);

    // Mesin
    Route::get('/mesin/dataAjax', [MesinController::class, 'dataAjax']);
    Route::resource('/mesin', MesinController::class);

    Route::get('/kain/dataAjax', [KainController::class, 'dataAjax']);
    Route::resource('/kain', KainController::class);

    // Laporan Produksi
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak']);
});


Route::group(['middleware' => ['auth', 'level:3,4']], function () {
    // Jadwal Produksi
    Route::get('/jadwal/dataAjax', [JadwalController::class, 'dataAjax']);
    Route::resource('/jadwal', JadwalController::class);

    // Data Produksi
    Route::get('/produksi/dataAjax', [ProduksiController::class, 'dataAjax']);
    Route::resource('/produksi', ProduksiController::class);
});
