<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AddOnPurchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddOnPurchasePolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('AddOnPurchase list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, AddOnPurchase $AddOnPurchase)
    {
        return $user->can('AddOnPurchase list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('AddOnPurchase create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, AddOnPurchase $AddOnPurchase)
    {
        return $user->can('AddOnPurchase edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, AddOnPurchase $AddOnPurchase)
    {
        return $user->can('AddOnPurchase delete');
    }
}
