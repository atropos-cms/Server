<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Collaboration\Files\File::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'mime_type' => $faker->mimeType,
        'original_filename' => $faker->name,
        'file_extension' => $faker->fileExtension,
        'sha256_checksum' => $faker->sha256,
        'size' => $faker->numberBetween(),
    ];
});
