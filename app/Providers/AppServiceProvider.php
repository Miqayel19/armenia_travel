<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            'App\Http\Contracts\OrderInterface', 
            'App\Http\Services\OrderService'
        );
        $this->app->bind(
            'App\Http\Contracts\OrderStatusInterface', 
            'App\Http\Services\OrderStatusService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }
}
