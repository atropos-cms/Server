<?php

namespace App\Models\Website;

use App\Models\User;
use App\Enums\ContentType;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use SoftDeletes;
    use Searchable;
    use CastsEnums;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $model) {
            $model->slug = Str::slug($model->title);
            $model->order = $model->getHighestOrderNumber() + 1;
        });

        static::saving(function (self $model) {
            $model->author_id = auth()->id();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'published', 'type',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'published' => false,
    ];

    /**
     * Map attribute names to enum classes.
     *
     * @var array
     */
    protected $enumCasts = [
        'type' => ContentType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determines the next value for the order column
     *
     * @return int
     */
    public function getHighestOrderNumber(): int
    {
        return (int) static::query()->max('order');
    }
}