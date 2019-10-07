<?php

namespace Tests\GraphQL;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\GraphQLTestCase;

class UserTest extends GraphQLTestCase
{
    public function test_user_query()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $this->graphQL("
        {
            user (id: $user->id) {
                id
                first_name
                last_name
                street
                postcode
                city
                country
                email
            }
        }
        ")->assertJson([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ]
            ]
        ]);
    }

    public function test_users_query()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $this->graphQL("
        {
            users (first:1, page: 1) {
                data {
                    id
                }
            }
        }
        ")->assertJson([
            'data' => [
                'users' => [
                    'data' => [[
                        'id' => $user->id,
                    ]]
                ]
            ]
        ]);
    }

    public function test_createUser_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $this->postGraphQL([
            'query' => '
                mutation createUser($data: UpdateOrCreateUserInput!) {
                    createUser(data: $data) {
                        id
                        first_name
                        last_name
                        initials
                        email
                        street
                        postcode
                        city
                        country
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'first_name' => 'FirstName',
                    'last_name' => 'LastName',
                    'email' => 'test@local.com'
                ]
            ],
        ])->assertJson([
            'data' => [
                'createUser' => [
                    'first_name' => 'FirstName',
                    'last_name' => 'LastName',
                    'email' => 'test@local.com'
                ]
            ]
        ]);
    }

    public function test_updateUser_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $this->postGraphQL([
            'query' => '
                mutation updateUser($id: ID!, $data: UpdateOrCreateUserInput!) {
                    updateUser(id: $id, data: $data) {
                        id
                        first_name
                        last_name
                        initials
                        email
                        street
                        postcode
                        city
                        country
                    }
                }
            ',
            'variables' => [
                'id' => $user->id,
                'data' => [
                    'first_name' => 'FirstName',
                    'last_name' => 'LastName'
                ]
            ],
        ])->assertJson([
            'data' => [
                'updateUser' => [
                    'id' => $user->id,
                    'first_name' => 'FirstName',
                    'last_name' => 'LastName',
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ]
            ]
        ]);
    }

    public function test_deleteUser_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->create();

        $this->postGraphQL([
            'query' => '
                mutation deleteUser($id: ID!) {
                    deleteUser(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $user->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteUser' => [
                    'id' => $user->id,
                ]
            ]
        ]);

        $this->assertTrue($user->refresh()->trashed());
    }

    public function test_restoreUser_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->create();
        $user->delete();

        $this->postGraphQL([
            'query' => '
                mutation restoreUser($id: ID!) {
                    restoreUser(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $user->id,
            ],
        ])->assertJson([
            'data' => [
                'restoreUser' => [
                    'id' => $user->id,
                ]
            ]
        ]);

        $this->assertFalse($user->refresh()->trashed());
    }

    public function test_updateMe_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->create();
        $this->actingAs($user);

        $this->postGraphQL([
            'query' => '
                mutation updateMe($data: UpdateOrCreateUserInput!) {
                    updateMe(data: $data) {
                        id
                        first_name
                        last_name
                        initials
                        email
                        street
                        postcode
                        city
                        country
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'first_name' => 'FirstName',
                    'last_name' => 'LastName'
                ]
            ],
        ])->assertJson([
            'data' => [
                'updateMe' => [
                    'id' => $user->id,
                    'first_name' => 'FirstName',
                    'last_name' => 'LastName',
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ]
            ]
        ]);
    }

    public function test_updateMyPassword_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->create(['password' => \Hash::make('secret')]);

        $this->postGraphQL([
            'query' => '
                mutation updateMyPassword($data: UpdateUserPasswordInput!) {
                    updateMyPassword(data: $data) {
                        id
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'current_password' => 'secret',
                    'password' => 'passw0rd',
                    'password_confirmation' => 'passw0rd'
                ]
            ],
        ])->assertJson([
            'data' => [
                'updateMyPassword' => [
                    'id' => $user->id,
                ]
            ]
        ]);
    }
}
