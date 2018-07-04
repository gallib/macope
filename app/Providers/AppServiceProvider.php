<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Categorization;
use App\Category;
use App\JournalEntry;
use App\Observers\CategoryObserver;
use App\Observers\JournalEntryObserver;
use App\Observers\CategorizationObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CategorizationService', \Gallib\Macope\Services\CategorizationService::class);
        $this->app->bind('JournalEntryService', \Gallib\Macope\Services\JournalEntryService::class);
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
