<?php

namespace Tests\GraphQL;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserQuery()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->graphQL("
        {
            user (id: $user->id) {
                id
                first_name
                last_name
                street
                postcode
                city
                country
                email
            }
        }
        ")->assertJson([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'street' => $user->street,
                    'postcode' => $user->postcode,
                    'city' => $user->city,
                    'country' => $user->country,
                    'email' => $user->email,
                ]
            ]
        ]);
    }

    public function testUsersQuery()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->graphQL("
        {
            users (first:1, page: 1) {
                data {
                    id
                }
            }
        }
        ")->assertJson([
            'data' => [
                'users' => [
                    'data' => [[
                        'id' => $user->id,
                    ]]
                ]
            ]
        ]);
    }
}
