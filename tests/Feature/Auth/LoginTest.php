<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_logs_in_if_credentials_are_valid()
    {
        $user = factory(User::class)->create();

        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'token_type' => 'bearer',
                    'expires_in_seconds' => 3600
                ]
            ]);

        $this->assertNotNull($response->json('data.token'));
    }

    public function test_it_returns_401_if_credentials_are_invalid()
    {
        $user = factory(User::class)->create();

        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'wrong password',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials.',
            ]);
    }
}
