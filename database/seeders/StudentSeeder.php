<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // We only want to seed students for "class" accounts (not admin)
        $classUsers = User::where('email', '!=', 'admin@aksara.com')
                          ->where('email', '!=', 'admin@aksara.sch.id')
                          ->get();

        foreach ($classUsers as $user) {
            // Let's create 5-10 random students for each class
            $studentCount = rand(5, 10);
            
            for ($i = 0; $i < $studentCount; $i++) {
                Student::create([
                    'user_id' => $user->id,
                    'name' => $faker->name(),
                    'instagram' => '@' . strtolower(str_replace([' ', '.'], '', $faker->name)),
                    'quote' => $faker->sentence(rand(4, 10)),
                ]);
            }
        }
    }
}
