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

    public function initializeTenancy($domain = 'test.localhost')
    {
        config([
            'tenancy.database.prefix' => 'testing/',
            'tenancy.database.suffix' => '.sqlite',
            'tenancy.queue_database_creation' => false,
        ]);

        tenancy()->create($domain);
        tenancy()->all();

        tenancy()->init($domain);
    }

    public function tearDown(): void
    {
        config([
            'tenancy.queue_database_deletion' => false,
            'tenancy.delete_database_after_tenant_deletion' => true,
        ]);
        tenancy()->all()->each->delete();

        parent::tearDown();
    }
}
