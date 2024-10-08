<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('dokters', DokterController::class);
    Route::resource('konsultasis', KonsultasiController::class);

    Route::post('/konsultasis/{id}/accept', [KonsultasiController::class, 'accept'])->name('konsultasis.accept');
    Route::post('/konsultasis/{id}/deny', [KonsultasiController::class, 'deny'])->name('konsultasis.deny');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
