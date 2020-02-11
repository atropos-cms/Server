<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

abstract class GraphQLTestCase extends TestCase
{
    use RefreshDatabase;
    use MakesGraphQLRequests;

    public function authenticate() : User
    {
        return app(\App\Factories\UserFactory::class)->createWithAuthentication();
    }
}
