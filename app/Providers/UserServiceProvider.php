<?php

namespace TeamSnap\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('layouts.new', 'TeamSnap\Http\ViewComposer\UserComposer');
        view()->composer('layouts.app', 'TeamSnap\Http\ViewComposer\UserDetailComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
