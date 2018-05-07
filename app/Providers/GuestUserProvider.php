<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuestUserProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Pseudo\Contracts\GuestContract::class, \App\GuestUser::class);
    }
}
