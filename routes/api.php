<?php

use App\Http\Controllers\newListController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\stokBarangController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/qrcode', [QrCodeController::class, 'index']);
Route::post('/qrcode', [QrCodeController::class, 'store']);
Route::post('/StokBarang', [stokBarangController::class, 'store']);
Route::post('/listTransaksi', [newListController::class, 'store']);
Route::get('/qrcode/{BarCode}', [QrCodeController::class, 'show']);

Route::post('/Transaksi', [TransaksiController::class, 'store']);
