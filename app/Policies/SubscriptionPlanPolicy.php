<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPlanPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('SubscriptionPlan list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, SubscriptionPlan $SubscriptionPlan)
    {
        return $user->can('SubscriptionPlan list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('SubscriptionPlan create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, SubscriptionPlan $SubscriptionPlan)
    {
        return $user->can('SubscriptionPlan edit');
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
