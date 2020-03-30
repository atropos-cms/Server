<?php

namespace Tests\GraphQL;

use Tests\Factories\GroupFactory;
use Tests\Factories\UserFactory;
use Tests\GraphQLTestCase;

class UserTest extends GraphQLTestCase
{
    /** @test */
    public function test_user_query()
    {
        $user = $this->authenticate();

        $this->graphQL("
        {
            user (id: $user->id) {
                id
                firstName
                lastName
                fullName
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
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'fullName' => $user->full_name,
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_users_query()
    {
        $user = $this->authenticate();

        $this->graphQL('
        {
            users (first:1, page: 1) {
                data {
                    id
                }
            }
        }
        ')->assertJson([
            'data' => [
                'users' => [
                    'data' => [[
                        'id' => $user->id,
                    ]],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_createUser_mutation()
    {
        $this->authenticate();

        $this->postGraphQL([
            'query' => '
                mutation createUser($data: UpdateOrCreateUserInput!) {
                    createUser(data: $data) {
                        id
                        firstName
                        lastName
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
                    'firstName' => 'FirstName',
                    'lastName' => 'LastName',
                    'email' => 'test@local.com',
                ],
            ],
        ])->assertJson([
            'data' => [
                'createUser' => [
                    'firstName' => 'FirstName',
                    'lastName' => 'LastName',
                    'email' => 'test@local.com',
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateUser_mutation()
    {
        $user = $this->authenticate();

        $this->postGraphQL([
            'query' => '
                mutation updateUser($id: ID!, $data: UpdateOrCreateUserInput!) {
                    updateUser(id: $id, data: $data) {
                        id
                        firstName
                        lastName
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
                    'firstName' => 'FirstName',
                    'lastName' => 'LastName',
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateUser' => [
                    'id' => $user->id,
                    'firstName' => 'FirstName',
                    'lastName' => 'LastName',
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteUser_mutation()
    {
        $user = $this->authenticate();

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
                ],
            ],
        ]);

        $this->assertTrue($user->refresh()->trashed());
    }

    /** @test */
    public function test_restoreUser_mutation()
    {
        $user = $this->authenticate();
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
                ],
            ],
        ]);

        $this->assertFalse($user->refresh()->trashed());
    }

//    public function test_syncUserGroups_mutation()
//    {
//        $this->authenticate();
//
//        $user = UserFactory::new()->withGroups(1)();
//        $groups = GroupFactory::times()->create()->pluck('id');
//
//        $this->postGraphQL([
//            'query' => '
//                mutation syncUserGroups($id: ID!, $groups: [ID!]!) {
//                    syncUserGroups(id: $id, groups: $groups) {
//                         id
//                         groups { id }
//                    }
//                }
//            ',
//            'variables' => [
//                'id' => $group->id,
//                'groups' => [$group->id],
//            ],
//        ])->assertJson([
//            'data' => [
//                'syncUserGroups' => [
//                    'id' => $group->id,
//                    'membersCount' => 2,
//                    'members' => $newUsers->map(fn($id) => ['id' => $id])->all(),
//                ],
//            ],
//        ]);
//    }

    /** @test */
    public function test_updateMe_mutation()
    {
        $user = $this->authenticate();

        $this->postGraphQL([
            'query' => '
                mutation updateMe($data: UpdateOrCreateUserInput!) {
                    updateMe(data: $data) {
                        id
                        firstName
                        lastName
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
                    'firstName' => 'FirstName',
                    'lastName' => 'LastName',
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateMe' => [
                    'id' => $user->id,
                    'firstName' => 'FirstName',
                    'lastName' => 'LastName',
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ],
            ],
        ]);

        $this->assertEquals('FirstName', $user->fresh()->first_name);
        $this->assertEquals('LastName', $user->fresh()->last_name);
    }

    /** @test */
    public function test_updateMyPassword_mutation()
    {
        $user = app(\App\Factories\UserFactory::class)->createWithAuthentication(['password' => \Hash::make('secret')]);

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
                    'currentPassword' => 'secret',
                    'password' => 'passw0rd',
                    'passwordConfirmation' => 'passw0rd',
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateMyPassword' => [
                    'id' => $user->id,
                ],
            ],
        ]);
    }
}
