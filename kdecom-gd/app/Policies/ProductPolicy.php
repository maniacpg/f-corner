<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product_list'));
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product_add'));
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product_edit'));
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.product_delete'));
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        //
    }
}
