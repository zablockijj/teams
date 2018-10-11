<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Resource::withoutWrapping();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
