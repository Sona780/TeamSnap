<?php

namespace Org4Leagues\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       //   view()->composer(
       //   'layouts.new',
       //   'Org4Leagues\Http\ViewComposers\LayoutComposer'
       // );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
