<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::insert([
            [
                'name' => 'calcio',
                'tipo' => 'mensile',
                'cost' => 100
            ],
            [
                'name' => 'tennis',
                'tipo' => 'mensile',
                'cost' => 50
            ],
            [
                'name' => 'nuoto',
                'tipo' => 'mensile',
                'cost' => 20
            ],
            [
                'name' => 'freccette',
                'tipo' => 'orario',
                'cost' => 2
            ],
            [
                'name' => 'pallavolo',
                'tipo' => 'mensile',
                'cost' => 30
            ],
            [
                'name' => 'lettura',
                'tipo' => 'orario',
                'cost' => 5
            ],
        ]);
    }
}
