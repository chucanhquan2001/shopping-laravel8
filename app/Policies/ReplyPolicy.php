<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    public function viewAny(User $user)
    {
        return $user->checkPermission(config('common.permissions.replies.reply-list'));
    }
    public function update(User $user)
    {
        return $user->checkPermission(config('common.permissions.replies.reply-edit'));
    }
    public function delete(User $user)
    {
        return $user->checkPermission(config('common.permissions.replies.reply-delete'));
    }
}