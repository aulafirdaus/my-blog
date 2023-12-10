<?php

namespace App\Traits;

use App\Models\Role;

trait HasRole
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function hasAnyRoles(...$roles)
    {
        foreach ($roles as $role) {
            if (str($this->roles->pluck('name'))->contains($role)) {
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
