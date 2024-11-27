<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use App\Models\Subject;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Crear materias primero
        $subjects = [
            ['name' => 'Matemáticas'],
            ['name' => 'Programación'],
            ['name' => 'Base de Datos'],
            ['name' => 'Algoritmos'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }

        // Crear cursos asociados a materias
        $courses = [
            ['name' => 'Matemáticas Avanzadas', 'subject_id' => 1],
            ['name' => 'Programación Web', 'subject_id' => 2],
            ['name' => 'Base de Datos I', 'subject_id' => 3],
            ['name' => 'Algoritmos I', 'subject_id' => 4],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Crear estudiantes de prueba
        $students = [
            ['name' => 'Ana García', 'email' => 'ana@example.com'],
            ['name' => 'Pedro López', 'email' => 'pedro@example.com'],
            ['name' => 'María Rodríguez', 'email' => 'maria@example.com'],
            ['name' => 'Juan Pérez', 'email' => 'juan@example.com'],
            ['name' => 'Andrea Martínez', 'email' => 'andrea@example.com'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
