<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Role::create([
            'name' => 'Admin',
        ]);

        $permissions = \App\Models\Permission::pluck('id');
        $admin->permissions()->sync($permissions);
    }
}
