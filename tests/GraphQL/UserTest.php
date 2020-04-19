<?php

namespace Tests\GraphQL;

use Tests\GraphQLTestCase;
use Tests\Factories\RoleFactory;
use Tests\Factories\UserFactory;
use Tests\Factories\PermissionFactory;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends GraphQLTestCase
{
    use WithFaker;

    /** @test */
    public function test_user_query()
    {
        $user = UserFactory::new()->withAuthentication()();

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
        $user = UserFactory::new()->authenticateWithPermission('administration-users')();

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
        UserFactory::new()->authenticateWithPermission('administration-users')();

        $user = UserFactory::new()->make();

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
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'email' => $user->email,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createUser' => [
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'email' => $user->email,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateUser_mutation()
    {
        $user = UserFactory::new()->authenticateWithPermission('administration-users')();

        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;

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
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateUser' => [
                    'id' => $user->id,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
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
        $user = UserFactory::new()->authenticateWithPermission('administration-users')();

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
        $user = UserFactory::new()->authenticateWithPermission('administration-users')();
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

    public function test_syncUserRoles_mutation()
    {
        UserFactory::new()->authenticateWithPermission('administration-users')();

        $user = UserFactory::new()->withRoles(1)();
        $roles = RoleFactory::times(2)->create()->pluck('id');

        $this->postGraphQL([
            'query' => '
                mutation syncUserRoles($id: ID!, $roles: [ID!]!) {
                    syncUserRoles(id: $id, roles: $roles) {
                         id
                         roles { id }
                    }
                }
            ',
            'variables' => [
                'id' => $user->id,
                'roles' => $roles,
            ],
        ])->assertJson([
            'data' => [
                'syncUserRoles' => [
                    'id' => $user->id,
                    'roles' => $roles->map(fn ($id) => ['id' => $id])->all(),
                ],
            ],
        ]);
    }

    public function test_syncUserPermissions_mutation()
    {
        UserFactory::new()->authenticateWithPermission('administration-users')();

        $user = UserFactory::new()();
        $permissions = PermissionFactory::times(2)->create()->pluck('id');

        $this->postGraphQL([
            'query' => '
                mutation syncUserPermissions($id: ID!, $permissions: [ID!]!) {
                    syncUserPermissions(id: $id, permissions: $permissions) {
                         id
                         permissions { id }
                    }
                }
            ',
            'variables' => [
                'id' => $user->id,
                'permissions' => $permissions,
            ],
        ])->assertJson([
            'data' => [
                'syncUserPermissions' => [
                    'id' => $user->id,
                    'permissions' => $permissions->map(fn ($id) => ['id' => $id])->all(),
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateMe_mutation()
    {
        $user = UserFactory::new()->withAuthentication()();

        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;

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
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateMe' => [
                    'id' => $user->id,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ],
            ],
        ]);

        $this->assertEquals($firstName, $user->fresh()->first_name);
        $this->assertEquals($lastName, $user->fresh()->last_name);
    }

    /** @test */
    public function test_updateMyPassword_mutation()
    {
        $user = UserFactory::new()->withAuthentication()->create(['password' => \Hash::make('secret')]);

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
