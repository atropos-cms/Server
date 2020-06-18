<?php

namespace Tests\GraphQL;

use Carbon\Carbon;
use Tests\GraphQLTestCase;
use Tests\Factories\UserFactory;

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
    public function login_records_the_loginAt_date()
    {
        $user = UserFactory::new()();
        Carbon::setTestNow(now());

        $this->assertNull($user->refresh()->login_at);

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
                    'password' => 'password',
                ],
            ],
        ])->decodeResponseJson('data.login.accessToken');

        $this->assertEquals(now()->toIso8601String(), $user->refresh()->login_at->toIso8601String());
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
        // Create an additional token that should not be deleted
        $user->createToken('device_name');

        $token = $user->createToken('device_name');
        $bearerToken = $token->plainTextToken;

        $this->assertCount(2, $user->tokens);

        $this->postGraphQL(
            [
            'query' => '
                mutation {
                  logout {
                    status
                  }
            }', ],
            ['Authorization' => "Bearer $bearerToken"]
        );

        $this->assertCount(1, $user->fresh()->tokens);
    }
}
