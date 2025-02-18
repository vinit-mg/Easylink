<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StoreNotifications;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreNotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Store notification list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, StoreNotifications $StoreNotification)
    {
        return $user->can('Store notification list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Store notification create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, StoreNotifications $StoreNotification)
    {
        return $user->can('Store notification edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, StoreNotifications $StoreNotification)
    {
        return $user->can('Store notification delete');
    }
}
