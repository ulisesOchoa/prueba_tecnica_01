<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Bogotá', 'country_id' => 1],
            ['name' => 'Medellín', 'country_id' => 1],
            ['name' => 'Cali', 'country_id' => 1],
            ['name' => 'Ciudad de México', 'country_id' => 2],
            ['name' => 'Buenos Aires', 'country_id' => 3],
        ]);
    }
}
