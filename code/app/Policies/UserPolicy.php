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
    /**
     * ----------------------------------------------------------------------------------
     */
    public function anyView(User $user, User $model)
    {
        // return $user->hasPermission($user->roles, 'user_view') and $this->getRule($user, $model);
        return $user->hasPermission($user->roles, 'user_view_any');
    }
    /**
     * ----------------------------------------------------------------------------------
     */
    public function viewUserCoordenador(User $user, User $model)
    {
        $coordenador = $user->hasPermission($user->roles, 'user_view_coordenador');
        $rolePermission = true;
        $producePermission = true;
        
        if ($model) {
            $rolePermission = false;
            $producePermission = false;
            
            
            $rolePermission = $model->roles->contains(function ($value, $key) {
                return in_array($value->id, [1, 2, 3]);
            });

            $producePermission = $this->producePermission($user, $model);
        }
        // dd($coordenador and $rolePermission and $producePermission);
        // dd($rolePermission);
        // dd($producePermission);
        return $coordenador and $rolePermission and $producePermission;
    }
    /**
     * ----------------------------------------------------------------------------------
     */
    public function viewUserAdmin(User $user, User $model)
    {
        $permissionAdmin = $user->hasPermission($user->roles, 'user_view_admin');
        $producePermission = $this->producePermission($user, $model);
        return $permissionAdmin and $producePermission;
    }
    /**
     * ----------------------------------------------------------------------------------
     */
    public function viewUserSelf(User $user, User $model)
    {
        $viewPerfil = $user->hasPermission($user->roles, 'user_view_self');
        $perfil = $user->id == $model->id;
        return $perfil and $viewPerfil;
    }
    /**
     * ----------------------------------------------------------------------------------
     * Apenas usuários donos de deu perfíl podem inativar perfíl
     */
    public function updateActive(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    /**
     * --------------------------------------------------------------------------------
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        // dd($user->roles);
        return $user->hasPermission($user->roles, 'user_create');
    }

    /**
     * ----------------------------------------------------------------------------------
     */
    public function includeProduces(User $user)
    {
        return $user->hasManyRules('Admin') or $user->hasManyRules('Coordenador');
    }

    /**
     * ----------------------------------------------------------------------------------
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
     * ----------------------------------------------------------------------------------
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
     * ----------------------------------------------------------------------------------
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

    private function producePermission($user, $model)
    {
        $produtorasUser = $user->produces->map(function ($produtora) {
            return $produtora->id;
        });

        $producePermission = $model->produces->contains(function ($value, $key) use ($produtorasUser) {
            return in_array($value->id, $produtorasUser->toArray());
        });

        return $producePermission;
    }

    /**
     * ----------------------------------------------------------------------------------
     * @param User $user
     * @param User $model
     * @return bool
     */
    private function getRule(User $user, User $model)
    {
        $retorno = false;

        if ($user->hasManyRules('Revisor') or $user->hasManyRules('Editor')) {
            $retorno = $user->id == $model->id;
        }

        if ($user->hasManyRules('Admin') or $user->hasManyRules('Coordenador')) {
            $retorno = $user->hasProduces($model->produces);
        }

        return $retorno;
    }
}
