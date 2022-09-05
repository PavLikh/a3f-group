<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ParseHtmlService;

class ParseHtmlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ParseHtmlService::class, function ($app) {
            return new ParseHtmlService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
