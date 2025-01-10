<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Barbara Coltrioli',
                'role' => 1,
                'email' => 'admin@admin.it',
                'oresettimanali' => 38,
                'oresaldo' => 1976,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'cacao',
                'role' => 0,
                'email' => 'cacao@cacao.it',
                'oresettimanali' => 12,
                'oresaldo' => 11,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'cacao2',
                'role' => 0,
                'email' => 'cacao2@cacao.it',
                'oresettimanali' => 14,
                'oresaldo' => 116,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'cacao3',
                'role' => 0,
                'email' => 'cacao3@cacao.it',
                'oresettimanali' => 13,
                'oresaldo' => 113,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'cacao4',
                'role' => 0,
                'email' => 'cacao4@cacao.it',
                'oresettimanali' => 14,
                'oresaldo' => 114,
                'password' => Hash::make('123456')
            ],
        ]);
    }
}
