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
        // If apero is postulable and if user is not the host and has not postulated, the user can postulate
        if ($apero->postulable && $apero->host_id !== $user->id && !Postulation::where('apero_id', $apero->id)->where('user_id', $user->id)->exists()) {
            return true;
        }

        return false;
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
        if ($postulation->isOpen && $postulation->user_id === $user->id) {
            return true;
        }

        return false;
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
        // Can cancel if never cancelled and if the user is the one who did the postulation
        if (!$postulation->isCancelled && $postulation->user_id === $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can cancel the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function accept(User $user, Postulation $postulation, Apero $apero)
    {
        // Can accept if open and if the user is the host
        if ($postulation->isOpen && $apero->host_id === $user->id) {
            return true;
        }

        return false;
    }

     /**
     * Determine whether the user can cancel the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function decline(User $user, Postulation $postulation, Apero $apero)
    {
        // Can decline if open and if the user is the host
        if ($postulation->isOpen && $apero->host_id === $user->id) {
            return true;
        }

        return false;
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
