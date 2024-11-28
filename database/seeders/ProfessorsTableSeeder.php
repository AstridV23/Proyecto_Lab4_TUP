<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Professor;

class ProfessorsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Professor::create([
                'name' => $faker->name,
                'specialization' => $faker->randomElement(['Matemáticas', 'Física', 'Programación', 'Base de Datos', 'Redes']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
