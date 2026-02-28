<?php

namespace App\Providers;

use App\Models\Warga;
use App\Observers\WargaObserver;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Warga::observe(WargaObserver::class);
    }
}
