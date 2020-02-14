<?php

namespace Tests;

use App\Models\User;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

abstract class GraphQLTestCase extends TestCase
{
    use MakesGraphQLRequests;
    use UsesTenant;

    public function authenticate(): User
    {
        return app(\App\Factories\UserFactory::class)->createWithAuthentication();
    }
}
