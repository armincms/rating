<?php

namespace Armincms\Rating;

use Illuminate\Contracts\Support\DeferrableProvider; 
use Illuminate\Support\ServiceProvider; 

class RatingServiceProvider extends ServiceProvider implements DeferrableProvider
{ 
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [
            \Illuminate\Console\Events\ArtisanStarting::class
        ];
    }
}
