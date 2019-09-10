<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use SoftDeletes;
    use Searchable;

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
