<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Produce extends Model
{
    protected $fillable = ['name', 'cnpj', 'telephone', 'email'];

    public function users()
    {
    	return $this->belongsToMany(User::class, 'user_produce');
    }
}
