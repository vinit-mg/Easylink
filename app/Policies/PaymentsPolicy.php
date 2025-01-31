<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payments;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentsPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Payment list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, Payments $Payment)
    {
        return $user->can('Payment list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Payment create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Payments $Payment)
    {
        return $user->can('Payment edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Payments $Payment)
    {
        return $user->can('Payment delete');
    }
}
