<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-rooms', function (User $user) {
            return true;
        });

        Gate::define('manage-positions', function (User $user) {

            return true;
        });

        Gate::define('manage-users', function (User $user) {
            return true;
        });
    }
}
