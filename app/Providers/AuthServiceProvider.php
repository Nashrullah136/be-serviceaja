<?php

namespace App\Providers;

use App\Models\Motor;
use App\Models\Schedule;
use App\Models\User;
use App\Policies\MotorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Motor::class => MotorPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-schedule', function (User $user, Schedule $schedule){
            return $user->id === $schedule->motor->user_id;
        });

    }
}
