<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->makeUserAndPosts(User::ROLE_ADMIN);
        $this->makeUserAndPosts(User::ROLE_CLIENT);
        $this->makeUserAndPosts(User::ROLE_CLIENT);
    }

    public function makeUserAndPosts(string $role)
    {
        $user = factory(User::class)->create([
            'role' => $role,
        ]);

        factory(Post::class, 3)->create([
            'user_id' => $user->id,
        ]);
    }
}