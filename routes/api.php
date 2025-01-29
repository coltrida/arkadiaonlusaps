<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('appuntamenti', [\App\Http\Controllers\api\CalendarController::class, 'getAppuntamenti']);
Route::post('salvaAppuntamento', [\App\Http\Controllers\api\CalendarController::class, 'salvaAppuntamento']);
