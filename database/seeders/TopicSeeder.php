<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($userId = 1): void
    {
        \App\Models\Topic::insert([
            ['title' => 'General', 'user_id' => $userId, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Announcements', 'user_id' => $userId, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Support', 'user_id' => $userId, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}