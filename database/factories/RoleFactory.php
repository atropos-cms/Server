<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Spatie\Permission\Guard;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    $guardName = Guard::getDefaultName(Role::class);

    return [
        'name' => $faker->colorName,
        'description' => $faker->paragraph,

        'guard_name' => $guardName,
    ];
});
