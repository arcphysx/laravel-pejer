<?php

namespace Arcphysx\LaravelPejer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class LaravelPejerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../../config/laravelpejer.php' => config_path('laravelpejer.php')], 'config');
        }elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('laravelpejer');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/laravelpejer.php', 'laravelpejer');
    }
}