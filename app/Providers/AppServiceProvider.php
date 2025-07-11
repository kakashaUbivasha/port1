<?php

namespace App\Providers;

use App\Service\GlobalService;
use App\Service\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskService::class, function ($app) {
            return new TaskService();
        });
        $this->app->singleton(GlobalService::class, function ($app) {
            return new GlobalService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
