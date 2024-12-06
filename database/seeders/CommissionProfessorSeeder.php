<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Commission;
use App\Models\Professor;

class CommissionProfessorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        $commissionIds = Commission::pluck('id')->toArray();
        $professorIds = Professor::pluck('id')->toArray();

        if (empty($commissionIds) || empty($professorIds)) {
            $this->command->error('Se necesitan registros en las tablas "commissions" y "professors".');
            return;
        }

        foreach ($commissionIds as $commissionId) {
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