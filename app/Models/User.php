<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    protected $fillable = [
        'username', 'name', 'gender','birth_date', 'phone', 'email', 'password', 'image_name', 'image_path',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(DisLike::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourites::class);
    }

    public function unfavourites()
    {
        return $this->hasMany(UnFavourites::class);
    }

    public function systemLog()
    {
        return $this->hasMany(System_logs::class, 'id', 'user_id');
    }
}
