<?php

namespace Tests\Unit\Models;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_page_belongs_to_a_user()
    {
        $user = factory(User::class)->create();

        /** @var Page $page */
        $page = factory(Page::class)->make([
            'user' => $user
        ]);

        $this->assertEquals($user->id, $page->author->id);
    }
}
