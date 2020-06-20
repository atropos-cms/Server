<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Collaboration\Files\Workspace::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
