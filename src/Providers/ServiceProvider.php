<?php

namespace Golchha21\ReSmushIt\Providers;

use Golchha21\ReSmushIt\ReSmushIt;
use Illuminate\Support\ServiceProvider as SP;

class ServiceProvider extends SP
{
    const CONFIG_PATH = __DIR__ . '/../config/ReSmushIt.php';

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

        $this->app->bind('optimize', function ($app) {
            return new ReSmushIt();
        });
    }
}
