<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Role;
use App\Models\Admin\Produce;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * -------------------------------------------------------------------------------------------------------
     * POssivei atributos para pesistencia na base de dados
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo', 'active', 'cpf', 'telefone', 'cnpj'
    ];

    /**
     * -------------------------------------------------------------------------------------------------------
     * Atributos ocultos do formulario.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * -------------------------------------------------------------------------------------------------------
     * Metodos de relacionamento da entidade Role
     * @return Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * -------------------------------------------------------------------------------------------------------
     * Metodo de relacionamento da entidade Produce
     * @return Produce
     */
    public function produces()
    {
        return $this->belongsToMany(Produce::class, 'user_produce');
    }

    /**
     * -------------------------------------------------------------------------------------------------------
     * @param Collection $role objeto Collection de Role
     * @param String $permission_name nome da permission para verificar a possivel
     * existêmncia em alguma role da collection
     * @return boolean
     */
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
     * -------------------------------------------------------------------------------------------------------
     * Verificar se o objeto usuário pertence à alguma produce da Collection injetada
     * @param Collection $produces coleção de produce
     * @return boolean
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
     * -------------------------------------------------------------------------------------------------------
     * Verificar se objeto do usuário tem alguma role na Collecton injetada
     * @param  Collection  $roles Coleção de Role
     * @return boolean
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

    public static function getUser($id)
    {
        $autenticado = auth()->user();
        $user = self::find($id);
        $view = (
            $autenticado->can('anyView', $user) or
            $autenticado->can('viewUserCoordenador', $user) or
            $autenticado->can('viewUserAdmin', $user) or
            $autenticado->can('viewUserSelf', $user)
        );
        if ($view) {
            return $user;
        }
        return false;
    }

    /**
     * -------------------------------------------------------------------------------------------------------
     * Metodo que retorna uma coleção de objetos usuário de acordo com a permissão do usuário autenticado
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function all($array = [])
    {
        $autenticado = auth()->user();
        $produtora = [];

        // Seta a produrora do usuário logado
        $autenticado->produces->map(function ($produtoras) use (&$produtora) {
            $produtora[] = $produtoras->id;
        });

        $users = self::getQuerySelect();

        // Coordenador pode listar usuarios editores e/ou revesores da própria produtora.
        if ($autenticado->can('anyView', $autenticado)) {
            $users = $users->groupBy('users.id')->get();
            return $users;
        } elseif ($autenticado->can('viewUserCoordenador', $autenticado)) {
            // dd('coor');
            $users = $users->whereIn('roles.id', [1, 2, 3])
            ->whereIn('user_produce.produce_id', $produtora)
            ->groupBy('users.id')->get();

            return $users;
            
        // Admin pode listar todos os usuários de sua produtora
        } elseif ($autenticado->can('viewUserAdmin', $autenticado)) {
            $users = $users->whereIn('user_produce.produce_id', $produtora)->groupBy('users.id')->get();
            return $users;

        // Revisores e Editodores só podem ver seu perfil
        } elseif ($autenticado->can('viewUserSelf', $autenticado)) {
            $users = $users->where('users.id', $autenticado->id)
            ->groupBy('users.id')
            ->get();

            return $users;
        }
    }

    /**
     * -------------------------------------------------------------------------------------------------------
     * Query Principla para listagem de usuarios em relatórios.
     * @return User|QueryBuilder
     */
    private static function getQuerySelect()
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->leftJoin('user_produce', 'user_produce.user_id', '=', 'users.id')
        ->leftJoin('produces', 'produces.id', '=', 'user_produce.produce_id')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.created_at',
            'users.active',
            DB::raw('GROUP_CONCAT(roles.name) roles'),
            DB::raw('GROUP_CONCAT(DISTINCT produces.name) as produce')
        );

        return $users;
    }
}
