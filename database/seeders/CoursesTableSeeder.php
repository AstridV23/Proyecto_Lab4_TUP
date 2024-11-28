<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Course;
use App\Models\Subject;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            for ($i = 0; $i < 3; $i++) {
                Course::create([
                    'name' => $subject->name . ' - Curso ' . ($i + 1),
                    'subject_id' => $subject->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
