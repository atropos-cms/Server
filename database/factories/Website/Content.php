<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Website\Content::class, function (Faker $faker) {
    $author = optional(\App\Models\User::inRandomOrder()->first())->id;

    return [
        'title' => $faker->sentence,
        'slug' => $faker->word,
        'content' => $faker->paragraph,
        'published' => $faker->boolean,
        'type' => $faker->randomElement(\App\Enums\ContentType::getValues()),
        'author_id' => $author,
    ];
});
