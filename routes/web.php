<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/calcoloSaldo', [\App\Http\Controllers\FrontController::class, 'calcoloSaldo'])->name('calcoloSaldo');

Route::get('/migrate', function (){
//    \Illuminate\Support\Facades\Artisan::call('migrate --path=/database/migrations/2023_09_17_203300_add_descrizione_to_table.php');
//    \Illuminate\Support\Facades\Artisan::call('migrate --path=/database/migrations/2022_04_27_193446_add_giorno_to_primanota.php');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('inizio');

    //-------------------------- USER -------------------------------//
    Route::get('/listaOperatori', [\App\Http\Controllers\UserController::class, 'listaOperatori'])->name('user.listaOperatori');
    Route::get('/presenzeOperatore', [\App\Http\Controllers\UserController::class, 'presenzeOperatore'])->name('user.presenzeOperatore');
    Route::get('/associaOperatoreOre', [\App\Http\Controllers\UserController::class, 'associaOperatoreOre'])->name('user.associaOperatoreOre');

    //-------------------------- CAR -------------------------------//
    Route::get('/listaVetture', [\App\Http\Controllers\CarController::class, 'listaVetture'])->name('car.listaVetture');

    //-------------------------- CLIENT -------------------------------//
    Route::get('/listaClienti', [\App\Http\Controllers\ClientController::class, 'listaClienti'])->name('client.listaClienti');
    Route::get('/associaAttivitaClienti', [\App\Http\Controllers\ClientController::class, 'associaAttivitaClienti'])->name('client.associaAttivitaClienti');
    Route::get('/presenzeAttivita', [\App\Http\Controllers\ClientController::class, 'presenzeAttivita'])->name('client.presenzeAttivita');

    //-------------------------- ACTIVITY -------------------------------//
    Route::get('/listaAttivita', [\App\Http\Controllers\ActivityController::class, 'listaAttivita'])->name('activity.listaAttivita');

    //-------------------------- TRIP -------------------------------//
    Route::get('/inserisciChilometri', [\App\Http\Controllers\TripController::class, 'inserisciChilometri'])->name('trip.inserisciChilometri');

    //-------------------------- LOG -------------------------------//
    Route::get('/log', [\App\Http\Controllers\LogController::class, 'listaLog'])->name('log.listaLog');

    //-------------------------- AGRICOLTURA -------------------------------//
    Route::get('/agricoltura', [\App\Http\Controllers\AgricolturaController::class, 'agricoltura'])->name('agricoltura');

    //-------------------------- RICEVUTE -------------------------------//
    Route::get('/ricevute', [\App\Http\Controllers\RicevutaController::class, 'ricevute'])->name('ricevute');

    //-------------------------- STATISTICHE -------------------------------//
    Route::get('/statistiche/presenzeClienti', [\App\Http\Controllers\StatisticheController::class, 'presenzeClienti'])->name('statistiche.presenzeClienti');
    Route::get('/statistiche/presenzeOperatori', [\App\Http\Controllers\StatisticheController::class, 'presenzeOperatori'])->name('statistiche.presenzeOperatori');
    Route::get('/statistiche/chilometriVetture', [\App\Http\Controllers\StatisticheController::class, 'chilometriVetture'])->name('statistiche.chilometriVetture');
    Route::get('/statistiche/chilometriClienti', [\App\Http\Controllers\StatisticheController::class, 'chilometriClienti'])->name('statistiche.chilometriClienti');

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
