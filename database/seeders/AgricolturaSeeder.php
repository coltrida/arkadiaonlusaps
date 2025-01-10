<?php

namespace Database\Seeders;

use App\Models\Agricoltura;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Psy\Util\Str;

class AgricolturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataOggi = Carbon::now();

        for ($i=1; $i<40; $i++){
            $giorno = $dataOggi->addDays($i);

            $mese = $giorno->month;
            $anno = $giorno->year;
            $settimana = $giorno->week;

            Agricoltura::create([
                'user_id' => 1,
                'settimana' => $settimana,
                'mese' => $mese,
                'anno' => $anno,
                'giorno' => $giorno->format('d/m/Y'),
                'tipo' => Arr::random(['P', 'A']),
            ]);
        }
    }
}
