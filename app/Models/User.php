<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;
    use Searchable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'street', 'postcode', 'city', 'country', 'email', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'login_at' => 'datetime',
        'deleted_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function getInitialsAttribute(): string
    {
        return substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
