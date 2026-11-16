<?php

namespace App\Providers;

use App\Models\Donation;
use App\Models\Volunteer;
use App\Policies\DonationPolicy;
use App\Policies\VolunteerPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot(): void
    {
        Gate::policy(Donation::class, DonationPolicy::class);
        Gate::policy(Volunteer::class, VolunteerPolicy::class);
        Gate::define('admin', fn ($user) => $user->isAdmin());
    }
}
