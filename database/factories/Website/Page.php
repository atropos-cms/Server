<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Website\Page::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
    ];
});
