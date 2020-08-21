<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Tymon\JWTAuth\JWTGuard;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return JWTGuard
     */
    protected function auth()
    {
        // Default guard is 'api' so we don't need to pass an argument to auth().
        return auth();
    }

    protected function message(string $message, $status = 200, array $headers = [], $options = 0)
    {
        return $this->json([
            'message' => $message,
        ], $status, $headers, $options);
    }

    protected function json($data = [], $status = 200, array $headers = [], $options = 0)
    {
        return response()->json($data, $status, $headers, $options);
    }
}
