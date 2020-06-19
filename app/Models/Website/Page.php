<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    public function getBodyAttribute($value)
    {
        if (! is_null($value)) {
            return $value;
        }

        return '{}';
    }

    /**
     * Get the page's navigationentry.
     */
    public function navigationentry(): MorphOne
    {
        return $this->morphOne(Navigationentry::class, 'content');
    }
}
