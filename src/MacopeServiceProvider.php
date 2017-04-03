<?php

namespace Gallib\Macope;

use Gallib\Macope\App\Categorization;
use Gallib\Macope\App\JournalEntry;
use Gallib\Macope\App\Observers\CategorizationObserver;
use Gallib\Macope\App\Observers\JournalEntryObserver;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

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
            __DIR__ . '/config/macope.php' => config_path('macope.php'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'macope');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadObservers();
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/macope.php', 'macope');

        $this->registerProviders();

        $this->registerAliases();

        $this->app->bind('JournalEntryService', \Gallib\Macope\App\Services\JournalEntryService::class);
    }

    /**
     * Register 3rd party providers.
     *
     * @return void
     */
    protected function registerProviders()
    {
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Maatwebsite\Excel\ExcelServiceProvider::class);
    }

    /**
     * Register 3rd party aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Excel', \Maatwebsite\Excel\Facades\Excel::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
    }

    /**
     * Load packages routes
     *
     * @return void
     */
    protected function loadRoutes()
    {
        include __DIR__ . '/routes/web.php';
    }

    /**
     * Load observers
     *
     * @return void
     */
    protected function loadObservers()
    {
        Categorization::observe(CategorizationObserver::class);
        JournalEntry::observe(JournalEntryObserver::class);
    }
}
