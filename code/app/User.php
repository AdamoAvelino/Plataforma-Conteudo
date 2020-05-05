<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\Role;
use App\Models\Admin\Produce;

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

    public function produces()
    {
        return $this->belongsToMany(Produce::class, 'user_produce');
    }

    public function hasPermission($roles, $permission_name)
    {
        $retorno = false;
        foreach ($roles as $role) {
            if ($role->permissions->contains('name', $permission_name)) {
                $retorno = true;
                break;
            }
        }
        return $retorno;
    }

    /**
     * @param $produces
     * @return bool
     */
    public function hasProduces($produces)
    {
        if (is_array($produces) or is_object($produces)) {
            foreach ($produces as $produce) {
                if ($this->produces->contains('id', $produce->id)) {
                    return true;
                }
            }
        }
        return $this->produces->contains('id', $produces);
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

    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAll()
    {
        $autenticado = auth()->user();
        if ($autenticado->hasManyRules('Coordenador')) {
            $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.email', 'users.created_at')
                ->whereIn('roles.id', [2, 3])
                ->groupBy('users.id')->get();

            return $users;
        } else if ($autenticado->hasManyRules('Admin')) {

            $produtora = [];
            $autenticado->produces->map(function ($produtoras) use (&$produtora) {
                $produtora[] = $produtoras->id;
            });

            $user = User::join('user_produce', 'users.id', '=', 'user_produce.user_id')
                ->whereIn('user_produce.produce_id', $produtora)
                ->select('users.id', 'users.name', 'users.email', 'users.created_at')
                ->groupBy('users.id')->get();

            return $user;
        }

        $users = self::all();
        return $users;
    }
}
