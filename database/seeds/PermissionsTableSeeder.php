<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'updateMe',
            'updateMyPassword',
            'createUser',
            'updateUser',
            'deleteUser',
            'restoreUser',
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'name' => $permission,
                'category' => 'administration',
            ]);
        }
    }
}
