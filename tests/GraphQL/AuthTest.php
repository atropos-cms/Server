<?php

namespace Tests\GraphQL;

use App\Models\User;
use Tests\GraphQLTestCase;

class AuthTest extends GraphQLTestCase
{
    public function test_a_user_can_login()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $token = $this->postGraphQL([
            'query' => '
                mutation login($data: LoginInput) {
                    login(data: $data) {
                        accessToken
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'email' => $user->email,
                    'password' => 'password',
                ],
            ],
        ])->decodeResponseJson('data.login.accessToken');

        $this->postGraphQL([
            'query' => '{
                me {
                    id
                }
            }', ],
            ['Authorization' => "Bearer $token"]
        )->assertJson([
            'data' => [
                'me' => [
                    'id' => $user->id,
                ],
            ],
        ]);
    }

    public function test_that_me_returns_the_active_user()
    {
        $user = $this->authenticate();

        $this->graphQL('
        {
            me {
                id
            }
        }')->assertJson([
            'data' => [
                'me' => [
                    'id' => $user->id,
                ],
            ],
        ]);
    }

    public function test_a_user_can_logout()
    {
        $user = app(\App\Factories\UserFactory::class)->create();
        $token = $user->createToken('device_name')->plainTextToken;

        $this->assertCount(1, $user->tokens);

        $this->postGraphQL([
            'query' => '
                mutation {
                  logout {
                    status
                  }
            }', ],
            ['Authorization' => "Bearer $token"]
        );

        $this->assertCount(0, $user->fresh()->tokens);
    }
}
