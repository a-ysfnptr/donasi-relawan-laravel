<?php

namespace App\Policies;

use App\Models\Donation;
use App\Models\User;

class DonationPolicy
{
    // Anti-IDOR: pemilik atau admin saja.
    public function view(User $user, Donation $donation): bool
    {
        return $user->isAdmin() || $donation->user_id === $user->id;
    }
    public function update(User $user, Donation $donation): bool
    {
        return $donation->user_id === $user->id && $donation->status === 'menunggu';
    }
    public function cancel(User $user, Donation $donation): bool
    {
        return $donation->user_id === $user->id && $donation->status === 'menunggu';
    }
}
