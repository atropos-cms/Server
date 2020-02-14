<?php

use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tenancy()->create('tenant.atropos-server.test');
        tenancy()->init('tenant.atropos-server.test');
    }
}
