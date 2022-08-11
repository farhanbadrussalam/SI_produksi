<?php

use App\Http\Controllers\JadwalController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::group(['middleware' => ['auth', 'level:1,2']], function () {
    // User
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/dataAjax', [UsersController::class, 'dataAjax']);
    Route::post('/users/store', [UsersController::class, 'store']);
    Route::post('/users/{id}/update', [UsersController::class, 'update']);
    Route::get('/users/{id}/destroy', [UsersController::class, 'destroy']);

    // Mesin
    Route::get('/mesin', [MesinController::class, 'index']);
    Route::get('/mesin/dataAjax', [MesinController::class, 'dataAjax']);

    // Laporan Produksi

});


Route::group(['middleware' => ['auth', 'level:3,4']], function () {
    // Jadwal Produksi
    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::get('/jadwal/dataAjax', [JadwalController::class, 'dataAjax']);

    // Data Produksi
    Route::get('/produksi', [ProduksiController::class, 'index']);
    Route::get('/produksi/dataAjax', [ProduksiController::class, 'dataAjax']);
});




