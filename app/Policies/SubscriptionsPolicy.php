<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscriptions;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionsPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Subscription list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, Subscriptions $Subscription)
    {
        return $user->can('Subscription list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Subscription create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Subscriptions $Subscription)
    {
        return $user->can('Subscription edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Subscriptions $Subscription)
    {
        return $user->can('Subscription delete');
    }
}
