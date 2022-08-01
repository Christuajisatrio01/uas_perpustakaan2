<?php

use App\Http\Controllers\API\mahasiswaController;
use App\Http\Controllers\API\pinjamController;
use App\Http\Controllers\API\bukuController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// tidak perlu login dengan barear access token untuk mengakses :
Route::group(['prefix'=>'v1'], function($router){
    // untuk tabel mahasiswa
    Route::get('mahasiswa', [mahasiswaController::class, 'index']);
    Route::get('mahasiswa/{id}', [mahasiswaController::class, 'show']);
    Route::post('mahasiswa', [mahasiswaController::class, 'store']);
    Route::put('mahasiswa/{id}', [mahasiswaController::class, 'update']);
    Route::delete('mahasiswa/{id}', [mahasiswaController::class, 'destroy']);
    // tes relasi antar tabel
    Route::get('relasi-mahasiswa', [mahasiswaController::class, 'indexRelasi']);
});

//perlu login
Route::group(['middleware' => 'auth:api', 'prefix'=>'v1'], function ($router) {
    // untuk tabel orders
    Route::get('pinjam', [pinjamController::class, 'index']);
    Route::get('pinjam/{id}', [pinjamController::class, 'show']);
    Route::post('pinjam', [pinjamController::class, 'store']);
    Route::put('pinjam/{id}', [pinjamController::class, 'update']);
    Route::delete('pinjam/{id}', [pinjamController::class, 'destroy']);
    //tes relasi antar tabel
    Route::get('relasi-pinjam', [pinjamController::class, 'relasi_pinjam']);

    // untuk tabel products
    Route::get('buku', [bukuController::class, 'index']);
    Route::get('buku/{id}', [bukuController::class, 'show']);
    Route::post('buku', [bukuController::class, 'store']);
    Route::put('buku/{id}', [bukuController::class, 'update']);
    Route::delete('buku/{id}', [bukuController::class, 'destroy']);
    //tes relasi antar tabel
    Route::get('relasi-buku', [bukuController::class, 'indexRelasi']);
});

Route::group(['middleware' => 'api'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
   
    Route::get('password', function () {
        return bcrypt('satrio123');
    });
    
});