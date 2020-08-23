<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsController extends Controller
{
    public function index()
    {
        return JsonResource::make(Post::all());
    }
}
