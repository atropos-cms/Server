<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Website\Navigationentry::class, function (Faker $faker) {
    $contentType = $faker->randomElement(\App\Enums\ContentType::getValues());
    $content = factory($contentType)->create();

    $author = optional(\App\Models\User::inRandomOrder()->first())->id;

    return [
        'title' => $faker->sentence,
        'slug' => $faker->word,
        'published' => $faker->boolean,
        'type' => $faker->randomElement(\App\Enums\ContentType::getValues()),

        'author_id' => $author,

        'content_id' => $content->id,
        'content_type' => $contentType,
    ];
});
