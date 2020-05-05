<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermission($user->roles, 'user_view');
    }

    public function anyView(User $user, User $model)
    {
        return $user->hasPermission($user->roles, 'user_view') and $this->getRule($user, $model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission($user->roles, 'user_create');
    }

    public function includeProduces(User $user, User $model)
    {
        return $user->hasManyRules('Admin') or $user->hasManyRules('Coordenador');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->hasPermission($user->roles, 'user_edit') and $this->getRule($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermission($user->roles, 'user_delete') and $this->getRule($user, $model);
    }

    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->hasManyRules('Root')) {
            return true;
        }
    }

    /**
     * @param User $user
     * @param User $model
     * @return bool
     */
    private function getRule(User $user, User $model)
    {
        $retorno = false;
        if ($user->hasManyRules('Admin') or $user->hasManyRules('Coordenador')) {
            $retorno = $user->hasProduces($model->produces);
        }

        if ($user->hasManyRules('Revisor') or $user->hasManyRules('Editor')) {
            $retorno = $user->id == $model->id;
        }

        return $retorno;
    }
}
