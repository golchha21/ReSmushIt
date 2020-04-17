<?php

namespace Golchha21\ReSmushIt;

use Illuminate\Support\ServiceProvider;

class ReSmushItServiceProvider extends ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/config/ReSmushIt.php';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                self::CONFIG_PATH => config_path('ReSmushIt.php'),
            ], 'config');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(self::CONFIG_PATH, 'resmushit');

    }
}
