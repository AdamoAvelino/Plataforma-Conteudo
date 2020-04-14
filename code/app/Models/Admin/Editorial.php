<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    protected $fillable = ['name'];

    public function produces()
    {
    	return $this->belongsToMany(Produce::class);
    }
}
