<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AddOnFeatures;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddOnFeaturePolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('AddOnFeature list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, AddOnFeatures $addonfeature)
    {
        return $user->can('AddOnFeature list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('AddOnFeature create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, AddOnFeatures $addonfeature)
    {
        return $user->can('AddOnFeature edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, AddOnFeatures $addonfeature)
    {
        return $user->can('AddOnFeature delete');
    }
}
