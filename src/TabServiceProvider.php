<?php

namespace ReeceM\GitTab;

use Facade\Ignition\Ignition;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ReeceM\GitTab\Http\Middleware\Authorize;

class TabServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->booted(function () {
            $this->routes();
            $this->handlePublishing();
            $this->registerConfig();
        // });

        Ignition::tab(app(IgnitionGitTab::class));
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        if (!config('app.debug')) {
            return;
        }

        Route::prefix('ignition-vendor/reecem/ignition-git')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Registers the applications config file and/or exports it
     */
    protected function registerConfig()
    {
        
        if (!config('app.debug')) {
            return;
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/ignition-git.php',
            'ignition-git'
        );
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function handlePublishing()
    {
        if ($this->app->runningInConsole()) {
            
            $this->publishes([
                __DIR__ . '/../config/ignition-git.php' => config_path('ignition-git.php'),
            ], 'ignition-git');

        }
    }
}
