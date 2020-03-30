<?php

namespace Tests;

use App\Models\User;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

abstract class GraphQLTestCase extends TestCase
{
    use MakesGraphQLRequests;
    use UsesTenant;
}
