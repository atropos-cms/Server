<?php

namespace Tests\GraphQL;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = factory(User::class)->create();

        $this->graphQL('
        {
            users {
                id
                first_name
            }
        }
        ')->assertJson([
            'data' => [
                'users' => [
                    [
                        'id' => $user->id,
                        'first_name' => $user->first_name,
                    ]
                ]
            ]
        ]);
    }
}
