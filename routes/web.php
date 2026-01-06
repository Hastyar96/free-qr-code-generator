<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\BarcodeController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/qr',[QrCodeController::class,'index'])->name('qr.index');
Route::post('/qr/generate',[QrCodeController::class,'generate'])->name('qr.generate');
Route::post('/qr/download',[QrCodeController::class,'download'])->name('qr.download');


Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode.index');
Route::post('/barcode/generate', [BarcodeController::class, 'generate'])->name('barcode.generate');
Route::post('/barcode/download', [BarcodeController::class, 'download'])->name('barcode.download');
