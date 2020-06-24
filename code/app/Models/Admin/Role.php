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
        // dd($autenticado);
        $produtoras = [];
        $autenticado->produces->map(function ($produtora) use (&$produtoras) {
            $produtoras[] = $produtora->id;
        });

        $roles = self::getQuerySelect();

        if ($autenticado->hasManyRules('Coordenador')) {
            $roles = $roles->whereIn('roles.id', [1,2,3])
            ->orWhere(function ($query) use ($produtoras) {
                $query->whereIn('roles.produce_id', $produtoras);
            });
        } elseif ($autenticado->hasManyRules('Admin')) {
            $roles = $roles->whereIn('roles.id', [1,2,3,4])
            ->orWhere(function ($query) use ($produtoras) {
                $query->whereIn('roles.produce_id', $produtoras);
            });
        }
        // echo $roles->toSql();
        // dd('para');
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
