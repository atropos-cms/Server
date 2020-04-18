<?php

namespace Tests\Factories\Collaboration;

use App\Models\Collaboration\Folder;
use Lukeraymonddowning\Poser\Factory;

/**
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Folder[]|\App\Models\Collaboration\Folder __invoke($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Folder[]|\App\Models\Collaboration\Folder create($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Collaboration\Folder[]|\App\Models\Collaboration\Folder make($attributes = [])
 */
class FolderFactory extends Factory
{
    protected static $modelName = Folder::class;
}
