<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Class AuthServiceProvider
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-advert', function ($user, $advert) {
            return $advert->isAuthor($user->id);
        });

        Gate::define('update-advert', function ($user, $advert) {
            return $advert->isAuthor($user->id);
        });

        Gate::define('delete-advert', function ($user, $advert) {
            return $advert->isAuthor($user->id);
        });
    }
}
