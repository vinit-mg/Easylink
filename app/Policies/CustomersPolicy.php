<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customers;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomersPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Customers list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user)
    {
        return $user->can('Customers list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Customers create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user)
    {
        return $user->can('Customers edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user)
    {
        return $user->can('Customers delete');
    }
}
