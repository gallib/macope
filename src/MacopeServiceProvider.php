<?php

namespace Gallib\Macope;

use Illuminate\Support\ServiceProvider;
use Gallib\Macope\Observers\CategoryObserver;
use Gallib\Macope\Observers\JournalEntryObserver;
use Gallib\Macope\Observers\CategorizationObserver;

class MacopeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the packages services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutes();

        $this->publishes([
            __DIR__.'/../config/macope.php' => config_path('macope.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'macope');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/assets/js/components' => base_path('resources/assets/js/components/macope'),
            ], 'macope-components');
        }

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadObservers();
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/macope.php', 'macope');

        $this->registerProviders();

        $this->app->bind('CategorizationService', \Gallib\Macope\Services\CategorizationService::class);
        $this->app->bind('JournalEntryService', \Gallib\Macope\Services\JournalEntryService::class);
    }

    /**
     * Register 3rd party providers.
     *
     * @return void
     */
    protected function registerProviders()
    {
        $this->app->register(\Felixkiss\UniqueWithValidator\ServiceProvider::class);
    }

    /**
     * Load packages routes.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        include __DIR__.'/../routes/web.php';
    }

    /**
     * Load observers.
     *
     * @return void
     */
    protected function loadObservers()
    {
        Categorization::observe(CategorizationObserver::class);
        Category::observe(CategoryObserver::class);
        JournalEntry::observe(JournalEntryObserver::class);
    }
}
