<?php

namespace Database\Seeders;

use App\Models\Associa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssociaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Associa::insert([
            [
                'activity_id' => 1,
                'client_id' => 1
            ]
        ]);
    }
}
