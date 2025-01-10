<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            [
                'name' => 'pippo'
            ],
            [
                'name' => 'pluto'
            ],
            [
                'name' => 'topolino'
            ],
            [
                'name' => 'pippo1'
            ],
            [
                'name' => 'pluto1'
            ],
            [
                'name' => 'topolino1'
            ],
            [
                'name' => 'pippo2'
            ],
            [
                'name' => 'pluto2'
            ],
            [
                'name' => 'topolino2'
            ],
            [
                'name' => 'pippo5'
            ],
            [
                'name' => 'pluto5'
            ],
            [
                'name' => 'topolino5'
            ],
            [
                'name' => 'pippo6'
            ],
            [
                'name' => 'pluto6'
            ],
            [
                'name' => 'topolino6'
            ],
        ]);
    }
}
