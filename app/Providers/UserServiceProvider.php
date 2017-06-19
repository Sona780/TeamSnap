<?php

namespace Org4Leagues\Providers;

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
        //view()->composer('layouts.new', 'Org4Leagues\Http\ViewComposer\UserComposer');
        view()->composer('layouts.app', 'Org4Leagues\Http\ViewComposer\UserDetailComposer');
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
