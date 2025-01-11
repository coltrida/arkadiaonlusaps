<?php

namespace App\Services;

use App\Models\Car;

class CarService
{
    public function listaVetture()
    {
        return Car::orderBy('name')->get();
    }

    public function elimina($id)
    {
        $car = $carDaInviareALog = Car::find($id);
        $car->delete();
        return $carDaInviareALog;
    }

    public function inserisci($request)
    {
        Car::create($request->all());
    }

    public function modifica(Car $car, $request)
    {
        $car->name = $request->name;
        $car->save();
    }
}
