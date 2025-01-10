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

    public function inserisci($nomeVettura)
    {
        Car::insert([
            'name' => $nomeVettura
        ]);
    }
}
