<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    /**
     * -------------------------------------------------------------------------
     * Description
     * @return type
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function produces()
    {
        return $this->belongsTo(Produce::class);
    }

    /**
     * -------------------------------------------------------------------------
     * Description
     * @param type $permissionId
     * @return type
     */
    public function hasPermission($permissionId)
    {
        return $this->permissions->contains('id', $permissionId);
    }
    /**
     * ------------------------------------------------------------------------------------
     * Description
     * @param type|array $array
     * @return type
     */
    public static function all($array = [])
    {
        $autenticado = auth()->user();

        if (! $autenticado->can('view', Role::class)) {
            return collect([]);
        }

        $produtoras = [];
        $autenticado->produces->map(function ($produtora) use (&$produtoras) {
            $produtoras[] = $produtora->id;
        });

        $roles = self::getQuerySelect();

        if ($autenticado->can('viewRoleCoordenador', Role::class)) {
            $roles = $roles->whereNotIn('roles.id', [4,5])
            ->orWhere(function ($query) use ($produtoras) {
                $query->whereIn('roles.produce_id', $produtoras);
            });
        } elseif ($autenticado->can('viewRoleAdmin', Role::class)) {
            $roles = $roles->whereNotIn('roles.id', [5])
            ->orWhere(function ($query) use ($produtoras) {
                $query->whereIn('roles.produce_id', $produtoras);
            });
        }
        
        return $roles->get();
    }

    public static function getQuerySelect()
    {
        return Role::leftJoin('produces', 'produces.id', 'roles.produce_id')
        ->select(
            'roles.id',
            'roles.name',
            'roles.label',
            'roles.created_at',
            'roles.updated_at'
        );
    }
}
