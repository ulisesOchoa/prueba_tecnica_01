<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'first_name' => 'Juan',
                'last_name' => 'Pérez',
                'identification' => '123456789',
                'address' => 'Calle 123',
                'phone' => '3001234567',
                'city_id' => 1,
            ],
            [
                'first_name' => 'María',
                'last_name' => 'González',
                'identification' => '987654321',
                'address' => 'Calle 456',
                'phone' => '3007654321',
                'city_id' => 2,
            ],
        ]);
    }
}
