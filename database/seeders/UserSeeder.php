<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ulices',
                'last_name' => 'Ochoa',
                'email' => 'ulisesochoap@gmail.com',
                'identification' => '1037631738',
                'address' => 'Calle 123, Bogotá',
                'phone' => '3114023094',
                'city_id' => 1,
                'is_boss' => false,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Maria',
                'last_name' => 'Gómez',
                'email' => 'maria.gomez@example.com',
                'identification' => '987654321',
                'address' => 'Avenida Siempre Viva, Medellín',
                'phone' => '3109876543',
                'city_id' => 2,
                'is_boss' => true,
                'password' => Hash::make('securePassword'),
            ],
            [
                'name' => 'Carlos',
                'last_name' => 'Rodríguez',
                'email' => 'carlos.rodriguez@example.com',
                'identification' => '1122334455',
                'address' => 'Carrera 45, Cali',
                'phone' => '3201122334',
                'city_id' => 3,
                'is_boss' => false,
                'password' => Hash::make('myPassword123'),
            ],
        ]);
    }
}
