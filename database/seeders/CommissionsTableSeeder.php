<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CommissionsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $courseIds = Course::pluck('id')->toArray();

        if (empty($courseIds)) {
            $this->command->error('Se necesitan registros en la tabla "courses" para poblar "commissions".');
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            DB::table('commissions')->insert([
                'aula' => 'Aula ' . $faker->numberBetween(1, 100),
                'horario' => $faker->time('H:i') . ' - ' . $faker->time('H:i'),
                'course_id' => $faker->randomElement($courseIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}