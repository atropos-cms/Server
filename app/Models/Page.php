<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Page extends Model
{
    use SoftDeletes;
    use Searchable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Page $model) {
            $model->slug = Str::slug($model->title);
        });

        static::saving(function (Page $model) {
            $model->author_id = auth()->id();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'content', 'published'
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'published' => false
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
