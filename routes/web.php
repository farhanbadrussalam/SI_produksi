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

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/login', [LoginController::class, 'index']);

Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/dataAjax', [UsersController::class, 'dataAjax']);

Route::get('/mesin', [MesinController::class, 'index']);
Route::get('/mesin/dataAjax', [MesinController::class, 'dataAjax']);

Route::get('/jadwal', [JadwalController::class, 'index']);
Route::get('/jadwal/dataAjax', [JadwalController::class, 'dataAjax']);

Route::get('/produksi', [ProduksiController::class, 'index']);
Route::get('/produksi/dataAjax', [ProduksiController::class, 'dataAjax']);
