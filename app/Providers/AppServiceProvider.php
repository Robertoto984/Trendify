<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();
        App::setLocale(session('locale', config('app.locale')));
    }
}
