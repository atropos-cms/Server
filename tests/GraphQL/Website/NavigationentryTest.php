<?php

namespace Tests\GraphQL\Website;

use App\Enums\ContentType;
use Illuminate\Support\Str;
use Tests\Factories\UserFactory;
use Tests\AuthenticatedGraphQLTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Factories\Website\NavigationentryFactory;


class NavigationentryTest extends AuthenticatedGraphQLTestCase
{
    use WithFaker;

    /** @test */
    public function test_navigation_query()
    {
        $navigationentry = NavigationentryFactory::new()();

        $this->graphQL("
        {
            navigationentry (id: $navigationentry->id) {
                id
                title
                published
            }
        }
        ")->assertJson([
            'data' => [
                'navigationentry' => [
                    'id' => $navigationentry->id,
                    'title' => $navigationentry->title,
                    'published' => $navigationentry->published,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_navigationentries_query()
    {
        $navigationentries = NavigationentryFactory::times(3)();

        $this->graphQL('
        {
            navigationentries {
              id
            }
        }
        ')->assertJson([
            'data' => [
                'navigationentries' => $navigationentries->map(fn ($navigationentry) => ['id' => $navigationentry->id])->all(),
            ],
        ]);
    }

    /** @test */
    public function test_createNavigationentry_mutation()
    {
        $navigationentry = NavigationentryFactory::new()->make();

        $this->postGraphQL([
            'query' => '
                mutation createNavigationentry($data: CreateNavigationentryInput!) {
                    createNavigationentry(data: $data) {
                         id
                         title
                         slug
                         published
                         order
                         author {
                            id
                         }
                         content {
                           __typename
                           ... on Page {
                              body
                           }
                         }
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'title' => $navigationentry->title,
                    'type' => ContentType::Page()->key,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createNavigationentry' => [
                    'title' => $navigationentry->title,
                    'slug' => Str::slug($navigationentry->title),
                    'published' => false,
                    'order' => 1,
                    'author' => [
                        'id' => $this->user->id,
                    ],
                    'content' => [
                        '__typename' => ContentType::Page()->key,
                    ],
                ],
            ],
        ]);
    }

    /** @test */
    public function test_updateNavigationentry_mutation()
    {
        $navigationentry = NavigationentryFactory::new()->forAuthor(
            UserFactory::new()
        )->create();

        $title = $this->faker->title;

        $this->assertNotSame($this->user->id, $navigationentry->author->id);

        $this->postGraphQL([
            'query' => '
                mutation updateNavigationentry($id: ID!, $data: UpdateNavigationentryInput!) {
                    updateNavigationentry(id: $id, data: $data) {
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
                'id' => $navigationentry->id,
                'data' => [
                    'title' => $title,
                    'published' => true,
                ],
            ],
        ])->assertJson([
            'data' => [
                'updateNavigationentry' => [
                    'title' => $title,
                    'slug' => Str::slug($navigationentry->title),
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
    public function test_deleteNavigationentry_mutation()
    {
        $navigationentry = NavigationentryFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation deleteNavigationentry($id: ID!) {
                    deleteNavigationentry(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $navigationentry->id,
            ],
        ])->assertJson([
            'data' => [
                'deleteNavigationentry' => [
                    'id' => $navigationentry->id,
                ],
            ],
        ]);

        $this->assertTrue($navigationentry->refresh()->trashed());
    }

    /** @test */
    public function test_restoreNavigationentry_mutation()
    {
        $navigationentry = NavigationentryFactory::new()();
        $navigationentry->delete();

        $this->postGraphQL([
            'query' => '
                mutation restoreNavigationentry($id: ID!) {
                    restoreNavigationentry(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $navigationentry->id,
            ],
        ])->assertJson([
            'data' => [
                'restoreNavigationentry' => [
                    'id' => $navigationentry->id,
                ],
            ],
        ]);

        $this->assertFalse($navigationentry->refresh()->trashed());
    }

    /** @test */
    public function test_forceDeleteNavigationentry_mutation()
    {
        $navigationentry = NavigationentryFactory::new()();

        $this->postGraphQL([
            'query' => '
                mutation forceDeleteNavigationentry($id: ID!) {
                    forceDeleteNavigationentry(id: $id) {
                        id
                    }
                }
            ',
            'variables' => [
                'id' => $navigationentry->id,
            ],
        ])->assertJson([
            'data' => [
                'forceDeleteNavigationentry' => [
                    'id' => $navigationentry->id,
                ],
            ],
        ]);

        $this->assertDatabaseMissing($navigationentry->getTable(), ['id' => $navigationentry->id]);
    }

    /** @test */
    public function test_syncNavigationentryOrder_mutation()
    {
        $navigationentries = NavigationentryFactory::times(3)();
        $reverseOrderedIds = $navigationentries->sortByDesc('order')->values();

        $this->postGraphQL([
            'query' => '
                mutation syncNavigationentryOrder($data: [ID!]!) {
                    syncNavigationentryOrder(data: $data) {
                        id
                    }
                }
            ',
            'variables' => [
                'data' => $reverseOrderedIds->pluck('id')->toArray(),
            ],
        ])->assertExactJson([
            'data' => [
                'syncNavigationentryOrder' => $reverseOrderedIds
                    ->map(fn ($navigationentry) => ['id' => (string)$navigationentry->id])
                    ->all(),
            ],
        ]);

        $this->graphQL('
        {
            navigationentries {
              id
            }
        }
        ')->assertExactJson([
            'data' => [
                'navigationentries' => $reverseOrderedIds
                    ->map(fn ($navigationentry) => ['id' => (string)$navigationentry->id])
                    ->all(),
            ],
        ]);
    }
}
