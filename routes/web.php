<?php

use App\Http\Controllers\CustomerpdfController;
use App\Http\Controllers\PaymentpdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/{record}/view', [CustomerpdfController::class, 'view'])->name('CustomPackage.pdf.view');
Route::get('/{record}/pdf', [CustomerpdfController::class, 'pdf'])->name('CustomPackage.pdf.download');

Route::get('/{record}/voucher', [PaymentpdfController::class, 'view'])->name('voucher.pdf.voucher');
Route::get('/{record}/download', [PaymentpdfController::class, 'pdf'])->name('voucher.pdf.download');
