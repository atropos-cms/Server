<?php

namespace Tests\GraphQL;

use App\Models\Group;
use Tests\Factories\GroupFactory;
use Tests\Factories\PermissionFactory;
use Tests\Factories\UserFactory;
use Tests\GraphQLTestCase;

class GroupTest extends GraphQLTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->authenticate();
    }

    /** @test */
    public function test_group_query()
    {
        $group = GroupFactory::new()();

        $this->graphQL("
        {
            group (id: $group->id) {
                id
                name
                description
            }
        }
        ")->assertJson([
            'data' => [
                'group' => [
                    'id' => $group->id,
                    'name' => $group->name,
                    'description' => $group->description,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_groups_query()
    {
        $group = GroupFactory::new()
            ->withPermissions(3)
            ->withUsers(3)();

        $this->graphQL('
        {
            groups (first:1, page: 1) {
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
                'groups' => [
                    'data' => [[
                        'id' => $group->id,
                        'permissions' => $group->permissions->map(fn($permission) => ['id' => $permission->id])->all(),
                        'members' => $group->users->map(fn($user) => ['id' => $user->id])->all(),
                        'membersCount' => 3
                    ]],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_createGroup_mutation()
    {
        $group = GroupFactory::new()->make();

        $this->postGraphQL([
            'query' => '
                mutation createGroup($data: UpdateOrCreateGroupInput!) {
                    createGroup(data: $data) {
                         id
                         name
                         description
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'name' => $group->name,
                    'description' => $group->description,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createGroup' => [
                    'id' => 1,
                    'name' => $group->name,
                    'description' => $group->description,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateGroup_mutation()
    {
        $group = GroupFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation updateGroup($id: ID!, $data: UpdateOrCreateGroupInput!) {
                    updateGroup(id: $id, data: $data) {
                         id
                         name
                         description
                    }
                }
            ',
            'variables' => [
                'id' => $group->id,
                'data' => [
                    'name' => 'NewName',
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateGroup' => [
                    'id' => $group->id,
                    'name' => 'NewName',
                    'description' => $group->description,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteGroup_mutation()
    {
        $group = GroupFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation deleteGroup($id: ID!) {
                    deleteGroup(id: $id) {
                         id
                         name
                         description
                    }
                }
            ',
            'variables' => [
                'id' => $group->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteGroup' => [
                    'id' => $group->id,
                    'name' => $group->name,
                    'description' => $group->description,
                ],
            ],
        ]);

        $this->assertTrue(Group::whereId($group->id)->doesntExist());
    }

    /** @test */
    public function test_addGroupMembers_and_removeGroupMembers_mutation()
    {
        $group = GroupFactory::new()
            ->withUsers(UserFactory::times(3))();

        $newUser = UserFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation addGroupMembers($id: ID!, $members: [ID!]!) {
                    addGroupMembers(id: $id, members: $members) {
                         id
                         membersCount
                    }
                }
            ',
            'variables' => [
                'id' => $group->id,
                'members' => [$newUser->id],
            ],
        ])->assertJson([
            'data' => [
                'addGroupMembers' => [
                    'id' => $group->id,
                    'membersCount' => 4,
                ],
            ],
        ]);

        $this->postGraphQL([
            'query' => '
                mutation removeGroupMembers($id: ID!, $members: [ID!]!) {
                    removeGroupMembers(id: $id, members: $members) {
                         id
                         membersCount
                    }
                }
            ',
            'variables' => [
                'id' => $group->id,
                'members' => [
                    $newUser->id
                ],
            ],
        ])->assertJson([
            'data' => [
                'removeGroupMembers' => [
                    'id' => $group->id,
                    'membersCount' => 3,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_syncGroupMembers_mutation()
    {
        $group = GroupFactory::new()
            ->withUsers(UserFactory::times(3))();

        $newUsers = UserFactory::times(2)->create()->pluck('id');

        $this->postGraphQL([
            'query' => '
                mutation syncGroupMembers($id: ID!, $members: [ID!]!) {
                    syncGroupMembers(id: $id, members: $members) {
                         id
                         membersCount
                         members { id }
                    }
                }
            ',
            'variables' => [
                'id' => $group->id,
                'members' => $newUsers,
            ],
        ])->assertJson([
            'data' => [
                'syncGroupMembers' => [
                    'id' => $group->id,
                    'membersCount' => 2,
                    'members' => $newUsers->map(fn($id) => ['id' => $id])->all(),
                ],
            ],
        ]);
    }

    /** @test */
    public function test_syncGroupPermissions_mutation()
    {
        $group = GroupFactory::new()
            ->withPermissions(3)();

        $permissions = PermissionFactory::times(2)->create()->pluck('id');

        $this->postGraphQL([
            'query' => '
                mutation syncGroupPermissions($id: ID!, $permissions: [ID!]!) {
                    syncGroupPermissions(id: $id, permissions: $permissions) {
                         id
                         permissions { id }
                    }
                }
            ',
            'variables' => [
                'id' => $group->id,
                'permissions' => $permissions,
            ],
        ])->assertJson([
            'data' => [
                'syncGroupPermissions' => [
                    'id' => $group->id,
                    'permissions' => $permissions->map(fn($id) => ['id' => $id])->all(),
                ],
            ],
        ]);
    }
}
