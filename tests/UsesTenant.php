<?php

namespace Tests;

trait UsesTenant
{
    protected bool $tenancy = true;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');

        if ($this->tenancy) {
            $this->initializeTenancy();
        }
    }

    public function initializeTenancy($domain = 'tenant')
    {
        config()->set('app.url', "http://$domain.localhost");

        config([
            'tenancy.database.prefix' => 'testing/',
            'tenancy.database.suffix' => '.sqlite',
            'tenancy.queue_database_creation' => false,
        ]);

        $tenant = \App\Models\Tenant::create();
        $tenant->domains()->create([
            'domain' => $domain,
        ]);

        tenancy()->initialize($tenant);
    }
}
