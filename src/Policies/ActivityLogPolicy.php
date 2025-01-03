<?php

namespace L0MAX\ActivityLog\Policies;

use App\Models\User;
use L0MAX\ActivityLog\ActivityLog;

class ActivityLogPolicy
{
    public function view(User $user, ActivityLog $log)
    {
        // Admins can view all logs
        if ($user->hasRole('admin')) {
            return true;
        }

        // Non-admins can only view their own logs
        return $log->user_id === $user->id;
    }
}
