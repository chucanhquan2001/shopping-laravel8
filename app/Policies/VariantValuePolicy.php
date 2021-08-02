<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VariantValue;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariantValuePolicy
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
        return $user->checkPermission(config('common.permissions.variant_values.variant-value-list'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VariantValue  $variantValue
     * @return mixed
     */
    public function view(User $user)
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
        return $user->checkPermission(config('common.permissions.variant_values.variant-value-add'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VariantValue  $variantValue
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermission(config('common.permissions.variant_values.variant-value-edit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VariantValue  $variantValue
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermission(config('common.permissions.variant_values.variant-value-delete'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VariantValue  $variantValue
     * @return mixed
     */
    public function restore(User $user, VariantValue $variantValue)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VariantValue  $variantValue
     * @return mixed
     */
    public function forceDelete(User $user, VariantValue $variantValue)
    {
        //
    }
}