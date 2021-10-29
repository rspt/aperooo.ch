<?php

namespace App\Policies;

use App\Models\Apero;
use App\Models\Postulation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostulationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Postulation $postulation)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Apero $apero)
    {
        // If user is host, the user can't postulate
        if ($apero->host_id === $user->id) {
            return false;
        }

        // If user has already postulated, he cannot do it once more
        if (Postulation::where('apero_id', $apero->host_id)->where('user_id', $user->id)->exists()) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Postulation $postulation)
    {
        //
    }

    /**
     * Determine whether the user can cancel the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function cancel(User $user, Postulation $postulation)
    {
        // Cannot cancel if already cancelled
        if ($postulation->status === 'cancelled') {
            return false;
        }

        // Cannot cancel if the user is not the one who did the postulation
        if ($postulation->user_id !== $user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Postulation $postulation)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Postulation $postulation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Postulation $postulation)
    {
        //
    }
}
