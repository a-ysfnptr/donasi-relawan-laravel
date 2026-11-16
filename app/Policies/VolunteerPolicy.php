<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Volunteer;

class VolunteerPolicy
{
    public function view(User $user, Volunteer $volunteer): bool
    {
        return $user->isAdmin() || $volunteer->user_id === $user->id;
    }
    public function cancel(User $user, Volunteer $volunteer): bool
    {
        return $volunteer->user_id === $user->id && $volunteer->status === 'menunggu';
    }
}
