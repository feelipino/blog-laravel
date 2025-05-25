<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        if ($posts->isEmpty() || $users->isEmpty()) {
            $this->command->info('No posts or users found. Please run the PostSeeder and UserSeeder first.');
            return;
        }

        foreach ($posts as $post) {
            foreach ($users as $user) {
                Comment::factory()->count(3)->create([
                        'post_id' => $post->id,
                        'user_id' => $user->random()->id,
                    ]);
            }
        }



    }
}
