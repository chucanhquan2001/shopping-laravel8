<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->checkPermission(config('common.permissions.reviews.review-list'));
    }

    public function create(User $user)
    {
        return $user->checkPermission(config('common.permissions.reviews.review-reply'));
    }
    public function update(User $user)
    {
        return $user->checkPermission(config('common.permissions.reviews.review-edit'));
    }
    public function delete(User $user)
    {
        return $user->checkPermission(config('common.permissions.reviews.review-delete'));
    }
}