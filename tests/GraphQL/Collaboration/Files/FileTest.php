<?php

namespace Tests\GraphQL\Collaboration\Files;

use Tests\GraphQLTestCase;
use Tests\Factories\UserFactory;
use Illuminate\Http\UploadedFile;
use Tests\Factories\Collaboration\Files\FileFactory;
use Tests\Factories\Collaboration\Files\FolderFactory;
use Tests\Factories\Collaboration\Files\WorkspaceFactory;

class FileTest extends GraphQLTestCase
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
    public function test_file_query()
    {
        $workspace = WorkspaceFactory::new()();
        $file = FileFactory::new()
            ->forWorkspace($workspace)
            ->create();

        $this->graphQL("
        {
            file (workspace_id: $workspace->id, id: $file->id) {
                id
                name
                mimeType
                originalFilename
                fileExtension
                sha256Checksum
                size
                workspace {
                  id
                }
            }
        }
        ")->assertJson([
            'data' => [
                'file' => [
                    'id' => $file->id,
                    'name' => $file->name,
                    'mimeType' => $file->mime_type,
                    'originalFilename' => $file->original_filename,
                    'fileExtension' => $file->file_extension,
                    'sha256Checksum' => $file->sha256_checksum,
                    'size' => $file->size,
                    'workspace' => ['id' => $workspace->id,],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_files_query()
    {
        $workspace = WorkspaceFactory::new()();
        $files = FileFactory::times(3)
            ->forWorkspace($workspace)
            ->create();

        $this->graphQL("
        {
            files(workspace_id: $workspace->id) {
                id
                name
                mimeType
                originalFilename
                fileExtension
                sha256Checksum
                size
                workspace {
                  id
                }
            }
        }
        ")->assertJson([
            'data' => [
                'files' => $files->map(fn ($file) => [
                    'id' => $file->id,
                    'name' => $file->name,
                    'mimeType' => $file->mime_type,
                    'originalFilename' => $file->original_filename,
                    'fileExtension' => $file->file_extension,
                    'sha256Checksum' => $file->sha256_checksum,
                    'size' => $file->size,
                    'workspace' => ['id' => $workspace->id,],
                ])->all(),
            ],
        ]);
    }

    /** @test */
    public function test_createFile_mutation()
    {
        $workspace = WorkspaceFactory::new()();
        $file = FileFactory::new()->make();

        $dataJson = json_encode([
            'name' => $file->name,
            'workspace' => ['connect' => $workspace->id],
            'parent' => [],
        ]);

        $id = $this->multipartGraphQL(
            [
            'operations' => /* @lang JSON */ '
            {
                "query": "mutation createFile($file: Upload!, $data: CreateFileInput!) { createFile(file: $file, data: $data) { id name size mimeType workspace { id }  parent { id } } }",
                "variables": {
                    "file": null,
                    "data": ' . $dataJson . '
                }
            }',
            'map' => /* @lang JSON */'
            {
                "0": ["variables.file"]
            }',
        ],
            [
            '0' => UploadedFile::fake()->create('image.jpg', 500),
        ]
        )->assertJson([
            'data' => [
                'createFile' => [
                    'name' => $file->name,
                    'size' => 512000,
                    'mimeType' => 'image/jpeg',
                    'workspace' => ['id' => $workspace->id,],
                    'parent' => null,
                ],
            ],
        ])->json('data.createFile.id');

        $this->assertNotNull($id);
    }

    /** @test */
    public function test_updateFile_mutation()
    {
        $file = FileFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $this->postGraphQL([
            'query' => '
                mutation updateFile($id: ID!, $data: UpdateFileInput!) {
                    updateFile(id: $id, data: $data) {
                         id
                         name
                         workspace {
                           id
                         }
                    }
                }
            ',
            'variables' => [
                'id' => $file->id,
                'data' => [
                    'name' => $file->name,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateFile' => [
                    'id' => $file->id,
                    'name' => $file->name,
                    'workspace' => ['id' => $file->workspace->id,],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteFile_mutation()
    {
        $file = FileFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $this->postGraphQL([
            'query' => '
                mutation deleteFile($id: ID!) {
                    deleteFile(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $file->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteFile' => [
                    'id' => $file->id,
                ],
            ],
        ]);

        $this->assertTrue($file->refresh()->trashed());
    }

    /** @test */
    public function test_restoreFile_mutation()
    {
        $file = FileFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();
        $file->delete();

        $this->postGraphQL([
            'query' => '
                mutation restoreFile($id: ID!) {
                    restoreFile(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $file->id,
            ],
        ])->assertJson([
            'data' => [
                'restoreFile' => [
                    'id' => $file->id,
                ],
            ],
        ]);

        $this->assertFalse($file->refresh()->trashed());
    }

    /** @test */
    public function test_forceDeleteFile_mutation()
    {
        $file = FileFactory::new()
            ->forWorkspace(WorkspaceFactory::new())
            ->create();

        $this->postGraphQL([
            'query' => '
                mutation forceDeleteFile($id: ID!) {
                    forceDeleteFile(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $file->id,
            ],
        ])->assertJson([
            'data' => [
                'forceDeleteFile' => [
                    'id' => $file->id,
                ],
            ],
        ]);

        $this->assertDatabaseMissing($file->getTable(), ['id' => $file->id]);
    }
}
