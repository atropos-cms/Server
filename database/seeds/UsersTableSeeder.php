<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \Tests\Factories\UserFactory::new()->create([
            'email' => 'admin@localhost',
        ]);

        $admin->assignRole('Admin');

        factory(\App\Models\User::class, 100)->create();
    }
}
