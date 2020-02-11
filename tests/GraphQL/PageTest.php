<?php

namespace Tests\GraphQL;

use App\Models\Page;
use Illuminate\Support\Str;
use Tests\GraphQLTestCase;

class PageTest extends GraphQLTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticate();
    }

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
                ]
            ]
        ]);
    }

    public function test_pages_query()
    {
        $page = factory(Page::class)->create();

        $this->graphQL("
        {
            pages {
                    id
            }
        }
        ")->assertJson([
            'data' => [
                'pages' => [[
                    'id' => $page->id,
                ]]
            ]
        ]);
    }

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
                ]
            ],
        ])->assertJson([
            'data' => [
                'createPage' => [
                    'title' => $page->title,
                    'slug' => Str::slug($page->title),
                    'published' => false
                ]
            ]
        ]);
    }
}
