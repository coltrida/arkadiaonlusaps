<?php

namespace Database\Seeders;

use App\Models\Appuntamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppuntamentiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appuntamento::insert([
            [
                'startDate' => '2025-01-12',
                'endDate' => '2025-01-12',
                'user_id' => 1,
                'titolo' => 'primo appuntamento'
            ],
            [
                'startDate' => '2025-01-21',
                'endDate' => '2025-01-22',
                'user_id' => 1,
                'titolo' => 'secondo appuntamento'
            ],
        ]);
    }
}
