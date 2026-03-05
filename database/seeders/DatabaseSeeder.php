<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('-----------------------------------------');
        $this->command->info('SINKRONISASI DATA ADMIN...');

        // Kita gunakan updateOrCreate agar jika dijalankan berkali-kali tidak error
        $admin = User::updateOrCreate(
            ['email' => 'admin@aksara.com'],
            [
                'name' => 'Admin Aksara',
                'password' => bcrypt('password'), // Pastikan password aman
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('SUKSES: User Admin baru telah dibuat.');
        } else {
            $this->command->info('INFO: User Admin sudah ada, data diperbarui.');
        }

        $this->command->info('Email   : admin@aksara.com');
        $this->command->info('Password: password');
        $this->call(ClassSeeder::class);
        $this->command->info('SUKSES: Data Kelas telah diseed.');
        $this->command->info('---------------------------------------');
    }
}
