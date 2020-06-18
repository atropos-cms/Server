<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = tenant();
        $domain = \Illuminate\Support\Arr::first($tenant->domains);

        $admin = \App\Models\Role::create([
            'name' => 'Admin',
            'email_address' => 'admin@' . $domain,
        ]);

        $permissions = \App\Models\Permission::pluck('id');
        $admin->permissions()->sync($permissions);
    }
}
