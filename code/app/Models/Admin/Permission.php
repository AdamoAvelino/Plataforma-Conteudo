<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label', 'modulo_id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
