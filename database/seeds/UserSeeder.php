<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = factory(User::class)->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $user = factory(User::class)->create([
            'role' => User::ROLE_CLIENT,
        ]);

        $user = factory(User::class)->create([
            'role' => User::ROLE_CLIENT,
        ]);
    }
}