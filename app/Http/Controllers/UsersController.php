<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersController extends Controller
{
    public function index()
    {
        return JsonResource::make(User::paginate());
    }
}
