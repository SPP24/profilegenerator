<?php

namespace SPP24\profilegenerator;

use Illuminate\Support\ServiceProvider;

class profilegeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('SPP24\profilegenerator\src\Http\Controllers\ProfileController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/src/database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/src/database/factories');
        $this->loadViewsFrom(__DIR__.'/resources/views/profiles/', 'SPP24');
        $this->publishes([
            __DIR__.'/resources/views/profiles' => base_path('resources/views/vendor/SPP24/profiles'),
        ]);

        $this->app['router']->namespace('SPP24\\profilegenerator\\Controllers')
            ->middleware(['auth'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
            });
    }
}
