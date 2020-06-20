<?php

namespace Tests\GraphQL\Collaboration\Files;

use Tests\AuthenticatedGraphQLTestCase;
use Tests\Factories\Collaboration\Files\WorkspaceFactory;

class WorkspaceTest extends AuthenticatedGraphQLTestCase
{
    /** @test */
    public function test_workspace_query()
    {
        $workspace = WorkspaceFactory::new()();

        $this->graphQL("
        {
            workspace (id: $workspace->id) {
                id
                name
            }
        }
        ")->assertJson([
            'data' => [
                'workspace' => [
                    'id' => $workspace->id,
                    'name' => $workspace->name,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_workspaces_query()
    {
        $workspaces = WorkspaceFactory::times(3)();

        $this->graphQL('
        {
            workspaces {
                id
                name
            }
        }
        ')->assertJson([
            'data' => [
                'workspaces' => $workspaces->map(fn ($workspace) => [
                    'id' => $workspace->id,
                    'name' => $workspace->name,
                ])->all(),
            ],
        ]);
    }

    /** @test */
    public function test_createWorkspace_mutation()
    {
        $workspace = WorkspaceFactory::new()->make();

        $id = $this->postGraphQL([
            'query' => '
                mutation createWorkspace($data: CreateWorkspaceInput!) {
                    createWorkspace(data: $data) {
                         id
                         name
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'name' => $workspace->name,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createWorkspace' => [
                    'name' => $workspace->name,
                ],
            ],
        ])->json('data.createWorkspace.id');

        $this->assertNotNull($id);
        $this->assertDatabaseHas('workspaces', ['id' => $id]);
    }

    /** @test */
    public function test_updateWorkspace_mutation()
    {
        $workspace = WorkspaceFactory::new()();

        $updatedName = 'New Workspace Name';

        $this->postGraphQL([
            'query' => '
                mutation updateWorkspace($id: ID!, $data: UpdateWorkspaceInput!) {
                    updateWorkspace(id: $id, data: $data) {
                         id
                         name
                    }
                }
            ',
            'variables' => [
                'id' => $workspace->id,
                'data' => [
                    'name' => $updatedName,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateWorkspace' => [
                    'id' => $workspace->id,
                    'name' => $updatedName,
                ],
            ],
        ]);

        $this->assertDatabaseHas('workspaces', [
            'id' => $workspace->id,
            'name' => $updatedName,
        ]);
    }

    /** @test */
    public function test_deleteWorkspace_mutation()
    {
        $workspace = WorkspaceFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation deleteWorkspace($id: ID!) {
                    deleteWorkspace(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $workspace->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteWorkspace' => [
                    'id' => $workspace->id,
                ],
            ],
        ]);

        $this->assertTrue($workspace->refresh()->trashed());
    }

    /** @test */
    public function test_restoreWorkspace_mutation()
    {
        $workspace = WorkspaceFactory::new()();
        $workspace->delete();

        $this->postGraphQL([
            'query' => '
                mutation restoreWorkspace($id: ID!) {
                    restoreWorkspace(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $workspace->id,
            ],
        ])->assertJson([
            'data' => [
                'restoreWorkspace' => [
                    'id' => $workspace->id,
                ],
            ],
        ]);

        $this->assertFalse($workspace->refresh()->trashed());
    }

    /** @test */
    public function test_forceDeleteWorkspace_mutation()
    {
        $workspace = WorkspaceFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation forceDeleteWorkspace($id: ID!) {
                    forceDeleteWorkspace(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $workspace->id,
            ],
        ])->assertJson([
            'data' => [
                'forceDeleteWorkspace' => [
                    'id' => $workspace->id,
                ],
            ],
        ]);

        $this->assertDatabaseMissing($workspace->getTable(), ['id' => $workspace->id]);
    }
}
