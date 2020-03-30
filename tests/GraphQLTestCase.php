<?php

namespace Tests;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

abstract class GraphQLTestCase extends TestCase
{
    use MakesGraphQLRequests;
    use UsesTenant;
}
