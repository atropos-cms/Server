<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Page;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    $author = optional(User::inRandomOrder()->first())->id;

    return [
        'title' => $faker->sentence,
        'slug' => $faker->word,
        'content' => $faker->paragraph,
        'published' => $faker->boolean,
        'author_id' => $author,
    ];
});
