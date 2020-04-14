<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo', 'active'
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
     * [roles description]
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * [hasPermission description]
     * @param  Permission $permission [description]
     * @return boolean                [description]
     */

    public function hasPermission(Permission $permission)
    {
        return $this->hasManyRules($permission->roles);
    }

    /**
     * [hasManyRules description]
     * @param  [type]  $roles [description]
     * @return boolean        [description]
     */
    public function hasManyRules($roles)
    {
        if (is_array($roles) or is_object($roles)) {
            foreach ($roles as $role) {
                if ($this->roles->contains('name', $role->name)) {
                    return true;
                }
            }
        }

        return $this->roles->contains('name', $roles);
    }
}
