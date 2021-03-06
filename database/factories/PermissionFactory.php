<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Models\Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'category' => $faker->randomElement(['administration', 'content']),
    ];
});
