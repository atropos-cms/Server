<?php

namespace Tests\GraphQL\Website;

use App\Enums\ContentType;
use Tests\GraphQLTestCase;
use Illuminate\Support\Str;
use Tests\Factories\UserFactory;
use Tests\Factories\Website\ContentFactory;
use Illuminate\Foundation\Testing\WithFaker;

class ContentTest extends GraphQLTestCase
{
    use WithFaker;

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
    public function test_content_query()
    {
        $content = ContentFactory::new()();

        $this->graphQL("
        {
            content (id: $content->id) {
                id
                title
                published
            }
        }
        ")->assertJson([
            'data' => [
                'content' => [
                    'id' => $content->id,
                    'title' => $content->title,
                    'published' => $content->published,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_contents_query()
    {
        $contents = ContentFactory::times(3)();

        $this->graphQL('
        {
            contents {
              id
            }
        }
        ')->assertJson([
            'data' => [
                'contents' => $contents->map(fn ($content) => ['id' => $content->id])->all(),
            ],
        ]);
    }

    /** @test */
    public function test_createPage_mutation()
    {
        $content = ContentFactory::new()->make();

        $this->postGraphQL([
            'query' => '
                mutation createContent($data: CreateContentInput!) {
                    createContent(data: $data) {
                         id
                         title
                         type
                         slug
                         published
                         order
                         author {
                            id
                         }
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'title' => $content->title,
                    'type' => ContentType::Page()->key,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createContent' => [
                    'title' => $content->title,
                    'type' => ContentType::Page()->key,
                    'slug' => Str::slug($content->title),
                    'published' => false,
                    'order' => 1,
                    'author' => [
                        'id' => $this->user->id,
                    ],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateContent_mutation()
    {
        $content = ContentFactory::new()->forAuthor(
            UserFactory::new()
        )->create();

        $title = $this->faker->title;

        $this->assertNotSame($this->user->id, $content->author->id);

        $this->postGraphQL([
            'query' => '
                mutation updateContent($id: ID!, $data: UpdateContentInput!) {
                    updateContent(id: $id, data: $data) {
                         id
                         title
                         slug
                         published
                         order
                         author {
                            id
                         }
                    }
                }
            ',
            'variables' => [
                'id' => $content->id,
                'data' => [
                    'title' => $title,
                    'published' => true,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateContent' => [
                    'title' => $title,
                    'slug' => Str::slug($content->title),
                    'published' => true,
                    'order' => 1,
                    'author' => [
                        'id' => $this->user->id,
                    ],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_deleteContent_mutation()
    {
        $content = ContentFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation deleteContent($id: ID!) {
                    deleteContent(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $content->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteContent' => [
                    'id' => $content->id,
                ],
            ],
        ]);

        $this->assertTrue($content->refresh()->trashed());
    }

    /** @test */
    public function test_restoreContent_mutation()
    {
        $content = ContentFactory::new()();
        $content->delete();

        $this->postGraphQL([
            'query' => '
                mutation restoreContent($id: ID!) {
                    restoreContent(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $content->id,
            ],
        ])->assertJson([
            'data' => [
                'restoreContent' => [
                    'id' => $content->id,
                ],
            ],
        ]);

        $this->assertFalse($content->refresh()->trashed());
    }

    /** @test */
    public function test_forceDeleteContent_mutation()
    {
        $content = ContentFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation forceDeleteContent($id: ID!) {
                    forceDeleteContent(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $content->id,
            ],
        ])->assertJson([
            'data' => [
                'forceDeleteContent' => [
                    'id' => $content->id,
                ],
            ],
        ]);


        $this->assertDatabaseMissing($content->getTable(), ['id' => $content->id]);
    }
}
