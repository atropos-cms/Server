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
        foreach (\App\Enums\Permission::getValues() as $permission) {
            $category = \Illuminate\Support\Str::before($permission, '-');
            \App\Models\Permission::create([
                'name' => $permission,
                'category' => $category,
            ]);
        }
    }
}
