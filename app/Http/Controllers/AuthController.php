<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = $this->auth()->attempt($credentials);

        if (! $token) {
            return $this->message('Invalid credentials.', 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password']),
            'role' => User::ROLE_CLIENT,
        ]);

        $token = $this->auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return $this->auth()->user();
    }

    public function logout()
    {
        $this->auth()->logout();

        return $this->message('Successfully logged out');
    }

    public function refresh()
    {
        return $this->respondWithToken($this->auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return JsonResource::make([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in_seconds' => $this->auth()->factory()->getTTL() * 60
        ]);
    }
}
