<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

abstract class GraphQLTestCase extends TestCase
{
    use RefreshDatabase;
    use MakesGraphQLRequests;
}
