<?php

namespace App\Models;

use App\Enums\RoleMailingList;
use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use Searchable;

    protected $attributes = [
        'mailing_list' => RoleMailingList::Disabled,
    ];

    public function getMembersCountAttribute(): int
    {
        return $this->users()->count();
    }
}
