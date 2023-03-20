<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CountriesService;

class CountriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CountriesCervice::class, function ($app) {
            return new CountriesService();
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
