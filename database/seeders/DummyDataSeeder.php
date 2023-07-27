<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;


class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Doctor::create([
                'name' => 'Doctor ' . $i,
                'email' => 'doctor' . $i . '@example.com',
                'password' => bcrypt('password'),
                'phone' => '123456789' . $i,
                'speciality' => 'skin',
                'room' => $i,
                'image' => 'dummy.jpg',
            ]);
        }
    }
}
