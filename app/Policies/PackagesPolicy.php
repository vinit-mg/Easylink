<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Packages;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagesPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Package list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, Packages $Package)
    {
        return $user->can('Package list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Package create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Packages $Package)
    {
        return $user->can('Package edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Packages $Package)
    {
        return $user->can('Package delete');
    }
}
