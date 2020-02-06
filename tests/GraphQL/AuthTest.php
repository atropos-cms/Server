<?php

namespace Tests\GraphQL;

use App\Models\User;
use Tests\GraphQLTestCase;

class AuthTest extends GraphQLTestCase
{
    public function test_that_me_returns_the_active_user()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $this->graphQL('
        {
            me {
                id
            }
        }')->assertJson([
            'data' => [
                'me' => [
                    'id' => $user->id,
                ]
            ]
        ]);
    }
}
