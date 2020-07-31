<?php

namespace Tests;

use App\Models\Tenant;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

abstract class GraphQLTestCase extends TestCase
{
    use MakesGraphQLRequests;
    use UsesTenant;

    /**
     * Return the full URL to the GraphQL endpoint.
     */
    protected function graphQLEndpointUrl(): string
    {
        /** @var Tenant $tenant */
        $tenant = tenant();

        if (! $tenant) {
            return route(config('lighthouse.route.name'));
        }

        return config('app.url') . '/' . config('lighthouse.route.name');
    }
}
