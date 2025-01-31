<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Stores;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Stores list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, Stores $store)
    {
        return $user->can('Stores list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Stores create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Stores $store)
    {
        return $user->can('Stores edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Stores $store)
    {
        return $user->can('Stores delete');
    }

}
