<?php

namespace App\Policies;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TripPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole([1,2]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Trip $trip)
    {
        return $user->hasRole([1]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if($user->hasPermissionTo(10) || $user->hasRole([1])) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Trip $trip)
    {
        if($user->hasPermissionTo(11) || $user->hasRole([1])) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Trip $trip)
    {
        if($user->hasPermissionTo(12) || $user->hasRole([1])) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Trip $trip)
    {
        return $user->hasRole([1]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Trip $trip)
    {
        return $user->hasRole([1]);
    }
}
