<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'status_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function categorys()
    {
    	return $this->belongsToMany(Category::class, 'post_category');
    }
}
