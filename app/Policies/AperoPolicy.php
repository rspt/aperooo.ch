<?php

namespace App\Policies;

use App\Models\Apero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AperoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Apero $apero)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Apero $apero)
    {
        if ($user->id === $apero->host_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Apero $apero)
    {
        if ($user->id === $apero->host_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Apero $apero)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Apero $apero)
    {
        //
    }
}
