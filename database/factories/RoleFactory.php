<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;
use Spatie\Permission\Guard;

$factory->define(Role::class, function (Faker $faker) {
    $guardName = Guard::getDefaultName(Role::class);

    return [
        'name' => $faker->colorName,
        'description' => $faker->paragraph,

        'guard_name' => $guardName
    ];
});
