<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*Route::get('/test', function () {
    \Illuminate\Support\Facades\Mail::raw('Email di test inviata da Laravel con Aruba SMTP', function ($message) {
        $message->to('coltrida@gmail.com') // Sostituisci con un'email valida
        ->subject('Test SMTP Aruba');
    });
});*/

Route::get('/create-sheet', [\App\Http\Controllers\GoogleDriveController::class, 'createSheet']);
Route::get('/write-sheet', [\App\Http\Controllers\GoogleDriveController::class, 'writeToSheet'])->name('scriviSheet');

Route::get('/calcoloSaldo', [\App\Http\Controllers\FrontController::class, 'calcoloSaldo'])->name('calcoloSaldo');
Route::get('/calendario', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');

Route::get('/migrate', function (){
//    \Illuminate\Support\Facades\Artisan::call('migrate --path=/database/migrations/2023_09_17_203300_add_descrizione_to_table.php');
    \Illuminate\Support\Facades\Artisan::call('migrate --path=/database/migrations/2025_01_25_171823_create_appuntamentos_table.php');
});

Route::get('/eseguiCache', function (){
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('route:cache');
    \Illuminate\Support\Facades\Artisan::call('view:cache');
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
    Route::post('/statistiche/stampaPresenzeClienti', [\App\Http\Controllers\StatisticheController::class, 'stampaPresenzeClienti'])->name('statistiche.stampaPresenzeClienti');
    Route::get('/statistiche/presenzeOperatori', [\App\Http\Controllers\StatisticheController::class, 'presenzeOperatori'])->name('statistiche.presenzeOperatori');
    Route::get('/statistiche/chilometriVetture', [\App\Http\Controllers\StatisticheController::class, 'chilometriVetture'])->name('statistiche.chilometriVetture');
    Route::get('/statistiche/chilometriClienti', [\App\Http\Controllers\StatisticheController::class, 'chilometriClienti'])->name('statistiche.chilometriClienti');

});






Route::get('/dashboard', function () {
    return \Illuminate\Support\Facades\Redirect::route('inizio');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
