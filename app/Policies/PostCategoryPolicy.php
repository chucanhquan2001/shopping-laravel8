<?php

namespace App\Policies;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->checkPermission(config('common.permissions.post_categories.post-category-list'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostCategory  $postCategory
     * @return mixed
     */
    public function view(User $user, PostCategory $postCategory)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermission(config('common.permissions.post_categories.post-category-add'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostCategory  $postCategory
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermission(config('common.permissions.post_categories.post-category-edit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostCategory  $postCategory
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermission(config('common.permissions.post_categories.post-category-delete'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostCategory  $postCategory
     * @return mixed
     */
    public function restore(User $user, PostCategory $postCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostCategory  $postCategory
     * @return mixed
     */
    public function forceDelete(User $user, PostCategory $postCategory)
    {
        //
    }
}