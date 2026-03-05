<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'TKR 1', 'TKR 2', 'TKR 3',
            'TSM 1', 'TSM 2',
            'TKJ 1', 'TKJ 2', 'TKJ 3',
            'MM 1', 'MM 2', 'MM 3', 'MM 4',
            'TB 1', 'TB 2',
            'AK'
        ];

        foreach ($classes as $className) {
            $email = Str::slug($className) . '@aksara.sch.id';
            
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $className,
                    'password' => Hash::make('password123'),
                ]
            );
        }

        // Create a default admin if not exists
        User::updateOrCreate(
            ['email' => 'admin@aksara.sch.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
