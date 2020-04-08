<?php

namespace App\Models\Website;

use App\Models\User;
use App\Enums\ContentType;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Navigationentry extends Model
{
    use SoftDeletes;
//    use Searchable;
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
     * Returns the currently highest order number for any navigationentry
     *
     * @return int
     */
    public function getHighestOrderNumber(): int
    {
        return (int) static::query()->max('order');
    }

    public static function setNewOrder($ids, int $startOrder = 1)
    {
        if (! is_array($ids) && ! $ids instanceof ArrayAccess) {
            throw new InvalidArgumentException('You must pass an array or ArrayAccess object to setNewOrder');
        }

        foreach ($ids as $id) {
            static::withoutGlobalScope(SoftDeletingScope::class)
                ->where('id', $id)
                ->update(['order' => $startOrder++]);
        }
    }

    /**
     * Gets the author for this entry
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the content for this entry
     *
     * @return MorphTo
     */
    public function content(): MorphTo
    {
        return $this->morphTo();
    }
}
