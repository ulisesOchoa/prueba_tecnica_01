<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountySeeder::class,
            CitySeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            UserSeeder::class
//            EmployeePositionSeeder::class,
        ]);
    }
}
