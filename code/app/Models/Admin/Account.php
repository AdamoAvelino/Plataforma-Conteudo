<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Account extends Model
{
    protected $fillable = [
    	'name',
    	'description',
    	'account_class_id',
    	'user_id',
    	'active',
    	'final_date'
    ];

    public function class()
    {
    	return $this->belongsTo(AccountClass::class, 'account_class_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
