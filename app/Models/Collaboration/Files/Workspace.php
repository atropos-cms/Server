<?php

namespace App\Models\Collaboration\Files;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workspace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }
}
