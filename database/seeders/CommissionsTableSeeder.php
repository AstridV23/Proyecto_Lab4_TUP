<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Professor;


class CommissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $courseIds = Course::pluck('id')->toArray();
        $professorIds = Professor::pluck('id')->toArray();

        if (empty($courseIds) || empty($professorIds)) {
            $this->command->error('Se necesitan registros en las tablas "courses" y "professors".');
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            // Crear la comisión
            $commissionId = DB::table('commissions')->insertGetId([
                'aula' => 'Aula ' . $faker->numberBetween(1, 100),
                'horario' => $faker->time('H:i') . ' - ' . $faker->time('H:i'),
                'course_id' => $faker->randomElement($courseIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Asignar 1-3 profesores aleatorios a la comisión
            $randomProfessors = array_rand(array_flip($professorIds), rand(1, 3));
            if (!is_array($randomProfessors)) {
                $randomProfessors = [$randomProfessors];
            }

            foreach ($randomProfessors as $professorId) {
                DB::table('commission_professor')->insert([
                    'commission_id' => $commissionId,
                    'professor_id' => $professorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
