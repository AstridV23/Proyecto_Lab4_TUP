<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class Course_studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todos los IDs de estudiantes y cursos existentes
        $studentIds = \App\Models\Student::pluck('id')->toArray();
        $courseIds = \App\Models\Course::pluck('id')->toArray();

        // Para cada estudiante, asignar 1-3 cursos aleatorios
        foreach ($studentIds as $studentId) {
            // Seleccionar aleatoriamente entre 1 y 3 cursos para cada estudiante
            $randomCourses = array_rand(array_flip($courseIds), rand(1, 3));
            
            // Si solo se seleccionó un curso, convertirlo en array
            if (!is_array($randomCourses)) {
                $randomCourses = [$randomCourses];
            }

            // Crear las relaciones
            foreach ($randomCourses as $courseId) {
                DB::table('course_student')->insert([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
