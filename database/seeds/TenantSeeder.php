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
        $tenant = \App\Models\Tenant::create();
        $tenant->domains()->create([
            'domain' => 'tenant.atropos-server.test',
        ]);
        tenancy()->initialize($tenant);
    }
}
