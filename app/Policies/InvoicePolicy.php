<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $user->checkPermission(config('common.permissions.invoices.invoice-list'));
    }

    public function update(User $user)
    {
        return $user->checkPermission(config('common.permissions.invoices.invoice-edit'));
    }
}