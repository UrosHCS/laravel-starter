<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $posts = factory(Post::class, 3)->create();

        $response = $this->get('/posts');

        $response->assertStatus(200);

        $response->assertJson([
            'data' => $posts->toArray(),
        ]);
    }
}
