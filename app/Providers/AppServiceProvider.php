<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
        Gate::policy(User::class, UserPolicy::class);
    }
}
