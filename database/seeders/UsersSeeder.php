<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Create admin user if not exists
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'semuasama',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => Hash::make('semuasama'),
                'role' => 'admin',
            ]);
        }

        // Create 9 regular users
        User::factory()->count(9)->create();

        // Display seeder completion message
        $this->command->info('Users seeded successfully.');
    }
}
