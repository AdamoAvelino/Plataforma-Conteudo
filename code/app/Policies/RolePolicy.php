<?php

namespace App\Policies;

use App\User;
use App\Models\Admin\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    /**
     * ------------------------------------------------------------------------
     */
    public function before(User $user, $ability)
    {
        if ($user->hasManyRules('Root')) {
            return true;
        }
    }
    /**
     *  ------------------------------------------------------------------------
     */
    public function view(User $user)
    {
        return $user->hasPermission($user->roles, 'role_view');
    }
    /**
     * ------------------------------------------------------------------------
     */
    public function viewRoleCoordenador(User $user)
    {
        return $user->hasPermission($user->roles, 'role_view_coordenador');
    }
    /**
     * ------------------------------------------------------------------------
     */
    public function viewRoleAdmin(User $user)
    {
        return $user->hasPermission($user->roles, 'role_view_admin');
    }
    /**
     *  ------------------------------------------------------------------------
     */
    public function update(User $user, Role $role)
    {
        $user->hasPermission($user->roles, 'role_update');
    }
    /**
     *  ------------------------------------------------------------------------
     */
    public function create(User $user, Role $role)
    {
        $user->hasPermission($user->roles, 'role_create');
    }
    /**
     *  ------------------------------------------------------------------------
     */
    public function delete(User $user, Role $role)
    {
        $user->hasPermission($user->roles, 'role_delete');
    }
}
