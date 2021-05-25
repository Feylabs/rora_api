<?php

use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\KaryawanController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/penggajian',[PenggajianController::class,'index']);
Route::post('/penggajian', [PenggajianController::class,'store']);
Route::delete('/penggajian/{Penggajian:id}', [PenggajianController::class,'destroy']);
Route::put('/penggajian/{Penggajian:id}', [PenggajianController::class,'update']);

// Karyawan
Route::get('/karyawan',[KaryawanController::class,'index']);
Route::get('//karyawan/{DataKaryawan:id}',[KaryawanController::class,'show']);
Route::post('/karyawan', [KaryawanController::class,'store']);
Route::put('/karyawan/{DataKaryawan:id}', [KaryawanController::class,'update']);
Route::delete('/karyawan/{DataKaryawan:id}', [KaryawanController::class,'destroy']);