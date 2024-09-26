<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees_positions')->insert([
            ['employee_id' => 1, 'position_id' => 1],
            ['employee_id' => 2, 'position_id' => 2],
        ]);
    }
}
