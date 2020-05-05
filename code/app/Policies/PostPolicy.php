<?php

namespace App\Policies;

use App\User;
use App\Models\Admin\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param \App\User $user
     * @param \App\Post $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        return true;
    }

    /**
     * @param User $user
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list(User $user)
    {
        return $user->hasPermission($user->roles, 'post_view');
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if ($user->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param \App\User $user
     * @param \App\Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param \App\User $user
     * @param \App\Post $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
    }
}
