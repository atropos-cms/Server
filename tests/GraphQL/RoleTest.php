<?php

namespace Tests\GraphQL;

use App\Models\Role;
use Tests\GraphQLTestCase;
use Tests\Factories\RoleFactory;
use Tests\Factories\UserFactory;
use Tests\Factories\PermissionFactory;

class RoleTest extends GraphQLTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        UserFactory::new()->authenticateWithPermission('administration-roles')();
    }

    /** @test */
    public function test_role_query()
    {
        $role = RoleFactory::new()();

        $this->graphQL("
        {
            role (id: $role->id) {
                id
                name
                description
            }
        }
        ")->assertJson([
            'data' => [
                'role' => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'description' => $role->description,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_roles_query()
    {
        $role = RoleFactory::new()
            ->withPermissions(3)
            ->withUsers(3)();

        $this->graphQL('
        {
            roles (first:1, page: 1) {
                data {
                    id
                    permissions { id }
                    members { id }
                    membersCount
                }
            }
        }
        ')->assertJson([
            'data' => [
                'roles' => [
                    'data' => [[
                        'id' => $role->id,
                        'permissions' => $role->permissions->map(fn ($permission) => ['id' => $permission->id])->all(),
                        'members' => $role->users->map(fn ($user) => ['id' => $user->id])->all(),
                        'membersCount' => 3,
                    ]],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_createRole_mutation()
    {
        $role = RoleFactory::new()->make();

        $this->postGraphQL([
            'query' => '
                mutation createRole($data: UpdateOrCreateRoleInput!) {
                    createRole(data: $data) {
                         id
                         name
                         description
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'name' => $role->name,
                    'description' => $role->description,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createRole' => [
                    'id' => 1,
                    'name' => $role->name,
                    'description' => $role->description,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateRole_mutation()
    {
        $role = RoleFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation updateRole($id: ID!, $data: UpdateOrCreateRoleInput!) {
                    updateRole(id: $id, data: $data) {
                         id
                         name
                         description
                    }
                }
            ',
            'variables' => [
                'id' => $role->id,
                'data' => [
                    'name' => 'NewName',
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateRole' => [
                    'id' => $role->id,
                    'name' => 'NewName',
                    'description' => $role->description,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteRole_mutation()
    {
        $role = RoleFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation deleteRole($id: ID!) {
                    deleteRole(id: $id) {
                         id
                         name
                         description
                    }
                }
            ',
            'variables' => [
                'id' => $role->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteRole' => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'description' => $role->description,
                ],
            ],
        ]);

        $this->assertTrue(Role::whereId($role->id)->doesntExist());
    }

    /** @test */
    public function test_addRoleMembers_and_removeRoleMembers_mutation()
    {
        $role = RoleFactory::new()
            ->withUsers(UserFactory::times(3))();

        $newUser = UserFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation addRoleMembers($id: ID!, $members: [ID!]!) {
                    addRoleMembers(id: $id, members: $members) {
                         id
                         membersCount
                    }
                }
            ',
            'variables' => [
                'id' => $role->id,
                'members' => [$newUser->id],
            ],
        ])->assertJson([
            'data' => [
                'addRoleMembers' => [
                    'id' => $role->id,
                    'membersCount' => 4,
                ],
            ],
        ]);

        $this->postGraphQL([
            'query' => '
                mutation removeRoleMembers($id: ID!, $members: [ID!]!) {
                    removeRoleMembers(id: $id, members: $members) {
                         id
                         membersCount
                    }
                }
            ',
            'variables' => [
                'id' => $role->id,
                'members' => [
                    $newUser->id,
                ],
            ],
        ])->assertJson([
            'data' => [
                'removeRoleMembers' => [
                    'id' => $role->id,
                    'membersCount' => 3,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_syncRoleMembers_mutation()
    {
        $role = RoleFactory::new()
            ->withUsers(UserFactory::times(3))();

        $newUsers = UserFactory::times(2)->create()->pluck('id');

        $this->postGraphQL([
            'query' => '
                mutation syncRoleMembers($id: ID!, $members: [ID!]!) {
                    syncRoleMembers(id: $id, members: $members) {
                         id
                         membersCount
                         members { id }
                    }
                }
            ',
            'variables' => [
                'id' => $role->id,
                'members' => $newUsers,
            ],
        ])->assertJson([
            'data' => [
                'syncRoleMembers' => [
                    'id' => $role->id,
                    'membersCount' => 2,
                    'members' => $newUsers->map(fn ($id) => ['id' => $id])->all(),
                ],
            ],
        ]);
    }

    /** @test */
    public function test_syncRolePermissions_mutation()
    {
        $role = RoleFactory::new()
            ->withPermissions(3)();

        $permissions = PermissionFactory::times(2)->create()->pluck('id');

        $this->postGraphQL([
            'query' => '
                mutation syncRolePermissions($id: ID!, $permissions: [ID!]!) {
                    syncRolePermissions(id: $id, permissions: $permissions) {
                         id
                         permissions { id }
                    }
                }
            ',
            'variables' => [
                'id' => $role->id,
                'permissions' => $permissions,
            ],
        ])->assertJson([
            'data' => [
                'syncRolePermissions' => [
                    'id' => $role->id,
                    'permissions' => $permissions->map(fn ($id) => ['id' => $id])->all(),
                ],
            ],
        ]);
    }
}
