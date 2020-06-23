<?php

namespace Tests\Factories\Collaboration\Files;

use Lukeraymonddowning\Poser\Factory;
use App\Models\Collaboration\Files\File;

/**
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Files\File[]|\App\Models\Collaboration\Files\File __invoke($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Files\File[]|\App\Models\Collaboration\Files\File create($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Files\File[]|\App\Models\Collaboration\Files\File make($attributes = [])
 */
class FileFactory extends Factory
{
    protected static $modelName = File::class;
}
