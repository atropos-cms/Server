<?php

namespace Tests;

use Tests\Factories\UserFactory;

abstract class AuthenticatedGraphQLTestCase extends GraphQLTestCase
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var array
     */
    protected array $authUserPermissions = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->user = UserFactory::new()->authenticateWithPermissions($this->authUserPermissions)();
    }
}
