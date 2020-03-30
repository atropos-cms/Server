<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use Searchable;

    public function getMembersCountAttribute(): int
    {
        return $this->users()->count();
    }
}
