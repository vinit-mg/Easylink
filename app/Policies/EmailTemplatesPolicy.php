<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EmailTemplates;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailTemplatesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categorys.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('Email template list');
    }

    /**
     * Determine whether the user can view a specific category.
     *
     * @return mixed
     */
    public function adminView(User $user, EmailTemplates $EmailTemplate)
    {
        return $user->can('Email template list');
    }

    /**
     * Determine whether the user can create categorys.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('Email template create');
    }

    /**
     * Determine whether the user can update a specific category.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, EmailTemplates $EmailTemplate)
    {
        return $user->can('Email template edit');
    }

    /**
     * Determine whether the user can delete a specific category.
     *
     * @return mixed
     */
    public function adminDelete(User $user, EmailTemplates $EmailTemplate)
    {
        return $user->can('Email template delete');
    }
}
