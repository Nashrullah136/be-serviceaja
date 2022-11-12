<?php

namespace App\Policies;

use App\Models\Motor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MotorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Motor $motor)
    {
        return $user->id === $motor->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Motor $motor)
    {
        return $user->id === $motor->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Motor $motor)
    {
        return $user->id === $motor->user_id;
    }

}
