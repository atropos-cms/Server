<?php

namespace Tests\GraphQL\Collaboration\Files;

use Carbon\Carbon;
use Tests\Factories\Collaboration\Files\FileFactory;
use Tests\GraphQLTestCase;
use Tests\Factories\UserFactory;
use Tests\Factories\Collaboration\Files\FolderFactory;
use Tests\Factories\Collaboration\Files\WorkspaceFactory;

class FolderTest extends GraphQLTestCase
{
    /**
     * @var \App\Models\User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = UserFactory::new()->withAuthentication()();
    }

    /** @test */
    public function test_folder_query()
    {
        $workspace = WorkspaceFactory::new()();
        $folder = FolderFactory::new()
            ->forWorkspace($workspace)
            ->create();

        $this->graphQL("
        {
            folder (workspace_id: $workspace->id, id: $folder->id) {
                id
                name
            }
        }
        ")->assertJson([
            'data' => [
                'folder' => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_folders_query()
    {
        $workspace = WorkspaceFactory::new()();
        $folders = FolderFactory::times(3)
            ->forWorkspace($workspace)
            ->create();

        $this->graphQL("
        {
            folders(workspace_id: $workspace->id) {
                id
                name
                workspace {
                  id
                }
            }
        }
        ")->assertJson([
            'data' => [
                'folders' => $folders->map(fn ($folder) => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'workspace' => ['id' => $workspace->id,],
                ])->all(),
            ],
        ]);
    }

    /** @test */
    public function test_createFolder_mutation()
    {
        $workspace = WorkspaceFactory::new()();
        $folder = FolderFactory::new()->make();

        $id = $this->postGraphQL([
            'query' => '
                mutation createFolder($data: CreateFolderInput!) {
                    createFolder(data: $data) {
                         id
                         name
                         workspace {
                           id
                         }
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'name' => $folder->name,
                    'workspace' => ['connect' => $workspace->id],
                    'parent' => [],
                ],
            ],
        ])->assertJson([
            'data' => [
                'createFolder' => [
                    'name' => $folder->name,
                    'workspace' => ['id' => $workspace->id,],
                ],
            ],
        ])->json('data.createFolder.id');

        $this->assertNotNull($id);
    }

    /** @test */
    public function test_createFolder_mutation_with_parent_folder()
    {
        $workspace = WorkspaceFactory::new()();
        $parent = FolderFactory::new()
            ->forWorkspace($workspace)
            ->create();

        $folder = FolderFactory::new()->make();

        $id = $this->postGraphQL([
            'query' => '
                mutation createFolder($data: CreateFolderInput!) {
                    createFolder(data: $data) {
                         id
                         name
                         workspace {
                           id
                         }
                         parent {
                           id
                         }
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'name' => $folder->name,
                    'workspace' => ['connect' => $workspace->id],
                    'parent' => ['connect' => $parent->id],
                ],
            ],
        ])->assertJson([
            'data' => [
                'createFolder' => [
                    'name' => $folder->name,
                    'workspace' => ['id' => $workspace->id,],
                    'parent' => ['id' => $parent->id,],
                ],
            ],
        ])->json('data.createFolder.id');

        $this->assertNotNull($id);
    }

    /** @test */
    public function test_updateFolder_mutation()
    {
        $folder = FolderFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $this->postGraphQL([
            'query' => '
                mutation updateFolder($id: ID!, $data: UpdateFolderInput!) {
                    updateFolder(id: $id, data: $data) {
                         id
                         name
                         workspace {
                           id
                         }
                    }
                }
            ',
            'variables' => [
                'id' => $folder->id,
                'data' => [
                    'name' => $folder->name,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateFolder' => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'workspace' => ['id' => $folder->workspace->id,],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteFolder_mutation()
    {
        $folder = FolderFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $this->postGraphQL([
            'query' => '
                mutation deleteFolder($id: ID!) {
                    deleteFolder(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $folder->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteFolder' => [
                    'id' => $folder->id,
                ],
            ],
        ]);

        $this->assertTrue($folder->refresh()->trashed());
    }

    /** @test */
    public function test_restoreFolder_mutation()
    {
        $folder = FolderFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();
        $folder->delete();

        $this->postGraphQL([
            'query' => '
                mutation restoreFolder($id: ID!) {
                    restoreFolder(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $folder->id,
            ],
        ])->assertJson([
            'data' => [
                'restoreFolder' => [
                    'id' => $folder->id,
                ],
            ],
        ]);

        $this->assertFalse($folder->refresh()->trashed());
    }

    /** @test */
    public function test_forceDeleteFolder_mutation()
    {
        $folder = FolderFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $this->postGraphQL([
            'query' => '
                mutation forceDeleteFolder($id: ID!) {
                    forceDeleteFolder(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $folder->id,
            ],
        ])->assertJson([
            'data' => [
                'forceDeleteFolder' => [
                    'id' => $folder->id,
                ],
            ],
        ]);

        $this->assertDatabaseMissing($folder->getTable(), ['id' => $folder->id]);
    }

    /** @test */
    public function test_downloadFolder_mutation()
    {
        Carbon::setTestNow(now());

        $folder = FolderFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $downloadLink = $this->postGraphQL([
            'query' => '
                mutation downloadFolder($id: ID!) {
                    downloadFolder(id: $id) {
                        folder {
                            id
                        }
                        validUntil
                        downloadLink
                    }
                }
            ',
            'variables' => [
                'id' => $folder->id,
            ],
        ])->assertJson([
            'data' => [
                'downloadFolder' => [
                    'folder' => [
                        'id' => $folder->id,
                    ],
                    'validUntil' => now()->addMinutes(5)->toIso8601String(),
                ],
            ],
        ])->json('data.downloadFolder.downloadLink');

        $this->assertStringContainsString('/files-download', $downloadLink);
        $this->assertStringContainsString('signature=', $downloadLink);
    }
}
