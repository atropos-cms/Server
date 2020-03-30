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
        \App\Models\Permission::create([
            'name' => 'createUsers',
            'category' => 'administration',
        ]);
        \App\Models\Permission::create([
            'name' => 'editUsers',
            'category' => 'administration',
        ]);
        \App\Models\Permission::create([
            'name' => 'deleteUsers',
            'category' => 'administration',
        ]);
    }
}
