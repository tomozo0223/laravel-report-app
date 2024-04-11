<?php

namespace App\Policies;

use App\Consts\UserConst;
use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Report $report): bool
    {
        return $report->user->id === $user->id || $user->role === UserConst::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Report $report): bool
    {
        return $report->user->id === $user->id || $user->role === UserConst::ROLE_ADMIN;
    }
}
