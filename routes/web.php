<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('inizio');

Route::middleware(['auth'])->group(function () {
    //-------------------------- USER -------------------------------//
    Route::get('/listaOperatori', [\App\Http\Controllers\UserController::class, 'listaOperatori'])->name('user.listaOperatori');
});






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
