<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the RoleSeeder so roles are created
        $this->call(RoleSeeder::class);

        // Create the test user first (with password)
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), // ✅ add a hashed password
            ]
        );

        // Call the TopicSeeder and pass the user ID
        $this->callWith(TopicSeeder::class, ['userId' => $user->id]);
    }
}