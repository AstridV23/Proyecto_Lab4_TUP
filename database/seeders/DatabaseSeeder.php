<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
public function run()
{
$this->call([
StudentSeeder::class,
Course_studentSeeder::class,
CommissionsTableSeeder::class,
]);
}
}
