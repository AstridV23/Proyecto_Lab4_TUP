<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
public function run()
{
$this->call([
SubjectsTableSeeder::class,
CoursesTableSeeder::class,
ProfessorsTableSeeder::class,
StudentSeeder::class,
Course_studentSeeder::class,
CommissionsTableSeeder::class,
]);
}
}
