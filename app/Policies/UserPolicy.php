<?php

namespace App\Policies;

use App\Consts\UserConst;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->role !== $model->role && $user->role === UserConst::ROLE_ADMIN;
    }
}
