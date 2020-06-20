<?php

namespace Tests;

use Tests\Factories\UserFactory;

abstract class AuthenticatedGraphQLTestCase extends GraphQLTestCase
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = UserFactory::new()->withAuthentication()();
    }
}
