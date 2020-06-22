<?php

namespace Tests\Factories\Collaboration\Files;

use Lukeraymonddowning\Poser\Factory;
use App\Models\Collaboration\Files\Folder;

/**
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Files\Folder[]|\App\Models\Collaboration\Files\Folder __invoke($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Files\Folder[]|\App\Models\Collaboration\Files\Folder create($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Files\Folder[]|\App\Models\Collaboration\Files\Folder make($attributes = [])
 */
class FolderFactory extends Factory
{
    protected static $modelName = Folder::class;
}
