<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AddOns;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddOnsPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('AddOn list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, AddOns $AddOn)
    {
        return $user->can('AddOn list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('AddOn create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, AddOns $AddOn)
    {
        return $user->can('AddOn edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, AddOns $AddOn)
    {
        return $user->can('AddOn delete');
    }
}
