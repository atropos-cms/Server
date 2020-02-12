<?php

namespace Tests\Unit\Models;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_post_belongs_to_a_user()
    {
        $user = factory(User::class)->create();

        /** @var Post $post */
        $post = factory(Post::class)->make([
            'user' => $user,
        ]);

        $this->assertEquals($user->id, $post->author->id);
    }
}
