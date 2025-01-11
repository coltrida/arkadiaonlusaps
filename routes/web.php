<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('inizio');

    //-------------------------- USER -------------------------------//
    Route::get('/listaOperatori', [\App\Http\Controllers\UserController::class, 'listaOperatori'])->name('user.listaOperatori');
    Route::get('/presenzeOperatore', [\App\Http\Controllers\UserController::class, 'presenzeOperatore'])->name('user.presenzeOperatore');

    //-------------------------- CAR -------------------------------//
    Route::get('/listaVetture', [\App\Http\Controllers\CarController::class, 'listaVetture'])->name('car.listaVetture');

    //-------------------------- CLIENT -------------------------------//
    Route::get('/listaClienti', [\App\Http\Controllers\ClientController::class, 'listaClienti'])->name('client.listaClienti');

    //-------------------------- ACTIVITY -------------------------------//
    Route::get('/listaAttivita', [\App\Http\Controllers\ActivityController::class, 'listaAttivita'])->name('activity.listaAttivita');


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
