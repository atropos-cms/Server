<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Role;

class Group extends Role
{
    use Searchable;
}
