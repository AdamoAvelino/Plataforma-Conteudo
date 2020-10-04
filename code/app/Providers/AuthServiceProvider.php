<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Policies\UserPolicy;
use App\Models\Admin\Post;
use App\Policies\PostPolicy;
use App\Models\Admin\Role;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('post_view', function ($user, $post) {
//            $roles = $user->roles;
//            $dono = $user->id == $post->user_id;
//            $permissao = $user->hasPermission($roles, 'post_view');
//            return $permissao and $dono;
//        });
//
//        Gate::before(function (User $user, $ability) {
//            if ($user->roles->contains('name', 'Root')) {
//                return true;
//            }
//
//        });
    }
}
