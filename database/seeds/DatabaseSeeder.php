<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a tenant
        $this->call(TenantSeeder::class);

        // These seeders apply to the tenant just created
        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
    }
}
