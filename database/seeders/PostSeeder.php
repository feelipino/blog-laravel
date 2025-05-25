<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Search for all users created by the UserSeeder
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run the UserSeeder first.');
            return;
        }

        foreach ($users as $user) {
            Post::factory()->count(2)->create(['user_id' => $user->id,]);
        }

        $this->command->info(count($users) * 2 . ' posts created and assigned to existing users.');
    }
}
