<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isAdmin',function($user){
            return $user->role === 'admin';
        });
        Gate::define('isBusinessPerson',function($user){
            return $user->role === 'business';
        });
        Gate::define('isRegular',function($user){
            return $user->role === 'regular';
        });
        Gate::define('isAcquaintance',function($user){
            return $user->role === 'acquaintance';
        });
        Passport::routes();
        //

    }
}
