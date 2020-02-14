<?php

namespace Tests\GraphQL;

use App\Models\Group;
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
        $group = factory(Group::class)->create();

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
        $group = factory(Group::class)->create();

        $this->graphQL('
        {
            groups (first:1, page: 1) {
                data {
                    id
                }
            }
        }
        ')->assertJson([
            'data' => [
                'groups' => [
                    'data' => [[
                        'id' => $group->id,
                    ]],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_createGroup_mutation()
    {
        $group = factory(Group::class)->make();

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
        $group = factory(Group::class)->create();

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
        $group = factory(Group::class)->create();

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
}
