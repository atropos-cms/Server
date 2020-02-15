<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Tests\UsesTenant;

class PostTest extends TestCase
{
    use UsesTenant;

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
