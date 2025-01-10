<?php

namespace App\Services;

use App\Models\Trip;
use Carbon\Carbon;

class TripService
{
    public function listaTuttiViaggi()
    {
        return Trip::with('user', 'car')->latest()->paginate(5);
    }

    public function inserisciViaggio($request)
    {
        $trip = Trip::create([
            'kmPercorsi' => $request->kmPercorsi,
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'giorno' => $request->giorno,
            'mese' => Carbon::make($request->giorno)->month,
            'anno' => Carbon::make($request->giorno)->year
        ]);

        $trip->clients()->attach($request->clients);

        return $trip;
    }

    public function elimina($id)
    {
        Trip::find($id)->delete();
    }
}
