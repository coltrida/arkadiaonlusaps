<?php

namespace Database\Seeders;

use App\Models\AttivitaCliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttivitaCliente::insert([
            [
                'activity_id' => 4,
                'client_id' => 1,
                'quantita' => 1,
                'costo' => 10,
                'giorno' => '2025/01/29',
                'mese' => '1',
                'anno' => '2025',
            ],
            [
                'activity_id' => 4,
                'client_id' => 1,
                'quantita' => 2,
                'costo' => 20,
                'giorno' => '2025/01/28',
                'mese' => '1',
                'anno' => '2025',
            ],
        ]);
    }
}
