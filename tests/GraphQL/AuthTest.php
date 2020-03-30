<?php

namespace Tests\GraphQL;

use Tests\Factories\UserFactory;
use Tests\GraphQLTestCase;

class AuthTest extends GraphQLTestCase
{
    /** @test */
    public function a_user_can_login()
    {
        $user = UserFactory::new()();

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

        $this->postGraphQL(
            [
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

    /** @test */
    public function an_error_is_returned_if_invalid_login_data_is_provided()
    {
        $user = UserFactory::new()();

        $this->postGraphQL([
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
                    'password' => 'invalid',
                ],
            ],
        ])->assertJson([
            'errors' => [[
                'message' => 'The given data was invalid.',
            ]],
        ]);
    }

    /** @test */
    public function me_returns_the_active_user()
    {
        $user = UserFactory::new()->withAuthentication()();

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

    /** @test */
    public function me_route_throws_an_error_if_user_is_not_logged_in()
    {
        $this->graphQL('
        {
            me {
                id
            }
        }')->assertJson([
            'errors' => [[
                'message' => 'UNAUTHENTICATED',
            ]],
        ]);
    }

    /** @test */
    public function a_user_can_logout()
    {
        $user = UserFactory::new()();
        $token = $user->createToken('device_name')->plainTextToken;

        $this->assertCount(1, $user->tokens);

        $this->postGraphQL(
            [
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
