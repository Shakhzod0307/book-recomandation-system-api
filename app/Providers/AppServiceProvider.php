<?php

namespace App\Providers;

use App\Models\Genre;
use App\Models\Role;
use App\Policies\GenrePolicy;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        Gate::policy(Genre::class, GenrePolicy::class);
        Gate::policy(Role::class, RolePolicy::class);


    }
}
