<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SettingPolicy
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
        return $user->checkPermissionAccess(config('permissions.access.setting_list'));
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.setting_add'));
    }

    public function update(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.setting_edit'));
    }

    public function delete(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.setting_delete'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Setting $setting): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Setting $setting): bool
    {
        //
    }
}
