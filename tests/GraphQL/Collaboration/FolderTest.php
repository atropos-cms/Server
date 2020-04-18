<?php

namespace Tests\GraphQL\Collaboration;

use Tests\Factories\Collaboration\FolderFactory;
use Tests\Factories\UserFactory;
use Tests\GraphQLTestCase;

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
        $folder = FolderFactory::new()();

        $this->graphQL("
        {
            folder (id: $folder->id) {
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
        $folders = FolderFactory::times(3)();

        $this->graphQL("
        {
            folders {
                id
                name
            }
        }
        ")->assertJson([
            'data' => [
                'folders' => $folders->map(fn ($folder) => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                ])->all(),
            ],
        ]);
    }

    /** @test */
    public function test_createFolder_mutation()
    {
        $folder = FolderFactory::new()->make();

         $id = $this->postGraphQL([
            'query' => '
                mutation createFolder($data: CreateFolderInput!) {
                    createFolder(data: $data) {
                         id
                         name
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'name' => $folder->name,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createFolder' => [
                    'name' => $folder->name,
                ],
            ],
        ])->json('data.createFolder.id');

         $this->assertNotNull($id);
    }

    /** @test */
    public function test_updateFolder_mutation()
    {
        $folder = FolderFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation updateFolder($id: ID!, $data: UpdateFolderInput!) {
                    updateFolder(id: $id, data: $data) {
                         id
                         name
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
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteFolder_mutation()
    {
        $folder = FolderFactory::new()();

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
        $folder = FolderFactory::new()();
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
        $folder = FolderFactory::new()();

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

}
