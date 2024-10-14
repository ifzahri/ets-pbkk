<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('dokter', DokterController::class)->only(['index', 'store']);
    Route::resource('konsultasi', KonsultasiController::class);

    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/pasien/dashboard', [PasienController::class, 'index'])->name('pasien.index');

    Route::get('/dokter/konsultasi/{id}', [DokterController::class, 'show'])->name('dokter.show');
    Route::post('/dokter/konsultasi/{id}/medication', [DokterController::class, 'addMedication'])->name('dokter.addMedication');

    Route::post('/konsultasis/{id}/accept', [KonsultasiController::class, 'accept'])->name('konsultasis.accept');
    Route::post('/konsultasis/{id}/deny', [KonsultasiController::class, 'deny'])->name('konsultasis.deny');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
