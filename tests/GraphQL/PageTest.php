<?php

namespace Tests\GraphQL;

use App\Models\Page;
use Tests\Factories\UserFactory;
use Tests\GraphQLTestCase;
use Illuminate\Support\Str;

class PageTest extends GraphQLTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        UserFactory::new()->withAuthentication()();
    }

    /** @test */
    public function test_page_query()
    {
        $page = factory(Page::class)->create();

        $this->graphQL("
        {
            page (id: $page->id) {
                id
                title
                published
            }
        }
        ")->assertJson([
            'data' => [
                'page' => [
                    'id' => $page->id,
                    'title' => $page->title,
                    'published' => $page->published,
                ],
            ],
        ]);
    }

    /** @test */
    public function test_pages_query()
    {
        $page = factory(Page::class)->create();

        $this->graphQL('
        {
            pages {
                    id
            }
        }
        ')->assertJson([
            'data' => [
                'pages' => [[
                    'id' => $page->id,
                ]],
            ],
        ]);
    }

    /** @test */
    public function test_createPage_mutation()
    {
        $page = factory(Page::class)->make();

        $this->postGraphQL([
            'query' => '
                mutation createPage($data: CreatePageInput!) {
                    createPage(data: $data) {
                         id
                         title
                         slug
                         published
                    }
                }
            ',
            'variables' => [
                'data' => [
                    'title' => $page->title,
                ],
            ],
        ])->assertJson([
            'data' => [
                'createPage' => [
                    'title' => $page->title,
                    'slug' => Str::slug($page->title),
                    'published' => false,
                ],
            ],
        ]);
    }
}
