<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = ['name', 'description', 'modulo_id'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
