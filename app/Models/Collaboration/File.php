<?php

namespace App\Models\Collaboration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mime_type',
        'original_filename',
        'file_extension',
        'sha256_checksum',
        'size',
    ];
}
