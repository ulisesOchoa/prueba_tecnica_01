<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Cundinamarca', 'city_id' => 1],
            ['name' => 'Antioquia', 'city_id' => 2],
            ['name' => 'Valle del Cauca', 'city_id' => 3],
            ['name' => 'Ciudad de México', 'city_id' => 4],
            ['name' => 'Buenos Aires', 'city_id' => 5],
        ]);
    }
}
