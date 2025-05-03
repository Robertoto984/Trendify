<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repositories\CartRepositoryInterface::class,
            \App\Repositories\CartRepository::class
        );
    }


    public function boot(): void
    {
        //
    }
}
