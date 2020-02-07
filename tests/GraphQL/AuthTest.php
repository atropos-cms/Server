<?php

namespace Tests\GraphQL;

use App\Models\User;
use Tests\GraphQLTestCase;

class AuthTest extends GraphQLTestCase
{
    public function test_a_user_can_login()
    {
        $user = app(\App\Factories\UserFactory::class)->make();
        $user->save();

        $token = $this->postGraphQL([
            'query' => '
                mutation login($data: LoginInput) {
                    login(data: $data) {
                        token
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'email' => $user->email,
                    'password' => 'password',
                ]
            ],
        ])->decodeResponseJson('data.login.token');

        $this->postGraphQL([
            'query' => '{
                me {
                    id
                }
            }'],
            ['Authorization' => "Bearer $token"]
        )->assertJson([
            'data' => [
                'me' => [
                    'id' => $user->id,
                ]
            ]
        ]);
    }

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
