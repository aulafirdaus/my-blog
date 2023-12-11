<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasRole;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function articles(){
        return $this->hasMany(Article::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function toggleLike($model)
    {
        $exists = $this->likes()->whereMorphedTo('likeable', $model)->exists();
        if (!$exists) {
            $this->likes()->save($model->likes()->make());
        } else {
            $this->likes()->whereMorphedTo('likeable', $model)->delete();
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function hasAnyRoles(...$roles)
    {
        foreach ($roles as $role) {
            if (str($this->roles->pluck('name'))->containsAll($role)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
}
