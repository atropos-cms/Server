<?php

namespace App\Models\Collaboration\Files;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use SoftDeletes;

    protected static function booted()
    {
        static::creating(function (File $model) {
            $model->uuid = Uuid::uuid4();
        });
    }

    protected $fillable = [
        'name',
        'mime_type',
        'original_filename',
        'file_extension',
        'sha256_checksum',
        'size',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function getStoragePathAttribute()
    {
        return "{$this->uuid}.{$this->file_extension}";
    }
}
